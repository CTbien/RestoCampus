-- =====================================================
-- BASE DE DONNÉES : Projet Cantine
-- Auteur : [Ton nom]
-- Date : 2025-10-13
-- Description : Script de création du MLD (Modèle Logique de Données) - Version corrigée
-- =====================================================

-- Création de la base de données
CREATE DATABASE IF NOT EXISTS cantine CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cantine;

-- =====================================================
-- TABLE : users
-- =====================================================
CREATE TABLE IF NOT EXISTS users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  login VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL -- Augmenté la taille pour les mots de passe hachés
);

-- =====================================================
-- TABLE : ARTICLE
-- =====================================================
CREATE TABLE IF NOT EXISTS ARTICLE (
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
CREATE TABLE IF NOT EXISTS INGREDIENT (
    id_ingredient INT AUTO_INCREMENT PRIMARY KEY,
    nom_ingredient VARCHAR(100) NOT NULL,
    allergene BOOLEAN NOT NULL DEFAULT FALSE,
    type VARCHAR(50)
);

-- =====================================================
-- TABLE : COMMANDE
-- =====================================================
CREATE TABLE IF NOT EXISTS COMMANDE (
    id_commande INT AUTO_INCREMENT PRIMARY KEY,
    date_commande DATE NOT NULL,
    heure_commande TIME NOT NULL,
    statut ENUM('réservée', 'récupérée', 'annulée') NOT NULL DEFAULT 'réservée',
    id_utilisateur INT NOT NULL,
    -- CORRECTION : La clé étrangère référence maintenant la table `users` et sa colonne `id`
    FOREIGN KEY (id_utilisateur) REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- =====================================================
-- TABLE D’ASSOCIATION : CONTENIR
-- =====================================================
CREATE TABLE IF NOT EXISTS CONTENIR (
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
CREATE TABLE IF NOT EXISTS COMPOSER (
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
-- DONNÉES DE TEST
-- =====================================================

-- Exemple d’insertion d’un admin et d’un étudiant
-- Les ID seront 1 pour 'admin' et 2 pour 'etudiant' grâce à l'AUTO_INCREMENT
INSERT INTO users (login, password) VALUES
('admin', 'admin123'),
('etudiant', 'azerty');

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
(1, 1, 0.05), -- Sandwich Jambon (id=1) -> Jambon (id=1)
(1, 2, 0.01), -- Sandwich Jambon (id=1) -> Beurre (id=2)
(2, 3, 0.08), -- Salade César (id=2) -> Poulet (id=3)
(2, 4, 0.02); -- Salade César (id=2) -> Parmesan (id=4)

-- Exemple de commande pour l'utilisateur 'etudiant' (id=2)
INSERT INTO COMMANDE (date_commande, heure_commande, statut, id_utilisateur)
VALUES (CURDATE(), CURTIME(), 'réservée', 2);

-- Exemple de contenu de commande (la commande avec id=1 contient 2 sandwichs)
INSERT INTO CONTENIR (id_commande, id_article, quantite_commandee)
VALUES (1, 1, 2);