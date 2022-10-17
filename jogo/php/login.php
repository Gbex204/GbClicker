<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/login.css">
    <title>GbClicker | Logar</title>
</head>
<body>
    <div id= 'container'>
        <div id= 'login_logo'>
            <h1 id= 'login_logo_h1'>GB CLICKER</h1>
        </div>
        <form id= 'login_form' method= 'POST' action= '../bd/login_exe.php'>
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
    
</body>
</html>