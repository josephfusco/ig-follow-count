CREATE DATABASE `9recent` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE `9recent`;

CREATE TABLE IF NOT EXISTS `IG_Users` (
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_comments` int(11) DEFAULT NULL,
  `total_likes` int(11) DEFAULT NULL,
  `avg_likes` int(11) DEFAULT NULL,
  `engagement_ratio` decimal(10,2) DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_stamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `num_followers` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;