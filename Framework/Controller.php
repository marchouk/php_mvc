<?php

require_once 'Request.php';
require_once 'View.php';

abstract class Controller {

    // Action à réaliser
    private $action;

    // Requête entrante
    /**
     * @var Request
     */
    protected $request;

    // Définit la requête entrante
    public function setRequest(Request $request) {
        $this->request = $request;
    }

    // Exécute l'action à réaliser
    public function executeAction($action) {
        if (method_exists($this, $action)) {
            $this->action = $action;
            $this->{$this->action}();
        }
        else {
            $controllerClass = get_class($this);
            throw new Exception("Action '$action' non définie dans la classe $controllerClass");
        }
    }

    // Méthode abstraite correspondant à l'action par défaut
    // Oblige les classes dérivées à implémenter cette action par défaut
    public abstract function index();

    // Génère la vue associée au contrôleur courant
    protected function renderView($viewData = array(), $action = null) {
        // Utilisation de l'action actuelle par défaut
        $viewAction = $this->action;
        if ($action != null) {
            // Utilisation de l'action passée en paramètre
            $viewAction = $action;
        }
        // Détermination du nom du fichier vue à partir du nom du contrôleur actuel
        $controller = $this->getPrefixController();
        // Instanciation et génération de la vue
        $view = new View($viewAction, $controller);
        $view->generatePageContent($viewData);
    }

    //Effectue une redirection vers un contrôleur et une action spécifiques
    protected function redirectTo($controller, $action = null)
    {
        $webRoot = Configuration::get("webRoot", "/");
        // Redirection vers l'URL /racine_site/controleur/action
        header("Location:" . $webRoot . $controller . "/" . $action);
    }

    protected function getPrefixController()
    {
        // Détermination du nom du fichier vue à partir du nom du contrôleur actuel
        $controllerClass = get_class($this);
        return str_replace("Controller", "", $controllerClass);
    }
}