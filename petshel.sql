-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2024 at 08:16 PM
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
-- Database: `petshel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Username` varchar(50) NOT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `ContactNumber` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Username`, `Password`, `Email`, `ContactNumber`) VALUES
('admin1', '482c811da5d5b4bc6d497ffa98491e38', 'admin1@example.com', '0123456789'),
('admin2', '25e4ee4e9229397b6b17776bfceaf8e7', 'admin2@example.com', '0987654321');

-- --------------------------------------------------------

--
-- Table structure for table `adoptionapplication`
--

CREATE TABLE `adoptionapplication` (
  `Application_id` int(11) NOT NULL,
  `ApplicationDate` date DEFAULT NULL,
  `Pet_id` int(11) NOT NULL,
  `ApprovalDate` date DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `User_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adoptionapplication`
--

INSERT INTO `adoptionapplication` (`Application_id`, `ApplicationDate`, `Pet_id`, `ApprovalDate`, `Status`, `User_id`) VALUES
(1, '2024-09-17', 9, NULL, 'Approved', 5),
(2, '2024-09-17', 9, NULL, 'Rejected', 5),
(3, '2024-09-17', 9, NULL, 'Rejected', 5),
(4, '2024-09-17', 9, NULL, 'Rejected', 5),
(5, '2024-09-17', 9, NULL, 'Rejected', 5),
(6, '2024-09-17', 9, NULL, 'Approved', 5),
(7, '2024-09-17', 9, NULL, 'Approved', 5),
(8, '2024-09-17', 9, NULL, 'Approved', 5),
(9, '2024-09-17', 9, NULL, 'Rejected', 5),
(10, '2024-09-17', 9, NULL, 'Rejected', 5),
(11, '2024-09-17', 9, NULL, 'Rejected', 5),
(12, '2024-09-17', 9, NULL, 'Approved', 5),
(13, '2024-09-17', 9, NULL, 'Approved', 5),
(14, '2024-09-17', 10, NULL, 'Approved', 5),
(15, '2024-09-17', 9, NULL, 'Approved', 5),
(16, '2024-09-17', 9, NULL, 'Approved', 5);

-- --------------------------------------------------------

--
-- Table structure for table `lostandfound`
--

CREATE TABLE `lostandfound` (
  `Report_id` int(11) NOT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `ReportDate` date DEFAULT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lostandfound`
--

INSERT INTO `lostandfound` (`Report_id`, `Status`, `ReportDate`, `Description`) VALUES
(1, 'Lost', '2024-09-12', 'sadasd'),
(2, 'Found', '2024-09-21', 'nai');

-- --------------------------------------------------------

--
-- Table structure for table `ownedpets`
--

CREATE TABLE `ownedpets` (
  `Pet_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `ApprovalDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ownedpets`
--

INSERT INTO `ownedpets` (`Pet_id`, `User_id`, `ApprovalDate`) VALUES
(5, 5, '2024-09-12'),
(6, 5, '2024-09-12'),
(7, 5, '2024-09-17'),
(8, 5, '2024-09-17'),
(9, 5, '2024-09-17'),
(17, 6, '2024-09-12'),
(31, 5, '2024-09-12'),
(35, 5, '2024-09-12');

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `Pet_id` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `Breed` varchar(50) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `AdoptionStatus` tinyint(1) DEFAULT NULL,
  `Image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`Pet_id`, `Name`, `Type`, `Breed`, `Age`, `AdoptionStatus`, `Image_url`) VALUES
