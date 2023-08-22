-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 06 août 2023 à 19:18
-- Version du serveur : 5.7.36
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bddensiref`
--
CREATE DATABASE IF NOT EXISTS `bddensiref` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `bddensiref`;

-- --------------------------------------------------------

--
-- Structure de la table `pc`
--

DROP TABLE IF EXISTS `pc`;
CREATE TABLE IF NOT EXISTS `pc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ram` int(11) NOT NULL,
  `processeur` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stockage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Disponible',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `pc`
--

INSERT INTO `pc` (`id`, `description`, `ram`, `processeur`, `stockage`, `image`, `status`) VALUES
(7, 'PC NoteBook', 8, 'I5-11400', '256 Go', '/myprojet_final/ENSIREF_1/img/pc.png', 'RÃ©servÃ©'),
(6, 'PC NoteBook Pro', 64, 'I9-12700', '1To', '/myproject_final/ENSIREF_1/img/pc.png', 'Maintenance'),
(8, 'PC NoteBook', 32, 'I9-12700', '512 Go', '/myproject_final/ENSIREF_1/img/pc.png', 'Maintenance'),
(9, 'PC NoteBook', 8, 'I7-12700', '128 Go', '/myproject_final/ENSIREF_1/img/pc.png', 'Maintenance'),
(10, 'PC NoteBook5', 8, 'I9-12700', '1To', '/myproject_final/ENSIREF_1/img/pc.png', 'RÃ©servÃ©'),
(11, 'PC NoteBook 13', 16, 'I7-12700', '256 Go', '/myproject_final/ENSIREF_1/img/pc.png', 'RÃ©servÃ©'),
(12, 'PC NoteBook', 8, 'I9-12700', '1To', '/myproject_final/ENSIREF_1/img/pc.png', 'Disponible'),
(13, 'PC NoteBook 15\"', 32, 'I9-12700', '2 To', '/myproject_final/ENSIREF_1/img/pc.png', 'Disponible'),
(15, 'PC Note Book', 16, 'I9-12700', '512 Go', '/myproject_final/ENSIREF_1/img/pc.png', 'RÃ©servÃ©'),
(16, 'PC NoteBook', 8, 'I9-12700', '128 Go', '/myproject_final/ENSIREF_1/img/pc.png', 'Maintenance');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pc_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `hour` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `heure` time NOT NULL,
  `start_datetime` datetime DEFAULT NULL,
  `end_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pc_id` (`pc_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `pc_id`, `user_id`, `date`, `hour`, `heure`, `start_datetime`, `end_datetime`) VALUES
