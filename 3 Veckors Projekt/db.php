<?php

class Connection
{
    public $db = null;

    public function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:server=localhost;dbname=inkopslistor', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "ERROR: " . $exception->getMessage();
        }

    }

    public function skaffalist()
    {
        $statement = $this->pdo->prepare("SELECT * FROM listor ORDER BY datum DESC");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function skapalista($lista)
    {
        $statement = $this->pdo->prepare("INSERT INTO listor (titel, Inneholl, datum)
        VALUES (:titel, :Inneholl, :date)");
        $statement->bindValue('titel', $lista['titel']);
        $statement->bindValue('Inneholl', $lista['Inneholl']);
        $statement->bindValue('date', date('Y-m-d H:i:s'));
        return $statement->execute();
    }

    public function tabortlista($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM listor WHERE id = :id");
        $statement->bindValue('id', $id);
        return $statement->execute();
    }

    public function listemedid($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM listor WHERE id = :id");
        $statement->bindValue('id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}

return new Connection();
