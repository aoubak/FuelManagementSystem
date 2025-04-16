-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 16, 2025 at 02:56 PM
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
  `fisrtName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `Email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `UserName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `Password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `Role` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `Sex` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `ContactNumber` int DEFAULT NULL,
  `StationID` int DEFAULT NULL,
  `Status` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`EmployeeID`, `fisrtName`, `lastName`, `Email`, `UserName`, `Password`, `Role`, `Sex`, `ContactNumber`, `StationID`, `Status`) VALUES
(1, 'Ayub Abdirhman Said', '', 'aoubak01@gmail.com', 'aoubak', '123', 'Pump Operator', 'Male', 115549635, 2, 1),
(2, 'Hawa', '', 'hawa@gmail.com', 'hawa01', '123', 'Accountant', 'Female', 775549635, 1, 0),
(3, 'Asad Ahmed Ali', '', 'asad@gmail.com', 'asad32', '123', 'Pump Operator', 'Male', 986549635, 2, 0),
(4, 'abadalla', '', 'abdalla01@gmail.com', 'abdalla', '1234', 'Accountant/Cashier', 'Male', 907408416, 1, 0),
(5, 'Hamze', 'Said', 'HAMZE01@gmail.com', 'hamze', '123', 'Accountant', NULL, NULL, NULL, 0),
(6, 'Ayub', 'Said', 'akcade34@gmail.com', NULL, 'w', NULL, NULL, NULL, NULL, 0),
(7, 'Axmed ', 'Zaki', 'ahmed0@gmail.com', 'ahmed09', '123', NULL, NULL, NULL, NULL, 0),
(8, 'Axmed ', 'Zaki', 'ahmed0@gmail.com', 'ahmed09', '123', NULL, NULL, NULL, NULL, 0),
(9, 'Axmed ', 'Zaki', 'ahmed000@gmail.com', 'ahmed000', '000', NULL, NULL, NULL, NULL, 0),
(10, 'abdalla', 'abadalla', 'abdalla01@gmail.com', 'abdall', '123', 'Security Guard', NULL, 908877009, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fuels`
--

CREATE TABLE `fuels` (
  `FuelID` int NOT NULL,
  `FuelType` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `UnitPrice` decimal(8,2) NOT NULL,
  `AvailableLiters` int NOT NULL,
  `Supplier` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `Status` int DEFAULT '0',
  `Date` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `fuels`
--

INSERT INTO `fuels` (`FuelID`, `FuelType`, `UnitPrice`, `AvailableLiters`, `Supplier`, `Status`, `Date`) VALUES
(1, 'Diesel', 1.00, 349999345, '3CC', 1, '2025-02-19 13:47:23'),
(2, 'Petrol', 1.70, 233999725, 'HASS', 1, '2025-02-06 13:47:33'),
(3, 'Gas', 1.30, 101999788, '3CC', 1, '2025-02-19 13:47:37'),
(4, 'Kerosene', 1.50, 190, '3CC', 0, '2025-02-02 13:47:41');

-- --------------------------------------------------------

--
-- Table structure for table `pumps`
--

CREATE TABLE `pumps` (
  `pumpID` int NOT NULL,
  `pumpName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `stationID` int NOT NULL,
  `fuelID` int NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `MaintenanceDate` datetime DEFAULT NULL,
  `pumpDesc` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `pumps`
--

INSERT INTO `pumps` (`pumpID`, `pumpName`, `stationID`, `fuelID`, `createdAt`, `status`, `MaintenanceDate`, `pumpDesc`) VALUES
(1, 'PumpNWC', 1, 1, NULL, 0, NULL, 'PumpExpress'),
(2, 'CR72025', 2, 2, NULL, 0, NULL, 'For Petrols');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int NOT NULL,
  `atendentID` int NOT NULL,
  `transaction_no` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `fuelType` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pumpNo` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `unitPrice` decimal(8,2) NOT NULL,
  `preRead` int NOT NULL,
  `curRead` int NOT NULL,
  `ltrSold` decimal(8,2) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `payment_method` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `entry_method` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `tax` decimal(8,2) DEFAULT NULL,
  `invoice_no` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `stationID` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `atendentID`, `transaction_no`, `fuelType`, `pumpNo`, `unitPrice`, `preRead`, `curRead`, `ltrSold`, `amount`, `payment_method`, `entry_method`, `tax`, `invoice_no`, `stationID`, `created_at`) VALUES
(1, 1, 'GMS-433857', 'Diesel', 'PumpNWC', 1.00, 10, 30, 20.00, 20.00, 'Cash', 'Swiped', 1.00, 'INV-000001', 1, '2025-04-07 21:23:06'),
(2, 1, 'GMS-590761', 'Diesel', 'PumpNWC', 1.00, 10, 30, 20.00, 20.00, 'Cash', 'Swiped', 2.00, 'INV-000002', 1, '2025-04-07 21:26:24'),
(3, 1, 'GMS-332703', 'Gas', 'PumpNWC', 1.30, 23, 45, 22.00, 28.60, 'Cash', 'Manual', 0.00, 'INV-000003', 1, '2025-04-07 21:53:07'),
(4, 1, 'GMS-624455', 'Kerosene', 'PumpNWC', 1.50, 10, 20, 10.00, 15.00, 'Cash', 'Swiped', 0.00, 'INV-000004', 1, '2025-04-07 22:47:48'),
(5, 1, 'GMS-230796', 'Petrol', 'PumpNWC', 1.70, 200, 250, 50.00, 85.00, 'Cash', 'Manual', 3.00, 'INV-000005', 1, '2025-04-07 22:49:45'),
(6, 1, 'GMS-685974', 'Diesel', 'PumpNWC', 1.00, 50, 70, 20.00, 20.00, 'Cash', 'Manual', 1.00, 'INV-000006', 1, '2025-04-09 18:39:10'),
(8, 1, 'GMS-232323', 'Petrol', 'PumpNWC', 1.70, 100, 200, 100.00, 170.00, 'Cash', 'Inserted', 1.00, 'INV-000007', 1, '2025-04-09 19:17:36'),
(13, 1, 'GMS-191078', 'Diesel', 'PumpNWC', 1.00, 50, 100, 50.00, 50.00, 'Cash', 'Manual', 1.00, 'INV-000010', 1, '2025-04-09 20:16:47'),
(14, 1, 'GMS-278175', 'Diesel', 'PumpNWC', 1.00, 40, 100, 60.00, 60.00, 'Mobile', 'Manual', 1.00, 'INV-000011', 1, '2025-04-09 20:18:36'),
(15, 1, 'GMS-201352', 'Gas', 'PumpNWC', 1.30, 40, 100, 60.00, 78.00, 'Cash', 'Inserted', 1.00, 'INV-000012', 1, '2025-04-09 20:20:06'),
(16, 1, 'GMS-907711', 'Kerosene', 'PumpNWC', 1.50, 20, 100, 80.00, 120.00, '-choose-', 'Swiped', 1.00, 'INV-000013', 1, '2025-04-09 20:30:45'),
(17, 1, 'GMS-695701', 'Diesel', 'PumpNWC', 1.00, 20, 50, 30.00, 30.00, 'Cash', 'Swiped', 1.00, 'INV-000014', 1, '2025-04-10 18:14:05'),
(18, 1, 'GMS-634969', 'Petrol', 'PumpNWC', 1.70, 40, 80, 40.00, 68.00, 'Mobile', 'Inserted', 2.00, 'INV-000015', 1, '2025-04-10 18:15:45'),
(19, 1, 'GMS-756179', 'Gas', 'PumpNWC', 1.30, 20, 80, 60.00, 78.00, 'Cash', 'Manual', 1.00, 'INV-000016', 1, '2025-04-10 19:19:55'),
(20, 1, 'GMS-102803', 'Kerosene', 'PumpNWC', 1.50, 20, 45, 25.00, 37.50, 'Cash', 'Swiped', 0.00, 'INV-000017', 1, '2025-04-10 19:20:27'),
(21, 1, 'GMS-110920', 'Petrol', 'PumpNWC', 1.70, 20, 40, 20.00, 34.00, 'Cash', 'Swiped', 0.00, 'INV-000018', 1, '2025-04-10 19:20:49'),
(22, 1, 'GMS-697527', 'Diesel', 'PumpNWC', 1.00, 30, 50, 20.00, 20.00, 'Cash', 'Inserted', 0.00, 'INV-000019', 1, '2025-04-10 19:21:15'),
(23, 10, 'GMS-139940', 'Kerosene', '1', 1.50, 20, 30, 10.00, 15.00, 'Cash', 'Inserted', 0.00, 'INV-000020', 1, '2025-04-16 19:18:16');

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `StationID` int NOT NULL,
  `Name` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `Location` char(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `ContactNumber` char(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`StationID`, `Name`, `Location`, `ContactNumber`, `status`) VALUES
(1, 'Main Station', 'Mogadisho', '115549635', '0'),
(2, 'Second Station', 'GAROOWE', '907408416', '1'),
(3, 'Third Station', 'GALKACYO', '907408416', '1'),
(4, 'Forth Station', 'BOSASO', '907408416', '1'),
(5, 'Fifth Station', 'GALDOGOB', '115549635', '1'),
(6, 'Sixth Station', 'Qardho', '907408416', '1');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `contactNumber` int NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`StationID`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `EmployeeID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fuels`
--
ALTER TABLE `fuels`
  MODIFY `FuelID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pumps`
--
ALTER TABLE `pumps`
  MODIFY `pumpID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `stations`
--
ALTER TABLE `stations`
  MODIFY `StationID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

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
