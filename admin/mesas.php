<?php

include "../config.php";

session_start();

if(!isset($_SESSION['logado'])){
    header('location: ./');
}

$select = "SELECT * FROM mesas ORDER BY mesas.id ASC";
$result = mysqli_query($conn, $select);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de mesas | Almoço de Confraternização 2022</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../css/global.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="../img/favicon.png">
</head>
<body>

<?php
    include './mod/menu.php';
?>

    <div class="table">
        <table>
            <tr class="topo">
                <td>seção</td>
                <td>mesa</td>
                <td>status</td>
                <td colspan="2">Ação</td>
            </tr>
<?php
    if(mysqli_num_rows($result) >= 1){
        while($reg = mysqli_fetch_assoc($result)){
            if($reg['status'] != 'hidden'){
    ?>
            <tr>
                <td><?php echo $reg['secao'];?></td>
                <td><?php echo $reg['mesa'];?></td>
                <td><?php echo $reg['status'];?></td>
                <?php
                    if($reg['status'] == 'block'){
                    ?>
                        <td><a href="./mod/status-mesa?id=<?php echo $reg['id']; ?>&status=livre">Liberar completa</a></td>
                        <td><a href="./mod/status-mesa?id=<?php echo $reg['id']; ?>&status=parcial">Liberar individual</a></td>
                    <?php
                    }elseif($reg['status'] == 'livre'){
                    ?>
                        <td><a href="./mod/status-mesa?id=<?php echo $reg['id']; ?>&status=block">Bloquear</a></td>
                        <td><a href="./mod/status-mesa?id=<?php echo $reg['id']; ?>&status=parcial">Tornar individual</a></td>
                    <?php
                    }elseif($reg['status'] == 'parcial'){
                    ?>
                        <td><a href="./mod/status-mesa?id=<?php echo $reg['id']; ?>&status=block">Bloquear</a></td>
                        <td><a href="./mod/status-mesa?id=<?php echo $reg['id']; ?>&status=livre">Tornar completa</a></td>
                    <?php
                    }
                ?>
            </tr>

    <?php
            }
        }
    }
?>
        </table>
    </div>

</body>
</html>