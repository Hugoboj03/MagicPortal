-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-03-2025 a las 22:48:01
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
  `mana_neutro` int(11) NOT NULL DEFAULT 0,
  `tipo_carta` int(11) NOT NULL,
  `tipo_criatura` int(11) DEFAULT NULL,
  `ataque` int(11) DEFAULT NULL,
  `defensa` int(11) DEFAULT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cartas`
--

INSERT INTO `cartas` (`id`, `nombre`, `mana_rojo`, `mana_azul`, `mana_verde`, `mana_negro`, `mana_blanco`, `mana_neutro`, `tipo_carta`, `tipo_criatura`, `ataque`, `defensa`, `img`) VALUES
(4, 'Reminiscencia ancestral', 0, 1, 0, 0, 0, 3, 2, NULL, NULL, NULL, 'lci-45-ancestral-reminiscence.jpg'),
(5, 'Reto arcano', 0, 2, 0, 0, 0, 5, 2, NULL, NULL, NULL, 'afc-14-arcane-endeavor.jpg'),
(6, 'Atraco arcano', 0, 2, 0, 0, 0, 2, 2, NULL, NULL, NULL, 'otc-13-arcane-heist.jpg'),
(7, 'Pericia de Baral', 0, 2, 0, 0, 0, 3, 2, NULL, NULL, NULL, 'otc-91-baral-s-expertise.jpg'),
(8, 'Vínculo de Perspicacia', 0, 1, 0, 0, 0, 3, 2, NULL, NULL, NULL, 'war-43-bond-of-insight.jpg'),
(9, 'Hechicera de mente extraña', 0, 1, 0, 0, 0, 4, 1, 47, 3, 4, 'afr-44-aberrant-mind-sorcerer.jpg'),
(10, 'Ojo aberrante', 0, 1, 0, 0, 0, 2, 1, 162, 5, 5, 'dsk-42-abhorrent-oculus.jpg'),
(11, 'Draco de la Academia', 0, 1, 0, 0, 0, 2, 1, 67, 2, 2, 'dom-40-academy-drake.jpg'),
(12, 'Aeromiba', 0, 1, 0, 0, 0, 3, 1, 75, 2, 4, 'mh2-37-aeromoeba.jpg'),
(13, 'Eterplasma', 0, 2, 0, 0, 0, 2, 1, 119, 1, 1, 'rvr-34-aetherplasm.jpg'),
(14, 'Ráfaga de éter', 0, 1, 0, 0, 0, 1, 3, NULL, NULL, NULL, 'm20-42-aether-gust.jpg'),
(15, 'Descarga de éter', 0, 1, 0, 0, 0, 1, 3, NULL, NULL, NULL, 'mh3-50-aether-spike.jpg'),
(16, 'Confundir', 0, 1, 0, 0, 0, 2, 3, NULL, NULL, NULL, 'm20-47-befuddle.jpg'),
(17, 'Perspicacia de la quimista', 0, 1, 0, 0, 0, 3, 3, NULL, NULL, NULL, 'c20-108-chemister-s-insight.jpg'),
(18, 'Código de represión', 0, 1, 0, 0, 0, 2, 3, NULL, NULL, NULL, 'rna-35-code-of-constraint.jpg'),
(19, 'Aguacero anfibio', 0, 1, 0, 0, 0, 2, 4, NULL, NULL, NULL, 'mh3-51-amphibian-downpour.jpg'),
(20, 'Forma acuosa', 0, 1, 0, 0, 0, 0, 4, NULL, NULL, NULL, 'cmr-56-aqueous-form.jpg'),
(21, 'Amnesia de Ashiok', 0, 2, 0, 0, 0, 2, 4, NULL, NULL, NULL, 'thb-43-ashiok-s-erasure.jpg'),
(22, 'Piratería costera', 0, 2, 0, 0, 0, 2, 4, NULL, NULL, NULL, 'acr-84-coastal-piracy.jpg'),
(23, 'Encantamiento copia', 0, 1, 0, 0, 0, 2, 4, NULL, NULL, NULL, 'rvr-39-copy-enchantment.jpg'),
(24, 'Guantelete de Asesino', 0, 1, 0, 0, 0, 2, 5, NULL, NULL, NULL, 'acr-12-assassin-gauntlet.jpg'),
(25, 'Candelero', 0, 1, 0, 0, 0, 0, 5, NULL, NULL, NULL, 'mkm-43-candlestick.jpg'),
(26, 'Calavera de cristal, catalejo Isu', 0, 2, 0, 0, 0, 2, 5, NULL, NULL, NULL, 'acr-15-crystal-skull-isu-spyglass.jpg'),
(27, 'Puerta rompecabezas de Orazca', 0, 1, 0, 0, 0, 0, 5, NULL, NULL, NULL, 'lci-68-orazca-puzzle-door.jpg'),
(28, 'Vara de la absorción', 0, 1, 0, 0, 0, 2, 5, NULL, NULL, NULL, 'afc-19-rod-of-absorption.jpg'),
(29, 'Jace, náufrago astuto', 0, 2, 0, 0, 0, 1, 7, NULL, NULL, NULL, 'xln-60-jace-cunning-castaway.jpg'),
(30, 'Jace, resucitado', 0, 2, 0, 0, 0, 0, 7, NULL, NULL, NULL, 'otj-271-jace-reawakened.jpg'),
(31, 'Jace, mago reflejado', 0, 2, 0, 0, 0, 1, 7, NULL, NULL, NULL, 'afc-14-arcane-endeavor.jpg'),
(32, 'Mu Yanling, Viento Celestial', 0, 2, 0, 0, 0, 4, 7, NULL, NULL, NULL, 'm20-286-mu-yanling-celestial-wind.jpg'),
(33, 'Teferi, Maestro del Tiempo', 0, 2, 0, 0, 0, 2, 7, NULL, NULL, NULL, 'm21-75-teferi-master-of-time.jpg'),
(34, 'Akroma, ángel de furia', 3, 0, 0, 0, 0, 5, 1, 7, 6, 6, 'tsr-150-akroma-angel-of-fury.jpg'),
(35, 'Infernal tectónico', 2, 0, 0, 0, 0, 5, 1, 120, 8, 5, 'c19-29-tectonic-hellion.jpg'),
(36, 'Venganza acechante', 2, 0, 0, 0, 0, 5, 1, 21, 5, 5, 'rvr-126-stalking-vengeance.jpg'),
(37, 'Devastasantuarios', 2, 0, 0, 0, 0, 4, 1, 30, 6, 4, 'iko-135-sanctuary-smasher.jpg'),
(38, 'Celebrantes salvajes', 2, 0, 0, 0, 0, 3, 1, 201, 5, 3, 'cmr-212-wild-celebrants.jpg'),
(39, 'Saludo del alquimista', 1, 0, 0, 0, 0, 4, 2, NULL, NULL, NULL, 'c19-133-alchemist-s-greeting.jpg'),
(40, 'Estragos de Anzrag', 2, 0, 0, 0, 0, 3, 2, NULL, NULL, NULL, 'mkm-111-anzrag-s-rampage.jpg'),
(41, 'Cúspide del poder', 3, 0, 0, 0, 0, 7, 2, NULL, NULL, NULL, 'afc-114-apex-of-power.jpg'),
(42, 'Cuchilla arqueada', 2, 0, 0, 0, 0, 3, 2, NULL, NULL, NULL, 'tsr-152-arc-blade.jpg'),
(43, 'Vínculo de pasión', 2, 0, 0, 0, 0, 4, 2, NULL, NULL, NULL, 'war-116-bond-of-passion.jpg'),
(44, 'Agravio antiguo', 1, 0, 0, 0, 0, 1, 3, NULL, NULL, NULL, 'tsr-151-ancient-grudge.jpg'),
(45, 'Frenesí de berserker', 1, 0, 0, 0, 0, 2, 3, NULL, NULL, NULL, 'afc-29-berserker-s-frenzy.jpg'),
(46, 'Trato del traidor', 1, 0, 0, 0, 0, 1, 3, NULL, NULL, NULL, 'dsk-126-betrayer-s-bargain.jpg'),
(47, 'Hacerse de oro', 1, 0, 0, 0, 0, 3, 3, NULL, NULL, NULL, 'blc-193-big-score.jpg'),
(48, 'Picado de la Rapaz del Trueno', 1, 0, 0, 0, 0, 1, 3, NULL, NULL, NULL, 'iko-109-blitz-of-the-thunder-raptor.jpg'),
(49, 'Revuelta del éter', 2, 0, 0, 0, 0, 2, 4, NULL, NULL, NULL, 'mh3-113-aether-revolt.jpg'),
(50, 'Luna alpina', 1, 0, 0, 0, 0, 0, 4, NULL, NULL, NULL, 'm19-128-alpine-moon.jpg'),
(51, 'Bombardeo arcano', 2, 0, 0, 0, 0, 4, 4, NULL, NULL, NULL, 'otc-154-arcane-bombardment.jpg'),
(52, 'Aria de la llama', 1, 0, 0, 0, 0, 2, 4, NULL, NULL, NULL, 'mh1-118-aria-of-flame.jpg'),
(53, 'Embestida de berserkers', 2, 0, 0, 0, 0, 3, 4, NULL, NULL, NULL, 'blc-192-berserkers-onslaught.jpg'),
(54, 'Acerosolar ardiente', 1, 0, 0, 0, 0, 1, 5, NULL, NULL, NULL, 'cmr-364-blazing-sunsteel.jpg'),
(55, 'Motosierra', 1, 0, 0, 0, 0, 1, 5, NULL, NULL, NULL, 'dsk-128-chainsaw.jpg'),
(56, 'Regulador de Chandra', 1, 0, 0, 0, 0, 1, 5, NULL, NULL, NULL, 'm20-131-chandra-s-regulator.jpg'),
(57, 'Espejo maldito', 1, 0, 0, 0, 0, 2, 5, NULL, NULL, NULL, 'mh3-279-cursed-mirror.jpg'),
(58, 'Percusionista mecánico', 1, 0, 0, 0, 0, 0, 5, NULL, NULL, NULL, 'dsk-130-clockwork-percussionist.jpg'),
(59, 'Jaya, piromante venerada', 1, 0, 0, 0, 0, 4, 7, NULL, NULL, NULL, 'war-135-jaya-venerated-firemage.jpg'),
(60, 'Lukka, paria de las Capas de Cobre', 2, 0, 0, 0, 0, 3, 7, NULL, NULL, NULL, 'iko-125-lukka-coppercoat-outcast.jpg'),
(61, 'Jeska, renacida tres veces', 1, 0, 0, 0, 0, 2, 7, NULL, NULL, NULL, 'cmr-186-jeska-thrice-reborn.jpg'),
(62, 'Zariel, archiduquesa de Averno', 2, 0, 0, 0, 0, 2, 7, NULL, NULL, NULL, 'afr-172-zariel-archduke-of-avernus.jpg'),
(63, 'Chandra, acólita de la llama', 2, 0, 0, 0, 0, 1, 7, NULL, NULL, NULL, 'm20-126-chandra-acolyte-of-flame.jpg'),
(64, 'Aeve, cieno progenitor', 0, 0, 3, 0, 0, 2, 1, 49, 2, 2, 'mh2-148-aeve-progenitor-ooze.jpg'),
(65, 'Analista de consecuencias', 0, 0, 1, 0, 0, 1, 1, 76, 1, 3, 'mkm-148-aftermath-analyst.jpg'),
(66, 'Sobreviviente ainok', 0, 0, 1, 0, 0, 1, 1, 47, 2, 1, 'c19-156-ainok-survivalist.jpg'),
(67, 'Víbora emboscadora', 0, 0, 1, 0, 0, 1, 1, 235, 2, 1, 'cmr-213-ambush-viper.jpg'),
(68, 'Yerbamala poderosa', 0, 0, 1, 0, 0, 0, 1, 238, 1, 1, 'iko-143-almighty-brushwagg.jpg'),
(69, 'Analizar el polen', 0, 0, 1, 0, 0, 0, 2, NULL, NULL, NULL, 'mkm-150-analyze-the-pollen.jpg'),
(70, 'Audiencia con Trostani', 0, 0, 1, 0, 0, 2, 2, NULL, NULL, NULL, 'mkm-152-audience-with-trostani.jpg'),
(71, 'Mordisco justiciero', 0, 0, 1, 0, 0, 3, 2, NULL, NULL, NULL, 'mkm-154-bite-down-on-crime.jpg'),
(72, 'Carga de la Bestia Infinita', 0, 0, 1, 0, 0, 2, 2, NULL, NULL, NULL, 'iko-147-charge-of-the-forever-beast.jpg'),
(73, 'Maravillas antiguas', 0, 0, 2, 0, 0, 0, 2, NULL, NULL, NULL, 'lcc-89-bygone-marvels.jpg'),
(74, 'Decreto de salvajismo', 0, 0, 2, 0, 0, 7, 3, NULL, NULL, NULL, 'afc-156-decree-of-savagery.jpg'),
(75, 'Invocaciones de la estirpe', 0, 0, 2, 0, 0, 5, 3, NULL, NULL, NULL, 'afc-163-kindred-summons.jpg'),
(76, 'Recompensa de poder', 0, 0, 2, 0, 0, 4, 3, NULL, NULL, NULL, 'grn-124-bounty-of-might.jpg'),
(77, 'Regreso del Portavoz Salvaje', 0, 0, 1, 0, 0, 4, 3, NULL, NULL, NULL, 'otc-203-return-of-the-wildspeaker.jpg'),
(78, 'Rebaño curioso', 0, 0, 1, 0, 0, 3, 3, NULL, NULL, NULL, 'c20-59-curious-herd.jpg'),
(79, 'Un asesino entre nosotros', 0, 0, 1, 0, 0, 4, 4, NULL, NULL, NULL, 'mkm-167-a-killer-among-us.jpg'),
(80, 'Coartada perfecta', 0, 0, 1, 0, 0, 2, 4, NULL, NULL, NULL, 'mkm-149-airtight-alibi.jpg'),
(81, 'Ascenso del domador', 0, 0, 1, 0, 0, 2, 4, NULL, NULL, NULL, 'blc-118-beastmaster-ascension.jpg'),
(82, 'Ritual de nacimiento', 0, 0, 1, 0, 0, 1, 4, NULL, NULL, NULL, 'mh3-146-birthing-ritual.jpg'),
(83, 'Influencia de Ayula', 0, 0, 3, 0, 0, 0, 4, NULL, NULL, NULL, 'mh1-156-ayula-s-influence.jpg'),
(84, 'Cornucopia antigua', 0, 0, 1, 0, 0, 2, 5, NULL, NULL, NULL, 'big-16-ancient-cornucopia.jpg'),
(85, 'Bolsa de trucos', 0, 0, 1, 0, 0, 1, 5, NULL, NULL, NULL, 'afc-37-bag-of-tricks.jpg'),
(86, 'Llamacomida', 0, 0, 1, 0, 0, 2, 5, NULL, NULL, NULL, 'blc-211-chitterspitter.jpg'),
(87, 'Alijo de explorador', 0, 0, 1, 0, 0, 1, 5, NULL, NULL, NULL, 'lci-184-explorer-s-cache.jpg'),
(88, 'Guadaña malamet', 0, 0, 1, 0, 0, 2, 5, NULL, NULL, NULL, 'lci-200-malamet-scythe.jpg'),
(89, 'Ellywick Rasguereta', 0, 0, 2, 0, 0, 2, 7, NULL, NULL, NULL, 'afr-181-ellywick-tumblestrum.jpg'),
(90, 'Garruk, desatado', 0, 0, 2, 0, 0, 2, 7, NULL, NULL, NULL, 'm21-183-garruk-unleashed.jpg'),
(91, 'Vivien, Exploradora del Animarco', 0, 0, 3, 0, 0, 1, 7, NULL, NULL, NULL, 'm20-199-vivien-arkbow-ranger.jpg'),
(92, 'Vivien, defensora de los monstruos', 0, 0, 2, 0, 0, 3, 7, NULL, NULL, NULL, 'iko-175-vivien-monsters-advocate.jpg'),
(93, 'Nissa, la que Sacude el Mundo', 0, 0, 3, 0, 0, 2, 7, NULL, NULL, NULL, 'iwar-169-nissa-who-shakes-the-world.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartas_habilidades`
--

