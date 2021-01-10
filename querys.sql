-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.16-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para twitter
CREATE DATABASE IF NOT EXISTS `twitter` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `twitter`;

-- Copiando estrutura para tabela twitter.tweets
CREATE TABLE IF NOT EXISTS `tweets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `tweet` varchar(280) COLLATE utf8_unicode_ci NOT NULL,
  `data` datetime DEFAULT current_timestamp(),
  `image` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela twitter.tweets: ~36 rows (aproximadamente)
/*!40000 ALTER TABLE `tweets` DISABLE KEYS */;
INSERT INTO `tweets` (`id`, `id_user`, `tweet`, `data`, `image`) VALUES
	(1, 1, 'será que estou existindo ou apenas vivendo a base de neosoro', '2021-01-02 15:23:44', ''),
	(3, 1, 'aaaaaaaaaaaaa', '2021-01-02 17:00:18', NULL),
	(4, 1, 'publicando tweet', '2021-01-02 18:58:03', NULL),
	(5, 1, 'vish nao tenho twelves', '2021-01-04 22:17:17', NULL),
	(6, 2, 'meu primeiro tweet galera', '2021-01-04 22:18:06', NULL),
	(7, 2, 'caixa de areia apenas', '2021-01-04 22:18:14', NULL),
	(8, 6, 'metal raw trevas amo  metal raw', '2021-01-04 22:19:03', NULL),
	(9, 7, 'amo o taeanjo lindo taenjo perfeito luis fedido ', '2021-01-04 22:23:17', NULL),
	(10, 1, 'se fodase', '2021-01-05 22:15:34', NULL),
	(12, 1, 'DASDFSADASDASDFSADASDASDFSADASDASDFSADASDASDFSADASDASDFSADASDASDFSADASDASDFSADASDASDFSADASDASDFSADASDASDFSADASDASDFSADAS', '2021-01-06 21:38:05', NULL),
	(31, 1, 'apenas juniro barros', '2021-01-09 16:01:04', 'img/users/1/posts/juniro_200104_1.jpeg'),
	(32, 1, 'apenas', '2021-01-09 16:01:10', 'img/users/1/posts/juniro_200110_1.jpeg'),
	(34, 2, 'nice to meet u', '2021-01-09 16:04:30', 'img/users/2/posts/sandbox_200130_2.jpeg'),
	(35, 1, 'So if you\'re lonely, you know I\'m here waiting for you ', '2021-01-09 19:56:29', NULL),
	(36, 8, 'fiz tatuagem ><', '2021-01-10 12:42:25', NULL),
	(37, 8, 'oi gente descobri que a agua é transparente ', '2021-01-10 12:42:38', NULL),
	(38, 8, 'kkkkkkkk te amo mary ', '2021-01-10 12:42:50', NULL),
	(39, 9, 'se eu vou jogar no bronze tenho q pensar como um', '2021-01-10 12:52:36', NULL),
	(40, 9, 'monogamia é o carai', '2021-01-10 12:52:47', NULL),
	(41, 9, 'para de ser cringe por favor ', '2021-01-10 12:55:50', NULL),
	(42, 8, 'Skol beats de cereja', '2021-01-10 12:56:47', NULL),
	(43, 7, 'hoje tem ein fml', '2021-01-10 12:58:37', NULL),
	(44, 7, 'eu tenho muita energia pra ser gasta dançando me chamem pra dançar eu gosto de dançar', '2021-01-10 12:59:00', NULL),
	(45, 7, 'aaaaa iiiiii iiiiiii ah oh uhhhh', '2021-01-10 12:59:12', NULL),
	(46, 6, 'metal rawraw raw ', '2021-01-10 13:07:14', NULL),
	(47, 6, 'R.i.p Alexi Laiho ', '2021-01-10 13:08:13', NULL),
	(48, 12, 'horimiya e mt bom', '2021-01-10 13:08:53', NULL),
	(49, 12, '50 skin da akali', '2021-01-10 13:08:59', NULL),
	(50, 12, 'vou comer pao', '2021-01-10 13:09:02', NULL),
	(51, 13, 'pato papao', '2021-01-10 13:10:02', NULL),
	(52, 13, 'oi eu so fofo :3', '2021-01-10 13:10:06', NULL),
	(53, 14, 'apenas fãs', '2021-01-10 13:11:06', NULL),
	(54, 14, 'aaaaAAAAAAAaaa', '2021-01-10 13:11:37', NULL),
	(55, 14, 'Sabia q eu so meio homo sapiens', '2021-01-10 13:11:42', NULL),
	(56, 1, 'homem bonito na timeline', '2021-01-10 13:13:38', 'img/users/1/posts/juniro _170138_1.jpeg'),
	(57, 1, 'teste tweet', '2021-01-10 16:34:50', 'img/users/1/posts/juniro _200150_1.png');
/*!40000 ALTER TABLE `tweets` ENABLE KEYS */;

-- Copiando estrutura para tabela twitter.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `bio` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `aniversary` date DEFAULT NULL,
  `image` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela twitter.users: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `bio`, `location`, `aniversary`, `image`) VALUES
	(1, 'juniro ', 'juniro@mail.com', 'e10adc3949ba59abbe56e057f20f883e', 'home sweet home', 'Eu', '2011-10-08', 'img/users/1/profile/profile_user_1.png'),
	(2, 'areia caixa', 'sandbox@mail.com', '332e1ffa4d17de05803923eaa4850180', 'caixa', 'sim', '2003-10-10', 'img/users/2/profile/profile_user_2.jpeg'),
	(3, 'caixa de areia', 'sandbox2@mail.com', '34f71b78c2f0a70d6ff5666a3eb5506f', NULL, NULL, NULL, NULL),
	(5, 'Teste', 'teste@mail.com', '698dc19d489c4e4db73e28a713eab07b', NULL, NULL, NULL, NULL),
	(6, 'mecanico do black metal', 'vendreu@lobto.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '2021-01-19', 'img/users/6/profile/profile_user_6.jpeg'),
	(7, 'kriss', 'keirusutina@mail.com', 'e10adc3949ba59abbe56e057f20f883e', 'sim', '', '2019-02-11', 'img/users/7/profile/profile_user_7.jpeg'),
	(8, 'Pequena Mary', 'litlemary@mail.com', 'e10adc3949ba59abbe56e057f20f883e', 'oi gente cortei o cabelo gostaram', 'casa', '2021-01-20', 'img/users/8/profile/profile_user_8.jpeg'),
	(9, 'mamon senha', 'branquinhofer@mail.com', 'e10adc3949ba59abbe56e057f20f883e', 'monogamia eh o carai', '', '2021-01-05', 'img/users/9/profile/profile_user_9.jpeg'),
	(12, 'lukriss', 'lukriss@mail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '1990-10-08', 'img/users/12/profile/profile_user_12.jpeg'),
	(13, 'teteu arruda', 'teteu@mail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '2001-10-08', 'img/users/13/profile/profile_user_13.jpeg'),
	(14, 'lais', 'lalaisnenis@mail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '2005-02-15', 'img/users/14/profile/profile_user_14.jpeg');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Copiando estrutura para tabela twitter.user_followers
CREATE TABLE IF NOT EXISTS `user_followers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_user_following` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela twitter.user_followers: ~16 rows (aproximadamente)
/*!40000 ALTER TABLE `user_followers` DISABLE KEYS */;
INSERT INTO `user_followers` (`id`, `id_user`, `id_user_following`) VALUES
	(51, 1, 3),
	(52, 1, 2),
	(53, 6, 1),
	(54, 1, 6),
	(56, 2, 1),
	(57, 8, 1),
	(58, 9, 1),
	(59, 1, 7),
	(60, 1, 12),
	(61, 12, 1),
	(64, 1, 9),
	(65, 1, 8),
	(67, 1, 14),
	(68, 1, 13),
	(69, 1, 4),
	(70, 1, 4);
/*!40000 ALTER TABLE `user_followers` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
