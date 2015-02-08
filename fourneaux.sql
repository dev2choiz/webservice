-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 02 Février 2015 à 09:38
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `fourneaux`
--
CREATE DATABASE IF NOT EXISTS `fourneaux` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `fourneaux`;

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

CREATE TABLE IF NOT EXISTS `jeux` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_support` int(10) unsigned NOT NULL,
  `id_genre` int(10) unsigned NOT NULL,
  `id_age` int(10) unsigned NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jeuUnique` (`id_support`,`id_genre`,`id_age`,`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `jeux`
--

INSERT INTO `jeux` (`id`, `id_support`, `id_genre`, `id_age`, `nom`, `description`, `update`) VALUES
(1, 1, 3, 6, 'Jeux 1', 'Description Jeux 1', '2014-07-18 10:37:39'),
(2, 2, 4, 5, 'Jeux 2 ', 'Description Jeux 2', '2014-07-18 10:37:39'),
(7, 2, 3, 5, 'jeux 7777', 'description', '2014-07-21 12:30:57'),
(9, 1, 3, 5, 'new game 1405932185', 'description', '2014-07-21 08:43:05'),
(10, 1, 3, 5, 'new game 1405932191', 'description', '2014-07-21 08:43:11'),
(11, 1, 3, 5, 'new game 1405932194', 'description', '2014-07-21 08:43:14'),
(12, 1, 3, 5, 'new game test', 'description', '2014-07-21 09:37:17');

-- --------------------------------------------------------

--
-- Structure de la table `properties`
--

CREATE TABLE IF NOT EXISTS `properties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('support','genre','age') COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `typeValue` (`type`,`value`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `properties`
--

INSERT INTO `properties` (`id`, `type`, `value`) VALUES
(2, 'support', 'MAC'),
(1, 'support', 'PC'),
(3, 'genre', 'Action'),
(4, 'genre', 'FPS'),
(5, 'age', '10-14'),
(6, 'age', '14-18');

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

CREATE TABLE IF NOT EXISTS `recette` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recette` text NOT NULL,
  `iduser` int(11) NOT NULL,
  `idcategorie` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `recette`
--

INSERT INTO `recette` (`id`, `recette`, `iduser`, `idcategorie`) VALUES
(1, '<p>recette1</p>', 13, 1),
(2, '<p>djdlkg</p>', 13, 1),
(3, '<p>dgklgj</p>', 13, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `mail`, `password`, `update`) VALUES
(13, 'nom1', 'prenom1', 'mail1@hotmail.com', 'b4136225ae3ffed43874cec08fcf7330', '2015-02-01 08:06:40');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `viewjeux`
--
CREATE TABLE IF NOT EXISTS `viewjeux` (
`id` int(10) unsigned
,`id_support` int(10) unsigned
,`id_genre` int(10) unsigned
,`id_age` int(10) unsigned
,`nom` varchar(255)
,`description` text
,`update` timestamp
,`value_support` varchar(50)
,`value_genre` varchar(50)
,`value_age` varchar(50)
);
-- --------------------------------------------------------

--
-- Structure de la vue `viewjeux`
--
DROP TABLE IF EXISTS `viewjeux`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewjeux` AS select `jeux`.`id` AS `id`,`jeux`.`id_support` AS `id_support`,`jeux`.`id_genre` AS `id_genre`,`jeux`.`id_age` AS `id_age`,`jeux`.`nom` AS `nom`,`jeux`.`description` AS `description`,`jeux`.`update` AS `update`,`table_support`.`value` AS `value_support`,`table_genre`.`value` AS `value_genre`,`table_age`.`value` AS `value_age` from (((`jeux` left join `properties` `table_support` on(((`table_support`.`id` = `jeux`.`id_support`) and (`table_support`.`type` = 'support')))) left join `properties` `table_genre` on(((`table_genre`.`id` = `jeux`.`id_genre`) and (`table_genre`.`type` = 'genre')))) left join `properties` `table_age` on(((`table_age`.`id` = `jeux`.`id_age`) and (`table_age`.`type` = 'age'))));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
