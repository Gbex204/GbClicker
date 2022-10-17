<?php
    require 'connect.php';
    //VERIFICAÇÃO SE OS DADOS MULTIPLIER E MONEY FORAM PASSADOS
    if( isset($_POST['save_input_money']) && isset($_POST['save_input_multiplier']) ){

        session_start();

        $logged_email = $_SESSION['logged_email'];
        $save_current_money = $_POST['save_input_money'];
        $save_current_multiplier = $_POST['save_input_multiplier'];

        //QUANDO RETORNAR AO SITE.PHP, O USUÁRIO TERÁ O DINHEIRO E MULTIPLICADOR ATUALIZADOS
        $_SESSION['logged_money'] = $_POST['save_input_money'];
        $_SESSION['logged_multiplier'] = $_POST['save_input_multiplier'];

        //ATUALIZANDO O DINHEIRO DO CADASTRO LOGADO NO SITE
        $sql = "UPDATE user SET user_money = '$save_current_money', user_multiplier = '$save_current_multiplier' WHERE user_email = '$logged_email'";
        $result = mysqli_query($conn, $sql);

        header('location: ../php/site.php');
    }
    else{
        header('location: ../php/login.php');
    }

?>