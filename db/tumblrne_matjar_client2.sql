-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2017 at 07:47 AM
-- Server version: 5.5.51-38.2
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tumblrne_matjar_client2`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
  `id` char(36) NOT NULL,
  `title` char(200) NOT NULL,
  `caption` varchar(250) NOT NULL,
  `image_extension` text NOT NULL,
  `order` int(11) unsigned NOT NULL,
  `status` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `caption`, `image_extension`, `order`, `status`) VALUES
('58ca774a-af40-438c-acd4-4f6cc0b90f98', 'Banner', '13', 'png', 0, 'active'),
('58ca79a6-6780-477e-8a0d-40c7c0b90f98', 'one', 'aa', 'jpg', 0, 'active'),
('58ca79de-ac10-49a6-bec8-4d4ac0b90f98', 'sports', 'aa', 'jpg', 0, 'active'),
('58ce843a-d54c-4061-83ed-4247c0b90f98', 'Running', 'Running', 'png', 0, 'active'),
('58ce8523-4544-4757-9a48-4de2c0b90f98', 'steph Curry', 'steph Curry', 'png', 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` char(36) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `details` mediumtext NOT NULL,
  `created` datetime NOT NULL,
  `status` tinytext NOT NULL,
  `token` varchar(250) DEFAULT NULL,
  `view_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `username`, `password`, `details`, `created`, `status`, `token`, `view_status`) VALUES
('58c820ff-cd20-47f9-88e0-7ebfc0b90f98', 'abdulbaten1983@gmail.com', '$2a$10$KRDye04yNxQfTt/y4QknQu8JTzu/L9bXHbS07tmbPFBAfcBTbnH.G', '{"fname":"Abdul","lname":"Baten","phone":"01725441424","address_line_1":"West Shewrapara,Mirpur.\\r\\n","address_line_2":"Dhaka - 1207","region":"Dhaka","poBox":"12345","country":"Bangladesh","state":"Dhaka"}', '2017-03-14 16:57:35', 'active', NULL, 1),
('58d788b4-506c-4477-b6c8-46d9c0b90f98', 'mz.7@msn.com', '$2a$10$jfnHySlMsXCAivCp9kRFm.Mw4RYpJUwfeWV3pL6NLTa7o.mD0cvnW', '{"fname":"\\u0645\\u0634\\u0627\\u0631\\u064a","lname":"\\u0627\\u0644\\u0628\\u0634\\u064a\\u0631\\u064a","phone":"8945555","address_line_1":"\\u0627\\u0644\\u062e\\u0628\\u0631","address_line_2":"\\u0627\\u0644\\u062e\\u0628\\u0631","region":"\\u0627\\u0644\\u062e\\u0628\\u0631","poBox":"30505","country":"Saudi Arabia","state":"Eastern Province"}', '2017-03-26 09:24:04', 'active', NULL, 1),
('58db53a9-6240-4282-822d-9195c0b90f98', 'msjabri1@yahoo.com', '$2a$10$6WDJNvux3RELxV4F5lsTau58Q0dzIP1pmEO2LSnde45x0nF6eETQK', '{"fname":"mohammed","lname":"Jabri","phone":"3024148204","address_line_1":"fddggh","address_line_2":"576jhgjjk","region":"dhgjhg","poBox":"465","country":"Saudi Arabia","state":"Al-Qassim"}', '2017-03-29 06:26:48', 'active', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `clients_order_status`
--

CREATE TABLE IF NOT EXISTS `clients_order_status` (
  `id` char(36) NOT NULL,
  `code` varchar(255) NOT NULL,
  `client_id` char(36) NOT NULL,
  `datetime` datetime NOT NULL,
  `data` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `section` varchar(100) NOT NULL,
  `is_viewed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients_order_status`
--

INSERT INTO `clients_order_status` (`id`, `code`, `client_id`, `datetime`, `data`, `status`, `section`, `is_viewed`) VALUES
('55586e8e-6658-49cf-953b-3689cdd1d5ac', 'cart1431858830', '553e1338-f3bc-4215-977d-054ecdd1d5ac', '2015-10-21 09:35:29', '[{"attributes":{"à¦°à¦™":"à¦¸à¦¾à¦¦à¦¾"},"cartThumbImage":"http://localhost/kaspersky/img/site/products/556fcd2f-cfb4-40c4-95a8-4871c0b90f98.jpg","product_id":"556fcd2f-cc8c-44aa-bf75-4871c0b90f98","product_title":"à¦Ÿà¦¾à¦™à§à¦—à¦¾à¦‡à¦² à¦¸à¦¿à¦²à§à¦• à¦¶à¦¾à§œà¦¿ ","cost":"3495","quantity":"1","unitPrice":"3495.00","discount":[{"type":"fixed"},{"amount":"5"},{"finalDiscount":"5"}],"productCode":"54323","productWeight":null}]', '', 'cart', 0),
('55810737-25a8-48bb-bb46-5173c0b90f99', 'fav1434519351', '553e1338-f3bc-4215-977d-054ecdd1d5ac', '2015-06-17 05:35:51', '["556f577b-0390-4ca3-835e-096bc0b90f98"]', '', 'fav', 0),
('558a47d6-e3a8-4910-9b55-5ff6c0b90f99', 'cart1435125718', '558a46da-ab0c-4707-bdf0-3ecbc0b90f99', '2015-06-24 07:13:35', '[{"attributes":{"N/A":"N/A"},"cartThumbImage":"http://www.labonno.com/engine/img/site/products/556f5e46-d2a4-4814-aae7-3636c0b90f98.jpg","product_id":"556f5e46-e04c-4c53-8fc5-3636c0b90f98","product_title":"à¦¬à¦¿à¦¸à¦¨à¦¾ à¦šà¦¾à¦¦à¦° ","cost":"500","quantity":"1","unitPrice":"500.00","discount":[{"type":""},{"amount":""},{"finalDiscount":"0"}],"productCode":"CODE-36663","productWeight":null}]', '', 'cart', 0),
('56909c71-9eac-45c5-8f7b-12c2cdd1d5ac', 'cart1452317809', '55113fb1-4d5c-41d0-8b7c-284bcdd1d5ac', '2016-01-09 05:37:47', '[{"attributes":{},"productKeyAttributesData":{"attribute_value_id":""},"product_id":"563b1a0b-7d58-4805-b99a-465ac0b90f99","product_title":"Kaspersky Internet Security 3 User","cost":"1799","quantity":"1","unitPrice":"1799.00","discount":[{"type":"fixed"},{"amount":"99"},{"finalDiscount":"99"}],"productCode":"KIS-3","productWeight":"0","productAvailableQuantity":"5"},{"attributes":{},"productKeyAttributesData":{"attribute_value_id":""},"product_id":"563b1a0b-7d58-4805-b99a-465ac0b90f99","product_title":"Kaspersky Internet Security 3 User","cost":"1799","quantity":"1","unitPrice":"1799.00","discount":[{"type":"fixed"},{"amount":"99"},{"finalDiscount":"99"}],"productCode":"KIS-3","productWeight":"0","productAvailableQuantity":"5"},{"attributes":{},"productKeyAttributesData":{"attribute_value_id":""},"product_id":"5639e663-30ec-456d-acd0-47f5c0b90f99","product_title":"Kaspersky Internet Security single User","cost":"899","quantity":"1","unitPrice":"899.00","discount":[{"type":"fixed"},{"amount":"99"},{"finalDiscount":"99"}],"productCode":"KIS-1","productWeight":"0","productAvailableQuantity":"2"}]', '', 'cart', 0);

-- --------------------------------------------------------

--
-- Table structure for table `english_banners`
--

CREATE TABLE IF NOT EXISTS `english_banners` (
  `id` char(36) NOT NULL,
  `title` char(200) NOT NULL,
  `caption` varchar(250) NOT NULL,
  `image_extension` text NOT NULL,
  `order` int(11) unsigned NOT NULL,
  `status` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `english_banners`
--

INSERT INTO `english_banners` (`id`, `title`, `caption`, `image_extension`, `order`, `status`) VALUES
('58ca774a-af40-438c-acd4-4f6cc0b90f98', 'shope', '5', 'jpg', 0, 'active'),
('58ca79a6-6780-477e-8a0d-40c7c0b90f98', 'one', 'aa', 'jpg', 0, 'active'),
('58ca79de-ac10-49a6-bec8-4d4ac0b90f98', 'sports', 'aa', 'jpg', 0, 'active'),
('58ce843a-d54c-4061-83ed-4247c0b90f98', 'Running', 'Running', 'png', 0, 'active'),
('58ce8523-4544-4757-9a48-4de2c0b90f98', 'steph Curry', 'steph Curry', 'png', 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `english_galleries`
--

CREATE TABLE IF NOT EXISTS `english_galleries` (
  `id` char(36) NOT NULL,
  `title` char(200) NOT NULL,
  `caption` varchar(250) NOT NULL,
  `details` mediumtext NOT NULL,
  `url` varchar(300) NOT NULL,
  `image_extension` text NOT NULL,
  `order` int(11) unsigned NOT NULL,
  `is_special` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `english_galleries`
--

INSERT INTO `english_galleries` (`id`, `title`, `caption`, `details`, `url`, `image_extension`, `order`, `is_special`) VALUES
('5826dabb-1f78-476f-a288-1733cdd1d5ac', 'Gallery - 1', 'Gallery - 1', 'sdfdsf', '', 'jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE IF NOT EXISTS `galleries` (
  `id` char(36) NOT NULL,
  `title` char(200) NOT NULL,
  `caption` varchar(250) NOT NULL,
  `details` mediumtext NOT NULL,
  `url` varchar(300) NOT NULL,
  `image_extension` text NOT NULL,
  `order` int(11) unsigned NOT NULL,
  `is_special` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `title`, `caption`, `details`, `url`, `image_extension`, `order`, `is_special`) VALUES
('5826dabb-1f78-476f-a288-1733cdd1d5ac', 'Gallery - 1', 'Gallery - 1', 'sdfdsf', '', 'jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `homeblocks`
--

CREATE TABLE IF NOT EXISTS `homeblocks` (
  `id` char(36) NOT NULL,
  `title` varchar(200) NOT NULL,
  `url` mediumtext NOT NULL,
  `image_extension` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `homeblocks`
--

INSERT INTO `homeblocks` (`id`, `title`, `url`, `image_extension`, `status`) VALUES
('54794195-5a78-4206-92ad-1265cdd1d5ac', 'dsfdsf', 'http://localhost:9000/#/shop/brands', 'jpeg', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `lookbooks`
--

CREATE TABLE IF NOT EXISTS `lookbooks` (
  `id` char(36) NOT NULL,
  `title` char(200) NOT NULL,
  `caption` varchar(250) NOT NULL,
  `details` mediumtext NOT NULL,
  `url` varchar(300) NOT NULL,
  `image_extension` text NOT NULL,
  `order` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lookbooks`
--

INSERT INTO `lookbooks` (`id`, `title`, `caption`, `details`, `url`, `image_extension`, `order`) VALUES
('54780b1f-8074-4e9d-b2a4-1514cdd1d5ac', 'test', 'dsf', '<p>dsf<br></p>', '', 'jpeg', 0),
('55111f71-e084-4f36-a55b-2670cdd1d5ac', 'Test lookbook', 'LookBook caption-2', '<p>dxfdszfgxdgsd</p>', 'https://facebook.com', 'jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients_order_status`
--
ALTER TABLE `clients_order_status`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `english_banners`
--
ALTER TABLE `english_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `english_galleries`
--
ALTER TABLE `english_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeblocks`
--
ALTER TABLE `homeblocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lookbooks`
--
ALTER TABLE `lookbooks`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
