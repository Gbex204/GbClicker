<?php
    session_start();
    //VERIFICAR SE A SESSÃO FOI INICIADA
    if(!isset($_SESSION['logged_username'])){
        header('location: login.php');
    }

    $logged_money = $_SESSION['logged_money'];
    $logged_multiplier = $_SESSION['logged_multiplier'];
    $logged_1multprice = $_SESSION['logged_1multprice'];
    $logged_10multprice = $_SESSION['logged_10multprice'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="site.css">
    <title>GbClicker | Site</title>
</head>
<body onload= 'update_price()'>

    <div id= 'header_div'>
        <div id= 'head_logo'>
            <h1>GB CLICKER</h1>
        </div>
        <div id= 'info_div'>
            <?php echo "<h1 class= 'infos'>Username: " . $_SESSION['logged_username'] . "</h1>"; ?>
            <?php echo "<h1 id= 'show_money' class= 'infos'>Money: " . $_SESSION['logged_money'] . "</h1>"; ?>
            <?php echo "<h1 id= 'show_multiplier' class= 'infos'>Multiplier: " . $_SESSION['logged_multiplier'] . "x</h1>"; ?>
        </div>
    </div>

    <div id='outer_clicker_div'>
        <div id= 'img_div'>
            <img onclick= 'add_money()' id= 'clicker_img' src='../midia/gb.png'>
        </div>
    </div>

    <div id='shop_div'>
        <div id= 'shop_above'>
            <button id= 'btn_1multiplier' onclick= 'buy_multiplier(50)' class= 'item'>+ 1x Multiplicador (R$50)</button>
            <button id= 'btn_10multiplier' onclick= 'buy_10multiplier(700)' class= 'item'>+ 10x Multiplicador (R$700)</button>
        </div>
        <div id= 'shop_under'>
            <button class= 'item'>+ 1</button>
            <button class= 'item'>+ 1 </button>
        </div>
    </div>
    
    <div id= 'invisible_div' class= 'form_invisible'>
    </div>

<script type= 'text/javascript' language= 'javascript'>

    //PEGANDO VALORES DO PHP E TRAZENDO PARA O JS
    var user_money = '<?php  echo"$logged_money"?>';
    var user_multiplier = '<?php  echo"$logged_multiplier"?>';
    var user_1multprice = '<?php  echo"$logged_1multprice"?>';
    var user_10multprice = '<?php  echo"$logged_10multprice"?>';

    //TRANSFORMANDO AS STRINGS TRAZIDAS DO BANCO DE DADOS PARA INTEIRO
    user_money = parseInt(user_money, 10);
    user_multiplier = parseInt(user_multiplier, 10);
    user_1multprice = parseInt(user_1multprice, 10);
    user_10multprice = parseInt(user_10multprice, 10);

    //ESPECIFICANDO ONDE SERÁ MOSTRADO O DINHEIRO, MULTIPLICADOR E ADICIONAIS DO USUÁRIO
    var showUserMoney = document.getElementById("show_money");
    var showUserMultiplier = document.getElementById("show_multiplier");
    var btnMult1price = document.getElementById("btn_1multiplier");
    var btnMult10price = document.getElementById("btn_10multiplier");


    
    //FUNÇÕES PARA ATUALIZAR NA PÁGINA O DINHEIRO, MULTIPLICADOR E PREÇOS ATUAIS DO USUÁRIO
    function update_money(current_money){
        showUserMoney.innerText = `Money: ${current_money}`;

        return;
    }

    function update_multiplier(current_multiplier){
        showUserMultiplier.innerText = `Multiplier: ${current_multiplier}x`;

        return;
    }

    function update_price(){
        btnMult1price.innerText = `+ 1x Multiplicador (R$${user_1multprice})`;
        btnMult10price.innerText = `+ 10x Multiplicador (R$${user_10multprice})`;

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
        div.innerHTML += `<form id= 'save_form' method= 'POST' action= '../bd/site_exe.php' style= 'visibility: hidden;'>
        \n<input name= 'save_input_money' type= 'text' value= "${user_money}" style= 'visibility: hidden;'>
        \n<input name= 'save_input_multiplier' type= 'text' value= "${user_multiplier}" style= 'visibility: hidden;'>
        \n<input name= 'save_input_1multprice' type= 'text' value= "${user_1multprice}" style= 'visibility: hidden;'>
        \n<input name= 'save_input_10multprice' type= 'text' value= "${user_10multprice}" style= 'visibility: hidden;'>
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

            return;
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
            
            return;
        }
        else{
            alert('Pouco dinheiro!')
            return;
        }
    }

    // FUNÇOES UTILIZADAAS PARA TROCAR O VALOR QUE O JOGADOR IRÁ PAGAR POR CADA ITEM E O TEXTO NA PÁGINA
    function change_1multiplier_price(price){
        let newPrice = price + (price/2);

        btnMult1price.innerHTML = `<button id= 'btn_1multiplier' onclick= 'buy_multiplier(${newPrice})' class= 'item'>+ 1x Multiplicador (R$${newPrice})</button>`;

        
        return; //save_changes();
    }

    function change_10multiplier_price(price){
        let newPrice = price + (price*0.5);

        btnMult10price.innerHTML = `<button id= 'btn_10multiplier' onclick= 'buy_10multiplier(${newPrice})' class= 'item'>+ 10x Multiplicador (R$${newPrice})</button>`;

        
        return; //save_changes();
    }

    
</script>
</body>

</html>