(1, 12, NULL, '2023-06-19', NULL, '10:00:00', NULL, NULL),
(2, 12, NULL, '2023-06-19', NULL, '08:00:00', NULL, NULL),
(3, 12, NULL, '2023-06-20', NULL, '08:00:00', NULL, NULL),
(4, 13, NULL, '2023-08-29', NULL, '14:00:00', NULL, NULL),
(5, 13, NULL, '2023-07-01', NULL, '08:00:00', NULL, NULL),
(6, 13, NULL, '2023-07-05', NULL, '08:00:00', NULL, NULL),
(7, 13, NULL, '2023-07-12', NULL, '08:00:00', NULL, NULL),
(8, 13, NULL, '2023-08-06', NULL, '08:00:00', NULL, NULL),
(9, 13, NULL, '2023-06-29', NULL, '08:00:00', NULL, NULL),
(10, 13, NULL, '2023-06-28', NULL, '12:00:00', NULL, NULL),
(11, 13, NULL, '2023-06-28', NULL, '16:00:00', NULL, NULL),
(12, 11, NULL, '2023-07-01', NULL, '08:00:00', NULL, NULL),
(13, 11, NULL, '2023-07-01', NULL, '08:00:00', NULL, NULL),
(14, 11, NULL, '2023-07-01', NULL, '08:00:00', NULL, NULL),
(15, 11, NULL, '2023-07-01', NULL, '08:00:00', NULL, NULL),
(16, 11, NULL, '2023-06-28', NULL, '14:00:00', NULL, NULL),
(17, 11, NULL, '2023-07-08', NULL, '12:00:00', NULL, NULL),
(18, 11, NULL, '2023-06-20', NULL, '09:00:00', NULL, NULL),
(19, 11, NULL, '2023-06-18', NULL, '08:00:00', NULL, NULL),
(20, 11, NULL, '2023-06-18', NULL, '08:00:00', NULL, NULL),
(21, 11, NULL, '2023-06-19', NULL, '12:00:00', NULL, NULL),
(22, 11, NULL, '2023-06-19', NULL, '12:00:00', NULL, NULL),
(23, 7, NULL, '2023-06-30', NULL, '16:00:00', NULL, NULL),
(24, 7, NULL, '2023-06-30', NULL, '16:00:00', NULL, NULL),
(25, 7, NULL, '2023-06-28', NULL, '13:00:00', NULL, NULL),
(26, 7, NULL, '2023-06-30', NULL, '15:00:00', NULL, NULL),
(27, 11, NULL, '2023-07-09', NULL, '08:00:00', NULL, NULL),
(28, 11, NULL, '2023-07-01', NULL, '10:00:00', NULL, NULL),
(29, 15, NULL, '2023-06-30', NULL, '13:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `username`, `password`, `email`, `role`) VALUES
(1, 'test', '12345', 'youssef.jebbari@hotmail.com', NULL),
(2, 'zzz', 'ddddd', 'youssef.jebbari@hotmail.com', NULL),
(3, 'zzz', 'ddddd', 'youssef.jebbari@hotmail.com', NULL),
(4, 'Yassine', '123456', 'yj@test.info', NULL),
(5, 'admin', 'admin', 'admin@ensitech.eu', 'admin'),
(6, 'test78', '$2y$10$WofFDhhBIDvKhd8tOOiqwO89Wk/O3cWhrpSbQ/MDfSEDFYRjEJodS', 'yj@simplelab.info', 'user'),
(7, 'test123', '$2y$10$Cn5NBj3nUFwm8PNAFjQO0eC6T3frAVO6bZP18GSbDPdmykH5fmeHS', 'test123@ensitech.eu', 'user'),
(8, 'tes94', '$2y$10$6SRc9N0DsvHvmCEJCjLPXenw2/OimGnaOufTvHpOYQP5vXRQXUWyC', 'test94@simplelab.info', 'user'),
(9, 'admin1', '$2y$10$BBgNdAEErWCx/AFNPB9oQ./9pEKK9U2jczwSY8Cd26N8wlRkmPs.C', 'admin1@test.fr', 'user'),
(10, 'sage', '$2y$10$tMzcOFB3bmZyzP03rwBwq.066ep8hYzO/7ywTmXsY6bPqRmD6dcUO', 'sage@riot.game', 'user'),
(11, 'admin781', '$2y$10$8SHKT8fsev6L6cT.n2QcjOj49tNSjKozNZS7UA81w0AP7ihSXx0wa', 'admin3@azerty.fr', 'user'),
(12, 'azerty', '$2y$10$V5KlkCh4gy74dAs9uZvVz.E/4jvtwTmL5UYsZw5f/k1O70d4wgoFS', 'azerty@az.az', 'admin'),
(13, 'test782', '$2y$10$XhUHyWfJkIdQO2PrgHUFqet5A6x5AiX/UZ6iOKA6aeluUVmuqYgsa', '123@a.fr', 'user'),
(14, 'Youssef', '$2y$10$Grw37visUDcFrbNfmaaWOu0KqT7HaQjTVJKIZT64/v5r3LT6yBnRy', 'ysf@test.info', 'user'),
(15, 'Ayoub Rouzi', '$2y$10$.0JFSrZHUSNmqlUfRwKsWumIlLJS5l1VC..Jt7JpVhajbnHtDeTzi', 'ar@test.fr', 'admin'),
(16, 'jbry', '$2y$10$MkzvBoQBWvNta7fZBwisA.m6U1nWdeWdub.Rj9j0CUByT34/3NvSm', 'jbry@az.fr', 'user'),
(17, 'chaouche', '$2y$10$RlXhVsfVa16uPgT047iD.OnWZ6gO5aGLofTlDLvc.YZK.BI/8Ru/2', 'chaouche@hotmail.fr', 'user'),
(18, 'Test78', '$2y$10$sm3BfxZmtCTYktRX0ljYQ.ZC17mn870pyotccMDGcfhbhiUS8pCQ6', 'zeaa@hotmail.com', 'user'),
(19, 'Test', '$2y$10$HaVodNvsjZcex0VjHFvDfObx9DL6TFTumzQD6D6.kRJXGcUCF0KyS', 'Test@hotmail.com', 'user'),
(20, 'Yassine', '$2y$10$58RK4l3b3QFaa6L/Uvur8u.dZgzoiGLbTYu36RKB6Cnh3WIX6I28C', 'yass@live.fr', 'user');
--
-- Base de données : `ensiref`
--
CREATE DATABASE IF NOT EXISTS `ensiref` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ensiref`;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--
-- Base de données : `inventaire_pc`
--
CREATE DATABASE IF NOT EXISTS `inventaire_pc` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `inventaire_pc`;

-- --------------------------------------------------------

--
-- Structure de la table `autres_dispositifs`
--

DROP TABLE IF EXISTS `autres_dispositifs`;
CREATE TABLE IF NOT EXISTS `autres_dispositifs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `statut` varchar(50) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `autres_dispositifs`
--

INSERT INTO `autres_dispositifs` (`id`, `image`, `statut`, `titre`, `description`) VALUES
(1, 'img/upload/Car Website ÔÇô 1@2x.png', 'En location', 'aaa', 'zazazazd');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `note` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `date_ajout` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `nom`, `note`, `commentaire`, `date_ajout`) VALUES
(5, 'aaa', 5, 'sasasa', '0000-00-00 00:00:00'),
(4, 'John Doe', 4, 'Excellent service!', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `pcs`
--

DROP TABLE IF EXISTS `pcs`;
CREATE TABLE IF NOT EXISTS `pcs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `statut` varchar(50) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `ram` varchar(50) NOT NULL,
  `stockage` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `pcs`
--

INSERT INTO `pcs` (`id`, `image`, `statut`, `titre`, `ram`, `stockage`) VALUES
(1, 'img/car1.jpg', 'Disponible', 'PC MAC', '24', '512 Go SSD'),
(2, 'img/car2.jpg', 'En location', 'ASUS 32 Go RAM', '32 Go', '512 Go SSD'),
(3, 'img/car3.jpg', 'En réparation', 'DELL 16 Go RAM', '16 Go', '512 Go SSD');
--
-- Base de données : `registration`
--
CREATE DATABASE IF NOT EXISTS `registration` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `registration`;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'aminekouis@gmail.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918'),
(2, 'aaa', 'aaaaa@gmail.com', 'ed02457b5c41d964dbd2f2a609d63fe1bb7528dbe55e1abf5b52c249cd735797'),
(3, 'bb', 'bb@gmail.com', '3b64db95cb55c763391c707108489ae18b4112d783300de38e033b4c98c3deaf'),
(4, 'cc', 'cc@gmail.com', '355b1bbfc96725cdce8f4a2708fda310a80e6d13315aec4e5eed2a75fe8032ce'),
(5, 'cc', 'cc@gmail.com', '355b1bbfc96725cdce8f4a2708fda310a80e6d13315aec4e5eed2a75fe8032ce'),
(6, 'cc', 'cc@gmail.com', '355b1bbfc96725cdce8f4a2708fda310a80e6d13315aec4e5eed2a75fe8032ce'),
(7, 'admin', 'yj@simplelab.info', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
