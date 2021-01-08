-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2020 at 04:51 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` enum('Admin','Sub Admin') NOT NULL DEFAULT 'Admin',
  `categories_view_access` tinyint(4) NOT NULL DEFAULT 0,
  `categories_full_access` tinyint(4) NOT NULL DEFAULT 0,
  `categories_edit_access` tinyint(4) NOT NULL DEFAULT 0,
  `products_access` tinyint(4) NOT NULL DEFAULT 0,
  `orders_access` tinyint(4) NOT NULL DEFAULT 0,
  `users_access` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `type`, `categories_view_access`, `categories_full_access`, `categories_edit_access`, `products_access`, `orders_access`, `users_access`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '7c7dc7bd3c7853506bc1e25ce128de70', 'Admin', 0, 0, 0, 0, 0, 0, 1, '2020-08-05 18:14:16', '2020-08-10 00:39:37'),
(3, 'jahir', '7c7dc7bd3c7853506bc1e25ce128de70', 'Sub Admin', 1, 0, 0, 0, 1, 1, 1, '2020-08-07 05:55:41', '2020-08-06 22:55:41'),
(4, 'sobuj', '0419ff0aea339851f7f68c69c46ee36a', 'Sub Admin', 0, 0, 0, 1, 1, 1, 1, '2020-08-07 06:58:03', '2020-08-07 00:42:16'),
(5, 'sohel', '489a32bf6156f24c85f49b8d070bed72', 'Admin', 0, 0, 0, 0, 0, 0, 0, '2020-08-07 07:03:35', '2020-08-07 00:11:56');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `image`, `title`, `link`, `status`, `created_at`, `updated_at`) VALUES
(2, '29345.jpeg', 'Sate T Shirt', 'sale-t-shirt', 1, '2020-03-11 05:31:29', '2020-03-11 05:31:29'),
(3, '66555.jpeg', 'sale banner first', 't-shirt', 1, '2020-03-11 23:47:52', '2020-03-11 23:47:52');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `product_name`, `product_code`, `product_color`, `size`, `price`, `quantity`, `user_email`, `session_id`, `created_at`, `updated_at`) VALUES
(44, 10, 'Special Men T-shirt for men and women', '1525534', 'Red', 'XXL', '1500', 3, '', '3tswruq1Wq6zhHBpj0aDNgCix26Ezg7F8cEp9h6i', NULL, NULL),
(60, 19, 'Special Men\'s Half Sleeve with normal cotton', 'TSG13', 'GREEN', 'XL', '600', 3, '', 'Xqebu4eXWyLI48NZq5TLGP0S54jC7wOUD05tewiD', NULL, NULL),
(61, 19, 'Special Men\'s Half Sleeve with normal cotton', 'ST2502', 'GREEN', 'XL', '250', 3, 'talk2jahir.official@gmail.com', NULL, '2020-08-30 07:13:02', '2020-08-30 07:13:02'),
(62, 20, 'Special Black T Shirt For Man', 'TS4016', 'Black', 'XXL', '250', 2, 'talk2jahir.official@gmail.com', NULL, '2020-08-30 07:13:21', '2020-08-30 07:13:21');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `category_name`, `description`, `url`, `status`, `remember_token`, `created_at`, `updated_at`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(13, 0, 'Shoes', 'Shoes', 'Shoes', 1, NULL, '2020-02-25 04:54:24', '2020-07-15 00:57:19', 'Shoes', 'Shoes Description', 'shoes'),
(14, 23, 'FORMAL T-SHIRT', 'FORMAL T-SHIRT', 'formal-t-shirt', 1, NULL, '2020-02-25 05:15:43', '2020-07-15 01:18:59', 'formal t-shirt', 'formal t-shirt description', 'formal t-shirt'),
(15, 23, 'CASUAL T-SHIRT', 'CASUAL T-SHIRT', 'casual-t-shirt', 1, NULL, '2020-02-25 05:16:44', '2020-03-03 23:10:43', '', '', ''),
(16, 0, 'BLOWER MACHINE', 'BLOWER MACHINE', 'blower-machine', 1, NULL, '2020-03-02 23:50:05', '2020-03-03 23:10:56', '', '', ''),
(17, 0, 'WELDING MACHINE', 'WELDING MACHINE', 'welding-machine', 1, NULL, '2020-03-02 23:50:31', '2020-03-03 23:11:14', '', '', ''),
(18, 0, 'SCALE', 'SCALE', 'scale', 1, NULL, '2020-03-02 23:50:51', '2020-03-04 04:21:31', '', '', ''),
(19, 0, 'HAND TOOLS', 'HAND TOOLS', 'hand-tools', 1, NULL, '2020-03-02 23:51:08', '2020-03-03 23:11:36', '', '', ''),
(20, 18, 'DIGITAL SCALE', 'DIGITAL SCALE', 'digital-scale', 1, NULL, '2020-03-02 23:52:35', '2020-03-04 04:23:46', '', '', ''),
(21, 18, 'MANUEL SCALE', 'MANUEL SCALE', 'manuel-scale', 1, NULL, '2020-03-02 23:53:05', '2020-03-03 23:11:58', '', '', ''),
(22, 19, 'SCREW DRIVER', 'SCREW DRIVER', 'screw-driver', 1, NULL, '2020-03-03 01:48:49', '2020-03-03 23:12:08', '', '', ''),
(23, 0, 'T-SHIRT', 'T-SHIRT', 't-shirt', 1, NULL, '2020-03-03 01:49:28', '2020-03-03 23:12:18', '', '', ''),
(24, 0, 'Power Tools', 'Power Tools Product', 'power-tools', 1, NULL, '2020-03-04 03:10:04', '2020-03-04 03:10:04', '', '', ''),
(25, 24, 'DRILL MACHINE', 'HIGH QUALITY DRILL MACHINE', 'drill-machine', 0, NULL, '2020-03-04 03:22:45', '2020-03-04 03:22:45', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `cmspages`
--

CREATE TABLE `cmspages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cmspages`
--

INSERT INTO `cmspages` (`id`, `title`, `description`, `url`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(3, 'About Us', 'About-us page coming soon', 'about-us', 'About Us', 'About Us page Details', 'about-us, details, online-shopping', 1, '2020-07-13 16:02:08', '2020-07-14 17:13:59'),
(4, 'Company Information', 'Company Information Page will coming soon', 'company-info', 'company information', 'company information details will go here', 'online-shopping, marketing, company-details, company-history', 1, '2020-07-13 16:34:04', '2020-07-14 17:14:51'),
(5, 'Term of Use', 'Term of use page coming soon', 'term-of-use', 'term-of-use', 'term of use page description ', 'term of use, condition', 1, '2020-07-13 16:34:42', '2020-07-14 17:15:37'),
(6, 'Privacy policy', 'Privacy policy page coming soon', 'privacy-policy', 'privacy policy', 'privacy policy page details', 'privacy, policy, privacy page', 1, '2020-07-13 16:35:19', '2020-07-14 17:16:23'),
(7, 'Billing System', 'This is Billing system', 'billing_system', 'billing Page', 'This is billing system page', 'billing, system', 1, '2020-07-14 17:32:19', '2020-07-15 00:33:01');

-- --------------------------------------------------------

--
-- Table structure for table `cod_pincodes`
--

CREATE TABLE `cod_pincodes` (
  `id` int(11) NOT NULL,
  `pincode` varchar(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cod_pincodes`
--

