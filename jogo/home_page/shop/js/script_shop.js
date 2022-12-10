var host = 'http://localhost'; //Trocar quando não estiver em server local (ex: usando RADMIN!)

function comprar(user_email, user_saldo, item_nome, item_preco){
    user_saldo = parseInt(user_saldo, 10);
    item_preco = parseInt(item_preco, 10);
    if(user_saldo>=item_preco){
        user_saldo -= item_preco;
        let link = host + `/GbClicker/jogo/home_page/shop/exes/comprar_item.php?email=${user_email}&nomeitem=${item_nome}&novosaldo=${user_saldo}`;
        window.location.href = link;
    }else{
        let link = host + `/GbClicker/jogo/home_page/shop/shop.php?erro=1`;
        window.location.href = link;
    }
}