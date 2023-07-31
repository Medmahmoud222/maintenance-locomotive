-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2023 at 10:36 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `snim`
--

-- --------------------------------------------------------

--
-- Table structure for table `locomotive`
--

CREATE TABLE `locomotive` (
  `id` int(11) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `parcour_total` varchar(255) NOT NULL,
  `parcour_apres_derniere_visite_vr` varchar(255) NOT NULL,
  `parcour_apres_derniere_visite_vc` varchar(255) NOT NULL,
  `date_derniere_vc` date NOT NULL,
  `date_derniere_vr` date NOT NULL,
  `date_dernier_changement_fs` date NOT NULL,
  `date_dernier_changement_fi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `locomotive`
--

INSERT INTO `locomotive` (`id`, `numero`, `type`, `parcour_total`, `parcour_apres_derniere_visite_vr`, `parcour_apres_derniere_visite_vc`, `date_derniere_vc`, `date_derniere_vr`, `date_dernier_changement_fs`, `date_dernier_changement_fi`) VALUES
(1, '100', 'Type1', '8150', '1350', '1350', '2023-07-23', '2023-07-23', '2023-07-23', '2023-07-23'),
(2, '101', 'type2', '2700', '1350', '1350', '2023-07-24', '2023-07-24', '2023-07-24', '2023-07-24');

-- --------------------------------------------------------

--
-- Table structure for table `prametres`
--

CREATE TABLE `prametres` (
  `VR` varchar(255) NOT NULL,
  `VC` varchar(255) NOT NULL,
  `FS` varchar(255) NOT NULL,
  `FI` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prametres`
--

INSERT INTO `prametres` (`VR`, `VC`, `FS`, `FI`) VALUES
('15000KM', '3000KM', '3Mois', '2ans');

-- --------------------------------------------------------

--
-- Table structure for table `train`
--

CREATE TABLE `train` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `distance` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `train`
--

INSERT INTO `train` (`id`, `nom`, `numero`, `date`, `distance`) VALUES
(1, 'train44', '100', '2023-07-24', '1350'),
(2, 'Train1', '101', '2023-07-24', '1350'),
(3, 'Train3', '100', '2023-07-24', '1350'),
(4, 'Train1', '100', '2023-07-24', '1350'),
(5, 'Train1', '100', '2023-07-24', '1350'),
(6, 'Train1', '100', '2023-07-24', '1350'),
(7, 'Train1', '100', '2023-07-25', '1350');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locomotive`
--
ALTER TABLE `locomotive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `train`
--
ALTER TABLE `train`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locomotive`
--
ALTER TABLE `locomotive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `train`
--
ALTER TABLE `train`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
