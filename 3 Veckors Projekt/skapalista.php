<?php


$connection = require_once 'db.php';


$id = $_POST['id'] ?? '';
if ($id){
  //  $connection->updateralista($id, $_POST); //halva denna del gör ingenting just nu (för en framtida funktion)
} else {                                     //där man ska kunna uppdatera en lista vid behov
    $connection->skapalista($_POST);
}

header('Location: index.php');

?>