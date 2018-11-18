<?php

require_once 'Request.php';
require_once 'View.php';
require_once 'Controller.php';

class Router {


    // Route une requête entrante : exécute l'action associée
    public function routeRequest() {
        try {
            // Fusion des paramètres GET et POST de la requête
            $request = new Request(array_merge($_GET, $_POST));

            /**
             * @var Controller $controller
             */
            $controller = $this->createController($request);
            $action = $this->defineAction($request);

            $controller->executeAction($action);
        }
        catch (Exception $e) {
            $this->handleError($e);
        }
    }

    // Crée le contrôleur approprié en fonction de la requête reçue
    private function createController(Request $request) {
        $controller = "Home";  // Contrôleur par défaut
        if ($request->isParameterDefinedAndHasAValue('controller')) {
            $controller = $request->getParameter('controller');
            // Première lettre en majuscule
            $controller = ucfirst(strtolower($controller));
        }
        // Création du nom du fichier du contrôleur
        $controllerClass =  $controller."Controller";
        $controllerFile = "Controller/" . $controllerClass . ".php";
        if (file_exists($controllerFile)) {
            // Instanciation du contrôleur adapté à la requête
            require($controllerFile);
            $controller = new $controllerClass();
            $controller->setRequest($request);
            return $controller;
        }
        else
            throw new Exception("Fichier '$controllerFile' introuvable");
    }

    // Détermine l'action à exécuter en fonction de la requête reçue
    private function defineAction(Request $request) {
        $action = "index";  // Action par défaut
        if ($request->isParameterDefinedAndHasAValue('action')) {
            $action = $request->getParameter('action');
        }
        return $action;
    }

    // Gère une erreur d'exécution (exception)
    private function handleError(Exception $exception) {
        $view = new View('error');
        $view->generatePageContent(array('errorMessage' => $exception->getMessage()));
    }


}