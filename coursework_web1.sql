-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2025 at 10:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coursework_web1`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `AnswerID` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `QuestionID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `isAccepted` tinyint(1) DEFAULT 0,
  `upvote` int(11) DEFAULT 0,
  `downvote` int(11) DEFAULT 0,
  `AssetID` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `AssetID` int(11) NOT NULL,
  `mediaKey` varchar(255) NOT NULL,
  `QuestionID` int(11) DEFAULT NULL,
  `AnswerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `CommentID` int(11) NOT NULL,
  `content` text NOT NULL,
  `QuestionID` int(11) DEFAULT NULL,
  `AnswerID` int(11) DEFAULT NULL,
  `UserID` int(11) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `ModuleID` int(11) NOT NULL,
  `moduleName` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`ModuleID`, `moduleName`, `description`) VALUES
(1, 'testModule', 'testModule');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `PostID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `ModuleID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Open','Closed','OnHold','Deleted') NOT NULL DEFAULT 'Open',
  `AssetID` int(11) DEFAULT NULL,
  `viewCount` int(11) DEFAULT 0,
  `voteCount` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`PostID`, `title`, `content`, `ModuleID`, `UserID`, `createdAt`, `updatedAt`, `status`, `AssetID`, `viewCount`, `voteCount`) VALUES
(3, 'test1', 'test1', 1, 1, '2025-03-11 10:34:52', '2025-03-18 16:41:09', 'Open', NULL, 61, 0),
(39, 'Understanding SQL Indexes', 'Indexes help speed up searches in SQL databases...', 1, 1, '2025-03-14 16:52:22', '2025-03-18 16:13:12', 'Open', NULL, 18, 3),
(40, 'Introduction to Machine Learning', 'Machine Learning is a subset of AI that...', 1, 1, '2025-03-14 16:52:22', '2025-03-18 16:28:41', 'Closed', NULL, 52, 10),
(41, 'Best Practices in Web Security', 'Security is essential in web development...', 1, 1, '2025-03-14 16:52:22', '2025-03-14 16:52:22', 'OnHold', NULL, 120, 25),
(42, 'Database Optimization Tips', 'Optimizing your database can greatly...', 1, 1, '2025-03-14 16:52:22', '2025-03-14 16:52:22', 'Deleted', NULL, 5, 0),
(43, 'How to Use ENUM in MySQL', 'ENUM data type is useful for predefined...', 1, 1, '2025-03-14 16:52:22', '2025-03-14 16:52:22', 'Open', NULL, 80, 15);

-- --------------------------------------------------------

--
-- Table structure for table `random-avatar`
--

CREATE TABLE `random-avatar` (
  `id` int(11) NOT NULL,
  `mediaKey` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `random-avatar`
--

INSERT INTO `random-avatar` (`id`, `mediaKey`) VALUES
(1, 'identicon-1741795697173.png'),
(2, 'identicon-1741795704255.png'),
(3, 'identicon-1741795706816.png'),
(4, 'identicon-1741795708792.png'),
(5, 'identicon-1741795711113.png'),
(6, 'identicon-1741795713182.png'),
(7, 'identicon-1741795715301.png'),
(8, 'identicon-1741795717246.png'),
(9, 'identicon-1741795719592.png'),
(10, 'identicon-1741795721724.png'),
(11, 'identicon-1741795723873.png'),
(12, 'identicon-1741795726242.png'),
(13, 'identicon-1741795729297.png'),
(14, 'identicon-1741795731730.png'),
(15, 'identicon-1741795735352.png'),
(16, 'identicon-1741795737132.png'),
(17, 'identicon-1741795740154.png'),
(18, 'identicon-1741795741873.png'),
(19, 'identicon-1741795743577.png'),
(20, 'identicon-1741795745121.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '',
  `avatar` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `status` enum('Active','Blocked','Banned','Archived','Unknown') NOT NULL DEFAULT 'Active',
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `username`, `firstname`, `lastname`, `password`, `avatar`, `dob`, `bio`, `status`, `role`, `createdAt`) VALUES
(1, 'lxvroo', '', '', 'unknown', 'identicon-1741795713182.png', NULL, NULL, 'Active', 'admin', '2025-03-03 12:53:25'),
(2, 'Steve', '', '', '', 'identicon-1741795729297.png', NULL, NULL, 'Active', 'user', '2025-03-18 15:01:38');

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `assign_random_avatar` BEFORE INSERT ON `user` FOR EACH ROW BEGIN
    DECLARE random_avatar VARCHAR(255);

    -- Lấy một avatar ngẫu nhiên từ bảng random-avatar
    SELECT mediaKey INTO random_avatar 
    FROM `random-avatar` 
    ORDER BY RAND() 
    LIMIT 1;

    -- Gán giá trị avatar ngẫu nhiên nếu avatar chưa được set
    IF NEW.avatar IS NULL THEN
        SET NEW.avatar = random_avatar;
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`AnswerID`),
  ADD KEY `QuestionID` (`QuestionID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `AssetID` (`AssetID`);

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`AssetID`),
  ADD UNIQUE KEY `AnswerID` (`AnswerID`),
  ADD KEY `fk_Photo_Question` (`QuestionID`),
  ADD KEY `AnswerID_2` (`AnswerID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `QuestionID` (`QuestionID`),
  ADD KEY `AnswerID` (`AnswerID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`ModuleID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`PostID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `photoid` (`AssetID`),
  ADD KEY `AssetID` (`AssetID`),
  ADD KEY `ModuleID` (`ModuleID`);

--
-- Indexes for table `random-avatar`
--
ALTER TABLE `random-avatar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `AnswerID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `AssetID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `ModuleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `PostID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `random-avatar`
--
ALTER TABLE `random-avatar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`QuestionID`) REFERENCES `posts` (`PostID`) ON DELETE CASCADE,
  ADD CONSTRAINT `answer_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `answer_ibfk_3` FOREIGN KEY (`AssetID`) REFERENCES `asset` (`assetID`) ON DELETE CASCADE;

--
-- Constraints for table `asset`
--
ALTER TABLE `asset`
  ADD CONSTRAINT `fk_Photo_Answer` FOREIGN KEY (`AnswerID`) REFERENCES `answer` (`AnswerID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_Photo_Question` FOREIGN KEY (`QuestionID`) REFERENCES `posts` (`PostID`) ON DELETE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`QuestionID`) REFERENCES `posts` (`PostID`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`AssetID`) REFERENCES `asset` (`assetID`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_ibfk_3` FOREIGN KEY (`ModuleID`) REFERENCES `modules` (`ModuleID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
