-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 12, 2021 at 12:01 PM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Store`
--
CREATE DATABASE IF NOT EXISTS `Store` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `Store`;

-- --------------------------------------------------------

--
-- Table structure for table `Addresses`
--

DROP TABLE IF EXISTS `Addresses`;
CREATE TABLE `Addresses` (
  `aid` int NOT NULL,
  `uid` int NOT NULL,
  `address` varchar(255) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zipcode` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `CartItems`
--

DROP TABLE IF EXISTS `CartItems`;
CREATE TABLE `CartItems` (
  `cpid` int NOT NULL,
  `cid` int NOT NULL,
  `size` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Carts`
--

DROP TABLE IF EXISTS `Carts`;
CREATE TABLE `Carts` (
  `cid` int NOT NULL,
  `uid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `OrderItems`
--

DROP TABLE IF EXISTS `OrderItems`;
CREATE TABLE `OrderItems` (
  `opid` int NOT NULL,
  `oid` int NOT NULL,
  `size` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

DROP TABLE IF EXISTS `Orders`;
CREATE TABLE `Orders` (
  `oid` int NOT NULL,
  `uid` int NOT NULL,
  `pname` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `shippingAddr` varchar(255) NOT NULL,
  `pimage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

DROP TABLE IF EXISTS `Products`;
CREATE TABLE `Products` (
  `pid` int NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pdescription` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `pgender` enum('Men','Women') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ptype` enum('Running','Basketball','Skateboard') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pimage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`pid`, `pname`, `pdescription`, `price`, `pgender`, `ptype`, `pimage`) VALUES
(42, 'Nike SB Nyjah Free 2', 'Skate Shoes', 95, 'Men', 'Skateboard', 'sb-nyjah-free-2-skate-shoes-s4Kt9q.png'),
(43, 'Nike SB Zoom Blazer Mid Premium', 'Skate Shoes', 105, 'Men', 'Skateboard', 'sb-zoom-blazer-mid-premium-skate-shoes-Gw3b1K.png'),
(44, 'Nike SB Zoom Blazer Mid', 'Skate Shoes', 85, 'Men', 'Skateboard', 'sb-zoom-blazer-mid-skate-shoes-qX3MZV.png'),
(45, 'Nike SB Chron 2 Canvas', 'Skate Shoes', 60, 'Men', 'Skateboard', 'sb-chron-2-canvas-skate-shoes-VmcNLG.png'),
(46, 'Nike SB Chron 2', 'Skate Shoes', 70, 'Men', 'Skateboard', 'sb-chron-2-skate-shoes-71Mh0H.png'),
(47, 'Zoom Freak 3', 'Basketball Shoes', 120, 'Men', 'Basketball', 'zoom-freak-3-basketball-shoes-QXBvM0.png'),
(48, 'Zoom Freak 3 (Team)', 'Basketball Shoe', 120, 'Men', 'Basketball', 'zoom-freak-3-team-basketball-shoe-9FVl5X.png'),
(49, 'Giannis Immortality \"Force Field\"', 'Basketball Shoe', 80, 'Men', 'Basketball', 'giannis-immortality-force-field-basketball-shoe-p9QlJF.png'),
(50, 'PG 5', 'Basketball Shoes', 110, 'Men', 'Basketball', 'pg-5-basketball-shoes-9zqWmn.png'),
(51, 'Kyrie 7', 'Basketball Shoes', 130, 'Men', 'Basketball', 'kyrie-7-basketball-shoes-nNMZ3b.png'),
(57, 'Nike Air Zoom Pegasus 38 A.I.R. Nathan Bell', 'Road Running Shoes', 130, 'Men', 'Running', 'air-zoom-pegasus-38-air-nathan-bell-road-running-shoes-7TndMG.png'),
(58, 'Nike Air Zoom Pegasus 38', 'Men\'s Running Shoes', 120, 'Men', 'Running', 'air-zoom-pegasus-38-mens-running-shoes-lq7PZZ.png'),
(59, 'Nike ZoomX Vaporfly Next% 2', 'Men\'s Road Racing Shoes', 250, 'Men', 'Running', 'zoomx-vaporfly-next-2-mens-road-racing-shoes-glWqfm.png'),
(60, 'Nike Zoom Alphafly Next Nature', 'Road Racing Shoes', 300, 'Men', 'Running', 'zoom-alphafly-next-nature-road-racing-shoes-WnMHmS.png'),
(61, 'Nike ZoomX Invincible Run Flyknit', 'Men\'s Road Running Shoes', 180, 'Men', 'Running', 'zoomx-invincible-run-flyknit-mens-road-running-shoes-sP2zk7.png'),
(62, 'Nike ZoomX Invincible Run Flyknit', 'Women\'s Road Running Shoes', 180, 'Women', 'Running', 'zoomx-invincible-run-flyknit-womens-road-running-shoes-kVqSJ8.png'),
(63, 'Nike React Infinity Run Flyknit 2', 'Women\'s Road Running Shoes', 160, 'Women', 'Running', 'react-infinity-run-flyknit-2-womens-road-running-shoes-rfh6Z8.png'),
(64, 'Nike Air Zoom Pegasus 38', 'Women\'s Road Running Shoes', 120, 'Women', 'Running', 'air-zoom-pegasus-38-womens-road-running-shoes-gg8GBK.png'),
(65, 'Nike React Escape Run', 'Women\'s Road Running Shoes', 100, 'Women', 'Running', 'react-escape-run-womens-road-running-shoes-LP3Msz.png'),
(66, 'Nike React Infinity Run Flyknit 2', 'Women\'s Road Running Shoes', 160, 'Women', 'Running', 'react-infinity-run-flyknit-2-womens-road-running-shoes-xkC78v.png'),
(67, 'Giannis Immortality \"Force Field\"', 'Basketball Shoe', 80, 'Women', 'Basketball', 'giannis-immortality-force-field-basketball-shoe-p9QlJF.png'),
(68, 'Zoom Freak 3', 'Basketball Shoes', 120, 'Women', 'Basketball', 'zoom-freak-3-basketball-shoes-QXBvM0.png'),
(69, 'Zoom Freak 3 (Team)', 'Basketball Shoe', 120, 'Women', 'Basketball', 'zoom-freak-3-team-basketball-shoe-9FVl5X.png'),
(70, 'Kyrie Low 4', 'Basketball Shoes', 110, 'Women', 'Basketball', 'kyrie-low-4-basketball-shoes-zwSncK.png'),
(71, 'Kyrie 7', 'Basketball Shoes', 130, 'Women', 'Basketball', 'kyrie-7-basketball-shoes-nNMZ3b.png'),
(72, 'Nike SB Nyjah Free 2', 'Skate Shoes', 95, 'Women', 'Skateboard', 'sb-nyjah-free-2-skate-shoes-s4Kt9q.png'),
(73, 'Nike SB Zoom Blazer Mid Premium', 'Skate Shoes', 105, 'Women', 'Skateboard', 'sb-zoom-blazer-mid-premium-skate-shoes-Gw3b1K.png'),
(74, 'Nike SB Zoom Blazer Mid', 'Skate Shoes', 85, 'Women', 'Skateboard', 'sb-zoom-blazer-mid-skate-shoes-qX3MZV.png'),
(75, 'Nike SB Chron 2 Canvas', 'Skate Shoes', 60, 'Women', 'Skateboard', 'sb-chron-2-canvas-skate-shoes-VmcNLG.png'),
(76, 'Nike SB Chron 2', 'Skate Shoes', 70, 'Women', 'Skateboard', 'sb-chron-2-skate-shoes-71Mh0H.png');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
CREATE TABLE `Users` (
  `uid` int NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`uid`, `firstName`, `lastName`, `email`, `password`) VALUES
(2, 'Hunter', 'Wilkins', 'test@gmail.com', '$2y$10$DOQHmWruTg8SsfxKH8.Mt.7E1.1oHMPv6/PFdqzhmuoEqqhN5inma');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Addresses`
--
ALTER TABLE `Addresses`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `CartItems`
--
ALTER TABLE `CartItems`
  ADD PRIMARY KEY (`cpid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `Carts`
--
ALTER TABLE `Carts`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `OrderItems`
--
ALTER TABLE `OrderItems`
  ADD PRIMARY KEY (`opid`),
  ADD KEY `oid` (`oid`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `aid` (`shippingAddr`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Addresses`
--
ALTER TABLE `Addresses`
  MODIFY `aid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `CartItems`
--
ALTER TABLE `CartItems`
  MODIFY `cpid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Carts`
--
ALTER TABLE `Carts`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `OrderItems`
--
ALTER TABLE `OrderItems`
  MODIFY `opid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `oid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `pid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
