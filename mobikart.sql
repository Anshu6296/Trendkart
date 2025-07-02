-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2023 at 11:35 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Mobikart`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'anshu', '1234'),
(3, 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `bank_name` varchar(200) NOT NULL,
  `card_number` varchar(200) NOT NULL,
  `banking_name` varchar(200) NOT NULL,
  `expyear` year(4) NOT NULL,
  `expmonth` int(20) DEFAULT NULL,
  `cvv` varchar(200) NOT NULL,
  `balance` bigint(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bank_name`, `card_number`, `banking_name`, `expyear`, `expmonth`, `cvv`, `balance`) VALUES
('uco', '1234567890', 'Roni', 2022, 12, '123', 9999567000),
('state', '1234567800', 'Tuhin', 2024, 12, '123', 9999846499);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(89, 21, 14, 'realme 11 Pro 5G', 25999, 1, 'realme 11 Pro 5G.webp'),
(96, 22, 15, 'realme C55', 15999, 1, 'realme C55.webp'),
(97, 22, 13, 'Infinix Note 30 5G', 19999, 1, 'Infinix Note 30 5G.webp'),
(121, 1, 14, 'realme 11 Pro 5G', 25999, 1, 'realme 11 Pro 5G.webp'),
(123, 1, 13, 'Infinix Note 30 5G', 19999, 1, 'Infinix Note 30 5G.webp');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `delivery_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `delivery_status`) VALUES
(1, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CASH', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 2) - ', 51998, '2023-07-17', 'Order Cancelled'),
(2, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CASH', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'Infinix Note 30 5G (19999 x 1) - ', 19999, '2023-07-17', 'Order Cancelled'),
(51, 20, 'SURYA PRATIM MANNA', '9874125645', 'surya@gmail.com', 'CASH', 'KIRTTIBASPUR, TARAHAT, KAMARPUKUR, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) - realme C55 (15999 x 1) - ', 41998, '2023-07-17', 'Order Cancelled'),
(52, 20, 'SURYA PRATIM MANNA', '9874125645', 'surya@gmail.com', 'CASH', 'KIRTTIBASPUR, TARAHAT, KAMARPUKUR, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) - ', 25999, '2023-07-17', 'completed'),
(53, 20, 'SURYA PRATIM MANNA', '9874125645', 'surya@gmail.com', 'CARD', 'KIRTTIBASPUR, TARAHAT, KAMARPUKUR, Hooghly, Hooghly, West Bengal, India - 712612', 'realme C55 (15999 x 1) -', 15999, '2023-07-16', 'completed'),
(54, 20, 'SURYA PRATIM MANNA', '9874125645', 'surya@gmail.com', 'CASH', 'KIRTTIBASPUR, TARAHAT, KAMARPUKUR, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) - ', 25999, '2023-07-17', 'completed'),
(55, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'Infinix Note 30 5G (19999 x 1) - realme 11 Pro 5G (25999 x 1) -', 45998, '2023-07-17', 'Order Cancelled'),
(56, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'Infinix Note 30 5G (19999 x 1) -', 19999, '2023-07-17', 'Order Cancelled'),
(57, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CASH', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'Infinix Note 30 5G (19999 x 1) - ', 19999, '2023-07-18', 'Order Cancelled'),
(58, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CASH', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) - ', 25999, '2023-07-18', 'Order Cancelled'),
(59, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'Infinix Note 30 5G (19999 x 2) -', 39998, '2023-07-20', 'Order Cancelled'),
(60, 22, 'ANSHU MANDAL', '9593261392', 'anshumandal6296@gmail.com', 'CASH', 'KIRTTIBASPUR, TARAHAT, KAMARPUKUR, Hooghly, Hooghly, West Bengal, India - 712612', 'Infinix Note 30 5G (19999 x 1) - realme 11 Pro 5G (25999 x 1) - ', 45998, '2023-08-11', 'Order Cancelled'),
(61, 22, 'ANSHU MANDAL', '9593261392', 'anshumandal6296@gmail.com', 'CASH', 'KIRTTIBASPUR, TARAHAT, KAMARPUKUR, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 9) - ', 233991, '2023-08-11', 'pending'),
(62, 22, 'ANSHU MANDAL', '9593261392', 'anshumandal6296@gmail.com', 'CASH', 'KIRTTIBASPUR, TARAHAT, KAMARPUKUR, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) - ', 25999, '2023-08-11', 'pending'),
(63, 22, 'ANSHU MANDAL', '9593261392', 'anshumandal6296@gmail.com', 'CASH', 'KIRTTIBASPUR, TARAHAT, KAMARPUKUR, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) - ', 25999, '2023-08-11', 'pending'),
(70, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CASH', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'Infinix Note 30 5G (19999 x 1) - realme 11 Pro 5G (25999 x 1) - realme C55 (15999 x 1) - ', 61997, '2023-08-13', 'Order Cancelled'),
(71, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CASH', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) - ', 25999, '2023-08-13', 'Order Cancelled'),
(72, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'Infinix Note 30 5G (19999 x 1) -', 19999, '2023-08-13', 'Order Cancelled'),
(73, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CASH', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) - ', 25999, '2023-08-13', 'Order Cancelled'),
(74, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', '', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) - ', 25999, '2023-08-13', 'Order Cancelled'),
(75, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CASH', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) - ', 25999, '2023-08-13', 'Order Cancelled'),
(76, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CASH', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme C55 (15999 x 1) - ', 15999, '2023-08-13', 'Order Cancelled'),
(77, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CASH', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) - ', 25999, '2023-08-13', 'pending'),
(78, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CASH', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) - ', 25999, '2023-08-13', 'pending'),
(79, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CASH', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'Infinix Note 30 5G (19999 x 1) - ', 19999, '2023-08-13', 'Order Cancelled'),
(80, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CASH', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) - ', 25999, '2023-08-13', 'Order Cancelled'),
(81, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CASH', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) - ', 25999, '2023-08-13', 'pending'),
(82, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CASH', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) - ', 25999, '2023-08-13', 'pending'),
(83, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', '', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', '', 0, '2023-08-13', 'pending'),
(84, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', '', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', '', 0, '2023-08-13', 'pending'),
(85, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-13', 'pending'),
(86, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-13', 'pending'),
(87, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', '', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', '', 0, '2023-08-13', 'pending'),
(88, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', '', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', '', 0, '2023-08-13', 'pending'),
(89, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', '', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', '', 0, '2023-08-13', 'pending'),
(90, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', '', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', '', 0, '2023-08-13', 'pending'),
(91, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', '', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', '', 0, '2023-08-13', 'pending'),
(92, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', '', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', '', 0, '2023-08-13', 'pending'),
(93, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-13', 'pending'),
(94, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-13', 'pending'),
(95, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-13', 'pending'),
(96, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-13', 'pending'),
(97, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-13', 'pending'),
(98, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-13', 'pending'),
(99, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-13', 'pending'),
(100, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-13', 'pending'),
(101, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-13', 'pending'),
(102, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-13', 'pending'),
(103, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-13', 'pending'),
(104, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-13', 'pending'),
(105, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-13', 'pending'),
(106, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(107, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(108, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', '', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', '', 0, '2023-08-14', 'pending'),
(109, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme C55 (15999 x 1) -', 15999, '2023-08-14', 'pending'),
(110, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme C55 (15999 x 1) -', 15999, '2023-08-14', 'pending'),
(111, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme C55 (15999 x 1) -', 15999, '2023-08-14', 'pending'),
(112, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(113, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(114, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', '', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', '', 0, '2023-08-14', 'pending'),
(115, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', '', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', '', 0, '2023-08-14', 'pending'),
(116, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', '', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', '', 0, '2023-08-14', 'pending'),
(117, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', '', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', '', 0, '2023-08-14', 'pending'),
(118, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(119, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(120, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(121, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(122, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(123, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(124, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(125, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(126, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(127, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(128, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(129, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(130, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(131, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(132, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(133, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(134, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(135, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(136, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(137, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(138, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(139, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(140, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(141, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(142, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(143, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(144, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(145, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(146, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(147, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(148, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(149, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(150, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(151, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(152, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(153, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(154, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(155, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(156, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(157, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(158, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(159, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(160, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(161, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'Order Cancelled'),
(162, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending'),
(163, 1, 'ANSHU MANDAL', '6296935411', 'anshumondal6296@gmail.com', 'CARD', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612', 'realme 11 Pro 5G (25999 x 1) -', 25999, '2023-08-14', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `Ram` varchar(50) NOT NULL,
  `internal_storage` varchar(100) NOT NULL,
  `battery` varchar(50) NOT NULL,
  `camera` varchar(50) NOT NULL,
  `display` varchar(200) NOT NULL,
  `details` mediumtext NOT NULL,
  `price` int(10) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `Ram`, `internal_storage`, `battery`, `camera`, `display`, `details`, `price`, `image_01`, `image_02`, `image_03`) VALUES
(13, 'Infinix Note 30 5G', '8', '256', '5000', '108', '6.78', 'Designed for both work and play, this Infinix NOTE 30 5G smartphone delivers effective performance with its striking design. Accompanied by a Dimensity 6080 5G processor with up to 16GB of RAM (8GB + 8GB) along with 256GB of storage space, an AI camera with 108MP, and a 45W all-round fast charger, this NOTE 30 5G smartphone comes with a hoard of awesome features, including ultrarapid network connectivity, enhanced performance, and flagship experience. Featuring an impressive 120 Hz FHD+ display, vlogging camera modes, and certified JBL-tuned audio, this phone can become your ideal choice with its awesome characteristics and sophisticated design.', 19999, 'Infinix Note 30 5G.webp', 'Infinix Note 30 5Gb.webp', 'Infinix Note 30 5Ga.webp'),
(14, 'realme 11 Pro 5G', '8', '128', '5000', '100', '6.7', 'You can enjoy an immersive display on the 120 Hz curved vision display of the realme Pro 5G smartphone. Featuring a 100 MP OIS ProLight camera, this smartphone allows you to capture memories that you can cherish for a lifetime. This smartphone is powered by the Dimensity 7050 5G chipset for fast and efficient performance. The 67 W SUPERVOOC charge of this smartphone charges your phone from 0-50% in about 18 minutes so that you do not have to wait long for it to charge. With up to 8 GB of Dynamic RAM, this smartphone ensures smooth and fast operations for you to game and multitask easily. This smartphone comes with a 5000 mAh battery for long-lasting battery life.', 25999, 'realme 11 Pro 5G.webp', 'realme 11 Pro 5Gl.webp', 'realme 11 Pro 5Gj.webp'),
(15, 'realme C55', '8', '128', '5000', '64', '6.72', 'Carry a sophisticated smartphone with you that allows you to multitask effortlessly and continue working no matter how challenging the day appears to be. The 64 MP AI camera of the Realme C55 enables you to snap stunning, high-quality photographs that capture every detail with remarkable clarity. Get a fantastic visual experience as well with the 17.07 cm (6.72) 90 Hz FHD+ display, which can captivate and excite you. Perceive astounding speed and faultless efficiency with up to 16 GB of dynamic RAM, as well. Whether you&#39;re viewing a high-definition video, playing graphics-intensive video games, or running many programmes at once, 16 GB of dynamic RAM offers a seamless and responsive user experience without lag or glitches.', 15999, 'realme C55.webp', 'realme C55a.webp', 'realme C55m.webp');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_dts`
--

