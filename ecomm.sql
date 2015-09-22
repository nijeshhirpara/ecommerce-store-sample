-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2015 at 12:41 PM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecomm`
--
CREATE DATABASE IF NOT EXISTS `ecomm` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ecomm`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `CatId` int(11) NOT NULL,
  `Category` varchar(200) NOT NULL,
  `CategoryLevel` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CatId`, `Category`, `CategoryLevel`) VALUES
(1, 'Audio', 0),
(2, 'Cameras', 0),
(3, 'Computers and Tablets', 0),
(4, 'WhiteGoods', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `Id` int(11) NOT NULL,
  `ProductID` varchar(3) DEFAULT NULL,
  `CatID` varchar(50) NOT NULL,
  `Category` varchar(21) DEFAULT NULL,
  `Product Name` varchar(24) DEFAULT NULL,
  `Price` int(4) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Id`, `ProductID`, `CatID`, `Category`, `Product Name`, `Price`) VALUES
(1, 'C1', '2', 'Cameras', 'Sony NEX6', 1199),
(2, 'C2', '2', 'Cameras', 'Canon 7D', 2999),
(3, 'C3', '2', 'Cameras', 'Canon EOS 1100D', 418),
(4, 'W1', '4', 'WhiteGoods', 'LG Fridge', 670),
(5, 'W2', '4', 'WhiteGoods', 'Breville Toaster', 99),
(6, 'A1', '1', 'Audio', 'Sony Speakers', 499),
(7, 'A2', '1', 'Audio', 'Sennheiser Headphones', 299),
(8, 'A3', '1', 'Audio', 'Bose QC15 Headphones', 329),
(9, 'CT1', '3', 'Computers and Tablets', 'Apple iPad Air', 599),
(10, 'CT2', '3', 'Computers and Tablets', 'Apple Macbook Pro', 1899),
(11, 'CT3', '3', 'Computers and Tablets', 'Toshiba Laptop', 1399),
(12, 'CT4', '3', 'Computers and Tablets', 'Apple iPad Mini', 499),
(13, 'CT5', '3', 'Computers and Tablets', 'Apple Mac Pro', 2999),
(14, 'CT6', '3', 'Computers and Tablets', 'Samsung Galaxy Tab', 699),
(15, 'CT7', '3', 'Computers and Tablets', 'Asus Sub-notebook', 498),
(16, 'CT8', '3', 'Computers and Tablets', 'Brother Laser Printer', 399),
(17, 'CT9', '3', 'Computers and Tablets', 'Seagate External HDD 1TB', 129);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CatId`),
  ADD UNIQUE KEY `Category` (`Category`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `ProductID` (`ProductID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CatId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
