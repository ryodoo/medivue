-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 08, 2025 at 08:32 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medievue`
--

-- --------------------------------------------------------

--
-- Table structure for table `affectations`
--

CREATE TABLE `affectations` (
  `id` int(11) NOT NULL,
  `set_id` int(11) DEFAULT NULL,
  `specialite_id` int(11) DEFAULT NULL,
  `medecin_id` int(11) DEFAULT NULL,
  `composition_id` int(11) DEFAULT NULL,
  `remarque` text DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `anomalies`
--

CREATE TABLE `anomalies` (
  `id` int(11) NOT NULL,
  `evenement_id` int(11) NOT NULL,
  `typeanomaly_id` int(11) NOT NULL,
  `instrument_id` int(11) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `commentaire` text DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bacs`
--

CREATE TABLE `bacs` (
  `id` int(11) NOT NULL,
  `ref` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blocs`
--

CREATE TABLE `blocs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ref` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `boucles`
--

CREATE TABLE `boucles` (
  `id` int(11) NOT NULL,
  `code_patient` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `compositions`
--

CREATE TABLE `compositions` (
  `id` int(11) NOT NULL,
  `fournisseur_id` int(11) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `images` text DEFAULT NULL,
  `remarque` text DEFAULT NULL,
  `emplacement` varchar(50) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE `configs` (
  `id` int(11) NOT NULL,
  `clinique` varchar(255) DEFAULT NULL,
  `sufixe_codebar` varchar(255) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `logo` varchar(45) DEFAULT NULL,
  `info_clinique` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `demandecompositions`
--

CREATE TABLE `demandecompositions` (
  `id` int(11) NOT NULL,
  `demande_id` int(11) DEFAULT NULL,
  `composition_id` int(11) DEFAULT NULL,
  `anomaly_id` int(11) DEFAULT NULL,
  `conforme` varchar(50) DEFAULT NULL,
  `remarque` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `demandes`
--

CREATE TABLE `demandes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bloc_id` int(11) DEFAULT NULL,
  `livrer_par` int(11) DEFAULT NULL,
  `stock_par` int(11) DEFAULT NULL,
  `specialite_id` int(11) DEFAULT NULL,
  `recu_par` int(11) DEFAULT NULL,
  `medecin_id` int(11) DEFAULT NULL,
  `etat` varchar(50) DEFAULT 'Demande en cours',
  `remarque` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `date_livraison` datetime DEFAULT NULL,
  `confirmer_livraison` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `devs`
--

CREATE TABLE `devs` (
  `id` int(11) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `commentaire` text DEFAULT NULL,
  `lien` text DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `view` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `etapes`
--

CREATE TABLE `etapes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `ordre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evenements`
--

CREATE TABLE `evenements` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `composition_id` int(11) NOT NULL,
  `poste_id` int(11) NOT NULL,
  `machine_id` int(11) NOT NULL,
  `etape_id` int(11) NOT NULL,
  `boucle_id` int(11) NOT NULL,
  `remarque` text DEFAULT NULL,
  `resultat` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instruments`
--

CREATE TABLE `instruments` (
  `id` int(11) NOT NULL,
  `composition_id` int(11) DEFAULT NULL,
  `fournisseur_id` int(11) DEFAULT NULL,
  `ref` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `nom_comercial` varchar(255) DEFAULT NULL,
  `code_fournisseur` varchar(45) DEFAULT NULL,
  `num_lot` varchar(255) DEFAULT NULL,
  `prix` varchar(45) DEFAULT NULL,
  `etat` int(11) DEFAULT 1,
  `date_ajout` date DEFAULT NULL,
  `taille` varchar(255) DEFAULT NULL,
  `remarque` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `coordonnees_image` varchar(255) DEFAULT NULL,
  `type_lavage` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `code` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `instrument_id` int(11) DEFAULT NULL,
  `evenement_id` int(11) DEFAULT NULL,
  `action` varchar(45) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `machines`
--

CREATE TABLE `machines` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `remarque` text DEFAULT NULL,
  `ref` varchar(45) DEFAULT NULL,
  `api` text DEFAULT NULL,
  `type` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medecins`
--

CREATE TABLE `medecins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `contact` varchar(45) DEFAULT NULL,
  `remarque` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postes`
--

CREATE TABLE `postes` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `remplacements`
--

CREATE TABLE `remplacements` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `instrument_source_id` int(11) NOT NULL,
  `instrument_cible_id` int(11) NOT NULL,
  `motif` text DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `specialites`
--

CREATE TABLE `specialites` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trempages`
--

CREATE TABLE `trempages` (
  `id` int(11) NOT NULL,
  `bac_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'trempé par',
  `composition_id` int(11) DEFAULT NULL,
  `date_trampage` datetime DEFAULT NULL,
  `comentaire_trempage` text DEFAULT NULL,
  `retirer_par` int(11) DEFAULT NULL,
  `date_retirage` datetime DEFAULT NULL,
  `comentaire_retirer` text DEFAULT NULL,
  `etat` varchar(50) DEFAULT 'en cours'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `typeanomalies`
--

CREATE TABLE `typeanomalies` (
  `id` int(11) NOT NULL,
  `anomalie` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `etat` varchar(45) DEFAULT NULL,
  `ref` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zonesaledetails`
--

CREATE TABLE `zonesaledetails` (
  `id` int(11) NOT NULL,
  `zonesale_id` int(11) DEFAULT NULL,
  `composition_id` int(11) DEFAULT NULL,
  `instrument_id` int(11) DEFAULT NULL,
  `type_scan` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zonesales`
--

CREATE TABLE `zonesales` (
  `id` int(11) NOT NULL,
  `poste_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `remarque` text DEFAULT NULL,
  `etat` varchar(50) DEFAULT 'En cours',
  `created` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affectations`
--
ALTER TABLE `affectations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anomalies`
--
ALTER TABLE `anomalies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bacs`
--
ALTER TABLE `bacs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blocs`
--
ALTER TABLE `blocs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boucles`
--
ALTER TABLE `boucles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compositions`
--
ALTER TABLE `compositions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demandecompositions`
--
ALTER TABLE `demandecompositions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demandes`
--
ALTER TABLE `demandes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devs`
--
ALTER TABLE `devs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `etapes`
--
ALTER TABLE `etapes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evenements`
--
ALTER TABLE `evenements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instruments`
--
ALTER TABLE `instruments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machines`
--
ALTER TABLE `machines`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `medecins`
--
ALTER TABLE `medecins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postes`
--
ALTER TABLE `postes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remplacements`
--
ALTER TABLE `remplacements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialites`
--
ALTER TABLE `specialites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trempages`
--
ALTER TABLE `trempages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `typeanomalies`
--
ALTER TABLE `typeanomalies`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zonesaledetails`
--
ALTER TABLE `zonesaledetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zonesales`
--
ALTER TABLE `zonesales`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `affectations`
--
ALTER TABLE `affectations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `anomalies`
--
ALTER TABLE `anomalies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bacs`
--
ALTER TABLE `bacs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blocs`
--
ALTER TABLE `blocs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `boucles`
--
ALTER TABLE `boucles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `compositions`
--
ALTER TABLE `compositions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `configs`
--
ALTER TABLE `configs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `demandecompositions`
--
ALTER TABLE `demandecompositions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `demandes`
--
ALTER TABLE `demandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `devs`
--
ALTER TABLE `devs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `etapes`
--
ALTER TABLE `etapes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `instruments`
--
ALTER TABLE `instruments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `machines`
--
ALTER TABLE `machines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medecins`
--
ALTER TABLE `medecins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `postes`
--
ALTER TABLE `postes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `remplacements`
--
ALTER TABLE `remplacements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `specialites`
--
ALTER TABLE `specialites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trempages`
--
ALTER TABLE `trempages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `typeanomalies`
--
ALTER TABLE `typeanomalies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `zonesaledetails`
--
ALTER TABLE `zonesaledetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `zonesales`
--
ALTER TABLE `zonesales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
