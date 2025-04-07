-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 04-04-2025 a las 12:09:46
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
-- Base de datos: `lkkxjgdf_parquedelavida`
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
(1, 'Entrada General', 5000, 8, 'recursos\\eventos\\koala.jpg', '2025-01-01 14:00:00', '2025-05-31 22:00:00', '2025-01-01 13:00:00'),
(2, 'Mitos y Leyendas', 45000, 44, 'recursos\\eventos\\mitoYLeyendas.png', '2025-02-01 18:00:00', '2025-05-31 22:00:00', '2025-01-01 13:00:00'),
(3, 'Caminata Nocturna', 35000, 42, 'recursos\\eventos\\caminataNocturna.png', '2025-03-01 18:00:00', '2025-05-31 22:00:00', '2025-01-01 13:00:00'),
(4, 'Avistamiento de Aves', 25000, 1, 'recursos\\eventos\\avistamientoAves.png', '2025-04-01 14:00:00', '2025-05-31 22:00:00', '2025-01-01 13:00:00'),
(5, 'Danza y Musica', 15000, 49, 'recursos\\eventos\\danzaMusica.png', '2025-05-01 15:00:00', '2025-05-31 22:00:00', '2025-01-01 13:00:00');

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
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fechaRegistroPago` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `usuario_id`, `productos`, `tipoDePago`, `totalAPagar`, `estadoPago`, `token`, `fechaRegistroPago`) VALUES
(1, 1, '{\n    \"a87ff679a2f3e71d9181a67b7542122c\": {\n        \"id\": \"4\",\n        \"entrada\": \"Avistamiento de Aves\",\n        \"cantidadSolicitada\": \"2\",\n        \"precio\": \"25000\",\n        \"totalAPagar\": 50000\n    },\n    \"c4ca4238a0b923820dcc509a6f75849b\": {\n        \"id\": \"1\",\n        \"entrada\": \"Entrada General\",\n        \"cantidadSolicitada\": \"3\",\n        \"precio\": \"5000\",\n        \"totalAPagar\": 15000\n    },\n    \"c81e728d9d4c2f636f067f89cc14862c\": {\n        \"id\": \"2\",\n        \"entrada\": \"Mitos y Leyendas\",\n        \"cantidadSolicitada\": \"4\",\n        \"precio\": \"45000\",\n        \"totalAPagar\": 180000\n    }\n}', 'Efectivo', '245000', 'Pagado', '$2b$12$c.D6iwaaCIfyMwcrR1bPZ.kQw9m/ohc/E3TqaDS4/LVMPnvyTqL/6', '2025-03-31 10:04:44'),
(2, 3, '{\n    \"eccbc87e4b5ce2fe28308fd9f2a7baf3\": {\n        \"id\": \"3\",\n        \"entrada\": \"Caminata Nocturna\",\n        \"cantidadSolicitada\": \"3\",\n        \"precio\": \"35000\",\n        \"totalAPagar\": 105000\n    },\n    \"c4ca4238a0b923820dcc509a6f75849b\": {\n        \"id\": \"1\",\n        \"entrada\": \"Entrada General\",\n        \"cantidadSolicitada\": \"4\",\n        \"precio\": \"5000\",\n        \"totalAPagar\": 20000\n    },\n    \"c81e728d9d4c2f636f067f89cc14862c\": {\n        \"id\": \"2\",\n        \"entrada\": \"Mitos y Leyendas\",\n        \"cantidadSolicitada\": \"2\",\n        \"precio\": \"45000\",\n        \"totalAPagar\": 90000\n    }\n}', 'Tarjeta', '215000', 'Pagado', '$2b$12$xuuysDuuGVhRH.IhoRORI.9hr7k.zP.nENY1RWQ9JjTqHdKY.Mf/e', '2025-03-31 10:08:05'),
(3, 1, '{\n    \"c4ca4238a0b923820dcc509a6f75849b\": {\n        \"id\": \"1\",\n        \"entrada\": \"Entrada General\",\n        \"cantidadSolicitada\": \"1\",\n        \"precio\": \"5000\",\n        \"totalAPagar\": 5000\n    },\n    \"a87ff679a2f3e71d9181a67b7542122c\": {\n        \"id\": \"4\",\n        \"entrada\": \"Avistamiento de Aves\",\n        \"cantidadSolicitada\": \"1\",\n        \"precio\": \"25000\",\n        \"totalAPagar\": 25000\n    }\n}', 'Tarjeta', '30000', 'Pagado', '$2b$12$aYb7V7eKfx5BGl9J7C8oyOXkz.sLFMEl5GCYAzp/3m12Rwe/4Bv9i', '2025-03-31 13:49:16'),
(4, 1, '{\n    \"c4ca4238a0b923820dcc509a6f75849b\": {\n        \"id\": \"1\",\n        \"entrada\": \"Entrada General\",\n        \"cantidadSolicitada\": \"1\",\n        \"precio\": \"5000\",\n        \"totalAPagar\": 5000\n    },\n    \"eccbc87e4b5ce2fe28308fd9f2a7baf3\": {\n        \"id\": \"3\",\n        \"entrada\": \"Caminata Nocturna\",\n        \"cantidadSolicitada\": \"1\",\n        \"precio\": \"35000\",\n        \"totalAPagar\": 35000\n    }\n}', 'Efectivo', '40000', 'Pagado', '$2b$12$5dijIdNzvIumynq/XoHse.5q.ld2YK3N7DtNJUqtx9XSWwZVWtOfm', '2025-03-31 14:20:12'),
(5, 2, '{\n    \"a87ff679a2f3e71d9181a67b7542122c\": {\n        \"id\": \"4\",\n        \"entrada\": \"Avistamiento de Aves\",\n        \"cantidadSolicitada\": \"26\",\n        \"precio\": \"25000\",\n        \"totalAPagar\": 650000\n    }\n}', 'Tarjeta', '650000', 'Pendiente', '$2b$12$uharM9Z2CfEdvUMFHKPBgeIoREyEXF8qQZtZUgoPq38aQj0V6G886', '2025-03-31 14:22:43'),
(6, 3, '{\n    \"a87ff679a2f3e71d9181a67b7542122c\": {\n        \"id\": \"4\",\n        \"entrada\": \"Avistamiento de Aves\",\n        \"cantidadSolicitada\": \"3\",\n        \"precio\": \"25000\",\n        \"totalAPagar\": 75000\n    }\n}', 'Efectivo', '75000', 'Pagado', '$2b$12$vfTU2GI41iRsBfmGTBSjeOXAJQLoz5gwjy0sLn9uZ9BXUoQsa2unm', '2025-03-31 15:28:57'),
(7, 3, '{\n    \"c4ca4238a0b923820dcc509a6f75849b\": {\n        \"id\": \"1\",\n        \"entrada\": \"Entrada General\",\n        \"cantidadSolicitada\": \"4\",\n        \"precio\": \"5000\",\n        \"totalAPagar\": 20000\n    },\n    \"a87ff679a2f3e71d9181a67b7542122c\": {\n        \"id\": \"4\",\n        \"entrada\": \"Avistamiento de Aves\",\n        \"cantidadSolicitada\": \"7\",\n        \"precio\": \"25000\",\n        \"totalAPagar\": 175000\n    }\n}', 'Tarjeta', '195000', 'Pendiente', '$2b$12$HrvOos/E4DOE4dRLjm6Wz.H7GZMrbkObYOE4cr2elKzvYNNUDM9gq', '2025-03-31 19:11:46'),
(8, 1, '{\n    \"a87ff679a2f3e71d9181a67b7542122c\": {\n        \"id\": \"4\",\n        \"entrada\": \"Avistamiento de Aves\",\n        \"cantidadSolicitada\": \"1\",\n        \"precio\": \"25000\",\n        \"totalAPagar\": 25000\n    }\n}', 'Tarjeta', '25000', 'Pagado', '$2b$12$GiHvbh3EJEbOS0erRjtYOe81OTyfwGdJwqJV1VW.V2gcBxOgDqCxS', '2025-04-01 18:23:45'),
(9, 3, '{\n    \"c4ca4238a0b923820dcc509a6f75849b\": {\n        \"id\": \"1\",\n        \"entrada\": \"Entrada General\",\n        \"cantidadSolicitada\": \"12\",\n        \"precio\": \"5000\",\n        \"totalAPagar\": 60000\n    },\n    \"eccbc87e4b5ce2fe28308fd9f2a7baf3\": {\n        \"id\": \"3\",\n        \"entrada\": \"Caminata Nocturna\",\n        \"cantidadSolicitada\": \"4\",\n        \"precio\": \"35000\",\n        \"totalAPagar\": 140000\n    }\n}', 'Efectivo', '200000', 'Pendiente', '$2b$12$jrIaKjg7woZUZmh3nHmXn.7d3luiCDPwexysojHwWEEufrcKhrcry', '2025-04-03 01:57:12'),
(10, 1, '{\n    \"c4ca4238a0b923820dcc509a6f75849b\": {\n        \"id\": \"1\",\n        \"entrada\": \"Entrada General\",\n        \"cantidadSolicitada\": \"3\",\n        \"precio\": \"5000\",\n        \"totalAPagar\": 15000\n    }\n}', 'Efectivo', '15000', 'Pagado', '$2y$10$JqG.x4TWU21bhLEQvelRe.g8gvnDPAr3c5PehF3LawHRdf3yGofY2', '2025-04-03 03:54:48'),
(11, 1, '{\n    \"c4ca4238a0b923820dcc509a6f75849b\": {\n        \"id\": \"1\",\n        \"entrada\": \"Entrada General\",\n        \"cantidadSolicitada\": \"12\",\n        \"precio\": \"5000\",\n        \"totalAPagar\": 60000\n    },\n    \"a87ff679a2f3e71d9181a67b7542122c\": {\n        \"id\": \"4\",\n        \"entrada\": \"Avistamiento de Aves\",\n        \"cantidadSolicitada\": \"8\",\n        \"precio\": \"25000\",\n        \"totalAPagar\": 200000\n    }\n}', 'Tarjeta', '260000', 'Pagado', '$2y$10$THiYHPhV6knmU5M5J4PFwuKgEINWk58m5K.4CQrnqv7E51l3MbJei', '2025-04-04 04:36:47'),
(12, 3, '{\n    \"c4ca4238a0b923820dcc509a6f75849b\": {\n        \"id\": \"1\",\n        \"entrada\": \"Entrada General\",\n        \"cantidadSolicitada\": \"1\",\n        \"precio\": \"5000\",\n        \"totalAPagar\": 5000\n    }\n}', 'Efectivo', '5000', 'Pendiente', '$2y$10$1Z0Kb8n23ooJWQYzVWDu0O/OMclkp5l4UKTYkwo/rDQf.NVE6dqvi', '2025-04-04 04:52:55'),
(13, 1, '{\n    \"e4da3b7fbbce2345d7772b0674a318d5\": {\n        \"id\": \"5\",\n        \"entrada\": \"Danza y Musica\",\n        \"cantidadSolicitada\": \"1\",\n        \"precio\": \"15000\",\n        \"totalAPagar\": 15000\n    }\n}', 'Efectivo', '15000', 'Pagado', '$2y$10$oYbd1e7Mt.YhXgNnPcIUteMK4TlbGJw8MXs4P1Mzc46eQ4u2JK64.', '2025-04-04 04:54:59'),
(14, 1, '{\n    \"c4ca4238a0b923820dcc509a6f75849b\": {\n        \"id\": \"1\",\n        \"entrada\": \"Entrada General\",\n        \"cantidadSolicitada\": \"1\",\n        \"precio\": \"5000\",\n        \"totalAPagar\": 5000\n    },\n    \"a87ff679a2f3e71d9181a67b7542122c\": {\n        \"id\": \"4\",\n        \"entrada\": \"Avistamiento de Aves\",\n        \"cantidadSolicitada\": \"1\",\n        \"precio\": \"25000\",\n        \"totalAPagar\": 25000\n    }\n}', 'Efectivo', '30000', 'Pagado', '$2y$10$2ZOR8xZVNHt01Z0YcvhxN.qV2rDDOfUiSWvjNOJiqZ/d0yUlXGwia', '2025-04-04 06:16:05');

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `transaccion`
--

INSERT INTO `transaccion` (`id`, `factura_id`, `boleto_id`, `precio`, `cantidad`, `totalAPagarUnidad`, `fechaRegistroTransaccion`) VALUES
(1, 1, 4, '25000', 2, 50000, '2025-03-31 10:04:44'),
(2, 1, 1, '5000', 3, 15000, '2025-03-31 10:04:44'),
(3, 1, 2, '45000', 4, 180000, '2025-03-31 10:04:44'),
(4, 2, 3, '35000', 3, 105000, '2025-03-31 10:08:05'),
(5, 2, 1, '5000', 4, 20000, '2025-03-31 10:08:05'),
(6, 2, 2, '45000', 2, 90000, '2025-03-31 10:08:05'),
(7, 3, 1, '5000', 1, 5000, '2025-03-31 13:49:16'),
(8, 3, 4, '25000', 1, 25000, '2025-03-31 13:49:16'),
(9, 4, 1, '5000', 1, 5000, '2025-03-31 14:20:12'),
(10, 4, 3, '35000', 1, 35000, '2025-03-31 14:20:12'),
(11, 5, 4, '25000', 26, 650000, '2025-03-31 14:22:43'),
(12, 6, 4, '25000', 3, 75000, '2025-03-31 15:28:57'),
(13, 7, 1, '5000', 4, 20000, '2025-03-31 19:11:46'),
(14, 7, 4, '25000', 7, 175000, '2025-03-31 19:11:46'),
(15, 8, 4, '25000', 1, 25000, '2025-04-01 18:23:45'),
(16, 9, 1, '5000', 12, 60000, '2025-04-03 01:57:12'),
(17, 9, 3, '35000', 4, 140000, '2025-04-03 01:57:12'),
(18, 10, 1, '5000', 3, 15000, '2025-04-03 03:54:48'),
(19, 11, 1, '5000', 12, 60000, '2025-04-04 04:36:47'),
(20, 11, 4, '25000', 8, 200000, '2025-04-04 04:36:47'),
(21, 12, 1, '5000', 1, 5000, '2025-04-04 04:52:55'),
(22, 13, 5, '15000', 1, 15000, '2025-04-04 04:54:59'),
(23, 14, 1, '5000', 1, 5000, '2025-04-04 06:16:05'),
(24, 14, 4, '25000', 1, 25000, '2025-04-04 06:16:05');

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
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `cedula` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `cedula`, `nombre`, `apellido`, `email`, `telefono`, `password`, `tipoUsuario`, `fechaRegistroUsuario`) VALUES
(1, '1322', 'Carlos 2 ', 'Arturo', 'us1@email.com', '3124321249', 'f4203cb0bf86d4e3c84b9d53c44c1afebb7e9094462b3284ea051d49771dbf77', 'Cliente', '2025-03-30'),
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