-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-12-2021 a las 07:56:21
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tabajaali`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_Cliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `servicio_id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` double(8,2) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `nombre_Cliente`, `servicio_id`, `fecha`, `direccion`, `descripcion`, `precio`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'carlos', 1, '2021-12-24', 'car12 #12-53', 'carlos se le corto el pelo y quedo calvo de un lado por eso se le hizo un descuento de 5.000', 5000.00, 0, NULL, '2021-12-10 03:40:53'),
(2, 'carlos angaritas', 1, '2021-12-29', NULL, NULL, 12001.00, 1, NULL, NULL),
(3, 'casas', 2, '2022-01-01', NULL, NULL, 1222.00, 0, NULL, NULL),
(4, 'carlos pedro', 1, '2021-12-24', 'car12 #12-53', 'carlos se le corto el pelo y quedo calvo de un lado por eso se le hizo un descuento de 5.000', 5000.00, 1, NULL, NULL),
(5, 'carlos pedro', 1, '2021-12-24', 'car12 #12-53', 'carlos se le corto el pelo y quedo calvo de un lado por eso se le hizo un descuento de 5.000', 5000.00, 1, NULL, NULL),
(6, 'pedro paulo', 4, '2021-12-31', 'car12', 'se le dejo calvo como bebe', 12000.00, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2013_25_11_000000_create_roll_user_table', 1),
(10, '2011_11_26_020845_creat_servis_table', 2),
(11, '2014_10_12_000000_create_users_table', 2),
(12, '2014_10_12_100000_create_password_resets_table', 2),
(13, '2019_08_19_000000_create_failed_jobs_table', 2),
(14, '2021_11_26_015840_creat_cita_servis_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('alirayopuches@gmail.com', '$2y$10$xxQ0Qikxl2E14CV4pj.b/u3Qw3imfNw2aPmrT4spushw3xoq.bFca', '2021-12-05 09:03:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_Servicio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` double(8,2) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre_Servicio`, `descripcion`, `precio`, `estado`) VALUES
(1, 'corte', 'corte de pelo con la maquina y los numero 1,2,3,4', 10000.00, 1),
(2, 'depilada', '123456', 123456.00, 1),
(3, 'corte2', NULL, 122222.00, 0),
(4, 'rapada', 'se le dejara calvo', 12000.00, 1),
(5, 'pintura', 'pintura', 12000.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `User_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `User_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'juan', 'alirayopuches@gmail.com', NULL, '$2y$10$WMmyJ5biMcpg6Xm4V4iESekakryovU8qyhPqdI5vd0XLl57wZO3GW', NULL, '2021-12-05 08:33:07', '2021-12-05 08:33:07'),
(2, 'juan', 'aarayo2@misena.edu.co', NULL, '$2y$10$QwrDJsvnMe0onWc6aKbkDeQifRyfuohbZbLNjGB3HczgFn0J/e1wy', 'snZjBRyZEqXOEZCCDZh4cib0kABj3IjKbynSEHm7skuooxR2MDoAOoqAYP6s', '2021-12-05 09:04:24', '2021-12-05 09:11:47');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `citas_servicio_id_foreign` (`servicio_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_servicio_id_foreign` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
