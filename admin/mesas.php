<?php

include "../config.php";

$select = "SELECT * FROM mesas ORDER BY mesas.id ASC";
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
                        <td><a href="">Liberar completa</a></td>
                        <td><a href="">Liberar individual</a></td>
                    <?php
                    }elseif($reg['status'] == 'livre'){
                    ?>
                        <td><a href="">Bloquear</a></td>
                        <td><a href="">Tornar individual</a></td>
                    <?php
                    }elseif($reg['status'] == 'parcial'){
                    ?>
                        <td><a href="">Bloquear</a></td>
                        <td><a href="">Tornar completa</a></td>
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