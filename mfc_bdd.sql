-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 12 fév. 2020 à 17:57
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mfc`

CREATE DATABASE IF NOT EXISTS mfc DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mfc`;

--

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

DROP TABLE IF EXISTS `formations`;
CREATE TABLE IF NOT EXISTS `formations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `skills` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `formations`
--

INSERT INTO `formations` (`id`, `name`, `description`, `skills`) VALUES
(1, 'BTS SIO', 'Bts dans une école d\'ingénieur de 2 ans en informatique option SLAM et SISR', 'Dev, Réseau'),
(2, 'DUT Informatique', 'DUT en informatique bla bla', 'Dev frontend backend infra');

-- --------------------------------------------------------

--
-- Structure de la table `student_interested_in_formation`
--

DROP TABLE IF EXISTS `student_interested_in_formation`;
CREATE TABLE IF NOT EXISTS `student_interested_in_formation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `formation_id` int(11) NOT NULL,
  `registered` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `student_interested_in_formation`
--

INSERT INTO `student_interested_in_formation` (`id`, `student_id`, `formation_id`, `registered`) VALUES
(1, 2, 1, 2),
(13, 17, 2, 1),
(4, 2, 2, 1),
(12, 2, 2, 1),
(11, 2, 1, 0),
(10, 2, 1, 0),
(9, 2, 1, 0),
(14, 2, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  `email` varchar(96) NOT NULL,
  `address` varchar(256) DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `zip` varchar(16) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `address`, `city`, `zip`, `status`) VALUES
(1, 'admin', 'admin', 'admin@mfc.com', NULL, NULL, NULL, 0),
(2, 'eleve', 'eleve', 'eleve@mfc.com', NULL, NULL, NULL, 1),
(3, 'formateur', 'formateur', 'formateur@mfc.com', NULL, NULL, NULL, 2),
(16, 'yolo', 'yolo', 'osef@yolo.com', NULL, NULL, NULL, 1),
(17, 'adminh', 'addd', 'adsfjl@dfsdsf.fr', NULL, NULL, NULL, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
