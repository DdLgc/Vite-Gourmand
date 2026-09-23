<?php

namespace App\DataFixtures;

use App\Entity\Allergen;
use App\Entity\Dish;
use App\Entity\Menu;
use App\Entity\OpeningHour;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);
        $allergens = $this->loadAllergens($manager);
        $dishes = $this->loadDishes($manager, $allergens);
        $this->loadMenus($manager, $dishes);
        $this->loadOpeningHours($manager);

        $manager->flush();
    }

    private function loadUsers(ObjectManager $manager): void
    {
        $users = [
            [
                'firstName' => 'Admin',
                'lastName' => 'Vite & Gourmand',
                'email' => 'admin@vite-gourmand.fr',
                'phone' => '0600000001',
                'address' => '10 rue Sainte-Catherine',
                'postalCode' => '33000',
                'city' => 'Bordeaux',
                'roles' => ['ROLE_ADMIN'],
                'password' => 'AdminVg2026!',
            ],
            [
                'firstName' => 'Julie',
                'lastName' => 'Martin',
                'email' => 'employe@vite-gourmand.fr',
                'phone' => '0600000002',
                'address' => '12 rue du Parlement',
                'postalCode' => '33000',
                'city' => 'Bordeaux',
                'roles' => ['ROLE_EMPLOYEE'],
                'password' => 'EmployeVg2026!',
            ],
            [
                'firstName' => 'Client',
                'lastName' => 'Demo',
                'email' => 'client@vite-gourmand.fr',
                'phone' => '0600000003',
                'address' => '25 cours Victor Hugo',
                'postalCode' => '33000',
                'city' => 'Bordeaux',
                'roles' => ['ROLE_USER'],
                'password' => 'ClientVg2026!',
            ],
        ];

        foreach ($users as $data) {
            $user = new User();
            $user
                ->setFirstName($data['firstName'])
                ->setLastName($data['lastName'])
                ->setEmail($data['email'])
                ->setPhone($data['phone'])
                ->setPostalAddress($data['address'])
                ->setPostalCode($data['postalCode'])
                ->setCity($data['city'])
                ->setRoles($data['roles'])
                ->setIsActive(true);

            $user->setPassword(
                $this->passwordHasher->hashPassword($user, $data['password'])
            );

            $manager->persist($user);
        }
    }

    private function loadAllergens(ObjectManager $manager): array
    {
        $allergens = [];

        foreach (['Gluten', 'Lait', 'Œufs', 'Fruits à coque', 'Poisson', 'Crustacés'] as $name) {
            $allergen = new Allergen();
            $allergen->setName($name);

            $manager->persist($allergen);
            $allergens[$name] = $allergen;
        }

        return $allergens;
    }

    private function loadDishes(ObjectManager $manager, array $allergens): array
    {
        $dishesData = [
            [
                'key' => 'foie-gras',
                'name' => 'Foie gras maison',
                'description' => 'Foie gras maison accompagné de pain toasté.',
                'courseType' => 'Entrée',
                'allergens' => ['Gluten'],
            ],
            [
                'key' => 'saumon',
                'name' => 'Saumon rôti aux herbes',
                'description' => 'Saumon rôti accompagné de légumes de saison.',
                'courseType' => 'Plat',
                'allergens' => ['Poisson'],
            ],
            [
                'key' => 'boeuf',
                'name' => 'Bœuf sauce bordelaise',
                'description' => 'Pièce de bœuf et sauce bordelaise, accompagnée de pommes grenailles.',
                'courseType' => 'Plat',
                'allergens' => [],
            ],
            [
                'key' => 'risotto',
                'name' => 'Risotto aux légumes',
                'description' => 'Risotto crémeux aux légumes de saison.',
                'courseType' => 'Plat',
                'allergens' => ['Lait'],
            ],
            [
                'key' => 'tarte',
                'name' => 'Tarte aux pommes',
                'description' => 'Tarte aux pommes traditionnelle.',
                'courseType' => 'Dessert',
                'allergens' => ['Gluten', 'Lait', 'Œufs'],
            ],
            [
                'key' => 'fondant',
                'name' => 'Fondant au chocolat',
                'description' => 'Fondant au chocolat servi avec une crème légère.',
                'courseType' => 'Dessert',
                'allergens' => ['Gluten', 'Lait', 'Œufs'],
            ],
        ];

        $dishes = [];

        foreach ($dishesData as $data) {
            $dish = new Dish();
            $dish
                ->setName($data['name'])
                ->setDescription($data['description'])
                ->setCourseType($data['courseType']);

            foreach ($data['allergens'] as $allergenName) {
                $dish->addAllergen($allergens[$allergenName]);
            }

            $manager->persist($dish);
            $dishes[$data['key']] = $dish;
        }

        return $dishes;
    }

    private function loadMenus(ObjectManager $manager, array $dishes): void
    {
        $menusData = [
            [
                'title' => 'Menu Tradition',
                'description' => 'Une sélection inspirée de la cuisine traditionnelle bordelaise.',
                'conditions' => 'Commande à effectuer au minimum 48 heures à l’avance.',
                'minimumPeople' => 4,
                'basePriceCents' => 3500,
                'availableStock' => 20,
                'theme' => 'Traditionnel',
                'diet' => 'Classique',
                'dishes' => ['foie-gras', 'boeuf', 'tarte'],
            ],
            [
                'title' => 'Menu Élégance',
                'description' => 'Un menu raffiné pour les repas et événements.',
                'conditions' => 'Commande à effectuer au minimum 72 heures à l’avance.',
                'minimumPeople' => 6,
                'basePriceCents' => 4500,
                'availableStock' => 15,
                'theme' => 'Gastronomique',
                'diet' => 'Classique',
                'dishes' => ['foie-gras', 'saumon', 'fondant'],
            ],
            [
                'title' => 'Menu Végétal',
                'description' => 'Une proposition sans viande autour des produits de saison.',
                'conditions' => 'Commande à effectuer au minimum 48 heures à l’avance.',
                'minimumPeople' => 4,
                'basePriceCents' => 2900,
                'availableStock' => 20,
                'theme' => 'Saison',
                'diet' => 'Végétarien',
                'dishes' => ['risotto', 'tarte'],
            ],
        ];

        foreach ($menusData as $data) {
            $menu = new Menu();
            $menu
                ->setTitle($data['title'])
                ->setDescription($data['description'])
                ->setConditions($data['conditions'])
                ->setMinimumPeople($data['minimumPeople'])
                ->setBasePriceCents($data['basePriceCents'])
                ->setAvailableStock($data['availableStock'])
                ->setTheme($data['theme'])
                ->setDiet($data['diet'])
                ->setIsActive(true);

            foreach ($data['dishes'] as $dishKey) {
                $menu->addDish($dishes[$dishKey]);
            }

            $manager->persist($menu);
        }
    }

    private function loadOpeningHours(ObjectManager $manager): void
    {
        for ($day = 1; $day <= 6; ++$day) {
            $openingHour = new OpeningHour();
            $openingHour
                ->setDayOfWeek($day)
                ->setMorningOpen(new \DateTimeImmutable('09:00'))
                ->setMorningClose(new \DateTimeImmutable('13:00'))
                ->setAfternoonOpen(new \DateTimeImmutable('14:00'))
                ->setAfternoonClose(new \DateTimeImmutable('18:00'))
                ->setIsClosed(false);

            $manager->persist($openingHour);
        }

        $sunday = new OpeningHour();
        $sunday
            ->setDayOfWeek(7)
            ->setIsClosed(true);

        $manager->persist($sunday);
    }
}