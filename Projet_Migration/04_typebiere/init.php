<?php
/////////////////////////////////////
//   Constantes pour se connecter  //
//   à la base de données SOURCE   //
/////////////////////////////////////
define("SGBD_SERVER_SOURCE", "127.0.0.1");
define("SGBD_PORT_SOURCE", "3306");
define("SGBD_BDD_SOURCE", "sdbm_v2");
define("SGBD_USER_SOURCE", "root");
define("SGBD_PSWD_SOURCE", "");

define("SGBD_OPTIONS_SOURCE", array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
));


define("SGBD_CHAINE_CONNEXION_SOURCE", "mysql:host=" . SGBD_SERVER_SOURCE . "; port=" . SGBD_PORT_SOURCE . "; dbname=" . SGBD_BDD_SOURCE . ";charset=utf8");
try {
    $connexion_SOURCE = new PDO(SGBD_CHAINE_CONNEXION_SOURCE, SGBD_USER_SOURCE, SGBD_PSWD_SOURCE, SGBD_OPTIONS_SOURCE);
} catch (Exception $e) {
    header('Location: erreur.php?Message=Problème accès à la BDD ' . $e->getMessage());
}


/////////////////////////////////////////
//   Constantes pour se connecter      //
//   à la base de données DESTINATION  //
/////////////////////////////////////////
define("SGBD_SERVER_DESTINATION", "127.0.0.1");
define("SGBD_PORT_DESTINATION", "3306");
define("SGBD_BDD_DESTINATION", "sdbm_sf");
define("SGBD_USER_DESTINATION", "root");
define("SGBD_PSWD_DESTINATION", "");

define("SGBD_OPTIONS_DESTINATION", array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
));


define("SGBD_CHAINE_CONNEXION_DESTINATION", "mysql:host=" . SGBD_SERVER_DESTINATION . "; port=" . SGBD_PORT_DESTINATION . "; dbname=" . SGBD_BDD_DESTINATION . ";charset=utf8");
try {
    $connexion_DESTINATION = new PDO(SGBD_CHAINE_CONNEXION_DESTINATION, SGBD_USER_DESTINATION, SGBD_PSWD_DESTINATION, SGBD_OPTIONS_DESTINATION);
} catch (Exception $e) {
    header('Location: erreur.php?Message=Problème accès à la BDD ' . $e->getMessage());
}
