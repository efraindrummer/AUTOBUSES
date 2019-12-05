-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2019 a las 19:52:12
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `fechas_prestamo` ()  select f_prestamo, f_inicio, hora_inicio, f_fin, hora_fin from prestamo$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `persona_clave` ()  select nom_persona, ape_persona, origen, destino
from responsable natural join prestamo
where cve_persona in(22,23,28)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autobuses`
--

CREATE TABLE `autobuses` (
  `NO_AUTOBUS` int(11) NOT NULL,
  `MARCA` varchar(45) DEFAULT NULL,
  `TIPO` varchar(45) DEFAULT NULL,
  `PLAZAS` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `autobuses`
--

INSERT INTO `autobuses` (`NO_AUTOBUS`, `MARCA`, `TIPO`, `PLAZAS`) VALUES
(1, 'MERCEDES', 'PASAJEROS', '41'),
(2, 'TOYOTA', 'PASAJEROS', '15'),
(3, 'MERCEDES', 'PASAJEROS', '35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultad`
--

CREATE TABLE `facultad` (
  `ID_FACULTAD` int(11) NOT NULL,
  `NOM_FACULTAD` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facultad`
--

INSERT INTO `facultad` (`ID_FACULTAD`, `NOM_FACULTAD`) VALUES
(1, 'NATURALES'),
(2, 'MATEMATICOS'),
(3, 'INFORMATICA');

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
  `F_PRESTAMO` date DEFAULT NULL,
  `F_INICIO` date DEFAULT NULL,
  `HORA_INICIO` time DEFAULT NULL,
  `F_FIN` date DEFAULT NULL,
  `HORA_FIN` time DEFAULT NULL,
  `ORIGEN` varchar(45) DEFAULT NULL,
  `DESTINO` varchar(45) DEFAULT NULL,
  `CVE_PERSONA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`NO_AUTOBUS`, `F_PRESTAMO`, `F_INICIO`, `HORA_INICIO`, `F_FIN`, `HORA_FIN`, `ORIGEN`, `DESTINO`, `CVE_PERSONA`) VALUES
(1, '2010-12-12', '2015-12-12', '06:00:00', '2010-01-13', '16:00:00', 'CARMEN', 'CANCUN', 22),
(2, '2010-05-12', '2001-06-12', '05:00:00', '2005-06-12', '12:00:00', 'CARMEN', 'MERIDA', 23),
(3, '2015-04-12', '2010-05-12', '05:00:00', '2010-05-12', '19:00:00', 'CARMEN', 'SABANCUY', 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsable`
--

CREATE TABLE `responsable` (
  `CVE_PERSONA` int(11) NOT NULL,
  `NOM_PERSONA` varchar(45) DEFAULT NULL,
  `APE_PERSONA` varchar(45) DEFAULT NULL,
  `ID_FACULTAD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `responsable`
--

INSERT INTO `responsable` (`CVE_PERSONA`, `NOM_PERSONA`, `APE_PERSONA`, `ID_FACULTAD`) VALUES
(22, 'JULIAN', 'MONTERO', 1),
(23, 'PEDRO', 'PICENT', 2),
(28, 'ANDRES', 'SALAZAR', 3);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_autobuses`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_autobuses` (
`marca` varchar(45)
,`plazas` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_n_p_persona`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_n_p_persona` (
`nom_persona` varchar(45)
,`ape_persona` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_autobuses`
--
DROP TABLE IF EXISTS `v_autobuses`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_autobuses`  AS  select `MARCA` AS `marca`,`PLAZAS` AS `plazas` from `autobuses` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_n_p_persona`
--
DROP TABLE IF EXISTS `v_n_p_persona`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_n_p_persona`  AS  select `responsable`.`NOM_PERSONA` AS `nom_persona`,`responsable`.`APE_PERSONA` AS `ape_persona` from `responsable` ;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
