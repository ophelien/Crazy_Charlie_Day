
/*!40101 SET NAMES utf8 */;

CREATE TABLE IF NOT EXISTS `admin` (
  `admin` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `logement` (
  `idLogement` int(11) NOT NULL AUTO_INCREMENT,
  `places` int(11) NOT NULL,
  PRIMARY KEY (`idLogement`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mdp` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `message` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `groupe` (
  `idGroupe` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(1) NOT NULL DEFAULT 0,
  `idLogement` int(11),
  CONSTRAINT FK_groupe_logement FOREIGN KEY (idLogement) REFERENCES `logement`(idLogement),
  PRIMARY KEY (`idGroupe`)
);

CREATE TABLE IF NOT EXISTS `appartient` (
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idGroupe` int(11) NOT NULL,
  `urlInvitation` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `urlGestion` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci,
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

INSERT INTO `user` (`email`, `mdp`, `nom`, `message`) VALUES
('jeanne@gmail.com', 'MDP', 'Jeanne', 'aime la musique ♫'),
('paul@gmail.com', 'MDP', 'Paul', 'aime cuisiner ♨ ♪'),
('myriam@gmail.com', 'MDP', 'Myriam', 'mange Halal ☪'),
('nicolas@gmail.com', 'MDP', 'Nicolas', 'ouvert à tous ⛄'),
('sophie@gmail.com', 'MDP', 'Sophie', 'aime sortir ♛'),
('karim@gmail.com', 'MDP', 'Karim', 'aime le soleil ☀'),
('julie@gmail.com', 'MDP', 'Julie', 'apprécie le calme ☕'),
('etienne@gmail.com', 'MDP', 'Etienne', 'accepte jeunes et vieux ☯'),
('max@gmail.com', 'MDP', 'Max', 'féru de musique moderne ☮'),
('sabrina@gmail.com', 'MDP', 'Sabrina', 'aime les repas en commun ⛵☻'),
('nathalie@gmail.com', 'MDP', 'Nathalie', 'bricoleuse ⛽'),
('martin@gmail.com', 'MDP', 'Martin', 'sportif ☘ ⚽ ⚾ ⛳'),
('manon@gmail.com', 'MDP', 'Manon', ''),
('thomas@gmail.com', 'MDP', 'Thomas', ''),
('lea@gmail.com', 'MDP', 'Léa', ''),
('alexandre@gmail.com', 'MDP', 'Alexandre', ''),
('camille@gmail.com', 'MDP', 'Camille', ''),
('quentin@gmail.com', 'MDP', 'Quentin', ''),
('marie@gmail.com', 'MDP', 'Marie', ''),
('antoine@gmail.com', 'MDP', 'Antoine', ''),
('laura@gmail.com', 'MDP', 'Laura', ''),
('julien@gmail.com', 'MDP', 'Julien', ''),
('pauline@gmail.com', 'MDP', 'Pauline', ''),
('lucas@gmail.com', 'MDP', 'Lucas', ''),
('sarah@gmail.com', 'MDP', 'Sarah', ''),
('romain@gmail.com', 'MDP', 'Romain', ''),
('mathilde@gmail.com', 'MDP', 'Mathilde', ''),
('florian@gmail.com', 'MDP', 'Florian', '');

