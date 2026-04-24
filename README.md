# maBoutique

Monorepo : API Laravel et application React (Vite).

## Structure

- **`maBoutique/`** — Backend Laravel (API REST, base de données, authentification).
- **`frontend/`** — Interface React + TypeScript + Vite.

Les deux branches historiques **Backend** et **Frontend** utilisaient toutes les deux un dossier nommé `maBoutique`, ce qui provoquait des conflits et une impression de mélange lors des pushes. Sur **`main`**, le front vit désormais dans **`frontend/`** pour rester séparé du Laravel.

## Démarrage rapide

### API (Laravel)

```bash
cd maBoutique
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

### Interface (Vite)

```bash
cd frontend
npm ci
npm run dev
```

En développement, configurez CORS et l’URL de l’API (`APP_URL`, `SANCTUM_STATEFUL_DOMAINS` côté Laravel, variable d’API côté front) pour que le navigateur puisse joindre le backend.

## Git

Après `git pull` sur `main`, travailler **depuis la racine du dépôt** : ne pas recopier le front dans `maBoutique/` ni l’inverse. Chaque partie a son dossier et son `package.json` / `composer.json` respectif.
