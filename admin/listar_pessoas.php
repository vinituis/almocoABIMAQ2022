<?php

include '../config.php';

$ref_cad = $_GET['id_cad'];
$mesa = $_GET['mesa'];

$select = "SELECT * FROM pessoas WHERE ref_cad = '$ref_cad' && ref_mesa = '$mesa' ORDER BY pessoas.cadeira ASC";
$result = mysqli_query($conn, $select);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/global.css">
</head>
<body>
    <table>
        <tr>
            <td>Mesa</td>
            <td>Cadeira</td>
            <td>Nome</td>
            <td>E-mail</td>
            <td>Empresa</td>
        </tr>
<?php

if(mysqli_num_rows($result) >= 1){
    while ($reg = mysqli_fetch_assoc($result)){
        echo $reg['nome'];

        ?>
        <tr>
            <td><?php echo $reg['ref_mesa']; ?></td>
            <td><?php echo $reg['cadeira']; ?></td>
            <td><?php echo $reg['nome']; ?></td>
            <td><?php echo $reg['email']; ?></td>
            <td><?php echo $reg['empresa']; ?></td>
        </tr>
        <?php

    }
}


if(isset($_GET['mesa'])){
    
}else{
    header('location: ../');
}

?>
</table>

</body>
</html>