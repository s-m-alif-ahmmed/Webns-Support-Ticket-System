-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2024 at 01:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_ticketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `industry_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `image` text DEFAULT NULL,
  `web_slug` text DEFAULT NULL,
  `company_code` varchar(255) DEFAULT NULL,
  `company_slug` varchar(255) DEFAULT NULL,
  `company_prefix` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `industry_id`, `user_id`, `update_user_id`, `name`, `image`, `web_slug`, `company_code`, `company_slug`, `company_prefix`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'UniMed UniHealth', 'admin/images/company/14187UniMed_UniHealth_Pharmaceuticals_Ltd_webns_technology_ltd.png', 'UniMed_UniHealth_Pharmaceuticals_Ltd_webns_technology_ltd', 'U5PoJvVwBAeqdMg', 'unimed-unihealth', 'unimed-unihealth', 'Published', '2024-08-27 08:51:07', '2024-08-27 08:51:07');

-- --------------------------------------------------------

--
-- Table structure for table `company_ticket_assigns`
--

CREATE TABLE `company_ticket_assigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `create_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `update_company_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assign_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `work_role` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'On',
  `assign_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_users`
--

CREATE TABLE `company_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `update_company_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` varchar(255) NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `designation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `permission` longtext DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `ban_status` int(11) NOT NULL DEFAULT 1,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_users`
--

INSERT INTO `company_users` (`id`, `user_id`, `update_user_id`, `company_user_id`, `update_company_user_id`, `employee_id`, `company_id`, `sub_company_id`, `location_id`, `department_id`, `designation_id`, `name`, `email`, `email_verified_at`, `photo`, `number`, `gender`, `role`, `permission`, `status`, `ban_status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, 'Test-001', 1, 1, 1, 1, 1, 'Test', 'test@unigroup-bd.com', NULL, 'admin/images/company_user/11556avatar-659652_640.webp', '0000000000000', 'Male', 'Admin', '{\"user_profile_user\":{\"profile_setting_user\":\"profile_setting_user\",\"profile_edit_user\":\"profile_edit_user\",\"profile_email_user\":\"profile_email_user\",\"profile_phone_user\":\"profile_phone_user\",\"profile_number_user\":\"profile_number_user\",\"profile_role_user\":\"profile_role_user\",\"profile_department_designation_user\":\"profile_department_designation_user\"},\"company_users_all_user\":{\"company_user_manage_user\":\"company_user_manage_user\",\"company_user_detail_user\":\"company_user_detail_user\",\"company_user_create_user\":\"company_user_create_user\",\"company_user_edit_user\":\"company_user_edit_user\",\"company_user_create_info_user\":\"company_user_create_info_user\",\"company_user_update_info_user\":\"company_user_update_info_user\",\"company_user_change_password_user\":\"company_user_change_password_user\",\"company_user_permission_user\":\"company_user_permission_user\",\"company_user_department_designation_user\":\"company_user_department_designation_user\",\"company_user_email_edit_user\":\"company_user_email_edit_user\",\"company_user_employee_id_edit_user\":\"company_user_employee_id_edit_user\",\"company_user_role_edit_user\":\"company_user_role_edit_user\",\"company_user_delete_user\":\"company_user_delete_user\"},\"company_users_tickets\":{\"manage_tickets\":\"manage_tickets\",\"ticket_detail\":\"ticket_detail\",\"ticket_create\":\"ticket_create\",\"assign_user_add\":\"assign_user_add\",\"assign_user_view\":\"assign_user_view\",\"assign_user_edit\":\"assign_user_edit\",\"assign_user_remove\":\"assign_user_remove\",\"message_view\":\"message_view\"}}', 'Active', 1, '123456789', NULL, '2024-08-27 09:41:47', '2024-08-27 09:42:25'),
(2, NULL, NULL, 1, NULL, 'Test01', 1, 1, 1, 1, 1, 'Test01', 'test01@unigroup-bd.com', NULL, 'admin/images/company_user/14849default-avatar-photo-female-vector.jpg', '0000000001', 'Female', 'Employee', '{\"user_profile_user\":{\"profile_edit_user\":\"profile_edit_user\",\"profile_phone_user\":\"profile_phone_user\"},\"company_users_tickets\":{\"manage_tickets\":\"manage_tickets\",\"ticket_detail\":\"ticket_detail\",\"ticket_create\":\"ticket_create\",\"assign_user_view\":\"assign_user_view\",\"message_view\":\"message_view\"}}', 'Active', 1, '123456789', NULL, '2024-08-27 10:03:27', '2024-08-27 10:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `create_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `department_slug` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `sub_company_id`, `location_id`, `create_user_id`, `update_user_id`, `name`, `department_slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, 'IT', 'it', 'Published', '2024-08-27 09:22:30', '2024-08-27 09:22:30');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `create_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `designation_slug` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `sub_company_id`, `location_id`, `department_id`, `create_user_id`, `update_user_id`, `name`, `designation_slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, NULL, 'Admin', 'admin', 'Published', '2024-08-27 09:37:47', '2024-08-27 09:37:47');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `industries`
--

CREATE TABLE `industries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `prefix` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `industries`
--

INSERT INTO `industries` (`id`, `user_id`, `update_user_id`, `name`, `slug`, `prefix`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Pharmaceutical', 'pharmaceutical', 'pharmaceutical', 'Published', '2024-08-27 08:48:59', '2024-09-09 15:03:22'),
(2, 1, NULL, 'Agro', 'agro', 'agro', 'Published', '2024-09-01 07:24:57', '2024-09-01 07:24:57'),
(3, 1, NULL, 'Hospital', 'hospital', 'hospital', 'Published', '2024-09-01 07:25:35', '2024-09-01 07:25:35'),
(4, 1, NULL, 'Diagnostic', 'diagnostic', 'diagnostic', 'Published', '2024-09-01 07:26:07', '2024-09-01 07:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `industry_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `location` text NOT NULL,
  `branch_code` varchar(255) NOT NULL,
  `location_code` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `industry_id`, `company_id`, `sub_company_id`, `user_id`, `update_user_id`, `location`, `branch_code`, `location_code`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, NULL, 'House# 660, Washpur, Post Office# Shyamlapur\r\nKeraniganj, Dhaka 1310, Bangladesh', 'UMUH-HQ', 'JueVqoBxche2PYF', 'Published', '2024-08-27 08:56:38', '2024-08-27 08:56:38');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `create_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message` text DEFAULT NULL,
  `attachment` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_07_18_091150_create_company_users_table', 1),
