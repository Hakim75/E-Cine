-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 14 avr. 2020 à 10:03
-- Version du serveur :  5.7.24
-- Version de PHP :  5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ecine`
--

-- --------------------------------------------------------

--
-- Structure de la table `tj_abonnement_jab`
--

DROP TABLE IF EXISTS `tj_abonnement_jab`;
CREATE TABLE IF NOT EXISTS `tj_abonnement_jab` (
  `jab_id` int(11) NOT NULL AUTO_INCREMENT,
  `jab_iSta` int(11) DEFAULT NULL,
  `jab_dDateDeb` date DEFAULT NULL,
  `jab_dDateFin` date DEFAULT NULL,
  `usr_id` int(11) NOT NULL,
  `pta_id` int(11) NOT NULL,
  `adm_id` int(11) DEFAULT NULL,
  `jab_dDateResi` date DEFAULT NULL,
  PRIMARY KEY (`jab_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tj_abonnement_jab`
--

INSERT INTO `tj_abonnement_jab` (`jab_id`, `jab_iSta`, `jab_dDateDeb`, `jab_dDateFin`, `usr_id`, `pta_id`, `adm_id`, `jab_dDateResi`) VALUES
(1, 1, '2020-04-12', '2020-04-11', 1, 1, NULL, NULL),
(2, 1, '2020-04-12', '2020-05-12', 1, 1, NULL, NULL),
(4, 1, '2020-04-13', '2021-04-13', 3, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tj_avis_jav`
--

