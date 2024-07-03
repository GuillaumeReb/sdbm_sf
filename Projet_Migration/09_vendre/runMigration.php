<?php
require_once "./init.php";
require_once "./param.php";

function migrer_une_table($migratUneTable, $SOURCE, $DESTINATION)
{

    echo "Table Source : " . $migratUneTable["source"][0];
    foreach ($migratUneTable["source"][1] as $colonne) {
        echo "<br/>$colonne";
    }
    echo "<br/><hr/>";
    echo "Table Destination : " . $migratUneTable["destination"][0];
    foreach ($migratUneTable["destination"][1] as $colonne) {
        echo "<br/>$colonne";
    }
    echo "<br/><hr/>";

    // Ici la connexion à la BDD est OUVERTE
    $sql = "SELECT * from {$migratUneTable["source"][0]}";
    if (!$SOURCE->query($sql)) echo "Pb d'accès aux {$migratUneTable["source"][0]}";
    else {
        // Vider la table de destination
        // $truncateQuery = "TRUNCATE  {$migratUneTable["destination"][0]} ";
        // echo "<br/>On vide la table {$migratUneTable['destination'][0]} <br/>";
        // $DESTINATION->query($truncateQuery);
        // On va maintenant la remplir
        print_r($SOURCE->query($sql));
        echo "<table border='2px'>";
        foreach ($SOURCE->query($sql) as $row) {
            // var_dump($row);
            echo "<tr>";

            // Affichage des données à inserer
            foreach ($migratUneTable["source"][1] as $colonne) {
                echo "<td>$row[$colonne]<td>";
            }
            $values = "";
            // Génération des valeurs à insérer
            foreach ($migratUneTable["source"][1] as $colonne) {
                
                
                // Modification afin de gérer les valeurs NULL
                
                if ($values == "") {
                    if ($row[$colonne] == NULL) {
                        $values .=  "NULL";
                    } else {
                        $values .=  $DESTINATION->quote($row[$colonne]);
                    }
                    
                } else {
                    if ($row[$colonne] == NULL) {
                        $values .=  ", NULL";
                    } else {
                        $values .= "," . $DESTINATION->quote($row[$colonne]);
                    }
                  
                }
                // Remarque : On ajoute des '' quelque soit le format (num ou chaine)

            }
            // On INSERT les données dans la table destination
            $insertQuery = "INSERT into  {$migratUneTable["destination"][0]} (" . implode(',', $migratUneTable["destination"][1]) . ") values (" . $values . ")";
            echo "$insertQuery</tr>"; // Affichage de la requete générée dans le tableau
            $DESTINATION->query($insertQuery);

            set_time_limit(10); // Repousse la limite d'execution
        }
        echo "</table>";
    }
}


echo "<h1>Début de la MIGRATION</h1>";

// On parcourt tout le tableau $migrationTables
// Chaque élément de cette table correspond à la migration
// d'une table
foreach ($migrationTables as $uneTableAMigrer) {
    migrer_une_table($uneTableAMigrer, $connexion_SOURCE, $connexion_DESTINATION);
    echo "<br/>FIN de Migration de cette Table<hr/><hr/><hr/>";
}