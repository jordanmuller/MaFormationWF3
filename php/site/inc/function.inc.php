<?php

// Fonction pour savoir si un utilisateur est connecté
function utilisateur_est_connecte()
{
    if(isset($_SESSION['utilisateur']))
    {
        // Si l'indice utilisateur existe alors l'utilisateur est connecté car il est passé par la page de connexion
        return true; // Si on passe par cette ligne, on sort de fonction avec le return et le return false en dessous ne sera pas pris en compte, on ne sort pas que du if mais aussi de function
    }
    return false;    
}

// Fonction pour savoir si un utilisateur est connecté mais a aussi le statut administrateur

function utilisateur_connecte_admin()
{
    if(utilisateur_est_connecte() && $_SESSION['utilisateur']['statut'] == 1)
    {
        return true;
    }
    return false;    
}

// Création du panier
function creation_panier()
{
    // Si panier n'existe pas, si on ne véréfie pas on l'écraserai à chaque fois
    if(!isset($_SESSION['panier']))
    {
        $_SESSION['panier'] = array();
        $_SESSION['panier']['id_article'] = array();
        $_SESSION['panier']['prix'] = array();
        $_SESSION['panier']['quantite'] = array();
        $_SESSION['panier']['titre'] = array();
        $_SESSION['panier']['photo'] = array();
    }
}

// Ajouter un article au panier
function ajouter_un_article_au_panier($id_article, $prix, $quantite, $titre, $photo)
{
    // Avant d'ajouter on vérifie si l'article n'est pas déjà présent dans le panier, si c'est la cas on ne faut que modifier la quantité
    $position = array_search($id_article, $_SESSION['panier']['id_article']);
    // array_search() permet de vérifier si une valeur se trouve dans un tableau array. Si c'est le cas on récupère l'indice correspondant, il renvoie un entier

    if($position !== FALSE)
    {
        // Si l'id_article existe déjà, on augmente juste l'indice quantité avec la nouvelle donnée $_POST['quantite'];
        $_SESSION['panier']['quantite'][$position] += $quantite;
    }
    else {
        // [] permettent de créer un nouvel élément dans le tableau
        $_SESSION['panier']['id_article'][] = $id_article;
        $_SESSION['panier']['quantite'][] = $quantite;
        $_SESSION['panier']['prix'][] = $prix;
        $_SESSION['panier']['titre'][] = $titre;
        $_SESSION['panier']['photo'][] = $photo;
    }
}

function retirer_article_panier($id_article)
{
    // On vérifie si un article est bien présent dans le panier et avec array_search() on récupère son indice correspondant
    $position = array_search($id_article, $_SESSION['panier']['id_article']);

    if($position !== FALSE)
    {
        // Retire un élément du tableau et réordonne le tableau pour combler le trou suite à la supression
        array_splice($_SESSION['panier']['id_article'], $position, 1);
        array_splice($_SESSION['panier']['titre'], $position, 1);
        array_splice($_SESSION['panier']['quantite'], $position, 1);
        array_splice($_SESSION['panier']['prix'], $position, 1);
        array_splice($_SESSION['panier']['photo'], $position, 1);

        // array_splice(le_tableau_concerne, indice_a_supprimer, nb_d_elements_a_supprimer)
    }
}

// Calcul du montant total du panier
function montant_total()
{ 
    if(!empty($_SESSION['panier']['titre']))
    {
        $taille_tab = sizeof($_SESSION['panier']['quantite']);
        $total = 0;
        for($j = 0; $j < $taille_tab; $j++)
        {
            $total += $_SESSION['panier']['prix'][$j] * $_SESSION['panier']['quantite'][$j];
        }
        return $total;
    }

}