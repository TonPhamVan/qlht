-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2022 at 06:50 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL COMMENT 'mã khách hàng',
  `customer_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'tên khách hàng',
  `gender` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'địa chỉ',
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'số điện thoại',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `gender`, `address`, `phone`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hoàng Tôn', 'Nam', 'Hà Nội', '0886684049', '2022-07-13 13:53:09', '2022-07-13 13:53:09', '2022-07-13 13:53:09'),
(2, 'Hoàng Yến', 'Nữ', 'Hà Nội', '0886684222', '2022-07-13 13:49:08', '2022-07-13 13:49:08', NULL),
(3, 'Tùng Lâm', 'Nam', 'Bắc Giang', '0886684077', '2022-07-13 13:49:33', '2022-07-13 13:49:33', NULL),
(4, 'Bùi Ngọc', 'Nữ', 'Hà Nội', '0886223342', '2022-07-13 13:50:08', '2022-07-13 13:50:08', NULL),
(6, 'Hoàng Tùng', 'Nam', 'Bắc Ninh', '0886684999', '2022-07-13 13:51:46', '2022-07-13 13:51:46', NULL),
(7, 'Nguyễn Giang', 'Nữ', 'Hà Nội', '0886684555', '2022-07-13 15:22:25', '2022-07-13 15:22:25', NULL),
(8, 'Hoàng Tùng', 'Nam', 'Bắc Ninh', '0886684999', '2022-07-13 15:24:09', '2022-07-13 15:24:09', NULL),
(9, 'Giang', 'Nam', 'Hà Nam', '0886684444', '2022-07-13 15:36:55', '2022-07-13 15:36:55', NULL),
(10, 'Hoàng Yến', 'Nữ', 'Hà Nội', '0886684687', '2022-07-13 15:29:50', '2022-07-13 15:29:50', NULL),
(11, 'Tùng Lâm', 'Nam', 'Bắc Ninh', '0886684244', '2022-07-13 16:43:16', '2022-07-13 16:43:16', NULL),
(16, 'Tùng Lâm', 'Nam', 'Hà Nam', '0886674833', '2022-07-13 16:42:40', '2022-07-13 16:31:15', '2022-07-13 16:42:40'),
(17, 'Hoàng Yến', 'Nữ', 'Bắc Giang', '0886223789', '2022-07-13 16:44:10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `id` int(11) NOT NULL COMMENT 'mã thuốc',
  `id_grub_group` int(11) NOT NULL COMMENT 'mã nhóm thuốc',
  `drug_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'tên thuốc',
  `ingredient` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Thành phần',
  `uses` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'công dụng',
  `producer` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nhà sản xuất',
  `quantity` int(11) NOT NULL COMMENT 'số lượng',
  `price` decimal(10,0) NOT NULL COMMENT 'đơn giá thuốc',
  `unit` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Hộp' COMMENT 'đơn vị thuốc',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `drug_groups`
--

