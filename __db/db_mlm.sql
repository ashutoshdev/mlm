-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 06, 2014 at 06:27 PM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_mlm`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_transaction_details`
--

CREATE TABLE IF NOT EXISTS `company_transaction_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `item_id` varchar(200) NOT NULL,
  `stock_debit` int(11) NOT NULL,
  `stock_credit` int(11) NOT NULL,
  `item_unit_price` double NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`id`,`transaction_id`,`transaction_date`),
  KEY `item_id` (`item_id`),
  KEY `transaction_id` (`transaction_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `company_transaction_master`
--

CREATE TABLE IF NOT EXISTS `company_transaction_master` (
  `transaction_id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `head_account_id` int(11) NOT NULL,
  `client_account_id` int(11) NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`transaction_id`,`transaction_date`,`head_account_id`,`client_account_id`),
  KEY `head_account_id` (`head_account_id`),
  KEY `client_account_id` (`client_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_master`
--

CREATE TABLE IF NOT EXISTS `item_master` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_category` enum('PRODUCT','PIN') NOT NULL,
  `item_name` text NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `item_master`
--

INSERT INTO `item_master` (`item_id`, `item_category`, `item_name`) VALUES
(5, 'PRODUCT', 'item1'),
(6, 'PRODUCT', 'item2'),
(7, 'PIN', 'TYYYU876OMN908'),
(8, 'PIN', 'JHHINMLNG');

-- --------------------------------------------------------

--
-- Table structure for table `package_details`
--

CREATE TABLE IF NOT EXISTS `package_details` (
  `package_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_price` decimal(10,0) NOT NULL,
  PRIMARY KEY (`package_id`,`item_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package_details`
--

INSERT INTO `package_details` (`package_id`, `item_id`, `item_price`) VALUES
(1, 5, 20),
(1, 6, 30),
(1, 7, 3500),
(1, 8, 3500),
(2, 5, 200),
(2, 6, 300);

-- --------------------------------------------------------

--
-- Table structure for table `package_master`
--

CREATE TABLE IF NOT EXISTS `package_master` (
  `package_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_name` text NOT NULL,
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `package_master`
--

INSERT INTO `package_master` (`package_id`, `package_name`) VALUES
(1, 'DEFAULT'),
(2, 'package2');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `introducer_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `user_left_right_index` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `joining_date` date NOT NULL,
  PRIMARY KEY (`user_id`,`introducer_id`,`created_by`),
  KEY `role` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `introducer_id`, `created_by`, `role`, `user_left_right_index`, `user_name`, `user_email`, `user_password`, `joining_date`) VALUES
(1, 0, 0, 1, 0, 'admin', 'admin', 'admin', '2014-08-04');

-- --------------------------------------------------------

--
-- Table structure for table `user_e_wallet`
--

CREATE TABLE IF NOT EXISTS `user_e_wallet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `bank_transaction_id` varchar(100) NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `note` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `role_id` int(11) NOT NULL,
  `role_name` text NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `role_name`) VALUES
(1, 'ADMIN'),
(2, 'MEMBER');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `company_transaction_details`
--
ALTER TABLE `company_transaction_details`
  ADD CONSTRAINT `company_transaction_details_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `company_transaction_master` (`transaction_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `company_transaction_master`
--
ALTER TABLE `company_transaction_master`
  ADD CONSTRAINT `company_transaction_master_ibfk_1` FOREIGN KEY (`head_account_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_transaction_master_ibfk_2` FOREIGN KEY (`client_account_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `package_details`
--
ALTER TABLE `package_details`
  ADD CONSTRAINT `package_details_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `package_master` (`package_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `package_details_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item_master` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role`) REFERENCES `user_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_e_wallet`
--
ALTER TABLE `user_e_wallet`
  ADD CONSTRAINT `user_e_wallet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;