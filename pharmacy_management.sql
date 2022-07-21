-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 12:54 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

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
(8, 'Hoàng Tùng', 'Nam', 'Bắc Ninh', '0887784033', '2022-07-15 01:53:26', '2022-07-15 01:53:26', NULL),
(9, 'Giang', 'Nam', 'Hà Nam', '0886684444', '2022-07-13 15:36:55', '2022-07-13 15:36:55', NULL),
(10, 'Hoàng Yến', 'Nữ', 'Hà Nội', '0886684687', '2022-07-14 12:00:52', '2022-07-13 15:29:50', '2022-07-14 12:00:52'),
(11, 'Tùng Lâm', 'Nam', 'Bắc Ninh', '0886684244', '2022-07-13 16:43:16', '2022-07-13 16:43:16', NULL),
(16, 'Tùng Lâm', 'Nam', 'Hà Nam', '0886674833', '2022-07-13 16:42:40', '2022-07-13 16:31:15', '2022-07-13 16:42:40'),
(17, 'Hoàng Yến', 'Nữ', 'Bắc Giang', '0886223789', '2022-07-13 16:44:10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `id` int(11) NOT NULL COMMENT 'mã thuốc',
  `id_drug_group` int(11) NOT NULL COMMENT 'mã nhóm thuốc',
  `drug_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'tên thuốc',
  `ingredient` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Thành phần',
  `uses` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'công dụng',
  `producer` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'nhà sản xuất',
  `quantity` int(11) DEFAULT 0 COMMENT 'số lượng',
  `price` decimal(10,0) NOT NULL COMMENT 'đơn giá thuốc',
  `unit` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Hộp' COMMENT 'đơn vị thuốc',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `id_drug_group`, `drug_name`, `ingredient`, `uses`, `producer`, `quantity`, `price`, `unit`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 3, 'sdfsdf', NULL, NULL, NULL, 250, '220000', 'Hộp', '2022-07-21 03:45:51', '2022-07-21 03:45:51', '2022-07-14 12:04:59'),
(6, 5, 'dgfdg', NULL, NULL, NULL, 250, '220000', 'Vỉ', '2022-07-21 03:45:51', '2022-07-21 03:45:51', '2022-07-14 12:04:33'),
(7, 5, 'xbc', NULL, NULL, NULL, 250, '220000', 'Vỉ', '2022-07-21 03:45:51', '2022-07-21 03:45:51', NULL),
(9, 6, 'Omega 3', NULL, NULL, NULL, -2930, '110000', 'Hộp', '2022-07-21 10:26:10', '2022-07-21 10:26:10', NULL),
(10, 5, 'Panactol extra', NULL, NULL, NULL, 300, '165000', 'Vỉ', '2022-07-21 04:15:40', '2022-07-21 04:15:40', NULL),
(11, 6, 'Omega 33', NULL, NULL, NULL, -3150, '220000', 'Lọ', '2022-07-21 10:26:10', '2022-07-21 10:26:10', NULL),
(12, 8, 'xbch', NULL, NULL, NULL, 330, '55000', 'Vỉ', '2022-07-21 09:52:15', '2022-07-21 09:52:15', NULL),
(13, 8, 'Omega 3333', NULL, NULL, NULL, 550, '220000', 'Vỉ', '2022-07-21 03:58:18', '2022-07-21 03:58:18', NULL),
(14, 6, 'Omega 33223', NULL, NULL, NULL, 250, '220000', 'Hộp', '2022-07-21 03:45:51', '2022-07-21 03:45:51', NULL);

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
(2, 'Thuốc giảm đau', NULL, '2022-07-20 03:34:53', '2022-07-20 03:34:53', NULL),
(3, 'Thuốc xương khớp', NULL, '2022-07-20 03:34:44', '2022-07-20 03:34:44', NULL),
(5, 'Thuốc hạ sốt', NULL, '2022-07-13 16:48:27', NULL, NULL),
(6, 'Thuốc bổ', NULL, '2022-07-14 02:57:38', NULL, NULL),
(7, 'Thực phẩm chức năng', NULL, '2022-07-14 10:50:35', NULL, '2022-07-14 10:50:35'),
(8, 'Thuốc an thần', NULL, '2022-07-20 03:35:00', '2022-07-20 03:35:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `export_bills`
--

CREATE TABLE `export_bills` (
  `id` int(11) NOT NULL COMMENT 'mã hóa đơn bán',
  `export_detail_id` int(11) NOT NULL COMMENT 'mã chi tiết bán',
  `user_id` int(11) NOT NULL COMMENT 'mã tài khoản',
  `customer_id` int(11) NOT NULL COMMENT 'mã khách hàng',
  `total_pay` decimal(10,0) NOT NULL COMMENT 'tổng tiền để thanh toán',
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ghi chú thông tin bán ',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'ngày bán',
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `export_details`
--

CREATE TABLE `export_details` (
  `id` int(11) NOT NULL COMMENT 'mã chi tiết bán',
  `drug_id` int(11) NOT NULL COMMENT 'mã thuốc',
  `quantity_export` int(11) NOT NULL COMMENT 'số lượng xuất',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 hiện, 0 ẩn',
  `total_price` decimal(10,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'ngày bán',
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `export_details`
--

INSERT INTO `export_details` (`id`, `drug_id`, `quantity_export`, `status`, `total_price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 9, 50, 1, '0', '2022-07-21 09:21:12', NULL, NULL),
(2, 11, 50, 1, '0', '2022-07-21 09:24:58', NULL, NULL),
(3, 7, 30, 1, '0', '2022-07-21 09:32:46', NULL, '2022-07-21 09:32:46'),
(4, 7, 30, 1, '0', '2022-07-21 10:34:21', NULL, NULL),
(5, 12, 30, 1, '0', '2022-07-21 10:46:11', NULL, NULL),
(6, 9, 40, 1, '0', '2022-07-21 10:50:06', NULL, NULL),
(7, 9, 40, 1, '0', '2022-07-21 10:52:22', NULL, NULL),
(8, 7, 3, 1, '0', '2022-07-21 10:53:10', NULL, NULL),
(9, 7, 3, 1, '0', '2022-07-21 10:53:36', NULL, NULL),
(10, 12, 4, 1, '0', '2022-07-21 10:53:45', NULL, NULL),
(11, 11, 4, 1, '0', '2022-07-21 10:54:14', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `import_details`
--

CREATE TABLE `import_details` (
  `id` int(11) NOT NULL COMMENT 'mã chi tiết nhập',
  `drug_id` int(11) NOT NULL COMMENT 'mã thuốc',
  `supplier_id` int(11) NOT NULL COMMENT 'mã nhà cung cấp',
  `quantity_import` int(11) NOT NULL COMMENT 'số lượng nhập',
  `price_import` decimal(10,0) NOT NULL COMMENT 'đơn giá nhập',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 chua import, 0 da import',
  `total_price` decimal(10,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'ngày nhập',
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `import_details`
--

INSERT INTO `import_details` (`id`, `drug_id`, `supplier_id`, `quantity_import`, `price_import`, `status`, `total_price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 9, 2, 50, '100000', 0, '0', '2022-07-21 09:51:45', NULL, '2022-07-21 09:51:45'),
(2, 13, 2, 100, '200000', 0, '0', '2022-07-21 09:51:50', '2022-07-20 02:11:58', '2022-07-21 09:51:50'),
(3, 7, 2, 500, '30000', 0, '0', '2022-07-20 10:34:47', NULL, '2022-07-20 02:12:59'),
(4, 10, 2, 50, '150000', 0, '0', '2022-07-21 09:51:40', NULL, '2022-07-21 09:51:40'),
(5, 12, 2, 50, '20000', 0, '0', '2022-07-21 09:51:34', NULL, '2022-07-21 09:51:34'),
(6, 9, 2, 20, '100000', 0, '2000000', '2022-07-21 09:51:27', NULL, NULL),
(7, 12, 2, 30, '50000', 0, '1500000', '2022-07-21 09:52:15', NULL, NULL);

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

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `address`, `phone`, `email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'tjuhjgj', 'Hà Nội', '0886694511', 'victi66g8@gmail.com', '2022-07-15 08:53:22', NULL, NULL);

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
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `permission_id`, `user_email`, `password`, `fullname`, `address`, `phone`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'admin@gmail.com', '$2y$10$dYh/X4NPubK7hyXJewvyQ.f.SbpvLj48U92vE2zf1RyRXRBzWT8U6', 'Phạm Tôn', 'Hà Nội', '0887784041', 'gHUdBaQni0IA7wP9XN5zMRWoXIk2bRQVkNemLpGnMfzWXdnOVg3O15ouUS5S', '2022-07-19 08:47:43', NULL, NULL),
(2, 2, 'nv1@gmail.com', '$2y$10$/qA/wlEV7y3uSriuq.HepORnQCgJ1FjqYKQDT68UMJPCS9dW.FCBO', 'Hoang anh', 'Cổ Nhuế, Bắc Từ Liêm, Hà Nội', '0886694511', 'zUpP6UqD4DdfA9bsaYl6v5N8CRAwN67Fq8wRdV3RzZo1xe4xIFRjpepAKOut', '2022-07-19 07:07:23', NULL, NULL),
(4, 2, 'nv02@gmail.com', '$2y$10$sWY1mVSutFcO7dDJ00rWde3oSIfCuKSfEkv.Ra8NF73ZPN5kBgBda', 'nguyen tu', 'Cổ Nhuế, Bắc Từ Liêm, Hà Nội', '0886694532', NULL, '2022-07-19 08:32:41', '2022-07-19 08:32:41', NULL);

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
  ADD KEY `id_drug_group` (`id_drug_group`) USING BTREE;

--
-- Indexes for table `drug_groups`
--
ALTER TABLE `drug_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `export_bills`
--
ALTER TABLE `export_bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `export_detail_id` (`export_detail_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `export_details`
--
ALTER TABLE `export_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `drug_id` (`drug_id`);

--
-- Indexes for table `import_details`
--
ALTER TABLE `import_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `drug_id` (`drug_id`),
  ADD KEY `supplier_id` (`supplier_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã thuốc', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `drug_groups`
--
ALTER TABLE `drug_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã nhóm thuốc', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `export_bills`
--
ALTER TABLE `export_bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã hóa đơn bán';

--
-- AUTO_INCREMENT for table `export_details`
--
ALTER TABLE `export_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã chi tiết bán', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `import_details`
--
ALTER TABLE `import_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã chi tiết nhập', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT COMMENT 'Mã quyền hạn', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã nhà cung cấp', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã tài khoản', AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `drugs`
--
ALTER TABLE `drugs`
  ADD CONSTRAINT `drugs_ibfk_1` FOREIGN KEY (`id_drug_group`) REFERENCES `drug_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `export_bills`
--
ALTER TABLE `export_bills`
  ADD CONSTRAINT `export_bills_ibfk_1` FOREIGN KEY (`export_detail_id`) REFERENCES `export_details` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `export_bills_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `export_bills_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `export_details`
--
ALTER TABLE `export_details`
  ADD CONSTRAINT `export_details_ibfk_1` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `import_details`
--
ALTER TABLE `import_details`
  ADD CONSTRAINT `import_details_ibfk_1` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `import_details_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
