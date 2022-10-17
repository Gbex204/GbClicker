<?php
    session_start();
    //VERIFICAR SE A SESSÃO FOI INICIADA
    if(!isset($_SESSION['logged_username'])){
        header('location: login.php');
    }

    $logged_money = $_SESSION['logged_money'];
    $logged_multiplier = $_SESSION['logged_multiplier'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/site.css">
    <title>GbClicker | Site</title>
</head>
<body>

    <div id= 'header_div'>
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
        <div id='save_button_div'>
            <button class= 'btn' onclick= 'save_changes()'>Salvar</button>
        </div>
    </div>

    <div id='shop_div'>
        <div id= 'shop_above'>
            <button onclick= 'buy_multiplier(50)' class= 'item'>+ 1x Multiplicador</button>
            <button class= 'item'>+ 1</button>
        </div>
        <div id= 'shop_under'>
            <button class= 'item'>+ 1</button>
            <button class= 'item'>+ 1 </button>
        </div>
    </div>

<script type= 'text/javascript' language= 'javascript'>

    //PEGANDO VALORES DO PHP E TRAZENDO PARA O JS
    var user_money = '<?php  echo"$logged_money"?>';
    var user_multiplier = '<?php  echo"$logged_multiplier"?>';

    //TRANSFORMANDO AS STRINGS TRAZIDAS DO BANCO DE DADOS PARA INTEIRO
    user_money = parseInt(user_money, 10);
    user_multiplier = parseInt(user_multiplier, 10);

    //ESPECIFICANDO ONDE SERÁ MOSTRADO O DINHEIRO DO USUÁRIO
    var showUserMoney = document.getElementById("show_money");
    var showUserMultiplier = document.getElementById("show_multiplier");
    
    //FUNÇÕES PARA ATUALIZAR NA PÁGINA O DINHEIRO ATUAL DO USUÁRIO
    function update_money(current_money){
        showUserMoney.innerText = `Money: ${current_money}`;
    }

    function update_multiplier(current_multiplier){
        showUserMultiplier.innerText = `Multiplier: ${current_multiplier}x`;
    }

    // CADA CLIQUE DO USUÁRIO NA IMAGEM, DEVERÁ SER ADICIONADO DINHEIRO DE ACORDO COM O MULTIPLICADOR ATUAL
    function add_money(){
        user_money = user_money + (1 * user_multiplier);
        return update_money(user_money);
    }

    // PARA SALVAR OS DADOS, CRIEI UM FORM INVISÍVEL QUE ENVIA OS DADOS AUTOMATICAMENTE APÓS CLICAR NO BOTÃO SALVAR PARA O "site_exe.php" SALVAR NO BANCO DE DADOS
    function save_changes(){
        let div = document.getElementById('header_div');
        div.innerHTML += `<form id= 'save_form' method= 'POST' action= '../bd/site_exe.php' style= 'visibility: hidden;'>
        \n<input name= 'save_input_money' type= 'text' value= "${user_money}" style= 'visibility: hidden;'>
        \n<input name= 'save_input_multiplier' type= 'text' value= "${user_multiplier}" style= 'visibility: hidden;'>
        \n</form>`;
        return document.getElementById('save_form').submit();
    }

    // FUNÇÃO USADA PARA AUMENTAR O MULTIPLICADOR DO JOGADOR, SALVAR OS DADOS NO BANCO E REMOVER O DINHEIRO USADO DA CONTA DO USUÁRIO
    function buy_multiplier(price){
        if(user_money>price){
            user_multiplier = user_multiplier + 1;
            user_money = user_money - price;
            update_multiplier(user_multiplier);
            return save_changes();
        }
        else{
            alert('Pouco dinheiro!')
            return;
        }
    }
</script>
</body>

</html>