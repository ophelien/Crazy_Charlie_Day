
/*!40101 SET NAMES utf8 */;

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
  `admin` int(1) NOT NULL DEFAULT 0,
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idGroupe` int(11) NOT NULL,
  `urlInvitation` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `urlGestion` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `estOk` int(1) NOT NULL DEFAULT 0,
  CONSTRAINT FK_appartient_groupe FOREIGN KEY (idGroupe) REFERENCES `groupe`(idGroupe),
  CONSTRAINT FK_appartient_user FOREIGN KEY (email) REFERENCES `user`(email),
  PRIMARY KEY (`id`)
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

INSERT INTO `user` (`email`, `mdp`, `nom`, `message`, `admin`) VALUES
('jeanne@gmail.com', 'MDP', 'Jeanne', 'aime la musique ♫',0),
('paul@gmail.com', 'MDP', 'Paul', 'aime cuisiner ♨ ♪',0),
('myriam@gmail.com', 'MDP', 'Myriam', 'mange Halal ☪',0),
('nicolas@gmail.com', 'MDP', 'Nicolas', 'ouvert à tous ⛄',0),
('sophie@gmail.com', 'MDP', 'Sophie', 'aime sortir ♛',0),
('karim@gmail.com', 'MDP', 'Karim', 'aime le soleil ☀',0),
('julie@gmail.com', 'MDP', 'Julie', 'apprécie le calme ☕',0),
('etienne@gmail.com', 'MDP', 'Etienne', 'accepte jeunes et vieux ☯',0),
('max@gmail.com', 'MDP', 'Max', 'féru de musique moderne ☮',0),
('sabrina@gmail.com', 'MDP', 'Sabrina', 'aime les repas en commun ⛵☻',0),
('nathalie@gmail.com', 'MDP', 'Nathalie', 'bricoleuse ⛽',0),
('martin@gmail.com', 'MDP', 'Martin', 'sportif ☘ ⚽ ⚾ ⛳',0),
('manon@gmail.com', 'MDP', 'Manon', '',0),
('thomas@gmail.com', 'MDP', 'Thomas', '',0),
('lea@gmail.com', 'MDP', 'Léa', '',0),
('alexandre@gmail.com', 'MDP', 'Alexandre', '',0),
('camille@gmail.com', 'MDP', 'Camille', '',0),
('quentin@gmail.com', 'MDP', 'Quentin', '',0),
('marie@gmail.com', 'MDP', 'Marie', '',0),
('antoine@gmail.com', 'MDP', 'Antoine', '',0),
('laura@gmail.com', 'MDP', 'Laura', '',0),
('julien@gmail.com', 'MDP', 'Julien', '',0),
('pauline@gmail.com', 'MDP', 'Pauline', '',0),
('lucas@gmail.com', 'MDP', 'Lucas', '',0),
('sarah@gmail.com', 'MDP', 'Sarah', '',0),
('romain@gmail.com', 'MDP', 'Romain', '',0),
('mathilde@gmail.com', 'MDP', 'Mathilde', '',0),
('florian@gmail.com', 'MDP', 'Florian', '',0);

