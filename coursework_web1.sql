-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2025 at 05:48 AM
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
(1, 'post_67dbc881dae6a_Screenshot 2025-03-08 110639.png', 44, NULL),
(5, 'post_67e391e9a6840_1064409568119103560.png', 3, NULL),
(6, 'post_67e391e9a6ccb_1093569733514772500.png', 3, NULL),
(7, 'post_67e391e9a7058_1130395935667662898.png', 3, NULL),
(8, 'post_67e391e9a89e6_1225008802152321086.png', 3, NULL),
(9, 'post_67e391e9a8eec_d672b1fa-4dea-48af-a4a9-dfeb53775bd5.png', 3, NULL),
(10, 'post_67eb932fc663f_z5018282565171_f96185ca8d3abcf07102685d64282d92.jpg', 46, NULL);

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
(9, 'Any contribute are welcome!', 44, 2, '2025-03-25 14:35:36', '2025-03-25 14:35:36'),
(15, '⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⢿⠿⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⢟⣋⠥⠀⢐⠀⣓⡖⡮⠙⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡏⢰⣫⡿⢳⡄⠐⠈⠟⠳⠇⠥⢻⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡟⠀⠈⠑⠈⠀⣀⠀⢀⠀⠀⢠⠠⠀⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠁⢀⣀⡴⣾⠆⢹⣆⣤⠀⠀⡄⠀⠈⠈⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣇⠀⠌⢻⠁⠀⠀⠀⢸⣣⠆⠀⡀⢐⢘⢦⡘⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⡄⠀⣤⣠⣤⣾⡟⣧⠀⠀⢷⣢⠞⠂⠉⠈⠉⠙⢻⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠏⠛⠀⢈⠪⣅⠀⠀⠈⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣧⠀⣀⠠⠊⠆⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠛⠿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣧⠙⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⠻⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⠿⠿⠿⠿⣿⣿⣿⣿⣿⣿⡿⠋⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⠻⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠟⠛⠉⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠙⠋⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠉⠙⠛⠿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⠋⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⠻⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⢻⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢻⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡃⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢻⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠰⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡇⠀⠀⠀⢀⣀⣀⣀⣀⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣀⣀⡀⠀⠸⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⢠⢴⣶⣿⣿⣿⡿⢟⣛⢿⣦⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⢠⣲⢏⣿⢿⣿⣷⣄⠹⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠿⣛⡭⣾⣷⡹⢟⣯⣷⣿⣿⣿⣷⢹⣿⣄⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣠⣌⣶⣿⣿⢚⣼⣷⡝⡎⣮⠀⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⡿⣫⣵⣿⡟⣼⣿⣿⢿⣯⢿⣿⣿⣿⣿⣳⣎⡿⡿⣄⠀⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⡀⣾⣿⢸⣿⣿⣇⢸⣿⡿⠿⢦⣟⢰⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣫⠾⡻⣻⢏⣾⡿⣫⣾⡏⣿⣯⣟⣿⢿⡁⣿⢣⡞⢟⣥⣾⣿⡄⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣤⣾⣷⠹⡏⣾⡼⣿⣿⡉⣷⣿⣿⢿⡇⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⢯⢟⡶⣵⢯⣾⢟⣵⣿⣿⢃⢿⣿⣿⠿⣚⢡⣏⡞⣡⣾⣿⣿⣿⣷⡄⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣤⣾⣿⣿⣿⠆⣱⣿⣇⣿⣿⡁⣻⣿⣿⢸⣇⢹⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⡟⣺⢏⡾⣳⢟⣵⣿⣿⣿⡏⣿⣿⣶⡿⠟⣩⢞⡾⣹⣿⣿⣿⣿⣿⣿⡿⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣴⣿⣿⣿⣿⣿⣿⢏⣼⣿⣿⣷⠋⣿⣸⡕⣯⡷⠸⢸⠈⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⡿⢳⣧⡿⡵⣳⣿⣿⣿⣿⣿⢇⡾⣛⣩⣶⡿⣫⣾⢧⣿⣿⣿⣿⣿⣿⣿⡟⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣿⣿⣿⣿⣿⣿⣿⡏⢸⣿⣿⣿⢣⢯⣿⣷⡜⣶⢟⡌⣸⠃⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⡿⣸⡟⡜⣼⣿⣿⣿⣿⠟⢕⣯⣾⣿⡿⣛⣵⣿⠟⣾⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠐⠿⠿⠿⣿⣿⣿⣿⡃⢸⣿⣿⢏⣿⢸⣿⣿⢇⢣⡿⢠⣿⢠⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⡇⡾⡙⣼⣿⣿⣿⡿⢋⣴⣿⣿⣛⡵⠾⠛⠛⠉⠀⠉⠉⠉⠙⠛⠛⠿⢿⡿⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⠙⠷⢠⣻⡟⣾⡏⣾⣿⡟⣰⣿⢃⣾⢇⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⢇⣣⢱⣿⣿⡿⢋⣴⡿⠛⠋⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⠙⠳⢿⣯⣽⣿⢧⣿⢡⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⠋⠀⠙⣿⡿⣵⡴⠛⠉⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠛⢯⢏⣵⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⠃⠀⠀⠀⠈⠓⠋⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠹⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠿⢿⣿⣋\r\n⣿⠃⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢄⠡⣔⡡⢌⠀⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠿⠟⣛⣫⣭⢶⡶⣟⣯⢷⣻\r\n⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠌⢢⣟⡾⣽⡎⢆⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠄⣂⠰⡀⠄⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢻⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⠿⢟⣛⣭⡵⣶⣻⣟⡿⣽⣞⣯⢿⡽⣞⣯⢿\r\n⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢈⠒⠼⣛⠷⣙⠂⠄⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⡔⣎⢷⡱⢈⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠻⣿⣿⣿⣿⣿⣿⣿⣿⡿⠿⣛⣻⡭⣷⢶⣟⣯⣟⡾⣽⣳⣟⡾⣽⣳⣟⡾⣯⢿⡽⣞⣿\r\n⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠀⡁⠊⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠁⡘⢌⠣⡙⠠⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢻⣿⣿⣿⠿⣛⣭⣴⡶⣿⢯⣷⣻⣽⣻⣞⡷⣯⣟⣷⣻⢾⣽⣳⣟⡾⣽⢯⣟⣽⣻⢾\r\n⣿⣦⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠂⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢘⣫⡽⣶⣻⢯⡷⣯⢿⣽⣻⣞⡷⣯⢷⡯⣟⣷⣻⢾⡽⣻⣞⡷⢯⡿⣽⣻⣞⡷⣯⢿\r\n⣿⣿⣧⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣤⣾⡟⣷⢯⣟⣯⢿⣽⣻⣞⡷⣯⢿⣽⣳⢿⡽⣞⡷⣯⣟⡷⣯⣟⣯⣟⣷⣻⢾⡽⣯⢿\r\n⣿⣿⣿⣆⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣴⣿⣳⣟⡾⣽⣻⢾⣽⣻⣞⣧⢿⡽⣞⡿⣮⣟⣯⡽⣯⣽⢾⡽⣞⣷⣻⢾⡽⣾⡽⣯⢿⣽⣻\r\n⣿⣿⣿⣿⣧⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣠⣾⣟⣾⣳⢯⣟⡷⣯⣟⡾⢧⣟⡾⣯⢿⡽⣽⣳⣟⡾⣽⣳⢯⡿⣽⠻⠾⠝⣋⣛⡥⠍⣈⣿⢾⣽\r\n⣿⣿⣿⣿⣿⣿⣿⣶⣄⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣤⣶⣷⣄⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣴⣾⣻⢷⣻⢾⣽⣻⢾⣽⣳⢯⣟⡿⣾⡽⣯⢿⡽⠳⠟⣞⣙⣃⣭⣭⣷⣶⠾⠿⢿⣛⣭⢶⣟⣯⣟⡿⣞\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⣤⣀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢠⣴⣾⣿⣿⣿⣿⠛⠉⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣀⣤⣾⣻⠷⣯⣟⢯⣟⣯⢾⣽⣻⢾⣽⣻⢾⣽⠳⢛⣩⣥⣶⣿⣿⠿⢟⣛⣭⡽⣶⣞⣿⣻⢯⡷⣯⣟⠾⠓⣋⣛⣭\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⣶⣶⣤⣦⣤⣤⣤⣤⣄⣀⣀⣀⣀⣀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢻⣿⣿⣿⣿⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢠⣴⣾⣷⠶⣂⣸⢯⣟⡷⣯⣟⡾⣽⣻⢾⠽⢻⣚⣩⣥⣶⡿⠿⣛⣯⣭⡶⣞⣿⣻⡽⣾⣽⣳⡟⠾⣝⣋⣭⣵⣶⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡆⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢠⣽⣿⣿⣿⡃⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢈⣭⡷⣞⣯⢿⣽⣻⢾⡽⠓⣋⣫⣥⣵⣶⡾⠿⣛⣫⣭⣶⢾⡿⣽⣞⣷⣻⡽⣞⠷⣛⣃⣭⣴⣶⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣾⣿⣿⣿⣿⣷⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢠⠿⠽⢛⣚⣭⣬⣴⣶⣿⣿⣿⠿⣛⣫⣵⣶⢿⣻⢷⣻⣞⣯⡟⠷⢛⣪⣥⣶⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣠⣾⣿⣿⣿⣿⣿⠿⢷⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠰⣾⣿⣿⣿⣿⣿⡿⢟⣫⣥⣾⣻⣽⣻⢾⡽⣯⡟⠯⣓⣩⣴⣶⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⡼⠿⢿⣛⣋⣭⣵⡶⣿⠻⠧⢂⣀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢹⣿⡿⢟⣫⣵⢾⣻⢷⣻⣞⡷⡯⠟⣋⣥⣶⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⠿⠛⠛⠉⠀⠀⠀⠀⠀⠀⠀⠀⠀⢠⣞⣿⣻⠟⢯⣛⣩⣬⣴⣶⣿⣿⣿⣿⣦⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠐⠾⠟⣿⣞⣯⣟⣯⢷⡯⠿⣁⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠟⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣛⣩⣴⣶⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡄⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⢓⣋⣬⣵⣶⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣇⣀⣀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣠⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣯⣥⣄⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣼⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⣶⣶⣶⣶⣶⣶⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⢶⣶⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿', 39, 2, '2025-03-25 15:31:57', '2025-03-25 15:31:57'),
(16, 'asdfasdfsadfasdf testt testes test test1 test2', 40, 4, '2025-03-26 13:38:01', '2025-03-26 13:47:39'),
(18, 'testttt', 3, 1, '2025-04-01 11:12:06', '2025-04-01 11:12:06');

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
(1, 'testModule', 'testModule'),
(2, 'idk how to call this module', ''),
(3, 'another random name', ''),
(4, 'molude', '');

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
(3, 'test1', 'test1again', 1, 1, '2025-03-26 11:23:58', '2025-04-03 14:40:57', NULL, 57, 0),
(39, 'Understanding SQL Indexes', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur porttitor vestibulum elit ut condimentum. Maecenas mollis orci vitae nunc interdum, eget posuere elit interdum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris ut ex elit. Cras in vehicula justo. In est dolor, sodales non tempus nec, suscipit ut odio. Proin eget leo nulla. Pellentesque ultricies interdum felis et convallis. Mauris vel sodales dolor, id ullamcorper mi. Donec venenatis sem non lorem porta rutrum. Nam euismod mauris turpis, ut commodo lacus ultrices sit amet. In hac habitasse platea dictumst. Nam erat nisi, semper sit amet pharetra nec, egestas et nisi. Nunc viverra nulla eget tellus posuere mattis. Aenean consequat sem purus, id hendrerit ante porttitor eget. Quisque eu ante at ipsum egestas rutrum vitae ac odio.\r\n\r\nQuisque ipsum mi, tempus vitae elit ut, pharetra fermentum augue. Mauris consectetur fermentum quam, vitae bibendum sem. Vestibulum placerat leo sit amet tortor ornare, non luctus eros bibendum. Suspendisse fringilla ullamcorper justo. Etiam interdum lacinia fermentum. Maecenas commodo euismod imperdiet. Nulla nec semper eros. Nunc a tempor ante. Nam ac posuere enim. Nulla ut tempus odio, quis ornare justo. Mauris vulputate pharetra ipsum non congue. Proin dapibus, tellus at porta mattis, ipsum mi sagittis quam, vel ultrices sem tellus non dolor. Ut scelerisque laoreet nunc ac sollicitudin. Vivamus vitae justo diam. Nulla facilisi. Nunc commodo dignissim massa in dictum.', 1, 5, '2025-03-14 16:52:22', '2025-04-01 18:49:02', NULL, 46, 3),
(40, 'Introduction to Machine Learning', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce quis nisl suscipit, posuere tortor nec, luctus felis. Sed ultrices nisi quis erat tristique porta. Fusce placerat interdum lorem, tincidunt efficitur diam suscipit a. Ut vitae mollis quam. Cras tincidunt eros sed fringilla rutrum. Phasellus varius, mauris a ultricies posuere, velit dolor dapibus sem, sollicitudin lacinia tortor arcu vel augue. Praesent eleifend posuere augue, ut porta massa malesuada nec. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nullam et libero in velit finibus lobortis. Duis nulla justo, imperdiet eget consectetur in, ornare laoreet est. Phasellus magna nisl, blandit et rutrum ut, tempor eget est. Pellentesque interdum urna lacus, sed venenatis felis pharetra in. Sed tempus ipsum vitae sapien viverra, et posuere neque posuere. Donec blandit, est et ultricies semper, turpis ante dictum mauris, eget scelerisque justo ante sed sem. Integer sit amet luctus nulla. In cursus volutpat risus quis dignissim.', 1, 3, '2025-03-14 16:52:22', '2025-04-01 14:43:01', NULL, 80, 10),
(41, 'Best Practices in Web Security', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin elementum consectetur mollis. Maecenas est est, convallis in eros vel, egestas cursus sapien. Sed congue maximus blandit. Duis placerat at nulla nec volutpat. Sed id libero ac dolor euismod varius. Sed molestie feugiat augue, eu auctor quam aliquet finibus. Aliquam tempor eget nunc et luctus. Sed dapibus, sapien non auctor interdum, risus dolor ultricies sapien, suscipit cursus turpis mi ut erat. Morbi sapien libero, placerat vitae urna sed, mollis vestibulum mauris. Cras lobortis enim vel leo tristique, a euismod eros rutrum. In eleifend ipsum vitae nunc dignissim, ac aliquet dui sollicitudin. Morbi efficitur risus quis venenatis tempus.\r\n\r\n', 1, 4, '2025-03-14 16:52:22', '2025-03-26 13:41:39', NULL, 126, 25),
(42, 'Database Optimization Tips', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi in facilisis dui, id feugiat lectus. Nulla rutrum sapien et massa eleifend, faucibus ullamcorper mauris pharetra. Nam finibus risus et dictum venenatis. Quisque imperdiet pellentesque viverra. Cras luctus dignissim rutrum. Donec semper neque ac purus auctor auctor. Pellentesque bibendum odio metus, vitae tincidunt nisi pretium et. Quisque scelerisque eros id faucibus lacinia.', 1, 3, '2025-03-14 16:52:22', '2025-04-01 14:43:06', NULL, 17, 0),
(43, 'How to Use ENUM in MySQL', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas condimentum lacus justo, et tristique nibh suscipit quis. Morbi efficitur sodales eleifend. In hac habitasse platea dictumst. Curabitur ornare ultrices odio vitae maximus. Ut nec posuere diam. Vivamus in finibus augue, sit amet rutrum sapien. In quis fringilla lacus. Etiam malesuada pretium metus. Cras ornare, enim nec posuere laoreet, turpis dui tempor leo, vel consequat erat augue ac lacus. Phasellus varius ac metus ut sagittis. Aenean non condimentum urna, quis scelerisque mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus maximus ipsum sit amet nulla interdum ornare. Nam sit amet massa quis turpis sagittis accumsan. Sed in dignissim nisi.', 1, 5, '2025-03-14 16:52:22', '2025-03-20 20:39:14', NULL, 86, 15),
(44, 'My first post!!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ornare lacus lacus, eu egestas metus vestibulum et. Integer sit amet aliquet urna. Nunc eget viverra orci. Fusce et ultricies nisi. Aliquam ut congue tortor, vitae consectetur velit. Sed gravida, dolor id ultricies vehicula, orci sem pharetra massa, quis aliquet purus dolor id neque. Duis facilisis vehicula tellus. Pellentesque facilisis velit eget mauris porta vehicula. Mauris a sapien mattis, semper quam in, tempus mauris. In hac habitasse platea dictumst. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse porta est sed sem hendrerit bibendum.', 1, 2, '2025-03-20 14:49:21', '2025-04-01 11:12:00', 1, 64, 0),
(46, 'Testing new Create Post Function', 'just testing, nothing much.', 1, 1, '2025-04-01 14:18:07', '2025-04-09 10:21:17', NULL, 7, 0);

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
(4, 'identicon-1741795708792.png'),
(5, 'identicon-1741795711113.png'),
(6, 'identicon-1741795713182.png'),
(7, 'identicon-1741795715301.png'),
(8, 'identicon-1741795717246.png'),
(9, 'identicon-1741795719592.png'),
(12, 'identicon-1741795726242.png'),
(14, 'identicon-1741795731730.png'),
(16, 'identicon-1741795737132.png'),
(17, 'identicon-1741795740154.png'),
(18, 'identicon-1741795741873.png'),
(19, 'identicon-1741795743577.png'),
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
(1, 'lxvroo', '0', '1', '$2y$10$K4LkiPBiH6/nSB3VdVWiEOqTXkiBQ2YFEClAn8AnkW7ENGdNTnD02', 'identicon-1741795713182.png', NULL, NULL, 'Active', 'admin', '2025-03-03 12:53:25'),
(2, 'nɒʜИ', 'nɘγυϱИ', 'nɒʜИ', '$2y$10$K4LkiPBiH6/nSB3VdVWiEOqTXkiBQ2YFEClAn8AnkW7ENGdNTnD02', 'identicon-1741795726242.png', NULL, NULL, 'Active', 'user', '2025-03-18 15:01:38'),
(3, 'human', 'nguyen', 'people', '$2y$10$K4LkiPBiH6/nSB3VdVWiEOqTXkiBQ2YFEClAn8AnkW7ENGdNTnD02', 'identicon-1741795711113.png', NULL, NULL, 'Active', 'user', '2025-03-19 11:28:12'),
(4, 'Nhân', 'Nguyn', 'Nhaan', '$2y$10$K4LkiPBiH6/nSB3VdVWiEOqTXkiBQ2YFEClAn8AnkW7ENGdNTnD02', 'identicon-1741795708792.png', NULL, NULL, 'Active', 'user', '2025-03-19 11:32:11'),
(5, 'nhan', 'Ngyn', 'nhan', '$2y$10$K4LkiPBiH6/nSB3VdVWiEOqTXkiBQ2YFEClAn8AnkW7ENGdNTnD02', 'identicon-1741795697173.png', NULL, NULL, 'Active', 'user', '2025-03-20 16:15:22'),
(6, 'teo`', 'Teo', 'Huynh Ba', '$2y$10$Jch8keQzVs6LTXFSwYoc7OgxlV2ZYhMR5pywbhe7mnpt.zUlwUvDu', 'identicon-1741795715301.png', NULL, NULL, 'Active', 'user', '2025-04-01 14:23:09'),
(9, 'theo?', 'Theo', 'Vu Thanh', '$2y$10$k1uRV1ko.XBbbN8H2dUc7eJZ/8UJob4FXQF/n5ev.tm6zVzucGBjK', 'identicon-1741795731730.png', NULL, NULL, 'Active', 'user', '2025-04-01 14:56:56'),
(10, 'Nhân', 'Ngyun', 'Nhaan', '$2y$10$K4LkiPBiH6/nSB3VdVWiEOqTXkiBQ2YFEClAn8AnkW7ENGdNTnD02', 'identicon-1741795708792.png', NULL, NULL, 'Active', 'user', '2025-03-19 11:32:11');

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
  MODIFY `AssetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `ModuleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `PostID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `random-avatar`
--
ALTER TABLE `random-avatar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
