<?php
include_once 'includes/db_connect.php';

$erro = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["data_ped"], $_POST["prazo_entrega"])) {
        // Validando campos obrigatórios
        if (empty($_POST["data_ped"]) || empty($_POST["prazo_entrega"])) {

            $erro = "Todos os campos são obrigatórios.";

        } else {
            
            $id_ped = $_POST["id_ped"];
            $data_ped = $_POST["data_ped"];
            $prazo_entrega = $_POST["prazo_entrega"];

            // Inserindo ou atualizando no banco de dados
            if ($id_ped == -1) {
                $stmt = $mysqli->prepare("INSERT INTO `pedido` (`data_ped`, `prazo_entrega`) VALUES (?, ?)");
                $stmt->bind_param("sssiss", $data_ped, $prazo_entrega);

                if ($stmt->execute()) {
                    header("Location: pedido.php");
                    exit;
                } else {
                    $erro = "Erro ao cadastrar pedido: " . $stmt->error;
                }
            } else {
                $erro = "Operação não suportada.";
            }
        }
    } else {
        $erro = "Todos os campos são obrigatórios.";
    }
}

// processamento para deletar cliente
if (isset($_GET["id_ped"]) && is_numeric($_GET["id_ped"]) && isset($_GET["del"])) {
    $id_ped = (int) $_GET["id_ped"];
    $stmt = $mysqli->prepare("DELETE FROM `pedido` WHERE id_ped = ?");
    $stmt->bind_param('i', $idid_ped_cli);
    $stmt->execute();

    header("Location: pedido.php");
    exit;
}

// preenchendo os valores para edição
$prazo_entrega = isset($_POST["prazo_entrega"]) ? $_POST["prazo_entrega"] : "";
$data_ped = isset($_POST["data_ped"]) ? $_POST["data_ped"] : "";
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
        <p> <?= $erro ?></p>
    <?php endif; ?>

    <?php
    require_once 'header.php'; 
    ?>

    <form action="prateleira.php" method="POST">
        <div class="container">
            <fieldset id="fieldsetcad"><legend><h1>Pedido</h1></legend><br>
        
                <label for="prazo_entrega">Prazo de entrega:</label><br>
                <input type="text" name="rua" value="<?= $rua ?>" required><br><br>

                <label for="data_ped">Data do pedido:</label><br>
                <input type="text" name="numero" value="<?= $numero ?>" required><br><br>

                <input type="hidden" name="id_cli" value="<?= $id_cli ?>"><br>
                <button type="submit"><?= ($id_cli == -1) ? "Cadastrar" : "Salvar" ?></button>
                <br><br>
                <p>Clique <a class="aqui" href="produto.php">aqui</a> para fazer o seu </p>
            </fieldset>
        </div>
    </form>
    <?php
    require_once 'footer.php';
    ?>
