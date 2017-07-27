<?php

class Autoload
{
    // La méthode statique inclusion_automatique
    public static function inclusion_automatique($className)
    {
        // Voilà ce qu'on attend de notre autoload

        // Les antislash sont pour les namespaces
        // new Controller\ArticleController
        // Les slashs sont pour l'arboresence des dossiers
        // require "src/Controller/ArticleController.php

        // new Entity\Article
        // require "src/Entity/Article.php"

        // new Controller\Controller
        // require "vendor/Controller/Controller.php

        // new Manager\PDOManager
        // require "vendor/Manager/PDOManager.php

        // On doit mettre deux '\\' sinon il croit qu'on tente de concaténer l'apostrophe
        // explode coupe une chaîne en segment, 1er argument le séparateur, 2eme argument la chaîne intiale à découper
        $tab = explode('\\', $className);

        // Tout ce qui est dans le namespace Manager
        if(
        $tab[0] == 'Manager' 
        || 
        ($tab[0] == 'Controller' && $tab[1] == 'Controller') 
        || 
        ($tab[0] == 'Model' && $tab[1] == 'Model'))
        {
            $path = __DIR__ . '/' . implode('/', $tab) . '.php';
        }
        else {
            $path = __DIR__ . '/../src/' . implode('/', $tab) . '.php';
        }

        // ------------
        // En dev pour constater le chemin parcouru par l'autoload
        echo '<pre>Autoload : ' . $className . '<br />';
        echo '==> require "' . $path . '"</pre>';
        // ------------

        require $path;
    } 
}

// -------------------
spl_autoload_register(array('Autoload', 'inclusion_automatique'));
// -------------------
/*
Commentaires :
    spl_autoload_register() en POO attend en argument un array avec les valeurs suivantes:
        - 1 : le nom de la classe
        - 2 : le nom de la méthode qui va être static (OBLIGATOIREMENT)
        ----> Autoload::inclusion_automatique($className);
*/