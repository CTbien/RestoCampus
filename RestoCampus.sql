-- =====================================================
-- BASE DE DONNÉES : Projet Cantine
-- Auteur : [Ton nom]
-- Date : 2025-10-13
-- Description : Script de création du MLD (Modèle Logique de Données)
-- =====================================================

-- Création de la base de données
CREATE DATABASE IF NOT EXISTS cantine CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cantine;

-- =====================================================
-- TABLE : UTILISATEUR
-- =====================================================
CREATE TABLE UTILISATEUR (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('admin', 'étudiant') NOT NULL
);

-- =====================================================
-- TABLE : ARTICLE
-- =====================================================
CREATE TABLE ARTICLE (
    id_article INT AUTO_INCREMENT PRIMARY KEY,
    nom_article VARCHAR(100) NOT NULL,
    description TEXT,
    prix DECIMAL(6,2) NOT NULL CHECK (prix >= 0),
    quantite_disponible INT NOT NULL DEFAULT 0 CHECK (quantite_disponible >= 0),
    quantite_max INT NOT NULL DEFAULT 0 CHECK (quantite_max >= 0)
);

-- =====================================================
-- TABLE : INGREDIENT
-- =====================================================
CREATE TABLE INGREDIENT (
    id_ingredient INT AUTO_INCREMENT PRIMARY KEY,
    nom_ingredient VARCHAR(100) NOT NULL,
    allergene BOOLEAN NOT NULL DEFAULT FALSE,
    type VARCHAR(50)
);

-- =====================================================
-- TABLE : COMMANDE
-- =====================================================
CREATE TABLE COMMANDE (
    id_commande INT AUTO_INCREMENT PRIMARY KEY,
    date_commande DATE NOT NULL,
    heure_commande TIME NOT NULL,
    statut ENUM('réservée', 'récupérée', 'annulée') NOT NULL DEFAULT 'réservée',
    id_utilisateur INT NOT NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- =====================================================
-- TABLE D’ASSOCIATION : CONTENIR
-- =====================================================
CREATE TABLE CONTENIR (
    id_commande INT NOT NULL,
    id_article INT NOT NULL,
    quantite_commandee INT NOT NULL CHECK (quantite_commandee > 0),
    PRIMARY KEY (id_commande, id_article),
    FOREIGN KEY (id_commande) REFERENCES COMMANDE(id_commande)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (id_article) REFERENCES ARTICLE(id_article)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- =====================================================
-- TABLE D’ASSOCIATION : COMPOSER
-- =====================================================
CREATE TABLE COMPOSER (
    id_article INT NOT NULL,
    id_ingredient INT NOT NULL,
    quantite_ingredient DECIMAL(6,2) NOT NULL CHECK (quantite_ingredient > 0),
    PRIMARY KEY (id_article, id_ingredient),
    FOREIGN KEY (id_article) REFERENCES ARTICLE(id_article)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (id_ingredient) REFERENCES INGREDIENT(id_ingredient)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- =====================================================
-- VUES OPTIONNELLES OU DONNÉES DE TEST
-- =====================================================

-- Exemple d’insertion d’un admin et d’un étudiant
INSERT INTO UTILISATEUR (nom, prenom, email, mot_de_passe, role)
VALUES 
('Dupont', 'Admin', 'admin@cantine.fr', 'admin123', 'admin'),
('Martin', 'Alice', 'alice@etu.fr', 'etu123', 'étudiant');

-- Exemple d’articles
INSERT INTO ARTICLE (nom_article, description, prix, quantite_disponible, quantite_max)
VALUES 
('Sandwich Jambon', 'Sandwich au jambon et beurre', 3.50, 20, 50),
('Salade César', 'Salade avec poulet, parmesan, croûtons', 4.20, 15, 40);

-- Exemple d’ingrédients
INSERT INTO INGREDIENT (nom_ingredient, allergene, type)
VALUES
('Jambon', FALSE, 'viande'),
('Beurre', TRUE, 'produit laitier'),
('Poulet', FALSE, 'viande'),
('Parmesan', TRUE, 'fromage');

-- Lier ingrédients aux articles
INSERT INTO COMPOSER (id_article, id_ingredient, quantite_ingredient)
VALUES
(1, 1, 0.05), -- Sandwich Jambon - Jambon
(1, 2, 0.01), -- Sandwich Jambon - Beurre
(2, 3, 0.08), -- Salade César - Poulet
(2, 4, 0.02); -- Salade César - Parmesan

-- Exemple de commande
INSERT INTO COMMANDE (date_commande, heure_commande, statut, id_utilisateur)
VALUES (CURDATE(), CURTIME(), 'réservée', 2);

-- Exemple de contenu de commande
INSERT INTO CONTENIR (id_commande, id_article, quantite_commandee)
VALUES (1, 1, 2);
