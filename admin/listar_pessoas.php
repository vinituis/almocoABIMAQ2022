<?php

include '../config.php';

$ref_cad = $_GET['id_cad'];
$mesa = $_GET['mesa'];

$select = "SELECT * FROM pessoas WHERE ref_cad = '$ref_cad' && ref_mesa = '$mesa' ORDER BY pessoas.id ASC";
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
    <h2>Dados do Comprador</h2>
    <div class="dados">
            <?php 
            $sql = "SELECT * FROM cadastros WHERE id = '$ref_cad'";
            $res = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($res) >= 1){
                while ($data = mysqli_fetch_assoc($res)){
                    $name = $data['nome'];
                    $business = $data['empresa'];
                    $tel = $data['telefone'];
                    $e_mail = $data['email'];
                    $cnpj = $data['cpf_cnpj'];
                    $end = $data['endereco'];
                    $quant = $data['quant_participante'];
                    $pag = $data['status_pag'];
                    $metPag = $data['method_pag'];
                    $obsPag = $data['observacoes_pag'];
            ?>
           
                <p>Identificador: <?php echo $ref_cad; ?></p>
                <p>Mesa: <?php echo $mesa; ?></p>
                <p>Nome: <?php echo $name; ?></p>
                <p>Empresa: <?php echo $business; ?></p>
                <p>Telefone: <?php echo $tel; ?></p>
                <p>E-mail: <?php echo $e_mail; ?></p>
                <p>CPF ou CNPJ: <?php echo $cnpj; ?></p>
                <p>Endereço: <?php echo $end; ?></p>
                <p>Lugares: <?php echo $quant; ?></p>
                <p>Pagamento: <?php echo $pag; ?></p>
                <p>Método de Pagamento: <?php echo $metPag; ?></p>
                <p>Observações: <?php echo $obsPag; ?></p>
            <?php 
                }
                
            }
            ?>
        <br><br>
        <a href="./cadastros">Voltar</a>
    </div>
    <div class="table">
        <h2>Dados dos Participantes</h2>
        <table>
            <tr class="topo">
                <td>Mesa</td>
                <td>Cadeira</td>
                <td>Nome</td>
                <td>E-mail</td>
                <td>Empresa</td>
            </tr>
                <?php

                if(mysqli_num_rows($result) >= 1){
                    while ($reg = mysqli_fetch_assoc($result)){
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
    </div>

</body>
</html>