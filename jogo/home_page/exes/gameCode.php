<script type= 'text/javascript' language= 'javascript'>
    //PEGANDO VALORES DO PHP E TRAZENDO PARA O JS
    var site_link = 'http://localhost'; 

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

    //CASO O USUARIO JÁ TENHA COMPRADO MINIONS, ELE CONTINUARÁ RECEBENDO DINHEIRO
    if(user_gbminions > 0){
        const interval_minion_give_money = setInterval(minion_give_money, 1000);
    }

    //FUNÇÕES PARA ATUALIZAR NA PÁGINA O DINHEIRO, MULTIPLICADOR E PREÇOS ATUAIS DO USUÁRIO
    function update_money(current_money){
        showUserMoney.innerText = `Money: ` + nFormatter(`${current_money}`, 1);

        return;
    }

    function update_multiplier(current_multiplier){
        showUserMultiplier.innerText = `Multiplier: ` + nFormatter(`${current_multiplier}`, 1) + `x`;

        return;
    }

    function update_gbminions(current_minions){
        showUserGbMinions.innerText = `Gb Minions: ` + nFormatter(`${current_minions}`, 1) + `x`;

        return;
    }

    function update_price(){
        botaoMult1price.innerText = `+ 1x Multiplicador (R$` + nFormatter(`${user_1multprice}`, 1) + `)`;
        botaoMult10price.innerText = `+ 10x Multiplicador (R$` + nFormatter(`${user_10multprice}`, 1) + `)`;
        btnGbMinionprice.innerText = `+ 1x Gb Minion (R$` + nFormatter(`${user_gbminionprice}`, 1) + `)`;

        update_money(user_money);
        update_multiplier(user_multiplier);
        update_gbminions(user_gbminions);

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
        let newPriceShorter = '';

        if(newPrice >= 1000){
            newPriceShorter = newPrice
        }

        btnMult1price.innerHTML = `<button id= 'btn_1multiplier' onclick= 'buy_multiplier(${newPrice})' class= 'item'>+ 1x Multiplicador (R$` + nFormatter(`${newPrice}`, 3) + `)</button>`;

        user_1multprice = newPrice;
        return;
    }

    function change_10multiplier_price(price){
        let newPrice = parseInt(price + (price*0.5), 10);

        btnMult10price.innerHTML = `<button id= 'btn_10multiplier' onclick= 'buy_10multiplier(${newPrice})' class= 'item'>+ 10x Multiplicador (R$` + nFormatter(`${newPrice}`, 3) + `)</button>`;

        user_10multprice = newPrice;
        return;
    }

    function change_1gbminion_price(price){
        let newPrice = parseInt(price + price, 10);
        btnGbMinionprice.innerHTML = `<button id= 'btn_1gbminion' onclick= 'buy_1gbminion(${newPrice})' class= 'item'>+ 1x Gb Minion (R$` + nFormatter(`${newPrice}`, 3) + `)</button>`;

        user_gbminionprice = newPrice;
        return;
    }

    function minion_give_money(){
        user_money += (1*user_multiplier) * user_gbminions;
        update_money(user_money);
    }


    function nFormatter(num, digits) { //formatador de números
        var si = [
          { value: 1, symbol: "" },
          { value: 1E3, symbol: "K" },
          { value: 1E6, symbol: "M" },
          { value: 1E9, symbol: "B" },
          { value: 1E12, symbol: "T" },
          { value: 1E15, symbol: "q" },
          { value: 1E18, symbol: "Q" }
        ];
        var rx = /\.0+$|(\.[0-9]*[1-9])0+$/;
        var i;
        // for negative value is work
        for (i = si.length - 1; i > 0; i--) {
          if (Math.abs(num) >= si[i].value) {
            break;
          }
        }
        return (num / si[i].value).toFixed(digits).replace(rx, "$1") + si[i].symbol;
    }

    function gotoShop(){
        let shop_link = site_link + '/GbClicker/jogo/home_page/shop/shop.php'
        window.location = shop_link;
    }
</script>