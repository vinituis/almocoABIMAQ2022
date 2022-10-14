<?php

include '../config.php';

session_start();

if(isset($_GET['id_cad'])){

    $ref_cad = $_GET['id_cad'];
    if(isset($_GET['mesa'])){
        $mesa = $_GET['mesa'];
    }else{
        // se não vier a mesa no cadastro, verifico o id de referencia do cadastro
        $cad = "SELECT * FROM cadastros WHERE id = '$ref_cad' ORDER BY cadastros.status_pag DESC";
        $resCad = mysqli_query($conn, $cad);
        //capturo a referencia da mesa
        $it = mysqli_fetch_assoc($resCad);
        $ref_mesa = $it['ref_mesa'];

        // verifico a seção e o número da mesa e retorno na variavel $mesa
        $mesaCad = "SELECT * FROM mesas WHERE id = '$ref_mesa'";
        $resMesa = mysqli_query($conn, $mesaCad);
        $row = mysqli_fetch_row($resMesa);
        $secao = $row[1];
        $num = $row[2];
        $mesa = $secao . $num;
    }
    if(isset($_GET['num'])){
        $Ncad = $_GET['num'] + 1;
        $cad_num = $_GET['num'];
    }
}else{
    header('location: ./');
}

// seleciono as pessoas vinculadas ao cadastro
$sql = "SELECT * FROM pessoas WHERE ref_mesa = '$mesa' && ref_cad = '$ref_cad' ORDER BY pessoas.id ASC";
$result = mysqli_query($conn, $sql);

// se tiver envio eu seleciono as pessoas vinculadas ao cadastro
if(isset($_POST['user'])){
    $sql = "SELECT * FROM pessoas WHERE ref_mesa = '$mesa' && ref_cad = '$ref_cad' ORDER BY pessoas.id ASC";
    $result = mysqli_query($conn, $sql);

    // pego as informações enviadas
    $cadeira = $_POST['cad'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $empresa = $_POST['empresa'];

    // seleciono as pessoas vinculadas a cadeira, mesa e cadastro
    $sql = "SELECT * FROM pessoas WHERE cadeira = '$cadeira' && ref_mesa = '$mesa' && ref_cad = '$ref_cad'";
    $res = mysqli_query($conn, $sql);

    // se tiver resultado na consulta acima eu retorno um aviso falando que já existe a pessoa
    if(mysqli_num_rows($res) >= 1){
        $reg = mysqli_fetch_assoc($res);
        echo '<span class="aviso">Este cadastro já existe</span>';
    }else{
        // se a resposta for 0 insere no banco e recarrega a página para atualizar a tabela
        $insert = "INSERT INTO pessoas (ref_cad, ref_mesa, nome, email, empresa, cadeira) VALUES ('$ref_cad', '$mesa', '$nome', '$email', '$empresa', '$cadeira')";
        mysqli_query($conn, $insert);
        header('refresh: 0');
    } 

    
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar na Mesa <?php echo $mesa; ?> | Almoço de Confraternização 2022</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../css/global.css">
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/77f6bd1ed5.js" crossorigin="anonymous" defer></script>
    <!-- JavaScript -->
    <script src="../js/form.js"></script>
    <!-- Bloquear indexação -->
    <meta name="robots" content="noindex">
    <!-- Favicon -->
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="../img/favicon.png">
    
</head>
<body>

<?php
    include './mod/menu.php';
?>

    <div class="container">
        <?php
            // se o número de linhas no banco for menor que o número de cadastros
            if(mysqli_num_rows($result) < $cad_num){
                // defino que $nRows vai receber o número de linhas do banco
                $nRows = mysqli_num_rows($result);
        ?>
        <form action="" method="POST">
            <select name="cad" id="cad" onChange="update_adm()">
                <option value="null">Participantes</option>
                <?php
                    // repito quantas vezes faltam para o número de pessoas atingir o máximo do cadastro 
                    for($x = ($nRows + 1); $x < ($cad_num + 1); $x++){ 
                ?>
                    <option value="<?php echo $x; ?>"><?php echo $x; ?>º Convidado</option>
                <?php } ?>
            </select>

            <input type="text" name="nome" id="nome" placeholder="Insira o nome" required>
            <input type="email" name="email" id="email" placeholder="Insira o e-mail" required>
            <input type="empresa" name="empresa" id="empresa" placeholder="Insira a empresa" required>
            <input type="submit" name="user">
        </form>

        <?php 
            }else{
                // se o número de linhas no banco for maior que o número de cadastros retorna um aviso
                echo '<span class="aviso">Número de convidados atingido</span>';
            } ?>

        <a href="./cadastros.php" class="btn voltar"><i class="fas fa-arrow-left"></i> Voltar</a>
        <div class="table">
            <table>
                <tr class="topo">
                    <td>Participante</td>
                    <td>Nome</td>
                    <td>E-mail</td>
                    <td>Empresa</td>
                    <td>Ação</td>
                </tr>

                <?php
                    // repetição da tabela dos participantes cadastrados
                    if(mysqli_num_rows($result) >= 1){
                        while ($reg = mysqli_fetch_assoc($result)){
                ?>

                    <tr>
                        <td><?php echo $reg['cadeira']; ?></td>
                        <td><?php echo $reg['nome']; ?></td>
                        <td><?php echo $reg['email']; ?></td>
                        <td><?php echo $reg['empresa']; ?></td>
                        <td></td>
                    </tr>

                <?php
                        }
                    }
                ?>
            </table>
        </div>

    </div>

    <script>update_adm();</script>
</body>
</html>