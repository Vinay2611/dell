-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2019 at 12:44 PM
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
-- Database: `dell_new`
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
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`admin_id`, `first_name`, `last_name`, `email_id`, `password`, `status`, `access_type`, `dateTime`) VALUES
(1, 'amit', 'pashte', 'amit@gmail.com', 'admin', 'Active', 'Admin', '2019-03-13 12:00:15'),
(2, 'vinay', 'j', 'superadmin@admin.com', 'superadmin', 'Active', 'SA', '2019-03-18 05:54:01'),
(3, 'john', 'pk', 'johnpk@shobizexperience.com', 'johnpk', 'Active', 'Admin', '2019-04-05 14:35:43'),
(4, 'saqlain', 'azhar', 'saqlain.azhar@shobizexperience.com', 'saqlain', 'Active', 'SA', '2019-04-05 14:37:01');

-- --------------------------------------------------------

--
-- Table structure for table `contest`
--

CREATE TABLE `contest` (
  `contest_id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `contest_owner_id` int(11) NOT NULL,
  `contest_name` varchar(256) NOT NULL,
  `contest_type` varchar(256) NOT NULL,
  `contest_for` varchar(255) NOT NULL,
  `budget` varchar(255) NOT NULL,
  `banner` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('Pending','Ongoing','On Hold','Approved','Rejected','Approved','Closed') NOT NULL,
  `system_status` enum('Active','Inactive') NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contest`
--

INSERT INTO `contest` (`contest_id`, `po_id`, `admin_id`, `contest_owner_id`, `contest_name`, `contest_type`, `contest_for`, `budget`, `banner`, `start_date`, `end_date`, `status`, `system_status`, `dateTime`) VALUES
(1, 1, 1, 3, 'GO CONQUER ISG', 'ISG', '', '45500', 'ongoing-reward.jpg', '2019-04-20', '2019-05-15', 'Ongoing', 'Active', '2019-04-25 06:10:22'),
(2, 2, 1, 3, 'GO CONQUER ISG FAST START', 'ISG', '', '20000', 'ongoing-reward.jpg', '2019-04-23', '2019-04-27', 'Ongoing', 'Active', '2019-04-25 06:10:27'),
(3, 2, 3, 3, 'CSG HIgh Price Band Lati', 'CSG', '', '5000', 'ongoing-reward.jpg', '2019-04-23', '2019-05-10', 'Ongoing', 'Active', '2019-05-02 09:32:47'),
(4, 2, 3, 3, 'CSG High Price Band Opti', 'CSG', '', '5000', 'ongoing-reward.jpg', '2019-04-23', '2019-05-10', 'Ongoing', 'Active', '2019-05-02 09:32:49'),
(5, 2, 1, 3, 'GO CONQUER ISG Monday', 'ISG', '', '30000', 'ongoing-reward.jpg', '2019-04-23', '2019-04-27', 'Ongoing', 'Active', '2019-04-25 06:10:27'),
(6, 1, 1, 3, 'GO ISG Friday', 'ISG', '', '40000', 'ongoing-reward.jpg', '2019-04-20', '2019-05-15', 'Ongoing', 'Active', '2019-04-25 06:10:22');

-- --------------------------------------------------------

--
-- Table structure for table `hedge_rate`
--

CREATE TABLE `hedge_rate` (
  `hedge_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `quarter` varchar(256) NOT NULL,
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
(1, 1, 'Q1FY20', '2019-02-01', '2019-04-30', '70.00', '2019-05-02 12:07:09', 'Active'),
(2, 1, 'Q2FY20', '2019-05-01', '2019-07-31', '72.00', '2019-05-02 12:07:13', 'Active'),
(3, 1, 'Q3FY20', '2019-08-01', '2019-10-31', '65.00', '2019-05-02 12:07:17', 'Active'),
(4, 1, 'Q4FY20', '2019-11-01', '2020-01-31', '60.00', '2019-05-02 12:07:22', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_number` varchar(256) NOT NULL,
  `contest_id` varchar(255) NOT NULL,
  `users_id` int(11) NOT NULL,
  `order_status` enum('Pending','Partly complete','Completed','Rejected') NOT NULL,
  `shipping_address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `agency_comments` varchar(256) NOT NULL,
  `remark` text NOT NULL,
  `order_date` date NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_number`, `contest_id`, `users_id`, `order_status`, `shipping_address`, `city`, `pincode`, `agency_comments`, `remark`, `order_date`, `last_update`) VALUES
(1, '1005-19-1', '3', 33, 'Pending', 'Test', 'Mumbai', '400015', '', '', '2019-05-10', '2019-05-10 06:01:21'),
(2, '1005-19-2', '5', 33, 'Pending', 'Test', 'Mumbai', '400158', '', '', '2019-05-10', '2019-05-10 06:04:57'),
(3, '1005-19-3', '2,5', 33, 'Pending', 'Test', 'Mumbai', '400105', '', 'Special instruction', '2019-05-10', '2019-05-10 06:10:57'),
(4, '1005-19-4', '2,5', 33, 'Pending', 'Test', 'Mumbai', '400105', '', 'Special instruction', '2019-05-10', '2019-05-10 06:46:57'),
(5, '1005-19-5', '3', 33, 'Pending', 'Test', 'mumbai', '4872873', '', '', '2019-05-10', '2019-05-10 06:56:23'),
(6, '1005-19-6', '5,1', 33, 'Pending', 'Test', 'Mumbai', '4872873', '', '', '2019-05-10', '2019-05-10 06:57:55'),
(7, '1005-19-7', '5', 33, 'Pending', 'Test', 'Mumbai', '4872873', '', '', '2019-05-10', '2019-05-10 06:58:35'),
(8, '1005-19-8', '3', 33, 'Pending', 'ter', 'Mumbai', '4872873', '', '', '2019-05-10', '2019-05-10 06:59:09'),
(9, '1005-19-9', '4', 33, 'Pending', 'fdg', 'dfsg', 'sfdgdf', '', '', '2019-05-10', '2019-05-10 06:59:31');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `od_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product` varchar(256) NOT NULL,
  `brand_details` varchar(256) NOT NULL,
  `size` varchar(256) NOT NULL,
  `website` varchar(255) NOT NULL,
  `price` varchar(256) NOT NULL,
  `url` varchar(256) NOT NULL,
  `remark` text NOT NULL,
  `comment` text NOT NULL,
  `agency_remark` text NOT NULL,
  `order_status` enum('Pending','In-progress','Completed','Rejected','Return Request','Replacement Request') NOT NULL,
  `exception_order` enum('Yes','No') NOT NULL DEFAULT 'No',
  `exception_status` enum('Pending','Approved','Rejected') NOT NULL,
  `mm_action_date` date NOT NULL,
  `ackStatus` enum('Pending','Received') NOT NULL,
  `ackFile` varchar(256) NOT NULL,
  `ackDate` date NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`od_id`, `order_id`, `product`, `brand_details`, `size`, `website`, `price`, `url`, `remark`, `comment`, `agency_remark`, `order_status`, `exception_order`, `exception_status`, `mm_action_date`, `ackStatus`, `ackFile`, `ackDate`, `dateTime`) VALUES
