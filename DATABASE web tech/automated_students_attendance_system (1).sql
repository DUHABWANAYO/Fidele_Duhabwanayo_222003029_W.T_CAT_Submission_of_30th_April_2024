-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 01:48 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `automated_students_attendance_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `student_id`, `course_id`, `attendance_date`, `status`) VALUES
(5, 5, 10, '2024-04-23', 'Absent'),
(8, 5, 5, '2024-04-23', 'Present'),
(9, 7, 9, '2024-04-23', 'Present'),
(11, 7, 9, '2024-04-23', 'absent'),
(12, 7, 4, '2024-04-18', 'Absent'),
(13, 7, 9, '2024-04-23', 'present'),
(20, 5, 5, '2024-04-29', 'Absent');

-- --------------------------------------------------------

--
-- Stand-in structure for view `attendance_view`
-- (See below for the actual view)
--
CREATE TABLE `attendance_view` (
`attendance_id` int(11)
,`student_id` int(11)
,`course_id` int(11)
,`attendance_date` date
,`status` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `course_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_code`) VALUES
(4, 'DATABASE', '2321'),
(5, 'JAVA', 'BIT2009'),
(6, 'MULTIMEDIA', 'MULTI23344'),
(7, 'WEB TECH', 'web20024'),
(8, 'ENGLISH', 'ENG2024'),
(9, 'SOCIAL', 'SOC123'),
(10, 'BIOLOGY', 'BIOR222'),
(11, 'MATHEMATICS', 'MATH12345');

-- --------------------------------------------------------

--
-- Stand-in structure for view `courses_view`
-- (See below for the actual view)
--
CREATE TABLE `courses_view` (
`course_id` int(11)
,`course_name` varchar(100)
,`course_code` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `enrollment_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `Contact_Information` varchar(255) DEFAULT NULL,
  `Lecturer_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`enrollment_id`, `student_id`, `Contact_Information`, `Lecturer_name`) VALUES
(3, 2, '0784150155', 'Dr. BOLINGO'),
(5, 2, '0786453234', 'SESONGA'),
(6, 7, '0737198207', 'Dr.Fidele'),
(8, 8, '0737198207', 'Dr.Sam'),
(9, 7, '0784150155', 'SESONGA');

-- --------------------------------------------------------

--
-- Stand-in structure for view `enrollments_view`
-- (See below for the actual view)
--
CREATE TABLE `enrollments_view` (
);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `Faculty_ID` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Contact_Information` varchar(20) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `Lecturer_names` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`Faculty_ID`, `Name`, `Contact_Information`, `course_id`, `Lecturer_names`) VALUES
(11, 'financial', '0780609487', 10, 'Dr Fidele'),
(12, 'JAVA', '0784150155', 11, 'SESONGA'),
(15, 'WEB TECH', '0784150155', 9, 'Dr.Faustin');

-- --------------------------------------------------------

--
-- Stand-in structure for view `faculty_view`
-- (See below for the actual view)
--
CREATE TABLE `faculty_view` (
`Faculty_ID` int(11)
,`Name` varchar(50)
,`Contact_Information` varchar(20)
,`course_id` int(11)
,`Lecturer_names` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `Student_ID` int(11) NOT NULL,
  `First_Name` varchar(50) DEFAULT NULL,
  `Last_Name` varchar(50) DEFAULT NULL,
  `Date_Of_Birth` date DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`Student_ID`, `First_Name`, `Last_Name`, `Date_Of_Birth`, `Email`) VALUES
