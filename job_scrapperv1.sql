-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2015 at 09:49 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `job_scrapperv1`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
`id` bigint(20) NOT NULL,
  `site_id` bigint(20) NOT NULL,
  `job_title` varchar(400) COLLATE utf8_bin NOT NULL,
  `job_url` text COLLATE utf8_bin NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `job_status` varchar(15) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1828 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `job_activities`
--

CREATE TABLE IF NOT EXISTS `job_activities` (
`id` bigint(20) NOT NULL,
  `job_id` bigint(20) NOT NULL,
  `site_id` bigint(20) NOT NULL,
  `change_activity` varchar(20) COLLATE utf8_bin NOT NULL,
  `recorded_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4033 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `job_count`
--

CREATE TABLE IF NOT EXISTS `job_count` (
`id` bigint(20) NOT NULL,
  `site_id` bigint(20) NOT NULL,
  `recorded_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `open_jobs` bigint(20) NOT NULL DEFAULT '0',
  `expired_jobs` bigint(20) NOT NULL DEFAULT '0',
  `new_jobs` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE IF NOT EXISTS `sites` (
`id` bigint(20) NOT NULL,
  `site_url` varchar(200) COLLATE utf8_bin NOT NULL,
  `job_url` varchar(900) COLLATE utf8_bin NOT NULL,
  `job_email` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `contact_email` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `linkedin` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `facebook` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `twitter` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=21077 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
 ADD PRIMARY KEY (`id`), ADD KEY `site_id` (`site_id`);

--
-- Indexes for table `job_activities`
--
ALTER TABLE `job_activities`
 ADD PRIMARY KEY (`id`), ADD KEY `site_id` (`site_id`,`recorded_on`);

--
-- Indexes for table `job_count`
--
ALTER TABLE `job_count`
 ADD PRIMARY KEY (`id`), ADD KEY `recorded_on` (`recorded_on`), ADD KEY `site_id` (`site_id`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1828;
--
-- AUTO_INCREMENT for table `job_activities`
--
ALTER TABLE `job_activities`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4033;
--
-- AUTO_INCREMENT for table `job_count`
--
ALTER TABLE `job_count`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21077;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
