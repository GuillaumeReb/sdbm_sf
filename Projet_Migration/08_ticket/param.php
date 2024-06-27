<?php

$migrationTables = array(
    array(
        "source" => array("ticket", array("ANNEE", "NUMERO_TICKET", "DATE_VENTE")),
        "destination" => array("ticket", array("annee", "numero_ticket",  "date_vente")),
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
