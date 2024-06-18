<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Links</title>
    <link rel="stylesheet" href="CSS/estilos.css">
    <style>
        * {
            text-align: center;
            font-family: arial;
            font-family: Arial, Helvetica, sans-serif;
        }

        fieldset {
            margin-top: 10em;
            margin-left: 50em;
            margin-right: 50em;
            border-radius: 15px;
        }

        #a_link {
            color: blue;
        }
        #a_link:hover{
            transition: 500ms;
            transform: scale(1.1);
        }
    </style>
</head>

<body>
    <?php

    require_once 'header.php';

    ?>
    <fieldset>
        <legend>
            <h2>Caixa</h2>
        </legend>
        <h1>Cliente novo?</h1>
        <a href="cadastro.php" id="a_link"><h2>Cadastrar</h2></a><br>

        <hr>

        <h1>Realizar pedido novo</h1>
        <a href="pedido.php" id="a_link"><h2>Pedido</h2></a><br>

        <hr>

        <h1>Explorar produtos</h1>
        <a href="prateleira.php" id="a_link"><h2>Prateleira</h2></a>

        <a href="https:www.google.com" id="a_sair"><h3 style="color: red; float: right; padding-right: 8%;">Sair da loja</h3></a>
    </fieldset>
</body>

</html>