(1, 1, 'producs 1', 'brand 1', '12', 'amazon', '7500', 'https://www.amazon.in/Resonate-RouterUPS-CRU12V2-Backup-Router/dp/B017NC2IPM/ref=sr_1_3?crid=95OGEB02V53X&keywords=ups+for+wifi+routers&qid=1554954631&s=gateway&sprefix=UPS+FOR+WI+FI+ROU%2Caps%2C341&sr=8-3', 'Remarks', '', '', 'Pending', 'No', 'Pending', '0000-00-00', 'Pending', '', '0000-00-00', '2019-05-10 06:01:21'),
(2, 2, 'producs 1', 'brand 1', '11', 'amazon', '11000', 'https://www.amazon.in/Resonate-RouterUPS-CRU12V2-Backup-Router/dp/B017NC2IPM/ref=sr_1_3?crid=95OGEB02V53X&keywords=ups+for+wifi+routers&qid=1554954631&s=gateway&sprefix=UPS+FOR+WI+FI+ROU%2Caps%2C341&sr=8-3', 'Remarks', '', '', 'Pending', 'No', 'Pending', '0000-00-00', 'Pending', '', '0000-00-00', '2019-05-10 06:04:57'),
(3, 3, 'producs 1', 'adidas', '10', 'amazon', '10500', 'https://www.amazon.in/Resonate-RouterUPS-CRU12V2-Backup-Router/dp/B017NC2IPM/ref=sr_1_3?crid=95OGEB02V53X&keywords=ups+for+wifi+routers&qid=1554954631&s=gateway&sprefix=UPS+FOR+WI+FI+ROU%2Caps%2C341&sr=8-3', 'Remarks 1', '', '', 'Pending', 'No', 'Pending', '0000-00-00', 'Pending', '', '0000-00-00', '2019-05-10 06:10:58'),
(4, 4, 'producs 1', 'adidas', '10', 'amazon', '10500', 'https://www.amazon.in/Resonate-RouterUPS-CRU12V2-Backup-Router/dp/B017NC2IPM/ref=sr_1_3?crid=95OGEB02V53X&keywords=ups+for+wifi+routers&qid=1554954631&s=gateway&sprefix=UPS+FOR+WI+FI+ROU%2Caps%2C341&sr=8-3', 'Remarks 1', '', '', 'Pending', 'No', 'Pending', '0000-00-00', 'Pending', '', '0000-00-00', '2019-05-10 06:46:58'),
(5, 5, 'producs1', 'adidas', '12', 'amazon', '450', 'https://www.amazon.in/Resonate-RouterUPS-CRU12V2-Backup-Router/dp/B017NC2IPM/ref=sr_1_3?crid=95OGEB02V53X&keywords=ups+for+wifi+routers&qid=1554954631&s=gateway&sprefix=UPS+FOR+WI+FI+ROU%2Caps%2C341&sr=8-3', 'Test', '', '', 'Pending', 'No', 'Pending', '0000-00-00', 'Pending', '', '0000-00-00', '2019-05-10 06:56:23'),
(6, 6, 'producs 1', 'adidas', '12', 'amazon', '5250', 'https://www.amazon.in/Resonate-RouterUPS-CRU12V2-Backup-Router/dp/B017NC2IPM/ref=sr_1_3?crid=95OGEB02V53X&keywords=ups+for+wifi+routers&qid=1554954631&s=gateway&sprefix=UPS+FOR+WI+FI+ROU%2Caps%2C341&sr=8-3', 'TEst', '', '', 'Pending', 'No', 'Pending', '0000-00-00', 'Pending', '', '0000-00-00', '2019-05-10 06:57:55'),
(7, 7, 'producs1', 'adidas', '12', 'amazon', '250', 'https://www.amazon.in/Resonate-RouterUPS-CRU12V2-Backup-Router/dp/B017NC2IPM/ref=sr_1_3?crid=95OGEB02V53X&keywords=ups+for+wifi+routers&qid=1554954631&s=gateway&sprefix=UPS+FOR+WI+FI+ROU%2Caps%2C341&sr=8-3', 'TEst', '', '', 'Pending', 'No', 'Pending', '0000-00-00', 'Pending', '', '0000-00-00', '2019-05-10 06:58:35'),
(8, 8, 'fg', 'gdg', 'dfg', 'df', '50', 'https://www.amazon.in/Resonate-RouterUPS-CRU12V2-Backup-Router/dp/B017NC2IPM/ref=sr_1_3?crid=95OGEB02V53X&keywords=ups+for+wifi+routers&qid=1554954631&s=gateway&sprefix=UPS+FOR+WI+FI+ROU%2Caps%2C341&sr=8-3', 'dfsg', '', '', 'Pending', 'No', 'Pending', '0000-00-00', 'Pending', '', '0000-00-00', '2019-05-10 06:59:10'),
(9, 9, 'producs1', 'fdsg', 'gdsf', 'gdfgsd', '6000', 'fgd', 'fds', '', '', 'Pending', 'No', 'Pending', '0000-00-00', 'Pending', '', '0000-00-00', '2019-05-10 06:59:32');

