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
    <script src="https://kit.fontawesome.com/77f6bd1ed5.js" crossorigin="anonymous" defer></script>
</head>
<body>

<?php
    include './mod/menu.php';
?>

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
           
                <p><b>Identificador:</b> <?php echo $ref_cad; ?></p>
                <p><b>Mesa:</b> <?php echo $mesa; ?></p>
                <p><b>Nome:</b> <?php echo $name; ?></p>
                <p><b>Empresa:</b> <?php echo $business; ?></p>
                <p><b>Telefone:</b> <?php echo $tel; ?></p>
                <p><b>E-mail:</b> <?php echo $e_mail; ?></p>
                <p><b>CPF ou CNPJ:</b> <?php echo $cnpj; ?></p>
                <p><b>Endereço:</b> <?php echo $end; ?></p>
                <p><b>Lugares:</b> <?php echo $quant; ?></p>
                <p><b>Pagamento:</b> <?php echo $pag; ?></p>
                <p><b>Método de Pagamento:</b> <?php echo $metPag; ?></p>
                <p><b>Observações:</b> <?php echo $obsPag; ?></p>
            <?php 
                }
                
            }
            ?>
        <br><br>
        <div class="acao">
            <div class="btns">
                <a href="./mod/pag?status=pago&id=<?php echo $ref_cad; ?>" class="btn azul">Pagamento efetuado</a>
                <a href="./mod/pag?status=cancelado&id=<?php echo $ref_cad; ?>" class="btn vermelho">Cancelar</a>
                <a href="./cadastros" class="btn voltar"><i class="fas fa-arrow-left"></i> Voltar</a>
            </div>
        </div>
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