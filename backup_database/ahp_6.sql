-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2022 at 04:44 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ahp_6`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternative`
--

CREATE TABLE `alternative` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alternative`
--

INSERT INTO `alternative` (`id`, `name`) VALUES
(19, 'Car A'),
(20, 'Car B'),
(21, 'Car C');

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE `criteria` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`id`, `name`) VALUES
(28, 'Price'),
(29, 'MPG'),
(30, 'Style'),
(31, 'Comfort');

-- --------------------------------------------------------

--
-- Table structure for table `pv_alternative`
--

CREATE TABLE `pv_alternative` (
  `id` int(11) NOT NULL,
  `id_alternative` int(11) NOT NULL,
  `id_criteria` int(11) NOT NULL,
  `score` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pv_alternative`
--

INSERT INTO `pv_alternative` (`id`, `id_alternative`, `id_criteria`, `score`) VALUES
(40, 19, 28, 0.122619),
(41, 20, 28, 0.320238),
(42, 21, 28, 0.557143),
(43, 19, 29, 0.086948),
(44, 20, 29, 0.273718),
(45, 21, 29, 0.639334),
(46, 19, 30, 0.264811),
(47, 20, 30, 0.655545),
(48, 21, 30, 0.0796437),
(49, 19, 31, 0.593432),
(50, 20, 31, 0.341161),
(51, 21, 31, 0.0654071);

-- --------------------------------------------------------

--
-- Table structure for table `pv_criteria`
--

CREATE TABLE `pv_criteria` (
  `id_criteria` int(11) NOT NULL,
  `score` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pv_criteria`
--

INSERT INTO `pv_criteria` (`id_criteria`, `score`) VALUES
(28, 0.398214),
(29, 0.085119),
(30, 0.29881),
(31, 0.217857);

-- --------------------------------------------------------

--
-- Table structure for table `ranking`
--

CREATE TABLE `ranking` (
  `id_alternative` int(11) NOT NULL,
  `score` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ranking`
--

INSERT INTO `ranking` (`id_alternative`, `score`) VALUES
(19, 0.264641),
(20, 0.42103),
(21, 0.314329);

-- --------------------------------------------------------

--
-- Table structure for table `ratio_alternative`
--

CREATE TABLE `ratio_alternative` (
  `id` int(11) NOT NULL,
  `alternative1` int(11) NOT NULL,
  `alternative2` int(11) NOT NULL,
  `comparison` int(11) NOT NULL,
  `score` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratio_alternative`
--

INSERT INTO `ratio_alternative` (`id`, `alternative1`, `alternative2`, `comparison`, `score`) VALUES
(16, 19, 20, 28, 0.333333),
(17, 19, 21, 28, 0.25),
(18, 20, 21, 28, 0.5),
(19, 19, 20, 29, 0.25),
(20, 19, 21, 29, 0.166667),
(21, 20, 21, 29, 0.333333),
(22, 19, 20, 30, 0.333333),
(23, 19, 21, 30, 4),
(24, 20, 21, 30, 7),
(25, 19, 20, 31, 2),
(26, 19, 21, 31, 8),
(27, 20, 21, 31, 6);

-- --------------------------------------------------------

--
-- Table structure for table `ratio_criteria`
--

CREATE TABLE `ratio_criteria` (
  `id` int(11) NOT NULL,
  `criteria1` int(11) NOT NULL,
  `criteria2` int(11) NOT NULL,
  `score` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratio_criteria`
--

INSERT INTO `ratio_criteria` (`id`, `criteria1`, `criteria2`, `score`) VALUES
(7, 28, 29, 3),
(8, 28, 30, 2),
(9, 28, 31, 2),
(10, 29, 30, 0.25),
(11, 29, 31, 0.25),
(12, 30, 31, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ri`
--

CREATE TABLE `ri` (
  `total` int(11) NOT NULL,
  `score` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ri`
--

INSERT INTO `ri` (`total`, `score`) VALUES
(1, 0),
(2, 0),
(3, 0.58),
(4, 0.9),
(5, 1.12),
(6, 1.24),
(7, 1.32),
(8, 1.41),
(9, 1.45),
(10, 1.49),
(11, 1.51),
(12, 1.48),
(13, 1.56),
(14, 1.57),
(15, 1.59);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternative`
--
ALTER TABLE `alternative`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pv_alternative`
--
ALTER TABLE `pv_alternative`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pv_criteria`
--
ALTER TABLE `pv_criteria`
  ADD PRIMARY KEY (`id_criteria`);

--
-- Indexes for table `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`id_alternative`);

--
-- Indexes for table `ratio_alternative`
--
ALTER TABLE `ratio_alternative`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratio_criteria`
--
ALTER TABLE `ratio_criteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ri`
--
ALTER TABLE `ri`
  ADD PRIMARY KEY (`total`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternative`
--
ALTER TABLE `alternative`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `criteria`
--
ALTER TABLE `criteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `pv_alternative`
--
ALTER TABLE `pv_alternative`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `ratio_alternative`
--
ALTER TABLE `ratio_alternative`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `ratio_criteria`
--
ALTER TABLE `ratio_criteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
