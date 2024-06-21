<?php
    require_once 'includes/db_connect.php';
    require_once 'header.php';

    if(isset($_POST['delete'])) {
        $sql = "DELETE FROM produto WHERE id_prod=".$_POST['id_prod'];
        if($mysqli->query($sql) === TRUE) {
            echo "deletado com sucesso";
        }
    }



    
        ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prateleira</title>
    <link rel="stylesheet" href="CSS/estilos.css" type="text/css">
</head>
<body>
    <h2>Prateleira de Produtos</h2>
    <table border="1" class="tabelapra">
        <tr>
            <td>Id do Produto</td>
            <td>Nome do produto</td>
            <td>Preço</td>
            <td>Descrição</td>
            <td width="70px">Delete</td>
            <td width="70px">EDIT</td>
        </tr>
    </table>
</body>
</html>
    