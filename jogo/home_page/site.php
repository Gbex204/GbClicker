<?php
    require "../bd/connect.php";

    session_start();
    //VERIFICAR SE A SESSÃO FOI INICIADA
    if(!isset($_SESSION['logged_username'])){
        header('location: ../login_page/login.php');
    }

    $sql = "SELECT * FROM user WHERE user_email = '" . $_SESSION['logged_email'] . "'";
    $result = $conn->query($sql);
    $result = $result->fetch_assoc();

    $logged_money = $result['user_money'];
    $logged_multiplier = $result['user_multiplier'];
    $logged_1multprice = $result['user_1multprice'];
    $logged_10multprice = $result['user_10multprice'];
    $logged_gbminionprice = $result['user_gbminionprice'];
    $logged_gbminions = $result['user_gbminions'];
?>

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
            <h1>GB CLICKER</h1>
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
            <img onclick= 'add_money()' id= 'clicker_img' src='midia/gb.png'>
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
                <button id= 'btn_1gbminion' class= 'item' onclick= 'buy_1gbminion(<?php echo $logged_gbminions ?>)'>+ 1x Gb Minion</button>
            </div>
            <div id= 'shop_under_right' class= 'shop_row'>
                <button class= 'item'>Em breve...</button>
            </div>
        </div>
        <div id= 'invisible_div'> </div>
    </div>

