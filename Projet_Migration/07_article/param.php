<?php

$migrationTables = array(
    array(
        "source" => array("article", array("ID_ARTICLE", "NOM_ARTICLE", "ID_COULEUR", "ID_TYPE", "ID_MARQUE", "PRIX_ACHAT", "VOLUME", "TITRAGE")),
        "destination" => array("article", array("id", "nom_article",  "couleurs_id", "types_id", "marques_id", "prix_achat", "volume", "titrage")),
    ),
    // array(
    //     "source" => array("pays", array("ID_PAYS", "ID_CONTINENT", "NOM_PAYS")),
    //     "destination" => array("paysbis", array("ID", "IDCONTINENT", "NOM")),
    // ),
    // array(
    //     "source" => array("couleur", array("ID_COULEUR", "NOM_COULEUR")),
    //     "destination" => array("couleurbis", array("ID", "NOM")),
    // ),
);
