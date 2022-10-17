<?php
    //CHAMANDO OS COMANDOS PARA CONECTAR NO BANCO DE DADOS!
    require "connect.php";

    if( isset($_POST['login_input_email']) && isset($_POST['login_input_password']) ){

        //DADOS RECEBIDOS DO LOGIN (login.php)
        $login_email = $_POST['login_input_email'];
        $login_password = $_POST['login_input_password'];

        $sql = "SELECT * FROM user WHERE user_email = '$login_email' and user_password = '$login_password'";
        $result = mysqli_query($conn, $sql);
        $resultArray = mysqli_fetch_assoc($result);

        if( ($resultArray['user_email'] == $login_email) && ($resultArray['user_password'] == $login_password) ){

            //CRIANDO SESSÃO PARA LEVAR OS DADOS DA CONTA CONECTADA PARA OUTRAS PÁGINAS
            session_start();
            $_SESSION['logged_email'] = $login_email;
            $_SESSION['logged_money'] = $resultArray['user_money'];
            $_SESSION['logged_multiplier'] = $resultArray['user_multiplier'];
            $_SESSION['logged_username'] = $resultArray['user_username'];
            
            //REDIRECIONAMENTO DO USUÁRIO PARA O SITE COM OS DADOS JÁ CONECTADOS
            header('location: ../php/site.php');
        }
        /*
        else{
            //CASO O USUÁRIO NÃO TENHA CONSEGUIDO SE CONTECTAR
            header('location: ../php/login.php ');
            echo "<h1>Usuário ou senha incorretos!</h1>";
        }
        */
    }

    else{
        echo "ERRO: DIGITE SUA CONTA DIREITO";
    }
?>