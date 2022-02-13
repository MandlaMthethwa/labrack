-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2021 at 02:08 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sclabtrack`
--
create database if not exists `sclabtrack`;

USE `sclabtrack`;
-- --------------------------------------------------------

--
-- Table structure for table `attendancerecord`
--

CREATE TABLE `attendancerecord` (
  `attendanceRecordID` int(10) NOT NULL,
  `attendanceRecordDate` date NOT NULL,
  `attendanceRecordTime` timestamp(4) NOT NULL DEFAULT current_timestamp(4),
  `registeredStudentID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendancerecord`
--

INSERT INTO `attendancerecord` (`attendanceRecordID`, `attendanceRecordDate`, `attendanceRecordTime`, `registeredStudentID`) VALUES
(62, '2021-04-22', '2021-04-22 16:44:17.2039', 13),
(63, '2021-04-22', '2021-04-22 16:44:38.2020', 15),
(64, '2021-04-22', '2021-04-22 16:46:17.8093', 13),
(65, '2021-04-22', '2021-04-22 16:46:44.7205', 13),
(66, '2021-04-22', '2021-04-22 16:49:04.7661', 13),
(67, '2021-04-22', '2021-04-22 16:49:16.6822', 13),
(68, '2021-04-22', '2021-04-22 16:50:59.3332', 13),
(69, '2021-04-22', '2021-04-22 16:55:27.6503', 17),
(70, '2021-04-22', '2021-04-22 16:59:35.1088', 17),
(71, '2021-04-22', '2021-04-22 17:00:15.7794', 17),
(72, '2021-04-22', '2021-04-22 17:00:32.5322', 16),
(73, '2021-04-22', '2021-04-22 17:07:50.4912', 16),
(74, '2021-04-22', '2021-04-22 17:13:23.7983', 16),
(75, '2021-04-22', '2021-04-22 17:15:02.6460', 16),
(76, '2021-04-22', '2021-04-22 17:15:19.7412', 13),
(77, '2021-04-22', '2021-04-22 17:15:46.3825', 13),
(78, '2021-04-22', '2021-04-22 17:23:17.9024', 13),
(79, '2021-04-22', '2021-04-22 17:25:21.8104', 13),
(80, '2021-04-23', '2021-04-23 20:46:56.5108', 13),
(81, '2021-04-23', '2021-04-23 20:47:30.7038', 13),
(84, '2021-04-23', '2021-04-23 20:49:15.5700', 15),
(85, '2021-05-23', '2021-05-23 18:16:37.5262', 19),
(86, '2021-05-23', '2021-05-23 18:30:26.4464', 19),
(87, '2021-05-23', '2021-05-23 18:45:58.7309', 19),
(88, '2021-05-23', '2021-05-23 18:46:05.6339', 20),
(89, '2021-05-23', '2021-05-23 18:46:55.9296', 20),
(90, '2021-05-23', '2021-05-23 18:47:00.9542', 20),
(91, '2021-05-23', '2021-05-23 18:47:04.6821', 19),
(92, '2021-05-23', '2021-05-23 18:48:07.0559', 20),
(93, '2021-05-23', '2021-05-23 18:48:58.0776', 20),
(94, '2021-05-23', '2021-05-23 18:49:02.7424', 20),
(95, '2021-05-23', '2021-05-23 18:51:01.3575', 20),
(96, '2021-05-23', '2021-05-23 18:51:06.4852', 20),
(97, '2021-05-27', '2021-05-27 12:26:10.1724', 22),
(98, '2021-05-27', '2021-05-27 12:26:31.2018', 21),
(99, '2021-05-27', '2021-05-27 21:52:25.3023', 32),
(100, '2021-05-27', '2021-05-27 21:52:28.9149', 33),
(101, '2021-05-27', '2021-05-27 21:53:29.2251', 31),
(102, '2021-05-27', '2021-05-27 21:53:30.6985', 31),
(103, '2021-05-27', '2021-05-27 21:53:31.7135', 31),
(104, '2021-05-27', '2021-05-27 21:53:33.4267', 31),
(105, '2021-05-27', '2021-05-27 21:53:34.9918', 31),
(106, '2021-05-27', '2021-05-27 21:53:38.5521', 32),
(107, '2021-05-27', '2021-05-27 21:53:42.2986', 33),
(108, '2021-05-27', '2021-05-27 21:53:45.7835', 31),
(109, '2021-05-27', '2021-05-27 21:53:47.2064', 31);

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `lecturerID` int(10) NOT NULL,
  `lecturerFirstName` varchar(100) NOT NULL,
  `lecturerLastName` varchar(100) NOT NULL,
  `lecturerUsername` varchar(100) NOT NULL,
  `lecturerPassword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`lecturerID`, `lecturerFirstName`, `lecturerLastName`, `lecturerUsername`, `lecturerPassword`) VALUES
