-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2020 at 11:10 AM
-- Server version: 5.5.29-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_media`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentid` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentid`, `content`, `timestamp`, `user_id`, `post_id`) VALUES
(1, 'First comment on first post.', '2020-02-18 11:28:24', 3, 1),
(2, 'Second comment on second post.', '2020-02-18 11:28:26', 3, 2),
(3, 'Second comment on First post.', '2020-02-23 20:41:22', 3, 1),
(4, 'First comment from the comment section', '2020-02-25 16:40:15', 2, 1),
(5, 'Second comment made from comments section.\r\n', '2020-02-25 16:59:02', 2, 4),
(6, 'You\'re wrong', '2020-02-27 10:18:12', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `post_info`
--

CREATE TABLE `post_info` (
  `postid` int(11) NOT NULL,
  `title` varchar(25) NOT NULL,
  `content` varchar(500) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL,
  `ytlink` varchar(50) NOT NULL,
  `imagelink` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_info`
--

INSERT INTO `post_info` (`postid`, `title`, `content`, `timestamp`, `userid`, `ytlink`, `imagelink`) VALUES
(1, 'Title 1', 'First post on my website', '2020-02-18 11:10:54', 2, '', ''),
(2, 'Title 2', 'Second post on my website', '2020-02-18 11:10:57', 2, '', ''),
(3, 'Something', 'POST ABOUT SOMETHING', '2020-02-24 15:30:52', 3, '', ''),
(4, 'Test title', 'First post made from the popup form.', '2020-02-25 11:55:27', 2, '', ''),
(5, 'website', 'websites are good', '2020-02-27 10:17:55', 2, '', ''),
(6, 'FREE Money here', '<b> This is bad </b>', '2020-03-07 14:28:37', 3, 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'wp.jpg'),
(7, 'Final image free post', 'Last test without images', '2020-03-16 14:05:34', 4, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `password` varchar(2000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `profile` varchar(255) NOT NULL,
  `otp` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `firstname`, `lastname`, `password`, `date`, `profile`, `otp`) VALUES

(3, 'adminJab@sms.com', 'Admin', '', '', '$2y$10$9.D43AWSkoaLTKoC.qMZo.WZzH4Z94AzhRX/61of//Z/aETmwrhzG', '2020-02-13 14:03:08', 'icons8-cloud-connection-100.png', NULL),

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentid`),
  ADD KEY `post_id_fk` (`post_id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Indexes for table `post_info`
--
ALTER TABLE `post_info`
  ADD PRIMARY KEY (`postid`),
  ADD KEY `user_id_foreignkey` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `otp` (`otp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `post_info`
--
ALTER TABLE `post_info`
  MODIFY `postid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `post_id_fk` FOREIGN KEY (`post_id`) REFERENCES `post_info` (`postid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_info`
--
ALTER TABLE `post_info`
  ADD CONSTRAINT `user_id_foreignkey` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
