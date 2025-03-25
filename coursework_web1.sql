-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2025 at 09:01 AM
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
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `AssetID` int(11) NOT NULL,
  `mediaKey` varchar(255) NOT NULL,
  `QuestionID` int(11) DEFAULT NULL,
  `AnswerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`AssetID`, `mediaKey`, `QuestionID`, `AnswerID`) VALUES
(1, 'post_67dbc881dae6a_Screenshot 2025-03-08 110639.png', 44, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `CommentID` int(11) NOT NULL,
  `content` text NOT NULL,
  `QuestionID` int(11) DEFAULT NULL,
  `UserID` int(11) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`CommentID`, `content`, `QuestionID`, `UserID`, `createdAt`, `updatedAt`) VALUES
(1, 'wow so this is test1', 3, 1, '2025-03-18 17:11:35', '2025-03-18 17:11:35'),
(2, 'so nice!', 3, 2, '2025-03-18 17:11:35', '2025-03-18 17:11:35'),
(7, 'lol i have wait for this moment so long', 3, 3, '2025-03-20 16:11:38', '2025-03-20 16:11:38'),
(8, 'well done guys, test1 is soo PEAK!!', 3, 4, '2025-03-20 16:11:38', '2025-03-20 16:11:38'),
(9, 'Any contribute are welcome!', 44, 2, '2025-03-25 14:35:36', '2025-03-25 14:35:36');

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
  `AssetID` int(11) DEFAULT NULL,
  `viewCount` int(11) DEFAULT 0,
  `voteCount` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`PostID`, `title`, `content`, `ModuleID`, `UserID`, `createdAt`, `updatedAt`, `AssetID`, `viewCount`, `voteCount`) VALUES
(3, 'test1', 'test1', 1, 1, '2025-03-11 10:34:52', '2025-03-25 14:53:13', NULL, 230, 0),
(39, 'Understanding SQL Indexes', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur porttitor vestibulum elit ut condimentum. Maecenas mollis orci vitae nunc interdum, eget posuere elit interdum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris ut ex elit. Cras in vehicula justo. In est dolor, sodales non tempus nec, suscipit ut odio. Proin eget leo nulla. Pellentesque ultricies interdum felis et convallis. Mauris vel sodales dolor, id ullamcorper mi. Donec venenatis sem non lorem porta rutrum. Nam euismod mauris turpis, ut commodo lacus ultrices sit amet. In hac habitasse platea dictumst. Nam erat nisi, semper sit amet pharetra nec, egestas et nisi. Nunc viverra nulla eget tellus posuere mattis. Aenean consequat sem purus, id hendrerit ante porttitor eget. Quisque eu ante at ipsum egestas rutrum vitae ac odio.\r\n\r\nQuisque ipsum mi, tempus vitae elit ut, pharetra fermentum augue. Mauris consectetur fermentum quam, vitae bibendum sem. Vestibulum placerat leo sit amet tortor ornare, non luctus eros bibendum. Suspendisse fringilla ullamcorper justo. Etiam interdum lacinia fermentum. Maecenas commodo euismod imperdiet. Nulla nec semper eros. Nunc a tempor ante. Nam ac posuere enim. Nulla ut tempus odio, quis ornare justo. Mauris vulputate pharetra ipsum non congue. Proin dapibus, tellus at porta mattis, ipsum mi sagittis quam, vel ultrices sem tellus non dolor. Ut scelerisque laoreet nunc ac sollicitudin. Vivamus vitae justo diam. Nulla facilisi. Nunc commodo dignissim massa in dictum.', 1, 5, '2025-03-14 16:52:22', '2025-03-23 14:41:26', NULL, 26, 3),
(40, 'Introduction to Machine Learning', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce quis nisl suscipit, posuere tortor nec, luctus felis. Sed ultrices nisi quis erat tristique porta. Fusce placerat interdum lorem, tincidunt efficitur diam suscipit a. Ut vitae mollis quam. Cras tincidunt eros sed fringilla rutrum. Phasellus varius, mauris a ultricies posuere, velit dolor dapibus sem, sollicitudin lacinia tortor arcu vel augue. Praesent eleifend posuere augue, ut porta massa malesuada nec. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nullam et libero in velit finibus lobortis. Duis nulla justo, imperdiet eget consectetur in, ornare laoreet est. Phasellus magna nisl, blandit et rutrum ut, tempor eget est. Pellentesque interdum urna lacus, sed venenatis felis pharetra in. Sed tempus ipsum vitae sapien viverra, et posuere neque posuere. Donec blandit, est et ultricies semper, turpis ante dictum mauris, eget scelerisque justo ante sed sem. Integer sit amet luctus nulla. In cursus volutpat risus quis dignissim.', 1, 3, '2025-03-14 16:52:22', '2025-03-20 20:32:55', NULL, 67, 10),
(41, 'Best Practices in Web Security', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin elementum consectetur mollis. Maecenas est est, convallis in eros vel, egestas cursus sapien. Sed congue maximus blandit. Duis placerat at nulla nec volutpat. Sed id libero ac dolor euismod varius. Sed molestie feugiat augue, eu auctor quam aliquet finibus. Aliquam tempor eget nunc et luctus. Sed dapibus, sapien non auctor interdum, risus dolor ultricies sapien, suscipit cursus turpis mi ut erat. Morbi sapien libero, placerat vitae urna sed, mollis vestibulum mauris. Cras lobortis enim vel leo tristique, a euismod eros rutrum. In eleifend ipsum vitae nunc dignissim, ac aliquet dui sollicitudin. Morbi efficitur risus quis venenatis tempus.\r\n\r\n', 1, 4, '2025-03-14 16:52:22', '2025-03-20 20:37:57', NULL, 120, 25),
(42, 'Database Optimization Tips', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi in facilisis dui, id feugiat lectus. Nulla rutrum sapien et massa eleifend, faucibus ullamcorper mauris pharetra. Nam finibus risus et dictum venenatis. Quisque imperdiet pellentesque viverra. Cras luctus dignissim rutrum. Donec semper neque ac purus auctor auctor. Pellentesque bibendum odio metus, vitae tincidunt nisi pretium et. Quisque scelerisque eros id faucibus lacinia.', 1, 3, '2025-03-14 16:52:22', '2025-03-23 14:41:17', NULL, 13, 0),
(43, 'How to Use ENUM in MySQL', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas condimentum lacus justo, et tristique nibh suscipit quis. Morbi efficitur sodales eleifend. In hac habitasse platea dictumst. Curabitur ornare ultrices odio vitae maximus. Ut nec posuere diam. Vivamus in finibus augue, sit amet rutrum sapien. In quis fringilla lacus. Etiam malesuada pretium metus. Cras ornare, enim nec posuere laoreet, turpis dui tempor leo, vel consequat erat augue ac lacus. Phasellus varius ac metus ut sagittis. Aenean non condimentum urna, quis scelerisque mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus maximus ipsum sit amet nulla interdum ornare. Nam sit amet massa quis turpis sagittis accumsan. Sed in dignissim nisi.', 1, 5, '2025-03-14 16:52:22', '2025-03-20 20:39:14', NULL, 86, 15),
(44, 'My first post!!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ornare lacus lacus, eu egestas metus vestibulum et. Integer sit amet aliquet urna. Nunc eget viverra orci. Fusce et ultricies nisi. Aliquam ut congue tortor, vitae consectetur velit. Sed gravida, dolor id ultricies vehicula, orci sem pharetra massa, quis aliquet purus dolor id neque. Duis facilisis vehicula tellus. Pellentesque facilisis velit eget mauris porta vehicula. Mauris a sapien mattis, semper quam in, tempus mauris. In hac habitasse platea dictumst. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse porta est sed sem hendrerit bibendum.', 1, 2, '2025-03-20 14:49:21', '2025-03-25 14:53:28', 1, 53, 0);

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
(20, 'identicon-1741795745121.png'),
(21, 'identicon-1741795697173.png'),
(22, 'identicon-1741795704255.png'),
(23, 'identicon-1741795708792.png'),
(24, 'identicon-1741795711113.png'),
(25, 'identicon-1741795713182.png'),
(26, 'identicon-1741795715301.png'),
(27, 'identicon-1741795717246.png'),
(28, 'identicon-1741795719592.png'),
(29, 'identicon-1741795726242.png'),
(30, 'identicon-1741795731730.png'),
(31, 'identicon-1741795737132.png'),
(32, 'identicon-1741795740154.png'),
(33, 'identicon-1741795741873.png'),
(34, 'identicon-1741795743577.png');

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
(1, 'lxvroo', '', '', '$2y$10$K4LkiPBiH6/nSB3VdVWiEOqTXkiBQ2YFEClAn8AnkW7ENGdNTnD02', 'identicon-1741795713182.png', NULL, NULL, 'Active', 'admin', '2025-03-03 12:53:25'),
(2, 'nɒʜИ', '', '', '$2y$10$K4LkiPBiH6/nSB3VdVWiEOqTXkiBQ2YFEClAn8AnkW7ENGdNTnD02', 'identicon-1741795726242.png', NULL, NULL, 'Active', 'user', '2025-03-18 15:01:38'),
(3, 'human', '', '', '$2y$10$K4LkiPBiH6/nSB3VdVWiEOqTXkiBQ2YFEClAn8AnkW7ENGdNTnD02', 'identicon-1741795711113.png', NULL, NULL, 'Active', 'user', '2025-03-19 11:28:12'),
(4, 'Nhân', '', '', '$2y$10$K4LkiPBiH6/nSB3VdVWiEOqTXkiBQ2YFEClAn8AnkW7ENGdNTnD02', 'identicon-1741795708792.png', NULL, NULL, 'Active', 'user', '2025-03-19 11:32:11'),
(5, 'nhan', '', '', '$2y$10$K4LkiPBiH6/nSB3VdVWiEOqTXkiBQ2YFEClAn8AnkW7ENGdNTnD02', 'identicon-1741795697173.png', NULL, NULL, 'Active', 'user', '2025-03-20 16:15:22');

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
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `AssetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `ModuleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `PostID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `random-avatar`
--
ALTER TABLE `random-avatar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

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
