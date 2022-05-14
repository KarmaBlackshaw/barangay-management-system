-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2022 at 10:47 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bsms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblblotter`
--

CREATE TABLE `tblblotter` (
  `id` int(11) NOT NULL,
  `complainant` varchar(100) DEFAULT NULL,
  `respondent` varchar(100) DEFAULT NULL,
  `victim` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `details` varchar(10000) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblblotter`
--

INSERT INTO `tblblotter` (`id`, `complainant`, `respondent`, `victim`, `type`, `location`, `date`, `time`, `details`, `status`) VALUES
(10, 'Joe Rizal', 'Nora Selos', 'Joe Rizal', 'Amicable', 'Pob 1 Catbalogan, Samar', '2020-11-02', '00:30:00', ' Sustento sa Anaak ', 'Scheduled'),
(19, 'Girl Topak', 'Boy Topak', 'Girl Topak', 'Incident', 'Manila', '2021-01-13', '11:11:00', 'Mga Topakin na Pamilya', 'Active'),
(26, 'baliw', 'luka', 'marites', 'Amicable', 'Looc', '2021-04-30', '13:09:00', 'Donec sollicitudin molestie malesuada. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Sed porttitor lectus nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.', 'Settled'),
(27, 'Ian', 'annie may', 'Riza', 'Amicable', 'Arado City', '2022-04-18', '15:59:00', 'Gin Suntok', 'Scheduled');

-- --------------------------------------------------------

--
-- Table structure for table `tblbrgy_info`
--

