-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2019 at 08:24 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

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
(8, 'C++');

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

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(4) NOT NULL,
  `category_id` int(3) NOT NULL,
  `title` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `date` date NOT NULL,
  `img` mediumtext COLLATE utf8_polish_ci NOT NULL,
  `content` mediumtext COLLATE utf8_polish_ci NOT NULL,
  `tags` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `comment_count` int(11) NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8_polish_ci NOT NULL DEFAULT 'hidden'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `title`, `author`, `date`, `img`, `content`, `tags`, `comment_count`, `status`) VALUES
(1, 1, 'Zabij sięe', 'Jakob', '2019-02-05', '1125404193.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id arcu arcu. Quisque ut consectetur orci. Sed bibendum sem sit amet placerat congue. Aenean placerat, mauris faucibus tempor vulputate, arcu nunc ullamcorper metus, eu vehicula ipsum nibh at erat. Etiam augue ante, elementum at fringilla eget, convallis eu sapien. Sed pharetra at est id efficitur. Mauris tellus leo, interdum non est eu, eleifend cursus dui. Suspendisse aliquet massa vehicula nunc suscipit, auctor molestie ligula ornare. Vestibulum erat lectus, laoreet finibus condimentum eu, facilisis et ante. Vivamus vitae metus at ante condimentum ornare a pulvinar nunc. Aenean in odio sapien. Integer consectetur purus sem, vitae mattis erat pretium et. Proin et enim faucibus erat luctus venenatis id sed lectus. Phasellus sed rhoncus lectus. .', 'suicide, good, idea, yeah, boii', 0, 'Publiczny'),
(2, 2, 'Dzięki Działa', 'Jakob', '2019-02-01', '1849919706.jpeg', 'Tuż stało na szabli, a przed Kusym o piękności metrykę nie chciałby do rąk muskała włosów pukle nie postanie! Nazywam się uparta coraz głośniejsza kłótnia o palec. Wiedziałem, że miał strzelców trzyma obyczajem pańskim i w języku strzelecki dzik, niedźwiedź, łoś, wilk zwany był żonaty a chłopi żegnali się, jak czas i krwi tonęła, gdy tak i przepraszał Sędziego. Sędzia wie, że nam, kolego! lecz latem nic to mówiąc, że pewnie na jutro na wychowanie niczego nie był zostawiony nóżkami drobnemi od wiatrów jesieni. Dóm mieszkalny niewielki, lecz zewsząd chędogi i stoi wypisany każdy mimowolnie porządku pilnował. Bo nie zbłądzi.', 'Dunno, pls, kill, me,thanks, lul', 0, 'Publiczny'),
(5, 4, 'uhu', 'Jakob', '2019-03-26', '1686583120.jpeg', 'treść', 'tagi', 0, 'Ukryty'),
(6, 1, 'Ogarnij Się', 'Jakob3', '2019-03-28', '1511055098.png', 'Uhuhu', 'Dunno, pls, kill, me,thanks, lul', 0, 'Publiczny');

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
  `email` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8_polish_ci NOT NULL DEFAULT 'normal_thumb.png',
  `role` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `thumbnail`, `role`) VALUES
(1, 'Jakob', '$2y$10$uEYLiOCF7YgGGYcO3tHsEendgPUywWLSiKs/d74gAwVmMImFcXUSO', '', '', 'j.rajca45@gmail.com', 'normal_thumb.png', 3),
(2, 'Jakob2', '$2y$10$25blPM2MM074buAKbH/GEekUWlf6olCcvGWWJ9E1a.uqguEtgVUC6', '', '', 'masterpolakpl@gmail.com', 'normal_thumb.png', 1),
(3, 'Jakob3', '$2y$10$2poyYxR26xd7fxdfaSH7f.ZS4N/MvCoSeEXOSXUSQBill/W8Og2Iq', '', '', '', 'normal_thumb.png', 2);

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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
