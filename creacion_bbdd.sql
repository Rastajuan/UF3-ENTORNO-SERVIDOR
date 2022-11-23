-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 23-11-2022 a las 11:48:33
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ifpdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

DROP TABLE IF EXISTS `actividades`;
CREATE TABLE IF NOT EXISTS `actividades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) CHARACTER SET ascii DEFAULT NULL,
  `ciudad` varchar(100) CHARACTER SET ascii DEFAULT NULL,
  `tipo` varchar(50) CHARACTER SET ascii DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `gratis` bit(1) NOT NULL,
  `usuario` varchar(50) CHARACTER SET ascii NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `titulo`, `ciudad`, `tipo`, `fecha`, `gratis`, `usuario`) VALUES
(47, 'concierto', 'Barcelona', 'cultura', '2022-11-22', b'0', 'ifp'),
(49, 'cena al aire libre', 'Valencia', 'comida', '2022-11-25', b'0', 'ifp'),
(57, 'Concierto', 'asdaf', 'Comida', '2022-11-10', b'0', 'ifp'),
(58, 'Pelicula', 'Barcelona', 'Viajes', '2022-11-11', b'0', 'ifp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` varchar(50) CHARACTER SET ascii NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contraseña`) VALUES
('ejemplo', 'Ejemplo', 'Ejemplo@gmail.com', '1234'),
('ifp', 'IFP', 'ejemplo@ifp.es', '2022'),
('jaime', 'Jaime', 'correo@gmail.com', '1234'),
('leo', 'Leo', 'leo@gmail.com', '1234');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `actividades_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
