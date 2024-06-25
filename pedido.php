<?php
include_once 'includes/db_connect.php';

// Verifica se há uma conexão válida com o banco de dados
if ($mysqli->connect_error) {
    die('Erro na conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido | Supermercado Avante</title>
    <link rel="shortcut icon" href="imagens/iconProduto.png" type="image/x-icon">
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

        .button {
            padding: 10px;
            width: 275px;
            border-radius: 5px;
            background-color: white;
            font-size: 20px;
        }

        .button:hover {
            transition: 1s;
            background-color: rgb(106, 110, 105);
        }
    </style>
</head>

<body>
    <?php require_once 'header.php'; ?>
    <?php



    $sql = "SELECT * FROM cliente";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        ?>
        <h2>Lista de usuários 2.0</h2>
        <table class="tabelapra">
            <tr>
                <th>Nome</th>
                <th>Rua</th>
                <th>Número</th>
                <th>CEP</th>
                <th>Telefone</th>
                <th>Documento</th>
                <th width="70px">Selecionar</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {

                echo "<tr>";
                echo "<td>" . $row['nome_cli'] . "</td>";
                echo "<td>" . $row['rua'] . "</td>";
                echo "<td>" . $row['numero'] . "</td>";
                echo "<td>" . $row['cep'] . "</td>";
                echo "<td>" . $row['telefone'] . "</td>";
                echo "<td>" . $row['documento'] . "</td>";
                echo "<td><a style='color: blue;' href='pedido.php?id=" . $row['id_cli'] . "' class='btn btn-info'>Selecionar</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
        <?php
    } else {
        echo "<br><br>Nenhum registro encontrado";
    }

    ?>
    <?php
    $sql = 'SELECT * FROM cliente WHERE id_cli = ' . $_GET["id"];
    echo $sql;
    ?>
    <form action="prateleira.php" method="POST">
        <div class="container">
            <fieldset id="fieldsetcad">
                <legend>
                    <h1>Pedido</h1>
                </legend><br>

                <label for="id">Id Cli</label><br>
                <input type="text" name="id" disabled value="<?php echo $_GET["id"]; ?>" required><br><br>

                <label for="nome_cli">nome_cli</label><br>
                <input type="text" name="nome_cli" value="<?php echo $_GET["nome_cli"]; ?>" required><br><br>

                <label for="nome_prod">Produto</label><br>
                <input type="text" name="nome_prod" value="<?php echo $nome_prod; ?>" required> <br><br>

                <label for="data_ped">Data de emissão:</label><br>
                <input type="text" name="data_ped" value="<?php echo $data_ped; ?>" required><br><br>

                <input type="hidden" name="id_cli" value="<?php echo $id_cli; ?>"><br>

                <button class="button" type="submit"></button><br><br>
                <p>Clique <a class="aqui" href="produto.php">aqui</a> para fazer o seu pedido</p>
            </fieldset>
        </div>
    </form>
    <?php require_once 'footer.php'; ?>
</body>