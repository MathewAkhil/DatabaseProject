-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2023 at 10:59 PM
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
-- Database: `csce310`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_retrieval`
--

CREATE TABLE `address_retrieval` (
  `Address_ID` int(10) NOT NULL,
  `Address_Line1` varchar(255) NOT NULL,
  `Address_Line2` varchar(255) DEFAULT NULL,
  `City` varchar(255) NOT NULL,
  `State` varchar(2) NOT NULL,
  `ZIP` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address_retrieval`
--

INSERT INTO `address_retrieval` (`Address_ID`, `Address_Line1`, `Address_Line2`, `City`, `State`, `ZIP`) VALUES
(1, '111 First Street ', 'Apt 1', 'College Station', 'TX', 77840),
(2, '222 Second Street', 'Apt 2', 'College Station', 'TX', 77840),
(3, '333 Third Street', 'Apt 3', 'College Station', 'TX', 77840),
(11, '717 University Dr', 'Unit 101', 'College Station', 'TX', 77840),
(12, '2322 Texas Ave', NULL, 'College Station', 'TX', 77840),
(13, '455 George Bush Dr W', NULL, 'College Station', 'TX', 77840);

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `Appointment_ID` int(10) NOT NULL,
  `Patient_ID` int(10) DEFAULT NULL,
  `Doctor_ID` int(10) NOT NULL,
  `Appointment_Date` date NOT NULL,
  `Appointment_StartTime` time NOT NULL,
  `Appointment_EndTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`Appointment_ID`, `Patient_ID`, `Doctor_ID`, `Appointment_Date`, `Appointment_StartTime`, `Appointment_EndTime`) VALUES
(1, 101, 201, '2023-05-01', '13:00:00', '14:00:00'),
(2, 102, 202, '2023-05-01', '14:00:00', '15:00:00'),
(3, 103, 203, '2023-05-01', '15:00:00', '16:00:00'),
(4, NULL, 201, '2023-05-01', '14:00:00', '15:00:00'),
(5, NULL, 202, '2023-05-01', '15:00:00', '16:00:00'),
(6, NULL, 203, '2023-05-01', '16:00:00', '17:00:00'),
(11, 101, 201, '2023-05-08', '13:00:00', '14:00:00'),
(12, 102, 202, '2023-05-08', '14:00:00', '15:00:00'),
(13, 103, 203, '2023-05-08', '15:00:00', '16:00:00'),
(14, NULL, 201, '2023-05-08', '14:00:00', '15:00:00'),
(15, NULL, 202, '2023-05-08', '15:00:00', '16:00:00'),
(16, NULL, 203, '2023-05-08', '16:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `User_ID` int(10) NOT NULL,
  `Doctor_Speciality` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`User_ID`, `Doctor_Speciality`) VALUES
(201, 'Psychiatrist'),
(202, 'Pediatrician'),
(203, 'Dermatologist'),
(222, NULL);

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
  `User_ID` int(10) NOT NULL,
  `Address_ID` int(10) DEFAULT NULL,
  `Patient_Allergens` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`User_ID`, `Address_ID`, `Patient_Allergens`) VALUES
(101, 1, 'ALL NUTS'),
(102, 2, 'PENICILLIN'),
(103, 3, 'GLUTEN'),
(111, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

CREATE TABLE `pharmacy` (
  `Pharmacy_ID` int(10) NOT NULL,
  `Pharmacy_Name` varchar(255) NOT NULL,
  `Addess_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacy`
--

INSERT INTO `pharmacy` (`Pharmacy_ID`, `Pharmacy_Name`, `Addess_ID`) VALUES
(1, 'CVS', 11),
(2, 'Walgreens', 12),
(3, 'Brookshire Brothers', 13);

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `Prescription_ID` int(11) NOT NULL,
  `Order_ID` int(11) NOT NULL,
  `Drug_ID` int(11) NOT NULL,
  `Prescription_Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `Review_ID` int(10) NOT NULL,
  `Appointment_ID` int(10) NOT NULL,
  `Star` int(1) NOT NULL,
  `Feedback_Text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_ID` int(10) NOT NULL,
  `User_Email` varchar(255) NOT NULL,
  `User_Password` varchar(255) NOT NULL,
  `User_FName` varchar(255) NOT NULL,
  `User_LName` varchar(255) NOT NULL,
  `User_DOB` date NOT NULL,
  `User_Type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_ID`, `User_Email`, `User_Password`, `User_FName`, `User_LName`, `User_DOB`, `User_Type`) VALUES
