-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2015 at 09:54 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cointec`
--

-- --------------------------------------------------------

--
-- Table structure for table `patient_scores`
--

CREATE TABLE IF NOT EXISTS `patient_scores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subtotal1` int(50) NOT NULL,
  `subtotal2` int(50) NOT NULL,
  `subtotal3` int(50) NOT NULL,
  `subtotal4` int(50) NOT NULL,
  `subtotal5` int(50) NOT NULL,
  `total` int(50) NOT NULL,
  `feedback` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `patient_scores`
--

INSERT INTO `patient_scores` (`id`, `username`, `email`, `subtotal1`, `subtotal2`, `subtotal3`, `subtotal4`, `subtotal5`, `total`, `feedback`, `created_at`) VALUES
(67, 'akash', 'akashmudliyar@gmail.com', 5, 5, 0, 0, 0, 10, 'zzzzzzzzzzzzzzzzzzzzzzzz', '2015-08-21 06:54:43'),
(68, 'akash', 'akashmudliyar@gmail.com', 17, 0, 0, 0, 0, 17, 'asdasdasd', '2015-08-21 06:55:19'),
(69, 'prab', 'akashmudliar@asjdhasd.com', 6, 0, 0, 0, 0, 6, 'asdasdas', '2015-08-21 06:55:52'),
(70, 'asdasdasd', '', 15, 0, 0, 0, 0, 15, '', '2015-08-21 19:22:10'),
(71, 'asdasdasd33333', '', 7, 0, 0, 0, 0, 7, '', '2015-08-21 19:30:17'),
(72, 'asdasdasda', 'akashmudliyar@gmail.com', 40, 25, 23, 23, 32, 143, 'asasdasdasdasdas', '2015-08-21 20:09:48');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
