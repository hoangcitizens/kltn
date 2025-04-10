-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 08:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website_ttsk`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `published_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog_id`, `title`, `content`, `author_id`, `published_at`) VALUES
(1, '5 Mẹo Tổ Chức Sự Kiện Công Ty Thành Công', 'Tổ chức sự kiện công ty đòi hỏi kế hoạch tỉ mỉ. Dưới đây là 5 mẹo: \r\n1. Xác định mục tiêu rõ ràng, \r\n2. Lựa chọn địa điểm phù hợp, \r\n3. Lập ngân sách hợp lý, \r\n4. Tập trung vào trải nghiệm khách mời,\r\n5. Đánh giá và theo dõi sau sự kiện.', 1, '2024-12-18 13:53:10'),
(2, 'Hướng Dẫn Chi Tiết Lập Kế Hoạch Đám Cưới', 'Lập kế hoạch đám cưới có thể gây căng thẳng. Hướng dẫn này bao gồm mọi thứ bạn cần biết, từ việc chọn địa điểm, lập danh sách khách mời, đến lựa chọn dịch vụ ăn uống phù hợp.', 5, '2024-12-18 13:53:10'),
(3, 'Xu Hướng Tổ Chức Sự Kiện Nổi Bật 2024', 'Xu hướng tổ chức sự kiện năm 2024 tập trung vào tính bền vững, trải nghiệm nhập vai và thiết lập sự kiện kết hợp. Tìm hiểu cách các xu hướng này làm nổi bật sự kiện của bạn.', 2, '2024-12-18 13:53:10'),
(4, 'Tại Sao Ánh Sáng Quan Trọng Trong Thiết Kế Sự Kiện', 'Ánh sáng là yếu tố quan trọng tạo nên bầu không khí cho sự kiện. Khám phá các kỹ thuật ánh sáng khác nhau và cách chúng nâng cao thiết kế sự kiện.', 1, '2024-12-18 13:53:10');

-- --------------------------------------------------------

--
-- Table structure for table `booking_requests`
--

CREATE TABLE `booking_requests` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `attendee_count` int(11) DEFAULT NULL,
  `additional_services` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_requests`
--

INSERT INTO `booking_requests` (`booking_id`, `user_id`, `event_name`, `event_date`, `attendee_count`, `additional_services`, `status`, `created_at`) VALUES
(1, 3, '	Hội nghị khách hàng 2024', '2024-12-25', 300, 'MC chuyên nghiệp, Âm thanh và ánh sáng', 'pending', '2024-12-18 14:07:40'),
(2, 5, 'Lễ kỷ niệm 10 năm ra trường', '2024-12-20', 40, 'Trang trí sân khấu, Quay phim và chụp hình.', 'approved', '2024-12-18 14:07:40'),
(3, 4, 'Gala Dinner cuối năm 2024', '2024-12-30', 150, 'Quay phim sự kiện, MC, Tiệc buffet', 'rejected', '2024-12-18 14:07:40');

-- --------------------------------------------------------

--
-- Table structure for table `contact_requests`
--

CREATE TABLE `contact_requests` (
  `request_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_requests`
--

INSERT INTO `contact_requests` (`request_id`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
(1, 'Nguyễn Thị Trà My', 'nguyenthitramy@gmail.com', '0384424232', 'Tôi muốn biết thêm về các dịch vụ tổ chức sự kiện công ty.', '2024-12-18 13:58:01'),
(2, 'Đỗ Đăng Khoa', 'dodangkhoa@gmail.com', '0366898984', 'Tôi cần hỗ trợ đặt lịch sự kiện vào tháng sau.', '2024-12-18 13:58:01');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `attendee_count` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` enum('pending','confirmed','completed','canceled') DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_date`, `attendee_count`, `user_id`, `status`, `created_at`) VALUES
(1, 'Tiệc cưới', '2024-12-19', 300, 5, 'confirmed', '2024-12-18 11:11:34'),
(2, 'Tiệc sinh nhật', '2024-12-31', 50, 4, 'pending', '2024-12-18 11:11:34'),
(3, 'Tiệc liên hoan cuối năm', '2024-12-29', 500, 2, 'confirmed', '2024-12-18 11:11:34'),
(4, 'Tiệc cưới', '2024-12-19', 300, 5, 'canceled', '2024-12-18 11:11:34'),
(5, 'Tiệc tất niên', '2024-12-28', 25, 3, 'pending', '2024-12-18 11:11:34');

-- --------------------------------------------------------

--
-- Table structure for table `event_services`
--

CREATE TABLE `event_services` (
  `event_service_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_services`
--

INSERT INTO `event_services` (`event_service_id`, `event_id`, `service_id`, `quantity`, `total_price`) VALUES
(1, 1, 6, 1, 5000.00),
(2, 2, 5, 1, 3000.00),
(3, 3, 3, 1, 12000.00),
(4, 4, 4, 1, 6000.00),
(5, 5, 4, 1, 75000.00);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faq_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`faq_id`, `question`, `answer`, `created_at`) VALUES
(1, 'Quy trình đặt lịch sự kiện như thế nào?', 'Bạn có thể đặt lịch sự kiện bằng cách điền vào biểu mẫu đặt lịch trực tuyến hoặc liên hệ trực tiếp với chúng tôi qua điện thoại hoặc email.', '2024-12-18 13:47:17'),
(2, 'Trung tâm có cung cấp dịch vụ ăn uống không?', 'Có, chúng tôi cung cấp nhiều gói dịch vụ ăn uống phù hợp với nhu cầu sự kiện của bạn.', '2024-12-18 13:47:17'),
(3, 'Tôi có thể tùy chỉnh trang trí sự kiện không?', 'Hoàn toàn có thể! Chúng tôi cung cấp các gói trang trí tùy chỉnh theo sở thích của bạn.', '2024-12-18 13:47:17'),
(4, 'Trung tâm chấp nhận các phương thức thanh toán nào?', 'Chúng tôi chấp nhận chuyển khoản ngân hàng, thanh toán bằng thẻ tín dụng/thẻ ghi nợ và tiền mặt.', '2024-12-18 13:47:17');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `media_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `media_type` enum('image','video') NOT NULL,
  `media_url` varchar(255) NOT NULL,
  `uploaded_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`media_id`, `event_id`, `media_type`, `media_url`, `uploaded_at`) VALUES