CREATE TABLE `drug_groups` (
  `id` int(11) NOT NULL COMMENT 'mã nhóm thuốc',
  `name_drug_group` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'tên nhóm thuốc',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ghi chú',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drug_groups`
--

INSERT INTO `drug_groups` (`id`, `name_drug_group`, `note`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Thuốc xương khớp', 'Chữa các bệnh về thoái hóa khớp, thoát vị đĩa đệm cột sống, đau thần kinh tọa, viêm khớp dạng thấp, bệnh gout, viêm điểm bám gân,loãng xương, bệnh cơ xương khớp do chấn thương.', '2022-07-13 16:49:38', '2022-07-13 15:43:26', '2022-07-13 16:49:38'),
(2, 'Thuốc giảm đau', 'Chữa bệnh đau đầu, sốt, cảm, đau răng, đau bụng kinh, cúm, viêm khớp,...', '2022-07-13 15:53:15', '2022-07-13 15:53:15', NULL),
(3, 'Thuốc xương khớp', 'Chữa các bệnh về thoái hóa khớp, thoát vị đĩa đệm cột sống, đau thần kinh tọa, viêm khớp dạng thấp, bệnh gout,,loãng xương...', '2022-07-13 16:49:26', '2022-07-13 15:55:56', NULL),
(5, 'Thuốc hạ sốt', NULL, '2022-07-13 16:48:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `export_bills`
--

CREATE TABLE `export_details` (
  `id` int(11) NOT NULL COMMENT 'mã chi tiết bán',
  `drug_id` int(11) NOT NULL COMMENT 'mã thuốc',
  `quantity_export` int(11) NOT NULL COMMENT 'số lượng xuất',
  `price_export` decimal(10,0) NOT NULL COMMENT 'đơn giá bán',
  `unit` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hộp' COMMENT 'đơn vị thuốc',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'ngày bán',
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `export_bills` (
  `id` int(11) NOT NULL COMMENT 'mã hóa đơn bán',
  `export_detail_id` int(11) NOT NULL COMMENT 'mã chi tiết bán',
  `user_id` int(11) NOT NULL COMMENT 'mã tài khoản',
  `customer_id` int(11) NOT NULL COMMENT 'mã khách hàng',
  `total_price` decimal(10,0) NOT NULL COMMENT 'tổng tiền',
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ghi chú thông tin bán ',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'ngày bán',
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `import_bills`
--


CREATE TABLE `import_details` (
  `id` int(11) NOT NULL COMMENT 'mã chi tiết nhập',
  `drug_id` int(11) NOT NULL COMMENT 'mã thuốc',
  `quantity_import` int(11) NOT NULL COMMENT 'số lượng nhập',
  `price_import` decimal(10,0) NOT NULL COMMENT 'đơn giá nhập',
  `unit` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hộp' COMMENT 'đơn vị thuốc',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'ngày nhập',
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `import_bills` (
  `id` int(11) NOT NULL COMMENT 'mã hóa đơn nhập',
  `import_detail_id` int(11) NOT NULL COMMENT 'mã chi tiết nhập',
  `supplier_id` int(11) NOT NULL COMMENT 'mã nhà cung cấp',
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ghi chú',
  `total_price` decimal(10,0) NOT NULL COMMENT 'tổng tiền nhập',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'ngày nhập',
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` tinyint(1) NOT NULL COMMENT 'Mã quyền hạn',
  `permission_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên quyền hạn',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', '2022-07-13 13:58:25', NULL, NULL),
(2, 'employee', '2022-07-13 13:58:25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL COMMENT 'mã nhà cung cấp',
  `supplier_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'tên nhà cung cấp',
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'địa chỉ',
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'số điện thoại nhà cung cấp',
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Email nhà cung cấp',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'mã tài khoản',
  `permission_id` tinyint(1) NOT NULL COMMENT 'Mã quyền hạn',
  `user_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'email đăng nhập',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Mật khẩu',
  `fullname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'họ tên người dùng',
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'địa chỉ',
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'số điện thoại',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_grub_group` (`id_grub_group`);

--
-- Indexes for table `drug_groups`
--
ALTER TABLE `drug_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `export_bills`
--

--
-- Indexes for table `import_bills`
--

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permission_name` (`permission_name`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supplier_name` (`supplier_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_email`),
  ADD KEY `permission_id` (`permission_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã khách hàng', AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã thuốc';

--
-- AUTO_INCREMENT for table `drug_groups`
--
ALTER TABLE `drug_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã nhóm thuốc', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `export_bills`
--

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT COMMENT 'Mã quyền hạn', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã nhà cung cấp';

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã tài khoản';

--
-- Constraints for dumped tables
--

--
-- Constraints for table `drugs`
--
ALTER TABLE `drugs`
  ADD CONSTRAINT `drugs_ibfk_1` FOREIGN KEY (`id_grub_group`) REFERENCES `drug_groups` (`id`);

--
-- Constraints for table `export_bills`
--

--
-- Constraints for table `import_bills`
--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
