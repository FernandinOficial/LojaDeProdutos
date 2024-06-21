<?php
include_once 'includes/db_connect.php';

$erro = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nome_cli"], $_POST["rua"], $_POST["numero"], $_POST["cep"], $_POST["telefone"], $_POST["documento"])) {
        // Validando campos obrigatórios
        if (empty($_POST["nome_cli"]) || empty($_POST["cep"]) || empty($_POST["numero"]) || empty($_POST["telefone"]) || empty($_POST["documento"])) {
            $erro = "Todos os campos são obrigatórios.";
        } else {
            $id = $_POST["id_cli"];
            $nome_cli = $_POST["nome_cli"];
            $rua = $_POST["rua"];
            $numero = $_POST["numero"];
            $cep = $_POST["cep"];
            $telefone = $_POST["telefone"];
            $documento = $_POST["documento"];

            // Inserindo ou atualizando no banco de dados
            if ($id == -1) {
                $stmt = $mysqli->prepare("INSERT INTO `cliente` (`nome_cli`, `rua`, `numero`, `cep`, `telefone`, `documento`) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssiss", $nome_cli, $rua, $numero, $cep, $telefone, $documento);

                if ($stmt->execute()) {
                    header("Location: cadastro.php");
                    exit;
                } else {
                    $erro = "Erro ao cadastrar cliente: " . $stmt->error;
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
if (isset($_GET["id_cli"]) && is_numeric($_GET["id_cli"]) && isset($_GET["del"])) {
    $id_cli = (int) $_GET["id_cli"];
    $stmt = $mysqli->prepare("DELETE FROM `cliente` WHERE id_cli = ?");
    $stmt->bind_param('i', $id_cli);
    $stmt->execute();

    header("Location: cadastro.php");
    exit;
}

// preenchendo os valores para edição
$nome_cli = isset($_POST["nome_cli"]) ? $_POST["nome_cli"] : "";
$rua = isset($_POST["rua"]) ? $_POST["rua"] : "";
$numero = isset($_POST["numero"]) ? $_POST["numero"] : "";
$cep = isset($_POST["cep"]) ? $_POST["cep"] : "";
$telefone = isset($_POST["telefone"]) ? $_POST["telefone"] : "";
$documento = isset($_POST["documento"]) ? $_POST["documento"] : "";
$id_cli = isset($_POST["id_cli"]) ? $_POST["id_cli"] : -1;

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
        }

        button:hover {
            transition: 3s;
            background-color: ;
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
