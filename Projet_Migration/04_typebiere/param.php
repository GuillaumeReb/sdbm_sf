<?php

$migrationTables = array(
    array(
        "source" => array("typebiere", array("ID_TYPE", "NOM_TYPE")),
        "destination" => array("typebiere", array("id", "nom_type")),
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
