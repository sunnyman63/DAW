-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 30-05-2022 a las 00:02:32
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `veredeporte`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campo`
--

CREATE TABLE `campo` (
  `id` int(11) NOT NULL,
  `tipo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `campo`
--

INSERT INTO `campo` (`id`, `tipo`) VALUES
(1, 'futbol'),
(2, 'futbol'),
(3, 'baloncesto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220222181054', '2022-02-22 19:10:59', 177),
('DoctrineMigrations\\Version20220223172044', '2022-02-23 18:20:56', 58);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id` int(11) NOT NULL,
  `liga_id` int(11) DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `solicitar_participar_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id`, `liga_id`, `nombre`, `tipo`, `solicitar_participar_id`) VALUES
(1, 11, 'Primer Equipo', 'futbol', NULL),
(4, 11, 'equipo 2', 'futbol', NULL),
(5, 11, 'equipo 3', 'futbol', NULL),
(6, 11, 'equipo 4', 'futbol', NULL),
(7, NULL, 'equipazo', 'futbol', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_usuario`
--

CREATE TABLE `equipo_usuario` (
  `equipo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liga`
--

CREATE TABLE `liga` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `max_equipos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `liga`
--

INSERT INTO `liga` (`id`, `nombre`, `tipo`, `fecha_inicio`, `fecha_fin`, `max_equipos`) VALUES
(11, 'La ligadura', 'futbol', '2022-05-02 17:00:00', '2022-06-11 15:00:00', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido`
--

CREATE TABLE `partido` (
  `id` int(11) NOT NULL,
  `arbitro_id` int(11) NOT NULL,
  `campo_id` int(11) NOT NULL,
  `liga_id` int(11) NOT NULL,
  `local_id` int(11) NOT NULL,
  `visitante_id` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `resultado` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:json)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `partido`
--

INSERT INTO `partido` (`id`, `arbitro_id`, `campo_id`, `liga_id`, `local_id`, `visitante_id`, `fecha_hora`, `resultado`) VALUES
(25, 1, 1, 11, 1, 6, '2022-05-07 15:00:00', '{\"local\":\"1\",\"visitante\":\"2\"}'),
(26, 1, 1, 11, 4, 5, '2022-05-07 16:30:00', '{\"local\":\"1\",\"visitante\":\"1\"}'),
(27, 1, 1, 11, 6, 5, '2022-05-14 15:00:00', '[]'),
(28, 1, 1, 11, 1, 4, '2022-05-14 16:30:00', '[]'),
(29, 1, 1, 11, 4, 6, '2022-05-21 15:00:00', '[]'),
(30, 1, 1, 11, 5, 1, '2022-05-21 16:30:00', '[]'),
(31, 1, 1, 11, 6, 1, '2022-05-28 15:00:00', '[]'),
(32, 1, 1, 11, 5, 4, '2022-05-28 16:30:00', '[]'),
(33, 1, 1, 11, 5, 6, '2022-06-04 15:00:00', '[]'),
(34, 1, 1, 11, 4, 1, '2022-06-04 16:30:00', '[]'),
(35, 1, 1, 11, 6, 4, '2022-06-11 15:00:00', '[]'),
(36, 1, 1, 11, 1, 5, '2022-06-11 16:30:00', '[]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `vigila_id` int(11) NOT NULL,
  `equipo_id` int(11) NOT NULL,
  `campo_id` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id`, `vigila_id`, `equipo_id`, `campo_id`, `fecha_hora`) VALUES
(9, 49, 7, 1, '2022-06-01 16:00:00'),
(10, 1, 1, 1, '2022-05-30 16:00:00'),
(11, 1, 1, 1, '2022-05-31 16:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `equipo_id` int(11) DEFAULT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `curso` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `equipo_id`, `email`, `roles`, `password`, `nombre`, `apellidos`, `curso`) VALUES
(1, NULL, 'admin@mail.com', '[\"ROLE_ADMIN\"]', '$2y$13$WXuS12JLc04Vb2HP5SAzdOC31U9oC9eOKaJ/JW9uhNxehMpNPAfL.', 'admin', 'admin', 'cualquiera'),
(2, 1, 'usuario1@mail.com', '[\"ROLE_CAPITAN\",\"ROLE_JUGADOR\"]', '$2y$13$OJsgbp/9lAdJe6SnyLJSAuGSTADneD4Ux0ADGb9pO94p9QatF5I1e', 'usuario1', 'user', NULL),
(3, 1, 'usuario2@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$nbITeTCT/0AX6wxMVQcrdeyYWanZSPvNeeeaT0a4BJNhVxzjPZN/y', 'usuario2', 'user2', NULL),
(6, 1, 'usuario3@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$Y3FDYvdskALCzwGoTrz04eYUmVGLBzJb28UURNLYB9ii6TvXlU0Q.', 'usuario3', 'user3', NULL),
(7, 1, 'usuario4@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$S7k1incmpMS3ohx8wOIt7OS.jiYpdcU0QaXdnvfSfmWoWVwZSlTRu', 'usuario4', 'user4', NULL),
(8, 1, 'usuario5@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$3FGvAocphoZUnNCGFoaYwO5KHgPEGXycGVKeW3BsjubdemizTUuIS', 'usuario5', 'user5', NULL),
(9, 1, 'usuario6@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$DQeBJRmlAhZ1mYZKfss6pe858Ql/aTC7IdRhFRjUEiQUff9rDe0L2', 'usuario6', 'user6', NULL),
(10, 1, 'usuario7@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$mhcc4J7ZS2GdNVrfQhFd7eyX4o943xemBync1PUhbD.2eeowyyRzC', 'usuario7', 'user7', NULL),
(11, 1, 'usuario8@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$q2LR0Stcu7lZ73RXn6haxONPgCITK8ylDg2/9hnXxwsPHCxnsq4ge', 'usuario8', 'user8', NULL),
(12, 1, 'usuario9@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$.3P./0bQmQxKQ4Z9JIi6jOLmzELGUIGfXY0A/kgUd.CO6tOlj19vS', 'usuario9', 'user9', NULL),
(13, 1, 'usuario10@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$g5wYg.CIJ9PzacDjp/wKsuXGRi/lHaTVP80YXLezCz5By/KXSZ2Wu', 'usuario10', 'user10', NULL),
(14, 1, 'usuario11@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$kG3lqXh5z/uXJE2.022BkePfUINSGf/PuBcgGEm4KVvfs7NX/7h0K', 'usuario11', 'user11', NULL),
(15, 4, 'usuario12@mail.com', '[\"ROLE_CAPITAN\",\"ROLE_JUGADOR\"]', '$2y$13$w8VM56GPmQ333myO.86nKeQjEYoDMzp9hD.kYVsFpCxWWdw7OgS42', 'usuario12', 'user12', NULL),
(16, 4, 'usuario13@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$NraNRZL1mjp.GzFc/M0.ye5ae0mmF4uc5bLkWGTrUz/1mGZFCG5g2', 'usuario13', 'user13', NULL),
(17, 4, 'usuario14@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$HkEW/wGNETsujPl51Pg20.A8dUFcd97g6SqBiZZsWQ8wE6Rw6ZBDC', 'usuario14', 'user14', NULL),
(18, 4, 'usuario15@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$P831IjPVIZrP5AJ91DS2BeTQiQylJSEP7PJaTDi1oFm4UFRjSJUSO', 'usuario15', 'user15', NULL),
(19, 4, 'usuario16@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$wZfh/qPHeqoDqgq/dtYLA.K0HAu4t.pKkqu1cEhhYw8hPmsRt9vaq', 'usuario16', 'user16', NULL),
(20, 4, 'usuario17@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$gz534OxFRKTg548Bdh1a8u0k3jij3rpGWC4nz5Gxw1Ti27M83iofa', 'usuario17', 'user17', NULL),
(21, 4, 'usuario18@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$FAUpj6LMQTfUnqzkUx/eV.i9UTdc7gTEfjsy3PBc.8jOxkFQeTjeC', 'usuario18', 'user18', NULL),
(22, 4, 'usuario19@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$NqyrtSnj7nxINoSoxwJO8.wdcO3BfDRErWxILDVOnhOGWm83fmYPa', 'usuario19', 'user19', NULL),
(23, 4, 'usuario20@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$4Ql8//ril41nndDz6d9baOf9hyBTVw9bZC5rWUSYANF.gwLJWuKhq', 'usuario20', 'user20', NULL),
(24, 4, 'usuario21@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$3T0.VIa6hVO0GXHbaJCe/ejfKRuBG59QantlZfvZ4Xz5NgDyvl4ES', 'usuario21', 'user21', NULL),
(25, 4, 'usuario22@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$HdVNSFPzCZRsIsc1MgkY6uM33U4tr5encH.Izbg.EfLG00DMXpAIq', 'usuario22', 'user22', NULL),
(26, 5, 'usuario23@mail.com', '[\"ROLE_CAPITAN\",\"ROLE_JUGADOR\"]', '$2y$13$OnaxX6CTRGKtGtXgPIzCA.rnhgnNMe56otAaMQGimJrRDuc23Tw76', 'usuario23', 'user23', NULL),
(28, 5, 'usuario24@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$T7SeTjO3J47gGgMenjZ2uuN3BhfzmDVScXsTTe746GQpfOzhr/UbG', 'usuario24', 'user24', NULL),
(29, 5, 'usuario25@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$NubTmf3M6j.93sx1u41RYuhunKN8sTow1eMfrnsKYnkNQjvHP2P3m', 'usuario25', 'user25', NULL),
(30, 5, 'usuario26@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$vXIwGBjcBPds8qWVmrm4yOWmyN9mizD4Qc626Qhy/d4ZCPjZP5iQi', 'usuario26', 'user26', NULL),
(31, 5, 'usuario27@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$MwEMGeZJ6ta/CgsOrLlGhekD64REHntrVyZbqcXwrr2AtjbtM9cBO', 'usuario27', 'user27', NULL),
(32, 5, 'usuario28@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$O4Mj2sgKE3K6RiI31MUNLuyPXadpQRgWGqwQPPQt9768cpFDJa5Ni', 'usuario28', 'user28', NULL),
(33, 5, 'usuario29@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$7o.GcDnKDVHmdP/EieSQUedM1.B2ej/lG3anDd9vCxmczF/11LwVq', 'usuario29', 'user29', NULL),
(34, 5, 'usuario30@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$jBRKTL.0eMfeaNHam6.08eEOMuQo9dFGqF5eCpT1jIymCuiMJyKQC', 'usuario30', 'user30', NULL),
(35, 5, 'usuario31@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$luKOmqst35278XOP8biQ8.zvjAGgbsyUXYAGkbGQTrCpum.MYjtSu', 'usuario31', 'user31', NULL),
(36, 5, 'usuario32@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$3D.dgOXWlcm88zS/2syvd.egA4AUeN7eIH0MRsCcNP/ZOYH8w/KvC', 'usuario32', 'user32', NULL),
(37, 5, 'usuario33@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$xT5UsjT2qarIP6xDIMSlxuFKymSfo61Ogk8rczGzj9H0FIelO1FIy', 'usuario33', 'user33', NULL),
(38, 6, 'usuario34@mail.com', '[\"ROLE_CAPITAN\",\"ROLE_JUGADOR\"]', '$2y$13$8T05UUAfiAQ8usMezFNRzO5IL9Wq4Hkic5PQ7dwNSWJHQ0.UBTgBq', 'usuario34', 'user34', NULL),
(39, 6, 'usuario35@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$uRhW/9Wr1Pv3SDd4RL1I/exCxX2jTcQT1sqG4z9.MsdtBOmtktoDm', 'usuario35', 'user35', NULL),
(40, 6, 'usuario36@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$vIiaqPKuY.m2vRV6it9tvuM5afMsHorEN/7SRx3HRlEe8WttISujm', 'usuario36', 'user36', NULL),
(41, 6, 'usuario37@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$ne4k9izdZiRrCGLLxfvnQOhcJgfXsoxllHQ0LrtGsd94P0mmQX8D.', 'usuario37', 'user37', NULL),
(42, 6, 'usuario38@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$qOXTjaTHAaya9tHKS.P3kOLk00PCimVdlYEJdei8ubsegY4R6wy6y', 'usuario38', 'user38', NULL),
(43, 6, 'usuario39@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$LGpPQFJRUo/BWo9HY14npOReDKkY4xfAcEYiewjWgsS8wTu1BpoGu', 'usuario39', 'user39', NULL),
(44, 6, 'usuario40@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$H8yO2.Lf/y0g9/wRNAfz5udFEEDSX4NIN5s06cRsUrwhrDp/x/djS', 'usuario40', 'user40', NULL),
(45, 6, 'usuario41@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$.q4k4rN3TgNjYttTh6V17eCDcKWNiOpCbeqwp09w0rzW0ZEh/B4bO', 'usuario41', 'user41', NULL),
(46, 6, 'usuario42@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$lyJzb6wwBuzk4CpLhXSlo.V.5HR9tPaLADrY7AH8qERt3fkL6yQhq', 'usuario42', 'user42', NULL),
(47, 6, 'usuario43@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$U5j3ZOumTVg53IXmKtz23.ja8xXfN2zTC/1IlYbr2FA/BbmlWtjV.', 'usuario43', 'user43', NULL),
(48, 6, 'usuario44@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$2vyO8nhZ.mcHbTHHKaG4KOpv2UyFK8XG45eW7K.M1FHcw0R8EIfBK', 'usuario44', 'user44', NULL),
(49, NULL, 'profe@email.com', '[\"ROLE_ADMIN\"]', '$2y$13$exyCAitaRWIubqA4EeK6BOy8OmmMndQbdmZ5GlnDW1ZEjO7Yye/ti', 'profe', 'sor', NULL),
(50, 7, 'sanchez@gmail.com', '[\"ROLE_CAPITAN\",\"ROLE_JUGADOR\"]', '$2y$13$FUVd1fLXE48hbTSodXIJ5u/3Hp4RLuws5VB2wwLuhXlWxht0KPli.', 'Pedro', 'Sanchez', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `campo`
--
ALTER TABLE `campo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C49C530BCF098064` (`liga_id`),
  ADD KEY `IDX_C49C530B80285EAB` (`solicitar_participar_id`);

--
-- Indices de la tabla `equipo_usuario`
--
ALTER TABLE `equipo_usuario`
  ADD PRIMARY KEY (`equipo_id`,`usuario_id`),
  ADD KEY `IDX_6F4B267F23BFBED` (`equipo_id`),
  ADD KEY `IDX_6F4B267FDB38439E` (`usuario_id`);

--
-- Indices de la tabla `liga`
--
ALTER TABLE `liga`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `partido`
--
ALTER TABLE `partido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4E79750B66FE4594` (`arbitro_id`),
  ADD KEY `IDX_4E79750BA17A385C` (`campo_id`),
  ADD KEY `IDX_4E79750BCF098064` (`liga_id`),
  ADD KEY `IDX_4E79750B5D5A2101` (`local_id`),
  ADD KEY `IDX_4E79750BD80AA8AF` (`visitante_id`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_188D2E3B8DA62F90` (`vigila_id`),
  ADD KEY `IDX_188D2E3B23BFBED` (`equipo_id`),
  ADD KEY `IDX_188D2E3BA17A385C` (`campo_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2265B05DE7927C74` (`email`),
  ADD KEY `IDX_2265B05D23BFBED` (`equipo_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `campo`
--
ALTER TABLE `campo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `liga`
--
ALTER TABLE `liga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `partido`
--
ALTER TABLE `partido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `FK_C49C530B80285EAB` FOREIGN KEY (`solicitar_participar_id`) REFERENCES `liga` (`id`),
  ADD CONSTRAINT `FK_C49C530BCF098064` FOREIGN KEY (`liga_id`) REFERENCES `liga` (`id`);

--
-- Filtros para la tabla `equipo_usuario`
--
ALTER TABLE `equipo_usuario`
  ADD CONSTRAINT `FK_6F4B267F23BFBED` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_6F4B267FDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `partido`
--
ALTER TABLE `partido`
  ADD CONSTRAINT `FK_4E79750B5D5A2101` FOREIGN KEY (`local_id`) REFERENCES `equipo` (`id`),
  ADD CONSTRAINT `FK_4E79750B66FE4594` FOREIGN KEY (`arbitro_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_4E79750BA17A385C` FOREIGN KEY (`campo_id`) REFERENCES `campo` (`id`),
  ADD CONSTRAINT `FK_4E79750BCF098064` FOREIGN KEY (`liga_id`) REFERENCES `liga` (`id`),
  ADD CONSTRAINT `FK_4E79750BD80AA8AF` FOREIGN KEY (`visitante_id`) REFERENCES `equipo` (`id`);

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `FK_188D2E3B23BFBED` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`),
  ADD CONSTRAINT `FK_188D2E3B8DA62F90` FOREIGN KEY (`vigila_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_188D2E3BA17A385C` FOREIGN KEY (`campo_id`) REFERENCES `campo` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_2265B05D23BFBED` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
