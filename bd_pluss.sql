-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-07-2017 a las 02:31:52
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_pluss`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment`
--

CREATE TABLE `comment` (
  `idComment` int(11) NOT NULL,
  `text` varchar(2000) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idPublication` int(11) NOT NULL,
  `dateCreation` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `connection`
--

CREATE TABLE `connection` (
  `idConnection` int(11) NOT NULL,
  `idUserFollower` int(11) NOT NULL,
  `dateCreation` datetime NOT NULL,
  `idUserFollowee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `like`
--

CREATE TABLE `like` (
  `idLike` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idPublication` int(11) NOT NULL,
  `dateCreation` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notification`
--

CREATE TABLE `notification` (
  `idNotification` int(11) NOT NULL,
  `typeNotification` varchar(45) NOT NULL,
  `idTypeOfNotification` int(11) NOT NULL,
  `idUserSender` int(11) NOT NULL,
  `dateCreation` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `estate` bit(1) NOT NULL,
  `idUserReceptor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `photo`
--

CREATE TABLE `photo` (
  `idPhoto` int(11) NOT NULL,
  `pathPhoto` varchar(45) NOT NULL,
  `idPublication` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profile`
--

CREATE TABLE `profile` (
  `idprofile` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `pathPhotoProfile` varchar(255) DEFAULT NULL,
  `pathPhotoCover` varchar(255) DEFAULT NULL,
  `emailNotification` bit(1) DEFAULT NULL,
  `smsNotification` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publication`
--

CREATE TABLE `publication` (
  `idPublication` int(11) NOT NULL,
  `dateCreation` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `idUser` int(11) DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `name` varchar(60) NOT NULL,
  `dateRegistration` datetime NOT NULL,
  `dateUpdate` datetime DEFAULT NULL,
  `password` varchar(64) NOT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `datebirth` date NOT NULL,
  `isFacebook` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`idComment`),
  ADD KEY `fk_COMMENT_user1_idx` (`idUser`),
  ADD KEY `fk_COMMENT_PUBLICATION1_idx` (`idPublication`);

--
-- Indices de la tabla `connection`
--
ALTER TABLE `connection`
  ADD PRIMARY KEY (`idConnection`),
  ADD KEY `fk_CONNECTION_user1_idx` (`idUserFollowee`);

--
-- Indices de la tabla `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`idUser`,`idPublication`),
  ADD UNIQUE KEY `UNICO_LIKE` (`idLike`),
  ADD KEY `fk_LIKE_PUBLICATION1_idx` (`idPublication`);

--
-- Indices de la tabla `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`idNotification`),
  ADD KEY `fk_NOTIFICATION_user1_idx` (`idUserReceptor`);

--
-- Indices de la tabla `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`idPhoto`),
  ADD KEY `fk_PHOTO_PUBLICATION1_idx` (`idPublication`);

--
-- Indices de la tabla `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`idprofile`,`idUser`),
  ADD KEY `fk_profile_user_idx` (`idUser`);

--
-- Indices de la tabla `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`idPublication`),
  ADD KEY `fk_PUBLICATION_user1_idx` (`idUser`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comment`
--
ALTER TABLE `comment`
  MODIFY `idComment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;
--
-- AUTO_INCREMENT de la tabla `connection`
--
ALTER TABLE `connection`
  MODIFY `idConnection` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `like`
--
ALTER TABLE `like`
  MODIFY `idLike` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT de la tabla `notification`
--
ALTER TABLE `notification`
  MODIFY `idNotification` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `photo`
--
ALTER TABLE `photo`
  MODIFY `idPhoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `profile`
--
ALTER TABLE `profile`
  MODIFY `idprofile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `publication`
--
ALTER TABLE `publication`
  MODIFY `idPublication` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_COMMENT_PUBLICATION1` FOREIGN KEY (`idPublication`) REFERENCES `publication` (`idPublication`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_COMMENT_user1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `connection`
--
ALTER TABLE `connection`
  ADD CONSTRAINT `fk_CONNECTION_user1` FOREIGN KEY (`idUserFollowee`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `like`
--
ALTER TABLE `like`
  ADD CONSTRAINT `fk_LIKE_PUBLICATION1` FOREIGN KEY (`idPublication`) REFERENCES `publication` (`idPublication`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_LIKE_user1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `fk_NOTIFICATION_user1` FOREIGN KEY (`idUserReceptor`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `fk_PHOTO_PUBLICATION1` FOREIGN KEY (`idPublication`) REFERENCES `publication` (`idPublication`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_profile_user` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `fk_PUBLICATION_user1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
