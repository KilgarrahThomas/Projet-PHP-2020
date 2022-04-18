-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  lun. 17 août 2020 à 14:48
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_bibli`
--

-- --------------------------------------------------------

--
-- Structure de la table `amis`
--

DROP TABLE IF EXISTS `amis`;
CREATE TABLE IF NOT EXISTS `amis` (
  `client_id1` bigint(20) NOT NULL,
  `client_id2` bigint(20) NOT NULL,
  PRIMARY KEY (`client_id1`,`client_id2`),
  KEY `Fk_client2` (`client_id2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `auteurs`
--

DROP TABLE IF EXISTS `auteurs`;
CREATE TABLE IF NOT EXISTS `auteurs` (
  `auteur_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  PRIMARY KEY (`auteur_id`),
  UNIQUE KEY `nom` (`nom`,`prenom`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `auteurs`
--

INSERT INTO `auteurs` (`auteur_id`, `nom`, `prenom`) VALUES
(1, 'Doyle', 'Conan'),
(2, 'Grenier', 'Christian'),
(3, 'Rowling', 'Joanne');

-- --------------------------------------------------------

--
-- Structure de la table `auth_tokens`
--

DROP TABLE IF EXISTS `auth_tokens`;
CREATE TABLE IF NOT EXISTS `auth_tokens` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `selector` char(13) NOT NULL,
  `hash_validator` char(64) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ON UPDATE CURRENT_TIMESTAMP()',
  PRIMARY KEY (`id`),
  KEY `FK_Cli` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `auth_tokens`
--

INSERT INTO `auth_tokens` (`id`, `selector`, `hash_validator`, `client_id`, `expires`) VALUES
(1, 'a55505777674', 'af1c13f1250c884221834a90bc55e64bd4582cba25af7346759260f49f74ab8b', 2, '2020-08-12 13:18:04'),
(2, 'e777bd567c03', '1e4911227b433583eef621b9d0a4bda653c752641d9c938fa44b1b2396dfca04', 2, '2020-08-12 15:53:21'),
(3, '7f6fbf6c32f2', '148d1a2fd7d61bc44feba5fbfcdd3c2c2f37661f7b88040513e3f918167e0889', 2, '2020-08-14 11:31:43'),
(5, 'd478665b0a29', 'dc26070e9de6b4095ef89374f7de678e5a0015503031e6b3b632df1c5356a515', 3, '2020-08-14 13:17:28'),
(6, '49470e86a43a', '419bf94077a094d80ed73245188ca5708351adca3149542901868aaf074b3509', 2, '2020-08-15 13:01:06'),
(7, '1d43282bab97', 'e0b90efd17e7a2fbefc8be2ff455cfc65408b7bc117673fad300108faafe52ca', 2, '2021-08-16 19:31:02');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date_naiss` datetime NOT NULL,
  `visibility_collec` bigint(20) NOT NULL DEFAULT '2',
  `visibility_wishlist` bigint(20) NOT NULL DEFAULT '1',
  `niveau` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`client_id`),
  UNIQUE KEY `mail` (`mail`),
  KEY `FK_collec` (`visibility_collec`),
  KEY `Fk_wishlist` (`visibility_wishlist`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`client_id`, `nom`, `prenom`, `mail`, `mdp`, `date_naiss`, `visibility_collec`, `visibility_wishlist`, `niveau`) VALUES