(1, 'DUHABWANAYO', 'Fidele', '2023-09-01', 'duhabwanayofidele@gmail.com'),
(2, 'DUHABWANAYO', 'Fidele', '2023-09-01', 'duhabwanayofidele@gmail.com'),
(3, 'fideline', 'ishimwe', '2024-04-23', 'fideline@gmail.com'),
(4, 'NIYOMUGABO', 'Leonard', '2000-12-09', 'samuelmasengesho@gmail.com'),
(5, 'NDAYISENGA', 'Emmanuel', '1998-06-05', 'emmanuelndayisenga@gmail.com'),
(6, 'ISHIMWE', 'Emile', '2000-01-01', 'emileishimwe@gmail.com'),
(7, 'fidelineA', 'impano', '2024-04-23', 'Email@gmail.com'),
(8, 'D.F NEWCASTER', 'DUHABWANAYO', '2024-04-23', 'fideleduhabwanayo@gmail.com'),
(13, 'ggghh', 'gghhj', '2024-04-02', 'bbb@gmail.com'),
(15, 'Fidele', 'DF', '2024-04-16', 'dfghjkiuy@gmail.com'),
(41, 'Fidele', 'kamana', '2024-04-29', 'fidelekamana@sdfghj.dfg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `students_view`
-- (See below for the actual view)
--
CREATE TABLE `students_view` (
`Student_ID` int(11)
,`First_Name` varchar(50)
,`Last_Name` varchar(50)
,`Date_Of_Birth` date
,`Email` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'dona', 'uwimana', '', 'donauwimana@2024', '', '$2y$10$YUBbSxCgELJrH9rYkt1ZBOzLVAHPley3pXwkSSzR0A587TlbxUgQ.', '2024-04-18 10:48:21', '', 0),
(2, 'Sipha', 'IRANESHA', 'sipha', 'iraneshasipha@2024', '0784150155', '$2y$10$6kClU2F2V2lDQGgimKEPDOYiDoDU8NeVYbejgkzk/ZQ8yDNXVdfAe', '2024-04-18 11:03:30', '1234', 0),
(3, 'Fidele', 'DUHABWANAYO', 'Fidele', 'fideleduhabwanayo49@gmail.com', '0784150155', '$2y$10$Yyrh3GgVhNRRXedujm8qLuddTuSLOKRc.nb3qqrJnSxGrGs9J/1XK', '2024-04-20 10:35:29', '1234', 0),
(7, 'DUHABWANAYO', 'Fidele', 'DUHABWANAYO', 'fideleduhabwanayo40@gmail.com', '0737198207', '$2y$10$gBTQdGtkp6ZWuWhyx5IlDOqTcvmGzoF0NzLoM1iuvfGoL0hmSFkuC', '2024-04-23 07:52:41', NULL, 0);

-- --------------------------------------------------------

--
-- Structure for view `attendance_view`
--
DROP TABLE IF EXISTS `attendance_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `attendance_view`  AS  select `attendance`.`attendance_id` AS `attendance_id`,`attendance`.`student_id` AS `student_id`,`attendance`.`course_id` AS `course_id`,`attendance`.`attendance_date` AS `attendance_date`,`attendance`.`status` AS `status` from `attendance` ;

-- --------------------------------------------------------

--
-- Structure for view `courses_view`
--
DROP TABLE IF EXISTS `courses_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `courses_view`  AS  select `courses`.`course_id` AS `course_id`,`courses`.`course_name` AS `course_name`,`courses`.`course_code` AS `course_code` from `courses` ;

-- --------------------------------------------------------

--
-- Structure for view `enrollments_view`
--
DROP TABLE IF EXISTS `enrollments_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `enrollments_view`  AS  select `enrollments`.`enrollment_id` AS `enrollment_id`,`enrollments`.`student_id` AS `student_id`,`enrollments`.`course_id` AS `course_id` from `enrollments` ;

-- --------------------------------------------------------

--
-- Structure for view `faculty_view`
--
DROP TABLE IF EXISTS `faculty_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `faculty_view`  AS  select `faculty`.`Faculty_ID` AS `Faculty_ID`,`faculty`.`Name` AS `Name`,`faculty`.`Contact_Information` AS `Contact_Information`,`faculty`.`course_id` AS `course_id`,`faculty`.`Lecturer_names` AS `Lecturer_names` from `faculty` ;

-- --------------------------------------------------------

--
-- Structure for view `students_view`
--
DROP TABLE IF EXISTS `students_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `students_view`  AS  select `students`.`Student_ID` AS `Student_ID`,`students`.`First_Name` AS `First_Name`,`students`.`Last_Name` AS `Last_Name`,`students`.`Date_Of_Birth` AS `Date_Of_Birth`,`students`.`Email` AS `Email` from `students` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`Faculty_ID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`Student_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `Faculty_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `Student_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`Student_ID`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`Student_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
