<?php
    require "../../../bd/connect.php";

    session_start();
    //VERIFICAR SE A SESSÃO FOI INICIADA
    if(!isset($_GET['nomeitem']) && !isset($_GET['email']) && !isset($_GET['novosaldo'])){
        header('location: ../login_page/login.php');
    }

    $sqlSaveUpgrade = "INSERT INTO updates (FK_user_email, FK_item_name) VALUES ('" . $_GET['email'] . "', '" . $_GET['nomeitem'] . "')";
    $sqlSaveNewBalance = "UPDATE user SET user_money = '".$_GET['novosaldo']."' WHERE user_email = '".$_GET['email']."';";

    if($conn->query($sqlSaveNewBalance) && $conn->query($sqlSaveUpgrade)){
        header('location: ../shop.php?comprado=true');
    }else{
        header('location: ../shop.php?erro=1');
    }
?>