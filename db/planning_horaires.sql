-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 15 déc. 2021 à 18:12
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bcafryhisc232`
--

-- --------------------------------------------------------

--
-- Structure de la table `planning_horaires`
--

CREATE TABLE `planning_horaires` (
  `id` int(11) NOT NULL,
  `idTableau` int(11) NOT NULL,
  `jour` int(11) NOT NULL,
  `horaireDebut` varchar(255) NOT NULL,
  `horaireFin` varchar(255) NOT NULL,
  `commentaire` text CHARACTER SET utf8 COLLATE utf8_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `planning_horaires`
--

INSERT INTO `planning_horaires` (`id`, `idTableau`, `jour`, `horaireDebut`, `horaireFin`, `commentaire`) VALUES
(1, 1, 1, '19:30', '21:00', 'Compétiteurs, jeu libre jusquà 22h'),
(2, 1, 2, '20:30', '22:00', 'Confirmés non compétiteurs'),
(3, 1, 3, '19:00', '20:30', 'Compétiteurs (3 terrains jusquà 22h).'),
(4, 1, 4, '', '', ''),
(5, 1, 5, '', '', ''),
(6, 1, 6, '', '', ''),
(7, 1, 7, '', '', ''),
(1072, 142, 1, '', '', ''),
(1073, 142, 2, '19:00', '20:30', ''),
(1074, 142, 3, '', '', ''),
(1075, 142, 4, '', '', ''),
(1076, 142, 5, '', '', ''),
(1077, 142, 6, '', '', ''),
(1078, 142, 7, '', '', ''),
(1079, 143, 1, '', '', ''),
(1080, 143, 2, '', '', ''),
(1081, 143, 3, '20:30', '22:00', '6 terrains'),
(1082, 143, 4, '20:30', '22:00', '6 terrains - Pour tous les adhérents'),
(1083, 143, 5, '20:30', '22:00', '6 terrains'),
(1084, 143, 6, '', '', ''),
(1085, 143, 7, '09:00', '12:00', 'Pour tous les adhérents');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `planning_horaires`
--
ALTER TABLE `planning_horaires`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `planning_horaires`
--
ALTER TABLE `planning_horaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1086;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
