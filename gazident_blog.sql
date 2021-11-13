-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 10, 2021 at 01:12 AM
-- Server version: 10.3.31-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gazident_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `cat_image` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'no_category.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `cat_image`) VALUES
(17, 'Diş Hekimliği', 'no_category.png'),
(18, 'Endodonti', 'no_category.png');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `comment_email` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `comment_content` mediumtext COLLATE utf8mb4_turkish_ci NOT NULL,
  `comment_reply` mediumtext COLLATE utf8mb4_turkish_ci NOT NULL,
  `comment_reply_date` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `comment_status` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `comment_date` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `friend_ls` varchar(1000) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `friend_request` varchar(1000) COLLATE utf8mb4_turkish_ci DEFAULT 'System',
  `received_request` varchar(1000) COLLATE utf8mb4_turkish_ci DEFAULT 'System'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `friends`
--


-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `msg_id` int(10) NOT NULL,
  `msg_status` varchar(10) COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'Panding',
  `msg_date` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `msg_author` varchar(60) COLLATE utf8mb4_turkish_ci NOT NULL,
  `msg_subject` varchar(70) COLLATE utf8mb4_turkish_ci NOT NULL,
  `author_email` varchar(70) COLLATE utf8mb4_turkish_ci NOT NULL,
  `msg_content` mediumtext COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`msg_id`, `msg_status`, `msg_date`, `msg_author`, `msg_subject`, `author_email`, `msg_content`) VALUES
(18, 'replied', '2021-09-21 01:16:28 AM', 'Deneme', 'Deneme', 'akifesadi193@gmail.com', 'Deneme amaÃ§lÄ± atÄ±lmÄ±ÅŸtÄ±r'),
(19, 'replied', '2021-10-16 11:43:27 PM', 'Da', 'BaÅŸarÄ±lar', 'husoerdog@yandex.com', 'Sitenizi Ã§ok beÄŸendim, baÅŸarÄ±larÄ±nÄ±zÄ±n devamÄ±nÄ± dilerim');

-- --------------------------------------------------------

--
-- Table structure for table `message_rooms`
--

CREATE TABLE `message_rooms` (
  `id` int(11) NOT NULL,
  `room_title` varchar(200) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `room_participiants` varchar(1000) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `room_password` varchar(1000) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `room_owner_username` varchar(50) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `messages` longtext COLLATE utf8mb4_turkish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `message_rooms`
--

-- --------------------------------------------------------

--
-- Table structure for table `online_users`
--

CREATE TABLE `online_users` (
  `id` int(3) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `session` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `post_author` varchar(55) COLLATE utf8mb4_turkish_ci NOT NULL,
  `post_date` varchar(70) COLLATE utf8mb4_turkish_ci NOT NULL,
  `post_image` mediumtext COLLATE utf8mb4_turkish_ci NOT NULL,
  `post_content` mediumtext COLLATE utf8mb4_turkish_ci NOT NULL,
  `post_tags` mediumtext COLLATE utf8mb4_turkish_ci NOT NULL,
  `post_comment_count` int(3) NOT NULL,
  `post_status` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'draft',
  `post_views_count` int(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `posts`
--


-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(3) NOT NULL,
  `css` varchar(30) COLLATE utf8mb4_turkish_ci NOT NULL,
  `admin_access` varchar(30) COLLATE utf8mb4_turkish_ci NOT NULL,
  `site_status` varchar(30) COLLATE utf8mb4_turkish_ci NOT NULL,
  `url` varchar(30) COLLATE utf8mb4_turkish_ci NOT NULL,
  `admin_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `css`, `admin_access`, `site_status`, `url`, `admin_id`) VALUES
(1, '', 'no', 'hidden', '', 33);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(4) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_firstname` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_lastname` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_sex` varchar(10) COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_birthday` date NOT NULL,
  `user_city` varchar(20) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `user_country` varchar(20) COLLATE utf8mb4_turkish_ci DEFAULT 'Türkiye',
  `user_number` varchar(20) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `user_lastlogin` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_reg` varchar(30) COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_email` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_password` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_image` varchar(250) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `user_role` varchar(20) COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_likes` int(10) NOT NULL DEFAULT 0,
  `user_interests` varchar(20) COLLATE utf8mb4_turkish_ci DEFAULT 'Diş Hekimliği',
  `user_status` varchar(250) COLLATE utf8mb4_turkish_ci DEFAULT 'like good',
  `user_message_rooms` varchar(200) COLLATE utf8mb4_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_inbox`
--

CREATE TABLE `user_inbox` (
  `msg_id` int(2) NOT NULL,
  `msg_sent` varchar(255) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `msg_author_id` int(3) NOT NULL,
  `msg_author` varchar(60) COLLATE utf8mb4_turkish_ci NOT NULL,
  `msg_subject` varchar(70) COLLATE utf8mb4_turkish_ci NOT NULL,
  `msg_content` mediumtext COLLATE utf8mb4_turkish_ci NOT NULL,
  `msg_date` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `msg_reply_status` varchar(10) COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'Unreplied'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `user_inbox`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `message_rooms`
--
ALTER TABLE `message_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_users`
--
ALTER TABLE `online_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_inbox`
--
ALTER TABLE `user_inbox`
  ADD PRIMARY KEY (`msg_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `msg_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `message_rooms`
--
ALTER TABLE `message_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `online_users`
--
ALTER TABLE `online_users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `user_inbox`
--
ALTER TABLE `user_inbox`
  MODIFY `msg_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
