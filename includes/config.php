<?php
/**
 * fichier de configuration qui déclare toutes les constantes utilisées dans les classes
**/

// global
const SITE_ROOT 	= '';
const SITE_ROOT_ADMIN 	= '';
const SITE_REP    = '';

// mysql
// base de données
const BDD_SGBD = 'mysql';
const BDD_DATABASE	= 'ecine';
const BDD_HOST 		= 'localhost';
const BDD_PASSWORD	= '';
const BDD_USER		= 'root';

// tables principales
const TABLE_ADM		= 't_admin_adm';
const TABLE_CAT		= 't_categorie_cat';
const TABLE_EPI		= 't_episode_epi';
const TABLE_PTA		= 't_plan_tarifaire_pta';
const TABLE_USR		= 't_users_usr';
const TABLE_VID		= 't_videos_vid';
const TABLE_SAN     = 't_saison_san';
const TABLE_BAN     = 't_banner_ban';


// tables de jointure
const TABLE_JAB		= 'tj_abonnement_jab';
const TABLE_JAV		= 'tj_avis_jav';
const TABLE_JPR		= 'tj_preferences_jpr';
const TABLE_JVV		= 'tj_vue_video_jvv';
const TABLE_VIC     = 'tj_videos_categorie_vic';



// expéditeur mail
const EXP_MAIL		= 'jarce2frise@gmail.com';

// destinataire emails plateforme
const DEST_MAIL		= 'jarce2frise@gmail.com';


// statuts
const DEF_STA_SUPPR	= 2; // ID du statut supprimé


const REP_CLI = '/fichiers/';


// taille des avatars
const AVATAR_WIDTH  = 100;
const AVATAR_HEIGHT = 100;

// avatar par défaut
const AVATAR_DEFAULT = 'img/user/no-image.png';

?>
