<?php

// Identifiants pour la base de données. Nécessaires a PDO2.
define('SQL_DSN',      'mysql:dbname=gsb_ticket;host=localhost');
define('SQL_USERNAME', 'root');
define('SQL_PASSWORD', 'root');

// Chemins à utiliser pour accéder aux vues/modeles/librairies
$module = empty($module) ? !empty($_GET['module']) ? $_GET['module'] : 'index' : $module;
define('CHEMIN_VUE',    $_SERVER['DOCUMENT_ROOT'].'/gsb_final/modules/'.$module.'/vues/');
define('CHEMIN_MODELE', $_SERVER['DOCUMENT_ROOT'].'/gsb_final/modeles/');
define('CHEMIN_LIB',    $_SERVER['DOCUMENT_ROOT'].'/gsb_final/libs/');

// Chemin vue global
define('CHEMIN_VUE_GLOBALE', $_SERVER['DOCUMENT_ROOT'].'/gsb_final/vues_globales/');

?>
