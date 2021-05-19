-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2021 at 09:20 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodshala`
--

-- --------------------------------------------------------

--
-- Table structure for table `additem`
--

CREATE TABLE `additem` (
  `id` int(11) NOT NULL,
  `iname` varchar(100) NOT NULL,
  `iprice` int(5) NOT NULL,
  `itype` char(1) NOT NULL,
  `ipic` varchar(500) NOT NULL,
  `owner` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `additem`
--

INSERT INTO `additem` (`id`, `iname`, `iprice`, `itype`, `ipic`, `owner`) VALUES
(35, 'Samosa', 25, 'v', 'samosa-recipe-500x500.jpg', 'dhaba@food.com'),
(36, 'Rasgulla', 15, 'v', 'rasgulla-indian-dessert-1957839-hero-01-7c3528a2d34a4f1b9248c7483a73d0a6.jpg', 'dhaba@food.com'),
(37, 'pulao', 120, 'v', 'pulao-recipe-500x500.jpg', 'dhaba@food.com'),
(38, 'Butter Paneer', 150, 'v', 'paneer-butter-masala-recipe-2.jpg', 'dhaba@food.com'),
(39, 'Naan Bread', 45, 'v', 'naan-recipe-2.jpg', 'dhaba@food.com'),
(40, 'Dhokla', 30, 'v', 'instant-dhokla-709x900.jpg', 'khana@khazana.com'),
(41, 'Hakka Noodles', 100, 'v', 'Hakka-Noodles-1.jpg', 'khana@khazana.com'),
(42, 'Gulab Jamun', 20, 'v', 'gulab-jamun-recipe.jpg', 'khana@khazana.com'),
(43, 'Fish Curry', 150, 'n', 'fish-curry-recipe-1.jpg', 'khana@khazana.com'),
(45, 'Dosa', 65, 'v', 'Dosa-recipe-plain-sada-dosa-Piping-Pot-Curry.jpg', 'khana@khazana.com'),
(46, 'Dahi Vada', 40, 'v', 'dahi-vada-recipe.jpg', 'foodie@kitchen.com'),
(47, 'Chicken Roll', 45, 'n', 'chickenroll.jpg', 'foodie@kitchen.com'),
(48, 'Chicken Biryani', 180, 'n', 'chicken-biryani-recipe-720x405.jpg', 'foodie@kitchen.com'),
(49, 'Butter Chicken', 200, 'n', 'butter-chicken-500x500.jpg', 'foodie@kitchen.com'),
(50, 'Lasagna', 220, 'n', '180820-bookazine-delish-01280-1536610916.jpg', 'foodie@kitchen.com');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `foodid` int(10) NOT NULL,
  `buyer` varchar(100) NOT NULL,
  `seller` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `confirmorder`
--

CREATE TABLE `confirmorder` (
  `id` int(11) NOT NULL,
  `foodid` int(10) NOT NULL,
  `buyer` varchar(100) NOT NULL,
  `seller` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `confirmorder`
--

INSERT INTO `confirmorder` (`id`, `foodid`, `buyer`, `seller`, `date`) VALUES
(23, 42, 'sourav@gmail.com', 'khana@khazana.com', '19/05/21'),
(24, 50, 'sourav@gmail.com', 'foodie@kitchen.com', '19/05/21'),
(25, 38, 'sourav@gmail.com', 'dhaba@food.com', '19/05/21'),
(26, 42, 'sourav@gmail.com', 'khana@khazana.com', '19/05/21'),
(27, 48, 'john@doe.com', 'foodie@kitchen.com', '19/05/21'),
(28, 43, 'john@doe.com', 'khana@khazana.com', '19/05/21'),
(29, 47, 'john@doe.com', 'foodie@kitchen.com', '19/05/21'),
(30, 35, 'mohan@gmail.com', 'dhaba@food.com', '19/05/21'),
(31, 36, 'mohan@gmail.com', 'dhaba@food.com', '19/05/21'),
(32, 39, 'mohan@gmail.com', 'dhaba@food.com', '19/05/21'),
(33, 38, 'mohan@gmail.com', 'dhaba@food.com', '19/05/21'),
(34, 45, 'mohan@gmail.com', 'khana@khazana.com', '19/05/21'),
(35, 40, 'mohan@gmail.com', 'khana@khazana.com', '19/05/21'),
(36, 46, 'mohan@gmail.com', 'foodie@kitchen.com', '19/05/21'),
(37, 35, 'mohan@gmail.com', 'dhaba@food.com', '20/05/21'),
(38, 37, 'mohan@gmail.com', 'dhaba@food.com', '20/05/21'),
(39, 48, 'john@doe.com', 'foodie@kitchen.com', '20/05/21'),
(40, 47, 'john@doe.com', 'foodie@kitchen.com', '20/05/21'),
(41, 49, 'john@doe.com', 'foodie@kitchen.com', '20/05/21'),
(42, 50, 'john@doe.com', 'foodie@kitchen.com', '20/05/21');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` bigint(10) NOT NULL,
  `address` text NOT NULL,
  `preference` char(1) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `contact`, `address`, `preference`, `password`) VALUES
(3, 'Sourav', 'sourav@gmail.com', 9876543220, 'Jamshedpur', 'b', '7c222fb2927d828af22f592134e8932480637c0d'),
(4, 'John Doe', 'john@doe.com', 9845183449, 'Sector 2, Noida', 'n', '7c222fb2927d828af22f592134e8932480637c0d'),
(5, 'Mohan Kumar', 'mohan@gmail.com', 9876543222, 'Yemen road, yemen', 'v', '7c222fb2927d828af22f592134e8932480637c0d');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `resName` varchar(100) NOT NULL,
  `resLocation` varchar(200) NOT NULL,
  `resContact` bigint(10) NOT NULL,
  `resEmail` varchar(100) NOT NULL,
  `resPass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `resName`, `resLocation`, `resContact`, `resEmail`, `resPass`) VALUES
(8, 'Dhaba Food', 'Bistupur', 9945128975, 'dhaba@food.com', '7c222fb2927d828af22f592134e8932480637c0d'),
(9, 'Khana Khazana', 'Kadma', 9898989876, 'khana@khazana.com', '7c222fb2927d828af22f592134e8932480637c0d'),
(10, 'Foodies Kitchen', 'Sakchi', 9308662948, 'foodie@kitchen.com', '7c222fb2927d828af22f592134e8932480637c0d');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additem`
--
ALTER TABLE `additem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `confirmorder`
--
ALTER TABLE `confirmorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `resEmail` (`resEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additem`
--
ALTER TABLE `additem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `confirmorder`
--
ALTER TABLE `confirmorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
