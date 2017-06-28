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
