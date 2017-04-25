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
-- Database: `tumblrne_matjar_cms2`
--

-- --------------------------------------------------------

--
-- Table structure for table `baskets`
--

CREATE TABLE IF NOT EXISTS `baskets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `basketSession` varchar(100) DEFAULT NULL,
  `product_id` varchar(65) DEFAULT NULL,
  `total_quantity` int(11) NOT NULL,
  `productPrice` float(7,2) DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=261 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `baskets`
--

INSERT INTO `baskets` (`id`, `user_id`, `basketSession`, `product_id`, `total_quantity`, `productPrice`, `created`) VALUES
(115, 0, '16101127am', '56efb4c7-47e8-419a-8b6f-1058cdd1d5ac', 1, 100.00, '2016-04-06 14:44:59'),
(112, 0, '16044238am', '56efb4c7-47e8-419a-8b6f-1058cdd1d5ac', 1, 100.00, '2016-04-06 04:42:58'),
(110, 0, '16100747am', '56efb4c7-47e8-419a-8b6f-1058cdd1d5ac', 2, 100.00, '2016-04-05 11:59:34'),
(111, 0, '16100747am', '56efbaac-e494-47a0-9532-1058cdd1d5ac', 1, 103.00, '2016-04-05 12:00:01'),
(86, 0, '16083518am', '56efbaac-e494-47a0-9532-1058cdd1d5ac', 1, 103.00, '2016-04-04 10:07:51'),
(85, 0, '16083518am', '56efb4c7-47e8-419a-8b6f-1058cdd1d5ac', 1, 100.00, '2016-04-04 10:07:47'),
(76, 0, '16122438pm', '56efb4c7-47e8-419a-8b6f-1058cdd1d5ac', 3, 100.00, '2016-03-31 12:24:42'),
(75, 0, '16070959am', '56efbaac-e494-47a0-9532-1058cdd1d5ac', 4, 103.00, '2016-03-31 10:50:49'),
(73, 0, '16091241am', '56efbaac-e494-47a0-9532-1058cdd1d5ac', 2, 103.00, '2016-03-30 11:01:04'),
(71, 0, '16091241am', '56efb4c7-47e8-419a-8b6f-1058cdd1d5ac', 2, 100.00, '2016-03-30 10:59:05'),
(57, 0, '16044744am', '56efbaac-e494-47a0-9532-1058cdd1d5ac', 1, 103.00, '2016-03-28 04:57:05'),
(116, 0, '16044857am', '56efcf28-3034-4683-8d9f-1058cdd1d5ac', 1, 2000.00, '2016-04-07 04:49:06'),
(117, 0, '16053754am', '56efb4c7-47e8-419a-8b6f-1058cdd1d5ac', 1, 100.00, '2016-04-07 05:37:57'),
(125, 0, '16090858am', '56efb4c7-47e8-419a-8b6f-1058cdd1d5ac', 3, 100.00, '2016-04-09 09:09:16'),
(124, 0, '16045026am', '56efcf28-3034-4683-8d9f-1058cdd1d5ac', 2, 2000.00, '2016-04-09 04:50:35'),
(177, 0, '16111033am', '57089712-e8ec-4849-b5cc-a3d0c0b90f98', 1, 163.00, '2016-04-25 12:10:34'),
(176, 0, '16111033am', '570896bf-4104-4a38-b570-9a53c0b90f98', 1, 6.00, '2016-04-25 12:10:28'),
(161, 0, '16050046am', '5705f3e3-7c1c-4386-b728-4976c0b90f98', 1, 7.90, '2016-04-18 05:01:04'),
(164, 0, '16053102am', '5704ffd9-a514-46fe-a796-4b47c0b90f98', 1, 7.90, '2016-04-18 05:31:07'),
(165, 0, '16072950am', '570608dc-6eb0-400a-8d4c-41e7c0b90f98', 2, 22.90, '2016-04-19 07:31:20'),
(166, 0, '16114330am', '5704ffd9-a514-46fe-a796-4b47c0b90f98', 1, 7.90, '2016-04-19 11:47:45'),
(167, 0, '16045418am', '5704ff6c-a8a8-4444-8060-4d02c0b90f98', 1, 10.00, '2016-04-23 04:54:43'),
(171, 0, '16054402am', '570b3a12-47d4-4bd5-9cf9-4c51c0b90f98', 1, 19.00, '2016-04-25 05:44:14'),
(172, 0, '16044848am', '570b3987-3720-45b0-85cf-47b4c0b90f98', 1, 8.00, '2016-04-25 05:50:39'),
(173, 0, '16111033am', '5704ff6c-a8a8-4444-8060-4d02c0b90f98', 1, 10.00, '2016-04-25 11:19:40'),
(174, 0, '16111033am', '570b39a4-a5e8-47ad-8bad-419fc0b90f98', 2, 6.00, '2016-04-25 12:09:54'),
(175, 0, '16111033am', '5708966a-f9a4-45a0-a940-9152c0b90f98', 2, 6.00, '2016-04-25 12:10:02'),
(178, 0, '16054111am', '570b39c6-dbe8-4f9d-8559-4809c0b90f98', 1, 17.50, '2016-04-26 06:57:49'),
(179, 0, '16075224am', '5704ff9f-1054-482a-9574-436fc0b90f98', 1, 6.50, '2016-04-26 07:52:35'),
(191, 0, '16100814am', '570b393f-9184-4299-9594-4878c0b90f98', 3, 24.90, '2016-05-03 10:56:22'),
(192, 0, '16120622pm', '5705f3e3-7c1c-4386-b728-4976c0b90f98', 1, 7.90, '2016-05-04 12:25:16'),
(217, 0, '16051133am', '570b39ea-e014-4d37-b79f-453cc0b90f98', 1, 8.90, '2016-05-05 06:16:45'),
(218, 0, '16104808am', '5726e45b-95bc-480c-b979-41c8c0b90f98', 2, 8.90, '2016-05-09 11:32:39'),
(219, 0, '16070234am', '5726e2d3-c3b0-442a-a179-4193c0b90f98', 6, 6.90, '2016-05-11 07:03:25'),
(190, 0, '16100814am', '5704ff6c-a8a8-4444-8060-4d02c0b90f98', 1, 10.00, '2016-05-03 10:55:23'),
(189, 0, '16100814am', '570b3a46-c2b4-4779-849b-40cbc0b90f98', 1, 185.00, '2016-05-03 10:55:07'),
(228, 0, '16070234am', '5726e384-f92c-4ee6-895d-434fc0b90f98', 5, 6.50, '2016-05-11 10:49:35'),
(229, 0, '16070234am', '5726e350-ba5c-4183-9e12-4a42c0b90f98', 3, 10.00, '2016-05-11 10:53:02'),
(230, 0, '16070234am', '5726e41a-969c-4891-bc58-4434c0b90f98', 1, 7.90, '2016-05-11 10:53:07'),
(231, 0, '16070234am', '5726e543-3280-4ba8-8a53-44fdc0b90f98', 1, 8.90, '2016-05-11 10:53:11'),
(237, 0, '16053714am', '5726e2d3-c3b0-442a-a179-4193c0b90f98', 1, 6.90, '2016-05-24 06:45:01'),
(233, 0, '16070234am', '5726ea96-ad68-43f3-bdce-7fa0c0b90f98', 1, 5.90, '2016-05-11 10:53:18'),
(232, 0, '16070234am', '5726e695-a9e0-4c52-8ddd-117dc0b90f98', 1, 6.90, '2016-05-11 10:53:15'),
(234, 0, '16111040am', '5726e2d3-c3b0-442a-a179-4193c0b90f98', 1, 6.90, '2016-05-11 11:11:02'),
(240, 0, '16053333am', '5726e350-ba5c-4183-9e12-4a42c0b90f98', 1, 10.00, '2016-07-14 09:12:06'),
(246, 0, '16095249am', '5726e722-4f08-4753-ad02-2049c0b90f98', 1, 6.50, '2016-07-14 11:14:32'),
(247, 0, '16093436am', '5726e45b-95bc-480c-b979-41c8c0b90f98', 11, 8.90, '2016-07-19 09:34:54'),
(248, 0, '16093436am', '5726e491-7f4c-44f0-8072-47d2c0b90f98', 9, 7.90, '2016-07-19 09:34:56'),
(249, 0, '16110817am', '5726eb38-abb4-4cd4-9a62-949dc0b90f98', 1, 8.90, '2016-07-25 11:08:33'),
(250, 0, '16110817am', '5726ee5e-0170-457f-b442-ec61c0b90f98', 1, 17.50, '2016-07-25 11:08:35');

-- --------------------------------------------------------

--
-- Table structure for table `currency_values`
--

CREATE TABLE IF NOT EXISTS `currency_values` (
  `id` tinyint(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `value` varchar(50) CHARACTER SET utf8 NOT NULL,
  `symbol` varchar(50) CHARACTER SET utf8 NOT NULL,
  `paypal_currency` varchar(100) CHARACTER SET utf8 NOT NULL,
  `status` tinytext NOT NULL,
  `currency_type` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency_values`
--

INSERT INTO `currency_values` (`id`, `name`, `value`, `symbol`, `paypal_currency`, `status`, `currency_type`) VALUES
(1, 'USD', '1', 'SAR', 'USD', '1', 'international'),
(2, 'Saudi riyal', '3.75', 'ر.س', 'BDT', '1', 'local');

-- --------------------------------------------------------

--
-- Table structure for table `english_menus`
--

CREATE TABLE IF NOT EXISTS `english_menus` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `location` tinytext NOT NULL,
  `type` tinytext NOT NULL,
  `link_data` text NOT NULL,
  `is_deleteable` tinytext NOT NULL,
  `order` int(11) unsigned NOT NULL,
  `status` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `english_menus`
--

