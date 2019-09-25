-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 25, 2019 at 03:43 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social`
--
CREATE DATABASE IF NOT EXISTS `social` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `social`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'root', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `blocked_ips`
--

CREATE TABLE IF NOT EXISTS `blocked_ips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ips` varchar(32) NOT NULL,
  `blocked_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blocked_ips`
--

INSERT INTO `blocked_ips` (`id`, `ips`, `blocked_date`) VALUES
(1, '127.0.0.1', '2019-09-25'),
(2, '127.0.0.1', '2019-09-25');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_body` text NOT NULL,
  `posted_by` varchar(100) NOT NULL,
  `posted_to` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL,
  `removed` varchar(3) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_body`, `posted_by`, `posted_to`, `date_added`, `removed`, `post_id`) VALUES
(1, 'You\'re such a genius, man.', 'arjun_adhikari', 'sunil_gautam', '2019-09-24 17:32:17', 'no', 4),
(2, 'Haha, I comment on my own.\r\n', 'arjun_adhikari', 'arjun_adhikari', '2019-09-24 18:40:28', 'no', 11),
(3, 'No need to comment here.', 'arjun_adhikari', 'arjun_adhikari', '2019-09-24 18:49:52', 'no', 13),
(4, 'I commented a youtube video here.', 'arjun_adhikari', 'arjun_adhikari', '2019-09-24 20:05:54', 'no', 17),
(5, 'Wow, man.\r\nThis video is lit.', 'samir_poudel', 'arjun_adhikari', '2019-09-24 20:07:21', 'no', 17),
(6, 'Can I get more detail about this video ?', 'samir_poudel', 'arjun_adhikari', '2019-09-24 20:09:35', 'no', 17),
(7, 'Wow, I mean how can you create such videos on the platform ?', 'sunil_gautam', 'arjun_adhikari', '2019-09-24 20:20:27', 'no', 17),
(8, 'Wow, you\'re sharing in a great way.\r\nKeep sharing.', 'samir_poudel', 'arjun_adhikari', '2019-09-25 01:16:35', 'no', 20),
(9, 'Wow !', 'arjun_adhikari', 'arjun_adhikari', '2019-09-25 07:00:35', 'no', 29),
(10, 'This is lit.', 'arjun_adhikari', 'arjun_adhikari', '2019-09-25 08:28:57', 'no', 29),
(11, 'Wow', 'sunil_gautam', 'arjun_adhikari', '2019-09-25 09:28:26', 'no', 37),
(12, 'You\'re doing great.', 'samir_poudel', 'arjun_adhikari', '2019-09-25 09:29:23', 'no', 37);

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE IF NOT EXISTS `friend_requests` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `username`, `post_id`) VALUES
(1, 'arjun_adhikari', 4),
(2, 'arjun_adhikari', 11),
(4, 'samir_poudel', 17),
(5, 'sunil_gautam', 17),
(6, 'arjun_adhikari', 29),
(8, 'sunil_gautam', 37),
(9, 'samir_poudel', 37),
(10, 'arjun_adhikari', 35);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_to`, `user_from`, `body`, `date`, `opened`, `viewed`, `deleted`) VALUES
(0, 'arjun_adhikari', 'arjun_adhikari', 'Hello myself.', '2019-09-24 13:22:34', 'yes', 'no', 'no'),
(0, 'arjun_adhikari', 'arjun_adhikari', 'What I want to do here.', '2019-09-24 13:22:48', 'yes', 'no', 'no'),
(0, 'arjun_adhikari', 'sunil_gautam', 'Hello Arjun Adhikari', '2019-09-24 13:29:47', 'yes', 'no', 'no'),
(0, 'sunil_gautam', 'arjun_adhikari', 'Hello Sunil Gautam', '2019-09-24 13:31:22', 'yes', 'no', 'no'),
(0, 'arjun_adhikari', 'sunil_gautam', 'What are you doing today ?', '2019-09-24 13:31:53', 'yes', 'no', 'no'),
(0, 'arjun_adhikari', 'sunil_gautam', 'What are you doing today ?', '2019-09-24 13:38:26', 'yes', 'no', 'no'),
(0, 'samir_poudel', 'sunil_gautam', 'Hello Samir', '2019-09-24 13:58:35', 'yes', 'no', 'no'),
(0, 'samir_poudel', 'sunil_gautam', 'What is to be done here.', '2019-09-24 14:07:10', 'yes', 'no', 'no'),
(0, 'sunil_gautam', 'samir_poudel', 'Nothing bro.', '2019-09-24 14:07:38', 'yes', 'no', 'no'),
(0, 'arjun_adhikari', 'arjun_adhikari', 'Okay, then do then.', '2019-09-24 19:03:44', 'yes', 'no', 'no'),
(0, 'arjun_adhikari', 'arjun_adhikari', 'Sure, you will.', '2019-09-24 19:05:52', 'yes', 'no', 'no'),
(0, 'samir_poudel', 'arjun_adhikari', 'Hello Man', '2019-09-24 21:50:40', 'yes', 'no', 'no'),
(0, 'arjun_adhikari', 'samir_poudel', 'Nice to meet you', '2019-09-24 21:51:10', 'yes', 'no', 'no'),
(0, 'arjun_adhikari', 'arjun_adhikari', 'I need to talk to myself, bye.', '2019-09-25 01:41:44', 'yes', 'no', 'no'),
(0, 'arjun_adhikari', 'arjun_adhikari', 'Bye', '2019-09-25 01:42:22', 'yes', 'no', 'no'),
(0, 'sunil_gautam', 'arjun_adhikari', 'Finally, completed.', '2019-09-25 06:42:14', 'yes', 'no', 'no'),
(0, 'sunil_gautam', 'arjun_adhikari', 'We are on D Day.', '2019-09-25 09:26:21', 'yes', 'no', 'no'),
(0, 'sunil_gautam', 'arjun_adhikari', 'Okay.', '2019-09-25 09:27:50', 'yes', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `link` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_to`, `user_from`, `message`, `link`, `datetime`, `opened`, `viewed`) VALUES
(0, 'sunil_gautam', 'arjun_adhikari', 'Arjun Adhikari liked your post', 'post.php?id=4', '2019-09-24 14:13:53', 'yes', 'no'),
(0, '', 'arjun_adhikari', 'Arjun Adhikari commented on your profile post', 'post.php?id=11', '2019-09-24 18:40:28', 'no', 'no'),
(0, 'arjun_adhikari', 'samir_poudel', 'Samir Poudel liked your post', 'post.php?id=17', '2019-09-24 20:06:14', 'yes', 'no'),
(0, 'arjun_adhikari', 'samir_poudel', 'Samir Poudel commented on your post', 'post.php?id=17', '2019-09-24 20:07:21', 'yes', 'no'),
(0, 'arjun_adhikari', 'samir_poudel', 'Samir Poudel commented on your post', 'post.php?id=17', '2019-09-24 20:09:35', 'yes', 'no'),
(0, 'arjun_adhikari', 'sunil_gautam', 'Sunil Gautam liked your post', 'post.php?id=17', '2019-09-24 20:20:12', 'yes', 'no'),
(0, 'arjun_adhikari', 'sunil_gautam', 'Sunil Gautam commented on your post', 'post.php?id=17', '2019-09-24 20:20:27', 'yes', 'no'),
(0, 'samir_poudel', 'sunil_gautam', 'Sunil Gautam commented on a post you commented on', 'post.php?id=17', '2019-09-24 20:20:27', 'yes', 'no'),
(0, '', 'arjun_adhikari', 'Arjun Adhikari liked your post', 'post.php?id=21', '2019-09-25 00:20:09', 'no', 'no'),
(0, 'arjun_adhikari', 'samir_poudel', 'Samir Poudel commented on your post', 'post.php?id=20', '2019-09-25 01:16:35', 'yes', 'no'),
(0, 'samir_poudel', 'arjun_adhikari', 'Arjun Adhikari liked your post', 'post.php?id=35', '2019-09-25 08:29:09', 'no', 'no'),
(0, 'arjun_adhikari', 'sunil_gautam', 'Sunil Gautam liked your post', 'post.php?id=37', '2019-09-25 09:28:21', 'yes', 'no'),
(0, 'arjun_adhikari', 'sunil_gautam', 'Sunil Gautam commented on your post', 'post.php?id=37', '2019-09-25 09:28:26', 'yes', 'no'),
(0, 'arjun_adhikari', 'samir_poudel', 'Samir Poudel liked your post', 'post.php?id=37', '2019-09-25 09:29:14', 'yes', 'no'),
(0, 'arjun_adhikari', 'samir_poudel', 'Samir Poudel commented on your post', 'post.php?id=37', '2019-09-25 09:29:23', 'yes', 'no'),
(0, 'sunil_gautam', 'samir_poudel', 'Samir Poudel commented on a post you commented on', 'post.php?id=37', '2019-09-25 09:29:23', 'yes', 'no'),
(0, 'samir_poudel', 'arjun_adhikari', 'Subash Adhikari liked your post', 'post.php?id=35', '2019-09-25 12:14:12', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` text NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `user_to` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL,
  `likes` int(11) NOT NULL,
  `image` varchar(255) DEFAULT '#',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `user_to`, `date_added`, `user_closed`, `deleted`, `likes`, `image`) VALUES
