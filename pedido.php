<?php
include_once 'includes/db_connect.php';
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
    <?php
    require_once 'header.php';

    $sql = "SELECT * FROM cliente";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        ?>
        <h2>List of all Users</h2>
        <table class="table table-bordered table-striped" border="1">
            <tr>
                <td>Nome</td>
                <td>Rua</td>
                <td>Número</td>
                <td>CEP</td>
                <td>Telefone</td>
                <td>Documento</td>
                <td width="70px">Selecionar</td>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<form action='' method='POST'>";   //lista oculta
                echo "<input type='hidden' value='" . $row['id_cli'] . "' name='userid' />";
                echo "<tr>";
                echo "<td>" . $row['nome_cli'] . "</td>";
                echo "<td>" . $row['rua'] . "</td>";
                echo "<td>" . $row['numero'] . "</td>";
                echo "<td>" . $row['cep'] . "</td>";
                echo "<td>" . $row['telefone'] . "</td>";
                echo "<td>" . $row['documento'] . "</td>";

                echo "<td><a href='pedido.php?id=" . $row['id_cli'] . "' class='btn btn-info'>Selecionar</a></td>";
                echo "</tr>";
                echo "</form>";
            }
            ?>
        </table>
        <?php
    } else {
        echo "<br><br>No Record Found";
    }
    ?>


    <form action="prateleira.php" method="POST">
        <div class="container">
            <fieldset id="fieldsetcad">
                <legend>
                    <h1>Pedido</h1>
                </legend><br>

                <label for="">Nome Cliente</label><br>
                <input type="text" name="nome_cli" value="<?php $nome_cli ?>"><button action="<? php ?>"
                    style="color: blue;">Pesquisar</button> <br><br>

                <label for="">Produto</label><br>
                <input type="text" name="nome_prod" value="<?php $nome_prod ?>"> <br><br>

                <label for="data_ped">Data de emissão:</label><br>
                <input type="text" name="numero" value="<?php $data_ped ?>" required><br><br>

                <input type="hidden" name="id_cli" value="<?php $id_cli ?>"><br>
                <button class="button" type="submit"><? ($id_cli == -1) ?>Comprar</button>
                <br><br>
                <p>Clique <a class="aqui" href="produto.php">aqui</a> para fazer o seu </p>
            </fieldset>
        </div>
    </form>
    <?php
    require_once 'footer.php';
    ?>