CREATE DATABASE IF NOT EXISTS ma_boutique
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE ma_boutique;

CREATE TABLE utilisateurs (
    id_utilisateur BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(40) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(191) NOT NULL,
    date_de_naissance DATE,
    sexe ENUM('M', 'F') NULL,
    role ENUM('admin', 'commercant', 'vendeur') NOT NULL DEFAULT 'vendeur',
    photo VARCHAR(191) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE boutiques(
    id_boutique BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_commercant BIGINT UNSIGNED NOT NULL,
    nom VARCHAR(100) NOT NULL,
    description TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_commercant FOREIGN KEY (id_commercant)
        REFERENCES utilisateurs(id_utilisateur) ON DELETE CASCADE
);

CREATE TABLE boutique_vendeur (
    id_boutique BIGINT UNSIGNED NOT NULL,
    id_vendeur BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT pk_boutique_vendeur PRIMARY KEY (id_boutique, id_vendeur),
    CONSTRAINT fk_boutique FOREIGN KEY (id_boutique)
        REFERENCES boutiques(id_boutique) ON DELETE CASCADE,
    CONSTRAINT fk_vendeur_boutique FOREIGN KEY (id_vendeur)
        REFERENCES utilisateurs(id_utilisateur) ON DELETE CASCADE
);

CREATE TABLE categories (
    id_categorie BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL UNIQUE,
    description TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE produits (
    id_produit BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_categorie BIGINT UNSIGNED NULL,
    nom VARCHAR(100) NOT NULL,
    description TEXT NULL,
    prix DECIMAL(10,2) NOT NULL,
    quantite INT UNSIGNED NOT NULL DEFAULT 0,
    photo VARCHAR(191) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_vendeur FOREIGN KEY (id_vendeur)
        REFERENCES utilisateurs(id_utilisateur) ON DELETE CASCADE,
    CONSTRAINT fk_categorie FOREIGN KEY (id_categorie)
        REFERENCES categories(id_categorie) ON DELETE SET NULL
);

CREATE TABLE boutiques_produits(
    id_boutique BIGINT UNSIGNED NOT NULL,
    id_produit BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT pk_boutique_produit PRIMARY KEY (id_boutique, id_produit),
    CONSTRAINT fk_boutique_produit FOREIGN KEY (id_boutique)
        REFERENCES boutiques(id_boutique) ON DELETE CASCADE,
    CONSTRAINT fk_produit_boutique FOREIGN KEY (id_produit)
        REFERENCES produits(id_produit) ON DELETE CASCADE
);

CREATE TABLE produit_vendeur(
    id_produit_vendeur BIGINT UNSIGNED NOT NULL,
    id_vendeur BIGINT UNSIGNED NOT NULL,
    id_produit BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT pk_produit_vendeur PRIMARY KEY (id_produit, id_vendeur),
    CONSTRAINT fk_produit_vendeur FOREIGN KEY (id_produit)
        REFERENCES produits(id_produit) ON DELETE CASCADE,
    CONSTRAINT fk_vendeur_produit FOREIGN KEY (id_vendeur)
        REFERENCES utilisateurs(id_utilisateur) ON DELETE CASCADE
);