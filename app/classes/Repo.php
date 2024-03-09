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
            case 'Mission':
                $stmt = $this->link->prepare("SELECT * FROM Missions");
                break;
            default:
                $stmt = $this->link->prepare("SELECT * FROM $table");
                break;
        }
        $stmt->execute();
        return $stmt->fetchAll();
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
}
