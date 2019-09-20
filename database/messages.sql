-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2019 at 10:14 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pahichaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `msg_body` text NOT NULL,
  `date` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `user_to`, `user_from`, `msg_body`, `date`, `opened`, `viewed`, `deleted`) VALUES
(1, 'john', 'sunil', 'Hey	', '2019-09-04 09:31:13', 'no', 'yes', 'no'),
(2, 'sunil', 'john', 'Hello		', '2019-09-04 09:31:37', 'no', 'yes', 'no'),
(3, 'john', 'sunil', 'How are you 	', '2019-09-04 09:34:37', 'no', 'yes', 'no'),
(4, 'sunil', 'john', '	Fine		', '2019-09-04 09:34:43', 'no', 'yes', 'no'),
(5, 'john', 'sunil', 'Hello Zina		', '2019-09-04 12:02:51', 'no', 'yes', 'no'),
(6, 'sunil', 'john', 'Hy			', '2019-09-04 12:03:01', 'no', 'yes', 'no'),
(7, 'john', 'sunil', 'John	', '2019-09-04 19:30:25', 'no', 'yes', 'no'),
(8, 'sunil', 'john', 'Yes		', '2019-09-04 19:30:35', 'no', 'yes', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
