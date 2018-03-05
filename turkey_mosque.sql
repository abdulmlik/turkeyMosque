-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2017 at 09:12 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `turkey_mosque`
--
CREATE DATABASE IF NOT EXISTS `turkey_mosque` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `turkey_mosque`;

-- --------------------------------------------------------

--
-- Table structure for table `mosque_info`
--

CREATE TABLE `mosque_info` (
  `price` float NOT NULL,
  `scription` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mosque_info`
--

INSERT INTO `mosque_info` (`price`, `scription`) VALUES
(40, 'two star');

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE `picture` (
  `pic_no` tinyint(4) NOT NULL,
  `pic_path` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`pic_no`, `pic_path`) VALUES
(1, 'C:\\wamp64\\www\\assignment\\images\\Screenshot.png');

-- --------------------------------------------------------

--
-- Table structure for table `resv_info`
--

CREATE TABLE `resv_info` (
  `r_no` int(11) NOT NULL,
  `u_no` smallint(6) NOT NULL,
  `paid` float NOT NULL,
  `r_date` date NOT NULL,
  `type` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `resv_info`
--

INSERT INTO `resv_info` (`r_no`, `u_no`, `paid`, `r_date`, `type`) VALUES
(1, 2, 0, '2017-02-06', 0),
(2, 3, 0, '2017-02-07', 0),
(3, 5, 40, '2017-01-24', 1),
(4, 5, 40, '2017-01-28', 1),
(5, 3, 40, '2017-01-26', 1),
(6, 2, 40, '2017-02-08', 1),
(7, 5, 0, '2017-02-20', 0),
(13, 3, 0, '2017-02-14', 0),
(15, 1, 40, '2017-10-30', 1),
(16, 1, 0, '2017-11-07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `u_no` smallint(6) NOT NULL,
  `u_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `priv` tinyint(2) NOT NULL,
  `Name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `address` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `telphone` char(14) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`u_no`, `u_name`, `password`, `priv`, `Name`, `address`, `telphone`, `email`) VALUES
(1, 'abdulmalik', '12345678', 1, 'abdulmalik', 'ly', '234-3552387', 'abdulmalik_101@outlook.com'),
(2, 'ali', '12345678', 2, '', 'tr', '256-3645234', 'asdf@outlook.com'),
(3, 'ahmed', '12345678', 2, 'red', 'tripoli-libya', '234-3365778', 'qwert@gmail.com'),
(5, 'hammam', '12345678', 2, NULL, 'tr', '234-863452', 'hammam@yahoo.com'),
(6, 'gjk', '1234567', 2, NULL, NULL, NULL, 'hgkk@hmbm.jg'),
(7, 'andsgnk', '0000', 2, NULL, NULL, NULL, 'bbbbbb@kkg.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`pic_no`);

--
-- Indexes for table `resv_info`
--
ALTER TABLE `resv_info`
  ADD PRIMARY KEY (`r_no`),
  ADD UNIQUE KEY `r_date` (`r_date`),
  ADD KEY `u_no` (`u_no`),
  ADD KEY `u_no_2` (`u_no`),
  ADD KEY `u_no_3` (`u_no`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`u_no`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `u_name` (`u_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
  MODIFY `pic_no` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `resv_info`
--
ALTER TABLE `resv_info`
  MODIFY `r_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `u_no` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `resv_info`
--
ALTER TABLE `resv_info`
  ADD CONSTRAINT `link_1` FOREIGN KEY (`u_no`) REFERENCES `user_info` (`u_no`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
