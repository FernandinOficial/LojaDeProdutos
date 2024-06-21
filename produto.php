<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produtos</title>
    <link rel="stylesheet" href="CSS/estilos.css">
    <style>
        * {
            text-align: center;
            font-family: arial;

        }

        fieldset {
            margin-top: 10em;
            margin-left: 50em;
            margin-right: 50em;
        }

        input {
            border-radius: 10px;
            padding: 5px;
        }
    </style>
</head>

<body>
    <?php
    require_once 'header.php';
    ?>

    <form action="prateleira.php" method="post">
        <div class="container">
            <fieldset>
                <legend>
                    <h1>Cadastro Do Produto</h1>
                </legend>
                <label for="nome_prod">Nome do Produto</label><br>
                <input type="text" name="nome_prod" value="<?= $nome_prod ?>" placeholder="Nome do Produto" <br><br>

                <label for="preco_unit">Preço</label><br>
                <input type="number" name="preco_unit" value="<?= $preco_unit ?>" placeholder="R$ 0,00"><br><br>

                <label for="desc_prod">Descrição</label><br>
                <textarea name="desc_prod" id="desc_prod" value="<?= $desc_prod ?>"
                    placeholder="Escreva aqui..."></textarea> <br>

                <input type="submit" value="Enviar">
            </fieldset>
        </div>
    </form>

    <?php
    require_once 'footer.php';
    ?>