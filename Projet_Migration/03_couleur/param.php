<?php

$migrationTables = array(
    array(
        "source" => array("couleur", array("ID_COULEUR", "NOM_COULEUR")),
        "destination" => array("couleur", array("id", "nom_couleur")),
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
