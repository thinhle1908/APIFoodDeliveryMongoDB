-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 21, 2022 at 12:29 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel-jwt-auth`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '3',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'thinhduc', 'thinhle@gmail.com', NULL, '$2y$10$sXXw5NyMaJGzR2zaPRaG/e7F7pJcrWDzCrWsalVTKHE7/RUQDZvdi', NULL, '2022-08-20 07:00:51', '2022-09-14 03:25:27', 1),
(2, 'Van Quang', 'vanquang@email.com', NULL, '$2y$10$nvo6SrDPt07lH2hB/dp0F.pP/SsyfgPKgGK1pcy1yMfwPMjBWrZ2C', NULL, '2022-08-20 07:00:51', '2022-08-20 07:00:51', 2),
(3, 'test user 01', 'user01@gmail.com', NULL, '$2y$10$fCZcHdVc./b5Rphk3ydFG.DpN6CL2T.7n0WTt7Cm0B/r.L6noSpNy', NULL, '2022-08-20 07:00:51', '2022-08-20 07:00:51', 3),
(4, 'test user 02', 'user02@gmail.com', NULL, '$2y$10$jiPudWvM.GFQty2Uaqv2WuEpV94BF27zZHHrfsZpw5M7bICefHs3e', NULL, '2022-08-20 07:00:51', '2022-08-20 07:00:51', 3),
(5, 'test user 03', 'user03@gmail.com', NULL, '$2y$10$mUw1MJqKbKk70YKXwPcFZugJp/1BeWnh87pQMKM1k.vfRSvv1cTGy', NULL, '2022-08-20 07:00:51', '2022-08-20 07:00:51', 3),
(6, 'test01', 'test@email.com', NULL, '$2y$10$eiEMTOg1NVBBa9XQGnFI/uRqqj7fgNR7QnZKBg6b/CmcjfXjMELYW', NULL, '2022-08-27 07:58:26', '2022-08-27 07:58:26', 3),
(7, 'test08', 'test12@email.com', NULL, '$2y$10$zX4sHQdxxK4YP05e3EvBWObYfnQH85yIHa5hg1eT6//kwVu5Rt3OO', NULL, '2022-09-19 05:59:25', '2022-09-19 05:59:25', 3),
(8, 'test01', 'test55@email.com', NULL, '$2y$10$IcZ9SP2eUrG83OhYjRxW6u15i5PcQ0XGQxKLsNGPAPvJSrqjoVrSC', NULL, '2022-09-20 17:19:26', '2022-09-20 17:19:26', 3),
(9, 'example name', 'examplecontent@gmail.com', NULL, '$2y$10$30ZtnF7fUpQLoaVNq9J3Eunb1yqLh7Sj6YgfEfJZNTDc8kYxWjDkq', NULL, '2022-09-20 17:21:12', '2022-09-20 17:21:12', 3),
(10, 'example name', 'examplecontent1@gmail.com', NULL, '$2y$10$z81I/I/CBbI8hKtdki5.K.HOJ5Dkm6EJxr3XUaMcj3DK8pwIaSzyy', NULL, '2022-09-20 17:22:39', '2022-09-20 17:22:39', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
