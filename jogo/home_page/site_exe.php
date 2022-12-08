<?php
    require '../bd/connect.php';
    //VERIFICAÇÃO SE OS DADOS MULTIPLIER E MONEY FORAM PASSADOS
    if( isset($_POST['save_input_money']) && isset($_POST['save_input_multiplier']) && isset($_POST['save_input_1multprice']) && isset($_POST['save_input_10multprice']) ){

        session_start();

        $logged_email = $_SESSION['logged_email'];
        $save_current_money = $_POST['save_input_money'];
        $save_current_multiplier = $_POST['save_input_multiplier'];
        $save_current_1multprice = $_POST['save_input_1multprice'];
        $save_current_10multprice = $_POST['save_input_10multprice'];
        $save_current_gbminionprice = $_POST['save_input_gbminionprice'];
        $save_current_gbminions = $_POST['save_input_gbminions'];

        //QUANDO RETORNAR AO SITE.PHP, O USUÁRIO TERÁ O DINHEIRO E MULTIPLICADOR ATUALIZADOS
        $_SESSION['logged_money'] = $_POST['save_input_money'];
        $_SESSION['logged_multiplier'] = $_POST['save_input_multiplier'];
        $_SESSION['logged_1multprice'] = $_POST['save_input_1multprice'];
        $_SESSION['logged_10multprice'] = $_POST['save_input_10multprice'];
        $_SESSION['logged_gbminionprice'] = $_POST['save_input_gbminionprice'];
        $_SESSION['logged_gbminions'] = $_POST['save_input_gbminions'];

        //ATUALIZANDO O DINHEIRO DO CADASTRO LOGADO NO SITE
        $sql = "UPDATE user, multiplier SET 
        user_money = '$save_current_money',
        multiplier = '$save_current_multiplier',
        multiplierPrice = '$save_current_1multprice',
        10multiplierPrice = '$save_current_10multprice',
        user_gbminionprice = '$save_current_gbminionprice',
        user_gbminions = '$save_current_gbminions' WHERE user_email = '$logged_email' and FK_user_email = '$logged_email'";
        
        $conn->query($sql);

        header('location: site.php');
    }
    else{
        header('location: login.php?erro=3');
    }

?>