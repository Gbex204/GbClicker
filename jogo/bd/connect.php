<?php
    $hostBD = 'localhost:3306';
    $usuarioBD = 'desenvolvedor';
    $senhaBD = 'senha@senha';
    $bd = 'gbclicker';
    //CONEXÃO COM BANCO DE DADOS
    $conn = mysqli_connect($hostBD, $usuarioBD, $senhaBD, $bd);

    if(!$conn){
        echo"Falha ao se conectar no banco de dados!";
    }

?>