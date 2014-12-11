-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 11 Décembre 2014 à 13:15
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `tn09`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(100) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Droits` enum('0','1') NOT NULL,
  `Mot de passe` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `Nom`, `Prenom`, `Email`, `Droits`, `Mot de passe`) VALUES
(1, 'Dupond', 'Henri', 'henri.dupond@gmail.com', '1', 'azerty'),
(2, 'Dupont', 'Paul', 'paul.dupont@hotmail.com', '0', '');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE IF NOT EXISTS `vehicule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Marque` varchar(50) NOT NULL COMMENT 'Marque de la voiture',
  `Modele` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Puissance` int(11) NOT NULL,
  `PrixTTC` double NOT NULL,
  `PrixHT` double NOT NULL,
  `CouleurExterieure` varchar(50) NOT NULL,
  `CouleurInterieure` varchar(50) NOT NULL,
  `Type` enum('vn','vo','utilitaire') NOT NULL,
  `Affichage` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `INDEX` (`Marque`,`PrixTTC`,`Type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Contenu de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `Marque`, `Modele`, `Description`, `Puissance`, `PrixTTC`, `PrixHT`, `CouleurExterieure`, `CouleurInterieure`, `Type`, `Affichage`) VALUES
(1, 'Citroen', 'DS3', 'DS3 Essence 3 portes 2013', 82, 18000, 14590, 'Noir', 'Cuir Noir', 'vn', 'DS3 (2013)'),
(2, 'Peugeot', '208', '208 Diesel 5 portes 2012', 96, 17500, 13990, 'Bleu marine', 'Gris', 'vn', '208 (2012)'),
(3, 'Renault', 'Clio', 'Clio 5 Diesel 3 portes 2013', 82, 17000, 13450, 'Jaune', 'Blanc', 'vn', 'Clio 5 (2013)'),
(4, 'Toyota', 'Verso', 'Verso Diesel 5 portes 2011', 108, 20000, 17800, 'Gris', 'Noir', 'vn', 'Verso (2011)'),
(5, 'Seat', 'Leon', 'Leon Essence 3 portes 2012', 112, 20500, 17900, 'Rouge', 'Gris', 'vn', 'Leon (2012)'),
(6, 'Alfa Romeo', 'Gulietta', 'Gulietta Essence 3 portes 2013', 133, 24530, 21760, 'Rouge', 'Noir', 'vn', 'Gulietta (2013)'),
(7, 'Ford', 'Mondeo', 'Mondeo break Diesel 5 portes 2012', 112, 19840, 17100, 'Bleu', 'Gris', 'vn', 'Mondeo break (2012)'),
(8, 'Ford', 'Fiesta', 'Fiesta Diesel 3 portes 2011', 82, 15990, 12200, 'Vert', 'Vert', 'vn', 'Fiesta (2011)'),
(9, 'Citroen', 'C1', 'C1 Diesel 3 portes 2012', 70, 9900, 7810, 'Blanc', 'Blanc', 'vn', 'C1 (2012)'),
(10, 'Aston Martin', 'Vantage', 'Vantage Essence 3 portes 2011', 394, 340900, 298960, 'Gris', 'Cuir Noir', 'vn', 'Vantage (2011)'),
(11, 'Peugeot', '208', '208 Diesel 5 portes 2012', 96, 14600, 11990, 'Bleu marine', 'Gris', 'vo', '208 (2012)'),
(12, 'Citroen', 'DS3', 'DS3 Essence 3 portes 2013', 82, 14500, 12100, 'Noir', 'Cuir Noir', 'vo', 'DS3 (2013)'),
(13, 'Renault', 'Clio', 'Clio 5 Diesel 3 portes 2013', 82, 14300, 12990, 'Jaune', 'Blanc', 'vo', 'Clio 5 (2013)'),
(14, 'Toyota', 'Verso', 'Verso Diesel 5 portes 2011', 108, 16800, 15740, 'Gris', 'Noir', 'vo', 'Verso (2011)'),
(15, 'Seat', 'Leon', 'Leon Essence 3 portes 2012', 112, 17900, 15600, 'Rouge', 'Gris', 'vo', 'Leon (2012)'),
(16, 'Alfa Romeo', 'Gulietta', 'Gulietta Essence 3 portes 2013', 133, 18990, 16990, 'Rouge', 'Noir', 'vo', 'Gulietta (2013)'),
(17, 'Ford', 'Mondeo', 'Mondeo break Diesel 5 portes 2012', 112, 15200, 1300, 'Bleu', 'Gris', 'vo', 'Mondeo break (2012)'),
(18, 'Ford', 'Fiesta', 'Fiesta Diesel 3 portes 2011', 82, 10460, 9840, 'Vert', 'Vert', 'vo', 'Fiesta (2011)'),
(19, 'Citroen', 'C1', 'C1 Diesel 3 portes 2012', 70, 6100, 4800, 'Blanc', 'Blanc', 'vo', 'C1 (2012)'),
(20, 'Aston Martin', 'Vantage', 'Vantage Essence 3 portes 2011', 394, 288400, 241200, 'Gris', 'Cuir Noir', 'vo', 'Vantage (2011)'),
(21, 'Peugeot', 'Patner', 'Patner Diesel 5 portes 2007', 82, 17500, 13200, 'Gris', 'Gris', 'utilitaire', 'Partner (2007)'),
(22, 'Renault', 'Master', 'Master Diesel 4 portes 2008', 92, 16400, 14950, 'Blanc', 'Noir', 'utilitaire', 'Master (2008)'),
(23, 'Peugeot', 'Patner', 'Patner Diesel 5 portes 2007', 82, 17490, 13200, 'Gris', 'Gris', 'utilitaire', 'Partner (2007)'),
(24, 'Peugeot', 'Patner', 'Patner Diesel 5 portes 2007', 82, 17480, 13200, 'Gris', 'Gris', 'utilitaire', 'Partner (2007)'),
(25, 'Peugeot', 'Patner', 'Patner Diesel 5 portes 2007', 82, 17380, 13200, 'Gris', 'Gris', 'utilitaire', 'Partner (2007)'),
(26, 'Peugeot', 'Patner', 'Patner Diesel 5 portes 2007', 82, 17360, 13200, 'Gris', 'Gris', 'utilitaire', 'Partner (2007)'),
(27, 'Renault', 'Master', 'Master Diesel 4 portes 2008', 92, 16300, 14950, 'Blanc', 'Noir', 'utilitaire', 'Master (2008)'),
(28, 'Renault', 'Master', 'Master Diesel 4 portes 2008', 0, 16200, 14950, 'Blanc', 'Noir', 'utilitaire', 'Master (2008)'),
(29, 'Renault', 'Master', 'Master Diesel 4 portes 2008', 92, 16600, 14950, 'Blanc', 'Noir', 'utilitaire', 'Master (2008)'),
(30, 'Renault', 'Master', 'Master Diesel 4 portes 2008', 92, 16100, 14950, 'Blanc', 'Noir', 'utilitaire', 'Master (2008)');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
