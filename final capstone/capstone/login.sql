-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2024 at 02:06 AM
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
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(6, 's', 'r@gmail.com', '$2y$10$P3uez2zQ4S9zlx69kNaGc.tOaBMyjKB5EbCIsgBBkD5uk3WVw6Lr2'),
(7, 'admin', 'admin@gmail.com', '$2y$10$aQA0z0hGrGeK7RRBMphuX.YFllIT4.d4YtbBsYSsOifobPyrRyZ6O');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_records`
--

CREATE TABLE `attendance_records` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `attendance_status` varchar(255) DEFAULT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Subject_Code` varchar(20) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `section` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance_records`
--

INSERT INTO `attendance_records` (`id`, `student_id`, `attendance_status`, `date_time`, `Subject_Code`, `first_name`, `last_name`, `section`) VALUES
(1840, '04-1111-2222', 'Absent', '2024-03-29 13:02:57', 'ITE 300', 'f', 's', 'FC1-3-1'),
(1841, '04-2121-2121', 'Present', '2024-03-29 13:02:57', 'ITE 300', 'g', 'SA', 'FC1-3-1'),
(1842, '04-2121-3232', 'Present', '2024-03-29 13:02:57', 'ITE 300', 'h', 'DSA', 'FC1-3-1'),
(1843, '04-3221-6565', 'Present', '2024-03-29 13:02:57', 'ITE 300', 'j', 'SDF', 'FC1-3-1'),
(1844, '04-2143-8733', 'Present', '2024-03-29 13:02:57', 'ITE 300', 'd', 'SDA', 'FC1-3-1'),
(1845, '04-3212-5443', 'Present', '2024-03-29 13:02:57', 'ITE 300', 'x', 'DFG', 'FC1-3-1'),
(1846, '04-3212-0101', 'Present', '2024-03-29 13:02:57', 'ITE 300', 'c', 'as', 'FC1-3-1'),
(1847, '04-2131-1212', 'Present', '2024-03-29 13:02:57', 'ITE 300', 'g', 'erw', 'FC1-3-1'),
(1848, '04-1111-2222', 'Absent', '2024-03-29 13:03:11', 'ITE 300', 'f', 's', 'FC1-3-1'),
(1849, '04-2121-2121', 'Absent', '2024-03-29 13:03:11', 'ITE 300', 'g', 'SA', 'FC1-3-1'),
(1850, '04-2121-3232', 'Present', '2024-03-29 13:03:11', 'ITE 300', 'h', 'DSA', 'FC1-3-1'),
(1851, '04-3221-6565', 'Present', '2024-03-29 13:03:11', 'ITE 300', 'j', 'SDF', 'FC1-3-1'),
(1852, '04-2143-8733', 'Present', '2024-03-29 13:03:11', 'ITE 300', 'd', 'SDA', 'FC1-3-1'),
(1853, '04-3212-5443', 'Present', '2024-03-29 13:03:11', 'ITE 300', 'x', 'DFG', 'FC1-3-1'),
(1854, '04-3212-0101', 'Present', '2024-03-29 13:03:11', 'ITE 300', 'c', 'as', 'FC1-3-1'),
(1855, '04-2131-1212', 'Present', '2024-03-29 13:03:11', 'ITE 300', 'g', 'erw', 'FC1-3-1'),
(1856, '04-1111-2222', 'Absent', '2024-03-29 13:04:03', 'ITE 300', 'f', 's', 'FC1-3-1'),
(1857, '04-2121-2121', 'Absent', '2024-03-29 13:04:03', 'ITE 300', 'g', 'SA', 'FC1-3-1'),
(1858, '04-2121-3232', 'Present', '2024-03-29 13:04:03', 'ITE 300', 'h', 'DSA', 'FC1-3-1'),
(1859, '04-3221-6565', 'Present', '2024-03-29 13:04:03', 'ITE 300', 'j', 'SDF', 'FC1-3-1'),
(1860, '04-2143-8733', 'Present', '2024-03-29 13:04:03', 'ITE 300', 'd', 'SDA', 'FC1-3-1'),
(1861, '04-3212-5443', 'Present', '2024-03-29 13:04:03', 'ITE 300', 'x', 'DFG', 'FC1-3-1'),
(1862, '04-3212-0101', 'Present', '2024-03-29 13:04:03', 'ITE 300', 'c', 'as', 'FC1-3-1'),
(1863, '04-2131-1212', 'Present', '2024-03-29 13:04:03', 'ITE 300', 'g', 'erw', 'FC1-3-1'),
(1864, '04-1111-2222', 'Absent', '2024-03-29 13:05:13', 'ITE 300', 'f', 's', 'FC1-3-1'),
(1865, '04-2121-2121', 'Absent', '2024-03-29 13:05:13', 'ITE 300', 'g', 'SA', 'FC1-3-1'),
(1866, '04-2121-3232', 'Absent', '2024-03-29 13:05:13', 'ITE 300', 'h', 'DSA', 'FC1-3-1'),
(1867, '04-3221-6565', 'Absent', '2024-03-29 13:05:13', 'ITE 300', 'j', 'SDF', 'FC1-3-1'),
(1868, '04-2143-8733', 'Absent', '2024-03-29 13:05:13', 'ITE 300', 'd', 'SDA', 'FC1-3-1'),
(1869, '04-3212-5443', 'Absent', '2024-03-29 13:05:13', 'ITE 300', 'x', 'DFG', 'FC1-3-1'),
(1870, '04-3212-0101', 'Absent', '2024-03-29 13:05:13', 'ITE 300', 'c', 'as', 'FC1-3-1'),
(1871, '04-2131-1212', 'Absent', '2024-03-29 13:05:13', 'ITE 300', 'g', 'erw', 'FC1-3-1'),
(1872, '04-1111-2222', 'Absent', '2024-03-29 13:20:33', 'ITE 300', 'f', 's', 'FC1-3-1'),
(1873, '04-2121-2121', 'Present', '2024-03-29 13:20:33', 'ITE 300', 'g', 'SA', 'FC1-3-1'),
(1874, '04-2121-3232', 'Present', '2024-03-29 13:20:33', 'ITE 300', 'h', 'DSA', 'FC1-3-1'),
(1875, '04-3221-6565', 'Present', '2024-03-29 13:20:33', 'ITE 300', 'j', 'SDF', 'FC1-3-1'),
(1876, '04-2143-8733', 'Present', '2024-03-29 13:20:33', 'ITE 300', 'd', 'SDA', 'FC1-3-1'),
(1877, '04-3212-5443', 'Present', '2024-03-29 13:20:33', 'ITE 300', 'x', 'DFG', 'FC1-3-1'),
(1878, '04-3212-0101', 'Present', '2024-03-29 13:20:33', 'ITE 300', 'c', 'as', 'FC1-3-1'),
(1879, '04-2131-1212', 'Present', '2024-03-29 13:20:33', 'ITE 300', 'g', 'erw', 'FC1-3-1'),
(1880, '04-1111-2222', 'Absent', '2024-03-29 13:21:09', 'ITE 300', 'f', 's', 'FC1-3-1'),
(1881, '04-2121-2121', 'Absent', '2024-03-29 13:21:09', 'ITE 300', 'g', 'SA', 'FC1-3-1'),
(1882, '04-2121-3232', 'Present', '2024-03-29 13:21:09', 'ITE 300', 'h', 'DSA', 'FC1-3-1'),
(1883, '04-3221-6565', 'Present', '2024-03-29 13:21:09', 'ITE 300', 'j', 'SDF', 'FC1-3-1'),
(1884, '04-2143-8733', 'Present', '2024-03-29 13:21:09', 'ITE 300', 'd', 'SDA', 'FC1-3-1'),
(1885, '04-3212-5443', 'Present', '2024-03-29 13:21:09', 'ITE 300', 'x', 'DFG', 'FC1-3-1'),
(1886, '04-3212-0101', 'Present', '2024-03-29 13:21:09', 'ITE 300', 'c', 'as', 'FC1-3-1'),
(1887, '04-2131-1212', 'Present', '2024-03-29 13:21:09', 'ITE 300', 'g', 'erw', 'FC1-3-1'),
(1888, '04-1111-2222', 'Absent', '2024-03-29 14:55:06', 'ITE 300', 'f', 's', 'FC1-3-1'),
(1889, '04-2121-2121', 'Absent', '2024-03-29 14:55:06', 'ITE 300', 'g', 'SA', 'FC1-3-1'),
(1890, '04-2121-3232', 'Absent', '2024-03-29 14:55:06', 'ITE 300', 'h', 'DSA', 'FC1-3-1'),
(1891, '04-3221-6565', 'Absent', '2024-03-29 14:55:06', 'ITE 300', 'j', 'SDF', 'FC1-3-1'),
(1892, '04-2143-8733', 'Absent', '2024-03-29 14:55:06', 'ITE 300', 'd', 'SDA', 'FC1-3-1'),
(1893, '04-3212-5443', 'Absent', '2024-03-29 14:55:06', 'ITE 300', 'x', 'DFG', 'FC1-3-1'),
(1894, '04-3212-0101', 'Absent', '2024-03-29 14:55:06', 'ITE 300', 'c', 'as', 'FC1-3-1'),
(1895, '04-2131-1212', 'Absent', '2024-03-29 14:55:06', 'ITE 300', 'g', 'erw', 'FC1-3-1'),
(1896, '04-1111-2222', 'Present', '2024-03-29 15:03:36', 'ITE 300', 'f', 's', 'FC1-3-1'),
(1897, '04-2121-2121', 'Present', '2024-03-29 15:03:36', 'ITE 300', 'g', 'SA', 'FC1-3-1'),
(1898, '04-2121-3232', 'Present', '2024-03-29 15:03:36', 'ITE 300', 'h', 'DSA', 'FC1-3-1'),
(1899, '04-3221-6565', 'Present', '2024-03-29 15:03:36', 'ITE 300', 'j', 'SDF', 'FC1-3-1'),
(1900, '04-2143-8733', 'Present', '2024-03-29 15:03:36', 'ITE 300', 'd', 'SDA', 'FC1-3-1'),
(1901, '04-3212-5443', 'Present', '2024-03-29 15:03:36', 'ITE 300', 'x', 'DFG', 'FC1-3-1'),
(1902, '04-3212-0101', 'Present', '2024-03-29 15:03:36', 'ITE 300', 'c', 'as', 'FC1-3-1'),
(1903, '04-2131-1212', 'Present', '2024-03-29 15:03:36', 'ITE 300', 'g', 'erw', 'FC1-3-1');

--
-- Triggers `attendance_records`
--
DELIMITER $$
CREATE TRIGGER `refresh_database_after_insert_update` AFTER INSERT ON `attendance_records` FOR EACH ROW BEGIN
    -- Execute a dummy update query to trigger a database refresh
    UPDATE dummy_table SET refresh_timestamp = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `dummy_table`
--

CREATE TABLE `dummy_table` (
  `id` int(11) NOT NULL,
  `student_id` varchar(50) DEFAULT NULL,
  `subject_code` varchar(50) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `attendance` varchar(10) DEFAULT NULL,
  `refresh_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `star_students`
