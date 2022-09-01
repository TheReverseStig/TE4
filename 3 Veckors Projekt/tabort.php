<?php


$connection = require_once 'db.php';

$connection->tabortlista($_POST['id']);

header('Location: index.php');

?>