-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 15, 2019 at 08:59 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE IF NOT EXISTS `admin_user` (
  `sno` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `level` varchar(15) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `time_date` date NOT NULL,
  `response` varchar(10) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`sno`, `name`, `gender`, `contact`, `address`, `photo`, `level`, `pass`, `time_date`, `response`) VALUES
(1, 'vinay', 'male', '8860923637', 'rakhi market zakhiar', '11165091_1772229369664786_4391739695489831661_n.jpg', 'Teacher', 'vinay', '2019-11-13', 'active'),
(7, 'superadmin', 'male', '9015263621', 'moti nagar', '12310533_193280041015357_2798111291783759647_n.jpg', 'superadmin', 'superadmin@admin', '2019-11-14', 'active'),
(8, 'sanjay', 'male', '9201234252', 'ramesh nagar', '480px-Marshall_Law_-_CG_Art_Image_-_Tekken_6_B.jpg', 'Teacher', 'sanjay@kumar', '2019-11-14', 'active'),
(9, 'vinod', 'male', '4562353622', 'rakhi market zakhira', '12524068_1695138377398999_7292198990187762788_n.jpg', 'Student', 'vinod@kumar', '2019-11-14', 'active');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
