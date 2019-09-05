-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2019 at 08:11 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `websalesmodify`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `id` int(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`id`, `email`, `password`) VALUES
(1, 'John Godstime', '$2y$10$G56YBThqyNlua7vO.QX2QeU9/L4BcBqyd464iqoM0Lo/i5mGG6ElW'),
(2, 'admin', '$2y$10$zRe8Ii/45irUzBIVXAefDeNOthtdMHsyk8IxPeAYzPEzm9HzGLUKa');

-- --------------------------------------------------------

--
-- Table structure for table `category_tbl`
--

CREATE TABLE `category_tbl` (
  `id` int(11) NOT NULL,
  `categoryname` varchar(80) NOT NULL,
  `createdat` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_tbl`
--

INSERT INTO `category_tbl` (`id`, `categoryname`, `createdat`) VALUES
(1, 'Wale', '2019-04-03 20:48:59'),
(2, 'Shark', '2019-04-03 22:11:25');

-- --------------------------------------------------------

--
-- Table structure for table `materialuse_tbl`
--

CREATE TABLE `materialuse_tbl` (
  `id` bigint(20) NOT NULL,
  `materialid` bigint(20) NOT NULL,
  `kg` int(11) NOT NULL,
  `createdat` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materialuse_tbl`
--

INSERT INTO `materialuse_tbl` (`id`, `materialid`, `kg`, `createdat`) VALUES
(1, 1, 5, '26-04-2019'),
(2, 1, 5, '26-04-2019'),
(3, 2, 2, '26-04-2019'),
(4, 2, 2, '26-04-2019'),
(5, 3, 3, '26-04-2019'),
(6, 3, 3, '26-04-2019'),
(7, 1, 2, '27-04-2019'),
(8, 2, 2, '27-04-2019'),
(9, 3, 2, '27-04-2019');

-- --------------------------------------------------------

--
-- Table structure for table `material_tbl`
--

CREATE TABLE `material_tbl` (
  `id` int(11) NOT NULL,
  `materialname` varchar(80) NOT NULL,
  `createdat` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material_tbl`
--

INSERT INTO `material_tbl` (`id`, `materialname`, `createdat`) VALUES
(1, 'Material 1', '2019-04-03 20:48:59'),
(2, 'material 2', '2019-04-03 22:11:25'),
(3, 'Material 3', '2019-04-26 16:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE `product_tbl` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `productname` text NOT NULL,
  `unitprice` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` text NOT NULL,
  `entrydate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`id`, `categoryid`, `productname`, `unitprice`, `quantity`, `image`, `entrydate`) VALUES
(1, 1, 'Product 1', 200, 25, '913594421726.jpg', '2019-04-03 22:52:30'),
(2, 2, 'Product 2', 800, 0, '666893132801.jpg', '2019-04-03 22:53:21'),
(3, 1, 'Product 3', 100, 6, '632192923922.jpg', '2019-04-03 22:54:11'),
(4, 0, 'Product 4', 300, 1, '', '2019-07-22 18:10:12');

-- --------------------------------------------------------

--
-- Table structure for table `sales_tbl`
--

CREATE TABLE `sales_tbl` (
  `id` bigint(20) NOT NULL,
  `invoiceid` varchar(20) NOT NULL,
  `staffid` int(11) NOT NULL,
  `customername` varchar(90) NOT NULL,
  `phonenumber` varchar(15) NOT NULL,
  `productinfo` text NOT NULL,
  `totalcost` int(11) NOT NULL,
  `transactiondate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_tbl`
--

INSERT INTO `sales_tbl` (`id`, `invoiceid`, `staffid`, `customername`, `phonenumber`, `productinfo`, `totalcost`, `transactiondate`) VALUES
(2, 'PRC-2', 2, 'Iniobong', '090990909', 'a:1:{i:0;a:4:{s:9:\"productId\";s:1:\"1\";s:15:\"productQuantity\";s:1:\"2\";s:9:\"unitPrice\";s:3:\"200\";s:5:\"total\";i:400;}}', 400, '04-04-2019'),
(3, 'PRC-3', 2, 'Erim', '09009099', 'a:1:{i:0;a:4:{s:9:\"productId\";s:1:\"2\";s:15:\"productQuantity\";s:1:\"1\";s:9:\"unitPrice\";s:3:\"800\";s:5:\"total\";i:800;}}', 800, '03-04-2019'),
(4, 'PRC-4', 2, 'Ikwo', '0909989', 'a:1:{i:0;a:4:{s:9:\"productId\";s:1:\"1\";s:15:\"productQuantity\";s:1:\"1\";s:9:\"unitPrice\";s:3:\"200\";s:5:\"total\";i:200;}}', 200, '05-04-2019'),
(5, 'PRC-5', 2, 'iffiok', '99898999', 'a:1:{i:0;a:4:{s:9:\"productId\";s:1:\"1\";s:15:\"productQuantity\";s:1:\"3\";s:9:\"unitPrice\";s:3:\"200\";s:5:\"total\";i:600;}}', 600, '05-04-2019'),
(6, 'PRC-6', 2, 'John', '09009899', 'a:1:{i:0;a:4:{s:9:\"productId\";s:1:\"4\";s:15:\"productQuantity\";s:1:\"3\";s:9:\"unitPrice\";s:3:\"300\";s:5:\"total\";i:900;}}', 900, '22-07-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_tbl`
--
ALTER TABLE `category_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materialuse_tbl`
--
ALTER TABLE `materialuse_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_tbl`
--
ALTER TABLE `material_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_tbl`
--
ALTER TABLE `sales_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category_tbl`
--
ALTER TABLE `category_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `materialuse_tbl`
--
ALTER TABLE `materialuse_tbl`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `material_tbl`
--
ALTER TABLE `material_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales_tbl`
--
ALTER TABLE `sales_tbl`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
