-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2023 at 09:11 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ras`
--

-- --------------------------------------------------------

--
-- Table structure for table `apartment`
--

CREATE TABLE `apartment` (
  `ApartmentID` varchar(100) NOT NULL,
  `holdingNumber` bigint(20) NOT NULL,
  `rentpermonth` double NOT NULL,
  `size` double NOT NULL,
  `availability` tinyint(1) NOT NULL DEFAULT 1,
  `BHK` int(100) NOT NULL,
  `available_from` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apartment`
--

INSERT INTO `apartment` (`ApartmentID`, `holdingNumber`, `rentpermonth`, `size`, `availability`, `BHK`, `available_from`) VALUES
('12345-1A', 12345, 20000, 1200, 0, 2, NULL),
('12345-2A', 12345, 50000, 3000, 0, 4, NULL),
('12346-1A', 12346, 23000, 2200, 1, 3, NULL),
('12346-1B', 12346, 22000, 2000, 0, 2, NULL),
('12346-1C', 12346, 24000, 2300, 0, 3, '2023-03-01'),
('12346-1D', 12346, 23000, 2200, 0, 3, '2023-04-01'),
('12346-2A', 12346, 20000, 2100, 0, 2, NULL),
('12353-1A', 12353, 50000, 4000, 1, 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `holdingNumber` bigint(20) NOT NULL,
  `buildingName` varchar(200) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`holdingNumber`, `buildingName`, `image`) VALUES
(12345, 'Professor Villa', 'building\\12345.jpg'),
(12346, 'Nilima House', 'building\\12346.jpg'),
(12350, 'Manchester City Palace', 'building\\12350.jpg'),
(12352, 'Aston Villa', 'building/12352.jpg'),
(12353, 'Messi Palace', 'building/12353.jpg'),
(12362, 'Barcelona Housing Society', 'building/12362.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `holdingNumber` bigint(20) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `area` varchar(100) NOT NULL,
  `thana` varchar(100) NOT NULL,
  `houseNo` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`holdingNumber`, `street`, `city`, `area`, `thana`, `houseNo`) VALUES
(12345, 'Road No.2', 'Chattogram', 'Sughandha', 'Panchlaish', 25),
(12346, 'Road No. 5', 'Chattogram', 'Cosmopoliton', 'Panchlaish', 33),
(12353, 'Road No 19', 'Chattogram', 'Sughandha', 'Panchlaish', 5),
(12362, 'Road No 3', 'Chittagong', 'Sughondha', 'Panchlaish', 10);

-- --------------------------------------------------------

--
-- Table structure for table `own`
--

