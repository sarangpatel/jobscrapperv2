-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2016 at 08:04 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `receipt`
--

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE IF NOT EXISTS `receipts` (
`id` bigint(20) NOT NULL,
  `full_name` varchar(200) COLLATE utf8_bin NOT NULL,
  `ref_no` varchar(50) COLLATE utf8_bin NOT NULL,
  `ref_date` varchar(50) COLLATE utf8_bin NOT NULL,
  `active` int(11) DEFAULT '1',
  `added_on` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `full_name`, `ref_no`, `ref_date`, `active`, `added_on`) VALUES
(9, 'Sarang Patel', '2323', '2016-02-22', 1, '2016-04-24 19:45:26');

-- --------------------------------------------------------

--
-- Table structure for table `receipt_particulars`
--

CREATE TABLE IF NOT EXISTS `receipt_particulars` (
`id` bigint(20) NOT NULL,
  `receipt_id` bigint(20) NOT NULL,
  `item_name` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `item_qty` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `item_price` varchar(20) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `receipt_particulars`
--

INSERT INTO `receipt_particulars` (`id`, `receipt_id`, `item_name`, `item_qty`, `item_price`) VALUES
(11, 9, 'Ite manem', '2', '10'),
(12, 9, 'itesma 2', '1', '10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipt_particulars`
--
ALTER TABLE `receipt_particulars`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `receipt_particulars`
--
ALTER TABLE `receipt_particulars`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
