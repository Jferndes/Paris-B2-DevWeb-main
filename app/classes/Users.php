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

    public function getUserById(array $data)
    {
        $sql = "SELECT * FROM Users WHERE id = :userId";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getUserByEmail(array $data)
    {
        $sql = "SELECT * FROM Users WHERE email = :email";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM Users";
        $stmt = $this->link->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function isAlreadyCreated(string $email)
    {
        $user = $this->getUserByEmail(['email' => $email]);
        if ($user) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserPrenomById(int $userId)
    {   
        $user = $this->getUserById(['userId' => $userId]);
        
        if ($user) {
            if ($user['grade'] == 1) {
                return "Admin";
            }
            else {
                $sql = "SELECT 
                    COALESCE(c.prenom, s.prenom, i.prenom) AS prenom
                FROM Users u
                    LEFT JOIN Clients c ON u.id = c.user_id
                    LEFT JOIN Standardistes s ON u.id = s.user_id
                    LEFT JOIN Intervenants i ON u.id = i.user_id
                WHERE u.id = :userId";

                $stmt = $this->link->prepare($sql);
                $stmt->execute(['userId' => $userId]);
                $result = $stmt->fetch(\PDO::FETCH_ASSOC);

                return $result ? $result['prenom'] : null;
            }
        }else {
            return "";
        }  
    }
}
