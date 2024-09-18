<?php //conecxao com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "sistema_pedidos";
    $conn = new mysqli($servername,$username,$password,$dbname);
        if($conn -> connect_error){
            die('Conexão falhou'.$conn -> connect_error);
 }
if(isset($_POST['create'])){

    $nome_cliente = $_POST['nome_cliente'];
    $nome_produto= $_POST['nome_produto'];
    $quantidade= $_POST['quantidade'];
    $data_pedido= $_POST['data_pedido'];
    $sql = "INSERT INTO pedidos (nome_cliente, nome_produto,quantidade, data_pedido) VALUE ('$nome_cliente','$nome_produto','$quantidade', '$data_pedido')";
    $resultado = $conn-> query($sql);
    if($conn -> query($sql) === true){
        echo"Novo registro adiocionado";
    }else{
        echo"Erro". $slq ."<br>".$conn -> error;
    }
}
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql = "DELETE FROM pedidos WHERE id = '$id'";
    if($conn -> query($sql) === true){
        echo"Novo pedido excluido com sucesso.";
     }else{
        echo "Echo". $sql . "<br>" . $conn -> error;
}
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $nome_cliente = $_POST['nome_cliente'];
    $nome_produto= $_POST['nome_produto'];
    $quantidade= $_POST['quantidade'];
    $data_pedido= $_POST['data_pedido'];
    $sql= "UPDATE pedidos SET nome_cliente='$nome_cliente', nome_produto=' $nome_produto', quantidade=' $quantidade', data_pedido='$data_pedido' WHERE id = $id";
    $resultado = $conn-> query($sql);
    if($conn -> query($sql) === true){
        echo"Registro Atualizado";
    }else{
        echo"Erro". $slq ."<br>".$conn -> error;
    }
}
$result = $conn -> query("SELECT * FROM pedidos");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = 'stylesheet' href="style.css"> 
    <title>Aula4</title>
</head>
    <body>
    <form method="POST">
        <label for="nome_cliente"> Nome Cliente:</label>
        <input type="text" name="nome_cliente" required>
        <label for="nome_prduto"> Nome Produto:</label>
        <input type="text" name="nome_produto" required>
        <label for="quantidade"> Quantidade:</label>
        <input type="int" name="quantidade" required>
        <label for="data_pedido"> Data Pedido:</label>
        <input type="date" name="data_pedido" required>
        <input type="submit" name='create' value="Enviar">
     </form>
    </body>
    <h2>Leitura dos pedidos</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Data Pedido</th>
                <th>Ações</th>
            </tr>
        <?php while($row = $result-> fetch_assoc()){
        ?>
        <tr>
            <td><?php echo $row['id'];?></td>
            <td><?php echo $row['nome_cliente'];?></td>
            <td><?php echo $row['nome_produto'];?></td>
            <td><?php echo $row['quantidade'];?></td>
            <td><?php echo $row['data_pedido'];?></td>
            <td>
                <a href='index_antonia.php?delete=<?php echo $row['id']?>'>Excluir</a>
            </td>
        </tr>
        <?php } ?>
        </table>
        <br></br>
        <form method="POST">
            <label for="id"> ID:</label>
            <input type="text" name="id" required>
            <label for="nome_cliente"> Novo Nome:</label>
            <input type="text" name="nome_cliente" required>
            <label for="nome_prduto"> Novo Produto:</label>
            <input type="text" name="nome_produto" required>
            <label for="quantidade"> Quantidade:</label>
            <input type="int" name="quantidade" required>
            <label for="data_pedido"> Data Pedido:</label>
            <input type="date" name="data_pedido" required>
            <input type="submit" name='update' value="Atualizar">
     </form>
</html>

