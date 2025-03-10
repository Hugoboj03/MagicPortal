-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-03-2025 a las 21:00:49
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

CREATE DATABASE IF NOT EXISTS `magic_portal`;
USE `magic_portal`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `magic_portal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartas`
--

CREATE TABLE `cartas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `mana_rojo` int(11) NOT NULL DEFAULT 0,
  `mana_azul` int(11) NOT NULL DEFAULT 0,
  `mana_verde` int(11) NOT NULL DEFAULT 0,
  `mana_negro` int(11) NOT NULL DEFAULT 0,
  `mana_blanco` int(11) NOT NULL DEFAULT 0,
  `mana_incoloro` int(11) NOT NULL DEFAULT 0,
  `tipo_carta` int(11) NOT NULL,
  `tipo_criatura` int(11) NOT NULL DEFAULT 0,
  `ataque` int(11) DEFAULT NULL,
  `defensa` int(11) DEFAULT NULL,
  `habilidad` int(11) NOT NULL DEFAULT 0,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habilidades`
--

CREATE TABLE `habilidades` (
  `id` int(11) NOT NULL,
  `habilidad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habilidades`
--

INSERT INTO `habilidades` (`id`, `habilidad`) VALUES
(1, 'Alcance'),
(2, 'Arrollar'),
(3, 'Dañar dos Veces'),
(4, 'Dañar Primero'),
(5, 'Prisa'),
(6, 'Toque Mortal'),
(7, 'Vinculo Vital'),
(8, 'Volar'),
(9, 'Amenaza'),
(10, 'Antimalefício'),
(11, 'Defensor'),
(12, 'Destello');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_carta`
--

CREATE TABLE `tipo_carta` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_carta`
--

INSERT INTO `tipo_carta` (`id`, `tipo`) VALUES
(1, 'Criatura'),
(2, 'Conjuro'),
(3, 'Instantáneo'),
(4, 'Encantamiento'),
(5, 'Artefacto'),
(6, 'Tierra'),
(7, 'PlanesWalker');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_criatura`
--

CREATE TABLE `tipo_criatura` (
  `id` int(11) NOT NULL,
  `tipo_criatura` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_criatura`
--

INSERT INTO `tipo_criatura` (`id`, `tipo_criatura`) VALUES
(1, 'Abanderado'),
(2, 'Acorazado'),
(3, 'Adalid'),
(4, 'Alce'),
(5, 'Aliado'),
(6, 'Anciano'),
(7, 'Ángel'),
(8, 'Antílope'),
(9, 'Aparejador'),
(10, 'Aparición'),
(11, 'Araña'),
(12, 'Arconte'),
(13, 'Ardilla'),
(14, 'Arena'),
(15, 'Arpía'),
(16, 'Arquero'),
(17, 'Artífice'),
(18, 'Asesino'),
(19, 'Astilla'),
(20, 'Atog'),
(21, 'Avatar'),
(22, 'Ave'),
(23, 'Azra'),
(24, 'Babosa'),
(25, 'Ballena'),
(26, 'Bárbaro'),
(27, 'Basilisco'),
(28, 'Beeble'),
(29, 'Berserker'),
(30, 'Bestia'),
(31, 'Bribón'),
(32, 'Buey'),
(33, 'Caballero'),
(34, 'Caballo'),
(35, 'Cabra'),
(36, 'Cadáver'),
(37, 'Calamar'),
(38, 'Camárido'),
(39, 'Cambiahechizos'),
(40, 'Camello'),
(41, 'Cangrejo'),
(42, 'Caribú'),
(43, 'Cazador-nocturno'),
(44, 'Cefálido'),
(45, 'Centauro'),
(46, 'Chacal'),
(47, 'Chamán'),
(48, 'Cíclope'),
(49, 'Cieno'),
(50, 'Ciudadano'),
(51, 'Clérigo'),
(52, 'Cobarde'),
(53, 'Cocatriz'),
(54, 'Cocodrilo'),
(55, 'Conejo'),
(56, 'Consejero'),
(57, 'Constructo'),
(58, 'Dauti'),
(59, 'Deidad'),
(60, 'Demonio'),
(61, 'Desertor'),
(62, 'Destructor'),
(63, 'Diablillo'),
(64, 'Diablo'),
(65, 'Dinosaurio'),
(66, 'Djinn'),
(67, 'Draco'),
(68, 'Dragón'),
(69, 'Dríada'),
(70, 'Druida'),
(71, 'Efrit'),
(72, 'Ejército'),
(73, 'Eldrazi'),
(74, 'Elefante'),
(75, 'Elemental'),
(76, 'Elfo'),
(77, 'Enano'),
(78, 'Encarnación'),
(79, 'Engendro'),
(80, 'Escorpión'),
(81, 'Escultura'),
(82, 'Esfinge'),
(83, 'Espantapájaros'),
(84, 'Espectro'),
(85, 'Espíritu'),
(86, 'Esponja'),
(87, 'Esqueleto'),
(88, 'Estrella-de-mar'),
(89, 'Etergénito'),
(90, 'Explorador'),
(91, 'Extraño'),
(92, 'Felino'),
(93, 'Fénix'),
(94, 'Fragmentado'),
(95, 'Gárgola'),
(96, 'Germen'),
(97, 'Gigante'),
(98, 'Glotón'),
(99, 'Gnomo'),
(100, 'Gólem'),
(101, 'Gorgona'),
(102, 'Gremlin'),
(103, 'Grifo'),
(104, 'Guerrero'),
(105, 'Gusano'),
(106, 'Hada'),
(107, 'Hechicero'),
(108, 'Hidra'),
(109, 'Hiena'),
(110, 'Hipogrifo'),
(111, 'Hipopótamo'),
(112, 'Homárido'),
(113, 'Homúnculo'),
(114, 'Hongo'),
(115, 'Horror'),
(116, 'Huevo'),
(117, 'Humano'),
(118, 'Hurón'),
(119, 'Ilusión'),
(120, 'Infernal'),
(121, 'Insecto'),
(122, 'Jabalí'),
(123, 'Kavu'),
(124, 'Kirin'),
(125, 'Kithkin'),
(126, 'Kóbold'),
(127, 'Kor'),
(128, 'Kraken'),
(129, 'Lagarto'),
(130, 'Lamia'),
(131, 'Lammasu'),
(132, 'Leviatán'),
(133, 'Lhurgoyf'),
(134, 'Licántropo'),
(135, 'Lícido'),
(136, 'Lobo'),
(137, 'Magistrado'),
(138, 'Mangosta'),
(139, 'Mantícora'),
(140, 'Marta'),
(141, 'Masticore'),
(142, 'Medusa'),
(143, 'Mercenario'),
(144, 'Metabolizador'),
(145, 'Metamorfo'),
(146, 'Metathrán'),
(147, 'Minotauro'),
(148, 'Místico'),
(149, 'Monje'),
(150, 'Murciélago'),
(151, 'Muro'),
(152, 'Mutante'),
(153, 'Myr'),
(154, 'Naga'),
(155, 'Nautilo'),
(156, 'Nefilim'),
(157, 'Ninfa'),
(158, 'Ninja'),
(159, 'Noggle'),
(160, 'Nómada'),
(161, 'Ogro'),
(162, 'Ojo'),
(163, 'Operario'),
(164, 'Orbe'),
(165, 'Orco'),
(166, 'Orgg'),
(167, 'Oso'),
(168, 'Ostra'),
(169, 'Oufé'),
(170, 'Oveja'),
(171, 'Pangolín'),
(172, 'Pegaso'),
(173, 'Pentavita'),
(174, 'Perforador'),
(175, 'Perro'),
(176, 'Pesadilla'),
(177, 'Pez'),
(178, 'Phelddagrif'),
(179, 'Piloto'),
(180, 'Pirata'),
(181, 'Plaga'),
(182, 'Planta'),
(183, 'Polilla-titilante'),
(184, 'Portador'),
(185, 'Primate'),
(186, 'Prisma'),
(187, 'Pueblo-arbóreo'),
(188, 'Pueblo-lunar'),
(189, 'Pulpo'),
(190, 'Quimera'),
(191, 'Rana'),
(192, 'Rata'),
(193, 'Rebelde'),
(194, 'Reflejo'),
(195, 'Rinoceronte'),
(196, 'Saga'),
(197, 'Salamandra'),
(198, 'Samurái'),
(199, 'Sanguijuela'),
(200, 'Saprolín'),
(201, 'Sátiro'),
(202, 'Serpiente'),
(203, 'Servo'),
(204, 'Sicario'),
(205, 'Sierpe'),
(206, 'Siervo'),
(207, 'Simio'),
(208, 'Sirena'),
(209, 'Slit'),
(210, 'Superviviente'),
(211, 'Soldado'),
(212, 'Soltari'),
(213, 'Sombra'),
(214, 'Surrakar'),
(215, 'Talako'),
(216, 'Tejón'),
(217, 'Tenaza'),
(218, 'Tetravita'),
(219, 'Thrull'),
(220, 'Topo'),
(221, 'Tóptero'),
(222, 'Tortuga'),
(223, 'Traficante'),
(224, 'Trasgo'),
(225, 'Trisquelavita'),
(226, 'Tritón'),
(227, 'Trilobites'),
(228, 'Trol'),
(229, 'Unicornio'),
(230, 'Uro'),
(231, 'Vampiro'),
(232, 'Vástago'),
(233, 'Vedalken'),
(234, 'Viashino'),
(235, 'Víbora'),
(236, 'Vólver'),
(237, 'Wombat'),
(238, 'Yerbamala'),
(239, 'Yeti'),
(240, 'Zángano'),
(241, 'Zombie'),
(242, 'Zorro'),
(243, 'Zubera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cartas`
--
ALTER TABLE `cartas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_carta` (`tipo_carta`),
  ADD KEY `tipo_criatura` (`tipo_criatura`),
  ADD KEY `habilidad` (`habilidad`);

--
-- Indices de la tabla `habilidades`
--
ALTER TABLE `habilidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_carta`
--
ALTER TABLE `tipo_carta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_criatura`
--
ALTER TABLE `tipo_criatura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cartas`
--
ALTER TABLE `cartas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `habilidades`
--
ALTER TABLE `habilidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tipo_carta`
--
ALTER TABLE `tipo_carta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_criatura`
--
ALTER TABLE `tipo_criatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cartas`
--
ALTER TABLE `cartas`
  ADD CONSTRAINT `cartas_ibfk_1` FOREIGN KEY (`tipo_carta`) REFERENCES `tipo_carta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cartas_ibfk_2` FOREIGN KEY (`tipo_criatura`) REFERENCES `tipo_criatura` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cartas_ibfk_3` FOREIGN KEY (`habilidad`) REFERENCES `habilidades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
