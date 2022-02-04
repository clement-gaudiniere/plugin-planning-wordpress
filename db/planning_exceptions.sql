-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 04 fév. 2022 à 21:37
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.4.27

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
-- Structure de la table `planning_exceptions`
--

CREATE TABLE `planning_exceptions` (
  `id` int(11) NOT NULL,
  `tabId` int(11) NOT NULL,
  `dateException` varchar(255) NOT NULL,
  `timeException` varchar(255) NOT NULL,
  `raison` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `planning_exceptions`
--

INSERT INTO `planning_exceptions` (`id`, `tabId`, `dateException`, `timeException`, `raison`) VALUES
(1, 1, '1', '1', 'rtghethjrtj'),
(8, 0, '2022-02-04', '23:23', ';j;y;jyh'),
(9, 0, '2022-02-04', '23:23', ';j;y;jyh'),
(10, 0, '2022-02-04', '23:23', ';j;y;jyh'),
(11, 1, '2022-02-04', '23:23', ';j;y;jyh'),
(12, 142, '2022-02-04', '23:23', ';j;y;jyh');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `planning_exceptions`
--
ALTER TABLE `planning_exceptions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `planning_exceptions`
--
ALTER TABLE `planning_exceptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
