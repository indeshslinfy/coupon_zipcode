-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 20, 2018 at 08:26 AM
-- Server version: 10.0.34-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `couponzi_beta`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(10) UNSIGNED NOT NULL,
  `address_line1` varchar(100) NOT NULL,
  `address_line2` varchar(100) DEFAULT NULL,
  `address_line3` varchar(100) DEFAULT NULL,
  `address_city_id` int(11) NOT NULL,
  `address_state_id` int(11) NOT NULL,
  `address_country_id` int(11) NOT NULL,
  `address_zipcode` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `address_line1`, `address_line2`, `address_line3`, `address_city_id`, `address_state_id`, `address_country_id`, `address_zipcode`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'C-110', 'Phase 7, Industrial Area', '', 1, 32, 1, '10002', 1, NULL, '2018-01-05 00:00:00', '2018-03-19 11:20:19'),
(2, 'E-584', 'Phase 8, Industrial Area', 'Near Coffee Shop', 1, 32, 1, '10002', 1, NULL, '2018-01-05 00:00:00', '2018-03-19 11:16:34'),
(3, '#265, Lane Cove', 'Mark Street II', '', 1, 32, 1, '10002', 1, NULL, '2018-01-05 14:30:05', '2018-03-19 11:16:44'),
(5, '9th Avenue', '712 9th Ave ', '', 1, 32, 1, '10002', 1, NULL, '2018-02-02 09:40:44', NULL),
(6, '9th Avenue', '712 9th Ave', '', 1, 32, 1, '', 1, NULL, '2018-02-02 09:45:31', '2018-03-19 11:20:37'),
(7, '9th Avenue', '712 9th Ave', '', 1, 32, 1, '', 1, NULL, '2018-02-02 12:46:00', '2018-02-02 12:57:00'),
(8, '10 Columbus Circle', '', '', 1, 32, 1, '', 1, NULL, '2018-02-05 08:17:24', '2018-03-19 11:20:54'),
(9, '640 3rd Ave', '', '', 1, 32, 1, '', 1, NULL, '2018-02-05 08:46:31', '2018-03-19 11:21:09'),
(10, '54 Thompson St', '', '', 1, 32, 1, '', 1, NULL, '2018-02-05 10:01:10', '2018-03-19 11:17:23'),
(11, '22-04 33rd Street', '', '', 1, 32, 1, '', 1, NULL, '2018-02-05 11:01:00', '2018-03-19 11:21:22'),
(12, '3620 Ditmars Blvd', '', '', 1, 32, 1, '', 1, NULL, '2018-02-05 12:21:27', '2018-03-19 11:21:27'),
(13, '45-01 Ditmars Blvd', '', '', 1, 32, 1, '', 1, NULL, '2018-02-05 12:44:12', '2018-03-19 11:22:18'),
(14, 'c-110,phase 7', '', '', 1, 32, 1, '', 1, NULL, '2018-02-06 06:10:01', '2018-02-06 06:15:06'),
(15, 'asdasdsadsa', '', '', 1, 32, 1, '', 1, NULL, '2018-02-06 06:28:30', '2018-02-06 06:31:00'),
(16, '9th Avenue', '', '', 1, 32, 1, '', 1, NULL, '2018-02-08 08:11:52', '2018-02-08 08:29:16'),
(17, '9th Avenue', '', '', 1, 32, 1, '', 1, NULL, '2018-02-08 08:12:29', '2018-02-08 08:14:50'),
(18, '9th Avenue', '', '', 1, 32, 1, '', 1, NULL, '2018-02-08 08:18:28', NULL),
(19, 'hgj', '', '', 1, 32, 1, '', 1, NULL, '2018-02-08 08:26:56', '2018-02-08 08:27:25'),
(20, 'ty', '', '', 1, 32, 1, '', 1, NULL, '2018-02-08 08:28:15', NULL),
(21, '9th Avenue', '', '', 1, 32, 1, '', 1, NULL, '2018-02-08 08:33:42', '2018-02-08 08:34:20'),
(22, '10 Columbus Circle', '', '', 1, 32, 1, '', 1, NULL, '2018-02-08 08:36:45', NULL),
(23, '2891 St 3', '', '', 1, 32, 1, '', 1, NULL, '2018-03-08 01:41:56', NULL),
(24, 'sd', 'c122', '122', 1, 32, 1, '', 1, NULL, '2018-03-09 00:20:35', '2018-03-09 02:42:28'),
(25, 'https://beta.couponzipcode.com/admin/add-store', 'https://beta.couponzipcode.com/admin/add-store', 'https://beta.couponzipcode.com/admin/add-store', 1, 32, 1, '', 1, NULL, '2018-03-09 00:45:09', '2018-03-09 02:31:52'),
(26, 'https://beta.couponzipcode.com/', 'https://beta.couponzipcode.com/', 'https://beta.couponzipcode.com/', 1, 32, 1, '', 1, NULL, '2018-03-09 01:16:44', '2018-03-09 02:42:12'),
(27, 'c123', '', '', 1, 32, 1, '', 1, NULL, '2018-03-09 05:40:01', '2018-03-19 11:17:31');

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_categories`
--

CREATE TABLE `affiliate_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(256) NOT NULL,
  `category_slug` varchar(256) DEFAULT NULL,
  `category_uid` varchar(50) DEFAULT NULL,
  `category_source` int(11) NOT NULL COMMENT '1. GROUPON 2. EBAY 3. AMAZON',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `affiliate_categories`
--

