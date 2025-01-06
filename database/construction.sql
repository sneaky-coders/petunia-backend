-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 06, 2025 at 06:14 AM
-- Server version: 9.1.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `construction`
--

-- --------------------------------------------------------

--
-- Table structure for table `api`
--

DROP TABLE IF EXISTS `api`;
CREATE TABLE IF NOT EXISTS `api` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Villa', '2024-12-16 02:07:45', '2024-12-16 02:07:45'),
(2, 'Flat', '2024-12-16 02:07:45', '2024-12-16 02:07:45'),
(3, 'Plot', '2024-12-16 02:07:45', '2024-12-16 02:07:45'),
(4, 'Commercial Space', '2024-12-16 02:07:45', '2024-12-16 02:07:45');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `phone`, `subject`, `message`) VALUES
(1, 'John Doe', 'john.doe@example.com', '9876543210', 'Inquiry About Villa', 'I would like to know more about villas.'),
(2, 'Jane Smith', 'jane.smith@example.com', '9876543211', 'Flat Details', 'I want details about available flats.'),
(3, 'John Doe', 'johndoe@example.com', '1234567890', 'Inquiry about services', 'I would like more information about your services.'),
(4, 'Alzaahid', 'alzaahid@gmail.com', NULL, 'Test', 'TWat'),
(5, 'Alzaahid', 'alzaahid@gmail.com', NULL, 'gg', 'g');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
CREATE TABLE IF NOT EXISTS `properties` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `price` decimal(15,2) NOT NULL,
  `area` float NOT NULL,
  `pincode` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `state` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Goa',
  `region` enum('North Goa','South Goa') COLLATE utf8mb4_general_ci NOT NULL,
  `taluka` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `district` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Goa',
  `city` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `address_line1` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `address_line2` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image1` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image2` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image3` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image4` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image5` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bedroom` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `bathroom` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `year_built` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `furnishing` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `kitchen` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `floor` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `video_link` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `category_id`, `title`, `description`, `price`, `area`, `pincode`, `state`, `region`, `taluka`, `district`, `city`, `address_line1`, `address_line2`, `created_at`, `updated_at`, `image1`, `image2`, `image3`, `image4`, `image5`, `bedroom`, `bathroom`, `year_built`, `furnishing`, `kitchen`, `floor`, `video_link`) VALUES
(1, 1, 'Luxury Villa in North Goa', 'Spacious villa with a pool and garden.', 25000000.00, 3500, '403001', 'Goa', 'North Goa', 'Bardez', 'Goa', 'Panaji', 'Near Candolim Beach', 'Opposite XYZ Resort', '2024-12-16 02:08:13', '2024-12-16 02:08:13', 'villa1.jpg', 'villa2.jpg', 'villa3.jpg', NULL, NULL, '', '', '', '', '', '', ''),
(2, 2, '2 BHK Flat in South Goa', 'Affordable flat in a prime location.', 4500000.00, 1200, '403702', 'Goa', 'South Goa', 'Salcete', 'Goa', 'Margao', 'Near Market Area', NULL, '2024-12-16 02:08:13', '2024-12-16 02:08:13', 'flat1.jpg', 'flat2.jpg', NULL, NULL, NULL, '', '', '', '', '', '', ''),
(3, 3, 'Residential Plot in North Goa', 'Ideal for building a dream home.', 8000000.00, 5000, '403114', 'Goa', 'North Goa', 'Mapusa', 'Goa', 'Mapusa', 'Near Highway', NULL, '2024-12-16 02:08:13', '2024-12-16 02:08:13', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', ''),
(4, 4, 'Commercial Space in South Goa', 'Perfect for offices or shops.', 20000000.00, 2000, '403601', 'Goa', 'South Goa', 'Vasco da Gama', 'Goa', 'Vasco', 'City Center', NULL, '2024-12-16 02:08:13', '2024-12-16 02:08:13', 'commercial1.jpg', 'commercial2.jpg', NULL, NULL, NULL, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `property_enquiry`
--

DROP TABLE IF EXISTS `property_enquiry`;
CREATE TABLE IF NOT EXISTS `property_enquiry` (
  `id` int NOT NULL AUTO_INCREMENT,
  `property_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci,
  `enquiry_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `property_id` (`property_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_enquiry`
--

INSERT INTO `property_enquiry` (`id`, `property_id`, `name`, `email`, `phone`, `message`, `enquiry_date`) VALUES
(1, 1, 'Alice Johnson', 'alice.johnson@example.com', '9876543220', 'Interested in the villa. Please send more details.', '2024-12-16 02:08:22'),
(2, 2, 'Bob Brown', 'bob.brown@example.com', '9876543221', 'I want to schedule a visit for the flat.', '2024-12-16 02:08:22'),
(3, 3, 'Charlie Green', 'charlie.green@example.com', '9876543222', 'Is the plot still available?', '2024-12-16 02:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `fullname` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` bigint DEFAULT NULL,
  `password` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `level` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `fullname`, `email`, `phone`, `password`, `image`, `level`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'Rutika', 'Rutika Patil4', 'rutikapatil270@gmail.com', 9606687176, 'zaahid97', NULL, 1, '2024-11-30 07:17:41', NULL, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `property_enquiry`
--
ALTER TABLE `property_enquiry`
  ADD CONSTRAINT `property_enquiry_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
