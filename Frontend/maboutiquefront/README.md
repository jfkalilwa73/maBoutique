# MA BOUTIQUE

Front-end d’une vitrine e-commerce (style marketplace) : pages d’accueil / catalogue, authentification simulée, espaces commerçant et atelier. **Aucune base de données ni API** : la connexion et les données affichées sont des démonstrations pour le développement de l’interface.

## Prérequis

- [Node.js](https://nodejs.org/) **18+** (LTS recommandé)
- **npm** (fourni avec Node)

Vérifier les versions :

```bash
node -v
npm -v
```

## Installation

À la racine du projet :

```bash
npm install
```

## Démarrage en développement

```bash
npm run dev
```

Le serveur Vite démarre par défaut sur **http://localhost:5174/** (port défini dans `vite.config.ts` pour limiter les conflits avec une autre app sur le port `5173`).

- Ouvrir l’URL indiquée dans le terminal si elle diffère (port occupé, etc.).
- Arrêter le serveur : **Ctrl+C** dans le terminal.

### Conflit de port

Si `5174` est déjà utilisé, modifiez le port dans `vite.config.ts` :

```ts
server: { port: 5200 }
```

Ou lancez une fois sans toucher au fichier :

```bash
npx vite --port 5200
```

## Autres commandes

| Commande        | Description                                      |
|-----------------|--------------------------------------------------|
| `npm run build` | Compilation TypeScript + build de production dans `dist/` |
| `npm run preview` | Sert le build localement (test du bundle)     |
| `npm run lint`  | Analyse ESLint du code                          |

## Utilisation rapide (démo)

- **Connexion** : soumettre le formulaire redirige vers le **tableau de bord commerçant** (sans vérification réelle des identifiants).
- **Navigation** : barre du haut masquée sur la page de connexion ; `Déconnexion` dans la barre après « connexion ».
- **Parcourir le catalogue sans compte** : lien sur la page de connexion.

## Structure du code (aperçu)

- `src/application/` — orchestration, registre de pages, ports (contrats), ViewModel
- `src/infrastructure/` — adaptateurs d’état (mémoire) pour l’UI
- `src/models/` — types et données statiques de démonstration
- `src/views/` — composants de présentation
- `src/App.tsx` — point d’entrée de l’interface

## Stack technique

- React 19, TypeScript
- Vite 5
- ESLint

## Dépannage

- **`npm` introuvable** : réinstaller Node.js ou vérifier le PATH.
- **Écran blanc / erreur au build** : supprimer `node_modules` et `package-lock.json`, puis `npm install` de nouveau.
- **Page ne se rafrachit pas** : recharger le navigateur ; le HMR de Vite recharge en général tout seul.

---

© Projet local **ma-boutique** — front-end uniquement.
