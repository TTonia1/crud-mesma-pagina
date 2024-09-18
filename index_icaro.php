<?php //conecxao com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "sistema_pedidos";
    $conn = new mysqli($servername,$username,$password,$dbname);
        if($conn -> connect_error){
            die('Conexão falhou'.$conn -> connect_error);
        }

    if(isset($_POST['create'])){ //quando o formulario é enviado na mesma pagina isset e seu nome é create
        $nome_cliente = $_POST['nome_cliente'];
        $nome_produto = $_POST['nome_produto'];
        $quantidade = $_POST['quantidade'];
        $data_pedido = $_POST['data_pedido'];
 
    $sql= "INSERT INTO pedidos(nome_cliente , nome_produto, quantidade, data_pedido) VALUE('$nome_cliente',' $nome_produto', ' $quantidade', '$data_pedido')";
    if($conn -> query($sql) === true){
        echo"Novo pedido adicionado com sucesso.";
    }else{
        echo "Echo". $sql . "<br>" . $conn -> error;
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

    if(isset($_POST['update'])){ //quando o formulario é enviado na mesma pagina isset e seu nome é update
        $id = $_POST['id'];
        $nome_cliente = $_POST['nome_cliente'];
        $produto = $_POST['nome_produto'];
        $quantidade = $_POST['quantidade'];
        $data_pedido = $_POST['data_pedido'];
    
        $sql= "UPDATE pedidos SET nome_cliente='$nome_cliente', nome_produto=' $nome_produto', quantidade=' $quantidade', data_pedido='$data_pedido' WHERE id = $id";
    
        if($conn -> query($sql) === true){
            echo"Pedido atualizado com sucesso.";
        }else{
            echo "Echo". $sql . "<br>" . $conn -> error;
        }
    }

    $result = $conn -> query("SELECT * FROM pedidos");// recebe a matriz do banco
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = 'stylesheet' href="style.css"> 
    <title>Crud Icaro</title>
</head>
<body>
    <form method='POST'>
        Nome Cliente : <input type='text' name='nome_cliente' require> <br><br>
        Nome Produto : <input type='text' name='nome_produto' require> <br><br>
        Quantidade : <input type='text' name='quantidade' require> <br><br>
        Data Pedido : <input type='date' name='data_pedido' require> <br><br>
        <input type="submit" name='create' value='Adicionar Pedido'>
    </form>
    <h2>Ler os Pedidos</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome Cliente</th>
            <th>Nome Produto</th>
            <th>Quantidade</th>
            <th>Data Produto</th>
            <th>Açoes</th>
        </tr>
        <?php while($row = $result-> fetch_assoc()){//fetch ele pergunta se tem conteudo caso tiver ele tras
        ?>
        <tr>
            <td><?php echo $row['id'];?></td>
            <td><?php echo $row['nome_cliente'];?></td>
            <td><?php echo $row['nome_produto'];?></td>
            <td><?php echo $row['quantidade'];?></td>
            <td><?php echo $row['data_pedido'];?></td>
            <td>
                <a href='index_icaro.php?delete=<?php echo $row['id']?>'>Excluir</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <h2>Atualizar Pedidos</h2>

    <from method= 'POST'>
        ID : <input type='text' name='id' require> <br><br>
        Novo Nome : <input type='text' name='nome_cliente' require> <br><br>
        Novo Produto : <input type='text' name='nome_produto' require> <br><br>
        Quantidade : <input type='text' name='quantidade' require> <br><br>
        Data Pedido : <input type='date' name='data_pedido' require> <br><br>
        <input type="submit" name='update' value='Editar Pedido'>
    </from>
    
</body>
</html>