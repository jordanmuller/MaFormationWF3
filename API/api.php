<?php
    // Inclure le script
    require_once "./api-allocine-helper.php";
    
    $pdo = new PDO('mysql:host=localhost;dbname=GetInspired', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

    // Créer l'objet
    $helper = new AlloHelper;
    $image = new AlloImage;

    echo '<pre>'; echo $image; echo '</pre>';

    // Il y a en tout 61498 films
    $code = 1500;

    // Et 9499 séries tv

    $profile = 'medium';

    // requête search en GET
    /*$result = $helper->search($_GET['search']);
    echo '<h1>' . $result['movie'][2]['originalTitle'] . '</h1>';
    echo '<pre>'; print_r($result);   echo '<pre>';*/
   
   /************ function lovie_list ***************/
    
    for($i = 2; $i < 20; $i++)
    {
        try
        {
            // Envoi de la requête
            
            
            $movie = $helper->movie( $i, $profile );
            
            
            
            // Afficher le titre
            // echo "<hr>Titre du film: ", $movie->title, PHP_EOL . '<hr>';
            // echo "<hr>Genre du film: ", $movie->genre[0]['$'], PHP_EOL . '<hr>';
            // echo "<hr>Trailer du film: ", $movie->trailerEmbed, PHP_EOL . '<hr>';
            
            $title = $movie->title;
            $gender = utf8_encode($movie->genre[0]['$']);
            $production_year = $movie->productionYear;
            $nationality = $movie->nationality[0]['$'];
            $synopsis = $movie->synopsis;
            $casting_director = $movie->castingShort->directors; 
            $casting_actors = $movie->castingShort->actors;
            $trailer = $movie->trailerEmbed;
            $poster = $movie->poster->url();
            

               
            // Afficher toutes les données
            echo '<pre>'; print_r($movie); echo '</pre>';
            
            $insertion = $pdo->prepare("INSERT INTO movies VALUES (NULL, :title, :production_year, :nationality, :synopsis, :casting_director,  :gender, :trailer, :casting_actors, :poster)");
            $insertion->bindParam(':title', $title, PDO::PARAM_STR);
            $insertion->bindParam(':production_year', $production_year, PDO::PARAM_STR);
            $insertion->bindParam(':nationality', $nationality, PDO::PARAM_STR);
            $insertion->bindParam(':synopsis', $synopsis, PDO::PARAM_STR);
            $insertion->bindParam(':casting_director', $casting_director, PDO::PARAM_STR);            
            $insertion->bindParam(':gender', $gender, PDO::PARAM_STR);
            $insertion->bindParam(':trailer', $trailer, PDO::PARAM_STR);
            $insertion->bindParam(':casting_actors', $casting_actors, PDO::PARAM_STR);
            $insertion->bindParam(':poster', $poster, PDO::PARAM_STR);
            $insertion->execute();
        }
        catch( ErrorException $error )
        {
            // En cas d'erreur
            echo "Erreur n°", $error->getCode(), ": ", $error->getMessage(), PHP_EOL;
        }
    }
?>
