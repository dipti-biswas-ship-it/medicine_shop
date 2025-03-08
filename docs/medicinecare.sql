-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2025 at 07:04 AM
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
-- Database: `medicinecare`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `phone`) VALUES
(1, 'priya', 'priyamitra0606@gmail.com', '123', '8597911631');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `m_id`, `u_id`, `quantity`) VALUES
(1, 1, 4, 1),
(2, 15, 4, 1),
(3, 5, 4, 1),
(4, 8, 3, 1),
(5, 11, 3, 1),
(6, 2, 7, 1),
(7, 11, 7, 1),
(8, 14, 7, 6),
(9, 5, 7, 6),
(10, 7, 7, 0),
(11, 6, 7, 4),
(12, 5, 98, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `c_id` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `add_on` date NOT NULL,
  `subject` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `m_id` int(11) NOT NULL,
  `m_name` varchar(50) NOT NULL,
  `m_category` varchar(50) NOT NULL,
  `mrp` decimal(10,0) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `description` varchar(100) NOT NULL,
  `qty` varchar(10) NOT NULL,
  `sort_description` varchar(100) NOT NULL,
  `added_on` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `image` varchar(200) NOT NULL,
  `expiryDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`m_id`, `m_name`, `m_category`, `mrp`, `price`, `description`, `qty`, `sort_description`, `added_on`, `status`, `image`, `expiryDate`) VALUES
(1, 'Amoxicillin 500mg', 'Antibiotics', 150, 140, 'Effective against bacterial infections', '120', 'Antibiotic treatment', '2025-02-24', 1, 'amoxicillin.jpg', '2025-09-25'),
(2, 'Cetirizine 10mg', 'Allergy Relief', 45, 40, 'Treats allergy symptoms', '300', 'Anti-allergic medicine', '2025-02-24', 1, 'cetirizine.jpg', '2026-08-10'),
(3, 'Paracetamol', 'Pain Reliever', 50, 45, 'Used to reduce fever and relieve mild pain.', '100', 'Pain relief tablet', '2025-02-20', 1, 'paracetamol.jpeg', '2026-12-31'),
(4, 'Cough Syrup', 'Cough & Cold', 120, 110, 'Effective relief from cough and throat irritation.', '50', 'Syrup for cough relief', '2025-02-20', 1, 'cough_syrup.jpg', '2026-08-15'),
(5, 'Vitamin C Tablets', 'Vitamins & Supplements', 200, 180, 'Boosts immunity and overall health.', '75', 'Vitamin C immunity booster', '2025-02-20', 1, 'vitamin_c.jpeg', '2027-03-10'),
(6, 'Antacid Tablet', 'Anti-Acids', 90, 85, 'Relieves acidity and heartburn.', '80', 'Acidity relief tablet', '2025-02-20', 1, 'antacid.jpeg', '2026-09-25'),
(7, 'Ibuprofen', 'Pain Reliever', 150, 140, 'Reduces pain, inflammation, and fever.', '60', 'Pain relief and anti-inflammatory', '2025-02-20', 1, 'ibuprofen.jpeg', '2027-01-05'),
(8, 'Multivitamin Capsules', 'Vitamins & Supplements', 250, 230, 'Essential vitamins and minerals for daily health.', '90', 'Daily health supplement', '2025-02-20', 1, 'multivitamin.jpg', '2027-06-30'),
(9, 'Aspirin 75mg', 'Blood Thinners', 50, 48, 'Prevents blood clot formation', '250', 'Heart health support', '2025-02-24', 1, 'aspirin-bottle-4245446.webp', '2026-04-10'),
(10, 'Omeprazole 20mg', 'Anti-Acids', 70, 65, 'Reduces stomach acid production', '180', 'GERD treatment', '2025-02-24', 1, 'Omeprazole-Domperidone-Capsules.jpg.jpg', '2026-07-20'),
(11, 'Calcium Tablets', 'Vitamins & Supplements', 140, 130, 'Supports bone health', '220', 'Bone strength booster', '2025-02-24', 1, 'calcium.jpg', '2026-03-22'),
(12, 'Zinc Supplement', 'Vitamins & Supplements', 110, 105, 'Boosts immune system', '250', 'Immunity booster', '2025-02-24', 1, 'zinc.webp', '2026-09-18'),
(13, 'Dolo 650', 'Pain Relievers', 55, 50, 'Pain reliever and fever reducer', '300', 'Fever reducer', '2025-02-24', 1, 'dolo_650.jpg', '2025-10-10'),
(14, 'Metformin 500mg', 'Diabetes Care', 90, 85, 'Controls blood sugar levels', '150', 'Diabetes management', '2025-02-24', 1, 'metformin.jpg', '2026-02-05'),
(15, 'Saline Nasal Spray', 'Cold & Sinus Relief', 100, 95, 'Clears nasal congestion', '200', 'Sinus relief', '2025-02-24', 1, 'nasal_spray.jpg', '2026-01-15'),
(16, 'Loratadine 10mg', 'Allergy Relief', 85, 78, 'Relieves hay fever symptoms', '220', 'Anti-allergic', '2025-02-24', 1, 'loratadine.webp', '2026-07-01'),
(17, 'Vitamin D3 Drops', 'Vitamins & Supplements', 130, 120, 'Supports bone health', '180', 'Bone & Immunity Support', '2025-02-24', 1, 'vitamin_d3.jpg', '2026-12-31'),
(18, 'Ginseng Capsules', 'Herbal Supplements', 160, 150, 'Boosts energy and reduces stress', '120', 'Herbal supplement', '2025-02-24', 1, 'ginseng.jpeg', '2026-05-10'),
(19, 'ORS Sachet', 'Rehydration', 25, 20, 'Prevents dehydration', '500', 'Electrolyte replenishment', '2025-02-24', 1, 'ors.jpeg', '2026-11-15');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pin` varchar(20) NOT NULL,
  `total_price` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `land_mark` varchar(50) NOT NULL,
  `house_no` varchar(10) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `o_email` varchar(50) NOT NULL,
  `full_address` varchar(300) NOT NULL,
  `quantity` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `m_id`, `u_id`, `name`, `city`, `state`, `pin`, `total_price`, `status`, `land_mark`, `house_no`, `phone`, `o_email`, `full_address`, `quantity`) VALUES
