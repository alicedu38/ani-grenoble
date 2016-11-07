-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 07 Novembre 2016 à 18:32
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `ani_grenoble`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE IF NOT EXISTS `annonce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` longtext COLLATE utf8_unicode_ci NOT NULL,
  `auteur` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `publie` tinyint(1) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F65593E53DA5256D` (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Contenu de la table `annonce`
--

INSERT INTO `annonce` (`id`, `titre`, `contenu`, `auteur`, `date`, `publie`, `image_id`) VALUES
(4, 'Réunion du 13/10/2016', 'Du coup, bilan de la réunion d''hier soir : \r\n- Handa kun\r\n- Keijo (ça je pense que tout le monde a retenu le titre XD)\r\n- Débat vite fait sur la 3D dans l''animation\r\n- Karaoké\r\n- Élections (de manière démocratique mdr) des membres du bureau, à savoir le Président Tom, le Vice-Président Maxime, le Trésorier Thibault et le Secrétaire Quentin', 'Alice', '2016-10-15', 1, 3),
(5, 'Concours de dessin de la mascotte d''Ani-grenoble', 'ANNONCE IMPORTANTE : concours de dessin pour désigner la mascotte de l''association ANI Grenoble.\r\nMagnifique affiche faite par Maxime qui réalise aussi celles de l''assos et qui sont toutes aussi splendides :)', 'Alice', '2016-10-22', 1, 4),
(6, 'Réunion du 18/10/2016', 'Bilan de ce soir :\r\n- Un-go\r\n- Berserk (1997)\r\n- Présentation très complète sur Berserk par Tom \r\n- Blindtest\r\nN''oubliez pas de participer au concours de dessin ainsi que de cotiser pour ceux qui veulent :)', 'Alice', '2016-10-22', 1, 5),
(7, 'Réunion du 20/09/2016', 'Bilan de la 1ère réunion qui s''est déroulée ce soir : \r\n- 1er ep de Danshi koukousei no nichijou\r\n- 1er ep de Black Lagoon\r\n- Blindtest normal\r\n- Quizz image\r\n- Time''s up\r\nDu coup, très bonne soirée en votre compagnie. Bien content qu''on soit plus d''une dizaine (espérons qu''on soit de plus en plus nombreux).', 'Alice', '2016-09-20', 1, 6),
(8, 'Réunion du 26/10/2016', 'Bilan de la réunion de ce soir : \r\n- Rokka no yuusha\r\n- Thunderbolt fantasy\r\n- Présentation de Valentin sur le jeu Bloodborne', 'Alice', '2016-10-26', 1, 7);

-- --------------------------------------------------------

--
-- Structure de la table `annonce_categorie`
--

CREATE TABLE IF NOT EXISTS `annonce_categorie` (
  `annonce_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  PRIMARY KEY (`annonce_id`,`categorie_id`),
  KEY `IDX_3C5A3DA68805AB2F` (`annonce_id`),
  KEY `IDX_3C5A3DA6BCF5E72D` (`categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `annonce_categorie`
--

INSERT INTO `annonce_categorie` (`annonce_id`, `categorie_id`) VALUES
(4, 2),
(5, 1),
(6, 2),
(7, 2),
(8, 2);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Evenement'),
(2, 'Reunion_hebdomadaire');

-- --------------------------------------------------------

--
-- Structure de la table `enquiry`
--

CREATE TABLE IF NOT EXISTS `enquiry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sujet` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `corps` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` longtext COLLATE utf8_unicode_ci,
  `alt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`id`, `url`, `alt`) VALUES
(3, 'uploads/img/handa-kun.jpg', '5sports.png'),
(4, 'uploads/img/ani-grenoble-concours-mascotte.jpg', 'mon image concours'),
(5, 'uploads/img/berserk.jpg', 'berserk.jpg'),
(6, 'uploads/img/Black lagoon.jpg', 'black lagoon'),
(7, 'uploads/img/rokka-no-yuusha.jpg', 'Rokka no yuusha');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1D1C63B392FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_1D1C63B3A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_1D1C63B3C05FB297` (`confirmation_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(15, 'superadmin', 'superadmin', 'superadmin@superadmin.fr', 'superadmin@superadmin.fr', 1, 'cqpt6ht8bbww0840cggok4wg0gw8k4o', 'sLxPvXpv93sQpNiRuzNXJzir4dxvcuCZJXhGMK2uhCuCr0a9awsFNIhWV79I7/jMCG0IXmGycHWo+NX1EJmMDQ==', '2016-10-30 23:01:26', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL),
(16, 'admin', 'admin', 'admin@admin.fr', 'admin@admin.fr', 1, 'q30kqwcase844ssokg00wc48o4ksoc0', 'mrk7DsH7S5KfdxUK+O5tVy4XeNr6wbZxzFfArW2ifvKe8HKSZ97eeQ7O/367wQ5xColMa6GZlKrfcz7XoG0H0g==', '2016-10-27 23:46:16', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `FK_F65593E53DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`);

--
-- Contraintes pour la table `annonce_categorie`
--
ALTER TABLE `annonce_categorie`
  ADD CONSTRAINT `FK_3C5A3DA68805AB2F` FOREIGN KEY (`annonce_id`) REFERENCES `annonce` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3C5A3DA6BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
