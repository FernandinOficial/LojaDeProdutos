
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

// Processamento para deletar cliente
if (isset($_GET["id_cli"]) && is_numeric($_GET["id_cli"]) && isset($_GET["del"])) {
    $id_cli = (int) $_GET["id_cli"];
    $stmt = $mysqli->prepare("DELETE FROM `cliente` WHERE id_cli = ?");
    $stmt->bind_param('i', $id_cli);
    $stmt->execute();

    header("Location: cadastro.php");
    exit;
}

// Preenchendo os valores para edição
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
    <title>Loja</title>
    <link rel="stylesheet" href="CSS/estilos.css" type="text/css">
    <style>
        * {
            text-align: center;
        }
        input {
            border-radius: 10px;
            background: white;
        }

        h1 {
            color: blue;
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

    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
        <fieldset>
            <legend>
                <h1>Cadastro</h1>
            </legend>

            <label for="nome_cli">Nome completo:</label><br>
            <input type="text" name="nome_cli" value="<?= $nome_cli ?>" required><br><br>

            <label for="rua">Rua:</label><br>
            <input type="text" name="rua" value="<?= $rua ?>" required><br><br>

            <label for="numero">Número:</label><br>
            <input type="text" name="numero" value="<?= $numero ?>" required><br><br>

            <label for="cep">CEP:</label><br>
            <input type="text" name="cep" value="<?= $cep ?>" required><br><br>

            <label for="telefone">Telefone:</label><br>
            <input type="tel" name="telefone" value="<?= $telefone ?>" required><br><br>

            <label for="documento">Tipo de Documento:</label><br>
            <input type="radio" name="documento" id="cpf" value="CPF" <?= $documento == "CPF" ? "checked" : "" ?>
                required><label for="cpf">CPF (Pessoa Física)</label><br>
            <input type="radio" name="documento" id="cnpj" value="CNPJ" <?= $documento == "CNPJ" ? "checked" : "" ?>><label
                for="cnpj">CNPJ (Pessoa Jurídica)</label>
            <br><br>

            <input type="hidden" name="id_cli" value="<?= $id_cli ?>">
            <button type="submit"><?= ($id_cli == -1) ? "Cadastrar" : "Salvar" ?></button>
            <br><br>
            <p>Se deseja fazer seu pedido clique <a class="aqui" href="pedido.php">aqui</a></p>
        </fieldset>
    </form>
    <?php
    require_once 'footer.php';
    ?>
