-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2020 at 03:46 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mojo_campaign`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(39, '2014_10_12_000000_create_users_table', 1),
(40, '2014_10_12_100000_create_password_resets_table', 1),
(41, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(42, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(43, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(44, '2016_06_01_000004_create_oauth_clients_table', 1),
(45, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(46, '2019_08_19_000000_create_failed_jobs_table', 1),
(47, '2020_04_13_121243_create_permission_tables', 1),
(48, '2020_04_13_130010_create_pages_table', 1),
(49, '2020_04_13_130037_create_blogs_table', 1),
(50, '2020_04_13_130040_create_question_sets_table', 1),
(51, '2020_04_13_130056_create_questions_table', 1),
(52, '2020_04_13_131112_create_question_options_table', 1),
(53, '2020_04_13_131805_create_settings_table', 1),
(54, '2020_04_13_135507_create_tracks_table', 1),
(55, '2020_04_29_165400_create_responses_table', 1),
(56, '2020_04_29_165724_create_winners_table', 1),
(57, '2020_04_29_175944_create_qustion_answers_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 3),
(2, 'App\\User', 1),
(2, 'App\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'website.view', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(2, 'website.login', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(3, 'website.register', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(4, 'website.question_answer', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(5, 'admin.access', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(6, 'dashboard.view', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(7, 'permission.view', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(8, 'permission.create', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(9, 'permission.edit', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(10, 'permission.delete', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(11, 'role.view', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(12, 'role.create', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(13, 'role.edit', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(14, 'role.delete', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(15, 'user.view', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(16, 'user.create', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(17, 'user.edit', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(18, 'user.delete', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(19, 'question_set.view', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(20, 'question_set.create', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(21, 'question_set.edit', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(22, 'question_set.delete', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(23, 'question.view', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(24, 'question.create', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(25, 'question.edit', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(26, 'question.delete', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(27, 'settings.view', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(28, 'settings.create', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(29, 'settings.edit', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(30, 'admin.view', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(31, 'admin.create', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(32, 'admin.edit', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(33, 'admin.delete', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(34, 'pages.view', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(35, 'pages.create', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(36, 'pages.edit', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(37, 'pages.delete', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(38, 'blogs.view', 'web', '2020-04-30 03:49:42', '2020-04-30 03:49:42'),
(39, 'blogs.create', 'web', '2020-04-30 03:49:42', '2020-04-30 03:49:42'),
(40, 'blogs.edit', 'web', '2020-04-30 03:49:42', '2020-04-30 03:49:42'),
(41, 'blogs.delete', 'web', '2020-04-30 03:49:42', '2020-04-30 03:49:42'),
(42, 'admin_profile.view', 'web', '2020-04-30 03:49:42', '2020-04-30 03:49:42'),
(43, 'admin_profile.edit', 'web', '2020-04-30 03:49:42', '2020-04-30 03:49:42');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `question_set_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `type` enum('radio','checkbox_single','checkbox_multiple','select_single','select_multiple','text') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'checkbox_single',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `title`, `question_set_id`, `status`, `type`, `created_at`, `updated_at`) VALUES
(5, 'নিচের কোনটি চট্টগ্রামের ঐতিহ্যবাহী খাবার?', 1, 1, 'checkbox_single', '2020-05-09 10:22:24', '2020-05-09 10:22:24'),
(6, 'মাই লাইফ মাই _______?', 1, 1, 'checkbox_single', '2020-05-09 10:23:19', '2020-05-09 10:23:19'),
(7, 'বাংলাদেশের প্রবেশদ্বার কোনটি?', 1, 1, 'checkbox_single', '2020-05-09 10:24:09', '2020-05-09 10:24:09'),
(8, 'বিশ্ব ইজতেমা কোথায় অনুষ্ঠিত হয়?', 1, 1, 'checkbox_single', '2020-05-09 10:24:52', '2020-05-09 10:24:52'),
(9, 'হাজির ----------------', 1, 1, 'checkbox_single', '2020-05-09 10:25:40', '2020-05-09 10:25:40'),
(10, 'বহু বছর ধরে প্রচলিত ঢাকার ঐতিহ্যবাহী ইফতার পাওয়া যায়?', 1, 1, 'checkbox_single', '2020-05-09 10:26:39', '2020-05-09 10:26:39'),
(11, 'বালাম কোন হার্ড রক ব্যান্ডের সদস্য ছিলেন?', 1, 1, 'checkbox_single', '2020-05-09 10:27:35', '2020-05-09 10:27:35'),
(12, 'শাহী টুকরা কোন ধরণের খাবার?', 1, 1, 'checkbox_single', '2020-05-09 10:28:26', '2020-05-09 10:28:26'),
(13, 'শীতল পানির ঝর্ণার অবস্থান? -', 1, 1, 'checkbox_single', '2020-05-09 10:29:17', '2020-05-09 10:29:17'),
(14, 'কাচ্চি বিরিয়ানির সাথে সাধারণত নিচের কোন ধরনের চাটনি দেয়া হয়ে থাকে?', 1, 1, 'checkbox_single', '2020-05-09 10:30:04', '2020-05-09 10:30:04'),
(15, 'রয়েল বেঙ্গল টাইগার রয়েছে?', 1, 1, 'checkbox_single', '2020-05-09 10:30:42', '2020-05-09 10:30:42'),
(16, 'নিচের কোনটি তেলের পিঠা?', 1, 1, 'checkbox_single', '2020-05-09 10:31:40', '2020-05-09 10:31:40'),
(17, 'মসজিদের শহর বলা হয়?', 1, 1, 'checkbox_single', '2020-05-09 10:32:41', '2020-05-09 10:32:41'),
(18, 'আমাদের পরিচিতি ----------?', 1, 1, 'checkbox_single', '2020-05-09 10:33:24', '2020-05-09 10:33:24'),
(19, 'পিৎজ্জা কোন দেশীয় খাবার?', 1, 1, 'checkbox_single', '2020-05-09 10:34:04', '2020-05-09 10:34:04');

