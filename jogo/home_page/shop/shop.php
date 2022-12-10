<?php require "exes/getSessionInfo.php" ?>
<?php 
    $shop = $conn->query('SELECT * FROM shop');

    if(isset($_GET['erro'])){
        if($_GET['erro'] == 1){
            echo "<script language='JavaScript'>alert('Não foi possível completar a compra!')</script>";
        }
    }
    if(isset($_GET['erro'])){
        if($_GET['erro'] == 2){
            echo "<script language='JavaScript'>alert('Pouco dinheiro para realizar a compra!')</script>";
        }
    }
?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Loja</title>
    <link rel="stylesheet" href="shop.css">
</head>
<body>
    <div id= 'header_div'>
        <div id= 'head_logo'>
            <h1 id= 'head_logo_text'>GB CLICKER</h1>
        </div>
        <div id= 'info_div'>
            <?php echo "<h1 class= 'infos'>Username: " . $_SESSION['logged_username'] . "</h1>"; ?>
            <?php echo "<h1 id= 'show_money' class= 'infos'>Money: " . $_SESSION['logged_money'] . "</h1>"; ?> <!-- A troca de valor do dinheiro será feita pelo javascript. -->
            <?php echo "<h1 id= 'show_multiplier' class= 'infos'>Multiplier: " . $_SESSION['logged_multiplier'] . "x</h1>"; ?> <!-- A troca de valor do dinheiro será feita pelo javascript. -->
            <?php echo "<h1 id= 'show_gbminions' class= 'infos'>Gb Minions: " . $_SESSION['logged_gbminions'] . "x</h1>"; ?> <!-- A troca de valor do dinheiro será feita pelo javascript. -->
        </div>
    </div>
    <div id='loja_div'>
        <table>
            <tr style='height:20%;'>
                <th colspan='5'>Loja</th>
            </tr>
            <?php
                $i = 0;
                $j = 0;
                while($j < 4){
                    if($i==0){echo"<tr style='height:20%;'>"; $i+=1;}
                    while($row = $shop->fetch_assoc()){
                        $item_name = $row['name'];
                        $item_price = $row['price'];
                        echo "<td onclick='comprar(`$logged_email`, `$logged_money`, `$item_name`, `$item_price`)'>
                                <div id='td_div_em_cima'>
                                    <div style='height:100%;'>
                                        <img id='imagem_item' src='data:image;base64,".base64_encode($row['image'])."' alt= 'Foto do item'>
                                    </div>
                                </div>
                                <div id='td_div_embaixo'>" . $row['name'] . " " . $row['price'] . "R$
                                </div>
                              </td>";
                        $i+=1;
                        if($i == 6){
                            echo "</tr>";
                            $j += 1; $i = 0;
                        }
                    }
                    while($i<6){echo"<td></td>"; $i+=1;}
                    if($i==6){echo"</tr>"; $j+=1; $i=0;}
                }
            ?>
        </table>
    <div>
    <script src='js/script_shop.js'></script>
</body>
</html>