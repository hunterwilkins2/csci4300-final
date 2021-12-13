-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 13, 2021 at 11:50 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `aid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zipcode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cartitems`
--

CREATE TABLE `cartitems` (
  `cpid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `size` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `opid` int(11) NOT NULL,
  `oid` int(11) NOT NULL,
  `size` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `oid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `shippingAddr` varchar(255) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`oid`, `uid`, `shippingAddr`, `size`, `pid`) VALUES
(1, 2, '1000 Nowhere Rd, Athens GA 30606', '11', 42);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pdescription` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `pgender` enum('Men','Women') NOT NULL,
  `ptype` enum('Running','Basketball','Skateboard') NOT NULL,
  `pimage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pname`, `pdescription`, `price`, `pgender`, `ptype`, `pimage`) VALUES
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `firstName`, `lastName`, `email`, `password`) VALUES
(2, 'Hunter', 'Wilkins', 'test@gmail.com', '$2y$10$DOQHmWruTg8SsfxKH8.Mt.7E1.1oHMPv6/PFdqzhmuoEqqhN5inma');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `cartitems`
--
ALTER TABLE `cartitems`
  ADD PRIMARY KEY (`cpid`),
  ADD KEY `cid` (`uid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`opid`),
  ADD KEY `oid` (`oid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `aid` (`shippingAddr`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cartitems`
--
ALTER TABLE `cartitems`
  MODIFY `cpid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `opid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
