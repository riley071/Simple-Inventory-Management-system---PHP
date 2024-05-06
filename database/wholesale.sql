-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2024 at 11:11 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wholesales`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `name`) VALUES
(1, 'Vitamins'),
(4, 'Antibiotics'),
(7, 'CNS'),
(8, 'Sample Category'),
(9, 'Computers'),
(10, 'Fresh food'),
(11, 'T-shirts'),
(12, 'Prescription drugs'),
(13, 'skin care'),
(14, 'hair care'),
(15, 'living room furniture'),
(16, 'daily products'),
(17, 'children furniture');

-- --------------------------------------------------------

--
-- Table structure for table `customer_list`
--

CREATE TABLE `customer_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `contact` varchar(30) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_list`
--

INSERT INTO `customer_list` (`id`, `name`, `contact`, `address`) VALUES
(1, 'Sample Customer', '+123456789', 'Sample address'),
(2, 'new customer', '02039', 'ddhdh');

-- --------------------------------------------------------

--
-- Table structure for table `expired_product`
--

CREATE TABLE `expired_product` (
  `id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `qty` int(30) NOT NULL,
  `date_expired` date NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expired_product`
--

INSERT INTO `expired_product` (`id`, `product_id`, `qty`, `date_expired`, `date_created`) VALUES
(3, 6, 5, '2020-10-05', '2020-10-09 08:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `qty` int(30) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1= stockin , 2 = stockout',
  `stock_from` varchar(100) NOT NULL COMMENT 'sales/receiving',
  `form_id` int(30) NOT NULL,
  `expiry_date` date NOT NULL,
  `expired_confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `other_details` text NOT NULL,
  `remarks` text NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `product_id`, `qty`, `type`, `stock_from`, `form_id`, `expiry_date`, `expired_confirmed`, `other_details`, `remarks`, `date_updated`) VALUES
(1, 3, 500, 1, 'receiving', 1, '2021-12-03', 1, '{\"price\":\"5\",\"qty\":\"500\"}', 'Stock from Receiving-83386962\r\n', '2024-04-06 22:20:29'),
(2, 2, 500, 1, 'receiving', 1, '2021-11-11', 0, '{\"price\":\"5\",\"qty\":\"500\"}', 'Stock from Receiving-83386962\r\n', '2020-10-08 10:55:21'),
(3, 6, 300, 1, 'receiving', 1, '2021-10-06', 0, '{\"price\":\"20\",\"qty\":\"300\"}', 'Stock from Receiving-83386962\r\n', '2020-10-08 10:55:21'),
(4, 5, 300, 1, 'receiving', 1, '2021-11-09', 0, '{\"price\":\"10\",\"qty\":\"300\"}', 'Stock from Receiving-83386962\r\n', '2020-10-08 10:55:21'),
(5, 4, 500, 1, 'receiving', 2, '2022-10-14', 0, '{\"price\":\"8\",\"qty\":\"500\"}', 'Stock from Receiving-00000000\n', '2020-10-08 11:03:36'),
(6, 6, 10, 1, 'receiving', 2, '2020-10-05', 1, '{\"price\":\"18\",\"qty\":\"10\"}', 'Stock from Receiving-00000000\n', '2020-10-09 08:20:00'),
(8, 3, 1, 2, 'Sales', 2, '0000-00-00', 0, '{\"price\":\"10\",\"qty\":\"1\"}', 'Stock out from Sales-00000000\n', '2020-10-08 13:23:13'),
(9, 5, 20, 2, 'Sales', 2, '0000-00-00', 0, '{\"price\":\"15\",\"qty\":\"20\"}', 'Stock out from Sales-00000000\n', '2020-10-08 13:23:13'),
(10, 3, 20, 2, 'Sales', 3, '0000-00-00', 0, '{\"price\":\"10\",\"qty\":\"20\"}', 'Stock out from Sales-74800422\n', '2020-10-08 13:42:29'),
(11, 3, 10, 2, 'Sales', 4, '0000-00-00', 0, '{\"price\":\"10\",\"qty\":\"10\"}', 'Stock out from Sales-01966403\n', '2020-10-08 13:43:08'),
(12, 8, 500, 1, 'receiving', 3, '2021-04-29', 0, '{\"price\":\"10\",\"qty\":\"500\"}', 'Stock from Receiving-95300488\n', '2020-10-09 08:17:29'),
(13, 8, 10, 2, 'Sales', 5, '0000-00-00', 0, '{\"price\":\"15\",\"qty\":\"10\"}', 'Stock out from Sales-16232790\n', '2020-10-09 08:19:04'),
(14, 3, 10, 2, 'Sales', 5, '0000-00-00', 0, '{\"price\":\"10\",\"qty\":\"10\"}', 'Stock out from Sales-16232790\n', '2020-10-09 08:19:04'),
(15, 3, 20, 1, 'receiving', 4, '2024-04-12', 0, '{\"price\":\"4000\",\"qty\":\"20\"}', 'Stock from Receiving-27844264\n', '2024-04-06 22:22:16'),
(16, 3, 10, 2, 'Sales', 6, '0000-00-00', 0, '{\"price\":\"10\",\"qty\":\"10\"}', 'Stock out from Sales-38470595\n', '2024-04-06 22:42:36'),
(17, 6, 20, 2, 'Sales', 7, '0000-00-00', 0, '{\"price\":\"30\",\"qty\":\"20\"}', 'Stock out from Sales-07920460\n', '2024-04-06 22:44:04'),
(18, 3, 10, 2, 'Sales', 7, '0000-00-00', 0, '{\"price\":\"10\",\"qty\":\"10\"}', 'Stock out from Sales-07920460\n', '2024-04-06 22:44:04');

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `id` int(30) NOT NULL,
  `category_id` text NOT NULL,
  `type_id` int(30) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `name` varchar(150) NOT NULL,
  `measurement` text NOT NULL,
  `description` text NOT NULL,
  `prescription` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `receiving_list`
