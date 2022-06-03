-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2022 at 08:06 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dentist_clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(10) NOT NULL,
  `doctor_id` int(10) NOT NULL,
  `patient_id` int(10) NOT NULL,
  `nurse_id` int(10) DEFAULT NULL,
  `time_start` time NOT NULL,
  `time_end` time DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='appointments table';

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `doctor_id`, `patient_id`, `nurse_id`, `time_start`, `time_end`, `date`) VALUES
(1, 7, 14, 12, '20:13:09', NULL, '2022-06-09');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='departments table';

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`) VALUES
(1, 'IT', '2022-05-24 16:52:29'),
(2, 'HR', '2022-05-24 16:52:29'),
(3, 'Sales', '2022-05-24 16:52:29'),
(4, 'Marketing', '2022-05-24 16:52:29'),
(5, 'Finance', '2022-05-24 16:52:29'),
(6, 'Admin', '2022-05-24 16:52:29'),
(7, 'Production', '2022-05-24 16:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `employee_departments`
--

CREATE TABLE `employee_departments` (
  `employee_id` int(10) NOT NULL,
  `department_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='employee_departments table';

--
-- Dumping data for table `employee_departments`
--

INSERT INTO `employee_departments` (`employee_id`, `department_id`) VALUES
(16, 3),
(10, 5),
(9, 6),
(8, 7);

-- --------------------------------------------------------

--
-- Table structure for table `treatments`
--

