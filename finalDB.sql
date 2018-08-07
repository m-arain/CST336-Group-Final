-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 07, 2018 at 02:37 AM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `name` varchar(40) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `username`, `password`, `id`) VALUES
('', 'admin', '25ab86bed149ca6ca9c1c0d5db7c9a91388ddeab', 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `All_Users_Cart_Total`
-- (See below for the actual view)
--
CREATE TABLE `All_Users_Cart_Total` (
`username` varchar(20)
,`total` decimal(27,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `username` int(11) DEFAULT NULL,
  `product` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `category` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `category`) VALUES
(17, 'HP Pavilion 21.5-Inc', 'It\'s time for a monitor that\'s worthy of your family\'s content. When you\'re looking for the best spe', '89.99', '1.2'),
(18, 'HP Pavillion', 'The best money can buy', '89.99', '1.4'),
(19, 'Samsung Tv', 'Watch tv like a sheep', '189.99', '1.3'),
(20, 'ASUS Screen', 'The best money can buy', '29.99', '1.2'),
(21, 'LG Phone', 'The best money can buy', '39.99', '2.2'),
(22, 'EVGA 500', 'Buy this, you wont regret it.', '49.99', '1.6'),
(23, 'EVGA 9000', 'The best product to pay for', '59.99', '1.2'),
(24, 'EVGA Basic', 'The best money can buy', '69.99', '1.2'),
(25, 'RoseWill Microphone', 'The best money can buy', '79.99', '1.1'),
(26, 'Thermaltake', 'The best money can buy', '89.99', '1.2'),
(27, 'Coller Master 5000', 'The best money can buy', '79.99', '1.2'),
(28, 'Cooler Master Two', 'Keep it cool', '289.99', '1.3'),
(29, 'GIGABITE Huge', 'Real Big storage', '489.99', '1.7'),
(30, 'MSI GAMING', 'Gamer Keyboard, super load and annoying', '123.99', '1.7'),
(31, 'AMD sucker', 'Like taking candy from a baby.', '45.99', '1.6'),
(32, 'INTEL PRO i7', 'Super pro, make you pro. Buy and become Pro', '234.99', '1.5'),
(33, '1337 Guide to Life', 'The best money can buy', '23.99', '1.4'),
(34, 'Redragon regarding D', 'The best money can buy', '765.99', '2.2'),
(35, 'Redragon: Return of ', 'The best money can buy', '876.99', '2.2'),
(36, 'Apple iPhone 21', 'The newest and bestest', '67.99', '2.2'),
(37, 'AGS', 'Made by Armadyl Himself', '24.99', '2.0'),
(38, 'HP Envy', 'Laptop', '999.00', '1.7'),
(39, 'Dragon Claws', 'Best spec weapon in all of OSRS!', '86.94', '1.3');

-- --------------------------------------------------------

--
-- Stand-in structure for view `Product_Pice_Average`
-- (See below for the actual view)
--
CREATE TABLE `Product_Pice_Average` (
`category` varchar(15)
,`Number of Products` bigint(21)
,`AVG Price` decimal(9,6)
);

-- --------------------------------------------------------

--
-- Table structure for table `purchaseHistory`
--

CREATE TABLE `purchaseHistory` (
  `id` int(11) NOT NULL,
  `invoice` int(11) NOT NULL,
  `username` int(11) DEFAULT NULL,
  `product` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchaseHistory`
--

INSERT INTO `purchaseHistory` (`id`, `invoice`, `username`, `product`, `quantity`) VALUES
(27, 1, 7, 37, 4);

-- --------------------------------------------------------

--
-- Stand-in structure for view `Purchase_History`
-- (See below for the actual view)
--
CREATE TABLE `Purchase_History` (
`phId` int(11)
,`invoice` int(11)
,`username` varchar(20)
,`name` varchar(20)
,`quantity` int(11)
,`subtotal` decimal(15,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `invoice` int(11) DEFAULT '0',
  `username` varchar(20) NOT NULL,
  `password` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `invoice`, `username`, `password`) VALUES
(1, 'Chris Andaya', 17, 'candaya', '5bae372e69f5293eda5b478a2663f5330fe41631'),
(7, 'default user', 2, 'user_1', '25ab86bed149ca6ca9c1c0d5db7c9a91388ddeab');

-- --------------------------------------------------------

--
-- Structure for view `All_Users_Cart_Total`
--
DROP TABLE IF EXISTS `All_Users_Cart_Total`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `All_Users_Cart_Total`  AS  select `u`.`username` AS `username`,sum(`p`.`price`) AS `total` from ((`cart` `c` join `product` `p` on((`p`.`id` = `c`.`product`))) join `users` `u` on((`c`.`username` = `u`.`id`))) group by `c`.`username` ;

-- --------------------------------------------------------

--
-- Structure for view `Product_Pice_Average`
--
DROP TABLE IF EXISTS `Product_Pice_Average`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Product_Pice_Average`  AS  select `product`.`category` AS `category`,count(1) AS `Number of Products`,avg(`product`.`price`) AS `AVG Price` from `product` group by `product`.`category` ;

-- --------------------------------------------------------

--
-- Structure for view `Purchase_History`
--
DROP TABLE IF EXISTS `Purchase_History`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Purchase_History`  AS  select `ph`.`id` AS `phId`,`ph`.`invoice` AS `invoice`,`u`.`username` AS `username`,`p`.`name` AS `name`,`ph`.`quantity` AS `quantity`,(`ph`.`quantity` * `p`.`price`) AS `subtotal` from ((`purchaseHistory` `ph` join `users` `u` on((`u`.`id` = `ph`.`username`))) join `product` `p` on((`p`.`id` = `ph`.`product`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `product` (`product`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseHistory`
--
ALTER TABLE `purchaseHistory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `product` (`product`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `purchaseHistory`
--
ALTER TABLE `purchaseHistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchaseHistory`
--
ALTER TABLE `purchaseHistory`
  ADD CONSTRAINT `purchaseHistory_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchaseHistory_ibfk_2` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
