<?php require "exes/getSessionInfo.php"; ?> <!-- Trazendo as informações do usuário logado para o jogo. -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="site.css">
    <title>GbClicker | Site</title>
</head>
<body onload= 'update_price()'> <!-- A página terá seus preços atualizados com os dados do usuário. -->

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

    <div id='outer_clicker_div'>
        <div id= 'img_div'>
            <a onclick= 'add_money()' id= 'clicker_img' style=' background: url("midia/gb.png") no-repeat scroll 0 0 transparent; cursor: pointer;'></a>
        </div>
    </div>

    <div id='shop_div'>
        <div id= 'shop_above'>
            <div id= 'shop_above_left' class= 'shop_row'>
                <button id= 'btn_1multiplier' onclick= 'buy_multiplier(<?php echo $logged_1multprice ?>)' class= 'item'>+ 1x Multiplicador (R$<?php echo $logged_1multprice ?>)</button>
            </div>
            <div id= 'shop_above_right' class= 'shop_row'>
                <button id= 'btn_10multiplier' onclick= 'buy_10multiplier(<?php echo $logged_10multprice ?>)' class= 'item'>+ 10x Multiplicador (R$<?php echo $logged_10multprice ?>)</button>
            </div>
        </div>
        <div id= 'shop_under'>
            <div id= 'shop_under_left' class= 'shop_row'>
                <button id= 'btn_1gbminion' class= 'item' onclick= 'buy_1gbminion(<?php echo $logged_gbminionprice ?>)'>+ 1x Gb Minion</button>
            </div>
            <div id= 'shop_under_right' class= 'shop_row'>
                <button class= 'item' onclick= 'gotoShop()'>Ir para a loja</button>
            </div>
        </div>
        <div id= 'invisible_div'> </div>
    </div>

    <?php require "exes/gameCode.php"; ?> <!-- Trazendo o javascript para o jogo. -->
</body>

</html>