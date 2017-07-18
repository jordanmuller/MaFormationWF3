<?php
// json_encode() Transforme un tableau ARRAY en format JSON
// json_decode() Transforme un format JSON en tableau ARRAY

// On crée le tableau array
$tab = array();
$tab['resultat'] = ""; 

$prenom = "";

if(isset($_POST['personne']))
{
    $prenom = $_POST['personne'];

    // Récupération du contenu d'un fichier, On peut mettre une url à la place du fichier
    $fichier = file_get_contents("fichier.json");

    // $json est un tableau array qui possède toutes les données de fichier.json. Il faut toujours mettre true en argument dans json_decode() lorsque le fichier récupéré est en format json
    $json = json_decode($fichier, true);
    // var_dump($json);
    
    foreach($json AS $valeur)
    {
        if($valeur['prenom'] == strtolower($prenom))
        {
            $tab['resultat'] = "<table border='1' style='border-collapse: collapse; width: 50%; margin: 0 auto;'>
                <tr>
                    <td style='padding: 10px;'>" . $valeur['nom'] . "</td>
                    <td style='padding: 10px;'>" . $valeur['prenom'] . "</td>
                    <td style='padding: 10px;'>" . $valeur['salaire'] . "</td>
                    <td style='padding: 10px;'>" . $valeur['dateEmbauche'] . "</td>
                </tr>
            </table>";
        }
    }
}
echo json_encode($tab);