--

CREATE TABLE `star_students` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `absences` int(11) NOT NULL,
  `subject_code` varchar(50) NOT NULL,
  `section` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `star_students`
--

INSERT INTO `star_students` (`id`, `user_id`, `absences`, `subject_code`, `section`) VALUES
(83, '04-2131-1212', 3, 'ITE 335', 'FC1-3-2'),
(84, '04-2121-2121', 3, 'ITE 300', 'FC1-3-1'),
(85, '04-2121-2121', 4, 'ITE 300', 'FC1-3-1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(6, 'stanley', 's@gmail.com', '$2y$10$w3MxLM2.o42Xo.QpoU2t9OZmNchORKujQ5fi/vABs/SyAWJrffTby'),
(7, '2', '2@gmail.com', '$2y$10$/vZ69ZzrZDXN9JhyNKc1R.wUTMKuOpnsve1LxB/Q/XJpaBUOPiVlW'),
(8, '1', '1@gmail.com', '$2y$10$tqYBELEcnKBa2oAR0ZU.ouSclR6b0VTQKUt6AjBb4/xrjSvl2H6Im'),
(9, 'n', 'n@gmail.com', '$2y$10$0NJshsnEk/bx06Apgqw8vewGwDUIQFZOadLXEDTYO7Q4UYjK2.JVK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_records`
--
ALTER TABLE `attendance_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dummy_table`
--
ALTER TABLE `dummy_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `star_students`
--
ALTER TABLE `star_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `attendance_records`
--
ALTER TABLE `attendance_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1904;

--
-- AUTO_INCREMENT for table `dummy_table`
--
ALTER TABLE `dummy_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `star_students`
--
ALTER TABLE `star_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
