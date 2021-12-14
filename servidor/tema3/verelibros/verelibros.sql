-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-11-2021 a las 21:10:18
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `verelibros`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `nombreUsu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`nombreUsu`) VALUES
('admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor`
--

CREATE TABLE `autor` (
  `nombre` varchar(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `autor`
--

INSERT INTO `autor` (`nombre`, `id`) VALUES
('Gustavo Adolfo Bécquer', 1),
('Agatha Christie', 2),
('Alex Romero', 3),
('Javi Prima', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `nombreUsu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`nombreUsu`) VALUES
('aromerop');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `nombreUsu` varchar(50) NOT NULL,
  `isbnLibro` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escrito`
--

CREATE TABLE `escrito` (
  `isbn` varchar(13) NOT NULL,
  `idAutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `escrito`
--

INSERT INTO `escrito` (`isbn`, `idAutor`) VALUES
('1000000000000', 1),
('2000000000000', 1),
('3000000000000', 2),
('4000000000000', 2),
('5000000000000', 3),
('6000000000000', 5),
('7000000000000', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `isbn` varchar(13) NOT NULL,
  `anyo_publicacion` int(4) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `almacenados` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`isbn`, `anyo_publicacion`, `titulo`, `precio`, `almacenados`) VALUES
('1000000000000', 1864, 'Desde mi celda', '22', 100),
('2000000000000', 1861, 'Los ojos verdes', '20', 100),
('3000000000000', 1934, 'Asesinato en el Orient Express', '23', 100),
('4000000000000', 1937, 'Muerte en el nilo', '21', 100),
('5000000000000', 2021, 'Mi libro', '19', 100),
('6000000000000', 2021, 'Deberes PHP', '1', 1),
('7000000000000', 2021, 'Deberes Javascript', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasenya` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre`, `correo`, `contrasenya`) VALUES
('admin', 'admin@gmail.com', '$2y$10$JyNbMEIf2XPKo0UmCKe0LukhoNJwEEFiv.j.06zhbxuBlVdAYGgku'),
('aromerop', 'arp@gmail.com', '$2y$10$U1VKUe6x0w0pdpNKDUZeg.80aXSYAr7Lv2hkglNTvwhkxKqs59LMC');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`nombreUsu`);

--
-- Indices de la tabla `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`nombreUsu`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD KEY `nombreUsu` (`nombreUsu`),
  ADD KEY `isbnLibro` (`isbnLibro`);

--
-- Indices de la tabla `escrito`
--
ALTER TABLE `escrito`
  ADD KEY `idAutor` (`idAutor`),
  ADD KEY `escrito_ibfk_2` (`isbn`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`isbn`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autor`
--
ALTER TABLE `autor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`nombreUsu`) REFERENCES `usuario` (`nombre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`nombreUsu`) REFERENCES `usuario` (`nombre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`nombreUsu`) REFERENCES `cliente` (`nombreUsu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`isbnLibro`) REFERENCES `libro` (`isbn`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `escrito`
--
ALTER TABLE `escrito`
  ADD CONSTRAINT `escrito_ibfk_1` FOREIGN KEY (`idAutor`) REFERENCES `autor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `escrito_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `libro` (`isbn`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
