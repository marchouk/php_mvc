<?php

require_once 'Configuration.php';

abstract class Model {

    // Objet PDO d'accès à la BD
    private static $dbConnexion;

    // Exécute une requête SQL éventuellement paramétrée
    protected function executeQuery($sql, $params = null) {
        if ($params == null) {
            $result = self::getDbConnexion()->query($sql);    // exécution directe
        }
        else {
            $result = self::getDbConnexion()->prepare($sql);  // requête préparée
            $result->execute($params);
        }
        return $result;
    }

    // Renvoie un objet de connexion à la BD en initialisant la connexion au besoin
    private static function getDbConnexion() {
        if (self::$dbConnexion == null) {
            // Récupération des paramètres de configuration BD
            $dsn = Configuration::get("dsn");
            $user = Configuration::get("user");
            $password = Configuration::get("password");
            // Création de la connexion
            self::$dbConnexion = new PDO($dsn, $user, $password,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        return self::$dbConnexion;
    }

}