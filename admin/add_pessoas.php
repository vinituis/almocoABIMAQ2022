<?php

include '../config.php';


if(isset($_GET['mesa'])){
    $mesa = $_GET['mesa'];
    $Ncad = $_GET['num'] + 1;
    $ref_cad = $_GET['id_cad'];
}

if(isset($_POST['user'])){
    $cadeira = $_POST['cad'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $empresa = $_POST['empresa'];

    $sql = "SELECT * FROM pessoas WHERE cadeira = '$cadeira' && ref_mesa = '$mesa'";
    $res = mysqli_query($conn, $sql);

    var_dump($res);
    if(mysqli_num_rows($res) >= 1){
        $reg = mysqli_fetch_assoc($res);
        echo $reg['ref_mesa'];
    }else{
        $insert = "INSERT INTO pessoas (ref_cad, ref_mesa, nome, email, empresa, cadeira) VALUES ('$ref_cad', '$mesa', '$nome', '$email', '$empresa', '$cadeira')";
        var_dump($insert);
        mysqli_query($conn, $insert);
    } 

    
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/global.css">
    <script src="../js/form.js"></script>
</head>
<body>
    <div class="participantes">
        <form action="" method="POST">
            <select name="cad" id="cad" onChange="update_adm()">
                <option value="null">Selecione a cadeira</option>
                <?php for($x = 1; $x < $Ncad; $x++){ ?>
                    <option value="<?php echo $x; ?>">Cadeira <?php echo $x; ?></option>
                <?php } ?>
            </select>

            <input type="text" name="nome" id="nome" placeholder="Insira o nome" required>
            <input type="email" name="email" id="email" placeholder="Insira o e-mail" required>
            <input type="empresa" name="empresa" id="empresa" placeholder="Insira a empresa" required>
            <input type="submit" name="user">
        </form>

    </div>

    <script>update_adm();</script>
</body>
</html>