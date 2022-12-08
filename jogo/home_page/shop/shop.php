<?php require "exes/getSessionInfo.php" ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Loja</title>
    <link rel="stylesheet" href="shop.css">
</head>
<body>
    <div id= 'header_div'>
        <div id= 'head_logo'>
            <h1 id= 'head_logo_text'>GB CLICKER</h1>
        </div>
        <div id= 'info_div'>
            <?php echo "<h1 class= 'infos'>Username: " . $_SESSION['logged_username'] . "</h1>"; ?>
            <?php echo "<h1 id= 'show_money' class= 'infos'>Money: " . $_SESSION['logged_money'] . "</h1>"; ?> <!-- A troca de valor do dinheiro será feita pelo javascript. -->
            <?php echo "<h1 id= 'show_multiplier' class= 'infos'>Multiplier: " . $_SESSION['logged_multiplier'] . "x</h1>"; ?> <!-- A troca de valor do dinheiro será feita pelo javascript. -->
            <?php echo "<h1 id= 'show_gbminions' class= 'infos'>Gb Minions: " . $_SESSION['logged_gbminions'] . "x</h1>"; ?> <!-- A troca de valor do dinheiro será feita pelo javascript. -->
        </div>
    </div>
    <div id='loja_div'>
        <table>
            <th colspan='5'>Loja</th>
            <tr class='table_row'><td></td><td></td><td></td><td></td><td></td></tr>
            <tr class='table_row'><td></td><td></td><td></td><td></td><td></td></tr>
            <tr class='table_row'><td></td><td></td><td></td><td></td><td></td></tr>
            <tr class='table_row'><td></td><td></td><td></td><td></td><td></td></tr>
        </table>
    <div>
</body>
</html>