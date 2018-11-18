<?php

class Configuration {

    private static $parameters;

    // Renvoie la valeur d'un paramètre de configuration
    public static function get($name, $defaultValue = null) {
        if (isset(self::getParameters()[$name])) {
            $value = self::getParameters()[$name];
        }
        else {
            $value = $defaultValue;
        }
        return $value;
    }

    // Renvoie le tableau des paramètres en le chargeant au besoin
    private static function getParameters()
    {
        if (self::$parameters == null)
        {
            $filePath = "Config/parameters.ini";
            if (!file_exists($filePath))
            {
                throw new Exception("Aucun fichier de configuration trouvé");
            }
            else {
                self::$parameters = parse_ini_file($filePath);
            }
        }
        return self::$parameters;
    }
}