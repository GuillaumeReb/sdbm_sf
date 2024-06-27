<?php

$migrationTables = array(
    array(
        "source" => array("fabricant", array("ID_FABRICANT", "NOM_FABRICANT")),
        "destination" => array("fabricant", array("id", "nom_fabricant")),
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
