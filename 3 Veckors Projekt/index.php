<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inköpslista</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div>
        <form action="skapalist.php" method = "post">
            <input type="text" name="titel" placeholder="Inköpslistans namn" autocomplete="off"> <br>
            <textarea name="innehåll" placeholder="Saker att köpa in"> </textarea> <br>
            <button> Skapa inköpningslista </button>
        </form>
    </div>
</body>
</html>

