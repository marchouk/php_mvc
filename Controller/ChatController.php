<?php

require_once 'Controller/SecurityController.php';
require_once 'Model/Conversation.php';
require_once 'Model/Message.php';
require_once 'Model/User.php';

class ChatController extends SecurityController
{
    private $conversation;
    private $message;
    private $user;

    public function __construct()
    {
        $this->conversation = new Conversation();
        $this->message = new Message();
        $this->user = new User();
    }

    public function index()
    {
        $idOtherUser = $this->request->getParameter('id');
        $otherUser = $this->user->get($idOtherUser);
        $user = $this->request->getSession()->getAttribute("user");
        $idUser = $user['id'];
        $conversation = $this->conversation->get($user['id'], $idOtherUser);
        if ($conversation)
        {
            $idConversation = $conversation['id'];
        }
        else
        {
            $this->conversation->add($idUser, $idOtherUser);
            $conversation = $this->conversation->get($idUser, $idOtherUser);
            $idConversation = $conversation['id'];
        }
        $this->renderView([
            'user' => $user,
            'idConversation' => $idConversation,
            'otherUser'  => $otherUser,
        ]);
    }

    public function addMessage()
    {
        $idConversation = $this->request->getParameter('id');
        $idUser = $this->request->getSession()->getAttribute("user")['id']; // connected user
        $content = $this->request->getParameter('content');

        $this->message->add($idUser, $content, $idConversation);

        //header("Content-type: application/json");
        echo json_encode(array('code'=>200, 'idConversation' => $idConversation));
    }

    public function chatSection()
    {
        $idConversation = $this->request->getParameter('id');

        $messages  = $this->message->getAllByConversation($idConversation);

        $user = $this->request->getSession()->getAttribute("user");

        $view = new View('chatSection', $this->getPrefixController());
        echo $view->generateViewContent($view->getFileName(),[
            'messages' => $messages,
            'user' => $user,
        ]);
    }

}