DROP TABLE IF EXISTS `tj_avis_jav`;
CREATE TABLE IF NOT EXISTS `tj_avis_jav` (
  `jav_id` int(11) NOT NULL AUTO_INCREMENT,
  `jav_sContenu` text NOT NULL,
  `jav_iEtoile` int(11) NOT NULL,
  `jav_dDate` date NOT NULL,
  `usr_id` int(11) NOT NULL,
  `vid_id` int(11) NOT NULL,
  PRIMARY KEY (`jav_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `tj_preferences_jpr`
--

DROP TABLE IF EXISTS `tj_preferences_jpr`;
CREATE TABLE IF NOT EXISTS `tj_preferences_jpr` (
  `jpr_id` int(11) NOT NULL AUTO_INCREMENT,
  `jpr_iSta` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL,
  `vid_id` int(11) NOT NULL,
  PRIMARY KEY (`jpr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tj_preferences_jpr`
--

INSERT INTO `tj_preferences_jpr` (`jpr_id`, `jpr_iSta`, `usr_id`, `vid_id`) VALUES
(1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `tj_videos_categorie_vic`
--

DROP TABLE IF EXISTS `tj_videos_categorie_vic`;
CREATE TABLE IF NOT EXISTS `tj_videos_categorie_vic` (
  `vic_id` int(11) NOT NULL AUTO_INCREMENT,
  `vid_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`vic_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tj_videos_categorie_vic`
--

INSERT INTO `tj_videos_categorie_vic` (`vic_id`, `vid_id`, `cat_id`) VALUES
(1, 1, 4),
(15, 3, 4),
(14, 2, 3),
(13, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `tj_vue_video_jvv`
--

DROP TABLE IF EXISTS `tj_vue_video_jvv`;
CREATE TABLE IF NOT EXISTS `tj_vue_video_jvv` (
  `jvv_id` int(11) NOT NULL AUTO_INCREMENT,
  `jvv_dDate` date NOT NULL,
  `usr_id` int(11) NOT NULL,
  `vid_id` int(11) NOT NULL,
  PRIMARY KEY (`jvv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tj_vue_video_jvv`
--

INSERT INTO `tj_vue_video_jvv` (`jvv_id`, `jvv_dDate`, `usr_id`, `vid_id`) VALUES
(1, '2020-04-12', 1, 2),
(2, '2020-04-11', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_admin_adm`
--

DROP TABLE IF EXISTS `t_admin_adm`;
CREATE TABLE IF NOT EXISTS `t_admin_adm` (
  `adm_id` int(11) NOT NULL AUTO_INCREMENT,
  `adm_iSta` int(11) NOT NULL,
  `adm_sNom` varchar(255) NOT NULL,
  `adm_sPrenom` varchar(255) DEFAULT NULL,
  `adm_sEmail` varchar(255) NOT NULL,
  `adm_sPass` varchar(255) NOT NULL,
  `adm_sPseudo` varchar(255) NOT NULL,
  `adm_iRole` int(11) NOT NULL,
  `adm_sPhoto` varchar(255) DEFAULT NULL,
  `adm_dDateAjout` date NOT NULL,
  PRIMARY KEY (`adm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_admin_adm`
--

INSERT INTO `t_admin_adm` (`adm_id`, `adm_iSta`, `adm_sNom`, `adm_sPrenom`, `adm_sEmail`, `adm_sPass`, `adm_sPseudo`, `adm_iRole`, `adm_sPhoto`, `adm_dDateAjout`) VALUES
(1, 1, 'admin', 'Principal', 'admin@hetic.net', 'f4af5c548220efbf7ecf45f4e7eff9594828a1c1c4daa729a8dc17098331da42fca157d7818301e6f09ea2d12d72faa95413a168ed5c22abe1aebb456a2fd6e9', 'admin', 0, NULL, '2020-04-09'),
(2, 1, 'Calou', 'Bastien', 'bastien.calou@hetic.net', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', ' ', 1, 'assets/img/avatar/avatar.png', '2020-04-10');

-- --------------------------------------------------------

--
-- Structure de la table `t_banner_ban`
--

DROP TABLE IF EXISTS `t_banner_ban`;
CREATE TABLE IF NOT EXISTS `t_banner_ban` (
  `ban_id` int(11) NOT NULL AUTO_INCREMENT,
  `ban_iOrder` int(11) NOT NULL,
  `ban_sBackground` varchar(255) NOT NULL,
  `ban_sPromo` varchar(255) NOT NULL,
  `vid_id` int(11) NOT NULL,
  PRIMARY KEY (`ban_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_banner_ban`
--

INSERT INTO `t_banner_ban` (`ban_id`, `ban_iOrder`, `ban_sBackground`, `ban_sPromo`, `vid_id`) VALUES
(1, 2, 'assets/media/film/banner/skate-board_1586713636.jpg', 'Une nouvelle sensation', 1),
(2, 1, 'assets/media/serie/banner/casa-de-papel_1586713931.png', 'Nouvelle saison casa de papel, trop chaude', 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_categorie_cat`
--

DROP TABLE IF EXISTS `t_categorie_cat`;
CREATE TABLE IF NOT EXISTS `t_categorie_cat` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_sLib` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_categorie_cat`
--

INSERT INTO `t_categorie_cat` (`cat_id`, `cat_sLib`) VALUES
(2, 'variete'),
(3, 'horreur'),
(4, 'documentaire');

-- --------------------------------------------------------

--
-- Structure de la table `t_episode_epi`
--

DROP TABLE IF EXISTS `t_episode_epi`;
CREATE TABLE IF NOT EXISTS `t_episode_epi` (
  `epi_id` int(11) NOT NULL AUTO_INCREMENT,
  `epi_iSta` int(11) NOT NULL,
  `epi_sTitre` varchar(255) DEFAULT NULL,
  `epi_sVideo` varchar(255) NOT NULL,
  `epi_iNum` int(11) NOT NULL,
  `epi_dDateSor` date NOT NULL,
  `epi_dDateAjout` date NOT NULL,
  `epi_sDescriptif` text,
  `adm_id` int(11) NOT NULL,
  `san_id` int(11) NOT NULL,
  PRIMARY KEY (`epi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_episode_epi`
--

INSERT INTO `t_episode_epi` (`epi_id`, `epi_iSta`, `epi_sTitre`, `epi_sVideo`, `epi_iNum`, `epi_dDateSor`, `epi_dDateAjout`, `epi_sDescriptif`, `adm_id`, `san_id`) VALUES
(1, 1, 'l\'entrée en scène', 'assets/media/serie/video/l-entree_1586618363.mp4', 1, '2015-02-23', '2020-04-11', 'c\'est marrant le mec avec les boules sur', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_plan_tarifaire_pta`
--

DROP TABLE IF EXISTS `t_plan_tarifaire_pta`;
CREATE TABLE IF NOT EXISTS `t_plan_tarifaire_pta` (
  `pta_id` int(11) NOT NULL AUTO_INCREMENT,
  `pta_iSta` int(11) NOT NULL,
  `pta_sLibelle` varchar(255) NOT NULL,
  `pta_iPrix` float NOT NULL,
  `pta_sAvantage` text NOT NULL,
  `pta_iDuree` int(11) NOT NULL,
  PRIMARY KEY (`pta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_plan_tarifaire_pta`
--

INSERT INTO `t_plan_tarifaire_pta` (`pta_id`, `pta_iSta`, `pta_sLibelle`, `pta_iPrix`, `pta_sAvantage`, `pta_iDuree`) VALUES
(1, 1, 'bronze', 12, '- Accès à tous les programmes', 1),
(2, 1, 'silver', 30, '- Accès à tous les programmes\r\n- Economie de 6€', 3),
(3, 1, 'Gold', 120, '- Accès à tous les programmes\r\n - Economisez plus 24€', 12);

-- --------------------------------------------------------

--
-- Structure de la table `t_saison_san`
--

DROP TABLE IF EXISTS `t_saison_san`;
CREATE TABLE IF NOT EXISTS `t_saison_san` (
  `san_id` int(11) NOT NULL AUTO_INCREMENT,
  `san_iSta` int(11) NOT NULL,
  `san_iNumero` int(11) NOT NULL,
  `vid_id` int(11) NOT NULL,
  PRIMARY KEY (`san_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_saison_san`
--

INSERT INTO `t_saison_san` (`san_id`, `san_iSta`, `san_iNumero`, `vid_id`) VALUES
(1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_users_usr`
--

DROP TABLE IF EXISTS `t_users_usr`;
CREATE TABLE IF NOT EXISTS `t_users_usr` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_iSta` int(11) NOT NULL,
  `usr_sNom` varchar(255) NOT NULL,
  `usr_sPrenom` varchar(255) DEFAULT NULL,
  `usr_sEmail` varchar(255) NOT NULL,
  `usr_sPseudo` varchar(255) NOT NULL,
  `usr_sPass` varchar(255) NOT NULL,
  `usr_dDateIns` date NOT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_users_usr`
--

INSERT INTO `t_users_usr` (`usr_id`, `usr_iSta`, `usr_sNom`, `usr_sPrenom`, `usr_sEmail`, `usr_sPseudo`, `usr_sPass`, `usr_dDateIns`) VALUES
(1, 1, 'GUILLOUXs', 'Brontis', 'b.guilloux@hetic.net', 'bg', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', '2020-04-10'),
(2, 1, 'FOUSSADIER', 'Marie-Tiphaine', 'mt.foussadier@hetic.net', 'mt', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', '2020-04-10'),
(3, 1, 'CHOMEL', 'Denys', 'chomel@hetic.net', 'chomel', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', '2020-04-10');

-- --------------------------------------------------------

--
-- Structure de la table `t_videos_vid`
--

DROP TABLE IF EXISTS `t_videos_vid`;
CREATE TABLE IF NOT EXISTS `t_videos_vid` (
  `vid_id` int(11) NOT NULL AUTO_INCREMENT,
  `vid_iSta` varchar(255) NOT NULL,
  `vid_sType` varchar(255) NOT NULL,
  `vid_sTitre` varchar(255) NOT NULL,
  `vid_sSyno` text,
  `vid_sReal` varchar(255) DEFAULT NULL,
  `vid_sVideo` varchar(255) DEFAULT NULL,
  `vid_sPoster` varchar(255) NOT NULL,
  `vid_dDateSort` date NOT NULL,
  `vid_dDateAjout` datetime NOT NULL,
  `adm_id` int(11) NOT NULL,
  PRIMARY KEY (`vid_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_videos_vid`
--

INSERT INTO `t_videos_vid` (`vid_id`, `vid_iSta`, `vid_sType`, `vid_sTitre`, `vid_sSyno`, `vid_sReal`, `vid_sVideo`, `vid_sPoster`, `vid_dDateSort`, `vid_dDateAjout`, `adm_id`) VALUES
(1, '1', 'Film', 'skate board', 'C\'est une vidéo des jeunes skateurs sur des routes hallucinantes. Un vrai délice', 'Jim anon', 'assets/media/film/video/skate-board_1586556106.mp4', 'assets/media/film/poster/skate-board_1586556106.PNG', '2020-04-06', '2020-04-11 00:01:46', 1),
(2, '1', 'Série', 'Casa de papel', 'Un groupe de gens qui n\'ont plus rien à perdre est regroupe par un homme appelé le Professeur, pour braquer la fabrique de la monnaie.', 'Don juan', NULL, 'assets/media/serie/poster/casa-de-papel_1586759185.jpg', '2017-09-05', '2020-04-11 00:08:27', 1),
(3, '1', 'Film', 'Into the wild', 'test test test', 'Sébastien', 'assets/media/film/video/into-the-wild_1586768376.mp4', 'assets/media/film/poster/into-the-wild_1586768376.jpg', '2020-04-12', '2020-04-13 10:59:35', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
