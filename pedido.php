<?php
 
require_once 'includes/db_connect.php';
 
echo "<div class='container'>";
if( isset($_POST['delete'])){
 
        $sql = "DELETE  FROM pedido WHERE id_ped=". $_POST['id_ped'];
        if ($mysqli->query($sql) === TRUE){
 
echo "<div class='alert alert-success'>Successfully delete pedido</div>";
 
    }
}
$sql= "SELECT * FROM pedido";
$result = $mysqli->query($sql);
if( $result->num_rows > 0) {
 
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