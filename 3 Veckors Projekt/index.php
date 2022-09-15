<?php
$connection = require_once 'db.php'; 

// Hämtar alla listorna och lägger nyast längst upp
$listor = $connection->skaffalist();

/**
 * sätter att den aktiva listan inte har några värden så att den inte automatiskt försöker redigera
 * en lista som inte existerar när man öppnar sidan
*/
$aktivlista = [
    'id' => '',
    'titel' => '',
    'Inneholl' => ''
];

$titelErr = "";

// kollar om det finns ett ID i url:en,
if (isset($_GET['id'])) {
   $aktivlista = $connection->listamedid($_GET['id']);
}


?>
<!-- simpel HTML början -->
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
    
    <form class="NyLista" action="skapalista.php" method="post">
        <h1> Inköpslista </h1>
        <!-- ger varje lista ett ID -->
        <input type="hidden" name="id" value="<?php echo $aktivlista['id'] ?>">
        
        <!-- Text rutorna som man ger listorna titel och innehåll -->
        <input type="text" name="titel" placeholder="inköpslistans namn" autocomplete="off" required
        value="<?php echo $aktivlista['titel'] ?>">

        <textarea name="Inneholl" id="a"  rows = "4"
        placeholder="Produkter att köpa in"><?php echo $aktivlista['Inneholl'] ?></textarea>
        
        <!--
        if sats i knappen som kollar om den ska visa uppdatera/ändra lista eller Ny lista 
        -->
        <button>
        <?php if ($aktivlista['id']): ?>
                Ändra lista
            <?php else: ?>
                Ny lista
            <?php endif ?>
        </button>
    </form>
    <!-- en mall för vad varje lista ska se ut på HTML sidan -->
    <div class="listor">
        <?php foreach ($listor as $lista): ?>
            <div class="lista">
                
                <!-- 
                href länk på titeln som används som redigerings knapp
                som sätter sidans ID till listans id så att du redigerar
                den istället för att göra en ny lista
                -->
                <div class="titel">
                <h2><a href="?id=<?php echo $lista['id'] ?>">
                <?php echo $lista['titel'] ?>
                </a></h2>
                </div>

                <div class="Inneholl">
                <?php echo $lista['Inneholl'] ?>
                </div>
                
                <!--kopierad och redigerad för att jag inte använt datum förut i php-->
                <small><?php echo date('d/m/Y H:i', strtotime($lista['datum'])) ?></small> 
                
                <!-- anrop till tabort.php för kanppen som är kopplad till listan -->
                <form action="tabort.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $lista['id'] ?>">
                    <button class="bort">X</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
