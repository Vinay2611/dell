-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2019 at 06:57 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dell`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `admin_id` int(11) NOT NULL,
  `first_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `email_id` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `access_type` enum('SA','Admin') NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`admin_id`, `first_name`, `last_name`, `email_id`, `password`, `status`, `access_type`, `dateTime`) VALUES
(1, 'amit', 'pashte', 'amit@gmail.com', 'admin', 'Active', 'Admin', '2019-03-13 17:30:15'),
(2, 'vinay', 'j', 'superadmin@admin.com', 'superadmin', 'Active', 'SA', '2019-03-18 11:24:01');

-- --------------------------------------------------------

--
-- Table structure for table `contest`
--

CREATE TABLE `contest` (
  `contest_id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `contest_name` varchar(256) NOT NULL,
  `contest_type` varchar(256) NOT NULL,
  `contest_for` varchar(255) NOT NULL,
  `budget` varchar(255) NOT NULL,
  `banner` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('Pending','Ongoing','On Hold','Cancelled','Closed') NOT NULL,
  `system_status` enum('Active','Inactive') NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contest`
--

INSERT INTO `contest` (`contest_id`, `po_id`, `admin_id`, `contest_name`, `contest_type`, `contest_for`, `budget`, `banner`, `start_date`, `end_date`, `status`, `system_status`, `dateTime`) VALUES
(1, 1, 1, 'contest1', 'ISG', 'Individual', '100', 'ongoing-reward.jpg', '2019-03-14', '2019-03-14', 'Ongoing', 'Active', '2019-03-28 12:09:23'),
(2, 1, 1, 'contest 2', 'ISG', 'Individual', '50', 'ongoing-reward.jpg', '2019-03-14', '2019-03-20', 'Ongoing', 'Active', '2019-03-28 14:13:08'),
(3, 1, 1, 'contest 3', 'ISG', 'Team', '100', 'server.png', '2019-03-14', '2019-03-20', 'Ongoing', 'Active', '2019-03-28 14:13:11'),
(4, 1, 1, 'Contest 4', 'ISG', 'Team', '100', 'ongoing-reward.jpg', '2019-03-01', '2019-03-31', 'Ongoing', 'Active', '2019-03-28 14:13:13'),
(6, 1, 1, 'asdfa', 'ISG', 'Team', '', '', '2019-04-11', '2019-04-25', 'Pending', 'Active', '2019-03-27 13:57:06'),
(8, 1, 1, 'asdfa', 'ISG', 'Team', '', '', '2019-04-11', '2019-04-25', 'Pending', 'Active', '2019-03-27 13:58:00'),
(9, 1, 1, 'asdfa', 'ISG', 'Team', '', '', '2019-04-11', '2019-04-25', 'Pending', 'Active', '2019-03-27 13:59:13'),
(10, 1, 1, 'testa', 'CSG', 'Individual', '20', '', '2019-04-02', '2019-04-11', 'Ongoing', 'Active', '2019-04-03 09:32:16'),
(11, 1, 1, 'newcontest', 'CSG', 'Team', '', '', '2019-04-01', '2019-04-30', 'Pending', 'Active', '2019-03-27 14:02:03');

-- --------------------------------------------------------

--
-- Table structure for table `contest_junk`
--

CREATE TABLE `contest_junk` (
  `id` int(11) NOT NULL,
  `contest_name` varchar(255) DEFAULT NULL,
  `contest_type` varchar(255) DEFAULT NULL,
  `po_id` int(11) DEFAULT NULL,
  `contest_value` decimal(10,0) DEFAULT NULL,
  `start_date_contest` date DEFAULT NULL,
  `end_date_contest` date DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Dumping data for table `contest_junk`
--

INSERT INTO `contest_junk` (`id`, `contest_name`, `contest_type`, `po_id`, `contest_value`, `start_date_contest`, `end_date_contest`, `status`) VALUES
(1, 'Contetst1', 'Goodies', 1, '500', '2019-03-08', '2019-03-31', 'Active'),
(2, 'Contetst2', 'Goodies', 1, '500', '2019-03-10', '2019-04-10', 'Active'),
(3, 'Contetst3', 'Team Outing', 2, '2500', '2019-05-01', '2019-05-05', 'Active'),
(4, 'Contetst4', 'Team Outing', 2, '4000', '2019-06-15', '2019-06-30', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `contest_junk2`
--

CREATE TABLE `contest_junk2` (
  `contest_id` int(11) NOT NULL,
  `contest_name` varchar(256) NOT NULL,
  `po_id` int(11) NOT NULL,
  `contest_type` enum('individual','team') NOT NULL,
  `po_value` varchar(256) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contest_junk2`
--

INSERT INTO `contest_junk2` (`contest_id`, `contest_name`, `po_id`, `contest_type`, `po_value`, `start_date`, `end_date`, `status`, `dateTime`) VALUES
(1, 'contest 1', 1, 'individual', '1000', '2019-03-13', '2019-03-21', 'Active', '2019-03-13 07:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `hedge_rate`
--

CREATE TABLE `hedge_rate` (
  `hedge_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `quarter` enum('Q1','Q2','Q3','Q4') NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `hedge_rate` decimal(15,2) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Dumping data for table `hedge_rate`
--

INSERT INTO `hedge_rate` (`hedge_id`, `admin_id`, `quarter`, `from_date`, `to_date`, `hedge_rate`, `create_date`, `status`) VALUES
(1, 1, 'Q1', '2019-01-01', '2019-03-31', '70.00', '2019-03-28 14:08:27', 'Active'),
(2, 1, 'Q2', '2019-04-01', '2019-06-30', '72.00', '2019-03-28 14:12:46', 'Active'),
(3, 1, 'Q3', '2019-07-01', '2019-09-30', '65.00', '2019-03-28 14:13:31', 'Active'),
(4, 1, 'Q4', '2019-10-01', '2019-12-31', '60.00', '2019-03-28 14:13:37', 'Active'),
(6, 1, 'Q1', '2019-04-02', '2019-04-27', '75.00', '2019-04-02 09:43:01', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `contest_id` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `url` text NOT NULL,
  `url1` text NOT NULL,
  `url2` text NOT NULL,
  `url3` text NOT NULL,
  `url4` text NOT NULL,
  `order_type` varchar(255) NOT NULL,
  `club_type` varchar(255) NOT NULL,
  `club_price` varchar(255) NOT NULL,
  `status` enum('Pending','In-progress','Completed','Rejected') DEFAULT 'Pending',
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `order_id`, `contest_id`, `price`, `users_id`, `url`, `url1`, `url2`, `url3`, `url4`, `order_type`, `club_type`, `club_price`, `status`, `dateTime`) VALUES
(2, '2', '1', '100', 11, 'http://www.shobizexperience.com', '', '', '', '', '', '', '', 'Pending', '2019-03-19 08:49:11'),
(6, '3', '2', '50', 13, 'https://www.amazon.in/Kevin-inches-Ready-K56U912-Black/dp/B072QD8QKL/ref=gbph_tit_m-3_659b_82e8af94?smid=AT95IG9ONZD7S&pf_rd_p=4f62fce0-bf26-4196-9065-e1509b88659b&pf_rd_s=merchandised-search-3&pf_rd_t=101&pf_rd_i=1389396031&pf_rd_m=A1VBAL9TL5WCBF&pf_rd_r=TG7S7TV4QE9SJ5Q1JFT7', '', '', '', '', '', '', '', 'Pending', '2019-03-27 06:38:17'),
(7, '5', '4', '100', 9, '', '', '', '', '', 'Team outting', '', '', 'Pending', '2019-03-27 07:04:29'),
(17, '5c9b6e5338cd3', '2', '50', 7, 'https://www.amazon.in/Kevin-inches-Ready-K56U912-Black/dp/B072QD8QKL/ref=gbph_tit_m-3_659b_82e8af94?smid=AT95IG9ONZD7S&pf_rd_p=4f62fce0-bf26-4196-9065-e1509b88659b&pf_rd_s=merchandised-search-3&pf_rd_t=101&pf_rd_i=1389396031&pf_rd_m=A1VBAL9TL5WCBF&pf_rd_r=TG7S7TV4QE9SJ5Q1JFT7', '', '', '', '', '', '', '', 'Pending', '2019-03-27 12:36:35'),
(20, '2803-1920-2', '3', '100', 2, '', '', '', '', '', 'Refreshing', '', '', 'Pending', '2019-03-28 11:25:14'),
(24, '0304-1924-1', '3', '20.00', 1, 'https://www.amazon.in/Kevin-inches-Ready-K56U912-Black/dp/B072QD8QKL/ref=gbph_tit_m-3_659b_82e8af94?smid=AT95IG9ONZD7S&pf_rd_p=4f62fce0-bf26-4196-9065-e1509b88659b&pf_rd_s=merchandised-search-3&pf_rd_t=101&pf_rd_i=1389396031&pf_rd_m=A1VBAL9TL5WCBF&pf_rd_r=TG7S7TV4QE9SJ5Q1JFT7', '', '', '', '', '', 'ISG', '', 'Pending', '2019-04-03 13:09:49'),
(25, '0304-1925-1', '2', '40.00', 1, 'https://www.amazon.in/Kevin-inches-Ready-K56U912-Black/dp/B072QD8QKL/ref=gbph_tit_m-3_659b_82e8af94?smid=AT95IG9ONZD7S&pf_rd_p=4f62fce0-bf26-4196-9065-e1509b88659b&pf_rd_s=merchandised-search-3&pf_rd_t=101&pf_rd_i=1389396031&pf_rd_m=A1VBAL9TL5WCBF&pf_rd_r=TG7S7TV4QE9SJ5Q1JFT7', '', '', '', '', '', 'ISG', '', 'Pending', '2019-04-03 13:09:49'),
(26, '0304-1926-1', '1', '30.00', 1, 'https://www.amazon.in/Kevin-inches-Ready-K56U912-Black/dp/B072QD8QKL/ref=gbph_tit_m-3_659b_82e8af94?smid=AT95IG9ONZD7S&pf_rd_p=4f62fce0-bf26-4196-9065-e1509b88659b&pf_rd_s=merchandised-search-3&pf_rd_t=101&pf_rd_i=1389396031&pf_rd_m=A1VBAL9TL5WCBF&pf_rd_r=TG7S7TV4QE9SJ5Q1JFT7', '', '', '', '', '', 'ISG', '', 'Pending', '2019-04-03 13:09:49');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_details` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Table structure for table `po_master_junk`
--

CREATE TABLE `po_master_junk` (
  `id` int(11) DEFAULT NULL,
  `po_no` int(11) DEFAULT NULL,
  `po_date` date DEFAULT NULL,
  `po_details` varchar(255) DEFAULT NULL,
  `po_value` decimal(15,2) DEFAULT NULL,
  `agency_fees` decimal(10,0) DEFAULT NULL,
  `tax_amt` decimal(10,0) DEFAULT NULL,
  `bal_po_value` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Dumping data for table `po_master_junk`
--

INSERT INTO `po_master_junk` (`id`, `po_no`, `po_date`, `po_details`, `po_value`, `agency_fees`, `tax_amt`, `bal_po_value`) VALUES
(1, 123, '2019-03-08', 'Po details1', '1130.00', '50', '180', '1000'),
(2, 456, '2019-03-08', 'Po details 456', '1130.00', '50', '180', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `po_id` int(11) NOT NULL,
  `hedge_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `po_number` varchar(256) NOT NULL,
  `po_value` varchar(256) NOT NULL,
  `po_file` varchar(256) NOT NULL,
  `date_of_po` date NOT NULL,
  `agency_fee` varchar(256) NOT NULL,
  `tax` varchar(256) NOT NULL,
  `balance_amount` decimal(10,0) NOT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`po_id`, `hedge_id`, `admin_id`, `po_number`, `po_value`, `po_file`, `date_of_po`, `agency_fee`, `tax`, `balance_amount`, `status`, `timestamp`) VALUES
(1, 1, 1, 'PO102563', '1000', 'test1.doc', '2019-03-05', '100', '10', '790', 'Pending', '2019-04-02 12:54:58'),
(2, 2, 1, '1548978', '15000', 'test2.doc', '2019-04-03', '7', '1548978', '11250', 'Pending', '2019-04-02 12:55:03'),
(3, 1, 1, '158456', '150000', 'test3.doc', '2019-04-10', '7', '158456', '112500', 'Pending', '2019-04-02 12:55:07'),
(4, 1, 1, '1457893', '1542', '', '2019-04-02', '7', '1457893', '1434', 'Pending', '2019-04-02 13:02:06'),
(5, 1, 1, '14586', '15243', '', '2019-04-02', '7', '', '14176', 'Pending', '2019-04-02 13:03:59');

-- --------------------------------------------------------

--
-- Table structure for table `split_po_junk`
--

CREATE TABLE `split_po_junk` (
  `id` int(11) DEFAULT NULL,
  `po_id` int(11) DEFAULT NULL,
  `agency_fees` decimal(10,0) DEFAULT NULL,
  `tax_amt` decimal(10,0) DEFAULT NULL,
  `reward_amt` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`team_id`, `team_name`, `status`) VALUES
(1, 'Commercial', 'Active'),
(2, 'Channel', 'Active'),
(3, 'GCCS', 'Active'),
(4, 'DCSE', 'Active'),
(5, 'Admin', 'Active'),
(6, 'IT', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `team_head`
--

CREATE TABLE `team_head` (
  `id` int(11) NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Dumping data for table `team_head`
--

INSERT INTO `team_head` (`id`, `team_id`, `users_id`, `status`) VALUES
(1, 1, 1, 'Active'),
(2, 2, 2, 'Active'),
(3, 1, 3, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `first_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `employee_id` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `user_type` enum('ISR','TSR','AG','MM','LM') NOT NULL,
  `status` enum('Pending','Active','Reject') NOT NULL DEFAULT 'Pending',
  `team_id` int(11) NOT NULL,
  `reporting_manager` int(11) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `first_name`, `last_name`, `employee_id`, `email`, `password`, `user_type`, `status`, `team_id`, `reporting_manager`, `dateTime`) VALUES
(1, 'vinay', 'jaiswal', '1112', 'vinay@gmail.com', '123456', 'ISR', 'Active', 2, 3, '2019-03-28 11:06:50'),
(2, 'ramesh', 'mhaskar', '1002', 'ramesh@gmail.com', 'ramesh', 'TSR', 'Active', 2, 2, '2019-03-12 11:16:23'),
(3, 'neetuprakash', 'P', '1003', 'neetu@gmail.com', 'neetu', 'TSR', 'Pending', 1, 1, '2019-03-12 11:18:15'),
(4, 'sachin', 't', '400012', 'sachin@gmail.com', 'sachin', 'ISR', 'Active', 1, 1, '2019-03-12 05:43:58'),
(5, 'virat', 'mhaskar', '4002', 'virat@gmail.com', 'virat', 'TSR', 'Active', 2, 2, '2019-03-12 05:46:23'),
(6, 'ms', 'Dhoni', '4003', 'ms@gmail.com', 'ms', 'TSR', 'Pending', 2, 2, '2019-03-12 05:48:15'),
(7, 'suresh', 'r', '500012', 'suresh@gmail.com', 'suresh', 'ISR', 'Active', 2, 2, '2019-03-12 05:43:58'),
(8, 'james', 'anderson', '5002', 'james@gmail.com', 'james', 'TSR', 'Active', 1, 2, '2019-03-12 05:46:23'),
(9, 'shane', 'warne', '5003', 'shane@gmail.com', 'shane', 'TSR', 'Active', 2, 9, '2019-03-12 05:48:15'),
(10, 'Demo', '', '54433', 'demo@gmail.com', '123456', 'ISR', 'Active', 1, 2, '2019-03-19 06:25:39'),
(11, 'rahul', '', '10450', 'rahul@rahul.com', 'rahul', 'TSR', 'Active', 1, 1, '2019-03-19 08:46:49'),
(12, 'Rohit', '', '12', 'rohit@gmail.com', 'jNF9T1', 'TSR', 'Active', 1, 1, '2019-03-19 10:46:20'),
(13, 'Sameer', '', '1010', 'popli@gmail.com', '123456', 'ISR', 'Active', 2, 2, '2019-03-27 06:29:45'),
(15, 'Demo', '', '7347', 'demo1@gmail.com', '123456', 'ISR', 'Pending', 1, 3, '2019-03-27 10:25:10'),
(16, 'Shobiz', '', '1234', 'shobiz@gmail.com', '123456', 'ISR', 'Active', 1, 3, '2019-03-28 11:47:31'),
(17, 'Vinay', '', '89374587', 'vin@gmaail.com', '123654', 'ISR', 'Pending', 2, 2, '2019-03-28 11:50:23'),
(18, 'Demo', '', '23878', 'test@aol.com', '123456', 'ISR', 'Pending', 1, 3, '2019-04-01 06:35:37'),
(19, 'Demo', '', '002', 'amit@gmail.com', '123456', 'ISR', 'Pending', 2, 2, '2019-04-01 06:36:19'),
(20, 'Demo', '', '1010', 'vinay.jaiswal@shobizexperience.com', '1234567', 'MM', 'Active', 1, 3, '2019-04-01 06:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `users_junk`
--

CREATE TABLE `users_junk` (
  `users_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `team_id` int(11) NOT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `users_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Dumping data for table `users_junk`
--

INSERT INTO `users_junk` (`users_id`, `name`, `team_id`, `employee_id`, `users_name`, `password`, `user_type`, `status`) VALUES
(1, 'Nanda', 5, '1', 'nanda', 'nanda123', 'super_admin', 'Active'),
(2, 'Karan', 5, '2', 'karan', 'karan123', 'admin', 'Active'),
(3, 'Saqlain', 1, '3', 'saqline', 'saqline123', 'TSR', 'Active'),
(4, 'Amit', 2, '4', 'amit', 'amit123', 'TSR', 'Active'),
(5, 'Vinay', 2, '5', 'vinay', 'vinay123', 'ISR', 'Active'),
(6, 'Neetuprakash', 3, '6', 'neetuprakash', 'neetuprakash123', 'TSR', 'Active'),
(7, 'Ramesh', 3, '7', 'ramesh', 'ramesh123', 'ISR', 'Active'),
(8, 'Sameer', 3, '8', 'sameer', 'sameer123', 'ISR', 'Active'),
(9, 'Sikandar', 4, '9', 'sikandar', 'sikandar123', 'ISR', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `winner_isr`
--

CREATE TABLE `winner_isr` (
  `id` int(11) NOT NULL,
  `contest_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `reward_amt` decimal(15,0) DEFAULT NULL,
  `reward_status` enum('Pending','Redeemed') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Dumping data for table `winner_isr`
--

INSERT INTO `winner_isr` (`id`, `contest_id`, `users_id`, `details`, `reward_amt`, `reward_status`) VALUES
(1, 1, 7, NULL, '125', 'Pending'),
(2, 1, 8, NULL, '125', 'Pending'),
(3, 1, 5, NULL, '125', 'Pending'),
(4, 1, 9, NULL, '125', 'Pending'),
(5, 2, 5, NULL, '125', 'Pending'),
(6, 2, 9, NULL, '125', 'Pending'),
(7, 2, 7, NULL, '125', 'Pending'),
(8, 2, 8, NULL, '125', 'Pending'),
(9, 1, 12, NULL, '10', 'Pending'),
(10, 2, 13, 'Rewards point ', '100', 'Pending'),
(11, 1, 1, 'Demo', '10', 'Pending'),
(12, 1, 4, NULL, '20', 'Pending'),
(13, 1, 16, 'test', '25', 'Pending'),
(14, 2, 1, 'Demo contest 1 user vinay', '20', 'Pending'),
(15, 3, 1, 'Test contest 3 user 1', '20', 'Pending'),
(16, 10, 1, 'Demo contest 10 user vinay CSG', '20', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `winner_tsr`
--

CREATE TABLE `winner_tsr` (
  `id` int(11) NOT NULL,
  `contest_id` int(11) NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `details` text,
  `reward_amt` decimal(15,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Dumping data for table `winner_tsr`
--

INSERT INTO `winner_tsr` (`id`, `contest_id`, `team_id`, `users_id`, `details`, `reward_amt`) VALUES
(1, 3, 2, 5, 'Demo', '10.000'),
(7, 4, 6, 0, NULL, '1500.000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `contest`
--
ALTER TABLE `contest`
  ADD PRIMARY KEY (`contest_id`),
  ADD KEY `contest_ibfk_1` (`po_id`);

--
-- Indexes for table `contest_junk`
--
ALTER TABLE `contest_junk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contest_master_fk1` (`po_id`);

--
-- Indexes for table `contest_junk2`
--
ALTER TABLE `contest_junk2`
  ADD PRIMARY KEY (`contest_id`),
  ADD KEY `po_id` (`po_id`);

--
-- Indexes for table `hedge_rate`
--
ALTER TABLE `hedge_rate`
  ADD PRIMARY KEY (`hedge_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `po_master_junk`
--
ALTER TABLE `po_master_junk`
  ADD KEY `id` (`id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`po_id`);

--
-- Indexes for table `split_po_junk`
--
ALTER TABLE `split_po_junk`
  ADD KEY `split_po_fk1` (`po_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `team_head`
--
ALTER TABLE `team_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- Indexes for table `users_junk`
--
ALTER TABLE `users_junk`
  ADD PRIMARY KEY (`users_id`),
  ADD UNIQUE KEY `users_id` (`users_id`),
  ADD KEY `users_master_fk1` (`team_id`);

--
-- Indexes for table `winner_isr`
--
ALTER TABLE `winner_isr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `winner_tsr`
--
ALTER TABLE `winner_tsr`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contest`
--
ALTER TABLE `contest`
  MODIFY `contest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contest_junk2`
--
ALTER TABLE `contest_junk2`
  MODIFY `contest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hedge_rate`
--
ALTER TABLE `hedge_rate`
  MODIFY `hedge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `po_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users_junk`
--
ALTER TABLE `users_junk`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `winner_isr`
--
ALTER TABLE `winner_isr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `winner_tsr`
--
ALTER TABLE `winner_tsr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contest`
--
ALTER TABLE `contest`
  ADD CONSTRAINT `contest_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `purchase_order` (`po_id`);

--
-- Constraints for table `contest_junk`
--
ALTER TABLE `contest_junk`
  ADD CONSTRAINT `contest_master_fk1` FOREIGN KEY (`po_id`) REFERENCES `po_master_junk` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_fk1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);

--
-- Constraints for table `split_po_junk`
--
ALTER TABLE `split_po_junk`
  ADD CONSTRAINT `split_po_fk1` FOREIGN KEY (`po_id`) REFERENCES `po_master_junk` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
