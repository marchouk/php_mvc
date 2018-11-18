<?php

/**
 * Classe modélisant la session.
 * Encapsule la superglobale PHP $_SESSION.
 */
class Session
{
    /**
     * Constructeur.
     * Démarre ou restaure la session
     */
    public function __construct()
    {
        session_start();
    }
    /**
     * Détruit la session actuelle
     */
    public function destroy()
    {
        session_destroy();
    }
    /**
     * Ajoute un attribut à la session
     */
    public function setAttribute($name, $value)
    {
        $_SESSION[$name] = $value;
    }
    /**
     * Renvoie vrai si l'attribut existe dans la session
     */
    public function isAttributeDefinedAndHasAValue($name)
    {
        return (isset($_SESSION[$name]) && $_SESSION[$name] != "");
    }
    /**
     * Renvoie la valeur de l'attribut demandé
     *
     * @param string $nom Nom de l'attribut
     * @return string Valeur de l'attribut
     * @throws Exception Si l'attribut n'existe pas dans la session
     */
    public function getAttribute($name)
    {
        if ($this->isAttributeDefinedAndHasAValue($name)) {
            return $_SESSION[$name];
        }
        else {
            throw new Exception("Attribut '$name' absent de la session");
        }
    }
}