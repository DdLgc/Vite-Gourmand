# Vite & Gourmand

![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?logo=php&logoColor=white)
![Symfony](https://img.shields.io/badge/Symfony-7.4-000000?logo=symfony&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-17-4169E1?logo=postgresql&logoColor=white)
![MongoDB](https://img.shields.io/badge/MongoDB-8-47A248?logo=mongodb&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-Compose-2496ED?logo=docker&logoColor=white)
![Status](https://img.shields.io/badge/Status-En%20développement-orange)

Application web réalisée dans le cadre de la préparation du titre professionnel **Développeur Web et Web Mobile**.

> **État actuel :** projet en cours de développement.  
> La conception, l'environnement Docker et le socle de données sont réalisés.  
> Les interfaces et les fonctionnalités métier restent à développer.

---

## Sommaire

- [Présentation](#présentation)
- [Fonctionnalités prévues](#fonctionnalités-prévues)
- [État d'avancement](#état-davancement)
- [Stack technique](#stack-technique)
- [Installation](#installation)
- [Base de données](#base-de-données)
- [Comptes de démonstration](#comptes-de-démonstration)
- [Documentation](#documentation)
- [Workflow Git](#workflow-git)
- [Déploiement](#déploiement)
- [Auteur](#auteur)

---

## Présentation

**Vite & Gourmand** est un projet de site web pour une entreprise de traiteur située à Bordeaux.

L'application doit permettre aux visiteurs de découvrir les menus et les plats proposés par l'entreprise.

Les clients pourront créer un compte, commander un menu, choisir les informations de livraison et suivre l'avancement de leur commande.

Des espaces spécifiques sont également prévus pour les employés et l'administrateur.

Le projet est actuellement en cours de développement.

---

## Fonctionnalités prévues

### Visiteur

- Consulter les menus disponibles
- Filtrer les menus
- Consulter les informations des plats
- Créer un compte
- Se connecter
- Contacter l'entreprise

### Client

- Gérer son compte
- Passer une commande
- Choisir le nombre de personnes
- Renseigner les informations de livraison
- Consulter le détail du prix
- Modifier ou annuler une commande selon son état
- Suivre l'évolution d'une commande
- Déposer un avis

### Employé

- Gérer les menus et les plats
- Gérer les horaires
- Consulter les commandes
- Modifier le statut d'une commande
- Enregistrer les prises de contact avec les clients
- Modérer les avis

### Administrateur

- Gérer les comptes employés
- Consulter les statistiques
- Consulter le chiffre d'affaires par menu

> Ces fonctionnalités correspondent à la conception du projet et ne sont pas toutes implémentées actuellement.

---

## État d'avancement

### Réalisé

- Analyse du sujet
- Organisation du projet avec Trello
- Réflexion initiale avec Excalidraw
- Charte graphique
- Maquettes desktop et mobile
- Diagramme de cas d'utilisation
- Diagramme de séquence
- Architecture technique
- MCD
- MLD
- Environnement Docker Compose
- Projet Symfony 7.4
- PostgreSQL
- MongoDB
- Mailpit
- Configuration Doctrine ORM
- Entités et relations
- Migration initiale
- Fixtures de démonstration
- Mise en place de Symfony Security pour les utilisateurs
- Hashage des mots de passe
- Scripts SQL de structure et de données

### À poursuivre

- Intégration des interfaces Twig
- Authentification
- Gestion des comptes
- Catalogue des menus
- Système de commande
- Calcul des remises et frais de livraison
- Suivi des commandes
- Espaces employé et administrateur
- Statistiques MongoDB
- Envoi des emails
- Validation des formulaires
- Tests
- Accessibilité
- Déploiement

---

## Stack technique

### Back-end

- PHP 8.3
- Symfony 7.4 LTS
- Doctrine ORM
- Symfony Security

### Front-end

- Twig
- TypeScript prévu pour les interactions côté navigateur

### Données

- PostgreSQL 17
- MongoDB 8

### Environnement

- Docker
- Docker Compose
- Mailpit

### Outils

- Git
- GitHub
- Trello
- Figma
- Excalidraw
- diagrams.net

---

## Installation

### Prérequis

- Git
- Docker Desktop
- Docker Compose

### 1. Cloner le dépôt

```bash
git clone https://github.com/DdLgc/Vite-Gourmand.git
```

### 2. Accéder au projet

```bash
cd Vite-Gourmand
```

### 3. Configurer l'environnement

Créer le fichier `.env.docker` à partir du modèle :

```bash
cp .env.docker.example .env.docker
```

Renseigner ensuite les variables locales dans `.env.docker`.

> `.env.docker` contient la configuration locale et n'est pas versionné.

### 4. Démarrer Docker

```bash
docker compose --env-file .env.docker up -d
```

### 5. Vérifier les services

```bash
docker compose --env-file .env.docker ps
```

### 6. Exécuter les migrations

```bash
docker compose --env-file .env.docker exec app php bin/console doctrine:migrations:migrate --no-interaction
```

### 7. Charger les données de démonstration

```bash
docker compose --env-file .env.docker exec app php bin/console doctrine:fixtures:load --no-interaction
```

> **Attention :** le chargement des fixtures supprime les données présentes dans les tables avant d'insérer les données de démonstration.

---

## Services Docker

| Service | Rôle | Port |
| --- | --- | --- |
| `app` | Application Symfony | `8000` |
| `database` | PostgreSQL | `5432` interne |
| `mongodb` | MongoDB | `27017` interne |
| `mailpit` | Interface Mailpit | `8025` |
| `mailpit` | SMTP | `1025` |

Application :

`http://localhost:8000`

Mailpit :

`http://localhost:8025`

---

## Base de données

La base relationnelle a été conçue à partir d'un **MCD**, puis d'un **MLD**, avant la création des entités Doctrine.

Le dossier `database/` contient :

```text
database/
├── schema.sql
└── data.sql
```

- `schema.sql` contient la structure SQL de la base.
- `data.sql` contient les données de démonstration exportées au format SQL.

Le projet contient également les migrations Doctrine et les fixtures utilisées pendant le développement.

---

## Comptes de démonstration

| Rôle | Email | Mot de passe |
| --- | --- | --- |
| Administrateur | `admin@vite-gourmand.fr` | `AdminVg2026!` |
| Employé | `employe@vite-gourmand.fr` | `EmployeVg2026!` |
| Client | `client@vite-gourmand.fr` | `ClientVg2026!` |

Les mots de passe sont hashés avec le système de hashage fourni par Symfony avant leur stockage en base de données.

> Les interfaces permettant d'utiliser ces comptes ne sont pas encore développées.

---

## Commandes utiles

Vérifier l'environnement Symfony :

```bash
docker compose --env-file .env.docker exec app php bin/console about
```

Vérifier les entités Doctrine :

```bash
docker compose --env-file .env.docker exec app php bin/console doctrine:mapping:info
```

Afficher l'état des migrations :

```bash
docker compose --env-file .env.docker exec app php bin/console doctrine:migrations:status
```

Vérifier le mapping Doctrine :

```bash
docker compose --env-file .env.docker exec app php bin/console doctrine:schema:validate
```

Arrêter les conteneurs :

```bash
docker compose --env-file .env.docker stop
```

Redémarrer les conteneurs :

```bash
docker compose --env-file .env.docker start
```

---

## Documentation

Les documents liés à la conception et au suivi du projet sont regroupés dans `docs/`.

```text
docs/
├── conception/
│   ├── architecture/
│   ├── database/
│   ├── sequence/
│   └── use-case/
├── graphic-charter/
├── project-management/
├── technical/
└── user-manual/
```

### Conception

- MCD
- MLD
- Diagramme de cas d'utilisation
- Diagramme de séquence
- Architecture technique

### Design

- Charte graphique
- Maquettes desktop
- Maquettes mobile

### Gestion du projet

- Réflexion initiale avec Excalidraw
- Suivi des tâches avec Trello

---

## Gestion de projet

Le suivi du projet est réalisé avec Trello :

https://trello.com/b/C0s4uFHV/vite-gourmand

Le tableau permet de suivre les différentes étapes depuis l'analyse et la conception jusqu'au développement et aux tests.

---

## Workflow Git

Le projet utilise principalement :

- `main` : branche principale
- `develop` : branche d'intégration
- `feat/*` : développement des fonctionnalités
- `fix/*` : corrections
- `docs/*` : documentation
- `refactor/*` : refactorisation

Les commits suivent la convention **Conventional Commits**.

```text
feat:
fix:
docs:
refactor:
style:
chore:
```

Exemples :

```text
feat(database): add User entity mapping
feat(database): add first Doctrine migration
feat(database): add demo fixtures and user security
docs(conception): add project diagrams
docs(design): add graphic charter and mockups
```

---

## Déploiement

L'application n'est pas encore déployée.

Le déploiement fait partie des étapes restantes du projet.

---

## Auteur

**David Le Gouellec**

Développeur Web Full Stack en formation.

Projet réalisé dans le cadre de la préparation du titre professionnel **Développeur Web et Web Mobile**.

---

## Licence

Projet réalisé à des fins pédagogiques.