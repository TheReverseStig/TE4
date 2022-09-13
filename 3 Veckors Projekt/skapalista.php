<?php


$connection = require_once 'db.php';


$id = $_POST['id'];

/** 
 * if sats som kollar om den ska uppdatera eller skapa en helt ny lista beroende på om ID 
 * redan är vald genom en href i index.php och tack vare biten ovanför
*/
if ($id){
   $connection->uppdateralista($id, $_POST); 
} else {                                     
    $connection->skapalista($_POST);
}

header('Location: index.php');

?>