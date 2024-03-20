<?php

namespace App;

class Repo
{   
    protected $link;

    function __construct()
    {
        try {
            $this->link = new \PDO('mysql:host=mysql;dbname=bd_accordEnergie', "root", "");
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
            die();
        }
    }

    public function getAllTable(string $table)
    {
        switch ($table) {
            case 'Missions':
                $stmt = $this->link->prepare("SELECT * FROM Missions");
                break;
            default:
                $stmt = $this->link->prepare("SELECT * FROM $table");
                break;
        }
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getOneById(string $table, $id)
    {
        $stmt = $this->link->prepare("SELECT * FROM $table WHERE numeroDossier = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function insert(string $table, array $data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->link->prepare($sql);
        $stmt->execute(array_values($data));

        return $this->link->lastInsertId();
    }

    public function update(string $table, array $data, int $id)
    {
        $updateFields = '';
        foreach ($data as $key => $value) {
            $updateFields .= "$key = ?, ";
        }
        $updateFields = rtrim($updateFields, ', ');
    
        // Ajoutez le nom de la clé primaire dans la requête SQL
        $sql = "UPDATE $table SET $updateFields WHERE numeroDossier = ?";
        $stmt = $this->link->prepare($sql);
    
        // Création du tableau des valeurs pour la requête préparée
        $values = array_values($data);
        $values[] = $id;
    
        // Exécution de la requête avec les valeurs
        $stmt->execute($values);
    }

    public function drop(string $table, int $id)
    {
        $sql = "DELETE FROM $table WHERE numeroDossier = ?";
        $stmt = $this->link->prepare($sql);
    
        $stmt->execute([$id]);
    }
}
