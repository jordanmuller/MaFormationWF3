<?php

namespace Manager;

final class Application
{
    private $controller;
    private $action;
    private $argument;

    // La fonction __construct() va récupérer les infos dans l'URL et les stocker
    public function __construct()
    {
        // S'il y a 'controller' dans l'URL
        if(isset($_GET['controller']))
        {
            // Je vérifie si la valeur de l'indice URL existe en tant que fichier
            if(file_exists(__DIR__ . '/../../src/Controller/' . ucfirst($_GET['controller']) . 'Controller.php'))
            {
                // Si le Controller existe bien dans mon dossier Controller, alors je stocke son "nom" dans ma propriété $controller.
                $this->controller = 'Controller\\' . ucfirst($_GET['controller']) . 'Controller';
            } else {
                // Erreur, envoi d'une page 404
                // echo 'test';
                require __DIR__ . '/../../src/View/404.html';
            }
        } else {
            // Cela coresspond finalement à notre homepage (les deux actions) 
            $this->controller = 'Controller\ArticleController';
            $this->action = 'afficheAll';
        }

        // S'il y a une action dans l'URL
        if(isset($_GET['action']))
        {
            // On stocke l'action récupérée de $_GET['action'] dans la propriété $action
            $this->action = $_GET['action'];
        } else {
            // Cela coresspond finalement à notre homepage (les deux actions) 
            $this->controller = 'Controller\ArticleController';
            $this->action = 'afficheAll';
        }

        // Récupération de l'id s'il y en a un:
        if(isset($_GET['id']) && !empty($_GET['id'])) 
        {
            $this->argument = (int) $_GET['id'];
        }

        // Récupération de la catégorie s'il y en a une
        if(isset($_GET['cat']) && !empty($_GET['cat']))
        {
            $this->argument = (string) $_GET['cat'];
        }

        // Récupération du terme de recherche passé en $_POST,  :
        // recherche sera le nom de notre input type submit 
        // search sera le nom de notre input type text ou NEW 'search'
        if(isset($_POST['recherche']) && !empty($_POST['search']))
        {
            $this->controller = 'Controller\ArticleController';
            $this->action = 'rechercher';
            $this->argument = $_POST['search'];
        }
    }

    // La fonction run() va instancier le bon controller, et lancer la bonne action (méthode)
    public function run()
    {
        if(!is_null($this->controller))
        {
            // J'instancie le controller demandé dont on avait stocké le nom dans $this->controller
            $a = new $this->controller;

            // On vérifie si le champs action n'est pas null dans l'URL et si la méthode (l'action) ratachée à cette action existe bien dans mon objet $a.
            // Est-ce que dans mon article isssu de la class ArticleControlleur l'action existe bien (ex: afficheAll())
            if(!is_null($this->action) && method_exists($a, $this->action))
            {
                $action = $this->action;
                if(!is_null($this->argument))
                {
                    $a->$action($this->argument);
                    // $a affiche(6)
                    // $a->categorie(chemise)
                } else {
                    $a->$action();
                    // $a->afficheAll()
                }
            } else {
                // Erreur, envoi d'une page 404
                require __DIR__ . '/../../src/View/404.html';
            }
        } else {
            // Erreur, envoi d'une page 404
            require __DIR__ . '/../../src/View/404.html';
        }
    }
}