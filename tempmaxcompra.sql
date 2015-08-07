-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-08-2015 a las 14:48:46
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `nmaxx_develop`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tempmaxcompra`
--

CREATE TABLE IF NOT EXISTS `tempmaxcompra` (
`id` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `prod` int(11) DEFAULT NULL,
  `cant` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tempmaxcompra`
--

INSERT INTO `tempmaxcompra` (`id`, `user`, `prod`, `cant`) VALUES
(1, 10, 144, 10),
(2, 10, 133, NULL),
(3, 10, 136, NULL),
(4, 10, 146, 10),
(5, 10, 237, 10),
(6, 10, 151, NULL),
(7, 10, 159, NULL),
(8, 10, 160, NULL),
(9, 10, 161, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tempmaxcompra`
--
ALTER TABLE `tempmaxcompra`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tempmaxcompra`
--
ALTER TABLE `tempmaxcompra`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
