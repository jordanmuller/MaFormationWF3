<?php
require_once('inc/init.inc.php');

$tab = array();
$tab['tableau'] = ''; 

if(!empty($_GET['prenom']))
{

}

$table = $pdo->query("SELECT * FROM employes");

$tab['tableau'] .= "<table border='1'><tr>";
$nb_col = $table->columnCount();
for ($i = 0; $i < $nb_col; $i++)
{
    $colonne = $table->getColumnMeta($i);
    $tab['tableau'] .= '<th>' . $colonne['name'] .'</th>';
}
$tab['tableau'] .= '</tr>';

while($ligne = $table->fetch(PDO::FETCH_ASSOC))
{
    $tab['tableau'] .= '<tr>';
        // On parcourt grâce à foreach tous les champs de chaque ligne de manière dynamique
        foreach($ligne AS $indice => $info)
        {
            if($indice == 'salaire')
            {
                $tab['tableau'] .= '<td>' . $info . ' €</td>';
            }
            elseif($indice == 'prenom')
            {
                $tab['tableau'] .= '<td><a href="?prenom=' . $ligne['prenom'] . '">' . $info . ' </a></td>';
            }
            else {
                $tab['tableau'] .= '<td>' . $info . '</td>'; 
            }
           
        }

    $tab['tableau'] .= '</tr>';
}

$tab['tableau'] .= '</table>';








echo json_encode($tab);

