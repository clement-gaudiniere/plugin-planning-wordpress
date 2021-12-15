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
-- Structure de la table `planning_tableaux`
--

CREATE TABLE `planning_tableaux` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `planning_tableaux`
--

INSERT INTO `planning_tableaux` (`id`, `name`, `lieu`, `date_creation`) VALUES
(1, 'Adultes Confirmés', '', '2021-01-01 16:25:09'),
(142, 'Adultes Débutants', '', '2021-12-15 18:02:39'),
(143, 'Adultes Loisirs', '', '2021-12-15 18:03:31');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `planning_tableaux`
--
ALTER TABLE `planning_tableaux`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `planning_tableaux`
--
ALTER TABLE `planning_tableaux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