CREATE TABLE `cartas_habilidades` (
  `id_carta` int(11) NOT NULL,
  `id_habilidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cartas_habilidades`
--

INSERT INTO `cartas_habilidades` (`id_carta`, `id_habilidad`) VALUES
(10, 8),
(11, 8),
(12, 8),
(19, 12),
(34, 2),
(34, 8),
(35, 5),
(36, 5),
(37, 4),
(67, 6),
(67, 12),
(68, 2),
(80, 12);

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
  ADD KEY `tipo_criatura` (`tipo_criatura`);

--
-- Indices de la tabla `cartas_habilidades`
--
ALTER TABLE `cartas_habilidades`
  ADD PRIMARY KEY (`id_carta`,`id_habilidad`),
  ADD KEY `id_habilidad` (`id_habilidad`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

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
  ADD CONSTRAINT `cartas_ibfk_2` FOREIGN KEY (`tipo_criatura`) REFERENCES `tipo_criatura` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cartas_habilidades`
--
ALTER TABLE `cartas_habilidades`
  ADD CONSTRAINT `cartas_habilidades_ibfk_1` FOREIGN KEY (`id_carta`) REFERENCES `cartas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cartas_habilidades_ibfk_2` FOREIGN KEY (`id_habilidad`) REFERENCES `habilidades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
