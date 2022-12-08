<?php
    require "../bd/connect.php";

    session_start();
    //VERIFICAR SE A SESSÃO FOI INICIADA
    if(!isset($_SESSION['logged_username'])){
        header('location: ../login_page/login.php');
    }

    $sql = "SELECT * FROM user WHERE user_email = '" . $_SESSION['logged_email'] . "'";
    $result = $conn->query($sql);
    $result = $result->fetch_assoc();

    $logged_money = $result['user_money'];
    $logged_multiplier = $result['user_multiplier'];
    $logged_1multprice = $result['user_1multprice'];
    $logged_10multprice = $result['user_10multprice'];
    $logged_gbminionprice = $result['user_gbminionprice'];
    $logged_gbminions = $result['user_gbminions'];
?>