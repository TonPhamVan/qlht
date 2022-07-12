-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2022 at 10:25 AM
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
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'mã khách hàng',
  `customer_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'tên khách hàng',
  `gender` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
('KH01', 'Hoàng Tùng', 'Nam', 'Hà Nội', '0886674187', '2022-07-12 07:48:09', '2022-07-12 07:48:09', NULL),
('KH02', 'Nguyễn Tú', 'Nam', 'Hà Nội', '0887784045', '2022-07-12 04:51:23', NULL, NULL),
('KH03', 'Nguyễn Thị Ly', 'Nữ', 'Hà Nội', '0886694532', '2022-07-12 03:23:23', '2022-07-12 03:23:23', NULL),
('KH04', 'Lê Huyền', 'Nữ', 'Hà Nội', '0886696222', '2022-07-12 08:25:05', '2022-07-12 08:25:05', NULL),
('KH05', 'Lê Hà', 'Nữ', 'Hà Nội', '0886693333', '2022-07-12 08:14:50', '2022-07-12 08:14:50', NULL),
('KH10', 'Nguyễn Yến', 'Nữ', 'Hà Nội', '0887784022', '2022-07-12 07:44:07', NULL, NULL),
('KH44', 'Hoàng Công', 'Nam', 'Hà Nội', '0886694552', '2022-07-12 03:14:28', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'mã thuốc',
  `index_grub_group` int(20) NOT NULL COMMENT 'mã nhóm thuốc',
  `drug_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'tên thuốc',
  `ingredient` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Thành phần',
  `uses` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'công dụng',
  `producer` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nhà sản xuất',
  `date_production` date NOT NULL COMMENT 'ngày sản xuất thuốc',
  `date_expiration` date NOT NULL COMMENT 'hạn sử dụng của thuốc',
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
  `index` int(20) NOT NULL COMMENT 'mã nhóm thuốc',
  `name_drug_group` varchar(50) NOT NULL COMMENT 'tên nhóm thuốc',
  `note` varchar(255) DEFAULT NULL COMMENT 'ghi chú'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `export_bills`
--

CREATE TABLE `export_bills` (
  `index` int(20) NOT NULL COMMENT 'mã hóa đơn bán',
  `drug_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'mã thuốc',
  `user_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'mã tài khoản',
  `customer_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'mã khách hàng',
  `quantity` int(20) NOT NULL COMMENT 'số lượng',
  `price` decimal(10,0) NOT NULL COMMENT 'đơn giá bán',
  `unit` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hộp' COMMENT 'đơn vị thuốc',
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

CREATE TABLE `import_bills` (
  `index` int(20) NOT NULL COMMENT 'mã hóa đơn nhập',
  `drug_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'mã thuốc',
  `supplier_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'mã nhà cung cấp',
  `quantity` int(20) NOT NULL COMMENT 'số lượng',
  `price` decimal(10,0) NOT NULL COMMENT 'đơn giá nhập',
  `unit` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hộp' COMMENT 'đơn vị thuốc',
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ghi chú',
  `total_price` decimal(10,0) NOT NULL COMMENT 'tổng tiền',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'ngày nhập',
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `index` tinyint(1) NOT NULL COMMENT 'Mã quyền hạn',
  `permission_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên quyền hạn',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `suppliers` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'mã nhà cung cấp',
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
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Mã tài khoản',
  `permission_index` tinyint(1) NOT NULL COMMENT 'Mã quyền hạn',
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
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_grub_group` (`index_grub_group`);

--
-- Indexes for table `drug_groups`
--
ALTER TABLE `drug_groups`
  ADD PRIMARY KEY (`index`),
  ADD UNIQUE KEY `name_drug_group` (`name_drug_group`);

--
-- Indexes for table `export_bills`
--
ALTER TABLE `export_bills`
  ADD PRIMARY KEY (`index`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `drug_id` (`drug_id`);

--
-- Indexes for table `import_bills`
--
ALTER TABLE `import_bills`
  ADD PRIMARY KEY (`index`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `drug_id` (`drug_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`index`),
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
  ADD KEY `permission_index` (`permission_index`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drug_groups`
--
ALTER TABLE `drug_groups`
  MODIFY `index` int(20) NOT NULL AUTO_INCREMENT COMMENT 'mã nhóm thuốc';

--
-- AUTO_INCREMENT for table `export_bills`
--
ALTER TABLE `export_bills`
  MODIFY `index` int(20) NOT NULL AUTO_INCREMENT COMMENT 'mã hóa đơn bán';

--
-- AUTO_INCREMENT for table `import_bills`
--
ALTER TABLE `import_bills`
  MODIFY `index` int(20) NOT NULL AUTO_INCREMENT COMMENT 'mã hóa đơn nhập';

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `index` tinyint(1) NOT NULL AUTO_INCREMENT COMMENT 'Mã quyền hạn', AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `drugs`
--
ALTER TABLE `drugs`
  ADD CONSTRAINT `drugs_ibfk_1` FOREIGN KEY (`index_grub_group`) REFERENCES `drug_groups` (`index`);

--
-- Constraints for table `export_bills`
--
ALTER TABLE `export_bills`
  ADD CONSTRAINT `export_bills_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `export_bills_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `export_bills_ibfk_3` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`);

--
-- Constraints for table `import_bills`
--
ALTER TABLE `import_bills`
  ADD CONSTRAINT `import_bills_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`),
  ADD CONSTRAINT `import_bills_ibfk_2` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`permission_index`) REFERENCES `permissions` (`index`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
