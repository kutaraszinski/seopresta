-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 24 Février 2016 à 07:44
-- Version du serveur: 5.5.34
-- Version de PHP: 5.4.6-1ubuntu1.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `api_presta`
--

-- --------------------------------------------------------

--
-- Structure de la table `keyword`
--

CREATE TABLE IF NOT EXISTS `keyword` (
  `id_keyword` int(11) NOT NULL AUTO_INCREMENT,
  `id_page` int(11) NOT NULL,
  `keyword` text NOT NULL,
  PRIMARY KEY (`id_keyword`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `keyword`
--

INSERT INTO `keyword` (`id_keyword`, `id_page`, `keyword`) VALUES
(1, 1, 'test'),
(2, 2, 'robe ete test'),
(3, 3, 't shirt homme humour'),
(4, 4, 'jeans elastique homme grande taille'),
(5, 5, 'robes'),
(6, 6, 'chemisier femme'),
(7, 7, 'robes dÃ©contractÃ©es'),
(8, 8, 'robe soirÃ©e'),
(9, 9, 't shirt femme'),
(10, 10, 'blouse blanche homme'),
(11, 11, 'blouse blanche');

-- --------------------------------------------------------

--
-- Structure de la table `keywords`
--

CREATE TABLE IF NOT EXISTS `keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_page` int(11) NOT NULL,
  `keyword` text NOT NULL,
  `actif` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=430 ;

--
-- Contenu de la table `keywords`
--

INSERT INTO `keywords` (`id`, `id_page`, `keyword`, `actif`) VALUES
(63, 8, 'robes décontractées', 1),
(64, 8, 'decontractees robes for women', 0),
(65, 8, 'robes mariées décontractées', 0),
(66, 8, 'robes d''été décontractées', 0),
(67, 8, 'robes décontractées pas cher', 1),
(68, 8, 'robes décontractées longues', 1),
(69, 8, 'robes décontractées chic', 0),
(70, 8, 'decontractees robes for kids', 0),
(71, 8, 'decontractees robes de mariage', 0),
(72, 8, 'decontractees robes for men', 0),
(73, 8, 'decontractees robes for bridesmaids', 0),
(74, 8, 'decontractees robes with hoods', 0),
(75, 8, 'decontractees robes de soiree', 0),
(76, 8, 'décontractées robes', 0),
(77, 8, 'decontractees robeson', 0),
(78, 8, 'decontractees robes of arcana', 0),
(79, 8, 'decontractees robes for girls', 0),
(80, 8, 'decontractees robes kabyles', 0),
(81, 8, 'robes de mariée', 0),
(82, 8, 'robes de mariage', 0),
(83, 8, 'robes for kids', 0),
(84, 8, 'robes for men', 0),
(85, 8, 'robes for women', 0),
(86, 8, 'robes décontractées mode', 0),
(87, 8, 'robes for bridesmaids', 0),
(88, 8, 'robes kabyles 2016', 1),
(89, 8, 'decontractees robesonian', 0),
(90, 8, 'robes of arcana', 1),
(91, 8, 'robes for girls', 0),
(92, 8, 'robes de soirée', 0),
(93, 8, 'decontractees robespierre', 1),
(125, 11, 'blouse blanche', 0),
(126, 11, 'blouse blanche chimie', 1),
(127, 11, 'blanche blouse', 0),
(128, 11, 'robe blanche blouse bleue claire', 0),
(129, 11, 'blanche bosselman', 0),
(130, 11, 'blouse blanche travail', 1),
(131, 11, 'blouse blanche coton', 1),
(132, 11, 'blouse blanche nylon', 0),
(133, 11, 'blanche blasch death', 0),
(134, 11, 'blanche blueitt', 0),
(135, 11, 'blouse blanche college', 0),
(136, 11, 'blouse blanche chimie auchan', 0),
(137, 11, 'blouse blanche scolaire', 1),
(138, 11, 'blouse blanche homme', 1),
(139, 11, 'blanche louise lewien', 0),
(140, 11, 'definition blouse', 0),
(141, 11, 'blouse blanche coton ado', 0),
(142, 11, 'blouse blanche paris', 0),
(143, 11, 'blouse blanche carrefour', 0),
(144, 11, 'blouse blanche femme', 1),
(145, 11, 'effet blouse blanche', 0),
(146, 11, 'blouse blanche enfants', 0),
(147, 11, 'blouse blanche physique', 1),
(148, 11, 'blouse blanche anglais', 0),
(149, 11, 'blouse blanche en coton a manche longues', 0),
(150, 11, 'blouse blanche lycée', 1),
(151, 11, 'blouse blanche chimie carrefour', 0),
(152, 11, 'blouse blanche pharmacie', 1),
(153, 11, 'blouse blanche auchan', 0),
(154, 11, 'blouse blanche travail industrie', 0),
(155, 11, 'restaurant blouses', 0),
(156, 11, 'syndrome blouse blanche', 0),
(157, 11, 'restaurant blouse', 0),
(158, 11, 'blanche louise jackson lexington gazette', 0),
(159, 11, 'blanche bleaching cream', 0),
(160, 11, 'blanche bruce s main accomplishments', 0),
(161, 11, 'blanche bleaching cream trial coupon', 0),
(162, 11, 'blanche louise treadway', 0),
(163, 11, 'blanche louise wurl born in laramie wy', 0),
(164, 11, 'blanche louise preston mcsmith', 0),
(165, 11, 'blanche borsella howe', 0),
(166, 3, 't shirt homme humour', 0),
(167, 3, 't shirt humour homme', 0),
(168, 3, 't shirt homme humour pas cher', 0),
(169, 3, 't shirt humour homme pas cher', 0),
(170, 3, 'life joke t shirt homme', 0),
(171, 3, 'humour t homme shirt', 0),
(172, 3, 't humour homme shirt', 0),
(173, 3, 'humour shirt homme t', 0),
(174, 3, 't homme humour shirt', 0),
(175, 3, 'humour shirt t homme', 0),
(176, 3, 't homme shirt humour', 0),
(177, 3, 'shirt homme humour t', 0),
(178, 3, 't humour shirt homme', 0),
(179, 3, 'shirt humour t homme', 0),
(180, 3, 'homme t shirt humour', 0),
(181, 3, 'homme humour shirt t', 0),
(182, 3, 'homme humour t shirt', 0),
(183, 3, 'shirt t humour homme', 0),
(184, 3, 'shirt t homme humour', 0),
(185, 3, 'homme t humour shirt', 0),
(186, 3, 'shirt homme t humour', 0),
(187, 3, 'homme shirt humour t', 0),
(188, 3, 'shirt humour homme t', 0),
(189, 3, 'homme shirt t humour', 0),
(190, 3, 'humour t shirt homme', 0),
(191, 3, 'humour homme shirt t', 0),
(192, 3, 'humour homme t shirt', 0),
(193, 3, 'humour t-shirt homme ny 2016', 0),
(194, 3, 'humour t-shirt homme de marque', 0),
(195, 3, 'humour t-shirt homme avec logos ny 2016', 0),
(196, 3, 't shirt homme humour algerien', 0),
(197, 3, 'homme shirt t humour video', 0),
(198, 3, 'homme shirt t humour or humor', 0),
(199, 3, 'homme shirt t humour algerien', 0),
(200, 3, 'humour t-shirt homme enfant identique', 0),
(201, 3, 'shirt homme t humour algerien', 0),
(202, 3, 't shirt homme humour ivoirien', 0),
(203, 3, 't shirt homme humour et blague', 0),
(204, 3, 'humour t-shirt homme je t''aime', 0),
(205, 3, 'humour t-shirt homme pas cher', 0),
(206, 3, 'humour t-shirt homme champagne gris', 0),
(207, 3, 'humour t-shirt homme motif', 0),
(208, 3, 'humour t-shirt homme bio', 0),
(209, 3, 'homme shirt t humour images', 0),
(210, 3, 'tee shirt homme humour', 0),
(211, 3, 'shirt homme t humour et blague', 0),
(212, 3, 'shirt homme t humour meaning', 0),
(213, 3, 'shirt homme t humour noir', 0),
(214, 3, 'shirt homme t humour ivoirien', 0),
(215, 3, 'shirt homme t humour images', 0),
(216, 3, 'shirt homme t humour or humor', 0),
(217, 3, 'shirt homme t humour video', 0),
(218, 3, 't shirt homme humour or humor', 0),
(219, 3, 'homme shirt humour t-shirts', 0),
(220, 3, 'shirt homme humour t-shirts', 0),
(221, 3, 'homme shirt t humour et blague', 0),
(222, 3, 't shirt homme humour meaning', 0),
(223, 3, 'homme shirt t humour meaning', 0),
(224, 3, 'homme shirt t humour noir', 0),
(225, 3, 't shirt homme humour video', 0),
(226, 3, 't shirt homme humour images', 0),
(227, 3, 'homme shirt t humour ivoirien', 0),
(228, 3, 'tee shirt humour homme', 0),
(229, 3, 'shirt t homme humour or humor', 0),
(230, 3, 'shirt t homme humour algerien', 0),
(231, 3, 'tee shirt humour homme grande taille', 0),
(232, 3, 'shirt t homme humour video', 0),
(233, 3, 'shirt t homme humour images', 0),
(234, 3, 'shirt t homme humour ivoirien', 0),
(235, 3, 'tee shirt humour homme retraite', 0),
(236, 3, 'shirt t humour homme a lunette', 0),
(237, 3, 'tee shirt humour homme 50 ans', 0),
(238, 3, 'shirt t humour homme au', 0),
(239, 3, 't shirt humour homme au', 0),
(240, 3, 't shirt humour homme a lunette', 0),
(241, 3, 'tee shirt humour homme pas cher', 0),
(242, 3, 'tee shirt humoristique homme anniversaire', 0),
(243, 3, 'tee-shirt humoristique homme pas cher', 0),
(244, 3, 'tee shirt humoristique homme retraite', 0),
(245, 3, 'shirt t homme humour meaning', 0),
(246, 3, 'shirt t homme humour et blague', 0),
(247, 3, 'tee shirt homme humour noir', 0),
(248, 3, 't shirt homme humour noir', 0),
(249, 3, 'tee shirt homme humour pas cher', 0),
(250, 3, 'shirt t homme humour noir', 0),
(251, 3, 'homme t shirt humour images', 0),
(252, 3, 'homme t shirt humour ivoirien', 0),
(253, 3, 'homme t humour shirt dress', 0),
(254, 3, 'homme shirt humour togolais', 0),
(255, 3, 'humour shirt t homme meaning', 0),
(256, 3, 'homme t humour shirt size', 0),
(257, 3, 'homme t shirt humour or humor', 0),
(258, 3, 'homme t shirt humour algerien', 0),
(259, 3, 'homme shirt humour tukulukat', 0),
(260, 3, 'homme t humour shirts', 0),
(261, 3, 'homme t shirt humour africain', 0),
(262, 3, 'homme t shirt humour et blague', 0),
(263, 3, 'homme t shirt humour video', 0),
(264, 3, 'homme t humour shirt collar', 0),
(265, 3, 'homme t humour shirt design', 0),
(266, 3, 'homme t shirt humour noir', 0),
(267, 3, 'homme t humour shirt stays', 0),
(268, 3, 'homme t shirt humour francais', 0),
(269, 3, 'homme t humour shirt folding', 0),
(270, 3, 'homme t humour shirt and tie', 0),
(271, 3, 'homme t shirt humour meaning', 0),
(272, 3, 'homme t humour shirt woot', 0),
(273, 3, 'homme t humour shirt maker', 0),
(274, 3, 'humour shirt t homme prehistorique', 0),
(275, 3, 'homme t-shirt humour', 0),
(276, 3, 'homme t humour shirt template', 0),
(277, 3, 'humour shirt t homme moderne', 0),
(278, 3, 'humour shirt homme translation', 0),
(279, 3, 'humour shirt homme taureau', 0),
(280, 3, 'humour shirt homme tabasse', 0),
(281, 3, 'humour shirt homme tronc', 0),
(282, 3, 'humour shirt homme tres', 0),
(283, 3, 'humour shirt homme triste', 0),
(284, 3, 'humour t homme shirt folding', 0),
(285, 3, 'humour t homme shirt and tie', 0),
(286, 3, 'humour t homme shirt woot', 0),
(287, 3, 'humour t homme shirt collar', 0),
(288, 3, 'humour shirt homme tigre', 0),
(289, 3, 'humour shirt homme tunisien', 0),
(290, 3, 'humour shirt t-homme', 0),
(291, 3, 'humour shirt t homme home', 0),
(292, 3, 'humour shirt t homme less', 0),
(293, 3, 'humour shirt t homme au', 0),
(294, 3, 'humour shirt t hommelhof', 0),
(295, 3, 'humour shirt homme t-shirt rouge', 0),
(296, 3, 'humour shirt homme tout', 0),
(297, 3, 'humour shirt homme tahitien', 0),
(298, 3, 'humour shirt homme t-shirt', 0),
(299, 3, 'humour shirt homme t-shirts', 0),
(300, 3, 'humour t homme shirt template', 0),
(301, 3, 'humour t homme shirt size', 0),
(302, 3, 'humour shirt t homme fatale', 0),
(303, 3, 'humour shirt t homme arbre', 0),
(304, 3, 'homme shirt t humorous quotes', 0),
(305, 3, 'homme shirt t humorous', 0),
(306, 3, 'homme shirt humour teaching', 0),
(307, 3, 'homme shirt humour tachlhit', 0),
(308, 3, 'homme shirt humour travail', 0),
(309, 3, 'homme shirt humour transpiration', 0),
(310, 3, 'homme shirt humour translation', 0),
(311, 3, 'homme shirt humour texts', 0),
(312, 3, 'homme shirt t humour africain', 0),
(313, 3, 'homme shirt t humour francais', 0),
(314, 3, 'humour t homme shirt dress', 0),
(315, 3, 'humour t homme shirt design', 0),
(316, 3, 'humour t homme shirt stays', 0),
(317, 3, 'humour t homme shirt maker', 0),
(318, 3, 'humour t homme shirts', 0),
(319, 3, 'humour shirt t homme cologne', 0),
(320, 3, 'shirt t humour hommes', 0),
(321, 3, 'humour shirt t homme et femme', 0),
(322, 3, 'humour t-shirt homme', 0),
(323, 3, 'humour t-shirt homme mode 2015', 0),
(324, 3, 'homme shirt humor therapy', 0),
(325, 3, 'shirt humour homme tres', 0),
(326, 3, 't-shirt homme enfant identique', 0),
(327, 3, 't-shirt homme ny 2016', 0),
(328, 3, 't-shirt homme champagne gris', 0),
(329, 3, 't-shirt homme de marque', 0),
(330, 3, 't-shirt homme je t''aime', 0),
(331, 3, 't-shirt homme avec logos ny 2016', 0),
(332, 3, 't homme shirt humour francais', 0),
(333, 3, 't homme shirt humour video', 0),
(334, 3, 't homme shirt humour images', 0),
(335, 3, 't homme shirt humour or humor', 0),
(336, 3, 't homme shirt humour africain', 0),
(337, 3, 't homme shirt humour algerien', 0),
(338, 3, 't-shirt homme mode 2015', 0),
(339, 3, 't-shirt homme', 0),
(340, 3, 't humour shirt homme et femme', 0),
(341, 3, 't humour shirt homme cologne', 0),
(342, 3, 't humour shirt homme moderne', 0),
(343, 3, 't humour shirt homme fatale', 0),
(344, 3, 't humour shirt homme prehistorique', 0),
(345, 3, 't humour shirt homme arbre', 0),
(346, 3, 't humour shirt homme au', 0),
(347, 3, 't-shirt homme motif', 0),
(348, 3, 't-shirt homme pas cher', 0),
(349, 3, 't humour shirt homme home', 0),
(350, 3, 't humour shirt homme less', 0),
(351, 3, 't homme shirt humour ivoirien', 0),
(352, 3, 't homme shirt humour et blague', 0),
(353, 3, 't shirt homme humour francais', 0),
(354, 3, 't shirt homme humour africain', 0),
(355, 3, 't-shirt humour homme', 0),
(356, 3, 't shirt humour hommes', 0),
(357, 3, 't homme humour shirts', 0),
(358, 3, 't shirt homme humorous', 0),
(359, 3, 't shirt homme humorous quotes', 0),
(360, 3, 't-shirt homme humour', 0),
(361, 3, 't shirt homme humoristique', 0),
(362, 3, 't-shirt homme humour pas cher', 0),
(363, 3, 't shirt homme humour alcool', 0),
(364, 3, 't homme humour shirt dress', 0),
(365, 3, 't homme humour shirt design', 0),
(366, 3, 't homme humour shirt collar', 0),
(367, 3, 't homme humour shirt woot', 0),
(368, 3, 't-shirt humour', 0),
(369, 3, 't homme shirt humour noir', 0),
(370, 3, 't homme shirt humour meaning', 0),
(371, 3, 't homme humour shirt and tie', 0),
(372, 3, 't homme humour shirt folding', 0),
(373, 3, 't homme humour shirt stays', 0),
(374, 3, 't homme humour shirt maker', 0),
(375, 3, 't homme humour shirt size', 0),
(376, 3, 't homme humour shirt template', 0),
(377, 3, 't humour shirt homme meaning', 0),
(378, 3, 't humour homme shirts', 0),
(379, 3, 'shirt humour t homme prehistorique', 0),
(380, 3, 'shirt humour t homme fatale', 0),
(381, 3, 'shirt humour t homme meaning', 0),
(382, 3, 'shirt humour homme triste', 0),
(383, 3, 'shirt humour homme translation', 0),
(384, 3, 'shirt humour t homme moderne', 0),
(385, 3, 'shirt humour t homme et femme', 0),
(386, 3, 'shirt humour t homme less', 0),
(387, 3, 'shirt humour t homme au', 0),
(388, 3, 'shirt humour t homme arbre', 0),
(389, 3, 'shirt humour t homme cologne', 0),
(390, 3, 'shirt humour homme taureau', 0),
(391, 3, 'shirt humour homme tabasse', 0),
(392, 3, 'shirt humour homme t-shirt rouge', 0),
(393, 3, 'shirt humour homme t-shirts', 0),
(394, 3, 'shirt t homme humorous quotes', 0),
(395, 3, 'shirt t homme humorous', 0),
(396, 3, 'shirt t homme humour africain', 0),
(397, 3, 'shirt humour homme t-shirt', 0),
(398, 3, 'shirt humour homme tahitien', 0),
(399, 3, 'shirt humour homme tronc', 0),
(400, 3, 'shirt humour homme tigre', 0),
(401, 3, 'shirt humour homme tunisien', 0),
(402, 3, 'shirt humour homme tout', 0),
(403, 3, 'shirt humour t homme home', 0),
(404, 3, 'shirt humour t-homme', 0),
(405, 3, 't humour homme shirt and tie', 0),
(406, 3, 't humour homme shirt folding', 0),
(407, 3, 't humour homme shirt woot', 0),
(408, 3, 't humour homme shirt collar', 0),
(409, 3, 'shirt homme humour togolais', 0),
(410, 3, 't humour homme shirt template', 0),
(411, 3, 't humour homme shirt size', 0),
(412, 3, 't humour homme shirt dress', 0),
(413, 3, 't humour homme shirt design', 0),
(414, 3, 't humour homme shirt stays', 0),
(415, 3, 't humour homme shirt maker', 0),
(416, 3, 'shirt homme humour tukulukat', 0),
(417, 3, 'shirt homme humor therapy', 0),
(418, 3, 'shirt homme t humorous', 0),
(419, 3, 'shirt homme t humorous quotes', 0),
(420, 3, 'shirt homme t humour africain', 0),
(421, 3, 'shirt homme t humour francais', 0),
(422, 3, 'shirt humour t hommelhof', 0),
(423, 3, 'shirt homme humour teaching', 0),
(424, 3, 'shirt homme humour tachlhit', 0),
(425, 3, 'shirt homme humour travail', 0),
(426, 3, 'shirt homme humour transpiration', 0),
(427, 3, 'shirt homme humour translation', 0),
(428, 3, 'shirt homme humour texts', 0),
(429, 3, 'shirt t homme humour francais', 1);

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id_page` int(11) NOT NULL AUTO_INCREMENT,
  `id_site` int(11) NOT NULL,
  `type_page` text NOT NULL,
  `url` text NOT NULL,
  PRIMARY KEY (`id_page`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `pages`
--

INSERT INTO `pages` (`id_page`, `id_site`, `type_page`, `url`) VALUES
(1, 0, 'Produits', 'http://mypresta/robes-ete/8-test.html'),
(2, 0, 'Produits', 'http://mypresta/robes-ete/9-test.html'),
(3, 0, 'Produits', 'http://mypresta/t-shirts/11-test.html'),
(4, 0, 'Produits', 'http://mypresta/robes-ete/10-test.html'),
(5, 0, 'Categories', 'http://mypresta/8-robes'),
(6, 0, 'Categories', 'http://mypresta/7-chemisiers'),
(7, 0, 'Categories', 'http://mypresta/9-robes-decontractees'),
(8, 0, 'Categories', 'http://mypresta/10-robes-soiree'),
(9, 0, 'Categories', 'http://mypresta/5-t-shirts'),
(10, 0, 'Produits', 'http://mypresta/t-shirts/12-test.html'),
(11, 0, 'Categories', 'http://mypresta/3-blouse-blanche');

-- --------------------------------------------------------

--
-- Structure de la table `sites`
--

CREATE TABLE IF NOT EXISTS `sites` (
  `id_site` int(11) NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  `hash` text NOT NULL,
  PRIMARY KEY (`id_site`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
