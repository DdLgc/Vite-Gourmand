<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\EmployeeType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class EmployeeController extends AbstractController
{
    #[Route('/admin/employes', name: 'app_admin_employees', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $employees = $userRepository->findEmployees();

        return $this->render('admin/employees/index.html.twig', [
            'employees' => $employees,
        ]);
    }

    #[Route('/admin/employes/nouveau', name: 'app_admin_employee_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher,
        UserRepository $userRepository
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $employee = new User();

        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $existingUser = $userRepository->findOneBy([
                'email' => $employee->getEmail(),
            ]);

            if ($existingUser !== null) {
                $form->get('email')->addError(
                    new \Symfony\Component\Form\FormError(
                        'Cette adresse e-mail est déjà utilisée.'
                    )
                );
            } else {
                $plainPassword = $form->get('plainPassword')->getData();

                $employee->setPassword(
                    $passwordHasher->hashPassword($employee, $plainPassword)
                );

                $employee->setRoles(['ROLE_EMPLOYEE']);
                $employee->setIsActive(true);

                $entityManager->persist($employee);
                $entityManager->flush();

                $this->addFlash('success', 'Employé créé avec succès.');

                return $this->redirectToRoute('app_admin_employees');
            }
        }

        return $this->render('admin/employees/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/employes/{id}/modifier', name: 'app_admin_employee_edit', methods: ['GET', 'POST'])]
    public function edit(
        User $employee,
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher,
        UserRepository $userRepository
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if (!in_array('ROLE_EMPLOYEE', $employee->getRoles(), true)) {
            throw $this->createNotFoundException('Employé introuvable.');
        }

        $form = $this->createForm(EmployeeType::class, $employee, [
            'password_required' => false,
        ]);

        $originalEmail = $employee->getEmail();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $existingUser = $userRepository->findOneBy([
                'email' => $employee->getEmail(),
            ]);

            if ($existingUser !== null && $existingUser->getId() !== $employee->getId()) {
                $employee->setEmail($originalEmail);

                $form->get('email')->addError(
                    new \Symfony\Component\Form\FormError(
                        'Cette adresse e-mail est déjà utilisée.'
                    )
                );
            } else {
                $plainPassword = $form->get('plainPassword')->getData();

                if ($plainPassword !== null && $plainPassword !== '') {
                    $employee->setPassword(
                        $passwordHasher->hashPassword($employee, $plainPassword)
                    );
                }

                $entityManager->flush();

                $this->addFlash('success', 'Employé modifié avec succès.');

                return $this->redirectToRoute('app_admin_employees');
            }
        }

        return $this->render('admin/employees/edit.html.twig', [
            'form' => $form->createView(),
            'employee' => $employee,
        ]);
    }
    #[Route(
        '/admin/employes/{id}/desactiver',
        name: 'app_admin_employee_deactivate',
        methods: ['POST']
    )]
    public function deactivate(
        User $employee,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if (!in_array('ROLE_EMPLOYEE', $employee->getRoles(), true)) {
            throw $this->createNotFoundException('Employé introuvable.');
        }

        if (!$this->isCsrfTokenValid(
            'deactivate_employee_' . $employee->getId(),
            $request->request->getString('_token')
        )) {
            throw $this->createAccessDeniedException(
                'Jeton de sécurité invalide.'
            );
        }

        if (!$employee->isActive()) {
            $this->addFlash('warning', 'Ce compte est déjà désactivé.');

            return $this->redirectToRoute('app_admin_employees');
        }

        $employee->setIsActive(false);
        $employee->setUpdatedAt(new \DateTimeImmutable());

        $entityManager->flush();

        $this->addFlash('success', 'Le compte employé a été désactivé.');

        return $this->redirectToRoute('app_admin_employees');
    }
}
