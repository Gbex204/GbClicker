<?php
    $sqlItems = "SELECT FK_item_name FROM updates WHERE FK_user_email = '$logged_email';";   // primeiro é visto se há itens relacionados a conta logada
    $result = $conn->query($sqlItems);   // mandando o sql para o banco de dados
    if($result->num_rows>0){   // caso seja encontrado algum item entrará no IF
        while($row = $result->fetch_assoc()){   // enquanto estiver itens que correspondem à pesquisa, os comandos dentro do while serão executados
            $sqlItemsImages= "SELECT image FROM shop WHERE name = '".$row['FK_item_name']."'";   // com o nome dos itens comprados pelo usuário, sua imagem é achada na tabela "shop"
            $resultImage= $conn->query($sqlItemsImages);   // mandando o sql para o banco de dados
            $resultImage= $resultImage->fetch_assoc();   // transformando os dados achados em uma array associativa
            echo"
                <img src='data:image;base64,".base64_encode($resultImage['image'])."' style='position:absolute; height:60%; width: 85%;'>
            ";   // colocando a imagem do item na frente da imagem usada no clicker (gb.png)
        }
    }
?>