<?php
    //CHAMANDO OS COMANDOS PARA CONECTAR NO BANCO DE DADOS!
    require "../bd/connect.php";

    if( isset($_POST['login_input_email']) && isset($_POST['login_input_password']) ){

        //DADOS RECEBIDOS DO LOGIN (login.php)
        $email_inputado = $_POST['login_input_email'];
        $senha_inputada = $_POST['login_input_password'];

        $sql = "SELECT * FROM user WHERE user_email = '$email_inputado' and user_password = '$senha_inputada'";
        $result = mysqli_query($conn, $sql);
        $resultArray = mysqli_fetch_assoc($result);

        if( ($resultArray !== NULL) && ($resultArray['user_email'] == $email_inputado) && ($resultArray['user_password'] == $senha_inputada) ){

            //CRIANDO SESSÃO PARA LEVAR OS DADOS DA CONTA CONECTADA PARA OUTRAS PÁGINAS
            session_start();
            $_SESSION['logged_email'] = $login_email;
            $_SESSION['logged_money'] = $resultArray['user_money'];
            $_SESSION['logged_multiplier'] = $resultArray['user_multiplier'];
            $_SESSION['logged_username'] = $resultArray['user_username'];
            $_SESSION['logged_1multprice'] = $resultArray['user_1multprice'];
            $_SESSION['logged_10multprice'] = $resultArray['user_10multprice'];
            
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