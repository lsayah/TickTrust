-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 06 fév. 2025 à 08:54
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ticktrust`
--

-- --------------------------------------------------------

--
-- Structure de la table `affectation`
--

DROP TABLE IF EXISTS `affectation`;
CREATE TABLE IF NOT EXISTS `affectation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_ticket_id` int DEFAULT NULL,
  `id_user_id` int DEFAULT NULL,
  `id_affectation` int NOT NULL,
  `date_affectation` datetime NOT NULL,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resolu_par` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_de_resolution` datetime NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_F4DD61D3F035FBF5` (`id_ticket_id`),
  KEY `IDX_F4DD61D379F37AE5` (`id_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250129164835', '2025-01-29 16:48:44', 500),
('DoctrineMigrations\\Version20250130110528', '2025-01-30 11:05:50', 436),
('DoctrineMigrations\\Version20250130173325', '2025-01-30 17:33:58', 336),
('DoctrineMigrations\\Version20250201184605', '2025-02-01 18:46:24', 520),
('DoctrineMigrations\\Version20250201191517', '2025-02-01 19:15:22', 79),
('DoctrineMigrations\\Version20250202143459', '2025-02-02 14:35:06', 146),
('DoctrineMigrations\\Version20250202151543', '2025-02-02 15:15:50', 225),
('DoctrineMigrations\\Version20250202182858', '2025-02-02 18:29:07', 221),
('DoctrineMigrations\\Version20250204173355', '2025-02-04 17:34:03', 348);

-- --------------------------------------------------------

--
-- Structure de la table `intervention`
--

DROP TABLE IF EXISTS `intervention`;
CREATE TABLE IF NOT EXISTS `intervention` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ticket_id` int NOT NULL,
  `technician_id` int NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D11814AB700047D2` (`ticket_id`),
  KEY `IDX_D11814ABE6C5D496` (`technician_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `intervention`
--

INSERT INTO `intervention` (`id`, `ticket_id`, `technician_id`, `details`, `created_at`) VALUES
(1, 23, 11, 'j\'ai fait plein de truc de fou malade', '2025-02-04 17:40:30'),
(2, 23, 11, 'nouvelle intervention', '2025-02-04 18:10:47');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_auteur_id` int DEFAULT NULL,
  `id_ticket_id` int DEFAULT NULL,
  `id_message` int NOT NULL,
  `contenu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_B6BD307FE08ED3C1` (`id_auteur_id`),
  KEY `IDX_B6BD307FF035FBF5` (`id_ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_auteur_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `priorite` int NOT NULL,
  `statut` int NOT NULL,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `technician_id` int DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_97A0ADA3E08ED3C1` (`id_auteur_id`),
  KEY `IDX_97A0ADA3E6C5D496` (`technician_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ticket`
--

INSERT INTO `ticket` (`id`, `id_auteur_id`, `title`, `category`, `description`, `created_at`, `updated_at`, `priorite`, `statut`, `service`, `technician_id`, `attachment`) VALUES
(15, 9, 'encore un pour voir si sa double', 'support', 'raf', '2025-01-30 16:31:39', '2025-01-30 16:31:39', 1, 0, 'NONE', NULL, NULL),
(16, 9, 'test pour le dashboard users', 'bug', 'jespere que sa fonctionne', '2025-01-30 16:57:18', '2025-01-30 16:57:18', 1, 0, 'NONE', NULL, NULL),
(17, 9, 'essaie 1', 'bug', 'esssaie 1', '2025-01-30 17:34:12', '2025-01-30 17:34:12', 1, 0, 'NONE', NULL, NULL),
(18, 9, 'c\'est le dernier ticket', 'feature_request', 'sa fonctionne', '2025-01-30 17:39:09', '2025-01-30 17:39:09', 1, 0, 'NONE', NULL, NULL),
(19, 9, 'nouveau ticket test', 'bug', 'doit s\'afficher', '2025-01-31 09:31:37', '2025-01-31 09:31:37', 1, 0, 'NONE', NULL, NULL),
(20, 9, 'tac', 'bug', 'tac', '2025-01-31 11:34:13', '2025-01-31 11:34:13', 1, 0, 'NONE', NULL, NULL),
(21, 9, 'trop de machine dans la machine', 'bug', 'j\'ai un probleme sur ma machine oh non', '2025-02-01 18:06:53', '2025-02-01 18:06:53', 1, 0, 'NONE', NULL, NULL),
(22, 9, 'test assignation tech', 'bug', 'normalement un technicien est assignée, j\'espere', '2025-02-01 19:16:14', '2025-02-01 19:16:14', 1, 0, 'NONE', NULL, NULL),
(23, 9, 'encore un test d\'assignation', 'bug', 'bzidbqeioifok<nsfn<PSFNp\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon\r\n\r\nNouvelle Description:\r\nla sa devrais etre bon', '2025-02-01 19:22:20', '2025-02-05 10:41:02', 1, 0, 'NONE', 11, NULL),
(24, 9, 'test pour l\'ajout de fichier', 'bug', 'mettre un fichier (sa fonctionnais) mais la on teste la modif\r\n\r\nNouvelle Description:\r\nmettre un fichier (sa fonctionnais) mais la on teste la modif', '2025-02-02 13:50:30', '2025-02-05 10:38:42', 1, 0, 'NONE', NULL, NULL),
(25, 9, 'test ajout fichier', 'bug', 'ajouter un fichier et modif\n\nNouvelle Description:\najouter un fichier et modif', '2025-02-02 15:17:06', '2025-02-02 15:30:04', 1, 0, 'NONE', NULL, 'C:\\Users\\Amazi\\AppData\\Local\\Temp\\php1224.tmp'),
(27, 9, 'dernier test du week end', 'bug', 'okok\n\nNouvelle Description:\nokok', '2025-02-02 23:43:44', '2025-02-03 08:54:23', 1, 0, 'NONE', 12, NULL),
(28, 9, 'c\'est beau', 'bug', 'la saint valentin', '2025-02-04 11:03:14', '2025-02-04 11:03:14', 1, 0, 'NONE', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_available` tinyint(1) NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `password`, `role`, `email_verified_at`, `created_at`, `updated_at`, `service`, `is_available`, `photo`) VALUES
(9, 'users', 'test', 'testUsers@example.fr', '$2y$13$1VuWkifCe9Sh3g73hAeys.xnTBSKnJNyhpSRk0Wa2tbIS9CvlFsYS', 'ROLE_USER', NULL, '2025-01-30 11:26:01', '2025-01-30 11:26:01', 'NONE', 0, NULL),
(10, 'SuperAdmin', 'User', 'superadmin@example.com', '$2y$12$tthSF91spOUBUhIL8CS5ROK5G2UcBMiuW5qrjiBv9fKk2YnrSQqjm', 'ROLE_ADMIN', '2025-01-31 11:09:52', '2025-01-31 11:09:52', '2025-01-31 11:09:52', 'NONE', 0, NULL),
(11, 'Tech', 'Man', 'Techman@example.com', '$2y$10$5AyOYpuCzFjXaCoqZHSz7OjscWHy8siU1aEndv8SjfiyLBgC/7zvG', 'ROLE_TECHNICIAN', NULL, '2025-02-01 19:38:27', '2025-02-01 19:38:27', 'NONE', 0, NULL),
(12, 'Fin', 'ANCIAL', 'fintech@example.com', '$2y$10$R7gPfFpZRllGTxl2Pe3ul.KLx2Th9ckzP8nVEVdKh1NIrnP3GQ.fu', 'ROLE_TECHNICIAN', NULL, '2025-02-02 19:34:32', '2025-02-02 19:34:32', 'IT', 0, NULL),
(13, 'jean-Marie', 'LEPEN', 'lepen4ever@example.fr', '$2y$13$ZZlLwCKE5WkOF9h6YGiDw.feBsTJP6/0j2GjU/ZAueZ3Js.Rrx0hC', 'ROLE_USER', NULL, '2025-02-04 09:42:12', '2025-02-04 09:42:12', 'NONE', 1, NULL),
(14, 'Jacques', 'Brel', 'JacquesBrel@gmail.com', '$2y$13$wULvvuThuW6V2.Qp/UibduW3r.yiv8z0ScN.gve3hEuF.UhbDxyM2', 'ROLE_USER', NULL, '2025-02-05 23:28:57', '2025-02-05 23:28:57', 'NONE', 1, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `affectation`
--
ALTER TABLE `affectation`
  ADD CONSTRAINT `FK_F4DD61D379F37AE5` FOREIGN KEY (`id_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_F4DD61D3F035FBF5` FOREIGN KEY (`id_ticket_id`) REFERENCES `ticket` (`id`);

--
-- Contraintes pour la table `intervention`
--
ALTER TABLE `intervention`
  ADD CONSTRAINT `FK_D11814AB700047D2` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`),
  ADD CONSTRAINT `FK_D11814ABE6C5D496` FOREIGN KEY (`technician_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_B6BD307FE08ED3C1` FOREIGN KEY (`id_auteur_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_B6BD307FF035FBF5` FOREIGN KEY (`id_ticket_id`) REFERENCES `ticket` (`id`);

--
-- Contraintes pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `FK_97A0ADA3E08ED3C1` FOREIGN KEY (`id_auteur_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_97A0ADA3E6C5D496` FOREIGN KEY (`technician_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
