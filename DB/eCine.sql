-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mer. 08 avr. 2020 à 16:10
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP :  7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `eCine`
--

-- --------------------------------------------------------

--
-- Structure de la table `tj_abonnement_jab`
--

CREATE TABLE `tj_abonnement_jab` (
  `jab_id` int(11) NOT NULL,
  `jab_iSta` int(11) DEFAULT NULL,
  `jab_dDateDeb` date NOT NULL,
  `jab_dDateFin` date NOT NULL,
  `usr_id` int(11) NOT NULL,
  `pta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `tj_avis_jav`
--

CREATE TABLE `tj_avis_jav` (
  `jav_id` int(11) NOT NULL,
  `jav_sContenu` text NOT NULL,
  `jav_iEtoile` int(11) NOT NULL,
  `jav_dDate` date NOT NULL,
  `usr_id` int(11) NOT NULL,
  `vid_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `tj_preferences_jpr`
--

CREATE TABLE `tj_preferences_jpr` (
  `jpr_id` int(11) NOT NULL,
  `jpr_iSta` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL,
  `vid_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `tj_vue_video_jvv`
--

CREATE TABLE `tj_vue_video_jvv` (
  `jvv_id` int(11) NOT NULL,
  `jvv_dDate` date NOT NULL,
  `usr_id` int(11) NOT NULL,
  `vid_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_admin_adm`
--

CREATE TABLE `t_admin_adm` (
  `adm_id` int(11) NOT NULL,
  `adm_iSta` int(11) NOT NULL,
  `adm_sNom` varchar(255) NOT NULL,
  `adm_sPrenom` varchar(255) DEFAULT NULL,
  `adm_sEmail` varchar(255) NOT NULL,
  `adm_sPass` varchar(255) NOT NULL,
  `adm_sPseudo` varchar(255) NOT NULL,
  `adm_iRole` int(11) NOT NULL,
  `adm_sPhoto` varchar(255) DEFAULT NULL,
  `adm_dDateAjout` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_categorie_cat`
--

CREATE TABLE `t_categorie_cat` (
  `cat_id` int(11) NOT NULL,
  `cat_iSta` int(11) NOT NULL,
  `cat_sLib` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_episode_epi`
--

CREATE TABLE `t_episode_epi` (
  `epi_id` int(11) NOT NULL,
  `epi_iSta` int(11) NOT NULL,
  `epi_sTitre` varchar(255) DEFAULT NULL,
  `epi_iNum` int(11) NOT NULL,
  `epi_dDateSor` datetime NOT NULL,
  `epi_dDateAjout` date NOT NULL,
  `epi_sDescriptif` varchar(45) DEFAULT NULL,
  `vid_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_plan_tarifaire_pta`
--

CREATE TABLE `t_plan_tarifaire_pta` (
  `pta_id` int(11) NOT NULL,
  `pta_iSta` int(11) NOT NULL,
  `pta_sLibelle` varchar(255) NOT NULL,
  `pta_iPrix` float NOT NULL,
  `pta_sAvantage` text NOT NULL,
  `pta_iDuree` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_users_usr`
--

CREATE TABLE `t_users_usr` (
  `usr_id` int(11) NOT NULL,
  `usr_iSta` int(11) NOT NULL,
  `usr_sNom` varchar(255) NOT NULL,
  `usr_sPrenom` varchar(255) DEFAULT NULL,
  `usr_sEmail` varchar(255) NOT NULL,
  `usr_sPseudo` varchar(255) NOT NULL,
  `usr_sPass` varchar(255) NOT NULL,
  `usr_dDateIns` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_videos_vid`
--

CREATE TABLE `t_videos_vid` (
  `vid_id` int(11) NOT NULL,
  `vid_iSta` varchar(255) NOT NULL,
  `vid_sType` varchar(255) NOT NULL,
  `vid_sTitre` varchar(255) NOT NULL,
  `vid_sSyno` text DEFAULT NULL,
  `vid_sReal` varchar(255) DEFAULT NULL,
  `vid_sVideo` varchar(255) NOT NULL,
  `vid_sPoster` varchar(255) NOT NULL,
  `vid_dDateSort` date NOT NULL,
  `vid_dDateAjout` datetime NOT NULL,
  `adm_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tj_abonnement_jab`
--
ALTER TABLE `tj_abonnement_jab`
  ADD PRIMARY KEY (`jab_id`);

--
-- Index pour la table `tj_avis_jav`
--
ALTER TABLE `tj_avis_jav`
  ADD PRIMARY KEY (`jav_id`);

--
-- Index pour la table `tj_preferences_jpr`
--
ALTER TABLE `tj_preferences_jpr`
  ADD PRIMARY KEY (`jpr_id`);

--
-- Index pour la table `tj_vue_video_jvv`
--
ALTER TABLE `tj_vue_video_jvv`
  ADD PRIMARY KEY (`jvv_id`);

--
-- Index pour la table `t_admin_adm`
--
ALTER TABLE `t_admin_adm`
  ADD PRIMARY KEY (`adm_id`);

--
-- Index pour la table `t_categorie_cat`
--
ALTER TABLE `t_categorie_cat`
  ADD PRIMARY KEY (`cat_id`);

--
-- Index pour la table `t_episode_epi`
--
ALTER TABLE `t_episode_epi`
  ADD PRIMARY KEY (`epi_id`);

--
-- Index pour la table `t_plan_tarifaire_pta`
--
ALTER TABLE `t_plan_tarifaire_pta`
  ADD PRIMARY KEY (`pta_id`);

--
-- Index pour la table `t_users_usr`
--
ALTER TABLE `t_users_usr`
  ADD PRIMARY KEY (`usr_id`);

--
-- Index pour la table `t_videos_vid`
--
ALTER TABLE `t_videos_vid`
  ADD PRIMARY KEY (`vid_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tj_abonnement_jab`
--
ALTER TABLE `tj_abonnement_jab`
  MODIFY `jab_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tj_avis_jav`
--
ALTER TABLE `tj_avis_jav`
  MODIFY `jav_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tj_preferences_jpr`
--
ALTER TABLE `tj_preferences_jpr`
  MODIFY `jpr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tj_vue_video_jvv`
--
ALTER TABLE `tj_vue_video_jvv`
  MODIFY `jvv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_admin_adm`
--
ALTER TABLE `t_admin_adm`
  MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_categorie_cat`
--
ALTER TABLE `t_categorie_cat`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_episode_epi`
--
ALTER TABLE `t_episode_epi`
  MODIFY `epi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_plan_tarifaire_pta`
--
ALTER TABLE `t_plan_tarifaire_pta`
  MODIFY `pta_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_users_usr`
--
ALTER TABLE `t_users_usr`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_videos_vid`
--
ALTER TABLE `t_videos_vid`
  MODIFY `vid_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
