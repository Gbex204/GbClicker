<?php
    require "../../bd/connect.php";


if(file_exists($_FILES['change_image_input']['tmp_name'])){
    /*Confesso que eu não sei muito bem como funciona esse comando, mas quando da um input de imagem é criado
    pelo php o $_FILES com o nome do input usado*/
    $file = addslashes(file_get_contents($_FILES['change_image_input']['tmp_name']));
}


$item_criado = [
    $_POST['nome_item_input'],
    $file,
    $_POST['preco_item_input']
];


if( $conn->query("INSERT INTO shop(name, image, price) VALUES ('$item_criado[0]', '$item_criado[1]', '$item_criado[2]');") ){
    header('location: ../itens_admin.php');
}else{
    echo "ERRO!";
}


?>