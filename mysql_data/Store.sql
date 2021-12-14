SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `Store` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `Store`;

DROP TABLE IF EXISTS `cartitems`;
CREATE TABLE `cartitems` (
  `cpid` int NOT NULL,
  `uid` int NOT NULL,
  `pid` int NOT NULL,
  `size` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `cartitems` (`cpid`, `uid`, `pid`, `size`) VALUES
(13, 2, 57, 13.5),
(14, 2, 68, 14.5);

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `oid` int NOT NULL,
  `uid` int NOT NULL,
  `shippingAddr` varchar(255) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `pid` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `orders` (`oid`, `uid`, `shippingAddr`, `size`, `pid`) VALUES
(3, 2, '123 Apple St, GA 30605', '7', 67),
(4, 2, '123 Apple St, GA 30605', '13', 61),
(6, 2, '642 Baker Mayfield, OK 73008', '6.5', 42);

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `pid` int NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pdescription` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `pgender` enum('Men','Women') NOT NULL,
  `ptype` enum('Running','Basketball','Skateboard') NOT NULL,
  `pimage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `uid` int NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`uid`, `firstName`, `lastName`, `email`, `password`) VALUES
(2, 'Hunter', 'Wilkins', 'test@gmail.com', '$2y$10$mQwQTJqYfsDMEhRkWe9gd.YYQyRdZNtPsiG1i6sJtDIppsNtcsQdS');


ALTER TABLE `cartitems`
  ADD PRIMARY KEY (`cpid`),
  ADD KEY `cid` (`uid`),
  ADD KEY `uid` (`uid`);

ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `aid` (`shippingAddr`);

ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);


ALTER TABLE `cartitems`
  MODIFY `cpid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

ALTER TABLE `orders`
  MODIFY `oid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `products`
  MODIFY `pid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

ALTER TABLE `users`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
