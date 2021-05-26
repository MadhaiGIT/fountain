-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 26, 2021 at 05:12 PM
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

CREATE TABLE IF NOT EXISTS `advice_queries` (
  `query_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `advice_secret` varchar(255) COLLATE utf8_bin NOT NULL,
  `advice_user_query` varchar(255) COLLATE utf8_bin NOT NULL,
  `advice_response` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`query_id`),
  UNIQUE KEY `query_id` (`query_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_enabled` tinyint(1) NOT NULL,
  `signup_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signup_referer_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signup_device` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signup_ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit` int(11) NOT NULL DEFAULT '0',
  `account_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_nickname_index` (`nickname`),
  KEY `users_facebook_token_index` (`facebook_token`),
  KEY `users_google_token_index` (`google_token`),
  KEY `users_hashed_password_index` (`hashed_password`),
  KEY `users_account_enabled_index` (`account_enabled`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_activity`
--

CREATE TABLE IF NOT EXISTS `users_activity` (
  `activity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `event_type` enum('login','logoff','ask_advice','credit_added','credit_spent','email_open','email_click','email_unsubscribe','email_complain','email_bounce_hard','email_bounce_soft','reset_password') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`activity_id`),
  KEY `event_datetime` (`event_datetime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users_credit_history`
--

CREATE TABLE IF NOT EXISTS `users_credit_history` (
  `credit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `action_type` enum('deposited','spent') COLLATE utf8_bin NOT NULL,
  `action_value` int(11) NOT NULL,
  PRIMARY KEY (`credit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users_finance`
--

CREATE TABLE IF NOT EXISTS `users_finance` (
  `finance_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `finance_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `finance_amount` double NOT NULL,
  `currency` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`finance_id`),
  KEY `finance_datetime` (`finance_datetime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users_rating`
--

CREATE TABLE IF NOT EXISTS `users_rating` (
  `rating_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `query_id` int(11) NOT NULL,
  `rating_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rating_value` int(11) NOT NULL,
  `rating_comment` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`rating_id`),
  KEY `rating_datetime` (`rating_datetime`),
  KEY `rating_value` (`rating_value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
