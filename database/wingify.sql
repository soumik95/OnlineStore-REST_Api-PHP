-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2017 at 08:59 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wingify`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productId` int(11) NOT NULL,
  `serial_no` varchar(100) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productPrice` float NOT NULL,
  `productInfo` text NOT NULL,
  `productCategory` varchar(50) NOT NULL,
  `productQuantity` int(11) NOT NULL,
  `seller` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `serial_no`, `productName`, `productPrice`, `productInfo`, `productCategory`, `productQuantity`, `seller`) VALUES
(5, 'c2kjv5a', 'MotoX Mobile', 19998, 'Smartphone', 'Electronics', 99, 'sellerA'),
(8, 'hg9k77gh5', 'Iphone 7s Plus', 49999, 'Smartphone', 'Electronics', 30, 'sellerB'),
(9, 'qv4p5t6y', 'Samsung QLED TV', 345550, '65', 'Electronics', 10, 'sellerA'),
(13, 'jd72i0n', 'Levis Jeans Men', 1999, 'Slim Fit size-32', 'Electronics', 88, 'sellerB'),
(20, 'pv1eqs34', 'Programming Book', 250, 'Dennis Ritchie', 'Electronics', 35, 'sellerA'),
(37, 'jb34tcq2', 'Supreme Chair', 1200, 'Fibre Chairs', 'Home', 300, 'sellerB'),
(45, 'b43qmv2', 'Puma Wallet', 799, 'Brown Men Wallet', 'Electronics', 80, 'sellerA'),
(51, 'gfgt232j', 'Whirlpool Refrigerator', 13999, '180L Fridge', 'Electronics', 89, 'sellerA'),
(54, 'jvm34rt5', 'Hitachi AC', 24000, '1.5 Ton 5star', 'Electronics', 21, 'sellerB');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `username`, `password`) VALUES
(1, 'customer', '1234'),
(2, 'admin ', '1234'),
(3, 'sellerA', '1234'),
(4, 'sellerB', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
