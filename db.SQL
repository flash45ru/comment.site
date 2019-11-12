
SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `create_date` varchar(255) NOT NULL,
  `update_date` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `admin_update` int(1) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `comment` (`id`, `name`, `email`, `comment`, `create_date`, `update_date`, `status`, `admin_update`, `image`) VALUES
(1,	'Test Comment',	'test.comment@mail.ru',	'В архиве есть контроллер, модель и миграции указанного выше проекта (с демо данными) для демонстрации работы API, на базе которых можно создавать свои.\r\nТаким образом, прежде всего нужно перенести папку «api» из архива в корень проекта. Далее перенести файлы миграций в папку с миграциями (console\\migrations) и применить миграции.\r\nТак же, желательно, дополнить папку environments проекта файлами из архива, чтобы после клонирования проекта и выполнения команды php init, локальные файлы типа «index.php», «main-local.php» и тд. создавались автоматически в своих папках. Если команда init уже выполнялась (т.е. API создается для уже действующего проекта), то на другом компьютере после команды git pull просто скопировать файлы из папки environments в соответствующие папки каталога «api».',	'1573128543',	NULL,	1,	NULL,	'upload/images/comments/1.jpeg'),
(2,	'Comment Test',	'comment.test@mail.ru',	'В архиве, есть контроллер, модель и миграции указанного выше проекта (с демо данными) для демонстрации работы API, на базе которых можно создавать свои. Таким образом, прежде всего нужно перенести папку «api» из архива в корень проекта. Далее перенести файлы миграций в папку с миграциями (console\\migrations) и применить миграции. Так же, желательно, дополнить папку environments проекта файлами из архива, чтобы после клонирования проекта и выполнения команды php init, локальные файлы типа «index.php», «main-local.php» и тд. создавались автоматически в своих папках. Если команда init уже выполнялась (т.е. API создается для уже действующего проекта), то на другом компьютере после команды git pull просто скопировать файлы из папки environments в соответствующие папки каталога «api».',	'1573559501',	'1573559530',	1,	1,	NULL);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`) VALUES
(1,	'admin',	'admin@mail.ru',	'123',	'admin'),
(2,	'Guest',	'',	'',	'guest');
