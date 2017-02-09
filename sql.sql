
/*!40101 SET NAMES utf8 */;

CREATE TABLE IF NOT EXISTS `logement` (
  `idLogement` int(11) NOT NULL AUTO_INCREMENT,
  `places` int(11) NOT NULL,
  PRIMARY KEY (`idLogement`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nom` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `groupe` (
  `idGroupe` int(11) NOT NULL AUTO_INCREMENT,
  `estValidee` int(1) NOT NULL DEFAULT 0,
  `idLogement` int(11),
  CONSTRAINT FK_groupe_logement FOREIGN KEY (idLogement) REFERENCES `logement`(idLogement),
  PRIMARY KEY (`idGroupe`)
);

CREATE TABLE IF NOT EXISTS `appartient` (
  `email` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idGroupe` int(11) NOT NULL,
  `urlGestion` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `urlInvitation` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `estOk` int(1) NOT NULL DEFAULT 0,
  CONSTRAINT FK_appartient_groupe FOREIGN KEY (idGroupe) REFERENCES `groupe`(idGroupe),
  CONSTRAINT FK_appartient_user FOREIGN KEY (email) REFERENCES `user`(email),
  PRIMARY KEY (`email`,`idGroupe`)
);

INSERT INTO `logement` (`idLogement`, `places`) VALUES
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

INSERT INTO `user` (`email`, `nom`, `message`) VALUES
('jeanne@gmail.com', 'Jeanne', 'aime la musique ♫'),
('paul@gmail.com', 'Paul', 'aime cuisiner ♨ ♪'),
('myriam@gmail.com', 'Myriam', 'mange Halal ☪'),
('nicolas@gmail.com', 'Nicolas', 'ouvert à tous ⛄'),
('sophie@gmail.com', 'Sophie', 'aime sortir ♛'),
('karim@gmail.com', 'Karim', 'aime le soleil ☀'),
('julie@gmail.com', 'Julie', 'apprécie le calme ☕'),
('etienne@gmail.com', 'Etienne', 'accepte jeunes et vieux ☯'),
('max@gmail.com', 'Max', 'féru de musique moderne ☮'),
('sabrina@gmail.com', 'Sabrina', 'aime les repas en commun ⛵☻'),
('nathalie@gmail.com', 'Nathalie', 'bricoleuse ⛽'),
('martin@gmail.com', 'Martin', 'sportif ☘ ⚽ ⚾ ⛳'),
('manon@gmail.com', 'Manon', ''),
('thomas@gmail.com', 'Thomas', ''),
('lea@gmail.com', 'Léa', ''),
('alexandre@gmail.com', 'Alexandre', ''),
('camille@gmail.com', 'Camille', ''),
('quentin@gmail.com', 'Quentin', ''),
('marie@gmail.com', 'Marie', ''),
('antoine@gmail.com', 'Antoine', ''),
('laura@gmail.com', 'Laura', ''),
('julien@gmail.com', 'Julien', ''),
('pauline@gmail.com', 'Pauline', ''),
('lucas@gmail.com', 'Lucas', ''),
('sarah@gmail.com', 'Sarah', ''),
('romain@gmail.com', 'Romain', ''),
('mathilde@gmail.com', 'Mathilde', ''),
('florian@gmail.com', 'Florian', '');