-- --------------------------------------------------------

--
-- Table structure for table `question_options`
--

CREATE TABLE `question_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `question_options`
--

INSERT INTO `question_options` (`id`, `question_id`, `value`, `is_correct`, `created_at`, `updated_at`) VALUES
(17, 5, 'বাকরখানি', 1, '2020-05-09 10:22:24', '2020-05-09 10:22:24'),
(18, 5, 'মেজবানি মাংস', 0, '2020-05-09 10:22:24', '2020-05-09 10:22:24'),
(19, 5, 'কাচ্চি বিরিয়ানি', 0, '2020-05-09 10:22:24', '2020-05-09 10:22:24'),
(20, 5, 'চিংড়ি মাছের মালাইকারি', 0, '2020-05-09 10:22:24', '2020-05-09 10:22:24'),
(21, 6, 'দোজো', 0, '2020-05-09 10:23:19', '2020-05-09 10:23:19'),
(22, 6, 'মোজো', 1, '2020-05-09 10:23:19', '2020-05-09 10:23:19'),
(23, 6, 'রুলস', 0, '2020-05-09 10:23:19', '2020-05-09 10:23:19'),
(24, 6, 'প্রব্লেম', 0, '2020-05-09 10:23:19', '2020-05-09 10:23:19'),
(25, 7, 'চট্টগ্রাম', 1, '2020-05-09 10:24:09', '2020-05-09 10:24:09'),
(26, 7, 'বরিশাল', 0, '2020-05-09 10:24:09', '2020-05-09 10:24:09'),
(27, 7, 'ঢাকা', 0, '2020-05-09 10:24:09', '2020-05-09 10:24:09'),
(28, 7, 'গাইবান্ধা', 0, '2020-05-09 10:24:09', '2020-05-09 10:24:09'),
(29, 8, 'টঙ্গী', 1, '2020-05-09 10:24:52', '2020-05-09 10:24:52'),
(30, 8, 'গাজীপুর', 0, '2020-05-09 10:24:52', '2020-05-09 10:24:52'),
(31, 8, 'নবাবগঞ্জ', 0, '2020-05-09 10:24:52', '2020-05-09 10:24:52'),
(32, 8, 'মাদারীপুর', 0, '2020-05-09 10:24:52', '2020-05-09 10:24:52'),
(33, 9, 'বিরিয়ানি', 1, '2020-05-09 10:25:40', '2020-05-09 10:25:40'),
(34, 9, 'চটপটি', 0, '2020-05-09 10:25:40', '2020-05-09 10:25:40'),
(35, 9, 'লটপটি', 0, '2020-05-09 10:25:40', '2020-05-09 10:25:40'),
(36, 9, 'শরবত', 0, '2020-05-09 10:25:40', '2020-05-09 10:25:40'),
(37, 10, 'মোহাম্মদপুর', 0, '2020-05-09 10:26:39', '2020-05-09 10:26:39'),
(38, 10, 'পুরান ঢাকা', 1, '2020-05-09 10:26:39', '2020-05-09 10:26:39'),
(39, 10, 'মেরুল বাড্ডা', 0, '2020-05-09 10:26:39', '2020-05-09 10:26:39'),
(40, 10, 'ফার্মগেট', 0, '2020-05-09 10:26:39', '2020-05-09 10:26:39'),
(41, 11, 'ওয়ারফেজ', 1, '2020-05-09 10:27:35', '2020-05-09 10:27:35'),
(42, 11, 'ক্রিপটিক ফেট', 0, '2020-05-09 10:27:35', '2020-05-09 10:27:35'),
(43, 11, 'আর্টসেল', 0, '2020-05-09 10:27:35', '2020-05-09 10:27:35'),
(44, 11, 'ব্ল্যাক', 0, '2020-05-09 10:27:35', '2020-05-09 10:27:35'),
(45, 12, 'ঝাল', 0, '2020-05-09 10:28:26', '2020-05-09 10:28:26'),
(46, 12, 'মিষ্টান্ন', 1, '2020-05-09 10:28:26', '2020-05-09 10:28:26'),
(47, 12, 'নোনতা', 0, '2020-05-09 10:28:26', '2020-05-09 10:28:26'),
(48, 12, 'টক', 0, '2020-05-09 10:28:26', '2020-05-09 10:28:26'),
(49, 13, 'হিমছড়ি, জাফলং', 1, '2020-05-09 10:29:17', '2020-05-09 10:29:17'),
(50, 13, 'মানিকগঞ্জ', 0, '2020-05-09 10:29:17', '2020-05-09 10:29:17'),
(51, 13, 'কিশোরগঞ্জ', 0, '2020-05-09 10:29:17', '2020-05-09 10:29:17'),
(52, 13, 'ব্রাহ্মণবাড়িয়া', 0, '2020-05-09 10:29:17', '2020-05-09 10:29:17'),
(53, 14, 'আমের চাটনি', 0, '2020-05-09 10:30:04', '2020-05-09 10:30:04'),
(54, 14, 'তেঁতুলের চাটনি', 1, '2020-05-09 10:30:04', '2020-05-09 10:30:04'),
(55, 14, 'আলুবাখারার চাটনি', 0, '2020-05-09 10:30:04', '2020-05-09 10:30:04'),
(56, 14, 'জলপাইয়ের চাটনি', 0, '2020-05-09 10:30:04', '2020-05-09 10:30:04'),
(57, 15, 'মহেশখালী', 0, '2020-05-09 10:30:42', '2020-05-09 10:30:42'),
(58, 15, 'জোয়ার ধৌত বন', 0, '2020-05-09 10:30:42', '2020-05-09 10:30:42'),
(59, 15, 'সুন্দরবন', 1, '2020-05-09 10:30:42', '2020-05-09 10:30:42'),
(60, 15, 'ফরিদপুর', 0, '2020-05-09 10:30:42', '2020-05-09 10:30:42'),
(61, 16, 'পাটিসাপটা', 0, '2020-05-09 10:31:40', '2020-05-09 10:31:40'),
(62, 16, 'পোয়া পিঠা', 1, '2020-05-09 10:31:40', '2020-05-09 10:31:40'),
(63, 16, 'ভাঁপা পিঠা', 0, '2020-05-09 10:31:40', '2020-05-09 10:31:40'),
(64, 16, 'চিতই পিঠা', 0, '2020-05-09 10:31:40', '2020-05-09 10:31:40'),
(65, 17, 'সিলেট', 0, '2020-05-09 10:32:41', '2020-05-09 10:32:41'),
(66, 17, 'চট্টগ্রাম', 0, '2020-05-09 10:32:41', '2020-05-09 10:32:41'),
(67, 17, 'ঢাকা', 1, '2020-05-09 10:32:41', '2020-05-09 10:32:41'),
(68, 17, 'বরিশাল', 0, '2020-05-09 10:32:41', '2020-05-09 10:32:41'),
(69, 18, 'মাছে ভাতে বাঙালি', 1, '2020-05-09 10:33:24', '2020-05-09 10:33:24'),
(70, 18, 'শাকে ভাতে বাঙালি', 0, '2020-05-09 10:33:24', '2020-05-09 10:33:24'),
(71, 18, 'ডালে ভাতে বাঙালি', 0, '2020-05-09 10:33:24', '2020-05-09 10:33:24'),
(72, 18, 'মাংসে ভাতে বাঙালি', 0, '2020-05-09 10:33:24', '2020-05-09 10:33:24'),
(73, 19, 'ভারতীয়', 0, '2020-05-09 10:34:04', '2020-05-09 10:34:04'),
(74, 19, 'ইতালিয়ান', 1, '2020-05-09 10:34:04', '2020-05-09 10:34:04'),
(75, 19, 'বাংলাদেশী', 0, '2020-05-09 10:34:04', '2020-05-09 10:34:04'),
(76, 19, 'মেক্সিকান', 0, '2020-05-09 10:34:04', '2020-05-09 10:34:04');

-- --------------------------------------------------------

--
-- Table structure for table `question_sets`
--

CREATE TABLE `question_sets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `question_sets`
--

