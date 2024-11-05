-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 01 mai 2024 à 22:22
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hotel2`
--

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

CREATE TABLE `chambre` (
  `id_chambre` int(11) NOT NULL,
  `id_type_ch` int(11) NOT NULL,
  `num_chambre` varchar(20) DEFAULT NULL,
  `statut` enum('disponible','occupée') NOT NULL DEFAULT 'disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `chambre`
--

INSERT INTO `chambre` (`id_chambre`, `id_type_ch`, `num_chambre`, `statut`) VALUES
(1, 1, '101', 'disponible'),
(2, 2, '102', 'disponible'),
(3, 1, '103', 'occupée'),
(7, 1, '104', 'disponible'),
(10, 1, '105', 'disponible'),
(16, 3, '106', 'disponible'),
(22, 1, '107', 'disponible');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_chambre` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `nb_adultes` int(4) DEFAULT NULL,
  `nb_enfants` int(4) DEFAULT NULL,
  `etat` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `id_client`, `id_chambre`, `date_debut`, `date_fin`, `nb_adultes`, `nb_enfants`, `etat`) VALUES
(22, 14, 1, '2024-05-02', '2024-05-10', 1, 1, 2),
(23, 13, 1, '2024-05-09', '2024-05-11', 1, 1, 2),
(24, 15, 3, '2024-05-06', '2024-05-12', 2, 1, 2),
(25, 16, 2, '2024-05-09', '2024-05-11', 2, 2, 1),
(26, 16, 3, '2024-04-16', '2024-04-19', 2, 3, 2),
(27, 17, 3, '2024-05-03', '2024-05-05', 2, 1, 2),
(28, 13, 3, '2024-05-02', '2024-05-05', 2, 0, 2),
(29, 13, 3, '2024-05-07', '2024-05-10', 2, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `saison`
--

CREATE TABLE `saison` (
  `id_sai` int(11) NOT NULL,
  `libelle_sai` varchar(20) DEFAULT NULL,
  `dat_deb_sai` date DEFAULT NULL,
  `dat_fin_sai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `saison`
--

INSERT INTO `saison` (`id_sai`, `libelle_sai`, `dat_deb_sai`, `dat_fin_sai`) VALUES
(1, 'Basse saison', '2024-01-01', '2024-06-30'),
(2, 'Haute saison', '2024-07-01', '2024-12-31');

-- --------------------------------------------------------

--
-- Structure de la table `tarif`
--

CREATE TABLE `tarif` (
  `id_tarif` int(11) NOT NULL,
  `id_sai` int(11) NOT NULL,
  `id_type_ch` int(11) NOT NULL,
  `prix` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tarif`
--

INSERT INTO `tarif` (`id_tarif`, `id_sai`, `id_type_ch`, `prix`) VALUES
(1, 1, 1, 75.00),
(2, 1, 2, 150.00),
(3, 2, 1, 90.00),
(4, 2, 2, 200.00),
(5, 1, 3, 100.00);

-- --------------------------------------------------------

--
-- Structure de la table `type_chambre`
--

CREATE TABLE `type_chambre` (
  `id_type_ch` int(11) NOT NULL,
  `libelle_type_ch` varchar(20) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `nb_ch` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_chambre`
--

INSERT INTO `type_chambre` (`id_type_ch`, `libelle_type_ch`, `description`, `nb_ch`) VALUES
(1, 'Standard', 'Chambre simple pour deux personnes', 20),
(2, 'Luxe', 'Chambre spacieuse avec vue', 10),
(3, 'Suite', 'Grande suite avec salon et jacuzzi', 5);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `role` enum('visiteur','client','administrateur') NOT NULL,
  `image` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `email`, `mot_de_passe`, `role`, `image`) VALUES
(2, 'Admin', 'admin', 'admin', 'administrateur', NULL),
(13, 'cc', 'cc@gmail.com', 'cc', 'client', 0x2e2e2f5675652f696d6167652f70726f66696c652d706963202833292e706e67),
(14, 'Assil Bouassida', 'bouassidaassil40@gmail.com', '123', 'client', 0x2e2e2f5675652f696d6167652f70726f66696c652d706963202832292e706e67),
(15, 'yosr', 'yosr@gmail.com', '123', 'client', 0x2e2e2f5675652f696d6167652f70726f66696c652d706963202834292e706e67),
(16, 'fatma', 'fatma@gmail.com', '987', 'client', 0x2e2e2f5675652f696d6167652f70726f66696c652d706963202831292e706e67),
(17, 'ahmed', 'ahmed@gamil.com', '654', 'client', 0x2e2e2f5675652f696d6167652f70726f66696c652d706963202835292e706e67);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chambre`
--
ALTER TABLE `chambre`
  ADD PRIMARY KEY (`id_chambre`),
  ADD KEY `id_type_ch` (`id_type_ch`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_chambre` (`id_chambre`);

--
-- Index pour la table `saison`
--
ALTER TABLE `saison`
  ADD PRIMARY KEY (`id_sai`);

--
-- Index pour la table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id_tarif`),
  ADD KEY `id_sai` (`id_sai`),
  ADD KEY `id_type_ch` (`id_type_ch`);

--
-- Index pour la table `type_chambre`
--
ALTER TABLE `type_chambre`
  ADD PRIMARY KEY (`id_type_ch`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chambre`
--
ALTER TABLE `chambre`
  MODIFY `id_chambre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `saison`
--
ALTER TABLE `saison`
  MODIFY `id_sai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `type_chambre`
--
ALTER TABLE `type_chambre`
  MODIFY `id_type_ch` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chambre`
--
ALTER TABLE `chambre`
  ADD CONSTRAINT `chambre_ibfk_1` FOREIGN KEY (`id_type_ch`) REFERENCES `type_chambre` (`id_type_ch`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_chambre`) REFERENCES `chambre` (`id_chambre`);

--
-- Contraintes pour la table `tarif`
--
ALTER TABLE `tarif`
  ADD CONSTRAINT `tarif_ibfk_1` FOREIGN KEY (`id_sai`) REFERENCES `saison` (`id_sai`),
  ADD CONSTRAINT `tarif_ibfk_2` FOREIGN KEY (`id_type_ch`) REFERENCES `type_chambre` (`id_type_ch`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
