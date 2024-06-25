<?php
include_once 'includes/db_connect.php';

$erro = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nome_prod"], $_POST["desc_prod"], $_POST["preco_unit"])) {
        // Validando campos obrigatórios
        if (empty($_POST["nome_prod"]) || empty($_POST["desc_prod"]) || empty($_POST["preco_unit"])) {
            $erro = "Todos os campos são obrigatórios.";
        } else {
            $id_prod = isset($_POST["id_prod"]) ? $_POST["id_prod"] : -1;
            $nome_prod = $_POST["nome_prod"];
            $desc_prod = $_POST["desc_prod"];
            $preco_unit = $_POST["preco_unit"];
            
            // Inserindo ou atualizando no banco de dados
            if ($id_prod == -1) {
                $stmt = $mysqli->prepare("INSERT INTO `produto` (`nome_prod`, `desc_prod`, `preco_unit`) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $nome_prod, $desc_prod, $preco_unit);

                if ($stmt->execute()) {
                    header("Location: produto.php");
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

// Processamento para deletar produto
if (isset($_GET["id_prod"]) && is_numeric($_GET["id_prod"]) && isset($_GET["del"])) {
    $id_prod = (int) $_GET["id_prod"];
    $stmt = $mysqli->prepare("DELETE FROM `produto` WHERE id_prod = ?");
    $stmt->bind_param('i', $id_prod);
    $stmt->execute();

    header("Location: produto.php");
    exit;
}

// Preenchendo os valores para edição
$nome_prod = isset($_POST["nome_prod"]) ? $_POST["nome_prod"] : "";
$desc_prod = isset($_POST["desc_prod"]) ? $_POST["desc_prod"] : "";
$preco_unit = isset($_POST["preco_unit"]) ? $_POST["preco_unit"] : "";
$id_prod = isset($_POST["id_prod"]) ? $_POST["id_prod"] : -1;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>+ Produto | Supermercado Avante</title>
    <link rel="shortcut icon" href="imagens/iconProduto.png" type="image/x-icon">
    <link rel="stylesheet" href="CSS/estilos.css">
    <style>
        * {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php if (!empty($erro)): ?>
        <p><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <?php
    require_once 'header.php';
    ?>

    <form action="produto.php" method="POST">
        <div class="container">
            <fieldset id="fieldsetcad">
                <legend>
                    <h1>Produto</h1>
                </legend>
                <label for="nome_prod">Nome do produto:</label><br>
                <input type="text" name="nome_prod" value="<?= htmlspecialchars($nome_prod) ?>" required><br><br>

                <label for="desc_prod">Descrição do produto:</label><br>
                <input type="text" name="desc_prod" value="<?= htmlspecialchars($desc_prod) ?>" required><br><br>

                <label for="preco_unit">Preço:</label><br>
                <input type="text" name="preco_unit" value="<?= htmlspecialchars($preco_unit) ?>" required><br><br>

                <input type="hidden" name="id_prod" value="<?= htmlspecialchars($id_prod) ?>">
                <button type="submit" style="cursor: pointer;"><?= ($id_prod == -1) ? "Cadastrar" : "Salvar" ?></button>
                <br><br>
                <p>Se deseja fazer seu pedido clique <a class="aqui" href="pedido.php">aqui</a></p>
            </fieldset>
        </div>
    </form>

    <?php
    require_once 'footer.php';
    ?>
</body>

</html>