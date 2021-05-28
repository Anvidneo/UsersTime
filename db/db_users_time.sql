-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2021 a las 04:09:26
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_users_time`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_activities`
--

CREATE TABLE `tbl_activities` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `date_created` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_activities`
--

INSERT INTO `tbl_activities` (`id`, `description`, `date_created`, `id_user`) VALUES
(1, 'A description', '2021-05-27', 1),
(2, 'Other activity', '2021-05-28', 1),
(3, 'Programming', '2021-05-28', 1),
(4, 'Hello world', '2021-05-28', 1),
(9, 'hokd', '2021-05-28', 2),
(10, 'Other', '2021-05-28', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_times`
--

CREATE TABLE `tbl_times` (
  `id` int(11) NOT NULL,
  `time` double NOT NULL,
  `date` date NOT NULL,
  `id_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_times`
--

INSERT INTO `tbl_times` (`id`, `time`, `date`, `id_activity`) VALUES
(2, 5, '2021-05-28', 1),
(6, 3, '2021-05-13', 4),
(8, 2, '2021-05-06', 10),
(15, 6, '2021-05-27', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `user` varchar(15) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `date_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `user`, `password`, `date_created`) VALUES
(1, 'Anvid', '123', '2021-05-28'),
(2, 'Vale', '12345', '2021-05-28'),
(3, 'Soto', '123', '2021-05-28');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_activities`
--
ALTER TABLE `tbl_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_times`
--
ALTER TABLE `tbl_times`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_activities`
--
ALTER TABLE `tbl_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tbl_times`
--
ALTER TABLE `tbl_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
