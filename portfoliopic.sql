-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2023 at 01:33 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `portfoliopic`
--

CREATE TABLE `portfoliopic` (
  `id` int(11) NOT NULL,
  `project_name` varchar(55) DEFAULT NULL,
  `project_catagory` varchar(55) DEFAULT NULL,
  `project_client` varchar(55) DEFAULT NULL,
  `project_url` varchar(55) DEFAULT NULL,
  `project_description` varchar(500) DEFAULT NULL,
  `picture_url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `portfoliopic`
--

INSERT INTO `portfoliopic` (`id`, `project_name`, `project_catagory`, `project_client`, `project_url`, `project_description`, `picture_url`, `created_at`) VALUES
(1, 'canteen', 'django', 'versity', 'github', 'aljlajflaj ljaljljjvia', 'assets\\img\\portfolio\\canteen1.jpg', '2023-05-29 12:47:58'),
(2, 'canteen', 'django', 'versity', 'github', 'afjlaj', 'assets\\img\\portfolio\\canteen2.jpg', '2023-05-29 20:35:15'),
(3, 'canteen', 'django', 'versity', 'github', 'escvb', 'assets\\img\\portfolio\\canteen3.jpg', '2023-05-29 20:36:59'),
(4, 'chat', 'django', 'versity', 'github', 'Chatting system', 'assets\\img\\portfolio\\chat1.jpg', '2023-05-29 21:44:57'),
(5, 'chat', 'django', 'versity', 'github', 'Chatting system', 'assets\\img\\portfolio\\chat2.jpg', '2023-05-29 21:45:23'),
(6, 'chat', 'django', 'versity', 'github', 'afjlaj', 'assets\\img\\portfolio\\chat3.jpg', '2023-05-29 21:46:34'),
(7, 'diabetics', 'django', 'versity', 'github', 'This is a project to predict diabetics.', 'assets\\img\\portfolio\\diabetics1.jpg', '2023-05-30 10:12:15'),
(8, 'diabetics', 'django', 'versity', 'github', 'This is a project to predict diabetics.', 'assets\\img\\portfolio\\diabetics2.jpg', '2023-05-30 10:12:56'),
(9, 'jobseek', 'PHP', 'versity', 'github', 'This is project to seek job.', 'assets\\img\\portfolio\\jobseek1.jpg', '2023-05-30 10:32:23'),
(10, 'jobseek', 'PHP', 'versity', 'github', 'This is project to seek job.', 'assets\\img\\portfolio\\jobseek2.jpg', '2023-05-30 10:32:56'),
(11, 'jobseek', 'PHP', 'versity', 'github', 'This is project to seek job.', 'assets\\img\\portfolio\\jobseek3.jpg', '2023-05-30 10:33:30'),
(12, 'jobseek', 'PHP', 'versity', 'github', 'This is project to seek job.', 'assets\\img\\portfolio\\jobseek4.jpg', '2023-05-30 10:34:07'),
(13, 'edoctor', 'PHP', 'versity', 'github', 'This is the project where patients can take medication ', 'assets\\img\\portfolio\\edoctor1.jpg', '2023-05-30 10:54:34'),
(14, 'edoctor', 'PHP', 'versity', 'github', 'This is the system where patients can take medication online.', 'assets\\img\\portfolio\\edoctor2.jpg', '2023-05-30 11:01:02'),
(15, 'edoctor', 'PHP', 'versity', 'github', 'This is the system where patients can take medication online.', 'assets\\img\\portfolio\\edoctor3.jpg', '2023-05-30 11:02:05'),
(16, 'edoctor', 'PHP', 'versity', 'github', 'This is the system where patients can take medication online.', 'assets\\img\\portfolio\\edoctor4.jpg', '2023-05-30 11:02:47'),
(17, 'edoctor', 'PHP', 'versity', 'github', 'This is the system where patients can take medication online.', 'assets\\img\\portfolio\\edoctor5.jpg', '2023-05-30 11:04:00'),
(18, 'security', 'PHP', 'versity', 'github', 'basic security of a software--------------> sqli, authentication, authorization, ban, user log', 'assets\\img\\portfolio\\security1.jpg', '2023-05-30 11:34:53'),
(19, 'security', 'PHP', 'versity', 'github', 'basic security of a software--------------> sqli, authentication, authorization, ban , user log', 'assets\\img\\portfolio\\security2.jpg', '2023-05-30 11:35:26'),
(20, 'security', 'PHP', 'versity', 'github', 'basic security of a software--------------> sqli, authentication, authorization, ban , user log', 'assets\\img\\portfolio\\security3.jpg', '2023-05-30 11:35:55'),
(21, 'guess', 'Java', 'versity', 'github', 'Simple guessing game.', 'assets\\img\\portfolio\\guess1.jpg', '2023-05-30 11:47:11'),
(22, 'guess', 'Java', 'versity', 'github', 'Simple guessing game.', 'assets\\img\\portfolio\\guess2.jpg', '2023-05-30 11:48:00'),
(23, 'guess', 'Java', 'versity', 'github', 'Simple guessing game.', 'assets\\img\\portfolio\\guess3.jpg', '2023-05-30 11:48:34'),
(24, 'ping', 'Java', 'versity', 'github', 'Simple ping pong game.', 'assets\\img\\portfolio\\ping1.jpg', '2023-05-30 12:02:15'),
(25, 'ping', 'Java', 'versity', 'github', 'Simple ping pong game.', 'assets\\img\\portfolio\\ping2.jpg', '2023-05-30 12:03:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `portfoliopic`
--
ALTER TABLE `portfoliopic`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `portfoliopic`
--
ALTER TABLE `portfoliopic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
