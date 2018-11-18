<?php

require_once 'Session.php';

class Request {

    // paramètres de la requête
    private $parameters;

    // Objet session associé à la requête
    private $session;

    public function __construct($parameters) {
        $this->parameters = $parameters;
        $this->session = new Session();
    }

    // Renvoie vrai si le paramètre existe dans la requête
    public function isParameterDefinedAndHasAValue($name) {
        return (isset($this->parameters[$name]) && $this->parameters[$name] != "");
    }

    // Renvoie la valeur du paramètre demandé
    // Lève une exception si le paramètre est introuvable
    public function getParameter($name) {
        if ($this->isParameterDefinedAndHasAValue($name)) {
            return $this->sanitize($this->parameters[$name]);
        }
        else
            throw new Exception("Paramètre '$name' absent de la requête");
    }

    /*
     * Renvoie l'objet session associé à la requête
     */
    public function getSession()
    {
        return $this->session;
    }

    // Nettoie une valeur insérée dans une page HTML
    private function sanitize($value) {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
    }
}