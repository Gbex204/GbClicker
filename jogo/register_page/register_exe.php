<?php
    //CHAMANDO OS COMANDOS PARA CONECTAR NO BANCO DE DADOS!
    require "../bd/connect.php";

    //CASO O ARQUIVO "register_exe.php" ESTEJA RECEBENDO AS INFORMAÇÕES DO USUÁRIO (register.php) OS DADOS SERÃO CADASTRADOS
    if( isset($_POST['register_input_email']) && isset($_POST['register_input_password']) && isset($_POST['register_input_username']) ){
        
        //RECEBENDO VALORES INFORMADOS PELO USUÁRIO (register.php)!
        $register_email = $_POST['register_input_email'];
        $register_password = $_POST['register_input_password'];
        $register_username = $_POST['register_input_username'];

        //DEFININDO COMANDO SQL PARA O PHP MANDAR PRO BANCO DE DADOS OS DADOS INFORMADOS
        $sql = "INSERT INTO user (user_email, user_password, user_username, user_money, user_multiplier, user_1multprice, user_10multprice) VALUES ('$register_email', '$register_password', '$register_username', '0', '1', '50', '700')";

        //COLOCANDO NO BANCO DE DADOS O COMANDO DEFINIDO NO '$sql'
        $result = mysqli_query($conn, $sql);

        header('location: ../login_page/login.php');
    }
    else{
        header('location: register.php');
    }

    
?>