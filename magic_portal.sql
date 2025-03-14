-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-03-2025 a las 21:11:15
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

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
  `ataque` int(11) DEFAULT NULL,
  `defensa` int(11) DEFAULT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cartas`
--

INSERT INTO `cartas` (`id`, `nombre`, `mana_rojo`, `mana_azul`, `mana_verde`, `mana_negro`, `mana_blanco`, `mana_neutro`, `tipo_carta`, `ataque`, `defensa`, `img`) VALUES
(4, 'Reminiscencia ancestral', 0, 1, 0, 0, 0, 3, 2, NULL, NULL, 'lci-45-ancestral-reminiscence.jpg'),
(5, 'Reto arcano', 0, 2, 0, 0, 0, 5, 2, NULL, NULL, 'afc-14-arcane-endeavor.jpg'),
(6, 'Atraco arcano', 0, 2, 0, 0, 0, 2, 2, NULL, NULL, 'otc-13-arcane-heist.jpg'),
(7, 'Pericia de Baral', 0, 2, 0, 0, 0, 3, 2, NULL, NULL, 'otc-91-baral-s-expertise.jpg'),
(8, 'Vínculo de Perspicacia', 0, 1, 0, 0, 0, 3, 2, NULL, NULL, 'war-43-bond-of-insight.jpg'),
(9, 'Hechicera de mente extraña', 0, 1, 0, 0, 0, 4, 1, 3, 4, 'afr-44-aberrant-mind-sorcerer.jpg'),
(10, 'Ojo aberrante', 0, 1, 0, 0, 0, 2, 1, 5, 5, 'dsk-42-abhorrent-oculus.jpg'),
(11, 'Draco de la Academia', 0, 1, 0, 0, 0, 2, 1, 2, 2, 'dom-40-academy-drake.jpg'),
(12, 'Aeromiba', 0, 1, 0, 0, 0, 3, 1, 2, 4, 'mh2-37-aeromoeba.jpg'),
(13, 'Eterplasma', 0, 2, 0, 0, 0, 2, 1, 1, 1, 'rvr-34-aetherplasm.jpg'),
(14, 'Ráfaga de éter', 0, 1, 0, 0, 0, 1, 3, NULL, NULL, 'm20-42-aether-gust.jpg'),
(15, 'Descarga de éter', 0, 1, 0, 0, 0, 1, 3, NULL, NULL, 'mh3-50-aether-spike.jpg'),
(16, 'Confundir', 0, 1, 0, 0, 0, 2, 3, NULL, NULL, 'm20-47-befuddle.jpg'),
(17, 'Perspicacia de la quimista', 0, 1, 0, 0, 0, 3, 3, NULL, NULL, 'c20-108-chemister-s-insight.jpg'),
(18, 'Código de represión', 0, 1, 0, 0, 0, 2, 3, NULL, NULL, 'rna-35-code-of-constraint.jpg'),
(19, 'Aguacero anfibio', 0, 1, 0, 0, 0, 2, 4, NULL, NULL, 'mh3-51-amphibian-downpour.jpg'),
(20, 'Forma acuosa', 0, 1, 0, 0, 0, 0, 4, NULL, NULL, 'cmr-56-aqueous-form.jpg'),
(21, 'Amnesia de Ashiok', 0, 2, 0, 0, 0, 2, 4, NULL, NULL, 'thb-43-ashiok-s-erasure.jpg'),
(22, 'Piratería costera', 0, 2, 0, 0, 0, 2, 4, NULL, NULL, 'acr-84-coastal-piracy.jpg'),
(23, 'Encantamiento copia', 0, 1, 0, 0, 0, 2, 4, NULL, NULL, 'rvr-39-copy-enchantment.jpg'),
(24, 'Guantelete de Asesino', 0, 1, 0, 0, 0, 2, 5, NULL, NULL, 'acr-12-assassin-gauntlet.jpg'),
(25, 'Candelero', 0, 1, 0, 0, 0, 0, 5, NULL, NULL, 'mkm-43-candlestick.jpg'),
(26, 'Calavera de cristal, catalejo Isu', 0, 2, 0, 0, 0, 2, 5, NULL, NULL, 'acr-15-crystal-skull-isu-spyglass.jpg'),
(27, 'Puerta rompecabezas de Orazca', 0, 1, 0, 0, 0, 0, 5, NULL, NULL, 'lci-68-orazca-puzzle-door.jpg'),
(28, 'Vara de la absorción', 0, 1, 0, 0, 0, 2, 5, NULL, NULL, 'afc-19-rod-of-absorption.jpg'),
(29, 'Jace, náufrago astuto', 0, 2, 0, 0, 0, 1, 7, NULL, NULL, 'xln-60-jace-cunning-castaway.jpg'),
(30, 'Jace, resucitado', 0, 2, 0, 0, 0, 0, 7, NULL, NULL, 'otj-271-jace-reawakened.jpg'),
(31, 'Jace, mago reflejado', 0, 2, 0, 0, 0, 1, 7, NULL, NULL, 'afc-14-arcane-endeavor.jpg'),
(32, 'Mu Yanling, Viento Celestial', 0, 2, 0, 0, 0, 4, 7, NULL, NULL, 'm20-286-mu-yanling-celestial-wind.jpg'),
(33, 'Teferi, Maestro del Tiempo', 0, 2, 0, 0, 0, 2, 7, NULL, NULL, 'm21-75-teferi-master-of-time.jpg'),
(34, 'Akroma, ángel de furia', 3, 0, 0, 0, 0, 5, 1, 6, 6, 'tsr-150-akroma-angel-of-fury.jpg'),
(35, 'Infernal tectónico', 2, 0, 0, 0, 0, 5, 1, 8, 5, 'c19-29-tectonic-hellion.jpg'),
(36, 'Venganza acechante', 2, 0, 0, 0, 0, 5, 1, 5, 5, 'rvr-126-stalking-vengeance.jpg'),
(37, 'Devastasantuarios', 2, 0, 0, 0, 0, 4, 1, 6, 4, 'iko-135-sanctuary-smasher.jpg'),
(38, 'Celebrantes salvajes', 2, 0, 0, 0, 0, 3, 1, 5, 3, 'cmr-212-wild-celebrants.jpg'),
(39, 'Saludo del alquimista', 1, 0, 0, 0, 0, 4, 2, NULL, NULL, 'c19-133-alchemist-s-greeting.jpg'),
(40, 'Estragos de Anzrag', 2, 0, 0, 0, 0, 3, 2, NULL, NULL, 'mkm-111-anzrag-s-rampage.jpg'),
(41, 'Cúspide del poder', 3, 0, 0, 0, 0, 7, 2, NULL, NULL, 'afc-114-apex-of-power.jpg'),
(42, 'Cuchilla arqueada', 2, 0, 0, 0, 0, 3, 2, NULL, NULL, 'tsr-152-arc-blade.jpg'),
(43, 'Vínculo de pasión', 2, 0, 0, 0, 0, 4, 2, NULL, NULL, 'war-116-bond-of-passion.jpg'),
(44, 'Agravio antiguo', 1, 0, 0, 0, 0, 1, 3, NULL, NULL, 'tsr-151-ancient-grudge.jpg'),
(45, 'Frenesí de berserker', 1, 0, 0, 0, 0, 2, 3, NULL, NULL, 'afc-29-berserker-s-frenzy.jpg'),
(46, 'Trato del traidor', 1, 0, 0, 0, 0, 1, 3, NULL, NULL, 'dsk-126-betrayer-s-bargain.jpg'),
(47, 'Hacerse de oro', 1, 0, 0, 0, 0, 3, 3, NULL, NULL, 'blc-193-big-score.jpg'),
(48, 'Picado de la Rapaz del Trueno', 1, 0, 0, 0, 0, 1, 3, NULL, NULL, 'iko-109-blitz-of-the-thunder-raptor.jpg'),
(49, 'Revuelta del éter', 2, 0, 0, 0, 0, 2, 4, NULL, NULL, 'mh3-113-aether-revolt.jpg'),
(50, 'Luna alpina', 1, 0, 0, 0, 0, 0, 4, NULL, NULL, 'm19-128-alpine-moon.jpg'),
(51, 'Bombardeo arcano', 2, 0, 0, 0, 0, 4, 4, NULL, NULL, 'otc-154-arcane-bombardment.jpg'),
(52, 'Aria de la llama', 1, 0, 0, 0, 0, 2, 4, NULL, NULL, 'mh1-118-aria-of-flame.jpg'),
(53, 'Embestida de berserkers', 2, 0, 0, 0, 0, 3, 4, NULL, NULL, 'blc-192-berserkers-onslaught.jpg'),
(54, 'Acerosolar ardiente', 1, 0, 0, 0, 0, 1, 5, NULL, NULL, 'cmr-364-blazing-sunsteel.jpg'),
(55, 'Motosierra', 1, 0, 0, 0, 0, 1, 5, NULL, NULL, 'dsk-128-chainsaw.jpg'),
(56, 'Regulador de Chandra', 1, 0, 0, 0, 0, 1, 5, NULL, NULL, 'm20-131-chandra-s-regulator.jpg'),
(57, 'Espejo maldito', 1, 0, 0, 0, 0, 2, 5, NULL, NULL, 'mh3-279-cursed-mirror.jpg'),
(58, 'Percusionista mecánico', 1, 0, 0, 0, 0, 0, 5, NULL, NULL, 'dsk-130-clockwork-percussionist.jpg'),
(59, 'Jaya, piromante venerada', 1, 0, 0, 0, 0, 4, 7, NULL, NULL, 'war-135-jaya-venerated-firemage.jpg'),
(60, 'Lukka, paria de las Capas de Cobre', 2, 0, 0, 0, 0, 3, 7, NULL, NULL, 'iko-125-lukka-coppercoat-outcast.jpg'),
(61, 'Jeska, renacida tres veces', 1, 0, 0, 0, 0, 2, 7, NULL, NULL, 'cmr-186-jeska-thrice-reborn.jpg'),
(62, 'Zariel, archiduquesa de Averno', 2, 0, 0, 0, 0, 2, 7, NULL, NULL, 'afr-172-zariel-archduke-of-avernus.jpg'),
(63, 'Chandra, acólita de la llama', 2, 0, 0, 0, 0, 1, 7, NULL, NULL, 'm20-126-chandra-acolyte-of-flame.jpg'),
(64, 'Aeve, cieno progenitor', 0, 0, 3, 0, 0, 2, 1, 2, 2, 'mh2-148-aeve-progenitor-ooze.jpg'),
(65, 'Analista de consecuencias', 0, 0, 1, 0, 0, 1, 1, 1, 3, 'mkm-148-aftermath-analyst.jpg'),
(66, 'Sobreviviente ainok', 0, 0, 1, 0, 0, 1, 1, 2, 1, 'c19-156-ainok-survivalist.jpg'),
(67, 'Víbora emboscadora', 0, 0, 1, 0, 0, 1, 1, 2, 1, 'cmr-213-ambush-viper.jpg'),
(68, 'Yerbamala poderosa', 0, 0, 1, 0, 0, 0, 1, 1, 1, 'iko-143-almighty-brushwagg.jpg'),
(69, 'Analizar el polen', 0, 0, 1, 0, 0, 0, 2, NULL, NULL, 'mkm-150-analyze-the-pollen.jpg'),
(70, 'Audiencia con Trostani', 0, 0, 1, 0, 0, 2, 2, NULL, NULL, 'mkm-152-audience-with-trostani.jpg'),
(71, 'Mordisco justiciero', 0, 0, 1, 0, 0, 3, 2, NULL, NULL, 'mkm-154-bite-down-on-crime.jpg'),
(72, 'Carga de la Bestia Infinita', 0, 0, 1, 0, 0, 2, 2, NULL, NULL, 'iko-147-charge-of-the-forever-beast.jpg'),
(73, 'Maravillas antiguas', 0, 0, 2, 0, 0, 0, 2, NULL, NULL, 'lcc-89-bygone-marvels.jpg'),
(74, 'Decreto de salvajismo', 0, 0, 2, 0, 0, 7, 3, NULL, NULL, 'afc-156-decree-of-savagery.jpg'),
(75, 'Invocaciones de la estirpe', 0, 0, 2, 0, 0, 5, 3, NULL, NULL, 'afc-163-kindred-summons.jpg'),
(76, 'Recompensa de poder', 0, 0, 2, 0, 0, 4, 3, NULL, NULL, 'grn-124-bounty-of-might.jpg'),
(77, 'Regreso del Portavoz Salvaje', 0, 0, 1, 0, 0, 4, 3, NULL, NULL, 'otc-203-return-of-the-wildspeaker.jpg'),
(78, 'Rebaño curioso', 0, 0, 1, 0, 0, 3, 3, NULL, NULL, 'c20-59-curious-herd.jpg'),
(79, 'Un asesino entre nosotros', 0, 0, 1, 0, 0, 4, 4, NULL, NULL, 'mkm-167-a-killer-among-us.jpg'),
(80, 'Coartada perfecta', 0, 0, 1, 0, 0, 2, 4, NULL, NULL, 'mkm-149-airtight-alibi.jpg'),
(81, 'Ascenso del domador', 0, 0, 1, 0, 0, 2, 4, NULL, NULL, 'blc-118-beastmaster-ascension.jpg'),
(82, 'Ritual de nacimiento', 0, 0, 1, 0, 0, 1, 4, NULL, NULL, 'mh3-146-birthing-ritual.jpg'),
(83, 'Influencia de Ayula', 0, 0, 3, 0, 0, 0, 4, NULL, NULL, 'mh1-156-ayula-s-influence.jpg'),
(84, 'Cornucopia antigua', 0, 0, 1, 0, 0, 2, 5, NULL, NULL, 'big-16-ancient-cornucopia.jpg'),
(85, 'Bolsa de trucos', 0, 0, 1, 0, 0, 1, 5, NULL, NULL, 'afc-37-bag-of-tricks.jpg'),
(86, 'Llamacomida', 0, 0, 1, 0, 0, 2, 5, NULL, NULL, 'blc-211-chitterspitter.jpg'),
(87, 'Alijo de explorador', 0, 0, 1, 0, 0, 1, 5, NULL, NULL, 'lci-184-explorer-s-cache.jpg'),
(88, 'Guadaña malamet', 0, 0, 1, 0, 0, 2, 5, NULL, NULL, 'lci-200-malamet-scythe.jpg'),
(89, 'Ellywick Rasguereta', 0, 0, 2, 0, 0, 2, 7, NULL, NULL, 'afr-181-ellywick-tumblestrum.jpg'),
(90, 'Garruk, desatado', 0, 0, 2, 0, 0, 2, 7, NULL, NULL, 'm21-183-garruk-unleashed.jpg'),
(91, 'Vivien, Exploradora del Animarco', 0, 0, 3, 0, 0, 1, 7, NULL, NULL, 'm20-199-vivien-arkbow-ranger.jpg'),
(92, 'Vivien, defensora de los monstruos', 0, 0, 2, 0, 0, 3, 7, NULL, NULL, 'iko-175-vivien-monsters-advocate.jpg'),
(93, 'Nissa, la que Sacude el Mundo', 0, 0, 3, 0, 0, 2, 7, NULL, NULL, 'iwar-169-nissa-who-shakes-the-world.jpg'),
(94, 'Rastreacrúor abismal', 0, 0, 0, 2, 0, 4, 1, 6, 6, 'lci-87-abyssal-gorestalker.jpg'),
(95, 'Espectro abismal', 0, 0, 0, 2, 0, 2, 1, 2, 3, 'ps11-60-abyssal-specter.jpg'),
(96, 'Acererak, el Archiliche', 0, 0, 0, 1, 0, 2, 1, 5, 5, 'afr-87-acererak-the-archlich.jpg'),
(97, 'Aclazotz, Traición Primigenia', 0, 0, 0, 2, 0, 3, 1, 4, 4, 'lci-88-aclazotz-deepest-betrayal.jpg'),
(98, 'Gigápodo emboscador', 0, 0, 0, 2, 0, 4, 1, 6, 2, 'otj-77-ambush-gigapede.jpg'),
(99, 'Ayudar a los caídos', 0, 0, 0, 1, 0, 1, 2, NULL, NULL, 'war-76-aid-the-fallen.jpg'),
(100, 'Dragado de Afetto', 0, 0, 0, 1, 0, 3, 2, NULL, NULL, 'psal-D40-aphetto-dredging.jpg'),
(101, 'Asesinar', 0, 0, 0, 1, 0, 2, 2, NULL, NULL, 'tsr-101-assassinate.jpg'),
(102, 'Despertar a los Arcaicos', 0, 0, 0, 2, 0, 3, 2, NULL, NULL, 'rna-61-awaken-the-erstwhile.jpg'),
(103, 'Faro de desasosiego', 0, 0, 0, 2, 0, 3, 2, NULL, NULL, 'c19-105-beacon-of-unrest.jpg'),
(104, 'Resistencia anormal', 0, 0, 0, 1, 0, 1, 3, NULL, NULL, 'm19-85-abnormal-endurance.jpg'),
(105, 'Bendición de Belzenlok', 0, 0, 0, 1, 0, 0, 3, NULL, NULL, 'dom-77-blessing-of-belzenlok.jpg'),
(106, 'Aferrarse al polvo', 0, 0, 0, 1, 0, 0, 3, NULL, NULL, 'thb-87-cling-to-dust.jpg'),
(107, 'Convicción corrupta', 0, 0, 0, 1, 0, 0, 3, NULL, NULL, 'otj-84-corrupted-conviction.jpg'),
(108, 'Ráfaga oscura', 0, 0, 0, 1, 0, 0, 3, NULL, NULL, 'gk1-51-darkblast.jpg'),
(109, 'Aspecto de lamprea', 0, 0, 0, 1, 0, 3, 4, NULL, NULL, 'thb-85-aspect-of-lamprey.jpg'),
(110, 'Contactos en el mercado negro', 0, 0, 0, 1, 0, 2, 4, NULL, NULL, 'acr-87-black-market-connections.jpg'),
(111, 'Canonizar con sangre', 0, 0, 0, 1, 0, 1, 4, NULL, NULL, 'lci-96-canonized-in-blood.jpg'),
(112, 'Pesadilla ctónica', 0, 0, 0, 1, 0, 1, 4, NULL, NULL, 'mh3-83-chthonian-nightmare.jpg'),
(113, 'Conspiración', 0, 0, 0, 2, 0, 3, 4, NULL, NULL, 'acr-88-conspiracy.jpg'),
(114, 'Bolsa devoradora', 0, 0, 0, 1, 0, 0, 5, NULL, NULL, 'afc-21-bag-of-devouring.jpg'),
(115, 'Mangual de espinas sangrientas', 0, 0, 0, 1, 0, 0, 5, NULL, NULL, 'lci-93-bloodthorn-flail.jpg'),
(116, 'Ciudadela de Nicol Bolas', 0, 0, 0, 3, 0, 3, 5, NULL, NULL, 'war-79-bolas-s-citadel.jpg'),
(117, 'Garraescoria', 0, 0, 0, 1, 0, 1, 5, NULL, NULL, 'mh3-89-drossclaw.jpg'),
(118, 'Corazón de cristal', 0, 0, 0, 1, 0, 2, 5, NULL, NULL, 'lcc-199-glass-cast-heart.jpg'),
(119, 'Davriel, magosombra renegado', 0, 0, 0, 1, 0, 2, 7, NULL, NULL, 'war-83-davriel-rogue-shadowmage.jpg'),
(120, 'Liliana, a salvo de la muerte', 0, 0, 0, 2, 0, 2, 7, NULL, NULL, 'm19-106-liliana-untouched-by-death.jpg'),
(121, 'Lolth, la Reina Araña', 0, 0, 0, 2, 0, 3, 7, NULL, NULL, 'afr-112-lolth-spider-queen.jpg'),
(122, 'Sorin, señor sangriento altivo', 0, 0, 0, 1, 0, 2, 7, NULL, NULL, 'm20-115-sorin-imperious-bloodlord.jpg'),
(123, 'Sorin, señor vampiro', 0, 0, 0, 2, 0, 4, 7, NULL, NULL, 'm20-290-sorin-vampire-lord.jpg'),
(124, 'Zetalpa, la Aurora Primigenia', 0, 0, 0, 0, 2, 6, 1, 4, 8, 'lcc-141-zetalpa-primal-dawn.jpg'),
(125, 'Avatar del Sol Albo', 0, 0, 0, 0, 3, 5, 1, 7, 7, 'lcc-139-wakening-sun-s-avatar.jpg'),
(126, 'Akroma, visión de Íxidor', 0, 0, 0, 0, 2, 5, 1, 6, 6, 'cmr-2-akroma-vision-of-ixidor.jpg'),
(127, 'Gigante de marfil', 0, 0, 0, 0, 2, 5, 1, 3, 4, 'tsr-20-ivory-giant.jpg'),
(128, 'Solar radiante', 0, 0, 0, 0, 1, 5, 1, 3, 6, 'afc-9-radiant-solar.jpg'),
(129, 'Mano amiga', 0, 0, 0, 0, 1, 0, 2, NULL, NULL, 'lci-17-helping-hand.jpg'),
(130, 'Calambre reanimador', 0, 0, 0, 0, 1, 0, 2, NULL, NULL, 'mh3-33-jolted-awake.jpg'),
(131, 'Incursión de requisición', 0, 0, 0, 0, 1, 0, 2, NULL, NULL, 'otj-26-requisition-raid.jpg'),
(132, 'De un bocado', 0, 0, 0, 0, 1, 0, 2, NULL, NULL, 'iko-35-swallow-whole.jpg'),
(133, 'Decreto de devoción', 0, 0, 0, 0, 1, 1, 2, NULL, NULL, 'm20-13-devout-decree.jpg'),
(134, 'Égida de los cielos', 0, 0, 0, 0, 1, 1, 3, NULL, NULL, 'm19-1-aegis-of-the-heavens.jpg'),
(135, 'Voluntad de Akroma', 0, 0, 0, 0, 1, 3, 3, NULL, NULL, 'lcc-125-akroma-s-will.jpg'),
(136, 'Asalto de grupo', 0, 0, 0, 0, 1, 2, 3, NULL, NULL, 'znr-1-allied-assault.jpg'),
(137, 'Fervor del encarcelador', 0, 0, 0, 0, 1, 0, 3, NULL, NULL, 'rvr-4-arrester-s-zeal.jpg'),
(138, 'Gracia del ángel', 0, 0, 0, 0, 1, 0, 3, NULL, NULL, 'tsr-4-angel-s-grace.jpg'),
(139, 'Gracia duradera', 0, 0, 0, 0, 1, 2, 4, NULL, NULL, 'mh2-1-abiding-grace.jpg'),
(140, 'Último esfuerzo de Ajani', 0, 0, 0, 0, 2, 2, 4, NULL, NULL, 'm19-4-ajani-s-last-stand.jpg'),
(141, 'Exaltación angélica', 0, 0, 0, 0, 1, 3, 4, NULL, NULL, 'rvr-2-angelic-exaltation.jpg'),
(142, 'Plegarias escuchadas', 0, 0, 0, 0, 2, 1, 4, NULL, NULL, 'mh1-2-answered-prayers.jpg'),
(143, 'Recibimiento de Ajani', 0, 0, 0, 0, 1, 0, 4, NULL, NULL, 'm19-6-ajani-s-welcome.jpg'),
(144, 'Mapa de arqueomante', 0, 0, 0, 0, 1, 2, 5, NULL, NULL, 'lcc-101-archaeomancer-s-map.jpg'),
(145, 'Estrado argénteo', 0, 0, 0, 0, 1, 1, 5, NULL, NULL, 'mh3-20-argent-dais.jpg'),
(146, 'Caduceo, vara de Hermes', 0, 0, 0, 0, 1, 2, 5, NULL, NULL, 'acr-2-caduceus-staff-of-hermes.jpg'),
(147, 'Espadón seráfico', 0, 0, 0, 0, 1, 1, 5, NULL, NULL, 'cmr-45-seraphic-greatsword.jpg'),
(148, 'Relicario de esencias', 0, 0, 0, 0, 1, 2, 5, NULL, NULL, 'mh3-24-essence-reliquary.jpg'),
(149, 'Ajani, líder inspirador', 0, 0, 0, 0, 2, 4, 7, NULL, NULL, 'm20-282-ajani-inspiring-leader.jpg'),
(150, 'Basri Ketr', 0, 0, 0, 0, 2, 1, 7, NULL, NULL, 'm21-7-basri-ket.jpg'),
(151, 'Elspeth, campeona del sol', 0, 0, 0, 0, 2, 4, 7, NULL, NULL, 'blc-97-elspeth-sun-s-champion.jpg'),
(152, 'Elspeth, némesis del sol', 0, 0, 0, 0, 2, 2, 7, NULL, NULL, 'thb-14-elspeth-sun-s-nemesis.jpg'),
(153, 'Gideon Blackblade', 0, 0, 0, 0, 2, 1, 7, NULL, NULL, 'rvr-20-gideon-blackblade.jpg'),
(154, 'Sembrador del olvido', 0, 0, 0, 0, 0, 6, 1, 5, 8, 'otc-77-oblivion-sower.jpg'),
(155, 'Errante vacío', 0, 0, 0, 0, 0, 7, 1, 4, 4, 'mh3-13-nulldrifter.jpg'),
(156, 'Kozilek, la Realidad Rota', 0, 0, 0, 0, 0, 9, 1, 9, 9, 'mh3-10-kozilek-the-broken-reality.jpg'),
(157, 'Emrakul, Renovadora de Mundos', 0, 0, 0, 0, 0, 12, 1, 12, 12, 'mh3-6-emrakul-the-world-anew.jpg'),
(158, 'Descubridora', 0, 0, 0, 0, 0, 3, 1, 1, 1, 'iko-2-farfinder.jpg'),
(159, 'Ráfaga elemental vacía', 0, 0, 0, 0, 0, 1, 3, NULL, NULL, 'mh3-12-null-elemental-blast.jpg'),
(160, 'Sarcófago abandonado', 0, 0, 0, 0, 0, 3, 5, NULL, NULL, 'c20-236-abandoned-sarcophagus.jpg'),
(161, 'Rotor de los eone', 0, 0, 0, 0, 0, 5, 5, NULL, NULL, 'c19-52-aeon-engine.jpg'),
(162, 'Monumento a Akroma', 0, 0, 0, 0, 0, 7, 5, NULL, NULL, 'tsr-262-akroma-s-memorial.jpg'),
(163, 'Altar del panteón', 0, 0, 0, 0, 0, 3, 5, NULL, NULL, 'thb-231-altar-of-the-pantheon.jpg'),
(164, 'Amuleto de custodia', 0, 0, 0, 0, 0, 2, 5, NULL, NULL, 'm19-226-amulet-of-safekeeping.jpg'),
(165, 'Karn, vástago de Urza', 0, 0, 0, 0, 0, 4, 7, NULL, NULL, 'dom-1-karn-scion-of-urza.jpg'),
(166, 'Karn, el Gran Creador', 0, 0, 0, 0, 0, 4, 7, NULL, NULL, 'rvr-1-karn-the-great-creator.jpg'),
(167, 'Ugin, el Inefable', 0, 0, 0, 0, 0, 6, 7, NULL, NULL, 'war-2-ugin-the-ineffable.jpg'),
(168, 'Ugin, el dragón espíritu', 0, 0, 0, 0, 0, 8, 7, NULL, NULL, 'm21-1-ugin-the-spirit-dragon.jpg'),
(169, 'Teferi, manipulador del tiempo', 0, 1, 0, 0, 1, 1, 7, NULL, NULL, 'rvr-232-teferi-time-raveler.jpg'),
(170, 'Égida asimiladora', 0, 1, 0, 0, 1, 1, 5, NULL, NULL, 'otj-192-assimilation-aegis.jpg'),
(171, 'Amuleto azorio', 0, 1, 0, 0, 1, 0, 5, NULL, NULL, 'gk2-8-azorius-charm.jpg'),
(172, 'Caballero árbitro azorio', 0, 1, 0, 0, 1, 3, 1, 2, 5, 'rna-154-azorius-knight-arbiter.jpg'),
(173, 'Brago, el rey eterno', 0, 1, 0, 0, 1, 2, 1, 2, 4, 'khc-82-brago-king-eternal.jpg'),
(174, 'Sorin, Señor de Innistrad', 0, 0, 0, 1, 1, 2, 7, NULL, NULL, 'lcc-289-sorin-lord-of-innistrad.jpg'),
(175, 'Efecto sangrado', 0, 0, 0, 1, 1, 2, 4, NULL, NULL, 'acr-51-bleeding-effect.jpg'),
(176, 'Caballero sin aliento', 0, 0, 0, 1, 1, 1, 1, 2, 2, 'mh2-187-breathless-knight.jpg'),
(177, 'Ángel del pacto mortal', 0, 0, 0, 2, 1, 3, 1, 5, 5, 'gk2-38-deathpact-angel.jpg'),
(178, 'Tácticas desesperadas', 0, 0, 0, 1, 1, 0, 3, NULL, NULL, 'iko-183-dire-tactics.jpg'),
(179, 'Huatli, poetisa guerrera', 1, 0, 0, 0, 1, 3, 7, NULL, NULL, 'xln-224-huatli-warrior-poet.jpg'),
(180, 'Aya de Alejandría', 1, 0, 0, 0, 1, 2, 1, 4, 3, 'acr-48-aya-of-alexandria.jpg'),
(181, 'Bruenor Martillo de Batalla', 1, 0, 0, 0, 1, 2, 1, 5, 3, 'afr-219-bruenor-battlehammer.jpg'),
(182, 'Filoveloz boros', 1, 0, 0, 0, 1, 0, 1, 1, 2, 'gk1-86-boros-swiftblade.jpg'),
(183, 'Amuleto boros', 1, 0, 0, 0, 1, 0, 3, NULL, NULL, 'otc-216-boros-charm.jpg'),
(184, 'Ajani, el de Corazón Grande', 0, 0, 1, 0, 1, 2, 7, NULL, NULL, 'war-184-ajani-the-greathearted.jpg'),
(185, 'Ajani, el de Corazón Grande', 0, 0, 2, 0, 1, 1, 3, NULL, NULL, 'gk1-107-advent-of-the-wurm.jpg'),
(186, 'Bate de béisbol', 0, 0, 1, 0, 1, 0, 5, NULL, NULL, 'dsk-209-baseball-bat.jpg'),
(187, 'Llamada del Cónclave', 0, 0, 1, 0, 1, 0, 2, NULL, NULL, 'rvr-169-call-of-the-conclave.jpg'),
(188, 'Llamado de Eladamri', 0, 0, 1, 0, 1, 0, 3, NULL, NULL, 'mh1-197-eladamri-s-call.jpg');

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
(80, 12),
(95, 8),
(97, 7),
(97, 8),
(98, 12),
(124, 3),
(124, 8),
(124, 13),
(124, 14),
(126, 2),
(126, 4),
(126, 8),
(126, 13),
(128, 7),
(128, 8),
(155, 8),
(157, 8),
(158, 13),
(172, 13),
(173, 8),
(176, 7),
(176, 8),
(177, 8),
(180, 7),
(180, 9),
(182, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartas_tipos_criatura`
--

