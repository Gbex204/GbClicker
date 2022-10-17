<?php
    $host = 'localhost:3306';
    $user = 'desenvolvedor';
    $pass = 'senha@senha';
    $db = 'gbclicker';
    //CONEXÃO COM BANCO DE DADOS
    $conn = mysqli_connect($host, $user, $pass, $db);

    if(!$conn){
        echo"Falha ao se conectar no banco de dados!";
    }

?>