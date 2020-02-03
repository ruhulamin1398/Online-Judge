-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2020 at 03:11 PM
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
  `problemId` int(11) NOT NULL,
  `problemName` text NOT NULL,
  `problemDescription` text NOT NULL,
  `inputDescription` text NOT NULL,
  `outputDescription` text NOT NULL,
  `constraintDescription` text NOT NULL,
  `inputExample` text NOT NULL,
  `outputExample` text NOT NULL,
  `notes` text NOT NULL,
  `cpuTimeLimit` float NOT NULL DEFAULT '2',
  `memoryLimit` int(11) NOT NULL DEFAULT '128000',
  `userId` int(11) NOT NULL,
  `problemAddedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `problems`
--
DELIMITER $$
CREATE TRIGGER `TG_InsertProblemModerator` AFTER INSERT ON `problems` FOR EACH ROW BEGIN
    INSERT INTO problem_moderator(problemId, userId,moderatorRoles)
        VALUES(new.problemId,new.userId,10);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `problem_moderator`
--

CREATE TABLE `problem_moderator` (
  `problemModeratorId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `problemId` int(11) NOT NULL,
  `moderatorRoles` int(11) NOT NULL DEFAULT '20'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `submissionId` int(11) NOT NULL,
  `submissionType` int(11) NOT NULL DEFAULT '1',
  `problemId` int(11) NOT NULL,
  `sourceCode` text NOT NULL,
  `languageId` int(11) NOT NULL,
  `maxTimeLimit` float NOT NULL DEFAULT '0',
  `maxMemoryLimit` int(11) NOT NULL DEFAULT '0',
  `runOnMaxTime` float NOT NULL DEFAULT '0',
  `runOnMaxMemory` int(11) NOT NULL DEFAULT '0',
  `userId` int(11) NOT NULL,
  `submissionTime` datetime NOT NULL,
  `submissionVerdict` int(11) NOT NULL DEFAULT '1',
  `testCaseReady` int(11) NOT NULL DEFAULT '-1',
  `judgeComplete` int(11) NOT NULL DEFAULT '0',
  `runOnTest` int(11) NOT NULL DEFAULT '1',
  `totalTestCase` int(11) NOT NULL DEFAULT '0',
  `threadId` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `submissions_on_test_case`
--

CREATE TABLE `submissions_on_test_case` (
  `submissionTestCaseId` int(11) NOT NULL,
  `submissionId` int(11) NOT NULL,
  `testCaseSerialNo` int(11) NOT NULL,
  `testCaseToken` varchar(100) NOT NULL,
  `judgeStatus` int(11) NOT NULL DEFAULT '-1',
  `verdict` int(11) NOT NULL DEFAULT '1',
  `totalTime` float NOT NULL DEFAULT '0',
  `totalMemory` int(11) NOT NULL DEFAULT '0',
  `responseData` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test_case`
--

CREATE TABLE `test_case` (
  `testCaseId` int(11) NOT NULL,
  `testCaseIdHash` varchar(150) DEFAULT NULL,
  `problemId` int(11) NOT NULL,
  `testCaseAddedDate` datetime NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userFullName` text NOT NULL,
  `userHandle` varchar(15) NOT NULL,
  `userEmail` text NOT NULL,
  `userPhoto` text,
  `userEwuId` text,
  `userPassword` varchar(150) NOT NULL,
  `userRoles` int(11) NOT NULL DEFAULT '40',
  `userRegistrationDate` datetime NOT NULL,
  `userLastLoginInfo` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`problemId`),
  ADD KEY `fk_problem_user` (`userId`);

--
-- Indexes for table `problem_moderator`
--
ALTER TABLE `problem_moderator`
  ADD PRIMARY KEY (`problemModeratorId`),
  ADD UNIQUE KEY `UC_UserProblem` (`userId`,`problemId`),
  ADD KEY `FK_ProblemModeratorProblem` (`problemId`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`submissionId`),
  ADD KEY `FK_SubmissionUser` (`userId`),
  ADD KEY `FK_SubmissionProblem` (`problemId`);

--
-- Indexes for table `submissions_on_test_case`
--
ALTER TABLE `submissions_on_test_case`
  ADD PRIMARY KEY (`submissionTestCaseId`),
  ADD KEY `FK_SubmissionId` (`submissionId`);

--
-- Indexes for table `test_case`
--
ALTER TABLE `test_case`
  ADD PRIMARY KEY (`testCaseId`),
  ADD KEY `fk_test_case_add_by` (`userId`) USING BTREE,
  ADD KEY `fk_test_case_problem_id` (`problemId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `uc_user_handle` (`userHandle`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `problemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `problem_moderator`
--
ALTER TABLE `problem_moderator`
  MODIFY `problemModeratorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `submissionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `submissions_on_test_case`
--
ALTER TABLE `submissions_on_test_case`
  MODIFY `submissionTestCaseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `test_case`
--
ALTER TABLE `test_case`
  MODIFY `testCaseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `problems`
--
ALTER TABLE `problems`
  ADD CONSTRAINT `fk_problem_user` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `problem_moderator`
--
ALTER TABLE `problem_moderator`
  ADD CONSTRAINT `FK_ProblemModeratorProblem` FOREIGN KEY (`problemId`) REFERENCES `problems` (`problemId`),
  ADD CONSTRAINT `FK_ProblemModeratorUserId` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `FK_SubmissionProblem` FOREIGN KEY (`problemId`) REFERENCES `problems` (`problemId`),
  ADD CONSTRAINT `FK_SubmissionUser` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `submissions_on_test_case`
--
ALTER TABLE `submissions_on_test_case`
  ADD CONSTRAINT `FK_SubmissionId` FOREIGN KEY (`submissionId`) REFERENCES `submissions` (`submissionId`);

--
-- Constraints for table `test_case`
--
ALTER TABLE `test_case`
  ADD CONSTRAINT `fk_test_case_add_by` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `fk_test_case_problem_id` FOREIGN KEY (`problemId`) REFERENCES `problems` (`problemId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