(5, '2024_07_28_051112_create_industries_table', 2),
(6, '2024_07_28_081128_create_companies_table', 3),
(7, '2024_07_29_044816_create_sub_companies_table', 4),
(8, '2024_07_29_081320_create_locations_table', 5),
(9, '2024_07_30_053314_create_departments_table', 6),
(10, '2024_07_30_085454_create_designations_table', 7),
(11, '2024_08_08_081636_create_modules_table', 8),
(12, '2024_08_08_095951_create_sub_modules_table', 9),
(13, '2024_08_11_033437_create_ticket_natures_table', 10),
(14, '2024_08_11_044000_create_tickets_table', 11),
(15, '2024_08_14_094946_create_ticket_asigns_table', 12),
(16, '2024_08_14_094946_create_ticket_assigns_table', 13),
(17, '2024_08_18_042407_create_messages_table', 14),
(18, '2024_08_22_032828_create_company_ticket_assigns_table', 15),
(19, '2024_09_12_041535_create_notifications_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `module_code` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `module_slug` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `user_id`, `update_user_id`, `name`, `module_code`, `description`, `module_slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Steps ERP', 'WT-StepsERP', NULL, 'steps-erp', 'Published', '2024-08-27 09:46:43', '2024-08-27 09:46:43');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('152a1c2f-cec1-4cf4-a655-5d3219ee7658', 'App\\Notifications\\TicketStatusChangeNotification', 'App\\Models\\User', 1, '{\"ticket_id\":17,\"ticket_title\":null,\"old_status\":\"Open\",\"status\":\"Open\",\"message\":\"A ticket has been closed.Ticket ID: #5.\"}', NULL, '2024-09-12 04:37:27', '2024-09-12 04:37:27'),
('202ce17a-59bc-4c70-8787-4f3cb4174324', 'App\\Notifications\\TicketStatusChangeNotification', 'App\\Models\\User', 2, '{\"ticket_id\":4,\"ticket_title\":null,\"old_status\":\"Open\",\"status\":\"Open\",\"message\":\"A ticket has been closed.Ticket ID: #4.\"}', NULL, '2024-09-12 04:36:56', '2024-09-12 04:36:56'),
('263ca558-4f59-4273-bfdc-893d5fe8529b', 'App\\Notifications\\TicketStatusChangeNotification', 'App\\Models\\User', 2, '{\"ticket_id\":4,\"ticket_title\":null,\"old_status\":\"Closed\",\"status\":\"Closed\",\"message\":\"The Ticket ID: #4 has been closed.\"}', NULL, '2024-09-12 04:43:04', '2024-09-12 04:43:04'),
('3bce0b7b-f74a-4f5b-8693-b56988707adb', 'App\\Notifications\\TicketStatusChangeNotification', 'App\\Models\\User', 2, '{\"ticket_id\":4,\"ticket_title\":null,\"old_status\":\"Closed\",\"status\":\"Closed\",\"message\":\"The Ticket ID: #4 has been closed.\"}', NULL, '2024-09-12 04:36:22', '2024-09-12 04:36:22'),
('9e53f904-c8ed-424f-af2d-abac3a0a25a9', 'App\\Notifications\\TicketStatusChangeNotification', 'App\\Models\\User', 1, '{\"ticket_id\":17,\"ticket_title\":null,\"old_status\":\"Open\",\"status\":\"Closed\",\"message\":\"The Ticket ID: #5 has been closed.\"}', NULL, '2024-09-12 04:23:56', '2024-09-12 04:23:56'),
('b7008919-4a28-49f7-a50e-8dbe606e8769', 'App\\Notifications\\TicketStatusChangeNotification', 'App\\Models\\User', 1, '{\"ticket_id\":17,\"ticket_title\":null,\"old_status\":\"Closed\",\"status\":\"Closed\",\"message\":\"The Ticket ID: #5 has been closed.\"}', NULL, '2024-09-12 04:41:05', '2024-09-12 04:41:05'),
('ce07d2cb-a45e-4b7a-a798-dead7bbe6280', 'App\\Notifications\\TicketStatusChangeNotification', 'App\\Models\\User', 1, '{\"ticket_id\":17,\"ticket_title\":null,\"old_status\":\"Closed\",\"status\":\"Closed\",\"message\":\"The Ticket ID: #5 has been closed.\"}', NULL, '2024-09-12 04:37:08', '2024-09-12 04:37:08'),
('f7cb1ec5-13f1-4c69-8041-fa0aee800cfa', 'App\\Notifications\\TicketStatusChangeNotification', 'App\\Models\\User', 1, '{\"ticket_id\":17,\"ticket_title\":null,\"old_status\":\"Closed\",\"status\":\"Open\",\"message\":\"A ticket has been closed.Ticket ID: #5.\"}', NULL, '2024-09-12 04:24:58', '2024-09-12 04:24:58');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('gW3NzxHCAHfgEjFXlMo4JKWKjz7KzHvwbOWfldDo', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiT3JKTm5VNzZqQllXQXBvMFhBRWVOVDdERXJKR3ZLOFBlenQySTJuaiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jaGFuZ2UtdGlja2V0LWFkbWluLXN0YXR1cy8zIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1726137792);

