-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 25-02-2022 a las 18:11:30
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
(1, 8, 'Primer Equipo', 'futbol', NULL),
(4, 8, 'Equipo 2', 'futbol', NULL),
(5, 8, 'Equipo 3', 'futbol', NULL),
(6, 8, 'Equipo 4', 'futbol', NULL);

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
(8, 'La ligadura', 'futbol', '2022-02-28 17:00:00', '2022-04-09 15:00:00', 4);

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
(61, 1, 1, 8, 1, 6, '2022-03-05 15:00:00', '[]'),
(62, 1, 1, 8, 4, 5, '2022-03-05 16:30:00', '[]'),
(63, 1, 1, 8, 6, 5, '2022-03-12 15:00:00', '[]'),
(64, 1, 1, 8, 5, 4, '2022-03-12 16:30:00', '[]'),
(65, 1, 1, 8, 5, 6, '2022-03-19 15:00:00', '[]'),
(66, 1, 1, 8, 5, 1, '2022-03-19 16:30:00', '[]'),
(67, 1, 1, 8, 6, 1, '2022-03-26 15:00:00', '[]'),
(68, 1, 1, 8, 5, 4, '2022-03-26 16:30:00', '[]'),
(69, 1, 1, 8, 5, 6, '2022-04-02 15:00:00', '[]'),
(70, 1, 1, 8, 4, 5, '2022-04-02 16:30:00', '[]'),
(71, 1, 1, 8, 6, 5, '2022-04-09 15:00:00', '[]'),
(72, 1, 1, 8, 1, 5, '2022-04-09 16:30:00', '[]');

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
(15, 4, 'usuario12@mail.com', '[\"ROLE_CAPITAN\",\"ROLE_JUGADOR\"]', '$2y$13$Jw3iJbCxuzi3Og6HYS9rZObcOCP63HM/YcPmw9xzXhFCdRcPY3mp2', 'usuario12', 'user12', NULL),
(16, 4, 'usuario13@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$IReyux0eJL9oYoXY6eQ3tOXz6GJ4scLqAQdsbnwaHZIkYgEjtd.eq', 'usuario13', 'user13', NULL),
(17, 4, 'usuario14@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$jazXuPEO7iQ6RPjiww7FbuB3lwAONMzGI25X6QUi/wUcK.awKEoN2', 'usuario14', 'user14', NULL),
(18, 4, 'usuario15@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$rN.UbViMJUNkQb.YixCHBenkK0psuvlt2HbFAPiIIyXFVSoghmn0K', 'usuario15', 'user15', NULL),
(19, 4, 'usuario19@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$lX//26pnvZ3MBv092upoAeUBuIvL6/axlh.Uy2Xfcjl.Iu1f8CdSS', 'usuario19', 'user19', NULL),
(20, 4, 'usuario20@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$UcJwO6W491Lob2EtMjTs5eKgLcpuwvwg6ph63jglYK0fFHtB81Siy', 'usuario20', 'user20', NULL),
(21, 4, 'usuario21@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$fxAbuXvGOsXq6lRe88PrK.nEs8mIfrF7m6kI30vCDigJMAo5C8E5.', 'usuario21', 'user21', NULL),
(22, 4, 'usuario22@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$Z//CXBTvPUpuEkdyfz9UeeCZrLj/LSAFTV1hGgLJsbs5dtY30omiW', 'usuario22', 'user22', NULL),
(23, 5, 'usuario23@mail.com', '[\"ROLE_CAPITAN\",\"ROLE_JUGADOR\"]', '$2y$13$5fCzOOfsGEVUemJoEHhdaugE95WB1O230fkvNB8Sb85LZF5WBLVC.', 'usuario23', 'user23', NULL),
(24, 4, 'usuario16@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$BKboUu0WjynnoIxCeSjEa.KjOj7FHqe76SdxB00.mWhTN0KAi5U/m', 'usuario16', 'user16', NULL),
(25, 4, 'usuario17@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$36B1RQBYuxskeVbmFMKi1uV.hdbBbWA8Vztjdcc783fWHSUEmks/.', 'usuario17', 'user17', NULL),
(26, 4, 'usuario18@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$KGnG9qaSqcU/Xl8oQ/xHt.n79Q2zwEqiWcmPeXqsIGBEVj90q0r.q', 'usuario18', 'user18', NULL),
(27, 5, 'usuario24@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$aoAWNAoAviE0xLFw61pqjeVUCxOXBk/vHi.YeGKaK8BLVNoWNc85e', 'usuario24', 'user24', NULL),
(28, 5, 'usuario25@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$B6gkcWB7nstA.LNEGhx.SuMy9oNoaccsUoxXViR71SM5PWeIUfuSO', 'usuario25', 'user25', NULL),
(30, 5, 'usuario26@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$Vl70yPkovzFdeRLdOPJq/uJESzrR8.SFJvIYYjY5MRS8.J9Lem0Bq', 'usuario26', 'user26', NULL),
(31, 5, 'usuario27@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$xMXH4hs62jEp6ct.LXh07uC2QdXk2z6S84kezz3PnX/ct0aEP0yXC', 'usuario27', 'user27', NULL),
(32, 5, 'usuario28@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$IRNCRF2BJwor/3dOWE71jO5vGxGpNSBy.rnWwSB.atee5ouPdt5G2', 'usuario28', 'user28', NULL),
(33, 5, 'usuario29@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$Uu.rTfaFvyNHXtLvth4c2ecJxfn1SnOmrGhR2ou87vkiPfL4RcIYO', 'usuario29', 'user29', NULL),
(34, 5, 'usuario30@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$3iMr./J6kiPG7xglPLNYPuktfxehaDRAX0lJi0PoKQ3NS2BtFdgqa', 'usuario30', 'user30', NULL),
(35, 5, 'usuario31@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$Bf4/zthNUJK5xIN1Ud0b9OpjNMSy0.XGVdzJuJ.jip2hDmZGx9Cya', 'usuario31', 'user31', NULL),
(36, 5, 'usuario32@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$LEURpaYBOxGfA.LRJ8qNzOPSNTn28Ift7wtAW12DsqcCzlCpNkb3u', 'usuario32', 'user32', NULL),
(37, 5, 'usuario33@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$rGIMrfw2X/mLUhJvbkCsF.bwAsMo5vhhBibwMxmAhcfTPEDEkhi5i', 'usuario33', 'user33', NULL),
(38, 6, 'usuario34@mail.com', '[\"ROLE_CAPITAN\",\"ROLE_JUGADOR\"]', '$2y$13$TmKpE8IIXge7KS90.5cBZuEj8mr8azs.bN76pSIUezuPsDhGqi2BG', 'usuario34', 'user34', NULL),
(39, 6, 'usuario35@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$JROSon7V7tVemqnv4xaP5Ol9yNFI7/H8T1aQbW/F5cKhrS1FVeQu.', 'usuario35', 'user35', NULL),
(40, 6, 'usuario36@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$XxNmfdj46HALYjXwxWT32uVSkjYFRh97QaFKR0k6j74wo5vQJb2ki', 'usuario36', 'user36', NULL),
(41, 6, 'usuario37@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$7gNWDJ0JZQmHVCKFd2sV6eUqcGCu7G7bGGJsLhn8jAI12Eb.4/VwK', 'usuario37', 'user37', NULL),
(42, 6, 'usuario38@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$PgruvKUbh2YR7/mQJSmcIe2gHfLfPYQ1XllFb/JSeNjTYE6lTT98G', 'usuario38', 'user38', NULL),
(43, 6, 'usuario39@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$S/2fxzwjNA3OKijaZUoohuyz1iTGHd62Npb4roPW116aHoSzO4K1.', 'usuario39', 'user39', NULL),
(44, 6, 'usuario40@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$Zlod.UGuzQHv/i5EB0uul.XkzkRp7aZqF6ZKOEjP4jPQqVhswxOLu', 'usuario40', 'user40', NULL),
(45, 6, 'usuario41@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$UGYaP4/ADDeyTS6CkiNwDOyVbPP9aX4r5mqoX9WclKzGti5ssEx2a', 'usuario41', 'user41', NULL),
(46, 6, 'usuario42@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$lzRwne4bhG2M7Cr9Pm8AAOvJzKhsswdFTSa7hW7WPZ920enH38F8i', 'usuario42', 'user42', NULL),
(47, 6, 'usuario43@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$JZErVxvklulxICfl16ew4.yQR3jaXdNSkSf2vQR9W/QsZ5dprJwY6', 'usuario43', 'user43', NULL),
(48, 6, 'usuario44@mail.com', '[\"ROLE_JUGADOR\"]', '$2y$13$n1rmyS3BSc914AxaD2FePO9xxmpBiJ5nPXhw1.0SuK1TSEHUaEQvq', 'usuario44', 'user44', NULL),
(49, NULL, 'profe@mail.com', '[\"ROLE_ADMIN\"]', '$2y$13$69.roBHEcT/.UN.IPvMc3.wX24cni55rfkERI0B2og1K8NB/OJc7m', 'profe', 'sor', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `liga`
--
ALTER TABLE `liga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `partido`
--
ALTER TABLE `partido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

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
