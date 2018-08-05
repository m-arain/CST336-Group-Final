-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 05, 2018 at 11:49 PM
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
('Da authority', 'admin', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 1);

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
(15, 'D Claws', 'sadsad', '987.00', '1'),
(16, 'D Claws', 'asdsad', '654.00', '1');

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
(5, 1, 1, 15, 1337),
(7, 1, 1, 15, 12),
(8, 1, 1, 15, 12),
(9, 1, 1, 15, 12),
(10, 2, 1, 15, 1),
(11, 2, 1, 15, 1),
(12, 3, 1, 15, 1337),
(13, 4, 1, 15, 1),
(14, 5, 1, 15, 2),
(15, 6, 1, 15, 12),
(16, 7, 1, 16, 1),
(17, 8, 1, 16, 1),
(18, 9, 1, 15, 1),
(19, 10, 1, 16, 1),
(20, 11, 1, 16, 1),
(21, 12, 1, 16, 1),
(22, 13, 1, 15, 2);

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
(1, 'Chris Andaya', 14, 'candaya', '5bae372e69f5293eda5b478a2663f5330fe41631'),
(6, 'user_1', 1, 'User 1', '25ab86bed149ca6ca9c1c0d5db7c9a91388ddeab');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `purchaseHistory`
--
ALTER TABLE `purchaseHistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