--

CREATE TABLE `receiving_list` (
  `id` int(30) NOT NULL,
  `ref_no` varchar(100) NOT NULL,
  `supplier_id` int(30) NOT NULL,
  `total_amount` double NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receiving_list`
--

INSERT INTO `receiving_list` (`id`, `ref_no`, `supplier_id`, `total_amount`, `date_added`) VALUES
(1, '83386962\n', 1, 14000, '2020-10-08 10:52:05'),
(2, '00000000\n', 3, 4180, '2020-10-08 11:03:36'),
(3, '95300488\n', 3, 5000, '2020-10-09 08:17:29'),
(4, '27844264\n', 3, 80000, '2024-04-06 22:22:16');

-- --------------------------------------------------------

--
-- Table structure for table `sales_list`
--

CREATE TABLE `sales_list` (
  `id` int(30) NOT NULL,
  `ref_no` varchar(30) NOT NULL,
  `customer_id` int(30) NOT NULL,
  `total_amount` double NOT NULL,
  `amount_tendered` double NOT NULL,
  `amount_change` double NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_list`
--

INSERT INTO `sales_list` (`id`, `ref_no`, `customer_id`, `total_amount`, `amount_tendered`, `amount_change`, `date_updated`) VALUES
(2, '00000000\n', 0, 310, 400, 90, '2020-10-08 13:23:13'),
(3, '74800422\n', 0, 200, 200, 0, '2020-10-08 13:42:29'),
(4, '01966403\n', 0, 100, 100, 0, '2020-10-08 13:43:08'),
(5, '16232790\n', 1, 250, 300, 50, '2020-10-09 08:19:04'),
(6, '38470595\n', 2, 100, 500, 400, '2024-04-06 22:42:36'),
(7, '07920460\n', 2, 700, 800, 100, '2024-04-06 22:44:04');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_list`
--

CREATE TABLE `supplier_list` (
  `id` int(30) NOT NULL,
  `supplier_name` text NOT NULL,
  `contact` varchar(30) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier_list`
--

INSERT INTO `supplier_list` (`id`, `supplier_name`, `contact`, `address`) VALUES
(1, 'Supplier 1', '65524556', 'Sample Address'),
(3, 'Supplier 2', '6546531', 'Supplier2 Address'),
(4, 'Supplier 3', '85655466', 'Sample supplier address');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'Online Food Ordering System', 'info@sample.com', '+6948 8542 623', '1600654680_photo-1504674900247-0877df9cc836.jpg', '&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;ABOUT US&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;background: transparent; position: relative; font-size: 14px;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;&lt;b style=&quot;margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Lorem Ipsum&lt;/b&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#x2019;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;br&gt;&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;background: transparent; position: relative; font-size: 14px;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;background: transparent; position: relative; font-size: 14px;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;&lt;h2 style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;Where does it come from?&lt;/h2&gt;&lt;p style=&quot;text-align: center; margin-bottom: 15px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400;&quot;&gt;Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.&lt;/p&gt;&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `type_list`
--

CREATE TABLE `type_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type_list`
--

INSERT INTO `type_list` (`id`, `name`) VALUES
(1, 'Electronics'),
(2, 'Clothing'),
(3, 'Medicine '),
(4, 'Food and Beverages'),
(5, 'Beauty care products'),
(6, 'Sample Type'),
(7, 'Office Supplies'),
(8, 'Sports Goods'),
(9, 'Furniture');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=admin , 2 = cashier'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(1, 'Administrator', 'admin', 'admin123', 1),
(4, 'John Smith', 'jsmith', 'jsmith123', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_list`
--
ALTER TABLE `customer_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expired_product`
--
ALTER TABLE `expired_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receiving_list`
--
ALTER TABLE `receiving_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_list`
--
ALTER TABLE `sales_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_list`
--
ALTER TABLE `supplier_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_list`
--
ALTER TABLE `type_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `customer_list`
--
ALTER TABLE `customer_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expired_product`
--
ALTER TABLE `expired_product`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `receiving_list`
--
ALTER TABLE `receiving_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales_list`
--
ALTER TABLE `sales_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `supplier_list`
--
ALTER TABLE `supplier_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `type_list`
--
ALTER TABLE `type_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