INSERT INTO `english_menus` (`id`, `parent_id`, `title`, `slug`, `location`, `type`, `link_data`, `is_deleteable`, `order`, `status`) VALUES
('58ba54ae-3e30-4bba-a690-4aa4c0b90f98', '', 'Store Locator', '', 'header', 'content', 'store-locator--', 'yes,yes', 1, 'active'),
('58ba55e2-6ce4-4a63-864f-4320c0b90f98', '', 'About Us', '', 'header', 'content', 'about-us', 'yes,yes', 2, 'active'),
('58ba5605-8644-477f-900c-47f0c0b90f98', '', 'Matjar Alwatany', '', 'footer_top', 'static', '/', 'yes,yes', 1, 'active'),
('58ba5623-e7a0-4264-a575-458fc0b90f98', '58ba5605-8644-477f-900c-47f0c0b90f98', 'About Us', '', 'footer_top', 'content', 'about-us', 'yes,yes', 2, 'active'),
('58ba563a-8a50-4c4c-a6fd-4e6bc0b90f98', '58ba5605-8644-477f-900c-47f0c0b90f98', 'Store Locator', '', 'footer_top', 'content', 'store-locator--', 'yes,yes', 3, 'active'),
('58ba565e-ff50-4a56-a9f2-4298c0b90f98', '58ba5605-8644-477f-900c-47f0c0b90f98', 'Careers', '', 'footer_top', 'content', 'careers', 'yes,yes', 4, 'active'),
('58ba5677-5d4c-4b2c-b934-4106c0b90f98', '58ba5605-8644-477f-900c-47f0c0b90f98', 'Contact Us', '', 'footer_top', 'content', 'contact-us', 'yes,yes', 5, 'active'),
('58ba568e-d060-488e-83ef-4869c0b90f98', '', 'Customer Care', '', 'footer_top', 'static', '/', 'yes,yes', 7, 'active'),
('58ba56a5-ee10-4d98-b4d1-4f29c0b90f98', '58ba568e-d060-488e-83ef-4869c0b90f98', 'FAQ', '', 'footer_top', 'content', 'faq', 'yes,yes', 8, 'active'),
('58ba56cb-e2fc-41f8-b3c0-46b5c0b90f98', '58ba568e-d060-488e-83ef-4869c0b90f98', 'Track Order', '', 'footer_top', 'content', 'track-order', 'yes,yes', 9, 'active'),
('58ba56f6-30ec-4cfc-b503-454fc0b90f98', '58ba568e-d060-488e-83ef-4869c0b90f98', 'Payment Methods', '', 'footer_top', 'content', 'payment-methods', 'yes,yes', 10, 'active'),
('58ba5719-39a0-456f-aada-44f6c0b90f98', '58ba568e-d060-488e-83ef-4869c0b90f98', 'Size Guide', '', 'footer_top', 'content', 'size-guide', 'yes,yes', 11, 'active'),
('58ba5749-7390-418d-9fc4-433dc0b90f98', '58ba568e-d060-488e-83ef-4869c0b90f98', 'Shipping Info', '', 'footer_top', 'content', 'shipping-policy', 'yes,yes', 12, 'active'),
('58ba5764-fd84-4c0a-85aa-4933c0b90f98', '58ba568e-d060-488e-83ef-4869c0b90f98', 'Returns', '', 'footer_top', 'content', 'returns', 'yes,yes', 13, 'active'),
('58ba87a1-1254-435a-ba8d-a853c0b90f98', '', 'Privacy Policy', '', 'footer', 'content', 'privacy', 'yes,yes', 1, 'active'),
('58ba87c7-1080-4e37-8a16-ad9bc0b90f98', '', 'Terms & Conditions', '', 'footer', 'content', 'terms-and-conditions', 'yes,yes', 2, 'active'),
('58ba8804-f1e4-4abb-b8ef-b5cfc0b90f98', '', 'Cookies', '', 'footer', 'content', 'cookies', 'yes,yes', 3, 'active'),
('58ba8818-6ea8-4631-a211-b877c0b90f98', '', 'FAQ', '', 'footer', 'content', 'faq', 'yes,yes', 4, 'active'),
('58c0fcdc-81b0-4adb-a9a8-49d3c0b90f98', '58ba5605-8644-477f-900c-47f0c0b90f98', 'Locations', '', 'footer_top', 'functional', 'locations', 'yes,no', 6, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `english_overviews`
--

CREATE TABLE IF NOT EXISTS `english_overviews` (
  `id` smallint(5) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `num_of_items` int(11) NOT NULL,
  `status` tinytext NOT NULL,
  `cssClass` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `english_overviews`
--

INSERT INTO `english_overviews` (`id`, `title`, `num_of_items`, `status`, `cssClass`) VALUES
(1, 'Brand', 16, 'active', 'cubes'),
(2, 'cities', 18, 'active', 'map-marker'),
(3, 'stores', 40, 'active', 'home'),
(4, 'years', 60, 'active', 'calendar');

-- --------------------------------------------------------

--
-- Table structure for table `english_web_pages`
--

CREATE TABLE IF NOT EXISTS `english_web_pages` (
  `id` char(36) NOT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `meta_keys` varchar(60) NOT NULL,
  `meta_description` varchar(150) NOT NULL,
  `description` mediumtext NOT NULL,
  `status` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `english_web_pages`
--

INSERT INTO `english_web_pages` (`id`, `title`, `slug`, `meta_keys`, `meta_description`, `description`, `status`) VALUES
('582af03d-6da8-4f08-81cb-4404c0b90f98', 'Store Locator--', 'store-locator--', 'Store Locator', 'Store Locator', '<div class="info-boxes">      <div class="storelocator"><img src="http://uysys.net/demo/matjar-alwatany/storelocator.png" alt="Store Locator" class="fr-fin"></div></div>', 'active'),
('582af117-c410-4eda-87c8-46acc0b90f98', 'Privacy--', 'privacy--', 'Privacy--', 'Privacy--', '<p>Coming Soon</p>', 'inactive'),
('582af15b-09e4-4245-824a-46bac0b90f98', 'Company News', 'company-news', 'Company News', 'Company News', '<p></p><div id="idTextPanel" class="jqDnR">  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.  Aenean commodo ligula eget dolor.  Aenean massa.  Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.  Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.  Nulla consequat massa quis enim.  Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.  In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>  <p> Nullam dictum felis eu pede mollis pretium.  Integer tincidunt.  Cras dapibus.  Vivamus elementum semper nisi.  Aenean vulputate eleifend tellus.  Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.  Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.  Phasellus viverra nulla ut metus varius laoreet.  Quisque rutrum.  Aenean imperdiet.  Etiam ultricies nisi vel augue.  Curabitur ullamcorper ultricies nisi.  Nam eget dui.</p>  <p>Etiam rhoncus.  Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.  Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.  Maecenas nec odio et ante tincidunt tempus.  Donec vitae sapien ut libero venenatis faucibus.  Nullam quis ante.  Etiam sit amet orci eget eros faucibus tincidunt.  Duis leo.  Sed fringilla mauris sit amet nibh.  Donec sodales sagittis magna.  Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.  Fusce vulputate eleifend sapien.  Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.  Nullam accumsan lorem in dui.  Cras ultricies mi eu turpis hendrerit fringilla.  Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi</p></div>', 'active'),
('582af177-80a4-4964-8830-4535c0b90f98', 'Careers', 'careers', 'Careers', 'Careers', '<p></p><div id="idTextPanel" class="jqDnR">  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.  Aenean commodo ligula eget dolor.  Aenean massa.  Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.  Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.  Nulla consequat massa quis enim.  Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.  In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>  <p> Nullam dictum felis eu pede mollis pretium.  Integer tincidunt.  Cras dapibus.  Vivamus elementum semper nisi.  Aenean vulputate eleifend tellus.  Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.  Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.  Phasellus viverra nulla ut metus varius laoreet.  Quisque rutrum.  Aenean imperdiet.  Etiam ultricies nisi vel augue.  Curabitur ullamcorper ultricies nisi.  Nam eget dui.</p>  <p>Etiam rhoncus.  Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.  Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.  Maecenas nec odio et ante tincidunt tempus.  Donec vitae sapien ut libero venenatis faucibus.  Nullam quis ante.  Etiam sit amet orci eget eros faucibus tincidunt.  Duis leo.  Sed fringilla mauris sit amet nibh.  Donec sodales sagittis magna.  Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.  Fusce vulputate eleifend sapien.  Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.  Nullam accumsan lorem in dui.  Cras ultricies mi eu turpis hendrerit fringilla.  Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi</p></div>', 'active'),
('582af195-8950-43e6-88b3-44acc0b90f98', 'Cookie Policy', 'cookie-policy', 'Cookie Policy', 'Cookie Policy', '<p></p><div id="idTextPanel" class="jqDnR">  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.  Aenean commodo ligula eget dolor.  Aenean massa.  Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.  Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.  Nulla consequat massa quis enim.  Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.  In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>  <p> Nullam dictum felis eu pede mollis pretium.  Integer tincidunt.  Cras dapibus.  Vivamus elementum semper nisi.  Aenean vulputate eleifend tellus.  Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.  Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.  Phasellus viverra nulla ut metus varius laoreet.  Quisque rutrum.  Aenean imperdiet.  Etiam ultricies nisi vel augue.  Curabitur ullamcorper ultricies nisi.  Nam eget dui.</p>  <p>Etiam rhoncus.  Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.  Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.  Maecenas nec odio et ante tincidunt tempus.  Donec vitae sapien ut libero venenatis faucibus.  Nullam quis ante.  Etiam sit amet orci eget eros faucibus tincidunt.  Duis leo.  Sed fringilla mauris sit amet nibh.  Donec sodales sagittis magna.  Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.  Fusce vulputate eleifend sapien.  Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.  Nullam accumsan lorem in dui.  Cras ultricies mi eu turpis hendrerit fringilla.  Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi</p></div>', 'active'),
('582afdd8-9b30-4c6d-8d79-c84fc0b90f98', 'Contact Us', 'contact-us', 'Contact Us', 'Contact Us', '<div class="col-xs-12 col-sm-4"><br><p><strong>Jeddah Wholesale<br></strong>Tel: +9662-6424621<br>Fax: +9662-6424258<br><strong>Riyadh Wholesale<br></strong>Tel: +9661-4749890<br>Fax: +9661-4749880<br><strong>Al-Khobar Wholesale<br></strong>Tel: +9663-8951760<br>Fax: +9663-8954656<br></p></div><div class="col-xs-12 col-sm-4"><br><p>&nbsp;SPORTS GHURNADA, Saudi Arabia<br>&nbsp;GO SPORT, Saudi Arabia<br>&nbsp;AL FALEH SPORTS, Saudi Arabia<br>&nbsp;BAHRAIN SHOOT, Bahrain<br>&nbsp;TOP WEAR, Saudi Arabia<br>&nbsp;QARRAT SPORT, Saudi Arabia<br>&nbsp;ARRIYADA SPORT, Saudi Arabia<br><br></p></div><div class="col-xs-12 col-sm-4"><br><strong>Our Head Office Location (AL Khobar)<br><img class="fr-fin" alt="Image title" src="http://matjaralwatany.com/img/loc.jpg" width="250"></strong></div>', 'active'),
('582afe54-861c-453d-98fb-d4f7c0b90f98', 'Brands', 'brands', 'Brands', 'Brands', '<p><strong>Lotto<br></strong></p><p><img class="fr-fil" alt="Image title" src="http://matjaralwatany.com/img/brand/lotto.jpg" width="150"> Lotto was established in 1973 by the Caberlotto family in Montebelluna, northern Italy, the world centre of footwear manufacturing. In June 1973, Lotto made its debut as a sports footwear manufacturer. Tennis shoes signaled the beginning of production, followed by models for basketball, volleyball, athletics and football. Today Lotto distributes its products in more than 70 countries through independent sports stores.<br><br>                    In June 1999 the Company was taken over by a group of local business people who were already very active in the sports segment. It was headed by Andrea Tomat, who took on the role of President and CEO of the new company, which was renamed Lotto Sport Italia S.p.A.<br><br>                    The new ownership''s objective was to exploit the brand''s strengths – dynamism, innovation, quality, Italian design and a real passion for sport – combined with its increasingly painstaking and effective customer service.<br><br><strong class="h10">Matjar Al Watany</strong> is the sole agent of Lotto Sport Italy for over 25 years now in Saudi Arabia and Bahrain market, and has been offering the brand through its almost 40 stores in 17 cities and around 200 point of sale of our valuable partners (key accounts).</p><hr><p><strong>Nike<br><img class="fr-fil" alt="Image title" src="http://matjaralwatany.com/img/brand/nike.jpg" width="150"></strong>The company was founded in January 25, 1964 as Blue Ribbon Sports by Bill Bowerman and Philip Knight, and officially became Nike, Inc. on May 30, 1978. Nike markets its products under its own brand, as well as Nike Golf, Nike Pro, Nike+, Air Jordan, Nike Skateboarding. Throughout the 1980s, Nike expanded its product line to encompass many sports and regions throughout the world.<br><br>                    Nike pays top athletes in many sports to use their products and promote and advertise their technology and design. During the past 20 years especially, Nike has been one of the major clothing and footwear sponsors for leading tennis players. Nike was the official kit sponsor for the Indian cricket team for five years, from 2006 until the end of 2010. <br><br>                    Today, Nike continues to seek new and innovative ways to develop superior athletic products, and creative methods to communicate directly with its consumers. The company has continued to expand in new ways, including strong growth in many markets and a deal to become the official sponsor of the National Football League (NFL) beginning in 2012.<br><br>                    Matjar Al Watany introduced the brand three years ago and it has grown rapidly with tremendous demand from the native consumers, new NIKE concepts (shop in shop) are on its way to selective prime shops! <br></p><hr><p><br></p><p><strong>Adidas<br><img class="fr-fil" alt="Image title" src="http://matjaralwatany.com/img/brand/adidas.jpg" width="150"></strong>Adidas was founded in 1948 by Adolf "Adi" Dassler, following the split of Gebrüder Dassler Schuhfabrik between him and his older brother Rudolf. Rudolf later established Puma, which was the early rival of Adidas. Registered in 1949, Adidas is currently based in Herzogenaurach, Germany, along with Puma. The company''s clothing and shoe designs typically feature three parallel bars, and the same pattern is incorporated into Adidas''s current official logo. The "Three Stripes" were bought from the Finnish sport company Karhu Sports in 1951.<br><br>                    Adidas is the world''s top international brand in sport segment and has bench mark in sponsoring top clubs, players and tournaments among various activities. <br><br><strong class="h10">Matjar Al Watany</strong> is offering Adidas through its 25 stores across the Kingdom with its two Shop in Shop concepts (SIS), one in Galaria Al Khobar store (165 sqm), another concept in Mahmal Jeddah. <br></p><hr><p><strong>Umbro</strong></p><p><img class="fr-fil" alt="Image title" src="http://matjaralwatany.com/img/brand/umbro.jpg" width="150"> The company was founded in 1924 in Wilmslow, Cheshire as Humphreys Brothers Clothing.</p><p>After working in various parts of the tailoring industry, Harold Humphreys set up Umbro with his brother Wallace, with the aim of bringing the ideals and practices of the industry into the burgeoning world of sportswear. Umbro, Ltd., a subsidiary of NIKE, Inc., is the original Manchester based football brand that invented sportswear and sports tailoring. Umbro''s first major football kit was made for Manchester City in 1934, a kit they won the FA Cup in. Today, the company combines its heritage in sports tailoring with modern football culture to create groundbreaking and iconic football apparel, footwear and equipment that blend performance and style.</p><p>Among the hottest brand on shelves, Matjar Al Watany carries UMBRO in almost 22 Point of Sales across Kingdom, UMBRO is known for its graphics in Soccer collection and quality of fabrics, come and check it out ..!</p><hr><p><strong>Lacoste</strong></p><p><img class="fr-fil" alt="Image title" src="http://matjaralwatany.com/img/brand/lacoste.jpg" width="150"> René Lacoste founded La Chemise Lacoste in 1933 with André Gillier, the owner and president of the largest French knitwear manufacturing firm at the time. They began to produce the revolutionary tennis shirt Lacoste had designed and worn on the tennis courts with the crocodile logo embroidered on the chest.</p><p>In 2005, almost 50 million Lacoste products sold in over 110 countries. Its visibility has increased due to the contracts between Lacoste and several young tennis players, including American tennis star Andy Roddick, French rising young prospect Richard Gasquet, and Swiss Olympic gold medalist Stanislas Wawrinka. Lacoste has also begun to increase its presence in the golf world.</p><p>Mahmal   Jeddah   shop   is   considered  to   be  the   oldest  shop   selling full   range of   Lacoste products   (more than 20years ago),   today,Matjar Al Watany, is well known, in selling attractive sport life style shoes and slippers for both men and women through its prime seven shops Kingdom wide.</p><hr><p><strong>Puma</strong></p><p><img class="fr-fil" alt="Image title" src="http://matjaralwatany.com/img/brand/puma.jpg" width="150"> Puma SE, officially branded as PUMA, is a major German multinational company that produces high-end athletic shoes, lifestyle footwear and other sportswear. Formed in 1924 as Gebrüder Dassler Schuhfabrik by Adolf and Rudolf Dassler, relationships between the two brothers deteriorated until the two agreed to split in 1948, forming two separate entities, Adidas andPuma. Puma is currently based in Herzogenaurach, Germany. the company is known for its football shoes and has sponsored acclaimed footballers. Puma AG has approximately 9,500 employees and distributes its products in more than 120 countries.</p><p>Matjar Al Watany is among the entrepreneur retailers who started selling PUMA, today, Matjar Al Watany carry attractive collection of Ferrari, Football, Running and Lifestyle among other apparel, footwear and accessories vibrant and recent collection.</p>', 'active'),
('582afea1-d160-460f-99f3-de7cc0b90f98', 'Terms And Conditions', 'terms-and-conditions', 'Terms And Conditions', 'Terms And Conditions', '<p></p><p><b>Terms and Conditions</b></p>  <p>Matjar Alwatany (“our”, “we”, “us”) website(s) ( “website”, “site”, or “sites”) and related services are made available to you pursuant to the following Terms and Conditions which include all other rules under any header published on our website, and which collectively make up our binding Terms of Use & Service (“TOS”). Clients (“you” “your”, ”their”) using our website inherently accept our Terms of Use & Service when choosing to browse and interact with our website.<br> <br> We may modify our Terms of Use & Service at any time, thus, we encourage our clients to visit and read these Terms of Use and Service regularly. If at any time, you decide that this TOS does not meet your agreement, then we regret the inconvenience and ask you to refrain from using our website.</p><p><br></p>    <p><b>1. Rudimentary Conditions and Limitations of Liability:</b></p>  <ul>  <li><p>Using      our website does not grant you any rights as to any of the content      available on our website such as copyrights, trademarks, designs,      graphics, photographs, sounds, music, video, audio and text. These      items of content are property of Matjar Alwatany or the third parties with      whom Matjar Alwatany is cooperating for the mutual benefit of this bona      fide ecommerce website. Therefore, any use of the above intellectual      property is strictly prohibited and punishable to the fullest extent      permitted by law.</p></li>  <li><p>Our website      is for personal use only and may not be commercialized by duplicating any      part of it, linking to it or referencing it without explicit written      authorization by MatjarAlwatany.</p></li>  <li><p>MatjarAlwatany’s      relationship with its customers is one of merchant and client and no other      representation is to be promoted or implied by you.</p></li>  <li><p>MatjarAlwatany      reserves the right to deny your access to its site should we feel that you      are not abiding by our Terms of Use and Service (TOS).</p></li>  <li><p>Matjar      Alwatany does not guarantee that there will not be any access delays or      interruptions of its website service; furthermore, Matjar Alwatany shall      not be held liable in anyway whatsoever for such delays or interruptions.</p></li>  <li><p>Matjar      Alwatany does not guarantee that its site is error free from either      content or function ability issues, nor does it guarantee that the site is      free from viruses, system failure or malfunction or any other possibly      harmful elements. You are responsible to make sure that your      computer is setup to use all preventative measures available to personal      computer users.</p></li>  <li><p>Matjar      Alwatany will make its best effort to represent the items that it is      selling to the best of its ability, however, no misrepresentation or      misunderstanding is to be construed as to have fraudulent intent.      Representation of products is subject to hardware and software constraints      of compatibility which may lead to such occurrences for which it is      pre-agreed that returns or refunds will be the maximum possible resolution      for such incidents.</p></li>  <li><p>Matjar      Alwatany does not guarantee, support, condone or endorse any third party      services or products that have hyperlinks on our website nor are we liable      for any loss incurred as a result of a customer choosing to visit these      hyperlinks. Customers choose to visit these third party sites on their own      responsibility.</p></li>  <li><p>MatjarAlwatany      has the right to compensation should your use of the website be abusive to      its function, operability, reputation and/or its client base whether it is      as a result of an intended or unintended action.</p></li>  <li><p>MatjarAlwatany      reserves the right to revoke any right or privilege given to its Customers      by these terms and conditions without notice so long as it is not a legal      right per the laws of the Kingdom of Saudi Arabia.</p></li>  <li><p>Further,      to the fullest extent permitted by law, Matjar Alwatany will not be liable      for any direct, indirect, special, incidental, or consequential damages of      any kind (including lost profits or opportunities) related to our website      or its use by you regardless of the form of action whether in contract,      tort (including negligence), or otherwise, even if we have been advised of      the possibility of such damages.</p></li> </ul>  <p><b>2. Registration / Account Eligibility:</b></p>  <ul>  <li><p>Customers must be living      personas intending to purchase or use our service for personal consumption/use      or for the gifting of other living personas. </p></li>  <li><p>Customers must provide      their real: name, address, phone number and email address and may not      impersonate any other person or entity.</p></li>  <li><p>Customers must provide      payment details, for which they are authorized to use including all      relevant info necessary for our payment gateway to verify, validate,      authorize and debit your account.</p></li>  <li><p>Customers are responsible      for keeping their personal information up to date and Matjar Alwatany is      not responsible for any mistakes or losses incurred as a result of      out-dated or incorrect client information.</p></li>  <li><p>Customers below the age of      16, or any age considered to be not legally binding to transact in their      country of residence, must get their parents to transact on their behalf      with Matja rAlwatany</p></li> </ul>  <p><b>3. Orders & Purchases:</b></p>  <p>Orders are subject to acceptance and availability of merchandise as well as all conditions set forth in these Terms of Use and Service (TOS).</p>  <p>The email entitled “Acknowledgement of Order Receipt” does not constitute an order confirmation. </p>  <p>We reserve the right at our sole discretion not to accept your order in any the event such as, but not limited to, we are unable to get authorization for your payment, the item you ordered cannot be legally shipped to your country of delivery, the item purchased is no longer in stock or the remaining items do not meet your quality inspection before shipment or for any reason that Matjar Alwatany deems that the transaction is not completely bona fide as per these Terms of Use and Service (TOS).</p>  <p>Only actual dispatch of your order constitutes a completion of contract transaction and thus the transaction will have been concluded in Saudi Arabia.</p>  <p>Each order placed at any given time is treated as a new and separate order subject to all the conditions of the TOS.</p>  <p><b>4. Pricing, Price Adjustments & Fees:</b></p>  <ul>  <li><p>Prices      shown on the website are in Saudi Riyals (SAR).</p></li>  <li><p>Prices      are set in the base currency sometimes weeks in advance of merchandise      availability and are subject to modification based on Manufacturer/Supplier      Suggested Retail Prices as well as currency fluctuations at any time;      however, any orders already placed by a client will be honored at the      price at which the customer placed the order.</p></li>  <li><p>All      purchases are charged as Delivery Duty Paid (DDP) therefore the final      purchase price will include shipping and import fees. Eventual,      additional, local taxes, not related to custom import, such as State Tax,      are not included and are the customer''s responsibility</p></li>  <li><p>If you      are a customer, whose payment method is based on a different currency than      the currency in which you have made your purchase, your final price will      be affected by your financial institution at the exchange rate and      commission that is charged by them and for which Matjar Alwatany is not      responsible.</p></li>  <li><p>Items      purchased in a sale or any special promotions are not eligible for further      price adjustments in case the same item becomes marked down further.</p></li>  <li><p>Shipping,      duties, and taxes are non refundable</p></li> </ul>    <p><b>5. Payments:</b></p>  <ul>  <li><p><b><i>Payments      can be made by Visa, MasterCard, CashU, OLP2, PayPal and cash on delivery</i></b>.</p></li>  <li><p>In      case your credit card issuer does not authorize your transaction, we will      not be able to prepare your goods for shipment thus incurring delays for      which we will not be responsible for.</p></li>  <li><p>Payments      will be debited from your account upon dispatch of your order by Matjar Alwatany.</p></li>  <li><p>Our      website uses Secure Socket Layer (SSL) Technology to safeguard your      personal information when processing payments which is the best practice      and standard in the industry, however, we are neither responsible nor      liable for any third party unauthorized use of your personal information      or payment method.</p></li> </ul>    <p><b>6. Delivery:</b></p>  <ul>  <li><p>Matjar      Alwatanyaims to dispatch and deliver your orders in a timely manner; we do      not guarantee any delivery date or delay and all mentions of delivery      dates/periods are based on best estimations. You can track your      order using the Air Way Bill number provided for you with your order to      make your own informed opinion of possible delivery date. Matjar Alwatany      will not be liable for any compensation for delivery delays.</p></li>  <li><p>MatjarAlwatany,      via our shipping agent, requires a signature for any goods to be      delivered.</p></li>  <li><p>We      insure your goods whilst being delivered but responsibility of your      order/goods immediately passes to you upon your signature of delivery or      the signature of an agent at the address provided by you at the time of      your order.</p></li>  <li><p>In the      case of a gift, proof of signature of the recipient of your gift or their      agent also finalizes MatjarAlwatany’s responsibility for your order/transaction.</p></li> </ul>    <p><b>7. Returns </b></p>  <ul>  <li><p>Our      Returns procedure is an intrinsic part of our exchange and refund policy      and must be followed for any exchanges or refunds to take place.</p></li> </ul>  <ul><li><p>If you want to return a product, please contact the Customer Services Department during the work hours (from Sunday to Thursday, from 9.00 am to 3.30 pm), mention the order number and request a return or exchange. Alternatively you can e-mail us on <a>customerservice@matjaralwatany.com</a> </p></li>  <li><p>The process of return shall be implemented within seven (7) days after you receive our email sent by the Customer Services Department, which contains the required information for the return process.</p></li>  <li><p>If you choose to return your item you will be refunded with Matjar Alwatany store credit that you can use online. You will not be able to use your online store credit in our physical stores.</p></li>  <li><p>Please note you will be liable to pay the delivery charges for any returns. </p></li>  <li><p>We do not exchange items as you can return your item and then choose another product with your online store credit. </p></li></ul>  <p>.</p>  <p><b>8. Final Conditions:</b></p>  <ul>  <li><p>The      above terms and conditions constitute a whole and at no part are they to      be segmented and viewed in parts. Should you break any of the      above conditions, Matjar Alwatany reserves the right to act in its      interest by taking the necessary action that it sees as appropriate within      the time frame that it sees as appropriate.No delay in action on      behalf of Matjar Alwatany shall constitute our consent on any of your      violation of these conditions.</p></li>  <li><p>Any      issue not addressed in these terms & conditions but referred to in our      website under “Privacy Policy” or our “Frequently Asked Questions” shall      be relevant to these terms and conditions and construed as a part of the      agreement with the client.</p></li>  <li><p>In the      case of any dispute, the customer and Matjar Alwatany agree that the laws      of the Kingdom of Saudi Arabia shall constitute the total, exclusive      applicable law to be used and no other country than Saudi Arabia shall      have jurisdiction over any part of Matjar Alwatany’s relationship with the      customer.</p></li>  <li><p>Matjar      Alwatany does not claim nor guarantee that the claims, terms and      conditions within this TOS, are representative of the laws pertaining to      the customer’s country of residence nor will these laws have any relevance      on any use of our website or order placed with us. Users who choose to      enter our website from locations where our website contents are illegal do      so at their own risk, and are solely responsible for any resulting breach      with respect to their relative local laws.</p></li>  <li><p>Matjar      Alwatany is neither responsible nor liable towards any government for any      of their residents who use our website illegally or for any duties or tax      on shipments shipped.</p></li>  <li><p>Once      you start to browse our website, it is acknowledged and understood that      you are there on your own volition and agree to all the above Terms of Use      & Service including our policies and procedures that are part of our      Privacy Policy and Frequently Asked Questions (FAQ) pages.</p></li> </ul>    <p><br></p>', 'active'),
('582afee2-0a98-461a-b1bf-e632c0b90f98', 'Exchang And Return Policy', 'exchang-and-return-policy', 'Exchang And Return Policy', 'Exchang And Return Policy', '<p></p><p><strong>&nbsp;Refund Policy<br></strong></p><p>We want you to be happy with your purchase. If you''re not, just return the item with proof of purchase and we''ll exchange it.</p><p>If you post a product to make a return, it can take up to 14 days of your returning the item(s) to receive your refund. If you return your order directly to an NRBBuySell.com office, we''ll process your refund immediately (though it can take up to 5 days for the bank to transfer the funds to you).</p><p>Please return the unused product to us within 14 days of receiving your order.Once returned, we’ll refund the person who originally placed and paid for the order. This includes Clearance.</p><p><b>Are there any products that can’t be returned?</b></p><p>We can’t offer refunds or exchanges, unless faulty or not as described, on the following items:</p><ul>  <li><p>Products which have been personalized      for you, such as stationery or gifts</p></li>  <li><p>Made to measure products such      as curtains or blinds</p></li>  <li><p>Perishable goods such as      flowers, food or real Christmas trees</p></li>  <li><p>Computer software that has been      opened, or computer software cards that have been redeemed</p></li>  <li><p>iTunes gift cards</p></li></ul><p><b>Terms and conditions</b></p><ul>  <li><p>If you''re unhappy with your      purchase, please let us know. Unless faulty, we''d like this to be within 14      days of purchase</p></li>  <li><p>If you return your item to one      of our office and you''d like a refund, we''ll give you a gift card to the      value of the current selling price if you have your receipt or delivery      note</p></li>  <li><p>It''s important that any      unwanted item, unless faulty, is returned in a resalable condition. We''d      expect this to mean that you''ve kept all original packaging and labels,      and that it''s undamaged and unused</p></li>  <li><p>Where a product has been made      to measure or personalized for you, unless faulty, we''re unable to refund      or offer an exchange. </p></li>  <li><p>For online or telephone      purchases we’ll refund the standard delivery charge, provided you return      the full order. If you are only returning some of the items on your order,      then we will only refund the cost of those items</p></li>  <li><p>This does not affect your      statutory rights</p></li></ul><h2>International Returns </h2><h3>What is the refund policy for international items?</h3><p>We want you to be happy with your purchase. If you''re not, please follow the instructions on our delivery note and return it to us at the address shown, obtaining proof of postage. Unless faulty, we''d like you to make your return within 21 days of purchase, and please note that you’ll need to bear postage costs. If the item is faulty, damaged or not as described, please call us on +88 09613717171, 7 days a week, 07:00AM to midnight (BST).</p><h3>How do I return an item by post internationally?</h3><p>If we''ve sent you the wrong items, or your order is faulty, damaged or not as described on arrival, please contact us on +88 09613717171. We will refund postal charges you incur to return such items. Please note that this refund will be in Dollar, and may therefore not equate exactly to the amount paid, owing to fluctuating exchange rates. In such scenario will follow the approved guideline from financial regulatory authority, Bangladesh Bank. </p><p>Please make sure that whatever your reason for returning goods, you obtain proof of postage from your post office, and we will credit your account as soon as possible.</p><h3>When will I receive a refund if I return an international delivery?</h3><p>If you have returned the item to us, your credit or debit card will be credited within 21 days of you sending the returned item.</p><p><br></p>', 'active'),
('582b00da-8080-45cd-9800-4016c0b90f98', 'Shipping Policy', 'shipping-policy', 'Shipping Policy', 'Shipping Policy', '<p></p><p><strong>Shipping Policy<br></strong></p><p><strong>How Product shipping weight measured and finalized?</strong><br></p><p>Generally Merchants/nrbbuysell.com measures two weights, gross and volumetric. Gross weight is the actual weight of the product that we traditionally measured in weighing scales.</p><p>Volumetric weight measures by Product after packaging: (Length X Height X Width) / 5000.This measurement may varyif any further notice by local relevant Logistics Service Providers&relevant regulatory authorities.</p><p><strong>What are the delivery charges?</strong><br></p><p>Shipping charge varies on destinations. All shipping charges will be visible in Cart Detail Section before you payout.nrbbuysell.com is engaged with globally and locally renowned shipping service providers like FedEx, DHL, Sky Net and EMS for overseas delivery with most competitive shipping charges. Logistics Service provider listing may change time to time depend on availability and service quality.</p><p><strong>What is the estimated delivery time?</strong><br></p><p>Merchants generally arrange and ship their product within following day/two. Business days exclude public holidays and Fridays.</p><p>Estimated delivery time depends on the following factors:</p><p>The Merchants offering the product</p><p>Product''s availability with the Merchants</p><p>The destination to which you want the order shipped to and location of the Seller.</p><p>Note: Especially for express service it takes 3 to 4 working days in many cases, depends on stable flight schedule.</p><p><strong>Are there any hidden costs (VAT, Other Taxes) in shipping charges for the product sold by Merchants through nrbbuysell.com?</strong><br></p><p>Shipping charges are not hidden charges and are charged (if at all) extra depending on the Merchant''s shipping policy.</p><p><strong>Why does the estimated delivery time vary for each Merchants?</strong><br></p><p>You have probably noticed varying estimated delivery times for Merchants of the product you are interested in. Delivery times are influenced by product availability, geographic location of the Merchants, your shipping destination and the courier partner''s time-to-deliver in your location.</p><p><strong>Is State/Province, City & zip code/Post Code mandatory for shipping products?</strong><br></p><p>State/Province, City & zip code/Post Code is mandatory for successful shipping a product.</p><p>Whether your location can be serviced or not depends on</p><p>Whether the Merchants/nrbbuysell.com ships to your location</p><p>Legal restrictions, if any, in shipping particular products to your location</p><p>The availability of reliable courier partners in your location</p><p> At times Merchants/nrbbuysell.com prefer not to ship to certain locations. This is entirely at their discretion.</p><p><strong>I need to return an item, how do I arrange for a pick-up?</strong><br></p><p>Returns are easy. Contact Us to initiate a return. You may call/e-mail/chat discussing the process, once you have initiated a return. You can return the item through a courier service. Return fees are borne by the buyer, but the resend shipping charges will be borne by Merchant/nrbbuysell.com.Any Duties and Taxes attached with the return process will borne by parties paying shipping charges. Any changes in the policy are sole discretion of Merchant/nrbbuysell.com Management.</p><p><strong>Does nrbbuysell.com arrange shipping internationally?</strong><br></p><p>As of now, nrbbuysell.com id committed to facilitate buy and sell of Bangladeshi Brands to Non Resident Bangladeshis (NRBs) residing abroad, so for this Merchants/nrbbuysell.com partnered with worlds renowned and best performing shipping partners for as part of best shipping experience to Customers. .<br><br> You will be able to make your purchases on our site from anywhere in the world with credit cards issued in Bangladesh and all other countries of the world, but please ensure the delivery address should be accurate with proper Country, State/Province and Zip code/Postal Code numbers.</p><p><br></p>', 'active'),
('582c493f-9670-4fed-86e8-4e27c0b90f98', 'About Us', 'about-us', 'About Us', 'About Us', '<p><img data-fr-image-preview="true" alt="Image title" src="http://www.matjaralwatany.com/img/history.jpg" width="326" class="fr-fin" style="border: 3px solid #000; margin-left:auto; margin-right:auto;"><br></p><p><br></p><p><br></p><p><br></p><p>Matjar Al Watany, was founded in 1953 by Mr. Mohammad Yousaf Sulaiman Al Sheikh as a general trading company in 1980 the business was diversified much towards sports industry.&nbsp;</p><p><br>Mr. Salah M. Sulaiman acquired the position of sole proprietor of the organization in 1990 and established sports retail chain under the name "Matjar Al Watany" – National Stores. </p><p>Today the organization  operates in two segments of business.</p><p><br><strong>Retail Segment :</strong> Comprises of 40 stores extending its tentacles in all the major Urban City''s as well in  the up country market for the consumer need and satisfaction. <br></p><p><strong>The Wholesale :</strong> Operates through our branch offices in Jeddah, Riyadh & Al-Khobar. Our territory of wholesale business caters KSA, Egypt, Kuwait & Bahrain.<br></p>', 'active'),
('582d48a2-0c04-458b-991d-4f89c0b90f98', 'Mission & Vision', 'mission-&-vision', 'Mission & Vision', 'Mission & Vision', '<p><strong class="h9">VISION<br></strong></p><p>To be a part of Saudis’ life as a major provider of Sports Products.</p><p><br></p><p><strong class="h9">MISSION STATMENT<br></strong></p><p>With an integrated companywide value chain, we strive to act with honesty and fairness, to completely satisfy the needs of Saudi youth along with Expatriates, Corporate and Government sector by delivering throughout the Kingdom''s major and provincial cities high quality international sports and lifestyle brands while promoting and encouraging neighborhood sports activities, and in the process, securing stable growth in total revenue and profitability.<br></p>', 'active'),
('582d8545-2e7c-4782-879e-486fc0b90f98', 'Privacy', 'privacy', 'Privacy', 'Privacy', '<p></p><p>This privacy policy has been compiled to better serve those who are concerned with how we collect and use the information that you provide us with. Please read our privacy policy carefully to get a clear understanding of how we collect, use, protect or otherwise handle your data.<br></p>    <p><b>What personal information do we collect from the people that visit our blog, website or app?</b></p>    <p>When ordering or registering on our site, as appropriate, you may be asked to enter your name, email address, mailing address, phone number, credit card information or other details to help you with your experience.</p>    <p><b>When do we collect information?</b></p>    <p>We collect information from you when you register on our site, place an order, subscribe to a newsletter, fill out a form or enter information on our site.</p>  <p><br> Provide us with feedback on our products or services</p>  <p><b>How do we use your information?</b></p>    <p>We may use the information we collect from you when you register, make a purchase, sign up for our newsletter, respond to a survey or marketing communication, surf the website, or use certain other site features in the following ways:</p>  <p><b>•</b>To personalize your experience and to allow us to deliver the type of content and product offerings in which you are most interested.</p>  <p><b>•</b>To improve our website in order to better serve you.</p>  <p><b>•</b>To allow us to better service you in responding to your customer service requests.</p>  <p><b>•</b>To administer a contest, promotion, survey or other site feature.</p>  <p><b>•</b>To quickly process your transactions.</p>  <p><b>•</b>To follow up with them after correspondence (live chat, email or phone inquiries)</p>    <p><b>How do we protect your information?</b></p>  <p>Our website is scanned on a regular basis for security holes and known vulnerabilities in order to make your visit to our site as safe as possible.</p>  <p>We use regular Malware Scanning.</p>  <p>Your personal information is contained behind secured networks and is only accessible by a limited number of persons who have special access rights to such systems, and are required to keep the information confidential. In addition, all sensitive/credit information you supply is encrypted via Secure Socket Layer (SSL) technology.</p>  <p>We implement a variety of security measures when a user places an order enters, submits, or accesses their information to maintain the safety of your personal information.</p>  <p>All transactions are processed through a gateway provider and are not stored or processed on our servers.</p>    <p><b>Do we use ''cookies''?</b></p>  <p>Yes. Cookies are small files that a site or its service provider transfers to your computer''s hard drive through your Web browser (if you allow) that enables the site''s or service provider''s systems to recognize your browser and capture and remember certain information. For instance, we use cookies to help us remember and process the items in your shopping cart. They are also used to help us understand your preferences based on previous or current site activity, which enables us to provide you with improved services. We also use cookies to help us compile aggregate data about site traffic and site interaction so that we can offer better site experiences and tools in the future.</p>  <p><br> <b>We use cookies to:</b></p>  <p><b>•</b>Help remember and process the items in the shopping cart.</p>  <p><b>•</b>Understand and save user''s preferences for future visits.</p>  <p><br> You can choose to have your computer warn you each time a cookie is being sent, or you can choose to turn off all cookies. You do this through your browser settings. Since each browser is a little different, look at your browser''s Help Menu to learn the correct way to modify your cookies.</p>  <p>If you turn cookies off, some features will be disabled. It won''t affect the user''s experience that make your site experience more efficient and may not function properly.</p>  <p>However, you will still be able to place orders.</p>    <p><b>Third-party disclosure</b></p>  <p>We do not sell, trade, or otherwise transfer to outside parties your Personally Identifiable Information.</p>    <p><b>Third-party links</b></p>  <p>We do not include or offer third-party products or services on our website.</p>    <p><b>Contacting Us</b></p>  <p>If there are any questions regarding this privacy policy, you may contact us using the information below.</p>  <p>matjaralwatany.com</p>  <p>Al Kohbar,</p>  <p>Saudi Arabia</p>  <p>info@matjaralwatany.com</p>  <p>+966138951820</p>  <p><br> <br> </p>    <p><br></p>', 'active'),
('582d883e-0314-4ecf-b742-4775c0b90f98', 'CEO Message', 'ceo-message', 'CEO Message', 'CEO Message', '<div class="info-boxes">    <p>Dear valued customer, <br></p><p>Since childhood, I use to accompany my father to our shop in Khobar, which was established in 1953 and had many things to offer (i.e. Greeting Cards, Stationary, Candy …etc), which has eventually created in me the passion for retail like businesses. <br></p><p>Though, I did complete my Civil Engineering from nearby university (K. F. U. P. M) and worked for almost five years in an engineering field, I never stopped thinking to have my own retail business. <br></p><p>In 1983, my father passed away, and left his business to me and my brothers, only when I started injecting all my efforts and energy towards building Sporting Goods and Casual category. <br></p><p>In 1990, successfully built by myself a marketing oriented organization after being equipped academically in the field of Management, Marketing and Retail operations, making you my ultimate priority, becoming category specialist in Sports and Casual wear (footwear and apparel), blended with high level of customer service made us leaders in this field, tactical yet aggressive marketing campaigns with time uplifted brand awareness as well, many brands today acknowledge our dedication and efforts.</p><p>In 2010, I completed my EMBA from KFUPM, which upgraded our practices to professional international level, opening a future business full of opportunities to maintain the company''s position as one of the emerging market leaders in Saudi Arabia.</p><p>The sports industry future is booming in Saudi Arabia. We have one of the highest birth growth rate worldwide, more than 50% of Saudi youth is fond of soccer and sports. The Saudi federation league is setting up international standards in order to enhance this industry which eventually will take the demand and size of business to extensive heights.</p><p>We have kingdom wide 40 stores with 3 wholesales offices in Jeddah, Riyadh and Khobar to attend to your needs.</p><p>Thank you for your support, and do hope for continuance in future.</p><p>We assure you of our best service and quality products at all times.</p><p>Best personal regards,<br>Eng. Salah M. Al Shaikh</p></div>', 'active'),
('58353382-8a9c-4e41-8ae1-59d5c0b90f98', 'Store Locator', 'store-locator', 'Store Locator', 'Store Locator', '<p><img class="storeimage fr-fin" alt="Image title" src="http://uysys.net/demo/matjar-alwatany/storelocator.png" width="371"></p><p><br></p>', 'active'),
('58401d62-0a04-4c8f-8434-4415c0b90f98', 'Company profile', 'company-profile', 'Company profile', 'Company profile', '<div class="info-boxes about"><img src="http://www.matjaralwatany.com/img/history.jpg" alt="About Us" class="fr-fin"><p>Matjar Al Watany, was founded in 1953 by Mr. Mohammad Yousaf Sulaiman Al Sheikh as a general trading company In 1980 the business was diversified much towards sports industry.</p><p>Mr. Salah M. Sulaiman acquired the position of sole proprietor of the organization in 1990 and established sports retail chain under the name "Matjar Al Watany" – National Stores.</p><p>Today the organization operates in two segments of business...</p><p><strong>Retail Segment :</strong> Comprises of 40 stores extending its tentacles in all the major Urban City''s as well in the up country market for the consumer need and satisfaction.</p><p><strong>The Wholesale :</strong> Operates through our branch offices in Jeddah, Riyadh & Al-Khobar. Our territory of wholesale business caters KSA, Egypt, Kuwait & Bahrain.</p><p class="text-center"><a href="http://themetumblr.net/engine/img/site/Matjar%20Alwatany%20company%20profile.pdf">View company profile</a></p></div>', 'active');
INSERT INTO `english_web_pages` (`id`, `title`, `slug`, `meta_keys`, `meta_description`, `description`, `status`) VALUES
('58401eae-1b40-467f-a8be-4181c0b90f98', 'Branches', 'branches', 'Branches', 'Branches', '<div class="info-boxes">    <h2 class="sub-heading">        <div class="locations-wrapper">            <div class="container">                <div class="row">                    <div class="col-xs-12">قائمة المعارض</div>        </div>      </div>    </div>  </h2>    <h3>        <div class="table-heading">المنطقة ال شرقية</div>  </h3>    <p>( سΎعΕΎ العمل: 9.30  صبΎحΎ  الκ صاة الظϬر 4 عصرا لκ 10:30 مسΎء )قϡاإدارة: 013-8951820</p>013-8948805الدϭر اأرضي ، الجΎاريΎ سنتر ، شΎرع اأمير محمد ، تΎϘطع الخبرالجΎاريΎ1013-8938668مΎϘبل مϭل الرحمΎنيΔالخبركعكي2013-8673977شΎرع  10 ، مΎϘبل مϔرϭشΕΎ الدليجΎنالخبرلϭتϭ 103013-8640641شΎرع الظϬران ، الراشد مϭل ، الدϭر اأϭلالخبرالراشد مϭل4013-8097778كϭرنيش الدمϡΎ ، مبنκ مϭل الϠي مΎرشيه ، مΎϘبل الدمϡΎلي مΎرشيه5013-8349131الشΎرع اأϭل ، الدانه مϭل ، الدϭر اأرضيالدمϡΎالدانه6013-8304228 شΎرع المϙϠ عبدالعزيز ، مΎϘبل اأسϭاφ الدϭليΔالدمϡΎالمϙϠ عبدالعزيز7013-3636685مϭل الجبيل سنتر ، الدϭر اأϭلالدمϡΎالجبيل سنتر8013-3617902شΎرع المϙϠ عبدالعزيز ، بΎلϘرΏ من سΎبتكϭالجبيلالجبيل 29013-3622171شΎرع المϙϠ عبدالعزيزالجبيلمحل تصϔيΔ10013-7673464شΎرع اأمير نΎيفالخϔجيالخϔجي11013-5812784شΎرع الجΎمعΔ ، بΎلϘرΏ من كيϙ هϭΎسااحسΎءااحسΎء 112013-8239373سنتر الϘطيف ، بΎلϘرΏ من الكϭرنيش ، الدϭر اأرضيالϘطيفسيتي سنتر13013-7247667شΎرع المϙϠ عبدالعزيز ، تΎϘطع العΎϘريΔ ، بΎلϘرΏ من مطعϡ هرفيحϔر البΎطنحϔر البΎطن14    <table class="table table-bordered">        <thead>            <tr class="blackback">                <td>                    <div class="table-responsive">الϬاتفالعنϭانالمدينةالمعرضرقم  المعرض</div>        </td>      </tr>    </thead>        <tbody>            <tr></tr>    </tbody>  </table>    <h3>        <div class="table-heading">المنطقة الϭسطى</div>  </h3>    <p>( سΎعΕΎ العمل: 9.30  صبΎحΎ  الκ صاة الظϬر 4 عصرا لκ 10:30 مسΎء )قϡاإدارة: 011-4749890</p>011-4794494، بجϭار البنϙ اأهϠيالريΎضالمϠز1011-4604920تΎϘطع العرϭبΔ مع المϙϠ فϬد ، العϠيΎ افنيϭ الجϬه الخϔϠيه ، امϡΎ برج الممϠكΔ الريΎضالعϠيΎ2011-2356119شΎرع رϭضΔ عبدالرحمن الغΎفϘ ي ، مΎϘبل مϭبΎيϠيالريΎضالرϭضΔ3011-4497036طريφ المدينΔ - البديعΔ بازا  - بجϭار الϬرϡالريΎضبديعΔ4016-3266803شΎرع المϙϠ خΎلد ، عمΎئر الراجحي بعد فندφ مϭفمبالϘصيϡبريدة5016-3624241 شΎرع الزلϔ ي ، دϭار السΎعΔ بجϭار بنϙ سΎمبΎالϘصيϡعنيزة6016-3390092 شΎرع الرس الرئسي امϡΎ بنϙ الراجحيالϘصيϡالرس7016-5333550 شΎرع برج حΎئل ، بجϭار برج حΎئل قبل البنϙ العربيحΎئلحΎئل8014-6654455شΎرع المϙϠ عبده ، بجΎنΏ مطعϡ كنΎرρعرعرعرعر9    <table class="table table-bordered">        <thead>            <tr class="blackback">                <td>                    <div class="table-responsive">الϬاتفالعنϭانالمدينةاسم المعرضرقم  المعرض</div>        </td>      </tr>    </thead>        <tbody>            <tr></tr>    </tbody>  </table>    <h3>        <div class="table-heading">المنطقة ال غربية</div>  </h3>    <p>( سΎعΕΎ العمل: 9.30  صبΎحΎ  الκ صاة الظϬر  11-5 مسΎء )قϡاإدارة: 011-4749890</p>012-6438495الدϭر الثΎلث ، محمل سنتر ، البϠدجدهالمحمل سنتر1012-6421547 بغداديΔ الغربيΔ ، شΎرع حΏϠجدهالبغداديΔ2012-6646734 شΎرع المدينΔ ، مϭل الشعΔϠجدهالشعΔϠ3012-6819661 شΎرع الجΎمعΔ ، حي الجΎمعΔجدهالجΎمعΔ4012-6552547شΎرع حراء  ، دϭار الجϭاد اأبيضجدهحراء5012-2387797شΎرع حراء دϭار التΎريخ ، بجΎنΏ افنيϭ مϭلجدهحراء بازا6012-2842528شΎرع الرϭضΔ ، حي الϔيصϠيΔ ، دϭار الدراجΔجدهالϔيصϠيΔ7014-3226466 البحر ، شΎرع الحنΎن ، بجΎنΏ المستشκϔينبعينبع 18TBAينبع البϠد ، طريφ المϙϠ عبدالعزيز ، بجϭار عΎلϡ العصΎئرجΎزانينبع 29TBAمΎϘبل كΎدρ مϭل بجΎنΏ مϭبΎيϠيعرعرجΎزان9    <table class="table table-bordered">        <thead>            <tr class="blackback">                <td>                    <div class="table-responsive">الϬاتفالعنϭانالمدينةاسم المعرضرقم  المعرض</div>        </td>      </tr>    </thead>        <tbody>            <tr></tr>    </tbody>  </table>    <p class="text-center"><a href="http://themetumblr.net/engine/img/site/Full%20Store%20list.pdf" target="_blank">View full list</a></p></div>', 'active'),
('58b7cdf0-cf74-4a9c-8924-4f29c0b90f98', 'FAQ', 'faq', 'FAQ', 'FAQ', '<p></p><h4>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...</h4><p><br></p>', 'active'),
('58ba4dbf-aef0-4d60-af41-d0e5c0b90f98', 'Track Order', 'track-order', 'Track Order', 'Track Order', '<p>Track Order<br></p>', 'active'),
('58ba4dd6-487c-494e-b42d-d387c0b90f98', 'Payment Methods', 'payment-methods', 'Payment Methods', 'Payment\r\nMethods', '<p>Payment<br>Methods<br></p>', 'active'),
('58ba4de4-3aa4-40c8-8fec-d4e5c0b90f98', 'Size Guide', 'size-guide', 'Size Guide', 'Size Guide', '<p>Size Guide<br></p>', 'active'),
('58ba4e06-e304-4a63-819e-d8adc0b90f98', 'Returns', 'returns', 'Returns', 'Returns', '<p><br></p><p><strong>Return Policy:</strong></p><p>In order to facilitate the process of purchasing online, we present to you the policy of return. Please read the following terms and conditions: </p><p>If you want to return a product, please contact the Customer Services Department during the work hours (from Sunday to Thursday, from 9.00 am to 3.30 pm), mention the order number and request a return or exchange. Alternatively you can e-mail us on <a>customerservice@matjaralwatany.com</a></p><p>The process of return shall be implemented within seven (7) days after you receive our email sent by the Customer Services Department, which contains the required information for the return process.</p><p>If you choose to return your item you will be refunded with Matjar Alwatany store credit that you can use online. You will not be able to use your online store credit in our physical stores.</p><p>Please note you will be liable to pay the delivery charges for any returns. </p><p>We do not exchange items as you can return your item and then choose another product with your online store credit. </p><p><br></p><p><strong>Steps of Return Process: </strong></p><p>Send the return request and the order number to e-mail <a>customerservice@matjaralwatany.com</a> or call us on…. within 7 days of receiving the product. </p><p>We will then send you a link for the shipment label where you are required to print 2 copies. </p><p>Take your product to your nearest Aramex branch and hand it over to the cashier where you will then need to pay the shipping cost. </p><p>The product should be in its original, new and unused state, preserved in its box.</p><p>The customer is responsible for the product until the Customer Services Department receives it. </p><p>In case of exchanging the product in bad condition or in a state that prevents its reselling, we have the right to refuse the return request and give the product back to the customer on his/her own expense. </p><p>After the approval of the received product, you can get the full amount in online store credit, excluding any shipping charges, customs charges, or taxes in the country where the product is sent to or from. </p><p><br></p>', 'active'),
('58ba87e9-9700-4d21-bfbb-b202c0b90f98', 'Cookies', 'cookies', 'Cookies', 'Cookies', '<p></p><p><b>Cookies</b></p>  <p>To make this site work properly, we sometimes place small data files called cookies on your device. Most big websites do this too.</p>    <p><b>What are cookies?</b></p>  <p>A cookie is a small text file that a website saves on your computer or mobile device when you visit the site. It enables the website to remember your actions and preferences (such as login, language, font size and other display preferences) over a period of time, so you don’t have to keep re-entering them whenever you come back to the site or browse from one page to another.</p>    <p><b>How do we use cookies?</b></p>  <p>A number of our pages use cookies to remember:</p>  <p>Your display preferences, such as contrast colour settings or font size</p>  <p>If you have already replied to a survey pop-up that asks you if the content was helpful or not (so you won''t be asked again)</p>  <p>Also, some videos embedded in our pages use a cookie to anonymously gather statistics on how you got there and what videos you visited.</p>  <p>Cookies will also keep your shopping basket and wishlist items for you, so even if you navigate to away from our site, next time you visit us all your items will still be there for viewing. </p>  <p>Enabling these cookies is not strictly necessary for the website to work but it will provide you with a better browsing experience. You can delete or block these cookies, but if you do that some features of this site may not work as intended.</p>  <p>The cookie-related information is not used to identify you personally and the pattern data is fully under our control. These cookies are not used for any purpose other than those described here.</p>    <p><b>How to control cookies</b></p>  <p>You can control and/or delete cookies as you wish – for details, see<a>aboutcookies.org</a>. You can delete all cookies that are already on your computer and you can set most browsers to prevent them from being placed. If you do this, however, you may have to manually adjust some preferences every time you visit a site and some services and functionalities may not work.</p>  <p><br></p>', 'active'),
('58f8a4cf-93b4-4265-88fc-045ac0b90f98', 'Test', 'test', '1', '2', '<p>Test</p>', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `english_web_page_details`
--

CREATE TABLE IF NOT EXISTS `english_web_page_details` (
  `id` char(36) NOT NULL,
  `web_page_id` char(36) NOT NULL,
  `question` varchar(100) NOT NULL,
  `answer` varchar(250) NOT NULL,
  `status` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `english_web_page_details`
--

INSERT INTO `english_web_page_details` (`id`, `web_page_id`, `question`, `answer`, `status`) VALUES
('58b6922e-42d0-4068-842b-0e17cdd1d5ac', '57c80dc4-0db4-4ca3-b009-2849cdd1d5ac', 'How are you?', 'I am fine.ddccc', 'active'),
('58b69a68-e864-4d3e-9950-237ecdd1d5ac', '57c80dc4-0db4-4ca3-b009-2849cdd1d5ac', 'Where are you now?', 'dsfdsf', 'active'),
('58b7ce19-a82c-4e97-9132-4555c0b90f98', '58b7cdf0-cf74-4a9c-8924-4f29c0b90f98', 'What is Lorem Ipsum?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It h', 'active'),
('58b7ce30-6bd8-487d-9176-4714c0b90f98', '58b7cdf0-cf74-4a9c-8924-4f29c0b90f98', 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up', 'active'),
('58cfc813-57ec-4b29-95b5-4426c0b90f98', '58b7cdf0-cf74-4a9c-8924-4f29c0b90f98', 'gbcvb', 'bvcvbcv', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `id` char(36) NOT NULL,
  `extension` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `extension`) VALUES
('54226801-ca44-4317-8474-046312142117', 'jpeg'),
('54226aa8-ca40-452b-aa16-55d112142117', 'jpeg'),
('54226abc-6a04-4109-bed8-0d9a12142117', 'jpeg'),
('54226aee-5580-4d11-9ad7-5be612142117', 'jpeg'),
('54227e2b-4c68-40e4-92eb-6d4512142117', 'jpeg'),
('564c5ead-a718-4280-ab39-4024c0b90f99', 'png'),
('564c5ec7-b3f8-45fe-929a-4a78c0b90f99', 'jpg'),
('564c5ee1-4b28-499e-adad-4721c0b90f99', 'jpg'),
('582ffbdb-1b3c-4d97-8fb2-467fc0b90f98', 'jpg'),
('58340b02-0790-4751-86f2-4294c0b90f98', 'jpg'),
('58340b0c-4b14-4700-835d-4346c0b90f98', 'jpg'),
('58340b18-9020-4c6e-9da6-4489c0b90f98', 'jpg'),
('58340b2c-ba68-4818-9d2a-4605c0b90f98', 'jpg'),
('58340b3e-a1f8-4bf8-b616-486fc0b90f98', 'jpg'),
('58340b48-57ac-48bc-8b06-4967c0b90f98', 'jpg'),
('58353226-99bc-4d96-bb78-39f8c0b90f98', 'png'),
('58353371-f170-4c03-a924-5829c0b90f98', 'png');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `location` tinytext NOT NULL,
  `type` tinytext NOT NULL,
  `link_data` text NOT NULL,
  `is_deleteable` tinytext NOT NULL,
  `order` int(11) unsigned NOT NULL,
  `status` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `title`, `slug`, `location`, `type`, `link_data`, `is_deleteable`, `order`, `status`) VALUES
('58ba54ae-3e30-4bba-a690-4aa4c0b90f98', '', 'Store Locator', '', 'header', 'content', 'store-locator--', 'yes,yes', 1, 'active'),
('58ba55e2-6ce4-4a63-864f-4320c0b90f98', '', 'About Us', '', 'header', 'content', 'about-us', 'yes,yes', 2, 'active'),
('58ba5605-8644-477f-900c-47f0c0b90f98', '', 'Matjar Alwatany', '', 'footer_top', 'static', '/', 'yes,yes', 1, 'active'),
('58ba5623-e7a0-4264-a575-458fc0b90f98', '58ba5605-8644-477f-900c-47f0c0b90f98', 'About Us', '', 'footer_top', 'content', 'about-us', 'yes,yes', 2, 'active'),
('58ba563a-8a50-4c4c-a6fd-4e6bc0b90f98', '58ba5605-8644-477f-900c-47f0c0b90f98', 'Store Locator', '', 'footer_top', 'content', 'store-locator--', 'yes,yes', 3, 'active'),
('58ba565e-ff50-4a56-a9f2-4298c0b90f98', '58ba5605-8644-477f-900c-47f0c0b90f98', 'Careers', '', 'footer_top', 'content', 'careers', 'yes,yes', 4, 'active'),
('58ba5677-5d4c-4b2c-b934-4106c0b90f98', '58ba5605-8644-477f-900c-47f0c0b90f98', 'Contact Us', '', 'footer_top', 'content', 'contact-us', 'yes,yes', 5, 'active'),
('58ba568e-d060-488e-83ef-4869c0b90f98', '', 'Customer Care', '', 'footer_top', 'static', '/', 'yes,yes', 7, 'active'),
('58ba56a5-ee10-4d98-b4d1-4f29c0b90f98', '58ba568e-d060-488e-83ef-4869c0b90f98', 'FAQ', '', 'footer_top', 'content', 'faq', 'yes,yes', 8, 'active'),
('58ba56cb-e2fc-41f8-b3c0-46b5c0b90f98', '58ba568e-d060-488e-83ef-4869c0b90f98', 'Track Order', '', 'footer_top', 'content', 'track-order', 'yes,yes', 9, 'active'),
('58ba56f6-30ec-4cfc-b503-454fc0b90f98', '58ba568e-d060-488e-83ef-4869c0b90f98', 'Payment Methods', '', 'footer_top', 'content', 'payment-methods', 'yes,yes', 10, 'active'),
('58ba5719-39a0-456f-aada-44f6c0b90f98', '58ba568e-d060-488e-83ef-4869c0b90f98', 'Size Guide', '', 'footer_top', 'content', 'size-guide', 'yes,yes', 11, 'active'),
('58ba5749-7390-418d-9fc4-433dc0b90f98', '58ba568e-d060-488e-83ef-4869c0b90f98', 'Shipping Info', '', 'footer_top', 'content', 'shipping-info', 'yes,yes', 12, 'active'),
('58ba5764-fd84-4c0a-85aa-4933c0b90f98', '58ba568e-d060-488e-83ef-4869c0b90f98', 'Returns', '', 'footer_top', 'content', 'returns', 'yes,yes', 13, 'active'),
('58ba87a1-1254-435a-ba8d-a853c0b90f98', '', 'Privacy Policy', '', 'footer', 'content', 'privacy', 'yes,yes', 1, 'active'),
('58ba87c7-1080-4e37-8a16-ad9bc0b90f98', '', 'Terms & Conditions', '', 'footer', 'content', 'terms-and-conditions', 'yes,yes', 2, 'active'),
('58ba8804-f1e4-4abb-b8ef-b5cfc0b90f98', '', 'Cookies', '', 'footer', 'content', 'cookies', 'yes,yes', 3, 'active'),
('58ba8818-6ea8-4631-a211-b877c0b90f98', '', 'FAQ', '', 'footer', 'content', 'faq', 'yes,yes', 4, 'active'),
('58c0fcdc-81b0-4adb-a9a8-49d3c0b90f98', '58ba5605-8644-477f-900c-47f0c0b90f98', 'Locations', '', 'footer_top', 'functional', 'locations', 'yes,no', 6, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `overviews`
--

CREATE TABLE IF NOT EXISTS `overviews` (
  `id` smallint(5) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `num_of_items` int(11) NOT NULL,
  `status` tinytext NOT NULL,
  `cssClass` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `overviews`
--

INSERT INTO `overviews` (`id`, `title`, `num_of_items`, `status`, `cssClass`) VALUES
(1, 'علامة تجارية', 16, 'active', 'cubes'),
(2, 'مدن', 18, 'active', 'map-marker'),
(3, 'مخازن', 40, 'active', 'home'),
(4, 'سنوات', 60, 'active', 'calendar');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE IF NOT EXISTS `partners` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `image_extension` char(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `name`, `email`, `phone`, `address`, `image_extension`) VALUES
(1, 'Mipel', 'mipellim@hotmail.com', '01812305802', '<p>Dhaka<br></p>', 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` char(36) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `accesslist` longtext NOT NULL,
  `is_deletable` text NOT NULL,
  `status` text NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `description`, `accesslist`, `is_deletable`, `status`, `created`) VALUES
('54217bff-7358-4187-8e9c-0ae112142117', 'Web Manager', 'Access to web and menus', '{"web_pages":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete"},"web_page_details":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete"},"menus":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete","admin_sort_menu":"admin_sort_menu"},"users":{"admin_index":"admin_index","admin_clientIndex":"admin_clientIndex","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete"},"roles":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete"},"subscribers":{"admin_index":"admin_index","admin_delete":"admin_delete"},"subscriber_notifications":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete"},"subscriber_notification_details":{"admin_index":"admin_index"},"site_settings":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete"},"overviews":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete"},"social_networks":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete","admin_sort_socialnetwork":"admin_sort_socialnetwork"},"notifications":{"admin_index":"admin_index","admin_view":"admin_view"},"currency_values":{"admin_index":"admin_index","admin_edit":"admin_edit"},"categories":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete"},"brands":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete"},"teams":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete"},"attributes":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete","admin_sort_attribute":"admin_sort_attribute"},"merchants":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete","admin_view":"admin_view"},"products":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete","admin_stockreport":"admin_stockreport","admin_salereport":"admin_salereport","admin_product_settings":"admin_product_settings","admin_excelImport":"admin_excelImport"},"product_stocks":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete","admin_view":"admin_view","admin_export":"admin_export","admin_import":"admin_import"},"product_orders":{"admin_order_view":"admin_order_view","admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_send_email":"admin_send_email","admin_delete":"admin_delete","admin_unview":"admin_unview","admin_asignDeliveryMan":"admin_asignDeliveryMan"},"coupons":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete"},"deliverymen":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete","admin_view":"admin_view"},"purchases":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete","admin_view":"admin_view"},"demages":{"admin_index":"admin_index","admin_add":"admin_add","admin_recover":"admin_recover","admin_delete":"admin_delete","admin_view":"admin_view"},"expense_titles":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete","admin_view":"admin_view"},"expenses":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete","admin_view":"admin_view"},"countries":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete"},"states":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete"},"cities":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete"},"channels":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_generate_channels":"admin_generate_channels"},"banners":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete"},"clients":{"admin_index":"admin_index","admin_view":"admin_view","admin_add":"admin_add","admin_edit":"admin_edit"}}', 'no', 'active', '2014-09-23'),
('5423b276-712c-4958-b2c4-1034cdd1d5ac', 'System Admin', 'access everything with codding power', '{"web_pages":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete"},"menus":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete"},"users":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete"},"roles":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete"},"system_settings":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete"},"site_settings":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete"}}', 'no_no', 'active', '2014-09-25'),
('57148561-ab40-4f71-8b0f-0d00cdd1d5ac', 'Client', 'For all registered client', '{"web_pages":{"admin_index":"0","admin_add":"0","admin_edit":"0","admin_delete":"0"},"menus":{"admin_index":"0","admin_add":"0","admin_edit":"0","admin_delete":"0","admin_sort_menu":"0"},"users":{"admin_index":"0","admin_clientIndex":"0","admin_add":"0","admin_edit":"0","admin_delete":"0"},"roles":{"admin_index":"0","admin_add":"0","admin_edit":"0","admin_delete":"0"},"site_settings":{"admin_index":"0","admin_add":"0","admin_edit":"0","admin_delete":"0"},"social_networks":{"admin_index":"0","admin_add":"0","admin_edit":"0","admin_delete":"0","admin_sort_socialnetwork":"0"},"categories":{"admin_index":"0","admin_add":"0","admin_edit":"0","admin_delete":"0"},"merchants":{"admin_index":"admin_index","admin_add":"admin_add","admin_edit":"admin_edit","admin_delete":"admin_delete","admin_view":"admin_view"},"products":{"admin_index":"0","admin_add":"0","admin_edit":"0","admin_delete":"0","admin_stockreport":"0","admin_salereport":"0"},"stocks":{"admin_index":"0","admin_add":"0","admin_edit":"0","admin_delete":"0","admin_view":"0"},"sales":{"admin_index":"0"},"product_orders":{"admin_order_view":"0","admin_index":"0","admin_add":"0","admin_edit":"0","admin_send_email":"0","admin_delete":"0"},"coupons":{"admin_index":"0","admin_add":"0","admin_edit":"0","admin_delete":"0"},"galleries":{"admin_index":"0","admin_add":"0","admin_edit":"0","admin_delete":"0"},"clients":{"admin_index":"admin_index","admin_view":"admin_view"}}', 'no', 'active', '2016-04-18');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` char(36) NOT NULL,
  `site_title` varchar(100) NOT NULL,
  `site_slogan` varchar(200) NOT NULL,
  `meta_key` varchar(60) NOT NULL,
  `meta_description` varchar(150) NOT NULL,
  `site_author` varchar(100) NOT NULL,
  `site_author_email` varchar(100) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_address` varchar(200) NOT NULL,
  `company_loaction` varchar(100) NOT NULL,
  `phones` varchar(200) NOT NULL,
  `emails` varchar(200) NOT NULL,
  `kitchen_email` varchar(100) DEFAULT NULL,
  `faxes` varchar(200) NOT NULL,
  `google_analytics_data` mediumtext NOT NULL,
  `status` text NOT NULL,
  `shippingCharge` float NOT NULL,
  `website` varchar(100) NOT NULL,
  `copyrightText` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_title`, `site_slogan`, `meta_key`, `meta_description`, `site_author`, `site_author_email`, `company_name`, `company_address`, `company_loaction`, `phones`, `emails`, `kitchen_email`, `faxes`, `google_analytics_data`, `status`, `shippingCharge`, `website`, `copyrightText`) VALUES
('54219a9b-f910-4d8c-9515-0ae112142117', 'Matjar Alwatany', 'Matjar Alwatany', 'grocery,safe food, Safe life,bazaar, best bazaar', 'Online Grocery Shop', 'UY Systems Ltd.', 'info@uysys.com', 'Matjar Alwatany', 'P.O. Box 275, Al Khobar 31952, Kingdom of Saudi Arabia', '23.7840538,90.391035', ' +088 125 5663', 'info@matjaralwatany.com', 'greengroser24@gmail.com', 'n/a', '{"Key":"dfdsf","Gmail":"info@matjaralwatany.com","Password":"a"}', 'live', 30, 'http://www.matjaralwatany.com', '© Matjar Alwatany 2016. All right reserved.');

-- --------------------------------------------------------

--
-- Table structure for table `social_networks`
--

CREATE TABLE IF NOT EXISTS `social_networks` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `short_description` varchar(250) NOT NULL,
  `url` varchar(150) NOT NULL,
  `order` int(11) unsigned NOT NULL,
  `status` text NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `iconClass` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `social_networks`
--

INSERT INTO `social_networks` (`id`, `title`, `slug`, `short_description`, `url`, `order`, `status`, `created`, `modified`, `iconClass`) VALUES
(3, 'Facebook', 'facebook_2', 'Short description goes here.', 'https://www.facebook.com/matjaralwatany', 1, 'active', '2015-01-16', '2016-11-22', 'fa fa-facebook'),
(5, 'Twitter', 'twitter_2', 'zsdfsdzf', 'https://twitter.com/matjaralwatany', 2, 'active', '2015-01-16', '2016-11-22', 'fa fa-twitter'),
(6, 'Pinterest', 'pinterest_2', 'Pinterest', 'https://pinterest.com/', 5, 'inactive', '2015-03-23', '2016-11-22', 'icon-pinterest'),
(7, 'Instagram', 'instagram', 'Instagram', 'https://www.instagram.com/matjaralwatany/', 3, 'active', '2015-03-23', '2016-11-22', 'fa fa-instagram'),
(8, 'Google Plus', 'google_plus', 'Google Plus', 'https://googleplus.com/', 4, 'inactive', '2016-08-29', '2016-11-22', 'icon-gplus');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` char(36) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(250) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `token`, `created`, `updated`, `status`) VALUES
('58be961f-9438-483a-94c9-4ba0c0b90f98', 'abdulbaten1983@gmail.com', 'NULL', '2017-03-07 17:14:39', '2017-03-07 17:16:38', 'inactive'),
('58ca891d-1c0c-498b-b4fe-4a4cc0b90f98', 'shimul27@gmail.com', 'JDJhJDEwJFdya0dWYkFLbzQvV0txNC5ZVlpDQS55emV3Znp2RjRvakRaQkdSeW5XR25zVk9SVWVzMS5h', '2017-03-16 17:46:21', '2017-03-16 17:57:05', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `subscriber_notifications`
--

CREATE TABLE IF NOT EXISTS `subscriber_notifications` (
  `id` char(36) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `message` text,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `file_extension` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscriber_notifications`
--

INSERT INTO `subscriber_notifications` (`id`, `title`, `message`, `created`, `modified`, `file_extension`) VALUES
('58f4b249-7048-4846-90a8-1e5ec0b90f98', 'Test', '<p>daddsa</p>', '2017-04-17 12:17:13', '2017-04-17 12:17:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscriber_notification_details`
--

CREATE TABLE IF NOT EXISTS `subscriber_notification_details` (
  `id` char(36) NOT NULL,
  `subscriber_id` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE IF NOT EXISTS `system_settings` (
  `id` char(36) NOT NULL,
  `domain` varchar(100) NOT NULL,
  `developer_email` varchar(100) NOT NULL,
  `system_author_name` varchar(100) NOT NULL,
  `developer_company` varchar(100) NOT NULL,
  `pagination_no` int(11) unsigned NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `domain`, `developer_email`, `system_author_name`, `developer_company`, `pagination_no`, `status`) VALUES
('54219b4c-8ed8-492e-a456-047412142117', 'xx.com', 'adsf@dsf.com', 'asdf', 'dskfd', 10, 'development');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` char(36) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(64) NOT NULL,
  `personal_details` mediumtext NOT NULL,
  `role_id` char(36) NOT NULL,
  `status` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `personal_details`, `role_id`, `status`, `created`) VALUES
('542391f1-037c-41a3-a270-0cadcdd1d5ac', 'admin@uysys.com', '$2a$10$2pVjlMYsTs40DTnvd3DLvuLCBp8AyoB1KKbhqrelqhwMzcMmPI4z.', '{"first_name":"UYSYS ","last_name":"ADMIN","date_of_birth":"1988-12-14","blood_group":"A+","gender":"male","maritial_status":"single","current_address":{"address_line_1":"Mirpur","address_line_2":"Dhaka"},"cell":"+01922299933","fax":"none","skype":"uysystems"}', '54217bff-7358-4187-8e9c-0ae112142117', 'active', '2014-09-25 13:54:25'),
('565d6ac7-0110-487c-9130-51dac0b90f99', 'shaiful2@uysys.com', '$2a$10$dDW9NK0IiFQRciDQk/Q5B.e.ucykeAlSyD3F2sdise.dXAdL9H6/6', '{"vorname":"Saiful","nacname":"Islam","starbe":"12213","postcode":"4312","phone":"6163416","firma":"","etage":"","password":"abc123"}', '57148561-ab40-4f71-8b0f-0d00cdd1d5ac', 'active', '2015-12-01 15:39:21'),
('565d6ac9-0110-487c-9130-51dac0b90f99', 'shaiful@uysys.com', '$2a$10$dDW9NK0IiFQRciDQk/Q5B.e.ucykeAlSyD3F2sdise.dXAdL9H6/6', '{"first_name":"Md.Shaiful","last_name":"Islam","date_of_birth":"2015-12-01","blood_group":"","gender":"male","maritial_status":"single","current_address":{"address_line_1":"","address_line_2":""},"cell":"","fax":"","skype":""}', '54217bff-7358-4187-8e9c-0ae112142117', 'active', '2015-12-01 15:39:21'),
('571b51b3-40e8-48b4-9a95-1360cdd1d5ac', 'mipellim@hotmail.com', '$2a$10$oCkLAy/wGCyCGO/r39eoDu3ducxjMdXQxOx4/F6R24z3uj8YkpyL.', '{"vorname":"first Name","nacname":"Last Name","starbe":"12213","postcode":"4312","phone":"6163416","firma":"","etage":"","password":"abc123"}', '57148561-ab40-4f71-8b0f-0d00cdd1d5ac', 'active', '2016-04-23 04:42:59');

-- --------------------------------------------------------

--
-- Table structure for table `web_pages`
--

CREATE TABLE IF NOT EXISTS `web_pages` (
  `id` char(36) NOT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `meta_keys` varchar(60) NOT NULL,
  `meta_description` varchar(150) NOT NULL,
  `description` mediumtext NOT NULL,
  `status` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `web_pages`
--

INSERT INTO `web_pages` (`id`, `title`, `slug`, `meta_keys`, `meta_description`, `description`, `status`) VALUES
('582af03d-6da8-4f08-81cb-4404c0b90f98', 'Find A Store', 'store-locator--', 'Find A Store', 'Find A Store', '<p></p><div id="idTextPanel" class="jqDnR">  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.  Aenean commodo ligula eget dolor.  Aenean massa.  Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.  Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.  Nulla consequat massa quis enim.  Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.  In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>  <p> Nullam dictum felis eu pede mollis pretium.  Integer tincidunt.  Cras dapibus.  Vivamus elementum semper nisi.  Aenean vulputate eleifend tellus.  Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.  Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.  Phasellus viverra nulla ut metus varius laoreet.  Quisque rutrum.  Aenean imperdiet.  Etiam ultricies nisi vel augue.  Curabitur ullamcorper ultricies nisi.  Nam eget dui.</p>  <p>Etiam rhoncus.  Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.  Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.  Maecenas nec odio et ante tincidunt tempus.  Donec vitae sapien ut libero venenatis faucibus.  Nullam quis ante.  Etiam sit amet orci eget eros faucibus tincidunt.  Duis leo.  Sed fringilla mauris sit amet nibh.  Donec sodales sagittis magna.  Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.  Fusce vulputate eleifend sapien.  Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.  Nullam accumsan lorem in dui.  Cras ultricies mi eu turpis hendrerit fringilla.  Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi</p></div>', 'active'),
('582af117-c410-4eda-87c8-46acc0b90f98', 'Sizing Charts', 'privacy--', 'Sizing Charts', 'Sizing Charts', '<p></p><div id="idTextPanel" class="jqDnR">  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.  Aenean commodo ligula eget dolor.  Aenean massa.  Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.  Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.  Nulla consequat massa quis enim.  Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.  In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>  <p> Nullam dictum felis eu pede mollis pretium.  Integer tincidunt.  Cras dapibus.  Vivamus elementum semper nisi.  Aenean vulputate eleifend tellus.  Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.  Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.  Phasellus viverra nulla ut metus varius laoreet.  Quisque rutrum.  Aenean imperdiet.  Etiam ultricies nisi vel augue.  Curabitur ullamcorper ultricies nisi.  Nam eget dui.</p>  <p>Etiam rhoncus.  Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.  Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.  Maecenas nec odio et ante tincidunt tempus.  Donec vitae sapien ut libero venenatis faucibus.  Nullam quis ante.  Etiam sit amet orci eget eros faucibus tincidunt.  Duis leo.  Sed fringilla mauris sit amet nibh.  Donec sodales sagittis magna.  Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.  Fusce vulputate eleifend sapien.  Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.  Nullam accumsan lorem in dui.  Cras ultricies mi eu turpis hendrerit fringilla.  Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi</p></div>', 'active'),
('582af15b-09e4-4245-824a-46bac0b90f98', 'Company News', 'company-news', 'Company News', 'Company News', '<p></p><div id="idTextPanel" class="jqDnR">  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.  Aenean commodo ligula eget dolor.  Aenean massa.  Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.  Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.  Nulla consequat massa quis enim.  Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.  In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>  <p> Nullam dictum felis eu pede mollis pretium.  Integer tincidunt.  Cras dapibus.  Vivamus elementum semper nisi.  Aenean vulputate eleifend tellus.  Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.  Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.  Phasellus viverra nulla ut metus varius laoreet.  Quisque rutrum.  Aenean imperdiet.  Etiam ultricies nisi vel augue.  Curabitur ullamcorper ultricies nisi.  Nam eget dui.</p>  <p>Etiam rhoncus.  Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.  Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.  Maecenas nec odio et ante tincidunt tempus.  Donec vitae sapien ut libero venenatis faucibus.  Nullam quis ante.  Etiam sit amet orci eget eros faucibus tincidunt.  Duis leo.  Sed fringilla mauris sit amet nibh.  Donec sodales sagittis magna.  Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.  Fusce vulputate eleifend sapien.  Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.  Nullam accumsan lorem in dui.  Cras ultricies mi eu turpis hendrerit fringilla.  Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi</p></div>', 'active'),
('582af177-80a4-4964-8830-4535c0b90f98', 'Careers', 'careers', 'Careers', 'Careers', '<p></p><div id="idTextPanel" class="jqDnR">  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.  Aenean commodo ligula eget dolor.  Aenean massa.  Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.  Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.  Nulla consequat massa quis enim.  Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.  In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>  <p> Nullam dictum felis eu pede mollis pretium.  Integer tincidunt.  Cras dapibus.  Vivamus elementum semper nisi.  Aenean vulputate eleifend tellus.  Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.  Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.  Phasellus viverra nulla ut metus varius laoreet.  Quisque rutrum.  Aenean imperdiet.  Etiam ultricies nisi vel augue.  Curabitur ullamcorper ultricies nisi.  Nam eget dui.</p>  <p>Etiam rhoncus.  Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.  Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.  Maecenas nec odio et ante tincidunt tempus.  Donec vitae sapien ut libero venenatis faucibus.  Nullam quis ante.  Etiam sit amet orci eget eros faucibus tincidunt.  Duis leo.  Sed fringilla mauris sit amet nibh.  Donec sodales sagittis magna.  Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.  Fusce vulputate eleifend sapien.  Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.  Nullam accumsan lorem in dui.  Cras ultricies mi eu turpis hendrerit fringilla.  Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi</p></div>', 'active'),
('582af195-8950-43e6-88b3-44acc0b90f98', 'Cookie Policy', 'cookie-policy', 'Cookie Policy', 'Cookie Policy', '<p></p><div id="idTextPanel" class="jqDnR">  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.  Aenean commodo ligula eget dolor.  Aenean massa.  Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.  Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.  Nulla consequat massa quis enim.  Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.  In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>  <p> Nullam dictum felis eu pede mollis pretium.  Integer tincidunt.  Cras dapibus.  Vivamus elementum semper nisi.  Aenean vulputate eleifend tellus.  Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.  Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.  Phasellus viverra nulla ut metus varius laoreet.  Quisque rutrum.  Aenean imperdiet.  Etiam ultricies nisi vel augue.  Curabitur ullamcorper ultricies nisi.  Nam eget dui.</p>  <p>Etiam rhoncus.  Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.  Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.  Maecenas nec odio et ante tincidunt tempus.  Donec vitae sapien ut libero venenatis faucibus.  Nullam quis ante.  Etiam sit amet orci eget eros faucibus tincidunt.  Duis leo.  Sed fringilla mauris sit amet nibh.  Donec sodales sagittis magna.  Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.  Fusce vulputate eleifend sapien.  Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.  Nullam accumsan lorem in dui.  Cras ultricies mi eu turpis hendrerit fringilla.  Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi</p></div>', 'active'),
('582afdd8-9b30-4c6d-8d79-c84fc0b90f98', 'اتصل بنا', 'contact-us', 'اتصل بنا', 'اتصل بنا', '<div class="col-xs-12 col-sm-4"><br><p><strong>Jeddah Wholesale</strong>Tel: +9662-6424621Fax: +9662-6424258<br><strong>Riyadh Wholesale</strong>Tel: +9661-4749890Fax: +9661-4749880<br><strong>Al-Khobar Wholesale</strong>Tel: +9663-8951760Fax: +9663-8954656<br></p></div><div class="col-xs-12 col-sm-4"><br><p>&nbsp;SPORTS GHURNADA, Saudi Arabia<br>&nbsp;GO SPORT, Saudi Arabia&nbsp;AL FALEH SPORTS, Saudi Arabia<br>&nbsp;BAHRAIN SHOOT, Bahrain<br>&nbsp;TOP WEAR, Saudi Arabia<br>&nbsp;QARRAT SPORT, Saudi Arabia<br>&nbsp;ARRIYADA SPORT, Saudi Arabia<br><br></p></div><div class="col-xs-12 col-sm-4"><br><strong>لدينا رئيس مكتب الموقع (الخبر) <br><img class="fr-fin" alt="Image title" src="http://matjaralwatany.com/img/loc.jpg" width="250"></strong></div>', 'active'),
('582afe54-861c-453d-98fb-d4f7c0b90f98', 'العلامات التجارية', 'brands', 'العلامات التجارية', 'العلامات التجارية', '<p><strong>Lotto<br></strong></p><p><img class="fr-fil" alt="Image title" src="http://matjaralwatany.com/img/brand/lotto.jpg" width="150"> تأسست لوتو في عام 1973 من قبل عائلة Caberlotto في MONTEBELLUNA، شمال إيطاليا، ومركز عالمي للتصنيع الأحذية. في يونيو 1973، قدمت لوتو لاول مرة كشركة مصنعة الأحذية الرياضية. حذاء تنس أشارت بداية الإنتاج، تليها نماذج لكرة السلة والكرة الطائرة وألعاب القوى وكرة القدم. اليوم وتو توزع منتجاتها في أكثر من 70 دولة من خلال متاجر الرياضية مستقلة<br><br>                    في يونيو 1999 تم التقاط هذه الشركة على يد مجموعة من رجال الأعمال المحليين الذين كانوا بالفعل نشطة جدا في قطاع الرياضة. وترأس من قبل أندريا تومات، الذي تولى دور الرئيس والمدير التنفيذي للشركة الجديدة، التي تم تغيير اسمها لوتو S.p.A<br><br>                    وكان الهدف ملكية جديدة لاستغلال نقاط القوة للعلامة التجارية - الديناميكية والابتكار والجودة والتصميم الإيطالي والعاطفة الحقيقية للرياضة - جنبا إلى جنب مع خدمة متزايد مضنية وفعالة عملائها <br><br>  Matjar الوطني المصري  هو الوكيل الوحيد لشركة لوتو سبورت إيطاليا لأكثر من 25 عاما حتى الآن في المملكة العربية السعودية وسوق البحرين، وقد تم تقديم هذه العلامة التجارية من خلال لما يقرب من 40 متجرا في 17 مدينة ونحو 200 نقطة بيع من قيمة لدينا الشركاء (الحسابات الرئيسية).</p><hr><p><strong>Nike<br><img class="fr-fil" alt="Image title" src="http://matjaralwatany.com/img/brand/nike.jpg" width="150"></strong>تأسست الشركة في 25 يناير 1964 باسم بلو ريبون الرياضة على يد بيل باورمان وفيليب نايت، وأصبح رسميا شركة نايكي يوم 30 مايو، 1978. نايك بتسويق منتجاتها تحت العلامة التجارية الخاصة بها، فضلا عن نايك جولف، نايك برو ونايكي +، الأردن الجوية، نايكي التزلج. في جميع أنحاء 1980s، وسعت نايك خط منتجاتها لتشمل العديد من الألعاب الرياضية والمناطق في جميع أنحاء العالم.<br><br>                    نايك يدفع نخبة من الرياضيين في العديد من الألعاب الرياضية لاستخدام منتجاتها وتعزيز والإعلان عن التكنولوجيا والتصميم. خلال السنوات ال 20 الماضية خصوصا، كان نايك واحد من الملابس والأحذية الرعاة الرئيسيين لقيادة لاعبي التنس. وكان نايك الرسمي الراعي عدة لفريق الكريكيت الهندي لمدة خمس سنوات، من عام 2006 وحتى نهاية عام 2010. <br><br>                    واليوم، تواصل نايك للبحث عن طرق جديدة ومبتكرة لتطوير منتجات رياضية متفوقة، وأساليب مبتكرة للتواصل مباشرة مع عملائها. واصلت الشركة للتوسع في طرق جديدة، بما في ذلك نمو قوي في العديد من الأسواق وصفقة لتصبح الراعي الرسمي للرابطة الوطنية لكرة القدم (NFL) بداية عام 2012.<br><br>                    قدم Matjar الوطني المصري العلامة التجارية منذ ثلاث سنوات، ونمت بسرعة مع الطلب الهائل من المستهلكين الأصلي والمفاهيم NIKE جديدة (متجر في متجر) هم في طريقها إلى الانتقائية المتاجر الرئيسية! <br></p><hr><p><br></p><p><strong>Adidas<br><img class="fr-fil" alt="Image title" src="http://matjaralwatany.com/img/brand/adidas.jpg" width="150"></strong>تأسست اديداس عام 1948 من قبل أدولف "عدي" داسلر، إثر انقسام GEBRUDER داسلر شوفابريك عليه وشقيقه الأكبر رودولف بين. تأسست رودولف في وقت لاحق من طراز بوما، الذي كان المنافس في وقت مبكر من أديداس. سجلت في عام 1949، ويستند أديداس حاليا في هيرتسوجيناوراخ، ألمانيا، جنبا إلى جنب مع بوما. الملابس والأحذية تصاميم الشركة عادة ميزة ثلاثة المتوازيين، وأدرج على نفس النمط في الشعار الرسمي الحالي أديداس. وقد اشترت "الأشرطة الثلاثة" من الرياضة الشركة الفنلندية Karhu الرياضة في عام 1951.<br><br>                    أديداس هي أعلى علامة دولية في العالم في قطاع الرياضة ولها علامة مقاعد البدلاء في رعاية أندية واللاعبين والبطولات بين الأنشطة المختلفة. <br><br>  Matjar الوطني المصري  هو تقديم أديداس من خلال 25 متجرا في جميع أنحاء المملكة مع متجر وهما في المفاهيم ورشة (SIS)، واحدة في متجر Galaria الخبر (165 متر مربع)، ومفهوم آخر في المحمل جدة.<br></p><hr><p><strong>Umbro</strong></p><p><img class="fr-fil" alt="Image title" src="http://matjaralwatany.com/img/brand/umbro.jpg" width="150"> تأسست الشركة في عام 1924 في يلمسلو، شيشاير كما همفريز الإخوة الملابس.</p><p>بعد أن عمل في أجزاء مختلفة من صناعة الخياطة، تعيين هارولد همفريز يصل امبرو مع شقيقه والاس، وذلك بهدف تحقيق المثل العليا وممارسات الصناعة في العالم المزدهر من الملابس الرياضية. امبرو، المحدودة، وهي شركة تابعة لشركة نايكي، هو العلامة التجارية لكرة القدم مانشستر مقرها الأصلي الذي اخترع الرياضية والرياضة الخياطة. وقدم الإسعافات كرة القدم الرئيسية امبرو لمانشستر سيتي في عام 1934، مجموعة فازوا بكأس الاتحاد الانجليزي في اليوم، وتجمع الشركة بين تراثها في مجال الرياضة والخياطة مع ثقافة كرة القدم الحديثة لخلق الرائدة ومبدع كرة القدم الملابس والأحذية والمعدات التي تمزج الأداء والاسلوب.</p><p>ومن بين أهم العلامات التجارية على الرفوف، Matjar الوطني المصري يحمل أمبرو في ما يقرب من 22 نقطة للمبيعات في جميع أنحاء المملكة، ومن المعروف أمبرو للرسومات في جمع كرة القدم ونوعية الأقمشة، يأتي والتحقق من ذلك ..!</p><hr><p><strong>Lacoste</strong></p><p><img class="fr-fil" alt="Image title" src="http://matjaralwatany.com/img/brand/lacoste.jpg" width="150"> تأسست رينيه لاكوست لا قميص لاكوست في عام 1933 مع أندريه Gillier، مالك ورئيس أكبر شركة تصنيع التريكو الفرنسية في ذلك الوقت. بدأوا في إنتاج قميص التنس الثوري قد لاكوست صممت وتلبس على ملاعب للتنس مع شعار التمساح المطرزة على الصدر.</p><p>في عام 2005، ما يقرب من 50 مليون منتج لاكوست تباع في أكثر من 110 بلدا. وقد زاد حضورها بسبب العقود المبرمة بين لاكوست والعديد من لاعبي التنس الشباب، بما في ذلك نجم التنس الامريكي اندي روديك الفرنسي ارتفاع احتمال الشباب ريشار جاسكيه، والأولمبية السويسرية الميدالية الذهبية ستانيسلاس فافرينكا. بدأت لاكوست أيضا إلى زيادة وجودها في العالم للجولف.</p><p>يعتبر متجر المحمل جدة لتكون أقدم محل لبيع مجموعة كاملة من منتجات لاكوست (أكثر من 20years قبل)، اليوم، Matjar الوطني المصري، هو معروف، في بيع الأحذية نمط الحياة رياضة جذابة والنعال للرجال والنساء من خلال المتميز سبعة متاجر على مستوى المملكة.</p><hr><p><strong>Puma</strong></p><p><img class="fr-fil" alt="Image title" src="http://matjaralwatany.com/img/brand/puma.jpg" width="150"> بوما، وصفت رسميا باسم PUMA، هي شركة متعددة الجنسيات الألمانية الكبرى التي تنتج الراقية الأحذية الرياضية والأحذية نمط الحياة وغيرها من الملابس الرياضية. شكلت في عام 1924 كما GEBRUDER داسلر شوفابريك من قبل أدولف داسلر ورودولف، تدهورت العلاقات بين الأخوين حتى اتفقا على تقسيم في عام 1948، وتشكيل كيانين منفصلين، أديداس andPuma. ويستند بوما حاليا في هيرتسوجيناوراخ، ألمانيا. ومن المعروف أن شركة للأحذية كرة القدم، وتمت برعاية لاعبي كرة القدم الشهير. بوما AG ما يقرب من 9500 موظف، وتوزع منتجاتها في أكثر من 120 دولة.</p><p>Matjar الوطني المصري هو من بين تجار التجزئة رجل الأعمال الذي بدأ بيع طراز بوما، اليوم، Matjar الوطني المصري تحمل مجموعة جذابة من فيراري، كرة القدم، الركض ونمط الحياة بين الملابس الأخرى والأحذية والاكسسوارات مجموعة حيوية والأخير.</p>', 'active'),
('582afea1-d160-460f-99f3-de7cc0b90f98', 'الأحكام والشروط', 'terms-and-conditions', 'الأحكام والشروط', 'الأحكام والشروط', '<p>تنطبق هذه الشروط والظروف لاستخدام هذا الموقع والوصول إلى هذا الموقع و / أو وضع أمر فإنك توافق على الالتزام بالشروط والأوضاع المبينة أدناه. إذا كنت لا توافق على الالتزام بهذه الشروط والأحكام، لا يجوز لك استخدام أو الوصول إلى هذا الموقع: .</p><p>قبل وضع النظام، وإذا كان لديك أي أسئلة تتعلق بهذه الشروط والأحكام، يرجى الاتصال بفريق خدمة العملاء عن طريق البريد الإلكتروني: ، أو الاتصال بنا على&nbsp; أيام في الأسبوع،&nbsp; - منتصف الليل. وستحمل جميع المكالمات لخدمة العملاء، ويمكن أن تسجل على حد سواء المكالمات الواردة والصادرة لأغراض الرصد الجودة والتدريب.</p><p>استخدام الموقع</p><p>وصول</p><p>وتقدم لك الوصول إلى هذا الموقع وفقا لهذه الشروط وأي أوامر وضعت من قبل يجب أن توضع بدقة وفقا لهذه الشروط.</p><p>التسجيل</p><p>فإنك تضمن ما يلي:</p><p>1. المعلومات الشخصية التي تتطلب منك أن تقدم عند التسجيل كعميل غير صحيحة ودقيقة وحديثة وكاملة من جميع النواحي. و</p><p>2. سوف إبلاغنا فورا من أي تغييرات على المعلومات الشخصية عن طريق الاتصال ممثلي خدمة العملاء عن طريق البريد الإلكتروني:&nbsp; <br></p><p>فإنك توافق على عدم انتحال شخصية أي شخص أو كيان آخر أو استخدام اسم مستعار أو اسم أنك غير مخول للاستخدام.</p><p>تعويض</p><p>فإنك توافق تماما على تعويض والدفاع عنها وعقد لنا، ونحن الضباط والمديرين والموظفين والوكلاء والموردين، وغير مؤذية على الفور على الطلب، من وضد جميع المطالبات، والمسؤولية والأضرار والخسائر والتكاليف والنفقات، بما في ذلك الرسوم القانونية المعقولة، الناشئة عن أي خرق للشروط من قبلك أو أي التزامات أخرى ناشئة عن استخدامك لهذا الموقع، أو استخدامها من قبل أي شخص آخر الوصول إلى الموقع باستخدام حساب التسوق الخاصة بك و / أو المعلومات الشخصية الخاصة بك.</p><p>حقوقنا</p><p>نحن نحتفظ بالحق في:</p><p>1. تعديل أو سحب، بشكل مؤقت أو بشكل دائم، وهذا الموقع (أو أي جزء منها) مع أو بدون إشعار لك وأنت نؤكد اننا لن نكون مسؤولين تجاهك أو تجاه أي طرف ثالث عن أي تعديل أو سحب الموقع. و / أو</p><p>2. تغيير الشروط من وقت لآخر، ويعتبر استمرار استخدامك لهذا الموقع (أو أي جزء منها) بعد هذا التغيير أن يكون قبولك بهذا التغيير. ومن مسؤوليتكم لفحص بانتظام لتحديد ما إذا كان قد تم تغيير شروط. إذا كنت لا توافق على أي تغيير في شروط ثم يجب عليك التوقف فورا عن استخدام الموقع.</p><p>روابط الطرف الثالث</p><p>لتوفير زيادة القيمة إلى المستخدمين لدينا، ونحن يمكن أن توفر وصلات لمواقع أو موارد أخرى لتتمكن من الوصول في تقديركم الوحيد. فإنك تقر وتوافق على أن، كما كنت قد اخترت لدخول موقع مرتبط نحن لسنا مسؤولين عن توافر مثل هذه المواقع أو الموارد الخارجية، وعدم مراجعة أو تأييد ولسنا مسؤولين أو مسؤولا بشكل مباشر أو غير مباشر، ل(ط) ممارسات الخصوصية لمثل هذه المواقع، (ب) محتوى هذه المواقع، بما في ذلك (دون تحديد) أية إعلانات أو محتوى، المنتجات أو البضائع أو غيرها من المواد أو الخدمات أو المتاحة من مثل هذه المواقع أو الموارد أو (ج) استخدام التي بينما البعض الآخر يصنع من هذه المواقع أو الموارد، ولا عن أي ضرر أو خسارة أو جريمة تسببت أو زعم أن سببها، أو في اتصال مع، استخدام أو الاعتماد على أي من هذه الإعلانات، والمحتوى، والمنتجات والبضائع أو المواد أو الخدمات الأخرى المتاحة في تلك المواقع الخارجية أو الموارد.</p><p>توصيات</p><p>عند استخدام موقعنا على شبكة الإنترنت، سترى أن نقدم لكم التوصيات، والتي تبين المنتجات التي تعتقد أنك قد تريد وربما يغيب عندما كنت تصفح الموقع.</p><p>وتستند هذه على مشترياتك الماضية، الأكثر مبيعا، وتقييم والمنتجات التي تم عرضها مؤخرا. علينا أن نحدد المصالح الخاصة بك واقتراح منتجات جديدة قد ترغب. بالإضافة إلى ذلك قارنا اهتماماتك وعادات الشراء مع مصالح وعادات زبائن آخرين، لتظهر لك المنتجات ذات الصلة.</p><p>قد تتغير التوصيات الخاصة بك عند إجراء عملية شراء والتحرك في جميع أنحاء الموقع. قد ترغب في إضافة منتجات التي تهمك لرغبتكم قائمة للرجوع إليها في المستقبل.</p><p>نحن نأخذ عناية معقولة لضمان توصياتنا تتماشى مع سلوكك كعميل على . تفاصيل المنتجات ونحن نوصي - مثل السعر - صحيحة في الوقت الذي قدمت توصيات أصلا لكم، ولكن يمكن أن تكون عرضة للتغيير دون إشعار.</p><p>الطلب، وإلغاء وعودة المنتجات</p><p>أوامر</p><p>سنتخذ كل العناية المعقولة، بقدر ما هو في وسعنا للقيام بذلك، للحفاظ على تفاصيل طلبك ودفع آمنة، ولكن في حالة عدم وجود إهمال من جانبنا نحن لا يمكن أن يكون مسؤولا عن أي خسارة يجوز لك تعاني إذا يدبر طرف ثالث الوصول غير المصرح به إلى أي البيانات التي تقدمها عند الوصول أو الطلب من الموقع.</p><p>إنشاء العقد والمقاولات الإلكترونية</p><p>الخطوات الفنية اللازمة خلق العقد بينك وبين لنا هي كما يلي</p>', 'active'),
('582afee2-0a98-461a-b1bf-e632c0b90f98', 'Exchang And Return Policy', 'exchang-and-return-policy', 'Exchang And Return Policy', 'Exchang And Return Policy', '<p></p><p><strong>&nbsp;Refund Policy<br></strong></p><p>We want you to be happy with your purchase. If you''re not, just return the item with proof of purchase and we''ll exchange it.</p><p>If you post a product to make a return, it can take up to 14 days of your returning the item(s) to receive your refund. If you return your order directly to an NRBBuySell.com office, we''ll process your refund immediately (though it can take up to 5 days for the bank to transfer the funds to you).</p><p>Please return the unused product to us within 14 days of receiving your order.Once returned, we’ll refund the person who originally placed and paid for the order. This includes Clearance.</p><p><b>Are there any products that can’t be returned?</b></p><p>We can’t offer refunds or exchanges, unless faulty or not as described, on the following items:</p><ul>  <li><p>Products which have been personalized      for you, such as stationery or gifts</p></li>  <li><p>Made to measure products such      as curtains or blinds</p></li>  <li><p>Perishable goods such as      flowers, food or real Christmas trees</p></li>  <li><p>Computer software that has been      opened, or computer software cards that have been redeemed</p></li>  <li><p>iTunes gift cards</p></li></ul><p><b>Terms and conditions</b></p><ul>  <li><p>If you''re unhappy with your      purchase, please let us know. Unless faulty, we''d like this to be within 14      days of purchase</p></li>  <li><p>If you return your item to one      of our office and you''d like a refund, we''ll give you a gift card to the      value of the current selling price if you have your receipt or delivery      note</p></li>  <li><p>It''s important that any      unwanted item, unless faulty, is returned in a resalable condition. We''d      expect this to mean that you''ve kept all original packaging and labels,      and that it''s undamaged and unused</p></li>  <li><p>Where a product has been made      to measure or personalized for you, unless faulty, we''re unable to refund      or offer an exchange. </p></li>  <li><p>For online or telephone      purchases we’ll refund the standard delivery charge, provided you return      the full order. If you are only returning some of the items on your order,      then we will only refund the cost of those items</p></li>  <li><p>This does not affect your      statutory rights</p></li></ul><h2>International Returns </h2><h3>What is the refund policy for international items?</h3><p>We want you to be happy with your purchase. If you''re not, please follow the instructions on our delivery note and return it to us at the address shown, obtaining proof of postage. Unless faulty, we''d like you to make your return within 21 days of purchase, and please note that you’ll need to bear postage costs. If the item is faulty, damaged or not as described, please call us on +88 09613717171, 7 days a week, 07:00AM to midnight (BST).</p><h3>How do I return an item by post internationally?</h3><p>If we''ve sent you the wrong items, or your order is faulty, damaged or not as described on arrival, please contact us on +88 09613717171. We will refund postal charges you incur to return such items. Please note that this refund will be in Dollar, and may therefore not equate exactly to the amount paid, owing to fluctuating exchange rates. In such scenario will follow the approved guideline from financial regulatory authority, Bangladesh Bank. </p><p>Please make sure that whatever your reason for returning goods, you obtain proof of postage from your post office, and we will credit your account as soon as possible.</p><h3>When will I receive a refund if I return an international delivery?</h3><p>If you have returned the item to us, your credit or debit card will be credited within 21 days of you sending the returned item.</p><p><br></p>', 'active'),
('582b00da-8080-45cd-9800-4016c0b90f98', 'سياسة الشحن', 'shipping-policy', 'سياسة الشحن', 'سياسة الشحن', '<p>سياسة الشحن</p><p>كيف وزن الشحن المنتج قياسها ووضع اللمسات الأخيرة؟</p><p>عموما التجار /&nbsp; يقيس اثنين من الأوزان، والجسيمة والحجمي. الوزن الإجمالي هو الوزن الفعلي للمنتج التي قمنا بقياسها تقليديا في موازين.</p><p>تدابير الوزن الحجمي من قبل المنتج بعد التعبئة والتغليف: (الطول × الارتفاع × العرض) .This والقياس قد varyif أي إشعار آخر من قبل مقدمي الخدمات اللوجستية ذات الصلة المحلية والسلطات التنظيمية ذات الصلة.</p><p>ما هي رسوم التوصيل؟</p><p>يختلف رسوم الشحن على وجهة. وجميع رسوم الشحن تكون مرئية في مقطع التفاصيل العربة قبل&nbsp; تعمل مع مزودي خدمات النقل البحري المشهور عالميا ومحليا مثل فيديكس، دي إتش إل، سكاي نت ونظم الإدارة البيئية للتسليم في الخارج مع معظم رسوم الشحن تنافسية. خدمة الخدمات اللوجستية القائمة قد تتغير وقت لآخر يعتمد على توافر وجودة الخدمة.</p><p>ما هو وقت التسليم؟</p><p>التجار عموما ترتيب وشحن المنتجات في غضون بعد يوم / الاثنين. أيام عمل باستثناء أيام العطل الرسمية وأيام الجمعة.</p><p>يقدر التسليم في الوقت المحدد يتوقف على العوامل التالية:</p><p>التجار على عرض المنتج</p><p>توافر المنتج مع التجار</p><p>الوجهة التي ترغب في ذلك يتم شحنها إلى وموقع البائع.</p><p>ملاحظة: وخاصة بالنسبة للخدمات التوصيل السريع يستغرق 3-4 أيام عمل في كثير من الحالات، يعتمد على جدول الرحلات مستقر.</p><p>هل هناك أي تكاليف خفية (ضريبة القيمة المضافة، الضرائب الأخرى) في رسوم الشحن للمنتج المباعة من قبل التجار من خلال</p><p>رسوم الشحن لا رسوم خفية، واتهم (على كل حال) اعتمادا اضافية على سياسة الشحن والتاجر.</p><p>لماذا تختلف وقت التسليم لكل التجار؟</p><p>وربما كنت قد لاحظت للتجار من المنتج كنت مهتما في متفاوتة مرات التسليم. وتتأثر مواعيد التسليم التي توفر المنتجات والموقع الجغرافي للتجار، وجهتك الشحن والوقت إلى تقديم الشريك ساعي في موقعك.</p><p>هل الدولة / مقاطعة ومدينة والرمز البريدي / الرمز البريدي إلزاميا بالنسبة للمنتجات حرية؟</p><p>الدولة / مقاطعة ومدينة والرمز البريدي / الرمز البريدي إلزامي للنجاح في الشحن منتج.</p><p>سواء موقعك يمكن خدمتها أو لا يعتمد على</p><p>سواء التجار السفن / إلى موقعك</p><p>القيود القانونية، إن وجدت، في مجال النقل البحري منتجات معينة إلى موقعك</p><p>توافر شركاء ساعي البريد موثوق في موقعك</p><p>في بعض الأحيان التجار&nbsp; تفضل عدم السفينة الى بعض المواقع. هذا هو تماما الوقت الذي تراه مناسبا.</p><p>ولست بحاجة للعودة بندا، كيف أرتب لالبيك اب؟</p><p>العوائد سهلة. اتصل بنا أن يبدأ عودة. يمكنك الاتصال / البريد الإلكتروني / دردشة مناقشة عملية، مرة واحدة كنت قد شرعت في العودة. يمكنك العودة هذا البند من خلال خدمة البريد السريع. وتتحمل رسوم من قبل المشتري، ولكن سوف تتحمل رسوم الشحن إعادة إرسال بواسطة تاجر / واجبات Any والضرائب المرفقة مع عملية العودة سوف تتحملها الأطراف دفع رسوم الشحن. أي تغييرات في السياسة هي التقدير المطلق لتاجر الإدارة.</p><p>هل&nbsp; ترتيب شحن الدولي؟</p><p>اعتبارا من الآن،&nbsp; معرف ارتكبت لتسهيل شراء وبيع بنجلاديش العلامات التجارية لبنجلادش غير مقيم&nbsp; المقيمين في الخارج، وذلك لهذا التجار&nbsp; شراكة مع العالم المشهورة وأفضل أداء شركاء الشحن لكجزء من أفضل الشحن تجربة للعملاء. .</p><p>سوف تكون قادرة على جعل عمليات الشراء الخاصة بك على موقعنا من أي مكان في العالم مع بطاقات الائتمان الصادرة في بنغلاديش ومن كل بلدان العالم، ولكن يرجى التأكد من عنوان التسليم يجب أن تكون دقيقة مع السليم البلد، ولاية / محافظة والرمز البريدي / أرقام الرمز البريدي.</p>', 'active'),
('582c493f-9670-4fed-86e8-4e27c0b90f98', 'About Us', 'about-us', 'About Us', 'About Us', '<p><img class="pull-left fr-fil" data-fr-image-preview="true" alt="Image title" src="http://www.matjaralwatany.com/img/history.jpg" width="171">Matjar Al Watany, was founded in 1953 by Mr. Mohammad Yousaf Sulaiman Al Sheikh as a general trading company in 1980 the business was diversified much towards sports industry.&nbsp;</p><p><br>Mr. Salah M. Sulaiman acquired the position of sole proprietor of the organization in 1990 and established sports retail chain under the name "Matjar Al Watany" – National Stores. </p><p>Today the organization  operates in two segments of business.</p><p><br><strong>Retail Segment :</strong> Comprises of 40 stores extending its tentacles in all the major Urban City''s as well in  the up country market for the consumer need and satisfaction. <br></p><p><strong>The Wholesale :</strong> Operates through our branch offices in Jeddah, Riyadh & Al-Khobar. Our territory of wholesale business caters KSA, Egypt, Kuwait & Bahrain.<br></p>', 'active'),
('582d48a2-0c04-458b-991d-4f89c0b90f98', 'رؤية المهمة', 'mission-&-vision', 'رؤية المهمة', 'رؤية المهمة', '<p><strong class="h9">رؤية<br></strong></p><p>أن تكون جزءا من حياة السعوديين كمقدم رئيسي للمنتجات الرياضية.</p><p><strong class="h9">بيان المهمة<br></strong></p><p>مع سلسلة القيمة أقسام الشركة المتكاملة، ونحن نسعى للعمل مع الصدق والنزاهة، لتلبية تماما احتياجات الشباب السعودي مع المغتربين والقطاع والشركات الحكومية من خلال تقديم جميع أنحاء المدن الكبرى والمحافظات في المملكة جودة عالية الرياضية الدولية والعلامات التجارية نمط الحياة مع تعزيز وتشجيع الأنشطة الرياضية الحي، وفي هذه العملية، وضمان نمو مستقر في إجمالي الإيرادات والربحية.<br></p>', 'active'),
('582d8545-2e7c-4782-879e-486fc0b90f98', 'خصوصية', 'privacy', 'خصوصية', 'خصوصية', '<p><strong>سياسات الخصوصية<br></strong></p><p><strong>حقوق الخصوصية<br></strong></p><p>بجمع المعلومات عنك ويستخدم هذه المعلومات لمساعدتك على التواصل مع أرباب العمل والمشترين والبائعين، والتاجر لتوفير الخدمات الأخرى لك. توضح هذه السياسة كيفية جمع المعلومات الخاصة بك واستخدامها واختياراتك فيما يتعلق بالمعلومات الشخصية الخاصة بك. ونحن نشجعكم على مراجعة سياسة الخصوصية الكاملة للحصول على معلومات مفصلة حول ممارسات الخصوصية.</p><p><strong>نطاق هذه السياسة</strong></p><p>تنطبق هذه السياسة على المعلومات التي نجمعها أو استخدامها على المواقع والتطبيقات التي تملكها أو تسيطر عليها  أو الشركات التابعة لها  ليست مسؤولة عن سياسات أو ممارسات إضافة شبكات ومواقع أخرى، وأطراف ثالثة الذين نعمل معهم في الخصوصية توفر لك خدمات شخصية، أو أولئك الذين الوصول إلى المعلومات الخاصة بك على مواقعنا أو التطبيقات.</p><p><strong>المعلومات التي نجمعها</strong></p><p>نقوم بجمع معلومات عنك عند استخدام موقعنا. نقوم بجمع المعلومات منك مباشرة مثل معلومات الاتصال الخاصة بك، السيرة الذاتية، والمعلومات الشخصية. كما نقوم بجمع المعلومات عنك تلقائيا مثل كيفية استخدام والتفاعل مع موقعنا على الانترنت والمعلومات الديموغرافية والمعلومات حول جهاز الكمبيوتر الخاص بك أو جهاز الهاتف النقال. قد نقوم بجمع أو استخدام المعلومات من المواقع المتاحة للجمهور أم لا كان لديك حساب معنا. سيكون لديك فرصة للمطالبة بتغيير إعداد رؤية، أو إزالة المعلومات. ولكن نحن لا يمكن أن تضمن أننا لن جمع في وقت لاحق من المواقع المتاحة للجمهور غيرها من المعلومات التي تنتمي لك. ونحن قد أيضا الحصول على معلومات عنك من أطراف ثالثة لإضفاء مزيد من التخصيص وتعزيز تجربتك.</p><p><strong>كيف نستخدم المعلومات</strong></p><p>نحن نستخدم المعلومات التي نجمعها عنك لتقديم المنتجات والخدمات التي نقدمها، نرد عليك، وتشغيل وتحسين مواقعنا والتطبيقات. وتشمل خدماتنا يظهر لك محتوى مخصص والإعلان على هذا الموقع أو المواقع الأخرى التي تربطنا بها علاقة تجارية. قد نستخدم المعلومات الخاصة بك للاتصال بك حول تحديثات لدينا، والدراسات الاستقصائية السلوك، أو لتوفير الاتصالات الإعلامية والخدمات ذات الصلة، بما في ذلك استخدام التحديثات الأمنية الهامة. ويمكن الوصول إلى المعلومات التي تشاركها في الأماكن العامة من هذا الموقع أو جعل مرئية في قاعدة بيانات السير الذاتية والشخصية، استخدامها، وتخزينها من قبل الآخرين في جميع أنحاء العالم. ونحن نسعى جاهدين لتوفير بيئة آمنة من خلال محاولة لتقييد الوصول إلى قاعدة البيانات الخاصة بنا للمستخدمين الشرعيين، ولكن نحن لا يمكن أن تضمن أن الأحزاب غير مصرح بها لن الوصول. نحن أيضا لا يمكن التحكم في كيفية المستخدمين المصرح تخزين أو نقل المعلومات التي تعطيها لنا، لذلك يجب أن لا تنشر معلومات حساسة بالنسبة لنا.</p><p><strong>كيف نشارك المعلومات</strong></p><p>نحن لا نشارك المعلومات الاتصال مع أطراف ثالثة لأغراض التسويق المباشر من دون موافقتك. ونحن نشارك معلوماتك مع الأطراف الثالثة التي تساعدنا على تقديم منتجاتنا والخدمات لكم. لا تستطيع هذه الأطراف الثالثة استخدام المعلومات الخاصة بك لأي غرض آخر. قد نشارك المعلومات إلى أطراف ثالثة إذا وافقت. على سبيل المثال، قد نستخدم المعلومات الخاصة بك للاتصال بك عن منتجات او خدمات متوفرة من  أو الشركات التابعة لنا. إذا اخترت في، ونحن يمكن أن يوفر معلومات لأطراف ثالثة الذين قد اتصل بك عن منتجاتها أو خدماتها. قد نكشف المعلومات الأطراف الثالثة التي جمعناها من مواقع أخرى. نكشف المعلومات حيث المطلوبة قانونا. قد نكشف ونقل المعلومات إلى طرف ثالث الذي يكتسب أي من وحدات الأعمال  أو جميعها.</p><p><strong>كيف نقوم بتخزين معلومات</strong></p><p>نقوم بتخزين المعلومات الخاصة بك لجعل التفاعل مع أكثر كفاءة، والعملية، وذات الصلة. تستطيع الوصول إليها، مراجعة أو تصحيح أو تحديث أو حذف سيرتك الذاتية أو البيانات الشخصية في أي وقت عن طريق تسجيل الدخول إلى حسابك. إذا لم يكن لديك حساب، الرجاء الاتصال بنا. عند حذف المعلومات الشخصية الخاصة بك، ونحن سوف تحتفظ السجلات والمعلومات غير الشخصية حول نشاطك على  ونحن أيضا الاحتفاظ نسخة أرشيفية من المعلومات الخاصة بك والتي لا يمكن الوصول إليها من قبلك أو من أطراف ثالثة على شبكة الإنترنت. إذا تم الوصول معلوماتك الشخصية من قبل الآخرين باستخدام موقعنا، ونحن غير قادرين على حذف المعلومات من أنظمتها.</p><p><strong>معلومات أخرى</strong></p><p>وليس المقصود للأطفال دون سن 12 سنة من العمر. نحن نستخدم الكوكيز لمساعدتك على تخصيص وتعظيم تجربتك على الإنترنت على  تستطيع إيقاف الكوكيز. ومع ذلك، وهذا سوف يؤثر سلبا على استخدامك لموقعنا.</p><p><strong>معلومات الاتصال<br></strong></p><p>يمكنك الاتصال بنا عبر الإنترنت للأسئلة أو استفسارات حول الخصوصية. يمكنك أيضا مراسلتنا عبر البريد الإلكتروني.</p><p><br></p>', 'active'),
('582d883e-0314-4ecf-b742-4775c0b90f98', 'رسالة الرئيس التنفيذي', 'ceo-message', 'رسالة الرئيس التنفيذي', 'رسالة الرئيس التنفيذي', '<p>عزيزي العميل المحترم,<br><br>منذ الطفولة، وأنا استخدم لمرافقة والدي في متجر في مدينة الخبر، والتي تأسست في عام 1953، وكان الكثير من الامور لتقديم (أي بطاقات المعايدة، قرطاسية، كاندي ... الخ)، والتي خلقت في النهاية لي شغف التجزئة مثل الشركات .<br><br>على الرغم من أنني لم أكمل بلدي الهندسة المدنية من جامعة قريبة (KFUPM) وعمل لما يقرب من خمس سنوات في المجال الهندسي، وأنا لم يكف عن التفكير لديك بلدي تجارة التجزئة.<br><br>في عام 1983، توفي والدي، وترك عمله لي وإخواني، فقط عندما بدأت ضخ كل جهودي والطاقة نحو بناء السلع الرياضية والفئة عارضة.<br><br>في عام 1990، بنيت بنجاح بنفسي منظمة التسويق الموجهة بعد أن مجهزة أكاديميا في مجال الإدارة والتسويق وعمليات البيع بالتجزئة، وجعل لكم أولوياتي في نهاية المطاف، لتصبح الفئة متخصص في الرياضة والملابس الكاجوال (الأحذية والملابس)، المخلوطة مع مستوى عال من خدمة العملاء جعلتنا الرائدة في هذا المجال والتكتيكية الحملات التسويقية بعد العدوانية مع مرور الوقت الرقي الوعي بالعلامة التجارية أيضا، العديد من العلامات التجارية اليوم تعترف التزامنا والجهود.<br><br>في عام 2010، أكملت بلدي EMBA من جامعة الملك فهد، الذي ترقية ممارساتنا إلى المستوى الدولي المهنية، وفتح الأعمال التجارية في المستقبل مليء بالفرص للحفاظ على مكانة الشركة باعتبارها واحدة من الشركات الرائدة في السوق الناشئة في المملكة العربية السعودية.<br><br>مستقبل صناعة الرياضة المزدهر في المملكة العربية السعودية. لدينا واحدة من أعلى معدلات النمو الولادة في جميع أنحاء العالم، وأكثر من 50٪ من الشباب السعودي هي جميلة من كرة القدم والرياضة. الدوري الاتحاد السعودي اقامة المعايير الدولية من أجل تعزيز هذه الصناعة التي في النهاية سوف تأخذ الطلب وحجم الأعمال التجارية إلى آفاق واسعة.<br><br>لدينا مملكة واسعة 40 متجرا مع 3 بالجملة مكاتب في جدة والرياض والخبر لحضور لاحتياجاتك<br><br>أشكركم على دعمكم، ونأمل للاستمرار في المستقبل.<br><br>ونحن نؤكد لكم أفضل الخدمات والمنتجات ذات الجودة في جميع الأوقات.<br>مع أطيب التحيات الشخصية،<br>المهندس. صلاح بن محمد الشيخ<br></p>', 'active'),
('58353382-8a9c-4e41-8ae1-59d5c0b90f98', 'Store Locator', 'store-locator', 'Store Locator', 'Store Locator', '<p><img class="storeimage fr-fin" alt="Image title" src="http://uysys.net/demo/matjar-alwatany/storelocator.png" width="371"></p><p><br></p>', 'active'),
('58401d62-0a04-4c8f-8434-4415c0b90f98', 'ملف الشركة', 'company-profile', 'ملف الشركة', 'ملف الشركة', '<div class="info-boxes about"><img src="http://www.matjaralwatany.com/img/history.jpg" alt="About Us" class="fr-fin"><p>Matjar الوطني المصري، تأسست في عام 1953 من قبل السيد محمد يوسف سليمان الشيخ كشركة تجارية عامة في عام 1980 في الأعمال وتنوعت كثيرا نحو صناعة.السيد الرياضية. حصلت صلاح محمد سليمان موقف المالك الوحيد للمنظمة في عام 1990، وأنشأ سلسلة متاجر التجزئة الرياضية تحت اسم "Matjar الوطني المصري" - مخازن.اليوم الوطنية تعمل المنظمة في جزأين من الأعمال. <br><strong>قطاع التجزئة:</strong> ويتألف من 40 <br>متجرا تمتد مخالبها في جميع وكذلك في سوق المدينة الحضرية الرئيسية في البلاد لأعلى لحاجة المستهلك وال<strong><br></strong></p><p><strong>وبالجملة:</strong> وتعمل من خلال مكاتب فرعنا في جدة والرياض والخبر. لدينا أراضي تجارة الجملة يخدم المملكة العربية السعودية ومصر والكويت والبحري</p><p class="text-center"><a href="http://themetumblr.net/engine/img/site/Matjar%20Alwatany%20company%20profile.pdf">استعرض نبذة عن الشركة</a></p></div>', 'active'),
('58401eae-1b40-467f-a8be-4181c0b90f98', 'الفروع', 'branches', 'الفروع', 'الفروع', '<div class="info-boxes"><div class="locations-wrapper"><div class="container"><div class="row"><div class="col-xs-12"><h2 class="sub-heading">قائمة المعارض</h2><div class="table-heading"><h3>المنطقة ال شرقية</h3><p>( سΎعΕΎ العمل: 9.30  صبΎحΎ  الκ صاة الظϬر 4 عصرا لκ 10:30 مسΎء )</p><p>قϡاإدارة: 013-8951820</p></div><div class="table-responsive"><table class="table table-bordered"><thead><tr class="blackback"><td>الϬاتف</td><td>العنϭان</td><td>المدينة</td><td>المعرض</td><td>رقم  المعرض</td></tr></thead><tbody><tr><td>013-8948805</td><td>الدϭر اأرضي ، الجΎاريΎ سنتر ، شΎرع اأمير محمد ، تΎϘطع </td><td>الخبر</td><td>الجΎاريΎ</td><td>1</td></tr><tr><td>013-8938668</td><td>مΎϘبل مϭل الرحمΎنيΔ</td><td>الخبر</td><td>كعكي</td><td>2</td></tr><tr><td>013-8673977</td><td>شΎرع  10 ، مΎϘبل مϔرϭشΕΎ الدليجΎن</td><td>الخبر</td><td>لϭتϭ 10</td><td>3</td></tr><tr><td>013-8640641</td><td>شΎرع الظϬران ، الراشد مϭل ، الدϭر اأϭل</td><td>الخبر</td><td>الراشد مϭل</td><td>4</td></tr><tr><td>013-8097778</td><td>كϭرنيش الدمϡΎ ، مبنκ مϭل الϠي مΎرشيه ، مΎϘبل </td><td>الدمϡΎ</td><td>لي مΎرشيه</td><td>5</td></tr><tr><td>013-8349131</td><td>الشΎرع اأϭل ، الدانه مϭل ، الدϭر اأرضي</td><td>الدمϡΎ</td><td>الدانه</td><td>6</td></tr><tr><td>013-8304228 </td><td>شΎرع المϙϠ عبدالعزيز ، مΎϘبل اأسϭاφ الدϭليΔ</td><td>الدمϡΎ</td><td>المϙϠ عبدالعزيز</td><td>7</td></tr><tr><td>013-3636685</td><td>مϭل الجبيل سنتر ، الدϭر اأϭل</td><td>الدمϡΎ</td><td>الجبيل سنتر</td><td>8</td></tr><tr><td>013-3617902</td><td>شΎرع المϙϠ عبدالعزيز ، بΎلϘرΏ من سΎبتكϭ</td><td>الجبيل</td><td>الجبيل 2</td><td>9</td></tr><tr><td>013-3622171</td><td>شΎرع المϙϠ عبدالعزيز</td><td>الجبيل</td><td>محل تصϔيΔ</td><td>10</td></tr><tr><td>013-7673464</td><td>شΎرع اأمير نΎيف</td><td>الخϔجي</td><td>الخϔجي</td><td>11</td></tr><tr><td>013-5812784</td><td>شΎرع الجΎمعΔ ، بΎلϘرΏ من كيϙ هϭΎس</td><td>ااحسΎء</td><td>ااحسΎء 1</td><td>12</td></tr><tr><td>013-8239373</td><td>سنتر الϘطيف ، بΎلϘرΏ من الكϭرنيش ، الدϭر اأرضي</td><td>الϘطيف</td><td>سيتي سنتر</td><td>13</td></tr><tr><td>013-7247667</td><td>شΎرع المϙϠ عبدالعزيز ، تΎϘطع العΎϘريΔ ، بΎلϘرΏ من مطعϡ هرفي</td><td>حϔر البΎطن</td><td>حϔر البΎطن</td><td>14</td></tr></tbody></table></div><div class="table-heading"><h3>المنطقة الϭسطى</h3><p>( سΎعΕΎ العمل: 9.30  صبΎحΎ  الκ صاة الظϬر 4 عصرا لκ 10:30 مسΎء )</p><p>قϡاإدارة: 011-4749890</p></div><div class="table-responsive"><table class="table table-bordered"><thead><tr class="blackback"><td>الϬاتف</td><td>العنϭان</td><td>المدينة</td><td>اسم المعرض</td><td>رقم  المعرض</td></tr></thead><tbody><tr><td>011-4794494</td><td>، بجϭار البنϙ اأهϠي</td><td>الريΎض</td><td>المϠز</td><td>1</td></tr><tr><td>011-4604920</td><td>تΎϘطع العرϭبΔ مع المϙϠ فϬد ، العϠيΎ افنيϭ الجϬه الخϔϠيه ، امϡΎ برج الممϠكΔ </td><td>الريΎض</td><td>العϠيΎ</td><td>2</td></tr><tr><td>011-2356119</td><td>شΎرع رϭضΔ عبدالرحمن الغΎفϘ ي ، مΎϘبل مϭبΎيϠي</td><td>الريΎض</td><td>الرϭضΔ</td><td>3</td></tr><tr><td>011-4497036</td><td>طريφ المدينΔ - البديعΔ بازا  - بجϭار الϬرϡ</td><td>الريΎض</td><td>بديعΔ</td><td>4</td></tr><tr><td>016-3266803</td><td>شΎرع المϙϠ خΎلد ، عمΎئر الراجحي بعد فندφ مϭفمب</td><td>الϘصيϡ</td><td>بريدة</td><td>5</td></tr><tr><td>016-3624241 </td><td>شΎرع الزلϔ ي ، دϭار السΎعΔ بجϭار بنϙ سΎمبΎ</td><td>الϘصيϡ</td><td>عنيزة</td><td>6</td></tr><tr><td>016-3390092 </td><td>شΎرع الرس الرئسي امϡΎ بنϙ الراجحي</td><td>الϘصيϡ</td><td>الرس</td><td>7</td></tr><tr><td>016-5333550 </td><td>شΎرع برج حΎئل ، بجϭار برج حΎئل قبل البنϙ العربي</td><td>حΎئل</td><td>حΎئل</td><td>8</td></tr><tr><td>014-6654455</td><td>شΎرع المϙϠ عبده ، بجΎنΏ مطعϡ كنΎرρ</td><td>عرعر</td><td>عرعر</td><td>9</td></tr></tbody></table></div><div class="table-heading"><h3>المنطقة ال غربية</h3><p>( سΎعΕΎ العمل: 9.30  صبΎحΎ  الκ صاة الظϬر  11-5 مسΎء )</p><p>قϡاإدارة: 011-4749890</p></div><div class="table-responsive"><table class="table table-bordered"><thead><tr class="blackback"><td>الϬاتف</td><td>العنϭان</td><td>المدينة</td><td>اسم المعرض</td><td>رقم  المعرض</td></tr></thead><tbody><tr><td>012-6438495</td><td>الدϭر الثΎلث ، محمل سنتر ، البϠد</td><td>جده</td><td>المحمل سنتر</td><td>1</td></tr><tr><td>012-6421547 </td><td>بغداديΔ الغربيΔ ، شΎرع حΏϠ</td><td>جده</td><td>البغداديΔ</td><td>2</td></tr><tr><td>012-6646734 </td><td>شΎرع المدينΔ ، مϭل الشعΔϠ</td><td>جده</td><td>الشعΔϠ</td><td>3</td></tr><tr><td>012-6819661 </td><td>شΎرع الجΎمعΔ ، حي الجΎمعΔ</td><td>جده</td><td>الجΎمعΔ</td><td>4</td></tr><tr><td>012-6552547</td><td>شΎرع حراء  ، دϭار الجϭاد اأبيض</td><td>جده</td><td>حراء</td><td>5</td></tr><tr><td>012-2387797</td><td>شΎرع حراء دϭار التΎريخ ، بجΎنΏ افنيϭ مϭل</td><td>جده</td><td>حراء بازا</td><td>6</td></tr><tr><td>012-2842528</td><td>شΎرع الرϭضΔ ، حي الϔيصϠيΔ ، دϭار الدراجΔ</td><td>جده</td><td>الϔيصϠيΔ</td><td>7</td></tr><tr><td>014-3226466 </td><td>البحر ، شΎرع الحنΎن ، بجΎنΏ المستشκϔ</td><td>ينبع</td><td>ينبع 1</td><td>8</td></tr><tr><td>TBA</td><td>ينبع البϠد ، طريφ المϙϠ عبدالعزيز ، بجϭار عΎلϡ العصΎئر</td><td>جΎزان</td><td>ينبع 2</td><td>9</td></tr><tr><td>TBA</td><td>مΎϘبل كΎدρ مϭل بجΎنΏ مϭبΎيϠي</td><td>عرعر</td><td>جΎزان</td><td>9</td></tr></tbody></table></div></div></div></div></div><p class="text-center"><a href="http://themetumblr.net/engine/img/site/Full%20Store%20list.pdf" target="_blank">View full list</a></p></div>', 'active'),
('58b7cdf0-cf74-4a9c-8924-4f29c0b90f98', 'FAQ', 'faq', 'FAQ', 'FAQ', '<p></p><h4>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...</h4><p><br></p>', 'active'),
('58ba4dbf-aef0-4d60-af41-d0e5c0b90f98', 'Track Order', 'track-order', 'Track Order', 'Track Order', '<p>Track Order<br></p>', 'active'),
('58ba4dd6-487c-494e-b42d-d387c0b90f98', 'Payment Methods', 'payment-methods', 'Payment Methods', 'Payment\r\nMethods', '<p>Payment<br>Methods<br></p>', 'active'),
('58ba4de4-3aa4-40c8-8fec-d4e5c0b90f98', 'Size Guide', 'size-guide', 'Size Guide', 'Size Guide', '<p>Size Guide<br></p>', 'active'),
('58ba4e06-e304-4a63-819e-d8adc0b90f98', 'Returns', 'returns', 'Returns', 'Returns', '<p>Returns<br></p>', 'active'),
('58ba87e9-9700-4d21-bfbb-b202c0b90f98', 'Cookies', 'cookies', 'Cookies', 'Cookies', '<p><a href="">Cookies<br></a></p>', 'active'),
('58f8a4cf-93b4-4265-88fc-045ac0b90f98', 'Test', 'test', '1', '2', '<p>Test</p>', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `web_page_details`
--

CREATE TABLE IF NOT EXISTS `web_page_details` (
  `id` char(36) NOT NULL,
  `web_page_id` char(36) NOT NULL,
  `question` varchar(100) NOT NULL,
  `answer` varchar(250) NOT NULL,
  `status` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `web_page_details`
--

INSERT INTO `web_page_details` (`id`, `web_page_id`, `question`, `answer`, `status`) VALUES
('58b6922e-42d0-4068-842b-0e17cdd1d5ac', '57c80dc4-0db4-4ca3-b009-2849cdd1d5ac', 'How are you?', 'fff', 'active'),
('58b69a68-e864-4d3e-9950-237ecdd1d5ac', '57c80dc4-0db4-4ca3-b009-2849cdd1d5ac', 'Where are you now?', 'dsfdsf', 'active'),
('58b7ce19-a82c-4e97-9132-4555c0b90f98', '58b7cdf0-cf74-4a9c-8924-4f29c0b90f98', 'What is Lorem Ipsum?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It h', 'active'),
('58b7ce30-6bd8-487d-9176-4714c0b90f98', '58b7cdf0-cf74-4a9c-8924-4f29c0b90f98', 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up', 'active'),
('58cfc813-57ec-4b29-95b5-4426c0b90f98', '58b7cdf0-cf74-4a9c-8924-4f29c0b90f98', 'gbcvb', 'bvcvbcv', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `baskets`
--
ALTER TABLE `baskets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency_values`
--
ALTER TABLE `currency_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `english_menus`
--
ALTER TABLE `english_menus`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `english_overviews`
--
ALTER TABLE `english_overviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `english_web_pages`
--
ALTER TABLE `english_web_pages`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `english_web_page_details`
--
ALTER TABLE `english_web_page_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `overviews`
--
ALTER TABLE `overviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_networks`
--
ALTER TABLE `social_networks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `subscriber_notifications`
--
ALTER TABLE `subscriber_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriber_notification_details`
--
ALTER TABLE `subscriber_notification_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_pages`
--
ALTER TABLE `web_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_page_details`
--
ALTER TABLE `web_page_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baskets`
--
ALTER TABLE `baskets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=261;
--
-- AUTO_INCREMENT for table `currency_values`
--
ALTER TABLE `currency_values`
  MODIFY `id` tinyint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `english_overviews`
--
ALTER TABLE `english_overviews`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `overviews`
--
ALTER TABLE `overviews`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `social_networks`
--
ALTER TABLE `social_networks`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
