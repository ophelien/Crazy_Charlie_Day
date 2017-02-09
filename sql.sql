
/*!40101 SET NAMES utf8 */;

CREATE TABLE IF NOT EXISTS `logement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `places` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;


INSERT INTO `logement` (`id`, `places`) VALUES
(1, 3),
(2, 3),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(7, 4),
(8, 5),
(9, 5),
(10, 6),
(11, 6),
(12, 6),
(13, 7),
(14, 7),
(15, 8),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3);


CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;


INSERT INTO `user` (`id`, `nom`, `message`) VALUES
(1, 'Jeanne', 'aime la musique ♫'),
(2, 'Paul', 'aime cuisiner ♨ ♪'),
(3, 'Myriam', 'mange Halal ☪'),
(4, 'Nicolas', 'ouvert à tous ⛄'),
(5, 'Sophie', 'aime sortir ♛'),
(6, 'Karim', 'aime le soleil ☀'),
(7, 'Julie', 'apprécie le calme ☕'),
(8, 'Etienne', 'accepte jeunes et vieux ☯'),
(9, 'Max', 'féru de musique moderne ☮'),
(10, 'Sabrina', 'aime les repas en commun ⛵☻'),
(11, 'Nathalie', 'bricoleuse ⛽'),
(12, 'Martin', 'sportif ☘ ⚽ ⚾ ⛳'),
(13, 'Manon', ''),
(14, 'Thomas', ''),
(15, 'Léa', ''),
(16, 'Alexandre', ''),
(17, 'Camille', ''),
(18, 'Quentin', ''),
(19, 'Marie', ''),
(20, 'Antoine', ''),
(21, 'Laura', ''),
(22, 'Julien', ''),
(23, 'Pauline', ''),
(24, 'Lucas', ''),
(25, 'Sarah', ''),
(26, 'Romain', ''),
(27, 'Mathilde', ''),
(28, 'Florian', '');

