-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 08 sep. 2020 à 14:27
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `immobilier`
--

-- --------------------------------------------------------

--
-- Structure de la table `logement`
--

CREATE TABLE `logement` (
  `id_logement` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `ville` varchar(55) NOT NULL,
  `cp` int(11) NOT NULL,
  `surface` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `photo` varchar(55) NOT NULL,
  `type_bien` enum('location','vente') NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `logement`
--

INSERT INTO `logement` (`id_logement`, `titre`, `adresse`, `ville`, `cp`, `surface`, `prix`, `photo`, `type_bien`, `description`) VALUES
(1, 'F4 meuble', '31 avenue georges mandel', 'PARIS', 75016, 80, 800000, 'photos/appartf4.jpg', 'vente', 'Appartement de type F4'),
(2, 'F3 meublé', '2 rue bla', 'PARIS', 92120, 65, 2500, 'photos/appartf3.jpg', 'location', 'Appartement F3 en location'),
(3, 'studio', '13 rue Moret', 'paris', 75011, 30, 200000, 'photos/studio2.jpg', 'vente', 'Studio 30m² à vendre'),
(4, 'Duplex', '1 rue DES SABLONS', 'Paris', 75016, 100, 900000, 'photos/duplex2.jpg', 'vente', 'Duplex de 100m² à vendre'),
(6, 'F4 meuble', '31 avenue georges mandel', 'PARIS', 75016, 30, 60, 'photos/studio2.jpg', 'vente', 'dfghjk'),
(11, 'F4 meuble', '13 rue Moret 75011', 'paris', 75011, 65, 54, 'photos/', 'vente', 'fgh'),
(12, 'F4 meuble', '31 avenue georges mandel', 'PARIS', 75016, 100, 50, 'photos/duplex1.jpg', 'vente', 'ghhj'),
(20, 'cuisine', '5 rue bla ble', 'paris', 75012, 30, 65, 'photos/', 'location', 'cuisine ouverte'),
(21, 'F4 meuble', '2 rue bla', 'PARIS', 75016, 55, 15, 'photos/appartf4.jpg', 'vente', 'F4 joli'),
(22, 'Patalon blanc', '31 avenue georges mandel', 'PARIS', 75016, 100, 200000, 'photos/', 'location', 'essai'),
(23, 'F4 ', '2 rue bla', 'PARIS', 92120, 100, 15, 'photos/appartf4.jpg', 'vente', 'vente f4'),
(24, 'cuisine1', '5 rue bla ble', 'paris', 75012, 30, 50, 'photos/', 'location', 'photo non uploadé');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `logement`
--
ALTER TABLE `logement`
  ADD PRIMARY KEY (`id_logement`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `logement`
--
ALTER TABLE `logement`
  MODIFY `id_logement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
