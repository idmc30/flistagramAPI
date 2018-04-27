-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-04-2018 a las 20:34:06
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `flistagram`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL,
  `text` varchar(2000) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_publication` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comment`
--

INSERT INTO `comment` (`id_comment`, `text`, `id_user`, `id_publication`, `created_at`, `updated_at`) VALUES
(7, 'Que tal comentario papurrin', 7, 24, '2018-04-23', '2018-04-23'),
(8, 'Que tal comentario papurrin', 7, 24, '2018-04-23', '2018-04-23'),
(9, 'Que tal comentario papurrin', 7, 24, '2018-04-24', '2018-04-24'),
(10, 'Mira este comentario papurrin', 6, 24, '2018-04-26', '2018-04-26'),
(11, 'Comentario', 6, 25, '2018-04-26', '2018-04-26'),
(12, 'cscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscs', 6, 25, '2018-04-26', '2018-04-26'),
(13, 'cscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscs', 6, 25, '2018-04-26', '2018-04-26'),
(14, 'cscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscscs', 6, 25, '2018-04-26', '2018-04-26'),
(15, 'asodmaosmd :3', 6, 25, '2018-04-26', '2018-04-26'),
(16, 'Hola', 7, 24, '2018-04-26', '2018-04-26'),
(17, 'mira este comentario papurrin', 7, 25, '2018-04-26', '2018-04-26'),
(18, 'ascs', 7, 25, '2018-04-26', '2018-04-26'),
(19, 'ascscscsc', 7, 25, '2018-04-26', '2018-04-26'),
(20, 'ascscscsc', 7, 25, '2018-04-26', '2018-04-26'),
(21, 'ascscs', 7, 25, '2018-04-26', '2018-04-26'),
(22, 'cscascsc', 7, 25, '2018-04-26', '2018-04-26'),
(23, 'ascscs', 7, 25, '2018-04-26', '2018-04-26'),
(24, 'ascsc', 7, 25, '2018-04-26', '2018-04-26'),
(25, 'mira comeento', 7, 24, '2018-04-26', '2018-04-26'),
(26, 'Comentario', 6, 27, '2018-04-27', '2018-04-27'),
(27, 'Hola', 7, 30, '2018-04-27', '2018-04-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `connection`
--

CREATE TABLE `connection` (
  `id_connection` int(11) NOT NULL,
  `id_follower` int(11) NOT NULL,
  `id_to_follow` int(11) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `connection`
--

INSERT INTO `connection` (`id_connection`, `id_follower`, `id_to_follow`, `created_at`, `updated_at`) VALUES
(7, 7, 6, '2018-04-27', '2018-04-27'),
(10, 6, 7, '2018-04-27', '2018-04-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `like`
--

CREATE TABLE `like` (
  `id_like` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_publication` int(11) NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `like`
--

INSERT INTO `like` (`id_like`, `id_user`, `id_publication`, `updated_at`, `created_at`) VALUES
(9, 6, 24, '2018-04-26', '2018-04-26'),
(16, 6, 27, '2018-04-27', '2018-04-27'),
(15, 6, 30, '2018-04-27', '2018-04-27'),
(18, 6, 33, '2018-04-27', '2018-04-27'),
(13, 7, 24, '2018-04-26', '2018-04-26'),
(11, 7, 25, '2018-04-26', '2018-04-26'),
(12, 7, 26, '2018-04-26', '2018-04-26'),
(17, 7, 29, '2018-04-27', '2018-04-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `photo`
--

CREATE TABLE `photo` (
  `id_photo` int(11) NOT NULL,
  `path_photo` varchar(255) NOT NULL,
  `id_publication` int(11) NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  `public_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `photo`
--

INSERT INTO `photo` (`id_photo`, `path_photo`, `id_publication`, `updated_at`, `created_at`, `public_path`) VALUES
(23, '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451Ohqq4Y.jpg', 24, '2018-04-23', '2018-04-23', '/api/v1/storage/pub/24/image.jpg'),
(24, '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b24519iTrcn.jpg', 25, '2018-04-23', '2018-04-23', '/api/v1/storage/pub/25/image.jpg'),
(25, '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451eIhRBw.jpg', 26, '2018-04-24', '2018-04-24', '/api/v1/storage/pub/26/image.jpg'),
(26, '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451w9pF1j.jpg', 27, '2018-04-27', '2018-04-27', '/api/v1/storage/pub/27/image.jpg'),
(28, 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683OKIgNA.jpg', 29, '2018-04-27', '2018-04-27', '/api/v1/storage/pub/29/image.jpg'),
(29, 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683W5J6az.jpg', 30, '2018-04-27', '2018-04-27', '/api/v1/storage/pub/30/image.jpg'),
(30, 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683s9zykv.jpg', 31, '2018-04-27', '2018-04-27', '/api/v1/storage/pub/31/image.jpg'),
(31, 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683vVP3oF.jpg', 32, '2018-04-27', '2018-04-27', '/api/v1/storage/pub/32/image.jpg'),
(32, '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451VZkf8G.jpg', 33, '2018-04-27', '2018-04-27', '/api/v1/storage/pub/33/image.jpg'),
(33, '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b24511zwjeO.jpg', 34, '2018-04-27', '2018-04-27', '/api/v1/storage/pub/34/image.jpg'),
(34, '6b51d431df5d7f141cbececcf79edf3dd861c3b4069f0b11661a3eefacbba918CP1voX.jpg', 35, '2018-04-27', '2018-04-27', '/api/v1/storage/pub/35/image.jpg'),
(35, '6b51d431df5d7f141cbececcf79edf3dd861c3b4069f0b11661a3eefacbba918goQx7c.jpg', 36, '2018-04-27', '2018-04-27', '/api/v1/storage/pub/36/image.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publication`
--

CREATE TABLE `publication` (
  `id_publication` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `publication`
--

INSERT INTO `publication` (`id_publication`, `id_user`, `location`, `updated_at`, `created_at`, `description`) VALUES
(24, 7, 'Peru', '2018-04-23', '2018-04-23', 'Mira esta descripción papu'),
(25, 7, 'Peru', '2018-04-23', '2018-04-23', 'Mira esta descripción papu'),
(26, 7, 'Peru', '2018-04-24', '2018-04-24', 'Mira esta descripción papu'),
(27, 7, 'Peru', '2018-04-27', '2018-04-27', 'Publicacion de publicaciones :V'),
(29, 6, 'China', '2018-04-27', '2018-04-27', 'Mi descripcion'),
(30, 6, 'China', '2018-04-27', '2018-04-27', 'Montañas'),
(31, 6, 'cas', '2018-04-27', '2018-04-27', 'csc'),
(32, 6, 'scs', '2018-04-27', '2018-04-27', 'casc'),
(33, 7, 'csc', '2018-04-27', '2018-04-27', 'cas'),
(34, 7, 'Peru', '2018-04-27', '2018-04-27', 'Publicacion de publicaciones :V'),
(35, 12, 'd', '2018-04-27', '2018-04-27', 'd'),
(36, 12, 'd', '2018-04-27', '2018-04-27', 'd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `name` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `path_photo` varchar(255) NOT NULL,
  `name_file_photo` varchar(255) NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `username`, `name`, `password`, `email`, `path_photo`, `name_file_photo`, `updated_at`, `created_at`) VALUES
(6, 'dev_cort', 'Ismael', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'miemal@gmail.com', '/api/v1/storage/u/6/profile.jpg', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683FofKPI.jpg', '2018-04-27', '2018-04-23'),
(7, 'dev_cortesito', 'Ismael Cotegana', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'ismael@mfial.com', '/api/v1/storage/u/7/profile.jpg', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451svjesq.jpg', '2018-04-23', '2018-04-23'),
(8, 'josepepe', 'Jose', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'misemal@gmail.com', '', '', '2018-04-24', '2018-04-24'),
(9, 'ismael14_16', 'CSGO', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Charles@4abyte.ca', '', '', '2018-04-27', '2018-04-27'),
(10, 'demo', 'Ismael Luis ', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'pazduradera9@hotmail.com', '', '', '2018-04-27', '2018-04-27'),
(11, 'demo1', 'Internet Software & Services', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'ismael134_16@hotmail.com', '', '', '2018-04-27', '2018-04-27'),
(12, 'ismaSocial', 'csgo_logo_2.png', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'icortegana@unprg.edu.pe', '', '', '2018-04-27', '2018-04-27');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `fk_COMMENT_user1_idx` (`id_user`),
  ADD KEY `fk_COMMENT_PUBLICATION1_idx` (`id_publication`);

--
-- Indices de la tabla `connection`
--
ALTER TABLE `connection`
  ADD PRIMARY KEY (`id_connection`),
  ADD KEY `fk_CONNECTION_user1_idx` (`id_to_follow`),
  ADD KEY `FK_FOLLOWER_CONNECTION_USER` (`id_follower`) USING BTREE;

--
-- Indices de la tabla `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`id_user`,`id_publication`),
  ADD UNIQUE KEY `UNICO_LIKE` (`id_like`),
  ADD KEY `fk_LIKE_PUBLICATION1_idx` (`id_publication`);

--
-- Indices de la tabla `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id_photo`),
  ADD KEY `fk_PHOTO_PUBLICATION1_idx` (`id_publication`);

--
-- Indices de la tabla `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`id_publication`),
  ADD KEY `fk_PUBLICATION_user1_idx` (`id_user`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `connection`
--
ALTER TABLE `connection`
  MODIFY `id_connection` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `like`
--
ALTER TABLE `like`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `photo`
--
ALTER TABLE `photo`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `publication`
--
ALTER TABLE `publication`
  MODIFY `id_publication` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_COMMENT_PUBLICATION1` FOREIGN KEY (`id_publication`) REFERENCES `publication` (`id_publication`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_COMMENT_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `connection`
--
ALTER TABLE `connection`
  ADD CONSTRAINT `connection_ibfk_1` FOREIGN KEY (`id_follower`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `fk_CONNECTION_user1` FOREIGN KEY (`id_to_follow`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `like`
--
ALTER TABLE `like`
  ADD CONSTRAINT `fk_LIKE_PUBLICATION1` FOREIGN KEY (`id_publication`) REFERENCES `publication` (`id_publication`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_LIKE_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `fk_PHOTO_PUBLICATION1` FOREIGN KEY (`id_publication`) REFERENCES `publication` (`id_publication`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `fk_PUBLICATION_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
