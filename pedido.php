<?php
include_once 'includes/db_connect.php';

$erro = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    se nome cliente = id cli referencie a tabela daquele cliente 
    se nome produto = id prod referencia a tabela com o valor deste determinado produto 
    
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Avante</title>
    <link rel="stylesheet" href="CSS/estilos.css" type="text/css">
    <style>
        * {
            text-align: center;
        }
        input {
            border-radius: 5px;
            background: white;
        }

        h1 {
            color: black;
        }

        button {
            padding: 10px;
            width: 275px;
            border-radius: 5px;
            background-color: white;
            font-size: 20px;
        }

        button:hover {
            transition: 1s;
            background-color: rgb(106, 110, 105);
        }
        
    </style>
</head>

<body>
    <?php if (!empty($erro)): ?>
        <p> <?php $erro ?></p>
    <?php endif; ?>

    <?php
    require_once 'header.php'; 
    ?>

    <form action="prateleira.php" method="POST">
        <div class="container">
            <fieldset id="fieldsetcad"><legend><h1>Pedido</h1></legend><br>

                <label for="">Nome</label>
                <input type="text" name="nome_cli" > 

                <label for="prazo_entrega">Prazo de entrega:</label><br>
                <input type="text" name="rua" value="<?php $rua ?>" required><br><br>

                <label for="data_ped">Data do pedido:</label><br>
                <input type="text" name="numero" value="<?php $numero ?>" required><br><br>

                <input type="hidden" name="id_cli" value="<?php $id_cli ?>"><br>
                <button type="submit"><? ($id_cli == -1)?>Comprar</button>
                <br><br>
                <p>Clique <a class="aqui" href="produto.php">aqui</a> para fazer o seu </p>
            </fieldset>
        </div>
    </form>
    <?php
    require_once 'footer.php';
    ?>
