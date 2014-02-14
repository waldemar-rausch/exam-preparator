CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickName` varchar(155) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(155) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `isAdmin` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
