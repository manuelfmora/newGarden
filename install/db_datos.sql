-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-05-2016 a las 13:44:53
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `practica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE IF NOT EXISTS `tareas` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `poblacion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `codigo_postal` int(11) NOT NULL,
  `provincia` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechac` date DEFAULT NULL,
  `operario` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechar` date DEFAULT NULL,
  `anotacionesa` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `anotacionesp` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `descripcion`, `nombre`, `telefono`, `correo`, `direccion`, `poblacion`, `codigo_postal`, `provincia`, `estado`, `fechac`, `operario`, `fechar`, `anotacionesa`, `anotacionesp`) VALUES
(11, 'Tala de arboles', 'Antonio Martín Ramirez', 959314578, 'anmar@gmail.com', 'Calle Velázquez Nº 54', 'El Portil (Punta Umbria)', 21459, '21', 'Realizada', '2015-12-09', 'Antoni Gomez Perez', '2015-12-09', 'La tarea tiene que realizarse a partir de las doce', 'Cliente satisfecho.'),
(12, 'Arreglo de aspesores', 'Antonia Mora Bebia', 959318956, 'anmo@gmial.com', 'Avda. Andalucía Nº15', 'Gibraleón', 21500, '21', 'Cancelada', '2015-12-09', 'Pepe Perez Gomez', '2015-12-09', '', ''),
(13, 'Tarea', 'Manuel Francisco Mora Martín', 607535968, 'mfmora2@gmail.com', 'Avda. Andalucía Nº85 2º', 'Gibraleón', 21500, '01', 'Pendiente', '2016-05-04', 'Manuel Francisco', '2016-05-05', '', NULL),
(14, 'Tarea1', 'Manuel Francisco Martín', 959301156, 'mfmora2@gmail.com', 'Avda. Andalucía Nº85 2º', 'Gibraleón', 21500, '19', 'Pendiente', '2016-05-04', 'Antonio Perez Gutierrez', '2016-05-05', '', NULL),
(15, 'Tarea2', 'Pepe Ramos Bebeia', 959304545, 'mf@hotmail.com', 'Calle Velázquez Nº 54', 'Lepe', 23500, '21', 'Pendiente', '2016-05-04', 'Antonio Gomez Gomez', '2016-05-05', '', NULL),
(16, 'Tarea3', 'Manuel Francisco Mora Martín', 959301156, 'mfmora2@gmail.com', 'Avda. Andalucía Nº85 2º', 'Gibraleón', 21500, '18', 'Pendiente', '2016-05-04', 'Francisco Gomez Martín', '2016-05-05', '', NULL);

--
-- Disparadores `tareas`
--
DELIMITER $$
CREATE TRIGGER `tareas_BINS` BEFORE INSERT ON `tareas`
 FOR EACH ROW SET NEW.fechac = SYSDATE()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_provincias`
--

CREATE TABLE IF NOT EXISTS `tbl_provincias` (
  `cod` char(2) NOT NULL DEFAULT '00' COMMENT 'Código de la provincia de dos digitos',
  `nombre` varchar(50) NOT NULL DEFAULT '' COMMENT 'Nombre de la provincia',
  `comunidad_id` tinyint(4) NOT NULL COMMENT 'Código de la comunidad a la que pertenece'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Provincias de españa; 99 para seleccionar a Nacional';

--
-- Volcado de datos para la tabla `tbl_provincias`
--

INSERT INTO `tbl_provincias` (`cod`, `nombre`, `comunidad_id`) VALUES
('01', 'Alava', 16),
('02', 'Albacete', 7),
('03', 'Alicante', 10),
('04', 'Almera', 1),
('05', 'Avila', 8),
('06', 'Badajoz', 11),
('07', 'Balears (Illes)', 4),
('08', 'Barcelona', 9),
('09', 'Burgos', 8),
('10', 'Cáceres', 11),
('11', 'Cádiz', 1),
('12', 'Castellón', 10),
('13', 'Ciudad Real', 7),
('14', 'Córdoba', 1),
('15', 'Coruña (A)', 12),
('16', 'Cuenca', 7),
('17', 'Girona', 9),
('18', 'Granada', 1),
('19', 'Guadalajara', 7),
('20', 'Guipzcoa', 16),
('21', 'Huelva', 1),
('22', 'Huesca', 2),
('23', 'Jaén', 1),
('24', 'León', 8),
('25', 'Lleida', 9),
('26', 'Rioja (La)', 17),
('27', 'Lugo', 12),
('28', 'Madrid', 13),
('29', 'Málaga', 1),
('30', 'Murcia', 14),
('31', 'Navarra', 15),
('32', 'Ourense', 12),
('33', 'Asturias', 3),
('34', 'Palencia', 8),
('35', 'Palmas (Las)', 5),
('36', 'Pontevedra', 12),
('37', 'Salamanca', 8),
('38', 'Santa Cruz de Tenerife', 5),
('39', 'Cantabria', 6),
('40', 'Segovia', 8),
('41', 'Sevilla', 1),
('42', 'Soria', 8),
('43', 'Tarragona', 9),
('44', 'Teruel', 2),
('45', 'Toledo', 7),
('46', 'Valencia', 10),
('47', 'Valladolid', 8),
('48', 'Vizcaya', 16),
('49', 'Zamora', 8),
('50', 'Zaragoza', 2),
('51', 'Ceuta', 18),
('52', 'Melilla', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL,
  `tipo` char(1) DEFAULT NULL,
  `usuario` varchar(25) DEFAULT NULL,
  `clave` varchar(60) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `tipo`, `usuario`, `clave`) VALUES
(1, 'A', 'admin', 'admin'),
(2, 'O', 'ope', 'ope'),
(3, 'O', 'ope1', '1'),
(4, 'O', 'ope2', '2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_provincias`
--
ALTER TABLE `tbl_provincias`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `nombre` (`nombre`),
  ADD KEY `FK_ComunidadAutonomaProv` (`comunidad_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