-- --------------------------------------------------------

--
-- Table structure for table `order_files`
--

CREATE TABLE `order_files` (
  `of_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `type` varchar(256) NOT NULL,
  `file` varchar(256) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `po_budget` varchar(256) NOT NULL,
  `po_file` varchar(256) NOT NULL,
  `date_of_po` date NOT NULL,
  `agency_fee` varchar(256) NOT NULL,
  `pm_fee` varchar(256) NOT NULL,
  `tax` varchar(256) NOT NULL,
  `balance_amount` decimal(10,0) NOT NULL,
  `individual_amount` varchar(256) NOT NULL,
  `team_amount` varchar(256) NOT NULL,
  `status` enum('Pending','Approved','Rejected','Close') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`po_id`, `hedge_id`, `admin_id`, `po_number`, `po_value`, `po_budget`, `po_file`, `date_of_po`, `agency_fee`, `pm_fee`, `tax`, `balance_amount`, `individual_amount`, `team_amount`, `status`, `timestamp`) VALUES
(1, 2, 1, 'po123456', '50000', '', '6924_dell-doc.docx', '2019-04-20', '7', '1000', '', '45500', '45500', '0', 'Approved', '2019-04-20 14:06:02'),
(2, 1, 1, 'po123457', '40000', '', '9689_testingfile.docx', '2019-04-23', '7', '5000', '7200', '25000', '20000', '5000', 'Approved', '2019-05-07 05:17:37');

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
(1, ' South House Accounts-Commercial', 'Active'),
(2, ' East-Commercial', 'Active'),
(3, ' North House & Acquisition accounts-Commercial ', 'Active'),
(4, ' South Geo Accounts-Commercial', 'Active'),
(5, ' North Geo Expansion accounts-Commercial ', 'Active'),
(6, ' Government accounts-Commercial', 'Active'),
(7, ' West Geo Expansion accounts--Commercial', 'Active'),
(8, ' BFSI accounts-Commercial ', 'Active'),
(9, ' South Acquisition Accounts-Commercial', 'Active'),
(10, ' West House & Acquisition accounts-Commercial', 'Active'),
(11, ' DCCS South & East-Commercial', 'Active'),
(12, ' DCCS North & West-Commercial', 'Active'),
(13, ' Distribution Team-Commercial', 'Active'),
(14, ' Storage DCSE South & East-Commercial', 'Active'),
(15, ' Storage DCSE North & West-Commercial', 'Active'),
(16, ' South & East Channel', 'Active'),
(17, ' North Channel', 'Active'),
(18, ' West Channel', 'Active'),
(19, ' Gov Channel', 'Active'),
(20, ' GeM', 'Active'),
(21, ' North & East GCCS', 'Active'),
(22, ' GCCS West 1 ', 'Active'),
(23, ' GCCS West 2 ', 'Active'),
(24, ' GCCS South 1', 'Active'),
(25, ' GCCS South 2', 'Active'),
(26, ' GCCS Acquisition Accounts ', 'Active'),
(27, ' GCCS GCN North & South', 'Active'),
(28, ' GCN West & East GCCS', 'Active'),
(29, ' EMC AISRs', 'Active'),
(30, ' EMC T1&T2 Enterprise Accounts ', 'Active'),
(31, ' EMC Commercial Accounts ', 'Active'),
(32, ' EMC Enterprise Preferred Accounts ', 'Active');

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
(3, 3, 3, 'Active'),
(4, 4, 4, 'Active'),
(5, 5, 5, 'Active'),
(6, 6, 6, 'Active'),
(7, 7, 7, 'Active'),
(8, 8, 8, 'Active'),
(9, 9, 9, 'Active'),
(10, 10, 10, 'Active'),
(11, 11, 11, 'Active'),
(12, 12, 12, 'Active'),
(13, 13, 13, 'Active'),
(14, 14, 14, 'Active'),
(15, 15, 15, 'Active'),
(16, 16, 16, 'Active'),
(17, 17, 17, 'Active'),
(18, 18, 17, 'Active'),
(20, 19, 19, 'Active'),
(21, 20, 20, 'Active'),
(22, 21, 21, 'Active'),
(23, 22, 22, 'Active'),
(24, 23, 23, 'Active'),
(25, 24, 24, 'Active'),
(26, 25, 25, 'Active'),
(27, 26, 26, 'Active'),
(28, 27, 27, 'Active'),
(29, 28, 28, 'Active'),
(30, 29, 29, 'Active'),
(31, 30, 30, 'Active'),
(32, 31, 31, 'Active'),
(33, 32, 32, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `team_request`
--

CREATE TABLE `team_request` (
  `to_id` int(11) NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `team_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `contest_id` varchar(255) NOT NULL,
  `order_type` varchar(255) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `venue` text NOT NULL,
  `amount` varchar(255) NOT NULL,
  `kind_of_activity` text NOT NULL,
  `document` text NOT NULL,
  `hr_approval` text NOT NULL,
  `geo_head_approval` text NOT NULL,
  `upload_pi` text NOT NULL,
  `upload_invoice` text NOT NULL,
  `status` enum('Pending','In-progress','Completed','Rejected') NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastUpdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team_request`
--

INSERT INTO `team_request` (`to_id`, `order_number`, `team_id`, `users_id`, `admin_id`, `contest_id`, `order_type`, `start_date`, `end_date`, `venue`, `amount`, `kind_of_activity`, `document`, `hr_approval`, `geo_head_approval`, `upload_pi`, `upload_invoice`, `status`, `dateTime`, `lastUpdate`) VALUES
(1, 'TM-0805-19-2', 2, 2, 0, '6', 'Team outting', '08-05-2019', '25-05-2019', 'dfgdsfg', '', 'gdfsg', '', '', '', '', '', 'Pending', '2019-05-08 09:23:55', '0000-00-00 00:00:00'),
(2, 'TM-0905-19-2', 2, 2, 0, '6', 'Team outting', '08-05-2019', '14-05-2019', 'fsd', '', 'sdfsd', '', '', '', '', '', 'Pending', '2019-05-09 13:01:17', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `team_request_files`
--

CREATE TABLE `team_request_files` (
  `tof_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `user_type` enum('ISR','TSR','AG','MM','LM','AISR','IDCSE','ISM') NOT NULL,
  `status` enum('Pending','Active','Reject') NOT NULL DEFAULT 'Pending',
  `team_id` int(11) NOT NULL,
  `reporting_manager` int(11) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `first_name`, `last_name`, `employee_id`, `email`, `password`, `user_type`, `status`, `team_id`, `reporting_manager`, `dateTime`) VALUES
