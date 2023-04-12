-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 12, 2023 at 10:10 PM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_retrieval`
--

CREATE TABLE `address_retrieval` (
  `Address_ID` int(10) NOT NULL,
  `Address_Line1` varchar(255) NOT NULL,
  `Address_Line2` varchar(255) NOT NULL,
  `Address_City` varchar(255) NOT NULL,
  `Address_ZIP` varchar(5) NOT NULL,
  `Address_State` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(10) NOT NULL,
  `Admin_Email` varchar(255) NOT NULL,
  `Admin_Password` varchar(255) NOT NULL,
  `Admin_FName` varchar(255) NOT NULL,
  `Admin_LName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `Appointment_ID` int(10) NOT NULL,
  `Patient_ID` int(10) NOT NULL,
  `Doctor_ID` int(10) NOT NULL,
  `Appointment_DateTime` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `Doctor_ID` int(10) NOT NULL,
  `Doctor_Email` varchar(255) NOT NULL,
  `Doctor_Password` varchar(255) NOT NULL,
  `Doctor_FName` varchar(255) NOT NULL,
  `Doctor_LName` varchar(255) NOT NULL,
  `Doctor_Specialty` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `drug`
--

CREATE TABLE `drug` (
  `Drug_ID` int(10) NOT NULL,
  `Drug_Quantity` int(3) NOT NULL,
  `Drug_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `Order_ID` int(10) NOT NULL,
  `Doctor_ID` int(10) NOT NULL,
  `Patient_ID` int(10) NOT NULL,
  `Pharmacy_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `Patient_ID` int(10) NOT NULL,
  `Patient_Email` varchar(255) DEFAULT NULL,
  `Patient_Password` varchar(255) DEFAULT NULL,
  `Patient_FName` varchar(255) DEFAULT NULL,
  `Patient_LName` varchar(255) DEFAULT NULL,
  `Patient_DOB` date DEFAULT NULL,
  `Address_ID` int(10) DEFAULT NULL COMMENT 'foreign key',
  `Allergens` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

CREATE TABLE `pharmacy` (
  `Pharmacy_ID` int(10) NOT NULL,
  `Pharmacy_Name` varchar(255) NOT NULL,
  `Addess_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `Prescription_ID` int(10) NOT NULL,
  `Order_ID` int(10) NOT NULL,
  `Drug_ID` int(10) NOT NULL,
  `Prescription_Quantity` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rando`
--

CREATE TABLE `rando` (
  `a` int(1) NOT NULL,
  `b` int(2) NOT NULL,
  `c` int(3) NOT NULL,
  `d` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `Review_ID` int(10) NOT NULL,
  `Appointment_ID` int(10) NOT NULL,
  `Star_Rating` int(1) NOT NULL,
  `Feedback_Text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_retrieval`
--
ALTER TABLE `address_retrieval`
  ADD PRIMARY KEY (`Address_ID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`Appointment_ID`),
  ADD KEY `Patient_ID` (`Patient_ID`),
  ADD KEY `Doctor_ID` (`Doctor_ID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`Doctor_ID`);

--
-- Indexes for table `drug`
--
ALTER TABLE `drug`
  ADD PRIMARY KEY (`Drug_ID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`Order_ID`),
  ADD KEY `Doctor Link` (`Doctor_ID`),
  ADD KEY `Patient Link` (`Patient_ID`),
  ADD KEY `Pharmacy Link` (`Pharmacy_ID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`Patient_ID`),
  ADD KEY `Address Link` (`Address_ID`);

--
-- Indexes for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD PRIMARY KEY (`Pharmacy_ID`),
  ADD KEY `Addess_ID` (`Addess_ID`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`Prescription_ID`),
  ADD KEY `Order_ID` (`Order_ID`),
  ADD KEY `Drug_ID` (`Drug_ID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`Review_ID`),
  ADD KEY `Appointment_ID` (`Appointment_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`Patient_ID`) REFERENCES `patient` (`Patient_ID`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`Doctor_ID`) REFERENCES `doctor` (`Doctor_ID`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `Doctor Link` FOREIGN KEY (`Doctor_ID`) REFERENCES `doctor` (`Doctor_ID`),
  ADD CONSTRAINT `Patient Link` FOREIGN KEY (`Patient_ID`) REFERENCES `patient` (`Patient_ID`),
  ADD CONSTRAINT `Pharmacy Link` FOREIGN KEY (`Pharmacy_ID`) REFERENCES `pharmacy` (`Pharmacy_ID`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `Address Link` FOREIGN KEY (`Address_ID`) REFERENCES `address_retrieval` (`Address_ID`);

--
-- Constraints for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD CONSTRAINT `pharmacy_ibfk_1` FOREIGN KEY (`Addess_ID`) REFERENCES `address_retrieval` (`Address_ID`);

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`Order_ID`) REFERENCES `order` (`Order_ID`),
  ADD CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`Drug_ID`) REFERENCES `drug` (`Drug_ID`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`Appointment_ID`) REFERENCES `appointment` (`Appointment_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
