-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2021 at 05:49 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_office`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `device_id` int(11) NOT NULL,
  `type` int(3) NOT NULL,
  `device_name` varchar(50) NOT NULL,
  `room_id` int(11) NOT NULL,
  `status` tinyint(5) NOT NULL COMMENT '0 = off 1 = on',
  `guest` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = enable, 0= disable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`device_id`, `type`, `device_name`, `room_id`, `status`, `guest`) VALUES
(2, 1, 'lock', 1, 3, 0),
(3, 2, 'lamp', 1, 0, 1),
(4, 3, 'fan', 1, 0, 1),
(5, 1, 'lock', 2, 0, 0),
(6, 2, 'lamp', 2, 0, 1),
(7, 3, 'fan', 2, 0, 1),
(13, 1, 'lock', 3, 0, 1),
(14, 2, 'lamp', 3, 0, 0),
(15, 2, 'lamp', 3, 0, 0),
(16, 3, 'fan', 3, 0, 1),
(17, 3, 'fan', 3, 0, 1),
(18, 1, 'lock', 10, 0, 1),
(19, 2, 'lamp', 10, 0, 0),
(20, 2, 'lamp', 10, 0, 0),
(21, 2, 'lamp', 10, 0, 0),
(22, 3, 'fan', 10, 0, 0),
(23, 3, 'fan', 10, 0, 0),
(24, 3, 'fan', 10, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `device_types`
--

CREATE TABLE `device_types` (
  `id` tinyint(1) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `device_types`
--

INSERT INTO `device_types` (`id`, `name`) VALUES
(1, 'lock'),
(2, 'lamp'),
(3, 'fan');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `no` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `room_id` int(11) NOT NULL,
  `user` varchar(25) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1 = on 0= off'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`no`, `device_id`, `time`, `room_id`, `user`, `status`) VALUES
(61, 19, '2021-02-28 14:47:29', 10, 'System', 0),
(62, 4, '2021-03-08 23:18:31', 1, '1', 1),
(63, 3, '2021-03-08 23:18:35', 1, '1', 1),
(64, 4, '2021-03-08 23:18:45', 1, '1', 0),
(65, 3, '2021-03-08 23:18:47', 1, '1', 0),
(66, 3, '2021-03-08 23:19:45', 1, '1', 1),
(67, 3, '2021-03-08 23:19:49', 1, '1', 0),
(68, 4, '2021-03-08 23:19:52', 1, '1', 1),
(69, 3, '2021-03-08 23:19:58', 1, '1', 1),
(70, 4, '2021-03-08 23:20:43', 1, '1', 0),
(71, 3, '2021-03-08 23:21:04', 1, '1', 0),
(72, 3, '2021-03-08 23:21:10', 1, '1', 1),
(73, 3, '2021-03-08 23:21:20', 1, '1', 0),
(74, 3, '2021-03-08 23:21:23', 1, '1', 1),
(75, 3, '2021-03-08 23:21:28', 1, '1', 0),
(76, 4, '2021-03-08 23:21:30', 1, '1', 1),
(77, 3, '2021-03-08 23:21:33', 1, '1', 1),
(78, 3, '2021-03-08 23:21:57', 1, '1', 0),
(79, 4, '2021-03-08 23:22:17', 1, '1', 0),
(80, 3, '2021-03-08 23:22:24', 1, '1', 1),
(81, 3, '2021-03-08 23:22:33', 1, '1', 0),
(82, 6, '2021-03-08 23:24:30', 2, '2', 1),
(83, 6, '2021-03-08 23:24:34', 2, '2', 0),
(84, 7, '2021-03-08 23:25:46', 2, '2', 1),
(85, 7, '2021-03-08 23:25:46', 2, '2', 1),
(86, 7, '2021-03-08 23:27:47', 2, '2', 0),
(87, 7, '2021-03-08 23:30:33', 2, '2', 1),
(88, 7, '2021-03-08 23:31:08', 2, '2', 0),
(89, 3, '2021-03-08 23:37:02', 1, '1', 1),
(90, 3, '2021-03-08 23:37:06', 1, '1', 0),
(91, 3, '2021-03-08 23:37:11', 1, '1', 1),
(92, 3, '2021-03-08 23:37:16', 1, '1', 0),
(93, 4, '2021-03-08 23:37:21', 1, '1', 1),
(94, 4, '2021-03-08 23:37:24', 1, '1', 0),
(95, 3, '2021-03-08 23:37:25', 1, '1', 1),
(96, 3, '2021-03-08 23:37:27', 1, '1', 0),
(97, 3, '2021-03-08 23:41:07', 1, '1', 1),
(98, 3, '2021-03-08 23:41:10', 1, '1', 0),
(99, 3, '2021-03-08 23:41:17', 1, '1', 1),
(100, 3, '2021-03-08 23:41:21', 1, '1', 0),
(101, 4, '2021-03-08 23:41:24', 1, '1', 1),
(102, 4, '2021-03-08 23:41:29', 1, '1', 0),
(103, 7, '2021-03-08 23:45:19', 2, '2', 1),
(104, 7, '2021-03-08 23:45:24', 2, '2', 0),
(105, 6, '2021-03-08 23:46:07', 2, '2', 1),
(106, 7, '2021-03-08 23:46:07', 2, '2', 1),
(107, 7, '2021-03-08 23:49:20', 2, '2', 0),
(108, 6, '2021-03-08 23:49:21', 2, '2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `u_from` varchar(25) NOT NULL,
  `u_to` varchar(25) NOT NULL,
  `message` tinyint(1) NOT NULL COMMENT '1 = requesting acces 2 = giving access 3= decline access',
  `time` datetime NOT NULL,
  `reply_status` int(1) NOT NULL DEFAULT 0 COMMENT '0 = no 1= yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `u_from`, `u_to`, `message`, `time`, `reply_status`) VALUES
(57, '5', '1', 2, '2021-02-28 14:15:13', 1),
(58, '1', '5', 2, '2021-02-28 14:48:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_type` varchar(20) NOT NULL,
  `owner` varchar(25) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_type`, `owner`, `name`) VALUES
(1, 'R1', '1', 'Jordan'),
(2, 'R2', '2', 'jurdno'),
(3, 'R2', '3', 'Testing'),
(10, 'H1', '5', 'Testing Account');

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `id_type` varchar(10) NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`id_type`, `type_name`) VALUES
('H1', 'Hall'),
('R1', 'Normal Room'),
('R2', 'Exclusive Room');

-- --------------------------------------------------------

--
-- Table structure for table `server_account`
--

CREATE TABLE `server_account` (
  `id` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 = ON 0 = OFF'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `server_account`
--

INSERT INTO `server_account` (`id`, `password`, `status`) VALUES
('server1', 'asd123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `no` int(11) NOT NULL,
  `token` varchar(25) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user` varchar(25) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1= active 0= deactive',
  `valid` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`no`, `token`, `room_id`, `user`, `status`, `valid`) VALUES
