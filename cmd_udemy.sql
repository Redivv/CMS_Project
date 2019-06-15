-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 16, 2019 at 01:02 AM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmd_udemy`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(3) NOT NULL,
  `title` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(1, 'Bootstrap'),
(2, 'React'),
(3, 'PHP'),
(4, 'Python'),
(8, 'C++'),
(9, 'MySQL'),
(10, 'Klienci'),
(11, 'Frameworki');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(3) NOT NULL,
  `post_id` int(3) NOT NULL,
  `author_id` int(10) NOT NULL,
  `content` mediumtext COLLATE utf8_polish_ci NOT NULL,
  `date` date NOT NULL,
  `response_count` int(10) NOT NULL DEFAULT '0',
  `response_id` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author_id`, `content`, `date`, `response_count`, `response_id`) VALUES
(1, 1, 1, 's', '2019-06-15', 1, 0),
(2, 1, 1, 's', '2019-06-15', 0, 0),
(3, 1, 1, 'kok', '2019-06-15', 0, 1),
(4, 1, 1, '1', '2019-06-15', 0, 0),
(5, 1, 1, 's', '2019-06-15', 0, 0),
(6, 1, 1, 's', '2019-06-15', 0, 0),
(7, 1, 1, 'd', '2019-06-15', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `receipient` int(10) UNSIGNED NOT NULL,
  `type` int(1) UNSIGNED NOT NULL,
  `link` text COLLATE utf8_polish_ci,
  `status` int(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(4) UNSIGNED NOT NULL,
  `category_id` int(3) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_polish_ci NOT NULL DEFAULT 'tytul',
  `author` varchar(255) COLLATE utf8_polish_ci NOT NULL DEFAULT 'autor',
  `date` date NOT NULL,
  `img` varchar(255) COLLATE utf8_polish_ci NOT NULL DEFAULT 'post_normal_thumb.jpg',
  `content` text COLLATE utf8_polish_ci NOT NULL,
  `tags` varchar(255) COLLATE utf8_polish_ci NOT NULL DEFAULT 'tagi',
  `comment_count` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8_polish_ci NOT NULL DEFAULT 'Ukryty',
  `viewed_count` int(255) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `hash` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8_polish_ci NOT NULL DEFAULT 'normal_thumb.png',
  `role` int(1) NOT NULL DEFAULT '1',
  `ban_date` date NOT NULL DEFAULT '0000-00-00',
  `last_email` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `hash`, `email`, `thumbnail`, `role`, `ban_date`, `last_email`) VALUES
(1, 'Jakob', '$2y$10$wREMGPmB8F5E04B4LLRiJOOpmMZSuGjHq9.G7Vo3sjpt3E6QJdgGi', 'Jakub', 'Rajca', NULL, 'j.rajca45@gmail.com', '1431571015.jpeg', 3, '0000-00-00', 'j.rajdca45@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD KEY `Receipient` (`receipient`),
  ADD KEY `Status` (`status`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`author`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `last_email` (`last_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
