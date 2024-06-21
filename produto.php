<?php
include_once 'includes/db_connect.php';

$erro = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nome_prod"], $_POST["preco_unit"], $_POST["desc_prod"])) {
        // Validando campos obrigatórios

        if (empty($_POST["nome_prod"]) && empty($_POST["preco_unit"]) && empty($_POST["desc_prod"])) {
            $erro = "Todos os campos são obrigatórios.";
        } else {
            $nome_prod = $_POST["nome_prod"];
            $preco_unit = $_POST["preco_unit"];
            $desc_prod = $_POST["desc_prod"];

            // Inserindo ou atualizando no banco de dados


            if ($id == -1) {
                $stmt = $mysqli->prepare("INSERT INTO `produto` (`nome_prod`, `desc_prod`, `preco_unit`) VALUES (?, ?, ?)");
                $stmt->bind_param("sssiss", $nome_prod, $desc_prod, $preco_unit);

                if ($stmt->execute()) {
                    header("Location: pro.php");
                    exit;
                } else {
                    $erro = "Erro ao cadastrar produto: " . $stmt->error;
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
if (isset($_GET["id_prod"]) && is_numeric($_GET["id_prod"]) && isset($_GET["del"])) {
    $id_cli = (int) $_GET["id_prod"];
    $stmt = $mysqli->prepare("DELETE FROM `produto` WHERE id_prod = ?");
    $stmt->bind_param('i', $id_prod);
    $stmt->execute();

    header("Location: produto.php");
    exit;
}

// Preenchendo os valores para edição
$nome_prod = isset($_POST["nome_prod"]) ? $_POST["nome_prod"] : "";

$preco_unit = isset($_POST["preco_unit"]) ? $_POST["preco_unit"] : "";

$desc_prod = isset($_POST["desc_prod"]) ? $_POST["desc_prod"] : "";

$id_prod = isset($_POST["id_prod"]) ? $_POST["id_prod"] : -1;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto | Supermercado Avante</title>
    <link rel="shortcut icon" href="imagens/iconProduto.png" type="image/x-icon">
    <link rel="stylesheet" href="CSS/estilos.css">
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

                <input type="hidden" name="id_prod" value="<?= $id_prod ?>">
                <button type="submit" class="cadastrar"><?= ($id_prod == -1) ? "Cadastrar" : "Salvar" ?></button>
                <br><br>
                
            </fieldset>
        </div>
    </form>

    <?php
    require_once 'footer.php';
    ?>