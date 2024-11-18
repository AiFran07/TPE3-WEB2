-- phpMyAdmin SQL Dump
-- Base de datos: `db_vehiculos`

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `db_vehiculos` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `db_vehiculos`;

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `vehiculos`

CREATE TABLE `vehiculos` (
  `id` int(11) NOT NULL,
  `marca` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `modelo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `año` int(4) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `categoria` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcado de datos para la tabla `vehiculos`

INSERT INTO `vehiculos` (`id`, `marca`, `modelo`, `año`, `precio`, `categoria`) VALUES
(1, 'Toyota', 'Corolla', 2020, 20000.00, 'Sedan'),
(2, 'Ford', 'Ranger', 2022, 35000.00, 'Pick-Up'),
(3, 'Honda', 'Civic', 2021, 22000.00, 'Sedan'),
(4, 'Chevrolet', 'Tracker', 2023, 28000.00, 'SUV');

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `usuario`

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcado de datos para la tabla `usuario`

INSERT INTO `usuario` (`id`, `email`, `password`) VALUES
(1, 'admin@concesionaria.com', '$2y$10$xQop0wF1YJ/dKhZcWDqHceUM96S04u73zGeJtU80a1GmM.H5H0EHC');

-- Índices para tablas

-- Índices de la tabla `vehiculos`
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`);

-- Índices de la tabla `usuario`
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

-- AUTO_INCREMENT para las tablas

-- AUTO_INCREMENT de la tabla `vehiculos`
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

-- AUTO_INCREMENT de la tabla `usuario`
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

COMMIT;