INSERT INTO `question_sets` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'A', '2020-04-30 03:49:41', '2020-04-30 03:49:41');

-- --------------------------------------------------------

--
-- Table structure for table `qustion_answers`
--

CREATE TABLE `qustion_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `response_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `question_option_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT 0,
  `total_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'in milli seconds',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_answer` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'in count',
  `total_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'in seconds',
  `total_correct` int(10) NOT NULL DEFAULT 0 COMMENT 'total correct answer',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=>not complete, 1=>complete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'User', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41'),
(2, 'Super Admin', 'web', '2020-04-30 03:49:41', '2020-04-30 03:49:41');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Mojo Eid Campaign',
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_toll_free_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_hotline_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `office_hour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `likedin_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `footer_text` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `logo`, `contact_toll_free_number`, `contact_hotline_number`, `email`, `address`, `office_hour`, `facebook_link`, `twitter_link`, `likedin_link`, `instagram_link`, `footer_text`, `created_at`, `updated_at`) VALUES
(1, 'Mojo Eid Offer', '-1589018301.png', '16609', NULL, 'info@akijfood.com', 'Akij House, Bir Uttam Mir Shawkat Sarak, Dhaka 1208', NULL, 'https://www.facebook.com/mojomasti/', 'https://twitter.com/hashtag/akij?lang=en', NULL, NULL, 'Developed by Akij info Tech Ltd.', '2020-04-30 03:49:41', '2020-05-09 09:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`id`, `title`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'বাংলাদেশের জাতির পিতার নাম কি?', 'Question updated', 1, '2020-05-02 04:26:12', '2020-05-02 04:26:12'),
(2, 'বাংলাদেশের জাতির পিতার নাম কি?', 'Question updated', 1, '2020-05-07 06:18:23', '2020-05-07 06:18:23'),
(3, 'Settings', 'Setting was updated', 1, '2020-05-09 09:56:28', '2020-05-09 09:56:28'),
(4, 'Settings', 'Setting was updated', 1, '2020-05-09 09:58:21', '2020-05-09 09:58:21'),
(5, 'admin', 'User was Updated', 1, '2020-05-09 10:15:53', '2020-05-09 10:15:53'),
(6, 'নিচের কোনটি চট্টগ্রামের ঐতিহ্যবাহী খাবার?', 'New question created', 1, '2020-05-09 10:22:24', '2020-05-09 10:22:24'),
(7, 'মাই লাইফ মাই _______?', 'New question created', 1, '2020-05-09 10:23:19', '2020-05-09 10:23:19'),
(8, 'বাংলাদেশের প্রবেশদ্বার কোনটি?', 'New question created', 1, '2020-05-09 10:24:09', '2020-05-09 10:24:09'),
(9, 'বিশ্ব ইজতেমা কোথায় অনুষ্ঠিত হয়?', 'New question created', 1, '2020-05-09 10:24:52', '2020-05-09 10:24:52'),
(10, 'হাজির ----------------', 'New question created', 1, '2020-05-09 10:25:40', '2020-05-09 10:25:40'),
(11, 'বহু বছর ধরে প্রচলিত ঢাকার ঐতিহ্যবাহী ইফতার পাওয়া যায়?', 'New question created', 1, '2020-05-09 10:26:39', '2020-05-09 10:26:39'),
(12, '৭) বালাম কোন হার্ড রক ব্যান্ডের সদস্য ছিলেন?', 'New question created', 1, '2020-05-09 10:27:20', '2020-05-09 10:27:20'),
(13, 'বালাম কোন হার্ড রক ব্যান্ডের সদস্য ছিলেন?', 'Question updated', 1, '2020-05-09 10:27:35', '2020-05-09 10:27:35'),
(14, 'শাহী টুকরা কোন ধরণের খাবার?', 'New question created', 1, '2020-05-09 10:28:26', '2020-05-09 10:28:26'),
(15, 'শীতল পানির ঝর্ণার অবস্থান? -', 'New question created', 1, '2020-05-09 10:29:17', '2020-05-09 10:29:17'),
(16, 'কাচ্চি বিরিয়ানির সাথে সাধারণত নিচের কোন ধরনের চাটনি দেয়া হয়ে থাকে?', 'New question created', 1, '2020-05-09 10:30:04', '2020-05-09 10:30:04'),
(17, 'রয়েল বেঙ্গল টাইগার রয়েছে?', 'New question created', 1, '2020-05-09 10:30:42', '2020-05-09 10:30:42'),
(18, 'নিচের কোনটি তেলের পিঠা?', 'New question created', 1, '2020-05-09 10:31:40', '2020-05-09 10:31:40'),
(19, 'মসজিদের শহর বলা হয়?', 'New question created', 1, '2020-05-09 10:32:41', '2020-05-09 10:32:41'),
(20, 'আমাদের পরিচিতি ----------?', 'New question created', 1, '2020-05-09 10:33:24', '2020-05-09 10:33:24'),
(21, 'পিৎজ্জা কোন দেশীয় খাবার?', 'New question created', 1, '2020-05-09 10:34:04', '2020-05-09 10:34:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `api_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `phone_no`, `email`, `email_verified_at`, `password`, `date_of_birth`, `location`, `is_approved`, `api_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, 'admin', '019512332084', 'admin.mojo@akijfood.com', NULL, '$2y$10$t2Il.dmfkB0stZ2Ks68tDuP9VtXQBz5UUx9zTf6t0S/d5L4PIA/B.', '1995-12-30', 'Dhaka', 1, NULL, 'rusnr9RhQVE81gUcqcSRvTadLbL6HfM5436s84mQQKdDBdgHqCzqLUmqH80a', '2020-05-09 10:15:53', '2020-05-09 10:15:53'),
(2, 'Siraji ', 'Ahmed', 'siraji', '012', 'siraji@gmail.com', NULL, '$2y$10$DnG5YNNUjlQmR8rnhuNAJOFjO9b0tWAhy/XaYod16hMG1JUT7r0yO', NULL, NULL, 1, NULL, NULL, '2020-04-30 03:49:42', '2020-04-30 03:49:42'),
(6, 'Maniruzzaman', ' Akash', 'maniruzzaman', '01951233084', NULL, NULL, '$2y$10$VOWwZmce/kMeN4FhpSyGJeX.sNmoCO9Eh0LkCKZnzkmA5M18Q6Efi', '2020-05-05', 'dhaka', 0, NULL, NULL, '2020-05-05 03:32:48', '2020-05-05 03:32:48'),
(7, 'Shakib', 'Nazmus', 'shakib', '01747867585', NULL, NULL, '$2y$10$i/9NoZNe8MO/.xem6kHTn.dswN2RwhHdR43tNCscHH6ChJGS.PLVC', '2020-05-10', 'Rajshahi', 0, NULL, NULL, '2020-05-07 06:32:05', '2020-05-07 06:32:05');

-- --------------------------------------------------------

--
-- Table structure for table `winners`
--

CREATE TABLE `winners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('daily','full_season') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'daily',
  `date` date NOT NULL,
  `total_answer` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'in count',
  `total_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'in seconds',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blogs_slug_unique` (`slug`);

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
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_question_set_id_foreign` (`question_set_id`);

--
-- Indexes for table `question_options`
--
ALTER TABLE `question_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_options_question_id_foreign` (`question_id`);

--
-- Indexes for table `question_sets`
--
ALTER TABLE `question_sets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qustion_answers`
--
ALTER TABLE `qustion_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qustion_answers_question_id_foreign` (`question_id`),
  ADD KEY `qustion_answers_response_id_foreign` (`response_id`),
  ADD KEY `qustion_answers_question_option_id_foreign` (`question_option_id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `responses_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tracks_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_phone_no_unique` (`phone_no`),
  ADD KEY `users_first_name_index` (`first_name`);

--
-- Indexes for table `winners`
--
ALTER TABLE `winners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `winners_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `question_options`
--
ALTER TABLE `question_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `question_sets`
--
ALTER TABLE `question_sets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `qustion_answers`
--
ALTER TABLE `qustion_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `winners`
--
ALTER TABLE `winners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_question_set_id_foreign` FOREIGN KEY (`question_set_id`) REFERENCES `question_sets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question_options`
--
ALTER TABLE `question_options`
  ADD CONSTRAINT `question_options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `qustion_answers`
--
ALTER TABLE `qustion_answers`
  ADD CONSTRAINT `qustion_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `qustion_answers_question_option_id_foreign` FOREIGN KEY (`question_option_id`) REFERENCES `question_options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `qustion_answers_response_id_foreign` FOREIGN KEY (`response_id`) REFERENCES `responses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tracks`
--
ALTER TABLE `tracks`
  ADD CONSTRAINT `tracks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `winners`
--
ALTER TABLE `winners`
  ADD CONSTRAINT `winners_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
