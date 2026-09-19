# Vite & Gourmand

[![HTML5](https://img.shields.io/badge/HTML5-Markup-E34F26?logo=html5&logoColor=white)]()
[![CSS3](https://img.shields.io/badge/CSS3-Styling-1572B6?logo=css3&logoColor=white)]()
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?logo=javascript&logoColor=black)]()
<!-- [![Status](https://img.shields.io/badge/Status-{{ STATUS }}-success)]() -->

---

## Description

Application web réalisée dans le cadre du titre professionnel Développeur Web et Web Mobile.

## Fonctionnalités

### Frontend

- {{ FRONTEND_FEATURE_1 }}
- {{ FRONTEND_FEATURE_2 }}
- {{ FRONTEND_FEATURE_3 }}

### Backend

- {{ BACKEND_FEATURE_1 }}
- {{ BACKEND_FEATURE_2 }}
- {{ BACKEND_FEATURE_3 }}

---
## Stack technique

- PHP 8.3
- Symfony 7.4 LTS
- PostgreSQL 17
- MongoDB 8
- Mailpit
- Docker & Docker Compose
- Git
- GitHub

---

## Installation

### Prérequis

- Git
- Docker Desktop
- Docker Compose

### Étapes

#### 1. Cloner le projet

```bash
git clone https://github.com/DdLgc/Vite-Gourmand.git
```

#### 2. Accéder au projet

```bash
cd Vite-Gourmand
```

#### 3. Configurer l'environnement Docker

Créer le fichier `.env.docker` à partir du fichier `.env.docker.example` :

```bash
cp .env.docker.example .env.docker
```

Renseigner ensuite les variables d'environnement locales dans `.env.docker`.

Le fichier `.env.docker` n'est pas versionné.

#### 4. Démarrer l'environnement

```bash
docker compose --env-file .env.docker up -d
```

### Services Docker

| Service | Utilisation | Port |
| --- | --- | --- |
| `app` | Application Symfony | `8000` |
| `database` | PostgreSQL | `5432` (interne) |
| `mongodb` | MongoDB | `27017` (interne) |
| `mailpit` | Interface Mailpit | `8025` |
| `mailpit` | Serveur SMTP | `1025` |

L'application est accessible sur `http://localhost:8000`.

Mailpit est accessible sur `http://localhost:8025`.

### Commandes Docker utiles

Vérifier l'état des services :

```bash
docker compose --env-file .env.docker ps
```

Vérifier l'environnement Symfony :

```bash
docker compose --env-file .env.docker exec app php bin/console about
```

Vérifier PostgreSQL :

```bash
docker compose --env-file .env.docker exec database pg_isready -U vite_gourmand -d vite_gourmand
```

Arrêter les services :

```bash
docker compose --env-file .env.docker stop
```

Redémarrer les services :

```bash
docker compose --env-file .env.docker start
```

---

## Utilisation

{{ USAGE }}

---

## Compétences développées

- {{ SKILL_1 }}
- {{ SKILL_2 }}
- {{ SKILL_3 }}
- Git & GitHub
- Workflow professionnel

---

## Workflow Git

Branches utilisées :

- `feature/*`
- `fix/*`
- `refactor/*`
- `docs/*`
- `release/*`

Conventional Commits :

```text
feat:
fix:
docs:
refactor:
style:
chore:
```

---

## Améliorations possibles

- {{ ROADMAP_1 }}
- {{ ROADMAP_2 }}
- {{ ROADMAP_3 }}

---

## 🔗 Links

[![Portfolio](https://img.shields.io/badge/Portfolio-000?style=for-the-badge&logo=ko-fi&logoColor=white)](https://ddlgc-portfolio.netlify.app/)

[![GitHub](https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github&logoColor=white)]({{ GITHUB_REPOSITORY }})

[![LinkedIn](https://img.shields.io/badge/LinkedIn-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/david-le-gouellec-551322243/)

---

## Arborescence

```text
{{ PROJECT_TREE }}
```

---

## Captures d'écran

À venir.

---

## Auteur

**David Le Gouellec**

{{ AUTHOR_DESCRIPTION }}

---

## Licence

Projet réalisé à des fins pédagogiques.

Vous êtes libre de le consulter, de l'utiliser et de l'adapter pour votre apprentissage.