-- --------------------------------------------------------

--
-- Table structure for table `sub_companies`
--

CREATE TABLE `sub_companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `industry_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `image` text DEFAULT NULL,
  `web_slug` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `sister_concern` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `sub_company_code` varchar(255) DEFAULT NULL,
  `sub_company_slug` varchar(255) DEFAULT NULL,
  `sub_company_prefix` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_companies`
--

INSERT INTO `sub_companies` (`id`, `industry_id`, `company_id`, `user_id`, `update_user_id`, `name`, `image`, `web_slug`, `email`, `number`, `sister_concern`, `branch`, `sub_company_code`, `sub_company_slug`, `sub_company_prefix`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 'UniMed UniHealth - Head Office', 'admin/images/sub_company/14012UniMed_UniHealth_Pharmaceuticals_Ltd_webns_technology_ltd.png', 'https://unimedunihealth.com/', 'info@unigroup-bd.com', '+8801929993999', 'No', 'No', 'cCI25CveE4fJf3g', 'unimed-unihealth-head-office', 'unimed-unihealth-head-office', 'Published', '2024-08-27 08:54:36', '2024-08-27 09:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `sub_modules`
--

CREATE TABLE `sub_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `module_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sub_module_code` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sub_module_slug` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_modules`
--

INSERT INTO `sub_modules` (`id`, `user_id`, `update_user_id`, `module_id`, `name`, `sub_module_code`, `description`, `sub_module_slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '1', 'Steps HRMS', 'WT-StepsERP-001', NULL, 'steps-hrms', 'Published', '2024-08-27 09:47:40', '2024-08-27 09:47:40');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `create_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `update_company_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `module_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_module_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ticket_nature_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `attachment` longtext DEFAULT NULL,
  `priority` varchar(255) DEFAULT NULL,
  `operation_end_time` varchar(255) DEFAULT NULL,
  `operation_status` varchar(255) NOT NULL DEFAULT 'Open',
  `read_status` varchar(255) DEFAULT 'UnRead',
  `status` varchar(255) NOT NULL DEFAULT 'Open',
  `end_time` varchar(255) DEFAULT NULL,
  `ticket_code` varchar(255) DEFAULT NULL,
  `ticket_slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `create_user_id`, `update_user_id`, `company_user_id`, `update_company_user_id`, `company_id`, `sub_company_id`, `location_id`, `module_id`, `sub_module_id`, `ticket_nature_id`, `subject`, `description`, `attachment`, `priority`, `operation_end_time`, `operation_status`, `read_status`, `status`, `end_time`, `ticket_code`, `ticket_slug`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 1, NULL, 1, 1, 1, 1, 1, 1, 'Test', 'Test', 'admin/images/tickets/attachments/16720Default.jpg', 'High', '2024-08-27 06:14:58', 'Closed', 'UnRead', 'Closed', '2024-08-27 06:18:32', '1', 'test', '2024-08-27 09:49:16', '2024-09-11 04:46:17'),
(2, NULL, NULL, 2, NULL, 1, 1, 1, 1, 1, 1, 'test 01', 'test 01', NULL, 'Normal', NULL, 'Open', 'UnRead', 'Closed', '2024-09-12 10:29:13', '2', 'test-01-191925', '2024-08-27 10:21:17', '2024-09-12 04:29:13'),
(3, NULL, NULL, 2, NULL, 1, 1, 1, 1, 1, 1, 'test03', 'test03', NULL, 'Normal', '2024-08-27 06:42:21', 'Closed', 'UnRead', 'Closed', '2024-09-12 10:43:12', '3', 'test03-116651', '2024-08-27 10:30:31', '2024-09-12 04:43:12'),
(4, 2, NULL, NULL, NULL, 1, 1, 1, 1, 1, 1, 'Test', 'Test', NULL, 'High', NULL, 'Open', 'UnRead', 'Closed', '2024-09-12 10:43:04', '4', 'test-36935', '2024-08-28 12:34:27', '2024-09-12 04:43:04'),
(17, 1, NULL, NULL, NULL, 1, 1, 1, 1, 1, 1, 'fdssfsfs fds dsfds', 'dsfdsf sfdsf sf', NULL, 'Medium', NULL, 'Open', 'UnRead', 'Closed', '2024-09-12 10:41:05', '5', 'fdssfsfs-fds-dsfds-40219', '2024-09-12 03:59:51', '2024-09-12 04:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_assigns`
--

CREATE TABLE `ticket_assigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `create_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assign_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `work_role` varchar(255) DEFAULT NULL,
  `approx_end_time` datetime DEFAULT NULL,
  `updated_approx_end_time` datetime DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'On',
  `assign_status` varchar(255) DEFAULT 'Pending',
  `work_end_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_natures`
--

CREATE TABLE `ticket_natures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `update_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `ticket_nature_slug` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_natures`
--

INSERT INTO `ticket_natures` (`id`, `user_id`, `update_user_id`, `name`, `ticket_nature_slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Operational Error', 'operational-error', 'Published', '2024-08-27 09:48:28', '2024-08-27 09:48:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `permission` longtext DEFAULT NULL,
  `ban_status` int(11) NOT NULL DEFAULT 1,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `employee_id`, `department`, `designation`, `name`, `email`, `email_verified_at`, `photo`, `number`, `gender`, `role`, `permission`, `ban_status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'WT0003', 'dep xdffs', 'dfkdsjfkdsjfs', 'WEBNS Technology Ltd.', 'superadmin@webnstech.net', NULL, 'admin/save_images/profile_photo/fav icon-01.jpg', '+8801900000000', 'Male', 'Super Admin', '{\"users_all\":{\"employ_manage\":\"employ_manage\",\"employ_detail\":\"employ_detail\",\"employ_create\":\"employ_create\",\"employ_edit\":\"employ_edit\",\"employ_permission\":\"employ_permission\",\"employ_show_password\":\"employ_show_password\",\"employ_password\":\"employ_password\",\"employ_restriction\":\"employ_restriction\",\"employ_delete\":\"employ_delete\"},\"user_profile\":{\"show_password\":\"show_password\",\"change_password\":\"change_password\",\"profile_edit\":\"profile_edit\",\"profile_email\":\"profile_email\",\"profile_phone\":\"profile_phone\",\"profile_number\":\"profile_number\",\"profile_role\":\"profile_role\",\"profile_department_designation\":\"profile_department_designation\"},\"company_everything_all\":{\"industry_all\":{\"industry_manage\":\"industry_manage\",\"industry_detail\":\"industry_detail\",\"industry_create\":\"industry_create\",\"industry_edit\":\"industry_edit\",\"industry_create_info\":\"industry_create_info\",\"industry_update_info\":\"industry_update_info\",\"industry_status\":\"industry_status\",\"industry_delete\":\"industry_delete\"},\"company_all\":{\"company_manage\":\"company_manage\",\"company_detail\":\"company_detail\",\"company_create\":\"company_create\",\"company_edit\":\"company_edit\",\"company_code\":\"company_code\",\"company_create_info\":\"company_create_info\",\"company_update_info\":\"company_update_info\",\"company_status\":\"company_status\",\"company_delete\":\"company_delete\"},\"sub_company_all\":{\"sub_company_manage\":\"sub_company_manage\",\"sub_company_detail\":\"sub_company_detail\",\"sub_company_create\":\"sub_company_create\",\"sub_company_edit\":\"sub_company_edit\",\"sub_company_code\":\"sub_company_code\",\"sub_company_create_info\":\"sub_company_create_info\",\"sub_company_update_info\":\"sub_company_update_info\",\"sub_company_status\":\"sub_company_status\",\"sub_company_delete\":\"sub_company_delete\"},\"location_all\":{\"location_manage\":\"location_manage\",\"location_detail\":\"location_detail\",\"location_create\":\"location_create\",\"location_edit\":\"location_edit\",\"location_create_info\":\"location_create_info\",\"location_update_info\":\"location_update_info\",\"location_status\":\"location_status\",\"location_delete\":\"location_delete\"}},\"company_users_all\":{\"department_all\":{\"department_manage\":\"department_manage\",\"department_detail\":\"department_detail\",\"department_create\":\"department_create\",\"department_edit\":\"department_edit\",\"department_create_info\":\"department_create_info\",\"department_update_info\":\"department_update_info\",\"department_status\":\"department_status\",\"department_delete\":\"department_delete\"},\"designation_all\":{\"designation_manage\":\"designation_manage\",\"designation_detail\":\"designation_detail\",\"designation_create\":\"designation_create\",\"designation_edit\":\"designation_edit\",\"designation_create_info\":\"designation_create_info\",\"designation_update_info\":\"designation_update_info\",\"designation_status\":\"designation_status\",\"designation_delete\":\"designation_delete\"},\"company_all_user\":{\"company_user_manage\":\"company_user_manage\",\"company_user_detail\":\"company_user_detail\",\"company_user_create\":\"company_user_create\",\"company_user_edit\":\"company_user_edit\",\"company_user_create_info\":\"company_user_create_info\",\"company_user_update_info\":\"company_user_update_info\",\"company_user_show_password\":\"company_user_show_password\",\"company_user_change_password\":\"company_user_change_password\",\"company_user_permission\":\"company_user_permission\",\"company_user_delete\":\"company_user_delete\"}},\"ticket_helpers_all\":{\"module_all\":{\"module_manage\":\"module_manage\",\"module_detail\":\"module_detail\",\"module_create\":\"module_create\",\"module_edit\":\"module_edit\",\"module_create_info\":\"module_create_info\",\"module_update_info\":\"module_update_info\",\"module_status\":\"module_status\",\"module_delete\":\"module_delete\"},\"sub_module_all\":{\"sub_module_manage\":\"sub_module_manage\",\"sub_module_detail\":\"sub_module_detail\",\"sub_module_create\":\"sub_module_create\",\"sub_module_edit\":\"sub_module_edit\",\"sub_module_create_info\":\"sub_module_create_info\",\"sub_module_update_info\":\"sub_module_update_info\",\"sub_module_status\":\"sub_module_status\",\"sub_module_delete\":\"sub_module_delete\"},\"ticket_nature_all\":{\"ticket_nature_manage\":\"ticket_nature_manage\",\"ticket_nature_detail\":\"ticket_nature_detail\",\"ticket_nature_create\":\"ticket_nature_create\",\"ticket_nature_edit\":\"ticket_nature_edit\",\"ticket_nature_create_info\":\"ticket_nature_create_info\",\"ticket_nature_update_info\":\"ticket_nature_update_info\",\"ticket_nature_status\":\"ticket_nature_status\",\"ticket_nature_delete\":\"ticket_nature_delete\"}},\"tickets_all\":{\"tickets\":{\"ticket_manage\":\"ticket_manage\",\"ticket_view\":\"ticket_view\",\"ticket_detail\":\"ticket_detail\",\"ticket_create\":\"ticket_create\",\"ticket_edit\":\"ticket_edit\",\"ticket_create_info\":\"ticket_create_info\",\"ticket_update_info\":\"ticket_update_info\",\"ticket_status\":\"ticket_status\",\"ticket_delete\":\"ticket_delete\"},\"assign_all\":{\"assign_manage\":\"assign_manage\",\"assign_view\":\"assign_view\",\"assign_detail\":\"assign_detail\",\"assign_create\":\"assign_create\",\"assign_edit\":\"assign_edit\",\"assign_create_info\":\"assign_create_info\",\"assign_update_info\":\"assign_update_info\",\"assign_work_status\":\"assign_work_status\",\"assign_status\":\"assign_status\",\"assign_delete\":\"assign_delete\"},\"company_user_assign_all\":{\"company_user_assign_manage\":\"company_user_assign_manage\",\"company_user_assign_view\":\"company_user_assign_view\",\"company_user_assign_detail\":\"company_user_assign_detail\",\"company_user_assign_create\":\"company_user_assign_create\",\"company_user_assign_edit\":\"company_user_assign_edit\",\"company_user_assign_create_info\":\"company_user_assign_create_info\",\"company_user_assign_update_info\":\"company_user_assign_update_info\",\"company_user_assign_work_status\":\"company_user_assign_work_status\",\"company_user_assign_status\":\"company_user_assign_status\",\"company_user_assign_delete\":\"company_user_assign_delete\"},\"messages_all\":{\"message_manage\":\"message_manage\",\"message_view\":\"message_view\",\"message_detail\":\"message_detail\",\"message_create\":\"message_create\",\"message_edit\":\"message_edit\",\"message_create_info\":\"message_create_info\",\"message_update_info\":\"message_update_info\",\"message_status\":\"message_status\",\"message_delete\":\"message_delete\"}}}', 1, 'superadmin@webnstech.net', 'JmsUWCkeisbonYc9qva6D4QmTnOj93Lw8djcUp89QvfZelsSMGEvySGXIFkO', '2024-07-18 04:42:35', '2024-08-27 10:37:48'),
(2, 1, 'WT0024', 'Technical', 'Operation Head', 'Kashif Ayub', 'kashif@webnstech.net', NULL, 'admin/save_images/profile_photo/WhatsApp Image 2024-08-27 at 3.58.52 PM.jpeg', '+8801988000805', 'Male', 'Admin', '{\"user_profile\":{\"profile_setting\":\"profile_setting\",\"profile_edit\":\"profile_edit\",\"profile_phone\":\"profile_phone\"},\"company_everything_all\":{\"industry_all\":{\"industry_manage\":\"industry_manage\",\"industry_detail\":\"industry_detail\",\"industry_create\":\"industry_create\",\"industry_edit\":\"industry_edit\",\"industry_create_info\":\"industry_create_info\",\"industry_update_info\":\"industry_update_info\"},\"company_all\":{\"company_manage\":\"company_manage\",\"company_detail\":\"company_detail\",\"company_create\":\"company_create\",\"company_edit\":\"company_edit\",\"company_code\":\"company_code\",\"company_create_info\":\"company_create_info\",\"company_update_info\":\"company_update_info\"},\"sub_company_all\":{\"sub_company_manage\":\"sub_company_manage\",\"sub_company_detail\":\"sub_company_detail\",\"sub_company_create\":\"sub_company_create\",\"sub_company_edit\":\"sub_company_edit\",\"sub_company_code\":\"sub_company_code\",\"sub_company_create_info\":\"sub_company_create_info\",\"sub_company_update_info\":\"sub_company_update_info\"},\"location_all\":{\"location_manage\":\"location_manage\",\"location_detail\":\"location_detail\",\"location_create\":\"location_create\",\"location_edit\":\"location_edit\",\"location_create_info\":\"location_create_info\",\"location_update_info\":\"location_update_info\"}},\"company_users_all\":{\"department_all\":{\"department_manage\":\"department_manage\",\"department_detail\":\"department_detail\",\"department_create\":\"department_create\",\"department_edit\":\"department_edit\",\"department_create_info\":\"department_create_info\",\"department_update_info\":\"department_update_info\"},\"designation_all\":{\"designation_manage\":\"designation_manage\",\"designation_detail\":\"designation_detail\",\"designation_create\":\"designation_create\",\"designation_edit\":\"designation_edit\",\"designation_create_info\":\"designation_create_info\",\"designation_update_info\":\"designation_update_info\"},\"company_all_user\":{\"company_user_manage\":\"company_user_manage\",\"company_user_detail\":\"company_user_detail\",\"company_user_create\":\"company_user_create\",\"company_user_edit\":\"company_user_edit\",\"company_user_create_info\":\"company_user_create_info\",\"company_user_update_info\":\"company_user_update_info\",\"company_user_change_password\":\"company_user_change_password\",\"company_user_permission\":\"company_user_permission\"}},\"ticket_helpers_all\":{\"module_all\":{\"module_manage\":\"module_manage\",\"module_detail\":\"module_detail\",\"module_create\":\"module_create\",\"module_edit\":\"module_edit\",\"module_create_info\":\"module_create_info\",\"module_update_info\":\"module_update_info\"},\"sub_module_all\":{\"sub_module_manage\":\"sub_module_manage\",\"sub_module_detail\":\"sub_module_detail\",\"sub_module_create\":\"sub_module_create\",\"sub_module_edit\":\"sub_module_edit\",\"sub_module_create_info\":\"sub_module_create_info\",\"sub_module_update_info\":\"sub_module_update_info\"},\"ticket_nature_all\":{\"ticket_nature_manage\":\"ticket_nature_manage\",\"ticket_nature_detail\":\"ticket_nature_detail\",\"ticket_nature_create\":\"ticket_nature_create\",\"ticket_nature_edit\":\"ticket_nature_edit\",\"ticket_nature_create_info\":\"ticket_nature_create_info\",\"ticket_nature_update_info\":\"ticket_nature_update_info\"}},\"tickets_all\":{\"tickets\":{\"ticket_manage\":\"ticket_manage\",\"ticket_view\":\"ticket_view\",\"ticket_detail\":\"ticket_detail\",\"ticket_create\":\"ticket_create\",\"ticket_create_info\":\"ticket_create_info\",\"ticket_update_info\":\"ticket_update_info\"},\"assign_all\":{\"assign_manage\":\"assign_manage\",\"assign_view\":\"assign_view\",\"assign_detail\":\"assign_detail\",\"assign_create\":\"assign_create\",\"assign_edit\":\"assign_edit\",\"assign_create_info\":\"assign_create_info\",\"assign_update_info\":\"assign_update_info\",\"assign_work_status\":\"assign_work_status\",\"assign_status\":\"assign_status\",\"assign_delete\":\"assign_delete\"},\"messages_all\":{\"message_manage\":\"message_manage\",\"message_view\":\"message_view\",\"message_detail\":\"message_detail\",\"message_create\":\"message_create\",\"message_edit\":\"message_edit\",\"message_create_info\":\"message_create_info\",\"message_update_info\":\"message_update_info\"}}}', 1, '123456789', NULL, '2024-08-27 13:56:51', '2024-08-28 12:48:55'),
(3, 1, 'WT0050', 'Technical', 'Analyst Programmer', 'MD. Asaduzzaman', 'asaduzzaman@webnstech.net', NULL, 'admin/save_images/profile_photo/Asaduzzaman.jpg', '+8801900000000', 'Male', 'Editor', '{\"user_profile\":{\"profile_setting\":\"profile_setting\",\"profile_edit\":\"profile_edit\",\"profile_phone\":\"profile_phone\"},\"company_everything_all\":{\"industry_all\":{\"industry_manage\":\"industry_manage\",\"industry_detail\":\"industry_detail\"},\"company_all\":{\"company_manage\":\"company_manage\",\"company_detail\":\"company_detail\"},\"sub_company_all\":{\"sub_company_manage\":\"sub_company_manage\",\"sub_company_detail\":\"sub_company_detail\"},\"location_all\":{\"location_manage\":\"location_manage\",\"location_detail\":\"location_detail\"}},\"company_users_all\":{\"department_all\":{\"department_manage\":\"department_manage\",\"department_detail\":\"department_detail\"},\"designation_all\":{\"designation_manage\":\"designation_manage\",\"designation_detail\":\"designation_detail\"},\"company_all_user\":{\"company_user_manage\":\"company_user_manage\",\"company_user_detail\":\"company_user_detail\"}},\"ticket_helpers_all\":{\"module_all\":{\"module_manage\":\"module_manage\",\"module_detail\":\"module_detail\"},\"sub_module_all\":{\"sub_module_manage\":\"sub_module_manage\",\"sub_module_detail\":\"sub_module_detail\"},\"ticket_nature_all\":{\"ticket_nature_manage\":\"ticket_nature_manage\",\"ticket_nature_detail\":\"ticket_nature_detail\"}},\"tickets_all\":{\"tickets\":{\"ticket_manage\":\"ticket_manage\",\"ticket_view\":\"ticket_view\",\"ticket_detail\":\"ticket_detail\"},\"assign_all\":{\"assign_manage\":\"assign_manage\",\"assign_view\":\"assign_view\",\"assign_create\":\"assign_create\",\"assign_work_status\":\"assign_work_status\",\"assign_delete\":\"assign_delete\"},\"messages_all\":{\"message_manage\":\"message_manage\",\"message_view\":\"message_view\",\"message_detail\":\"message_detail\",\"message_create\":\"message_create\"}}}', 1, '123456789', NULL, '2024-08-28 14:21:04', '2024-08-28 14:31:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_ticket_assigns`
--
ALTER TABLE `company_ticket_assigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_users`
--
ALTER TABLE `company_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_users_employee_id_unique` (`employee_id`),
  ADD UNIQUE KEY `company_users_email_unique` (`email`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `industries`
--
ALTER TABLE `industries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `industries_name_unique` (`name`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sub_companies`
--
ALTER TABLE `sub_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_modules`
--
ALTER TABLE `sub_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tickets_ticket_code` (`ticket_code`);

--
-- Indexes for table `ticket_assigns`
--
ALTER TABLE `ticket_assigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_natures`
--
ALTER TABLE `ticket_natures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_employee_id_unique` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_ticket_assigns`
--
ALTER TABLE `company_ticket_assigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `company_users`
--
ALTER TABLE `company_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `industries`
--
ALTER TABLE `industries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_companies`
--
ALTER TABLE `sub_companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_modules`
--
ALTER TABLE `sub_modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ticket_assigns`
--
ALTER TABLE `ticket_assigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ticket_natures`
--
ALTER TABLE `ticket_natures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
