-- CREAR LA BDD
CREATE DATABASE `preinscripcions` 
DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

-- USAR LA BDD
USE `preinscripcions`;

-- AREES FORMATIVES
CREATE TABLE IF NOT EXISTS `arees_formatives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ;

INSERT INTO `arees_formatives` (`id`, `nom`) VALUES
(0, 'Altres'),
(1, 'Soldadura'),
(2, 'Mecànica Convencional'),
(3, 'Disseny Mecànic'),
(4, 'Electricitat'),
(5, 'Logística'),
(6, 'Comunicacions - microinformàtica'),
(7, 'Programació i web'),
(8, 'PLCs i automatismes'),
(9, 'Pneumàtica i hidràulica'),
(10, 'e-commerce'),
(11, 'Fontanería, climatització i calefacció');

-- CURSOS
CREATE TABLE IF NOT EXISTS `cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codi` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  `id_area` int(11) NOT NULL,
  `nom` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `descripcio` text COLLATE utf8_spanish_ci NOT NULL,
  `hores` int(11) NOT NULL,
  `data_inici` date DEFAULT NULL,
  `data_fi` date DEFAULT NULL,
  `horari` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `torn` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `tipus` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `requisits` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_area` (`id_area`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ;

INSERT INTO `cursos` (`id`, `codi`, `id_area`, `nom`, `descripcio`, `hores`, `data_inici`, `data_fi`, `horari`, `torn`, `tipus`, `requisits`) VALUES
(1, '10/14', 0, 'Analisis de Persona', 'Este curso muestra como el ser humano se comparta', 600, '2016-11-30', '2017-11-01', '', 'M', 'Nivel 2 CP', 'Saber leer.\r\nSaber escribir.\r\nSaber escuchar.'),
(2, '10/15', 7, 'Desarollo de picapedrero', 'Picar teclas sin parar', 250, '2016-11-17', '2016-12-30', '8:00 a 13:00', 'M', 'CP-3', 'No tener callos en las manos'),
(3, '09/12', 4, 'CURS D''APRENDRE APRENENTATGES', 'CURS DE FORMACIÓ PER APRENDRE A ADQUIRIR CONEIXEMENTS PER APRENDRE NOVES COSES QUE ABANS NO SE SABIEN', 360, '2017-01-21', '2017-06-30', 'Dll-Dv 9 a 14', 'M', 'CP NV1', 'Saber llegir i escriure.'),
(4, '08/12', 5, 'Desmantelador de edificios', 'Aprende a desmantelar todo el material de valor de un edificio en el minimo tiempo posible ', 200, '2016-11-17', '2016-11-30', '8:00 a 13:00', 'T', 'CP-1', 'Tener predisposicion a quedarte lo que no es tuyo'),
(5, '10/13', 0, 'Aplicaciones Web', 'Robert te enseña a programar', 240, '2016-11-01', '2017-03-16', '', 'm', 'Nivel 3', 'Saber encender el ordenador \r\nHabilidad para dormir con los ojos abiertos'),
(6, '10/16', 5, 'logistica', 'Aprenentatge de tot el corresponent a la gestió d''un magatzem;des-de''l carregar i descarregar un camió, fins l´aprenentatge de la llengua anglesa per logistica', 610, '2016-11-01', '2016-11-30', 'de 15 a 18 P.M', 't', 'cp3', 'Major d''edat,resident al país,en situació d''atur i no cobrar cap prestació.'),
(7, '01/14', 11, 'Aplicacions IOS', 'Desenvolupament per al SO IOS', 90, '2016-10-10', '2016-12-05', 'de 8 a 14h, de dilluns a divendres', 'M', '1', 'ESO'),
(8, '03/06', 11, 'Aplicacions Web rares', 'Este curso trata sobre las Aplicaciones más raras que podais encontrar', 190, '2016-12-12', '2017-05-05', 'de 8 a 2', 'M', '1', 'Estudis del carrer'),
(9, '08/09', 10, 'Crea un tenda online Prestashop', 'Creació d''una tenda amb el gestor de conteninguts Prestashop.', 450, '2016-11-30', '2017-04-07', '9:00 - 12:00', 'M', 'CIFO', 'E.S.O'),
(10, '', 1, 'Curs de Xispes', 'Curs per aprendre a fer xispassos amb cablejat electric d''alta, mitja i baixa tensió.\r\n\r\nEs faran pràctiques tant amb corrent alterna, contínua i ficticia.', 240, '2017-01-07', '2017-04-22', 'Dll-Dv 9 a 13', 'M', 'SC', 'Tenir coneixements i experièncie en desfibriladors musculars, pel que pugui passar...'),
(11, '', 1, 'Curs de Xispes', 'Curs per aprendre a fer xispassos amb cablejat electric d''alta, mitja i baixa tensió.\n\nEs faran pràctiques tant amb corrent alterna, contínua i ficticia.', 240, '2017-01-07', '2017-04-22', 'Dll-Dv 9 a 13', 'M', 'SC', 'Tenir coneixements i experièncie en desfibriladors musculars, pel que pugui passar...'),
(12, '01/07', 0, 'Magia negra', 'Apren a fer mises negres o com a mínim de color gris', 666, '2016-11-18', '2017-07-14', '9:00 - 12:00', 'M', 'Subvencionat ', 'Batxillerat'),
(13, '04/16', 4, 'La electricitat y les seves conexions al món mundial', 'Aquest curs aprofundeix en els temes bàsics de seguretat electricificada.', 350, '2016-11-16', '2017-03-15', '9:00-14:00', 'm', 'CP nivell 2', 'Estar en situació de atur i tenir coneixements mínins d''electricitat.'),
(14, '20/16', 5, 'Carretillero', 'Curs per treure''t el carnet de carretiller.', 400, '2016-11-15', '2016-01-16', '15:00-18:00', 't', 'CP nivell 2', 'Tenir estudis primaris.'),
(15, '02/14', 1, 'soldadura amb alumini', 'apendre a soldar i crear objecte amb l''alumini,', 380, '2016-11-01', '2017-03-09', '9:00-14:00', 'm', 'CP nivell 2', 'estar en situació d''atur\r\ntenir el títol de graduat'),
(16, '01/17', 11, 'curs d''instal·lacions de fontaneria i climatització', 'aprenentatge en instal·lacions de fontaneria i climatització', 15, NULL, NULL, '', '', '', ''),
(17, '', 1, 'Cuinar crispetes', 'Curs per aprendre a fer crispetes a partir de les boletes de blat de moro.\n\nEs faran pràctiques de crispetes dolces i salades. Despres del curs, anirem al cine i ens les menjarem totes.', 24, '2017-01-17', '2017-01-22', 'Dll-Dv 17 a 20', 'M', 'SC', 'Tenir coneixements i experiència en el tast de crispetes.');

-- PREINSCRIPCIONS
CREATE TABLE IF NOT EXISTS `preinscripcions` (
  `id_usuari` int(11) NOT NULL,
  `id_curs` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuari`,`id_curs`),
  KEY `id_curs` (`id_curs`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `preinscripcions` (`id_usuari`, `id_curs`, `data`) VALUES
(2, 1, '2016-11-16 11:39:58'),
(2, 3, '2016-11-16 11:39:58'),
(3, 2, '2016-11-16 11:39:58'),
(4, 5, '2016-11-16 11:39:58'),
(4, 7, '2016-11-16 11:39:58'),
(5, 8, '2016-11-16 11:39:58'),
(6, 3, '2016-11-16 11:40:18'),
(6, 6, '2016-11-16 11:40:18'),
(6, 7, '2016-11-16 11:40:34'),
(7, 1, '2016-11-16 11:40:34'),
(8, 2, '2016-11-16 11:40:34'),
(8, 6, '2016-11-16 11:40:34'),
(9, 11, '2016-11-16 12:04:44'),
(9, 16, '2016-11-16 12:04:44'),
(10, 9, '2016-11-16 12:05:00'),
(10, 11, '2016-11-16 11:44:48'),
(11, 15, '2016-11-16 12:05:00');

-- SUBSCRIPCIONS
CREATE TABLE IF NOT EXISTS `subscripcions` (
  `id_usuari` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuari`,`id_area`),
  KEY `id_area` (`id_area`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `subscripcions` (`id_usuari`, `id_area`, `data`) VALUES
(2, 3, '2016-11-16 12:05:14'),
(2, 2, '2016-11-16 12:05:14'),
(3, 4, '2016-11-16 12:05:14'),
(4, 8, '2016-11-16 12:05:14'),
(5, 3, '2016-11-16 12:05:14'),
(4, 5, '2016-11-16 12:05:14'),
(3, 6, '2016-11-16 12:05:14'),
(5, 5, '2016-11-16 12:05:14'),
(6, 3, '2016-11-16 12:05:14'),
(7, 3, '2016-11-16 12:05:14'),
(8, 11, '2016-11-16 12:05:14'),
(8, 9, '2016-11-16 12:05:23'),
(8, 2, '2016-11-16 12:05:14'),
(9, 3, '2016-11-16 12:05:23'),
(9, 7, '2016-11-16 11:45:38');

-- USUARIS
CREATE TABLE IF NOT EXISTS `usuaris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dni` char(9) COLLATE utf8_spanish_ci NOT NULL,
  `nom` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `cognom1` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `cognom2` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `data_naixement` date NOT NULL,
  `estudis` int(11) NOT NULL,
  `situacio_laboral` int(11) NOT NULL,
  `prestacio` tinyint(1) NOT NULL,
  `telefon_mobil` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  `telefon_fix` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `imatge` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=19 ;

INSERT INTO `usuaris` (`id`, `dni`, `nom`, `cognom1`, `cognom2`, `data_naixement`, `estudis`, `situacio_laboral`, `prestacio`, `telefon_mobil`, `telefon_fix`, `email`, `admin`, `imatge`) VALUES
(1, '99999999Z', 'Admin', '', '', '1970-01-01', 0, 0, 0, '', '', 'admin@myapp.cat', 1, ''),
(2, '4852265f', 'paquito', 'perez', 'gonzalez', '1978-11-15', 2, 2, 0, '698554785', '988556471', 'herencho@hotmiler.com', 0, ''),
(3, '12345678W', 'PEPITO', 'PALOTES', 'PEREZ', '1996-11-12', 1, 0, 0, '671501528', '937317036', 'pepito@palot.es', 0, ''),
(4, '98345678Z', 'Pepita', 'Perez', 'Palos', '1994-09-12', 1, 0, 0, '610953745', '937337033', 'pepita@hotmail.es', 0, ''),
(5, '45896365A', 'Paco', 'Jímenez', 'Alcántara', '1985-11-16', 1, 2, 0, '65894712', '938954758', 'paco@paquito.com', 0, ''),
(6, '856951475', 'javi', 'Pérez', 'Pérez', '2000-12-25', 2, 1, 1, '695478123', '936584745', 'javi@javi.net', 0, ''),
(7, '33444555F', 'Federico', 'Montes', 'Galindo', '1988-03-15', 3, 0, 1, '645678234', '931225467', 'federicocorrea@gmail.com', 0, ''),
(8, '36456567C', 'Cristina', 'Álvarez', 'Martínez', '1991-04-12', 2, 1, 0, '345123321', '931234567', 'yomisma@mimail.com', 0, ''),
(9, '45672834F', 'Marc', 'Sánchez', 'Ricart', '1990-11-08', 2, 1, 0, '656788754', '934568762', 'marcsanchez@gmail.com', 0, ''),
(10, '98765476J', 'Silvia', 'López', 'López', '1989-11-01', 3, 1, 1, '654321789', '938765433', 'silvialopez@gmail.com', 0, ''),
(11, '45471254F', 'Armando', 'Camorra', 'Segura', '1957-10-05', 1, 1, 1, '666254785', '93665874587', 'camorra@gmail.com', 0, ''),
(12, '27899654J', 'jorobaldo', 'dela', 'chepa', '1976-11-11', 1, 1, 0, '698512355', '864995265', 'jorrobasmil@lacurva.com', 0, ''),
(13, '33905777z', 'Mike', 'Mor', 'Ben', '2006-11-08', 2, 1, 1, '666777888', '937775566', 'sdfasdf@gmail.com', 0, '');

-- CREACIO DE LES RELACIONS
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `arees_formatives` (`id`) ON UPDATE CASCADE;

ALTER TABLE `preinscripcions`
  ADD CONSTRAINT `preinscripcions_ibfk_2` FOREIGN KEY (`id_curs`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `preinscripcions_ibfk_1` FOREIGN KEY (`id_usuari`) REFERENCES `usuaris` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `subscripcions`
  ADD CONSTRAINT `subscripcions_ibfk_2` FOREIGN KEY (`id_area`) REFERENCES `arees_formatives` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subscripcions_ibfk_1` FOREIGN KEY (`id_usuari`) REFERENCES `usuaris` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


-- VISTES
CREATE VIEW v_alumnes_preinscrits AS
SELECT u.dni, CONCAT_WS(' ',u.nom,u.cognom1,u.cognom2) AS nom, 
u.telefon_mobil, u.telefon_fix, u.email, 
DATE_FORMAT(p.data, '%d/%c/%Y') AS data, c.id AS id_curs
FROM usuaris u INNER JOIN preinscripcions p ON u.id=p.id_usuari
INNER  JOIN cursos c ON p.id_curs=c.id;





