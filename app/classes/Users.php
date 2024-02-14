<?php

namespace App;

class Users extends Repo
{
    private $id;
    private $email;
    private $password;
    private $created_at;
    private $updated_at;
    private $isActive;
    private $grade;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertUser(array $data)
    {
        $sql = "INSERT INTO Users (email, password, isActive, grade) VALUES (:email, :password, 1, 0)";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
    }

    public function getUserByEmail(array $data)
    {
        $sql = "SELECT * FROM Users WHERE email = :email";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