CREATE TABLE `own` (
  `email` varchar(100) NOT NULL,
  `holdingNumber` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `own`
--

INSERT INTO `own` (`email`, `holdingNumber`) VALUES
('alvarez19@gmail.com', 12353),
('haaland9@gmail.com', 12350),
('km7@gmail.com', 12346),
('martinez23@gmail.com', 12352),
('messi10@gmail.com', 12345),
('messi10@gmail.com', 12362);

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`first_name`, `last_name`, `phone`, `email`, `image`) VALUES
('Julian', 'Alvarez', '0238741', 'alvarez19@gmail.com', 'owner/alvarez19@gmail.com.jpg'),
('Erling', 'Haaland', '2187348', 'haaland9@gmail.com', 'owner\\haaland9@gmail.com.jpg'),
('Kylian', 'Mbappe', '2342374', 'km7@gmail.com', 'owner\\km7@gmail.com.jpg'),
('Emi', 'Martinez', '2341234', 'martinez23@gmail.com', 'owner/martinez23@gmail.com.jpg'),
('Lionel', 'Messi', '+8801813548764', 'messi10@gmail.com', 'owner\\messi10@gmail.com.jpg'),
('Neymar', 'Jr', '+8801813548782', 'neymar10@gmail.com', 'owner\\neymar10@gmail.com.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `ApartmentID` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `rent_of` varchar(100) NOT NULL,
  `paid_date` date DEFAULT NULL,
  `verify` varchar(100) DEFAULT NULL,
  `type` varchar(100) NOT NULL,
  `tnx_id` varchar(100) NOT NULL,
  `verified_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_history`
--

INSERT INTO `payment_history` (`ApartmentID`, `name`, `rent_of`, `paid_date`, `verify`, `type`, `tnx_id`, `verified_by`) VALUES
('12345-1A', 'Alison Becker', '2023-01', '2023-01-07', 'rejected', 'bkash', 'jan_pay', 'not verified'),
('12345-1A', 'Alison Becker', '2023-02', '2023-02-07', 'verified', 'nagad', 'feb_pay', 'messi10@gmail.com'),
('12345-1A', '', '2023-03', NULL, '', '', '', ''),
('12345-1A', '', '2023-04', NULL, '', '', '', ''),
('12345-2A', '', '2023-01', NULL, NULL, '', '', NULL),
('12345-2A', 'Stefan Bajectic', '2023-02', '2023-02-07', 'rejected', 'bkash', 'asfg', 'not verified'),
('12345-2A', '', '2023-03', NULL, NULL, '', '', NULL),
('12345-2A', '', '2023-04', NULL, NULL, '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `ApartmentID` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `nid` varchar(100) NOT NULL,
  `fdesc` varchar(300) NOT NULL,
  `registerddate` date NOT NULL DEFAULT current_timestamp(),
  `nid_image` varchar(200) NOT NULL,
  `advanced_amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`ApartmentID`, `first_name`, `last_name`, `phone`, `email`, `image`, `nid`, `fdesc`, `registerddate`, `nid_image`, `advanced_amount`) VALUES
('12345-1A', 'Alison', 'Becker', '12837401', 'beckar5@gmail.com', 'tenant/12345-1A.jpg', '2374162384', 'Married', '2023-01-01', 'nid/12345-1A.png', 20000),
('12345-2A', 'Stefan', 'Bajectic', '1823471203', 'bajectic_loss_ball@gmail.com', 'tenant/12345-2A.jpg', '17263413278', 'total 7 members', '2023-02-01', 'nid/12345-2A.png', 50000),
('12346-1B', 'Robiul', 'Apu', '54623456', 'apu69@gmail.com', 'tenant/12346-1B.jpg', '23471283748291', '1 boyfreind', '2023-02-01', 'nid/12346-1B.png', 200),
('12346-1C', 'Shajidul', 'Islam', '3245342525', 'shajidul69@gmail.com', 'tenant\\12346-1C.jpg', '23471283748291', 'Four girlfriend and no wife', '2023-02-18', 'nid\\12346-1C.png', 0),
('12346-1D', 'Emam', 'Easin', '0181384298', 'Easin78@gmail.com', '', '5626234510', '', '2022-08-15', '', 0),
('12346-2A', 'Sanim', 'Sourav', '32487520347', 'sourav69@gmail.com', '', '832475234', 'trying to find a girl', '2023-02-18', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `type`) VALUES
('12345-1A@ras.com', '2374162384', 'tenant'),
('12345-2A@ras.com', '17263413278', 'tenant'),
('12346-1B@ras.com', '23471283748291', 'tenant'),
('12346-1C@ras.com', '23471283748291', 'tenant'),
('12346-2A@ras.com', '832475234', 'tenant'),
('12349-1C@ras.com', '1234', 'tenant'),
('12349-2A@ras.com', '53452345234', 'tenant'),
('alvarez19@gmail.com', '1234', 'owner'),
('haaland9@gmail.com', '1234', 'owner'),
('km7@gmail.com', 'psgfan', 'owner'),
('martinez23@gmail.com', '1234', 'owner'),
('messi10@gmail.com', '123321', 'owner'),
('neymar10@gmail.com', '2026', 'owner'),
('tajbir@gmail.com', '123456', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apartment`
--
ALTER TABLE `apartment`
  ADD PRIMARY KEY (`ApartmentID`),
  ADD KEY `ApartmentID` (`ApartmentID`),
  ADD KEY `holdingNumber` (`holdingNumber`);

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`holdingNumber`),
  ADD KEY `holdingNumber` (`holdingNumber`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`holdingNumber`),
  ADD KEY `holdingNumber` (`holdingNumber`);

--
-- Indexes for table `own`
--
ALTER TABLE `own`
  ADD PRIMARY KEY (`email`,`holdingNumber`),
  ADD KEY `email` (`email`),
  ADD KEY `holdingNumber` (`holdingNumber`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`email`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`ApartmentID`,`rent_of`),
  ADD KEY `ApartmentID` (`ApartmentID`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`ApartmentID`),
  ADD KEY `apartmentid` (`ApartmentID`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `holdingNumber` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12363;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apartment`
--
ALTER TABLE `apartment`
  ADD CONSTRAINT `apartment_ibfk_1` FOREIGN KEY (`holdingNumber`) REFERENCES `building` (`holdingNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`holdingNumber`) REFERENCES `building` (`holdingNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `own`
--
ALTER TABLE `own`
  ADD CONSTRAINT `own_ibfk_1` FOREIGN KEY (`email`) REFERENCES `owner` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `own_ibfk_2` FOREIGN KEY (`holdingNumber`) REFERENCES `building` (`holdingNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `owner`
--
ALTER TABLE `owner`
  ADD CONSTRAINT `owner_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD CONSTRAINT `payment_history_ibfk_1` FOREIGN KEY (`ApartmentID`) REFERENCES `apartment` (`ApartmentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tenant`
--
ALTER TABLE `tenant`
  ADD CONSTRAINT `tenant_ibfk_1` FOREIGN KEY (`ApartmentID`) REFERENCES `apartment` (`ApartmentID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
