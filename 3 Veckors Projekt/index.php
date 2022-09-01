<?php
$connection = require_once 'db.php';

$listor = $connection->skaffalist();

$aktivlista = [
    'id' => '',
    'titel' => '',
    'Inneholl' => ''
];
if (isset($_GET['id'])) {
    $aktivlista = $connection->listamedid($_GET['id']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>inköpslista</title>
    <link rel="stylesheet" href="stil.css">
</head>
<body>
<div>
    <form class="new-lista" action="skapalista.php" method="post">
        <input type="hidden" name="id" value="<?php echo $aktivlista['id'] ?>"> <!--ingen riktig funktion just nu-->
        <input type="text" name="titel" placeholder="inköpningslistans namn" autocomplete="off"
        value="<?php echo $aktivlista['titel'] ?>">
        <textarea name="Inneholl"
        placeholder="Produkter att köpa in"><?php echo $aktivlista['Inneholl'] ?></textarea>
        <button>
        Skapa listan
        </button>
    </form>
    <div class="listor">
        <?php foreach ($listor as $lista): ?>
            <div class="lista">
                <div class="titel">
                    <h1>
                        <?php echo $lista['titel'] ?>
                    </h1>
                </div>
                <div class="Inneholl">
                    <?php echo $lista['Inneholl'] ?>
                </div>
                <small><?php echo date('d/m/Y H:i', strtotime($lista['datum'])) ?></small>
                <form action="tabort.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $lista['id'] ?>">
                    <button class="close">X</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
