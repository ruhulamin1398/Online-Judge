-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2020 at 09:31 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ewuoj`
--

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `problem_id` int(11) NOT NULL,
  `problem_name` text NOT NULL,
  `problem_description` text NOT NULL,
  `input_description` text NOT NULL,
  `output_description` text NOT NULL,
  `constraint_description` text NOT NULL,
  `input_example` text NOT NULL,
  `output_example` text NOT NULL,
  `notes` text NOT NULL,
  `cpu_time_limit` float NOT NULL DEFAULT '2',
  `memory_limit` int(11) NOT NULL DEFAULT '128000',
  `user_id` int(11) NOT NULL,
  `problem_added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`problem_id`, `problem_name`, `problem_description`, `input_description`, `output_description`, `constraint_description`, `input_example`, `output_example`, `notes`, `cpu_time_limit`, `memory_limit`, `user_id`, `problem_added_date`) VALUES
(1, 'Hello', '<p><span class="equation">\\(a\\bigoplus b\\)</span>&nbsp;You are given an unweighted tree with&nbsp;nn&nbsp;vertices. Recall that a tree is a connected undirected graph without cycles.</p>\n\n<p>Your task is to choose&nbsp;three distinct&nbsp;vertices&nbsp;a,b,ca,b,c&nbsp;on this tree such that the number of edges which belong to&nbsp;at least&nbsp;one of the simple paths between&nbsp;aa&nbsp;and&nbsp;bb,&nbsp;bb&nbsp;and&nbsp;cc, or&nbsp;aa&nbsp;and&nbsp;cc&nbsp;is the maximum possible. See the notes section for a better understanding.</p>\n\n<p>The simple path is the path that visits each vertex at most once.</p>\n', '<em><strong><span class="equation">\\(x = {-b \\pm \\sqrt{b^2-4ac} \\over 2a}\\)</span>Input starts with an integer </strong>T denoting the number of test cases.Each case contains two integers: N, K.and tetere</em>', 'For each test case, print the&nbsp;<strong>number of trailing zeroes</strong>&nbsp;in your result.', '<span class="equation">\\(x = {-b \\pm \\sqrt{b^2-4ac} \\over 2a}\\)</span><br />\n<span class="equation">\\(x = {-b \\pm \\sqrt{b^2-4ac} \\over 2a}\\)</span>', '6<br />\nLRU<br />\nDURLDRUDRULRDURDDL<br />\nLRUDDLRUDRUL<br />\nLLLLRRRR<br />\nURDUR<br />\nLLL', '2<br />\nLR<br />\n14<br />\nRUURDDDDLLLUUR<br />\n12<br />\nULDDDRRRUULL<br />\n2<br />\nLR<br />\n2<br />\nUD<br />\n7', '<p>There are only two possible answers in the first test case: &quot;LR&quot; and &quot;RL&quot;.</p>\n\n<p>The picture corresponding to the second test case:</p>\n<img src="https://espresso.codeforces.com/b8d040c328a3c50a5e36b8d6da86a6e5f2b67b52.png" /><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Note that the direction of traverse does not matter\n<p>Another correct answer to the third test case: &quot;URDDLLLUURDR&quot;.</p>\n', 2, 128000, 1, '2020-01-24 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `test_case`
--

CREATE TABLE `test_case` (
  `test_case_id` int(11) NOT NULL,
  `test_case_id_hash` varchar(150) DEFAULT NULL,
  `problem_id` int(11) NOT NULL,
  `test_case_added_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_case`
--

INSERT INTO `test_case` (`test_case_id`, `test_case_id_hash`, `problem_id`, `test_case_added_date`, `user_id`) VALUES
(60, 'NDJjMzA5ZmYzYzZkNTE3MjFiNDcxOGZkNzJhZjAxZTFjODU5YzY0Y2UxZDQwMGRlYzgzMThmMmI0Zjc1NTdkNA==', 1, '2020-01-28 14:56:07', 1),
(61, 'Y2UyNTYyZDg3Yzc0MTAxMjI4NzViZDUxZjMzZGUxNWViMzRmYjI3YmVhZDBlMGZiNTI3ODg5NmFiOTY4NzkzNw==', 1, '2020-01-28 15:03:07', 1),
(62, 'Yzc5Yzg5MmZiZjdhYjRiMTBjZTA4OTQyOWJjYjc0NDNjNTBmOTJhNGNlZmJhNmFhY2IwNDhhZDRkZTBjZGI3ZA==', 1, '2020-01-28 14:08:31', 1),
(66, 'ade10caf763fec757430a2d399fb3c60bfd9875764db1bd27fe56c2a6909db21', 1, '2020-01-29 20:41:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_full_name` text NOT NULL,
  `user_handle` varchar(15) NOT NULL,
  `user_email` text NOT NULL,
  `user_photo` text,
  `user_ewu_id` text,
  `user_password` varchar(150) NOT NULL,
  `user_registration_date` datetime NOT NULL,
  `user_last_login_info` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_full_name`, `user_handle`, `user_email`, `user_photo`, `user_ewu_id`, `user_password`, `user_registration_date`, `user_last_login_info`) VALUES
(1, '', 'hamza05', 'sk.amirhamza@gmail.com', '', '', 'OTg4NDVhYzc5MWFhYWYxYWMyMDU5YjQ2YTg4MjcyOTAwZWU1YjNjMTA3NTZkYzg1ODU4NzU5ZjU2ODgyNmVhZA==', '2020-01-18 00:00:00', '{"ip":"::1","url":"\\/project\\/EWUOJ\\/site_action.php","time":"2020-01-30 03:29:57"}'),
(5, 'test', 'test', 'test@gmail.com', NULL, '', 'NTc1MzlkNmI2MjJiYjAzZTA1OTEyZmY1NDkzMzZmZTY0MGE5YzEzYjdmZDNkYTJiYjQ4NTBiNmUwMzBhNmQ0Ng==', '2020-01-20 23:08:00', NULL),
(6, 'test', 'test1', 'test1@gmail.com', NULL, '2017-1-60-0', 'NWJlMTBiMDFjNGIzMWRkNDNlYmExNzc0NGNkOTNmYzY3NDk2ZGZlYWUyMGRmYzQ3ODBlN2MyZWNiZTdmNGI2Zg==', '2020-01-20 23:10:48', NULL),
(7, 'hamza', 'hamza051', 'hamza@gmail.com', NULL, '2017-1-60-091', 'NWJlMTBiMDFjNGIzMWRkNDNlYmExNzc0NGNkOTNmYzY3NDk2ZGZlYWUyMGRmYzQ3ODBlN2MyZWNiZTdmNGI2Zg==', '2020-01-20 23:14:34', NULL),
(8, 'test2', 'test2', 'test2@gmail.com', NULL, '2017-1-60-091', 'NTc1MzlkNmI2MjJiYjAzZTA1OTEyZmY1NDkzMzZmZTY0MGE5YzEzYjdmZDNkYTJiYjQ4NTBiNmUwMzBhNmQ0Ng==', '2020-01-20 23:20:14', NULL),
(9, 'user1', 'user1', 'user1@gmail.com', NULL, '2017-1-60-091', 'NTc1MzlkNmI2MjJiYjAzZTA1OTEyZmY1NDkzMzZmZTY0MGE5YzEzYjdmZDNkYTJiYjQ4NTBiNmUwMzBhNmQ0Ng==', '2020-01-20 23:23:10', NULL),
(10, 'user4', 'user4', 'user4@gmaiil.com', NULL, '', 'NTc1MzlkNmI2MjJiYjAzZTA1OTEyZmY1NDkzMzZmZTY0MGE5YzEzYjdmZDNkYTJiYjQ4NTBiNmUwMzBhNmQ0Ng==', '2020-01-20 23:36:10', NULL),
(11, 'user5', 'user5', 'user5@gmail.com', NULL, '{"year":2017,"semister":1,"department":60,"id":91}', 'NWJlMTBiMDFjNGIzMWRkNDNlYmExNzc0NGNkOTNmYzY3NDk2ZGZlYWUyMGRmYzQ3ODBlN2MyZWNiZTdmNGI2Zg==', '2020-01-20 23:59:22', NULL),
(12, 'user6', 'user6', 'user6@gmail.com', NULL, '{"year":2017,"semister":1,"department":60,"serial":92}', 'NTc1MzlkNmI2MjJiYjAzZTA1OTEyZmY1NDkzMzZmZTY0MGE5YzEzYjdmZDNkYTJiYjQ4NTBiNmUwMzBhNmQ0Ng==', '2020-01-21 00:01:24', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`problem_id`),
  ADD KEY `fk_problem_user` (`user_id`);

--
-- Indexes for table `test_case`
--
ALTER TABLE `test_case`
  ADD PRIMARY KEY (`test_case_id`),
  ADD KEY `fk_test_case_add_by` (`user_id`) USING BTREE,
  ADD KEY `fk_test_case_problem_id` (`problem_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `uc_user_handle` (`user_handle`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `problem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `test_case`
--
ALTER TABLE `test_case`
  MODIFY `test_case_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `problems`
--
ALTER TABLE `problems`
  ADD CONSTRAINT `fk_problem_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `test_case`
--
ALTER TABLE `test_case`
  ADD CONSTRAINT `fk_test_case_add_by` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_test_case_problem_id` FOREIGN KEY (`problem_id`) REFERENCES `problems` (`problem_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
