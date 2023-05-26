-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2023 a las 01:25:19
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `empresa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiene_novedad`
--

CREATE TABLE `tiene_novedad` (
  `id_empleado` int(11) NOT NULL,
  `id_novedad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tiene_novedad`
--

INSERT INTO `tiene_novedad` (`id_empleado`, `id_novedad`) VALUES
(1, 1),
(2, 2),
(3, 4),
(4, 7),
(5, 6),
(1, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tiene_novedad`
--
ALTER TABLE `tiene_novedad`
  ADD KEY `idempleado` (`id_empleado`),
  ADD KEY `idnovedad` (`id_novedad`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tiene_novedad`
--
ALTER TABLE `tiene_novedad`
  ADD CONSTRAINT `tiene_novedad_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id`),
  ADD CONSTRAINT `tiene_novedad_ibfk_2` FOREIGN KEY (`id_novedad`) REFERENCES `novedades` (`id_novedad`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
