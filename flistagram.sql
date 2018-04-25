-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2018 a las 14:06:06
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
(9, 'Que tal comentario papurrin', 7, 24, '2018-04-24', '2018-04-24');

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
(4, 7, 24, '2018-04-23', '2018-04-23');

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
(23, '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451Ohqq4Y.jpg', 24, '2018-04-23', '2018-04-23', '/api/v1/storage/24/image.jpg'),
(24, '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b24519iTrcn.jpg', 25, '2018-04-23', '2018-04-23', '/api/v1/storage/25/image.jpg'),
(25, '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451eIhRBw.jpg', 26, '2018-04-24', '2018-04-24', '/api/v1/storage/26/image.jpg');

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
(26, 7, 'Peru', '2018-04-24', '2018-04-24', 'Mira esta descripción papu');

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
(6, 'dev_cort', 'Ismael', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'miemal@gmail.com', '', '', '2018-04-23', '2018-04-23'),
(7, 'dev_cortesito', 'Ismael Cotegana', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'ismael@mfial.com', '/api/v1/storage/u/7/profile.jpg', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451svjesq.jpg', '2018-04-23', '2018-04-23'),
(8, 'josepepe', 'Jose', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'misemal@gmail.com', '', '', '2018-04-24', '2018-04-24');

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
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `connection`
--
ALTER TABLE `connection`
  MODIFY `id_connection` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `like`
--
ALTER TABLE `like`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `photo`
--
ALTER TABLE `photo`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `publication`
--
ALTER TABLE `publication`
  MODIFY `id_publication` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
