-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-12-2023 a las 06:39:10
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectocripto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `codiUsua` char(8) NOT NULL,
  `logiUsua` varchar(45) NOT NULL,
  `passUsua` varchar(120) NOT NULL,
  `claveAute` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codiUsua`, `logiUsua`, `passUsua`, `claveAute`) VALUES
('40801418', 'kike', 'Fd6hR2P0/ys=', 'N6SLSEWL44JEFGCC'),
('72755161', 'andres', 'cxSW9wmYhvk=', 'TEBTSDXD3D6AIS66'),
('72847211', 'anthony', 'QVfq5gWLNDY=', 'S62J46AWLLQDFJ3N'),
('73594630', 'carlos', 'qJbuQ8FRMxA=', 'PIMRQYFMRTZIUKDG'),
('74999126', 'conejo', 'OFG3UanIVJw=', '42R5WA4Y2NXBZDGO'),
('75149676', 'denver', 'mFdceOqt6Cc=', 'SRYRYJT6EZYCAQJA');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codiUsua`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
