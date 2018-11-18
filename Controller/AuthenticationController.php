<?php
require_once 'Framework/Controller.php';
require_once 'Model/User.php';

//Contrôleur gérant la connexion au site

class AuthenticationController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }
    public function index()
    {
        $this->renderView();
    }
    public function login()
    {
        if ($this->request->isParameterDefinedAndHasAValue("username") &&
            $this->request->isParameterDefinedAndHasAValue("password"))
        {
            $username = $this->request->getParameter("username");
            $password = $this->request->getParameter("password");

            $user = $this->user->login($username);
            if ($user)
            {
                $hashed_password = $user['password'];
                if (password_verify($password, $hashed_password))
                {
                    // empty user  before storing in the session
                    $user['password'] = null;
                    $this->user->updateStatus(true, $user['id']);
                    $user['status'] = true;
                    $this->request->getSession()->setAttribute("user", $user);
                    $this->redirectTo("home");
                }
                $this->renderView(array('msgErreur' => 'Login ou mot de passe incorrects'),
                    "index");
            }
            else
            {
                $this->renderView(array('msgErreur' => 'Login ou mot de passe incorrects'),
                    "index");
            }
        }
        else
            throw new Exception("Action impossible : login ou mot de passe non défini");
    }
    public function logout()
    {
        $user = $this->request->getSession()->getAttribute("user");
        $this->user->updateStatus(false, $user[id]);
        $this->request->getSession()->destroy();
        $this->redirectTo("authentication");
    }
}