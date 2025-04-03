-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 31-03-2025 a las 15:53:08
-- Versión del servidor: 9.1.0
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `parquedelavida`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boleto`
--

DROP TABLE IF EXISTS `boleto`;
CREATE TABLE IF NOT EXISTS `boleto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `evento` varchar(100) NOT NULL,
  `precio` int NOT NULL,
  `disponibles` int NOT NULL,
  `imagenEvento` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fechaIngreso` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaSalida` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaRegistroEvento` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `boleto`
--

INSERT INTO `boleto` (`id`, `evento`, `precio`, `disponibles`, `imagenEvento`, `fechaIngreso`, `fechaSalida`, `fechaRegistroEvento`) VALUES
(1, 'Entrada General', 5000, 43, 'recursos\\eventos\\koala.jpg', '2025-01-01 14:00:00', '2025-05-31 22:00:00', '2025-01-01 13:00:00'),
(2, 'Mitos y Leyendas', 45000, 44, 'recursos\\eventos\\mitoYLeyendas.png', '2025-02-01 18:00:00', '2025-05-31 22:00:00', '2025-01-01 13:00:00'),
(3, 'Caminata Nocturna', 35000, 47, 'recursos\\eventos\\caminataNocturna.png', '2025-03-01 18:00:00', '2025-05-31 22:00:00', '2025-01-01 13:00:00'),
(4, 'Avistamiento de Aves', 25000, 48, 'recursos\\eventos\\avistamientoAves.png', '2025-04-01 14:00:00', '2025-05-31 22:00:00', '2025-01-01 13:00:00'),
(5, 'Danza y Musica', 15000, 50, 'recursos\\eventos\\danzaMusica.png', '2025-05-01 15:00:00', '2025-05-31 22:00:00', '2025-01-01 13:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE IF NOT EXISTS `factura` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `productos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tipoDePago` enum('Efectivo','Tarjeta','Transferencia') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `totalAPagar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `estadoPago` enum('Pendiente','Pagado') NOT NULL,
  `fechaRegistroPago` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `usuario_id`, `productos`, `tipoDePago`, `totalAPagar`, `estadoPago`, `fechaRegistroPago`) VALUES
(1, 1, '{\n    \"a87ff679a2f3e71d9181a67b7542122c\": {\n        \"id\": \"4\",\n        \"entrada\": \"Avistamiento de Aves\",\n        \"cantidadSolicitada\": \"2\",\n        \"precio\": \"25000\",\n        \"totalAPagar\": 50000\n    },\n    \"c4ca4238a0b923820dcc509a6f75849b\": {\n        \"id\": \"1\",\n        \"entrada\": \"Entrada General\",\n        \"cantidadSolicitada\": \"3\",\n        \"precio\": \"5000\",\n        \"totalAPagar\": 15000\n    },\n    \"c81e728d9d4c2f636f067f89cc14862c\": {\n        \"id\": \"2\",\n        \"entrada\": \"Mitos y Leyendas\",\n        \"cantidadSolicitada\": \"4\",\n        \"precio\": \"45000\",\n        \"totalAPagar\": 180000\n    }\n}', 'Efectivo', '245000', 'Pendiente', '2025-03-31 10:04:44'),
(2, 3, '{\n    \"eccbc87e4b5ce2fe28308fd9f2a7baf3\": {\n        \"id\": \"3\",\n        \"entrada\": \"Caminata Nocturna\",\n        \"cantidadSolicitada\": \"3\",\n        \"precio\": \"35000\",\n        \"totalAPagar\": 105000\n    },\n    \"c4ca4238a0b923820dcc509a6f75849b\": {\n        \"id\": \"1\",\n        \"entrada\": \"Entrada General\",\n        \"cantidadSolicitada\": \"4\",\n        \"precio\": \"5000\",\n        \"totalAPagar\": 20000\n    },\n    \"c81e728d9d4c2f636f067f89cc14862c\": {\n        \"id\": \"2\",\n        \"entrada\": \"Mitos y Leyendas\",\n        \"cantidadSolicitada\": \"2\",\n        \"precio\": \"45000\",\n        \"totalAPagar\": 90000\n    }\n}', 'Tarjeta', '215000', 'Pagado', '2025-03-31 10:08:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion`
--

DROP TABLE IF EXISTS `transaccion`;
CREATE TABLE IF NOT EXISTS `transaccion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `factura_id` int NOT NULL,
  `boleto_id` int NOT NULL,
  `precio` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cantidad` int NOT NULL,
  `totalAPagarUnidad` int NOT NULL,
  `fechaRegistroTransaccion` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `boleto_id` (`boleto_id`),
  KEY `factura_id` (`factura_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `transaccion`
--

INSERT INTO `transaccion` (`id`, `factura_id`, `boleto_id`, `precio`, `cantidad`, `totalAPagarUnidad`, `fechaRegistroTransaccion`) VALUES
(1, 1, 4, '25000', 2, 50000, '2025-03-31 10:04:44'),
(2, 1, 1, '5000', 3, 15000, '2025-03-31 10:04:44'),
(3, 1, 2, '45000', 4, 180000, '2025-03-31 10:04:44'),
(4, 2, 3, '35000', 3, 105000, '2025-03-31 10:08:05'),
(5, 2, 1, '5000', 4, 20000, '2025-03-31 10:08:05'),
(6, 2, 2, '45000', 2, 90000, '2025-03-31 10:08:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cedula` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tipoUsuario` enum('Cliente','Administrador') NOT NULL,
  `fechaRegistroUsuario` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `cedula`, `nombre`, `apellido`, `email`, `telefono`, `password`, `tipoUsuario`, `fechaRegistroUsuario`) VALUES
(1, '1322', 'Carlos 2 ', 'Arturo', 'us1@email.com', '3124321249', '1234', 'Cliente', '2025-03-30'),
(2, '1323', 'Carlos', 'Arturo', 'registro@baulphp.com', '3124321249', '1234', 'Cliente', '2025-03-31'),
(3, '1324', 'Sergio', 'Ramirez', 'sergio@sss.xx', '32124', '1234', 'Cliente', '2025-03-31');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD CONSTRAINT `transaccion_ibfk_1` FOREIGN KEY (`factura_id`) REFERENCES `factura` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `transaccion_ibfk_2` FOREIGN KEY (`boleto_id`) REFERENCES `boleto` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
