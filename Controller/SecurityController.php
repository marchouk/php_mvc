<?php
require_once 'Framework/Controller.php';

/**
 * Classe parente des contrôleurs soumis à authentification
 */
abstract class SecurityController extends Controller
{
    public function executeAction($action)
    {
        // Vérifie si les informations utilisateur sont présents dans la session
        // Si oui, l'utilisateur s'est déjà authentifié : l'exécution de l'action continue normalement
        // Si non, l'utilisateur est renvoyé vers le contrôleur de connexion
        if ($this->request->getSession()->isAttributeDefinedAndHasAValue("user")) {
            parent::executeAction($action);
        }
        else {
            $this->redirectTo("authentication");
        }
    }
}