(12, 'A professional is neat in appearance. Be sure to meet or even exceed the requirements of your company\'s dress code, and pay special attention to your appearance when meeting with prospects or clients. Even if your workplace tends towards the casual, strive for snappy casual rather than sloppy casual. Keep something a bit dressier handy in case the big boss or an important client happens by.\r\n', 'arjun_adhikari', 'none', '2019-09-24 18:48:49', 'no', 'no', 0, ''),
(13, 'Professionals such as doctors, lawyers and public accountants must adhere to a strict code of ethics. Even if your company or industry doesn\'t have a written code, you should display ethical behavior at all times. It\'s not just a matter of the #MeToo movement; extend professional, respectful, appropriate behavior to everyone you do business with and in every situation you find yourself in.\r\n', 'arjun_adhikari', 'none', '2019-09-24 18:48:57', 'no', 'no', 0, ''),
(14, 'Professionals such as doctors, lawyers and public accountants must adhere to a strict code of ethics. Even if your company or industry doesn\'t have a written code, you should display ethical behavior at all times. It\'s not just a matter of the #MeToo movement; extend professional, respectful, appropriate behavior to everyone you do business with and in every situation you find yourself in.\r\n', 'arjun_adhikari', 'none', '2019-09-24 18:52:15', 'no', 'no', 0, ''),
(15, 'A professional must maintain his poise even when facing a difficult situation. For example, if a colleague or client treats you in a belligerent manner, you should not resort to the same type of behavior.\r\n', 'arjun_adhikari', 'none', '2019-09-24 19:05:39', 'no', 'no', 0, ''),
(16, 'A professional can quickly and easily find what is needed. Your work area should be neat and organized, and your briefcase should contain only what is needed for your appointment or presentation. Few things say \"unprofessional\" as quickly as a hopelessly cluttered, messy work area.\r\n', 'arjun_adhikari', 'none', '2019-09-24 19:09:41', 'no', 'no', 0, ''),
(20, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/QmvAYDc4UUw\'></iframe><br>', 'arjun_adhikari', 'none', '2019-09-25 00:06:04', 'no', 'no', 0, ''),
(26, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/_Gpe1Zn-1fE\'></iframe><br>', 'samir_poudel', 'none', '2019-09-25 01:16:56', 'no', 'no', 0, ''),
(27, 'Wow, Today I earned this.', 'samir_poudel', 'none', '2019-09-25 01:21:38', 'no', 'no', 0, 'assets/images/posts/post13324.png'),
(28, 'Tutorial for renaming files in bundle !', 'arjun_adhikari', 'none', '2019-09-25 02:52:24', 'no', 'no', 0, 'assets/images/posts/post31423.png'),
(29, 'It\'s hard to earn this !', 'arjun_adhikari', 'none', '2019-09-25 02:53:46', 'no', 'no', 1, 'assets/images/posts/post71632.png'),
(30, 'Finally honored with the title !', 'samir_poudel', 'none', '2019-09-25 03:00:08', 'no', 'no', 0, 'assets/images/posts/post10009.png'),
(31, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/LxfUGhug-iQ\'></iframe><br>', 'samir_poudel', 'none', '2019-09-25 03:03:16', 'no', 'no', 0, ''),
(35, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/Jy9-aGMB_TE\'></iframe><br> This is so lit video.', 'samir_poudel', 'none', '2019-09-25 03:06:40', 'no', 'no', 1, ''),
(36, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/gclhw5WTT-4\'></iframe><br>', 'arjun_adhikari', 'none', '2019-09-25 09:25:08', 'no', 'no', 0, ''),
(37, 'I earned this.', 'arjun_adhikari', 'none', '2019-09-25 09:25:42', 'no', 'no', 2, 'assets/images/posts/post44465.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `trends`
--

CREATE TABLE IF NOT EXISTS `trends` (
  `title` varchar(50) NOT NULL,
  `hits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `num_posts` int(11) NOT NULL,
  `num_likes` int(11) NOT NULL,
  `user_closed` varchar(3) DEFAULT NULL,
  `friend_array` text NOT NULL,
  `status` varchar(10) DEFAULT 'normal',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friend_array`, `status`) VALUES
(1, 'Subash', 'Adhikari', 'arjun_adhikari', 'Arjun@gmail.com', '451d3eb1573c7ebb70c08dfee9766509', '2019-09-24', 'assets/images/profile_pics/display-picture610.jpg', 29, 6, 'no', ',samir_poudel,biswas_ojha,sunil_gautam,', 'normal'),
(2, 'Sunil', 'Gautam', 'sunil_gautam', 'Sunil@gmail.com', '48ccc87cd7afb85704a63e8d5953d326', '2019-09-24', 'assets/images/profile_pics/display-picture157.jpg', 1, 1, 'no', ',arjun_adhikari,', 'blocked'),
(3, 'Samir', 'Poudel', 'samir_poudel', 'Samir@gmail.com', '25fce9ba0ce66b82148637dfc19a0832', '2019-09-24', 'assets/images/profile_pics/display-picture385.jpg', 10, 1, 'no', ',arjun_adhikari,', 'normal'),
(4, 'Ashish', 'Paudel', 'ashish_paudel', 'Ashish@gmail.com', 'a15f2c0ef7b4bd3c06bfc0ea172a6e78', '2019-09-24', 'assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'yes', ',', 'normal'),
(5, 'Biswas', 'Ojha', 'biswas_ojha', 'Biswas@gmail.com', 'd061f612b6212ef0a67dd9bf6464feb9', '2019-09-25', 'assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'no', ',arjun_adhikari,', 'blocked');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
