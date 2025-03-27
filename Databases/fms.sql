-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2025 at 08:02 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fms`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `EmployeeID` int NOT NULL,
  `fisrtName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `Email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `UserName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` varchar(255) DEFAULT NULL,
  `Sex` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ContactNumber` int DEFAULT NULL,
  `StationID` int DEFAULT NULL,
  `Status` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`EmployeeID`, `fisrtName`, `lastName`, `Email`, `UserName`, `Password`, `Role`, `Sex`, `ContactNumber`, `StationID`, `Status`) VALUES
(1, 'Ayub Abdirhman Said', '', 'aoubak01@gmail.com', 'aoubak', '123', 'Station Manager', 'Male', 115549635, 1, 1),
(2, 'Hawa', '', 'hawa@gmail.com', 'hawa01', '123', 'Accountant', 'Female', 775549635, 1, 0),
(3, 'Asad Ahmed Ali', '', 'asad@gmail.com', 'asad32', '123', 'Pump Operator', 'Male', 986549635, 2, 0),
(4, 'abadalla', '', 'abdalla01@gmail.com', 'abdalla', '1234', 'Accountant/Cashier', 'Male', 907408416, 1, 0),
(5, 'Hamze', 'Said', 'HAMZE01@gmail.com', 'hamze', '123', 'Accountant', NULL, NULL, NULL, 0),
(6, 'Ayub', 'Said', 'akcade34@gmail.com', NULL, 'w', NULL, NULL, NULL, NULL, 0),
(7, 'Axmed ', 'Zaki', 'ahmed0@gmail.com', 'ahmed09', '123', NULL, NULL, NULL, NULL, 0),
(8, 'Axmed ', 'Zaki', 'ahmed0@gmail.com', 'ahmed09', '123', NULL, NULL, NULL, NULL, 0),
(9, 'Axmed ', 'Zaki', 'ahmed000@gmail.com', 'ahmed000', '000', NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fuels`
--

CREATE TABLE `fuels` (
  `FuelID` int NOT NULL,
  `FuelType` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `UnitPrice` decimal(8,2) NOT NULL,
  `AvailableLiters` int NOT NULL,
  `Supplier` varchar(255) NOT NULL,
  `Status` int DEFAULT '0',
  `Date` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `fuels`
--

INSERT INTO `fuels` (`FuelID`, `FuelType`, `UnitPrice`, `AvailableLiters`, `Supplier`, `Status`, `Date`) VALUES
(1, 'Diesel', 1.00, 349999950, '3CC', 1, '2025-02-19 13:47:23'),
(2, 'Petrol', 1.70, 234000000, 'HASS', 1, '2025-02-06 13:47:33'),
(3, 'Gas', 1.30, 102000000, '3CC', 1, '2025-02-19 13:47:37'),
(4, 'Kerosene', 1.50, 100000000, '3CC', 1, '2025-02-02 13:47:41');

-- --------------------------------------------------------

--
-- Table structure for table `pumps`
--

CREATE TABLE `pumps` (
  `pumpID` int NOT NULL,
  `pumpName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stationID` int NOT NULL,
  `fuelID` int NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `MaintenanceDate` datetime DEFAULT NULL,
  `pumpDesc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pumps`
--

INSERT INTO `pumps` (`pumpID`, `pumpName`, `stationID`, `fuelID`, `createdAt`, `status`, `MaintenanceDate`, `pumpDesc`) VALUES
(1, 'Pump', 1, 1, NULL, 0, NULL, 'PumpExpress');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `salesID` int NOT NULL,
  `AtendentID` int NOT NULL,
  `pumpNo` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `previousRead` int NOT NULL,
  `currentRead` int NOT NULL,
  `soldLtr` int NOT NULL,
  `amount` int NOT NULL,
  `date` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `StationID` int NOT NULL,
  `Name` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Location` char(255) DEFAULT NULL,
  `ContactNumber` char(255) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`StationID`, `Name`, `Location`, `ContactNumber`, `status`) VALUES
(1, 'Main Station', 'Mogadisho', '115549635', '0'),
(2, 'Second Station', 'GAROOWE', '907408416', '0'),
(3, 'Third Station', 'GALKACYO', '907408416', '0'),
(4, 'Forth Station', 'BOSASO', '907408416', '1'),
(5, 'Fifth Station', 'GALDOGOB', '115549635', '0'),
(6, 'Sixth Station', 'Qardho', '907408416', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD KEY `employees_ibfk_1` (`StationID`);

--
-- Indexes for table `fuels`
--
ALTER TABLE `fuels`
  ADD PRIMARY KEY (`FuelID`);

--
-- Indexes for table `pumps`
--
ALTER TABLE `pumps`
  ADD PRIMARY KEY (`pumpID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`salesID`);

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`StationID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `EmployeeID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `fuels`
--
ALTER TABLE `fuels`
  MODIFY `FuelID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pumps`
--
ALTER TABLE `pumps`
  MODIFY `pumpID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `salesID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stations`
--
ALTER TABLE `stations`
  MODIFY `StationID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`StationID`) REFERENCES `stations` (`StationID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