(42, '342cd468d6722edbdf0f85091', 1, '5', 0, '2021-02-28 16:30:56'),
(43, '750c89d49eaa04f21238cb8a8', 10, '1', 0, '2021-02-28 14:49:54');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(25) NOT NULL,
  `room_type` varchar(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `status1` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = offline 1 = idle2=online',
  `status2` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = not in the room, 1 = in the room',
  `automation` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = on, 0 = off',
  `automation_timer` int(11) DEFAULT 60
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `room_type`, `name`, `email`, `password`, `last_login_time`, `status1`, `status2`, `automation`, `automation_timer`) VALUES
('1', 'R1', 'Jordan', 'andyanjordan1153@gmail.com', 'asd12345', '2021-03-08 23:41:29', 2, 0, 1, 10),
('2', 'R1', 'jurdno', 'andyanjordan@gmail.com', 'asd123', '2021-03-08 23:49:21', 2, 0, 1, 60),
('3', 'R2', 'Testing', 'test@gmail.com', 'asd123', '2021-01-28 00:06:20', 0, 0, 1, 60),
('4', 'R1', NULL, NULL, 'c671bdbb8cfd3a8d4bed73713e7466e7f0b959cc', NULL, 0, 0, 1, 60),
('5', 'H1', 'Testing Account', 'test1@gmail.com', '73386d282ee33215e6ced610505e0c239b0522bb', '2021-02-28 15:18:02', 0, 0, 1, 60);

-- --------------------------------------------------------

--
-- Table structure for table `user_admin`
--

CREATE TABLE `user_admin` (
  `id` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_admin`
--

INSERT INTO `user_admin` (`id`, `password`) VALUES
('admin01', 'asd123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`device_id`);

--
-- Indexes for table `device_types`
--
ALTER TABLE `device_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`id_type`);

--
-- Indexes for table `server_account`
--
ALTER TABLE `server_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `device_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `device_types`
--
ALTER TABLE `device_types`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
