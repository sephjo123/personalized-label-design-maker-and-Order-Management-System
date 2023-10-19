-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2023 at 07:32 PM
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
-- Database: `chappy_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `item_materials`
--

CREATE TABLE `item_materials` (
  `ID` int(11) NOT NULL,
  `material` varchar(100) NOT NULL,
  `price` varchar(111) NOT NULL,
  `stock` int(11) NOT NULL,
  `availability` varchar(255) NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_materials`
--

INSERT INTO `item_materials` (`ID`, `material`, `price`, `stock`, `availability`) VALUES
(1, 'White Vinyl Sticker Non Laminated', '.50', 9850, 'available'),
(2, 'Satin Sticker', '.25', 550, 'available'),
(3, 'Clear Vinyl Sticker Non Laminated', '.50', 300, 'available'),
(12, 'White Vinyl Sticker Laminated Glossy/Matte', '1.50', 550, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `item_shape`
--

CREATE TABLE `item_shape` (
  `ID` int(11) NOT NULL,
  `shape` varchar(100) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_shape`
--

INSERT INTO `item_shape` (`ID`, `shape`, `price`) VALUES
(1, 'Rectangle', '50'),
(2, 'Circle', '60'),
(3, 'Square', '70');

-- --------------------------------------------------------

--
-- Table structure for table `item_size`
--

CREATE TABLE `item_size` (
  `ID` int(11) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_size`
--

INSERT INTO `item_size` (`ID`, `size`, `price`) VALUES
(1, '1x1', '.50'),
(2, '2x2', '1.50'),
(3, '3x3', '4.50');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `date` datetime(6) DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `admin_name`, `action`, `date`) VALUES
(419, 'admin@gmail.com', 'Has logged out of the system', '2023-07-14 01:31:47.198174');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `date_added` datetime(6) DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `brand_name`, `qty`, `date_added`) VALUES
(19, 'Clear Sticker', 4005, '2023-05-24 16:10:18.000000'),
(42, 'Satin Sticker', 100, '2023-04-08 00:00:00.000000'),
(43, 'Vinyl Sticker', 200, '2023-04-08 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `message_list`
--

CREATE TABLE `message_list` (
  `id` int(11) NOT NULL,
  `from_admin` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `un_read` varchar(255) NOT NULL DEFAULT '0',
  `date_messaged` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message_list`
--

INSERT INTO `message_list` (`id`, `from_admin`, `customer_id`, `message`, `un_read`, `date_messaged`) VALUES
(23, 'Chappy', '87', 'hi', '1', '2023-06-26 15:25:21'),
(24, 'Chappy', '85', 'hi', '0', '2023-06-26 15:47:59'),
(25, 'Chappy', '85', 'hi', '0', '2023-06-26 15:50:31'),
(26, 'Chappy', '87', 'hi', '1', '2023-06-26 21:13:58'),
(27, 'Chappy', '87', 'hi', '1', '2023-06-26 21:14:14'),
(28, 'Chappy', '87', 'hi', '1', '2023-07-13 14:59:16');

-- --------------------------------------------------------

--
-- Table structure for table `order_form`
--

CREATE TABLE `order_form` (
  `ID` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `ref_num` varchar(255) NOT NULL,
  `payer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `shape` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `material` varchar(255) DEFAULT NULL,
  `processing` varchar(255) NOT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `custom_image` varchar(100) DEFAULT NULL,
  `payment_total_amount` float NOT NULL,
  `status` varchar(25) CHARACTER SET latin1 NOT NULL DEFAULT 'Yet to be approved',
  `un_read` tinyint(1) NOT NULL DEFAULT 0,
  `date_order` datetime NOT NULL DEFAULT current_timestamp(),
  `date_act` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `ID` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'User',
  `availability` varchar(255) NOT NULL DEFAULT 'active',
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `id_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`ID`, `first_name`, `profile_pic`, `last_name`, `email`, `password`, `mobile`, `address`, `user_type`, `availability`, `date_added`, `id_user`) VALUES
(1, 'Chappy', 'profile_pics/Chappy-Logo.png', 'Printing', 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '09437007408', '28 L. Wood Street Taytay, Rizal', 'super-admin', 'active', '2023-02-10 22:52:10', '1'),
(87, 'joseph', 'profile_pics/joseph.jpg', 'lebaquin', 'lebaquinuser@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '123456', 'sample', 'user', 'active', '2023-06-26 15:21:42', 'ID-64993c86-3037'),
(88, 'Shane Steven', 'profile_pics/Dev. Shane.jpg', 'Trinidad', 'admintrinidad@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '09232836820', 'sample address', 'admin', 'active', '2023-07-13 15:16:37', '2'),
(90, 'jason bill', 'profile_pics/Dev. Bill.jpg', 'Mercado', 'adminbill@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '0923283677817', 'sample address', 'admin', 'active', '2023-07-13 20:12:24', '3'),
(91, 'Jomarie', 'profile_pics/Dev. Jomarie.jpg', 'Atadero', 'adminatadero@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '092328362820', 'sample address', 'admin', 'active', '2023-07-13 20:55:03', '4'),
(92, 'John Marcel', 'profile_pics/Dev. Jhayc.jpg', 'Satombo', 'adminsatombo@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '0923283677817', 'sample addres', 'admin', 'active', '2023-07-13 21:04:05', '5'),
(93, 'Mark Joseph', 'profile_pics/Dev. Joseph.jpg', 'Lebaquin', 'adminlebaquin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '0923283677817', 'sample addres', 'admin', 'active', '2023-07-13 21:06:25', '6'),
(98, 'kamote', 'profile_pics/271529833_673539933677818_4131716207144360790_n.jpg', 'kyut', 'kamote@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '123', '123', 'user', 'active', '2023-07-14 01:28:01', 'ID-64b03421-5939');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item_materials`
--
ALTER TABLE `item_materials`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `item_shape`
--
ALTER TABLE `item_shape`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `item_size`
--
ALTER TABLE `item_size`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_list`
--
ALTER TABLE `message_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_form`
--
ALTER TABLE `order_form`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_materials`
--
ALTER TABLE `item_materials`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `item_shape`
--
ALTER TABLE `item_shape`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item_size`
--
ALTER TABLE `item_size`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=420;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `message_list`
--
ALTER TABLE `message_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `order_form`
--
ALTER TABLE `order_form`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=334;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