(2, 'Salmon', 'Geoffrey', 'geoffrey.salmon@std.heh.be', '$2y$10$WZJt9Xacl9Cbxq3wyzeCVOJQCW6aayn7N5rZW5AYjWcEECsMPg9zq', '1991-07-26 18:46:27', 2, 1, 2),
(3, 'Zerque', 'Séverine', 'severine.zerque@std.heh.be', '$2y$10$/FsPbEz249pArZB2EPt44eutvI..feWPoe24NqJ9CDaDB7ePlDS5y', '2020-08-08 19:41:14', 2, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `collections`
--

DROP TABLE IF EXISTS `collections`;
CREATE TABLE IF NOT EXISTS `collections` (
  `client_id` bigint(20) NOT NULL,
  `livre_id` bigint(20) NOT NULL,
  `possede` tinyint(1) NOT NULL,
  `note` tinyint(6) DEFAULT NULL,
  `Commentaire` text,
  PRIMARY KEY (`client_id`,`livre_id`),
  KEY `Fk_livre` (`livre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `collections`
--

INSERT INTO `collections` (`client_id`, `livre_id`, `possede`, `note`, `Commentaire`) VALUES
(2, 1, 0, NULL, NULL),
(2, 4, 1, 17, ''),
(3, 2, 1, 17, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Fk_clientContact` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `client_id`, `message`) VALUES
(1, 3, '123'),
(2, 3, '456');

-- --------------------------------------------------------

--
-- Structure de la table `editions`
--

DROP TABLE IF EXISTS `editions`;
CREATE TABLE IF NOT EXISTS `editions` (
  `edition_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `maison_edition` varchar(50) NOT NULL,
  PRIMARY KEY (`edition_id`),
  UNIQUE KEY `maison_edition` (`maison_edition`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `editions`
--

INSERT INTO `editions` (`edition_id`, `maison_edition`) VALUES
(2, 'Gallimard'),
(1, 'Rageot');

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

DROP TABLE IF EXISTS `genres`;
CREATE TABLE IF NOT EXISTS `genres` (
  `genre_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `genre_parent_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`genre_id`),
  UNIQUE KEY `nom` (`nom`),
  UNIQUE KEY `nom_2` (`nom`),
  KEY `FK_genre_parent` (`genre_parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `genres`
--

INSERT INTO `genres` (`genre_id`, `nom`, `genre_parent_id`) VALUES
(2, 'Non-fiction', NULL),
(3, 'True Crime', 2),
(4, 'Aventures', NULL),
(5, 'Espionnage', 4),
(6, 'Policier', NULL),
(7, 'Mondes perdus', 4),
(8, 'Noir', 6),
(9, 'Thriller', 6),
(10, 'à Enigme', 6),
(11, 'Science-Fiction', NULL),
(12, 'Anticipation', 11),
(13, 'Cyberpunk', 11),
(14, 'Steampunk', 11),
(15, 'Space Opera', 11),
(16, 'Science-Fiction Humoristique', 11),
(17, 'Fantasy', NULL),
(18, 'Dark Fantasy', 17),
(19, 'Urban Fantasy', 17),
(20, 'Héroic Fantasy', 17),
(21, 'Light Fantasy', 17),
(22, 'Low Fantasy', 17),
(23, 'High Fantasy', 17),
(24, 'Romantic Fantasy', 17),
(25, 'Space Fantasy', 11),
(26, 'Fantastique', NULL),
(27, 'Horreur', NULL),
(28, 'Biographie', NULL),
(29, 'Romance', NULL),
(30, 'Industriel', NULL),
(32, 'Autobiographie', 28),
(36, 'Conte', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

DROP TABLE IF EXISTS `livres`;
CREATE TABLE IF NOT EXISTS `livres` (
  `livre_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `auteur_id` bigint(20) NOT NULL,
  `edition_id` bigint(20) NOT NULL,
  `genre_id` bigint(20) NOT NULL,
  `sommaire` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `couverture_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`livre_id`),
  KEY `FK_auteur` (`auteur_id`),
  KEY `FK_edition` (`edition_id`),
  KEY `FK_genre` (`genre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`livre_id`, `titre`, `auteur_id`, `edition_id`, `genre_id`, `sommaire`, `couverture_id`) VALUES
(1, 'Coups de Théâtre', 2, 1, 6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.', 0),
(2, 'Harry Potter à l\'école des sorciers', 3, 2, 22, 'Test !', 0),
(4, 'Harry Potter et la chambre des Secrets', 3, 2, 22, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `visibilite`
--

DROP TABLE IF EXISTS `visibilite`;
CREATE TABLE IF NOT EXISTS `visibilite` (
  `visibility_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  PRIMARY KEY (`visibility_id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `visibilite`
--

INSERT INTO `visibilite` (`visibility_id`, `nom`) VALUES
(1, 'les amis'),
(0, 'personne'),
(2, 'tout le monde');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `amis`
--
ALTER TABLE `amis`
  ADD CONSTRAINT `Fk_client1` FOREIGN KEY (`client_id1`) REFERENCES `clients` (`client_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `Fk_client2` FOREIGN KEY (`client_id2`) REFERENCES `clients` (`client_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `FK_Cli` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `FK_collec` FOREIGN KEY (`visibility_collec`) REFERENCES `visibilite` (`visibility_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `Fk_wishlist` FOREIGN KEY (`visibility_wishlist`) REFERENCES `visibilite` (`visibility_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `collections`
--
ALTER TABLE `collections`
  ADD CONSTRAINT `Fk_client` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fk_livre` FOREIGN KEY (`livre_id`) REFERENCES `livres` (`livre_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `Fk_clientContact` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `genres`
--
ALTER TABLE `genres`
  ADD CONSTRAINT `FK_genre_parent` FOREIGN KEY (`genre_parent_id`) REFERENCES `genres` (`genre_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `livres`
--
ALTER TABLE `livres`
  ADD CONSTRAINT `FK_auteur` FOREIGN KEY (`auteur_id`) REFERENCES `auteurs` (`auteur_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_edition` FOREIGN KEY (`edition_id`) REFERENCES `editions` (`edition_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_genre` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
