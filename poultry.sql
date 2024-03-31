-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2024 at 04:08 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poultry`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `ID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`ID`, `Username`, `Password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `C_ID` int(11) NOT NULL,
  `Date_Created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `Street` varchar(255) NOT NULL,
  `Brgy` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Province` varchar(255) NOT NULL,
  `Region` varchar(255) NOT NULL,
  `Contact_No` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Code` mediumint(9) NOT NULL,
  `Account_Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`C_ID`, `Date_Created`, `Username`, `Password`, `Name`, `Surname`, `Street`, `Brgy`, `City`, `Province`, `Region`, `Contact_No`, `Email`, `Code`, `Account_Status`) VALUES
(10, '2024-03-28 13:18:57', 'sub01XD', 'ADCantimage0031', 'Gino', 'Toralba', 'BLK 4 LOT 2 Bellparc', 'Santo Tomas', 'Calauan', 'Laguna', 'Region IV-A (CALABARZON)', '09465354675', 'ginotoralba0031@gmail.com', 0, 'Verified');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `O_ID` int(11) NOT NULL,
  `O_Customer` varchar(255) NOT NULL,
  `O_Seller` varchar(255) NOT NULL,
  `O_ProductID` int(11) NOT NULL,
  `O_QTY` bigint(20) NOT NULL,
  `O_Total` double NOT NULL,
  `O_Status` varchar(255) NOT NULL,
  `O_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`O_ID`, `O_Customer`, `O_Seller`, `O_ProductID`, `O_QTY`, `O_Total`, `O_Status`, `O_Date`) VALUES
(4, 'sub01XD', 'qwe', 1, 120, 1200, 'Completed', '2024-03-27'),
(5, 'sub01XD', 'qwe', 9, 150, 1800, 'Completed', '2024-03-28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `P_ID` int(11) NOT NULL,
  `P_Seller` varchar(255) NOT NULL,
  `P_Type` varchar(255) NOT NULL,
  `P_Description` varchar(255) NOT NULL,
  `P_Price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`P_ID`, `P_Seller`, `P_Type`, `P_Description`, `P_Price`) VALUES
(1, 'qwe', 'Eggs', 'Large', '10'),
(5, 'qwe', 'Eggs', 'Medium', '8'),
(6, 'qwe', 'Eggs', 'Small', '6'),
(7, 'qwe', 'Eggs', 'Brown', '6'),
(8, 'qwe', 'Eggs', 'White', '6'),
(9, 'qwe', 'Eggs', 'Maalat', '12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `User_ID` int(11) NOT NULL,
  `Date_Created` date NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Contact` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Type` int(11) NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`User_ID`, `Date_Created`, `Name`, `Surname`, `Address`, `Contact`, `Username`, `Password`, `Type`, `Status`) VALUES
(1, '2024-03-14', 'qwe', 'qwe', 'qweqweqwe', '09465354675', 'qwe', 'qwe', 2, 'Approved'),
(2, '2024-03-15', 'Gino', 'Toralba', 'siquwoiehskjdbvkjwheg', '09465354675', 'admin', 'admin', 1, 'Approved'),
(3, '2024-03-17', 'Aaron', 'Exconde', 'Bangyas Calauan Laguna', '09123456789', 'aaron', 'aaron', 3, 'Approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`C_ID`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`O_ID`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`P_ID`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `C_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `O_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `P_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
