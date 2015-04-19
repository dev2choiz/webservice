-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 19 Avril 2015 à 20:54
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `fourneaux`
--
CREATE DATABASE IF NOT EXISTS `fourneaux` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `fourneaux`;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id_cat` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_cat`),
  KEY `id_cat` (`id_cat`),
  KEY `value` (`value`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id_cat`, `value`, `img`) VALUES
(1, 'Cuisine du monde', 'categorie/Cuisine du monde.jpg'),
(2, 'Cuisine authentique', 'categorie/authentique.jpg'),
(3, 'Santé', 'categorie/sante.png'),
(4, 'Végétarienne', 'categorie/vegetarienne.jpg'),
(6, 'Viande', 'categorie/viande.jpg'),
(9, 'Poissons', 'categorie/poissons.jpg'),
(15, 'nouvelle valeur de la cat', 'catImg2');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `id_com` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `note` int(11) NOT NULL,
  `id_recette` mediumint(8) unsigned NOT NULL,
  `id_user` mediumint(8) unsigned NOT NULL,
  `update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_com`),
  KEY `id_recette` (`id_recette`),
  KEY `id_user` (`id_user`),
  KEY `id_recette_2` (`id_recette`),
  KEY `id_user_2` (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=53 ;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`id_com`, `value`, `note`, `id_recette`, `id_user`, `update`) VALUES
(1, 'Je suis le premier commentaire', 0, 12, 13, '2015-04-19 08:59:36'),
(2, 'nouvelle valeur du commentaire avec id=2', 0, 12, 13, '2015-04-19 09:05:49'),
(3, '<p>Un commentaire</p>', 0, 12, 13, '2015-03-17 00:06:37'),
(46, '<p>nouveau com</p>', 1, 13, 13, '2015-04-19 14:13:06'),
(7, '<p>coucou2</p>', 0, 13, 13, '2015-03-17 00:06:37'),
(8, '<p>coucou2</p>', 0, 13, 13, '2015-03-17 00:06:37'),
(9, '<p>Trop bien yeaaaaah</p>', 0, 43, 13, '2015-03-17 00:06:37'),
(10, '<p>Un commentaire pp</p>', 0, 43, 13, '2015-03-17 00:06:37'),
(11, '<p>Un commentaire pp</p>', 0, 43, 13, '2015-03-17 00:06:37'),
(12, '<p>Hum que &ccedil;a a l''air app&eacute;tissant&nbsp;<img src="../../Library/TinyMCE/tinymce/plugins/emoticons/img/smiley-kiss.gif" alt="kiss" /></p>', 0, 44, 13, '2015-03-17 00:06:37'),
(13, '<p>Bon, je vais ajouter d''autres comm pour voir</p>', 0, 44, 13, '2015-03-17 00:24:09'),
(14, '<p>Bon, je vais ajouter d''autres comm pour voir</p>', 0, 44, 13, '2015-03-17 00:24:17'),
(15, '<p>Bon, je vais ajouter d''autres comm pour voir</p>', 0, 44, 13, '2015-03-17 00:24:50'),
(16, '<p>eh bien</p>', 5, 44, 13, '2015-03-17 00:28:03'),
(17, '<p>coucoucou</p>', 4, 44, 13, '2015-03-18 11:15:44'),
(18, '<p>coucoucou</p>', 4, 44, 13, '2015-03-18 11:15:51'),
(19, '<p><img src="../../Library/TinyMCE/tinymce/plugins/emoticons/img/smiley-embarassed.gif" alt="embarassed" /><img src="../../Library/TinyMCE/tinymce/plugins/emoticons/img/smiley-innocent.gif" alt="innocent" /><img src="../../Library/TinyMCE/tinymce/plugins/emoticons/img/smiley-frown.gif" alt="frown" /><img src="../../Library/TinyMCE/tinymce/plugins/emoticons/img/smiley-cool.gif" alt="cool" /><img src="../../Library/TinyMCE/tinymce/plugins/emoticons/img/smiley-cry.gif" alt="cry" /></p>', 1, 44, 13, '2015-03-18 11:18:42'),
(20, '<p>Coucou</p>', 5, 44, 13, '2015-03-23 20:58:20'),
(21, '<h3>Le passage de Lorem Ipsum standard, utilis&eacute; depuis 1500</h3>\n<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>\n<h3>Section 1.10.32 du "De Finibus Bonorum et Malorum" de Ciceron (45 av. J.-C.)</h3>\n<p>"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"</p>\n<h3>Traduction de H. Rackham (1914)</h3>\n<p>"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"</p>\n<h3>Section 1.10.33 du "De Finibus Bonorum et Malorum" de Ciceron (45 av. J.-C.)</h3>\n<p>"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat."</p>\n<h3>Traduction de H. Rackham (1914)</h3>\n<p>"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains."</p>', 5, 44, 13, '2015-03-24 23:14:13'),
(22, '<p>Parce que je suis contente</p>', 5, 51, 13, '2015-03-28 18:44:37'),
(23, '<p>Alors</p>', 5, 51, 13, '2015-03-28 18:46:39'),
(24, '<p>Alors 2</p>', 1, 51, 13, '2015-03-28 18:51:53'),
(25, 'jkmjkj', 1, 44, 13, '2015-04-11 15:35:16'),
(26, 'jkmjkjokùolk', 3, 44, 13, '2015-04-11 15:35:33'),
(27, 'jgfklgh', 0, 44, 13, '2015-04-11 17:48:21'),
(28, 'ghg', 0, 37, 13, '2015-04-12 00:05:31'),
(29, 'dvmjkj', 0, 37, 13, '2015-04-12 05:29:50'),
(30, 'dvmjkj', 0, 37, 13, '2015-04-12 05:30:14'),
(31, 'dvmjkj', 0, 37, 13, '2015-04-12 05:30:39'),
(32, 'fgsb', 0, 37, 13, '2015-04-12 05:31:38'),
(33, 'pjkmj', 0, 37, 13, '2015-04-12 05:33:31'),
(34, 'jmkjk', 0, 37, 13, '2015-04-12 05:38:19'),
(35, 'vfùkvfkô k*^f*', 0, 37, 13, '2015-04-12 05:40:23'),
(36, 'ùkjk', 0, 37, 13, '2015-04-12 05:41:42'),
(37, 'jmkjk', 0, 37, 13, '2015-04-12 05:42:46'),
(38, 'kmjkmjk', 0, 37, 13, '2015-04-12 05:44:11'),
(39, 'kmjkmjk', 0, 37, 13, '2015-04-12 05:44:48'),
(40, 'klmjkjk km jk', 0, 37, 13, '2015-04-12 06:29:58'),
(41, 'mkjmkj jkjm', 0, 37, 13, '2015-04-12 06:30:50'),
(42, 'mkjmkj jkjm', 0, 37, 13, '2015-04-12 06:42:59'),
(43, 'klmùkl', 0, 37, 13, '2015-04-12 06:59:10'),
(44, 'hljjlh', 0, 37, 13, '2015-04-12 07:11:07'),
(45, 'nouveau commentaire de l''insert de JMeter', 0, 44, 13, '2015-04-19 09:04:59'),
(47, '<p>nouveau com2</p>', 1, 13, 13, '2015-04-19 14:13:44'),
(48, '<p>nouveau com3</p>', 1, 13, 13, '2015-04-19 14:23:04'),
(49, '<p>nouveau com3 com ocom</p>', 1, 13, 13, '2015-04-19 14:30:07'),
(50, '<p>nouveau com3 com ocom2323</p>', 1, 13, 13, '2015-04-19 14:33:47'),
(51, '<p>dslhdgfsjljqg</p>', 1, 13, 13, '2015-04-19 14:59:50'),
(52, '<p>mon commefdqsfdmk</p>', 1, 13, 13, '2015-04-19 15:00:47');

-- --------------------------------------------------------

--
-- Structure de la table `ingredients`
--

CREATE TABLE IF NOT EXISTS `ingredients` (
  `id_ingredient` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_ingredient`),
  UNIQUE KEY `value` (`value`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Contenu de la table `ingredients`
--

INSERT INTO `ingredients` (`id_ingredient`, `value`) VALUES
(4, 'canelle'),
(2, 'carottes'),
(5, 'chocolat'),
(18, 'citron'),
(7, 'farine'),
(13, 'gingembre'),
(6, 'lait'),
(8, 'oeufs'),
(17, 'Poire'),
(11, 'poivrons'),
(9, 'poulet'),
(12, 'riz'),
(3, 'Sucre'),
(1, 'tomates'),
(19, 'new valued');

-- --------------------------------------------------------

--
-- Structure de la table `liste_categorie`
--

CREATE TABLE IF NOT EXISTS `liste_categorie` (
  `id_liste_categorie` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `id_recette` mediumint(8) unsigned NOT NULL,
  `id_cat` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id_liste_categorie`),
  KEY `id_recette` (`id_recette`,`id_cat`),
  KEY `id_categorie` (`id_cat`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `liste_ingredients`
--

CREATE TABLE IF NOT EXISTS `liste_ingredients` (
  `id_liste` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_recette` mediumint(8) unsigned NOT NULL,
  `id_ingredient` mediumint(8) unsigned NOT NULL,
  `id_unite` tinyint(3) unsigned DEFAULT NULL,
  `value` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_liste`),
  KEY `id_recette` (`id_recette`),
  KEY `id_ingredient` (`id_ingredient`),
  KEY `id_unite` (`id_unite`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=48 ;

--
-- Contenu de la table `liste_ingredients`
--

INSERT INTO `liste_ingredients` (`id_liste`, `id_recette`, `id_ingredient`, `id_unite`, `value`) VALUES
(6, 13, 1, 1, 45),
(23, 43, 4, 2, 30),
(24, 43, 17, 2, 10),
(25, 44, 8, 2, 2),
(26, 44, 3, 2, 120),
(27, 49, 2, 1, 1),
(47, 50, 13, 8, 3),
(37, 12, 1, 2, 0),
(38, 12, 2, 2, 23),
(39, 12, 18, 9, 1),
(46, 50, 18, 3, 5);

-- --------------------------------------------------------

--
-- Structure de la table `liste_produits`
--

CREATE TABLE IF NOT EXISTS `liste_produits` (
  `id_liste_produits` mediumint(9) NOT NULL AUTO_INCREMENT,
  `id_produit` mediumint(8) unsigned NOT NULL,
  `id_recette` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id_liste_produits`),
  KEY `id_produit` (`id_produit`),
  KEY `id_recette` (`id_recette`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Contenu de la table `liste_produits`
--

INSERT INTO `liste_produits` (`id_liste_produits`, `id_produit`, `id_recette`) VALUES
(2, 2, 12),
(3, 1, 44),
(4, 2, 44),
(5, 3, 44),
(6, 1, 12),
(7, 3, 12),
(8, 1, 13),
(9, 4, 13),
(11, 41, 13),
(12, 1, 49),
(14, 6, 49),
(15, 1, 50);

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE IF NOT EXISTS `livre` (
  `id_livre` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prix` smallint(6) NOT NULL,
  PRIMARY KEY (`id_livre`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `livre`
--

INSERT INTO `livre` (`id_livre`, `value`, `prix`) VALUES
(1, 'Les petits plats de maman', 50);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `id_note` int(11) NOT NULL AUTO_INCREMENT,
  `value` enum('1','2','3','4','5') COLLATE utf8_unicode_ci NOT NULL,
  `id_recette` mediumint(8) unsigned NOT NULL,
  `id_user` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id_note`),
  KEY `id_recette` (`id_recette`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `note`
--

INSERT INTO `note` (`id_note`, `value`, `id_recette`, `id_user`) VALUES
(1, '5', 12, 0),
(2, '5', 13, 0),
(3, '1', 44, 13),
(4, '4', 37, 13),
(5, '3', 12, 13);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE IF NOT EXISTS `panier` (
  `id_panier` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `id_recette` mediumint(8) unsigned NOT NULL,
  `id_user` mediumint(8) unsigned NOT NULL,
  `id_produit` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id_panier`),
  KEY `id_panier` (`id_panier`,`id_recette`,`id_user`,`id_produit`),
  KEY `id_recette` (`id_recette`),
  KEY `id_user` (`id_user`),
  KEY `id_produit` (`id_produit`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=69 ;

--
-- Contenu de la table `panier`
--

INSERT INTO `panier` (`id_panier`, `id_recette`, `id_user`, `id_produit`) VALUES
(45, 0, 13, 2),
(53, 0, 13, 4),
(54, 0, 13, 1),
(58, 0, 13, 3),
(60, 0, 1, 1),
(61, 0, 1, 1),
(62, 0, 1, 4),
(63, 0, 13, 4);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `prix` smallint(4) NOT NULL,
  `ref` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `top` enum('0','1','2','3') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_produit`),
  UNIQUE KEY `ref` (`ref`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=64 ;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `value`, `img`, `prix`, `ref`, `top`) VALUES
(1, 'cnewvalue', '/img/produit/poele.png', 0, 'F000PP99', '1'),
(2, 'Crépière', '/img/produit/crepiere.png', 70, 'TTTTRRFF', '3'),
(3, 'Liquide vaisselle', '/img/produit/liquidevaisselle.png', 2, 'FFT0RR', '2'),
(4, 'Fouet', '/img/produit/fouet.png', 50, 'HHHRT', '0'),
(5, 'Fourneaux', '/img/produit/fourneaux.png', 127, 'FFFEZD00', '0'),
(6, 'Théière', '/img/produit/theiere.png', 20, 'RRTTF', '0'),
(41, 'Casserole', '/img/produit/casserole.png', 456, 'GTED', '0'),
(62, 'sdfgsz', '', 1223, 'DSF', '0');

-- --------------------------------------------------------

--
-- Structure de la table `questionsecrete`
--

CREATE TABLE IF NOT EXISTS `questionsecrete` (
  `id_questionsecrete` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_questionsecrete`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `questionsecrete`
--

INSERT INTO `questionsecrete` (`id_questionsecrete`, `value`) VALUES
(1, 'nouvelle valeur de la question'),
(2, 'question2'),
(3, 'question3'),
(4, 'question4'),
(5, 'question5'),
(7, 'Quelle est le pr?nom de votre arriere grand m?re');

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

CREATE TABLE IF NOT EXISTS `recette` (
  `id_recette` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `value` text NOT NULL,
  `tps_cuisson` int(11) NOT NULL,
  `cout` int(11) NOT NULL,
  `difficulte` int(11) NOT NULL,
  `type` enum('entrée','plat','dessert','') NOT NULL,
  `chef` tinyint(1) NOT NULL,
  `diabete` tinyint(1) NOT NULL,
  `ble` tinyint(1) NOT NULL,
  `lait` tinyint(1) NOT NULL,
  `oeuf` tinyint(1) NOT NULL,
  `arachide` tinyint(1) NOT NULL,
  `soja` tinyint(1) NOT NULL,
  `gluten` tinyint(1) NOT NULL,
  `id_user` mediumint(8) unsigned NOT NULL,
  `id_cat` tinyint(4) unsigned NOT NULL,
  `id_livre` mediumint(8) unsigned NOT NULL,
  `id_resto` mediumint(8) unsigned NOT NULL,
  `top` enum('0','1','2','3') NOT NULL,
  PRIMARY KEY (`id_recette`),
  UNIQUE KEY `titre` (`titre`),
  KEY `id_user` (`id_user`),
  KEY `id_cat` (`id_cat`),
  KEY `id_livre` (`id_livre`),
  KEY `id_resto` (`id_resto`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- Contenu de la table `recette`
--

INSERT INTO `recette` (`id_recette`, `titre`, `img`, `value`, `tps_cuisson`, `cout`, `difficulte`, `type`, `chef`, `diabete`, `ble`, `lait`, `oeuf`, `arachide`, `soja`, `gluten`, `id_user`, `id_cat`, `id_livre`, `id_resto`, `top`) VALUES
(12, 'Tarte aux citrons', 'Tarte aux citrons.jpg', '<p><strong>P&acirc;te sabl&eacute;e aux noisettes :</strong></p>\r\n<p>Mettre le tout dans un bol. Mixer jusqu''&agrave; boule homog&egrave;ne. Vider sur une feuille de papier sulfuris&eacute; et frigo pendant 15 mn (la p&acirc;te est tr&egrave;s collante). Sortir et aplatir un peu &agrave; la main, recouvrir d''une 2&egrave;me feuille de papier sulfuris&eacute;, aplatir au rouleau dimension moule. Enlever feuille du dessus et cuire &agrave; four chaud 200&deg; pendant environ 10 mn.</p>\r\n<p><strong>Cr&egrave;me au citron :</strong></p>\r\n<p>Casserole !!! Fouetter jaunes et sucre jusqu''&agrave; blanchiment Fondre le beurre dans jus de citron, laisser refroidir pour ajouter la ma&iuml;zena et bien remuer pour homog&eacute;n&eacute;iser. Verser beurre/citron progressivement dans les jaunes en continuant de bien m&eacute;langer. Porter le tout &agrave; petit feu et tourner jusqu''a &eacute;paississement. Verser sur fond de tarte cuite et r&eacute;partir &agrave; la spatule.</p>\r\n<p><strong>Cr&egrave;me meringu&eacute;e :</strong></p>\r\n<p>Battre les blancs en neige tr&egrave;s ferme et ajouter le sucre, rebattre environ 3mn. Verser sur la tarte et former des piques avec une fourchette. Mettre 10 mn au four.</p>\r\n<p>&nbsp;</p>', 1, 5, 5, 'dessert', 0, 0, 1, 1, 1, 1, 0, 0, 13, 2, 1, 1, '3'),
(13, 'Cotelette de veau', '', '<p>1 -A pinc&eacute;e de sel</p>', 40, 40, 5, 'plat', 0, 0, 0, 0, 0, 0, 0, 0, 13, 3, 1, 1, '0'),
(37, 'Tarte à la fraise', '/fourneaux/Public/img/37image000.jpg', '<p>dgsrh</p>', 0, 0, 1, 'entrée', 0, 0, 0, 0, 0, 0, 0, 0, 13, 1, 1, 1, '0'),
(43, 'Gateaux aux poires', '/fourneaux/Public/img/43CIMG4392.JPG', '<p>coucou</p>', 30, 10, 2, 'dessert', 1, 0, 1, 1, 1, 1, 0, 1, 13, 3, 1, 1, '2'),
(44, 'Cupcake', '44cupcake.jpg', '<h4>Pr&eacute;paration de la recette :</h4>\r\n<p><br />Pr&eacute;chauffer votre four &agrave; 200&deg;C (thermostat 6).<br /><br />Faire fondre le beurre puis l''ajouter au sucre dans un saladier.<br /><br />Ajouter les &oelig;ufs puis la farine, le bicarbonate et la levure. Bien m&eacute;langer le tout pour &eacute;viter les grumeaux.<br /><br />Ajouter le lait et la vanille.<br /><br />Remplir les moules &agrave; cupcakes au 3/4. (En cas de moules papier : les disposer dans un ramequin ou autre pour &eacute;viter qu''ils ne s&rsquo;aplatissent.)<br /><br />Enfourner pendant 20 min &agrave; 200&deg;C.<br /><br />Laisser refroidir sans d&eacute;mouler.<br /><br />Quand les cupcakes sont bien refroidis, pr&eacute;parer la cr&egrave;me beurre:<br /><br />Battre avec un fouet (&eacute;lectrique ou non) pendant 3 &agrave; 5 min, le beurre mou et le sucre glace.<br /><br />Ajouter du lait + ou - selon la consistance. La cr&egrave;me ne doit pas &ecirc;tre trop liquide ni trop compacte afin d''avoir la consistance id&eacute;ale pour la poche &agrave; douille.<br /><br />D&eacute;corer vos cupcakes avec la cr&egrave;me au beurre et une poche &agrave; douille (pour faire plus joli) : Astuce, si vous n''avez pas de poche &agrave; douille, prenez un petit sachet de cong&eacute;lation&nbsp;dont vous aurez coup&eacute; un tout petit peu de l''un de ses coins !<br /><br />Pour colorer la cr&egrave;me au beurre : colorant alimentaire ou chocolat en poudre, sirop de menthe, grenadine... D&eacute;coration : p&eacute;pites de chocolats, vermicelles, sucres rigolos et tout ce que vous imaginez d''autres...</p>', 35, 10, 3, 'dessert', 1, 0, 1, 1, 1, 1, 0, 0, 13, 2, 1, 1, '1'),
(45, 'TTTT', '/fourneaux/Public/img/45exo2.png', '<blockquote>\r\n<p><img src="../Library/TinyMCE/tinymce/plugins/emoticons/img/smiley-kiss.gif" alt="kiss" />&nbsp;10:31:47 <strong>coucocuo</strong></p>\r\n</blockquote>', 334, 0, 1, 'entrée', 0, 0, 0, 0, 0, 0, 0, 0, 13, 1, 1, 1, '0'),
(49, 'Poivrons farcis', '', '<p>Poivrons</p>', 1, 40, 1, 'plat', 0, 0, 0, 0, 1, 1, 0, 1, 13, 6, 1, 1, '0'),
(50, 'frites', '/img/50CIMG4015.JPG', '<p>sfzef</p>', 0, 0, 2, 'dessert', 0, 0, 0, 0, 0, 0, 0, 0, 13, 1, 1, 1, '0'),
(53, 'djfj', '/img/53Marcus-Fenix.jpg', '<p>sjjm</p>', 23, 22, 1, 'entrée', 0, 0, 1, 0, 1, 0, 0, 0, 13, 1, 1, 1, '0');

-- --------------------------------------------------------

--
-- Structure de la table `restaurant`
--

CREATE TABLE IF NOT EXISTS `restaurant` (
  `id_resto` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `chef` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prix_moyen` smallint(6) NOT NULL,
  PRIMARY KEY (`id_resto`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `restaurant`
--

INSERT INTO `restaurant` (`id_resto`, `value`, `chef`, `prix_moyen`) VALUES
(1, 'Les petits plats de Samyn', 'Samyn', 4);

-- --------------------------------------------------------

--
-- Structure de la table `unite`
--

CREATE TABLE IF NOT EXISTS `unite` (
  `id_unite` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_unite`),
  UNIQUE KEY `value` (`value`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Contenu de la table `unite`
--

INSERT INTO `unite` (`id_unite`, `value`) VALUES
(9, ''),
(5, 'cL'),
(3, 'cuillère à café'),
(8, 'Cuillère à soupe'),
(6, 'dL'),
(2, 'g'),
(1, 'Kg'),
(7, 'L'),
(4, 'Sachet');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pseudo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `date_naissance` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `socio_eco` enum('Professions libérales, techniciens et assimilés','Cadres administratifs supérieurs','Employés de bureaux','Vendeurs','Agriculteurs exploitants','Ouvriers agricoles','Travailleurs dans les transports et les services','Artisans','Population active non classée ailleurs','Inactifs') COLLATE utf8_unicode_ci NOT NULL,
  `nb_enfants` enum('0','1','2','3','4','5 et +') COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('admin','membre','premium','') COLLATE utf8_unicode_ci NOT NULL,
  `update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reponsesecrete` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_questionsecrete` mediumint(9) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `nom`, `prenom`, `pseudo`, `mail`, `password`, `date_naissance`, `socio_eco`, `nb_enfants`, `role`, `update`, `reponsesecrete`, `id_questionsecrete`) VALUES
(1, 'Bacchus', 'Sam', 'Sublime', 'mail1@gmail.com', 'b4136225ae3ffed43874cec08fcf7330', '0000-00-00', 'Professions libérales, techniciens et assimilés', '', 'admin', '2015-03-29 11:05:13', 'mareponse', 2),
(13, 'MELHEM', 'Na', 'Na', 'mail1@hotmail.com', 'b4136225ae3ffed43874cec08fcf7330', '0000-00-00', 'Professions libérales, techniciens et assimilés', '', 'admin', '2015-04-19 18:02:18', 'mareponse', 3),
(14, 'naila', 'MELHEM', 'nmelhem', 'naila@melhem.com', 'naila', '0000-00-00', 'Employés de bureaux', '0', 'membre', '2015-02-09 00:45:20', '', 0),
(16, 'Naïlaa', 'Melhem', 'NaÏl', 'naila@gmail.com', 'f79358c3dd429d651875b3ca72e908b2', '0000-00-00', 'Professions libérales, techniciens et assimilés', '0', 'membre', '2015-02-22 14:21:16', '', 0),
(22, 'stark', 'arya', 'arry', 'arya@hotmail.comm', 'b4136225ae3ffed43874cec08fcf7330', '1957/02/30', 'Professions libérales, techniciens et assimilés', '0', 'membre', '2015-04-18 15:56:17', '', 0),
(19, 'Jacky', 'Chan', 'Jacky', 'jacky@kija.com', 'b4136225ae3ffed43874cec08fcf7330', '0000-00-00', 'Professions libérales, techniciens et assimilés', '2', 'membre', '2015-04-18 18:34:31', 'mareponse', 4),
(21, 'stark', 'arya', 'arry', 'arya@hotmail.com', 'b4136225ae3ffed43874cec08fcf7330', '1957/02/30', 'Professions libérales, techniciens et assimilés', '0', 'membre', '2015-04-18 15:56:17', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `id_video` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `data` longblob NOT NULL,
  PRIMARY KEY (`id_video`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_categorie`
--
CREATE TABLE IF NOT EXISTS `view_categorie` (
`id_recette` mediumint(8) unsigned
,`titre` varchar(50)
,`type` enum('entrée','plat','dessert','')
,`id_cat` tinyint(4) unsigned
,`categorie` varchar(50)
,`img` varchar(1000)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_commentaire`
--
CREATE TABLE IF NOT EXISTS `view_commentaire` (
`id_com` mediumint(8) unsigned
,`value` text
,`note` int(11)
,`id_recette` mediumint(8) unsigned
,`id_user` mediumint(8) unsigned
,`update` timestamp
,`pseudo` varchar(50)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_liste_ingredients`
--
CREATE TABLE IF NOT EXISTS `view_liste_ingredients` (
`id_liste` int(10) unsigned
,`id_ingredient` mediumint(8) unsigned
,`id_recette` mediumint(8) unsigned
,`id_unite` tinyint(3) unsigned
,`value` tinyint(4)
,`recette` text
,`ingredients` varchar(100)
,`unite` varchar(50)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_liste_produits`
--
CREATE TABLE IF NOT EXISTS `view_liste_produits` (
`id_liste_produits` mediumint(9)
,`id_produit` mediumint(8) unsigned
,`id_recette` mediumint(8) unsigned
,`value_produit` varchar(100)
,`prix` smallint(4)
,`img` varchar(1000)
,`ref` varchar(10)
,`titre` varchar(50)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_panier`
--
CREATE TABLE IF NOT EXISTS `view_panier` (
`id_panier` mediumint(8) unsigned
,`id_recette` mediumint(8) unsigned
,`id_user` mediumint(8) unsigned
,`id_produit` mediumint(8) unsigned
,`titre_recette` varchar(50)
,`prenom_user` varchar(50)
,`mail_user` varchar(255)
,`value_produit` varchar(100)
,`img_produit` varchar(1000)
,`prix_produit` smallint(4)
,`ref_produit` varchar(10)
,`nom_user` varchar(50)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_recette`
--
CREATE TABLE IF NOT EXISTS `view_recette` (
`id_recette` mediumint(8) unsigned
,`top` enum('0','1','2','3')
,`titre` varchar(50)
,`img` varchar(1000)
,`value` text
,`tps_cuisson` int(11)
,`difficulte` int(11)
,`cout` int(11)
,`type` enum('entrée','plat','dessert','')
,`chef` tinyint(1)
,`diabete` tinyint(1)
,`ble` tinyint(1)
,`lait` tinyint(1)
,`oeuf` tinyint(1)
,`arachide` tinyint(1)
,`soja` tinyint(1)
,`gluten` tinyint(1)
,`note` enum('1','2','3','4','5')
,`user_pseudo` varchar(50)
,`id_cat` tinyint(4) unsigned
,`categorie` varchar(50)
,`livre` varchar(255)
,`livre_prix` smallint(6)
,`resto` varchar(150)
,`resto_chef` varchar(50)
,`resto_prix` smallint(6)
);
-- --------------------------------------------------------

--
-- Structure de la vue `view_categorie`
--
DROP TABLE IF EXISTS `view_categorie`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_categorie` AS select `recette`.`id_recette` AS `id_recette`,`recette`.`titre` AS `titre`,`recette`.`type` AS `type`,`categorie`.`id_cat` AS `id_cat`,`categorie`.`value` AS `categorie`,`categorie`.`img` AS `img` from (`categorie` left join `recette` on((`recette`.`id_cat` = `categorie`.`id_cat`)));

-- --------------------------------------------------------

--
-- Structure de la vue `view_commentaire`
--
DROP TABLE IF EXISTS `view_commentaire`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_commentaire` AS select `commentaire`.`id_com` AS `id_com`,`commentaire`.`value` AS `value`,`commentaire`.`note` AS `note`,`commentaire`.`id_recette` AS `id_recette`,`commentaire`.`id_user` AS `id_user`,`commentaire`.`update` AS `update`,`user`.`pseudo` AS `pseudo` from ((`commentaire` left join `recette` on((`commentaire`.`id_recette` = `recette`.`id_recette`))) left join `user` on((`commentaire`.`id_user` = `user`.`id_user`)));

-- --------------------------------------------------------

--
-- Structure de la vue `view_liste_ingredients`
--
DROP TABLE IF EXISTS `view_liste_ingredients`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_liste_ingredients` AS select `liste_ingredients`.`id_liste` AS `id_liste`,`ingredients`.`id_ingredient` AS `id_ingredient`,`recette`.`id_recette` AS `id_recette`,`unite`.`id_unite` AS `id_unite`,`liste_ingredients`.`value` AS `value`,`recette`.`value` AS `recette`,`ingredients`.`value` AS `ingredients`,`unite`.`value` AS `unite` from (((`liste_ingredients` left join `recette` on((`liste_ingredients`.`id_recette` = `recette`.`id_recette`))) left join `ingredients` on((`liste_ingredients`.`id_ingredient` = `ingredients`.`id_ingredient`))) left join `unite` on((`liste_ingredients`.`id_unite` = `unite`.`id_unite`)));

-- --------------------------------------------------------

--
-- Structure de la vue `view_liste_produits`
--
DROP TABLE IF EXISTS `view_liste_produits`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_liste_produits` AS select `liste_produits`.`id_liste_produits` AS `id_liste_produits`,`liste_produits`.`id_produit` AS `id_produit`,`liste_produits`.`id_recette` AS `id_recette`,`produit`.`value` AS `value_produit`,`produit`.`prix` AS `prix`,`produit`.`img` AS `img`,`produit`.`ref` AS `ref`,`recette`.`titre` AS `titre` from ((`liste_produits` left join `produit` on((`liste_produits`.`id_produit` = `produit`.`id_produit`))) left join `recette` on((`liste_produits`.`id_recette` = `recette`.`id_recette`)));

-- --------------------------------------------------------

--
-- Structure de la vue `view_panier`
--
DROP TABLE IF EXISTS `view_panier`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_panier` AS select `panier`.`id_panier` AS `id_panier`,`panier`.`id_recette` AS `id_recette`,`panier`.`id_user` AS `id_user`,`panier`.`id_produit` AS `id_produit`,`recette`.`titre` AS `titre_recette`,`user`.`prenom` AS `prenom_user`,`user`.`mail` AS `mail_user`,`produit`.`value` AS `value_produit`,`produit`.`img` AS `img_produit`,`produit`.`prix` AS `prix_produit`,`produit`.`ref` AS `ref_produit`,`user`.`nom` AS `nom_user` from (((`panier` left join `recette` on((`panier`.`id_recette` = `recette`.`id_recette`))) left join `user` on(((`panier`.`id_user` = `user`.`id_user`) and (`recette`.`id_user` = `user`.`id_user`)))) left join `produit` on((`panier`.`id_produit` = `produit`.`id_produit`)));

-- --------------------------------------------------------

--
-- Structure de la vue `view_recette`
--
DROP TABLE IF EXISTS `view_recette`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_recette` AS select `recette`.`id_recette` AS `id_recette`,`recette`.`top` AS `top`,`recette`.`titre` AS `titre`,`recette`.`img` AS `img`,`recette`.`value` AS `value`,`recette`.`tps_cuisson` AS `tps_cuisson`,`recette`.`difficulte` AS `difficulte`,`recette`.`cout` AS `cout`,`recette`.`type` AS `type`,`recette`.`chef` AS `chef`,`recette`.`diabete` AS `diabete`,`recette`.`ble` AS `ble`,`recette`.`lait` AS `lait`,`recette`.`oeuf` AS `oeuf`,`recette`.`arachide` AS `arachide`,`recette`.`soja` AS `soja`,`recette`.`gluten` AS `gluten`,`note`.`value` AS `note`,`user`.`pseudo` AS `user_pseudo`,`categorie`.`id_cat` AS `id_cat`,`categorie`.`value` AS `categorie`,`livre`.`value` AS `livre`,`livre`.`prix` AS `livre_prix`,`restaurant`.`value` AS `resto`,`restaurant`.`chef` AS `resto_chef`,`restaurant`.`prix_moyen` AS `resto_prix` from (((((`recette` left join `user` on((`recette`.`id_user` = `user`.`id_user`))) left join `categorie` on((`recette`.`id_cat` = `categorie`.`id_cat`))) left join `livre` on((`recette`.`id_livre` = `livre`.`id_livre`))) left join `restaurant` on((`recette`.`id_resto` = `restaurant`.`id_resto`))) left join `note` on((`recette`.`id_recette` = `note`.`id_recette`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
