<?php require "exes/getSessionInfo.php" ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="itens_admin.css">
    <title>Edição de Itens | Admin</title>
</head>
<body>

<div id= 'header_div'>
    <div id= 'head_logo'>
        <h1 id= 'head_logo_text'>GB CLICKER</h1>
    </div>
    <div id= 'info_div'>
        <?php echo "<h1 class='infos'>Username: " . $_SESSION['logged_username'] . "</h1>"; ?>
    </div>
</div>
<div id='form_div'>
    <form method='POST' action='exes/create_item.php'>
        <ul>
            <li><input name='nome_item_input' type='text' placeholder='Nome do Item' required></li>
            <li><input name='preco_item_input' type='text' placeholder='Preço do Item' required></li>
            <li><label id='change_image_label' for='change_image_input'>Enviar Imagem</label><input id="change_image_input" name='change_image_input' type= 'file' required></li>
            <li><button>Criar Item</button></li>
        </ul>
    </form>
</div>
</body>
</html>