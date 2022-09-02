<?php


$connection = require_once 'db.php';

$connection->tabortlista($_POST['id']); //tar bort inköpslistor beroende på ID 

header('Location: index.php'); // redirectar till index.php

?>


