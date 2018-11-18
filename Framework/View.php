<?php

require_once 'Configuration.php';

class View
{
    // Nom du fichier associé à la vue
    private $fileName;
    // Titre de la vue (défini dans le fichier vue)
    private $title;


    public function __construct($action, $controller = "") {
        // Détermination du nom du fichier vue à partir de l'action et du constructeur
        $fileName = "View/";
        if ($controller != "") {
            $fileName = $fileName . $controller . "/";
        }
        $this->fileName = $fileName . $action . ".php";
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }



    // Génère et affiche la vue
    public function generatePageContent($data)
    {
        // Génération de la partie spécifique de la vue
        $content = $this->generateViewContent($this->fileName, $data);
        // On définit une variable locale accessible par la vue pour la racine Web
        // Il s'agit du chemin vers le site sur le serveur Web
        // Nécessaire pour les URI de type controleur/action/id
        $webRoot = Configuration::get("webRoot", "/");
        // Génération du gabarit commun utilisant la partie spécifique
        $vue = $this->generateViewContent('View/base.php',
            array('title' => $this->title, 'content' => $content,
                'webRoot' => $webRoot));
        // Renvoi de la vue générée au navigateur
        echo $vue;
    }

    // Génère un fichier vue et renvoie le résultat produit
    public function generateViewContent($fileName, $data) {
        if (file_exists($fileName)) {
            // Rend les éléments du tableau $donnees accessibles dans la vue
            extract($data);
            // Démarrage de la temporisation de sortie
            ob_start();
            // Inclut le fichier vue
            // Son résultat est placé dans le tampon de sortie
            require $fileName;
            // Arrêt de la temporisation et renvoi du tampon de sortie
            return ob_get_clean();
        }
        else {
            throw new Exception("Fichier '$fileName' introuvable");
        }
    }
}