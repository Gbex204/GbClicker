<?php
    $hostBD = 'localhost:3306';
    $usuarioBD = 'desenvolvedor';
    $senhaBD = 'senha@senha';
    $bd = 'gbclicker';
    //CONEXÃO COM BANCO DE DADOS
    $conn = new mysqli($hostBD, $usuarioBD, $senhaBD, $bd);

    if($conn->connect_error){
        echo"Falha ao se conectar no banco de dados!";
    }

?>