<?php
    //CHAMANDO OS COMANDOS PARA CONECTAR NO BANCO DE DADOS!
    require "../bd/connect.php";

    if( isset($_POST['login_input_email']) && isset($_POST['login_input_password']) ){

        //DADOS RECEBIDOS DO LOGIN (login.php)
        $email_inputado = $_POST['login_input_email'];
        $senha_inputada = $_POST['login_input_password'];

        $sql = "SELECT * FROM user, multiplier WHERE user_email = '$email_inputado' and multiplier.FK_user_email = '$email_inputado' and user_password = '$senha_inputada'";
        $result = $conn->query($sql);
        $result = $result->fetch_assoc();

        if( ($result !== NULL) && ($result['user_email'] == $email_inputado) && ($result['user_password'] == $senha_inputada) ){

            //CRIANDO SESSÃO PARA LEVAR OS DADOS DA CONTA CONECTADA PARA OUTRAS PÁGINAS
            session_start();
            $_SESSION['logged_email'] = $email_inputado;
            $_SESSION['logged_money'] = $result['user_money'];
            $_SESSION['logged_multiplier'] = $result['multiplier'];
            $_SESSION['logged_username'] = $result['user_username'];
            $_SESSION['logged_1multprice'] = $result['multiplierPrice'];
            $_SESSION['logged_10multprice'] = $result['10multiplierPrice'];
            $_SESSION['logged_gbminionprice'] = $result['user_gbminionprice'];
            $_SESSION['logged_gbminions'] = $result['user_gbminions'];
            
            //REDIRECIONAMENTO DO USUÁRIO PARA O SITE COM OS DADOS JÁ CONECTADOS
            header('location: ../home_page/site.php');
        }
        else{
            header('location: login.php?erro=1');
        }
    }

    else{
        header('location: login.php?erro=2');
    }
?>