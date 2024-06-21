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
        <h2>List of all peds</h2>
        <table class="table table-bordered table-striped">
            <tr>
                <td>ID Pedido</td>
                <td>ID Cliente</td>
                <td>Data do Pedido</td>
                <td>Prazo de entrega</td>
                <td>Quantidade do Produto</td>
                <td width="70px">Delete</td>
                <td width="70px">EDIT</td>
            </tr>
        <?php
        while( $row = $result->fetch_assoc())
        {
            echo "<form action='' method='POST'>";  //added
            echo "<input type='hidden' value='".$row['id_ped']."'name='id_ped'/>";
         // echo "<input type='hidden' value='".$row['user_id']."' name='userid'>";
//added
            echo "<tr>";
            echo "<td>".$row['ID Pedido']. "</td>";
            echo "<td>".$row['ID Cliente']. "</td>";
            echo "<td>".$row['Data do Pedido']. "</td>";
            echo "<td>".$row['Prazo de Entrega']. "</td>";
            echo "<td>".$row['Quantidade do Produto']. "</td>";
            echo "<td><input type='submit' name='delete' value='Delete' class='btn btn-danger'/></td>";
           //   echo "<td><a href='edit.php?id=".$row['user_id']."' class='btn btn-info'>Edit</a></td>";
            echo "<td><a href='.php?id=".$row['']."' class='btn btn-info'>Edit</a></td>";
            echo "</tr>";
            echo "</form>";//added
        }
        ?>
        </table>
 
<?php
    }else{
        echo "<br><br>No Record Found";
    }
    ?>
</div>
    <?php 
        require_once 'footer.php';
    ?>