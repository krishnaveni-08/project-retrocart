-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2025 at 11:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `retrocart`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers_details`
--

CREATE TABLE `customers_details` (
  `id` int(10) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `Mobile` varchar(20) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `cPassword` varchar(10) NOT NULL,
  `Door` varchar(10) NOT NULL,
  `street` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `pincode` int(10) NOT NULL,
  `landmark` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers_details`
--

INSERT INTO `customers_details` (`id`, `fullname`, `username`, `email`, `Mobile`, `Password`, `cPassword`, `Door`, `street`, `city`, `state`, `pincode`, `landmark`, `created_at`, `status`) VALUES
(11, 'jkk', 'jkumar', 'jk5@gmail.com', '9876543210', 'Jk@12345', 'Jk@12345', '10', 'Madurai main', 'Madurai', 'Tamilnadu', 625001, 'Madurai', '2025-11-18 07:37:56', 'active'),
(15, 'ramya', 'ramya_00', 'ramya@gmail.com', '6352418596', 'Ramya@123', 'Ramya@123', '57/5', 'krishnaanagar', 'ramnadu', 'tamilnadu', 625104, 'pudur', '2025-11-11 06:00:15', 'active'),
(16, 'veni', 'veni_16', 'veni@gmail.com', '8112562341', 'Veni@123', 'Veni@123', '12/1', 'kallanthiri', 'viruthunagar', 'Tamilnadu', 625106, 'vempur', '2025-11-12 11:38:49', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_details`
--

CREATE TABLE `merchant_details` (
  `id` int(11) NOT NULL,
  `Fullname` varchar(30) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobilenumber` varchar(10) NOT NULL,
  `password` varchar(15) NOT NULL,
  `Confirm_Password` varchar(15) NOT NULL,
  `door` varchar(10) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `landmark` varchar(50) NOT NULL,
  `shopname` varchar(30) NOT NULL,
  `bussinesstype` int(20) NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `merchant_details`
--

INSERT INTO `merchant_details` (`id`, `Fullname`, `username`, `email`, `mobilenumber`, `password`, `Confirm_Password`, `door`, `street`, `city`, `state`, `pincode`, `landmark`, `shopname`, `bussinesstype`, `status`) VALUES
(1, 'jayakumar', 'jk_08', 'jk@gmail.com', '6666444485', 'Jk@12345', 'Jk@12345', '55/8', 'puthu street', 'madurai', 'tamilnadu', '625104', 'arumpanur madurai', 'krishu shopp', 0, 'active'),
(7, 'gowsi', 'gowsi_00', 'gowsi@gmail.com', '7585963265', 'Gowsi@123', 'Gowsi@123', '55/5', 'krishnapuram', 'madurai', 'Tamilnadu', '625104', 'ramnadu', 'goesi shop', 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `subscribed_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newsletter_subscribers`
--

INSERT INTO `newsletter_subscribers` (`id`, `name`, `email`, `subscribed_at`) VALUES
(1, NULL, 'ashok@gmail.com', '2025-11-01 14:26:34'),
(2, NULL, 'suresh@gmail.com', '2025-11-01 14:29:22'),
(3, NULL, 'krish@gmail.com', '2025-11-07 16:46:35'),
(4, NULL, 'idhanay@gmail.com', '2025-11-08 10:40:08'),
(5, NULL, 'keerthi@gmail.com', '2025-11-08 10:40:45'),
(6, NULL, 'arun@gmail.com', '2025-11-08 10:44:52'),
(7, NULL, 'asdfas@gmail.com', '2025-11-08 13:21:36'),
(8, NULL, 'as@gmail.com', '2025-11-08 13:23:27'),
(9, NULL, 'asd@gmail.com', '2025-11-08 13:26:36'),
(10, NULL, 'keerthis@gmail.com', '2025-11-08 13:33:57'),
(11, NULL, 'keerthisssss@gmail.com', '2025-11-08 13:34:17'),
(12, NULL, 'naga@gmail.com', '2025-11-11 16:22:10'),
(13, NULL, 'rakesh@gmail.com', '2025-11-11 17:12:29'),
(14, NULL, 'veni@gmail.com', '2025-11-18 13:20:59');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `merchant_name` varchar(200) NOT NULL,
  `product_id` int(11) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `product_name` varchar(300) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `buyer_type` varchar(50) DEFAULT NULL,
  `buyer_id` int(11) NOT NULL,
  `buyer_name` varchar(30) NOT NULL,
  `merchant_id` int(11) DEFAULT NULL,
  `merchant_name` varchar(100) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`id`, `customer_id`, `customer_name`, `buyer_type`, `buyer_id`, `buyer_name`, `merchant_id`, `merchant_name`, `product_id`, `product_name`, `quantity`, `total_amount`, `payment_method`, `order_date`, `created_at`) VALUES
(1, NULL, NULL, 'customer', 1, 'krishu_09', 1, 'jk_08', NULL, ' Contra Arcade Cartridge', 1, 0.00, '', '2025-11-01 17:01:36', '2025-11-05 17:07:16'),
(2, NULL, NULL, 'customer', 3, 'vishnu_00', 1, 'jk_08', 0, 'Sonic the Hedgehog', 1, 0.00, '', '2025-11-01 19:24:08', '2025-11-05 17:07:16'),
(3, NULL, NULL, 'customer', 3, 'vishnu_00', 1, 'jk_08', 0, 'Brick Game', 1, 0.00, '', '2025-11-01 19:31:21', '2025-11-05 17:07:16'),
(4, NULL, NULL, 'customer', 3, 'vishnu_00', 1, 'jk_08', 27, 'Brick Game', 1, 0.00, '', '2025-11-01 22:22:10', '2025-11-05 17:07:16'),
(5, NULL, NULL, 'merchant', 1, 'jk_08', 1, 'jk_08', 0, 'Brick Game', 1, 0.00, '', '2025-11-03 11:23:40', '2025-11-05 17:07:16'),
(6, NULL, NULL, 'merchant', 1, 'jk_08', 1, 'jk_08', 0, 'Brick Game', 1, 0.00, '', '2025-11-03 12:11:40', '2025-11-05 17:07:16'),
(7, NULL, NULL, 'merchant', 1, 'jk_08', 1, 'jk_08', 0, 'Sonic the Hedgehog', 1, 0.00, '', '2025-11-03 12:11:53', '2025-11-05 17:07:16'),
(8, NULL, NULL, 'merchant', 1, 'jk_08', 1, 'jk_08', 0, 'Brick Game', 1, 0.00, '', '2025-11-03 12:13:49', '2025-11-05 17:07:16'),
(9, NULL, NULL, 'merchant', 1, 'jk_08', 1, 'jk_08', 0, ' Contra Arcade Cartridge', 1, 0.00, '', '2025-11-03 12:14:46', '2025-11-05 17:07:16'),
(10, NULL, NULL, 'merchant', 1, 'jk_08', 1, 'jk_08', 0, ' Contra Arcade Cartridge', 1, 0.00, '', '2025-11-03 12:24:13', '2025-11-05 17:07:16'),
(11, NULL, NULL, 'merchant', 1, 'jk_08', 1, 'jk_08', 0, 'apple ', 1, 0.00, '', '2025-11-03 12:25:06', '2025-11-05 17:07:16'),
(12, NULL, NULL, 'merchant', 1, 'jk_08', 1, 'jk_08', 0, 'apple ', 1, 0.00, '', '2025-11-03 12:35:41', '2025-11-05 17:07:16'),
(13, NULL, NULL, 'merchant', 1, 'jk_08', 1, 'jk_08', 0, 'Brick Game', 1, 0.00, '', '2025-11-03 12:38:02', '2025-11-05 17:07:16'),
(14, NULL, NULL, 'customer', 1, 'krishu_09', 1, 'jk_08', 0, ' Contra Arcade Cartridge', 1, 0.00, '', '2025-11-03 12:39:03', '2025-11-05 17:07:16'),
(15, NULL, NULL, 'merchant', 1, 'jk_08', 1, 'jk_08', 0, 'telephone retro', 1, 0.00, '', '2025-11-04 10:16:50', '2025-11-05 17:07:16'),
(16, NULL, NULL, 'merchant', 1, 'jk_08', 1, 'jk_08', 0, 'Neon Wall Clock ', 1, 8549.00, '', '2025-11-04 16:12:59', '2025-11-05 17:07:16'),
(17, NULL, NULL, 'merchant', 1, 'jk_08', 1, 'jk_08', 0, 'Vintage Typewriter Keyboard', 1, 4849.00, '', '2025-11-04 16:21:50', '2025-11-05 17:07:16'),
(18, NULL, NULL, 'merchant', 1, 'jk_08', 1, 'jk_08', 0, 'Vintage Typewriter Keyboard', 1, 4849.00, '', '2025-11-04 16:23:13', '2025-11-05 17:07:16'),
(19, NULL, NULL, 'merchant', 1, 'jk_08', 1, 'jk_08', 0, 'Vintage Typewriter Keyboard', 1, 4849.00, '', '2025-11-04 16:52:41', '2025-11-05 17:07:16'),
(20, NULL, NULL, 'merchant', 1, 'jk_08', 1, 'jk_08', 0, 'Sonic the Hedgehog', 1, 5807.00, '', '2025-11-05 14:08:54', '2025-11-05 17:07:16'),
(21, NULL, NULL, 'merchant', 1, 'jk_08', 1, 'jk_08', 0, 'Sonic the Hedgehog', 1, 5807.00, '', '2025-11-05 14:09:52', '2025-11-05 17:07:16'),
(22, NULL, NULL, NULL, 1, '', NULL, NULL, 0, NULL, 1, 5807.00, '', '2025-11-05 17:07:34', '2025-11-05 12:37:34'),
(23, NULL, NULL, NULL, 1, '', NULL, NULL, 0, NULL, 1, 5807.00, '', '2025-11-05 17:07:37', '2025-11-05 12:37:37'),
(24, NULL, NULL, NULL, 1, '', NULL, NULL, 0, NULL, 1, 5807.00, '', '2025-11-05 17:08:15', '2025-11-05 12:38:15'),
(25, NULL, NULL, NULL, 1, '', NULL, NULL, 0, NULL, 1, 5807.00, '', '2025-11-05 17:10:48', '2025-11-05 12:40:48'),
(26, NULL, NULL, NULL, 1, '', NULL, NULL, 0, NULL, 1, 5807.00, '', '2025-11-05 17:13:09', '2025-11-05 12:43:09'),
(27, NULL, NULL, NULL, 1, '', NULL, NULL, 0, NULL, 1, 4595.00, '', '2025-11-05 17:23:26', '2025-11-05 12:53:26'),
(28, NULL, NULL, 'customer', 9, 'sasi_00', 1, 'jk_08', 0, 'fridgesss', 1, 5807.00, '', '2025-11-05 17:30:07', '2025-11-05 17:30:07'),
(29, NULL, NULL, 'merchant', 1, 'naga_57', 1, 'jk_08', 0, 'Retro Digital Wristwatch', 1, 12395.00, '', '2025-11-06 10:57:42', '2025-11-06 10:57:42'),
(30, NULL, NULL, 'customer', 12, 'raga_16', 1, 'jk_08', 0, 'fridgesss', 1, 5807.00, '', '2025-11-06 15:02:57', '2025-11-06 15:02:57'),
(31, NULL, NULL, 'customer', 12, 'raga_16', 1, 'jk_08', 0, 'Sonic the Hedgehog', 1, 5807.00, '', '2025-11-06 15:58:03', '2025-11-06 15:58:03'),
(32, NULL, NULL, 'customer', 12, 'raga_16', 1, 'jk_08', 0, 'fridgesss', 1, 5807.00, '', '2025-11-06 16:04:50', '2025-11-06 16:04:50'),
(33, NULL, NULL, 'merchant', 1, 'keerthi_12', 1, 'jk_08', 21, 'fridgesss', 1, 5807.00, 'Cash on Delivery', '2025-11-06 16:18:36', '2025-11-06 16:18:36'),
(34, NULL, NULL, 'merchant', 1, 'keerthi_12', 1, 'jk_08', 0, 'Sonic the Hedgehog', 1, 5807.00, '', '2025-11-06 16:19:25', '2025-11-06 16:19:25'),
(35, NULL, NULL, 'merchant', 1, 'keerthi_12', 1, 'jk_08', 0, ' Contra Arcade Cartridge', 1, 4595.00, '', '2025-11-06 16:20:26', '2025-11-06 16:20:26'),
(36, NULL, NULL, 'merchant', 1, 'keerthi_12', 1, 'jk_08', 0, ' Contra Arcade Cartridge', 1, 4595.00, '', '2025-11-06 16:21:13', '2025-11-06 16:21:13'),
(37, NULL, NULL, 'customer', 13, 'priya_15', 1, 'jk_08', 0, 'fridgesss', 1, 5807.00, '', '2025-11-06 16:24:29', '2025-11-06 16:24:29'),
(38, NULL, NULL, 'customer', 13, 'priya_15', 1, 'jk_08', 0, 'Vintage Typewriter Keyboard', 1, 4849.00, '', '2025-11-06 17:04:02', '2025-11-06 17:04:02'),
(39, NULL, NULL, 'customer', 13, 'priya_15', 1, 'jk_08', 0, 'Brick Game', 1, 8635.00, '', '2025-11-06 17:12:19', '2025-11-06 17:12:19'),
(40, NULL, NULL, 'customer', 13, 'priya_15', 1, 'jk_08', 0, 'Neon Wall Clock ', 1, 8549.00, '', '2025-11-06 17:28:26', '2025-11-06 17:28:26'),
(41, NULL, NULL, 'merchant', 1, 'jk_08', 1, 'jk_08', 21, 'fridgesss', 1, 5807.00, '', '2025-11-07 13:58:51', '2025-11-07 13:58:51'),
(42, NULL, NULL, 'merchant', 1, 'jk_08', 1, 'jk_08', 30, 'Sonic the Hedgehog', 1, 5807.00, '', '2025-11-07 13:59:06', '2025-11-07 13:59:06'),
(43, NULL, NULL, 'customer', 2, 'arsad_30', 1, 'jk_08', 37, 'Neon Wall Clock ', 1, 8549.00, '', '2025-11-07 14:01:12', '2025-11-07 14:01:12'),
(44, NULL, NULL, 'customer', 14, 'devi_12', 1, 'jk_08', 38, 'Vintage Typewriter Keyboard', 1, 9648.00, '', '2025-11-07 17:09:53', '2025-11-07 17:09:53'),
(45, NULL, NULL, 'customer', 9, 'sasi_00', 1, 'jk_08', 30, 'Sonic the Hedgehog', 1, 5807.00, '', '2025-11-08 10:53:03', '2025-11-08 10:53:03'),
(46, NULL, NULL, 'customer', 9, 'sasi_00', 1, 'jk_08', 41, 'redmi note ', 1, 15215.00, '', '2025-11-08 11:04:10', '2025-11-08 11:04:10'),
(47, NULL, NULL, 'customer', 9, 'sasi_00', 1, 'jk_08', 41, 'redmi note ', 1, 15215.00, '', '2025-11-08 11:18:11', '2025-11-08 11:18:11'),
(48, NULL, NULL, 'customer', 9, 'sasi_00', 1, 'jk_08', 41, 'redmi note ', 1, 15215.00, '', '2025-11-08 11:21:16', '2025-11-08 11:21:16'),
(49, NULL, NULL, 'customer', 9, 'sasi_00', 1, 'jk_08', 30, 'Sonic the Hedgehog', 1, 5807.00, '', '2025-11-08 11:59:21', '2025-11-08 11:59:21'),
(50, NULL, NULL, 'customer', 9, 'sasi_00', 1, 'jk_08', 37, 'Neon Wall Clock ', 1, 8549.00, '', '2025-11-08 12:02:07', '2025-11-08 12:02:07'),
(51, NULL, NULL, 'customer', 9, 'sasi_00', 1, 'jk_08', 37, 'Neon Wall Clock ', 1, 8549.00, '', '2025-11-08 12:02:34', '2025-11-08 12:02:34'),
(52, NULL, NULL, 'customer', 9, 'sasi_00', 1, 'jk_08', 37, 'Neon Wall Clock ', 1, 8549.00, '', '2025-11-08 12:05:43', '2025-11-08 12:05:43'),
(53, NULL, NULL, 'customer', 9, 'sasi_00', 1, 'jk_08', 27, ' Contra Arcade Cartridge', 1, 4595.00, 'upi', '2025-11-08 12:07:50', '2025-11-08 12:07:50'),
(54, NULL, NULL, 'customer', 9, 'sasi_00', 1, 'jk_08', 27, ' Contra Arcade Cartridge', 1, 4595.00, 'upi', '2025-11-08 12:09:20', '2025-11-08 12:09:20'),
(55, NULL, NULL, 'customer', 9, 'sasi_00', 1, 'jk_08', 27, ' Contra Arcade Cartridge', 1, 4595.00, 'upi', '2025-11-08 12:11:38', '2025-11-08 12:11:38'),
(56, NULL, NULL, 'customer', 9, 'sasi_00', 1, 'jk_08', 27, ' Contra Arcade Cartridge', 1, 4595.00, 'card', '2025-11-08 12:12:11', '2025-11-08 12:12:11'),
(57, NULL, NULL, 'customer', 9, 'sasi_00', 1, 'jk_08', 31, 'Brick Game', 1, 8635.00, 'cod', '2025-11-08 12:20:55', '2025-11-08 12:20:55'),
(58, NULL, NULL, 'customer', 9, 'sasi_00', 1, 'jk_08', 21, 'fridgesss', 1, 5807.00, 'cod', '2025-11-08 12:22:54', '2025-11-08 12:22:54'),
(59, NULL, NULL, 'customer', 9, 'sasi_00', 1, 'jk_08', 30, 'Sonic the Hedgehog', 1, 5807.00, 'cod', '2025-11-08 12:23:59', '2025-11-08 12:23:59'),
(60, NULL, NULL, 'customer', 9, 'sasi_00', 1, 'jk_08', 30, 'Sonic the Hedgehog', 1, 5807.00, 'cod', '2025-11-08 12:25:38', '2025-11-08 12:25:38'),
(61, NULL, NULL, 'customer', 9, 'sasi_00', 1, 'jk_08', 30, 'Sonic the Hedgehog', 1, 5807.00, 'upi', '2025-11-08 12:28:27', '2025-11-08 12:28:27'),
(62, NULL, NULL, 'customer', 9, 'sasi_00', 1, 'jk_08', 38, 'Vintage Typewriter Keyboard', 1, 4849.00, 'cod', '2025-11-08 12:28:53', '2025-11-08 12:28:53'),
(63, NULL, NULL, 'customer', 9, 'sasi_00', 1, 'jk_08', 30, 'Sonic the Hedgehog', 1, 5807.00, 'cod', '2025-11-08 12:30:13', '2025-11-08 12:30:13'),
(64, NULL, NULL, 'merchant', 1, 'keerthi_12', 1, 'jk_08', 38, 'Vintage Typewriter Keyboard', 1, 4849.00, 'on', '2025-11-08 12:45:43', '2025-11-08 12:45:43'),
(65, NULL, NULL, 'merchant', 3, 'arsadd_09', 3, 'keerthi_12', 45, 'Mario Quest', 0, 2049.00, 'cod', '2025-11-08 17:14:31', '2025-11-08 17:14:31'),
(66, NULL, NULL, 'merchant', 3, 'arsadd_09', 3, 'keerthi_12', 45, 'Mario Quest', 0, 2049.00, 'upi', '2025-11-08 17:15:27', '2025-11-08 17:15:27'),
(67, NULL, NULL, 'customer', 3, 'vishnu_00', 3, 'keerthi_12', 48, 'Bit Racer', 0, 1349.00, 'upi', '2025-11-11 11:00:26', '2025-11-11 11:00:26'),
(68, NULL, NULL, 'customer', 13, 'priya_15', 3, 'keerthi_12', 49, 'Sonic Rush', 0, 1649.00, 'upi', '2025-11-11 17:16:51', '2025-11-11 17:16:51'),
(69, NULL, NULL, 'merchant', 3, 'jk_08', 3, 'keerthi_12', 49, 'Sonic Rush', 0, 1649.00, 'upi', '2025-11-12 16:37:34', '2025-11-12 16:37:34'),
(70, NULL, NULL, 'merchant', 3, 'jk_08', 3, 'keerthi_12', 49, 'Sonic Rush', 0, 1649.00, 'upi', '2025-11-12 16:38:20', '2025-11-12 16:38:20'),
(71, NULL, NULL, 'merchant', 3, 'jk_08', 3, 'keerthi_12', 49, 'Sonic Rush', 0, 1649.00, 'upi', '2025-11-12 16:39:29', '2025-11-12 16:39:29'),
(72, NULL, NULL, 'customer', 15, 'ramya_00', 3, 'keerthi_12', 48, 'Bit Racer', 0, 1349.00, 'cod', '2025-11-12 16:41:43', '2025-11-12 16:41:43'),
(73, NULL, NULL, 'customer', 16, 'veni_16', 2, 'arsadd_09', 50, 'Golden Hits ', 0, 550.00, 'cod', '2025-11-12 17:09:28', '2025-11-12 17:09:28'),
(74, NULL, NULL, 'customer', 16, 'veni_16', 3, 'keerthi_12', 48, 'Bit Racer', 0, 1349.00, 'upi', '2025-11-12 17:53:27', '2025-11-12 17:53:27'),
(75, NULL, NULL, 'customer', 16, 'veni_16', 3, 'keerthi_12', 48, 'Bit Racer', 0, 1349.00, 'cod', '2025-11-16 20:12:40', '2025-11-16 20:12:40'),
(76, NULL, NULL, 'merchant', 3, 'prenitha_0', 3, 'keerthi_12', 45, 'Mario Quest', 0, 2049.00, 'cod', '2025-11-17 11:28:45', '2025-11-17 11:28:45'),
(77, NULL, NULL, 'merchant', 3, 'prenitha_0', 3, 'keerthi_12', 47, 'Brick Blast', 0, 1049.00, 'cod', '2025-11-17 11:29:15', '2025-11-17 11:29:15'),
(78, NULL, NULL, 'customer', 16, 'veni_16', 3, 'keerthi_12', 47, 'Brick Blast', 0, 1049.00, 'cod', '2025-11-17 11:30:31', '2025-11-17 11:30:31'),
(79, NULL, NULL, 'customer', 16, 'veni_16', 3, 'keerthi_12', 48, 'Bit Racer', 0, 1349.00, 'cod', '2025-11-17 11:31:19', '2025-11-17 11:31:19'),
(80, NULL, NULL, 'merchant', 3, 'arsadd_09', 3, 'keerthi_12', 49, 'Sonic Rush', 0, 1649.00, 'cod', '2025-11-17 11:32:22', '2025-11-17 11:32:22'),
(81, NULL, NULL, 'merchant', 3, 'gowsi_00', 3, 'keerthi_12', 49, 'Sonic Rush', 0, 1649.00, 'cod', '2025-11-17 11:34:48', '2025-11-17 11:34:48'),
(82, NULL, NULL, 'merchant', 7, 'gowsi_00', 7, 'gowsi_00', 49, 'Sonic Rush', 0, 1649.00, 'cod', '2025-11-17 11:40:43', '2025-11-17 11:40:43'),
(83, NULL, NULL, 'merchant', 3, 'gowsi_00', 3, 'keerthi_12', 46, 'Retro Fighter', 0, 1849.00, 'upi', '2025-11-17 11:41:37', '2025-11-17 11:41:37'),
(84, NULL, NULL, 'merchant', 3, 'gowsi_00', 3, 'keerthi_12', 47, 'Brick Blast', 0, 1049.00, 'cod', '2025-11-17 16:16:28', '2025-11-17 16:16:28'),
(85, NULL, NULL, 'merchant', 3, 'gowsi_00', 3, 'keerthi_12', 47, 'Brick Blast', 0, 1049.00, 'cod', '2025-11-17 16:16:38', '2025-11-17 16:16:38'),
(86, NULL, NULL, 'merchant', 3, 'prenitha_0', 3, 'keerthi_12', 48, 'Bit Racer', 0, 1349.00, 'upi', '2025-11-17 16:17:48', '2025-11-17 16:17:48'),
(87, NULL, NULL, 'merchant', 3, 'gowsi_00', 3, 'keerthi_12', 46, 'Retro Fighter', 0, 1849.00, 'cod', '2025-11-17 16:54:05', '2025-11-17 16:54:05'),
(88, NULL, NULL, 'merchant', 3, 'jk_08', 3, 'keerthi_12', 48, 'Bit Racer', 0, 1349.00, 'cod', '2025-11-17 17:26:46', '2025-11-17 17:26:46'),
(89, NULL, NULL, 'merchant', 3, 'gowsi_00', 3, 'keerthi_12', 49, 'Sonic Rush', 0, 1649.00, 'upi', '2025-11-17 17:27:55', '2025-11-17 17:27:55'),
(90, NULL, NULL, 'merchant', 3, 'gowsi_00', 3, 'keerthi_12', 44, 'Pixel Invaders', 0, 1549.00, 'cod', '2025-11-17 17:28:15', '2025-11-17 17:28:15'),
(91, NULL, NULL, 'merchant', 7, '', 7, 'gowsi_00', 0, 'Bit Racer', 0, 1349.00, 'cod', '2025-11-17 17:34:24', '2025-11-17 17:34:24'),
(92, NULL, NULL, 'merchant', 7, 'gowsi_00', 7, 'gowsi_00', 0, 'Bit Racer', 0, 1349.00, 'cod', '2025-11-17 17:36:38', '2025-11-17 17:36:38'),
(93, NULL, NULL, 'merchant', 7, 'gowsi_00', 7, 'gowsi_00', 48, 'Bit Racer', 0, 1349.00, 'cod', '2025-11-17 17:40:04', '2025-11-17 17:40:04'),
(94, NULL, NULL, 'merchant', 6, 'prenitha_0', 6, 'prenitha_0', 47, 'Brick Blast', 0, 1049.00, 'cod', '2025-11-17 17:42:03', '2025-11-17 17:42:03'),
(95, NULL, NULL, 'merchant', 7, 'gowsi_00', 7, 'gowsi_00', 45, 'Mario Quest', 0, 2049.00, 'cod', '2025-11-18 10:44:47', '2025-11-18 10:44:47'),
(96, NULL, NULL, 'customer', 16, 'veni_16', 7, 'gowsi_00', 44, 'Pixel Invaders', 0, 1549.00, 'cod', '2025-11-18 10:46:18', '2025-11-18 10:46:18'),
(97, NULL, NULL, 'merchant', 7, 'gowsi_00', 7, 'gowsi_00', 36, 'Polaroid OneStep Camera', 0, 21047.00, 'card', '2025-11-18 13:32:10', '2025-11-18 13:32:10'),
(98, NULL, NULL, 'merchant', 7, 'gowsi_00', 7, 'gowsi_00', 37, 'Neon Wall Clock ', 0, 8549.00, 'cod', '2025-11-18 14:36:47', '2025-11-18 14:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) DEFAULT 0,
  `category` enum('RetroGames','MusicTapes','VintageToys','ClassicFashion','OldComics','HomeAppliances','Jewelry','Watches') DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `discount` int(11) NOT NULL,
  `brand` varchar(30) NOT NULL,
  `condition` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL,
  `meterial` varchar(50) NOT NULL,
  `color` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_best_selling` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `merchant_id`, `name`, `description`, `price`, `quantity`, `category`, `image`, `status`, `discount`, `brand`, `condition`, `stock`, `meterial`, `color`, `created_at`, `is_best_selling`) VALUES
(7, 1, 'VintagePulse Quartz', 'fgsdfioghsidfioug', 4299.00, 3, '', 'Asset/image/product/product-three.png', 'inactive', 0, '', '', 0, '', '', '2025-10-23 11:04:44', 0),
(8, 1, 'test', 'asdfasdf', 1234.00, 5, '', '', 'inactive', 0, '', '', 0, '', '', '2025-10-23 11:20:49', 0),
(9, 1, 'bike', 'sdfghjk,l.;xdcfvgbhnm,', 4299.00, 1, '', 'Asset/image/product/product -one.jpg', 'inactive', 0, '', '', 0, '', '', '2025-10-23 11:32:03', 0),
(11, 1, ' Record Player', 'Bring back the golden age of music with this beautifully crafted retro-style vinyl record player. Features wooden design, Bluetooth support, and high-quality speakers.', 5757.00, 1, '', 'Asset/image/product/back.png', 'inactive', 0, '', '', 0, '', '', '2025-10-24 04:22:06', 0),
(12, 1, ' Record Player', 'Bring back the golden age of music with this beautifully crafted retro-style vinyl record player. Features wooden design, Bluetooth support, and high-quality speakers.', 5757.00, 1, '', 'Asset/image/product/mem-two.jpg', 'inactive', 0, '', '', 0, '', '', '2025-10-24 05:24:03', 0),
(13, 1, 'krish retroo', 'Bring back the golden age of music with this beautifully crafted retro-style vinyl record player. Features wooden design, Bluetooth support, and high-quality speakers.', 5757.00, 1, '', 'Asset/image/product/memory.jpg', 'inactive', 0, '', '', 0, '', '', '2025-10-24 05:24:27', 0),
(15, 1, 'headphones', 'adfsssssssssssssssssssssssssssssssdfsdfmdfnsmd v,mm', 999.00, 5, '', 'Asset/image/product/radio.png', 'inactive', 0, '', '', 0, '', '', '2025-10-28 09:52:18', 0),
(16, 1, 'iphone', 'sdxfcgvbhnjkm,e45rtfgyhuijko,l;.', 100000.00, 1, '', 'Asset/image/product/product -one copy.jpg', 'inactive', 0, 'iphone', 'Used', 0, '', 'green', '2025-10-29 08:33:46', 0),
(17, 1, 'redime phone', 'awsdcfgvbhnjmk,lzwexcrtvbynuimk,l', 15151.00, 1, '', 'Asset/image/product/mem-two.jpg', 'inactive', 0, 'boat', 'Refurbished', 0, '', 'yello', '2025-10-29 08:34:23', 0),
(18, 1, 'tv', 'swedrftgyhuijko,lesdrftgyhujik', 20000.00, 1, '', 'Asset/image/product/product-three.png', 'inactive', 0, 'boat', 'Refurbished', 0, '', 'green', '2025-10-29 08:46:56', 0),
(19, 1, 'VintagePulse Quartz', 'ldgkdnf,mdfnosifjlsdflakdfldkffldsffkalksdflskdfn', 4299.00, 1, '', 'Asset/image/product/back.png', 'inactive', 0, 'RetroTime Co', 'New', 0, '', 'purple', '2025-10-29 09:07:45', 0),
(20, 1, 'laptop', 'fvgbhnjm,erftgyhujikexdcfvgbhnj', 5252.00, 1, '', 'Asset/image/product/back.png', 'inactive', 0, 'boat', 'Used', 0, '', 'yello', '2025-10-29 09:15:49', 0),
(21, 1, 'fridgesss', 'sxdcfvgbhnjmk,lxdcrftvgbyhunjimk', 5757.00, 1, 'HomeAppliances', 'Asset/image/product/product -one copy.jpg', 'active', 0, '151322136', 'New', 0, '', 'green', '2025-10-29 11:57:48', 1),
(22, 1, 'apple', 'Compact arcade stick with classic controls.', 5757.00, 1, 'RetroGames', 'Asset/image/product/product -one copy.jpg', 'inactive', 0, 'VintageTone', 'New', 0, '', 'Red', '2025-10-29 12:25:04', 0),
(23, 1, ' Record Player', 'drftghjklcfgvbhnjkm', 1605.00, 1, 'MusicTapes', 'Asset/image/product/child-ban.png', 'inactive', 0, 'VintageTone', 'Refurbished', 0, '', 'yello', '2025-10-30 15:01:21', 1),
(24, 1, 'Retro Game Console', 'Classic handheld console with 400+ built-in retro games.', 2.00, 1, 'RetroGames', 'Asset/image/product/games_2.jpg', 'inactive', 0, 'RetroMax', 'Used', 0, '', 'Black & Red', '2025-10-31 06:21:31', 1),
(25, 1, 'Arcade Stick Mini', 'Compact arcade stick with classic controls.', 4299.00, 1, 'RetroGames', 'Asset/image/product/games-1.jpg', 'inactive', 0, 'GameEra', 'Used', 0, '', 'blue', '2025-10-31 06:23:35', 0),
(26, 1, 'Super Mario Bros ', 'Compact arcade stick with classic controls.\n', 4545.00, 1, 'RetroGames', 'Asset/image/product/games_3.jpg', 'inactive', 0, 'Nintendo', 'Used', 0, '', 'Red', '2025-10-31 06:28:16', 0),
(27, 1, ' Contra Arcade Cartridge', ' Run-and-gun classic with co-op chaos and unforgettable soundtracks.\r\n', 4545.00, 1, 'RetroGames', 'Asset/image/product/home-2.jpg', 'active', 0, '', 'Used', 0, '', 'green', '2025-10-31 06:29:39', 1),
(28, 1, 'Man Retro Console', 'Mini plug-and-play console preloaded with Pac-Man and other vintage hits.', 3.00, 1, 'RetroGames', 'Asset/image/product/games_3.jpg', 'inactive', 0, 'Bandai Namco', 'Used', 0, '', 'green', '2025-10-31 08:53:18', 0),
(29, 1, 'Street Fighter', 'Iconic 90s fighting game featuring Ryu, Ken, Chun-Li and more.', 2.00, 1, 'RetroGames', 'Asset/image/product/games-1.jpg', 'inactive', 0, 'VintageTone', 'Refurbished', 0, '', 'purple', '2025-10-31 08:54:12', 0),
(30, 1, 'Sonic the Hedgehog', 'Blast through colorful levels at supersonic speed — Sega’s 16-bit masterpiece.', 5757.00, 1, 'RetroGames', 'Asset/image/product/freepik__a-vibrant-display-of-classic-80s-and-90s-toys-game__57330.png', 'active', 0, 'RetroTime Co', 'Refurbished', 0, '', 'pink', '2025-10-31 08:54:58', 1),
(31, 1, 'Brick Game', 'Portable retro handheld console loaded with classic brick puzzle games.', 8585.00, 1, 'RetroGames', 'Asset/image/product/radio.png', 'active', 0, 'BrickMaster', 'Refurbished', 0, '', 'green', '2025-10-31 08:56:01', 0),
(35, 1, 'telephone retro', 'asdfghjklwertyuiocvbnm,.', 563.00, 1, 'MusicTapes', 'Asset/image/product/games_2 1.png', 'inactive', 0, 'apple', 'Used', 0, '', 'Red', '2025-11-03 07:27:22', 1),
(36, 1, 'Polaroid OneStep Camera', 'Instant film camera with flash and self-timer for vintage photo lovers.', 6999.00, 1, 'RetroGames', 'Asset/image/product/camera.jpg', 'active', 0, 'Polaroid', 'Used', 0, '', 'Red', '2025-11-04 09:32:17', 0),
(37, 1, 'Neon Wall Clock ', 'Turntable with Bluetooth and built-in speakers for a vintage audio experience.', 8499.00, 1, 'RetroGames', 'Asset/image/product/tele 1.png', 'active', 0, 'GrooveTech', 'Used', 0, '', 'yello', '2025-11-04 09:34:13', 0),
(38, 1, 'Vintage Typewriter Keyboard', 'Mechanical keyboard designed like an old typewriter, USB compatible.', 4799.00, 1, 'RetroGames', 'Asset/image/product/toys_1.jpg', 'active', 0, 'ClickMaster', 'Used', 0, '', 'purple', '2025-11-04 09:35:04', 0),
(39, 1, 'Retro Round Sunglasses', '90s-style round sunglasses with gold frame and UV protection.', 4299.00, 1, 'MusicTapes', 'Asset/image/product/fann.png', 'active', 0, 'ClassicRay', 'Used', 0, '', 'purple', '2025-11-04 09:47:09', 0),
(40, 1, ' Wristwatch', '90s-style round sunglasses with gold frame and UV protection.', 12345.00, 1, 'RetroGames', 'Asset/image/product/fann.png', 'active', 0, 'VintageTone', 'Used', 0, '', 'pink', '2025-11-04 09:47:54', 0),
(41, 1, 'redmi note ', 'waesrdtfgawesdfghjksdfgvhbj', 15165.00, 1, 'VintageToys', 'Asset/image/product/tele.jpg', 'inactive', 0, 'VintageTone', 'Used', 0, '', 'yello', '2025-11-05 04:47:57', 0),
(56, 7, ' Record Player', ' Record Player  Record Player  Record Player', 4299.00, 1, 'MusicTapes', 'Asset/image/product/Classic Rock.jpg', 'active', 0, 'boat', 'Used', 0, '', 'green', '2025-11-18 07:46:02', 0),
(57, 7, 'Retro Pixel Handheld', 'Classic 90s handheld with 200 built-in retro games.', 4299.00, 1, 'MusicTapes', 'Asset/image/product/games_2 1.png', 'active', 0, 'RetroTime Co', 'Refurbished', 0, '', 'Red', '2025-11-18 10:11:59', 0),
(58, 7, 'Flip Alarm Clock', 'Vintage flip-style clock with smooth card rolls.', 999.00, 1, 'MusicTapes', 'Asset/image/product/two.jpg', 'active', 0, 'RetroTime Co', 'Used', 0, '', 'yellow', '2025-11-18 10:13:29', 0),
(59, 7, 'Neon Arcade Wall Light', 'Retro-style neon wall lamp for gaming rooms.', 999.00, 1, 'MusicTapes', 'Asset/image/product/three.jpg', 'active', 0, 'RetroTime Co', 'Used', 0, '', 'purple', '2025-11-18 10:30:31', 0),
(60, 7, 'Vintage Metal Lunchbox', '80s-style printed metal lunchbox collectible.', 12345.00, 1, 'MusicTapes', 'Asset/image/product/four.jpg', 'active', 0, 'iphone', 'Used', 0, '', 'green', '2025-11-18 10:32:13', 0),
(61, 7, 'Old School Roller Skates', 'Classic four-wheel skates with sturdy build.', 4299.00, 1, 'RetroGames', 'Asset/image/product/five.jpg', 'active', 0, 'boat', 'New', 0, '', 'green', '2025-11-18 10:33:33', 0),
(62, 7, 'Rotary Dial Phone', 'Working dial phone with old ringing tone.', 5757.00, 1, 'MusicTapes', 'Asset/image/product/six.jpg', 'active', 0, 'iphone', 'New', 0, '', 'Red', '2025-11-18 10:34:36', 0),
(63, 7, 'Antique Brass Pocket Watch', 'Vintage engraved pocket watch with chain.', 4299.00, 1, 'MusicTapes', 'Asset/image/product/seven.jpg', 'active', 0, 'RetroTime Co', 'New', 0, '', 'purple', '2025-11-18 10:35:56', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`image_id`, `product_id`, `image_path`, `uploaded_at`) VALUES
(5, 9, 'Asset/image/product/1761219123_product -one.jpg', '2025-10-23 11:32:03'),
(7, 11, 'Asset/image/product/back.png', '2025-10-24 04:22:06'),
(8, 12, 'Asset/image/product/mem-two.jpg', '2025-10-24 05:24:03'),
(9, 13, 'Asset/image/product/memory.jpg', '2025-10-24 05:24:27'),
(10, 15, 'Asset/image/product/radio.png', '2025-10-28 09:52:18'),
(11, 16, 'Asset/image/product/product -one copy.jpg', '2025-10-29 08:33:46'),
(12, 17, 'Asset/image/product/mem-two.jpg', '2025-10-29 08:34:23'),
(13, 18, 'Asset/image/product/product-three.png', '2025-10-29 08:46:57'),
(14, 19, 'Asset/image/product/back.png', '2025-10-29 09:07:45'),
(15, 20, 'Asset/image/product/back.png', '2025-10-29 09:15:49'),
(16, 21, 'Asset/image/product/product -one copy.jpg', '2025-10-29 11:57:48'),
(17, 22, 'Asset/image/product/product -one copy.jpg', '2025-10-29 12:25:04'),
(18, 23, 'Asset/image/product/child-ban.png', '2025-10-30 15:01:21'),
(19, 24, 'Asset/image/product/games_2.jpg', '2025-10-31 06:21:31'),
(20, 25, 'Asset/image/product/games-1.jpg', '2025-10-31 06:23:35'),
(21, 26, 'Asset/image/product/games_3.jpg', '2025-10-31 06:28:16'),
(22, 27, 'Asset/image/product/home-2.jpg', '2025-10-31 06:29:39'),
(23, 28, 'Asset/image/product/games_3.jpg', '2025-10-31 08:53:18'),
(24, 29, 'Asset/image/product/games-1.jpg', '2025-10-31 08:54:12'),
(25, 30, 'Asset/image/product/freepik__a-vibrant-display-of-classic-80s-and-90s-toys-game__57330.png', '2025-10-31 08:54:58'),
(26, 31, 'Asset/image/product/radio.png', '2025-10-31 08:56:01'),
(28, 35, 'Asset/image/product/games_2 1.png', '2025-11-03 07:27:22'),
(29, 36, 'Asset/image/product/camera.jpg', '2025-11-04 09:32:17'),
(30, 37, 'Asset/image/product/tele 1.png', '2025-11-04 09:34:13'),
(31, 38, 'Asset/image/product/toys_1.jpg', '2025-11-04 09:35:04'),
(32, 39, 'Asset/image/product/fann.png', '2025-11-04 09:47:09'),
(33, 40, 'Asset/image/product/fann.png', '2025-11-04 09:47:54'),
(34, 41, 'Asset/image/product/tele.jpg', '2025-11-05 04:47:57'),
(48, 56, 'Asset/image/product/Classic Rock.jpg', '2025-11-18 07:46:02'),
(49, 57, 'Asset/image/product/games_2 1.png', '2025-11-18 10:11:59'),
(50, 58, 'Asset/image/product/two.jpg', '2025-11-18 10:13:29'),
(51, 59, 'Asset/image/product/three.jpg', '2025-11-18 10:30:31'),
(52, 60, 'Asset/image/product/four.jpg', '2025-11-18 10:32:13'),
(53, 61, 'Asset/image/product/five.jpg', '2025-11-18 10:33:33'),
(54, 62, 'Asset/image/product/six.jpg', '2025-11-18 10:34:36'),
(55, 63, 'Asset/image/product/seven.jpg', '2025-11-18 10:35:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers_details`
--
ALTER TABLE `customers_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`Mobile`);

--
-- Indexes for table `merchant_details`
--
ALTER TABLE `merchant_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile number` (`mobilenumber`);

--
-- Indexes for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `merchant_id` (`merchant_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers_details`
--
ALTER TABLE `customers_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `merchant_details`
--
ALTER TABLE `merchant_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_details` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