(1, 'Ahmed', 'Seema', '1234', '$2y$10$bM4sxubA3y7uEww3/Ii6uuAUrcdf3Bat9aBcLbL7J6DJ3f3EXkY8q'),
(2, 'Angelina', 'Mokoena', '201489357', '12345678'),
(3, 'Derrick', 'Mthembu', '203217485', '12345678'),
(4, 'Isabella', 'Naidoo', '206472359', '12345678'),
(5, 'Sizwe', 'Khoza', '206248626', '12345678'),
(6, 'John', 'Mahlangu', '200184621', '12345678'),
(7, 'Kenneth', 'Mkhize', '200429860', '12345678'),
(8, 'admin', 'admin', 'admin', '$2y$10$P4S70CoI4il0otdqnr8L2Oh4/PNRJXmTGjOimmHjmlbA/e7zjdmni'),
(9, 'Jakobus', 'Botha', '208459625', '12345678'),
(10, 'Nomathemba', 'Mbatha', '203487125', '12345678'),
(11, 'Kingsley', 'Smith', '204578264', '12345678'),
(12, 'Agnes', 'Mazibuko', '213695472', '12345678'),
(13, 'Kimberly', 'van Wyk', '212145962', '12345678'),
(14, 'Mandla', 'Cele', '205863247', '12345678'),
(16, 'David', 'Williams', '204876235', '12345678'),
(17, 'Ferland', 'Chauke', '214632547', '12345678'),
(18, 'Alexandria', 'Clermont', '212457895', '12345678'),
(19, 'Kevin', 'du Plessis', '214623954', '12345678'),
(20, 'Claire', 'Theron', '216472358', '12345678'),
(21, 'Thandeka', 'Buthelezi', '210497562', '12345678'),
(22, 'Nathaniel', 'Sithole', '202658984', '12345678'),
(25, 'Vanessa', 'Mdluli', '200359418', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `registeredlecturer`
--

CREATE TABLE `registeredlecturer` (
  `registeredLecturerID` int(10) NOT NULL,
  `subjectID` int(10) NOT NULL,
  `lecturerID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registeredlecturer`
--

INSERT INTO `registeredlecturer` (`registeredLecturerID`, `subjectID`, `lecturerID`) VALUES
(19, 1, 1),
(24, 1, 2),
(20, 2, 1),
(25, 2, 2),
(51, 2, 10),
(21, 3, 1),
(26, 3, 2),
(52, 3, 10),
(22, 4, 1),
(27, 4, 2),
(23, 5, 1),
(28, 5, 2),
(63, 5, 14),
(29, 6, 3),
(34, 6, 4),
(48, 6, 9),
(30, 7, 3),
(41, 7, 6),
(44, 7, 7),
(59, 7, 13),
(66, 7, 16),
(31, 8, 3),
(45, 8, 7),
(32, 9, 3),
(35, 9, 4),
(46, 9, 7),
(67, 9, 16),
(33, 10, 3),
(38, 10, 5),
(42, 10, 6),
(47, 10, 7),
(49, 10, 9),
(64, 10, 14),
(60, 11, 13),
(39, 12, 5),
(55, 12, 11),
(61, 12, 13),
(50, 13, 9),
(62, 13, 13),
(36, 14, 4),
(43, 14, 6),
(53, 14, 10),
(68, 14, 16),
(56, 15, 11),
(69, 17, 16),
(57, 18, 11),
(37, 19, 4),
(54, 21, 10),
(58, 22, 11),
(65, 22, 14),
(40, 23, 5);

-- --------------------------------------------------------

--
-- Table structure for table `registeredstudent`
--

CREATE TABLE `registeredstudent` (
  `registeredStudentID` int(10) NOT NULL,
  `subjectID` int(10) NOT NULL,
  `studentID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registeredstudent`
--

INSERT INTO `registeredstudent` (`registeredStudentID`, `subjectID`, `studentID`) VALUES
(6, 1, 1),
(10, 1, 2),
(13, 1, 8),
(18, 1, 9),
(21, 1, 10),
(26, 1, 11),
(31, 1, 12),
(37, 1, 13),
(41, 1, 14),
(46, 1, 15),
(51, 1, 16),
(56, 1, 17),
(64, 1, 18),
(60, 1, 19),
(68, 1, 20),
(72, 1, 21),
(78, 1, 22),
(83, 1, 23),
(88, 1, 24),
(93, 1, 25),
(97, 1, 26),
(101, 1, 27),
(105, 1, 28),
(7, 2, 1),
(14, 2, 8),
(22, 2, 10),
(27, 2, 11),
(32, 2, 12),
(38, 2, 13),
(42, 2, 14),
(47, 2, 15),
(52, 2, 16),
(57, 2, 17),
(65, 2, 18),
(61, 2, 19),
(69, 2, 20),
(73, 2, 21),
(79, 2, 22),
(84, 2, 23),
(89, 2, 24),
(94, 2, 25),
(98, 2, 26),
(102, 2, 27),
(106, 2, 28),
(9, 3, 1),
(11, 3, 7),
(15, 3, 8),
(19, 3, 9),
(23, 3, 10),
(28, 3, 11),
(33, 3, 12),
(53, 3, 16),
(95, 3, 25),
(8, 4, 1),
(12, 4, 7),
(16, 4, 8),
(24, 4, 10),
(29, 4, 11),
(34, 4, 12),
(48, 4, 15),
(96, 4, 25),
(17, 5, 8),
(20, 5, 9),
(25, 5, 10),
(30, 5, 11),
(35, 5, 12),
(74, 5, 21),
(36, 6, 12),
(39, 6, 13),
(43, 6, 14),
(49, 6, 15),
(54, 6, 16),
(58, 6, 17),
(66, 6, 18),
(62, 6, 19),
(70, 6, 20),
(75, 6, 21),
(80, 6, 22),
(85, 6, 23),
(90, 6, 24),
(99, 6, 26),
(103, 6, 27),
(107, 6, 28),
(40, 7, 13),
(44, 7, 14),
(50, 7, 15),
(55, 7, 16),
(59, 7, 17),
(67, 7, 18),
(63, 7, 19),
(71, 7, 20),
(76, 7, 21),
(81, 7, 22),
(86, 7, 23),
(91, 7, 24),
(100, 7, 26),
(104, 7, 27),
(108, 7, 28),
(45, 10, 14),
(77, 11, 21),
(92, 16, 24),
(87, 18, 23),
(82, 19, 22);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` int(10) NOT NULL,
  `studentFirstName` varchar(100) NOT NULL,
  `studentLastName` varchar(100) NOT NULL,
  `studentNumber` varchar(100) NOT NULL,
  `studentPassword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `studentFirstName`, `studentLastName`, `studentNumber`, `studentPassword`) VALUES
(8, 'Nonjabulo', 'Mhlanga', '218590639', '$2y$10$6BxJ.uwB5aMW6S9mK3Dw6uvW2hNqmmvgooJnsqqA/ioo1Z/kxmTa2'),
(9, 'Josh', 'Smith', '214785652', '$2y$10$a9NIcxXyN114sF1DHrSpvuhVxk9bozVZNQvALMQZ2lBFhO0vCPJnK'),
(10, 'Slindokuhle', 'Skuhle', '215638787', '$2y$10$0aS73fSiv1Q9IwFsI8dBXer9kJaeCLqXtiIDyBt2AQaCx3oPgO9/m'),
(11, 'Siyabonga', 'Kwame', '218956325', '$2y$10$b9MAD7U72p1jaNkGwaFiruspAgm1zMMWWFuUpmtzZTY0WGOHHkaN2'),
(12, 'James', 'McKinney', '213569878', '$2y$10$EmGOrBu1U0POqt064LSiaODICqOjzLyihuzbPbMReIqyCzsnShhDK'),
(13, 'Ditebogo', 'Mohlala', '218985658', '$2y$10$t.PsF6ul.igN2TfxeqbE9eJoh5W2jAZeqA.L/CQXel17MZ4IVYsse'),
(14, 'Lufuno', 'Ravhuhali', '210555698', '$2y$10$h2A9dIbBw1SnqUefXqX0te1bnty/Mt2dIldZjfAW5TXGwVMyfOcOO'),
(15, 'Nkosikhona', 'Nyauza', '216541149', '$2y$10$3wbN4pfSk2h0Nh7otT031eX9y/rzi0e/hi9dosrd6x1SfYPQ.mc/q'),
(16, 'Andre', 'Van der Westhuizen', '219362587', '$2y$10$9mE0lOibB2nhaaqELcZAQeYMZNHBZNdZMnxwQqgvm7Agjt16AV34.'),
(17, 'Boitumelo', 'Khumalo', '220458786', '$2y$10$Q4laGAAFlubG.NvWt7s3j.HxFFA5jL2j2WSwulpTm2/x.ryUCbnLm'),
(18, 'Weston', 'Motaung', '217235698', '$2y$10$ks.g4qQZdSoqx4L1RkpvnuxZ1OhL1s5.TUHSRAhJx1PijM6pfAUDC'),
(19, 'Molemo', 'Scott Wesley', '219258745', '$2y$10$oLcOJzy2dlmkA2f0gA/tfOUdtuqv99dNKEBuOhUh09srxGwIUYVvi'),
(20, 'Christian', 'Graham', '221685457', '$2y$10$g4K3gxZhy37r4eyTCdVcl.uX7PRbcTh8AyZrQBzM.Qacg1gXTtmUC'),
(21, 'Ricardo', 'Pieters', '215895321', '$2y$10$o3ypj1mdKQrjt8cdhC66i.KwtgYPTIP/JDpmNME5veIFpfOSaucGa'),
(22, 'Lorenzo', 'Van Willemse', '214687259', '$2y$10$/CXc2BRhdTDv0OgO3ca7COwn9fp9eh58LAbIrvT8BBJ/vxOSEXRDq'),
(23, 'Nhlakanipho', 'Mtshwali', '219563201', '$2y$10$.znFhtaoz48u7vveJYyqrORBwNAyeCHm94aZBiaQffxvm0xoL9EcS'),
(24, 'Molelekwa', 'Fume', '214357862', '$2y$10$gOqB0aCDiCXZLJ16f0XrAulDTSxzyCJJWszawh7Aw3P3To6wU5piq'),
(25, 'Miles', 'Garcia', '220394518', '$2y$10$GB06oUnBgH2vEm03gLKy6O9t9kOQWdsYDhFK00D9B378xwsK3uO66'),
(26, 'Brandon', 'Smith', '221573691', '$2y$10$hUpeU8jDFXLuQYgIr9CE1.BcNbhF5vOTNALU8HaM/Pu38k.uzif9e'),
(27, 'Mark', 'Scott', '217590639', '$2y$10$feXQtzfYWH06cDIOStED9.1L/..oLiIR6HQc.fwDjj9xPYZQGCKLG'),
(28, 'Jimm', 'Harper', '217599669', '$2y$10$kKod.peiOBBfpuVFBLr/5OICS.IWZieygc.Uv20pYFZ0FjXWI1D9K');

-- --------------------------------------------------------

--
-- Stand-in structure for view `studentatt`
-- (See below for the actual view)
--
CREATE TABLE `studentatt` (
`studentid` int(10)
,`registeredstudentid` int(10)
,`studentfirstname` varchar(100)
,`studentlastname` varchar(100)
,`subjectid` int(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subjectID` int(10) NOT NULL,
  `subjectCode` varchar(100) NOT NULL,
  `subjectName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectID`, `subjectCode`, `subjectName`) VALUES
(1, 'SYS102', 'Info system & applications'),
(2, 'COM102', 'Computer literacy and web application'),
(3, 'CSK102', 'Communication Skills'),
(4, 'DAT102', 'Data Communication'),
(5, 'MAT102', 'Precalculus & Calculus'),
(6, 'PPA115D', 'Prin. of Programming A'),
(7, 'CFB115D', 'Computing Fundamentals B'),
(8, 'DCT115D', 'Discrete Structures'),
(9, 'PPB115D', 'Prin. of Programming B'),
(10, 'WEB115D', 'Web Computing'),
(11, 'ADS216D', 'Adv. Discrete Structures'),
(12, 'CAO216D', 'Computer Architecture'),
(13, 'DTP216D', 'Database Principles'),
(14, 'OOP216D', 'Object-Oriented Prog.'),
(15, 'AOP216D', 'Adv. Object-Oriented Prog.'),
(16, 'ISC216D', 'Information Security'),
(17, 'ORS216D', 'Operating Systems'),
(18, 'SEF216D', 'Software Eng. Fundamentals'),
(19, 'INT316D', 'Internet Programming'),
(20, 'MOB316D', 'Mobile Computing'),
(21, 'CAP105X', 'Communication'),
(22, 'INF125D', 'Information Literacy'),
(23, 'LFS125X', 'Life Skills'),
(24, 'CFA115D', 'Computing Fundamentals A'),
(25, 'COH115D', 'Computational Mathematics');

-- --------------------------------------------------------

--
-- Structure for view `studentatt`
--
DROP TABLE IF EXISTS `studentatt`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `studentatt`  AS  select `s`.`studentID` AS `studentid`,`r`.`registeredStudentID` AS `registeredstudentid`,`s`.`studentFirstName` AS `studentfirstname`,`s`.`studentLastName` AS `studentlastname`,`r`.`subjectID` AS `subjectid` from (`student` `s` join `registeredstudent` `r`) where `s`.`studentID` = `r`.`studentID` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendancerecord`
--
ALTER TABLE `attendancerecord`
  ADD PRIMARY KEY (`attendanceRecordID`),
  ADD KEY `registeredLecturerID` (`registeredStudentID`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`lecturerID`);

--
-- Indexes for table `registeredlecturer`
--
ALTER TABLE `registeredlecturer`
  ADD PRIMARY KEY (`registeredLecturerID`),
  ADD KEY `subjectID` (`subjectID`,`lecturerID`);

--
-- Indexes for table `registeredstudent`
--
ALTER TABLE `registeredstudent`
  ADD PRIMARY KEY (`registeredStudentID`),
  ADD KEY `subjectID` (`subjectID`,`studentID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subjectID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendancerecord`
--
ALTER TABLE `attendancerecord`
  MODIFY `attendanceRecordID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `lecturer`
--
ALTER TABLE `lecturer`
  MODIFY `lecturerID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `registeredlecturer`
--
ALTER TABLE `registeredlecturer`
  MODIFY `registeredLecturerID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `registeredstudent`
--
ALTER TABLE `registeredstudent`
  MODIFY `registeredStudentID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subjectID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
