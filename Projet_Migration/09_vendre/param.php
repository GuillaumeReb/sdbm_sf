<?php

$migrationTables = array(
    array(
        "source" => array("vendre", array("ANNEE", "NUMERO_TICKET", "ID_ARTICLE", "QUANTITE", "PRIX_VENTE")),
        "destination" => array("vendre", array("annee", "numero_ticket",  "article_id", "quantite", "prix_vente")),
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
