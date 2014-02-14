CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic` varchar(255) COLLATE utf8_bin NOT NULL,
  `question` text CHARACTER SET utf8 NOT NULL,
  `startDate` date NOT NULL,
  `author` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='exam' AUTO_INCREMENT=1 ;
