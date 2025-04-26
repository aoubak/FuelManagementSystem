-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 25, 2025 at 02:30 PM
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
  `Status` int DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`EmployeeID`, `fisrtName`, `lastName`, `Email`, `UserName`, `Password`, `Role`, `Sex`, `ContactNumber`, `StationID`, `Status`, `image`, `remember_token`) VALUES
(1, 'Ayub', 'Said', 'aoubak01@gmail.com', 'aoubak', '$2y$10$5UI.4Jjs9y7dE/OCboE2GebG8rRMOCV2sm7fi/T2bvBn/Q9vV8t6.', 'Admin', 'Male', 115549635, 1, 1, '6807828b28ca4.png', 'a5b037ed121a18fb1512b4b2841ff80edf0ab6d7b3bf582848c67a05e978b413'),
(2, 'Hawa', 'ahmed', 'hawa@gmail.com', 'hawa01', '$2y$10$YcMvXWhXoqRu3yrwOMcx7.UMXEy5axAvZP09pnBVLebJ4QKJ1JZaC', 'Pump Operator', 'Female', 775549635, 1, 1, '680a1c5b52372.png', NULL),
(3, 'Asad ', 'Ali', 'asad@gmail.com', 'asad32', '$2y$10$5UI.4Jjs9y7dE/OCboE2GebG8rRMOCV2sm7fi/T2bvBn/Q9vV8t6.', 'Pump Operator', 'Male', 986549635, 2, 1, NULL, NULL),
(13, 'farah', 'ali', 'farah@gmail.com', 'farah12', '1234', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(14, 'Fatima', 'Husain', 'fatima@gmail.com', 'fatima12', '$2y$10$zRA4XlQd/MEsZlWiJP8xT.NWDuQ.2yHdTX2GIVgG4ZPqcr4uhIB6y', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(15, 'asad', 'xaji', 'akcade34@gmail.com', 'asad32', '$2y$10$Q49VAYraluMSVwS32S8oxO3eGmZGc461kaXofFlxUW1DMfxLSB4Wy', 'Pump Operator', 'Male', 97376272, 1, 0, NULL, NULL);

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
(2, 'Petrol', 1.70, 233999651, 'HASS', 1, '2025-02-06 13:47:33'),
(3, 'Gas', 1.30, 501, '3CC', 1, '2025-02-19 13:47:37'),
(4, 'Kerosene', 1.50, 501, '3CC', 1, '2025-02-02 13:47:41');

-- --------------------------------------------------------

--
-- Table structure for table `fuel_order_history`
--

CREATE TABLE `fuel_order_history` (
  `id` int NOT NULL,
  `fuel_type` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `quantity_liters` decimal(10,2) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_cost` decimal(10,2) DEFAULT NULL,
  `supplier_name` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `received_by` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `delivery_note` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `date_received` datetime DEFAULT CURRENT_TIMESTAMP,
  `remarks` text COLLATE utf8mb4_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `fuel_order_history`
--

INSERT INTO `fuel_order_history` (`id`, `fuel_type`, `quantity_liters`, `unit_price`, `total_cost`, `supplier_name`, `received_by`, `delivery_note`, `date_received`, `remarks`) VALUES
(1, 'Diesel', 5000.00, 1.25, 6250.00, 'ABC Fuel Co.', 'AOUBAK', 'DN-2032', '2025-04-21 03:12:04', 'Urgent refill before holiday');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `expires_at` datetime NOT NULL,
  `used` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `expires_at`, `used`) VALUES
(1, 'aoubak01@gmail.com', '09893224d039a396a3ae50f96f9332800f7eacaf6f902bbb1ce25203103056e54e0cb585b49f0c03c98eb73c712929c7c7ad', '2025-04-24 19:23:19', 0),
(2, 'aoubak01@gmail.com', 'ad25caf3b851975239386833527c3f901a01c4b5bcff7a3a6fa77795940a5c858ff69b133b509bdfc688d74212659edca630', '2025-04-24 19:26:48', 0),
(3, 'aoubak01@gmail.com', '2a24eb33b3560a11f1de42b7a4f7c10343892c0dae1dc0113709338b47594625fc2de78dfdae0dccd1186b099fdfe5be97ca', '2025-04-24 19:34:53', 0),
(4, 'aoubak01@gmail.com', '9d00626cb3aa1d08bcde843a33f8229b5721beb8bb406e2f0538b606a495403a878ad934a96296cc406bf029dd4c90f0cd6d', '2025-04-24 19:39:19', 0),
(5, 'akcade34@gmail.com', 'bbb73d14172e8bdc5c1c62375b99a7518332682f75483818c202459f07d8dff52334943d4e3377371c94000255f5537813f6', '2025-04-24 19:53:55', 0),
(6, 'akcade34@gmail.com', 'c1dc6c9edd9310871159be57b4aee1b075b3b2fae14df3994c291af09ab992d719737fa3eb7a5f2a133b131bcaf19735ab13', '2025-04-24 19:55:58', 0),
(7, 'akcade34@gmail.com', '0276668fc6e0636085791d5ae7c26bbe178f37449960769f986e3055964266be48aba90f5231ddbf6690363091eba397f137', '2025-04-24 19:56:06', 0),
(8, 'akcade34@gmail.com', 'fc2e3ad1b77f15154a79303456fb7bfe6127e1ff1b46f07cbc838d6a15293f9820449dcf6a382ce393d97cb7168289cffef7', '2025-04-24 19:58:44', 0),
(9, 'aoubak01@gmail.com', '8385ac0986426ea3e76a84ac46bffcc4d4ceeed01744582809e364daa612de59040dfac82ec5002c1afca5f4edca45ddc4ea', '2025-04-24 19:59:38', 0),
(10, 'akcade34@gmail.com', 'c5adb05ecc06842ee13d2f609954429cca4926dd3b8c6eec7f5bcb132f0df301780c25b0c71e77e02bdfa6bd9e968fe6a9c6', '2025-04-24 20:09:39', 0),
(11, 'akcade34@gmail.com', 'cbf40b2ffa60a4fc2dbec2fbbef4cfcda24f4c43101a7e0ce1ecc2fa49f8048002e8538d9f2c82df505a128af457c7de7b32', '2025-04-24 20:10:51', 0),
(12, 'akcade34@gmail.com', 'd861f99f25fd04a9efaa32ad21589fc9ee6cf76372f45e86be012dfa4e6db4225f5b68ba50d82c4667f682e031103e67601a', '2025-04-24 20:13:53', 0),
(13, 'akcade34@gmail.com', '8e3dbf7f42340918cc628501ccd4ebfaa5c553769bbc011e75425884cef819ba5595f91bb0061cca224a5073d5b298a07320', '2025-04-24 20:14:28', 0),
(14, 'akcade34@gmail.com', '2fbf774b49dc39d5bfe08abb45c01164e9e558f6442f06b403f25bba89931e98ddcc5161d06f00c4401f3593c752155e7d54', '2025-04-24 20:16:06', 0),
(15, 'akcade34@gmail.com', '22711dbe3bf6bddc89a94d85b4fab502a7dc0c44e3953ff97a8153d934cd885f4b0e4651a364f34c2577847d510b0e95903e', '2025-04-24 20:29:36', 0),
(16, 'akcade34@gmail.com', 'abfa1afc18216a5ba46bd00263ab6f810ace582adc3ea04fd8ff31dc43ebbf5c02483b1b2bce02d9b1195ff46b36ee7649c0', '2025-04-24 21:45:15', 0),
(17, 'akcade34@gmail.com', '24742c084b0e5c8e4f630dd118ea284e616d352f73c0dd49c3e202894039031ee9a183ae53ed090247699c867442d9ab7dba', '2025-04-25 03:47:15', 1),
(18, 'akcade34@gmail.com', '0dbf1872fe82b88c1dd93914fa3c4eb648d2ff2c4f5c186483735bd77a63840145da86d4778fc61b66342720af3b21d5f0dd', '2025-04-24 23:23:30', 0),
(19, 'akcade34@gmail.com', '368078cc862b7481cd085c40319da3947a742443d2754ea3ff71d71fb3b0ce30443c2544f93a05d8dd315d71ed26bed1e45e', '2025-04-25 04:59:03', 1),
(20, 'akcade34@gmail.com', '3720265a8a901fe1a1402fd0f0c875012d218765e01bbea6539ac329f8682bf39d103972ee83727f0972dd38a4ce31f421e7', '2025-04-25 04:00:16', 1),
(21, 'akcade34@gmail.com', '0d40847a642b909d57a506eccca5f4920204772ae2ea74177874621b15a41f534304192b2c9d5d60ded1ea653600d712ca4d', '2025-04-25 04:13:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pumps`
--

CREATE TABLE `pumps` (
  `pumpID` int NOT NULL,
  `pumpName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `stationID` int NOT NULL,
  `fuelID` int NOT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `MaintenanceDate` datetime DEFAULT NULL,
  `pumpDesc` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `pumps`
--

INSERT INTO `pumps` (`pumpID`, `pumpName`, `stationID`, `fuelID`, `createdAt`, `status`, `MaintenanceDate`, `pumpDesc`) VALUES
(1, 'PumpNWC', 1, 2, NULL, 0, NULL, 'PumpExpress'),
(4, 'Walver', 3, 4, NULL, 0, NULL, 'W324');

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
  `sales_ref` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `stationID` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `atendentID`, `transaction_no`, `fuelType`, `pumpNo`, `unitPrice`, `preRead`, `curRead`, `ltrSold`, `amount`, `payment_method`, `entry_method`, `tax`, `sales_ref`, `stationID`, `created_at`) VALUES
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
(21, 1, 'GMS-110920', 'Petrol', 'PumpNWC', 1.70, 20, 40, 20.00, 34.00, 'Cash', 'Swiped', 0.00, 'INV-000018', 1, '2025-03-10 19:20:49'),
(22, 1, 'GMS-697527', 'Diesel', 'PumpNWC', 1.00, 30, 50, 20.00, 20.00, 'Cash', 'Inserted', 0.00, 'INV-000019', 1, '2025-01-10 19:21:15'),
(23, 10, 'GMS-139940', 'Kerosene', '1', 1.50, 20, 30, 10.00, 15.00, 'Cash', 'Inserted', 0.00, 'INV-000020', 1, '2025-04-16 19:18:16'),
(24, 1, 'GMS-426861', 'Kerosene', '4', 1.50, 20, 45, 25.00, 37.50, 'Mobile', 'Manual', 0.00, 'Cash', 1, '2025-03-21 03:48:08'),
(25, 1, 'GMS-319718', 'Kerosene', '4', 1.50, 20, 25, 5.00, 7.50, 'Cash', 'Swiped', 0.00, 'INV-000021', 1, '2024-08-21 04:16:45'),
(26, 1, 'GMS-301494', 'Kerosene', '4', 1.50, 10, 15, 5.00, 7.50, 'Cash', 'Manual', 0.00, 'Cash', 1, '2025-03-21 04:27:20'),
(27, 1, 'GMS-631240', 'Petrol', '1', 1.70, 30, 67, 37.00, 62.90, 'Cash', 'Swiped', 0.00, 'Cash', 1, '2024-04-21 23:09:47'),
(28, 1, 'GMS-503221', 'Petrol', '1', 1.70, 30, 67, 37.00, 62.90, 'Card', 'Swiped', 0.00, 'Cash', 1, '2025-04-21 23:55:15'),
(29, 1, 'GMS-655763', 'Kerosene', '4', 1.50, 30, 67, 37.00, 55.50, 'Cash', 'Swiped', 0.00, 'Cash', 1, '2025-04-21 23:55:58'),
(30, 2, 'GMS-476619', 'Gas', '3', 1.39, 75, 92, 21.96, 30.52, 'Cash', 'Swiped', 2.75, 'Cash', 2, '2025-03-08 03:49:26'),
(31, 3, 'GMS-463163', 'Petrol', '4', 1.55, 31, 109, 82.84, 128.40, 'Cash', 'Swiped', 2.63, 'Cash', 1, '2024-08-02 07:15:17'),
(32, 2, 'GMS-209660', 'Diesel', '4', 1.20, 181, 216, 35.11, 42.13, 'Cash', 'Inserted', 1.66, 'Cash', 2, '2024-12-30 15:47:28'),
(33, 5, 'GMS-359099', 'Gas', '2', 1.59, 189, 236, 43.74, 69.55, 'Cash', 'Swiped', 1.43, 'Cash', 2, '2024-06-15 04:26:18'),
(34, 6, 'GMS-631255', 'Gas', '2', 1.74, 26, 53, 26.64, 46.35, 'Cash', 'Swiped', 2.80, 'Cash', 4, '2024-10-01 15:31:39'),
(35, 1, 'GMS-530620', 'Gas', '1', 1.66, 79, 150, 67.41, 111.90, 'Cash', 'Manual', 1.78, 'Cash', 1, '2024-10-23 17:33:12'),
(36, 10, 'GMS-409648', 'Petrol', '1', 1.23, 27, 91, 68.42, 84.16, 'Cash', 'Inserted', 0.15, 'Cash', 4, '2024-05-28 14:20:28'),
(37, 2, 'GMS-222334', 'Petrol', '2', 1.71, 62, 92, 31.53, 53.92, 'Cash', 'Manual', 1.08, 'Cash', 2, '2024-12-25 13:23:25'),
(38, 6, 'GMS-257097', 'Petrol', '1', 1.78, 46, 140, 97.67, 173.85, 'Cash', 'Inserted', 0.94, 'Cash', 2, '2024-11-08 05:25:41'),
(39, 8, 'GMS-400374', 'Diesel', '3', 1.59, 122, 198, 77.15, 122.67, 'Cash', 'Inserted', 0.27, 'Cash', 1, '2024-05-23 20:27:32'),
(40, 6, 'GMS-373001', 'Gas', '1', 1.41, 87, 125, 42.91, 60.50, 'Cash', 'Manual', 2.40, 'Cash', 1, '2025-02-19 14:42:31'),
(41, 1, 'GMS-459942', 'Kerosene', '3', 1.75, 71, 123, 49.54, 86.69, 'Cash', 'Inserted', 0.73, 'Cash', 3, '2025-03-10 03:31:34'),
(42, 7, 'GMS-759000', 'Gas', '3', 1.73, 183, 241, 55.01, 95.17, 'Cash', 'Manual', 2.38, 'Cash', 1, '2025-04-10 13:10:52'),
(43, 1, 'GMS-788299', 'Gas', '3', 1.02, 36, 57, 24.35, 24.84, 'Cash', 'Swiped', 2.26, 'Cash', 3, '2025-01-05 04:19:33'),
(44, 5, 'GMS-121743', 'Diesel', '1', 1.61, 170, 235, 63.17, 101.70, 'Cash', 'Manual', 0.83, 'Cash', 4, '2024-08-03 20:34:46'),
(45, 1, 'GMS-196291', 'Kerosene', '3', 1.01, 0, 31, 31.72, 32.04, 'Cash', 'Swiped', 2.00, 'Cash', 2, '2024-07-19 05:50:27'),
(46, 8, 'GMS-746682', 'Gas', '1', 1.45, 95, 188, 93.36, 135.37, 'Cash', 'Swiped', 0.39, 'Cash', 2, '2024-12-11 09:17:51'),
(47, 10, 'GMS-554758', 'Petrol', '4', 1.08, 153, 234, 76.92, 83.07, 'Cash', 'Inserted', 1.35, 'Cash', 1, '2024-07-28 03:34:33'),
(48, 9, 'GMS-408177', 'Gas', '4', 1.56, 53, 79, 27.11, 42.29, 'Cash', 'Inserted', 1.57, 'Cash', 1, '2025-04-12 22:26:32'),
(49, 2, 'GMS-961061', 'Petrol', '3', 1.74, 67, 148, 82.62, 143.76, 'Cash', 'Inserted', 2.11, 'Cash', 3, '2024-11-21 20:46:36'),
(50, 6, 'GMS-821419', 'Gas', '1', 1.36, 26, 111, 88.16, 119.90, 'Cash', 'Inserted', 1.31, 'Cash', 3, '2025-03-23 18:42:15'),
(51, 2, 'GMS-684304', 'Diesel', '2', 1.67, 183, 235, 55.33, 92.40, 'Cash', 'Inserted', 2.02, 'Cash', 1, '2025-04-16 00:14:54'),
(52, 1, 'GMS-623912', 'Gas', '2', 1.60, 28, 104, 77.66, 124.26, 'Cash', 'Manual', 2.57, 'Cash', 3, '2024-04-10 00:39:29'),
(53, 10, 'GMS-913475', 'Kerosene', '3', 1.48, 122, 171, 47.31, 70.02, 'Cash', 'Swiped', 1.03, 'Cash', 1, '2024-08-14 07:18:39'),
(54, 4, 'GMS-844089', 'Kerosene', '2', 1.21, 89, 134, 46.25, 55.96, 'Cash', 'Inserted', 2.90, 'Cash', 4, '2024-06-18 14:01:02'),
(55, 5, 'GMS-477664', 'Diesel', '3', 1.07, 175, 207, 32.53, 34.81, 'Cash', 'Manual', 0.17, 'Cash', 3, '2024-08-11 17:19:18'),
(56, 5, 'GMS-894650', 'Kerosene', '3', 1.04, 129, 177, 46.19, 48.04, 'Cash', 'Swiped', 2.96, 'Cash', 3, '2024-06-29 10:22:00'),
(57, 8, 'GMS-101916', 'Petrol', '4', 1.29, 157, 204, 48.95, 63.15, 'Cash', 'Swiped', 0.73, 'Cash', 2, '2024-04-11 16:20:30'),
(58, 1, 'GMS-440185', 'Diesel', '1', 1.30, 96, 188, 95.65, 124.35, 'Cash', 'Inserted', 0.04, 'Cash', 3, '2024-05-29 23:19:52'),
(59, 5, 'GMS-209779', 'Kerosene', '2', 1.08, 196, 257, 61.62, 66.55, 'Cash', 'Swiped', 0.03, 'Cash', 4, '2024-07-18 06:24:38'),
(60, 5, 'GMS-450629', 'Gas', '2', 1.64, 85, 156, 71.84, 117.82, 'Cash', 'Swiped', 2.22, 'Cash', 2, '2024-12-25 21:09:15'),
(61, 4, 'GMS-850297', 'Diesel', '1', 1.54, 97, 147, 45.43, 69.96, 'Cash', 'Inserted', 0.73, 'Cash', 3, '2024-11-13 19:03:12'),
(62, 3, 'GMS-140227', 'Kerosene', '3', 1.43, 110, 143, 32.47, 46.43, 'Cash', 'Inserted', 0.89, 'Cash', 3, '2024-06-16 08:46:26'),
(63, 3, 'GMS-727652', 'Petrol', '3', 1.31, 15, 112, 101.47, 132.93, 'Cash', 'Inserted', 0.50, 'Cash', 1, '2025-02-15 09:58:53'),
(64, 7, 'GMS-119637', 'Petrol', '3', 1.06, 38, 118, 76.87, 81.48, 'Cash', 'Manual', 1.03, 'Cash', 1, '2024-12-30 05:55:16'),
(65, 10, 'GMS-809060', 'Diesel', '3', 1.29, 197, 254, 55.42, 71.49, 'Cash', 'Manual', 0.19, 'Cash', 2, '2024-07-31 21:24:55'),
(66, 3, 'GMS-962823', 'Gas', '1', 1.64, 54, 131, 73.86, 121.13, 'Cash', 'Manual', 1.75, 'Cash', 1, '2024-10-02 20:56:26'),
(67, 7, 'GMS-477893', 'Gas', '1', 1.20, 67, 134, 63.85, 76.62, 'Cash', 'Manual', 0.45, 'Cash', 2, '2025-02-10 06:01:31'),
(68, 6, 'GMS-959134', 'Diesel', '2', 1.30, 95, 139, 47.69, 62.00, 'Cash', 'Manual', 2.90, 'Cash', 2, '2024-09-20 16:17:50'),
(69, 4, 'GMS-902535', 'Kerosene', '1', 1.79, 109, 203, 96.96, 173.56, 'Cash', 'Manual', 0.41, 'Cash', 4, '2024-06-20 21:11:47'),
(70, 4, 'GMS-551805', 'Diesel', '1', 1.67, 99, 146, 48.25, 80.58, 'Cash', 'Inserted', 1.84, 'Cash', 4, '2024-10-27 20:39:57'),
(71, 3, 'GMS-275475', 'Kerosene', '3', 1.48, 103, 164, 56.61, 83.78, 'Cash', 'Swiped', 1.51, 'Cash', 4, '2025-02-09 17:39:30'),
(72, 8, 'GMS-926979', 'Kerosene', '3', 1.18, 32, 74, 37.18, 43.87, 'Cash', 'Manual', 2.59, 'Cash', 2, '2024-06-21 20:56:36'),
(73, 1, 'GMS-400846', 'Diesel', '4', 1.39, 35, 79, 41.07, 57.09, 'Cash', 'Inserted', 0.68, 'Cash', 1, '2024-09-07 20:39:54'),
(74, 9, 'GMS-309234', 'Kerosene', '2', 1.11, 64, 155, 91.77, 101.86, 'Cash', 'Manual', 1.69, 'Cash', 4, '2024-07-22 22:10:38'),
(75, 7, 'GMS-461728', 'Petrol', '3', 1.02, 153, 213, 61.57, 62.80, 'Cash', 'Swiped', 0.87, 'Cash', 4, '2024-10-02 17:05:53'),
(76, 8, 'GMS-899500', 'Petrol', '4', 1.64, 118, 153, 36.93, 60.57, 'Cash', 'Swiped', 2.21, 'Cash', 4, '2024-08-12 14:27:39'),
(77, 3, 'GMS-257994', 'Gas', '2', 1.55, 108, 131, 21.09, 32.69, 'Cash', 'Manual', 0.39, 'Cash', 3, '2024-07-13 19:10:28'),
(78, 5, 'GMS-294745', 'Petrol', '1', 1.05, 32, 74, 42.75, 44.89, 'Cash', 'Manual', 1.72, 'Cash', 3, '2024-07-17 21:00:20'),
(79, 5, 'GMS-991928', 'Gas', '1', 1.27, 152, 233, 81.25, 103.19, 'Cash', 'Inserted', 2.81, 'Cash', 1, '2024-05-26 15:03:39'),
(80, 4, 'GMS-225118', 'Kerosene', '4', 1.49, 81, 176, 95.87, 142.85, 'Cash', 'Manual', 2.85, 'Cash', 1, '2024-04-16 12:25:58'),
(81, 7, 'GMS-963914', 'Gas', '3', 1.71, 38, 53, 10.09, 17.25, 'Cash', 'Swiped', 1.12, 'Cash', 3, '2025-01-29 09:06:20'),
(82, 9, 'GMS-302430', 'Kerosene', '2', 1.43, 182, 206, 20.05, 28.67, 'Cash', 'Manual', 1.93, 'Cash', 4, '2024-12-21 21:34:16'),
(83, 7, 'GMS-697802', 'Diesel', '1', 1.74, 163, 218, 52.08, 90.62, 'Cash', 'Manual', 0.62, 'Cash', 1, '2024-06-13 01:29:38'),
(84, 7, 'GMS-556383', 'Gas', '2', 1.19, 168, 199, 28.15, 33.50, 'Cash', 'Swiped', 0.03, 'Cash', 3, '2024-05-23 05:00:12'),
(85, 6, 'GMS-363432', 'Diesel', '2', 1.65, 157, 213, 59.51, 98.19, 'Cash', 'Manual', 1.74, 'Cash', 1, '2024-11-01 07:50:05'),
(86, 6, 'GMS-220071', 'Gas', '3', 1.35, 25, 39, 10.00, 13.50, 'Cash', 'Swiped', 0.72, 'Cash', 3, '2025-01-15 03:56:19'),
(87, 4, 'GMS-244616', 'Diesel', '1', 1.31, 38, 89, 48.25, 63.21, 'Cash', 'Inserted', 1.71, 'Cash', 4, '2025-01-18 02:21:46'),
(88, 2, 'GMS-448582', 'Petrol', '2', 1.34, 63, 100, 38.23, 51.23, 'Cash', 'Inserted', 0.89, 'Cash', 4, '2024-12-01 19:55:10'),
(89, 3, 'GMS-731980', 'Kerosene', '2', 1.21, 122, 156, 37.05, 44.83, 'Cash', 'Inserted', 1.21, 'Cash', 4, '2024-11-17 07:20:59'),
(90, 4, 'GMS-738129', 'Petrol', '3', 1.10, 152, 231, 78.90, 86.79, 'Cash', 'Inserted', 2.58, 'Cash', 3, '2024-08-13 14:13:15'),
(91, 10, 'GMS-430203', 'Kerosene', '1', 1.70, 54, 114, 57.25, 97.33, 'Cash', 'Manual', 2.45, 'Cash', 4, '2024-04-04 11:07:32'),
(92, 5, 'GMS-575045', 'Diesel', '3', 1.60, 13, 75, 66.55, 106.48, 'Cash', 'Inserted', 0.08, 'Cash', 4, '2025-04-10 00:55:15'),
(93, 6, 'GMS-785384', 'Gas', '1', 1.64, 11, 64, 48.44, 79.44, 'Cash', 'Inserted', 2.07, 'Cash', 1, '2024-05-25 15:19:08'),
(94, 10, 'GMS-709180', 'Diesel', '4', 1.67, 193, 272, 74.34, 124.15, 'Cash', 'Manual', 0.30, 'Cash', 2, '2025-02-17 19:08:32'),
(95, 1, 'GMS-647411', 'Petrol', '4', 1.19, 154, 197, 42.00, 49.98, 'Cash', 'Swiped', 2.62, 'Cash', 2, '2024-06-02 05:39:40'),
(96, 8, 'GMS-540783', 'Diesel', '3', 1.20, 195, 220, 21.55, 25.86, 'Cash', 'Inserted', 2.44, 'Cash', 1, '2024-10-19 16:41:01'),
(97, 1, 'GMS-421616', 'Petrol', '4', 1.56, 189, 272, 86.09, 134.30, 'Cash', 'Inserted', 1.44, 'Cash', 4, '2025-01-08 14:13:02'),
(98, 5, 'GMS-660644', 'Gas', '2', 1.62, 136, 175, 42.42, 68.72, 'Cash', 'Manual', 2.77, 'Cash', 3, '2025-01-31 15:19:22'),
(99, 4, 'GMS-984124', 'Kerosene', '1', 1.22, 97, 148, 53.43, 65.18, 'Cash', 'Manual', 0.90, 'Cash', 1, '2024-08-01 18:36:48'),
(100, 4, 'GMS-387913', 'Petrol', '3', 1.25, 107, 176, 72.67, 90.84, 'Cash', 'Manual', 2.59, 'Cash', 4, '2024-08-03 14:52:36'),
(101, 7, 'GMS-512128', 'Petrol', '2', 1.51, 134, 178, 41.65, 62.89, 'Cash', 'Swiped', 1.81, 'Cash', 1, '2024-11-12 03:31:20'),
(102, 8, 'GMS-793308', 'Gas', '1', 1.72, 184, 242, 53.41, 91.87, 'Cash', 'Swiped', 0.11, 'Cash', 2, '2024-10-30 15:29:39'),
(103, 2, 'GMS-382487', 'Kerosene', '2', 1.11, 74, 146, 69.47, 77.11, 'Cash', 'Inserted', 0.58, 'Cash', 2, '2024-06-24 12:05:41'),
(104, 8, 'GMS-946806', 'Kerosene', '2', 1.22, 186, 263, 72.20, 88.08, 'Cash', 'Swiped', 0.50, 'Cash', 1, '2024-04-07 01:00:35'),
(105, 8, 'GMS-855419', 'Gas', '2', 1.07, 80, 93, 17.52, 18.75, 'Cash', 'Manual', 2.96, 'Cash', 1, '2024-12-24 14:32:38'),
(106, 9, 'GMS-640770', 'Kerosene', '1', 1.13, 55, 145, 86.10, 97.29, 'Cash', 'Inserted', 0.65, 'Cash', 4, '2024-11-08 16:23:32'),
(107, 5, 'GMS-190831', 'Petrol', '2', 1.59, 15, 65, 54.57, 86.77, 'Cash', 'Swiped', 1.38, 'Cash', 1, '2024-09-12 10:05:43'),
(108, 3, 'GMS-993087', 'Gas', '2', 1.35, 44, 58, 16.13, 21.78, 'Cash', 'Manual', 2.25, 'Cash', 2, '2024-12-01 12:54:09'),
(109, 6, 'GMS-951691', 'Diesel', '3', 1.04, 6, 89, 85.69, 89.12, 'Cash', 'Manual', 2.44, 'Cash', 3, '2024-09-01 22:02:05'),
(110, 9, 'GMS-219158', 'Gas', '1', 1.80, 33, 51, 19.43, 34.97, 'Cash', 'Swiped', 0.49, 'Cash', 4, '2024-08-21 19:05:59'),
(111, 1, 'GMS-644962', 'Gas', '1', 1.58, 160, 215, 52.54, 83.01, 'Cash', 'Inserted', 1.26, 'Cash', 1, '2024-07-21 19:37:31'),
(112, 3, 'GMS-500429', 'Kerosene', '2', 1.63, 191, 213, 24.22, 39.48, 'Cash', 'Manual', 2.60, 'Cash', 1, '2025-01-20 15:18:38'),
(113, 9, 'GMS-428804', 'Gas', '2', 1.23, 21, 112, 91.67, 112.75, 'Cash', 'Inserted', 2.00, 'Cash', 1, '2024-09-24 15:30:02'),
(114, 5, 'GMS-682821', 'Kerosene', '2', 1.11, 138, 152, 16.19, 17.97, 'Cash', 'Manual', 0.17, 'Cash', 3, '2024-07-22 16:11:00'),
(115, 4, 'GMS-569948', 'Kerosene', '3', 1.11, 49, 138, 87.00, 96.57, 'Cash', 'Swiped', 0.13, 'Cash', 4, '2025-03-22 10:21:28'),
(116, 5, 'GMS-906529', 'Petrol', '4', 1.54, 93, 156, 60.31, 92.88, 'Cash', 'Inserted', 1.06, 'Cash', 2, '2025-01-07 00:22:35'),
(117, 7, 'GMS-391989', 'Gas', '3', 1.17, 10, 70, 63.75, 74.59, 'Cash', 'Swiped', 1.51, 'Cash', 2, '2025-04-06 03:19:21'),
(118, 3, 'GMS-293114', 'Diesel', '4', 1.63, 200, 241, 38.05, 62.02, 'Cash', 'Swiped', 0.13, 'Cash', 2, '2025-01-16 21:20:08'),
(119, 5, 'GMS-787672', 'Kerosene', '1', 1.50, 7, 35, 29.15, 43.72, 'Cash', 'Inserted', 0.61, 'Cash', 4, '2024-10-20 14:28:01'),
(120, 10, 'GMS-146449', 'Gas', '1', 1.07, 117, 173, 53.24, 56.97, 'Cash', 'Manual', 1.98, 'Cash', 2, '2024-10-13 04:06:32'),
(121, 4, 'GMS-619356', 'Diesel', '2', 1.62, 17, 112, 96.03, 155.57, 'Cash', 'Manual', 2.46, 'Cash', 4, '2024-09-06 10:31:44'),
(122, 7, 'GMS-756444', 'Petrol', '3', 1.12, 1, 78, 76.55, 85.74, 'Cash', 'Inserted', 0.54, 'Cash', 3, '2024-12-22 17:12:47'),
(123, 5, 'GMS-405941', 'Petrol', '3', 1.57, 173, 236, 58.51, 91.86, 'Cash', 'Inserted', 1.31, 'Cash', 1, '2024-11-20 22:32:37'),
(124, 6, 'GMS-603136', 'Diesel', '1', 1.38, 184, 253, 70.84, 97.76, 'Cash', 'Inserted', 0.92, 'Cash', 4, '2025-03-02 17:57:07'),
(125, 6, 'GMS-167491', 'Kerosene', '3', 1.52, 199, 297, 97.82, 148.69, 'Cash', 'Inserted', 1.70, 'Cash', 2, '2024-11-24 12:48:22'),
(126, 10, 'GMS-865313', 'Gas', '4', 1.52, 45, 55, 13.73, 20.87, 'Cash', 'Inserted', 1.45, 'Cash', 2, '2025-03-07 19:08:05'),
(127, 1, 'GMS-148621', 'Kerosene', '2', 1.28, 111, 127, 18.02, 23.07, 'Cash', 'Manual', 2.31, 'Cash', 1, '2024-04-03 23:22:09'),
(128, 3, 'GMS-597172', 'Kerosene', '1', 1.48, 29, 73, 48.41, 71.65, 'Cash', 'Swiped', 0.06, 'Cash', 2, '2024-04-24 13:40:06'),
(129, 1, 'GMS-940556', 'Petrol', '4', 1.19, 56, 135, 80.58, 95.89, 'Cash', 'Manual', 1.00, 'Cash', 1, '2024-11-11 05:46:24'),
(130, 7, 'GMS-905229', 'Diesel', '3', 1.72, 163, 202, 43.55, 74.91, 'Cash', 'Swiped', 1.48, 'Cash', 1, '2024-05-02 23:59:36'),
(131, 4, 'GMS-988058', 'Diesel', '2', 1.30, 81, 171, 90.22, 117.29, 'Cash', 'Inserted', 1.54, 'Cash', 3, '2025-01-10 05:27:21'),
(132, 7, 'GMS-633244', 'Petrol', '3', 1.15, 17, 39, 19.85, 22.83, 'Cash', 'Inserted', 0.46, 'Cash', 3, '2024-12-25 09:01:38'),
(133, 5, 'GMS-791378', 'Petrol', '3', 1.65, 104, 185, 76.31, 125.91, 'Cash', 'Swiped', 2.26, 'Cash', 1, '2024-10-21 04:23:14'),
(134, 2, 'GMS-398561', 'Petrol', '3', 1.64, 83, 107, 25.30, 41.49, 'Cash', 'Manual', 0.17, 'Cash', 1, '2024-04-17 00:47:35'),
(135, 2, 'GMS-241555', 'Gas', '1', 1.22, 197, 282, 86.01, 104.93, 'Cash', 'Manual', 1.09, 'Cash', 3, '2024-11-03 08:30:49'),
(136, 1, 'GMS-244519', 'Diesel', '4', 1.33, 92, 137, 48.68, 64.74, 'Cash', 'Manual', 0.66, 'Cash', 1, '2024-10-05 01:57:54'),
(137, 9, 'GMS-193104', 'Diesel', '3', 1.13, 163, 252, 86.33, 97.55, 'Cash', 'Inserted', 1.50, 'Cash', 4, '2024-11-04 12:38:31'),
(138, 8, 'GMS-629863', 'Gas', '1', 1.17, 151, 233, 79.02, 92.45, 'Cash', 'Manual', 2.90, 'Cash', 2, '2024-04-30 22:47:42'),
(139, 1, 'GMS-952983', 'Gas', '4', 1.27, 178, 265, 88.19, 112.00, 'Cash', 'Inserted', 2.19, 'Cash', 3, '2024-09-27 22:07:47'),
(140, 9, 'GMS-395863', 'Gas', '2', 1.19, 95, 153, 62.54, 74.42, 'Cash', 'Swiped', 0.21, 'Cash', 4, '2024-10-17 15:22:09'),
(141, 2, 'GMS-924598', 'Petrol', '1', 1.04, 96, 189, 88.63, 92.18, 'Cash', 'Manual', 0.46, 'Cash', 3, '2024-07-16 06:40:13'),
(142, 7, 'GMS-874727', 'Gas', '2', 1.24, 196, 243, 51.67, 64.07, 'Cash', 'Manual', 2.03, 'Cash', 4, '2024-11-23 15:07:07'),
(143, 6, 'GMS-441276', 'Gas', '2', 1.25, 7, 107, 96.45, 120.56, 'Cash', 'Swiped', 2.14, 'Cash', 3, '2024-06-11 14:53:58'),
(144, 10, 'GMS-341662', 'Diesel', '1', 1.08, 112, 203, 95.75, 103.41, 'Cash', 'Manual', 1.43, 'Cash', 2, '2024-10-03 22:23:52'),
(145, 1, 'GMS-411451', 'Petrol', '3', 1.73, 153, 188, 33.56, 58.06, 'Cash', 'Inserted', 0.03, 'Cash', 1, '2024-05-09 07:27:19'),
(146, 3, 'GMS-792092', 'Kerosene', '4', 1.06, 170, 235, 69.20, 73.35, 'Cash', 'Manual', 2.99, 'Cash', 3, '2024-09-24 05:59:56'),
(147, 4, 'GMS-651978', 'Diesel', '1', 1.07, 124, 224, 95.07, 101.72, 'Cash', 'Inserted', 0.33, 'Cash', 4, '2024-04-07 13:38:35'),
(148, 10, 'GMS-505042', 'Petrol', '1', 1.68, 147, 229, 86.15, 144.73, 'Cash', 'Inserted', 0.09, 'Cash', 2, '2024-05-21 14:55:10'),
(149, 9, 'GMS-904237', 'Petrol', '1', 1.37, 45, 112, 63.91, 87.56, 'Cash', 'Inserted', 1.41, 'Cash', 4, '2024-06-25 21:40:02'),
(150, 2, 'GMS-897153', 'Kerosene', '2', 1.27, 156, 235, 80.53, 102.27, 'Cash', 'Inserted', 2.02, 'Cash', 1, '2024-10-16 09:45:28'),
(151, 6, 'GMS-500827', 'Kerosene', '4', 1.21, 57, 72, 10.31, 12.48, 'Cash', 'Swiped', 1.82, 'Cash', 1, '2024-11-16 17:40:03'),
(152, 3, 'GMS-923585', 'Petrol', '3', 1.78, 199, 251, 55.78, 99.29, 'Cash', 'Inserted', 1.61, 'Cash', 2, '2024-12-30 22:50:56'),
(153, 10, 'GMS-487580', 'Diesel', '4', 1.80, 65, 124, 56.17, 101.11, 'Cash', 'Swiped', 2.32, 'Cash', 4, '2024-11-10 22:39:27'),
(154, 7, 'GMS-472976', 'Diesel', '4', 1.21, 91, 147, 59.98, 72.58, 'Cash', 'Inserted', 0.78, 'Cash', 2, '2024-12-31 17:50:03'),
(155, 7, 'GMS-313265', 'Petrol', '4', 1.07, 3, 61, 61.61, 65.92, 'Cash', 'Swiped', 2.81, 'Cash', 4, '2024-11-21 13:21:37'),
(156, 2, 'GMS-314988', 'Diesel', '2', 1.17, 76, 95, 16.14, 18.88, 'Cash', 'Swiped', 1.73, 'Cash', 4, '2024-09-10 04:13:23'),
(157, 8, 'GMS-107316', 'Gas', '2', 1.72, 40, 80, 41.49, 71.36, 'Cash', 'Manual', 1.92, 'Cash', 1, '2025-02-21 11:50:47'),
(158, 3, 'GMS-758864', 'Kerosene', '3', 1.58, 50, 125, 79.46, 125.55, 'Cash', 'Manual', 0.41, 'Cash', 3, '2024-04-02 11:12:03'),
(159, 4, 'GMS-376888', 'Gas', '4', 1.36, 106, 138, 32.95, 44.81, 'Cash', 'Inserted', 2.88, 'Cash', 4, '2024-10-24 10:46:17'),
(160, 6, 'GMS-618438', 'Gas', '3', 1.71, 125, 178, 54.26, 92.78, 'Cash', 'Inserted', 1.90, 'Cash', 1, '2024-12-08 02:14:44'),
(161, 6, 'GMS-786773', 'Gas', '4', 1.52, 75, 164, 88.36, 134.31, 'Cash', 'Swiped', 1.04, 'Cash', 4, '2024-05-18 19:28:19'),
(162, 1, 'GMS-720628', 'Diesel', '4', 1.32, 89, 180, 86.06, 113.60, 'Cash', 'Inserted', 1.84, 'Cash', 2, '2025-02-25 15:00:54'),
(163, 4, 'GMS-818407', 'Gas', '1', 1.41, 137, 171, 35.05, 49.42, 'Cash', 'Inserted', 1.21, 'Cash', 1, '2025-03-17 02:08:46'),
(164, 1, 'GMS-726834', 'Gas', '4', 1.04, 175, 204, 29.08, 30.24, 'Cash', 'Manual', 1.45, 'Cash', 2, '2024-08-13 11:36:17'),
(165, 4, 'GMS-903808', 'Petrol', '3', 1.74, 51, 123, 74.39, 129.44, 'Cash', 'Manual', 0.57, 'Cash', 3, '2024-08-29 05:54:12'),
(166, 7, 'GMS-271163', 'Kerosene', '4', 1.15, 52, 140, 89.04, 102.40, 'Cash', 'Inserted', 0.90, 'Cash', 1, '2024-06-16 02:17:16'),
(167, 8, 'GMS-404338', 'Gas', '3', 1.17, 13, 67, 49.87, 58.35, 'Cash', 'Manual', 1.13, 'Cash', 2, '2025-04-16 03:28:34'),
(168, 6, 'GMS-511809', 'Gas', '3', 1.42, 155, 178, 27.06, 38.43, 'Cash', 'Swiped', 1.61, 'Cash', 2, '2025-03-13 20:22:02'),
(169, 3, 'GMS-949649', 'Kerosene', '1', 1.42, 68, 146, 74.49, 105.78, 'Cash', 'Swiped', 0.28, 'Cash', 1, '2025-02-12 17:17:50'),
(170, 2, 'GMS-832993', 'Petrol', '4', 1.52, 91, 150, 59.59, 90.58, 'Cash', 'Swiped', 2.32, 'Cash', 4, '2025-03-21 23:30:30'),
(171, 2, 'GMS-453361', 'Kerosene', '4', 1.47, 143, 184, 37.05, 54.46, 'Cash', 'Inserted', 0.92, 'Cash', 2, '2024-04-11 15:00:27'),
(172, 9, 'GMS-667252', 'Petrol', '4', 1.50, 170, 254, 84.87, 127.31, 'Cash', 'Manual', 0.29, 'Cash', 1, '2024-12-09 16:49:02'),
(173, 8, 'GMS-289697', 'Kerosene', '4', 1.12, 70, 86, 11.63, 13.03, 'Cash', 'Inserted', 2.66, 'Cash', 2, '2024-09-22 12:38:51'),
(174, 8, 'GMS-139847', 'Diesel', '1', 1.54, 128, 225, 99.10, 152.61, 'Cash', 'Inserted', 1.06, 'Cash', 3, '2024-06-21 21:34:17'),
(175, 10, 'GMS-706472', 'Petrol', '1', 1.74, 105, 177, 74.19, 129.09, 'Cash', 'Inserted', 1.80, 'Cash', 4, '2024-11-05 12:43:54'),
(176, 9, 'GMS-854043', 'Gas', '3', 1.43, 30, 124, 97.19, 138.98, 'Cash', 'Swiped', 1.84, 'Cash', 3, '2024-09-03 01:06:08'),
(177, 8, 'GMS-334925', 'Petrol', '4', 1.63, 169, 202, 31.40, 51.18, 'Cash', 'Manual', 1.88, 'Cash', 1, '2024-04-22 21:19:51'),
(178, 10, 'GMS-431697', 'Kerosene', '4', 1.16, 106, 188, 84.41, 97.92, 'Cash', 'Manual', 1.43, 'Cash', 2, '2024-10-08 12:19:56'),
(179, 9, 'GMS-322126', 'Petrol', '1', 1.03, 0, 30, 26.04, 26.82, 'Cash', 'Inserted', 0.36, 'Cash', 4, '2024-12-02 01:51:09'),
(180, 6, 'GMS-638227', 'Diesel', '2', 1.13, 41, 66, 24.21, 27.36, 'Cash', 'Inserted', 1.37, 'Cash', 1, '2024-07-06 19:14:10'),
(181, 1, 'GMS-288683', 'Diesel', '3', 1.08, 143, 163, 21.19, 22.89, 'Cash', 'Manual', 1.74, 'Cash', 2, '2024-05-27 07:15:01'),
(182, 5, 'GMS-899343', 'Gas', '2', 1.67, 144, 232, 85.23, 142.33, 'Cash', 'Inserted', 1.91, 'Cash', 2, '2024-09-06 23:56:38'),
(183, 1, 'GMS-717790', 'Petrol', '2', 1.10, 158, 218, 59.74, 65.71, 'Cash', 'Inserted', 2.37, 'Cash', 3, '2024-09-16 07:16:18'),
(184, 4, 'GMS-120652', 'Kerosene', '4', 1.03, 54, 103, 44.77, 46.11, 'Cash', 'Manual', 1.31, 'Cash', 4, '2024-05-21 01:43:57'),
(185, 1, 'GMS-789421', 'Diesel', '1', 1.57, 125, 189, 62.31, 97.83, 'Cash', 'Swiped', 1.78, 'Cash', 4, '2024-07-16 09:59:26'),
(186, 4, 'GMS-973132', 'Kerosene', '3', 1.40, 64, 105, 36.41, 50.97, 'Cash', 'Inserted', 1.52, 'Cash', 1, '2024-11-12 07:07:03'),
(187, 2, 'GMS-151663', 'Petrol', '1', 1.19, 48, 98, 45.18, 53.76, 'Cash', 'Swiped', 2.40, 'Cash', 1, '2024-10-18 13:21:13'),
(188, 4, 'GMS-716497', 'Gas', '1', 1.50, 47, 113, 65.52, 98.28, 'Cash', 'Inserted', 1.65, 'Cash', 1, '2024-12-31 14:15:22'),
(189, 4, 'GMS-239649', 'Petrol', '1', 1.06, 66, 131, 69.05, 73.19, 'Cash', 'Inserted', 0.73, 'Cash', 2, '2024-09-22 21:16:02'),
(190, 5, 'GMS-840908', 'Diesel', '2', 1.69, 37, 116, 83.81, 141.64, 'Cash', 'Swiped', 0.33, 'Cash', 2, '2024-09-06 09:12:11'),
(191, 10, 'GMS-619711', 'Petrol', '1', 1.18, 115, 150, 34.97, 41.26, 'Cash', 'Manual', 1.27, 'Cash', 2, '2025-02-11 18:23:21'),
(192, 6, 'GMS-853820', 'Petrol', '2', 1.73, 181, 207, 27.97, 48.39, 'Cash', 'Inserted', 2.76, 'Cash', 3, '2024-04-01 14:55:20'),
(193, 8, 'GMS-144063', 'Kerosene', '3', 1.65, 12, 74, 66.74, 110.12, 'Cash', 'Swiped', 0.95, 'Cash', 2, '2024-07-25 22:30:01'),
(194, 5, 'GMS-701050', 'Kerosene', '2', 1.61, 142, 230, 90.69, 146.01, 'Cash', 'Swiped', 1.99, 'Cash', 4, '2024-04-15 11:50:26'),
(195, 10, 'GMS-468048', 'Kerosene', '3', 1.23, 77, 124, 42.07, 51.75, 'Cash', 'Inserted', 0.27, 'Cash', 1, '2024-05-30 07:29:59'),
(196, 2, 'GMS-961499', 'Petrol', '1', 1.07, 65, 114, 51.30, 54.89, 'Cash', 'Swiped', 2.43, 'Cash', 1, '2024-11-26 01:42:43'),
(197, 10, 'GMS-869092', 'Gas', '4', 1.48, 155, 224, 64.24, 95.08, 'Cash', 'Inserted', 2.51, 'Cash', 3, '2025-02-16 11:23:31'),
(198, 7, 'GMS-155279', 'Petrol', '1', 1.28, 82, 113, 30.20, 38.66, 'Cash', 'Manual', 2.66, 'Cash', 2, '2025-02-08 00:56:39'),
(199, 10, 'GMS-286375', 'Diesel', '4', 1.58, 65, 106, 36.19, 57.18, 'Cash', 'Inserted', 0.45, 'Cash', 2, '2024-09-01 05:31:23'),
(200, 9, 'GMS-599706', 'Gas', '2', 1.52, 128, 227, 101.73, 154.63, 'Cash', 'Manual', 0.79, 'Cash', 3, '2025-02-08 11:57:18'),
(201, 5, 'GMS-387247', 'Gas', '4', 1.19, 78, 130, 52.25, 62.18, 'Cash', 'Manual', 0.34, 'Cash', 1, '2025-01-21 10:50:31'),
(202, 6, 'GMS-782327', 'Petrol', '4', 1.55, 173, 209, 33.74, 52.30, 'Cash', 'Inserted', 1.32, 'Cash', 4, '2024-10-31 07:10:38'),
(203, 5, 'GMS-716225', 'Kerosene', '1', 1.68, 24, 61, 38.14, 64.08, 'Cash', 'Swiped', 0.09, 'Cash', 1, '2024-07-17 19:43:52'),
(204, 8, 'GMS-409925', 'Kerosene', '4', 1.52, 82, 156, 69.95, 106.32, 'Cash', 'Manual', 2.64, 'Cash', 1, '2025-03-14 08:31:09'),
(205, 4, 'GMS-766879', 'Kerosene', '1', 1.30, 121, 147, 27.65, 35.95, 'Cash', 'Manual', 1.70, 'Cash', 2, '2024-09-06 19:44:30'),
(206, 6, 'GMS-249489', 'Diesel', '4', 1.23, 98, 151, 57.66, 70.92, 'Cash', 'Manual', 0.39, 'Cash', 2, '2025-01-29 08:15:16'),
(207, 6, 'GMS-372128', 'Gas', '2', 1.37, 168, 236, 64.14, 87.87, 'Cash', 'Inserted', 2.12, 'Cash', 1, '2024-07-28 01:23:02'),
(208, 9, 'GMS-610715', 'Gas', '3', 1.21, 20, 88, 64.13, 77.60, 'Cash', 'Swiped', 0.92, 'Cash', 1, '2024-07-10 19:04:25'),
(209, 4, 'GMS-425035', 'Petrol', '2', 1.29, 45, 102, 60.05, 77.46, 'Cash', 'Inserted', 1.54, 'Cash', 1, '2024-04-02 07:24:22'),
(210, 1, 'GMS-714139', 'Gas', '2', 1.23, 68, 88, 21.26, 26.15, 'Cash', 'Swiped', 2.67, 'Cash', 1, '2025-03-12 13:46:49'),
(211, 1, 'GMS-788102', 'Gas', '4', 1.74, 44, 74, 30.84, 53.66, 'Cash', 'Inserted', 2.66, 'Cash', 2, '2025-01-02 04:38:33'),
(212, 9, 'GMS-600195', 'Diesel', '3', 1.64, 56, 85, 25.55, 41.90, 'Cash', 'Manual', 0.89, 'Cash', 3, '2025-03-14 13:01:06'),
(213, 7, 'GMS-508072', 'Kerosene', '3', 1.38, 41, 116, 72.23, 99.68, 'Cash', 'Swiped', 1.04, 'Cash', 3, '2024-07-15 04:54:57'),
(214, 1, 'GMS-367939', 'Kerosene', '1', 1.30, 104, 141, 40.93, 53.21, 'Cash', 'Inserted', 1.44, 'Cash', 1, '2024-11-23 04:49:13'),
(215, 2, 'GMS-957882', 'Petrol', '1', 1.02, 152, 194, 45.93, 46.85, 'Cash', 'Manual', 1.00, 'Cash', 1, '2024-10-29 22:38:38'),
(216, 4, 'GMS-272183', 'Kerosene', '4', 1.08, 104, 156, 54.51, 58.87, 'Cash', 'Manual', 0.94, 'Cash', 4, '2025-03-29 10:53:41'),
(217, 2, 'GMS-243179', 'Diesel', '3', 1.59, 72, 139, 68.20, 108.44, 'Cash', 'Inserted', 0.74, 'Cash', 3, '2024-12-30 05:23:15'),
(218, 3, 'GMS-242983', 'Gas', '3', 1.61, 92, 165, 68.15, 109.72, 'Cash', 'Manual', 2.65, 'Cash', 2, '2025-03-14 14:56:21'),
(219, 9, 'GMS-800414', 'Gas', '2', 1.55, 56, 96, 40.90, 63.40, 'Cash', 'Inserted', 1.47, 'Cash', 3, '2024-06-22 12:42:45'),
(220, 5, 'GMS-338112', 'Kerosene', '1', 1.40, 114, 193, 77.84, 108.98, 'Cash', 'Inserted', 2.18, 'Cash', 4, '2024-06-29 14:22:10'),
(221, 4, 'GMS-619034', 'Gas', '2', 1.07, 196, 225, 30.44, 32.57, 'Cash', 'Swiped', 1.38, 'Cash', 4, '2025-02-13 09:55:01'),
(222, 8, 'GMS-424706', 'Petrol', '3', 1.15, 153, 167, 12.41, 14.27, 'Cash', 'Inserted', 1.01, 'Cash', 1, '2024-06-06 00:56:46'),
(223, 6, 'GMS-717662', 'Kerosene', '3', 1.71, 176, 248, 76.18, 130.27, 'Cash', 'Manual', 0.28, 'Cash', 1, '2024-09-02 23:08:15'),
(224, 9, 'GMS-208180', 'Petrol', '3', 1.43, 93, 133, 35.24, 50.39, 'Cash', 'Manual', 1.15, 'Cash', 3, '2025-03-18 00:34:45'),
(225, 6, 'GMS-158895', 'Petrol', '1', 1.22, 84, 146, 64.89, 79.17, 'Cash', 'Swiped', 2.95, 'Cash', 3, '2024-12-01 02:09:41'),
(226, 10, 'GMS-990901', 'Diesel', '2', 1.70, 77, 162, 87.74, 149.16, 'Cash', 'Inserted', 1.55, 'Cash', 3, '2025-01-17 04:53:59'),
(227, 3, 'GMS-184684', 'Petrol', '3', 1.11, 114, 172, 61.17, 67.90, 'Cash', 'Inserted', 2.81, 'Cash', 4, '2025-01-09 07:49:10'),
(228, 4, 'GMS-759711', 'Gas', '1', 1.51, 111, 163, 55.86, 84.35, 'Cash', 'Inserted', 1.27, 'Cash', 3, '2024-09-15 11:59:14'),
(229, 8, 'GMS-850282', 'Petrol', '4', 1.42, 123, 172, 49.85, 70.79, 'Cash', 'Inserted', 0.44, 'Cash', 4, '2024-05-08 04:48:14'),
(230, 6, 'GMS-683587', 'Petrol', '2', 1.66, 117, 208, 90.17, 149.68, 'Cash', 'Swiped', 2.48, 'Cash', 1, '2024-05-14 22:11:02'),
(231, 10, 'GMS-535080', 'Kerosene', '2', 1.55, 56, 95, 40.42, 62.65, 'Cash', 'Swiped', 2.00, 'Cash', 2, '2024-08-19 22:17:01'),
(232, 4, 'GMS-359767', 'Diesel', '2', 1.19, 29, 47, 19.49, 23.19, 'Cash', 'Swiped', 1.01, 'Cash', 4, '2024-05-20 21:20:06'),
(233, 1, 'GMS-178460', 'Diesel', '1', 1.25, 99, 124, 25.11, 31.39, 'Cash', 'Manual', 0.89, 'Cash', 1, '2024-05-12 13:26:30'),
(234, 7, 'GMS-890973', 'Gas', '2', 1.76, 72, 103, 30.54, 53.75, 'Cash', 'Inserted', 2.95, 'Cash', 2, '2024-06-26 03:55:04'),
(235, 9, 'GMS-828281', 'Kerosene', '2', 1.13, 151, 227, 75.54, 85.36, 'Cash', 'Swiped', 2.14, 'Cash', 1, '2024-05-18 04:27:58'),
(236, 9, 'GMS-647835', 'Petrol', '3', 1.17, 84, 167, 78.51, 91.86, 'Cash', 'Swiped', 0.78, 'Cash', 4, '2024-04-09 17:30:37'),
(237, 10, 'GMS-432974', 'Diesel', '4', 1.59, 141, 239, 96.00, 152.64, 'Cash', 'Inserted', 0.92, 'Cash', 1, '2024-05-31 14:17:18'),
(238, 2, 'GMS-758527', 'Petrol', '2', 1.10, 8, 44, 33.50, 36.85, 'Cash', 'Inserted', 0.57, 'Cash', 3, '2024-04-09 17:58:07'),
(239, 10, 'GMS-538720', 'Kerosene', '2', 1.72, 122, 211, 93.67, 161.11, 'Cash', 'Swiped', 2.03, 'Cash', 1, '2024-11-08 10:43:44'),
(240, 7, 'GMS-528552', 'Gas', '3', 1.59, 78, 115, 32.33, 51.40, 'Cash', 'Swiped', 0.39, 'Cash', 1, '2025-03-28 07:51:48'),
(241, 2, 'GMS-216490', 'Gas', '1', 1.75, 33, 126, 88.67, 155.17, 'Cash', 'Swiped', 0.44, 'Cash', 3, '2024-06-06 02:09:11'),
(242, 1, 'GMS-945563', 'Diesel', '2', 1.15, 186, 273, 87.09, 100.15, 'Cash', 'Swiped', 0.02, 'Cash', 4, '2024-04-16 16:03:37'),
(243, 6, 'GMS-210350', 'Petrol', '2', 1.73, 130, 216, 84.93, 146.93, 'Cash', 'Swiped', 1.65, 'Cash', 4, '2024-08-14 10:35:10'),
(244, 8, 'GMS-945336', 'Diesel', '2', 1.24, 30, 73, 40.58, 50.32, 'Cash', 'Manual', 2.65, 'Cash', 4, '2024-06-19 00:22:02'),
(245, 7, 'GMS-310337', 'Kerosene', '1', 1.18, 139, 202, 59.06, 69.69, 'Cash', 'Inserted', 1.09, 'Cash', 2, '2024-11-20 11:00:51'),
(246, 4, 'GMS-445434', 'Diesel', '4', 1.02, 104, 159, 52.01, 53.05, 'Cash', 'Swiped', 0.14, 'Cash', 4, '2025-03-04 00:43:16'),
(247, 3, 'GMS-758819', 'Gas', '2', 1.31, 155, 200, 43.83, 57.42, 'Cash', 'Swiped', 0.21, 'Cash', 1, '2024-11-08 11:08:49'),
(248, 6, 'GMS-906038', 'Gas', '4', 1.42, 111, 146, 34.01, 48.29, 'Cash', 'Inserted', 1.97, 'Cash', 4, '2024-09-10 22:07:31'),
(249, 9, 'GMS-897017', 'Diesel', '4', 1.51, 73, 104, 32.36, 48.86, 'Cash', 'Manual', 0.42, 'Cash', 1, '2025-01-17 09:13:25'),
(250, 9, 'GMS-995476', 'Gas', '3', 1.60, 158, 168, 9.98, 15.97, 'Cash', 'Swiped', 0.04, 'Cash', 3, '2024-09-07 15:50:34'),
(251, 7, 'GMS-983356', 'Gas', '2', 1.59, 93, 180, 89.27, 141.94, 'Cash', 'Manual', 2.83, 'Cash', 1, '2024-05-20 14:48:04'),
(252, 6, 'GMS-843084', 'Kerosene', '3', 1.09, 86, 176, 87.20, 95.05, 'Cash', 'Manual', 0.44, 'Cash', 3, '2024-05-01 03:43:08'),
(253, 5, 'GMS-259246', 'Gas', '4', 1.80, 187, 278, 88.74, 159.73, 'Cash', 'Inserted', 1.19, 'Cash', 1, '2024-05-14 09:16:07'),
(254, 5, 'GMS-149551', 'Kerosene', '1', 1.50, 33, 79, 50.31, 75.47, 'Cash', 'Swiped', 1.09, 'Cash', 1, '2024-07-27 09:47:51'),
(255, 2, 'GMS-211561', 'Diesel', '3', 1.22, 124, 161, 34.28, 41.82, 'Cash', 'Manual', 1.40, 'Cash', 4, '2025-03-22 16:25:49'),
(256, 2, 'GMS-985740', 'Petrol', '3', 1.07, 30, 56, 25.03, 26.78, 'Cash', 'Inserted', 2.98, 'Cash', 2, '2025-04-19 13:13:54'),
(257, 5, 'GMS-980604', 'Kerosene', '3', 1.78, 62, 119, 54.74, 97.44, 'Cash', 'Swiped', 0.78, 'Cash', 1, '2025-03-27 17:13:15'),
(258, 9, 'GMS-355239', 'Kerosene', '2', 1.27, 187, 209, 23.71, 30.11, 'Cash', 'Manual', 0.57, 'Cash', 3, '2024-08-28 14:04:33'),
(259, 10, 'GMS-426191', 'Petrol', '3', 1.63, 178, 235, 56.44, 92.00, 'Cash', 'Swiped', 1.97, 'Cash', 1, '2024-08-15 01:18:33'),
(260, 8, 'GMS-904577', 'Petrol', '1', 1.02, 113, 138, 28.93, 29.51, 'Cash', 'Swiped', 1.39, 'Cash', 4, '2025-01-22 10:48:12'),
(261, 6, 'GMS-832112', 'Petrol', '4', 1.47, 122, 189, 62.86, 92.40, 'Cash', 'Inserted', 0.93, 'Cash', 4, '2024-07-25 10:02:03'),
(262, 7, 'GMS-562665', 'Gas', '1', 1.07, 27, 46, 23.04, 24.65, 'Cash', 'Inserted', 1.40, 'Cash', 1, '2024-11-17 11:24:28'),
(263, 6, 'GMS-274775', 'Petrol', '3', 1.61, 168, 230, 65.44, 105.36, 'Cash', 'Swiped', 0.73, 'Cash', 4, '2025-01-03 06:29:25'),
(264, 1, 'GMS-824460', 'Gas', '1', 1.13, 24, 53, 27.32, 30.87, 'Cash', 'Manual', 0.94, 'Cash', 3, '2024-06-26 03:31:32'),
(265, 7, 'GMS-697232', 'Petrol', '1', 1.31, 182, 263, 76.20, 99.82, 'Cash', 'Manual', 1.11, 'Cash', 4, '2024-06-29 21:18:36'),
(266, 4, 'GMS-946669', 'Diesel', '1', 1.36, 57, 104, 46.74, 63.57, 'Cash', 'Swiped', 0.07, 'Cash', 4, '2024-08-26 10:45:16'),
(267, 5, 'GMS-870825', 'Diesel', '2', 1.08, 25, 74, 48.69, 52.59, 'Cash', 'Manual', 0.76, 'Cash', 3, '2024-06-13 10:52:05'),
(268, 8, 'GMS-558145', 'Kerosene', '2', 1.46, 132, 181, 49.77, 72.66, 'Cash', 'Inserted', 1.89, 'Cash', 4, '2024-08-11 15:14:38'),
(269, 5, 'GMS-390456', 'Diesel', '1', 1.45, 33, 75, 46.43, 67.32, 'Cash', 'Manual', 0.33, 'Cash', 2, '2024-08-25 04:52:57'),
(270, 8, 'GMS-548209', 'Gas', '1', 1.42, 11, 55, 45.03, 63.94, 'Mobile', 'Swiped', 0.77, 'INV-000241', 2, '2024-05-04 20:59:58'),
(271, 2, 'GMS-860016', 'Gas', '1', 1.76, 9, 25, 11.01, 19.38, 'Mobile', 'Manual', 0.27, 'INV-000242', 2, '2024-07-28 21:46:21'),
(272, 9, 'GMS-828109', 'Kerosene', '2', 1.13, 197, 237, 43.99, 49.71, 'Mobile', 'Manual', 1.15, 'INV-000243', 1, '2024-12-15 12:58:09'),
(273, 9, 'GMS-632506', 'Kerosene', '1', 1.46, 126, 155, 28.07, 40.98, 'Mobile', 'Swiped', 1.72, 'INV-000244', 2, '2024-12-28 22:29:47'),
(274, 7, 'GMS-404413', 'Petrol', '2', 1.49, 92, 184, 93.16, 138.81, 'Mobile', 'Manual', 1.22, 'INV-000245', 4, '2024-09-09 22:37:28'),
(275, 9, 'GMS-137495', 'Kerosene', '3', 1.07, 175, 272, 97.92, 104.77, 'Mobile', 'Manual', 2.33, 'INV-000246', 3, '2024-12-13 08:10:33'),
(276, 2, 'GMS-835605', 'Gas', '3', 1.61, 135, 154, 14.61, 23.52, 'Mobile', 'Swiped', 2.67, 'INV-000247', 2, '2024-12-04 23:04:43'),
(277, 5, 'GMS-188558', 'Diesel', '1', 1.75, 48, 62, 12.03, 21.05, 'Mobile', 'Swiped', 2.21, 'INV-000248', 2, '2025-03-08 03:11:23'),
(278, 6, 'GMS-180255', 'Petrol', '2', 1.57, 151, 238, 91.08, 143.00, 'Mobile', 'Swiped', 1.42, 'INV-000249', 1, '2024-05-14 15:28:15'),
(279, 3, 'GMS-218664', 'Kerosene', '3', 1.70, 117, 204, 85.75, 145.78, 'Mobile', 'Manual', 2.66, 'INV-000250', 1, '2024-12-24 08:07:19'),
(280, 7, 'GMS-140977', 'Kerosene', '1', 1.66, 116, 201, 81.26, 134.89, 'Mobile', 'Inserted', 0.74, 'INV-000251', 3, '2024-10-24 07:54:42'),
(281, 3, 'GMS-507239', 'Diesel', '3', 1.42, 56, 155, 101.04, 143.48, 'Mobile', 'Swiped', 0.21, 'INV-000252', 2, '2024-04-16 04:47:21'),
(282, 5, 'GMS-411390', 'Petrol', '4', 1.38, 105, 153, 46.53, 64.21, 'Mobile', 'Manual', 0.72, 'INV-000253', 2, '2025-03-31 05:14:15'),
(283, 4, 'GMS-276772', 'Kerosene', '1', 1.53, 35, 96, 65.75, 100.60, 'Mobile', 'Manual', 1.99, 'INV-000254', 1, '2025-03-27 07:14:46'),
(284, 4, 'GMS-487436', 'Kerosene', '4', 1.11, 11, 111, 96.66, 107.29, 'Mobile', 'Manual', 0.68, 'INV-000255', 2, '2024-08-27 06:49:51'),
(285, 1, 'GMS-973221', 'Petrol', '2', 1.57, 153, 168, 14.02, 22.01, 'Mobile', 'Inserted', 1.71, 'INV-000256', 2, '2024-07-02 17:33:44'),
(286, 6, 'GMS-607140', 'Kerosene', '1', 1.42, 31, 74, 42.63, 60.53, 'Mobile', 'Manual', 0.41, 'INV-000257', 2, '2024-12-01 00:08:16'),
(287, 10, 'GMS-801446', 'Gas', '1', 1.37, 168, 185, 12.84, 17.59, 'Mobile', 'Swiped', 2.83, 'INV-000258', 3, '2025-03-21 22:24:51'),
(288, 4, 'GMS-341925', 'Gas', '4', 1.19, 122, 203, 79.92, 95.10, 'Mobile', 'Swiped', 1.45, 'INV-000259', 1, '2024-07-16 04:12:04'),
(289, 2, 'GMS-608049', 'Diesel', '4', 1.16, 79, 166, 87.16, 101.11, 'Mobile', 'Manual', 0.52, 'INV-000260', 1, '2024-11-11 07:10:47'),
(290, 5, 'GMS-157899', 'Kerosene', '4', 1.48, 18, 54, 34.92, 51.68, 'Mobile', 'Inserted', 1.63, 'INV-000261', 3, '2024-05-10 03:35:48'),
(291, 1, 'GMS-522870', 'Gas', '3', 1.62, 5, 49, 39.60, 64.15, 'Mobile', 'Swiped', 1.42, 'INV-000262', 3, '2025-02-25 03:33:22'),
(292, 5, 'GMS-820822', 'Petrol', '4', 1.41, 152, 240, 84.65, 119.36, 'Mobile', 'Manual', 0.41, 'INV-000263', 3, '2024-07-05 08:53:32'),
(293, 1, 'GMS-250886', 'Petrol', '2', 1.11, 69, 136, 66.70, 74.04, 'Mobile', 'Manual', 2.11, 'INV-000264', 1, '2024-07-05 04:30:17'),
(294, 6, 'GMS-709197', 'Petrol', '1', 1.73, 9, 75, 63.60, 110.03, 'Mobile', 'Inserted', 1.96, 'INV-000265', 4, '2024-04-10 09:22:36'),
(295, 5, 'GMS-794234', 'Kerosene', '4', 1.27, 90, 140, 46.93, 59.60, 'Mobile', 'Inserted', 2.61, 'INV-000266', 1, '2024-08-17 11:45:38'),
(296, 8, 'GMS-418603', 'Gas', '4', 1.77, 40, 129, 91.46, 161.88, 'Mobile', 'Swiped', 2.53, 'INV-000267', 1, '2024-04-23 10:08:42'),
(297, 5, 'GMS-119719', 'Gas', '3', 1.14, 103, 151, 49.13, 56.01, 'Mobile', 'Swiped', 1.69, 'INV-000268', 3, '2024-06-16 20:02:28'),
(298, 9, 'GMS-274249', 'Petrol', '3', 1.58, 129, 169, 37.53, 59.30, 'Mobile', 'Inserted', 1.56, 'INV-000269', 2, '2024-12-22 11:54:24'),
(299, 7, 'GMS-436019', 'Gas', '3', 1.20, 100, 154, 57.57, 69.08, 'Mobile', 'Inserted', 1.31, 'INV-000270', 3, '2025-02-13 09:37:37'),
(300, 3, 'GMS-665062', 'Diesel', '4', 1.78, 21, 74, 56.37, 100.34, 'Mobile', 'Inserted', 2.54, 'INV-000271', 3, '2024-07-29 23:33:47'),
(301, 1, 'GMS-261053', 'Diesel', '3', 1.21, 140, 152, 10.41, 12.60, 'Mobile', 'Manual', 0.31, 'INV-000272', 2, '2024-07-18 05:56:46'),
(302, 5, 'GMS-435340', 'Gas', '1', 1.04, 154, 208, 54.39, 56.57, 'Mobile', 'Inserted', 2.31, 'INV-000273', 1, '2024-10-16 08:24:19'),
(303, 3, 'GMS-504441', 'Petrol', '1', 1.37, 171, 242, 68.92, 94.42, 'Mobile', 'Swiped', 0.68, 'INV-000274', 1, '2025-01-21 14:07:21'),
(304, 2, 'GMS-322662', 'Diesel', '1', 1.27, 180, 206, 25.29, 32.12, 'Mobile', 'Swiped', 2.35, 'INV-000275', 2, '2024-05-18 11:19:00'),
(305, 4, 'GMS-624671', 'Diesel', '2', 1.42, 168, 264, 93.74, 133.11, 'Mobile', 'Manual', 2.39, 'INV-000276', 1, '2024-12-31 13:24:35'),
(306, 1, 'GMS-716240', 'Kerosene', '3', 1.19, 151, 205, 57.24, 68.12, 'Mobile', 'Inserted', 0.52, 'INV-000277', 2, '2024-07-18 22:28:05'),
(307, 6, 'GMS-739099', 'Kerosene', '2', 1.62, 180, 268, 89.33, 144.71, 'Mobile', 'Manual', 2.23, 'INV-000278', 3, '2024-04-10 19:26:54'),
(308, 10, 'GMS-537445', 'Petrol', '3', 1.40, 53, 126, 71.62, 100.27, 'Mobile', 'Swiped', 2.22, 'INV-000279', 1, '2024-12-17 18:29:58'),
(309, 1, 'GMS-932609', 'Gas', '3', 1.79, 18, 104, 87.55, 156.71, 'Mobile', 'Inserted', 2.76, 'INV-000280', 4, '2025-02-27 17:48:50'),
(310, 7, 'GMS-372437', 'Kerosene', '3', 1.62, 51, 145, 89.49, 144.97, 'Mobile', 'Inserted', 1.79, 'INV-000281', 2, '2025-01-18 23:10:44'),
(311, 7, 'GMS-209082', 'Diesel', '3', 1.58, 23, 67, 48.09, 75.98, 'Mobile', 'Inserted', 0.42, 'INV-000282', 4, '2024-09-16 05:27:33'),
(312, 4, 'GMS-596183', 'Gas', '1', 1.29, 41, 123, 77.57, 100.07, 'Mobile', 'Manual', 2.59, 'INV-000283', 3, '2024-12-15 10:18:05'),
(313, 3, 'GMS-608185', 'Kerosene', '2', 1.50, 141, 217, 76.48, 114.72, 'Mobile', 'Manual', 1.44, 'INV-000284', 3, '2024-11-13 06:07:40'),
(314, 7, 'GMS-621915', 'Diesel', '4', 1.17, 16, 116, 103.43, 121.01, 'Mobile', 'Inserted', 1.57, 'INV-000285', 1, '2025-03-17 22:11:57'),
(315, 3, 'GMS-991154', 'Petrol', '4', 1.13, 163, 262, 95.63, 108.06, 'Mobile', 'Swiped', 1.78, 'INV-000286', 3, '2025-01-28 11:34:17'),
(316, 10, 'GMS-646209', 'Petrol', '4', 1.43, 156, 217, 59.20, 84.66, 'Mobile', 'Inserted', 0.33, 'INV-000287', 4, '2025-02-09 22:41:04'),
(317, 2, 'GMS-995262', 'Kerosene', '2', 1.45, 163, 213, 48.86, 70.85, 'Mobile', 'Manual', 1.45, 'INV-000288', 2, '2024-08-28 12:05:27'),
(318, 10, 'GMS-640768', 'Diesel', '2', 1.78, 180, 270, 88.48, 157.49, 'Mobile', 'Inserted', 1.94, 'INV-000289', 4, '2024-07-19 06:17:23'),
(319, 9, 'GMS-379571', 'Kerosene', '3', 1.38, 46, 61, 19.83, 27.37, 'Mobile', 'Inserted', 0.28, 'INV-000290', 1, '2024-07-23 08:08:09'),
(320, 9, 'GMS-974240', 'Kerosene', '4', 1.03, 183, 225, 41.78, 43.03, 'Mobile', 'Manual', 1.74, 'INV-000291', 3, '2024-12-08 10:04:01'),
(321, 2, 'GMS-191910', 'Kerosene', '2', 1.77, 70, 159, 84.38, 149.35, 'Mobile', 'Swiped', 0.65, 'INV-000292', 3, '2025-03-02 17:19:43'),
(322, 1, 'GMS-901835', 'Petrol', '3', 1.43, 58, 99, 41.13, 58.82, 'Mobile', 'Swiped', 0.54, 'INV-000293', 4, '2025-03-02 19:33:42'),
(323, 10, 'GMS-229324', 'Petrol', '3', 1.54, 176, 232, 59.07, 90.97, 'Mobile', 'Swiped', 1.15, 'INV-000294', 4, '2024-11-30 02:11:18'),
(324, 6, 'GMS-433814', 'Kerosene', '2', 1.26, 145, 176, 28.50, 35.91, 'Mobile', 'Inserted', 1.22, 'INV-000295', 4, '2025-03-06 17:44:44'),
(325, 7, 'GMS-304945', 'Kerosene', '1', 1.11, 20, 113, 94.88, 105.32, 'Mobile', 'Inserted', 1.57, 'INV-000296', 4, '2024-09-18 11:53:39'),
(326, 1, 'GMS-995866', 'Diesel', '1', 1.53, 2, 49, 48.16, 73.68, 'Mobile', 'Inserted', 2.92, 'INV-000297', 3, '2024-07-23 11:08:01'),
(327, 3, 'GMS-162195', 'Diesel', '1', 1.41, 148, 193, 40.22, 56.71, 'Mobile', 'Inserted', 1.00, 'INV-000298', 1, '2024-10-03 12:46:05'),
(328, 4, 'GMS-722783', 'Petrol', '1', 1.28, 160, 244, 88.06, 112.72, 'Mobile', 'Manual', 1.64, 'INV-000299', 4, '2025-01-28 09:46:40'),
(329, 5, 'GMS-811803', 'Kerosene', '1', 1.37, 29, 106, 72.05, 98.71, 'Mobile', 'Manual', 0.22, 'INV-000300', 3, '2025-04-18 14:28:20');

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
(1, 'Main Station', 'Mogadisho', '115549635', '1'),
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
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `contactNumber` int NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `status` varchar(2) COLLATE utf8mb4_bin NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `contactNumber`, `location`, `status`) VALUES
(1, '3CC', 'INFO@3CC.COM', 907408416, 'BOSASO', '1'),
(2, 'HORN PETROLEIM', 'INFO@HORNPET.COM', 907408416, 'GAROOWE', '1');

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
-- Indexes for table `fuel_order_history`
--
ALTER TABLE `fuel_order_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

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
  MODIFY `EmployeeID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `fuels`
--
ALTER TABLE `fuels`
  MODIFY `FuelID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fuel_order_history`
--
ALTER TABLE `fuel_order_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pumps`
--
ALTER TABLE `pumps`
  MODIFY `pumpID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=330;

--
-- AUTO_INCREMENT for table `stations`
--
ALTER TABLE `stations`
  MODIFY `StationID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