INSERT INTO `affiliate_categories` (`id`, `category_name`, `category_slug`, `category_uid`, `category_source`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Antiques', NULL, '20081', 2, NULL, '2018-01-31 10:55:16', NULL),
(2, 'Art', NULL, '550', 2, NULL, '2018-01-31 10:55:16', NULL),
(3, 'Baby', NULL, '2984', 2, NULL, '2018-01-31 10:55:16', NULL),
(4, 'Books', NULL, '267', 2, NULL, '2018-01-31 10:55:16', NULL),
(5, 'Business & Industrial', NULL, '12576', 2, NULL, '2018-01-31 10:55:16', NULL),
(6, 'Cameras & Photo', NULL, '625', 2, NULL, '2018-01-31 10:55:16', NULL),
(7, 'Cell Phones & Accessories', NULL, '15032', 2, NULL, '2018-01-31 10:55:16', NULL),
(8, 'Clothing, Shoes & Accessories', NULL, '11450', 2, NULL, '2018-01-31 10:55:16', NULL),
(9, 'Coins & Paper Money', NULL, '11116', 2, NULL, '2018-01-31 10:55:16', NULL),
(10, 'Collectibles', NULL, '1', 2, NULL, '2018-01-31 10:55:16', NULL),
(11, 'Computers/Tablets & Networking', NULL, '58058', 2, NULL, '2018-01-31 10:55:16', NULL),
(12, 'Consumer Electronics', NULL, '293', 2, NULL, '2018-01-31 10:55:16', NULL),
(13, 'Crafts', NULL, '14339', 2, NULL, '2018-01-31 10:55:16', NULL),
(14, 'Dolls & Bears', NULL, '237', 2, NULL, '2018-01-31 10:55:16', NULL),
(15, 'DVDs & Movies', NULL, '11232', 2, NULL, '2018-01-31 10:55:16', NULL),
(16, 'Entertainment Memorabilia', NULL, '45100', 2, NULL, '2018-01-31 10:55:16', NULL),
(17, 'Gift Cards & Coupons', NULL, '172008', 2, NULL, '2018-01-31 10:55:16', NULL),
(18, 'Health & Beauty', NULL, '26395', 2, NULL, '2018-01-31 10:55:16', NULL),
(19, 'Home & Garden', NULL, '11700', 2, NULL, '2018-01-31 10:55:16', NULL),
(20, 'Jewelry & Watches', NULL, '281', 2, NULL, '2018-01-31 10:55:16', NULL),
(21, 'Music', NULL, '11233', 2, NULL, '2018-01-31 10:55:16', NULL),
(22, 'Musical Instruments & Gear', NULL, '619', 2, NULL, '2018-01-31 10:55:16', NULL),
(23, 'Pet Supplies', NULL, '1281', 2, NULL, '2018-01-31 10:55:16', NULL),
(24, 'Pottery & Glass', NULL, '870', 2, NULL, '2018-01-31 10:55:16', NULL),
(25, 'Real Estate', NULL, '10542', 2, NULL, '2018-01-31 10:55:16', NULL),
(26, 'Specialty Services', NULL, '316', 2, NULL, '2018-01-31 10:55:16', NULL),
(27, 'Sporting Goods', NULL, '888', 2, NULL, '2018-01-31 10:55:16', NULL),
(28, 'Sports Mem, Cards & Fan Shop', NULL, '64482', 2, NULL, '2018-01-31 10:55:16', NULL),
(29, 'Stamps', NULL, '260', 2, NULL, '2018-01-31 10:55:16', NULL),
(30, 'Tickets & Experiences', NULL, '1305', 2, NULL, '2018-01-31 10:55:16', NULL),
(31, 'Toys & Hobbies', NULL, '220', 2, NULL, '2018-01-31 10:55:16', NULL),
(32, 'Travel', NULL, '3252', 2, NULL, '2018-01-31 10:55:16', NULL),
(33, 'Video Games & Consoles', NULL, '1249', 2, NULL, '2018-01-31 10:55:16', NULL),
(34, 'Everything Else', NULL, '99', 2, NULL, '2018-01-31 10:55:16', NULL),
(35, 'Automotive', 'automotive', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(36, 'Beauty and Spas', 'beauty-and-spas', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(37, 'Health and Fitness', 'health-and-fitness', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(38, 'Electronics', 'electronics', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(39, 'Entertainment and Media', 'entertainment-and-media', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(40, 'Groceries Household and Pets', 'groceries-household-and-pets', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(41, 'Jewellery and Watches', 'jewelry-and-watches', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(42, 'Food and Drink', 'food-and-drink', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(44, 'Home Improvement', 'home-improvement', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(45, 'Personal Services', 'personal-services', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(46, 'Retail', 'retail', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(47, 'Things To Do', 'things-to-do', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(48, 'Auto And Home Improvement', 'auto-and-home-improvement', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(49, 'Baby Kids And Toys', 'baby-kids-and-toys', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(50, 'Collectibles', 'collectibles', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(51, 'For The Home', 'for-the-home', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(52, 'Health And Beauty', 'health-and-beauty', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(53, 'Mens Clothing Shoes And Accessories', 'mens-clothing-shoes-and-accessories', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(54, 'Sports And Outdoors', 'sports-and-outdoors', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(55, 'Womens Clothing Shoes And Accessories', 'womens-clothing-shoes-and-accessories', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(56, 'Cruise Travel', 'cruise-travel', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(57, 'Flights And Transportation', 'flights-and-transportation', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(58, 'Hotels And Accommodations', 'hotels-and-accommodations', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(59, 'Tour Travel', 'tour-travel', NULL, 1, NULL, '2018-02-01 00:00:00', NULL),
(98, 'Wine', 'Wine', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(99, 'Wireless', 'Wireless', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(100, 'Arts and Crafts', 'ArtsAndCrafts', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(101, 'Miscellaneous', 'Miscellaneous', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(102, 'Jewelry', 'Jewelry', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(103, 'Mobile Apps', 'MobileApps', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(104, 'Photo', 'Photo', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(105, 'Shoes', 'Shoes', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(106, 'Kindle Store', 'KindleStore', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(107, 'Automotive', 'Automotive', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(108, 'Vehicles', 'Vehicles', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(109, 'Pantry', 'Pantry', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(110, 'Musical Instruments', 'MusicalInstruments', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(111, 'Digital Music', 'DigitalMusic', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(112, 'Gift Cards', 'GiftCards', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(113, 'Fashion Baby', 'FashionBaby', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(114, 'Fashion Girls', 'FashionGirls', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(115, 'Gourmet Food', 'GourmetFood', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(116, 'Home Garden', 'HomeGarden', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(117, 'Music Tracks', 'MusicTracks', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(118, 'Unbox Video', 'UnboxVideo', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(119, 'Fashion Women', 'FashionWomen', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(120, 'Video Games', 'VideoGames', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(121, 'Fashion Men', 'FashionMen', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(122, 'Kitchen', 'Kitchen', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(123, 'Video', 'Video', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(124, 'Software', 'Software', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(125, 'Beauty', 'Beauty', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(126, 'Grocery', 'Grocery', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(127, 'Fashion Boys', 'FashionBoys', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(128, 'Industrial', 'Industrial', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(129, 'Pet Supplies', 'PetSupplies', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(130, 'Office Products', 'OfficeProducts', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(131, 'Magazines', 'Magazines', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(132, 'Watches', 'Watches', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(133, 'Luggage', 'Luggage', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(134, 'Outdoor Living', 'OutdoorLiving', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(135, 'Toys', 'Toys', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(136, 'Sporting Goods', 'SportingGoods', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(137, 'PC Hardware', 'PCHardware', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(138, 'Movies', 'Movies', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(139, 'Books', 'Books', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(140, 'Collectibles', 'Collectibles', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(141, 'Handmade', 'Handmade', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(142, 'VHS', 'VHS', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(143, 'MP3 Downloads', 'MP3Downloads', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(144, 'Home and Business Services', 'HomeAndBusinessServices', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(145, 'Fashion', 'Fashion', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(146, 'Tools', 'Tools', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(147, 'Baby', 'Baby', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(148, 'Apparel', 'Apparel', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(149, 'Marketplace', 'Marketplace', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(150, 'DVD', 'DVD', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(151, 'Appliances', 'Appliances', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(152, 'Music', 'Music', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(153, 'Lawn and Garden', 'LawnAndGarden', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(154, 'Wireless Accessories', 'WirelessAccessories', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(155, 'Blended', 'Blended', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(156, 'Health Personal Care', 'HealthPersonalCare', NULL, 3, NULL, '2018-02-12 00:00:00', NULL),
(157, 'Classical', 'Classical', NULL, 3, NULL, '2018-02-12 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE `captcha` (
  `captcha_id` bigint(13) UNSIGNED NOT NULL,
  `captcha_time` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `word` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(1, 1516183894, '112.196.33.90', 'Su0LZ'),
(2, 1516183917, '112.196.33.90', 'o4LQp');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `city_name` varchar(50) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city_name`, `state_id`) VALUES
(1, 'New York', 32);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_name` varchar(50) NOT NULL,
  `country_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name`, `country_code`) VALUES
(1, 'United States', 'US');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `coupon_title` varchar(256) NOT NULL,
  `coupon_code` varchar(128) NOT NULL,
  `coupon_type` int(11) NOT NULL DEFAULT '1',
  `coupon_start_date` datetime NOT NULL,
  `coupon_end_date` datetime NOT NULL,
  `coupon_description` longtext NOT NULL,
  `coupon_fine_print` varchar(1024) NOT NULL,
  `coupon_zipcode_id` varchar(50) NOT NULL,
  `coupon_store_id` int(11) NOT NULL,
  `coupon_publish` tinyint(1) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '3',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_title`, `coupon_code`, `coupon_type`, `coupon_start_date`, `coupon_end_date`, `coupon_description`, `coupon_fine_print`, `coupon_zipcode_id`, `coupon_store_id`, `coupon_publish`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '25% of on Soccer Jersey', '25OFFSOCCER', 1, '2018-03-05 00:00:00', '2018-03-28 00:00:00', 'You\'ll get 25% of on Soccer Jersey. Enjoy the treat with your loved ones.', 'You\'ll get 25% of on Soccer Jersey. Enjoy the treat with your loved ones.', '10', 19, 1, 1, NULL, '2018-01-19 07:09:15', '2018-03-09 07:35:57'),
(2, '50% off on Indian food', '50PERCBURG', 1, '2018-03-11 00:00:00', '2018-03-15 00:00:00', 'Get 50% off on burgers. Hurry. Limited offer only. Reach your nearest outlet quickly for yum food.', 'Get 50% off on burgers. Hurry FP', '2', 1, 1, 3, NULL, '2018-01-15 10:01:44', '2018-03-09 08:22:41'),
(3, '75% of on Jeans', '25OFFJEANS', 1, '2018-03-06 00:00:00', '2018-03-29 00:00:00', 'You\'ll get 75% of on Jeans. Enjoy the treat with your loved ones.', 'You\'ll get 75% of on Jeans. Enjoy the treat with your loved ones.', '1', 27, 1, 1, NULL, '2018-01-08 00:00:00', '2018-03-09 07:03:20'),
(4, 'Get 15 % Off', '15PERCBURG', 1, '2018-03-12 00:00:00', '2018-03-28 00:00:00', 'Get 15% off on your favorite food. Hurry. Limited offer only. Reach your nearest outlet quickly for yum food.', 'Get 50% off on bill. Hurry FP', '2', 21, 1, 3, NULL, '2018-02-02 09:50:50', '2018-03-09 04:32:48'),
(5, '15% off on Burgers', ' SAVE15', 1, '2018-01-09 00:00:00', '2018-01-16 00:00:00', 'Get 15% off on burgers. Hurry. Limited offer only. Reach your nearest outlet quickly for yum food.', 'Get 15% off on burgers. Hurry FP', '2', 7, 0, 2, NULL, '2018-02-05 05:05:51', '2018-03-09 02:46:51'),
(6, '20% off on Pizza', ' SAVE20', 1, '2018-01-09 00:00:00', '2018-06-30 00:00:00', 'Get 15% off on Pizza. Hurry. Limited offer only. Reach your nearest outlet quickly for yum food.', 'Get 20% off on Pizza. Hurry FP', '2', 21, 0, 1, NULL, '2018-02-05 05:41:57', '2018-03-19 11:31:00'),
(7, '50% off on Masala Dosa', '50PERCMASA', 1, '2018-01-29 00:00:00', '2018-06-30 00:00:00', 'Get 50% off on Masala Dosa. Hurry. Limited offer only. Reach your nearest outlet quickly for yum food.', 'Get 50% off on Masa. Hurry FP', '2', 23, 1, 1, NULL, '2018-02-05 12:55:12', '2018-03-19 11:32:29'),
(8, '$15 off on Molcajete Guacamole', '15DOLLARMOLCAJETE', 1, '2018-03-21 00:00:00', '2018-04-27 00:00:00', '$ 15 de descuento en el Guacamole de Molcajete. Oferta limitada solamente. Llega a tu punto de venta más cercano rápidamente para comer rico.', 'Obtenga un 50% de descuento en Molcajete. Rápido FP', '9', 24, 1, 3, NULL, '2018-02-05 13:10:19', '2018-03-09 05:18:07'),
(9, 'Get 15 % Off on chocolate mousse', '15PERCCHOCO', 1, '2018-01-19 00:00:00', '2018-02-26 00:00:00', 'Get 15% off on your chocolate mousse. Hurry. Limited offer only.', 'Get 50% off on chocolate mousse. Hurry FP', '2', 25, 0, 2, NULL, '2018-02-05 13:14:27', '2018-03-09 02:46:51'),
(10, 'Get 5 % Off on muffins', '5PERCMUFFINS', 1, '2018-01-29 00:00:00', '2018-02-26 00:00:00', 'Get 5% off on when you buy your favorite muffins. Hurry. Limited offer only.', 'Get 5% off on muffins. Hurry FP', '2', 26, 0, 2, NULL, '2018-02-05 13:23:34', '2018-03-09 02:46:51'),
(11, ' OK TESTED', ' OK-TESTED', 1, '2018-01-16 00:00:00', '2018-01-17 00:00:00', ' ', '  ', '2', 1, 0, 2, NULL, '2018-03-07 00:22:25', '2018-03-09 03:58:52'),
(12, 'Get 30% off', 'HARSH', 1, '2018-01-09 00:00:00', '2018-01-10 00:00:00', '', '', '1', 27, 0, 2, NULL, '2018-03-07 00:25:09', '2018-03-09 04:20:54'),
(13, 'demo', '1234', 1, '2018-01-08 00:00:00', '2018-01-09 00:00:00', 'ds', '', '1', 28, 0, 2, NULL, '2018-03-07 00:27:33', '2018-03-09 04:21:40'),
(14, 'get 10% off', '1234', 1, '2018-03-04 00:00:00', '2018-03-05 00:00:00', 'get 10% off', '', '1', 27, 0, 2, NULL, '2018-03-08 00:44:36', '2018-03-09 02:46:51'),
(15, 'alba coupon', '123456', 1, '2018-01-08 00:00:00', '2018-01-24 00:00:00', '', '', '1', 27, 0, 2, NULL, '2018-03-08 07:18:09', '2018-03-09 04:18:34'),
(16, 'demo-alba', '123456', 1, '2018-01-01 00:00:00', '2018-01-16 00:00:00', 'demo', '', '1', 27, 0, 2, NULL, '2018-03-08 07:28:44', '2018-03-09 04:21:15'),
(17, 'c-zip discount 10%', 'demo discount of 10%', 1, '2018-03-04 00:00:00', '2018-03-31 00:00:00', 'Get the discount of 10%', 'Get the discount of 10%', '2', 25, 0, 1, NULL, '2018-03-09 00:31:02', '2018-03-19 11:19:20'),
(18, '50% off on fresh arrival', 'code1234', 1, '2018-03-04 00:00:00', '2018-03-31 00:00:00', 'discount coupon', '', '2', 32, 1, 1, NULL, '2018-03-09 05:42:30', '2018-03-09 06:41:49');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `id` int(10) UNSIGNED NOT NULL,
  `subscriber_name` varchar(128) DEFAULT NULL,
  `subscriber_email` varchar(128) NOT NULL,
  `is_subscribed` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter_subscribers`
--

INSERT INTO `newsletter_subscribers` (`id`, `subscriber_name`, `subscriber_email`, `is_subscribed`, `created_at`, `updated_at`) VALUES
(2, 'Indesh Prinja', 'indesh.slinfy@gmail.com', 1, '2018-02-09 07:01:13', NULL),
(3, 'Indesh Prinja', 'indeshprinja@gmail.com', 1, '2018-02-09 07:04:22', NULL),
(4, 'indesh', 'indesh.slinfy@gmail.comz', 1, '2018-02-16 08:23:29', NULL),
(5, 'indesh', 'indesh.slinfy@gmail.comzz', 1, '2018-02-16 08:23:53', NULL),
(6, 'harsh', 'tester.slinfy@gmail.com', 1, '2018-03-07 01:09:38', NULL),
(7, 'Pranav TEsting', 'sunil.slinfy@gmail.com', 1, '2018-03-07 05:05:58', NULL),
(8, 'Sunil 2', 's.unil.slinfy@gmail.com', 1, '2018-03-07 05:06:44', NULL),
(9, 'Pranav', 'pranav.slinfy@gmail.com', 1, '2018-03-07 05:07:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `review_text` varchar(2048) NOT NULL,
  `rating` double(10,2) NOT NULL,
  `reviewer_id` int(11) DEFAULT NULL,
  `reviewer_name` varchar(50) NOT NULL,
  `review_type` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `review_text`, `rating`, `reviewer_id`, `reviewer_name`, `review_type`, `receiver_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'I went here last week with my family. The food here is very good and hygenic. I would love to visit Body Fuel in future also.', 2.00, NULL, 'Vishal Goyal', 1, 1, 1, NULL, '2018-01-11 00:00:00', '2018-02-01 08:40:27'),
(2, 'The most amazing part of this place is their quick food service. No matter how crowded this place is, you will not have to wait for more than 10 minutes.', 5.00, 1, 'Indesh Prinja', 1, 1, 1, NULL, '2018-01-11 00:00:00', '2018-02-01 08:33:04'),
(21, 'Food was too yum. Full money value.', 3.50, 7, 'Pranav Kumar', 1, 1, 1, NULL, '2018-01-15 11:21:46', '2018-02-01 08:37:00'),
(22, 'well it\'s too awesome, i am too happy with your work.', 5.00, NULL, 'Pranav', 1, 19, 0, NULL, '2018-02-01 08:04:45', '2018-02-01 08:44:15'),
(24, 'It is so good', 3.50, NULL, 'Sumit', 1, 28, 0, '2018-03-08 07:47:36', '2018-03-07 01:08:15', '2018-03-08 07:47:36'),
(25, 'good', 3.50, NULL, 'riya', 1, 24, 1, '2018-03-08 07:47:08', '2018-03-08 00:36:29', '2018-03-08 07:47:08'),
(26, 'The services provided by the stores was excellent', 5.00, NULL, 'C-zip', 1, 25, 1, NULL, '2018-03-09 00:32:55', '2018-03-09 00:34:18'),
(27, 'Demo to test', 5.00, NULL, 'Riya', 1, 29, 1, '2018-03-09 00:36:07', '2018-03-09 00:33:46', '2018-03-09 00:36:07'),
(28, 'dssd', 3.50, NULL, 'sdsd', 1, 29, 1, '2018-03-09 00:36:12', '2018-03-09 00:34:41', '2018-03-09 00:36:12'),
(29, 'rfs', 3.50, NULL, 'efs', 1, 29, 1, '2018-03-09 00:36:17', '2018-03-09 00:35:41', '2018-03-09 00:36:17'),
(30, 'rd', 0.50, NULL, 'c-riu', 1, 29, 1, '2018-03-09 00:36:59', '2018-03-09 00:36:30', '2018-03-09 00:36:59'),
(31, 'Its was excellent experience', 5.00, NULL, 'Harsh', 1, 24, 0, NULL, '2018-03-09 07:45:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `role_slug` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `role_slug`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super-admin', 1, NULL, '0000-00-00 00:00:00', NULL),
(2, 'Admin', 'admin', 1, NULL, '0000-00-00 00:00:00', NULL),
(3, 'User', 'user', 1, NULL, '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(128) NOT NULL,
  `setting_value` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_key`, `setting_value`, `created_at`, `updated_at`) VALUES
(1, 'email', 'a:2:{s:11:\"admin_email\";s:19:\"pranav82k@gmail.com\";s:10:\"admin_name\";s:18:\"Team CouponZipcode\";}', '2018-01-08 14:53:19', NULL),
(2, 'general_settings', 'a:3:{s:12:\"company_name\";s:13:\"CouponZipcode\";s:12:\"company_logo\";s:19:\"assets/img/logo.png\";s:15:\"company_favicon\";s:22:\"assets/img/favicon.ico\";}', '2018-01-08 13:06:58', NULL),
(3, 'zipcode_search_radius', 's:2:\"10\";', '2018-01-08 14:52:57', NULL),
(4, 'google_map_key', 's:39:\"AIzaSyC1-Jvfh71t0Wi05t8jh2hASRSrjmvaE6Y\";', '2018-01-08 14:52:59', NULL),
(14, 'groupon', 'a:2:{s:10:\"groupon_id\";s:6:\"212556\";s:8:\"media_id\";s:6:\"208295\";}', '2018-01-16 00:00:00', NULL),
(15, 'ebay', 'a:2:{s:6:\"app_id\";s:40:\"Couponzi-couponzi-PRD-05d80d3bd-0327d4a8\";s:7:\"camp_id\";s:10:\"5338251126\";}', '2018-01-30 00:00:00', NULL),
(16, 'frontend_menu', 'a:6:{i:0;a:3:{s:4:\"slug\";s:3:\"eat\";s:4:\"name\";s:3:\"Eat\";s:2:\"id\";s:2:\"55\";}i:1;a:3:{s:4:\"slug\";s:4:\"play\";s:4:\"name\";s:4:\"Play\";s:2:\"id\";s:2:\"56\";}i:2;a:3:{s:4:\"slug\";s:4:\"shop\";s:4:\"name\";s:4:\"Shop\";s:2:\"id\";s:2:\"58\";}i:3;a:3:{s:4:\"slug\";s:3:\"spa\";s:4:\"name\";s:3:\"Spa\";s:2:\"id\";s:2:\"59\";}i:4;a:3:{s:4:\"slug\";s:6:\"travel\";s:4:\"name\";s:6:\"Travel\";s:2:\"id\";s:2:\"57\";}i:5;a:3:{s:4:\"slug\";s:6:\"events\";s:4:\"name\";s:6:\"Events\";s:2:\"id\";s:2:\"60\";}}', '2018-02-01 14:59:00', NULL),
(22, 'social_platform', 'a:5:{s:8:\"facebook\";s:38:\"https://www.facebook.com/couponzipcode\";s:7:\"twitter\";s:33:\"https://twitter.com/couponzipcode\";s:5:\"gplus\";s:35:\"https://plus.google.com/+googleplus\";s:9:\"instagram\";s:25:\"https://www.instagram.com\";s:7:\"youtube\";s:23:\"https://www.youtube.com\";}', '2018-02-07 14:59:00', NULL),
(23, 'amazon', 'a:4:{s:5:\"keyId\";s:20:\"AKIAJRG5N5HEJSGYBPSA\";s:9:\"secretKey\";s:40:\"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\";s:11:\"associateId\";s:16:\"couponzipco00-20\";s:7:\"country\";s:2:\"US\";}', '2018-02-13 08:00:00', NULL),
(24, 'walmart', 'a:1:{s:6:\"apiKey\";s:24:\"gun6577sxg7gypa2zk6pa2ez\";}', '2018-02-14 08:00:00', NULL),
(25, 'deals_pagination', 'a:1:{s:5:\"limit\";i:20;}', '0000-00-00 00:00:00', NULL),
(26, 'restaurant_dot_com', 'a:3:{s:5:\"cj_id\";s:259:\"0080540191596e73d61dbe714c19fe6f6eb77ffe92367fd0000cc1fd56c4c9ed4191f60793ba7423d2afba435011b0ad4e2a7c0bf9459e7c1bb30f5f02c9667cc3/255d505f8bd49731bed35695bbf3d36a3f4fab45d34c7fb9a3fd4fd055d81d9650555abd39eb619778ede2584468dedad153fe258d4ebf2cd85928d3f421db31\";s:10:\"website_id\";s:7:\"7999476\";s:13:\"advertiser_id\";s:6:\"867296\";}', '2018-01-16 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(10) UNSIGNED NOT NULL,
  `state_name` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state_name`, `country_id`) VALUES
(32, 'New York', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_name` varchar(256) NOT NULL,
  `store_phone` varchar(20) NOT NULL,
  `store_website` varchar(100) DEFAULT NULL,
  `store_latitude` varchar(15) NOT NULL,
  `store_longitude` varchar(15) NOT NULL,
  `store_zipcode_id` int(11) NOT NULL,
  `store_category_id` int(11) NOT NULL,
  `store_address_id` int(11) NOT NULL,
  `store_type` varchar(128) DEFAULT NULL,
  `store_description` longtext,
  `store_fb_url` varchar(128) DEFAULT NULL,
  `store_tw_url` varchar(128) DEFAULT NULL,
  `store_email` varchar(128) DEFAULT NULL,
  `store_rating` double(2,1) NOT NULL DEFAULT '0.0',
  `store_featured_image` varchar(1024) NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `store_name`, `store_phone`, `store_website`, `store_latitude`, `store_longitude`, `store_zipcode_id`, `store_category_id`, `store_address_id`, `store_type`, `store_description`, `store_fb_url`, `store_tw_url`, `store_email`, `store_rating`, `store_featured_image`, `is_featured`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Body Fuel', '+919780945879', 'http://www.bodyfuel.com', '40.7152', '-73.9877', 2, 55, 1, 'Snacks, Main Course, Desserts', 'Body Fuel was established in 1984 in New York City. Serving the people for 40+ years now, we have 50+ branches all over USA. Your taste buds are our slaves. We believe in quality fooding.  Body Fuel was established in 1984 in New York City. Serving the people for 40+ years now, we have 50+ branches all over USA. Your taste buds are our slaves. We believe in quality fooding.  Body Fuel was established in 1984 in New York City. Serving the people for 40+ years now, we have 50+ branches all over USA. Your taste buds are our slaves. We believe in quality fooding.  Body Fuel was established in 1984 in New York City. Serving the people for 40+ years now, we have 50+ branches all over USA. Your taste buds are our slaves. We believe in quality fooding.', 'http://www.facebook.com/bodyfuel', 'http://www.twitter.com/bodyfuel', 'email@bodyfuel.com', 3.5, '\\uploads\\store_featured_images\\1518172524_e0eb297c3eb40c5f5b2423575b2b8cb7-700.jpg', 1, 1, NULL, '2018-01-11 00:00:00', '2018-03-19 11:20:19'),
(7, 'Fashion Farmers', '+919876543210', 'http://www.fashionfarmers.com', '40.7152', '-73.9877', 2, 58, 2, 'Trousers, T-Shirts, Shirts, Jeans, Formals, Accessories, Gents, Ladies, Kids', '       Description of Fashion farmers', '', '', '', 2.5, '\\uploads\\store_featured_images\\1518171867_1515562923_calzedonia-spring-summer-collection-emily-didonato-calzedonia-745219110.jpg', 1, 1, NULL, '2018-01-05 10:57:29', '2018-03-19 11:16:34'),
(19, 'Sports Square', '+917894561230', 'http://www.sportssquare.com', '40.7375', '-73.9813', 10, 56, 3, 'Accessories, Clothing', '      This is description of Sports Square', '', '', '', 0.0, '\\uploads\\store_featured_images\\1518171881_1515564811_Under-Armour-SpeedForm-Red-1-570x381.jpg', 1, 1, NULL, '2018-01-05 14:30:05', '2018-03-19 11:16:44'),
(21, 'Kebab House', '+12125828282', 'http://www.istanbulkebabny.com', '40.7152', '-73.9877', 2, 55, 6, 'Snacks, Main Course, Desserts', '         We are proud to serve you one of the healthiest and most well-balanced Turkish and Mediterranean Halal food in New York City. Our recipes took centuries to develop and traveled from civilization to civilization, continent to continent, country to country, and now to America. Our dishes are prepared freshly upon order, using authentic recipes, traditional cooking methods with finest ingredients. Since the day we opened our doors for business, we have worked hard to earn a reputation of providing the highest quality of service available.', 'https://www.facebook.com/1istanbulkebabhouseny/', 'https://twitter.com/istanbulkebabny', 'istanbulkebabny@gmail.com', 3.5, '\\uploads\\store_featured_images\\1518171893_1518160677_b6407a2b178333170aa171bc7bdb449a--the-bridge-new-england.jpg', 0, 1, NULL, '2018-02-02 09:45:31', '2018-03-19 11:20:37'),
(23, 'Columbus Circle', '+12128236300', 'www.theshopsatcolumbuscircle.c', '40.7152', '-73.9877', 2, 55, 8, 'Bakery, Bar / Lounge, Restaurant', '          New York City\'s premier shopping, dining, and entertainment destination located in Columbus Circle.', 'https://www.facebook.com/theshopsatcolumbuscircle', 'https://twitter.com/theshops_colcir', 'contact@columbus.com', 0.0, '\\uploads\\store_featured_images\\1518171906_1518171534_1518161248_uws-bar-es.w600.h315.2x.jpg', 0, 1, NULL, '2018-02-05 08:17:25', '2018-03-19 11:20:54'),
(24, 'Sinigual Restro', '+12122860250', 'http://www.sinigualrestaurants.com', '40.7262', '-73.9796', 9, 55, 9, 'Bakery, Bar / Lounge, Restaurant', '           Sinigual strives to create a uniquely elevated culinary experience of the earthy and rustic flavors of traditional Mexican cuisine. Our chefs infuse inspired innovation with fresh and simple ingredients, leaving your senses richly satisfied.', 'https://www.facebook.com/sinigualnyc', 'https://twitter.com/sinigualnyc', 'sinigual@gmail.com', 3.5, '\\uploads\\store_featured_images\\1518171919_1518161434_DIJWKW2P3JDTLJGUJT3VC2T5XY.jpg', 0, 1, NULL, '2018-02-05 08:46:31', '2018-03-19 11:21:09'),
(25, 'Pera Soho', '+12123351326', 'http://www.pera-soho.com', '40.7152', '-73.9877', 2, 55, 10, 'Snacks, Main Course, Desserts', '       Pera Soho is a transportative Mediterranean retreat in the heart of Soho. Inspired by the renowned Istanbul neighborhood where cuisine, art, culture, nightlife and the cosmopolitan converge, Pera SoHo seduces with an environment that is simultaneously warm and vibrant. Take a journey through mouthwateringly re-imagined, shareable plates, or let our kitchen delight your taste buds with a tightly curated selection of composed mezes and main courses.', 'https://www.facebook.com/perasohonyc', 'https://twitter.com/perasoho', 'hello@pera-soho.com', 0.0, '\\uploads\\store_featured_images\\1518171935_1518161535_Mocktail-686x350.jpg', 0, 1, NULL, '2018-02-05 10:01:10', '2018-03-19 11:17:23'),
(26, 'Cafe Astoria', '+17184408789', 'http://www.okcafeastoria.com', '40.7152', '-73.9877', 2, 55, 11, 'Coffee Soda-Pop, the Red Tea Latte, Ginger Peach Sparkler', '        OK Café is located in Astoria, NY, in the heart the Ditmars neighborhood’s thriving dining and shopping district. We are a unique small business, with big ambitions to impress. All of our attention is focused on the quality of the products we prepare. We proudly feature our original “only found here” coffee and tea creations and strive for the highest standards of service.', 'https://www.facebook.com/Ok.Cafe', 'https://twitter.com/okcafeastoria', 'office@okcafeastoria.com', 0.0, '\\uploads\\store_featured_images\\1518171948_1518161661_Puff_Muff_1.JPG', 0, 1, NULL, '2018-02-05 11:01:00', '2018-03-19 11:21:22'),
(27, 'Alba Restaurant', '+17189325924', 'http://albapizza.com', '40.7484', '-73.9967', 1, 55, 12, 'Snacks, Main Course, Desserts, Fast Food', '         We have been serving quality Italian Food & Pizza in Astoria since 1987. Whether you dine in our Italian restaurant, call ahead or order online for pizza delivery, you will enjoy our superb, authentic Italian cuisine. ', 'https://www.facebook.com/Albas-Pizza-177316745631859', 'https://twitter.com/albapizza', 'albapizza@gmail.com', 0.0, '/uploads/store_featured_images/1520407396_Shiva-purana-stories-of-shiva.jpg', 0, 1, NULL, '2018-02-05 12:21:27', '2018-03-19 11:21:27'),
(28, 'Grill n Eat', '+17182047711', 'http://kravecafeandgrill.com', '40.7484', '-73.9967', 1, 55, 13, 'Snacks, Main Course, Desserts', '         Krave Cafe & Grill offers delicious dining, takeout and delivery to Astoria, NY. Krave Cafe & Grill is a cornerstone in the Astoria community and has been recognized for its outstanding Hamburgers cuisine, excellent service and friendly staff. Our Hamburgers restaurant is known for its modern interpretation of classic dishes and its insistence on only using high quality fresh ingredients.', 'https://www.facebook.com/KRAVE-Cafe-and-Grill-1434492693521714', 'https://twitter.com/kravecafegrill', 'grillneat@gmail.com', 0.0, '\\uploads\\store_featured_images\\1518171968_1517831052_krave-cafe-grill.jpg', 0, 1, NULL, '2018-02-05 12:44:12', '2018-03-19 11:22:18'),
(32, 'Fashion Era', '8876543212', 'http://www.fashion-era.com/', '40.7152', '-73.9877', 2, 58, 27, 'https://beta.couponzipcode.com/', ' Some of the world\'s mega-screen queens have gone into other sectors of the creative arts industry and succeed. Nollywood actress, Omoni Oboli is doing the same by teaming up with fashion', 'https://beta.couponzipcode.com/', 'https://beta.couponzipcode.com/', 'fashion@yopmail.com', 0.0, '/uploads/store_featured_images/1520592001_doc__636510739426525010.jpg', 1, 1, NULL, '2018-03-09 05:40:01', '2018-03-19 11:17:31');

-- --------------------------------------------------------

--
-- Table structure for table `stores_attachment`
--

CREATE TABLE `stores_attachment` (
  `id` int(10) UNSIGNED NOT NULL,
  `attachment_name` varchar(512) NOT NULL,
  `attachment_path` varchar(512) NOT NULL,
  `attachment_type` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `is_external` tinyint(1) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stores_attachment`
--

INSERT INTO `stores_attachment` (`id`, `attachment_name`, `attachment_path`, `attachment_type`, `store_id`, `is_external`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(19, '123.jpg', 'https://www.youtube.com/embed/XGSy3_Czz8kz', 2, 1, 1, 1, NULL, '2018-01-10 00:00:00', '2018-03-19 11:20:19'),
(28, '500_F_175063465_nPAUPd3x4uoqbmKyGqDLRDsIvMejnraQ.jpg', '\\uploads\\store_menus\\1515136897_500_F_175063465_nPAUPd3x4uoqbmKyGqDLRDsIvMejnraQ.jpg', 3, 1, 0, 1, NULL, '2018-01-10 00:00:00', NULL),
(31, 'vector-cartoon-illustration-of-a-design-fast-food-restaurant-menu_1441-334.jpg', '\\uploads\\store_menus\\1515137514_vector-cartoon-illustration-of-a-design-fast-food-restaurant-menu_1441-334.jpg', 3, 1, 0, 1, NULL, '2018-01-05 08:31:54', NULL),
(40, 'Store_Video_7', 'https://www.youtube.com/embed/VNNxIcN_4wEz', 2, 7, 1, 1, NULL, '2018-01-05 10:57:29', '2018-03-19 11:16:34'),
(41, '7fb8893186384ed6b163d9e39a2b9e74_scotts-clothing-menu.jpg', '\\uploads\\store_menus\\1515146249_7fb8893186384ed6b163d9e39a2b9e74_scotts-clothing-menu.jpg', 3, 7, 0, 1, NULL, '2018-01-05 10:57:29', '2018-01-05 11:29:32'),
(43, 'C-zJ0YrXkAAgad6.jpg', '\\uploads\\store_images\\1515146249_C-zJ0YrXkAAgad6.jpg', 1, 7, 0, 1, NULL, '2018-01-05 10:57:29', '2018-01-05 11:29:32'),
(44, 'Store_Video_19', 'https://www.youtube.com/watch?v=VNNxIcN_4wEz', 2, 19, 1, 1, NULL, '2018-01-05 14:30:05', '2018-03-19 11:16:44'),
(49, '7fb8893186384ed6b163d9e39a2b9e74_scotts-clothing-menu.jpg', '\\uploads\\store_menus\\1515562087_7fb8893186384ed6b163d9e39a2b9e74_scotts-clothing-menu.jpg', 3, 19, 0, 1, NULL, '2018-01-10 06:28:07', NULL),
(51, 'adidas-logo.png', '\\uploads\\store_images\\1515562190_adidas-logo.png', 1, 19, 0, 1, '2018-01-10 07:13:20', '2018-01-10 06:29:50', '2018-01-10 07:13:20'),
(52, '23031185_1340739479365528_6646088657416517645_n.jpg', '\\uploads\\store_images\\1515562473_23031185_1340739479365528_6646088657416517645_n.jpg', 1, 1, 0, 1, NULL, '2018-01-10 06:34:33', NULL),
(53, 'calzedonia-spring-summer-collection-emily-didonato-calzedonia-745219110.jpg', '\\uploads\\store_images\\1515562923_calzedonia-spring-summer-collection-emily-didonato-calzedonia-745219110.jpg', 1, 7, 0, 1, NULL, '2018-01-10 06:42:03', NULL),
(54, 'Under-Armour-SpeedForm-Red-1-570x381.jpg', '\\uploads\\store_images\\1515564811_Under-Armour-SpeedForm-Red-1-570x381.jpg', 1, 19, 0, 1, NULL, '2018-01-10 07:13:31', NULL),
(55, 'Store_Video_21', 'https://www.youtube.com/embed/yLFqBClZSZg', 2, 21, 1, 1, NULL, '2018-02-02 09:45:31', '2018-03-19 11:20:37'),
(56, 'istanbulkebabnymenu.png', '\\uploads\\store_menus\\1517561131_istanbulkebabnymenu.png', 3, 21, 0, 1, NULL, '2018-02-02 09:45:31', NULL),
(57, 'istanbulkebabny.png', '\\uploads\\store_images\\1517561131_istanbulkebabny.png', 1, 21, 0, 1, NULL, '2018-02-02 09:45:31', NULL),
(58, 'Store_Video_23', 'https://www.youtube.com/embed/AN2LMVWgsIY', 2, 23, 1, 1, NULL, '2018-02-05 08:17:25', '2018-03-19 11:20:54'),
(59, 'theshopsatcolumbuscircle_menu.png', '\\uploads\\store_menus\\1517815045_theshopsatcolumbuscircle_menu.png', 3, 23, 0, 1, NULL, '2018-02-05 08:17:25', NULL),
(60, 'theshopsatcolumbuscircle.png', '\\uploads\\store_images\\1517815045_theshopsatcolumbuscircle.png', 1, 23, 0, 1, NULL, '2018-02-05 08:17:25', NULL),
(61, 'Store_Video_24', 'https://www.youtube.com/embed/ZRSREuy9qAQ', 2, 24, 1, 1, NULL, '2018-02-05 08:46:31', '2018-03-19 11:21:09'),
(62, 'sinigualrestaurants_menu.png', '\\uploads\\store_menus\\1517816791_sinigualrestaurants_menu.png', 3, 24, 0, 1, NULL, '2018-02-05 08:46:31', NULL),
(63, 'sinigualrestaurants.jpg', '\\uploads\\store_images\\1517816791_sinigualrestaurants.jpg', 1, 24, 0, 1, NULL, '2018-02-05 08:46:31', NULL),
(64, 'Store_Video_25', 'https://www.youtube.com/embed/etyXhzDOZ0M', 2, 25, 1, 1, NULL, '2018-02-05 10:01:10', '2018-03-19 11:17:23'),
(65, 'Pera-Soho-DINNER-OCTOBER-2017-1.png', '\\uploads\\store_menus\\1517821270_Pera-Soho-DINNER-OCTOBER-2017-1.png', 3, 25, 0, 1, NULL, '2018-02-05 10:01:10', NULL),
(66, 'pera-shop.png', '\\uploads\\store_images\\1517821270_pera-shop.png', 1, 25, 0, 1, NULL, '2018-02-05 10:01:10', NULL),
(67, 'Store_Video_26', 'https://www.youtube.com/embed/kuE0q0QF7ss', 2, 26, 1, 1, NULL, '2018-02-05 11:01:00', '2018-03-19 11:21:22'),
(68, 'ok_cafe.jpg', '\\uploads\\store_menus\\1517824860_ok_cafe.jpg', 3, 26, 0, 1, NULL, '2018-02-05 11:01:00', NULL),
(69, 'ok-cafe-image-44.jpg', '\\uploads\\store_images\\1517824860_ok-cafe-image-44.jpg', 1, 26, 0, 1, NULL, '2018-02-05 11:01:00', NULL),
(70, 'Store_Video_27', 'https://www.youtube.com/embed/Khv8AyUjUMw', 2, 27, 1, 1, NULL, '2018-02-05 12:21:27', '2018-03-19 11:21:27'),
(71, 'alpa_menu.jpg', '\\uploads\\store_menus\\1517829687_alpa_menu.jpg', 3, 27, 0, 1, NULL, '2018-02-05 12:21:27', NULL),
(72, 'alpa_logo.jpg', '\\uploads\\store_images\\1517829687_alpa_logo.jpg', 1, 27, 0, 1, NULL, '2018-02-05 12:21:27', NULL),
(73, 'Store_Video_28', 'https://www.youtube.com/embed/uFuLHmlzffE', 2, 28, 1, 1, NULL, '2018-02-05 12:44:12', '2018-03-19 11:22:18'),
(74, 'krave-restaurant-trinidad-menu-1-of-2.jpg', '\\uploads\\store_menus\\1517831052_krave-restaurant-trinidad-menu-1-of-2.jpg', 3, 28, 0, 1, NULL, '2018-02-05 12:44:12', NULL),
(75, 'krave-cafe-grill.jpg', '\\uploads\\store_images\\1517831052_krave-cafe-grill.jpg', 1, 28, 0, 1, NULL, '2018-02-05 12:44:12', NULL),
(96, 'restaurant-1.jpg', '\\uploads\\store_images\\1518158601_restaurant-1.jpg', 1, 21, 0, 1, '2018-02-09 07:47:57', '2018-02-09 07:43:21', '2018-02-09 07:47:57'),
(97, 'b6407a2b178333170aa171bc7bdb449a--the-bridge-new-england.jpg', '\\uploads\\store_images\\1518160677_b6407a2b178333170aa171bc7bdb449a--the-bridge-new-england.jpg', 1, 21, 0, 1, NULL, '2018-02-09 08:17:57', NULL),
(98, '24428_360.jpg', '\\uploads\\store_images\\1518160859_24428_360.jpg', 1, 1, 0, 1, '2018-02-09 10:37:19', '2018-02-09 08:20:59', '2018-02-09 10:37:19'),
(99, 'uws-bar-es.w600.h315.2x.jpg', '\\uploads\\store_images\\1518161248_uws-bar-es.w600.h315.2x.jpg', 1, 23, 0, 1, NULL, '2018-02-09 08:27:28', NULL),
(100, 'DIJWKW2P3JDTLJGUJT3VC2T5XY.jpg', '\\uploads\\store_images\\1518161434_DIJWKW2P3JDTLJGUJT3VC2T5XY.jpg', 1, 24, 0, 1, NULL, '2018-02-09 08:30:34', NULL),
(101, 'Mocktail-686x350.jpg', '\\uploads\\store_images\\1518161535_Mocktail-686x350.jpg', 1, 25, 0, 1, NULL, '2018-02-09 08:32:15', NULL),
(102, 'Puff Muff 1.JPG', '\\uploads\\store_images\\1518161661_Puff_Muff_1.JPG', 1, 26, 0, 1, NULL, '2018-02-09 08:34:21', NULL),
(104, '1.jpg', '/uploads/store_menus/1520572835_1.jpg', 3, 29, 0, 1, NULL, '2018-03-09 00:20:35', NULL),
(105, '3.png', '/uploads/store_images/1520572835_3.png', 1, 29, 0, 1, NULL, '2018-03-09 00:20:35', NULL),
(106, '6.jpg', '/uploads/store_menus/1520574309_6.jpg', 3, 30, 0, 1, NULL, '2018-03-09 00:45:09', NULL),
(107, '6.jpg', '/uploads/store_menus/1520576204_6.jpg', 3, 31, 0, 1, NULL, '2018-03-09 01:16:44', NULL),
(108, '6.jpg', '/uploads/store_images/1520576204_6.jpg', 1, 31, 0, 1, NULL, '2018-03-09 01:16:44', NULL),
(109, 'doc__636513040120356667.jpg', '/uploads/store_menus/1520592001_doc__636513040120356667.jpg', 3, 32, 0, 1, NULL, '2018-03-09 05:40:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stores_category`
--

CREATE TABLE `stores_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_category_name` varchar(128) NOT NULL,
  `store_category_slug` varchar(50) DEFAULT NULL,
  `store_category_keywords` varchar(1024) DEFAULT NULL,
  `store_category_description` longtext,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stores_category`
--

INSERT INTO `stores_category` (`id`, `store_category_name`, `store_category_slug`, `store_category_keywords`, `store_category_description`, `is_featured`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(55, 'Eat', 'eat', 'eat, food, drink', '', 0, 1, NULL, '2018-03-19 11:08:34', NULL),
(56, 'Play', 'play', 'play, sports, soccer, baseball', '', 0, 1, NULL, '2018-03-19 11:09:04', NULL),
(57, 'Travel', 'travel', 'travel, tour, tourist', '', 0, 1, NULL, '2018-03-19 11:09:27', NULL),
(58, 'Shop', 'shop', 'shop, shopping', '', 0, 1, NULL, '2018-03-19 11:10:25', NULL),
(59, 'Spa', 'spa', 'spa, pedicure, manicure, bleach, massage', '', 0, 1, NULL, '2018-03-19 11:11:03', NULL),
(60, 'Events', 'events', 'event, concert', '', 0, 1, NULL, '2018-03-19 11:29:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stores_like`
--

CREATE TABLE `stores_like` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stores_like`
--

INSERT INTO `stores_like` (`id`, `user_id`, `store_id`, `status`, `created_at`, `updated_at`) VALUES
(9, 7, 19, 0, '2018-01-22 14:12:49', NULL),
(10, 7, 21, 1, '2018-02-07 08:19:58', '2018-02-07 08:23:12'),
(11, 20, 24, 1, '2018-03-09 01:34:13', '2018-03-09 01:34:17'),
(12, 20, 23, 0, '2018-03-09 01:54:55', '2018-03-09 01:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `stores_timetable`
--

CREATE TABLE `stores_timetable` (
  `id` int(10) UNSIGNED NOT NULL,
  `monday` varchar(30) DEFAULT NULL,
  `tuesday` varchar(30) DEFAULT NULL,
  `wednesday` varchar(30) DEFAULT NULL,
  `thursday` varchar(30) DEFAULT NULL,
  `friday` varchar(30) DEFAULT NULL,
  `saturday` varchar(30) DEFAULT NULL,
  `sunday` varchar(30) DEFAULT NULL,
  `store_id` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stores_timetable`
--

INSERT INTO `stores_timetable` (`id`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `store_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2018-02-08 00:00:00', '2018-03-19 11:20:19'),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, NULL, '2018-02-08 00:00:00', '2018-03-19 11:16:34'),
(9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19, NULL, '2018-02-08 00:00:00', '2018-03-19 11:16:44'),
(10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21, NULL, '2018-02-08 00:00:00', '2018-03-19 11:20:37'),
(11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, '2018-02-08 00:00:00', '2018-03-19 11:20:54'),
(12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, NULL, '2018-02-08 00:00:00', '2018-03-19 11:21:09'),
(13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, '2018-02-08 00:00:00', '2018-03-19 11:17:23'),
(14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, NULL, '2018-02-08 00:00:00', '2018-03-19 11:21:22'),
(15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27, NULL, '2018-02-08 00:00:00', '2018-03-19 11:21:27'),
(16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, '2018-02-08 00:00:00', '2018-03-19 11:22:18'),
(17, '12:30am - 1:30am', NULL, NULL, '1:30am - 1:00pm', NULL, NULL, '12:30am - 3:30am', 36, NULL, '2018-02-08 08:33:42', '2018-02-08 08:34:20'),
(18, '12:00am - 1:00am', NULL, NULL, NULL, NULL, NULL, '1:00am - 2:00am', 37, NULL, '2018-02-08 08:36:45', NULL),
(19, '1:00am - 2:00am', NULL, NULL, NULL, NULL, NULL, NULL, 29, NULL, '2018-03-09 00:20:35', '2018-03-09 02:42:28'),
(20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30, NULL, '2018-03-09 00:45:09', '2018-03-09 02:31:52'),
(21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, '2018-03-09 01:16:44', '2018-03-09 02:42:12'),
(22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32, NULL, '2018-03-09 05:40:01', '2018-03-19 11:17:31');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `subject` varchar(128) NOT NULL,
  `ticket_type` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `subject`, `ticket_type`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, 'Pranav', 'Kumar', 'pranav.slinfy@gmail.com', '9569272622', 'new subject contact us', 1, 1, NULL, '2018-01-18 11:43:57', '2018-01-22 12:46:27'),
(6, 'Indesh', 'Prinja', 'pranav82k@gmail.com', '9569272622', 'Coupon Apply Issue', 1, 0, NULL, '2018-01-22 12:40:21', '2018-01-22 12:43:12'),
(11, 'sunil', 'kumar', 'sunil.slinfy@gmail.com', '9569272622', 'Coupon Apply Issue', 1, 1, NULL, '2018-01-29 10:28:18', '2018-01-29 10:29:43'),
(12, 'Sunil', 'kumar', 'sunil.slinfy@gmail.com', '9041996989', 'Advertise with you', 2, 1, NULL, '2018-01-29 10:40:20', NULL),
(13, 'Pranavaa', 'Kumar', 'sunil.slinfy@gmail.com', '9569272622', 'testing for trim and html entities', 2, 1, NULL, '2018-01-29 10:56:34', NULL),
(14, 'Pranav', 'Kumar', 'sunil.slinfy@gmail.com', '9569272622', 'Issue regarding coupon apply', 1, 1, NULL, '2018-01-29 11:29:59', NULL),
(15, 'pranav', 'kumar', 'pranav.slinfy@gmail.com', '9569272622', 'Issue regarding coupon apply', 2, 1, NULL, '2018-02-27 11:50:18', NULL),
(16, 'pranav', 'kumar', 'lalit.slinfy@gmail.com', '9569272622', 'Lalit\'s issue', 2, 1, NULL, '2018-02-28 07:01:23', NULL),
(17, 'Harsh', 'Demo', 'harsh@yopmail.com', '9876543212', 'one', 2, 0, NULL, '2018-03-07 00:45:59', '2018-03-07 00:47:18'),
(18, 'Harsh', 'demo', 'tester.slinfy@gmail.com', '9876543212', 'Demo', 2, 1, NULL, '2018-03-07 00:54:04', NULL),
(19, 'Pranav', 'Kumar', 'indesh.slinfy@gmail.com', '97845458251', 'Jai mata di', 2, 1, NULL, '2018-03-08 07:40:20', NULL),
(20, 'c-zip', 'demo', 'c-zip@yopmail.com', '987654321', 'c-zip request', 2, 0, NULL, '2018-03-08 07:43:35', '2018-03-08 07:46:10'),
(21, 'Naveen', 'Saini', 'indesh.slinfy@gmail.com', '58456151', 'Issue regarding coupon apply', 2, 1, NULL, '2018-03-08 07:50:36', NULL),
(22, 'LALIT', 'Kumar', 'lalit.slinfy@gmail.com', '8457812455', 'contact us final', 2, 1, NULL, '2018-03-08 07:57:00', NULL),
(23, 'Lalit', 'Kumar', 'lalit.slinfy@gmail.com', '9568741266', 'Advertise with you', 2, 1, NULL, '2018-03-08 08:02:05', NULL),
(24, 'Abc', 'def', 'lalit.slinfy@gmail.com', '8745121545', 'Contact Form', 2, 1, NULL, '2018-03-08 08:05:42', NULL),
(25, 'harsh', 'demo', 'tester.slinfy@gmail.com', '9876543212', 'want to advertise from your site', 2, 1, NULL, '2018-03-09 07:47:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tickets_message`
--

CREATE TABLE `tickets_message` (
  `id` int(10) NOT NULL,
  `ticket_id` int(10) NOT NULL,
  `message` longtext NOT NULL,
  `is_admin_sender` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets_message`
--

INSERT INTO `tickets_message` (`id`, `ticket_id`, `message`, `is_admin_sender`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 5, 'Hello Sir/Mam, I have some problem regarding coupons...', 0, NULL, '2018-01-18 11:51:57', NULL),
(3, 5, 'Thanks for contacting us. Please let us know how can I help you.', 1, NULL, '2018-01-18 11:47:57', NULL),
(4, 5, 'Hello Sir/Mam, I have some problem regarding coupons.', 0, NULL, '2018-01-18 11:45:57', NULL),
(5, 6, 'Hello, I am facing problem while using the coupons of your site on stores.Please check with the same and let me know the solution for this on urgent basis.', 0, NULL, '2018-01-22 12:40:21', NULL),
(7, 6, 'Hi, Sorry for facing you problem like this, you can try now..', 1, NULL, '2018-01-22 12:44:14', NULL),
(9, 5, 'Yes, we are working on it.', 1, NULL, '2018-01-22 12:46:49', NULL),
(21, 11, 'Hello, I am facing problem while using the coupons of your site on stores.Please check with the same and let me know the solution for this on urgent basis.', 0, NULL, '2018-01-29 10:28:18', NULL),
(22, 11, 'yes, i am checking with your problem, keep patience.', 1, NULL, '2018-01-29 10:30:27', NULL),
(23, 11, 'Thank you for your support.', 0, NULL, '2018-01-29 10:31:10', NULL),
(24, 12, 'advertise process want with you', 0, NULL, '2018-01-29 10:40:20', NULL),
(25, 12, 'yes sure when we will start work.', 1, NULL, '2018-01-29 10:41:53', NULL),
(26, 12, 'whenever you want i am ready to work with you..', 0, NULL, '2018-01-29 10:42:29', NULL),
(27, 13, 'testing\'s for database entry', 0, NULL, '2018-01-29 10:56:34', NULL),
(28, 14, 'aajkdasjkdnas ajkndjasndjansjn', 0, NULL, '2018-01-29 11:29:59', NULL),
(29, 14, 'very nice', 1, NULL, '2018-01-29 11:33:30', NULL),
(30, 15, 'I just try to use your coupon but seller not accept it please check with the same and let me know the issue whats happening here.', 0, NULL, '2018-02-27 11:50:18', NULL),
(31, 16, 'I have  a issue i am unable to process with your coupons', 0, NULL, '2018-02-28 07:01:23', NULL),
(32, 17, 'demo', 0, NULL, '2018-03-07 00:45:59', NULL),
(33, 17, 'hello', 1, NULL, '2018-03-07 00:46:47', NULL),
(34, 18, 'Hello admin', 0, NULL, '2018-03-07 00:54:04', NULL),
(35, 19, 'Hi, indesh how are you , coupon chal peya ki nahi dasde nahi ta chala dende', 0, NULL, '2018-03-08 07:40:20', NULL),
(36, 20, 'demo one', 0, NULL, '2018-03-08 07:43:35', NULL),
(37, 20, 'hey buddy', 1, NULL, '2018-03-08 07:44:56', NULL),
(38, 21, 'I am facing issue regarding the coupon application.', 0, NULL, '2018-03-08 07:50:36', NULL),
(39, 22, 'Coupon are not working', 0, NULL, '2018-03-08 07:57:00', NULL),
(40, 23, 'Hi, admin i wanmna contact with you regarding the couipons', 0, NULL, '2018-03-08 08:02:05', NULL),
(41, 24, 'asdasdasdasdas', 0, NULL, '2018-03-08 08:05:42', NULL),
(42, 25, 'it was excellent', 0, NULL, '2018-03-09 07:47:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT '3',
  `zipcode_id` int(11) NOT NULL,
  `verification_link` varchar(256) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `mobile_number`, `dob`, `role_id`, `zipcode_id`, `verification_link`, `address_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Indesh', 'Prinja', 'indesh', 'indesh@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', NULL, 3, 2, NULL, NULL, 1, NULL, '2017-12-27 00:00:00', NULL),
(2, 'Admin', 'Jackson', 'admin', 'admin@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, NULL, 2, 2, NULL, NULL, 1, NULL, '2017-12-27 16:47:26', NULL),
(3, 'Andor', 'Simpson', '', 'andor@gmail.com', '', NULL, '2017-12-29', 3, 2, NULL, NULL, 1, NULL, '2017-12-28 16:48:41', NULL),
(4, 'David', 'Warner', '', 'david@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '9797979797', '2017-12-29', 3, 2, NULL, NULL, 1, NULL, '2017-12-28 16:51:03', NULL),
(5, 'Ricky', 'Ponting', '', 'ricky@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', '2018-01-12', 3, 2, NULL, NULL, 1, NULL, '2017-12-28 17:06:43', NULL),
(6, 'Kanika', 'Gautam', NULL, 'kanika@gmail.com', 'password', NULL, NULL, 3, 2, NULL, NULL, 0, NULL, '2017-12-29 18:17:13', NULL),
(7, 'Pranav', 'Kumar', NULL, 'pranav@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, NULL, 3, 2, NULL, NULL, 1, NULL, '2018-01-12 10:48:21', NULL),
(8, 'Sarvjeet', 'Singh', NULL, 'sarvjeetsingh@slinfy.com', '4297f44b13955235245b2497399d7a93', NULL, NULL, 3, 2, NULL, NULL, 1, NULL, '2018-03-01 11:36:22', NULL),
(9, ' ', ' ', NULL, 'a1@mailinator.com', 'c4ca4238a0b923820dcc509a6f75849b', NULL, NULL, 3, 12, NULL, NULL, 1, '2018-03-06 07:53:45', '2018-03-06 06:30:17', NULL),
(10, 'Demo', 'One', NULL, 'demo@yopmail.com', 'c4ca4238a0b923820dcc509a6f75849b', NULL, NULL, 3, 1, NULL, NULL, 1, '2018-03-06 07:52:54', '2018-03-06 06:33:59', NULL),
(11, 'Demo', 'two', NULL, 'demo_two@yopmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '9876543210', '1994-10-05', 3, 4, NULL, NULL, 1, '2018-03-06 07:47:40', '2018-03-06 07:40:46', NULL),
(12, 'test', 'one', NULL, 'test_1@yopmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, 3, 1, NULL, NULL, 1, '2018-03-06 07:52:45', '2018-03-06 07:48:29', NULL),
(13, 'Test', 'one', NULL, 'test_one@yopmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, 3, 1, NULL, NULL, 1, '2018-03-06 07:52:59', '2018-03-06 07:49:05', NULL),
(14, 'test', 'two', NULL, 'test_2@yopmail.com', '202cb962ac59075b964b07152d234b70', '9876543210', '0000-00-00', 3, 3, NULL, NULL, 1, '2018-03-06 07:53:02', '2018-03-06 07:50:09', NULL),
(15, 'test', 'one', NULL, 'test_one@yopmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '', '0000-00-00', 3, 2, NULL, NULL, 1, NULL, '2018-03-06 07:53:31', NULL),
(16, 'blank', 'demo', NULL, 'blank@yopmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, 3, 2, NULL, NULL, 1, NULL, '2018-03-08 00:01:50', NULL),
(17, 'blank', 'two', NULL, 'blank_two@gmail.com', 'c20ad4d76fe97759aa27a0c99bff6710', '9876', NULL, 3, 1, NULL, NULL, 1, NULL, '2018-03-08 00:03:41', NULL),
(18, 'C-Zip ', 'Demo', NULL, 'c-zip@yopmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '9876543212', '1994-10-05', 3, 5, NULL, NULL, 1, '2018-03-08 07:11:09', '2018-03-08 07:09:59', NULL),
(19, 'C-Zip', 'Demo', NULL, 'c-zip@yopmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '9876543212', '0000-00-00', 3, 5, NULL, NULL, 1, NULL, '2018-03-08 07:12:05', NULL),
(20, 'demo', 'one', NULL, 'demo.11@yopmail.com', '96e79218965eb72c92a549dd5a330112', NULL, NULL, 3, 3, NULL, NULL, 1, NULL, '2018-03-09 01:33:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zap`
--

CREATE TABLE `zap` (
  `idx` longtext NOT NULL,
  `name` varchar(1024) NOT NULL,
  `make` varchar(1024) NOT NULL,
  `model` varchar(1024) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zap`
--

INSERT INTO `zap` (`idx`, `name`, `make`, `model`, `id`) VALUES
('idx', 'name', 'make', 'model', 1),
('84d683750ba0d7189155c8131c51a0c7', 'name', 'make', 'model', 2),
('84d683750ba0d7189155c8131c51a0c7', 'Genell', 'make', 'model', 3),
('84d683750ba0d7189155c8131c51a0c7', 'Genell', 'make', 'qaqw', 4),
('84d683750ba0d7189155c8131c51a0c7', 'Genell', '2018-03-14 16:41:02', 'qaqw', 5),
('84d683750ba0d7189155c8131c51a0c7', 'Genell', '2018-03-14 16:41:02', 'genellwilliams14@gmail.com', 6);

-- --------------------------------------------------------

--
-- Table structure for table `zipcodes`
--

CREATE TABLE `zipcodes` (
  `id` int(10) UNSIGNED NOT NULL,
  `zipcode` varchar(15) NOT NULL,
  `place_id` int(11) DEFAULT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zipcodes`
--

INSERT INTO `zipcodes` (`id`, `zipcode`, `place_id`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, '10001', 1, '40.7484', '-73.9967', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(2, '10002', 1, '40.7152', '-73.9877', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(3, '10003', 1, '40.7313', '-73.9892', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(4, '10004', 1, '40.6964', '-74.0253', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(5, '10005', 1, '40.7056', '-74.0083', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(6, '10006', 1, '40.7085', '-74.0135', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(7, '10007', 1, '40.7139', '-74.007', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(8, '10008', 1, '40.7143', '-74.006', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(9, '10009', 1, '40.7262', '-73.9796', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(10, '10010', 1, '40.7375', '-73.9813', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(11, '10011', 1, '40.7402', '-73.9996', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(12, '10012', 1, '40.7255', '-73.9983', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(13, '10013', 1, '40.7185', '-74.0025', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(14, '10014', 1, '40.7339', '-74.0054', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(16, '10016', 1, '40.7443', '-73.9781', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(17, '10017', 1, '40.7517', '-73.9707', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(18, '10018', 1, '40.7547', '-73.9925', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(19, '10019', 1, '40.7651', '-73.9858', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(20, '10020', 1, '40.7354', '-73.9968', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(21, '10021', 1, '40.7685', '-73.9588', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(22, '10022', 1, '40.7571', '-73.9657', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(23, '10023', 1, '40.7764', '-73.9827', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(24, '10024', 1, '40.7864', '-73.9764', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(25, '10025', 1, '40.7975', '-73.9683', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(26, '10026', 1, '40.8019', '-73.9531', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(27, '10027', 1, '40.8116', '-73.955', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(28, '10028', 1, '40.7763', '-73.9529', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(29, '10029', 1, '40.7918', '-73.9447', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(30, '10030', 1, '40.8183', '-73.9426', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(31, '10031', 1, '40.8246', '-73.9507', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(32, '10032', 1, '40.8382', '-73.942', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(33, '10033', 1, '40.8496', '-73.9356', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(34, '10034', 1, '40.8662', '-73.9221', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(35, '10035', 1, '40.8011', '-73.9371', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(36, '10036', 1, '40.7597', '-73.9918', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(37, '10037', 1, '40.8135', '-73.9381', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(38, '10038', 1, '40.7101', '-74.0013', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(39, '10039', 1, '40.8265', '-73.9383', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(40, '10040', 1, '40.8583', '-73.9296', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(41, '10041', 1, '40.7038', '-74.0098', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(42, '10043', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(43, '10044', 1, '40.7618', '-73.9505', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(44, '10045', 1, '40.7086', '-74.0087', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(45, '10055', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(46, '10060', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(47, '10065', 1, '40.7651', '-73.9638', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(48, '10069', 1, '40.778', '-73.9884', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(49, '10075', 1, '40.7143', '-74.006', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(50, '10080', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(51, '10081', 1, '40.7143', '-74.006', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(52, '10087', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(53, '10090', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(54, '10101', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(55, '10102', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(56, '10103', 1, '40.7603', '-73.9762', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(57, '10104', 1, '40.7609', '-73.9799', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(58, '10105', 1, '40.7628', '-73.9785', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(59, '10106', 1, '40.7652', '-73.9804', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(60, '10107', 1, '40.7664', '-73.9827', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(61, '10108', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(62, '10109', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(63, '101010', 1, '40.754', '-73.9808', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(64, '101011', 1, '40.7592', '-73.9778', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(65, '101012', 1, '40.7593', '-73.9798', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(66, '101013', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(67, '101014', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(68, '101015', 1, '40.8111', '-73.9642', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(69, '101016', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(70, '101017', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(71, '101018', 1, '40.749', '-73.9865', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(72, '101019', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(73, '101020', 1, '40.7506', '-73.9894', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(74, '101021', 1, '40.7496', '-73.9919', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(75, '101022', 1, '40.7518', '-73.9922', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(76, '101023', 1, '40.7515', '-73.9905', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(77, '10124', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(78, '10125', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(79, '10126', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(80, '10128', 1, '40.7816', '-73.9511', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(81, '10129', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(82, '10130', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(83, '10131', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(84, '10132', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(85, '10133', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(86, '10138', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(87, '10150', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(88, '10151', 1, '40.7634', '-73.974', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(89, '10152', 1, '40.7589', '-73.973', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(90, '10153', 1, '40.7641', '-73.9735', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(91, '10154', 1, '40.7583', '-73.9735', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(92, '10155', 1, '40.7611', '-73.968', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(93, '10156', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(94, '10157', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(95, '10158', 1, '40.7494', '-73.9758', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(96, '10159', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(97, '10160', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(98, '10161', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(99, '10162', 1, '40.7699', '-73.9511', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(100, '10163', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(101, '10164', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(102, '10165', 1, '40.7524', '-73.9791', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(103, '10166', 1, '40.7546', '-73.9762', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(104, '10167', 1, '40.7549', '-73.975', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(105, '10168', 1, '40.7519', '-73.9768', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(106, '10169', 1, '40.7547', '-73.9766', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(107, '10170', 1, '40.7526', '-73.9755', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(108, '10171', 1, '40.7564', '-73.9748', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(109, '10172', 1, '40.7558', '-73.9753', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(110, '10173', 1, '40.7543', '-73.9796', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(111, '10174', 1, '40.7517', '-73.9752', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(112, '10175', 1, '40.7543', '-73.9798', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(113, '10176', 1, '40.7556', '-73.9789', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(114, '10177', 1, '40.7553', '-73.9761', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(115, '10178', 1, '40.7514', '-73.9785', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(116, '10179', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(117, '10185', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(118, '10199', 1, '40.7503', '-74.0006', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(119, '10203', 1, '40.7143', '-74.006', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(120, '10211', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(121, '10212', 1, '40.7143', '-74.006', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(122, '10213', 1, '40.7143', '-74.006', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(123, '10242', 1, '40.7143', '-74.006', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(124, '10249', 1, '40.7143', '-74.006', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(125, '10256', 1, '40.7143', '-74.006', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(126, '10258', 1, '40.7143', '-74.006', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(127, '10259', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(128, '10260', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(129, '10261', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(130, '10265', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(131, '10268', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(132, '10269', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(133, '10270', 1, '40.7069', '-74.0082', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(134, '10271', 1, '40.7089', '-74.0111', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(135, '10272', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(136, '10273', 1, '40.7143', '-74.006', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(137, '10274', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(138, '10275', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(139, '10276', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(140, '10277', 1, '40.7808', '-73.9772', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(141, '10278', 1, '40.7152', '-74.0038', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(142, '10279', 1, '40.7127', '-74.0078', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(143, '10280', 1, '40.7105', '-74.0163', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(144, '10281', 1, '40.7146', '-74.015', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(145, '10282', 1, '40.7166', '-74.0146', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(146, '10285', 1, '40.7153', '-74.0163', '2018-03-06 00:00:00', '2018-03-06 00:00:00'),
(147, '10286', 1, '40.7142', '-74.0119', '2018-03-06 00:00:00', '2018-03-06 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affiliate_categories`
--
ALTER TABLE `affiliate_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `captcha`
--
ALTER TABLE `captcha`
  ADD PRIMARY KEY (`captcha_id`),
  ADD KEY `word` (`word`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores_attachment`
--
ALTER TABLE `stores_attachment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores_category`
--
ALTER TABLE `stores_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores_like`
--
ALTER TABLE `stores_like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores_timetable`
--
ALTER TABLE `stores_timetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets_message`
--
ALTER TABLE `tickets_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zap`
--
ALTER TABLE `zap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zipcodes`
--
ALTER TABLE `zipcodes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `affiliate_categories`
--
ALTER TABLE `affiliate_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `captcha`
--
ALTER TABLE `captcha`
  MODIFY `captcha_id` bigint(13) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `stores_attachment`
--
ALTER TABLE `stores_attachment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `stores_category`
--
ALTER TABLE `stores_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `stores_like`
--
ALTER TABLE `stores_like`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `stores_timetable`
--
ALTER TABLE `stores_timetable`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tickets_message`
--
ALTER TABLE `tickets_message`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `zap`
--
ALTER TABLE `zap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `zipcodes`
--
ALTER TABLE `zipcodes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
