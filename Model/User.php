<?php

require_once 'Framework/Model.php';

class User extends Model {


    //Vérifie qu'un utilisateur existe dans la BD
    public function login($username)
    {
        $sql = "SELECT *
                FROM users
                WHERE username=?";
        $user = $this->executeQuery($sql, array($username));
        if ($user->rowCount() == 1)
            return $user->fetch(PDO::FETCH_ASSOC);
        else
            return null;
    }

    // get all users except connected user
    public function getAll($id)
    {
        $sql = "SELECT id, username, status
                FROM users
                WHERE id!=?";
        return $this->executeQuery($sql, array($id));
    }
    //Update user status
    public function updateStatus($status, $id)
    {
        $sql = "UPDATE users 
                SET status=? 
                WHERE id=?";

        return $this->executeQuery($sql, array($status, $id));
    }

    public function register($username, $password)
    {
        $sql = 'INSERT INTO users(username, password)
                VALUES(?, ?)';
        $this->executeQuery($sql, array($username, password_hash($password, PASSWORD_DEFAULT)));
    }

    //Renvoie un utilisateur existant dans la BD
    public function get($id)
    {
        $sql = "SELECT username, status
                FROM users
                WHERE id=?";
        $user = $this->executeQuery($sql, array($id));
        if ($user->rowCount() == 1)
            return $user->fetch(PDO::FETCH_ASSOC);  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun utilisateur ne correspond au identifiant fourni");
    }
}