(1, ' Faisal', ' Zeeshan', '', '', '', 'ISM', 'Active', 1, 0, '2019-05-06 09:13:55'),
(2, ' Devi', ' Kowsalya', '', 'kowsalya.devi@dell.com', 'kowsalya', 'ISM', 'Active', 2, 0, '2019-05-06 09:13:55'),
(3, ' Handa', ' Nisha', '', '', '', 'ISM', 'Active', 3, 0, '2019-05-06 09:13:55'),
(4, ' Jose', ' Jubi', '', '', '', 'ISM', 'Active', 4, 0, '2019-05-06 09:13:55'),
(5, ' Juneja', ' Sachin', '', '', '', 'ISM', 'Active', 5, 0, '2019-05-06 09:13:55'),
(6, ' Krishna', ' Vamsi', '', '', '', 'ISM', 'Active', 6, 0, '2019-05-06 09:13:55'),
(7, ' Kumar', ' Nishant', '', '', '', 'ISM', 'Active', 7, 0, '2019-05-06 09:13:55'),
(8, ' M', ' Kuttappa', '', '', '', 'ISM', 'Active', 8, 0, '2019-05-06 09:13:55'),
(9, ' Abu', ' Siddique', '', '', '', 'ISM', 'Active', 9, 0, '2019-05-06 09:13:55'),
(10, ' Patravali', ' Aishwarya', '', '', '', 'ISM', 'Active', 10, 0, '2019-05-06 09:13:55'),
(11, ' Hardik', ' Rajyaguru', '', '', '', 'ISM', 'Active', 11, 0, '2019-05-06 09:13:55'),
(12, ' Jaspreet', ' Singh', '', '', '', 'ISM', 'Active', 12, 0, '2019-05-06 09:13:55'),
(13, ' Arjun', ' Bhujel', '', '', '', 'ISM', 'Active', 13, 0, '2019-05-06 09:13:55'),
(14, ' Saratchandra', ' ', '', '', '', 'ISM', 'Active', 14, 0, '2019-05-06 09:13:55'),
(15, ' Sandeep', ' dutta', '', '', '', 'ISM', 'Active', 15, 0, '2019-05-06 09:13:55'),
(16, ' Veena', ' Chandrashekhar', '', '', '', 'ISM', 'Active', 16, 0, '2019-05-06 09:13:55'),
(17, ' Ramakrishna', ' ', '', '', '', 'ISM', 'Active', 17, 0, '2019-05-06 09:13:55'),
(19, ' Sabarinath', ' ', '', '', '', 'ISM', 'Active', 19, 0, '2019-05-06 09:13:55'),
(20, ' Dhruva', ' Ramdas', '', '', '', 'ISM', 'Active', 20, 0, '2019-05-06 09:13:55'),
(21, ' Ghatak', ' Bhaskar', '', '', '', 'ISM', 'Active', 21, 0, '2019-05-06 09:13:55'),
(22, ' Ajit', ' Menon', '', '', '', 'ISM', 'Active', 22, 0, '2019-05-06 09:13:55'),
(23, ' Adarsh', ' Thompson', '', '', '', 'ISM', 'Active', 23, 0, '2019-05-06 09:13:55'),
(24, ' Abhimanyu', ' Yadav', '', '', '', 'ISM', 'Active', 24, 0, '2019-05-06 09:13:55'),
(25, ' Premi', ' Chittaranjan', '', '', '', 'ISM', 'Active', 25, 0, '2019-05-06 09:13:55'),
(26, ' Mohit', ' Panwar', '', '', '', 'ISM', 'Active', 26, 0, '2019-05-06 09:13:55'),
(27, ' Asha', ' BN', '', '', '', 'ISM', 'Active', 27, 0, '2019-05-06 09:13:55'),
(28, ' Abhishek', ' Ojha', '', '', '', 'ISM', 'Active', 28, 0, '2019-05-06 09:13:55'),
(29, ' Rakshit', ' Sindhi', '', '', '', 'ISM', 'Active', 29, 0, '2019-05-06 09:13:55'),
(30, ' Charanjot', ' Rehani', '', '', '', 'ISM', 'Active', 30, 0, '2019-05-06 09:13:55'),
(31, ' Shirley', ' Daniel', '', '', '', 'ISM', 'Active', 31, 0, '2019-05-06 09:13:55'),
(32, ' Rajeev', ' Saxena', '', '', '', 'ISM', 'Active', 32, 0, '2019-05-06 09:13:55'),
(33, 'Vinay', 'Jaiswal', '1144', 'vinay.jaiswal@shobizexperience.com', 'vinay123', 'ISR', 'Active', 2, 2, '2019-05-06 09:13:55'),
(34, 'amit', 'pashte', '1023', 'amit.pashte@shobiz.com', 'amit', 'TSR', 'Pending', 2, 2, '2019-05-06 10:49:05'),
(35, 'Karan', 'Sehgal', '1003', 'karan.sehgal@dell.com', 'karan', 'MM', 'Active', 9, 2, '2019-05-07 05:02:13');