CREATE TABLE `purchase_dts` (
  `cust_email` varchar(200) NOT NULL,
  `Model` varchar(200) NOT NULL,
  `Price` varchar(200) NOT NULL,
  `qty` varchar(200) NOT NULL,
  `purchase_date` date NOT NULL,
  `pament_mode` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_dts`
--

INSERT INTO `purchase_dts` (`cust_email`, `Model`, `Price`, `qty`, `purchase_date`, `pament_mode`) VALUES
('aj@gmail.com', 'a2pro', '19000', '3', '2023-06-23', 'Degitaly Pay'),
('aj@gmail.com', 'a2pro', '19000', '3', '2023-06-23', 'Degitaly Pay'),
('aj@gmail.com', 'a2pro', '19000', '3', '2023-06-23', 'Cash on delivery'),
('ronideydey@1234', '12Pro', '70000', '4', '2023-06-24', 'Degitaly Pay'),
('ronideydey@1234', '12Pro', '70000', '4', '2023-06-24', 'Degitaly Pay'),
('ronideydey@1234', '12Pro', '70000', '4', '2023-06-24', 'Degitaly Pay'),
('ronideydey@1234', '12Pro', '70000', '4', '2023-06-24', 'Cash on delivery'),
('deydeyroni@gmail.com', 's31', '32000', '3', '2023-06-24', 'Degitaly Pay'),
('deydeyroni@gmail.com', 'a2pro', '19000', '3', '2023-06-24', 'Degitaly Pay'),
('deydeyroni@gmail.com', 's31', '32000', '3', '2023-06-24', 'Degitaly Pay'),
('deydeyroni@gmail.com', 'a2pro', '19000', '3', '2023-06-24', 'Degitaly Pay'),
('ronidey@1234', '12Pro', '70000', '1', '2023-06-24', 'Cash on delivery'),
('ronidey@1234', '12Pro', '70000', '1', '2023-06-24', 'Cash on delivery'),
('aj@gmail.com', 'a2pro', '19000', '1', '2023-06-26', 'Cash on delivery'),
('aj@gmail.com', 'a2pro', '19000', '2', '2023-06-26', 'Cash on delivery'),
('aj@gmail.com', 's2', '32000', '1', '2023-06-26', 'Cash on delivery'),
('', '', '', '', '2023-07-13', 'CARD'),
('', '', '', '', '2023-07-13', 'CARD'),
('', '', '', '', '2023-07-13', 'CARD');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(1, 'ANSHU MANDAL', 'anshumondal6296@gmail.com', '6296935411', '1234', 'kolkata, kolkata, kolkata, Hooghly, Hooghly, West Bengal, India - 712612'),
(20, 'SURYA PRATIM MANNA', 'surya@gmail.com', '9874125645', '1010', 'KIRTTIBASPUR, TARAHAT, KAMARPUKUR, Hooghly, Hooghly, West Bengal, India - 712612'),
(21, 'ANSHU MANDAL', 'anshu45@gmail.com', '4545454578', '1234', 'VILL- KRITTIBASPUR, P.O- TARAHAT, DIST- HOOGHLY, P, TARAHAT, KAMARPUKUR, GOGHAT, GOGHAT, West Bengal, India - 712612'),
(22, 'ANSHU MANDAL', 'anshumandal6296@gmail.com', '9593261392', 'Anshu@2002', 'KIRTTIBASPUR, TARAHAT, KAMARPUKUR, Hooghly, Hooghly, West Bengal, India - 712612');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
