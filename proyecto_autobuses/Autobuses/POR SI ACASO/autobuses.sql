-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2019 a las 07:54:33
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `autobuses`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `facultad_clave_personas` ()  select id_facultad, cve_persona, nom_persona, ape_persona from facultad natural join responsable$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `marca_tipo` ()  select marca, tipo from autobuses$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autobuses`
--

CREATE TABLE `autobuses` (
  `NO_AUTOBUS` int(11) NOT NULL,
  `MARCA` varchar(45) NOT NULL,
  `TIPO` varchar(45) NOT NULL,
  `PLAZAS` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `autobuses`
--

INSERT INTO `autobuses` (`NO_AUTOBUS`, `MARCA`, `TIPO`, `PLAZAS`) VALUES
(1, 'TOYOTA', 'PASAJEROS', '23'),
(2, 'MAZDA', 'PASAJEROS', '34'),
(3, 'MERCEDES', 'PASAJEROS', '9'),
(4, 'TOYOTA', 'PASAJEROS', '123'),
(5, 'FERRARI', 'PASAJEROS', '40'),
(6, 'HP', 'PASAJEROS', '25'),
(7, 'MERCEDES', 'PASAJEROS', '18'),
(8, 'TOYOTA', 'PASAJEROS', '30'),
(9, 'CELESTION', 'PASAJEROS', '35'),
(10, 'CHEVROLET', 'PASAJEROS', '38');

--
-- Disparadores `autobuses`
--
DELIMITER $$
CREATE TRIGGER `autobuses_mas` AFTER INSERT ON `autobuses` FOR EACH ROW insert prestamo values(new.no_autobus, '4')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultad`
--

CREATE TABLE `facultad` (
  `ID_FACULTAD` int(11) NOT NULL,
  `NOM_FACULTAD` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facultad`
--

INSERT INTO `facultad` (`ID_FACULTAD`, `NOM_FACULTAD`) VALUES
(1, 'CIENCIAS DE LA INFORMACION'),
(2, 'DERECHO'),
(3, 'CIENCIAS NATURALES'),
(4, 'INGIENERIA'),
(5, 'QUIMICA'),
(6, 'LEFYD');

--
-- Disparadores `facultad`
--
DELIMITER $$
CREATE TRIGGER `responsable_mas` AFTER INSERT ON `facultad` FOR EACH ROW insert responsable values(new.id_facultad, '4')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `NO_AUTOBUS` int(11) NOT NULL,
  `F_PRESTAMO` date NOT NULL,
  `F_INICIO` date NOT NULL,
  `HORA_INICIO` time NOT NULL,
  `F_FIN` date NOT NULL,
  `HORA_FIN` time NOT NULL,
  `ORIGEN` varchar(45) NOT NULL,
  `DESTINO` varchar(45) NOT NULL,
  `CVE_PERSONA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`NO_AUTOBUS`, `F_PRESTAMO`, `F_INICIO`, `HORA_INICIO`, `F_FIN`, `HORA_FIN`, `ORIGEN`, `DESTINO`, `CVE_PERSONA`) VALUES
(1, '2019-11-01', '2019-11-02', '13:00:00', '2019-11-09', '12:59:00', 'CARMEN', 'MEXICO', 22),
(2, '2019-11-08', '2019-11-16', '13:00:00', '2019-11-22', '22:52:00', 'CARMEN', 'TAMAULIPAS', 12),
(3, '2019-11-20', '2019-11-25', '00:00:00', '2019-11-30', '13:00:00', 'CARMEN', 'MERIDA', 33),
(4, '2019-11-09', '2019-11-14', '09:00:00', '2019-11-22', '20:00:00', 'CANCUN', 'MEXICO', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsable`
--

CREATE TABLE `responsable` (
  `CVE_PERSONA` int(11) NOT NULL,
  `NOM_PERSONA` varchar(45) NOT NULL,
  `APE_PERSONA` varchar(45) NOT NULL,
  `ID_FACULTAD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `responsable`
--

INSERT INTO `responsable` (`CVE_PERSONA`, `NOM_PERSONA`, `APE_PERSONA`, `ID_FACULTAD`) VALUES
(12, 'LUISITO', 'CHAPITO', 1),
(22, 'JOSE FELIPE', 'COCON', 1),
(33, 'ALEXANDER', 'MAGAÑA', 2),
(223, 'JULIAN', 'MONTERO', 4);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_autobuses`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_autobuses` (
`marca` varchar(45)
,`plazas` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_personas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_personas` (
`nom_persona` varchar(45)
,`ape_persona` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_autobuses`
--
DROP TABLE IF EXISTS `vista_autobuses`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_autobuses`  AS  select `MARCA` AS `marca`,`PLAZAS` AS `plazas` from `autobuses` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_personas`
--
DROP TABLE IF EXISTS `vista_personas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_personas`  AS  select `responsable`.`NOM_PERSONA` AS `nom_persona`,`responsable`.`APE_PERSONA` AS `ape_persona` from `responsable` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autobuses`
--
ALTER TABLE `autobuses`
  ADD PRIMARY KEY (`NO_AUTOBUS`);

--
-- Indices de la tabla `facultad`
--
ALTER TABLE `facultad`
  ADD PRIMARY KEY (`ID_FACULTAD`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD KEY `fk_PRESTAMO_AUTOBUSES` (`NO_AUTOBUS`),
  ADD KEY `fk_PRESTAMO_RESPONSABLE1` (`CVE_PERSONA`);

--
-- Indices de la tabla `responsable`
--
ALTER TABLE `responsable`
  ADD PRIMARY KEY (`CVE_PERSONA`),
  ADD KEY `fk_RESPONSABLE_FACULTAD1` (`ID_FACULTAD`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `fk_PRESTAMO_AUTOBUSES` FOREIGN KEY (`NO_AUTOBUS`) REFERENCES `autobuses` (`NO_AUTOBUS`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PRESTAMO_RESPONSABLE1` FOREIGN KEY (`CVE_PERSONA`) REFERENCES `responsable` (`CVE_PERSONA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `responsable`
--
ALTER TABLE `responsable`
  ADD CONSTRAINT `fk_RESPONSABLE_FACULTAD1` FOREIGN KEY (`ID_FACULTAD`) REFERENCES `facultad` (`ID_FACULTAD`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