(1, 2, 'image', 'https://th.bing.com/th/id/R.692810cb258be5edd7b1b6a5891d756c?rik=sB4DpVsvl6t3OA&pid=ImgRaw&r=0', '2024-12-18 11:55:33'),
(2, 4, 'video', 'https://youtu.be/2WqBAc4klKY', '2024-12-18 11:55:33');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `description`, `price`, `created_at`) VALUES
(1, 'Cho thuê hệ thống âm thanh', 'Hệ thống âm thanh chất lượng cao cho các sự kiện.', 500000.00, '2024-12-18 11:42:21'),
(2, 'Cho thuê hệ thống ánh sáng', 'Thiết lập ánh sáng chuyên nghiệp cho mọi sự kiện. ', 300000.00, '2024-12-18 11:42:21'),
(3, 'Trang trí sân khấu', 'Trang trí sân khấu theo mọi phong cách và có thể tùy chỉnh.', 1200000.00, '2024-12-18 11:42:21'),
(4, 'Dịch vụ dùng bữa', 'Đồ ăn và đồ uống đảm bảo chất lượng, độ tươi ngon và sự đa dạng, phong phú.', 2500000.00, '2024-12-18 11:42:21'),
(5, 'Dịch vụ quay video, chụp ảnh', 'Ghi lại những khoảnh khắc đáng nhớ cho khách hàng với sự chuyên nghiệp và thân thiện.', 900000.00, '2024-12-18 11:42:21'),
(6, 'Dịch vụ MC', 'Người dẫn dắt chương trình chuyên nghiệp và cuốn hút.', 1000000.00, '2024-12-18 11:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `testimonial_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`testimonial_id`, `user_id`, `content`, `rating`, `created_at`) VALUES
(1, 3, 'Tốt', 4, '2024-12-18 13:38:57'),
(2, 4, 'Chưa tốt', 2, '2024-12-18 13:38:57'),
(3, 5, 'Tuyệt', 5, '2024-12-18 13:38:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `role` enum('customer','admin') DEFAULT 'customer',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `phone`, `role`, `created_at`) VALUES
(1, 'Nguyễn Thanh Diệp', 'nguyenthanhdiep123@', 'nguyenthanhdiep@gmail.com', '0966208562', 'admin', '2024-12-18 11:00:32'),
(2, 'Nguyễn Hữu Hoàng', 'nguyenhuuhoang123@', 'nguyenhuuhoanggmail.com', '0366898984', 'admin', '2024-12-02 11:00:32'),
(3, 'Hoàng Văn Hiệu', 'hoangvanhieu123@', 'hoangvanhieu@gmail.com', '0348177100', 'customer', '2024-12-17 11:00:32'),
(4, 'Dương Quang Huy', 'duongquanghuy123@', 'duongquanghuy@gmail.com', '0889364685', 'customer', '2024-12-18 11:06:35'),
(5, 'Lê Thị Ngọc Ánh', 'lethingocanh123@', 'lethingocanh@gmail.com', '0987683271', 'customer', '2024-12-18 11:06:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `booking_requests`
--
ALTER TABLE `booking_requests`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact_requests`
--
ALTER TABLE `contact_requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `event_services`
--
ALTER TABLE `event_services`
  ADD PRIMARY KEY (`event_service_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`testimonial_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `booking_requests`
--
ALTER TABLE `booking_requests`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_requests`
--
ALTER TABLE `contact_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event_services`
--
ALTER TABLE `event_services`
  MODIFY `event_service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `testimonial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `booking_requests`
--
ALTER TABLE `booking_requests`
  ADD CONSTRAINT `booking_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `event_services`
--
ALTER TABLE `event_services`
  ADD CONSTRAINT `event_services_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`),
  ADD CONSTRAINT `event_services_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`);

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);

--
-- Constraints for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD CONSTRAINT `testimonials_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