CREATE TABLE `tblbrgy_info` (
  `id` int(11) NOT NULL,
  `province` varchar(100) DEFAULT NULL,
  `town` varchar(100) DEFAULT NULL,
  `brgy_name` varchar(50) DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `text` text,
  `image` varchar(200) DEFAULT NULL,
  `city_logo` varchar(100) DEFAULT NULL,
  `brgy_logo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblbrgy_info`
--

INSERT INTO `tblbrgy_info` (`id`, `province`, `town`, `brgy_name`, `number`, `text`, `image`, `city_logo`, `brgy_logo`) VALUES
(1, 'LEYTE', 'BURAUEN', 'Barangay Buri', '0919-1234569', 'Location of Buri, Burauen, Leyte, Philippines\r\nBuri is one of the Barangays of Burauen.\r\nBurauen is in the Province of Leyte\r\nThe province of Leyte is in Region 8 â€“ Eastern Visayas Region.\r\nHistory of Buri, Burauen, Leyte, Philippines\r\nContribute your knowledge about the history of Buri\r\n\r\nPeople of Buri, Burauen, Leyte, Philippines\r\nTotal Population of Buri\r\n\r\nElected Government Officials of Buri, Burauen, Leyte, Philippines\r\nRepublic Act No. 11462 Approved: 03 December 2019: That the barangay and sangguniang kabataan elections on the second Monday of May 2020 shall be postponed to December 5, 2022. The elected barangay officials as of May 14, 2018 will serve until December of 2022.', '02012022032735burauenlogo.jpg', '02012022032735th.jfif', '02012022032735burilogo.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblchairmanship`
--

CREATE TABLE `tblchairmanship` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblchairmanship`
--

INSERT INTO `tblchairmanship` (`id`, `title`) VALUES
(2, 'Presiding Officer'),
(3, 'Committee on Appropriation'),
(4, 'Committee on Peace & Order'),
(5, 'Committee on Health'),
(6, 'Committee on Education'),
(7, 'Committee on Rules'),
(8, 'Committee on Infrastructure '),
(9, 'Committee on Solid Waste'),
(10, 'Committee on Sports'),
(11, 'No Chairmanship');

-- --------------------------------------------------------

--
-- Table structure for table `tbldocuments`
--

CREATE TABLE `tbldocuments` (
  `no` int(12) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `number` int(12) DEFAULT NULL,
  `requested_documents` varchar(50) DEFAULT NULL,
  `purpose` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldocuments`
--

INSERT INTO `tbldocuments` (`no`, `name`, `email`, `number`, `requested_documents`, `purpose`, `date`) VALUES
(1, 'amar', 'amar@gmail.com', 910201645, 'certificate', 'school', '2022-04-20 06:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblfpscert`
--

CREATE TABLE `tblfpscert` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `current_location` varchar(100) DEFAULT NULL,
  `applied` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblfpscert`
--

INSERT INTO `tblfpscert` (`id`, `name`, `current_location`, `applied`) VALUES
(1, 'RENATO R. ALMO', 'Metro Manila', '2022-04-15'),
(2, 'Annie May Barrera', 'Manila', '2022-04-18');

-- --------------------------------------------------------

--
-- Table structure for table `tblofficials`
--

CREATE TABLE `tblofficials` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `chairmanship` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `termstart` date DEFAULT NULL,
  `termend` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblofficials`
--

INSERT INTO `tblofficials` (`id`, `name`, `chairmanship`, `position`, `termstart`, `termend`, `status`) VALUES
(1, 'Gaudencio G. Berida', '2', '4', '2021-04-29', '2021-05-01', 'Active'),
(4, 'RENATO R. ALMO', '3', '7', '2021-04-03', '2021-04-24', 'Active'),
(5, 'Alberto C. Almo', '4', '8', '2021-04-03', '2022-03-24', 'Active'),
(6, 'ALLAN T. ANTONIO', '5', '9', '2021-10-13', '2022-10-26', 'Active'),
(7, 'merlo t. quiton', '6', '10', '2020-05-21', '2021-04-03', 'Active'),
(8, 'relando s. tungasm', '7', '11', '2020-03-17', '2021-04-03', 'Active'),
(9, 'Bienvinido P. BUHALOG', '8', '12', '2020-04-22', '2021-04-03', 'Active'),
(10, 'NELSON Q. ELOGORICO', '9', '13', '2020-06-18', '2021-04-03', 'Active'),
(11, 'DIONESIS C. ECHON', '10', '14', '2020-07-08', '2021-04-03', 'Active'),
(12, 'ALMA CANDELA', '11', '15', '2020-07-08', '2021-04-03', 'Active'),
(13, 'ROWENA P. RELLAMA', '11', '16', '2020-10-07', '2021-04-03', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblpayments`
--

CREATE TABLE `tblpayments` (
  `id` int(11) NOT NULL,
  `details` varchar(100) DEFAULT NULL,
  `amounts` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpayments`
--

INSERT INTO `tblpayments` (`id`, `details`, `amounts`, `date`, `user`, `name`) VALUES
(5, 'Business Permit Payment', '7000.00', '2021-05-19', 'admin', ' Atrium Salon & Studio'),
(6, 'Certificate of Indigency Payment', '3500.00', '2021-05-19', 'admin', ' Ronil Gonzales Cajan'),
(7, 'Barangay Clearance Payment', '2500.00', '2021-05-19', 'admin', ' Ronil Poe Cajan'),
(8, 'Business Permit Payment', '3500.00', '2021-05-18', 'admin', ' Atrium Salon & Studio'),
(9, 'Business Permit Payment', '7000.00', '2021-05-18', 'admin', ' Atrium Salon & Studio'),
(10, 'Business Permit Payment', '7500.00', '2021-05-18', 'admin', ' Atrium Salon & Studio'),
(11, 'Barangay Clearance Payment', '50.00', '2022-04-18', 'admin', ' Annie May Calupas Barrera'),
(12, 'Barangay Clearance Payment', '50.00', '2022-04-18', 'admin', ' Annie May Calupas Barrera'),
(13, 'Barangay Clearance Payment', '5.00', '2022-04-18', 'admin', ' Jhon Paulo Mahilog Tismo'),
(14, 'Business Permit Payment', '6.00', '2022-04-18', 'admin', ' Atrium Salon & Studio');

-- --------------------------------------------------------

--
-- Table structure for table `tblpermit`
--

CREATE TABLE `tblpermit` (
  `id` int(11) NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `owner1` varchar(200) DEFAULT NULL,
  `owner2` varchar(80) DEFAULT NULL,
  `nature` varchar(220) DEFAULT NULL,
  `applied` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpermit`
--

INSERT INTO `tblpermit` (`id`, `name`, `owner1`, `owner2`, `nature`, `applied`) VALUES
(4, 'SH Food Group 1', 'SH Food Group 1', 'SH Food Group 2', 'SH Food Group 1', '2021-04-30'),
(5, 'Atrium Salon & Studio', 'SH Food Group 213', '', 'Atrium Salon & Studio', '2021-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `tblposition`
--

CREATE TABLE `tblposition` (
  `id` int(11) NOT NULL,
  `position` varchar(50) DEFAULT NULL,
  `order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblposition`
--

INSERT INTO `tblposition` (`id`, `position`, `order`) VALUES
(4, 'Barangay Captain', 1),
(7, 'Barangay Kagawad', 2),
(8, 'Barangay Kagawad', 3),
(9, 'Barangay Kagawad', 4),
(10, 'Barangay Kagawad', 5),
(11, 'Barangay Kagawad', 6),
(12, 'Barangay Kagawad', 7),
(13, 'Barangay Kagawad', 8),
(14, 'SK Chairman', 9),
(15, 'Secretary', 10),
(16, 'Treasurer', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tblprecinct`
--

CREATE TABLE `tblprecinct` (
  `id` int(11) NOT NULL,
  `precinct` varchar(100) DEFAULT NULL,
  `details` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblprecinct`
--

INSERT INTO `tblprecinct` (`id`, `precinct`, `details`) VALUES
(1, '0987666666', 'DSWD Contact');

-- --------------------------------------------------------

--
-- Table structure for table `tblpurok`
--

CREATE TABLE `tblpurok` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `details` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpurok`
--

INSERT INTO `tblpurok` (`id`, `name`, `details`) VALUES
(1, 'Purok 1', 'Tikang Kanda Babon ngadto liwat kanda Babon'),
(2, 'Purok 2', 'Amon ngadto ira'),
(3, 'Purok 3', 'afawewqeqweqweqw'),
(4, 'Purok 4', 'dsfdsf'),
(5, 'Purok 5', 'rewrew'),
(6, 'Purok 6', 'rewrewr'),
(7, 'Purok 7', 'rew'),
(8, 'Purok 8', 'rew');

-- --------------------------------------------------------

--
-- Table structure for table `tblrequest`
--

CREATE TABLE `tblrequest` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `pcs` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `applied` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblrequest`
--

INSERT INTO `tblrequest` (`id`, `name`, `pcs`, `type`, `location`, `applied`) VALUES
(1, 'Annie May Barrera', 6, 'coconut', 'buri', '2022-04-15'),
(2, 'RENATO R. ALMO', 6, 'nara', 'Dist. 8', '2022-04-15'),
(3, 'Ian Figuracion', 100, 'Flywood', 'Arado City', '2022-04-18');

-- --------------------------------------------------------

--
-- Table structure for table `tblresident`
--

CREATE TABLE `tblresident` (
  `id` int(11) NOT NULL,
  `national_id` varchar(100) DEFAULT NULL,
  `citizenship` varchar(50) DEFAULT NULL,
  `picture` text CHARACTER SET utf8mb4,
  `firstname` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `middlename` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `alias` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `birthplace` varchar(80) CHARACTER SET utf8mb4 DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `civilstatus` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `gender` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `purok` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `voterstatus` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `identified_as` varchar(30) CHARACTER SET utf8mb4 DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4,
  `resident_type` int(11) DEFAULT '1',
  `remarks` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblresident`
--

INSERT INTO `tblresident` (`id`, `national_id`, `citizenship`, `picture`, `firstname`, `middlename`, `lastname`, `alias`, `birthplace`, `birthdate`, `age`, `civilstatus`, `gender`, `purok`, `voterstatus`, `identified_as`, `phone`, `email`, `occupation`, `address`, `resident_type`, `remarks`) VALUES
(169, '2018-24738', 'Filipino', '02012022031808FB_IMG_16410173556326371.jpg', 'JEREMY', 'ECHON', 'OLA', 'MY', 'Brgy. Buri Burauen Leyte', '1998-06-30', 23, 'Single', 'Male', 'Purok 2', 'Yes', 'Positive', '09102037489', 'jeremyechon@gmail.com', 'Student', 'Barangay Buri Burauen Leyte', 1, 'no remarks'),
(174, '2018-34555', 'Filipino', '02012022032131FB_IMG_16410174636644719.jpg', 'Jhon Paulo', 'Mahilog', 'Tismo', 'pau pau', 'Dist. 8 Burauen', '2022-01-01', 26, 'Single', 'Male', 'Purok 7', 'Yes', 'Positive', '349358957', 'cajanr02@gmail.com', 'Student', 'San Diego Burauen Leyte', 1, 'no remarks'),
(180, '1212321321', 'Filipino', '02012022030838anniemaybarreraID.jpg', 'Annie May', 'Calupas', 'Barrera', 'maytion', 'Brgy. Limburan Burauen Leyte', '1999-10-22', 22, 'Single', 'Female', 'Purok 6', 'Yes', 'Positive', '19512659595', 'anniemaybarrera@gmail.com', 'Student', 'Barangay Tabang LaPaz Leyte', 1, 'No remarks');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_support`
--

CREATE TABLE `tbl_support` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` text,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_support`
--

INSERT INTO `tbl_support` (`id`, `name`, `email`, `number`, `subject`, `message`, `date`) VALUES
(1, 'Annie May C. Barrera', 'anniemaybarrera@gmail.com', '09102016346', 'data', 'Hello sir can I have a COPY OF BRGY. CERTIFICATE?', '2022-04-18 21:01:17'),
(2, 'Annie May C. Barrera', 'anniemaybarrera@gmail.com', '09102016346', 'Clearance', 'school', '2022-04-20 23:53:27'),
(7, 'amar', 'waylimthai@gmail.com', '0987666666', 'technical', 'bb', '2022-04-21 01:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `avatar` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `user_type`, `avatar`, `created_at`) VALUES
(11, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'administrator', 'data:image/jpeg;base64,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', '2021-05-03 02:33:03'),
(12, 'paulo', '3352537346b8952df5cd1af145e0bc194c654b68', 'staff', '02012022033117FB_IMG_16410174636644719.jpg', '2022-01-02 02:31:17'),
(13, 'jeremy', 'ee68891a4be740d745aa4edd6c1c3121abbf4ab4', 'staff', '02012022033149FB_IMG_16410173556326371.jpg', '2022-01-02 02:31:49');
INSERT INTO `tbl_users` (`id`, `username`, `password`, `user_type`, `avatar`, `created_at`) VALUES
(14, 'staff', '6ccb4b7c39a6e77f76ecfa935a855c6c46ad5611', 'staff', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gIoSUNDX1BST0ZJTEUAAQEAAAIYAAAAAAQwAABtbnRyUkdCIFhZWiAAAAAAAAAAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNjAAAA8AAAAHRyWFlaAAABZAAAABRnWFlaAAABeAAAABRiWFlaAAABjAAAABRyVFJDAAABoAAAAChnVFJDAAABoAAAAChiVFJDAAABoAAAACh3dHB0AAAByAAAABRjcHJ0AAAB3AAAADxtbHVjAAAAAAAAAAEAAAAMZW5VUwAAAFgAAAAcAHMAUgBHAEIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAFhZWiAAAAAAAABvogAAOPUAAAOQWFlaIAAAAAAAAGKZAAC3hQAAGNpYWVogAAAAAAAAJKAAAA+EAAC2z3BhcmEAAAAAAAQAAAACZmYAAPKnAAANWQAAE9AAAApbAAAAAAAAAABYWVogAAAAAAAA9tYAAQAAAADTLW1sdWMAAAAAAAAAAQAAAAxlblVTAAAAIAAAABwARwBvAG8AZwBsAGUAIABJAG4AYwAuACAAMgAwADEANv/bAEMAAwICAwICAwMDAwQDAwQFCAUFBAQFCgcHBggMCgwMCwoLCw0OEhANDhEOCwsQFhARExQVFRUMDxcYFhQYEhQVFP/bAEMBAwQEBQQFCQUFCRQNCw0UFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFP/AABEIAPoB1AMBIgACEQEDEQH/xAAeAAAABgMBAQAAAAAAAAAAAAACAwQFBgcAAQgJCv/EAEYQAAEDAgQEBAUBBQUGBgIDAAECAxEABAUGEiEHMUFREyJhcQgUMoGRoSNCUrHBFWJygtEJFiQzQ+EXU5Ki8PElY3TCw//EABoBAAIDAQEAAAAAAAAAAAAAAAIEAQMFAAb/xAAvEQACAgICAQMEAgEEAgMAAAAAAQIRAyESMQQTQVEiMmFxBYGhFEKRsSPRweHw/9oADAMBAAIRAxEAPwCzk2ytpjV12ifvRzdugn6PzSgIQsRI/FGn9kNMSD1FVrGkLpWIhapLmxUAOkUcbafpKSPvNKC14YCyfwaESlxW3kB5zvRcAloReCVHYkAelb+Wn6iFew3pVpLawpO47ihKXuVAgHuBXbIqxKq3UkaVI29TQg2giCE+0mjUoO55g/vDnRmgtDkfeak5L5EnyzalbCD6UINhKtIKv0j80eVKjY1orOkg/wAq6gtGFlLadwoqPKOVAWiEDkJ9BRraNSdQOr36UYlAUmCmD0JoKO/QlS2VEQnl9634ZPMb0oUVIWExB7jlWljymVCTU6QX9hKkpG3T0raUpRtBM0YFlAHUfpQxKlSSPblUJlbv3Cksq2Ogj1rYT+0IKAI5zvRpW5zIASKAVJCgdvWiWwtMAptCFeUA99qGGkaQrQEnuRW1ONkSlMHoaGlZWNwUepPOoaIpfJjTaVnkdXOjwUKSAB7gUUnVBGr9KGhYVyX5vWpSZzVAygfSmSOw2oRZCvKlcHqJolToECdZ9KPRKTM/aKKgGkwTTIjTq3HYCtllIE8z1mgEJBgAifSthOr+H8UVsimCDKAjUIBoaWQrdKZ7HnQUjVsUj7HahBZ5SBHSi/LJ4oGEqKNK42HPaTQ2WEqQSEye4M0WkTuYPrQtRnY/+k0LaOYYhpSDuSD2ihC2LgJIE+tFjlyk+9YHAg7iD71BFhoYIVGwFbKAlQEap9f+1AUvUBvBrQUrVJWT2miSJbYatlRPlQDtvvvWNISkyU+b0oKVr0kqUSfet+MTuPMR3rtnW/cGsCdwB6RNaWyI5wPesQokkkhJPptQV3UCOfrFFYFX0YphGnbb1kUSWAk/QCftRqHgQf5GgKc1bpEEexFdZKiB0J0kwmfasCEKQeavSYo5LkJ3Jn2oJdAOoc/1oXJPpE7QUGhtpj7/AOtBU2AqDBnkaEpyZMTPfaghQIiaELk/cCEJ6kHsBWFoc/poSFIG0AD8GhqUgGQQB2rmjkJ7lgKSnVG/KKL+UgQpI09By/1pQVtvKgmKxJAPOB7zUWS79hA4jw1yUKnpHKtBgqWFKSAD33peptDh7UEtwgk8vWuTAp92JXbJBBAJ1Hsnl+aCi2CE+ZBWR160pKtSRB8vrNDQoJbjWP8ACTzrmvgNJCMW6VHdKle/Sg3Fs2pPMyO8f0NLlIhE7H0rSWQoAQjfnKZig/ZDSY3KtUhsENlwnkJrPkwrY7DsRy+9OnhhCoB0x6TRa2YVO0HtRaB4jeu2CVAeVv1Jma18qkqCvKY6jrTkLJa0yNvv/wBqJeShgSokn251H6IpDW9bFbhIBA7CKylS7w6vKlAHqN6yh5MDjD4/wJG2SROxPODShtlTgBhCT2BiiG/2YG8e9KrfzSdQFHtF6pgS2XNWmBHMSf60JtCkciAexo7XqQQVjbeQaLS2FKClSR6Db9akO6NLHiiSkoI59QaLDACSZj0oagFq+lSgOUVtcaQSSk9jUWzk0woJ0j9moD03oJKlAbSr0NbPllQI37bVvRpTqPI9tq7YVGESAYiOcGtrJWAPqT0P/eiytIPlOw/iFGlQKBpiT0E1BGkaADap5VsvKP0kAdtq0Nk7QD2JrTZSkydz3BiKhto7Ri1KmSRpHWa0lWolRk9tqxcGSFSOgJrSeRKjI9BRIjr3BLU2ogq8yhyAkfyoxohW6oSB3otJABlQjoAJoAeJEHygfauItNh6kFwkj6K0NJ20D80Hx4EAiO4oQkoKlKBHSCKi6D0bDbaQVbqB6HpQQkSCEkjqDQULIlWmQPSaIexFphKlOKDaes7VKAdCkwtfOE9hW1XCAQNaUp/WqE4t/EPa5PunrLDyi6uEJB1JUNIJn8xXO+MfEPnTEVvvt3yGmIkoCgnr05fpTEMUplLnGOjvt/E7VpfmdSkD94n/ALUUMz4elI03bUA/xCvNLFOKOasUZUTijykf3VxTTa51zA3K3Lx1QP8AeJqz0K+6/wDgq9WXsl/yepqMXt3QkhxJ1es0NV6yzv4g39YrzawDj9mHLaklu+cVpEQo6h+DWsW44ZkzDdB5ePXLCejTaykfpVkfGi/9xbznW0elbV626PKsEe9H6iE7kfivOvAviHzXg6mvCxF5wJ2h1ZUFe4NX5w5+Ku0vEsWeNlpF66YCkQgH0gnf7VEvGkvtdgrKl92jpptYWr/WjSpQVCVT61FMCzxhONtJXa3rbs/uhQBHvUjS8hSQQefrSck06aL1JPrYqQe6wT60AuBZ28xHM0X4xjSJrSAUgkiBUWkT+g4KkwoSmjJChMCByNBQPLMie00BDwCjIMeldZ1MNCwowZNbUNJAg70Wp5AG8x+aElUgQZnsakHivcMmBBMDtRXinVJBEVt0DbcpHWd6AZiZkdJqLJ6BFRJEAqnvWtZUfqI9K2d0TtHXczQCoEeUSK6yKQeFBCdlaj2oJ9dj6UFpOkHmk+9D0DqQr0POo2SkwpQIVvv71hMDbc96E9CYABUkczRSgVJlI27AVFkgXFkmCfbahapTymKAGlEeZOn3oYlAhLnm/hJruRNgXVlCQqeXQiteJrGqB/pQFJCjKpmtJGpMTt7V12dYY6sApkz21VtQAMgj9KzSCNjPrBrEpCvqnb1MVBNoDqkEa5PcUQAoOQn7mlRbKTIBTPSsI1EgiY9K7o6gCFzKQqT1g8qGlRTt+8KCqSBGqe3ShIbV4fnMk9YqSAxKj9QMEc5FGtrUpWyZPfpRSUJQJ3Ces1jt05ADQ0o6rqeyNe4O4xKD4STrcHOOlIygKOohK1mjm1NpBCUAnmfL1oLig4qCAD771DddHNL2EjjairywgdhWUFxMLIG4H8RM1lDb+QOARbtgmCCfQgUqFsAdgADQrVkzvBTHMUoU0BskR6ijBjJMTGWzoJCh6CtHUg7AQfsKWKAaHI6vWsQo81JAHckRXFn6Q3QDKoOroYoRQFELmfSadC20pHTV60mXZhKtcD2SagJISqa8REkGfegQUJggx2paWwpMncdI3oLyYQkkcup5VOyXsQobK5gx6GjCgAbwD3mlCmwpMkz96AE6SNKoT7UP7QGvcIUBpIIgHltJ/NB3EDSfaImjj9RHTqQKEkJcGkbD25/ep0EEqZKt0+T0maDpXpIBJpYlsIEJ2PbnRBSUHVznsKghKuwpSSkDbST2rXKJ1T13o9SBIVM+iuVYpIG6zB6VxNfAS4gGNO/pFbSkpSVFISRz2/pW0k7kEUlxO8/s+zcuFq/ZoSVEA7xXds7srDjJxyt+GrBZQgO3y29TafpA9TXJubfijzXj9tcWi3mWkOiCppuDHoZ2pr+JDiAM55+vbizUPkWkJZQEnYlJMmfvVKPYi64dJ8qR1FNxgkrbKmO+K47cYk4pVw+VLVzKjzppUt9OyXPL3BpI86SN1T6mkynFEwFEDvR8vhkOMH7Dyi9dYa8zhV7UQ7evXBCkKXHpSJD2gfVq/wAVaViqrceQhPoBVilKS2wa+BzDrzyNMQe6qXWlw0wmHEHxO4MVHk4q44QVge4FKmcUM7oSR3ImoiqYclZPMFxbC9BYuitpSv8ArCSB+N6erPCLe7fJw688dbZ1Sk6Z/O9VuzijQbgoTPcikqb59p5S7dxTZ9DTqnGPRVxbXZe+GZ1vMMebbZduEXjZgKSoyfSrw4U/FGWr0YXmVYaKPKHyiCD2VXFuFZjvWHgtxZURy1VIjeIx1Hjstli5T9SkjYmhm4ZV9REFx0z1Jy5mexzRaJuLC5RcNH99J29qfUKOjf8AM15zcBuNV7w5zOGL53xMLeBSttRP17Qr8A13hlHPOGZvs0OWVylRKdWjkay8mKtpaLrSfZK/8Jie9aG3v/doCDGx3HcmjEqSkz9JpbfsWJmgNzKR99zQ0AJIPftRUSSoeY9qPSELA32HMCp2S38GnRqOyefOsUAgiJNaWoauR27UI7jaa7YHXaBhrWjdR7wIolQA5dO+1GEEiI36SaLKDABruib/AAb1Hlqgdu9abAknYx+a2lsfTBn3rCCdjMjt/wBqm2cqMUrWeQA7qoClSoIk/ajUAA+UEH3rQSkLIj33qCf0jRZCBET9qLMABKRv6c6MgBJGqe070XG5qCbC3FjVCpPrzoIBmQT9iRQ4MkkCB3E1sDWBpSYP2qQGt7No1FMqUVq/vUe03tJ5+hii0nTsZMdjNbOtSiUwUxyiD+a6/kJKwxaVDcqKQekRNaDgJglMdxtQSfLBCp9aApQgSSD6iuVHUGqSSICkjtNFGBMDcc4rE6RzJmgKAcMEiem+9c1ZKggDwVGznuknnWJ3IUnyn+Gdq34Sivcp/O9CRaEgmUx03INRaRzSQHSQrUtCRHWKx1Y3VB9B2owMmCkKB6xRS2yUxAnoCdqnTKm1dhaluLMpUIrKLUxJ2EewrK6kDzHVFv4YGxKfUUNVmTJTA9IpxZYSr/mSfQGBWP22g6UqBSeQmp7LLb9hrNsoAlRAjpFE+GpR0lJ+1O/yqieRj0NFLYJOw0q7GuaCoa1tLiBJjvzospUjzEq+9OS2SiZSD7E0mNuVExyNRbJCG3FRBBUfblWykOAySP1ozwFJI61hbUCSTv2NRdndhGlKD9afzQCZMc6GtoqHKJrSmi2IJEdwaLojroC8E6R+6B60ABR3TKo6BM/rQ9BUI+r06VtKCDCUR966zr+TTavETI8sUI6xySVetaVAWJ3V7cq3O0aiB2rujtBalQNkyqgygiD9Xad6NKiTMgDv1oSXBB3B+01xCt+4QhsifpEVU3xEZyuMo5ExB62INypEJT3Sdj+hq3VrlPl2PtVE/Euw9f5MvkuW4ebQkkqUkQjaJ/WiglewZr5R553+Jam1lUEkkyqJJ7moq9eqS8ruegpzxK0Lrqw3Hhg+Up5EURZYIu6cAImaa5L2Ign7CAuqWOcE1o6inTtPeKsPBuGt1egKbZCk/rSt7hxdtqUldqpCeQITUOWrZb6bZV+lSdkyT6UQsq3BBBHOant1wyxQOkN2rqh3iKR3vD7EbFkqctlbc5G9U+rF65ErHOO2iII8RY32SKGHCAPNFLXMMdEpKCkjaDRSsIuUblClDvBq9TbVJkUJi/q31UravVBG00kcs3Eq86FCs0qbTOgketcqWwGxyavCEnzgE9CaesKxF5tshvyA8yKjDSvNvypSi8W2kpSpQHYGrFO/gPtaRLWXH3VE7OEbyOYq4+D3Fe6ybdNpbeWVLISWyedUnla+HikOkhMbkSTU04fvJxDP2CWzCStx2/ZSgdSdYP8ASonx9injR6VZCzUnNWDs3AQsEpEkiN6maErKJ6f4ZpnwXDWbBgBtIG30p5CnaFQCACKzn3osQIJCU8gTWadIkpBntyrIk7wK3okxEjvXHAgyCmAEg+lYYBhI3HbehBAgEwoigltKhMb1H6OA7OKMkg+oraQAdPX81g1Nkkb+lB8VSjB2qDjXhEk78u5/1oYSEwd47zzrQSrtW9O/IqI6HlXa9yN+xouiOv5opaARqnb8mjikdZnsKxTftPaKnXsR9TCFNSmRv77UApKNoMetKfB25jfoK2UIAACfuBR2HsISjUndMjoaNQzEbA+s0PSmJkn1NYkknlt3ioslI0tB0kAwOxrEIgSCFenatOiCNJBoaW3FQdQT6AUNo6qCVL1fSZPvWJbcUZ0xPODSnwg35lp3PWhIcUdo27mhs4I+Xk7yPvRibYJTsOfWjisiEpTz6iguMLIH1bd662SwPgpRJImOZmk61IWohCZ+9K/pR5lEK9DNFEhUHrPUTNEmwaCAConYgVngEx0A7mlAb1HfbtA2oaW9CVbzP/zlUP8AIElfYgW15jCtvSspSoGeY/8ATFZQ/wBFXH8Dk01IEj8GlqUoWgApAnqT/wBqUqsdCwSI7AVsMEp3UBVytBJL2ECrTSVJCiQfWixZkDuem1L3LTxkwmRH71ENMulfhuKV6EHY122WqhGu2J2gT9qAtiE6QUqPel7zC9ccj6GiVI6FIEdev5qHYSYgctyggKkDtEUUplOieRpzUgqAg/1ol612mZV6UFnN/ga1MhRgq370U7bAdQfQ0uU2dJlM+lJ1NqCvpI7USa+QHII0lrcSR2iiyuTGwn0pWWlEgzE8xQjbzJBTPpRVYXIRkIMb/isCdXIH70YtBSsDf7UIJAjnHY1FECZbZCvMIFBKD6R70pWIBKTPpuaLDaxvyrq/J1CcNCDMn1NUZ8VrFw1wvxN1lwJWlMjaZHUfiT9qvxaFadx5e8VXHG7L7uMZDxdtpw6TbL1NQCHBH0x1mjj3RXr3PL75RT6zqSAo9qtngrwkezXigU6ySwgSRHPtFZk7hZe5tzKjD8OZ8RWqVE7hInmYruLhxwrRkPB2mlobDukalhO5NON0qRfjj7tFW4Lw0sMuqIct0ynpRWM4NaF0lLbakdo5VaubrNsyrUEjuNqrm7tGQtcOyTv5lbCsryG0raNfx0m+iDX1hZAnS2kEdhTDimDWly2UqbBB9KmWKWybdRVsoHrFR67Y8WVJVt3rBlOn9Kf9G08cGtkDe4d4Y86XQwAfai15Mw1IUktoUR0IqWKbW0vRMz1oRsApQlUj0FR6+WvuKfSXSRXN/wAPcMukwGUpJ6xSFXCSzcAShAUT2mrZTgqQmSdj3o21skocEk1fDJkb+5gT8aD7Rz3m3hoMFa1JSU+wqAPYQsqISCCO9dvtZNTmRhTbtskoiAsiqc4g8DMVwa4euWrdRtgZSodBW9iy0towc+KMGc+IU9ZvaSrTO1X18J+XjjXFzAbhKPE+RWq6d1cgNJSmPXUpJ+xqpb7ClC4KVogpMGa7m+CThw1Y5S/3gW2kOXqiGlnmpCVEbekj+dXzmmuxBpex1IzbltlBPOPalAZWreYjqN6HoJiJV9qG3sew9aWdnJvoKbQpM6hqPQnatjVvP8qPUiJPOe3KtBsEAaTvzoOyaYnKlJPl69RW9RAiduwozwzqgAD3oJaV/CB6ip/QNUABKRJUfvQt5En8VtIBMDehwOWmT2qUF2BCpEiT77UIlQTtA9a2lII329CK2GSU8xPpUHJBJJB5yO4NCK5IgH80cGTEaR6k1oNjcSkegqVQTfyFTBnTq/pQSvWYSCPalaEhKSCYntWBo7Ry71LaBpBIAUk6xt2NDQWwnmZ7GhOMalbxWhapUqBsr3oaDSMAbnfYehpQAnQNAMdzW2sPAIKlg+lHqt52jl0qejqESmCqSR5fUVpCCg6iARS5u3Wdkj80P5GZKlJ1dhUb9juhMlKNEiJPeaCpoq5KSR23pSLUpSO3tWvDEwFA94NdZ12JV2QjVIkdpoSWAUyd/U7UqW2CAmQDRJRHIEn1FErZGgktOaoSYHvWItZVqWox70eUKSB5B+dxW0MKc25ekVFUC2J12K1qJCkAdBqFZRpYdSYAEetZU6K7fwTduw1ApkpUOpFAOHEeaFL/AMSY/mKkFnbBUBSkgdCetbvLVIV5Z+3KrTlRF12pIOwHoRSN7DtczqB5iKkVzbLBkAK7CkjiVTBG/ptQci1UMSGFg6FIgjuNzRTrSgrzJMDvT043JG2k+oohQKwY3IMRFDbZZoafB2MbDtWhaatysD2FOa2fKIn70QtgbSRFDsHsb3GI8pKtJ6zSVyzSFb6iD3p3SkBPlMDsaKfbCgdpPXVUqkyH+hnNkFLETHpWKtJJCUkj12NOTTYjr+KMdZUUgD8mmUrKmxlXayBJMjpQRYat9p+5p2WyoAbD3FCS1pEaNz2oqr3K097GRzDVkSQI9DWhbKERtHc86fNChI69qCGoHKfeq2rLOXwMTtrzITon+8SKgPFPN+HZUwkW96jxjehTWhIBgEGSoTy6ferVcZABCUjfuKof4iMmXWIYhgN9btLcYUtVtcJCdm0kFQcPYeUj7ihbcVa2M4IwnNKb0R/4Nsri9xbPGJuWifCt75FravpbAQpBQlZA9QVQfSPWrb4q3N3g9mpVi+ylw9Ep3H5NJPhXwZGE8GHcVtVSze4peLG8ghLpbChHMHRSHiNg9zjN5qbe8JStgCacUtbDcadRZyzxI4jZtsVrkuvoBnyjb8Cqx/8AH7FLJwpvLUz2giuiMy8OnDfXDGOYt/ZtqLcuMvsMhXiLk+QlR2O3brXFGLX+LXOJKYu7ZbDwVCml/un3Gx96VnFS+5FkJzj02W7ZcdrfESEvoUyByAE1K7HO1jfW6XWzrP8Ae51z9ZWTiblDbjQJPcVb2TMlXd7aeI2xCQOorOyYsb2jWwZM1/USK/zBbKT4iwlApo/3ysWQsquAhEzBptzPgV9YIWFNEJFVZjFs4tSvEKgPU1QsK6sZnmnBaSLfc4jYWkCLlO3U/wD3QG+LWF2zySlzxfUCuf75tqzIU8laknkRUnyLhbOO3BLFg8+23utSElekdzFWrxY9ttmfLysjdHV3DbingeOX1vajxUvLMJ/Zk/rXST/DljNuWHGnkFKHU8ygRH4rkrI7GFZeuLW5TahwIhSVJ2ruThXmZGa8tJUGVMyiEhQimsSxRetCuX1J7Z5qZo4YLf4kuYDa6SXLrwZb/dJPL0r0A4WZMGSsjYTg6VoWbW3S1rbTAMem8fmuXrzCo4j8SsetUNpVhuMO26EqXIbIQkFfqSrUfc11bwRYvbnhdlpzFHHXsQXaJU84+ZWsyYJ9SIqzJmivpFZYOMebJSwylMKPMdjQlo1n09uVL/kNSgANvWsXaFvYIk+tUWVp17DemUmIkepoRJjZH3maONouYCYPpR7eH9VDepT+CL/AgU2pZElX2rfglRhRgeopy+VSQI2jntQVWigCUgR70a/J1sQFvQIA9yDQflyo7AxTo1YqeTuNvShf2boG88+hqbo4RMMAK2keoozw5kRy6xSwMBshIBjrFHIsiBtvPWhsmhs8FKttJoIsxq6xTymxVO6TQ28MUVTE/agcqAafwM/yew327UWtgAaQDHepEMHeUfoPpRLuBqbMuBIn7mpuwkm0MqbTxQAAFKFLGLVLHmUlIPeadbXDQhJ0pkHqaUpwbWJAB771N0dQyrSgqCgglP2FCbbW4rZAHblUht8HTEET9ppxZwVpA1aBt3rnNLskjdvZrRuofYVjtjqEqbMc9lEVKzZNlIAQk+1Fu4bq+lJ9p2oPUT6OSohzrSkmBIT2FEOMhR2IHoBNS53A1EyCkT0NJlYEZ+oT7V1nURVLBVIAgjrFHJtlLI/eqSpwRDZMmZ6xRow1CEkRJ9KK4shxI4MOUo/TB9DQ0WETrQT96fnLUJSNKCkigJtCTMTPU7UakqKmhk/s7sYHZI2rKd12qtXJVZQ8n8AcWSNu9CUeZnQeyVz/AEFBXeocVIbJinO0wAKQdRJVEwUKP4MR+tF3WEeGNidukEU3UquguUU6GxdylQ87JB+xpOpbC1ctJ9BR7tnpX5gT7jakzrSW1nSAD2iqm29UGnYmf8NC5BWVdtNJX20rhWkpI9KXuoWoAaPeDQdIgg7DtpigevYNa9xtKQ6ISYP94/8Aegm0WoGNx3G9LXGApMhBT6itG3C2oSoHvPSgbQSGlTamyQAZHpRBQVEnSNfrTg+wtMzIHqRSQsmREgelWQAb+QtLbgMrSU+kVtRGvzUeGS0RvP8AiNDVbrInaT1502qrbKJa6EqwhY5xHQmgKaTpnn7Uo8JTR8wB+xrNZSkyQAfSoa/JFtiVTSdHPf1NA8EnsQevamHMufcAy2UoxLFWWnlnS3bpOt1xXZKEyon0Aqv84fEHiWVWz/Z3DTNmJtRIun8Kuba3iY3UWyqf8u9FGHLSCUl7luKZCUknaOsc6j+cMJGMYM+1pW4CgjSgwrl0rnW6+N7EbAuLxDh87aMpMK8a8dZI+zlumsw3457G+vUMqy2220oiVN4mla0pnclJbHKieLIu0THJGy8fhheYteCj+AXSND2F4peMJUpMawXSsK0n6fqO3pttFJc8stuulxlwpWjrTLwkxOzvsezNeYVdsvYVizjd6gMmSl4p0uA7/wB1JnbnEbVJcbwpuFLdBUT3NC1rZo42m7ZR+eLq4xm1Uy4NZGwJO5qhcd4b3WJXZW1aJSZ3Wof1rp7MlmwyVlLekc5nnVdX+LNtOlAKUCe1YeaeTlSZ6HDjwyjyiqIZkXgYl91L1yS4R+6BVvpyVZ4FYBKUhvblpqQ5ZsWMIwZq+vrxq1Q4kL/aEJ2O459ajmcc+YUHCll5DyeU8wf1qJRThtOy7HJ869iE4/lVjGdaNSVkdxyqos08MCkrHhJJHI9KvLL2Y8KubrQ68kKPIq2FJ+ILZt8NVdhlJtwQPEQrbcwJNJwcsf2uhnKozVNWcsX+Sw6Bb3luQlJ20ipvw3y0zl66aXboWlmQVNpJAX6Gp5Y3FvcJTrYSf8Qk0+WSbRSglCEpUTGyeVdLzJvVCf8ApMT2x1s7RrHLplCbNthAjyhO/wCa6n4K5abw6xJUQywPMVKMCaoPKeDLacQ7IVBmas/Hc7XuDZNvGrVOh9bKm0AbEyIketOeLkc39aMnyYRjKosoDIGWlcQuLucV3TPiZexfF7vXakaZbS6RpkbkkpJnnE9K7Rs7D5VltCW0wlISIHIdqofgrhOXsl2GBf2nfs2lxbWZs7f5x9KC7JClKgwFLkc+cHbarSxXjdw9y474OJZ1wKyc/wDLexBpKh9iqr5x+q0hDJK0kkS8256A+9Gos4SD9R/vUyZa4l5TzaCcFzHheKgc/k7xDpHvpJqUoUlcaSFjvM1V9XwLJCEWSCrzJH5rPASo7JJinAIGrv6TShLCVAao9hyqba6DGg25AP7OfetItVKHb7U9/KT9Ike1HN2QQkHr78qhzfuQ0MjViU7wTR/yKlDdIHrTzoE8hNbDQjZJ351CyMikMQw/SZ0ifzShizJiQAPanlNuORTPuTQlNJQnfl2moeWgqG9Ns0k7yfcUpToaRIRt6CjR4QMqIA96GEt6Y2T11CoT5bIpITLLkfsxAPUigCwUoaiBM/URFBxLM2DYO2V32J2lmgban30oH6mqzzx8R2V8tNlNniLWKvkHS3ZrC0yP4liQn7mro45T+1WT12Wi3bqKvNzFHItyo7mftXHd18amPpBcNngGHIC4CHrxy6WpP2DYSeX8VLB8dNvbJBfsLK5Mb+HeqbBP/oNPR8LO1fEpeWCe2ditNBuBtSlDbap1gf5jFcs5Y+O3ILrTf9rJvMOeVutTTrly0g+4AP8A7atnL3xCZAzgpsYTnDCbp9cRbC6QHJPIFJMg+lKTw5IOpRLFJPotE2wP0gafSgLZCtkpJI60y22ZGriPDuGVJPXVIP4NL28XShYCU6if3kLEfzmqkSKV2S0p1adu5FJvknHlGJP3ApSrFWyYMqUehVR3jOKAIQhKDzUowfttRJtdM6hvFiQYKo9DWnbMto67+lK1Eq2AH+Kgqtyv6gTHXvRJsgalsidgNVYlokArARHanBxkaY0AHuDyotNuoqhSjA9JFWqvcqkkJg3qE6gPx/pWUv8ABA2BT9xWVZyQFlsM2zTLSW0IASkQBTHmBhpuCG4nsNqkvSkGIsqeRpCQfemou3TByxUVyK+vGUqM6Aj15zTc5ZDVIAFS26wwpUfIY9TTbcWhQIiB7RQzhREJqQwLsw4Non8UhestSiNI9wKfnbfTvtSNxGnlG/YUrLQymhketlJACdQPpRPhKY3/AJg09/TI3PtSZ5QWd0TFUNbsL9DRcJDnmMk/gUQGFEgpSUj7xTq+y2qDpEnmZoKWUEbAR6GatjNoHi32NZa7wfWtQTI5inJVuArYD7mnLAMsO45e+E2FIbG7jqUyEjbbnzPSrOb9geNBGUsov5lvlJhTNm2kKXcFOxM7JSOvXfpt3pu41/D09nZWD2+F5ov8q4WzrViDlmoeLcgxpSkn6SIVudtxsavTCMKtsEsG7S0ZSyy2NkpEDuT+ahWfL5zUopXCU+u1XdK2A0myl8s8BMm8OXVOZcw1DeJL2exa6Pj3jvclxcnfsIHpVtu4u1b4W0hcE6YNQoYuVuEAx+lJc0Yx4Ns2jxIOnlzpdZU2W8UKsUurNx/XpRMzIFMmZssZWzxhK7PG8BwzF2VCNF9ZtupP2UDTFbX6rl7Skk+9O6lraSkBIE1yyyUtEcLK/wAq8Hcq8NMTvLzLdq9h5uyA/a/MLWyImChKydHsmBTtj7iPAVJkx0NIOKvFfLXCvLz+K5gvhbtoTKWmxqdcMxCE8yd6jeBZ+w3PWBWuK4e4V2t00HWyo7wRImmOcvcuxxojmOWr94paEHmdhNQXEMmqVc/tFaFncdalWas1HBFOKSEq7RvVRYhxQuhiRX4Fy+kHfw0zVLxxm7ZrYpyiqQPP3D/E8ZYaZVi9y22jdKWnFJ2+1Vzi+BYtgLHgIdXdJHJbiyVfmphmLjhdt282WBPOADzLuARH2iqzxPjBcYupQurZtlI6IEV04Pj9KGF9b+piVWGZrdcDluoN77b1YeC32ZrrLrmE4isKYc0lcbTBBH6gVXFhxmXaXPhG1QpqeZJmKm1hxWwi8Z8rvy1x/wCWv/Ws5wzPuJb/AOOD7HDwLq0IRpOnvFSPLVtrdSSSTM86ZcPzbbXbZC9K1HkRvUjy5dpS7qIGk9ZpPg07SGlkjJFv5Xc+VtgpQER13NQfjbxMXgeAuJtLhli5UtLbanvpJPejL3OjGF2K1BzSAIrjXj7xEXnHHPBbc1WdvqSIOyiYk/pTeGOTIY3kuEffZ3DiHCXLuaco2eJ41aX2KYyiwBIbuXSArTqKG2wdO52G3aoLkH/Z24hjjVtieb8yJwxTo8RWG2FuHFNAkkJLqjpJAgbJ5zuabPg++JAZ2XaZUzG6hWNYe3qtLlZj5pInc91pB+43rsd3NiLUISm4SCsgADfetSDljX1Mx2+XRVOEfA3w/wAuFt+6xTF79Lf/AElLaa1/50ISse6SKmiPhrw/GLdCcGxHHcuqb/5blvirziVDspK1Hb2g+tS61vXrp9JUorPQdKmGFXAsYduHFKc5hIOwpeXku7shxOXrrCePPD7N6sIwnCMezFayC3cthD1s6n1cdUNB6EEj77Grv4fXPGPEAP8AeDh81aNHbyYmz45/yAlP/uq3MKxy+xZwNtKKGv4qlVrYEJA8ZTiup1cqlZVlVUAk4kNZwzEmrdtV7Yv4etW/hP6SofdJI/Boz5XQOQB7RVpowxOJWAbeWokCATvUOxfCDhd0GnD9W6f7wpWcJx37FkZX2MCWdSZ2J7dq2LYzuCPtTqi3A3ABHYUC4JbSVHlHWqfUd7RYlY3PQygSCRUFz1xWwLIdku6xi/tbBhP7z7wTUG4/8anMoWL9th6Lh+508mQEJHPmo/03rzI4t8TsYzljDy713WsKKRqUVFInlJqyEFkZbwpXI6+4of7RHDsHvXbLK+FrxVUbXji9LIPpvqP4HvXNeefi94mZ9uNBzNd4HY9bfCT4Grfqsef8KFUQW3FmSSSe1YpDjSCVOafQmtKHjpK0rKXJJ6JLf5waXcuv3LTuLXrm67vEnlXCyfdZJ5+tNGJ8ScZvJaN040zEBtBhMdoqOvuELkuBQ9DSe6eSAkQN+tNqbhqJXKHLseVY/crQNby1e6qMZzDchvSVKUJ5zUdAUsjTR2hYGygD2rnlmVqCQ/Kxx0pnWQO01ltmB9l0KbdWggyDTGw84kFJTrV70YHvNLiik9hQvK5dsJQRa2X+OubMGKUtZixJCRsE/NuFI9hMCrPyx8X+dMvLSpOM3F4nqi4WVp/WuVlvFLmorkelOVjiMp0+ZI7mpUieMV7He+SPj+vFXbdvjuDOeEY/4uzeEDvqSYI+010zw4+KjKubSy01iCPFUAAy455x9iZNeR9piCrNAJMoVy3p+tc4XmDtB+ydXbujcKbMEVVNKXQfFVo9yMHx6xxZhLluQ4k9QrlTz4SVJmD7k15IcFPjcxjK9zb2WNuuPW6Vf89tZQenMDYivRrhXxlwjP8AhbFzb3TSy4kEFKgpJ+4paUJR6AT9iz1NDc+UJ6HaaSuCFCDPrFKG7ht36VAz0it+AVkkAGl7Z2hAppZVsaylardUnyn7isqPVX/5Mii2K0pOoRW6ytEu7CVsJUIImm+6wdt4HSAme9O1agUXJlLxr2IlcYGtOxTIHYc6a7jCHGiqGymelWApAUINJn7Rt0QoVDSZFOPZXD+GmIUkDvJMmm57DlCQkxPpyqwrnAwuSE6vamt/BtM+VR9CKXlBk8kQdWGrRuVhXcUE4ctI1JHl9Klb+DkSUpJ/WlGGZTXeKC1qLbQO571Wo3qJyaI1g+WrrF7lKWwkNz51qOyR/rVk2FhZ5es0sMpCNgVLgBSzESY60stbViwYDbLYQgdqhuK5i8fEHWm3BCDpKQeXvTmOHFbK5O9EmZxEOKc2OwmZ2qss4YjrU8NW0naakthiQLV2QoFSESQedVE/mAYu86qRoV67VGV60TGLTEtpcl++CPpE8jtNN+bHi9eFIUYAgwaHhinDjbjYQnwUtlZWFbzOwj871BeKWfbHI+FXeLYgXBbsiVBtJUf0FZ6i09F7aW2SzBmQhxJWoJQOpqhviZ+L7DOGzjmCZWNvjOYUHQ6oKlq15bqIHmV/dkep70PxW+KTH872Rw7A7gYLhrhkraX+2eT2J6faufMRZeU6t1epa1GStzck1p4fHf3SFMmddRBZ9zvj/ETGDieYcQdxC6UTo1qJDYPRI5JHoKnnB3jk7wtQixvlLXhDqpKEmS2T1AqqCIfHiDzUgzC94yQlWwA51pOCSK8eVqVo9Clu2OcMOReWdyi6ZcTqStB2NNdlZ2+GrUHGUe53muI+FnHfG+Fd4W2VfOYWtepdq4rkeRKex2rrXKHFnLnEaxTcWt0EXBQFOMObLSeorLnad0egw5oz1ILzreWam1ltoIJ28lUPjwKblZTapdk9U10FjLeF+AtxRLi+iQJB+/Sqyx/5FTpKWw2OwFKZcnJVKzSxySf0kDwmybuHpNk0j3SKmeF5dwlKStdq0pwiCqBI/SirJFotwaVaewpxfuLW0RrW4Egb7kUinK/pLZS+WaTl9Fo6FsEhvn0NLrnNjWD2iy84G0tiSdhVf5v4v2eFMlq3SXVjYaTVGZpz5iWZbhQceWlqdm0namIYMk9yZnZvJilxiyxM/cYnsddXZ2Tqvl5grnnVc4iXHgHNUzzBpts0qEEwDTyuVWpnn2itKGNRVIxp5HJ2wGXcRvcExa0xGyeNvdWrodbcQYIIr0N+Hzikc/YX47zoU+ylPitCZSoj1/1NeeNq0sonf2qzeCmdMdydmlkYY2/doulBtdq1+929qrzYlKNWBGddnqXgOJK5p8x9elSWyuQ++nVJJNVxk+/S7hTC3BpWUgkEQZqbYJcKVcpMQBXmXB3sYTXsWtg7pbt0NteXuYipNZXgs07kBRqtWMxlhHhtnzdhzqR5fW7fLDjyjoG8GmceVfakA4+5aOAXK1q1FQKVdCaUZksUXtmHNKVLb5HtUYtb8NJGkkAdqk2Evm5QUK1LQoc1VoPlKNAJtMiibMb7b014623bWTrjzobRG5Bin/H1DC3HfGT4TQ3CiRBFcT/GP8UDmUMDuMJwNbSL13yFxSvpTMEj1iaz1F8uLGoptWUv8XXHnDncTvcu5feQ883LdxeJP/LXuCkeoEGfUVxTdtqWta1KLiiZKiZJozFcwO3t448sha1mSonnTf4lxePpCl6UdulbmHC8cbZXPekbdBUnykj0mm+6s7q4ACQoD0qyMvYPZ3ISl1Pm7gTT7dYVbWYCWmUKHcxNHPLXYUMcpdFJjL146R5SR3pxt8purKfE1e0VZzWFXN25pZYB32IFOtrw6xO6UFLHhg+n9KSedp/A9DxHLsrS3yYytI1KUD0A8tODeT7cN+ZfmnlHMe9Wrb8LngB4yyv2FO1rw7YQpOsbClZ+X7RkPY/C+FZSSspsoMNxJ7iinsntKG69LnomK6AdyFaKRqCEg/xEUz4hklgSnR9xSi8qd9/9FkvDUVuP+SjXMkpfkBzUR6ikqsjXSFfsocHoQYq3rnJ3ggltuZ60Vb5eetklUn2O1NryJV2Kf6WLKsXl+7YQGlEoVExzo1mxuwCyolafUVZL9u2AQpsz1JimO/t2NZ0Ce4FXx8iXuBk8VpfSVzc4e5YvqJEAHbfnVm8GuMeN8OcfYusOufDQVJS62SQlSZE7cpjkaiuKNMNDUWlH3ppZQkO6mkwfU05HI2tszcsFH7j2y4F8V7XiRle2vrV1KypI8RIMlBgGD251brLa3UAgCPQxXkZ8JXHB/hnmllF4/pwu6Uhl9SlmEbwkx2BP2kk1615Yu28Yw5m5QFBKkgzG1V5MUltCiabFKrcg/TNZUkt7EraBDYUO6SKylakXUiTVlaot9xxppS0NKeUBshBEn2kgfrWkS3QbWpFNSMQvFuhLmH3TCFGNcNEJ94cJ/SlbN4y6pSAtQWlWkhxBQZ9AQJHqNqGUlHs5NsUlR6UAkmhUEoJ6mqnlfsiHG+zJFEPthzaB96NU3I5mfemvEMVbwxK3b1ly1tECVXTrjYbBmAPqmSfSqZZJP2I4h7eGoDwWsykchSx5xLSJKggCoVh2MO4zmBNwhTrdu0ChLZPlO/1Hfc7UZj2Z0OYgLRuJAk09jikkVy6ok1zdBNm8sGQEneKpF7F1N4w6pY8NPiK8uqZE89/5Vabt2tvBnCTII51SOYbom9cOvUJosr4rQEIu9k+srxK7C6UnzDQTAFUfbXPya0pGpAO4CwARPTYCp/l/Mzabd23WdKykwoDaqxx24NriClOLKhqJKhVHJSRbTTJ7ldxN9h968lKv2ay3qI5mATHpvUQxPDvm7tWrzyYg1YPDloX+SnrpA8TxFrKWkQAI2An1id+pO+1N7mFReEkBO/I86rcORHZHrXhPlzGrBbWKYDh9+h0Qtu5tkLSoeoI3qtM+/B5w8xFtasPyvZ4U4qSVYcjwNR9QmAfvXS9ilu2YSmATHU062uDt4g0s6em1aWDI4RoSyw5M8juM3wyIyAlx+wuLpTYJOi4CVR6SAI+9cz46w60tTbhhQ6169fEXkW3xGydStCVFMqRKRIVBAP615+WvCOwx/iMnC7/xEW1wHQkoOhWsJJTuRy2NBky296GsONy0jmQ2qnVQTM9q6BtOAGLYVw/sMx2a3La6U0l1bazE7SQnbnQM18C7TI+bsEcuLlb+E3FzLraEypKUkEpk/VO0+/2rupeFYZmbKqLZnw/D8MBLekApEbDccxSs5yfWxvhwdM8/rDiFjOHpDN0XFpGxCgQfzS24zgi5AWUGTzCxVq5x4X3WXsQd+ZtUP26lSlRTO1M7OUsKd2XhbLhI5aimPwRVNhPJSKwfzW8J8JAQO4pkv8XxDElhgOurLhgNoJ3PtXRWW+Dycz3ibTC8BRd3JH0wdI9VK5D710RkL4XbfJ2GW19iLVqrF1pBWi3b/ZNHsknc9pMTHIVfjx8mDLyZJdnnRnjhRj+WcstY3ilqu0tHXEtJLn1ajMD9DVbnD9JmY716UfGzw+dw34f73EFpbS3b3tsWyUk6lqXpj02JP2rz1TaJD4QtI1KISBuZNP8AGEV0xb1HMKwnDQ7CwTA5wJqUWWV77EylNraOPA9QKtTLHDZywytaG6tkpuLvzFHVInb9N6vDKvDlu2wttQaAhO+1Zs/JUJVROvc5cw/hTfhaDdDwkk/8tO5ronhHwxRg1zZONspaGyyopkmpZb5IYuMRbhGwNWELX+wWEvJbSooTsCIpfJneXSCS+CX4Pa/LtpM7DpUysHnA0nSAFGoxkMrzJYfPLRobBICZ5kfpU+wzCJb1q2SOhpKXjyjtBWhbhTMELdA9e9P/APvKlpCWLcaEjYx1qKXFypbngsDbkadMIwRxS0kgkmluEoug7RM8JxB+6WhI3HryqeYZiyMEaQHVyOieZNQa0fawNjzAF6Nt9qTt424t9Ty1FW2yRTuGl2wGvgW8Y8fF5ly9u1LFq1aMLdWSY8qUkmfsDXiLxq4rK4jZpfxFh0qsl7sAp0kJO8Ee9ehfx1cZrnKPDn5Kwfb+exG4SwQTBQ1BKz2MgaY9Z6V5TXzyS+UtphI2CTyA7CtCEU3ZCk1oA9ey5BO3en7L9qu8fSAox0qN+GHHtMBPtU4yXh7t7dtoSRExTPYcFZY+AZdV+y8qpPUb1Z+B8PGrltK7loH0NOGQ8sJbtWlONhagNlGTVjWlihpP7QEn93oKWyx0auKDT0RO0yda2KBoaSgdAE0qRhjbaVeXVFS0W4DZJRJ6EmkjrISDB39aw8vvZ6HHxqqI0u20RCDHSKJDaVGOp7U63NupRJCiCecUj+VS0ZTz6kmZpFxj2mORdLSEC20/SqD6EUju2ErRCYT6U6O263N0wR2ra7NSkTOmByA51UuV2iqde6I07YjT5iAB0AG9IbmyQ6AfDge9SB21glO6leu1ILi2UtEISpJ6k0Tm26ohYsclZCMYwTxArSEyeQ/71XOPYc9aObyCDvHKrjv2lAQBqI9KZ7vDG30EqRKjzmmsUpRdSehfJjSWioUsIu2oWmT2Jpv+RTbXU6fIfzVh4nlldqoutlGk9qhWLMqauFBTcjuJFbWGT9jz/kYn8DphLDSVKU0vSkjcHpXq5/s8OLqOIHDm3wTE7xu5x/BmxbXCSTrWgCG3DMyVJE8+c15B2eIu21wNK0gTyG9Xj8OPG+84H8RLLM9o5qs1vMt4sx0XbAqBV28msq9Yp/m62Yc4qD6Pc3wE/wAIrKQ4DjVvj+D2mI2zqXre5bS4hxBlKgRIIrKV9WBYkOtZRaVUMKq2ORSRbRutRW6yrOyDUVkVukt/iLGHMlx5ekAchzNdSODbm5as2FvPOJaaQCpSlGAAKqTNmM/7wX4UwEtWOrUgJ28Yx9a9tz235VUvxRcOM08VMZwfMuWsxX1i9gkqYwldwpuzWoSfEKUwS5yEqkRtFQPhn8TancYTlnO9urBsw2oQlxl9JRqnkobkEH0J9KlxB5WdaZfYNhhrlwYSQnmdqri4xkOZgW7KStR0lYG5AJgfqfzU0vcyW7mU/Ft39SFp2KeRql14utnESVKABVudqhzUegKstzHMfSzgmyiDHOap/EsY8Z1UkEzzBqTYniXzuEBIUSI5EzVdXTxaWqVb9qrySbRMdC9OKKbWFJ5jvUX4h3xXhT960SpTCFOKQj6iAJilhudJmduxpmxi7SptUT5tuVBBpHOn7l2fDliKcV4UYE/qGu5tEukDb6pPL2IqS4jZFp9Rge0VDuC1ynDcv4fajSQhpKSRCZ23MVZWKtpcRrjaOQNaSxKULQm24yojzK1qWEEbDvU+y/bpNjqUjmOdQVhoeONII35VYmBJAsRqBG1Big72RNtbKQ45WSXmnRpJTB5CuGsUy8zh3FvLq1M6C9dOJQ4AAAotOc9uokfeu9uMrSnEuQjUIPM1xnxPtkYbiuC4i6EoatsTZcU4s7JklPXlOqPvWb5jjCX1D3jSbaKx+IVlkWlm2zLl3bXSvE5+QRynvMbVbfw5ZwtMxZet8OvNPz7SAkg8z6zUW472CVYNeLTbJK23EL8QJ30kiTP3qH8J8NcuL9hbKi29I0rRzFVqaUVJDfk7d6O2brh5YYvgikvsoWe+1U7f/Cxe43mK3GEaWcNeUoXF04sJ+WGk+YD97faKlWb/AIicucDOHrd7nC7L968fDs8MtjquLlXoJ2T3J2A7nauFePfxpZ7z7aHCsJxZvLOXlI8NOE4IPCSlH8KnfrV2lOgH+Gm4cZ7aM/a6Z6DJ4hcEfhdwpWF3GY7FzFmm0m6baWLi9fVH1KbRKt9+gAnoK544jf7S3A7nE0jLOUr+4QiQHMQcQ0n30JJ7DnvXCWCWrreAqvHyoqeUdJV19aWWWXbpDKbpSTLp8iVD6vaiyZVFaLcWBZHsuHi18VGePiBwd3LmIM2lngDi0PLs7VoylSDKSXCZO/tUd4K8MXM85zDpZK8LwtaFvLP76+id+3P8UmwjLV6VWeGWFqbnGMRcSyy0kGQVGCpXZImSegrtTh7w0s+GOTrbCWlJfuYKri4UBqdcO6jt06AdABWZPy9Umx7LijiVJ7IrcZZL+O2bSApbaFDdIAEDoZq0W8K+WtEI0wkCiMFwVKsQQSjkald/beEQkAis/wBaUvcVW+yOWOEIXeJVpB35jamniddKwuwP/l6DsgSeXSp/hljqUVQAAOZqAcYbc3GCOpCiNB8Q6TvtTuFSe2C0iacBXEq4f4W1bqcKVtBf7USvcT5vXferZLDpbRbtSVq5xVU/CBhL3/hPYX1wSpTrtwtOtRUUpLy9Ik7xEenaugsJskqcLg5itlQ5RFG2mI8GymizQl58Ss7709vvNWbXkAmOgo2+uPBSANlHtzplxhSbexU6sbkb1XLHxXR0J26GW/xOXlFSgN+oNRrMOcRgzCng4mGwTEzTTjGJuOvKCFQn0FUjxtxe5w/Lt4tt5SApBBXHpWNf10h5RVdnKnxZ8Y1cRM4XRQ8V2zB8NDaVSkKEgn3mRXNa7knV5vzUgzfiKrrEnSlRWNR3qJvObmSY7RW5jVIqasPTcEkDVz9aujgnhjmKX7LaZUuZO3SqLtlKU8lKRMnlXUvw/wCHJwbD14k4ys3B2TttFHw9w4OmdYZXyim3wpoLISoJ6kUXfXNnhzpbduEFQPcGKrHFuJmP3Fmu3sLJSkxEzEfeqVzTdZ1xG6WvQUf4iJqnJFGlCcl+TrJWPWKkCHm1J5A6hTXe4tbhZlSQB2rjJV9nGychdy80gcxrMUrts85nsnUzdqdSP3VmQf61nTxcvc0cfkyWnA6ru8WYKoKwZ3EU3LxdKnISry+tUdh/EXE7lP8AxbSZ7oECpLh+Z3Hm0qK1b+k0pPx2ty/7NOOdtfSWW1iSGyorVHaNwaG5i7awNKgAOtV3eY8sJlSwB6CmtecUMAySqOiutULEn0XepKtlm3eLteFIJAHWmd7ElOiQoaT6xVV4nxIXbpUEALUeQg7VEMS4i41dqKGZSB2FEvD9T2QtPy8ePT3/AEXwXGQr9s4ADy3opZtXFAeOke5rnRzHczXmyA6qe2wo5t7H7VYW74yf81d/ouD7QtLzHL7YOv0dGIwpm7AQ0ErJ5magfEjIdxhtuq6S0S1E6inam7I3ETEbK4aadaU8EnzSkzFdgZTw7A+K3D1du/b6LgoIOoE79N//AJ705DE4mbm8iM9U0zzutrnTcaXUgKBiakbbgabICglLiYUPQ0HidkR/JWab7DrhBR4bh0AbHTO1RZzFkW7IaUFCOR51o0mtmRL8s9O/g8+LZrCOCllguN3inrrCLp2yQ94n1tAJWiR0gL0/5ayvNnC79xdoCm6DYnlqI/rWVlSxpydP/r/2V2/g+j8GjByolJowKqcGRPsvaBg0KgVsKrUjNAUCqCY9kvEF4nc36cVcubIpBTZuJ3bO8wqdxy2jaOZ6TrUKhHF7ida8Lsou4ittV1iT58CwskCVPvEbeyUiVKPRINXKSfQLVjEXE24/aDy+o2qneN/BHAOMdhLqVWOKMwq3xG3hLzagZAnqmeaTsd6Zcm8ZLqzYasMw3hvH1rWpV3y5qJAiekx15VODjbT4Dts8laFcikzVnKgHFrtHMdjxdzN8Oy0ZLz9Z3FxgiV6bDMbSSpp5JAhKzzQoGRB95O5qxMs5tw7OLXzeHXjdyyTspKxse21T7OeG4XmrBnrDF7Rq+tX06VtPI1BQ+9cr5x+HLEsoXb2KcNsZVgi9RcOHukllZ7A9PvP2pXLHn0wotVs6cavA3ZqStwKgVDcTu0qdUUTsfq6VzY38RudsgtfL58yxcMp1aBeMGWo5AyJBn3FTLBOPWUszNpS1ijTTxElt/wDZkfmqG5QVMJK9xLQXdpA8yt+9RjOOZLDA8JuL28f8G3YQVrXPIf1ov+3La7bSpl1DqSNi2oEVNOA/CNnjlnBy9xRtp3KWXbttT7aka/nbxMLS0Dy0I2K+swnvUzyQxx5MFfVok3D+7usuO2ljiM292thu5+XXIcbQsSnUI57Efar1tLpN/Yjbp2E1VvxP4E7ljPWWcz2iALO4bVh9wkbHxBqW0qeQEeIn/MKl+TsY+ZsUSdUgetaHhZ1ngL5YOOx7t7MB8GCN+VTvC2ibUQjpzUYqNtAOaSFRPrzqSWLgSyEyY96fUGhSck0VfxasitpZ5ACuPeNWGuKybjJZbQ+40yp5CVgEakeYc9uaRXbXEmzTcW6zyMbVzFnnLyL6yv7Rwyl9pbZKTuJBG3asfzsdysd8R9UVLmm4bzBke7uVuC4+ew0qSpCuaiiU+h3j9KqLAOIVjwjyReY1dw/dMo029vq8zjhHlT+evQTT+3id3hHB3BLV9tJxSwaVZLsAVBaEolKdXI8kj7muOOIuY766LOGPuOFlgydf1KVykwOfP81Vix3FGhnxyW5IaM8cQMZ4i5juMax67Xe4g8Y1HZLaeiEDklI9KjiVqLkETPIE7ULxIOwEetHWVou9uEpaQVmeQE090qFFFydIsrLaDjqrCxaTDVugFQPInrVsZbwA4qtV9eLYtcOs5TqdVAEDcn0qB8OfHwtAtF2SrfxlQu6MylPtVoOYC1nO8wXLuGFbeDpvrU3z8HdoOArn7AnfnFY/kPnLgvc3cOGXjYnlnGv2XH8NvDC6fevs/YphT7dw+2LXDGnmilVvbjdS9Pdw9ewHervYwO8xBZcLKwnoFpKf51089b2uF5JebQ23aeI3oTpQBpkQI6VU2JXItUaVK0pA/eOxqJ+JGEe7MWeV5pW0RLCcvrtXQ67DYHSJpXiVmw4sKLwAHQ8zTFmDiFhmESl69Q2OxVTHb8R8HxVfhs37KnDylW5qiOKC9guEkrolVzeIsGilnYkfVVWcRHnMUwm/t23FB55tSEKABIURAMHn7VMXb/5gQFBQ9KhObGwoKAHOm6iumBSLy+Fa7t8V4E5RVbqBU3aqYdJTpKnEOKSs/cgn71eNnarQ0NJE9p3rmP4NMYDGVsbwJ5Qt0YXirvgtKTo/ZOgOBXYgqUvcdu81PeJvxI2GUsVGWct2Duas3OplGF2I1FsctTigDoTPUivRYYxlBGdk5KVosq/vGre7HzK0tJH7zioFU3xq+IzJ+UmlWi8XZeuUCPAtla1D3AMD80zK+H3idxti94gZjXlbCnYUMFwZwFUfwrdKZO2xA/NTHJ3wu8OOE7AGF4FZuPJlRfebC3FE8ySapy4m1rQUM0brs5wueNmbM0p0ZYyLiSrdwBSMRvoQhSf4gORH3n0rn74gMzZ+w6wNrmS6tUs3RK2ra1MwkHqYG/pvXofnDHbfCLC5W0whDaEnSEJgCvLr4ks+O5hzQ5bKUVt2UtBaju4e57mko44xHVNy/BRN9eLcdUs7An3pruHA4JBg9aWPOHUTG3YU3vLlX0hNWkjrgFt8xiFs2mCVrA39679yfkxOXch2T6UpccW0FJSB6dZ6zNcL5BQLjMlgg6VDxU7KEjnXpHlG3Rd5PZbKtSEp21DeKCVpaQxgSlLZReZ835ksw43h+F61/wB0f/BVb4nmjNF20+5iFynCw2JgshSjv0BIrp3Ew1bLISEx6Deq+zthNpjNufFtWyO8QTSyyx6kjayeNOa10clX/EXHFPqQu6DsGNxE0e1mPElIQ683KFfvJAqwMZ4Z2qbpTrVorV0BrMP4f3V2sNfKkp7RVUskHpRF/Qyx/wB4w4Hiz908gJQtQJ6VfeUMo3GI4Um48BZa5FQ6GmTKXDK7tHkBNr4fY6a6Ey3gtxheChtfmSBySnYUcVFK6GcKknTdlO43k5bLR8pIHYiqqzXYO2ZUBMj1NdR47aNhtShp1HmQKp3PGGJuQ4CRJ6GsWWdxnTNlYlxs5+u7h0E+LIE7bUQrMDtmrW3bBcDmdx/OpxiWVXllKfDKkEc4psOU/BUUKYTB7k1oQyQStmPnx5G6iRxvipfpTobt2dQ25RTmxn3E7xtKnbFGkdU9aCciWzlyVhso36bin6xycvWgIalHdRArp5cDXQtDB5C3yr+zMFzoHLhKVWQCp3I2ium/h94pKwDGW7J4arG6hMKAASqdveZqoMDyo00lJNsgnqDU+y3ggtX21pTGkyAE70lyhf0F7wTmvq2Pvxn5AtG7mzzOw0G1X/7N4oTqClpSAnlsBpSa45vVNsk62UK7HlNejuLP2/Evg5fs3jQS9arUhGsEGUxCpjlv68q898+YJ8ji1wltopSlRgRFPYmmtmZkxxi2iJqvgFEJQtsfwgzWUStspVupIPasq30l8CDir7Z9NCdqGDRQNCBrBxZKWhpoMCq3qoE1n3p1ZmgKC8RxO2wjDrm+vHkW9pbNqdddWYCEpEkn7VwZxP4p3fEjM1xmG5SpjD0Dw8HtXFE+CwRu4UzAWuTO3KBJHK1/iv4qN3l4zkLDriUICbvGVtnyhIILduduayJI7Ad65IzbmRJcWNWiOiTyrTwzqPOTLMeNyZvHswF0KhWoz1O34pPlvjJiGULkBDinrYHzMK5faeVVximOF95el2PYc6YrvFiuElUkDvVeTynelZtRwxnHaOt8K4/YPmkIZW6LC4PlDb6gNR7Dfenc4r8z5kuakdK4XevVtq1IJmZkEg0/YLxXx/A1NoYvnFtiJbcOoe29BHO5vcRLJ4Sv6GdeYi6xeo8O5Ybfb/hWgKH61WGb+AWR81MrdVhbOHOkqcW/ZpDRnmVHaPXlUfwv4hUNWJdxLD1gJG5YJUpXolMSSew3rtThF8ON9mLLVnjucbJqwublKH2MAuh4oYGoFJuYIC1Rv4Y2EwSemjjdLlEy8uFwdSOXeE3+z7x7O1/YXDWc8fwPJanAu5fLgbuX2x+5bkJEav4zsByCunoHlu0ytwhy5Z5cwTCLrDsJsk6G27a0ddBPNSlLglalEklSiSSSSZqdtWvhNIRsNKQPInSPsOgoi/LrNk+u2bD1ylBLba1aUqVGwJgwCesVkZ8Pk+RO5QX/ACkApRxquRXOf7nAOJGW7rALhq7dFwjUnTbrGhQ3SrVEJIIkSZqmsjXN1gty9hV44A/Zr8JYSQVRGxI6SIMetdS2inzaI+cDYuCPOlkEoB7Anc++32rnfidZf2dxTVctNJQ3d2idSkpiVpURv3MEfin/AOPw58OTcKX7sWy5ccl9xP8ACr4OpTKj77ipGxdhoRJNV9l66UtoEyAO9SYX2pOxJ7kbV6mrM39B2PLF2wpJSeXfaqTzhgKvEcWlEirau73ShW8g9zNQnHil5KgFJUf1pTyfH9WOhnDmUHs54/8ACyxxfEb/AMZpSVKcnz8lSAZG56k9uXLv51/FplZGSuOGNYU22W2koaeQD1CkA7fy+1d3fFxdY9lzKtjj+Xry6tH8KvEu3abZZT4luoFKioD6gklJ5HlXnTxrzhimd82jGcXf+bvFsJZ8Uxq0JmB+tZGPxcuJ23aPT5f5V+TgWBrSII2nWvypM11PwE4LMv4VaYjiQSh+5T4nhOeUoT0/Ig1yoHdxzT9qmdpmrGsXLTL2I3T4ACUpLytIHICOVUeVinmjxjKirwfKXiZfVq2ujuLMmBZRyjgjq2lW97iIASi3bKVKJJiSJ5DmfQUf8NORRjmPpefbSELuEJCikEBYlQIB5ERI9vaqO4e5XewrCw9cyq6fgkK3AHT+ddU8DrhWX2GSkBJS54nfnsY7bUjgwRwSSk+THP5H+UzeeuMpa+DrvOmLWtjl8W1xofSkAlKwFbjcHfrIBrjXjdx+aw1VzbWi1oCAQu4mNJnl710Bm7MCcTwhZQolZTzI5V548VsBxS5wrEMPcaT8x4xeUrbUsySYjvPKtWf1IyPHiuWyOYnxdxPHrx9NopZamfGe3JpBlTiTeXOPow/EFttodXoTdxHhnuY6VD8NbviwuxW06yZmBPPuRU34f8Kbi9uPnLhRSVKKW0GNRO28UuoNfg9FKOCELf8A0dKcE8w4piuAOpvVqUWnShoqVqlEA8+fMmp87hxxML1BSinmYpp4fZYdytl+1tFJS4tCBqeMalk7yfzH2qxssYcboLWUAz/dpf7pVf8Ak8/lpSuPRWmaBmrKmAXqcmJQjF8ULVr4yx/ywpenxI5HQFqMGuuvh94RZZ4U5fQxh7Zv8Qf/AGt3il157q7dO5W4s7qM8p5CANhVcPYH4bVutpKWyjsIqwMBz3aZWy89eYo8GmbcQpSolXaB3J2itvw548SakzNzQlk6LdxAhbZUpQQO1VdnzP8AgWVrV5V3ftIWAf2aTqUftVT5+484lmALYwlz5CxMhRmHFD0UCIqgM0XCV+LcqEvubLcJlSvc8zVufyU9QVjXj+DPubpDxx1+KHDDgt1aYXYulwpIDznk/T/WvPPO+NuYzfvXTgAU6sqVPere4vYws3CWEkKB3ISN6ojHroqf0CducCkoty2xjJCENRGonzGSKSOzrJE0og7wZ+1JnHFJVyj1o7b0LUh6ycq4/t+z+WaLz5cToQlJUomeQHevSjg7mIowu2w29KrW98MBTD40qmI5HzfavMrCMSNpfsOgnUhYIKTBB969a/g+zuxxO4cYeMTct728Y1MPN3luHDAJCSTz3TG8U14+JZHV0GsscW2rG7HsprcLjvhpWF9etQq+ykogjTt2NdkXHCPCMWQEvYDZpaUSSuxxR5hXpASAPtMVE8Z4J2TVyhFnh+ONNH6ii8tlhPvrJP4qnyP4mc5cotGvg/lMcVUkcrDIloDqfZSrqOtOWGZftC4AhtEDaO1XnecA2n1qULfM4VMAtPWJPvHKktz8NBuSks32YreE7+I1bK1Hv5U8/YilF/G54sef8j4s19zX9f8A2MOW8sWjSEPKZbXt/CKccZRZMsKQ0AyewgTTjg3Ci5wNG2KYwpCdlJdwN0lXuU0vvMipuUpIeuY/e12DiSf12+9Ny8fJGNUJwz4lPkpFH5kZSlC45E7b1XWM2aVE+IkOE8iZ2/Wujcd4d2iyUOOO6o+rRFR0cJMNvQUqfviB2SkfiRXl8/j5OTdnoo+bhlCr/wAHOL2GJGwA26k0ldwJu8I8iVnrAroh7gZg90+tPi4u0U9U6Qk+0pNKrTgphFqQE296+R++64Af0Apb0nH33/f/AKFn5OG93/g5pdyKhC9baSlB/cUZP6UotMrobWFLBhP7pO36V0yvhVhrrJ//ABSzBgBy4g++1AVw0s0t7YOyByPiPqH8jXRxyf3NAS8rC/ts59Q0hhH/AC1LHfsae8vvOm5SNEAQfMDBq7EcPbJkN+FhOHuJmFh5ZgD02VP3ipZgeWLKzcQWbWxt55lq3T/pTEYY30xPJ5aquLIHmHFX7DhbiAwu2cuL9xsJbSwwXYVPYA/rtXI/xCZdewrE7W6SwLZm5tkuHUYPiSdQiNo8v5rvPOZ/s63dfVcF5ppBcUhCNAAAk9687ePnGVXE3G2jb2ybfDrZJQykL1EyTJ5dduvSr4clPS0Zk25Ju6KcunVqeURpj3NZSV18hZEI/NZWncjO/s+nWtzWqyvHJtdDQKarfjvxVHC/JynLTSvHsQJtsOaWJAcgkuK/uoEqPeAOtT3FMVtMDw64v759FtaW6CtxxZ2AH8/auDOMvEl3OebsTx5111NkpPythaPbFlhBPn09Cskq33iAeVaXi4vVlcukclb0VxmvMjjb90XH3bm5fcU89dPrlbzijKlqI7neOQ6bVT2YswhxxaSuBzKpp1zZmRV044hEe5NVtilxqWS4Ez/EK1J5Yv6UbOGHCO0BvsT8QwpzXG+wimi4xJSvNq1R2VvRNy+uFKSJHed6alXniKiAT686ojCbeloZ9Tiux3av1q2ClK96dMNs1XKiVNwAJKjSHA7A3i0jp6Cl/Ea7vuH2UEYg1blhVy6Gmn5Gx76ef35U9jg0+hHPkVWkdwfAb8LzGZL2x4n5tabNrZrK8BwV1Pm1jYXryTynm2kjl5uor0LSua8f/wDZ8fFMjhJjmL2mZlXV3hGItF7W3+0uF3OoAAg80hIgCQASdjO3pxwu45Zc4tsPLwb5y2caMFjEWPBcVuRITJkbHetBbMDIsu51aLJWqE0mUvvQS6Z3rRX6VYo0ITy8jRWlX/1VGcbkKbzXhi9kJFu4vVpB5KSCCen1D9avJSgRVdcYMDRiWCpdLfiLRII7pOxHt/pTOLUhbtkMy84hxpKgZMfYU5OOFbhKVR3qH5cvEohsGNJgAGpbMpEKArQSTXYcr6E2IvrbElUyORqP3V2VJMrI9BypTjuJptkmVDbrVf4xmRTgWloj7HlS05cdHRxvuym/jZxz+xOAGanmtK3bgMWZJPJLjyEqI9YmvMLHCnEktS6Ekbb13t8cmMOf+Bd6w47s/fWyAFbFagvVA+wJ+1ed7wUs6hO1Jzn8jkLSA3lkLK5SgL17TNWzwLy81juKPXCgFfKgECOp6/pVQuuKKRKpPrXS3wz4Y3bZMvb8pOpy4WSSJgBKR96UnLVoYX5LRwu0ReYnb2y29bSVpJ2kbGavbLVmnD2gW1bRyqvsIym9g99au3QSlx9sPaR+4DyB7GOnrVlWYQ0kQokEVjZbbLlBvaHxWJF1otiQD1qv80cNbLMDqnnX4eJkKBn9KlrgSrzTMetNNzfJ8QjUdukUEZuOnYate9Fc4pwvS6x4Cgz4YI/aJbGo/enbLmWLXL2ktpSpQ6xyqQvvHcpIA9aIStQ5qSJ7datllT6jZYuTX3DzbYip9SWwdh6VbuQMND9ly57yBVO4U0t64SESd+0CuhciMpssJSvSUqjeRE0WKpO6opmKryySvDlpAUSyqdI6/wCoqAcUsrjN3DjFGGA785bJF4yhhQCnHGjrSj7kR96s3DnRfXTjXIL2NMV7dMZexF1DziGm0HckxFNcq7AjpnJmA5n+Ys2iT/zEA6VCSJHLekucHi1YOEGJHM0tzjhVvhXEDHHrB9Fxg92/8zbpSd2SoStHbSFSR6H0qIZ/xlhWHKbGlEJJ1FQFXR4tdmwpvhuJzrxCvnH8TeBOlI2BmaqHElrN0s6iT6irFzJeN3niuI1byfNVaXhSbgxIk0aTRl5NsDrlO6SD3pI+4SqNVK3COU9OdNzypcO1H2UcQ2zH7dJ6zXY/wa8TX8qZgFkt1SG7iANx94BBE/ziuObF3w7toxI1DY10jw6wtFsvD722SErBSpRBnfnVuLJ6U0xjHj9TXZ6yYJm62vcMbcacLUiTpMfpRGI40Ht03pUOupcf0qmeHeYDeYDbJTqRKADKgd436VK2mru9JSCFJ9pFek5KStFz8aCJQcSWpJSi/wBz/fFG22IYq2uGsUdbHopJ/pTPhWVrkv6lgQeQFSNvLCkqGopT6Ez/ACqFBvspeCAFWKZlSCWMT1eimQr/APsBSpnGcxFkB+6YWCNx4ZSR9t/50U9hSGFhWv7pJoCUp1aNe/8AeJrpRXE6PjojOcMQuWk+I8psnuCagis1X6yQ24lKE9BUi4ltOC3UlLpj0JMfaaqa3cW2UgK0rH1KUSJ/WvF+bjXPujb8bx4yVWS26zLiKyEoulAkdESP5iki8ZxHwyl3EF7b6iAP5Gm190eBB1auYIJoy3Y+cZ0KSAsjZSRv+axJRaHl4kF2zHMUvXlhRxJxpEbDxBCv60jfxt1hwlzEVLB2jxKT3uAXrG7DBcMzr3pjxLB8SuD+0sCSf3jRQU/YZXiYWrsldlmBgyXbhZCTAlZM+sD/AEqS4BmO0cdEOLWgfuhMn8k1UTGBYmHwAPDA2807VL8v5cxAvIcU+NCd/wBkeZ9RFXrG+62UZPCx+w+cbM4JtuHeOpt7V4q+UcnfSo+XcAjlI6zXlnmS8U5fOKKinUSQOVeouLy627bX1qH23EFtSVJkLB2gjlXC3xL8HUZExwX+GMOIwa7GpCVSQyveW57QJEz132pjFlipcfcz/J8RRx8odlDlSjyk+tZQfAJO0isrQtfJ5prZ9Q29J8RxK2wiwuL29fRbWluhTjrzioShIEkk+woVzetWTC3n1httAkqJiK4+438a7nPuJfK4dcKtMuWi9TRacUhV4qIJc2HkBmE7g7E9APMePglmdRehxsScWeMd1xIvVvpLlvl23M2Vgf8ArQZD7qdvN2SZCefPlzBn/N/zLi9TylSTzECnrO2cEMNrhxJcMjc71RuYcwKvnVJK0QBsAIFb8+OLHwhr+h7x8Ll9X/wI8VxhRfVqUkgnnTHf4glSwjUQjumkV5cruVHS4CB60Qy6SvSshXYTWfDHL7k/8UbFxUaaFoQH0ftERPJUjcUnawguXI8NEpJiaf8ADsNKk+IsJ3GyQJqQ5fsbS1u27m8RKG1BXg7ArjpPSnlGSp2zNUXlnwxw2SThpwmxnHbV26t20W7DcAOvmAo+gHm+8R61MMUyfh74RZ5pt3cTYYJLaS1qkj+BPMk9BVlZAz/Y4kG2GLJu2EABtvzf0q7+HfBmyzTjVzjuZn3kWzoQ3a2DDaQoJTB1KWd51SYHKB61pYo30xXyG/H1lVNHI3Fj4bnuCOTMP4h32FLwDCEYnatGyef13rniqIBdj9mw2iAdKJUZ8xBkVbHCdGJ4xmPKqcPvnsMdusWtkgNrIIQFa1gnl9CF8+fKu0uJ/DnL/EPhtimWsbaN5g9xbFCvmVFZTCfKsk7ykgGee1cW/Bncv4ri2UGrx1V06i9ulW720vNNIcR4x7A6kbcxqG1PSxQmk62ZuDzZuM4y38dI9EXCDG21BKTzik5dBVAIJH5oLqlK/iHvVaiYM5JthxgkggUw5uaTcYS+39EJNOLq5I1EAUhxNaFWbu8ApPKmIR2gYON7OZ7W+dwvGHW3N0hZAMkzvVi2F+3iFumZBjeq2zPbLRibxIKDrJjUT1p9y1eqSlGpyE8upqY5I8nFGhLHcbFeZcKDqlQo6fXeoNd4FC9uX5qy8TcSq3gLCh7b1F3AUlXlEVXmTsKFJHDv+0duBhXD3KWGJ0zeYmt47bjw24//ANK4LtrR6+8QIUIQnUozG0x/WuuP9pFmA3/FbLeBAJ8LC8JNySk/9R91Ug/5WkfmuVLBa7O2fIVpQ6nQofxCQYP3A/FLSWrZfGSehqUwUOQTqrvr4HOHzeMcMk4tfNqctUXjqW0GNDihEiOe22/r6Vwi4jQ0twq6bAV6z8DMuI4bfDxk/DLuGbpNgm4fSnYhx0lxQPtqj7Vbjiq5IibmtIIzbYtXN4FQlCkmNhJpvP8AwqBrcEAbAGisWx+3cuFlbqdE9TuaYL/MYdUEsgFHasLzYuUriN4YWtjjiWLqLZDa4J22O9MzV+6SoLc39RJpvexFSySBoPU9KJXdIQjUojWaUgpRW0XrG7HZd84UFSW9UdzRTV/rVpKdJ/SmNN64VFKFEj0PKnrDcPLzfiKcKk95qmbfRaoxRMMnvodxNhpSoUpQA8wgmug27xrCsGUp5YaaSndSzArm/LeNW2XsSFyUh5SRsn170pzJnzEMyLIVc+GwP3EEgU1gTSuixYJZXpaJ1mDjW3gji2cLQXXxuHCny1UmbuIOJZofW9d3Ci6f3QSEimu/xFttSkqUJ/iqK4ziYaClhxP2NMSnGKtsdx+PDH+wzEsYNuIUZVEkk1UPEjMvjsqtyvStR2Bp0zJmZKgQlwpSBuSeZqk8zY8cUxJSkuFQRsNNDDJKfS0HmioRvYmxW/U0w4kkBShG1QK+UpT/ADMdhUhxB3USVOET0majl0seMIJ096ejdbMHI7fQI6g3P6k0kJUoyTSl/wAqBB1A96T6qNfgpTNJOlQO+1XhwkzDeobaLKwpLf8A03NxVHlXrT3lfN17la+Q/aqCkgyptXJQoJcq12NePkWOacuj0C4ccbnMNuba0usHcdQqEa2CCZ/zEV07lfiLgZ0G4S9bqiYW2f6V568LeN2EX19a/wBoAWKpEuT5RXa2W7vDsXsbW7sLti9tnEiHWXAsK+4rZ8HPNxrKa2XLhn9qLtHEfKjDCS7irFqD1uT4Q/8AdFOCcasr4A216w6hQkFDkmqwawO2cSCEAKO5JIo1vLFjcHdsKXy3SD/Stz6ZLsSlJLpMsrxx9QUHI7GaZb159bpUGtIn6v8A6qIHIrFudVm87YqO5UwYpJcWmN2RItsUU/HRxRFLzg/9rTOUos1nN9VwlQOokDnNVHc3Atb06WxAMDflVl3TGNvlRuQ4W4+pACxVX5rCrS5UA7CgZ3EGvMefgn20a3hzinS2O9vfB0BCoE8hFGFpTPmAhPcHlVd3WJ4ipJCLhSUn12pqVhl7fqPiYk8esIWoD+cV5t4re2bSTe6LeazOi0IS/coQiYGtYAPpuaNueIGE4Vq+aurdlPULdTVPJy0UArVcrVPNWsVhynbOHUFFxXUrVz/FWxjBLUgJQiy1b7iVlbw/ELwWojmygqP6U2McW7LCrhKrezdfYWNi55J/WoO3gFrZBKlFKQOvL9ajWdeKGH5Ms1hSmn4TsgKBJqYzSdXZVwhD6p9fssXNPFZd6jUygMT0BJIqk+M+enb/ACnc2F0+hxSilQamSOurYbdOu81R+a+NmJYw+54bhtmz9KW1GoDiOP3mKz476lT/ABGmI+PyfJifkfyOGMHDHsA9CXVAKET0rKTJWojv6mspj0/yeSc99Htvmz4gsYz7gKjd4ezgVo+dbdqH1Oq8LSIDitKQTMmAmBtzia55zxnRLbLqW3UyOqdhUizitUOjUYHITXP+eHFSrzH81oelDFD6FQzhhGUhnzHmZd+olT52O5A/7VB8UvwtRKFao5k1rEHFlSgVKI96j92tQZVBP5rz+dc5Wby4wSpBirkPSCsDf92luHo1rTpUIHPao5bKMczUnwL6U05gxLJG37BTScboli8QYwjDFXSwqEjbyySaBlrE7jG7dd6oOBjWWwsglM9pqxOHeEWOK4JcN3tlb3jZCgU3DSVg7diKmeY8Ns8O4YZWatLVi2aDLUIZbCEiUydgOp3p54/ThaYGDyVgtxjsbOD2Zsby5jLYYtWHEvKAL5bGlA9dq7h4acXbO6ul215aFllhCP8AiOilmdUCIgeXeep5RvyLkNtAw7ZKRv0FWjgh8JIQjyJUJKU7AmOdU4cs7uLox/Kis7bybLk+LnjSjLnBduyy/iMYxmt4YVZ3DBBLLSkkvPATyS2COm6hVZfCzimC8NsKx/NOJtvf2ZhTVvhNqbdhbqgpUKc0IQNxHhSeYg8gN6N41qUrOuWGiSWrewdDKCfK3LiZ0jpyHLtXSvwsoSeH+Lo0jQMTWQmNpLTc7VpYcznJKRkyx+jhlHG+zpHJeerDP2Cs4zhBeXZPEhtb7C2VGDB8qwDE9Yp+K3SFELH4qEYM4tm1SG1FAnkkxS9u5dKiC6sieWo1oNK9GI4tdskbjq5TuPxTfiVykWy0D96fppPaLUp7dRPuaSYso6F7nlVlUW4o2ylc3o0Yq6SqATyVyrWApKWC4gk77KEEVmeDF4k9Sqj8J2tttt6ylN+rRpyXGA6quVLYOtIX/ePSmS5eZUSNQJ7U5uqPyp3NRbE1qDgAUQJ71pSbYlFo8sPjNxxvGPiSzqtJKTaus2cDfdtpAP61SiXSm0CpEFRAGrf8VO/iNWpXHziKSST/AG7diSf/ANpqtSd0jpWfNu6sfio1dEgytZHGc1YJYOBKhc3rLQSrkZWBv6V6X5xz6u5bFqkpbZQgIQlAjSAIAjttXm5w42z9l/8A/mt/zFduK87p1eb3rPzOUVSZdCHJ3YqW8XiVLJPaBRLl4pkEDf3oVvzPtTdcrUH0gEgEd6zGmvceSVUhV/aSYPNKvXlSc33juAE6hSJ0nVz60osQDrJAJquTp0dtPY94egLWlVPyWHnkaQQ2j050kwBCQU+Ucu1ON4ojUQSDFWYMcMu2h1KKSdf5CHXGLJBGqVDnNR/EMdDZVpV5fTasuSVayTJnrVW41f3SMxXTabl5LaeSAswNh0pjJjrSZqwbjHRKL/HXHlKSE795moZj2JFMkn3g0+YAkXeIYgHwHgl2E+J5oGgHaah2YCU5nDIMNFoktj6SZ7Ul6Le3IWea5U0VjnbMrja3Grdwgq2MVDGZbQXXCdR5VI88NoTiioSkb9BURvySBvT+OKSpGVnk1OmzVy8XDKoJppuV6nuUD0pUeRpI8YUqnUl0IzdMCtyUgTI9aBFbP0ViNxXNUDZqs50YBsaArnUJ2QnsVYdiTuHPhxuCOqTyNXFw04h3OGP+NhF+5h14SCtDRjUe5HJX3mqSpRh7i2r1lSFqQoKG6TBoWqfIZx5nBnozw1+JjHk2iWMXYbxMpAAdUAlavUxtP2q6ME46YBiJQy6pdg8of9VJKR/m5CuGskurNrbErUTA3mrRw9aioeY8u9afjeTKf0yRoZsqpUjrRzOTF03/AMNcIuERI0mZpIxmRsuBxTZMdjEVz/YvuNoGhxSf8KiKsHLrzjls3rWpW3UzWq1xV2RicZK6LGxniGxhuGrWTpgcxua5uzNnt3FcZceWQUTuCZqb8Q1KThhSCQk8wDtVB3iiH3BJivO/yGST+mzb8fGlHkmTR7M7DgMLGwmCIP8AOstMaQlJU4uEq5SYqAPEhKSNj6Uet1am0ArUR6mvNyfBDayuJO/95mWVaS6haZiEHVWzmN65kMN6B0URFQm2AlJjeaf7tamsICkKKFd0mDVKyN7OWb8DPnfO7WW7F1y7fK3AJ8HVH9Ca5SzhnK6zHiTjzjvkJ8qANhUt4w3DrmIr1uLV18yiaqpdavjQ5LlJnn/5DPKcuC0ga3NR+qRWB4zuJoo86xA3FaFUjCehcnUoAwr81lAkwN+lZUcEyNH/2Q==', '2022-04-18 04:11:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblblotter`
--
ALTER TABLE `tblblotter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbrgy_info`
--
ALTER TABLE `tblbrgy_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblchairmanship`
--
ALTER TABLE `tblchairmanship`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldocuments`
--
ALTER TABLE `tbldocuments`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `tblfpscert`
--
ALTER TABLE `tblfpscert`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblofficials`
--
ALTER TABLE `tblofficials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpayments`
--
ALTER TABLE `tblpayments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpermit`
--
ALTER TABLE `tblpermit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblposition`
--
ALTER TABLE `tblposition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblprecinct`
--
ALTER TABLE `tblprecinct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpurok`
--
ALTER TABLE `tblpurok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblrequest`
--
ALTER TABLE `tblrequest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblresident`
--
ALTER TABLE `tblresident`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_support`
--
ALTER TABLE `tbl_support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblblotter`
--
ALTER TABLE `tblblotter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tblbrgy_info`
--
ALTER TABLE `tblbrgy_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblchairmanship`
--
ALTER TABLE `tblchairmanship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbldocuments`
--
ALTER TABLE `tbldocuments`
  MODIFY `no` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblfpscert`
--
ALTER TABLE `tblfpscert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblofficials`
--
ALTER TABLE `tblofficials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblpayments`
--
ALTER TABLE `tblpayments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblpermit`
--
ALTER TABLE `tblpermit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblposition`
--
ALTER TABLE `tblposition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tblprecinct`
--
ALTER TABLE `tblprecinct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblpurok`
--
ALTER TABLE `tblpurok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblrequest`
--
ALTER TABLE `tblrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblresident`
--
ALTER TABLE `tblresident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `tbl_support`
--
ALTER TABLE `tbl_support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
