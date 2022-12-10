<?php
    require "../../bd/connect.php";

    session_start();
    //VERIFICAR SE A SESSÃO FOI INICIADA
    if(!isset($_SESSION['logged_username'])){
        header('location: ../../login_page/login.php');
    }

    $logged_email = $_SESSION['logged_email'];

    $sql = "SELECT * FROM user, multiplier WHERE user_email = '$logged_email' and multiplier.FK_user_email = '$logged_email'";
    $result = $conn->query($sql);
    $result = $result->fetch_assoc();

    $_SESSION['logged_money'] = $result['user_money'];
    $logged_money = $result['user_money'];
    $logged_multiplier = $result['multiplier'];
    $logged_1multprice = $result['multiplierPrice'];
    $logged_10multprice = $result['10multiplierPrice'];
    $logged_gbminionprice = $result['user_gbminionprice'];
    $logged_gbminions = $result['user_gbminions'];
?>