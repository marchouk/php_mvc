<?php

require_once 'Framework/Model.php';

class Conversation extends Model
{
    //Vérifie qu'un utilisateur existe dans la BD
    public function get($idUser1, $idUser2)
    {
        $sql = "SELECT *
                FROM conversation
                WHERE (id_user1=? AND id_user2=?) OR (id_user1=? AND id_user2=?)";
        $conversation = $this->executeQuery($sql, array($idUser1, $idUser2, $idUser2, $idUser1));
        if ($conversation->rowCount() == 1)
            return $conversation->fetch(PDO::FETCH_ASSOC);
        else
            return null;
    }

    public function add($idUser1, $idUser2)
    {
        $sql = 'INSERT INTO conversation(created_at, id_user1, id_user2)
                VALUES(?, ?, ?)';
        $date = date('Y-m-d H:i:s');  // Récupère la date courante
        $this->executeQuery($sql, array($date, $idUser1, $idUser2));
    }
}