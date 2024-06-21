<?php
require_once 'includes/db_connect.php';
require_once 'header.php';

if (isset($_POST['delete'])) {
    $sql = "DELETE FROM produto WHERE id_prod=" . $_POST['id_prod'];
    if ($mysqli->query($sql) === TRUE) {
        echo "deletado com sucesso";
    }
}

$sql = "SELECT * FROM produto";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
}

?>

<link rel="stylesheet" href="CSS/estilos.css" type="text/css">
<h2>Prateleira de Produtos</h2>
<table border="1" class="tabelapra">
    <tr>
        <th>Id do Produto</th>
        <th>Nome do produto</th>
        <th>Preço</th>
        <th>Descrição</th>
        <th width="70px">Delete</th>
    </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<form action='' method='POST'>";
        echo "<input type='hidden' value='" . $row['id_prod'] . "' name='id_prod' />";

        echo "<tr>";
        echo "<td>" . $row['id_prod'] . "</td>";
        echo "<td>" . $row['nome_prod'] . "</td>";
        echo "<td>" . $row['preco_unit'] . "</td>";
        echo "<td>" . $row['desc_prod'] . "</td>";

        echo "<td><input type='submit' name='delete' value='Delete' class='delete'/></td>"; // cria um input que serve como o botão de delete
    
        echo "</tr>";
        echo "</form>";
    }

    ?>

</table>