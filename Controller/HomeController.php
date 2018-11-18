<?php

require_once 'Controller/SecurityController.php';
require_once 'Model/User.php';
require_once 'Framework/View.php';

class HomeController extends SecurityController
{

    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    // Affiche les détails sur un billet
    public function index()
    {
        $user = $this->request->getSession()->getAttribute("user");
        $this->renderView([
            'user' => $user,
        ]);
    }

    public function usersSection()
    {
        $user = $this->request->getSession()->getAttribute("user");
        $users = $this->user->getAll($user['id']);

        $view = new View('usersSection', $this->getPrefixController());
        echo $view->generateViewContent($view->getFileName(),['users' => $users]);
    }
}