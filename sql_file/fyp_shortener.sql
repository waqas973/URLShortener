-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2021 at 09:55 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp_shortener`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_area`
--

CREATE TABLE `admin_area` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_area`
--

INSERT INTO `admin_area` (`id`, `username`, `email`, `password`) VALUES
(1, 'AliRaza', 'admin123@gmail.com', 'admin12345');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `package_type` enum('Free','Business','Enterprise') NOT NULL,
  `method_type` enum('Easypaisa','Jazzcash','Bank account','N/A') NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `total_price` int(11) NOT NULL,
  `remaining_url` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `transaction_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `username`, `Email`, `password`, `package_type`, `method_type`, `start_date`, `end_date`, `total_price`, `remaining_url`, `token`, `status`, `transaction_id`, `transaction_status`) VALUES
(52, 'waqase', 'waqascomsts786@gmail.com', 'waqas', 'Enterprise', 'Jazzcash', '2021-01-14 00:00:00', '2022-01-08 00:00:00', 400, 'unlimited', '0', 'active', 'T20210110141543', 1),
(74, 'admin', 'drbilalhussain6@gmail.com', '123', 'Business', 'Jazzcash', '2021-01-14 00:00:00', '2021-09-10 00:00:00', 300, '272', '0', 'active', 'T20210110141531', 1),
(76, 'waqase', 'waqas@gmail.com', '123', 'Enterprise', 'Jazzcash', '2021-01-15 00:00:00', '2021-04-10 00:00:00', 200, 'unlimited', '0', 'active', 'T20210110142352', 1),
(78, 'ibrar', 'hackerworld0304@gmail.com', 'waqas', 'Free', 'N/A', '2021-01-11 00:00:00', '2021-02-11 00:00:00', 0, '15', '89a16ded3c12deb2fc297627c85cf8', 'active', 'N/A', 0),
(79, 'furqan', 'ranafurqanasif042@gmail.com', 'furqan123', 'Free', 'N/A', '2021-01-12 00:00:00', '2021-02-12 00:00:00', 0, '15', 'd40542a671b2faaa4677157d2969c4', 'active', 'N/A', 0),
(82, 'azeem', 'azeem7868400@gmail.com', 'azeem', 'Free', 'N/A', '2021-01-13 00:00:00', '2021-02-13 00:00:00', 0, '15', 'e551a19648a013ec97c47eb8507caf', 'inactive', 'N/A', 0),
(86, 'raza', 'raza123@gmail.com', 'raza', 'Business', 'Jazzcash', '2021-01-14 00:00:00', '2021-03-14 00:00:00', 200, '70', '0', 'active', '', 0),
(87, 'google', 'google@gmail.com', 'google', 'Business', 'Jazzcash', '2021-01-14 00:00:00', '2021-02-14 00:00:00', 100, '35', '0', 'active', 'T20210114160204', 1),
(88, 'zahid', 'zahid@gmail.com', 'zahid', 'Enterprise', 'Jazzcash', '2021-01-14 00:00:00', '2021-03-14 00:00:00', 400, 'unlimited', '0', 'active', 'T20210115002734', 1),
(90, 'mustak', 'mustak@gmail.com', 'mustak', 'Business', 'Jazzcash', '2021-01-15 00:00:00', '2021-03-18 00:00:00', 100, '70', '0', 'active', 'T20210115081927', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detection`
--

CREATE TABLE `detection` (
  `id` int(11) NOT NULL,
  `short_urls_id` int(11) NOT NULL,
  `browser_name` varchar(255) NOT NULL,
  `device_type` varchar(255) NOT NULL,
  `OS_type` varchar(255) NOT NULL,
  `ref_site` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `regionname` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lon` varchar(255) NOT NULL,
  `timezone` varchar(255) NOT NULL,
  `clicks` int(11) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `Month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detection`
--

INSERT INTO `detection` (`id`, `short_urls_id`, `browser_name`, `device_type`, `OS_type`, `ref_site`, `country`, `region`, `regionname`, `city`, `zip`, `lat`, `lon`, `timezone`, `clicks`, `customer_id`, `Month`, `year`) VALUES
(125, 39, 'Chrome', 'PC', 'Window', 'http://localhost/fyp_project/Enterprise/Createlink.php', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'December', '2020'),
(126, 39, 'Firefox', 'PC', 'Window', 'http://fb.com/profile', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'December', '2020'),
(127, 40, 'Chrome', 'PC', 'Window', 'http://fb.com/profile', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'December', '2020'),
(128, 41, 'Firefox', 'PC', 'Window', 'http://fb.com/profile', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'December', '2020'),
(129, 41, 'Chrome', 'PC', 'Window', 'http://fb.com/profile', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'December', '2020'),
(130, 42, 'Chrome', 'PC', 'Window', 'http://whatsapp.com/profile', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'December', '2020'),
(131, 39, 'Chrome', 'PC', 'Window', 'http://localhost/fyp_project/Enterprise/Createlink.php', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'December', '2020'),
(132, 43, 'Chrome', 'PC', 'Window', 'http://fb.com/profile', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'December', '2020'),
(133, 43, 'Firefox', 'PC', 'Window', 'http://whatsapp.com/profile', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'December', '2020'),
(134, 43, 'Chrome', 'PC', 'Window', 'http://whatsapp.com/profile', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'December', '2020'),
(135, 43, 'Firefox', 'PC', 'Window', 'http://whatsapp.com/profile', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'December', '2020'),
(136, 43, 'Chrome', 'PC', 'Window', 'http://whatsapp.com/profile', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'December', '2020'),
(137, 43, 'Chrome', 'PC', 'Window', 'http://fb.com/profile', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'December', '2020'),
(138, 43, 'Chrome', 'PC', 'Window', 'http://localhost/fyp_project/Enterprise/Createlink.php', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'December', '2020'),
(139, 43, 'Chrome', 'PC', 'Window', 'http://fb.com/profile', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'December', '2020'),
(140, 43, 'Chrome', 'PC', 'Window', 'http://fb.com/profile', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'December', '2020'),
(141, 43, 'Chrome', 'PC', 'Window', 'N/A', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'December', '2020'),
(142, 40, 'Chrome', 'PC', 'Window', 'N/A', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'December', '2020'),
(143, 43, 'Firefox', 'PC', 'Window', 'N/A', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'December', '2020'),
(144, 43, 'Chrome', 'PC', 'Window', 'N/A', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'December', '2020'),
(145, 40, 'Chrome', 'PC', 'Window', 'N/A', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'December', '2020'),
(146, 43, 'Chrome', 'PC', 'Window', 'N/A', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'December', '2020'),
(147, 39, 'Chrome', 'PC', 'Window', 'N/A', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'January', '2021'),
(148, 39, 'Chrome', 'PC', 'Window', 'N/A', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'January', '2021'),
(149, 39, 'Chrome', 'PC', 'Window', 'N/A', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'January', '2021'),
(150, 39, 'Chrome', 'PC', 'Window', 'N/A', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'January', '2021'),
(151, 39, 'Chrome', 'PC', 'Window', 'N/A', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'January', '2021'),
(152, 39, 'Chrome', 'PC', 'Window', 'N/A', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'January', '2021'),
(153, 39, 'Chrome', 'PC', 'Window', 'N/A', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'January', '2021'),
(154, 43, 'Chrome', 'PC', 'Window', 'N/A', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'January', '2021'),
(155, 44, 'Chrome', 'PC', 'Window', 'N/A', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'January', '2021'),
(156, 41, 'Chrome', 'PC', 'Window', 'N/A', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'January', '2021'),
(157, 43, 'Chrome', 'PC', 'Window', 'N/A', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'January', '2021'),
(158, 44, 'Chrome', 'PC', 'Window', 'N/A', 'Pakistan', 'PB', 'Punjab', 'Pattoki', '55300', '31.0167', '73.85', 'Asia/Karachi', 1, 52, 'January', '2021'),
(167, 51, 'Chrome', 'PC', 'Window', 'http://localhost/fyp_project/Business/Createlink.php', 'Pakistan', 'PB', 'Punjab', 'Lahore', '54000', '31.4888', '74.3686', 'Asia/Karachi', 1, 74, 'January', '2021'),
(168, 51, 'Chrome', 'PC', 'Window', 'N/A', 'Pakistan', 'PB', 'Punjab', 'Lahore', '54000', '31.4888', '74.3686', 'Asia/Karachi', 1, 74, 'January', '2021'),
(169, 43, 'Chrome', 'PC', 'Window', 'N/A', 'Pakistan', 'PB', 'Punjab', 'Lahore', '54000', '31.4888', '74.3686', 'Asia/Karachi', 1, 52, 'January', '2021'),
(170, 41, 'Chrome', 'PC', 'Window', 'N/A', 'Pakistan', 'SD', 'Sindh', 'Karachi', '', '24.8127', '67.0115', 'Asia/Karachi', 1, 52, 'January', '2021'),
(171, 43, 'Chrome', 'PC', 'Window', 'N/A', 'Pakistan', 'PB', 'Punjab', 'Lahore', '54000', '31.4931', '74.3699', 'Asia/Karachi', 1, 52, 'January', '2021'),
(172, 54, 'Chrome', 'PC', 'Window', 'http://localhost/fyp_project/Enterprise/Createlink.php', 'Pakistan', 'PB', 'Punjab', 'Lahore', '54000', '31.4931', '74.3699', 'Asia/Karachi', 1, 52, 'January', '2021');

-- --------------------------------------------------------

--
-- Table structure for table `guest_tab`
--

CREATE TABLE `guest_tab` (
  `id` int(11) NOT NULL,
  `long_url` varchar(255) NOT NULL,
  `short_url` varchar(255) NOT NULL,
  `hits` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guest_tab`
--

INSERT INTO `guest_tab` (`id`, `long_url`, `short_url`, `hits`, `created`) VALUES
(1, 'https://www.w3schools.com/php/php_form_complete.asp', '594M0Lw', 2, '2020-11-14 05:59:03'),
(2, 'https://www.w3schools.com/jsref/tryit.asp?filename=tryjsref_document_execcommand', 'NR1gFpA', 1, '2020-11-19 14:44:27'),
(3, 'https://www.geeksforgeeks.org/top-10-projects-for-beginners-to-practice-html-and-css-skills/', 'vP0MTh4', 1, '2021-01-03 14:15:16'),
(4, 'https://plagiarismdetector.net/paraphrasing-tool', 'tnFzyj0', 1, '2021-01-11 15:52:47'),
(5, 'https://preview.codecanyon.net/item/belink-ultimate-url-shortener/full_screen_preview/24354590?_ga=2.266810118.963466083.1601617600-1929780566.1597122821', '8BnGTGz', 1, '2021-01-14 20:38:57'),
(6, 'https://preview.codecanyon.net/item/belink-ultimate-url-shorten0?_ga=2.266810118.963466083.1601617600-1929780566.1597122821', 'S6BGwPj', 0, '2021-01-14 20:39:36'),
(7, 'https://www.w3schools.com/bootstrap4/bootstrap_buttons.asp', 'QT8rxsn', 1, '2021-01-14 20:41:40'),
(8, 'https://www.facebook.com/', 'pR6KZvW', 1, '2021-01-14 21:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(10) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `price` varchar(25) NOT NULL,
  `create_date` varchar(25) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `transaction_id`, `price`, `create_date`, `status`) VALUES
(1, 'T20210109155306', '100.00', '2021-01-09 11:53:45', '1'),
(2, 'T20210109155529', '20000.00', '2021-01-09 11:56:19', '1'),
(3, 'T20210109185247', '', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `query_report`
--

CREATE TABLE `query_report` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `query` varchar(255) NOT NULL,
  `admin_answer` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `query_report`
--

INSERT INTO `query_report` (`id`, `name`, `email`, `query`, `admin_answer`, `status`) VALUES
(1, 'waqas rasheed', 'hackerworld0304@gmail.com', 'plz make price low', 'yes if u can buy an offer for more month', 0),
(2, 'ali', 'ranafurqanasif042@gmail.com', 'hello', 'yes we can update it', 0),
(3, 'zahid', 'zahid@gmail.com', 'plz contact us', 'N/A', 1),
(4, 'Bilal Hussain', 'drbilalhussain6@gmail.com', 'offer is too expensive', 'N/A', 1);

-- --------------------------------------------------------

--
-- Table structure for table `short_urls`
--

CREATE TABLE `short_urls` (
  `id` int(11) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `long_url` varchar(255) NOT NULL,
  `short_url` varchar(255) NOT NULL,
  `url_type` enum('permanent_url','temporary_url') NOT NULL,
  `short_words` enum('random','custom') NOT NULL,
  `hide_pass` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `hits` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `expiry_date` varchar(255) NOT NULL,
  `expiry_status` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `short_urls`
--

INSERT INTO `short_urls` (`id`, `customer_id`, `long_url`, `short_url`, `url_type`, `short_words`, `hide_pass`, `status`, `hits`, `created`, `expiry_date`, `expiry_status`) VALUES
(39, 52, 'https://www.codeproject.com/Questions/1202510/Passing-parameter-with-location-href-to-the-action', '6MV8y81', 'permanent_url', 'random', 'N/A', 0, 10, '2020-12-13 00:00:00', '0000-00-00', 0),
(40, 52, 'https://www.w3resource.com/mysql-exercises/subquery-exercises/write-a-query-to-select-last-10-records-from-a-table.php', '4QcaJCw', 'temporary_url', 'random', 'N/A', 0, 20, '2020-12-13 00:00:00', '2021-01-01', 1),
(41, 52, 'https://getbootstrap.com/docs/4.3/getting-started/introduction/', 'introboo', 'permanent_url', 'custom', 'azeem123', 1, 6, '2020-12-13 00:00:00', '0000-00-00', 0),
(42, 52, 'https://backlinko.com/hub/youtube/video-description', 'Cryvt3c', 'permanent_url', 'random', 'N/A', 0, 1, '2020-12-13 00:00:00', '0000-00-00', 0),
(43, 52, 'https://www.tutorialspoint.com/laravel/index.htm', 'WYy7C2x', 'permanent_url', 'random', 'N/A', 0, 25, '2020-12-13 00:00:00', '0000-00-00', 0),
(44, 52, 'https://www.sitepoint.com/an-introduction-to-mongodb/', 'N1VhwrL', 'temporary_url', 'random', 'waqas', 1, 7, '2021-01-01 00:00:00', '2021-01-06', 1),
(51, 74, 'https://pixabay.com/vectors/', 'XFY4MGm', 'permanent_url', 'random', 'N/A', 0, 2, '2021-01-11 00:00:00', '0000-00-00', 0),
(52, 74, 'https://app.infinityfree.net/login', 'Gcnx0J4', 'temporary_url', 'random', 'N/A', 0, 3, '2021-01-11 00:00:00', '2021-01-12', 0),
(54, 52, 'https://www.w3schools.com/bootstrap4/bootstrap_jumbotron.asp', 'introe', 'temporary_url', 'custom', 'N/A', 0, 1, '2021-01-15 00:00:00', '2021-01-22', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_area`
--
ALTER TABLE `admin_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `detection`
--
ALTER TABLE `detection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detection_ibfk_1` (`short_urls_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `guest_tab`
--
ALTER TABLE `guest_tab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `query_report`
--
ALTER TABLE `query_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `short_urls`
--
ALTER TABLE `short_urls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `short_urls_ibfk_1` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_area`
--
ALTER TABLE `admin_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `detection`
--
ALTER TABLE `detection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `guest_tab`
--
ALTER TABLE `guest_tab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `query_report`
--
ALTER TABLE `query_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `short_urls`
--
ALTER TABLE `short_urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `short_urls`
--
ALTER TABLE `short_urls`
  ADD CONSTRAINT `short_urls_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
