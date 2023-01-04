<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="register.css">
    <title>GbClicker | Registrar</title>
</head>

<body>
    <div id='container'>
        <div id= 'register_logo'>
            <h1 id= 'register_logo_h1'>GB CLICKER</h1>
        </div>
        <form id= 'register_form' method= 'POST' action= 'register_exe.php'>
            <section class='register_form_section'>
                <label>Email:</label>
                <input name= 'register_input_email' type= 'email' placeholder= 'Digite aqui seu email...'>
            </section>
            <section class='register_form_section'>
                <label>Senha:</label>
                <input name= 'register_input_password' type='password' placeholder= 'Digite aqui sua senha...'>
            </section>
            <section class='register_form_section'>
                <label>Nome:</label>
                <input name= 'register_input_username' type='text' placeholder= 'Digite aqui seu nome...'>
            </section>
            <section class= 'register_form_section'>
                <input id= 'btnregister' type= 'submit' value='Registrar'>
            </section>
            <section class= 'register_form_section'>
                <h3 id='register_h3'>Já possui conta? <a id='register_a' href='../login_page/login.php'>Entre aqui</a></h3>
            </section>
        </form>
    </div>
</body>
</html>

<?php
        if(isset($_GET['erro'])){
            if($_GET['erro'] == 1){
                echo "<script language='JavaScript'>alert('Inputs vazios! Tente novamente...')</script>";
            }
            else if($_GET['erro'] == 2){
                echo "<script language='JavaScript'>alert('Não foi possível completar o registro!')</script>";
            }
        }
    ?>