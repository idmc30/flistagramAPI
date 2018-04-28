-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-04-2018 a las 07:50:04
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
(11, 14, 13, '2018-04-28', '2018-04-28'),
(12, 13, 14, '2018-04-28', '2018-04-28');

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
(19, 14, 37, '2018-04-28', '2018-04-28'),
(20, 14, 39, '2018-04-28', '2018-04-28');

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
(36, '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61Nfjk9Y.jpg', 37, '2018-04-28', '2018-04-28', '/api/v1/storage/pub/37/image.jpg'),
(37, '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61r8umy8.jpg', 38, '2018-04-28', '2018-04-28', '/api/v1/storage/pub/38/image.jpg'),
(38, '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e611ziYqb.jpg', 39, '2018-04-28', '2018-04-28', '/api/v1/storage/pub/39/image.jpg'),
(39, '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61dOwsyo.jpg', 40, '2018-04-28', '2018-04-28', '/api/v1/storage/pub/40/image.jpg'),
(40, '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e615xfsZn.jpg', 41, '2018-04-28', '2018-04-28', '/api/v1/storage/pub/41/image.jpg'),
(41, '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61lONk4P.jpg', 42, '2018-04-28', '2018-04-28', '/api/v1/storage/pub/42/image.jpg'),
(42, '3fdba35f04dc8c462986c992bcf875546257113072a909c162f7e470e581e278gzSv6J.jpg', 43, '2018-04-28', '2018-04-28', '/api/v1/storage/pub/43/image.jpg'),
(43, '3fdba35f04dc8c462986c992bcf875546257113072a909c162f7e470e581e27894GolM.jpg', 44, '2018-04-28', '2018-04-28', '/api/v1/storage/pub/44/image.jpg'),
(44, '3fdba35f04dc8c462986c992bcf875546257113072a909c162f7e470e581e278Zix3TP.jpg', 45, '2018-04-28', '2018-04-28', '/api/v1/storage/pub/45/image.jpg'),
(45, '3fdba35f04dc8c462986c992bcf875546257113072a909c162f7e470e581e278jYlv8x.jpg', 46, '2018-04-28', '2018-04-28', '/api/v1/storage/pub/46/image.jpg'),
(46, '3fdba35f04dc8c462986c992bcf875546257113072a909c162f7e470e581e278K2QewY.jpg', 47, '2018-04-28', '2018-04-28', '/api/v1/storage/pub/47/image.jpg'),
(47, '3fdba35f04dc8c462986c992bcf875546257113072a909c162f7e470e581e278OW79JS.jpg', 48, '2018-04-28', '2018-04-28', '/api/v1/storage/pub/48/image.jpg');

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
(37, 14, 'Perú', '2018-04-28', '2018-04-28', 'Montañas'),
(38, 14, 'Ni idea', '2018-04-28', '2018-04-28', 'Selfie'),
(39, 14, 'Nose', '2018-04-28', '2018-04-28', 'Animal'),
(40, 14, 'a', '2018-04-28', '2018-04-28', 'a'),
(41, 14, 'w', '2018-04-28', '2018-04-28', 'wolf'),
(42, 14, 'ad', '2018-04-28', '2018-04-28', 'horser'),
(43, 13, 'a', '2018-04-28', '2018-04-28', 'a'),
(44, 13, 'a', '2018-04-28', '2018-04-28', 'a'),
(45, 13, '', '2018-04-28', '2018-04-28', ''),
(46, 13, '', '2018-04-28', '2018-04-28', ''),
(47, 13, '', '2018-04-28', '2018-04-28', ''),
(48, 13, '', '2018-04-28', '2018-04-28', '');

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
(13, 'dev_cort', 'Ismael Luis ', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'ismael14_16@hotmail.com', '/api/v1/storage/u/13/profile.jpg', '3fdba35f04dc8c462986c992bcf875546257113072a909c162f7e470e581e278oPa0L9.jpg', '2018-04-28', '2018-04-28'),
(14, 'andree_ramos', 'Richard Ramos', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'andre@gmail.com', '/api/v1/storage/u/14/profile.jpg', '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61BLPao6.jpg', '2018-04-28', '2018-04-28');

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
  MODIFY `id_connection` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `like`
--
ALTER TABLE `like`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `photo`
--
ALTER TABLE `photo`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `publication`
--
ALTER TABLE `publication`
  MODIFY `id_publication` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
