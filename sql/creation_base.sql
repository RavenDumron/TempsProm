-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 31, 2025 at 02:25 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `prometecmod1`
--

CREATE DATABASE IF NOT EXISTS `prometecmod2`;
USE `prometecmod2`;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `clients_id` smallint(5) UNSIGNED NOT NULL,
  `clients_nom` varchar(45) NOT NULL,
  `clients_adresse` varchar(255) NOT NULL,
  `clients_cp` int(11) NOT NULL,
  `clients_ville` varchar(45) NOT NULL,
  `clients_tel` int(10) UNSIGNED ZEROFILL NOT NULL,
  `clients_mail` varchar(45) NOT NULL,
  `clients_actif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients_contrat`
--

CREATE TABLE IF NOT EXISTS `clients_contrat` (
  `clients_contrat_id` smallint(5) UNSIGNED NOT NULL,
  `clients_contrat_ouverture` date NOT NULL,
  `clients_contrat_fermeture` date NOT NULL,
  `clients_contrat_prix_vente_ht` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `clients_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `intervention`
--

CREATE TABLE IF NOT EXISTS `intervention` (
  `intervention_id` int(11) NOT NULL,
  `intervention_date_debut` datetime DEFAULT NULL,
  `intervention_date_fin` datetime DEFAULT NULL,
  `intervention_temp` time DEFAULT NULL,
  `intervention_lib` text DEFAULT NULL,
  `clients_id` smallint(5) UNSIGNED DEFAULT NULL,
  `techniciens_id` smallint(5) UNSIGNED DEFAULT NULL,
  `intervention_type_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `techniciens`
--

CREATE TABLE IF NOT EXISTS `techniciens` (
  `techniciens_id` smallint(5) UNSIGNED NOT NULL,
  `techniciens_nom` varchar(45) NOT NULL,
  `techniciens_prenom` varchar(45) NOT NULL,
  `techniciens_login` varchar(45) NOT NULL,
  `techniciens_mdp` varchar(255) NOT NULL,
  `techniciens_actif` tinyint(1) NOT NULL,
  `techniciens_cout_horaire` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clients_id`);

--
-- Indexes for table `clients_contrat`
--
ALTER TABLE `clients_contrat`
  ADD PRIMARY KEY (`clients_contrat_id`),
  ADD KEY `cliens_id` (`clients_id`);

--
-- Indexes for table `intervention`
--
ALTER TABLE `intervention`
  ADD PRIMARY KEY (`intervention_id`),
  ADD KEY `index2` (`clients_id`),
  ADD KEY `index1` (`techniciens_id`),
  ADD KEY `index3` (`intervention_type_id`) USING BTREE;

--
-- Indexes for table `techniciens`
--
ALTER TABLE `techniciens`
  ADD PRIMARY KEY (`techniciens_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clients_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients_contrat`
--
ALTER TABLE `clients_contrat`
  MODIFY `clients_contrat_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `intervention`
--
ALTER TABLE `intervention`
  MODIFY `intervention_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `techniciens`
--
ALTER TABLE `techniciens`
  MODIFY `techniciens_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;


-- Insert technicians
INSERT INTO techniciens (techniciens_nom, techniciens_prenom, techniciens_login, techniciens_mdp, techniciens_actif, techniciens_cout_horaire) VALUES
('Smith', 'John', 'jsmith', 'password123', 1, 30),
('Doe', 'Jane', 'jdoe', 'password123', 1, 35);

-- Insert 20 clients, including Prometech
INSERT INTO clients (clients_id, clients_nom, clients_adresse, clients_cp, clients_ville, clients_tel, clients_mail, clients_actif) VALUES
(1, 'Prometech', '123 Innovation Street', 75001, 'Paris', 0123456789, 'contact@prometech.com', 1),
(2, 'AlphaCorp', '456 Business Rd', 69000, 'Lyon', 0987654321, 'info@alphacorp.com', 1),
(3, 'BetaTech', '789 Future Ave', 31000, 'Toulouse', 0112233445, 'support@betatech.com', 1),
(4, 'GammaSoft', '159 Digital Blvd', 33000, 'Bordeaux', 0147852369, 'contact@gammasoft.com', 1),
(5, 'DeltaInc', '753 Tech Valley', 13000, 'Marseille', 0172394856, 'info@deltainc.com', 1),
(6, 'EpsilonSystems', '852 Cyber Park', 44000, 'Nantes', 0123498576, 'support@epsilonsys.com', 1),
(7, 'ZetaWorks', '321 Innovation St', 59000, 'Lille', 0165482379, 'contact@zetaworks.com', 1),
(8, 'EtaCorp', '741 Silicon Alley', 67000, 'Strasbourg', 0156798432, 'info@etacorp.com', 1),
(9, 'ThetaSolutions', '963 AI Road', 06000, 'Nice', 0129874563, 'support@theta.com', 1),
(10, 'IotaNetworks', '147 Quantum Drive', 34000, 'Montpellier', 0192837465, 'contact@iotanetworks.com', 1);

-- Insert contracts ensuring 1-2 year gap, with renewals for all clients
INSERT INTO clients_contrat (clients_contrat_ouverture, clients_contrat_fermeture, clients_contrat_prix_vente_ht, clients_id) VALUES
('2020-01-01', '2022-01-01', 5000, 1), ('2022-01-02', '2024-01-02', 5500, 1), ('2024-01-03', '2026-01-03', 6000, 1),
('2021-06-15', '2023-06-15', 7000, 2), ('2023-06-16', '2025-06-16', 7500, 2),
('2020-03-20', '2022-03-20', 6000, 3), ('2022-03-21', '2024-03-21', 6500, 3), ('2024-03-22', '2026-03-22', 7000, 3),
('2020-05-10', '2022-05-10', 6200, 4), ('2022-05-11', '2024-05-11', 6700, 4), ('2024-05-12', '2026-05-12', 7200, 4),
('2020-01-01', '2022-01-01', 100000, 5), ('2022-01-02', '2024-01-02', 100000, 5), ('2024-01-03', '2026-01-03', 100000, 5),
('2021-06-15', '2023-06-15', 7000, 6), ('2023-06-16', '2025-06-16', 7500, 6),
('2020-03-20', '2022-03-20', 6000, 7), ('2022-03-21', '2024-03-21', 6500, 7), ('2024-03-22', '2026-03-22', 7000, 7),
('2020-05-10', '2022-05-10', 50000, 8), ('2022-05-11', '2024-05-11', 45000, 8), ('2024-05-12', '2026-05-12', 60000, 8),
('2020-01-01', '2022-01-01', 5000, 9), ('2022-01-02', '2024-01-02', 5500, 9), ('2024-01-03', '2026-01-03', 6000, 9),
('2021-06-15', '2023-06-15', 7000, 10), ('2023-06-16', '2025-06-16', 7500, 10);

INSERT INTO intervention (intervention_date_debut, intervention_date_fin, intervention_temp, intervention_lib, clients_id, techniciens_id, intervention_type_id) VALUES
('2020-01-05 08:00:00', '2020-01-05 10:30:00', '02:30:00', 'Lorem ipsum dolor sit amet.', 1, 1, 2),
('2020-01-10 09:00:00', '2020-01-10 11:00:00', '02:00:00', 'Consectetur adipiscing elit.', 1, 2, 1),
('2020-01-15 14:00:00', '2020-01-15 16:00:00', '02:00:00', 'Sed do eiusmod tempor.', 4, 1, 9),
('2020-02-05 08:00:00', '2020-02-05 10:30:00', '02:30:00', 'Incididunt ut labore.', 1, 2, 1),
('2020-02-10 09:00:00', '2020-02-10 11:00:00', '02:00:00', 'Dolore magna aliqua.', 6, 1, 13),
('2020-01-05 08:30:00', '2020-01-05 11:00:00', '02:30:00', 'Ut enim ad minim veniam.', 2, 2, 1),
('2020-01-10 10:00:00', '2020-01-10 12:00:00', '02:00:00', 'Quis nostrud exercitation.', 7, 1, 1),
('2020-01-15 15:00:00', '2020-01-15 17:30:00', '02:30:00', 'Ullamco laboris nisi.', 2, 2, 1),
('2020-02-05 07:00:00', '2020-02-05 09:30:00', '02:30:00', 'Aliquip ex ea commodo.', 2, 1, 1),
('2020-02-10 08:45:00', '2020-02-10 10:45:00', '02:00:00', 'Duis aute irure dolor.', 10, 2, 1),
('2020-01-05 08:00:00', '2020-01-05 10:30:00', '02:30:00', 'Reprehenderit in voluptate.', 3, 1, 9),
('2020-01-10 09:00:00', '2020-01-10 11:00:00', '02:00:00', 'Velit esse cillum dolore.', 3, 2, 1),
('2020-01-15 14:00:00', '2020-01-15 16:00:00', '02:00:00', 'Fugiat nulla pariatur.', 9, 1, 1),
('2020-02-05 08:00:00', '2020-02-05 10:30:00', '02:30:00', 'Excepteur sint occaecat.', 3, 2, 1),
('2020-02-10 09:00:00', '2020-02-10 11:00:00', '02:00:00', 'Cupidatat non proident.', 8, 1, 1),
('2020-03-05 08:00:00', '2020-03-05 10:30:00', '02:30:00', 'Lorem ipsum dolor sit amet.', 1, 1, 2),
('2020-03-10 09:00:00', '2020-03-10 11:00:00', '02:00:00', 'Consectetur adipiscing elit.', 1, 2, 1),
('2020-03-15 14:00:00', '2020-03-15 16:00:00', '02:00:00', 'Sed do eiusmod tempor.', 1, 1, 9),
('2020-04-05 08:00:00', '2020-04-05 10:30:00', '02:30:00', 'Incididunt ut labore.', 5, 2, 1),
('2020-04-10 09:00:00', '2020-04-10 11:00:00', '02:00:00', 'Dolore magna aliqua.', 4, 1, 13),
('2020-03-05 08:30:00', '2020-03-05 11:00:00', '02:30:00', 'Ut enim ad minim veniam.', 6, 2, 1),
('2020-03-10 10:00:00', '2020-03-10 12:00:00', '02:00:00', 'Quis nostrud exercitation.', 2, 1, 1),
('2020-03-15 15:00:00', '2020-03-15 17:30:00', '02:30:00', 'Ullamco laboris nisi.', 8, 2, 12),
('2020-04-05 07:00:00', '2020-04-05 09:30:00', '02:30:00', 'Aliquip ex ea commodo.', 10, 1, 1),
('2020-04-10 08:45:00', '2020-04-10 10:45:00', '02:00:00', 'Duis aute irure dolor.', 5, 2, 1),
('2020-03-05 08:00:00', '2020-03-05 10:30:00', '02:30:00', 'Reprehenderit in voluptate.', 10, 1, 1),
('2020-03-10 09:00:00', '2020-03-10 11:00:00', '02:00:00', 'Velit esse cillum dolore.', 3, 2, 12),
('2020-03-15 14:00:00', '2020-03-15 16:00:00', '02:00:00', 'Fugiat nulla pariatur.', 3, 1, 1),
('2020-04-05 08:00:00', '2020-04-05 10:30:00', '02:30:00', 'Excepteur sint occaecat.', 7, 2, 1),
('2020-04-10 09:00:00', '2020-04-10 11:00:00', '02:00:00', 'Cupidatat non proident.', 9, 1, 1),
('2020-05-05 08:15:00', '2020-05-05 10:45:00', '02:30:00', 'Lorem ipsum dolor sit amet.', 1, 1, 1),
('2020-05-10 09:30:00', '2020-05-10 11:35:00', '02:05:00', 'Consectetur adipiscing elit.', 10, 2, 6),
('2020-05-15 13:45:00', '2020-05-15 15:50:00', '02:05:00', 'Sed do eiusmod tempor.', 5, 1, 1),
('2020-06-05 07:50:00', '2020-06-05 10:20:00', '02:30:00', 'Incididunt ut labore.', 6, 2, 1),
('2020-06-10 09:10:00', '2020-06-10 11:05:00', '01:55:00', 'Dolore magna aliqua.', 1, 1, 13),
('2020-05-05 08:45:00', '2020-05-05 11:10:00', '02:25:00', 'Ut enim ad minim veniam.', 2, 2, 1),
('2020-05-10 10:15:00', '2020-05-10 12:20:00', '02:05:00', 'Quis nostrud exercitation.', 2, 1, 1),
('2020-05-15 15:20:00', '2020-05-15 17:40:00', '02:20:00', 'Ullamco laboris nisi.', 8, 2, 1),
('2020-06-05 07:10:00', '2020-06-05 09:35:00', '02:25:00', 'Aliquip ex ea commodo.', 7, 1, 6),
('2020-06-10 08:50:00', '2020-06-10 10:50:00', '02:00:00', 'Duis aute irure dolor.', 2, 2, 1),
('2020-05-05 08:20:00', '2020-05-05 10:40:00', '02:20:00', 'Reprehenderit in voluptate.', 3, 1, 1),
('2020-05-10 09:15:00', '2020-05-10 11:20:00', '02:05:00', 'Velit esse cillum dolore.', 9, 2, 1),
('2020-05-15 13:55:00', '2020-05-15 15:55:00', '02:00:00', 'Fugiat nulla pariatur.', 3, 1, 1),
('2020-06-05 08:05:00', '2020-06-05 10:25:00', '02:20:00', 'Excepteur sint occaecat.', 10, 2, 6),
('2020-06-10 09:05:00', '2020-06-10 11:15:00', '02:10:00', 'Cupidatat non proident.', 8, 1, 1),
('2020-07-05 08:10:00', '2020-07-05 10:40:00', '02:30:00', 'Lorem ipsum dolor sit amet.', 7, 1, 1),
('2020-07-10 09:20:00', '2020-07-10 11:30:00', '02:10:00', 'Consectetur adipiscing elit.', 1, 2, 6),
('2020-07-15 14:10:00', '2020-07-15 16:15:00', '02:05:00', 'Sed do eiusmod tempor.', 5, 1, 9),
('2020-08-05 07:55:00', '2020-08-05 10:25:00', '02:30:00', 'Incididunt ut labore.', 8, 2, 1),
('2020-08-10 09:05:00', '2020-08-10 11:00:00', '01:55:00', 'Dolore magna aliqua.', 1, 1, 13),
('2020-07-05 08:35:00', '2020-07-05 11:00:00', '02:25:00', 'Ut enim ad minim veniam.', 10, 2, 1),
('2020-07-10 10:10:00', '2020-07-10 12:15:00', '02:05:00', 'Quis nostrud exercitation.', 2, 1, 9),
('2020-07-15 15:30:00', '2020-07-15 17:50:00', '02:20:00', 'Ullamco laboris nisi.', 4, 2, 12),
('2020-08-05 07:20:00', '2020-08-05 09:40:00', '02:20:00', 'Aliquip ex ea commodo.', 7, 1, 1),
('2020-08-10 08:40:00', '2020-08-10 10:50:00', '02:10:00', 'Duis aute irure dolor.', 2, 2, 1),
('2020-07-05 08:25:00', '2020-07-05 10:45:00', '02:20:00', 'Reprehenderit in voluptate.', 9, 1, 1),
('2020-07-10 09:10:00', '2020-07-10 11:25:00', '02:15:00', 'Velit esse cillum dolore.', 3, 2, 1),
('2020-07-15 14:05:00', '2020-07-15 16:05:00', '02:00:00', 'Fugiat nulla pariatur.', 10, 1, 1),
('2020-08-05 08:00:00', '2020-08-05 10:20:00', '02:20:00', 'Excepteur sint occaecat.', 7, 2, 6),
('2020-08-10 09:15:00', '2020-08-10 11:20:00', '02:05:00', 'Cupidatat non proident.', 3, 1, 1),
('2020-09-05 08:05:00', '2020-09-05 10:20:00', '02:15:00', 'Lorem ipsum dolor sit amet.', 5, 1, 1),
('2020-09-10 09:00:00', '2020-09-10 11:10:00', '02:10:00', 'Consectetur adipiscing elit.', 6, 2, 6),
('2020-09-15 14:20:00', '2020-09-15 16:25:00', '02:05:00', 'Sed do eiusmod tempor.', 1, 1, 9),
('2020-10-05 07:30:00', '2020-10-05 10:00:00', '02:30:00', 'Incididunt ut labore.', 10, 2, 1),
('2020-10-10 09:25:00', '2020-10-10 11:40:00', '02:15:00', 'Dolore magna aliqua.', 1, 1, 13),
('2020-09-05 08:40:00', '2020-09-05 11:05:00', '02:25:00', 'Ut enim ad minim veniam.', 5, 2, 1),
('2020-09-10 10:30:00', '2020-09-10 12:35:00', '02:05:00', 'Quis nostrud exercitation.', 2, 1, 1),
('2020-09-15 15:10:00', '2020-09-15 17:30:00', '02:20:00', 'Ullamco laboris nisi.', 8, 2, 1),
('2020-10-05 07:50:00', '2020-10-05 10:15:00', '02:25:00', 'Aliquip ex ea commodo.', 2, 1, 6),
('2020-10-10 08:55:00', '2020-10-10 11:05:00', '02:10:00', 'Duis aute irure dolor.', 7, 2, 1),
('2020-09-05 08:15:00', '2020-09-05 10:35:00', '02:20:00', 'Reprehenderit in voluptate.', 3, 1, 1),
('2020-09-10 09:45:00', '2020-09-10 11:55:00', '02:10:00', 'Velit esse cillum dolore.', 3, 2, 12),
('2020-09-15 14:30:00', '2020-09-15 16:35:00', '02:05:00', 'Fugiat nulla pariatur.', 9, 1, 1),
('2020-10-05 08:10:00', '2020-10-05 10:40:00', '02:30:00', 'Excepteur sint occaecat.', 3, 2, 6),
('2020-10-10 09:20:00', '2020-10-10 11:30:00', '02:10:00', 'Cupidatat non proident.', 10, 1, 1),
('2020-11-05 08:20:00', '2020-11-05 10:40:00', '02:20:00', 'Lorem ipsum dolor sit amet.', 8, 1, 1),
('2020-11-10 09:10:00', '2020-11-10 11:30:00', '02:20:00', 'Consectetur adipiscing elit.', 1, 2, 1),
('2020-11-15 14:30:00', '2020-11-15 16:40:00', '02:10:00', 'Sed do eiusmod tempor.', 7, 1, 1),
('2020-12-05 07:45:00', '2020-12-05 10:10:00', '02:25:00', 'Incididunt ut labore.', 1, 2, 12),
('2020-12-10 09:30:00', '2020-12-10 11:50:00', '02:20:00', 'Dolore magna aliqua.', 6, 1, 1),
('2020-11-05 08:50:00', '2020-11-05 11:20:00', '02:30:00', 'Ut enim ad minim veniam.', 2, 2, 1),
('2020-11-10 10:40:00', '2020-11-10 12:55:00', '02:15:00', 'Quis nostrud exercitation.', 5, 1, 1),
('2020-11-15 15:40:00', '2020-11-15 17:55:00', '02:15:00', 'Ullamco laboris nisi.', 4, 2, 1),
('2020-12-05 07:35:00', '2020-12-05 10:00:00', '02:25:00', 'Aliquip ex ea commodo.', 5, 1, 6),
('2020-12-10 08:25:00', '2020-12-10 10:35:00', '02:10:00', 'Duis aute irure dolor.', 2, 2, 1),
('2020-11-05 08:35:00', '2020-11-05 10:55:00', '02:20:00', 'Reprehenderit in voluptate.', 7, 1, 1),
('2020-11-10 09:25:00', '2020-11-10 11:40:00', '02:15:00', 'Velit esse cillum dolore.', 8, 2, 12),
('2020-11-15 14:45:00', '2020-11-15 16:50:00', '02:05:00', 'Fugiat nulla pariatur.', 3, 1, 1),
('2020-12-05 08:00:00', '2020-12-05 10:30:00', '02:30:00', 'Excepteur sint occaecat.', 10, 2, 6),
('2020-12-10 09:00:00', '2020-12-10 11:10:00', '02:10:00', 'Cupidatat non proident.', 3, 1, 1),
('2021-01-05 08:00:00', '2021-01-05 10:30:00', '02:30:00', 'Lorem ipsum dolor sit amet.', 9, 1, 1),
('2021-01-10 09:00:00', '2021-01-10 11:00:00', '02:00:00', 'Consectetur adipiscing elit.', 10, 2, 6),
('2021-01-15 14:00:00', '2021-01-15 16:00:00', '02:00:00', 'Sed do eiusmod tempor.', 1, 1, 1),
('2021-02-05 08:00:00', '2021-02-05 10:30:00', '02:30:00', 'Incididunt ut labore.', 10, 2, 1),
('2021-02-10 09:00:00', '2021-02-10 11:00:00', '02:00:00', 'Dolore magna aliqua.', 5, 1, 13),
('2021-01-05 08:30:00', '2021-01-05 11:00:00', '02:30:00', 'Ut enim ad minim veniam.', 2, 2, 1),
('2021-01-10 10:00:00', '2021-01-10 12:00:00', '02:00:00', 'Quis nostrud exercitation.', 7, 1, 1),
('2021-01-15 15:00:00', '2021-01-15 17:30:00', '02:30:00', 'Ullamco laboris nisi.', 2, 2, 12),
('2021-02-05 07:00:00', '2021-02-05 09:30:00', '02:30:00', 'Aliquip ex ea commodo.', 6, 1, 1),
('2021-02-10 08:45:00', '2021-02-10 10:45:00', '02:00:00', 'Duis aute irure dolor.', 2, 2, 1),
('2021-01-05 08:00:00', '2021-01-05 10:30:00', '02:30:00', 'Reprehenderit in voluptate.', 3, 1, 1),
('2021-01-10 09:00:00', '2021-01-10 11:00:00', '02:00:00', 'Velit esse cillum dolore.', 6, 2, 12),
('2021-01-15 14:00:00', '2021-01-15 16:00:00', '02:00:00', 'Fugiat nulla pariatur.', 3, 1, 1),
('2021-02-05 08:00:00', '2021-02-05 10:30:00', '02:30:00', 'Excepteur sint occaecat.', 3, 2, 6),
('2021-02-10 09:00:00', '2021-02-10 11:00:00', '02:00:00', 'Cupidatat non proident.', 3, 1, 1),
('2021-03-05 08:00:00', '2021-03-05 10:30:00', '02:30:00', 'Lorem ipsum dolor sit amet.', 6, 1, 1),
('2021-03-10 09:00:00', '2021-03-10 11:00:00', '02:00:00', 'Consectetur adipiscing elit.', 1, 2, 1),
('2021-03-15 14:00:00', '2021-03-15 16:00:00', '02:00:00', 'Sed do eiusmod tempor.', 7, 1, 1),
('2021-04-05 08:00:00', '2021-04-05 10:30:00', '02:30:00', 'Incididunt ut labore.', 6, 2, 1),
('2021-04-10 09:00:00', '2021-04-10 11:00:00', '02:00:00', 'Dolore magna aliqua.', 8, 1, 13),
('2021-03-05 08:30:00', '2021-03-05 11:00:00', '02:30:00', 'Ut enim ad minim veniam.', 2, 2, 1),
('2021-03-10 10:00:00', '2021-03-10 12:00:00', '02:00:00', 'Quis nostrud exercitation.', 6, 1, 1),
('2021-03-15 15:00:00', '2021-03-15 17:30:00', '02:30:00', 'Ullamco laboris nisi.', 2, 2, 1),
('2021-04-05 07:00:00', '2021-04-05 09:30:00', '02:30:00', 'Aliquip ex ea commodo.', 2, 1, 1),
('2021-04-10 08:45:00', '2021-04-10 10:45:00', '02:00:00', 'Duis aute irure dolor.', 2, 2, 1),
('2021-03-05 08:00:00', '2021-03-05 10:30:00', '02:30:00', 'Reprehenderit in voluptate.', 7, 1, 1),
('2021-03-10 09:00:00', '2021-03-10 11:00:00', '02:00:00', 'Velit esse cillum dolore.', 6, 2, 12),
('2021-03-15 14:00:00', '2021-03-15 16:00:00', '02:00:00', 'Fugiat nulla pariatur.', 3, 1, 1),
('2021-04-05 08:00:00', '2021-04-05 10:30:00', '02:30:00', 'Excepteur sint occaecat.', 3, 2, 6),
('2021-04-10 09:00:00', '2021-04-10 11:00:00', '02:00:00', 'Cupidatat non proident.', 6, 1, 1),
('2021-04-05 08:10:00', '2021-04-05 10:40:00', '02:30:00', 'Lorem ipsum dolor sit amet.', 1, 1, 1),
('2021-04-10 09:20:00', '2021-04-10 11:25:00', '02:05:00', 'Consectetur adipiscing elit.', 1, 2, 1),
('2021-04-15 14:10:00', '2021-04-15 16:30:00', '02:20:00', 'Sed do eiusmod tempor.', 6, 1, 9),
('2021-05-05 08:15:00', '2021-05-05 10:45:00', '02:30:00', 'Incididunt ut labore.', 1, 2, 1),
('2021-05-10 09:25:00', '2021-05-10 11:35:00', '02:10:00', 'Dolore magna aliqua.', 7, 1, 1),
('2021-04-05 08:30:00', '2021-04-05 11:00:00', '02:30:00', 'Ut enim ad minim veniam.', 6, 2, 1),
('2021-04-10 10:00:00', '2021-04-10 12:00:00', '02:00:00', 'Quis nostrud exercitation.', 2, 1, 9),
('2021-04-15 15:00:00', '2021-04-15 17:30:00', '02:30:00', 'Ullamco laboris nisi.', 2, 2, 1),
('2021-05-05 07:00:00', '2021-05-05 09:30:00', '02:30:00', 'Aliquip ex ea commodo.', 8, 1, 1),
('2021-05-10 08:45:00', '2021-05-10 10:50:00', '02:05:00', 'Duis aute irure dolor.', 6, 2, 1),
('2021-04-05 08:25:00', '2021-04-05 10:55:00', '02:30:00', 'Reprehenderit in voluptate.', 3, 1, 1),
('2021-04-10 09:15:00', '2021-04-10 11:30:00', '02:15:00', 'Velit esse cillum dolore.', 3, 2, 12),
('2021-04-15 14:45:00', '2021-04-15 16:50:00', '02:05:00', 'Fugiat nulla pariatur.', 6, 1, 1),
('2021-05-05 08:05:00', '2021-05-05 10:25:00', '02:20:00', 'Excepteur sint occaecat.', 3, 2, 1),
('2021-05-10 09:05:00', '2021-05-10 11:20:00', '02:15:00', 'Cupidatat non proident.', 3, 1, 1),
('2021-06-05 08:15:00', '2021-06-05 10:45:00', '02:30:00', 'Lorem ipsum dolor sit amet.', 6, 1, 2),
('2021-06-10 09:30:00', '2021-06-10 11:40:00', '02:10:00', 'Consectetur adipiscing elit.', 1, 2, 1),
('2021-06-15 14:20:00', '2021-06-15 16:40:00', '02:20:00', 'Sed do eiusmod tempor.', 10, 1, 9),
('2021-07-05 08:00:00', '2021-07-05 10:30:00', '02:30:00', 'Incididunt ut labore.', 1, 2, 1),
('2021-07-10 09:00:00', '2021-07-10 11:20:00', '02:20:00', 'Dolore magna aliqua.', 1, 1, 1),
('2021-06-05 08:25:00', '2021-06-05 10:55:00', '02:30:00', 'Ut enim ad minim veniam.', 2, 2, 1),
('2021-06-10 09:00:00', '2021-06-10 11:00:00', '02:00:00', 'Quis nostrud exercitation.', 7, 1, 9),
('2021-06-15 15:30:00', '2021-06-15 17:50:00', '02:20:00', 'Ullamco laboris nisi.', 8, 2, 1),
('2021-07-05 07:30:00', '2021-07-05 09:55:00', '02:25:00', 'Aliquip ex ea commodo.', 2, 1, 6),
('2021-07-10 08:45:00', '2021-07-10 10:55:00', '02:10:00', 'Duis aute irure dolor.', 10, 2, 1),
('2021-06-05 08:35:00', '2021-06-05 10:50:00', '02:15:00', 'Reprehenderit in voluptate.', 3, 1, 1),
('2021-06-10 09:10:00', '2021-06-10 11:20:00', '02:10:00', 'Velit esse cillum dolore.', 3, 2, 12),
('2021-06-15 14:45:00', '2021-06-15 16:50:00', '02:05:00', 'Fugiat nulla pariatur.', 3, 1, 1),
('2021-07-05 08:15:00', '2021-07-05 10:35:00', '02:20:00', 'Excepteur sint occaecat.', 6, 2, 6),
('2021-07-10 09:05:00', '2021-07-10 11:10:00', '02:05:00', 'Cupidatat non proident.', 3, 1, 1),
('2021-08-05 08:20:00', '2021-08-05 10:50:00', '02:30:00', 'Lorem ipsum dolor sit amet.', 1, 1, 1),
('2021-08-10 09:10:00', '2021-08-10 11:25:00', '02:15:00', 'Consectetur adipiscing elit.', 1, 2, 6),
('2021-08-15 14:15:00', '2021-08-15 16:30:00', '02:15:00', 'Sed do eiusmod tempor.', 1, 1, 1),
('2021-09-05 08:30:00', '2021-09-05 10:55:00', '02:25:00', 'Incididunt ut labore.', 1, 2, 1),
('2021-09-10 09:00:00', '2021-09-10 11:25:00', '02:25:00', 'Dolore magna aliqua.', 5, 1, 13),
('2021-08-05 08:35:00', '2021-08-05 11:00:00', '02:25:00', 'Ut enim ad minim veniam.', 6, 2, 1),
('2021-08-10 09:20:00', '2021-08-10 11:40:00', '02:20:00', 'Quis nostrud exercitation.', 2, 1, 1),
('2021-08-15 15:40:00', '2021-08-15 17:50:00', '02:10:00', 'Ullamco laboris nisi.', 7, 2, 1),
('2021-09-05 07:50:00', '2021-09-05 10:20:00', '02:30:00', 'Aliquip ex ea commodo.', 2, 1, 6),
('2021-09-10 08:50:00', '2021-09-10 11:10:00', '02:20:00', 'Duis aute irure dolor.', 2, 2, 1),
('2021-08-05 08:40:00', '2021-08-05 10:45:00', '02:05:00', 'Reprehenderit in voluptate.', 3, 1, 1),
('2021-08-10 09:00:00', '2021-08-10 11:20:00', '02:20:00', 'Velit esse cillum dolore.', 6, 2, 1),
('2021-08-15 14:40:00', '2021-08-15 16:50:00', '02:10:00', 'Fugiat nulla pariatur.', 5, 1, 1),
('2021-09-05 08:10:00', '2021-09-05 10:30:00', '02:20:00', 'Excepteur sint occaecat.', 3, 2, 6),
('2021-09-10 09:10:00', '2021-09-10 11:15:00', '02:05:00', 'Cupidatat non proident.', 3, 1, 1),
('2021-10-05 08:30:00', '2021-10-05 11:00:00', '02:30:00', 'Lorem ipsum dolor sit amet.', 1, 1, 1),
('2021-10-10 09:15:00', '2021-10-10 11:25:00', '02:10:00', 'Consectetur adipiscing elit.', 1, 2, 1),
('2021-10-15 14:25:00', '2021-10-15 16:40:00', '02:15:00', 'Sed do eiusmod tempor.', 1, 1, 1),
('2021-11-05 08:10:00', '2021-11-05 10:40:00', '02:30:00', 'Incididunt ut labore.', 6, 2, 12),
('2021-11-10 09:00:00', '2021-11-10 11:30:00', '02:30:00', 'Dolore magna aliqua.', 8, 1, 1),
('2021-10-05 08:40:00', '2021-10-05 11:00:00', '02:20:00', 'Ut enim ad minim veniam.', 2, 2, 1),
('2021-10-10 09:05:00', '2021-10-10 11:20:00', '02:15:00', 'Quis nostrud exercitation.', 2, 1, 1),
('2021-10-15 15:30:00', '2021-10-15 17:45:00', '02:15:00', 'Ullamco laboris nisi.', 10, 2, 12),
('2021-11-05 07:50:00', '2021-11-05 10:10:00', '02:20:00', 'Aliquip ex ea commodo.', 2, 1, 1),
('2021-11-10 08:55:00', '2021-11-10 11:05:00', '02:10:00', 'Duis aute irure dolor.', 6, 2, 1),
('2021-10-05 08:55:00', '2021-10-05 11:20:00', '02:25:00', 'Reprehenderit in voluptate.', 3, 1, 1),
('2021-10-10 09:10:00', '2021-10-10 11:30:00', '02:20:00', 'Velit esse cillum dolore.', 3, 2, 12),
('2021-10-15 14:50:00', '2021-10-15 17:00:00', '02:10:00', 'Fugiat nulla pariatur.', 3, 1, 1),
('2021-11-05 08:00:00', '2021-11-05 10:30:00', '02:30:00', 'Excepteur sint occaecat.', 3, 2, 6),
('2021-11-10 09:20:00', '2021-11-10 11:30:00', '02:10:00', 'Cupidatat non proident.', 6, 1, 1),
('2021-12-05 08:40:00', '2021-12-05 11:10:00', '02:30:00', 'Lorem ipsum dolor sit amet.', 1, 1, 1),
('2021-12-10 09:25:00', '2021-12-10 11:35:00', '02:10:00', 'Consectetur adipiscing elit.', 1, 2, 6),
('2021-12-15 14:35:00', '2021-12-15 16:50:00', '02:15:00', 'Sed do eiusmod tempor.', 1, 1, 1),
('2021-12-05 08:55:00', '2021-12-05 11:25:00', '02:30:00', 'Incididunt ut labore.', 6, 2, 1),
('2021-12-10 09:10:00', '2021-12-10 11:30:00', '02:20:00', 'Dolore magna aliqua.', 8, 1, 1),
('2021-12-05 08:30:00', '2021-12-05 11:00:00', '02:30:00', 'Ut enim ad minim veniam.', 2, 2, 1),
('2021-12-10 08:50:00', '2021-12-10 11:10:00', '02:20:00', 'Quis nostrud exercitation.', 2, 1, 1),
('2021-12-15 15:20:00', '2021-12-15 17:40:00', '02:20:00', 'Ullamco laboris nisi.', 2, 2, 1),
('2021-12-05 07:40:00', '2021-12-05 10:00:00', '02:20:00', 'Aliquip ex ea commodo.', 2, 1, 6),
('2021-12-10 09:05:00', '2021-12-10 11:25:00', '02:20:00', 'Duis aute irure dolor.', 2, 2, 1),
('2021-12-05 08:45:00', '2021-12-05 11:05:00', '02:20:00', 'Reprehenderit in voluptate.', 10, 1, 1),
('2021-12-10 09:00:00', '2021-12-10 11:20:00', '02:20:00', 'Velit esse cillum dolore.', 3, 2, 12),
('2021-12-15 14:55:00', '2021-12-15 17:05:00', '02:10:00', 'Fugiat nulla pariatur.', 7, 1, 1),
('2021-12-05 08:20:00', '2021-12-05 10:50:00', '02:30:00', 'Excepteur sint occaecat.', 3, 2, 6),
('2021-12-10 09:15:00', '2021-12-10 11:35:00', '02:20:00', 'Cupidatat non proident.', 8, 1, 1);