INSERT INTO `cod_pincodes` (`id`, `pincode`, `city`, `address`, `created_at`, `updated_at`) VALUES
(1, '1224', 'Dhaka', 'Motijheel', '0000-00-00 00:00:00', '2020-07-17 13:44:35'),
(2, '1207', 'Dhaka', 'Mohammadpur', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(3, '1216', 'Dhaka', 'Mirpur', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(4, '1212', 'Dhaka', 'Gulshan', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(5, '1209', 'Dhaka', 'Dhanmondi', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(6, '1000', 'Dhaka', 'Paltan', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(7, '1340', 'Savar', 'savar', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(8, '7800', 'Faridpur', 'Faridpur City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(9, '1700', 'Gazipur', 'Gazipur City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(10, '8100', 'Gopalganj', 'Gopalganj City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(11, '2300', 'Kishoreganj', 'Kishoreganj City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(12, '7900', 'Madaripur', 'Madaripur City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(13, '1800', 'Manikganj', 'Manikganj City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(14, '1500', 'Munshiganj', 'Munshiganj City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(15, '1400', 'Narayanganj', 'Narayanganj City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(16, '1600', 'Narsingdi', 'Narsingdi City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(17, '7710', 'Rajbari', 'Rajbari City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(18, '8000', 'Shariatpur', 'Shariatpur City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(19, '1900', 'Tangail', 'Tangail Ciy', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(20, '8700', 'Barguna', 'Barguna City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(21, '8200', 'Barishal', 'Barishal City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(22, '8210', 'Barishal', 'Babuganj', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(23, '8230', 'Barishal', 'Gouranadi', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(24, '8270', 'Barishal', 'Mahendiganj', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(25, '8250', 'Barishal', 'Muladi', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(26, '8280', 'Barishal', 'Sahebganj', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(27, '8220', 'Barishal', 'Uzirpur', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(28, '8300', 'Bhola', 'Bhola City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(29, '8400', 'Jhalokathi', 'Jhalokathi City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(30, '8600', 'Patuakhali', 'Patuakhali City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(31, '8500', 'Pirojpur', 'Pirojpur City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(32, '2000', 'Jamalpur', 'Jamalpur', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(33, '2230', 'Mymensingh', 'Gaforgaon', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(34, '2240', 'Mymensingh', 'Bhaluka', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(35, '2270', 'Mymensingh', 'Gouripur', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(36, '2260', 'Mymensingh', 'Haluaghat', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(37, '2210', 'Mymensingh', 'Muktagachha', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(38, '2200', 'Mymensingh', 'Mymensingh City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(39, '2220', 'Mymensingh', 'Trishal', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(40, '2400', 'Netrakona', 'Netrakona City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(41, '2150', 'Sherpur', 'Nakla', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(42, '2110', 'Sherpur', 'Nalitabari', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(43, '2100', 'Sherpur', 'Sherpur City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(44, '9300', 'Bagherhat', 'Bagherhat City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(45, '9340', 'Bagherhat', 'Rampal', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(46, '9310', 'Bagherhat', 'Kachua', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(47, '9320', 'Bagherhat', 'Morelganj', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(48, '7210', 'Chuadanga', 'Alamdanga', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(49, '7220', 'Chuadanga', 'Damurhuda', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(50, '7200', 'Chuadanga', 'Chuadanga City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(51, '7420', 'Jessore', 'Jhikargachha', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(52, '7450', 'Jessore', 'Keshabpur', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(53, '7460', 'Jessore', 'Noapara', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(54, '7400', 'Jessore', 'Jessore City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(55, '7300', 'Jinaidaha', 'Jinaidaha City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(56, '9240', 'Khulna', 'Alaipur', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(57, '9280', 'Khulna', 'Paikgachha', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(58, '9000', 'Khulna', 'Khulna City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(59, '3370', 'Hobiganj', 'Nabiganj', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(60, '3330', 'Hobiganj', 'Madhabpur', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(61, '3360', 'Hobiganj', 'Azmireeganj', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(62, '3300', 'Hobiganj', 'Hobiganj City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(63, '3250', 'Moulvibazar', 'Baralekha', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(64, '3210', 'Moulvibazar', 'Srimangal', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(65, '3230', 'Moulvibazar', 'Kulaura', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(66, '3200', 'Moulvibazar', 'Moulvibazar City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(67, '3080', 'Sunamganj', 'Chhatak', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(68, '3081', 'Sunamganj', 'Chhatak Cement', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(69, '3060', 'Sunamganj', 'Jagnnathpur', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(70, '3000', 'Sunamganj', 'Sunamganj City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(71, '3170', 'Sylhet', 'Bianibazar', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(72, '3116', 'Sylhet', 'Fenchuganj', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(73, '3100', 'Sylhet', 'Sylhet City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(74, '5890', 'Bogra', 'Alamdighi', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(75, '5820', 'Bogra', 'Gabtoli', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(76, '5800', 'Bogra', 'Bogra City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(77, '6310', 'Chapinawabganj', 'Nachol', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(78, '6320', 'Chapinawabganj', 'Rohanpur', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(79, '6340', 'Chapinawabganj', 'Shibganj U.P.O', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(80, '6300', 'Chapinawabganj', 'Chapinawabganj City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(81, '5940', 'Joypurhat', 'Akkelpur', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(82, '5900', 'Joypurhat', 'Joypurhat Cityy', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(83, '5910', 'Joypurhat', 'panchbibi', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(84, '6500', 'Naogaon', 'Naogaon City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(85, '6400', 'Natore', 'Natore City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(86, '6620', 'Pabna', 'Ishwardi', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(87, '6700', 'Sirajganj', 'Sirajganj City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(88, '6000', 'Rajshahi', 'Rajshahi City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(89, '5280', 'Dinajpur', 'Nababganj', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(90, '5266', 'Dinajpur', 'Birampur', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(91, '5270', 'Dinajpur', 'Bangla Hili', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(92, '5200', 'Dinajpur', 'Dinajpur City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(93, '5750', 'Gaibandha', 'Bonarpara', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(94, '5740', 'Gaibandha', 'Gobindhaganj', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(95, '5700', 'Gaibandha', 'Gaibandha City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(96, '5630', 'Kurigram', 'Chilmari', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(97, '5600', 'Kurigram', 'Kurigram City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(98, '5542', 'Lalmonirhat', 'Patgram', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(99, '5500', 'Lalmonirhat', 'Lalmonirhat City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(100, '5300', 'Nilphamari', 'Nilphamari City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(101, '5000', 'Panchagarh', 'Panchagarh City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(102, '5460', 'Rangpur', 'Mithapukur', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(103, '5400', 'Rangpur', 'Rangpur City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(104, '4600', 'Bandarban', 'Bandarban City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(105, '4630', 'Bandarban', 'Thanchi', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(106, '3450', 'Brahmanbaria', 'Akhaura', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(107, '4500', 'Rangamati', 'Rangamati City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(108, '3400', 'Brahmanbaria', 'Brahmanbaria City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(109, '4202', 'Chittagong', 'Chittagong City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(110, '3600', 'Chandpur', 'Chandpur City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(111, '3516', 'Comilla', 'Daudkandi', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(112, '3500', 'Comilla', 'Comilla City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(113, '4760', 'Cox’s Bazar', 'Teknaf', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(114, '4700', 'Cox’s Bazar', 'Cox’s Bazar City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(115, '3900', 'Feni', 'Feni City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(116, '4400', 'Khagrachari', 'Khagrachari City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(117, '3700', 'Lakshmipur', 'Lakshmipur City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(118, '3800-05', 'Noakhali', 'Noakhali City', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(119, '', '', '', '0000-00-00 00:00:00', '2020-07-16 01:04:30'),
(120, '', '', '', '0000-00-00 00:00:00', '2020-07-16 01:04:30');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Jahirul Islam', 'talk2jahir.official@gmail.com', 'What is the name of Product', 'What is the name of Product', '2020-08-12 06:12:30', '2020-08-11 23:12:30'),
(2, 'Jahirul Islam', 'jahirulislam1994ctgbd@gmail.com', 'What is the name of Product', 'What is the name of Product', '2020-08-12 06:47:43', '2020-08-11 23:47:43'),
(3, 'jahirul Islam', 'jahirulislam1994ctgbd@gmail.com', 'What is the name of Product', 'I want to know the name of product which is code is 025152', '2020-10-03 03:40:17', '2020-10-02 20:40:17');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CD', 'Democratic Republic of the Congo'),
(50, 'CG', 'Republic of Congo'),
(51, 'CK', 'Cook Islands'),
(52, 'CR', 'Costa Rica'),
(53, 'HR', 'Croatia (Hrvatska)'),
(54, 'CU', 'Cuba'),
(55, 'CY', 'Cyprus'),
(56, 'CZ', 'Czech Republic'),
(57, 'DK', 'Denmark'),
(58, 'DJ', 'Djibouti'),
(59, 'DM', 'Dominica'),
(60, 'DO', 'Dominican Republic'),
(61, 'TP', 'East Timor'),
(62, 'EC', 'Ecuador'),
(63, 'EG', 'Egypt'),
(64, 'SV', 'El Salvador'),
(65, 'GQ', 'Equatorial Guinea'),
(66, 'ER', 'Eritrea'),
(67, 'EE', 'Estonia'),
(68, 'ET', 'Ethiopia'),
(69, 'FK', 'Falkland Islands (Malvinas)'),
(70, 'FO', 'Faroe Islands'),
(71, 'FJ', 'Fiji'),
(72, 'FI', 'Finland'),
(73, 'FR', 'France'),
(74, 'FX', 'France, Metropolitan'),
(75, 'GF', 'French Guiana'),
(76, 'PF', 'French Polynesia'),
(77, 'TF', 'French Southern Territories'),
(78, 'GA', 'Gabon'),
(79, 'GM', 'Gambia'),
(80, 'GE', 'Georgia'),
(81, 'DE', 'Germany'),
(82, 'GH', 'Ghana'),
(83, 'GI', 'Gibraltar'),
(84, 'GK', 'Guernsey'),
(85, 'GR', 'Greece'),
(86, 'GL', 'Greenland'),
(87, 'GD', 'Grenada'),
(88, 'GP', 'Guadeloupe'),
(89, 'GU', 'Guam'),
(90, 'GT', 'Guatemala'),
(91, 'GN', 'Guinea'),
(92, 'GW', 'Guinea-Bissau'),
(93, 'GY', 'Guyana'),
(94, 'HT', 'Haiti'),
(95, 'HM', 'Heard and Mc Donald Islands'),
(96, 'HN', 'Honduras'),
(97, 'HK', 'Hong Kong'),
(98, 'HU', 'Hungary'),
(99, 'IS', 'Iceland'),
(100, 'IN', 'India'),
(101, 'IM', 'Isle of Man'),
(102, 'ID', 'Indonesia'),
(103, 'IR', 'Iran (Islamic Republic of)'),
(104, 'IQ', 'Iraq'),
(105, 'IE', 'Ireland'),
(106, 'IL', 'Israel'),
(107, 'IT', 'Italy'),
(108, 'CI', 'Ivory Coast'),
(109, 'JE', 'Jersey'),
(110, 'JM', 'Jamaica'),
(111, 'JP', 'Japan'),
(112, 'JO', 'Jordan'),
(113, 'KZ', 'Kazakhstan'),
(114, 'KE', 'Kenya'),
(115, 'KI', 'Kiribati'),
(116, 'KP', 'Korea, Democratic People\'s Republic of'),
(117, 'KR', 'Korea, Republic of'),
(118, 'XK', 'Kosovo'),
(119, 'KW', 'Kuwait'),
(120, 'KG', 'Kyrgyzstan'),
(121, 'LA', 'Lao People\'s Democratic Republic'),
(122, 'LV', 'Latvia'),
(123, 'LB', 'Lebanon'),
(124, 'LS', 'Lesotho'),
(125, 'LR', 'Liberia'),
(126, 'LY', 'Libyan Arab Jamahiriya'),
(127, 'LI', 'Liechtenstein'),
(128, 'LT', 'Lithuania'),
(129, 'LU', 'Luxembourg'),
(130, 'MO', 'Macau'),
(131, 'MK', 'North Macedonia'),
(132, 'MG', 'Madagascar'),
(133, 'MW', 'Malawi'),
(134, 'MY', 'Malaysia'),
(135, 'MV', 'Maldives'),
(136, 'ML', 'Mali'),
(137, 'MT', 'Malta'),
(138, 'MH', 'Marshall Islands'),
(139, 'MQ', 'Martinique'),
(140, 'MR', 'Mauritania'),
(141, 'MU', 'Mauritius'),
(142, 'TY', 'Mayotte'),
(143, 'MX', 'Mexico'),
(144, 'FM', 'Micronesia, Federated States of'),
(145, 'MD', 'Moldova, Republic of'),
(146, 'MC', 'Monaco'),
(147, 'MN', 'Mongolia'),
(148, 'ME', 'Montenegro'),
(149, 'MS', 'Montserrat'),
(150, 'MA', 'Morocco'),
(151, 'MZ', 'Mozambique'),
(152, 'MM', 'Myanmar'),
(153, 'NA', 'Namibia'),
(154, 'NR', 'Nauru'),
(155, 'NP', 'Nepal'),
(156, 'NL', 'Netherlands'),
(157, 'AN', 'Netherlands Antilles'),
(158, 'NC', 'New Caledonia'),
(159, 'NZ', 'New Zealand'),
(160, 'NI', 'Nicaragua'),
(161, 'NE', 'Niger'),
(162, 'NG', 'Nigeria'),
(163, 'NU', 'Niue'),
(164, 'NF', 'Norfolk Island'),
(165, 'MP', 'Northern Mariana Islands'),
(166, 'NO', 'Norway'),
(167, 'OM', 'Oman'),
(168, 'PK', 'Pakistan'),
(169, 'PW', 'Palau'),
(170, 'PS', 'Palestine'),
(171, 'PA', 'Panama'),
(172, 'PG', 'Papua New Guinea'),
(173, 'PY', 'Paraguay'),
(174, 'PE', 'Peru'),
(175, 'PH', 'Philippines'),
(176, 'PN', 'Pitcairn'),
(177, 'PL', 'Poland'),
(178, 'PT', 'Portugal'),
(179, 'PR', 'Puerto Rico'),
(180, 'QA', 'Qatar'),
(181, 'RE', 'Reunion'),
(182, 'RO', 'Romania'),
(183, 'RU', 'Russian Federation'),
(184, 'RW', 'Rwanda'),
(185, 'KN', 'Saint Kitts and Nevis'),
(186, 'LC', 'Saint Lucia'),
(187, 'VC', 'Saint Vincent and the Grenadines'),
(188, 'WS', 'Samoa'),
(189, 'SM', 'San Marino'),
(190, 'ST', 'Sao Tome and Principe'),
(191, 'SA', 'Saudi Arabia'),
(192, 'SN', 'Senegal'),
(193, 'RS', 'Serbia'),
(194, 'SC', 'Seychelles'),
(195, 'SL', 'Sierra Leone'),
(196, 'SG', 'Singapore'),
(197, 'SK', 'Slovakia'),
(198, 'SI', 'Slovenia'),
(199, 'SB', 'Solomon Islands'),
(200, 'SO', 'Somalia'),
(201, 'ZA', 'South Africa'),
(202, 'GS', 'South Georgia South Sandwich Islands'),
(203, 'SS', 'South Sudan'),
(204, 'ES', 'Spain'),
(205, 'LK', 'Sri Lanka'),
(206, 'SH', 'St. Helena'),
(207, 'PM', 'St. Pierre and Miquelon'),
(208, 'SD', 'Sudan'),
(209, 'SR', 'Suriname'),
(210, 'SJ', 'Svalbard and Jan Mayen Islands'),
(211, 'SZ', 'Swaziland'),
(212, 'SE', 'Sweden'),
(213, 'CH', 'Switzerland'),
(214, 'SY', 'Syrian Arab Republic'),
(215, 'TW', 'Taiwan'),
(216, 'TJ', 'Tajikistan'),
(217, 'TZ', 'Tanzania, United Republic of'),
(218, 'TH', 'Thailand'),
(219, 'TG', 'Togo'),
(220, 'TK', 'Tokelau'),
(221, 'TO', 'Tonga'),
(222, 'TT', 'Trinidad and Tobago'),
(223, 'TN', 'Tunisia'),
(224, 'TR', 'Turkey'),
(225, 'TM', 'Turkmenistan'),
(226, 'TC', 'Turks and Caicos Islands'),
(227, 'TV', 'Tuvalu'),
(228, 'UG', 'Uganda'),
(229, 'UA', 'Ukraine'),
(230, 'AE', 'United Arab Emirates'),
(231, 'GB', 'United Kingdom'),
(232, 'US', 'United States'),
(233, 'UM', 'United States minor outlying islands'),
(234, 'UY', 'Uruguay'),
(235, 'UZ', 'Uzbekistan'),
(236, 'VU', 'Vanuatu'),
(237, 'VA', 'Vatican City State'),
(238, 'VE', 'Venezuela'),
(239, 'VN', 'Vietnam'),
(240, 'VG', 'Virgin Islands (British)'),
(241, 'VI', 'Virgin Islands (U.S.)'),
(242, 'WF', 'Wallis and Futuna Islands'),
(243, 'EH', 'Western Sahara'),
(244, 'YE', 'Yemen'),
(245, 'ZM', 'Zambia'),
(246, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `amount_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiry_date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_code`, `amount`, `amount_type`, `expiry_date`, `status`, `created_at`, `updated_at`) VALUES
(2, 'eid_bonus_1000', 1000, 'Fixed', '2020-03-11', 1, '2020-03-10 06:07:35', '2020-03-10 23:01:59'),
(3, 'boish_offer', 500, 'Fixed', '2020-07-15', 1, '2020-03-10 07:03:40', '2020-05-31 00:13:01'),
(4, 'boish_offer', 2000, 'Fixed', '2020-03-24', 0, '2020-03-10 07:09:38', '2020-03-10 07:09:38'),
(5, 'valentine_offer', 10, 'Precentage', '2020-09-26', 1, '2020-03-10 07:10:43', '2020-07-21 02:15:47'),
(6, 'new_offer2020', 10, 'Precentage', '2020-10-17', 1, '2020-10-03 03:22:06', '2020-10-03 03:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `currency_code` varchar(255) NOT NULL,
  `exchange_rate` float NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `currency_code`, `exchange_rate`, `status`, `created_at`, `updated_at`) VALUES
(2, 'EUR', 96.9, 1, '2020-07-19 17:58:03', '2020-07-21 00:06:41'),
(3, 'GBP', 107.15, 1, '2020-07-19 17:58:34', '2020-07-21 00:07:21'),
(4, 'USD', 84.71, 1, '2020-07-20 17:06:06', '2020-07-21 00:06:06');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_addresses`
--

CREATE TABLE `delivery_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_addresses`
--

INSERT INTO `delivery_addresses` (`id`, `user_id`, `user_email`, `name`, `address`, `city`, `state`, `country`, `pincode`, `mobile`, `created_at`, `updated_at`) VALUES
(1, 4, 'farjana@gmail.com', 'Farjana Akter', 'Hazi ashraf Ali road, Chittagong', 'Chattongram', 'Chattogram', 'Bangladesh', '42022', '1884805662', '2020-03-16 06:42:26', '2020-03-23 22:45:59'),
(2, 6, 'alam@gmail.com', 'Alam', 'Foillatali bazar, Chattogram', 'Chattogram', 'Chattogram', 'Bangladesh', '42502', '01884805662', '2020-03-21 00:31:34', '2020-03-21 04:48:38'),
(3, 1, 'jahirupa@gmail.com', 'jahirul islam', 'Hazi ashraf Ali road, Chittagong', 'Chattongram', 'Chattogram', 'Bangladesh', '4202', '01884805662', '2020-05-31 00:16:00', '2020-05-31 00:16:00'),
(4, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', 'Bangladesh', '1207', '01884805662', '2020-07-15 01:48:01', '2020-09-13 07:38:58'),
(5, 10, 'jahirulislam1994ctgbd@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', 'Bangladesh', '1207', '01884805662', '2020-10-03 03:29:41', '2020-10-03 03:32:59');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_02_24_113826_create-category-table', 2),
(5, '2020_02_26_045831_create_products_table', 3),
(6, '2020_03_01_083941_create_products_attributes_table', 4),
(7, '2020_03_02_051523_create_product_attributes_table', 5),
(8, '2020_03_05_092733_create_products_images_table', 6),
(9, '2020_03_08_130156_create_cart_table', 7),
(10, '2020_03_10_095337_create_coupons_table', 8),
(11, '2020_03_11_102626_create_banners_table', 9),
(12, '2020_03_16_060649_create-delivery_addresses-table', 10),
(13, '2020_03_18_115328_create_orders_table', 11),
(14, '2020_03_18_124833_create_orders_products_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` tinyint(255) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `email`, `status`, `created_at`, `updated_at`) VALUES
(2, 'jahirulislam1994ctgbd@gmail.com', 0, '2020-08-21 17:04:14', '2020-08-21 23:04:14'),
(3, 'talk2jahir.official@gmail.com', 1, '2020-08-19 17:08:11', '0000-00-00 00:00:00'),
(4, 'jahirulislam1994ctgbd@gmail.com', 1, '2020-08-19 17:08:11', '0000-00-00 00:00:00'),
(5, 'jahirupa@gmail.com', 1, '2020-08-20 06:20:56', '2020-08-19 23:20:56'),
(6, 'talk2jahir.official@gmail.com', 1, '2020-08-20 07:23:04', '2020-08-20 00:23:04'),
(7, 'jahir@gmail.com', 1, '2020-08-20 07:25:20', '2020-08-20 00:25:20'),
(8, 'kabir@gmail.com', 1, '2020-08-20 07:25:35', '2020-08-20 00:25:35'),
(9, 'rahim@gmail.com', 1, '2020-08-20 07:31:43', '2020-08-20 00:31:43');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_charges` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_amount` double(8,2) NOT NULL,
  `order_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grand_total` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `user_email`, `name`, `address`, `city`, `state`, `pincode`, `country`, `mobile`, `shipping_charges`, `coupon_code`, `coupon_amount`, `order_status`, `payment_method`, `grand_total`, `created_at`, `updated_at`) VALUES
(2, 4, 'farjana@gmail.com', 'Farjana Akter', 'Hazi ashraf Ali road, Chittagong', 'Chattongram', 'Chattogram', '42022', 'Bangladesh', '1884805662', '0', 'valentine_offer', 270.00, 'New', 'COD', 7180.00, '2020-03-19 05:48:33', '2020-03-19 05:48:33'),
(3, 6, 'alam@gmail.com', 'Alam', 'Foillatali bazar, Chattogram', 'Chattogram', 'Chattogram', '42502', 'Bangladesh', '01884805662', '0', 'valentine_offer', 75.00, 'New', 'COD', 675.00, '2020-03-21 00:31:41', '2020-03-21 00:31:41'),
(4, 6, 'alam@gmail.com', 'Alam', 'Foillatali bazar, Chattogram', 'Chattogram', 'Chattogram', '42502', 'Bangladesh', '01884805662', '0', 'valentine_offer', 75.00, 'New', 'COD', 675.00, '2020-03-21 00:37:03', '2020-03-21 00:37:03'),
(5, 6, 'alam@gmail.com', 'Alam', 'Foillatali bazar, Chattogram', 'Chattogram', 'Chattogram', '42502', 'Bangladesh', '01884805662', '0', 'valentine_offer', 150.00, 'New', 'COD', 1350.00, '2020-03-21 03:06:53', '2020-03-21 03:06:53'),
(6, 6, 'alam@gmail.com', 'Alam', 'Foillatali bazar, Chattogram', 'Chattogram', 'Chattogram', '42502', 'Bangladesh', '01884805662', '0', 'valentine_offer', 300.00, 'New', 'COD', 2700.00, '2020-03-21 03:12:27', '2020-03-21 03:12:27'),
(7, 6, 'alam@gmail.com', 'Alam', 'Foillatali bazar, Chattogram', 'Chattogram', 'Chattogram', '42502', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'COD', 750.00, '2020-03-21 05:09:03', '2020-03-21 05:09:03'),
(8, 4, 'farjana@gmail.com', 'Farjana Akter', 'Hazi ashraf Ali road, Chittagong', 'Chattongram', 'Chattogram', '42022', 'Bangladesh', '1884805662', '0', 'valentine_offer', 450.00, 'New', 'Paypal', 11500.00, '2020-03-22 03:48:42', '2020-03-22 03:48:42'),
(9, 4, 'farjana@gmail.com', 'Farjana Akter', 'Hazi ashraf Ali road, Chittagong', 'Chattongram', 'Chattogram', '42022', 'Bangladesh', '1884805662', '0', 'valentine_offer', 450.00, 'New', 'Paypal', 11500.00, '2020-03-22 03:54:27', '2020-03-22 03:54:27'),
(10, 4, 'farjana@gmail.com', 'Farjana Akter', 'Hazi ashraf Ali road, Chittagong', 'Chattongram', 'Chattogram', '42022', 'Bangladesh', '1884805662', '0', '', 0.00, 'New', 'Paypal', 11950.00, '2020-03-23 22:46:04', '2020-03-23 22:46:04'),
(11, 4, 'farjana@gmail.com', 'Farjana Akter', 'Hazi ashraf Ali road, Chittagong', 'Chattongram', 'Chattogram', '42022', 'Bangladesh', '1884805662', '0', '', 0.00, 'New', 'Paypal', 11950.00, '2020-03-23 22:57:08', '2020-03-23 22:57:08'),
(12, 4, 'farjana@gmail.com', 'Farjana Akter', 'Hazi ashraf Ali road, Chittagong', 'Chattongram', 'Chattogram', '42022', 'Bangladesh', '1884805662', '0', '', 0.00, 'New', 'Paypal', 11950.00, '2020-03-23 22:59:32', '2020-03-23 22:59:32'),
(13, 4, 'farjana@gmail.com', 'Farjana Akter', 'Hazi ashraf Ali road, Chittagong', 'Chattongram', 'Chattogram', '42022', 'Bangladesh', '1884805662', '0', '', 0.00, 'New', 'Paypal', 11950.00, '2020-03-23 23:02:34', '2020-03-23 23:02:34'),
(14, 4, 'farjana@gmail.com', 'Farjana Akter', 'Hazi ashraf Ali road, Chittagong', 'Chattongram', 'Chattogram', '42022', 'Bangladesh', '1884805662', '0', '', 0.00, 'New', 'Paypal', 11950.00, '2020-03-23 23:03:53', '2020-03-23 23:03:53'),
(15, 4, 'farjana@gmail.com', 'Farjana Akter', 'Hazi ashraf Ali road, Chittagong', 'Chattongram', 'Chattogram', '42022', 'Bangladesh', '1884805662', '0', '', 0.00, 'New', 'Paypal', 11950.00, '2020-03-23 23:16:37', '2020-03-23 23:16:37'),
(16, 1, 'jahirupa@gmail.com', 'jahirul islam', 'Hazi ashraf Ali road, Chittagong', 'Chattongram', 'Chattogram', '4202', 'Bangladesh', '01884805662', '0', 'boish_offer', 500.00, 'New', 'Paypal', 500.00, '2020-05-31 00:16:12', '2020-05-31 00:16:12'),
(17, 7, 'talk2jahir.official@gmail.com', 'Jahir', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '40250', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'COD', 750.00, '2020-07-15 01:49:43', '2020-07-15 01:49:43'),
(18, 7, 'talk2jahir.official@gmail.com', 'Jahir', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '40250', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'Paypal', 750.00, '2020-07-15 01:51:33', '2020-07-15 01:51:33'),
(19, 7, 'talk2jahir.official@gmail.com', 'Jahir', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '40250', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'Paypal', 0.00, '2020-07-15 01:52:03', '2020-07-15 01:52:03'),
(20, 7, 'talk2jahir.official@gmail.com', 'Jahir', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '40250', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'Paypal', 0.00, '2020-07-15 01:52:55', '2020-07-15 01:52:55'),
(21, 7, 'talk2jahir.official@gmail.com', 'Jahir', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '40250', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'Paypal', 0.00, '2020-07-15 01:53:23', '2020-07-15 01:53:23'),
(22, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islma', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '40250', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'Paypal', 0.00, '2020-07-15 01:54:05', '2020-07-15 01:54:05'),
(23, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islma', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '40250', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'Paypal', 0.00, '2020-07-15 01:55:01', '2020-07-15 01:55:01'),
(24, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '40250', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'Paypal', 700.00, '2020-07-15 23:37:56', '2020-07-15 23:37:56'),
(25, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '40250', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'Paypal', 700.00, '2020-07-15 23:40:15', '2020-07-15 23:40:15'),
(26, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '40250', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'Paypal', 700.00, '2020-07-15 23:41:17', '2020-07-15 23:41:17'),
(27, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '40250', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'Paypal', 700.00, '2020-07-15 23:41:36', '2020-07-15 23:41:36'),
(28, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '40250', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'Paypal', 700.00, '2020-07-15 23:43:37', '2020-07-15 23:43:37'),
(29, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '40250', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'Paypal', 700.00, '2020-07-15 23:46:32', '2020-07-15 23:46:32'),
(30, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '40250', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'Paypal', 700.00, '2020-07-15 23:47:12', '2020-07-15 23:47:12'),
(31, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '40250', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'Paypal', 700.00, '2020-07-15 23:47:52', '2020-07-15 23:47:52'),
(32, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '40250', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'Paypal', 700.00, '2020-07-15 23:48:15', '2020-07-15 23:48:15'),
(33, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '40250', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'Paypal', 700.00, '2020-07-15 23:49:33', '2020-07-15 23:49:33'),
(34, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1222', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'COD', 2650.00, '2020-07-17 20:19:56', '2020-07-17 20:19:56'),
(35, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1222', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'COD', 1050.00, '2020-07-17 20:45:26', '2020-07-17 20:45:26'),
(36, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1222', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'COD', 1050.00, '2020-07-17 20:46:43', '2020-07-17 20:46:43'),
(37, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1222', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'COD', 6850.00, '2020-07-28 01:16:31', '2020-07-28 01:16:31'),
(38, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'COD', 6850.00, '2020-07-28 01:18:28', '2020-07-28 01:18:28'),
(39, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'COD', 1950.00, '2020-07-28 01:20:29', '2020-07-28 01:20:29'),
(40, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'COD', 650.00, '2020-07-28 23:21:11', '2020-07-28 23:21:11'),
(41, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '0', '', 0.00, 'New', 'COD', 4550.00, '2020-07-30 00:45:23', '2020-07-30 00:45:23'),
(42, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '50', '', 0.00, 'New', 'COD', 800.00, '2020-07-30 00:58:37', '2020-07-30 00:58:37'),
(43, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'COD', 4600.00, '2020-08-05 23:47:22', '2020-08-05 23:47:22'),
(44, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'COD', 4600.00, '2020-08-05 23:48:03', '2020-08-05 23:48:03'),
(45, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'COD', 4600.00, '2020-08-05 23:49:36', '2020-08-05 23:49:36'),
(46, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'COD', 4600.00, '2020-08-05 23:51:23', '2020-08-05 23:51:23'),
(47, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'COD', 4600.00, '2020-08-05 23:55:24', '2020-08-05 23:55:24'),
(48, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'COD', 4600.00, '2020-08-05 23:57:51', '2020-08-05 23:57:51'),
(49, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'COD', 4600.00, '2020-08-06 00:01:44', '2020-08-06 00:01:44'),
(50, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'COD', 4600.00, '2020-08-06 00:03:54', '2020-08-06 00:03:54'),
(51, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'COD', 4600.00, '2020-08-06 00:04:55', '2020-08-06 00:04:55'),
(52, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'COD', 4600.00, '2020-08-06 00:05:25', '2020-08-06 00:05:25'),
(53, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'COD', 4600.00, '2020-08-06 00:09:17', '2020-08-06 00:09:17'),
(54, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '150', '', 0.00, 'New', 'COD', 6000.00, '2020-08-13 06:57:43', '2020-08-13 06:57:43'),
(55, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '50', '', 0.00, 'New', 'COD', 1050.00, '2020-08-13 06:59:51', '2020-08-13 06:59:51'),
(56, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '50', '', 0.00, 'New', 'COD', 1050.00, '2020-08-13 07:08:50', '2020-08-13 07:08:50'),
(57, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '150', '', 0.00, 'New', 'PayUmoney', 8750.00, '2020-09-07 06:28:57', '2020-09-07 06:28:57'),
(58, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '150', '', 0.00, 'New', 'PayUmoney', 8750.00, '2020-09-07 06:32:13', '2020-09-07 06:32:13'),
(59, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '150', '', 0.00, 'New', 'PayUmoney', 8750.00, '2020-09-07 06:33:55', '2020-09-07 06:33:55'),
(60, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '150', '', 0.00, 'New', 'PayUmoney', 8750.00, '2020-09-07 06:34:53', '2020-09-07 06:34:53'),
(61, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '150', '', 0.00, 'New', 'PayUmoney', 8750.00, '2020-09-07 06:35:02', '2020-09-07 06:35:02'),
(62, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '150', '', 0.00, 'New', 'PayUmoney', 8750.00, '2020-09-07 06:51:51', '2020-09-07 06:51:51'),
(63, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '150', '', 0.00, 'New', 'PayUmoney', 8750.00, '2020-09-07 06:52:42', '2020-09-07 06:52:42'),
(64, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-07 06:54:05', '2020-09-07 06:54:05'),
(65, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-07 07:01:52', '2020-09-07 07:01:52'),
(66, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-07 07:16:36', '2020-09-07 07:16:36'),
(67, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-07 07:25:39', '2020-09-07 07:25:39'),
(68, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-07 07:28:39', '2020-09-07 07:28:39'),
(69, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-07 07:34:12', '2020-09-07 07:34:12'),
(70, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-07 07:35:27', '2020-09-07 07:35:27'),
(71, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-07 07:49:06', '2020-09-07 07:49:06'),
(72, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-07 07:49:59', '2020-09-07 07:49:59'),
(73, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-07 07:50:18', '2020-09-07 07:50:18'),
(74, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-07 07:51:23', '2020-09-07 07:51:23'),
(75, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-07 07:51:53', '2020-09-07 07:51:53'),
(76, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-07 07:52:54', '2020-09-07 07:52:54'),
(77, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-08 07:02:32', '2020-09-08 07:02:32'),
(78, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-08 07:04:44', '2020-09-08 07:04:44'),
(79, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-08 07:26:57', '2020-09-08 07:26:57'),
(80, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-08 07:48:42', '2020-09-08 07:48:42'),
(81, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-09 06:53:13', '2020-09-09 06:53:13'),
(82, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-09 07:04:30', '2020-09-09 07:04:30'),
(83, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-09 07:08:10', '2020-09-09 07:08:10'),
(84, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-09 07:13:31', '2020-09-09 07:13:31'),
(85, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-09 07:26:18', '2020-09-09 07:26:18'),
(86, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-10 06:42:58', '2020-09-10 06:42:58'),
(87, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-10 06:53:01', '2020-09-10 06:53:01'),
(88, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-10 07:04:43', '2020-09-10 07:04:43'),
(89, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-10 07:06:54', '2020-09-10 07:06:54'),
(90, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-10 07:11:05', '2020-09-10 07:11:05'),
(91, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-10 07:12:15', '2020-09-10 07:12:15'),
(92, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-10 07:14:40', '2020-09-10 07:14:40'),
(93, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-10 07:15:18', '2020-09-10 07:15:18'),
(94, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-10 07:17:24', '2020-09-10 07:17:24'),
(95, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-10 07:22:23', '2020-09-10 07:22:23'),
(96, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-10 07:35:32', '2020-09-10 07:35:32'),
(97, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-10 07:51:05', '2020-09-10 07:51:05'),
(98, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-11 07:11:54', '2020-09-11 07:11:54'),
(99, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-11 07:20:42', '2020-09-11 07:20:42'),
(100, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-11 07:23:47', '2020-09-11 07:23:47'),
(101, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-11 07:30:39', '2020-09-11 07:30:39'),
(102, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-11 07:31:14', '2020-09-11 07:31:14'),
(103, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-11 07:33:30', '2020-09-11 07:33:30'),
(104, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-11 07:39:45', '2020-09-11 07:39:45'),
(105, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-11 07:40:42', '2020-09-11 07:40:42'),
(106, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-11 07:42:55', '2020-09-11 07:42:55'),
(107, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-11 07:44:23', '2020-09-11 07:44:23'),
(108, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-11 07:46:11', '2020-09-11 07:46:11'),
(109, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-11 07:54:03', '2020-09-11 07:54:03'),
(110, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-11 08:01:22', '2020-09-11 08:01:22'),
(111, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-11 08:02:07', '2020-09-11 08:02:07'),
(112, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-11 08:03:17', '2020-09-11 08:03:17'),
(113, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-13 06:49:14', '2020-09-13 06:49:14'),
(114, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-13 06:50:49', '2020-09-13 06:50:49'),
(115, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-13 07:39:06', '2020-09-13 07:39:06'),
(116, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-13 07:45:56', '2020-09-13 07:45:56'),
(117, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'PayUmoney', 1250.00, '2020-09-13 07:48:00', '2020-09-13 07:48:00'),
(118, 7, 'talk2jahir.official@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'Paypal', 1250.00, '2020-09-13 07:49:57', '2020-09-13 07:49:57'),
(119, 10, 'jahirulislam1994ctgbd@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', 'new_offer2020', 250.00, 'New', 'Paypal', 2250.00, '2020-10-03 03:30:19', '2020-10-03 03:30:19'),
(120, 10, 'jahirulislam1994ctgbd@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', 'new_offer2020', 250.00, 'New', 'PayUmoney', 2250.00, '2020-10-03 03:31:17', '2020-10-03 03:31:17'),
(121, 10, 'jahirulislam1994ctgbd@gmail.com', 'Jahirul Islam', 'Hazi ashraf ali road', 'chattogram', 'chattogram', '1207', 'Bangladesh', '01884805662', '100', '', 0.00, 'New', 'COD', 250.00, '2020-10-03 03:33:05', '2020-10-03 03:33:05');

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE `orders_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`id`, `user_id`, `order_id`, `product_id`, `product_code`, `product_name`, `product_size`, `product_color`, `product_price`, `product_quantity`, `created_at`, `updated_at`) VALUES
(1, 4, 11, 20, '54255', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 1, '2020-03-19 06:00:24', '2020-03-19 06:00:24'),
(2, 4, 11, 10, '1525534', 'Special Men', 'XXL', 'Red', '1500', 3, '2020-03-19 06:00:25', '2020-03-19 06:00:25'),
(3, 4, 11, 19, 'TSG13', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-03-19 06:00:25', '2020-03-19 06:00:25'),
(4, 4, 11, 18, 'T-SHIRT25', 'BOYS T SHIRT 100% SILK', 'XXL', 'BLUE', '650', 3, '2020-03-19 06:00:25', '2020-03-19 06:00:25'),
(5, 6, 3, 19, 'TSG12', 'Special Men\'s Half Sleeve with normal cotton', 'XXL', 'GREEN', '250', 3, '2020-03-21 00:31:41', '2020-03-21 00:31:41'),
(6, 6, 4, 19, 'TSG12', 'Special Men\'s Half Sleeve with normal cotton', 'XXL', 'GREEN', '250', 3, '2020-03-21 00:37:03', '2020-03-21 00:37:03'),
(7, 6, 5, 20, '54255', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 3, '2020-03-21 03:06:53', '2020-03-21 03:06:53'),
(8, 6, 5, 20, '2364', 'Special Black T Shirt For Man', 'XL', 'Black', '250', 3, '2020-03-21 03:06:53', '2020-03-21 03:06:53'),
(9, 6, 6, 17, 'T-SHIRT253', 'BLACK 100% COTTON  T-SHIRT', 'XXL', 'BLACK', '350', 3, '2020-03-21 03:12:27', '2020-03-21 03:12:27'),
(10, 6, 6, 18, 'T-SHIRT23', 'BOYS T SHIRT 100% SILK', 'L', 'BLUE', '650', 3, '2020-03-21 03:12:27', '2020-03-21 03:12:27'),
(11, 6, 7, 19, 'TSG12', 'Special Men\'s Half Sleeve with normal cotton', 'XXL', 'GREEN', '250', 3, '2020-03-21 05:09:03', '2020-03-21 05:09:03'),
(12, 4, 8, 20, '54255', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 1, '2020-03-22 03:48:42', '2020-03-22 03:48:42'),
(13, 4, 8, 10, '1525534', 'Special Men', 'XXL', 'Red', '1500', 3, '2020-03-22 03:48:42', '2020-03-22 03:48:42'),
(14, 4, 8, 19, 'TSG13', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-03-22 03:48:42', '2020-03-22 03:48:42'),
(15, 4, 8, 18, 'T-SHIRT25', 'BOYS T SHIRT 100% SILK', 'XXL', 'BLUE', '650', 3, '2020-03-22 03:48:42', '2020-03-22 03:48:42'),
(16, 4, 8, 10, '1525534', 'Special Men', 'XXL', 'Red', '1500', 3, '2020-03-22 03:48:43', '2020-03-22 03:48:43'),
(17, 4, 9, 20, '54255', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 1, '2020-03-22 03:54:27', '2020-03-22 03:54:27'),
(18, 4, 9, 10, '1525534', 'Special Men', 'XXL', 'Red', '1500', 3, '2020-03-22 03:54:27', '2020-03-22 03:54:27'),
(19, 4, 9, 19, 'TSG13', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-03-22 03:54:27', '2020-03-22 03:54:27'),
(20, 4, 9, 18, 'T-SHIRT25', 'BOYS T SHIRT 100% SILK', 'XXL', 'BLUE', '650', 3, '2020-03-22 03:54:27', '2020-03-22 03:54:27'),
(21, 4, 9, 10, '1525534', 'Special Men', 'XXL', 'Red', '1500', 3, '2020-03-22 03:54:27', '2020-03-22 03:54:27'),
(22, 4, 10, 20, '54255', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 1, '2020-03-23 22:46:05', '2020-03-23 22:46:05'),
(23, 4, 10, 10, '1525534', 'Special Men', 'XXL', 'Red', '1500', 3, '2020-03-23 22:46:05', '2020-03-23 22:46:05'),
(24, 4, 10, 19, 'TSG13', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-03-23 22:46:05', '2020-03-23 22:46:05'),
(25, 4, 10, 18, 'T-SHIRT25', 'BOYS T SHIRT 100% SILK', 'XXL', 'BLUE', '650', 3, '2020-03-23 22:46:05', '2020-03-23 22:46:05'),
(26, 4, 10, 10, '1525534', 'Special Men', 'XXL', 'Red', '1500', 3, '2020-03-23 22:46:05', '2020-03-23 22:46:05'),
(27, 4, 11, 20, '54255', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 1, '2020-03-23 22:57:09', '2020-03-23 22:57:09'),
(28, 4, 11, 10, '1525534', 'Special Men', 'XXL', 'Red', '1500', 3, '2020-03-23 22:57:09', '2020-03-23 22:57:09'),
(29, 4, 11, 19, 'TSG13', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-03-23 22:57:09', '2020-03-23 22:57:09'),
(30, 4, 11, 18, 'T-SHIRT25', 'BOYS T SHIRT 100% SILK', 'XXL', 'BLUE', '650', 3, '2020-03-23 22:57:09', '2020-03-23 22:57:09'),
(31, 4, 11, 10, '1525534', 'Special Men', 'XXL', 'Red', '1500', 3, '2020-03-23 22:57:09', '2020-03-23 22:57:09'),
(32, 4, 12, 20, '54255', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 1, '2020-03-23 22:59:32', '2020-03-23 22:59:32'),
(33, 4, 12, 10, '1525534', 'Special Men', 'XXL', 'Red', '1500', 3, '2020-03-23 22:59:32', '2020-03-23 22:59:32'),
(34, 4, 12, 19, 'TSG13', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-03-23 22:59:32', '2020-03-23 22:59:32'),
(35, 4, 12, 18, 'T-SHIRT25', 'BOYS T SHIRT 100% SILK', 'XXL', 'BLUE', '650', 3, '2020-03-23 22:59:33', '2020-03-23 22:59:33'),
(36, 4, 12, 10, '1525534', 'Special Men', 'XXL', 'Red', '1500', 3, '2020-03-23 22:59:33', '2020-03-23 22:59:33'),
(37, 4, 13, 20, '54255', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 1, '2020-03-23 23:02:34', '2020-03-23 23:02:34'),
(38, 4, 13, 10, '1525534', 'Special Men', 'XXL', 'Red', '1500', 3, '2020-03-23 23:02:34', '2020-03-23 23:02:34'),
(39, 4, 13, 19, 'TSG13', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-03-23 23:02:34', '2020-03-23 23:02:34'),
(40, 4, 13, 18, 'T-SHIRT25', 'BOYS T SHIRT 100% SILK', 'XXL', 'BLUE', '650', 3, '2020-03-23 23:02:34', '2020-03-23 23:02:34'),
(41, 4, 13, 10, '1525534', 'Special Men', 'XXL', 'Red', '1500', 3, '2020-03-23 23:02:34', '2020-03-23 23:02:34'),
(42, 4, 14, 20, '54255', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 1, '2020-03-23 23:03:53', '2020-03-23 23:03:53'),
(43, 4, 14, 10, '1525534', 'Special Men', 'XXL', 'Red', '1500', 3, '2020-03-23 23:03:53', '2020-03-23 23:03:53'),
(44, 4, 14, 19, 'TSG13', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-03-23 23:03:53', '2020-03-23 23:03:53'),
(45, 4, 14, 18, 'T-SHIRT25', 'BOYS T SHIRT 100% SILK', 'XXL', 'BLUE', '650', 3, '2020-03-23 23:03:53', '2020-03-23 23:03:53'),
(46, 4, 14, 10, '1525534', 'Special Men', 'XXL', 'Red', '1500', 3, '2020-03-23 23:03:53', '2020-03-23 23:03:53'),
(47, 4, 15, 20, '54255', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 1, '2020-03-23 23:16:37', '2020-03-23 23:16:37'),
(48, 4, 15, 10, '1525534', 'Special Men', 'XXL', 'Red', '1500', 3, '2020-03-23 23:16:37', '2020-03-23 23:16:37'),
(49, 4, 15, 19, 'TSG13', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-03-23 23:16:37', '2020-03-23 23:16:37'),
(50, 4, 15, 18, 'T-SHIRT25', 'BOYS T SHIRT 100% SILK', 'XXL', 'BLUE', '650', 3, '2020-03-23 23:16:37', '2020-03-23 23:16:37'),
(51, 4, 15, 10, '1525534', 'Special Men', 'XXL', 'Red', '1500', 3, '2020-03-23 23:16:37', '2020-03-23 23:16:37'),
(52, 1, 16, 20, '54255', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 4, '2020-05-31 00:16:13', '2020-05-31 00:16:13'),
(53, 7, 17, 20, '54255', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 3, '2020-07-15 01:49:43', '2020-07-15 01:49:43'),
(54, 7, 24, 22, 'tshirt302XL', 'Man\'s Easy T-shirt', 'XL', 'yellow', '350', 2, '2020-07-15 23:37:56', '2020-07-15 23:37:56'),
(55, 7, 25, 22, 'tshirt302XL', 'Man\'s Easy T-shirt', 'XL', 'yellow', '350', 2, '2020-07-15 23:40:15', '2020-07-15 23:40:15'),
(56, 7, 26, 22, 'tshirt302XL', 'Man\'s Easy T-shirt', 'XL', 'yellow', '350', 2, '2020-07-15 23:41:17', '2020-07-15 23:41:17'),
(57, 7, 27, 22, 'tshirt302XL', 'Man\'s Easy T-shirt', 'XL', 'yellow', '350', 2, '2020-07-15 23:41:36', '2020-07-15 23:41:36'),
(58, 7, 28, 22, 'tshirt302XL', 'Man\'s Easy T-shirt', 'XL', 'yellow', '350', 2, '2020-07-15 23:43:37', '2020-07-15 23:43:37'),
(59, 7, 29, 22, 'tshirt302XL', 'Man\'s Easy T-shirt', 'XL', 'yellow', '350', 2, '2020-07-15 23:46:32', '2020-07-15 23:46:32'),
(60, 7, 30, 22, 'tshirt302XL', 'Man\'s Easy T-shirt', 'XL', 'yellow', '350', 2, '2020-07-15 23:47:12', '2020-07-15 23:47:12'),
(61, 7, 31, 22, 'tshirt302XL', 'Man\'s Easy T-shirt', 'XL', 'yellow', '350', 2, '2020-07-15 23:47:52', '2020-07-15 23:47:52'),
(62, 7, 32, 22, 'tshirt302XL', 'Man\'s Easy T-shirt', 'XL', 'yellow', '350', 2, '2020-07-15 23:48:15', '2020-07-15 23:48:15'),
(63, 7, 33, 22, 'tshirt302XL', 'Man\'s Easy T-shirt', 'XL', 'yellow', '350', 2, '2020-07-15 23:49:33', '2020-07-15 23:49:33'),
(64, 7, 34, 22, 'tshirt302XL', 'Man\'s Easy T-shirt', 'XL', 'yellow', '350', 2, '2020-07-17 20:19:56', '2020-07-17 20:19:56'),
(65, 7, 34, 18, 'T-SHIRT23', 'BOYS T SHIRT 100% SILK T-shirt', 'L', 'BLUE', '650', 3, '2020-07-17 20:19:56', '2020-07-17 20:19:56'),
(66, 7, 35, 22, 'tshirt302XL', 'Man\'s Easy T-shirt', 'XL', 'yellow', '350', 3, '2020-07-17 20:45:26', '2020-07-17 20:45:26'),
(67, 7, 36, 22, 'tshirt302XL', 'Man\'s Easy T-shirt', 'XL', 'yellow', '350', 3, '2020-07-17 20:46:43', '2020-07-17 20:46:43'),
(68, 7, 37, 22, 'tshirt302XL', 'Man\'s Easy T-shirt', 'XL', 'yellow', '350', 3, '2020-07-28 01:16:32', '2020-07-28 01:16:32'),
(69, 7, 37, 10, '1525534', 'Special Men T-shirt for men and women', 'XXL', 'Red', '1500', 3, '2020-07-28 01:16:32', '2020-07-28 01:16:32'),
(70, 7, 37, 18, 'T-SHIRT24', 'BOYS T SHIRT 100% SILK T-shirt', 'XL', 'BLUE', '650', 2, '2020-07-28 01:16:32', '2020-07-28 01:16:32'),
(71, 7, 38, 22, 'tshirt302XL', 'Man\'s Easy T-shirt', 'XL', 'yellow', '350', 3, '2020-07-28 01:18:28', '2020-07-28 01:18:28'),
(72, 7, 38, 10, '1525534', 'Special Men T-shirt for men and women', 'XXL', 'Red', '1500', 3, '2020-07-28 01:18:28', '2020-07-28 01:18:28'),
(73, 7, 38, 18, 'T-SHIRT24', 'BOYS T SHIRT 100% SILK T-shirt', 'XL', 'BLUE', '650', 2, '2020-07-28 01:18:29', '2020-07-28 01:18:29'),
(74, 7, 39, 18, 'T-SHIRT24', 'BOYS T SHIRT 100% SILK T-shirt', 'XL', 'BLUE', '650', 3, '2020-07-28 01:20:29', '2020-07-28 01:20:29'),
(75, 7, 40, 18, 'T-SHIRT24', 'BOYS T SHIRT 100% SILK T-shirt', 'XL', 'BLUE', '650', 1, '2020-07-28 23:21:12', '2020-07-28 23:21:12'),
(76, 7, 41, 10, '1525534', 'Special Men T-shirt for men and women', 'XXL', 'Red', '1500', 3, '2020-07-30 00:45:23', '2020-07-30 00:45:23'),
(77, 7, 42, 20, '2364', 'Special Black T Shirt For Man', 'XL', 'Black', '250', 3, '2020-07-30 00:58:37', '2020-07-30 00:58:37'),
(78, 7, 43, 10, '1525534', 'Special Men T-shirt for men and women', 'XXL', 'Red', '1500', 3, '2020-08-05 23:47:22', '2020-08-05 23:47:22'),
(79, 7, 44, 10, '1525534', 'Special Men T-shirt for men and women', 'XXL', 'Red', '1500', 3, '2020-08-05 23:48:03', '2020-08-05 23:48:03'),
(80, 7, 45, 10, '1525534', 'Special Men T-shirt for men and women', 'XXL', 'Red', '1500', 3, '2020-08-05 23:49:36', '2020-08-05 23:49:36'),
(81, 7, 46, 10, '1525534', 'Special Men T-shirt for men and women', 'XXL', 'Red', '1500', 3, '2020-08-05 23:51:23', '2020-08-05 23:51:23'),
(82, 7, 47, 10, '1525534', 'Special Men T-shirt for men and women', 'XXL', 'Red', '1500', 3, '2020-08-05 23:55:24', '2020-08-05 23:55:24'),
(83, 7, 48, 10, '1525534', 'Special Men T-shirt for men and women', 'XXL', 'Red', '1500', 3, '2020-08-05 23:57:52', '2020-08-05 23:57:52'),
(84, 7, 49, 10, '1525534', 'Special Men T-shirt for men and women', 'XXL', 'Red', '1500', 3, '2020-08-06 00:01:44', '2020-08-06 00:01:44'),
(85, 7, 50, 10, '1525534', 'Special Men T-shirt for men and women', 'XXL', 'Red', '1500', 3, '2020-08-06 00:03:54', '2020-08-06 00:03:54'),
(86, 7, 51, 10, '1525534', 'Special Men T-shirt for men and women', 'XXL', 'Red', '1500', 3, '2020-08-06 00:04:55', '2020-08-06 00:04:55'),
(87, 7, 52, 10, '1525534', 'Special Men T-shirt for men and women', 'XXL', 'Red', '1500', 3, '2020-08-06 00:05:25', '2020-08-06 00:05:25'),
(88, 7, 53, 10, '1525534', 'Special Men T-shirt for men and women', 'XXL', 'Red', '1500', 3, '2020-08-06 00:09:17', '2020-08-06 00:09:17'),
(89, 7, 54, 10, '1525534', 'Special Men T-shirt for men and women', 'XXL', 'Red', '1500', 3, '2020-08-13 06:57:43', '2020-08-13 06:57:43'),
(90, 7, 54, 20, '54255', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 3, '2020-08-13 06:57:43', '2020-08-13 06:57:43'),
(91, 7, 54, 19, 'TSG13', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-08-13 06:57:43', '2020-08-13 06:57:43'),
(92, 7, 55, 22, 'tshirt302XXL', 'Man\'s Easy T-shirt', 'XXL', 'yellow', '350', 3, '2020-08-13 06:59:51', '2020-08-13 06:59:51'),
(93, 7, 56, 22, 'tshirt302XL', 'Man\'s Easy T-shirt', 'XL', 'yellow', '350', 3, '2020-08-13 07:08:50', '2020-08-13 07:08:50'),
(94, 7, 57, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-07 06:28:57', '2020-09-07 06:28:57'),
(95, 7, 58, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-07 06:32:13', '2020-09-07 06:32:13'),
(96, 7, 58, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-07 06:32:14', '2020-09-07 06:32:14'),
(97, 7, 58, 10, '1542685', 'Special Men T-shirt for men and women', 'L', 'Red', '2500', 3, '2020-09-07 06:32:14', '2020-09-07 06:32:14'),
(98, 7, 59, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-07 06:33:55', '2020-09-07 06:33:55'),
(99, 7, 59, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-07 06:33:55', '2020-09-07 06:33:55'),
(100, 7, 59, 10, '1542685', 'Special Men T-shirt for men and women', 'L', 'Red', '2500', 3, '2020-09-07 06:33:55', '2020-09-07 06:33:55'),
(101, 7, 60, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-07 06:34:53', '2020-09-07 06:34:53'),
(102, 7, 60, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-07 06:34:53', '2020-09-07 06:34:53'),
(103, 7, 60, 10, '1542685', 'Special Men T-shirt for men and women', 'L', 'Red', '2500', 3, '2020-09-07 06:34:53', '2020-09-07 06:34:53'),
(104, 7, 61, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-07 06:35:02', '2020-09-07 06:35:02'),
(105, 7, 61, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-07 06:35:02', '2020-09-07 06:35:02'),
(106, 7, 61, 10, '1542685', 'Special Men T-shirt for men and women', 'L', 'Red', '2500', 3, '2020-09-07 06:35:03', '2020-09-07 06:35:03'),
(107, 7, 62, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-07 06:51:51', '2020-09-07 06:51:51'),
(108, 7, 62, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-07 06:51:51', '2020-09-07 06:51:51'),
(109, 7, 62, 10, '1542685', 'Special Men T-shirt for men and women', 'L', 'Red', '2500', 3, '2020-09-07 06:51:51', '2020-09-07 06:51:51'),
(110, 7, 63, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-07 06:52:42', '2020-09-07 06:52:42'),
(111, 7, 63, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-07 06:52:42', '2020-09-07 06:52:42'),
(112, 7, 63, 10, '1542685', 'Special Men T-shirt for men and women', 'L', 'Red', '2500', 3, '2020-09-07 06:52:42', '2020-09-07 06:52:42'),
(113, 7, 64, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-07 06:54:05', '2020-09-07 06:54:05'),
(114, 7, 64, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-07 06:54:05', '2020-09-07 06:54:05'),
(115, 7, 65, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-07 07:01:52', '2020-09-07 07:01:52'),
(116, 7, 65, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-07 07:01:52', '2020-09-07 07:01:52'),
(117, 7, 66, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-07 07:16:36', '2020-09-07 07:16:36'),
(118, 7, 66, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-07 07:16:36', '2020-09-07 07:16:36'),
(119, 7, 67, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-07 07:25:39', '2020-09-07 07:25:39'),
(120, 7, 67, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-07 07:25:39', '2020-09-07 07:25:39'),
(121, 7, 68, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-07 07:28:39', '2020-09-07 07:28:39'),
(122, 7, 68, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-07 07:28:39', '2020-09-07 07:28:39'),
(123, 7, 69, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-07 07:34:12', '2020-09-07 07:34:12'),
(124, 7, 69, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-07 07:34:12', '2020-09-07 07:34:12'),
(125, 7, 70, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-07 07:35:27', '2020-09-07 07:35:27'),
(126, 7, 70, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-07 07:35:27', '2020-09-07 07:35:27'),
(127, 7, 71, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-07 07:49:06', '2020-09-07 07:49:06'),
(128, 7, 71, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-07 07:49:06', '2020-09-07 07:49:06'),
(129, 7, 72, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-07 07:49:59', '2020-09-07 07:49:59'),
(130, 7, 72, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-07 07:49:59', '2020-09-07 07:49:59'),
(131, 7, 73, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-07 07:50:18', '2020-09-07 07:50:18'),
(132, 7, 73, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-07 07:50:18', '2020-09-07 07:50:18'),
(133, 7, 74, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-07 07:51:23', '2020-09-07 07:51:23'),
(134, 7, 74, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-07 07:51:23', '2020-09-07 07:51:23'),
(135, 7, 75, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-07 07:51:53', '2020-09-07 07:51:53'),
(136, 7, 75, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-07 07:51:53', '2020-09-07 07:51:53'),
(137, 7, 76, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-07 07:52:54', '2020-09-07 07:52:54'),
(138, 7, 76, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-07 07:52:54', '2020-09-07 07:52:54'),
(139, 7, 77, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-08 07:02:32', '2020-09-08 07:02:32'),
(140, 7, 77, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-08 07:02:33', '2020-09-08 07:02:33'),
(141, 7, 78, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-08 07:04:44', '2020-09-08 07:04:44'),
(142, 7, 78, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-08 07:04:44', '2020-09-08 07:04:44'),
(143, 7, 79, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-08 07:26:57', '2020-09-08 07:26:57'),
(144, 7, 79, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-08 07:26:57', '2020-09-08 07:26:57'),
(145, 7, 80, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-08 07:48:42', '2020-09-08 07:48:42'),
(146, 7, 80, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-08 07:48:42', '2020-09-08 07:48:42'),
(147, 7, 81, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-09 06:53:14', '2020-09-09 06:53:14'),
(148, 7, 81, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-09 06:53:14', '2020-09-09 06:53:14'),
(149, 7, 82, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-09 07:04:30', '2020-09-09 07:04:30'),
(150, 7, 82, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-09 07:04:30', '2020-09-09 07:04:30'),
(151, 7, 83, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-09 07:08:10', '2020-09-09 07:08:10'),
(152, 7, 83, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-09 07:08:10', '2020-09-09 07:08:10'),
(153, 7, 84, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-09 07:13:31', '2020-09-09 07:13:31'),
(154, 7, 84, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-09 07:13:31', '2020-09-09 07:13:31'),
(155, 7, 85, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-09 07:26:18', '2020-09-09 07:26:18'),
(156, 7, 85, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-09 07:26:18', '2020-09-09 07:26:18'),
(157, 7, 86, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-10 06:42:58', '2020-09-10 06:42:58'),
(158, 7, 86, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-10 06:42:58', '2020-09-10 06:42:58'),
(159, 7, 87, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-10 06:53:01', '2020-09-10 06:53:01'),
(160, 7, 87, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-10 06:53:01', '2020-09-10 06:53:01'),
(161, 7, 88, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-10 07:04:43', '2020-09-10 07:04:43'),
(162, 7, 88, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-10 07:04:43', '2020-09-10 07:04:43'),
(163, 7, 89, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-10 07:06:55', '2020-09-10 07:06:55'),
(164, 7, 89, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-10 07:06:55', '2020-09-10 07:06:55'),
(165, 7, 90, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-10 07:11:05', '2020-09-10 07:11:05'),
(166, 7, 90, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-10 07:11:05', '2020-09-10 07:11:05'),
(167, 7, 91, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-10 07:12:15', '2020-09-10 07:12:15'),
(168, 7, 91, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-10 07:12:15', '2020-09-10 07:12:15'),
(169, 7, 92, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-10 07:14:40', '2020-09-10 07:14:40'),
(170, 7, 92, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-10 07:14:40', '2020-09-10 07:14:40'),
(171, 7, 93, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-10 07:15:19', '2020-09-10 07:15:19'),
(172, 7, 93, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-10 07:15:19', '2020-09-10 07:15:19'),
(173, 7, 94, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-10 07:17:24', '2020-09-10 07:17:24'),
(174, 7, 94, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-10 07:17:24', '2020-09-10 07:17:24'),
(175, 7, 95, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-10 07:22:23', '2020-09-10 07:22:23'),
(176, 7, 95, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-10 07:22:23', '2020-09-10 07:22:23'),
(177, 7, 96, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-10 07:35:32', '2020-09-10 07:35:32'),
(178, 7, 96, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-10 07:35:32', '2020-09-10 07:35:32'),
(179, 7, 97, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-10 07:51:05', '2020-09-10 07:51:05'),
(180, 7, 97, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-10 07:51:06', '2020-09-10 07:51:06'),
(181, 7, 98, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-11 07:11:55', '2020-09-11 07:11:55'),
(182, 7, 98, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-11 07:11:55', '2020-09-11 07:11:55'),
(183, 7, 99, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-11 07:20:42', '2020-09-11 07:20:42'),
(184, 7, 99, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-11 07:20:42', '2020-09-11 07:20:42'),
(185, 7, 100, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-11 07:23:47', '2020-09-11 07:23:47'),
(186, 7, 100, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-11 07:23:47', '2020-09-11 07:23:47'),
(187, 7, 101, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-11 07:30:40', '2020-09-11 07:30:40'),
(188, 7, 101, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-11 07:30:40', '2020-09-11 07:30:40'),
(189, 7, 102, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-11 07:31:14', '2020-09-11 07:31:14'),
(190, 7, 102, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-11 07:31:14', '2020-09-11 07:31:14'),
(191, 7, 103, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-11 07:33:30', '2020-09-11 07:33:30'),
(192, 7, 103, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-11 07:33:30', '2020-09-11 07:33:30'),
(193, 7, 104, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-11 07:39:45', '2020-09-11 07:39:45'),
(194, 7, 104, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-11 07:39:45', '2020-09-11 07:39:45'),
(195, 7, 105, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-11 07:40:42', '2020-09-11 07:40:42'),
(196, 7, 105, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-11 07:40:42', '2020-09-11 07:40:42'),
(197, 7, 106, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-11 07:42:55', '2020-09-11 07:42:55'),
(198, 7, 106, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-11 07:42:55', '2020-09-11 07:42:55'),
(199, 7, 107, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-11 07:44:23', '2020-09-11 07:44:23'),
(200, 7, 107, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-11 07:44:23', '2020-09-11 07:44:23'),
(201, 7, 108, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-11 07:46:11', '2020-09-11 07:46:11'),
(202, 7, 108, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-11 07:46:11', '2020-09-11 07:46:11'),
(203, 7, 109, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-11 07:54:03', '2020-09-11 07:54:03'),
(204, 7, 109, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-11 07:54:03', '2020-09-11 07:54:03'),
(205, 7, 110, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-11 08:01:23', '2020-09-11 08:01:23'),
(206, 7, 110, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-11 08:01:23', '2020-09-11 08:01:23'),
(207, 7, 111, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-11 08:02:07', '2020-09-11 08:02:07'),
(208, 7, 111, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-11 08:02:07', '2020-09-11 08:02:07'),
(209, 7, 112, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-11 08:03:18', '2020-09-11 08:03:18'),
(210, 7, 112, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-11 08:03:18', '2020-09-11 08:03:18'),
(211, 7, 113, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-13 06:49:14', '2020-09-13 06:49:14'),
(212, 7, 113, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-13 06:49:14', '2020-09-13 06:49:14'),
(213, 7, 114, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-13 06:50:49', '2020-09-13 06:50:49'),
(214, 7, 114, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-13 06:50:49', '2020-09-13 06:50:49'),
(215, 7, 115, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-13 07:39:06', '2020-09-13 07:39:06'),
(216, 7, 115, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-13 07:39:06', '2020-09-13 07:39:06'),
(217, 7, 116, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-13 07:45:56', '2020-09-13 07:45:56'),
(218, 7, 116, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-13 07:45:56', '2020-09-13 07:45:56'),
(219, 7, 117, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-13 07:48:00', '2020-09-13 07:48:00'),
(220, 7, 117, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-13 07:48:00', '2020-09-13 07:48:00'),
(221, 7, 118, 19, 'ST2502', 'Special Men\'s Half Sleeve with normal cotton', 'XL', 'GREEN', '250', 3, '2020-09-13 07:49:57', '2020-09-13 07:49:57'),
(222, 7, 118, 20, 'TS4016', 'Special Black T Shirt For Man', 'XXL', 'Black', '250', 2, '2020-09-13 07:49:57', '2020-09-13 07:49:57'),
(223, 10, 119, 10, '1542685', 'Special Men T-shirt for men and women', 'L', 'Red', '2500', 1, '2020-10-03 03:30:19', '2020-10-03 03:30:19'),
(224, 10, 120, 10, '1542685', 'Special Men T-shirt for men and women', 'L', 'Red', '2500', 1, '2020-10-03 03:31:17', '2020-10-03 03:31:17'),
(225, 10, 121, 19, 'TSG12', 'Special Men\'s Half Sleeve with normal cotton', 'XXL', 'GREEN', '250', 1, '2020-10-03 03:33:05', '2020-10-03 03:33:05');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pincodes`
--

CREATE TABLE `pincodes` (
  `id` int(11) NOT NULL,
  `pincode` varchar(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pincodes`
--

INSERT INTO `pincodes` (`id`, `pincode`, `city`, `address`, `created_at`, `updated_at`) VALUES
(1, '1222', 'Dhaka', 'Motijheel', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(2, '1207', 'Dhaka', 'Mohammadpur', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(3, '1216', 'Dhaka', 'Mirpur', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(4, '1212', 'Dhaka', 'Gulshan', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(5, '1209', 'Dhaka', 'Dhanmondi', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(6, '1000', 'Dhaka', 'Paltan', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(7, '1340', 'Savar', 'savar', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(8, '7800', 'Faridpur', 'Faridpur City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(9, '1700', 'Gazipur', 'Gazipur City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(10, '8100', 'Gopalganj', 'Gopalganj City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(11, '2300', 'Kishoreganj', 'Kishoreganj City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(12, '7900', 'Madaripur', 'Madaripur City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(13, '1800', 'Manikganj', 'Manikganj City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(14, '1500', 'Munshiganj', 'Munshiganj City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(15, '1400', 'Narayanganj', 'Narayanganj City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(16, '1600', 'Narsingdi', 'Narsingdi City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(17, '7710', 'Rajbari', 'Rajbari City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(18, '8000', 'Shariatpur', 'Shariatpur City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(19, '1900', 'Tangail', 'Tangail Ciy', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(20, '8700', 'Barguna', 'Barguna City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(21, '8200', 'Barishal', 'Barishal City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(22, '8210', 'Barishal', 'Babuganj', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(23, '8230', 'Barishal', 'Gouranadi', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(24, '8270', 'Barishal', 'Mahendiganj', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(25, '8250', 'Barishal', 'Muladi', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(26, '8280', 'Barishal', 'Sahebganj', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(27, '8220', 'Barishal', 'Uzirpur', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(28, '8300', 'Bhola', 'Bhola City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(29, '8400', 'Jhalokathi', 'Jhalokathi City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(30, '8600', 'Patuakhali', 'Patuakhali City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(31, '8500', 'Pirojpur', 'Pirojpur City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(32, '2000', 'Jamalpur', 'Jamalpur', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(33, '2230', 'Mymensingh', 'Gaforgaon', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(34, '2240', 'Mymensingh', 'Bhaluka', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(35, '2270', 'Mymensingh', 'Gouripur', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(36, '2260', 'Mymensingh', 'Haluaghat', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(37, '2210', 'Mymensingh', 'Muktagachha', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(38, '2200', 'Mymensingh', 'Mymensingh City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(39, '2220', 'Mymensingh', 'Trishal', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(40, '2400', 'Netrakona', 'Netrakona City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(41, '2150', 'Sherpur', 'Nakla', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(42, '2110', 'Sherpur', 'Nalitabari', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(43, '2100', 'Sherpur', 'Sherpur City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(44, '9300', 'Bagherhat', 'Bagherhat City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(45, '9340', 'Bagherhat', 'Rampal', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(46, '9310', 'Bagherhat', 'Kachua', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(47, '9320', 'Bagherhat', 'Morelganj', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(48, '7210', 'Chuadanga', 'Alamdanga', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(49, '7220', 'Chuadanga', 'Damurhuda', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(50, '7200', 'Chuadanga', 'Chuadanga City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(51, '7420', 'Jessore', 'Jhikargachha', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(52, '7450', 'Jessore', 'Keshabpur', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(53, '7460', 'Jessore', 'Noapara', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(54, '7400', 'Jessore', 'Jessore City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(55, '7300', 'Jinaidaha', 'Jinaidaha City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(56, '9240', 'Khulna', 'Alaipur', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(57, '9280', 'Khulna', 'Paikgachha', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(58, '9000', 'Khulna', 'Khulna City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(59, '3370', 'Hobiganj', 'Nabiganj', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(60, '3330', 'Hobiganj', 'Madhabpur', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(61, '3360', 'Hobiganj', 'Azmireeganj', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(62, '3300', 'Hobiganj', 'Hobiganj City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(63, '3250', 'Moulvibazar', 'Baralekha', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(64, '3210', 'Moulvibazar', 'Srimangal', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(65, '3230', 'Moulvibazar', 'Kulaura', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(66, '3200', 'Moulvibazar', 'Moulvibazar City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(67, '3080', 'Sunamganj', 'Chhatak', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(68, '3081', 'Sunamganj', 'Chhatak Cement', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(69, '3060', 'Sunamganj', 'Jagnnathpur', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(70, '3000', 'Sunamganj', 'Sunamganj City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(71, '3170', 'Sylhet', 'Bianibazar', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(72, '3116', 'Sylhet', 'Fenchuganj', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(73, '3100', 'Sylhet', 'Sylhet City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(74, '5890', 'Bogra', 'Alamdighi', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(75, '5820', 'Bogra', 'Gabtoli', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(76, '5800', 'Bogra', 'Bogra City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(77, '6310', 'Chapinawabganj', 'Nachol', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(78, '6320', 'Chapinawabganj', 'Rohanpur', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(79, '6340', 'Chapinawabganj', 'Shibganj U.P.O', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(80, '6300', 'Chapinawabganj', 'Chapinawabganj City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(81, '5940', 'Joypurhat', 'Akkelpur', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(82, '5900', 'Joypurhat', 'Joypurhat Cityy', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(83, '5910', 'Joypurhat', 'panchbibi', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(84, '6500', 'Naogaon', 'Naogaon City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(85, '6400', 'Natore', 'Natore City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(86, '6620', 'Pabna', 'Ishwardi', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(87, '6700', 'Sirajganj', 'Sirajganj City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(88, '6000', 'Rajshahi', 'Rajshahi City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(89, '5280', 'Dinajpur', 'Nababganj', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(90, '5266', 'Dinajpur', 'Birampur', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(91, '5270', 'Dinajpur', 'Bangla Hili', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(92, '5200', 'Dinajpur', 'Dinajpur City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(93, '5750', 'Gaibandha', 'Bonarpara', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(94, '5740', 'Gaibandha', 'Gobindhaganj', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(95, '5700', 'Gaibandha', 'Gaibandha City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(96, '5630', 'Kurigram', 'Chilmari', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(97, '5600', 'Kurigram', 'Kurigram City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(98, '5542', 'Lalmonirhat', 'Patgram', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(99, '5500', 'Lalmonirhat', 'Lalmonirhat City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(100, '5300', 'Nilphamari', 'Nilphamari City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(101, '5000', 'Panchagarh', 'Panchagarh City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(102, '5460', 'Rangpur', 'Mithapukur', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(103, '5400', 'Rangpur', 'Rangpur City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(104, '4600', 'Bandarban', 'Bandarban City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(105, '4630', 'Bandarban', 'Thanchi', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(106, '3450', 'Brahmanbaria', 'Akhaura', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(107, '4500', 'Rangamati', 'Rangamati City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(108, '3400', 'Brahmanbaria', 'Brahmanbaria City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(109, '4202', 'Chittagong', 'Chittagong City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(110, '3600', 'Chandpur', 'Chandpur City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(111, '3516', 'Comilla', 'Daudkandi', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(112, '3500', 'Comilla', 'Comilla City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(113, '4760', 'Cox’s Bazar', 'Teknaf', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(114, '4700', 'Cox’s Bazar', 'Cox’s Bazar City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(115, '3900', 'Feni', 'Feni City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(116, '4400', 'Khagrachari', 'Khagrachari City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(117, '3700', 'Lakshmipur', 'Lakshmipur City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(118, '3800-05', 'Noakhali', 'Noakhali City', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(119, '', '', '', '0000-00-00 00:00:00', '2020-07-15 18:04:30'),
(120, '', '', '', '0000-00-00 00:00:00', '2020-07-15 18:04:30');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `care` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sleeve` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pattern` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` int(255) NOT NULL,
  `feature_item` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_color`, `description`, `care`, `sleeve`, `pattern`, `price`, `image`, `video`, `weight`, `feature_item`, `status`, `created_at`, `updated_at`) VALUES
(10, 14, 'Special Men T-shirt for men and women', '1201', 'Red', 'Formal T-Shirt', 'Formal T-Shirt', 'half-sleeve', 'Checked', 500.00, '47640.jpg', '', 1000, 1, 1, '2020-02-29 04:51:09', '2020-08-25 06:41:14'),
(11, 20, 'DIGITAL SCALE-200KG-SURMA', 'DG200KG', 'BLACK', 'SURMA DIGITAL SCALE FROM CHINA. THIS VERY GOOD QUALITY PRODUCT FROM CHINA. WITH VERY GOOD QUALITY.', 'SURMA DIGITAL SCALE FROM CHINA. THIS VERY GOOD QUALITY PRODUCT FROM CHINA. WITH VERY GOOD QUALITY.', '', '', 5000.00, '97912.jpg', 'file_example_MP4_640_3MG.mp4', 0, 0, 1, '2020-03-02 23:55:02', '2020-07-19 01:13:26'),
(12, 20, 'DIGITAL BATHROOM SCALE-180KG-CAMRY', 'DGB180KG', 'WHITE', 'DIGITAL BATHROOM SCALE WITH VERY POWERFUL BATTERY WHICH IS ONE OF THE BEST PRODUCT.', '', '', '', 1500.00, '73046.jpg', '', 0, 0, 1, '2020-03-02 23:57:36', '2020-03-02 23:57:36'),
(13, 17, 'WELDING MACHINE-MMA200I-MITECH', 'WM200I', 'NAVY-BLUE', 'HIGH QUALITY WELDING MACHINE FOR GOOD WELDING', '', '', '', 5800.00, '61047.jpg', '', 0, 0, 1, '2020-03-04 00:07:53', '2020-03-04 00:07:53'),
(14, 20, 'DIGITAL SCALE-1TON-FLOOR SCALE', 'DG1000KG', 'BLACK', 'HIGH QUALITY DIGITAL SCALE FOR GET GOOD WEIGHT', '', '', '', 22000.00, '22728.jpeg', '', 0, 0, 1, '2020-03-04 00:09:52', '2020-03-04 01:07:26'),
(15, 21, 'SPRING SCALE-150KG-CAMRY', 'SS180KG', 'GREEN', 'HIGH QUALITY SPRING SCALE TO GET GOOD WEIGHT FOR YOUR HEALTH', '', '', '', 500.00, '3959.png', '', 0, 0, 1, '2020-03-04 01:13:27', '2020-03-04 01:13:27'),
(16, 16, 'BLOWER MACHINE-800W-WORKSITE', 'BM800W', 'YELLOW', 'VERY HIGH QUALITY BLOWER MACHINE AND MATERIAL', 'VERY HIGH QUALITY BLOWER MACHINE AND MATERIAL', '', '', 2600.00, '34102.jpg', '', 0, 0, 1, '2020-03-05 00:39:41', '2020-03-05 00:47:20'),
(17, 14, 'BLACK 100% COTTON  T-SHIRT', '124536', 'BLACK', 'HIGHLY COTTON BLACK T SHIRT FOR YOU. IT 100% COTTON WITH SILK COTTON', 'HIGHLY COTTON BLACK T SHIRT FOR YOU. IT 100% COTTON WITH SILK COTTON', 'full-sleeve', 'Solid', 350.00, '43802.jpg', '', 500, 1, 1, '2020-03-07 07:27:14', '2020-08-05 23:01:12'),
(18, 14, 'BOYS T SHIRT 100% SILK T-shirt', '24535', 'BLUE', 'HIGHLY COTTON BLACK T SHIRT FOR YOU. IT 100% COTTON WITH SILK COTTON', 'HIGHLY COTTON BLACK T SHIRT FOR YOU. IT 100% COTTON WITH SILK COTTON', '', '', 650.00, '2704.jpg', '', 0, 1, 1, '2020-03-07 07:29:14', '2020-07-12 00:52:54'),
(19, 14, 'Special Men\'s Half Sleeve with normal cotton', 'ST2502', 'GREEN', 'VERY HIGH QUALITY AND NICE TSHIRT FOR MAN. THIS IS VERY SPECIAL RATE FOR YOU.', 'VERY HIGH QUALITY AND NICE TSHIRT FOR MAN. THIS IS VERY SPECIAL RATE FOR YOU.', 'full-sleeve', 'Checked', 600.00, '54721.jpg', '', 600, 1, 1, '2020-03-08 05:07:07', '2020-08-05 23:01:27'),
(20, 14, 'Special Black T Shirt For Man', 'TS4016', 'Black', 'very high quality shirt for the men. it\'s also very good quality for the kids', 'very high quality shirt for the men. it\'s also very good quality for the kids', 'full-sleeve', 'Checked', 500.00, '12406.jpg', '', 400, 0, 1, '2020-03-08 05:18:14', '2020-08-05 23:01:45'),
(21, 14, 'Special Men T-shirt', '1201', 'Red', 'Very hight Quality T-shirt for man and woman. Buy your product today and get special price.', 'Very hight Quality T-shirt for man and woman. Buy your product today and get special price.', 'full-sleeve', 'Checked', 250.00, '22217.jpg', '', 700, 0, 1, '2020-03-08 05:44:29', '2020-08-05 23:02:01'),
(22, 14, 'Man\'s Easy T-shirt', 'TS302', 'yellow', 'This is men\'s awesome t-shirt', '1. 100% cotton\r\n2. Blue color', 'full-sleeve', 'Checked', 350.00, '91043.jpg', 'file_example_MP4_640_3MG.mp4', 500, 1, 1, '2020-07-10 01:02:05', '2020-08-05 23:02:12'),
(23, 15, 'Man Cotton Shirt', 'T5052', 'blue', 'This is a very good tshirt for you', 'This is a very good tshirt for you', '', '', 500.00, '83446.jpg', 'file_example_MP4_640_3MG.mp4', 0, 1, 1, '2020-07-19 00:16:15', '2020-07-19 01:10:02'),
(24, 14, 'Red Youth T-shirt Small', 'red102', 'Red', 'Red color T-shirt for man and woman', 'Red color T-shirt for man and woman', 'short-sleeve', 'Checked', 750.00, '88301.jpg', 'file_example_MP4_640_3MG.mp4', 0, 1, 1, '2020-07-24 01:30:10', '2020-07-27 02:31:42'),
(25, 14, 'Black cotton t-shirt', '63300', 'blue', '<p>This is a very amazing product. It\'s a very comfortable t-shirt with silk jorjet.</p>', '<p>This is a very amazing product. It\'s a very comfortable t-shirt with silk jorjet.</p>', 'half-sleeve', 'Checked', 500.00, '64684.jpg', '118397325_406366993670443_3360690081048285753_n.jpg', 500, 1, 1, '2020-08-25 07:15:52', '2020-08-25 07:15:52');

-- --------------------------------------------------------

--
-- Table structure for table `products_images`
--

CREATE TABLE `products_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_images`
--

INSERT INTO `products_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 11, '9342.jpg', '2020-03-05 04:24:03', '2020-03-05 04:24:03'),
(2, 11, '35201.jpg', '2020-03-05 04:24:05', '2020-03-05 04:24:05'),
(3, 11, '26539.jpg', '2020-03-05 04:24:06', '2020-03-05 04:24:06'),
(4, 11, '55813.jpg', '2020-03-05 04:24:06', '2020-03-05 04:24:06'),
(5, 10, '38803.jpg', '2020-03-06 23:52:49', '2020-03-06 23:52:49'),
(6, 10, '37456.jpg', '2020-03-06 23:52:49', '2020-03-06 23:52:49'),
(8, 12, '84861.jpg', '2020-03-07 01:51:28', '2020-03-07 01:51:28'),
(9, 12, '99326.jpg', '2020-03-07 01:51:29', '2020-03-07 01:51:29'),
(10, 12, '94160.jpg', '2020-03-07 01:51:29', '2020-03-07 01:51:29'),
(11, 12, '30343.jpg', '2020-03-07 01:51:29', '2020-03-07 01:51:29'),
(12, 17, '22254.jpg', '2020-03-07 07:33:36', '2020-03-07 07:33:36'),
(13, 17, '46794.jpg', '2020-03-07 07:33:37', '2020-03-07 07:33:37'),
(14, 18, '34182.jpg', '2020-03-07 07:34:05', '2020-03-07 07:34:05'),
(15, 18, '46702.jpg', '2020-03-07 07:34:06', '2020-03-07 07:34:06'),
(16, 18, '99145.jpg', '2020-03-07 07:34:06', '2020-03-07 07:34:06'),
(17, 18, '57180.jpg', '2020-03-07 07:34:07', '2020-03-07 07:34:07'),
(18, 18, '90083.jpg', '2020-03-07 07:34:07', '2020-03-07 07:34:07'),
(19, 18, '2631.jpg', '2020-03-07 07:34:07', '2020-03-07 07:34:07'),
(20, 19, '38627.jpg', '2020-03-08 05:10:32', '2020-03-08 05:10:32'),
(21, 19, '85999.jpg', '2020-03-08 05:10:33', '2020-03-08 05:10:33'),
(22, 19, '66126.jpg', '2020-03-08 05:10:33', '2020-03-08 05:10:33'),
(23, 19, '36788.jpg', '2020-03-08 05:10:34', '2020-03-08 05:10:34'),
(24, 19, '24921.jpg', '2020-03-08 05:10:34', '2020-03-08 05:10:34'),
(25, 20, '11506.jpg', '2020-03-08 05:19:28', '2020-03-08 05:19:28'),
(26, 20, '87988.jpg', '2020-03-08 05:19:29', '2020-03-08 05:19:29'),
(27, 20, '79106.jpg', '2020-03-08 05:19:29', '2020-03-08 05:19:29'),
(28, 20, '61834.jpg', '2020-03-08 05:19:30', '2020-03-08 05:19:30'),
(29, 22, '91966.jpg', '2020-07-10 01:06:03', '2020-07-10 01:06:03'),
(30, 22, '35179.jpg', '2020-07-10 01:06:03', '2020-07-10 01:06:03');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `sku`, `size`, `price`, `stock`, `created_at`, `updated_at`) VALUES
(2, 10, '1201-52', 'XL', 1200.00, 0, '2020-03-01 23:22:18', '2020-07-26 00:38:23'),
(3, 10, '1525534', 'XXL', 1500.00, 55, '2020-03-01 23:22:35', '2020-08-13 06:57:43'),
(6, 10, '1542685', 'L', 2500.00, 0, '2020-03-05 02:53:07', '2020-10-03 03:31:17'),
(10, 17, 'T-SHIRT254', 'XL', 350.00, 50, '2020-03-07 07:31:57', '2020-07-26 00:38:58'),
(11, 17, 'T-SHIRT255', 'L', 350.00, 50, '2020-03-07 07:31:57', '2020-07-26 00:38:58'),
(12, 18, 'T-SHIRT25', 'XXL', 650.00, 25, '2020-03-07 07:33:04', '2020-07-28 01:19:51'),
(13, 18, 'T-SHIRT24', 'XL', 650.00, 0, '2020-03-07 07:33:04', '2020-07-28 23:21:12'),
(14, 18, 'T-SHIRT23', 'L', 650.00, 100, '2020-03-07 07:33:04', '2020-07-28 01:19:51'),
(15, 19, 'TSG12', 'XXL', 250.00, 1, '2020-03-08 05:09:49', '2020-10-03 03:33:05'),
(16, 19, 'TSG13', 'XL', 250.00, 4, '2020-03-08 05:09:49', '2020-08-13 06:57:43'),
(17, 19, 'TSG42', 'L', 350.00, 0, '2020-03-08 05:09:49', '2020-07-08 23:55:49'),
(18, 20, '54255', 'XXL', 250.00, 17, '2020-03-08 05:18:58', '2020-08-13 06:57:43'),
(19, 20, '2364', 'XL', 250.00, 47, '2020-03-08 05:18:58', '2020-07-30 00:58:37'),
(20, 20, '44753', 'L', 200.00, 0, '2020-03-08 05:18:58', '2020-03-08 05:18:58'),
(21, 22, 'tshirt302XXL', 'XXL', 350.00, 7, '2020-07-10 01:04:20', '2020-08-13 06:59:51'),
(22, 22, 'tshirt302XL', 'XL', 350.00, 11, '2020-07-10 01:04:20', '2020-08-13 07:08:50'),
(23, 22, 'tshirt302L', 'L', 350.00, 2, '2020-07-10 01:04:20', '2020-07-10 01:04:20'),
(24, 22, 'tshirt302M', 'M', 350.00, 50, '2020-07-10 01:04:20', '2020-07-10 01:04:20');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_charges`
--

CREATE TABLE `shipping_charges` (
  `id` int(11) NOT NULL,
  `country` varchar(100) NOT NULL DEFAULT '',
  `shipping_charge0_500` float NOT NULL,
  `shipping_charge500_1000` float NOT NULL,
  `shipping_charge1000_2000` float NOT NULL,
  `shipping_charge2000_5000` float NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shipping_charges`
--

INSERT INTO `shipping_charges` (`id`, `country`, `shipping_charge0_500`, `shipping_charge500_1000`, `shipping_charge1000_2000`, `shipping_charge2000_5000`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', 0, 750, 0, 0, '2020-07-28 11:24:17', '2020-07-30 01:38:34'),
(2, 'Albania', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(3, 'Algeria', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(4, 'American Samoa', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(5, 'Andorra', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(6, 'Angola', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(7, 'Anguilla', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(8, 'Antarctica', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(9, 'Antigua and Barbuda', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(10, 'Argentina', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(11, 'Armenia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(12, 'Aruba', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(13, 'Australia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(14, 'Austria', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(15, 'Azerbaijan', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(16, 'Bahamas', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(17, 'Bahrain', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(18, 'Bangladesh', 50, 100, 150, 200, '2020-07-28 11:24:17', '2020-08-05 23:47:02'),
(19, 'Barbados', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(20, 'Belarus', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(21, 'Belgium', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(22, 'Belize', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(23, 'Benin', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(24, 'Bermuda', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(25, 'Bhutan', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(26, 'Bolivia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(27, 'Bosnia and Herzegovina', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(28, 'Botswana', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(29, 'Bouvet Island', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(30, 'Brazil', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(31, 'British Indian Ocean Territory', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(32, 'Brunei Darussalam', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(33, 'Bulgaria', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(34, 'Burkina Faso', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(35, 'Burundi', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(36, 'Cambodia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(37, 'Cameroon', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(38, 'Canada', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(39, 'Cape Verde', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(40, 'Cayman Islands', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(41, 'Central African Republic', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(42, 'Chad', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(43, 'Chile', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(44, 'China', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(45, 'Christmas Island', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(46, 'Cocos (Keeling) Islands', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(47, 'Colombia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(48, 'Comoros', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(49, 'Democratic Republic of the Congo', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(50, 'Republic of Congo', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(51, 'Cook Islands', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(52, 'Costa Rica', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(53, 'Croatia (Hrvatska)', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(54, 'Cuba', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(55, 'Cyprus', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(56, 'Czech Republic', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(57, 'Denmark', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(58, 'Djibouti', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(59, 'Dominica', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(60, 'Dominican Republic', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(61, 'East Timor', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(62, 'Ecuador', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(63, 'Egypt', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(64, 'El Salvador', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(65, 'Equatorial Guinea', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(66, 'Eritrea', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(67, 'Estonia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(68, 'Ethiopia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(69, 'Falkland Islands (Malvinas)', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(70, 'Faroe Islands', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(71, 'Fiji', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(72, 'Finland', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(73, 'France', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(74, 'France, Metropolitan', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(75, 'French Guiana', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(76, 'French Polynesia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(77, 'French Southern Territories', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(78, 'Gabon', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(79, 'Gambia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(80, 'Georgia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(81, 'Germany', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(82, 'Ghana', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(83, 'Gibraltar', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(84, 'Guernsey', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(85, 'Greece', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(86, 'Greenland', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(87, 'Grenada', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(88, 'Guadeloupe', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(89, 'Guam', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(90, 'Guatemala', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(91, 'Guinea', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(92, 'Guinea-Bissau', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(93, 'Guyana', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(94, 'Haiti', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(95, 'Heard and Mc Donald Islands', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(96, 'Honduras', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(97, 'Hong Kong', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(98, 'Hungary', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(99, 'Iceland', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(100, 'India', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(101, 'Isle of Man', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(102, 'Indonesia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(103, 'Iran (Islamic Republic of)', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(104, 'Iraq', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(105, 'Ireland', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(106, 'Israel', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(107, 'Italy', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(108, 'Ivory Coast', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(109, 'Jersey', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(110, 'Jamaica', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(111, 'Japan', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(112, 'Jordan', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(113, 'Kazakhstan', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(114, 'Kenya', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(115, 'Kiribati', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(116, 'Korea, Democratic People\'s Republic of', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(117, 'Korea, Republic of', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(118, 'Kosovo', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(119, 'Kuwait', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(120, 'Kyrgyzstan', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(121, 'Lao People\'s Democratic Republic', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(122, 'Latvia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(123, 'Lebanon', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(124, 'Lesotho', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(125, 'Liberia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(126, 'Libyan Arab Jamahiriya', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(127, 'Liechtenstein', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(128, 'Lithuania', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(129, 'Luxembourg', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(130, 'Macau', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(131, 'North Macedonia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(132, 'Madagascar', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(133, 'Malawi', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(134, 'Malaysia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(135, 'Maldives', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(136, 'Mali', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(137, 'Malta', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(138, 'Marshall Islands', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(139, 'Martinique', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(140, 'Mauritania', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(141, 'Mauritius', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(142, 'Mayotte', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(143, 'Mexico', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(144, 'Micronesia, Federated States of', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(145, 'Moldova, Republic of', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(146, 'Monaco', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(147, 'Mongolia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(148, 'Montenegro', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(149, 'Montserrat', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(150, 'Morocco', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(151, 'Mozambique', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(152, 'Myanmar', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(153, 'Namibia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(154, 'Nauru', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(155, 'Nepal', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(156, 'Netherlands', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(157, 'Netherlands Antilles', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(158, 'New Caledonia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(159, 'New Zealand', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(160, 'Nicaragua', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(161, 'Niger', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(162, 'Nigeria', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(163, 'Niue', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(164, 'Norfolk Island', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(165, 'Northern Mariana Islands', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(166, 'Norway', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(167, 'Oman', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(168, 'Pakistan', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(169, 'Palau', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(170, 'Palestine', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(171, 'Panama', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(172, 'Papua New Guinea', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(173, 'Paraguay', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(174, 'Peru', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(175, 'Philippines', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(176, 'Pitcairn', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(177, 'Poland', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(178, 'Portugal', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(179, 'Puerto Rico', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(180, 'Qatar', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(181, 'Reunion', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(182, 'Romania', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(183, 'Russian Federation', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(184, 'Rwanda', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(185, 'Saint Kitts and Nevis', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(186, 'Saint Lucia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(187, 'Saint Vincent and the Grenadines', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(188, 'Samoa', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(189, 'San Marino', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(190, 'Sao Tome and Principe', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(191, 'Saudi Arabia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(192, 'Senegal', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(193, 'Serbia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(194, 'Seychelles', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(195, 'Sierra Leone', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(196, 'Singapore', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(197, 'Slovakia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(198, 'Slovenia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(199, 'Solomon Islands', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(200, 'Somalia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(201, 'South Africa', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(202, 'South Georgia South Sandwich Islands', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(203, 'South Sudan', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(204, 'Spain', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(205, 'Sri Lanka', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(206, 'St. Helena', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(207, 'St. Pierre and Miquelon', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(208, 'Sudan', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(209, 'Suriname', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(210, 'Svalbard and Jan Mayen Islands', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(211, 'Swaziland', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(212, 'Sweden', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(213, 'Switzerland', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(214, 'Syrian Arab Republic', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(215, 'Taiwan', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(216, 'Tajikistan', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(217, 'Tanzania, United Republic of', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(218, 'Thailand', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(219, 'Togo', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(220, 'Tokelau', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(221, 'Tonga', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(222, 'Trinidad and Tobago', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(223, 'Tunisia', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(224, 'Turkey', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(225, 'Turkmenistan', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(226, 'Turks and Caicos Islands', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(227, 'Tuvalu', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(228, 'Uganda', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(229, 'Ukraine', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(230, 'United Arab Emirates', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(231, 'United Kingdom', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(232, 'United States', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(233, 'United States minor outlying islands', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(234, 'Uruguay', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(235, 'Uzbekistan', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(236, 'Vanuatu', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(237, 'Vatican City State', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(238, 'Venezuela', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(239, 'Vietnam', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(240, 'Virgin Islands (British)', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(241, 'Virgin Islands (U.S.)', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(242, 'Wallis and Futuna Islands', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(243, 'Western Sahara', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(244, 'Yemen', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(246, 'Zimbabwe', 0, 0, 0, 0, '2020-07-28 11:24:17', '2020-07-28 18:24:17'),
(247, 'Zambia', 63, 0, 0, 0, '2020-07-29 17:05:44', '2020-07-30 00:05:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `status`, `admin`, `address`, `city`, `state`, `country`, `pincode`, `mobile`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'jahirul islam', 'jahirupa@gmail.com', 0, 1, 'Hazi ashraf Ali road, Chittagong', 'Chattongram', 'Chattogram', 'Bangladesh', '4202', '01884805662', NULL, '$2y$10$aF/IG6jiDsl.4voxjN0nY.P6DUWXQm36mk6uSBpXSTTCEN.Q.BTUi', NULL, '2020-02-23 23:52:30', '2020-07-12 00:14:28'),
(3, 'Sobuj', 'sobuj@gmail.com', 0, 0, '', '', '', 'Pakistan', '', '', NULL, '$2y$10$pOMGmE.JkMU6Zr4NDgeQgeg0gU7e1om1/aoQZWOvLlUDogdUsVjDa', NULL, '2020-03-13 23:30:23', '2020-03-13 23:30:23'),
(4, 'Farjana Akter', 'farjana@gmail.com', 0, 0, 'Hazi ashraf Ali road, Chittagong', 'Chattongram', 'Chattogram', 'Nepal', '42022', '1884805662', NULL, '$2y$10$3jQfG7/nDzslFX9C/kvie.7GWmS6AgfphYAGomzVqxGu9Wrtz3kJ.', NULL, '2020-03-14 00:00:41', '2020-03-23 22:45:59'),
(5, 'jahid', 'jahid@gmail.com', 0, 0, '', '', '', 'Pakistan', '', '', NULL, '$2y$10$sL7m8MhXlpnETV2mRKHjeu8zKpkwE2qElX4MWPFSdfZ7ewF7NvuKu', NULL, '2020-03-21 00:20:19', '2020-03-21 00:20:19'),
(6, 'Jane Alam', 'alam@gmail.com', 0, 0, 'Foillatali bazar, Chattogram', 'Chattogram', 'Chattogram', 'Bangladesh', '42502', '01884805662', NULL, '827cd38ab18d43db04b690d64e4b22bd', NULL, '2020-03-21 00:30:34', '2020-03-21 04:48:38'),
(7, 'Jahirul Islam', 'talk2jahir.official@gmail.com', 1, 0, 'Hazi ashraf ali road', 'chattogram', 'chattogram', 'Bangladesh', '1207', '01884805662', NULL, '$2y$10$ARH7HA0sCQn/RFd9bqx08OK7Hn9f.nWU1GLvWkF7wd.2N21k43oBe', NULL, '2020-07-12 00:17:18', '2020-09-13 07:38:57'),
(8, 'Moriyam Akter Ripa', 'mariyam@gmail.com', 0, 0, '', '', '', 'India', '', '', NULL, '$2y$10$mHCIWWGZdYNqlW5RE2R55OZuxOeLHw8Ng.UMgbJVuKcqtXs7UANYG', NULL, '2020-09-02 07:41:33', '2020-09-02 07:41:33'),
(9, 'sumi Akter', 'sumi@gmail.com', 0, 0, '', '', '', 'Pakistan', '', '', NULL, '$2y$10$LpK6mktck8qIIEHRz9AQcemHeV8y/SQ3xvdMEj/3vNTLmCaekEKTy', NULL, '2020-09-02 07:46:34', '2020-09-02 07:46:34'),
(10, 'Jahirul Islam', 'jahirulislam1994ctgbd@gmail.com', 1, 0, 'Hazi ashraf ali road', 'chattogram', 'chattogram', 'Bangladesh', '1207', '01884805662', NULL, '$2y$10$kZ9Jwp4JMxTwcSJJAHhnCe./4a64LbYEosbrezf94UxtGBL2aHFRi', NULL, '2020-10-03 03:23:05', '2020-10-03 03:32:59');

-- --------------------------------------------------------

--
-- Table structure for table `wish_lists`
--

CREATE TABLE `wish_lists` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `size` varchar(50) NOT NULL,
  `price` int(255) NOT NULL,
  `quantity` int(50) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wish_lists`
--

INSERT INTO `wish_lists` (`id`, `product_id`, `product_name`, `product_code`, `product_color`, `size`, `price`, `quantity`, `user_email`, `created_at`, `updated_at`) VALUES
(2, 19, 'Special Men\'s Half Sleeve with normal cotton', 'ST2502', 'GREEN', 'XXL', 250, 1, 'talk2jahir.official@gmail.com', '2020-08-28 07:22:17', '2020-08-27 11:22:17'),
(6, 20, 'Special Black T Shirt For Man', 'TS4016', 'Black', 'XXL', 250, 1, 'talk2jahir.official@gmail.com', '2020-08-28 07:26:36', '2020-08-27 11:26:36'),
(7, 19, 'Special Men\'s Half Sleeve with normal cotton', 'ST2502', 'GREEN', 'XL', 250, 1, 'talk2jahir.official@gmail.com', '2020-08-30 07:16:49', '2020-08-29 11:16:49'),
(8, 19, 'Special Men\'s Half Sleeve with normal cotton', 'ST2502', 'GREEN', 'L', 350, 1, 'talk2jahir.official@gmail.com', '2020-08-30 07:18:18', '2020-08-29 11:18:18'),
(9, 10, 'Special Men T-shirt for men and women', '1201', 'Red', 'L', 2500, 1, 'talk2jahir.official@gmail.com', '2020-08-30 07:19:38', '2020-08-29 11:19:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cmspages`
--
ALTER TABLE `cmspages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cod_pincodes`
--
ALTER TABLE `cod_pincodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
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
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_addresses`
--
ALTER TABLE `delivery_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pincodes`
--
ALTER TABLE `pincodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wish_lists`
--
ALTER TABLE `wish_lists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `cmspages`
--
ALTER TABLE `cmspages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cod_pincodes`
--
ALTER TABLE `cod_pincodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `delivery_addresses`
--
ALTER TABLE `delivery_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT for table `pincodes`
--
ALTER TABLE `pincodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wish_lists`
--
ALTER TABLE `wish_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
