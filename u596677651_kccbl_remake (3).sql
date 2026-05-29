-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 29, 2026 at 01:17 AM
-- Server version: 11.8.6-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u596677651_kccbl_remake`
--

-- --------------------------------------------------------

--
-- Table structure for table `awarded_players`
--

CREATE TABLE `awarded_players` (
  `awarded_players_id` int(11) NOT NULL,
  `date_awarded` date NOT NULL,
  `award_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `week` tinyint(4) NOT NULL,
  `photo` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `award_id` int(11) NOT NULL,
  `award_name` varchar(100) NOT NULL,
  `misc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `pinned` tinyint(4) NOT NULL DEFAULT 0,
  `sub_header` varchar(500) NOT NULL,
  `link` varchar(250) DEFAULT NULL,
  `skip_content` tinyint(4) NOT NULL DEFAULT 0,
  `content` text NOT NULL,
  `image` text DEFAULT NULL,
  `share_image` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_post_tags`
--

CREATE TABLE `blog_post_tags` (
  `post_tag_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_tags`
--

CREATE TABLE `blog_tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(50) NOT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `state_id` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities_old`
--

CREATE TABLE `cities_old` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `state_id` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `short_name` varchar(18) NOT NULL,
  `abbreviation` varchar(12) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `cover_photo` varchar(255) DEFAULT NULL,
  `raw_logo` varchar(255) DEFAULT NULL,
  `color_primary` varchar(7) DEFAULT NULL,
  `color_secondary` varchar(7) DEFAULT NULL,
  `color_tertiary` varchar(7) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `club_stats`
--

CREATE TABLE `club_stats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `club_id` bigint(20) UNSIGNED NOT NULL,
  `season` year(4) NOT NULL,
  `division` varchar(255) DEFAULT NULL,
  `wins` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `losses` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ties` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `runs_scored` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `runs_allowed` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `playoffs` tinyint(1) NOT NULL DEFAULT 0,
  `champion` tinyint(1) NOT NULL DEFAULT 0,
  `finish` tinyint(3) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coach_activity_logs`
--

CREATE TABLE `coach_activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `club_id` bigint(20) UNSIGNED DEFAULT NULL,
  `season` int(10) UNSIGNED DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `method` varchar(10) NOT NULL,
  `url` text NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coach_messages`
--

CREATE TABLE `coach_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coach_suggestions`
--

CREATE TABLE `coach_suggestions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `suggestion` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `college_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `short_name` varchar(100) NOT NULL,
  `mascot` varchar(100) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `baseball_twitter` varchar(150) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `state_id` smallint(6) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_inquiries`
--

CREATE TABLE `contact_inquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `inquiry_type` varchar(255) NOT NULL DEFAULT 'general',
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cover_photos`
--

CREATE TABLE `cover_photos` (
  `cover_photo_id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(100) NOT NULL,
  `image_path` varchar(500) NOT NULL,
  `original_filename` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_date` date NOT NULL,
  `season` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `event_image` varchar(255) DEFAULT NULL,
  `park_id` int(11) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `faq_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `game_id` int(11) NOT NULL,
  `game_date` datetime NOT NULL,
  `season` int(11) NOT NULL,
  `team_1_id` int(11) DEFAULT NULL,
  `club_1_id` smallint(6) NOT NULL,
  `team_2_id` int(11) DEFAULT NULL,
  `club_2_id` smallint(6) NOT NULL,
  `team_1_score` int(11) DEFAULT 0,
  `team_2_score` int(11) DEFAULT 0,
  `winner` int(11) DEFAULT NULL COMMENT 'Stores the winning team_id or 0 for a tie',
  `team_1_home` tinyint(1) DEFAULT 0,
  `team_2_home` tinyint(1) DEFAULT 0,
  `team_1_win` tinyint(1) DEFAULT 0,
  `team_2_win` tinyint(1) DEFAULT 0,
  `tie` tinyint(1) DEFAULT 0,
  `park_field_id` int(11) DEFAULT NULL,
  `game_type` tinyint(4) NOT NULL DEFAULT 1,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `game_innings`
--

CREATE TABLE `game_innings` (
  `inning_id` bigint(20) NOT NULL,
  `game_id` bigint(20) NOT NULL,
  `inning` tinyint(4) NOT NULL,
  `team_1_score` tinyint(4) NOT NULL DEFAULT 0,
  `team_2_score` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `game_stats`
--

CREATE TABLE `game_stats` (
  `game_stat_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `season` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `position` varchar(10) DEFAULT NULL,
  `bat_order` tinyint(4) NOT NULL DEFAULT 0,
  `AB` int(11) DEFAULT 0,
  `R` int(11) DEFAULT 0,
  `H` int(11) DEFAULT 0,
  `RBI` int(11) DEFAULT 0,
  `BB_batter` int(11) DEFAULT 0,
  `SO_batter` int(11) DEFAULT 0,
  `HBP_batter` int(11) DEFAULT 0,
  `Doubles` int(11) DEFAULT 0,
  `Triples` int(11) DEFAULT 0,
  `HR` int(11) DEFAULT 0,
  `SB` int(11) DEFAULT 0,
  `CS` int(11) DEFAULT 0,
  `E` int(11) DEFAULT 0,
  `SAC` int(11) DEFAULT 0,
  `SF` int(11) DEFAULT 0,
  `pitch_order` tinyint(4) NOT NULL DEFAULT 0,
  `IP` smallint(6) DEFAULT 0,
  `IPP` int(11) DEFAULT 0,
  `HA` int(11) DEFAULT 0,
  `RA` int(11) DEFAULT 0,
  `ER` int(11) DEFAULT 0,
  `SO_Pitched` int(11) DEFAULT 0,
  `BB_Pitched` int(11) DEFAULT 0,
  `HBP_Pitched` int(11) DEFAULT 0,
  `NP` int(11) DEFAULT 0,
  `TS` int(11) DEFAULT 0,
  `WP` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `media_id` int(11) NOT NULL,
  `media_type` varchar(50) NOT NULL COMMENT 'Type of media: photo, video, other',
  `media_link` text NOT NULL COMMENT 'Path to media file on the server',
  `caption` varchar(255) DEFAULT NULL COMMENT 'Short caption for the media item',
  `use_as_cover_photo` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 1 COMMENT 'User ID of the creator',
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'When the media was uploaded',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'When the record was created',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'When the record was last updated',
  `updated_by` int(11) NOT NULL DEFAULT 1 COMMENT 'User ID of the last updater'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media_tags`
--

CREATE TABLE `media_tags` (
  `media_tag_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL COMMENT 'Media item ID',
  `tag_id` int(11) NOT NULL COMMENT 'Tag ID from blog_tags',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'When the tag was created',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'When the tag was last updated',
  `updated_by` int(11) NOT NULL DEFAULT 1 COMMENT 'User ID of the updater'
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

-- --------------------------------------------------------

--
-- Table structure for table `parks`
--

CREATE TABLE `parks` (
  `park_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `short_name` varchar(50) NOT NULL,
  `street` varchar(100) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `state_id` smallint(6) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `park_fields`
--

CREATE TABLE `park_fields` (
  `field_id` int(11) NOT NULL,
  `park_id` int(11) DEFAULT NULL,
  `field_name` varchar(100) NOT NULL,
  `lf` int(11) DEFAULT NULL,
  `lc` int(11) DEFAULT NULL,
  `cf` int(11) DEFAULT NULL,
  `rc` int(11) DEFAULT NULL,
  `rf` int(11) DEFAULT NULL,
  `infield` varchar(50) DEFAULT NULL,
  `outfield` varchar(50) DEFAULT NULL,
  `bleachers` tinyint(1) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `player_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(35) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `high_school` varchar(100) DEFAULT NULL,
  `dob` varchar(20) DEFAULT NULL,
  `throw_hand` varchar(10) DEFAULT NULL,
  `bat_hand` varchar(10) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `pbr_link` text DEFAULT NULL,
  `amyo_link` text DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `college_id` int(11) DEFAULT NULL,
  `college_name` varchar(200) DEFAULT NULL,
  `grad_year` int(11) DEFAULT NULL,
  `college_grad_year` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 1,
  `height` varchar(10) DEFAULT NULL COMMENT 'Player height, e.g., 6''2"',
  `total_inches` smallint(6) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL COMMENT 'Player weight in pounds, e.g., 185',
  `primary_position` varchar(50) DEFAULT NULL COMMENT 'Primary position, e.g., RHP',
  `secondary_positions` varchar(100) DEFAULT NULL COMMENT 'Secondary positions, e.g., 1B,OF',
  `bio` text DEFAULT NULL COMMENT 'Player biography',
  `video_link` varchar(255) DEFAULT NULL COMMENT 'URL for video highlights, e.g., YouTube',
  `redshirt` tinyint(4) DEFAULT NULL,
  `transfer` tinyint(4) DEFAULT NULL,
  `two_year` tinyint(4) DEFAULT NULL,
  `four_year` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `player_claim_requests`
--

CREATE TABLE `player_claim_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `player_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `match_source` varchar(255) NOT NULL DEFAULT 'manual',
  `submitted_email` varchar(255) DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `reviewed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `player_images`
--

CREATE TABLE `player_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `player_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `season` int(11) DEFAULT NULL,
  `image_type` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `player_teams`
--

CREATE TABLE `player_teams` (
  `player_team_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `club_id` smallint(6) NOT NULL,
  `player_id` int(11) NOT NULL,
  `season` int(11) NOT NULL,
  `jersey_num` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `playoff_brackets`
--

CREATE TABLE `playoff_brackets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `season` int(10) UNSIGNED NOT NULL,
  `division` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `structure` varchar(50) NOT NULL DEFAULT 'single_elimination',
  `teams_count` int(11) NOT NULL DEFAULT 4,
  `order` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `playoff_matchups`
--

CREATE TABLE `playoff_matchups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `playoff_round_id` bigint(20) UNSIGNED NOT NULL,
  `matchup_number` int(11) NOT NULL,
  `team1_id` bigint(20) UNSIGNED DEFAULT NULL,
  `team2_id` bigint(20) UNSIGNED DEFAULT NULL,
  `team1_seed` int(11) DEFAULT NULL,
  `team2_seed` int(11) DEFAULT NULL,
  `team1_wins` int(11) NOT NULL DEFAULT 0,
  `team2_wins` int(11) NOT NULL DEFAULT 0,
  `winner_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `advances_to_matchup_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `playoff_rounds`
--

CREATE TABLE `playoff_rounds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `playoff_bracket_id` bigint(20) UNSIGNED NOT NULL,
  `round_number` int(11) NOT NULL,
  `round_name` varchar(100) NOT NULL,
  `series_format` varchar(50) NOT NULL DEFAULT 'best_of_3',
  `games_required` int(11) NOT NULL DEFAULT 2,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `playoff_seeds`
--

CREATE TABLE `playoff_seeds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `playoff_bracket_id` bigint(20) UNSIGNED NOT NULL,
  `division` varchar(50) DEFAULT NULL,
  `club_id` bigint(20) UNSIGNED NOT NULL,
  `seed` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postseason_stats_total`
--

CREATE TABLE `postseason_stats_total` (
  `season_stat_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `season` int(11) NOT NULL,
  `AB` int(11) DEFAULT 0,
  `R` int(11) DEFAULT 0,
  `H` int(11) DEFAULT 0,
  `RBI` int(11) DEFAULT 0,
  `BB_batter` int(11) DEFAULT 0,
  `SO_batter` int(11) DEFAULT 0,
  `HBP_batter` int(11) DEFAULT 0,
  `Doubles` int(11) DEFAULT 0,
  `Triples` int(11) DEFAULT 0,
  `HR` int(11) DEFAULT 0,
  `SB` int(11) DEFAULT 0,
  `CS` int(11) DEFAULT 0,
  `E` int(11) DEFAULT 0,
  `SAC` int(11) DEFAULT 0,
  `SF` int(11) DEFAULT 0,
  `IP` decimal(4,1) DEFAULT 0.0,
  `HA` int(11) DEFAULT 0,
  `RA` int(11) DEFAULT 0,
  `ER` int(11) DEFAULT 0,
  `SO_Pitched` int(11) DEFAULT 0,
  `BB_Pitched` int(11) DEFAULT 0,
  `HBP_Pitched` int(11) DEFAULT 0,
  `NP` int(11) DEFAULT 0,
  `TS` int(11) DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `school_id` int(11) NOT NULL,
  `mpName` varchar(200) NOT NULL,
  `rawName` varchar(200) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `webName` varchar(200) NOT NULL,
  `sa_name` varchar(200) NOT NULL,
  `short_name` varchar(10) NOT NULL,
  `mascot` varchar(30) NOT NULL,
  `street` varchar(75) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `zip` varchar(20) NOT NULL,
  `typeID` varchar(25) NOT NULL,
  `logo` varchar(75) NOT NULL,
  `ad` varchar(75) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `mpLink` varchar(200) NOT NULL,
  `webCode` bigint(20) NOT NULL,
  `hsClassID` smallint(6) NOT NULL,
  `fbUTD` tinyint(4) NOT NULL,
  `bsUTD` tinyint(4) NOT NULL,
  `bkUTD` tinyint(4) NOT NULL,
  `bhoUTD` tinyint(4) NOT NULL,
  `sbUTD` tinyint(1) NOT NULL,
  `bsoUTD` tinyint(1) NOT NULL,
  `gvbUTD` tinyint(1) NOT NULL,
  `blxUTD` tinyint(1) NOT NULL,
  `gbkUTD` tinyint(1) NOT NULL,
  `gsoUTD` tinyint(1) NOT NULL,
  `mpLink2` varchar(200) NOT NULL,
  `size` int(11) NOT NULL,
  `weight` double(5,2) NOT NULL DEFAULT 1.00,
  `bsweight` double(5,2) NOT NULL DEFAULT 1.00,
  `fbweight` double(5,2) NOT NULL DEFAULT 1.00,
  `bkweight` double(5,2) NOT NULL DEFAULT 1.00,
  `gbkweight` double(5,2) NOT NULL DEFAULT 1.00,
  `sbweight` double(5,2) NOT NULL DEFAULT 1.00,
  `bsoweight` double(5,2) NOT NULL DEFAULT 1.00,
  `gsoweight` double(5,2) NOT NULL DEFAULT 1.00,
  `gvbweight` double(5,2) NOT NULL DEFAULT 1.00,
  `blxweight` double(5,2) NOT NULL DEFAULT 1.00,
  `bhoweight` double(5,2) NOT NULL DEFAULT 1.00,
  `bs_twitter` varchar(75) NOT NULL,
  `history_grabbed` tinyint(4) NOT NULL,
  `times_viewed` bigint(20) NOT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scouting_videos`
--

CREATE TABLE `scouting_videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `player_id` int(11) DEFAULT NULL,
  `post_date` date NOT NULL,
  `tweet_url` text NOT NULL,
  `description` text DEFAULT NULL,
  `season` int(11) DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

CREATE TABLE `seasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `season_stats`
--

CREATE TABLE `season_stats` (
  `season_stat_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `season` int(11) NOT NULL,
  `AB` int(11) DEFAULT 0,
  `R` int(11) DEFAULT 0,
  `H` int(11) DEFAULT 0,
  `RBI` int(11) DEFAULT 0,
  `BB_batter` int(11) DEFAULT 0,
  `SO_batter` int(11) DEFAULT 0,
  `HBP_batter` int(11) DEFAULT 0,
  `Doubles` int(11) DEFAULT 0,
  `Triples` int(11) DEFAULT 0,
  `HR` int(11) DEFAULT 0,
  `SB` int(11) DEFAULT 0,
  `CS` int(11) DEFAULT 0,
  `E` int(11) DEFAULT 0,
  `SAC` int(11) DEFAULT 0,
  `SF` int(11) DEFAULT 0,
  `IP` decimal(4,1) DEFAULT 0.0,
  `HA` int(11) DEFAULT 0,
  `RA` int(11) DEFAULT 0,
  `ER` int(11) DEFAULT 0,
  `SO_Pitched` int(11) DEFAULT 0,
  `BB_Pitched` int(11) DEFAULT 0,
  `HBP_Pitched` int(11) DEFAULT 0,
  `NP` int(11) DEFAULT 0,
  `TS` int(11) DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `season_teams`
--

CREATE TABLE `season_teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `season` int(11) NOT NULL,
  `club_id` bigint(20) UNSIGNED NOT NULL,
  `division` varchar(50) DEFAULT NULL,
  `wins` int(11) NOT NULL DEFAULT 0,
  `losses` int(11) NOT NULL DEFAULT 0,
  `ties` int(11) NOT NULL DEFAULT 0,
  `games_scheduled` int(11) NOT NULL DEFAULT 0,
  `playoff_wins` int(11) NOT NULL DEFAULT 0,
  `playoff_losses` int(11) NOT NULL DEFAULT 0,
  `championship_wins` int(11) NOT NULL DEFAULT 0,
  `championship_losses` int(11) NOT NULL DEFAULT 0,
  `runs_scored` int(11) NOT NULL DEFAULT 0,
  `runs_allowed` int(11) NOT NULL DEFAULT 0,
  `finish` varchar(100) DEFAULT NULL,
  `div_wins` smallint(6) NOT NULL DEFAULT 0,
  `div_losses` smallint(6) NOT NULL DEFAULT 0,
  `div_ties` smallint(6) NOT NULL DEFAULT 0,
  `last_ten` varchar(10) NOT NULL DEFAULT '0-0',
  `last_five` varchar(10) NOT NULL DEFAULT '0-0',
  `streak` varchar(10) NOT NULL DEFAULT '',
  `updated_by` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `season_team_user`
--

CREATE TABLE `season_team_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `season_team_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'coach',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `season_weeks`
--

CREATE TABLE `season_weeks` (
  `season_weeks_id` int(11) NOT NULL,
  `season` int(11) NOT NULL,
  `week` tinyint(4) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `sponsor_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'Sponsor company name',
  `sponsor_level` varchar(50) NOT NULL COMMENT 'Sponsorship level, e.g., Platinum, Gold, Silver',
  `website` varchar(255) DEFAULT NULL COMMENT 'Sponsor website URL',
  `logo` text DEFAULT NULL COMMENT 'File path to sponsor logo',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 1 COMMENT 'User ID of updater'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `club_id` smallint(6) NOT NULL,
  `organization_title` varchar(150) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state_id` smallint(6) NOT NULL,
  `name` varchar(100) NOT NULL,
  `abbrev` varchar(5) NOT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL,
  `season` int(11) NOT NULL,
  `division` varchar(20) NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `gc_name` varchar(150) NOT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `short_name` varchar(20) DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 1,
  `twitter` varchar(100) DEFAULT NULL COMMENT 'Team Twitter handle, e.g., @TeamName',
  `primary_color` varchar(7) DEFAULT NULL COMMENT 'Primary team color in hex, e.g., #FF0000',
  `secondary_color` varchar(7) DEFAULT NULL COMMENT 'Secondary team color in hex, e.g., #0000FF'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_coaches`
--

CREATE TABLE `team_coaches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `club_id` bigint(20) UNSIGNED NOT NULL,
  `season` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_stats_game`
--

CREATE TABLE `team_stats_game` (
  `team_stat_game_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `game_type` tinyint(4) NOT NULL,
  `season` int(11) NOT NULL,
  `AB` int(11) NOT NULL DEFAULT 0,
  `R` int(11) NOT NULL DEFAULT 0,
  `H` int(11) NOT NULL DEFAULT 0,
  `RBI` int(11) NOT NULL DEFAULT 0,
  `BB_batter` int(11) NOT NULL DEFAULT 0,
  `SO_batter` int(11) NOT NULL DEFAULT 0,
  `HBP_batter` int(11) NOT NULL DEFAULT 0,
  `Doubles` int(11) NOT NULL DEFAULT 0,
  `Triples` int(11) NOT NULL DEFAULT 0,
  `HR` int(11) NOT NULL DEFAULT 0,
  `SB` int(11) NOT NULL DEFAULT 0,
  `CS` int(11) NOT NULL DEFAULT 0,
  `E` int(11) NOT NULL DEFAULT 0,
  `SAC` int(11) NOT NULL DEFAULT 0,
  `SF` int(11) NOT NULL DEFAULT 0,
  `IP` decimal(4,1) NOT NULL DEFAULT 0.0,
  `HA` int(11) NOT NULL DEFAULT 0,
  `RA` int(11) NOT NULL DEFAULT 0,
  `ER` int(11) NOT NULL DEFAULT 0,
  `SO_Pitched` int(11) NOT NULL DEFAULT 0,
  `BB_Pitched` int(11) NOT NULL DEFAULT 0,
  `HBP_Pitched` int(11) NOT NULL DEFAULT 0,
  `NP` int(11) NOT NULL DEFAULT 0,
  `TS` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_stats_post`
--

CREATE TABLE `team_stats_post` (
  `team_stat_post_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `season` int(11) NOT NULL,
  `wins` int(11) NOT NULL DEFAULT 0,
  `losses` int(11) NOT NULL DEFAULT 0,
  `AB` int(11) NOT NULL DEFAULT 0,
  `R` int(11) NOT NULL DEFAULT 0,
  `H` int(11) NOT NULL DEFAULT 0,
  `RBI` int(11) NOT NULL DEFAULT 0,
  `BB_batter` int(11) NOT NULL DEFAULT 0,
  `SO_batter` int(11) NOT NULL DEFAULT 0,
  `HBP_batter` int(11) NOT NULL DEFAULT 0,
  `Doubles` int(11) NOT NULL DEFAULT 0,
  `Triples` int(11) NOT NULL DEFAULT 0,
  `HR` int(11) NOT NULL DEFAULT 0,
  `SB` int(11) NOT NULL DEFAULT 0,
  `CS` int(11) NOT NULL DEFAULT 0,
  `E` int(11) NOT NULL DEFAULT 0,
  `SAC` int(11) NOT NULL DEFAULT 0,
  `SF` int(11) NOT NULL DEFAULT 0,
  `IP` decimal(4,1) NOT NULL DEFAULT 0.0,
  `HA` int(11) NOT NULL DEFAULT 0,
  `RA` int(11) NOT NULL DEFAULT 0,
  `ER` int(11) NOT NULL DEFAULT 0,
  `SO_Pitched` int(11) NOT NULL DEFAULT 0,
  `BB_Pitched` int(11) NOT NULL DEFAULT 0,
  `HBP_Pitched` int(11) NOT NULL DEFAULT 0,
  `NP` int(11) NOT NULL DEFAULT 0,
  `TS` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_stats_regular`
--

CREATE TABLE `team_stats_regular` (
  `team_stat_regular_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `season` int(11) NOT NULL,
  `wins` int(11) NOT NULL DEFAULT 0,
  `losses` int(11) NOT NULL DEFAULT 0,
  `AB` int(11) NOT NULL DEFAULT 0,
  `R` int(11) NOT NULL DEFAULT 0,
  `H` int(11) NOT NULL DEFAULT 0,
  `RBI` int(11) NOT NULL DEFAULT 0,
  `BB_batter` int(11) NOT NULL DEFAULT 0,
  `SO_batter` int(11) NOT NULL DEFAULT 0,
  `HBP_batter` int(11) NOT NULL DEFAULT 0,
  `Doubles` int(11) NOT NULL DEFAULT 0,
  `Triples` int(11) NOT NULL DEFAULT 0,
  `HR` int(11) NOT NULL DEFAULT 0,
  `SB` int(11) NOT NULL DEFAULT 0,
  `CS` int(11) NOT NULL DEFAULT 0,
  `E` int(11) NOT NULL DEFAULT 0,
  `SAC` int(11) NOT NULL DEFAULT 0,
  `SF` int(11) NOT NULL DEFAULT 0,
  `IP` decimal(4,1) NOT NULL DEFAULT 0.0,
  `HA` int(11) NOT NULL DEFAULT 0,
  `RA` int(11) NOT NULL DEFAULT 0,
  `ER` int(11) NOT NULL DEFAULT 0,
  `SO_Pitched` int(11) NOT NULL DEFAULT 0,
  `BB_Pitched` int(11) NOT NULL DEFAULT 0,
  `HBP_Pitched` int(11) NOT NULL DEFAULT 0,
  `NP` int(11) NOT NULL DEFAULT 0,
  `TS` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `claimed_player_id` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_requested_data_additions`
--

CREATE TABLE `user_requested_data_additions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `player_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `awarded_players`
--
ALTER TABLE `awarded_players`
  ADD PRIMARY KEY (`awarded_players_id`),
  ADD KEY `award_id` (`award_id`),
  ADD KEY `player_id` (`player_id`);

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`award_id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `blog_posts_slug_index` (`slug`);

--
-- Indexes for table `blog_post_tags`
--
ALTER TABLE `blog_post_tags`
  ADD PRIMARY KEY (`post_tag_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `tag_id` (`tag_id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `blog_tags`
--
ALTER TABLE `blog_tags`
  ADD PRIMARY KEY (`tag_id`),
  ADD KEY `updated_by` (`updated_by`);

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
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stateID` (`state_id`),
  ADD KEY `idx_cities_state` (`state_id`),
  ADD KEY `idx_cities_state_active_name` (`state_id`,`name`),
  ADD KEY `idx_cities_active_state` (`state_id`);

--
-- Indexes for table `cities_old`
--
ALTER TABLE `cities_old`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cities_name_state_id_unique` (`name`,`state_id`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clubs_slug_unique` (`slug`),
  ADD KEY `clubs_user_id_foreign` (`user_id`);

--
-- Indexes for table `club_stats`
--
ALTER TABLE `club_stats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `club_stats_club_id_season_unique` (`club_id`,`season`);

--
-- Indexes for table `coach_activity_logs`
--
ALTER TABLE `coach_activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coach_activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `coach_messages`
--
ALTER TABLE `coach_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coach_messages_created_by_foreign` (`created_by`);

--
-- Indexes for table `coach_suggestions`
--
ALTER TABLE `coach_suggestions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coach_suggestions_user_id_foreign` (`user_id`);

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`college_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `state_id` (`state_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `contact_inquiries`
--
ALTER TABLE `contact_inquiries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_inquiries_user_id_foreign` (`user_id`);

--
-- Indexes for table `cover_photos`
--
ALTER TABLE `cover_photos`
  ADD PRIMARY KEY (`cover_photo_id`),
  ADD UNIQUE KEY `cover_photos_category_unique` (`category`),
  ADD KEY `cover_photos_created_by_foreign` (`created_by`),
  ADD KEY `cover_photos_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`faq_id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`),
  ADD KEY `team_1_id` (`team_1_id`),
  ADD KEY `team_2_id` (`team_2_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `games_field_fk` (`park_field_id`),
  ADD KEY `game_type` (`game_type`),
  ADD KEY `game_date` (`game_date`),
  ADD KEY `season` (`season`),
  ADD KEY `club_1_id` (`club_1_id`),
  ADD KEY `club_2_id` (`club_2_id`),
  ADD KEY `idx_games_season` (`season`),
  ADD KEY `idx_games_date` (`game_date`),
  ADD KEY `idx_games_season_date` (`season`,`game_date`),
  ADD KEY `idx_games_season_club1` (`season`,`club_1_id`),
  ADD KEY `idx_games_season_club2` (`season`,`club_2_id`),
  ADD KEY `idx_games_season_type` (`season`,`game_type`),
  ADD KEY `idx_games_winner` (`winner`),
  ADD KEY `idx_games_field` (`park_field_id`);

--
-- Indexes for table `game_innings`
--
ALTER TABLE `game_innings`
  ADD PRIMARY KEY (`inning_id`);

--
-- Indexes for table `game_stats`
--
ALTER TABLE `game_stats`
  ADD PRIMARY KEY (`game_stat_id`),
  ADD UNIQUE KEY `game_stats_game_player_unique` (`game_id`,`player_id`),
  ADD KEY `player_id` (`player_id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `updated_by` (`updated_by`);

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
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `media_created_by_fk` (`created_by`),
  ADD KEY `media_updated_by_fk` (`updated_by`);

--
-- Indexes for table `media_tags`
--
ALTER TABLE `media_tags`
  ADD PRIMARY KEY (`media_tag_id`),
  ADD KEY `media_tags_media_id_fk` (`media_id`),
  ADD KEY `media_tags_tag_id_fk` (`tag_id`),
  ADD KEY `media_tags_updated_by_fk` (`updated_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parks`
--
ALTER TABLE `parks`
  ADD PRIMARY KEY (`park_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `state_id` (`state_id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `park_fields`
--
ALTER TABLE `park_fields`
  ADD PRIMARY KEY (`field_id`),
  ADD KEY `park_id` (`park_id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`player_id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `college_id` (`college_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `last_name` (`last_name`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `idx_players_last_name` (`last_name`),
  ADD KEY `idx_players_full_name` (`first_name`,`last_name`),
  ADD KEY `idx_players_college` (`college_id`);

--
-- Indexes for table `player_claim_requests`
--
ALTER TABLE `player_claim_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `player_claim_requests_reviewed_by_foreign` (`reviewed_by`),
  ADD KEY `player_claim_requests_status_created_at_index` (`status`,`created_at`),
  ADD KEY `player_claim_requests_user_status_index` (`user_id`,`status`),
  ADD KEY `player_claim_requests_player_status_index` (`player_id`,`status`);

--
-- Indexes for table `player_images`
--
ALTER TABLE `player_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `player_images_player_id_image_type_index` (`player_id`,`image_type`),
  ADD KEY `player_images_player_id_image_type_active_index` (`player_id`,`image_type`,`active`);

--
-- Indexes for table `player_teams`
--
ALTER TABLE `player_teams`
  ADD PRIMARY KEY (`player_team_id`),
  ADD UNIQUE KEY `player_teams_club_season_player_unique` (`club_id`,`season`,`player_id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `player_id` (`player_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `season` (`season`),
  ADD KEY `club_id` (`club_id`),
  ADD KEY `idx_player_teams_season` (`season`),
  ADD KEY `idx_player_teams_club` (`club_id`),
  ADD KEY `idx_player_teams_player` (`player_id`),
  ADD KEY `idx_player_teams_season_club` (`season`,`club_id`),
  ADD KEY `idx_player_teams_season_player` (`season`,`player_id`);

--
-- Indexes for table `playoff_brackets`
--
ALTER TABLE `playoff_brackets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `playoff_brackets_season_division_index` (`season`,`division`);

--
-- Indexes for table `playoff_matchups`
--
ALTER TABLE `playoff_matchups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `playoff_matchups_team1_id_foreign` (`team1_id`),
  ADD KEY `playoff_matchups_team2_id_foreign` (`team2_id`),
  ADD KEY `playoff_matchups_winner_id_foreign` (`winner_id`),
  ADD KEY `playoff_matchups_advances_to_matchup_id_foreign` (`advances_to_matchup_id`),
  ADD KEY `playoff_matchups_playoff_round_id_matchup_number_index` (`playoff_round_id`,`matchup_number`);

--
-- Indexes for table `playoff_rounds`
--
ALTER TABLE `playoff_rounds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `playoff_rounds_playoff_bracket_id_round_number_index` (`playoff_bracket_id`,`round_number`);

--
-- Indexes for table `playoff_seeds`
--
ALTER TABLE `playoff_seeds`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `playoff_seeds_playoff_bracket_id_club_id_unique` (`playoff_bracket_id`,`club_id`),
  ADD UNIQUE KEY `playoff_seeds_bracket_division_seed_unique` (`playoff_bracket_id`,`division`,`seed`),
  ADD KEY `playoff_seeds_club_id_foreign` (`club_id`);

--
-- Indexes for table `postseason_stats_total`
--
ALTER TABLE `postseason_stats_total`
  ADD PRIMARY KEY (`season_stat_id`),
  ADD KEY `player_id` (`player_id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`school_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `sa_name` (`sa_name`);

--
-- Indexes for table `scouting_videos`
--
ALTER TABLE `scouting_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scouting_videos_player_id_foreign` (`player_id`);

--
-- Indexes for table `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seasons_year_unique` (`year`);

--
-- Indexes for table `season_stats`
--
ALTER TABLE `season_stats`
  ADD PRIMARY KEY (`season_stat_id`),
  ADD KEY `player_id` (`player_id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `season_teams`
--
ALTER TABLE `season_teams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `season_teams_season_club_id_unique` (`season`,`club_id`),
  ADD KEY `season_teams_club_id_foreign` (`club_id`),
  ADD KEY `season_teams_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `season_team_user`
--
ALTER TABLE `season_team_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `season_team_user_season_team_id_user_id_unique` (`season_team_id`,`user_id`),
  ADD KEY `season_team_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `season_weeks`
--
ALTER TABLE `season_weeks`
  ADD PRIMARY KEY (`season_weeks_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`sponsor_id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `fk_staff_organization` (`organization_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `organization_id` (`organization_id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `team_coaches`
--
ALTER TABLE `team_coaches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_coaches_club_id_season_staff_id_unique` (`club_id`,`season`,`staff_id`),
  ADD KEY `team_coaches_club_id_season_index` (`club_id`,`season`),
  ADD KEY `team_coaches_staff_id_index` (`staff_id`);

--
-- Indexes for table `team_stats_game`
--
ALTER TABLE `team_stats_game`
  ADD PRIMARY KEY (`team_stat_game_id`),
  ADD KEY `team_stats_game_club_id_season_index` (`club_id`,`season`),
  ADD KEY `team_stats_game_game_id_index` (`game_id`);

--
-- Indexes for table `team_stats_post`
--
ALTER TABLE `team_stats_post`
  ADD PRIMARY KEY (`team_stat_post_id`),
  ADD UNIQUE KEY `team_stats_post_club_id_season_unique` (`club_id`,`season`);

--
-- Indexes for table `team_stats_regular`
--
ALTER TABLE `team_stats_regular`
  ADD PRIMARY KEY (`team_stat_regular_id`),
  ADD UNIQUE KEY `team_stats_regular_club_id_season_unique` (`club_id`,`season`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_claimed_player_id_unique` (`claimed_player_id`);

--
-- Indexes for table `user_requested_data_additions`
--
ALTER TABLE `user_requested_data_additions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_requested_data_additions_user_id_foreign` (`user_id`),
  ADD KEY `user_requested_data_additions_player_id_index` (`player_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `awarded_players`
--
ALTER TABLE `awarded_players`
  MODIFY `awarded_players_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `award_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_post_tags`
--
ALTER TABLE `blog_post_tags`
  MODIFY `post_tag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_tags`
--
ALTER TABLE `blog_tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities_old`
--
ALTER TABLE `cities_old`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `club_stats`
--
ALTER TABLE `club_stats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coach_activity_logs`
--
ALTER TABLE `coach_activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coach_messages`
--
ALTER TABLE `coach_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coach_suggestions`
--
ALTER TABLE `coach_suggestions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `college_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_inquiries`
--
ALTER TABLE `contact_inquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cover_photos`
--
ALTER TABLE `cover_photos`
  MODIFY `cover_photo_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `game_innings`
--
ALTER TABLE `game_innings`
  MODIFY `inning_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `game_stats`
--
ALTER TABLE `game_stats`
  MODIFY `game_stat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media_tags`
--
ALTER TABLE `media_tags`
  MODIFY `media_tag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parks`
--
ALTER TABLE `parks`
  MODIFY `park_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `park_fields`
--
ALTER TABLE `park_fields`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `player_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `player_claim_requests`
--
ALTER TABLE `player_claim_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `player_images`
--
ALTER TABLE `player_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `player_teams`
--
ALTER TABLE `player_teams`
  MODIFY `player_team_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `playoff_brackets`
--
ALTER TABLE `playoff_brackets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `playoff_matchups`
--
ALTER TABLE `playoff_matchups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `playoff_rounds`
--
ALTER TABLE `playoff_rounds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `playoff_seeds`
--
ALTER TABLE `playoff_seeds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `postseason_stats_total`
--
ALTER TABLE `postseason_stats_total`
  MODIFY `season_stat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `school_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scouting_videos`
--
ALTER TABLE `scouting_videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `season_stats`
--
ALTER TABLE `season_stats`
  MODIFY `season_stat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `season_teams`
--
ALTER TABLE `season_teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `season_team_user`
--
ALTER TABLE `season_team_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `season_weeks`
--
ALTER TABLE `season_weeks`
  MODIFY `season_weeks_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `sponsor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `state_id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_coaches`
--
ALTER TABLE `team_coaches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_stats_game`
--
ALTER TABLE `team_stats_game`
  MODIFY `team_stat_game_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_stats_post`
--
ALTER TABLE `team_stats_post`
  MODIFY `team_stat_post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_stats_regular`
--
ALTER TABLE `team_stats_regular`
  MODIFY `team_stat_regular_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_requested_data_additions`
--
ALTER TABLE `user_requested_data_additions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clubs`
--
ALTER TABLE `clubs`
  ADD CONSTRAINT `clubs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `club_stats`
--
ALTER TABLE `club_stats`
  ADD CONSTRAINT `club_stats_club_id_foreign` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coach_activity_logs`
--
ALTER TABLE `coach_activity_logs`
  ADD CONSTRAINT `coach_activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `coach_messages`
--
ALTER TABLE `coach_messages`
  ADD CONSTRAINT `coach_messages_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `coach_suggestions`
--
ALTER TABLE `coach_suggestions`
  ADD CONSTRAINT `coach_suggestions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `contact_inquiries`
--
ALTER TABLE `contact_inquiries`
  ADD CONSTRAINT `contact_inquiries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `cover_photos`
--
ALTER TABLE `cover_photos`
  ADD CONSTRAINT `cover_photos_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `cover_photos_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `player_claim_requests`
--
ALTER TABLE `player_claim_requests`
  ADD CONSTRAINT `player_claim_requests_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `player_claim_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `player_images`
--
ALTER TABLE `player_images`
  ADD CONSTRAINT `player_images_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`) ON DELETE CASCADE;

--
-- Constraints for table `playoff_matchups`
--
ALTER TABLE `playoff_matchups`
  ADD CONSTRAINT `playoff_matchups_advances_to_matchup_id_foreign` FOREIGN KEY (`advances_to_matchup_id`) REFERENCES `playoff_matchups` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `playoff_matchups_playoff_round_id_foreign` FOREIGN KEY (`playoff_round_id`) REFERENCES `playoff_rounds` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `playoff_matchups_team1_id_foreign` FOREIGN KEY (`team1_id`) REFERENCES `clubs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `playoff_matchups_team2_id_foreign` FOREIGN KEY (`team2_id`) REFERENCES `clubs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `playoff_matchups_winner_id_foreign` FOREIGN KEY (`winner_id`) REFERENCES `clubs` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `playoff_rounds`
--
ALTER TABLE `playoff_rounds`
  ADD CONSTRAINT `playoff_rounds_playoff_bracket_id_foreign` FOREIGN KEY (`playoff_bracket_id`) REFERENCES `playoff_brackets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `playoff_seeds`
--
ALTER TABLE `playoff_seeds`
  ADD CONSTRAINT `playoff_seeds_club_id_foreign` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `playoff_seeds_playoff_bracket_id_foreign` FOREIGN KEY (`playoff_bracket_id`) REFERENCES `playoff_brackets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `scouting_videos`
--
ALTER TABLE `scouting_videos`
  ADD CONSTRAINT `scouting_videos_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`) ON DELETE CASCADE;

--
-- Constraints for table `season_teams`
--
ALTER TABLE `season_teams`
  ADD CONSTRAINT `season_teams_club_id_foreign` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `season_teams_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `season_team_user`
--
ALTER TABLE `season_team_user`
  ADD CONSTRAINT `season_team_user_season_team_id_foreign` FOREIGN KEY (`season_team_id`) REFERENCES `season_teams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `season_team_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `team_coaches`
--
ALTER TABLE `team_coaches`
  ADD CONSTRAINT `team_coaches_club_id_foreign` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_requested_data_additions`
--
ALTER TABLE `user_requested_data_additions`
  ADD CONSTRAINT `user_requested_data_additions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
