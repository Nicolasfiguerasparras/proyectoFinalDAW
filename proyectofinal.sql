-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2019 a las 02:50:04
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

--
-- Volcado de datos para la tabla `cases`
--

INSERT INTO `cases` (`case_ID`, `title`, `description`, `lawer_ID`, `client_ID`, `type`) VALUES
(1, 'Infracción por conducción temeraria', 'El cliente pide asesoría legal para mantener su ciudadanía tras haber cometido una infracción de tráfico', 1, 2, 'Tráfico'),
(2, 'Permiso laboral', 'El cliente desea obtener el permiso laboral en el país', 2, 1, 'Permiso laboral'),
(3, 'Obtención de la nacionalidad', 'El cliente desea obtener la nacionalidad por medio de un familiar que reside en el país', 1, 4, 'Nacionalidad');

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
(1, 'Nicolás', 'Figueras Parras', '1999-03-22', 639941992, 'nicolasfiguerasparras@gmail.com', 'nicoClient', 'nicoClient', 850),
(2, 'Fernando', 'Juanez ', '1998-12-03', 626451200, 'fernando@gmail.com', 'fernando', 'fernando', 0),
(3, 'Jose Luis', 'Jimenez Marquez', '1980-05-06', 621545898, 'joseluis@gmail.com', 'joseluis', 'joseluis', 0),
(4, 'Luis', 'Vigo Pérez', '1996-07-02', 722154535, 'luisrubio@gmail.com', 'luis', 'rubio', 0),
(5, 'Patricia Elvira', 'Jimenez Martín', '2000-05-24', 645512466, 'mesosaurus_zen@gmail.com', 'patricia', 'mesosaurus', 0);

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
(1, 'Sonia', 'Parras', '1976-03-25', 639941992, 'soniaparras@law.com', 'soniaparras', 'lawoffice', 3500),
(2, 'Noemí', 'Casas', '1978-03-21', 649310891, 'noemi@law.com', 'noemi', 'parrasCasas', 1500),
(3, 'Mark', 'Konrad', '1984-08-15', 712245165, 'mark@law.com', 'mark', 'Konrad', 3400);

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
(3, 350.00, 2, 1, '2019-05-19', 0),
(4, 380.00, 2, 1, '2019-05-20', 0),
(5, 350.00, 2, 1, '2019-05-20', 0),
(6, 350.00, 2, 1, '2019-05-20', 3),
(7, 380.00, 2, 1, '2019-05-20', 3),
(8, 1.00, 2, 1, '2019-05-20', 3),
(9, 1.00, 2, 1, '2019-05-20', 0),
(10, 350.00, 2, 0, '2019-05-22', 0),
(11, 500.00, 2, 0, '2019-05-22', 1);

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
  `lawer_ID` bigint(20) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`task_ID`, `title`, `description`, `start_date`, `end_date`, `worker_ID`, `lawer_ID`, `status`) VALUES
(1, 'Llamada', 'Llamar a todos los clientes que tuvieron cita ayer', '2019-06-02', '2019-06-11', 1, 1, 0),
(2, 'Recopilar datos', 'Pedir datos a los clientes para resgistrar en la aplicación', '2019-01-01', '2019-06-10', 1, 3, 0),
(3, 'Recordatorio de cita', 'Llamar a Olivia Piñero Viñolo para recordarle su juicio del viernes 14/06', '2019-06-10', '2019-06-11', 2, 2, 0),
(4, 'Organizar facturas', 'Ordenar todas las facturas para pasarlas a la aplicación', '2019-06-01', '2019-06-20', 3, 2, 0);

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
(1, 'Raúl', 'Méndez Núñez', '1990-03-22', 639941992, 'raul@worker.com', 'raulmendez', 'mendeznuñez', 800),
(2, 'Tania', 'Rodríguez Gutiérrez', '1980-03-06', 61542451, 'tania@worker.com', 'tania', 'rodriguez', 1200),
(3, 'Olivia', 'Piñero Viñolo', '1977-11-14', 615124351, 'olivia@worker.com', 'olivia', 'piñero', 2500),
(4, 'Alicia', 'Martín Vicente', '1988-09-14', 655255135, 'alicia@worker.com', 'alicia', 'martin', 1000);

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
  MODIFY `case_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `client_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `lawers`
--
ALTER TABLE `lawers`
  MODIFY `lawer_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `workers`
--
ALTER TABLE `workers`
  MODIFY `worker_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
