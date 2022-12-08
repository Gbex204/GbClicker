<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="login.css">
    <title>GbClicker | Logar</title>
</head>
<body>
    <div id= 'container'>
        <div id= 'login_logo'>
            <h1 id= 'login_logo_h1'>GB CLICKER</h1>
        </div>
        <form id= 'login_form' method= 'POST' action= 'login_exe.php'>
            <section class='login_form_section'>
                <label>Email:</label>
                <input name= 'login_input_email' type= 'email' placeholder= 'Digite aqui seu email...'>
            </section>
            <section class='login_form_section'>
                <label>Senha:</label>
                <input name= 'login_input_password' type='password' placeholder= 'Digite aqui sua senha...'>
            </section>
            <section class= 'login_button_section'>
                <input id= 'btnLogin' type= 'submit' value='Logar'>
            </section>
        </form>
    </div>
    <?php
        if(isset($_GET['erro'])){
            if($_GET['erro'] == 1){
                echo "<script language='JavaScript'>alert('Conta não encontrada! Tente novamente...')</script>";
            }
        }
        else if(isset($_GET['erro'])){
            if($_GET['erro'] == 2){
                echo "<script language='JavaScript'>alert('Inputs vazios! Tente novamente...')</script>";
            }
        }
        else if(isset($_GET['erro'])){
            if($_GET['erro'] == 3){
                echo "<script language='JavaScript'>alert('ERRO FATAL AO SALVAR!')</script>";
            }
        }
        else if(isset($_GET['registrado'])){
            if($_GET['registrado'] == 'true'){
                echo "<script language='JavaScript'>alert('Registrado com Sucesso!')</script>";
            }
        }
    ?>
</body>
</html>