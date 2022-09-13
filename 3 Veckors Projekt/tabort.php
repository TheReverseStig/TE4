<?php


$connection = require_once 'db.php';

$connection->tabortlista($_POST['id']); //tar bort inköpslista med X ID i POST

header('Location: index.php');

?>


