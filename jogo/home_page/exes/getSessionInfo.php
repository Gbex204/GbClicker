<?php
    require "../bd/connect.php";

    session_start();
    //VERIFICAR SE A SESSÃO FOI INICIADA
    if(!isset($_SESSION['logged_username'])){
        header('location: ../login_page/login.php');
    }

    $sql = "SELECT * FROM user, multiplier WHERE FK_user_email = '" . $_SESSION['logged_email'] . "' and user_email = '" . $_SESSION['logged_email'] . "'";
    $result = $conn->query($sql);
    $result = $result->fetch_assoc();

    $logged_email = $result['user_email'];

    $logged_money = $result['user_money'];
    $_SESSION['logged_money'] =  $logged_money;

    $logged_multiplier = $result['multiplier'];
    $_SESSION['logged_multiplier'] = $logged_multiplier;

    $logged_1multprice = $result['multiplierPrice'];
    $_SESSION['logged_1multprice'] = $result['multiplierPrice'];

    $logged_10multprice = $result['10multiplierPrice'];
    $_SESSION['logged_10multprice'] = $result['10multiplierPrice'];

    $logged_gbminionprice = $result['user_gbminionprice'];
    $_SESSION['logged_gbminionprice'] = $result['user_gbminionprice'];

    $logged_gbminions = $result['user_gbminions'];
    $_SESSION['logged_gbminions'] = $result['user_gbminions'];
    
?>