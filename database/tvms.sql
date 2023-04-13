-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 29, 2023 lúc 04:27 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `traffic_violation_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `drivers_list`
--

CREATE TABLE `drivers_list` (
  `id` int(30) NOT NULL,
  `license_id_no` varchar(100) NOT NULL,
  `name` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = active, 2 = suspended, 3 = banned',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `drivers_list`
--

INSERT INTO `drivers_list` (`id`, `license_id_no`, `name`, `status`, `date_created`, `date_updated`) VALUES
(9, '09877776666333', 'Nguyễn Văn Alpha', 1, '2023-03-27 11:01:52', '2023-03-27 11:14:07'),
(10, '1234', 'Nguyễn Thị B', 1, '2023-03-28 13:29:10', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `drivers_meta`
--

CREATE TABLE `drivers_meta` (
  `driver_id` int(30) DEFAULT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `drivers_meta`
--

INSERT INTO `drivers_meta` (`driver_id`, `meta_field`, `meta_value`, `date_updated`) VALUES
(10, 'license_id_no', '1234', '2023-03-28 13:29:10'),
(10, 'name', 'Nguyễn Thị B', '2023-03-28 13:29:10'),
(10, 'dob', '1999-03-12', '2023-03-28 13:29:10'),
(10, 'permanent_address', 'Đà Nẵng', '2023-03-28 13:29:10'),
(10, 'nationality', 'Vietnam', '2023-03-28 13:29:10'),
(10, 'contact', '0999888777', '2023-03-28 13:29:10'),
(10, 'license_type', 'A1', '2023-03-28 13:29:10'),
(10, 'image_path', '', '2023-03-28 13:29:10'),
(10, 'driver_id', '10', '2023-03-28 13:29:10'),
(9, 'license_id_no', '09877776666333', '2023-03-28 13:30:14'),
(9, 'name', 'Nguyễn Văn Alpha', '2023-03-28 13:30:14'),
(9, 'dob', '1998-01-01', '2023-03-28 13:30:14'),
(9, 'permanent_address', 'Hải Châu, Đà Nẵng', '2023-03-28 13:30:14'),
(9, 'nationality', 'England', '2023-03-28 13:30:14'),
(9, 'contact', '0123776662', '2023-03-28 13:30:14'),
(9, 'license_type', 'A1', '2023-03-28 13:30:14'),
(9, 'image_path', 'uploads/drivers/9.jpg', '2023-03-28 13:30:14'),
(9, 'driver_id', '9', '2023-03-28 13:30:14'),
(9, 'image_path', 'uploads/drivers/9.jpg', '2023-03-28 13:30:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `violations`
--

CREATE TABLE `violations` (
  `id` int(30) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `fine` float NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=Inactive, 1=Active',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `violations`
--

INSERT INTO `violations` (`id`, `code`, `name`, `description`, `fine`, `status`, `date_created`, `date_updated`) VALUES
(1, 'OT-1001', 'Driving without License', 'This is a traffic violation for driving without License', 650, 1, '2021-08-19 09:14:43', '2021-08-19 09:17:50'),
(2, 'TO-1002', 'Running Over Speed Limit', '&lt;p&gt;Sample Traffic violation or violation for over speed limit.&lt;/p&gt;', 1000, 1, '2021-08-19 13:54:51', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `violation_items`
--

CREATE TABLE `violation_items` (
  `driver_violation_id` int(30) NOT NULL,
  `violation_id` int(30) DEFAULT NULL,
  `fine` float NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=paid',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `violation_items`
--

INSERT INTO `violation_items` (`driver_violation_id`, `violation_id`, `fine`, `status`, `date_created`) VALUES
(4, 1, 650, 0, '2023-03-27 12:03:00'),
(5, 1, 650, 1, '2023-03-28 14:48:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `violation_list`
--

CREATE TABLE `violation_list` (
  `id` int(30) NOT NULL,
  `driver_id` int(30) NOT NULL,
  `officer_name` text NOT NULL,
  `officer_id` text NOT NULL,
  `ticket_no` text NOT NULL,
  `total_amount` float NOT NULL,
  `remarks` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=paid',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `violation_list`
--

INSERT INTO `violation_list` (`id`, `driver_id`, `officer_name`, `officer_id`, `ticket_no`, `total_amount`, `remarks`, `status`, `date_created`, `date_updated`) VALUES
(4, 9, 'Nguyễn Vĩnh Duy', '0101', '11123322', 650, '', 0, '2023-03-27 12:03:00', NULL),
(5, 10, 'Nguyễn Vĩnh Duy', '1112', '9999999988', 650, 'k co', 1, '2023-03-28 14:48:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Hệ thống quản lý vi phạm giao thông thành phố'),
(6, 'short_name', 'TVMS'),
(11, 'logo', 'uploads/1629334140_traffic_light_logo.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/1629334140_traffic_bg.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Duy', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/1624240500_avatar.png', NULL, 1, '2021-01-20 14:02:37', '2023-03-28 15:21:10'),
(9, 'John', 'Smith', 'jsmith', '0192023a7bbd73250516f069df18b500', 'uploads/1629336240_avatar.jpg', NULL, 2, '2021-08-19 09:24:25', '2023-03-28 15:27:23'),
(16, 'Duy', 'taoladuy', 'taoladuy', '4213f655007ce3ef535043ab09f2ee06', NULL, NULL, 1, '2023-03-29 09:20:11', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `drivers_list`
--
ALTER TABLE `drivers_list`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `drivers_meta`
--
ALTER TABLE `drivers_meta`
  ADD KEY `driver_id` (`driver_id`);

--
-- Chỉ mục cho bảng `violations`
--
ALTER TABLE `violations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `violation_items`
--
ALTER TABLE `violation_items`
  ADD KEY `driver_violation_id` (`driver_violation_id`),
  ADD KEY `violation_id` (`violation_id`);

--
-- Chỉ mục cho bảng `violation_list`
--
ALTER TABLE `violation_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Chỉ mục cho bảng `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `drivers_list`
--
ALTER TABLE `drivers_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `violations`
--
ALTER TABLE `violations`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `violation_list`
--
ALTER TABLE `violation_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `drivers_meta`
--
ALTER TABLE `drivers_meta`
  ADD CONSTRAINT `drivers_meta_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `violation_items`
--
ALTER TABLE `violation_items`
  ADD CONSTRAINT `violation_items_ibfk_1` FOREIGN KEY (`driver_violation_id`) REFERENCES `violation_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `violation_items_ibfk_2` FOREIGN KEY (`violation_id`) REFERENCES `violations` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `violation_list`
--
ALTER TABLE `violation_list`
  ADD CONSTRAINT `violation_list_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
