CREATE TABLE IF NOT EXISTS `answers` (
  `examid` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer` varchar(255) COLLATE utf8_bin NOT NULL,
  `evaluation` int(11) NOT NULL,
  `explanation` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=300 ;