CREATE TABLE `cartas_tipos_criatura` (
  `id_carta` int(11) NOT NULL,
  `id_tipo_criatura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cartas_tipos_criatura`
--

INSERT INTO `cartas_tipos_criatura` (`id_carta`, `id_tipo_criatura`) VALUES
(9, 47),
(9, 76),
(9, 117),
(10, 162),
(11, 67),
(12, 30),
(12, 75),
(13, 119),
(34, 7),
(35, 120),
(36, 21),
(37, 30),
(38, 201),
(64, 49),
(65, 76),
(66, 47),
(66, 175),
(67, 235),
(68, 238),
(94, 115),
(95, 84),
(96, 107),
(96, 241),
(97, 59),
(97, 150),
(124, 6),
(124, 65),
(125, 21),
(125, 65),
(126, 7),
(127, 97),
(128, 7),
(154, 73),
(155, 73),
(155, 75),
(156, 73),
(157, 73),
(158, 242),
(172, 33),
(172, 117),
(173, 85),
(176, 33),
(176, 85),
(177, 7),
(180, 18),
(180, 117),
(181, 77),
(181, 104),
(182, 117),
(182, 211);

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
(12, 'Destello'),
(13, 'Vigilancia'),
(14, 'Indestructible');

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
  ADD KEY `tipo_carta` (`tipo_carta`);

--
-- Indices de la tabla `cartas_habilidades`
--
ALTER TABLE `cartas_habilidades`
  ADD PRIMARY KEY (`id_carta`,`id_habilidad`),
  ADD KEY `id_habilidad` (`id_habilidad`);

--
-- Indices de la tabla `cartas_tipos_criatura`
--
ALTER TABLE `cartas_tipos_criatura`
  ADD PRIMARY KEY (`id_carta`,`id_tipo_criatura`),
  ADD KEY `id_tipo_criatura` (`id_tipo_criatura`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT de la tabla `habilidades`
--
ALTER TABLE `habilidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  ADD CONSTRAINT `cartas_ibfk_1` FOREIGN KEY (`tipo_carta`) REFERENCES `tipo_carta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cartas_habilidades`
--
ALTER TABLE `cartas_habilidades`
  ADD CONSTRAINT `cartas_habilidades_ibfk_1` FOREIGN KEY (`id_carta`) REFERENCES `cartas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cartas_habilidades_ibfk_2` FOREIGN KEY (`id_habilidad`) REFERENCES `habilidades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cartas_tipos_criatura`
--
ALTER TABLE `cartas_tipos_criatura`
  ADD CONSTRAINT `cartas_tipos_criatura_ibfk_1` FOREIGN KEY (`id_carta`) REFERENCES `cartas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cartas_tipos_criatura_ibfk_2` FOREIGN KEY (`id_tipo_criatura`) REFERENCES `tipo_criatura` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
