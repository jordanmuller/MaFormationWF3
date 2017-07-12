<?php

// On crée un tableau array
$tab = array();
$tab['resultat'] = "";

if(!empty($_POST['pays']))
{
    $pays = $_POST['pays'];
    if($pays == 'France')
    {
        $tab['resultat'] .= '<option>Paris</option><option>Strasboug</option><option>Marseille</option><option>Lyon</option><option>Bordeaux</option>';
    }
    elseif ($pays == 'Italie')
    {
        $tab['resultat'] .= '<option>Rome</option><option>Milan</option><option>Turin</option><option>Naples</option><option>Florence</option>';
    }
    elseif ($pays == 'Espagne')
    {
        $tab['resultat'] .= '<option>Madrid</option><option>Barcelone</option><option>Malaga</option><option>Valence</option><option>Gijon</option>';
    }
}


// On transforme l'array tab en format JSON, interprétée comme une chaîne de caractère JSON par le JS, il faudra faire un parseJSON pour le transformer en objet JSON
echo json_encode($tab);