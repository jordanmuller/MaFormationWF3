<?php
// fonction permettant d'empêcher l'arrêt du script après 30s
ini_set('max_execution_time', 0);

    // Inclure le script
    require_once "./api-allocine-helper.php";
    
    $pdo = new PDO('mysql:host=localhost;dbname=GetInspired', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

    // Créer l'objet
    $helper = new AlloHelper;

    // Il y a en tout 61498 films
    $code = 1500;

    // Et 9499 séries tv

    $profile = 'medium';

    // requête search en GET
    /*$result = $helper->search($_GET['search']);
    echo '<h1>' . $result['movie'][2]['originalTitle'] . '</h1>';
    echo '<pre>'; print_r($result);   echo '<pre>';*/
   
   /************ function lovie_list ***************/
    
    for($i = 126000; $i <= 126200; $i++)
    {
        try
        {
            // Envoi de la requête
            
            
            $movie = $helper->movie($i, $profile );
            
            
            
            // Afficher le titre
            // echo "<hr>Titre du film: ", $movie->title, PHP_EOL . '<hr>';
            // echo "<hr>Genre du film: ", $movie->genre[0]['$'], PHP_EOL . '<hr>';
            // echo "<hr>Trailer du film: ", $movie->trailerEmbed, PHP_EOL . '<hr>';
            //echo '<pre>';var_dump($movie);echo '</pre>';
            $title = utf8_encode($movie->title);
            $gender = utf8_encode($movie->genre[0]['$']);
            $production_year = $movie->productionYear;
            $nationality = utf8_encode($movie->nationality[0]['$']);
            $synopsis = utf8_encode($movie->synopsis);
            $director = utf8_encode($movie->castingShort->directors); 
            $actors = utf8_encode($movie->castingShort->actors);
            $trailer_a = $movie->trailerEmbed;
            $poster = $movie->poster->url();

            $rank = $movie->statistics->userRating;

            // on découpe la chaîne de caractères retournée par le trailer afin d'avoir uniquement la video sans le lien
            $trailer = strstr($trailer_a, '<a', true) . '</div>';



            if($title != NULL && $gender != NULL && $production_year != NULL && $production_year >= '1960' && $nationality != NULL && $synopsis != NULL && $director != NULL && $actors != NULL && $rank != NULL && $rank > 4) {
               
            // Afficher toutes les données
            // echo '<b>' . $rank . '</b>';
            // echo '<pre>'; print_r($movie); echo '</pre>';            
            
            
                $insertion = $pdo->prepare("INSERT INTO movies VALUES (NULL, :title, :production_year, :nationality, :synopsis, :director, :actors, :gender, :trailer, :poster, NULL)");
                $insertion->bindParam(':title', $title, PDO::PARAM_STR);
                $insertion->bindParam(':production_year', $production_year, PDO::PARAM_STR);
                $insertion->bindParam(':nationality', $nationality, PDO::PARAM_STR);
                $insertion->bindParam(':synopsis', $synopsis, PDO::PARAM_STR);
                $insertion->bindParam(':director', $director, PDO::PARAM_STR);
                $insertion->bindParam(':actors', $actors, PDO::PARAM_STR);
                $insertion->bindParam(':gender', $gender, PDO::PARAM_STR);
                $insertion->bindParam(':trailer', $trailer, PDO::PARAM_STR);
                $insertion->bindParam(':poster', $poster, PDO::PARAM_STR);
                $insertion->execute();
            }            
        }
        catch( ErrorException $error )
        {
            // En cas d'erreur
            echo "Erreur n°", $error->getCode(), ": ", $error->getMessage(), PHP_EOL;
        }
    }
?>
