-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2019 a las 10:59:15
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectofinal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cases`
--

CREATE TABLE `cases` (
  `case_ID` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `lawer_ID` bigint(20) NOT NULL,
  `client_ID` bigint(20) NOT NULL,
  `type` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `client_ID` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `surname` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `birth_date` date NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `username` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `bill` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`client_ID`, `name`, `surname`, `birth_date`, `phone`, `email`, `username`, `password`, `bill`) VALUES
(2, 'Nicolás', 'Figueras Parras', '1999-03-22', 639941992, 'nicolasfiguerasparras@gmail.com', 'nicoClient', 'nicoClient', 350),
(3, 'Fernando', 'Juanez ', '1998-12-03', 626451200, 'fernando@gmail.com', 'fernando', 'fernando', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lawers`
--

CREATE TABLE `lawers` (
  `lawer_ID` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `surname` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `birth_date` date NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `username` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `salary` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `lawers`
--

INSERT INTO `lawers` (`lawer_ID`, `name`, `surname`, `birth_date`, `phone`, `email`, `username`, `password`, `salary`) VALUES
(1, 'Nicolás', 'Figueras Parras', '1999-03-22', 639941992, 'nico@law.com', 'nicoLawer', 'nicoLawer', 1999);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment`
--

CREATE TABLE `payment` (
  `payment_ID` bigint(20) UNSIGNED NOT NULL,
  `quantity` float(7,2) NOT NULL,
  `client_ID` int(5) NOT NULL,
  `worker_ID` int(5) NOT NULL,
  `date` date NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `payment`
--

INSERT INTO `payment` (`payment_ID`, `quantity`, `client_ID`, `worker_ID`, `date`, `type`) VALUES
(3, 350.00, 2, 1, '2019-05-19', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

CREATE TABLE `tasks` (
  `task_ID` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `worker_ID` bigint(20) NOT NULL,
  `lawer_ID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `workers`
--

CREATE TABLE `workers` (
  `worker_ID` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `surname` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `birth_date` date NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `username` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `salary` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `workers`
--

INSERT INTO `workers` (`worker_ID`, `name`, `surname`, `birth_date`, `phone`, `email`, `username`, `password`, `salary`) VALUES
(1, 'Nicolás', 'Figueras Parras', '1999-03-22', 639941992, 'nicolas@worker.com', 'nicoWorker', 'nicoWorker', 800);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`case_ID`),
  ADD UNIQUE KEY `case_ID` (`case_ID`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_ID`),
  ADD UNIQUE KEY `client_ID` (`client_ID`);

--
-- Indices de la tabla `lawers`
--
ALTER TABLE `lawers`
  ADD PRIMARY KEY (`lawer_ID`),
  ADD UNIQUE KEY `lawer_ID` (`lawer_ID`);

--
-- Indices de la tabla `payment`
--
ALTER TABLE `payment`
  ADD UNIQUE KEY `payment_ID` (`payment_ID`);

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_ID`),
  ADD UNIQUE KEY `task_ID` (`task_ID`);

--
-- Indices de la tabla `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`worker_ID`),
  ADD UNIQUE KEY `worker_ID` (`worker_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cases`
--
ALTER TABLE `cases`
  MODIFY `case_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `client_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `lawers`
--
ALTER TABLE `lawers`
  MODIFY `lawer_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `workers`
--
ALTER TABLE `workers`
  MODIFY `worker_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