(0, 'admin@test.com', 'asdf', 'Test', 'Admin', '2001-01-01', 0),
(1, 'arya.abbott@hospital.com', 'asdf', 'Arya', 'Abbott', '2001-01-01', 0),
(100, 'patient@test.com', 'asdf', 'Test', 'Patient', '2001-01-01', 1),
(101, 'pablo.peterson@gmail.com', 'asdf', 'Pablo', 'Peterson', '2001-01-01', 1),
(102, 'paul.phillips@gmail.com', 'asdf', 'Paul', 'Phillips', '2001-01-01', 1),
(103, 'patrick.parker@gmail.com', 'asdf', 'Patrick', 'Parker', '2001-01-01', 1),
(200, 'doctor@test.com', 'asdf', 'Test', 'Doctor', '2001-01-01', 2),
(201, 'daniel.davis@hospital.com', 'asdf', 'Daniel', 'Davis', '2001-01-01', 2),
(202, 'david.dunn@hospital.com', 'asdf', 'David', 'Dunn', '2001-01-01', 2),
(203, 'dylan.dixon@hospital.com', 'asdf', 'Dylan', 'Dixon', '2001-01-01', 2);

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `Patient/Doctor Trigger` AFTER INSERT ON `user` FOR EACH ROW IF NEW.User_Type = 1 THEN
        INSERT INTO patient (User_ID) VALUES (NEW.User_ID);
ELSEIF NEW.User_Type = 2 THEN
        INSERT INTO doctor (User_ID) VALUES (NEW.User_ID);
END IF
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_retrieval`
--
ALTER TABLE `address_retrieval`
  ADD PRIMARY KEY (`Address_ID`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`Appointment_ID`),
  ADD KEY `AppointmentDoctor Link` (`Doctor_ID`),
  ADD KEY `AppointmentPatient Link` (`Patient_ID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`User_ID`);

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
  ADD KEY `OrderDoctor Link` (`Doctor_ID`),
  ADD KEY `OrderPatient Link` (`Patient_ID`),
  ADD KEY `OrderPharmacy Link` (`Pharmacy_ID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`User_ID`),
  ADD KEY `PatientAddress Link` (`Address_ID`);

--
-- Indexes for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD PRIMARY KEY (`Pharmacy_ID`),
  ADD KEY `PharmacyAddress Link` (`Addess_ID`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`Prescription_ID`),
  ADD KEY `PrescriptionOrder Link` (`Order_ID`),
  ADD KEY `PrescriptionDrug Link` (`Drug_ID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`Review_ID`),
  ADD KEY `ReviewAppointment Link` (`Appointment_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address_retrieval`
--
ALTER TABLE `address_retrieval`
  MODIFY `Address_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `Appointment_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `drug`
--
ALTER TABLE `drug`
  MODIFY `Drug_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `Order_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharmacy`
--
ALTER TABLE `pharmacy`
  MODIFY `Pharmacy_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `Prescription_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `Review_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `AppointmentDoctor Link` FOREIGN KEY (`Doctor_ID`) REFERENCES `doctor` (`User_ID`),
  ADD CONSTRAINT `AppointmentPatient Link` FOREIGN KEY (`Patient_ID`) REFERENCES `patient` (`User_ID`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `OrderDoctor Link` FOREIGN KEY (`Doctor_ID`) REFERENCES `doctor` (`User_ID`),
  ADD CONSTRAINT `OrderPatient Link` FOREIGN KEY (`Patient_ID`) REFERENCES `patient` (`User_ID`),
  ADD CONSTRAINT `OrderPharmacy Link` FOREIGN KEY (`Pharmacy_ID`) REFERENCES `pharmacy` (`Pharmacy_ID`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `PatientAddress Link` FOREIGN KEY (`Address_ID`) REFERENCES `address_retrieval` (`Address_ID`);

--
-- Constraints for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD CONSTRAINT `PharmacyAddress Link` FOREIGN KEY (`Addess_ID`) REFERENCES `address_retrieval` (`Address_ID`);

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `PrescriptionDrug Link` FOREIGN KEY (`Drug_ID`) REFERENCES `drug` (`Drug_ID`),
  ADD CONSTRAINT `PrescriptionOrder Link` FOREIGN KEY (`Order_ID`) REFERENCES `order` (`Order_ID`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `ReviewAppointment Link` FOREIGN KEY (`Appointment_ID`) REFERENCES `appointment` (`Appointment_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
