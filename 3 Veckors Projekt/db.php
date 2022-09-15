<?php

class Lista
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
        // Kopierade delen ovanför från W3Schools och PHP.net
    }   // för att jag inte visste hur PDO fungera

    public function skaffalist()
    {  // SQL för att ta inköpslistor från nyast datum först i.e nyast först
        $statement = $this->pdo->prepare("SELECT * FROM listor ORDER BY datum DESC");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    public function skapalista($lista)
    {   /** 
          * skapara inköpslistorna genom att inserta 
          * informationen från hemsidan till databasen
          * som sedan visas vid 
          */
        $statement = $this->pdo->prepare("INSERT INTO listor (titel, Inneholl, datum)
        VALUES (:titel, :Inneholl, :date)");
        $statement->bindValue("titel", $lista["titel"]);
        $statement->bindValue("Inneholl", $lista["Inneholl"]);
        $statement->bindValue("date", date("Y-m-d H:i:s"));
        return $statement->execute();
    }

    public function tabortlista($id)
    {   // tar bort inköpslistorna med det Id 
        // som ta bort knappen är kopplad till (i index.php)
        $statement = $this->pdo->prepare("DELETE FROM listor WHERE id = :id");
        $statement->bindValue("id", $id);
        return $statement->execute();
    }

    public function listamedid($id)
    {   // används för att få Listornas ID till index.php för att redigera redan existerande listor
        $statement = $this->pdo->prepare("SELECT * FROM listor WHERE id = :id");
        $statement->bindValue("id", $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function uppdateralista($id, $lista)
    {   // Uppdaterar redan gjorda Listorna med SQL satsen för titel och innehållet
        $statement = $this->pdo->prepare("UPDATE listor SET titel = :titel, Inneholl = :Inneholl WHERE id = :id" );
        // kopplar alla med sin associerade del i data basen
        $statement->bindValue("id",$id);
        $statement->bindValue("titel", $lista["titel"]);
        $statement->bindValue("Inneholl", $lista["Inneholl"]);
        return $statement->execute();
    }
}

return new Lista();
