<?php
    // Inclure le script
    require_once "./api-allocine-helper.php";
    

    // Créer l'objet
    $helper = new AlloHelper;

    // Il y a en tout 61498 films
    // $code = 61498;

    // Et 9499 séries tv
    $code = 9499;
    $profile = 'medium';

    // requête search en GET
    $result = $helper->search($_GET['search']);
    echo '<h1>' . $result['movie'][2]['originalTitle'] . '</h1>';
    echo '<pre>'; print_r($result);   echo '<pre>';
   
   /************ function lovie_list ***************/
    
    // for($i = 1; $i < 100; $i++)
    // {
        try
        {
            // Envoi de la requête
            
            
                $serie = $helper->tvserie( $code, $profile );
            
            // Afficher le titre
            echo "<hr>Titre du film: ", $serie->title, PHP_EOL . '<hr>';
            
            // Afficher toutes les données
            echo '<pre>'; print_r($serie); echo '</pre>';
            
        }
        catch( ErrorException $error )
        {
            // En cas d'erreur
            echo "Erreur n°", $error->getCode(), ": ", $error->getMessage(), PHP_EOL;
        }
    // }
?>