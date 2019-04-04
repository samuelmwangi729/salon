-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 02, 2019 at 09:29 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salon`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` varchar(10) NOT NULL,
  `c_id` varchar(8) NOT NULL,
  `service` varchar(10000) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `date`, `time`, `c_id`, `service`, `status`) VALUES
(1, '2019-03-31', '12:59	PM', '66543352', 'Manicure', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(5) NOT NULL,
  `from_c` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` varchar(10000) NOT NULL,
  `reply` varchar(1000) NOT NULL,
  `status` int(1) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_c`, `title`, `body`, `reply`, `status`, `time`) VALUES
(1, '33495506', '', 'Hi thanks for Approving my Appointment', 'Welcome,We Hope to see you soon.We make the experience better.. Once again  you are welcome to our salon', 1, '2019-03-30 05:55:50'),
(2, '33495506', '', 'thanks', '.', 1, '2019-03-30 05:56:55');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`name`) VALUES
('Manager'),
('Receptionist'),
('Supervisor');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `name` varchar(20) NOT NULL,
  `role` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`name`, `role`) VALUES
('Receptionist', 'Oversee the Others');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `pay` int(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `pay`, `status`, `time`) VALUES
(1, 'Manicure ', 'the best service in the region', 1000, 1, '2019-03-30 05:50:12'),
(2, 'Pedicure', 'this is the very first one of the kind ', 5000, 1, '2019-03-30 05:58:07');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`name`) VALUES
('Manicure'),
('Pedicure');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(8) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `sname` varchar(100) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `c_id` int(8) NOT NULL,
  `c_tel` int(10) NOT NULL,
  `age` int(3) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `boss` varchar(50) NOT NULL,
  `pay` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `type` varchar(100) NOT NULL DEFAULT 'Customer',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `sname`, `username`, `email`, `password`, `c_id`, `c_tel`, `age`, `nationality`, `position`, `boss`, `pay`, `status`, `type`, `time`) VALUES
(5, 'pirate', 'pirate', 'pirate pirate', 'pirate@pirate.com', '85a93d738ba2f41c28b00f240bb87287366abe8b', 66543352, 798687564, 0, '', '', '', 0, 1, 'Customer', '2019-03-30 05:54:08'),
(6, 'pirate', 'pirate2', 'root pirate', 'piratereceptionist@gmail.com', '85a93d738ba2f41c28b00f240bb87287366abe8b', 66547783, 705988567, 21, 'kenyan', 'Receptionist', 'Manager mwangi', 20000, 1, 'Employee', '2019-03-30 16:31:16'),
(1, 'samuel ', 'mwangi', 'samuel mwangi', 'samuelmwangi700@gmail.com', '85a93d738ba2f41c28b00f240bb87287366abe8b', 33495506, 796956084, 21, 'Chinese', 'Manager', 'Manager mwangi', 50000, 1, 'Employee', '2019-03-30 05:18:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
