<?php
    include_once 'includes/db_connect.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja</title>
    <style>
        *{
            text-align: center;
            font-family: arial;
            background: #EEE;  
        }
        body{
            background-color: gray;
        }
        fieldset{
            margin-top: 10em;
            margin-left: 50em;
            margin-right: 50em;   
        }
        input {
            border-radius: 10px;
            background: white;
        }
    </style>
</head>
<body>
    <form action="cadastro.php" method="POST">

        <fieldset>
            <legend><h1>Cadastro</h1></legend>

        <label for="">Nome completo:</label><br>
        <input type="text" name="nome_cli" required><br><br>

        <label for="rua">Rua:</label><br>
        <input type="text" name="rua" required><br><br>
        
        <label for="numero">Número:</label><br>
        <input type="number" name="numero" required><br><br>    
        
        <label for="cep">CEP:</label><br>
        <input type="text" name="cep" required><br><br>
        
        <label for="telefone">Telefone:</label><br>
        <input type="tel" name="telefone" required><br><br>

        <label for="documento">Tipo de Documento:</label><br>
        <input type="radio" name="documento" id="cpf" required><label for="cpf">CPF (Pessoa Física)</label><br>
        <input type="radio" name="documento" id="cnpj"><label for="cnpj">CNPJ (Pessoa Jurídica)</label>
        <br><br>
        <input type="submit" value="Enviar">
        <br><br>
        <p>Se deseja fazer seu pedido clique <a href="pedido.php">aqui</a></p>
        </fieldset>
    </form>
</body>
</html>

<?php 

        

?>