-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th5 04, 2025 lúc 03:59 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ttsk`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `excerpt` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `slug`, `content`, `excerpt`, `image`, `category_id`, `author_id`, `published_at`, `created_at`, `updated_at`) VALUES
(1, '5 Mẹo Tổ Chức Sự Kiện Công Ty Thành Công', '5-meo-to-chuc-su-kien-cong-ty-thanh-cong', '<p>Tổ chức sự kiện công ty đòi hỏi kế hoạch tỉ mỉ. Dưới đây là 5 mẹo: 1. Xác định mục tiêu rõ ràng, 2. Lựa chọn địa điểm phù hợp, 3. Lập ngân sách hợp lý, 4. Tập trung vào trải nghiệm khách mời, 5. Đánh giá và theo dõi sau sự kiện.</p>', 'Bài viết hướng dẫn 5 mẹo quan trọng để tổ chức sự kiện công ty thành công', 'blogs/1744441706_damcuoi1.jpg', 2, 1, '2024-12-18 13:53:10', '2025-04-12 05:30:46', '2025-04-12 00:08:26'),
(2, 'Hướng Dẫn Chi Tiết Lập Kế Hoạch Đám Cưới', 'huong-dan-chi-tiet-lap-ke-hoach-dam-cuoi', '<p>Lập kế hoạch đám cưới có thể gây căng thẳng. Hướng dẫn này bao gồm mọi thứ bạn cần biết, từ việc chọn địa điểm, lập danh sách khách mời, đến lựa chọn dịch vụ ăn uống phù hợp.</p>', 'Hướng dẫn chi tiết từng bước để lập kế hoạch đám cưới hoàn hảo', 'blogs/1744441724_damcuoi1.jpg', 1, 5, '2024-12-18 13:53:10', '2025-04-12 05:30:46', '2025-04-12 00:08:44'),
(3, 'Xu Hướng Tổ Chức Sự Kiện Nổi Bật 2024', 'xu-huong-to-chuc-su-kien-noi-bat-2024', '<p>Xu hướng tổ chức sự kiện năm 2024 tập trung vào tính bền vững, trải nghiệm nhập vai và thiết lập sự kiện kết hợp. Tìm hiểu cách các xu hướng này làm nổi bật sự kiện của bạn.</p>', 'Khám phá các xu hướng mới nhất trong tổ chức sự kiện năm 2024', 'blogs/1744441264_dung-luong-banner-thoi-trang.jpg', 3, 2, '2024-12-18 13:53:10', '2025-04-12 05:30:46', '2025-04-12 00:01:04'),
(5, '10 Xu Hướng Trang Trí Tiệc Cưới Nổi Bật Năm 2024', '10-xu-huong-trang-tri-tiec-cuoi-noi-bat-nam-2024', '<p>Năm 2024 mang đến nhiều xu hướng trang trí tiệc cưới mới lạ và độc đáo. Từ phong cách tối giản đến những thiết kế cầu kỳ, các cặp đôi có nhiều lựa chọn để tạo nên một đám cưới đáng nhớ.</p>', 'Khám phá những xu hướng trang trí tiệc cưới mới nhất năm 2024, từ phong cách tối giản đến những thiết kế cầu kỳ.', 'blogs/1744442162_damcuoi2.jpg', 1, NULL, NULL, '2025-04-11 22:38:01', '2025-04-12 00:16:02'),
(6, 'Bí Quyết Lựa Chọn Địa Điểm Tổ Chức Tiệc Cưới Hoàn Hảo', 'bi-quyet-lua-chon-dia-diem-to-chuc-tiec-cuoi-hoan-hao', '<p>Việc lựa chọn địa điểm tổ chức tiệc cưới là một trong những quyết định quan trọng nhất trong quá trình lên kế hoạch đám cưới. Bài viết này sẽ giúp bạn tìm ra địa điểm phù hợp nhất với phong cách và ngân sách của mình.</p>', 'Hướng dẫn chi tiết về cách lựa chọn địa điểm tổ chức tiệc cưới phù hợp với phong cách và ngân sách của bạn.', 'blogs/1744442175_damcuoi3.jpg', 1, NULL, NULL, '2025-04-11 22:38:01', '2025-04-12 00:16:15'),
(8, 'ĐÁM CƯỚI', 'dam-cuoi', '<p>ĐÁM CƯỚI&nbsp;</p>', 'ĐÁM CƯỚI', 'blogs/1744645305_damcuoi3.jpg', 3, NULL, NULL, '2025-04-14 08:41:45', '2025-04-14 08:41:45'),
(9, 'SỰ KIỆN LỄ HỘI', 'su-kien-le-hoi', '<p>SỰ KIỆN LỄ HỘI</p>', 'SỰ KIỆN LỄ HỘI', 'blogs/1745138878_damcuoi1.jpg', 5, NULL, NULL, '2025-04-20 01:47:58', '2025-04-20 01:47:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking_requests`
--