-- --------------------------------------------------------

--
-- Table structure for table `winner`
--

CREATE TABLE `winner` (
  `winner_id` int(11) NOT NULL,
  `contest_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `type` enum('Individual','Team') NOT NULL,
  `reward_amount` varchar(255) NOT NULL,
  `balance_amount` decimal(10,2) NOT NULL,
  `reward_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `announcement_date` varchar(255) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `winner`
--

INSERT INTO `winner` (`winner_id`, `contest_id`, `team_id`, `users_id`, `type`, `reward_amount`, `balance_amount`, `reward_status`, `announcement_date`, `dateTime`) VALUES
(1, 1, 2, 33, 'Individual', '5000', '0.00', 'Redeemed', '', '2019-05-06 09:48:36'),
(2, 2, 2, 33, 'Individual', '10000', '0.00', 'Redeemed', '', '2019-05-06 09:48:36'),
(3, 3, 2, 33, 'Individual', '8000', '0.00', 'Redeemed', '', '2019-05-06 09:48:36'),
(4, 4, 2, 33, 'Individual', '6000', '0.00', 'Redeemed', '', '2019-05-06 09:48:36'),
(5, 5, 2, 33, 'Individual', '12000', '0.00', 'Redeemed', '', '2019-05-06 09:48:36'),
(6, 6, 2, 33, 'Individual', '15000', '0.00', 'Pending', '', '2019-05-06 09:48:36'),
(7, 6, 2, 2, 'Team', '15000', '0.00', 'Pending', '', '2019-05-06 09:48:36'),
(8, 6, 2, 34, 'Individual', '0', '0.00', 'NA', '', '2019-05-06 10:50:01');

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
-- Indexes for table `hedge_rate`
--
ALTER TABLE `hedge_rate`
  ADD PRIMARY KEY (`hedge_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`od_id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`po_id`);

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
-- Indexes for table `team_request`
--
ALTER TABLE `team_request`
  ADD PRIMARY KEY (`to_id`);

--
-- Indexes for table `team_request_files`
--
ALTER TABLE `team_request_files`
  ADD PRIMARY KEY (`tof_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- Indexes for table `winner`
--
ALTER TABLE `winner`
  ADD PRIMARY KEY (`winner_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contest`
--
ALTER TABLE `contest`
  MODIFY `contest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hedge_rate`
--
ALTER TABLE `hedge_rate`
  MODIFY `hedge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `od_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `po_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `team_head`
--
ALTER TABLE `team_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `team_request`
--
ALTER TABLE `team_request`
  MODIFY `to_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `team_request_files`
--
ALTER TABLE `team_request_files`
  MODIFY `tof_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `winner`
--
ALTER TABLE `winner`
  MODIFY `winner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contest`
--
ALTER TABLE `contest`
  ADD CONSTRAINT `contest_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `purchase_order` (`po_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
