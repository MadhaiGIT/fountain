-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 22, 2021 at 02:28 AM
-- Server version: 5.7.32
-- PHP Version: 7.3.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fountain`
--

-- --------------------------------------------------------

--
-- Table structure for table `advice_queries`
--

CREATE TABLE `advice_queries` (
  `query_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `advice_secret` varchar(255) COLLATE utf8_bin NOT NULL,
  `advice_user_query` varchar(255) COLLATE utf8_bin NOT NULL,
  `advice_response` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `account_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nickname` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `facebook_token` varchar(255) COLLATE utf8_bin NOT NULL,
  `google_token` varchar(255) COLLATE utf8_bin NOT NULL,
  `hashed_password` varchar(255) COLLATE utf8_bin NOT NULL,
  `account_enabled` tinyint(1) NOT NULL,
  `credit` int(11) NOT NULL DEFAULT '0',
  `signup_url` varchar(2047) COLLATE utf8_bin DEFAULT NULL,
  `signup_referer_url` varchar(63) COLLATE utf8_bin DEFAULT NULL,
  `signup_device` varchar(63) COLLATE utf8_bin DEFAULT NULL,
  `signup_ip` varchar(63) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users_activity`
--

CREATE TABLE `users_activity` (
  `activity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `event_type` enum('login','logoff','ask_advice','credit_added','credit_spent','email_open','email_click','email_unsubscribe','email_complain','email_bounce_hard','email_bounce_soft','reset_password') COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users_credit_history`
--

CREATE TABLE `users_credit_history` (
  `credit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `action_type` enum('deposited','spent') COLLATE utf8_bin NOT NULL,
  `action_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users_finance`
--

CREATE TABLE `users_finance` (
  `finance_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `finance_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `finance_amount` double NOT NULL,
  `currency` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users_rating`
--

CREATE TABLE `users_rating` (
  `rating_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `query_id` int(11) NOT NULL,
  `rating_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rating_value` int(11) NOT NULL,
  `rating_comment` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users_rating`
--

INSERT INTO `users_rating` (`rating_id`, `user_id`, `query_id`, `rating_datetime`, `rating_value`, `rating_comment`) VALUES
(1, 21, 31, '2021-05-22 01:40:26', 5, 'Test Comment');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advice_queries`
--
ALTER TABLE `advice_queries`
  ADD PRIMARY KEY (`query_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `account_creation` (`account_creation`),
  ADD KEY `nickname` (`nickname`),
  ADD KEY `email` (`email`),
  ADD KEY `facebook_token` (`facebook_token`),
  ADD KEY `google_token` (`google_token`),
  ADD KEY `hashed_password` (`hashed_password`),
  ADD KEY `account_enabled` (`account_enabled`);

--
-- Indexes for table `users_activity`
--
ALTER TABLE `users_activity`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `event_datetime` (`event_datetime`);

--
-- Indexes for table `users_credit_history`
--
ALTER TABLE `users_credit_history`
  ADD PRIMARY KEY (`credit_id`);

--
-- Indexes for table `users_finance`
--
ALTER TABLE `users_finance`
  ADD PRIMARY KEY (`finance_id`),
  ADD KEY `finance_datetime` (`finance_datetime`);

--
-- Indexes for table `users_rating`
--
ALTER TABLE `users_rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `rating_datetime` (`rating_datetime`),
  ADD KEY `rating_value` (`rating_value`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advice_queries`
--
ALTER TABLE `advice_queries`
  MODIFY `query_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users_activity`
--
ALTER TABLE `users_activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users_credit_history`
--
ALTER TABLE `users_credit_history`
  MODIFY `credit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_finance`
--
ALTER TABLE `users_finance`
  MODIFY `finance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users_rating`
--
ALTER TABLE `users_rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