CREATE TABLE `booking_requests` (
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `equipment_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','approved','rejected','returned') NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `booking_requests`
--

INSERT INTO `booking_requests` (`booking_id`, `user_id`, `equipment_id`, `start_date`, `end_date`, `quantity`, `total_price`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(4, 7, 2, '2025-04-13 00:00:00', '2025-04-14 00:00:00', 1, 300000.00, 'rejected', NULL, '2025-04-13 05:21:16', '2025-04-16 07:32:00'),
(6, 7, 3, '2025-04-15 00:00:00', '2025-04-16 00:00:00', 2, 800000.00, 'returned', NULL, '2025-04-14 08:29:24', '2025-04-19 00:25:27'),
(7, 7, 1, '2025-04-19 00:00:00', '2025-04-22 00:00:00', 2, 3000000.00, 'pending', NULL, '2025-04-19 00:09:35', '2025-04-19 00:09:35'),
(8, 7, 1, '2025-04-20 00:00:00', '2025-04-22 00:00:00', 1, 1000000.00, 'returned', NULL, '2025-04-20 01:42:10', '2025-04-20 01:44:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Tiệc cưới', 'tiec-cuoi', 'Các bài viết về tổ chức tiệc cưới', NULL, '2025-04-12 05:30:46', '2025-04-12 05:30:46'),
(2, 'Tiệc công ty', 'tiec-cong-ty', 'Các bài viết về tổ chức tiệc công ty', NULL, '2025-04-12 05:30:46', '2025-04-12 05:30:46'),
(3, 'Sự kiện đặc biệt', 'su-kien-dac-biet', 'Các bài viết về tổ chức sự kiện đặc biệt', NULL, '2025-04-12 05:30:46', '2025-04-12 05:30:46'),
(4, 'test danh muc', 'test-danh-muc', 'tesst', NULL, '2025-04-11 23:42:09', '2025-04-11 23:42:18'),
(5, 'Sự Kiện Lễ Hội', 'su-kien-le-hoi', 'Sự Kiện Lễ Hội', NULL, '2025-04-13 05:31:09', '2025-04-13 05:31:09'),
(6, 'Lễ Khai Trương', 'le-khai-truong', NULL, NULL, '2025-04-13 05:31:19', '2025-04-13 05:31:19'),
(7, 'TEST', 'test', '123', NULL, '2025-04-14 08:31:16', '2025-04-14 08:31:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact_requests`
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
-- Đang đổ dữ liệu cho bảng `contact_requests`
--

INSERT INTO `contact_requests` (`request_id`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
(2, 'Đỗ Đăng Khoa', 'dodangkhoa@gmail.com', '0366898984', 'Tôi cần hỗ trợ đặt lịch sự kiện vào tháng sau.', '2024-12-18 13:58:01'),
(4, 'TEST2', 'test@gmail.com', '0395004764', 'abcbdahhfa', '2025-04-20 15:59:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `equipment`
--

CREATE TABLE `equipment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `status` enum('available','rented','maintenance') NOT NULL DEFAULT 'available',
  `equipment_type_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `equipment`
--

INSERT INTO `equipment` (`id`, `name`, `description`, `image`, `price`, `quantity`, `status`, `equipment_type_id`, `created_at`, `updated_at`) VALUES
(1, 'Loa JBL EON 615', '<p>Loa công suất cao, công suất 1000W, phù hợp cho sự kiện ngoài trời</p>', 'equipment/AYKNEs2Abm1oqMBNkILeUM6ua4GvrIRNWvvOGTAL.jpg', 500000.00, 4, 'available', 1, '2025-04-12 01:39:26', '2025-04-20 01:44:08'),
(2, 'Mixer âm thanh Yamaha MG10XU', '<p>Mixer 10 kênh, tích hợp hiệu ứng, phù hợp cho sự kiện vừa và nhỏ</p>', 'equipment/Y8kyx1AStegQQndJd6XUAXRcWOjlhWzfgXofu1n7.jpg', 300000.00, 2, 'available', 1, '2025-04-12 01:39:26', '2025-04-12 01:49:19'),
(3, 'Micro không dây Shure BLX288', '<p>Bộ micro không dây 2 cái, tần số UHF, phù hợp cho MC và ca sĩ</p>', 'equipment/MLMHDdAk4s0jp4G2xAMbTGzf1b0dWvosWszOvUr1.jpg', 400000.00, 3, 'available', 1, '2025-04-12 01:39:26', '2025-04-19 00:25:27'),
(4, 'Đèn LED Par 64 RGB', '<p>Đèn LED Par 64, điều khiển DMX, hiệu ứng đa màu</p>', 'equipment/0M2XfQ2amRYgRKQXun0FesL7hdOzErsCEWABVL0h.jpg', 200000.00, 8, 'available', 2, '2025-04-12 01:39:26', '2025-04-12 02:03:06'),
(5, 'Đèn Moving Head 230W', '<p>Đèn Moving Head công suất 230W, điều khiển DMX, hiệu ứng đa dạng</p>', 'equipment/s6sjdJUuljvDDQf9u12LPRn8PtrYxn53SGm8qb1g.jpg', 600000.00, 4, 'available', 2, '2025-04-12 01:39:26', '2025-04-20 01:55:41'),
(6, 'Đèn Laser RGB', 'Đèn Laser RGB, điều khiển DMX, hiệu ứng laser đa màu', 'equipment/laser-rgb.jpg', 350000.00, 2, 'maintenance', 2, '2025-04-12 01:39:26', '2025-04-12 01:39:26'),
(7, 'Bàn tròn 1.2m', 'Bàn tròn đường kính 1.2m, phù hợp cho 8-10 người', 'equipment/table-1.2m.jpg', 150000.00, 20, 'available', 3, '2025-04-12 01:39:26', '2025-04-12 01:39:26'),
(8, 'Ghế gấp cao cấp', 'Ghế gấp cao cấp, chịu lực tốt, dễ dàng vận chuyển', 'equipment/folding-chair.jpg', 50000.00, 200, 'available', 3, '2025-04-12 01:39:26', '2025-04-12 01:39:26'),
(9, 'Nhà bạt 5x10m', 'Nhà bạt kích thước 5x10m, chống nắng mưa tốt', 'equipment/tent-5x10.jpg', 1000000.00, 5, 'available', 4, '2025-04-12 01:39:26', '2025-04-12 01:39:26'),
(10, 'Bóng bay trang trí', 'Bộ bóng bay trang trí đa màu, kèm bơm hơi', 'equipment/decoration-balloons.jpg', 200000.00, 10, 'available', 5, '2025-04-12 01:39:26', '2025-04-12 01:39:26'),
(11, 'TEST', '<p>abc</p>', 'equipment/HXdZkMiMsbgFfIQPW3KO4AIHCA52U9cFiDP0qGdU.jpg', 642.00, 2, 'available', 2, '2025-04-14 09:08:39', '2025-04-14 09:08:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `equipment_category`
--

CREATE TABLE `equipment_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `equipment_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `equipment_category`
--

INSERT INTO `equipment_category` (`id`, `equipment_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 4, 2, NULL, NULL),
(2, 4, 3, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 3, 2, NULL, NULL),
(5, 3, 3, NULL, NULL),
(6, 2, 1, NULL, NULL),
(7, 2, 2, NULL, NULL),
(8, 2, 3, NULL, NULL),
(9, 1, 1, NULL, NULL),
(10, 1, 3, NULL, NULL),
(11, 1, 5, NULL, NULL),
(12, 1, 6, NULL, NULL),
(13, 11, 2, NULL, NULL),
(14, 11, 3, NULL, NULL),
(15, 11, 4, NULL, NULL),
(16, 5, 1, NULL, NULL),
(17, 5, 2, NULL, NULL),
(18, 5, 3, NULL, NULL),
(19, 5, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `equipment_types`
--

CREATE TABLE `equipment_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `equipment_type_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `equipment_types`
--

INSERT INTO `equipment_types` (`id`, `equipment_type_name`, `created_at`, `updated_at`) VALUES
(1, 'Thiết bị âm thanh', '2025-04-12 01:35:53', '2025-04-12 01:35:53'),
(2, 'Thiết bị ánh sáng', '2025-04-12 01:35:53', '2025-04-12 01:35:53'),
(3, 'Bàn ghế', '2025-04-12 01:35:53', '2025-04-12 01:35:53'),
(4, 'Nhà bạt, không gian trưng bày', '2025-04-12 01:35:53', '2025-04-12 01:35:53'),
(5, 'Dụng cụ trang trí', '2025-04-12 01:35:53', '2025-04-12 01:35:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `faq`
--

CREATE TABLE `faq` (
  `faq_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `faq`
--

INSERT INTO `faq` (`faq_id`, `question`, `answer`, `created_at`) VALUES
(1, 'Quy trình đặt lịch sự kiện như thế nào?', 'Bạn có thể đặt lịch sự kiện bằng cách điền vào biểu mẫu đặt lịch trực tuyến hoặc liên hệ trực tiếp với chúng tôi qua điện thoại hoặc email.', '2024-12-18 13:47:17'),
(2, 'Trung tâm có cung cấp dịch vụ ăn uống không?', 'Có, chúng tôi cung cấp nhiều gói dịch vụ ăn uống phù hợp với nhu cầu sự kiện của bạn.', '2024-12-18 13:47:17'),
(3, 'Tôi có thể tùy chỉnh trang trí sự kiện không?', 'Hoàn toàn có thể! Chúng tôi cung cấp các gói trang trí tùy chỉnh theo sở thích của bạn.', '2024-12-18 13:47:17'),
(4, 'Trung tâm chấp nhận các phương thức thanh toán nào?', 'Chúng tôi chấp nhận chuyển khoản ngân hàng, thanh toán bằng thẻ tín dụng/thẻ ghi nợ và tiền mặt.', '2024-12-18 13:47:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gallery`
--

CREATE TABLE `gallery` (
  `media_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `media_type` enum('image','video') NOT NULL,
  `media_url` varchar(255) NOT NULL,
  `uploaded_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `gallery`
--

INSERT INTO `gallery` (`media_id`, `event_id`, `media_type`, `media_url`, `uploaded_at`) VALUES
(1, 2, 'image', 'https://th.bing.com/th/id/R.692810cb258be5edd7b1b6a5891d756c?rik=sB4DpVsvl6t3OA&pid=ImgRaw&r=0', '2024-12-18 11:55:33'),
(2, 4, 'video', 'https://youtu.be/2WqBAc4klKY', '2024-12-18 11:55:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2023_04_30_000001_add_status_to_contact_requests_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `details` text DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `group` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`, `created_at`, `updated_at`) VALUES
(1, 'site.title', 'Site Title', 'SuKien Thuy Cai', '', 'text', 1, 'Site', NULL, NULL),
(2, 'site.description', 'Site Description', 'Website tổ chức sự kiện chuyên nghiệp', '', 'text', 2, 'Site', NULL, NULL),
(3, 'site.logo', 'Site Logo', '', '', 'image', 3, 'Site', NULL, NULL),
(4, 'admin.bg_image', 'Admin Background Image', '', '', 'image', 4, 'Admin', NULL, NULL),
(5, 'admin.title', 'Admin Title', 'SuKien Thuy Cai', '', 'text', 5, 'Admin', NULL, NULL),
(6, 'admin.description', 'Admin Description', 'Welcome to SuKien Thuy Cai Admin Panel', '', 'text', 6, 'Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `staff`
--

INSERT INTO `staff` (`id`, `name`, `category`, `quantity`, `price`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Múa Lân', NULL, 2, 1000000.00, 'staff/1744814978.jpg', 'Múa Lân', '2025-04-16 07:49:38', '2025-04-16 07:49:38'),
(2, 'MC', NULL, 10, 500000.00, 'staff/1744815070.png', 'MC', '2025-04-16 07:51:10', '2025-04-16 07:51:10'),
(3, 'Người dẫn chương trình', NULL, 10, 1000000.00, 'staff/1744815154.jpg', 'Người dẫn chương trình', '2025-04-16 07:52:34', '2025-04-16 07:52:34'),
(4, 'Đội nhảy', NULL, 5, 1000000.00, 'staff/1744815428.jpg', 'Đội nhảy', '2025-04-16 07:57:08', '2025-04-16 07:57:08'),
(5, 'Ca Sĩ', NULL, 10, 2000000.00, 'staff/1744815477.jpg', NULL, '2025-04-16 07:57:57', '2025-04-16 07:57:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `staff_rentals`
--

CREATE TABLE `staff_rentals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rental_date` date NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_price` decimal(10,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `staff_rentals`
--

INSERT INTO `staff_rentals` (`id`, `staff_id`, `user_id`, `rental_date`, `quantity`, `total_price`, `notes`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 7, '2025-04-18', 1, 1000000.00, 'abc', 'approved', '2025-04-16 08:50:39', '2025-04-18 23:55:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `testimonials`
--

CREATE TABLE `testimonials` (
  `testimonial_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `testimonials`
--

INSERT INTO `testimonials` (`testimonial_id`, `user_id`, `content`, `rating`, `created_at`) VALUES
(1, 3, 'Tốt', 4, '2024-12-18 13:38:57'),
(2, 4, 'Chưa tốt', 2, '2024-12-18 13:38:57'),
(3, 5, 'Tuyệt', 5, '2024-12-18 13:38:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
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
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `phone`, `role`, `created_at`) VALUES
(1, 'Nguyễn Thanh Diệp', '$2y$10$xBt4ZCI4uKqAOf7Z6prVy.UjArXStQC2O8GutfDCpuP.NNEm/elKa', 'nguyenthanhdiep@gmail.com', '0966208562', 'customer', '2024-12-18 11:00:32'),
(2, 'Nguyễn Hữu Hoàng', 'nguyenhuuhoang123@', 'nguyenhuuhoanggmail.com', '0366898984', 'admin', '2024-12-02 11:00:32'),
(3, 'Hoàng Văn Hiệu', 'hoangvanhieu123@', 'hoangvanhieu@gmail.com', '0348177100', 'customer', '2024-12-17 11:00:32'),
(4, 'Dương Quang Huy', 'duongquanghuy123@', 'duongquanghuy@gmail.com', '0889364685', 'customer', '2024-12-18 11:06:35'),
(5, 'Ánh', '$2y$10$YAy2zw6fSzyngz2vUYFloeYGBzWxR4j1TzZaVQOtlZa5.yHsp4fHe', 'lethingocanh@gmail.com', '0987683271', 'customer', '2024-12-18 11:06:35'),
(6, 'Admin', '$2y$10$jolwV2NI1M5RMGJUqtBLM.al0pR7lTYu.65OsntGdLzcvqCUFQUau', 'admin@admin.com', '0966208562', 'admin', '2025-04-12 13:00:10'),
(7, 'test', '$2y$10$jolwV2NI1M5RMGJUqtBLM.al0pR7lTYu.65OsntGdLzcvqCUFQUau', 'test@gmail.com', '0395004764', 'customer', '2025-04-13 16:47:59');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Chỉ mục cho bảng `booking_requests`
--
ALTER TABLE `booking_requests`
  ADD PRIMARY KEY (`booking_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Chỉ mục cho bảng `contact_requests`
--
ALTER TABLE `contact_requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Chỉ mục cho bảng `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `equipment_category`
--
ALTER TABLE `equipment_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_category_equipment_id_foreign` (`equipment_id`);

--
-- Chỉ mục cho bảng `equipment_types`
--
ALTER TABLE `equipment_types`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Chỉ mục cho bảng `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Chỉ mục cho bảng `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `staff_rentals`
--
ALTER TABLE `staff_rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_rentals_staff_id_foreign` (`staff_id`);

--
-- Chỉ mục cho bảng `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`testimonial_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `booking_requests`
--
ALTER TABLE `booking_requests`
  MODIFY `booking_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `contact_requests`
--
ALTER TABLE `contact_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `equipment_category`
--
ALTER TABLE `equipment_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `equipment_types`
--
ALTER TABLE `equipment_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `faq`
--
ALTER TABLE `faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `gallery`
--
ALTER TABLE `gallery`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `staff_rentals`
--
ALTER TABLE `staff_rentals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `testimonial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blogs_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `equipment_category`
--
ALTER TABLE `equipment_category`
  ADD CONSTRAINT `equipment_category_equipment_id_foreign` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `staff_rentals`
--
ALTER TABLE `staff_rentals`
  ADD CONSTRAINT `staff_rentals_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