<script type= 'text/javascript' language= 'javascript'>

    //PEGANDO VALORES DO PHP E TRAZENDO PARA O JS
    var user_money = '<?php  echo"$logged_money"?>';
    var user_multiplier = '<?php  echo"$logged_multiplier"?>';
    var user_1multprice = '<?php  echo"$logged_1multprice"?>';
    var user_10multprice = '<?php  echo"$logged_10multprice"?>';
    var user_gbminionprice = '<?php echo"$logged_gbminionprice"?>';
    var user_gbminions = '<?php echo"$logged_gbminions"?>';

    //TRANSFORMANDO AS STRINGS TRAZIDAS DO BANCO DE DADOS PARA INTEIRO
    user_money = parseInt(user_money, 10);
    user_multiplier = parseInt(user_multiplier, 10);
    user_1multprice = parseInt(user_1multprice, 10);
    user_10multprice = parseInt(user_10multprice, 10);
    user_gbminionprice = parseInt(user_gbminionprice, 10);
    user_gbminions = parseInt(user_gbminions, 10);
    
    //ESPECIFICANDO ONDE SERÁ MOSTRADO O DINHEIRO, MULTIPLICADOR E ADICIONAIS DO USUÁRIO
    var showUserMoney = document.getElementById("show_money");
    var showUserMultiplier = document.getElementById("show_multiplier");
    var showUserGbMinions = document.getElementById("show_gbminions");
    var btnMult1price = document.getElementById("shop_above_left");
    var btnMult10price = document.getElementById("shop_above_right");
    var botaoMult1price = document.getElementById("btn_1multiplier");
    var botaoMult10price = document.getElementById("btn_10multiplier");
    var btnGbMinionprice = document.getElementById("btn_1gbminion");

    if(user_gbminions > 0){
        const interval_minion_give_money = setInterval(minion_give_money, 2000);
    }

    //FUNÇÕES PARA ATUALIZAR NA PÁGINA O DINHEIRO, MULTIPLICADOR E PREÇOS ATUAIS DO USUÁRIO
    function update_money(current_money){
        showUserMoney.innerText = `Money: ${current_money}`;

        return;
    }

    function update_multiplier(current_multiplier){
        showUserMultiplier.innerText = `Multiplier: ${current_multiplier}x`;

        return;
    }

    function update_gbminions(current_minions){
        showUserGbMinions.innerText = `Gb Minions: ${current_minions}x`;

        return;
    }

    function update_price(){
        botaoMult1price.innerText = `+ 1x Multiplicador (R$${user_1multprice})`;
        botaoMult10price.innerText = `+ 10x Multiplicador (R$${user_10multprice})`;
        btnGbMinionprice.innerText = `+ 1x Gb Minion (R$${user_gbminionprice})`;

        return;
    }

    // CADA CLIQUE DO USUÁRIO NA IMAGEM, DEVERÁ SER ADICIONADO DINHEIRO DE ACORDO COM O MULTIPLICADOR ATUAL
    function add_money(){
        user_money = user_money + (1 * user_multiplier);
        return update_money(user_money);
    }

    /* PARA SALVAR OS DADOS, CRIEI UM FORM INVISÍVEL QUE ENVIA OS DADOS AUTOMATICAMENTE APÓS CLICAR NO BOTÃO SALVAR PARA O "site_exe.php" 
       SALVAR NO BANCO DE DADOS*/
    function save_changes(){
        let div = document.getElementById('invisible_div');

        // SÃO SALVOS OS SEGUINTES DADOS: (DINHEIRO, MULTIPLICADOR ATUAL, PREÇO DE COMPRA DE 1 MULTIPLICADOR E DE 10 MULTIPLICADORES)
        div.innerHTML += `<form id= 'save_form' method= 'POST' action= 'site_exe.php' style= 'visibility: hidden;'>
        \n<input name= 'save_input_money' type= 'text' value= "${user_money}" style= 'visibility: hidden;'>
        \n<input name= 'save_input_multiplier' type= 'text' value= "${user_multiplier}" style= 'visibility: hidden;'>
        \n<input name= 'save_input_1multprice' type= 'text' value= "${user_1multprice}" style= 'visibility: hidden;'>
        \n<input name= 'save_input_10multprice' type= 'text' value= "${user_10multprice}" style= 'visibility: hidden;'>
        \n<input name= 'save_input_gbminionprice' type= 'text' value= "${user_gbminionprice}" style= 'visibility: hidden;'>
        \n<input name= 'save_input_gbminions' type= 'text' value= "${user_gbminions}" style= 'visibility: hidden;'>
        \n</form>`;

        return document.getElementById('save_form').submit();
    }

    // FUNÇÃO USADA PARA AUMENTAR O MULTIPLICADOR DO JOGADOR, SALVAR OS DADOS NO BANCO E REMOVER O DINHEIRO USADO DA CONTA DO USUÁRIO
    function buy_multiplier(price){
        if(user_money>=price){
            user_multiplier = user_multiplier + 1;
            user_money = user_money - price;

            update_multiplier(user_multiplier);
            update_money(user_money);
            change_1multiplier_price(price);

            return save_changes();
        }
        else{
            alert('Pouco dinheiro!');
            return;
        }
    }

    function buy_10multiplier(price){
        if(user_money>=price){
            user_multiplier = user_multiplier + 10;
            user_money = user_money - price;

            update_multiplier(user_multiplier);
            update_money(user_money);
            change_10multiplier_price(price);
            
            return save_changes();
        }
        else{
            alert('Pouco dinheiro!')
            return;
        }
    }

    function buy_1gbminion(price){
        if(user_money>=price){

            user_gbminions = user_gbminions + 1;
            user_money = user_money - price;

            update_gbminions(user_gbminions);
            update_money(user_money);
            change_1gbminion_price(price);
            
            return save_changes();
        }
        else{
            alert('Pouco dinheiro!')
            return;
        }
    }

    // FUNÇOES UTILIZADAAS PARA TROCAR O VALOR QUE O JOGADOR IRÁ PAGAR POR CADA ITEM E O TEXTO NA PÁGINA
    function change_1multiplier_price(price){
        let newPrice = parseInt((price + (price/2)), 10);

        btnMult1price.innerHTML = `<button id= 'btn_1multiplier' onclick= 'buy_multiplier(${newPrice})' class= 'item'>+ 1x Multiplicador (R$${newPrice})</button>`;

        user_1multprice = newPrice;
        return;
    }

    function change_10multiplier_price(price){
        let newPrice = parseInt(price + (price*0.5), 10);

        btnMult10price.innerHTML = `<button id= 'btn_10multiplier' onclick= 'buy_10multiplier(${newPrice})' class= 'item'>+ 10x Multiplicador (R$${newPrice})</button>`;

        user_10multprice = newPrice;
        return;
    }

    function change_1gbminion_price(price){
        let newPrice = parseInt(price + price, 10);
        btnGbMinionprice.innerHTML = `<button id= 'btn_1gbminion' onclick= 'buy_1gbminion(${newPrice})' class= 'item'>+ 1x Gb Minion (R$${newPrice})</button>`;

        user_gbminionprice = newPrice;
        return;
    }

    function minion_give_money(){
        user_money += (1*user_multiplier) * user_gbminions;
        update_money(user_money);
    }

    
</script>
</body>

</html>