(1, 14, 5616, 'priya', 'cob', 'west', '736179', '85', 0, 'krishnalaya', '4455', '8597911631', 'priyamitra0606@gmail.com', 'afaf', ''),
(2, 2, 1766, 'priya', 'cob', 'west', '736179', '120', 0, 'afa', '55', '8597916311', 'priyamitra0606@gmail.com', 'afa', ''),
(3, 5, 4270, 'priya', 'cob', 'west', '736179', '180', 0, 'salboni', '11', '8597911631', 'priyamitra0606@gmail.com', 'afafaf', ''),
(4, 8, 1426, 'afaf', 'afaff', 'fafaf', '444444', '460', 0, 'afa', 'afaf', '4444444444', 'priya@gmail.com', 'afaf', '2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(50) NOT NULL,
  `m_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `address` varchar(255) NOT NULL,
  `state` varchar(100) NOT NULL,
  `landmark` varchar(255) NOT NULL,
  `flat_house_no` varchar(50) NOT NULL,
  `pin_no` varchar(10) NOT NULL,
  `added_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_name`, `m_id`, `o_id`, `email`, `password`, `phone`, `status`, `address`, `state`, `landmark`, `flat_house_no`, `pin_no`, `added_on`) VALUES
(3, 'rickbose', 0, 0, 'rickbose85@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '555555555', 0, 'alipure', 'westbengal', 'sivbari', '501', '736478', '2025-02-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