(1, 'Buddy', 'Dog', 'Golden Retriever', 2, 1, '/images/1.jpg'),
(2, 'Milo', 'Cat', 'Siamese', 3, 1, '/images/2.jpg'),
(3, 'Rocky', 'Dog', 'Bulldog', 4, 1, '/images/3.jpg'),
(4, 'Bella', 'Cat', 'Persian', 1, 1, '/images/4.jpg'),
(5, 'Luna', 'Rabbit', 'Dwarf', 2, 1, '/images/5.jpg'),
(6, 'Bella', 'Dog', 'Labrador Retriever', 2, 1, '/images/6.jpg'),
(7, 'Charlie', 'Dog', 'German Shepherd', 3, 1, '/images/7.jpg'),
(8, 'Max', 'Dog', 'Golden Retriever', 1, 0, '/images/8.jpg'),
(9, 'Lucy', 'Dog', 'Poodle', 4, 0, '/images/9.jpg'),
(10, 'Daisy', 'Dog', 'Bulldog', 5, 0, '/images/10.jpg'),
(11, 'Luna', 'Dog', 'Beagle', 2, 0, '/images/11.jpg'),
(12, 'Rocky', 'Dog', 'Dachshund', 3, 0, '/images/12.jpg'),
(13, 'Milo', 'Dog', 'Boxer', 1, 0, '/images/13.jpg'),
(14, 'Bailey', 'Dog', 'Chihuahua', 6, 0, '/images/14.jpg'),
(15, 'Coco', 'Dog', 'Siberian Husky', 3, 0, '/images/15.jpg'),
(16, 'Oliver', 'Cat', 'Maine Coon', 2, 0, '/images/16.jpg'),
(17, 'Leo', 'Cat', 'Persian', 3, 1, '/images/17.jpg'),
(18, 'Molly', 'Cat', 'Siamese', 4, 0, '/images/18.jpg'),
(19, 'Simba', 'Cat', 'Ragdoll', 1, 0, '/images/19.jpg'),
(20, 'Misty', 'Cat', 'Bengal', 5, 0, '/images/20.jpg'),
(21, 'Zoe', 'Cat', 'British Shorthair', 2, 0, '/images/21.jpg'),
(22, 'Chloe', 'Cat', 'Scottish Fold', 3, 0, '/images/22.jpg'),
(23, 'Nala', 'Cat', 'Sphynx', 4, 0, '/images/23.jpg'),
(24, 'Lily', 'Cat', 'Abyssinian', 6, 0, '/images/24.jpg'),
(25, 'Toby', 'Cat', 'Birman', 1, 0, '/images/25.jpg'),
(26, 'Buddy', 'Rabbit', 'Holland Lop', 2, 0, '/images/26.jpg'),
(27, 'Jack', 'Rabbit', 'Mini Rex', 3, 0, '/images/27.jpg'),
(28, 'Oreo', 'Rabbit', 'Lionhead', 4, 0, '/images/28.jpg'),
(29, 'Pepper', 'Rabbit', 'Dwarf Hotot', 1, 0, '/images/29.jpg'),
(30, 'Snowball', 'Rabbit', 'English Angora', 5, 0, '/images/30.jpg'),
(31, 'Charlie', 'Bird', 'Cockatiel', 1, 1, '/images/31.jpg'),
(32, 'Sunny', 'Bird', 'Budgerigar', 2, 0, '/images/32.jpg'),
(33, 'Kiwi', 'Bird', 'Parrotlet', 3, 0, '/images/33.jpg'),
(34, 'Blue', 'Bird', 'Macaw', 4, 0, '/images/34.jpg'),
(35, 'Sky', 'Bird', 'Lovebird', 1, 1, '/images/35.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `petshelter`
--

CREATE TABLE `petshelter` (
  `Listing_id` int(11) NOT NULL,
  `PropertyName` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `PetPolicy` varchar(255) DEFAULT NULL,
  `ShelterType` varchar(50) DEFAULT NULL,
  `ShelterSeat` int(11) DEFAULT NULL,
  `ContactInformation` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petshelter`
--

INSERT INTO `petshelter` (`Listing_id`, `PropertyName`, `Address`, `PetPolicy`, `ShelterType`, `ShelterSeat`, `ContactInformation`) VALUES
(1, 'Happy Paws Shelter', '101 Pet St, Dhaka', 'No exotic pets', 'Dog', 22, 'happy@example.com'),
(2, 'Feline Friends', '202 Cat Ave, Chittagong', 'Cats only', 'Cat', 17, 'feline@example.com'),
(3, 'Bunny Hop Haven', '303 Rabbit Rd, Sylhet', 'Small animals only', 'Rabbit', 11, 'bunnyhop@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `User_id` int(11) NOT NULL,
  `Report_id` int(11) NOT NULL,
  `Pet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shelters`
--

CREATE TABLE `shelters` (
  `Listing_id` int(11) NOT NULL,
  `Pet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_id` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `ContactNumber` varchar(20) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Owned_pets` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_id`, `Name`, `Password`, `ContactNumber`, `Address`, `Email`, `Owned_pets`) VALUES
(1, 'John Doe', 'd763ec748433fb79a04f82bd46133d55', '01987654321', '123 Street, Dhaka', 'johndoe@example.com', 0),
(2, 'Jane Smith', '20b7a083459d9d66005453db9e1e18ed', '01765432109', '456 Road, Chittagong', 'janesmith@example.com', 1),
(3, 'Mark Spencer', '897911b38b625d74839921454bc0c93b', '01876543210', '789 Lane, Sylhet', 'markspencer@example.com', 2),
(4, 'as', '202cb962ac59075b964b07152d234b70', '1121', '11', 'as@a.com', 0),
(5, 'Faisal', '202cb962ac59075b964b07152d234b70', '123', '123', 'f@f.com', 0),
(6, 'a', '202cb962ac59075b964b07152d234b70', '123', '123', 'a@a.com', 0),
(7, 'peach', '889560d93572d538078ce1578567b91a', '1122', '1122', 'peach@gmail.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `adoptionapplication`
--
ALTER TABLE `adoptionapplication`
  ADD PRIMARY KEY (`Application_id`),
  ADD KEY `User_id` (`User_id`);

--
-- Indexes for table `lostandfound`
--
ALTER TABLE `lostandfound`
  ADD PRIMARY KEY (`Report_id`);

--
-- Indexes for table `ownedpets`
--
ALTER TABLE `ownedpets`
  ADD PRIMARY KEY (`Pet_id`,`User_id`),
  ADD KEY `User_id` (`User_id`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`Pet_id`);

--
-- Indexes for table `petshelter`
--
ALTER TABLE `petshelter`
  ADD PRIMARY KEY (`Listing_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`User_id`,`Report_id`,`Pet_id`),
  ADD KEY `Report_id` (`Report_id`),
  ADD KEY `Pet_id` (`Pet_id`);

--
-- Indexes for table `shelters`
--
ALTER TABLE `shelters`
  ADD PRIMARY KEY (`Listing_id`,`Pet_id`),
  ADD KEY `Pet_id` (`Pet_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adoptionapplication`
--
ALTER TABLE `adoptionapplication`
  MODIFY `Application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `lostandfound`
--
ALTER TABLE `lostandfound`
  MODIFY `Report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `Pet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `petshelter`
--
ALTER TABLE `petshelter`
  MODIFY `Listing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adoptionapplication`
--
ALTER TABLE `adoptionapplication`
  ADD CONSTRAINT `adoptionapplication_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`);

--
-- Constraints for table `ownedpets`
--
ALTER TABLE `ownedpets`
  ADD CONSTRAINT `ownedpets_ibfk_1` FOREIGN KEY (`Pet_id`) REFERENCES `pet` (`Pet_id`),
  ADD CONSTRAINT `ownedpets_ibfk_2` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`),
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`Report_id`) REFERENCES `lostandfound` (`Report_id`),
  ADD CONSTRAINT `reports_ibfk_3` FOREIGN KEY (`Pet_id`) REFERENCES `pet` (`Pet_id`);

--
-- Constraints for table `shelters`
--
ALTER TABLE `shelters`
  ADD CONSTRAINT `shelters_ibfk_1` FOREIGN KEY (`Listing_id`) REFERENCES `petshelter` (`Listing_id`),
  ADD CONSTRAINT `shelters_ibfk_2` FOREIGN KEY (`Pet_id`) REFERENCES `pet` (`Pet_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
