<?php
require_once("inc/init.inc.php");

$tab = array();
$tab['resultat'] = "";

$arg = isset($_POST['arg']) ? $_POST['arg'] : "";
$mode = isset($_POST['mode']) ? $_POST['mode'] : "";

if($mode == "liste_membre_connecte" && $arg == "retirer")
{
    // Si on rentre ici, nous devons retirer le pseudo du fichier pseudo.txt // Attention au sens entre cette condition car la valeur de $mode et la même pour les deux

    // On récupère le contenu de pseudo.txt, file_get_contents prend en paramètre soit le nom d'un fichier, soit une URL
    $contenu = file_get_contents("pseudo.txt");

    // On remplace dans la chaîne de caractères représentée par $contenu le pseudo par rien (pour le supprimer)
    $contenu = str_replace($_SESSION['utilisateur']['pseudo'], '', $contenu);

    // On remet le contenu modifié dans le fichier
    file_put_contents("pseudo.txt", $contenu);

}
elseif($mode == 'liste_membre_connecte') 
{
    // Si on rentre ici, nous devons récupérer la liste des membres sur le fichier pseudo.texte puis la renvoyer
    $fichier = file("pseudo.txt");
    // $fichier est un tableau array qui contient un indice pour chaque pseudo

    if(!empty($fichier)) 
    {
        // implode() permet de récupérer les valeurs d'un tableau array et de les renvoyer sous forme de chaîne de caractères séparées par un séparateur fourni en 1er argument
        $tab['resultat'] .= '<p>' . implode('</p><p>', $fichier) . '</p>';
    }
}
elseif($mode == 'postMessage')
{
    // Si la valeur de mode est égale à postMessage alors nous devons enregistrer le message de l'utilisateur
    if(!empty($_POST['arg'])) // $arg est censé contenir le message à enregistrer, donc s'il n'est pas vide on l'enregistre
    {
        $id = $_SESSION['utilisateur']['id_membre'];
        $enregistrement = $pdo->prepare("INSERT INTO dialogue (id_membre, message, date_dialogue) VALUES ($id, :message, NOW()) ");
        $enregistrement->bindPARAM(":message", $arg, PDO::PARAM_STR);
        $enregistrement->execute();
        $tab['resultat'] .= '<p>Message enregistré !</p>';
    } else {
        $tab['resultat'] .= '<p class="erreur">Veuillez saisir un message !</p>';
    }
}
elseif($mode == 'message_tchat')
{
    $affichage = $pdo->query("SELECT * FROM dialogue d, membre m WHERE d.id_membre = m.id_membre ORDER BY date_dialogue ASC");
    while ($info_message = $affichage->fetch(PDO::FETCH_ASSOC))
    {
        if($info_message['id_dialogue'] % 2 == 0 && $info_message['sexe'] == 'm')
        { 
            $tab['resultat'] .= '<div style="border: 1px solid #dedede; padding: 5px; border-radius: 3px; background: #FFDAB9;">' . '<b><span class="bleu">' . $info_message['pseudo'] . '</span></b><br>' . $info_message['message'] . '<br><span class="date">' . $info_message['date_dialogue'] . '</span></div><br />';
        } 
        elseif ($info_message['id_dialogue'] % 2 == 0 && $info_message['sexe'] == 'f') 
        {
            $tab['resultat'] .= '<div style="border: 1px solid #dedede; padding: 5px; border-radius: 3px; background: #FFDAB9;">' . '<b><span class="rose">' . $info_message['pseudo'] . '</span></b><br>' . $info_message['message'] . '<br><span class="date">' . $info_message['date_dialogue'] . '</span></div><br />';
        }
       elseif ($info_message['id_dialogue'] % 2 != 0 && $info_message['sexe'] == 'm') 
        { 
            $tab['resultat'] .= '<div style="border: 1px solid #dedede; padding: 5px; border-radius: 3px; background: #87CEFA;">' . '<b><span class="bleu">' . $info_message['pseudo'] . '</span></b><br>' . $info_message['message'] . '<br><span class="date">' . $info_message['date_dialogue'] . '</span></div><br />';
        } 
        elseif ($info_message['id_dialogue'] % 2 != 0 && $info_message['sexe'] == 'f') 
        { 
            $tab['resultat'] .= '<div style="border: 1px solid #dedede; padding: 5px; border-radius: 3px; background: #87CEFA;">' . '<b><span class="rose">' . $info_message['pseudo'] . '</span></b><br>' . $info_message['message'] . '<br><span class="date">' . $info_message['date_dialogue'] . '</span></div><br />';
        }
    } 
}





echo json_encode($tab);