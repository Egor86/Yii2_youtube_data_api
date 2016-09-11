-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.1.10-MariaDB - mariadb.org binary distribution
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица my_game.singer
CREATE TABLE IF NOT EXISTS `singer` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Экспортируемые данные не выделены.


-- Дамп структуры для таблица my_game.video
CREATE TABLE IF NOT EXISTS `video` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `video_id` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `view_count` int(10) unsigned DEFAULT NULL,
  `id_singer` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1_id_singer` (`id_singer`),
  CONSTRAINT `FK1_id_singer` FOREIGN KEY (`id_singer`) REFERENCES `singer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Экспортируемые данные не выделены.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