CREATE TABLE `treatments` (
  `treatment_id` int(10) NOT NULL,
  `patient_id` int(10) NOT NULL,
  `medications` text NOT NULL,
  `operated` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='users table';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Zaid Bari', 'zaidbari9@hotmail.com', '$2y$10$6qM8BdwTQ5I5..FISzc0.OG8BFGpxIc32Ljjm3CxxO.cX48IY1R6W', '2022-05-24 17:20:34'),
(7, 'Lionel Ingram', 'byki@mailinator.com', '$2y$10$Huu6wLjdALDmSVP9mOaTY.WucB.iL/dJGgHiwIlfsnEHKkjPRJ6DW', '2022-05-24 17:40:27'),
(8, 'Harrison Walker', 'pifip@mailinator.com', '$2y$10$CCzWV1BQdOWTCbQHKFITJeXTcUBywRBlzJKOMlQ4/KYkqrnA34VRe', '2022-05-24 17:40:33'),
(9, 'Darrel Powers', 'jybyto@mailinator.com', '$2y$10$OsNY/P69MUri3ifYNcbhTuvjrIVAqjDpd2r5/yBri/5L26ubt7T1q', '2022-05-24 17:40:39'),
(10, 'Mary Benson', 'jecijozizi@mailinator.com', '$2y$10$cFljjJ8AHRNPoqCSSSp7jeMgsoo.rDpcnbDYUy02Et7jMDsfyQQky', '2022-05-24 17:40:47'),
(11, 'Declan Brewer', 'xeduci@mailinator.com', '$2y$10$RLWovHpEDP.rX8koIeJ4RuYEeyBVepRkZfPqHG9EQ1D6hZB96NU7S', '2022-05-24 17:40:54'),
(12, 'Lacy Shepherd', 'bexy@mailinator.com', '$2y$10$zV6spTmWtBBNnHYv5QgmjeW8higLELriZwnEdhd8XDQTC5YwrCr8q', '2022-05-24 17:41:00'),
(13, 'Josiah Woodward', 'teli@mailinator.com', '$2y$10$8S8IfATX6rIKtl0Qmv/qX.nSIe6ZIDzoTiZlQzMpGW0WtWT6jETpa', '2022-05-24 17:41:09'),
(14, 'Kevin Chavez', 'sysubu@mailinator.com', '$2y$10$Mdf3zLAJ8iGgEOwN3jSrouh49BxqQNIX/qfdQPmKyhGkdcQlgbNPy', '2022-05-24 17:41:19'),
(15, 'Thor Oneill', 'tipyd@mailinator.com', '$2y$10$jCUX0I9T4cB4CeE2yRVwauh0kaS2Duc8YOaT2XK3chJ1NsGJGRbzK', '2022-05-24 17:41:25'),
(16, 'Nolan Horn', 'matobufas@mailinator.com', '$2y$10$gyDvyEAytUwXMWiKVWXaxO40eban.LvLp2OIJB2InqWBVzzcMLpyS', '2022-05-25 13:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `user_id` int(10) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `affiliation` varchar(255) DEFAULT NULL,
  `working_hours` varchar(255) DEFAULT NULL,
  `salary` int(10) DEFAULT NULL,
  `license` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='user_profiles table';

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`user_id`, `phone`, `address`, `city`, `affiliation`, `working_hours`, `salary`, `license`) VALUES
(1, '+1 (906) 845-3291', 'SOme address', 'Lefkosa', NULL, NULL, 1000, NULL),
(7, '+1 (579) 252-8891', 'Quisquam laboris pro', 'Est molestias quidem', 'Hic impedit et pari', NULL, 2500, '360'),
(8, '+1 (599) 288-1694', 'Est et esse a tenet', 'Quo velit rerum nob', 'Assumenda unde aliqu', NULL, 1000, NULL),
(9, '+1 (742) 163-7764', 'Quisquam dignissimos', 'Sit et dolores aliqu', 'Neque sit sunt aut c', NULL, 1000, NULL),
(10, '+1 (236) 318-8097', 'Tempora ipsum cum re', 'Sapiente nulla sint ', 'Provident amet ut ', NULL, 1000, NULL),
(11, '+1 (868) 399-6956', 'Praesentium impedit', 'Quis aut molestiae i', 'Lorem et minus vitae', NULL, 2500, '333'),
(12, '+1 (452) 973-4794', 'Quo asperiores animi', 'Et asperiores quidem', 'Esse et voluptas mi', NULL, 1000, NULL),
(13, '+1 (918) 762-8584', 'Tempor accusamus con', 'Est duis do nihil eu', 'Sequi in quia dolore', NULL, 1000, NULL),
(14, '+1 (614) 992-6051', 'Voluptatum possimus', 'Molestias sit optio', NULL, NULL, NULL, NULL),
(15, '+1 (905) 564-3264', 'Omnis deserunt ut et', 'Aut consectetur dol', NULL, NULL, NULL, NULL),
(16, '+1 (353) 488-9153', 'Qui in sed mollit ma', 'Ut praesentium amet', 'Minus et sunt volupt', NULL, 1000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` int(10) NOT NULL,
  `role` enum('admin','doctor','nurse','employee','patient') NOT NULL DEFAULT 'patient'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='user_roles table';

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role`) VALUES
(1, 'admin'),
(7, 'doctor'),
(8, 'employee'),
(9, 'employee'),
(10, 'employee'),
(11, 'doctor'),
(12, 'nurse'),
(13, 'nurse'),
(14, 'patient'),
(15, 'patient'),
(16, 'employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `appointments_doctor_id_fk` (`doctor_id`),
  ADD KEY `appointments_patient_id_fk` (`patient_id`),
  ADD KEY `appointments_nurse_id_fk` (`nurse_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_departments`
--
ALTER TABLE `employee_departments`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `employee_departments_department_id_fk` (`department_id`);

--
-- Indexes for table `treatments`
--
ALTER TABLE `treatments`
  ADD PRIMARY KEY (`treatment_id`),
  ADD KEY `patient___fk` (`patient_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `treatments`
--
ALTER TABLE `treatments`
  MODIFY `treatment_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_doctor_id_fk` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_nurse_id_fk` FOREIGN KEY (`nurse_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_patient_id_fk` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_departments`
--
ALTER TABLE `employee_departments`
  ADD CONSTRAINT `employee_departments_department_id_fk` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_departments_employee_id_fk` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `treatments`
--
ALTER TABLE `treatments`
  ADD CONSTRAINT `patient___fk` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `roles_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
