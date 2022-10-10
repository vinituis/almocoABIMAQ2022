<?php

include '../config.php';

$select = "SELECT * FROM cadastros";
$result = mysqli_query($conn, $select);

if($result){
    $id = array();
    $ref_mesa = array();
    $nome = array();
    $email = array();
    $empresa = array();
    $cpf_cnpj = array();
    $endereco = array();
    $telefone = array();
    $quant_participante = array();
    $status_pag = array();
    $observacoes_pag = array();
    $method_pag = array();
    $i = 0;

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
            <td>Mesa</td>
            <td>Nome</td>
            <td>E-mail</td>
            <td>Empresa</td>
            <td>Telefone</td>
            <td>Cadeiras</td>
            <td>Pagamento</td>
            <td>Metodo de pagamento</td>
            <td colspan="2">Ação</td>
        </tr>
    
    <?php


    while ($it = mysqli_fetch_assoc($result)) {
        
        $id[$i] = $it['id'];
        $ref_mesa[$i] = $it['ref_mesa'];
        $nome[$i] = $it['nome'];
        $email[$i] = $it['email'];
        $empresa[$i] = $it['empresa'];
        $cpf_cnpj[$i] = $it['cpf_cnpj']; 
        $endereco[$i] = $it['endereco']; 
        $telefone[$i] = $it['telefone']; 
        $quant_participante[$i] = $it['quant_participante']; 
        $status_pag[$i] = $it['status_pag']; 
        $observacoes_pag[$i] = $it['observacoes_pag']; 
        $method_pag[$i] = $it['method_pag']; 
        
        $sql = "SELECT * FROM mesas WHERE id = '$ref_mesa[$i]' ORDER BY mesas.id ASC";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($res);

        $mesa = $row[1];
        $num = $row[2];

    ?>
    
        <tr>
            <td><?php echo $mesa . $num; ?></td>
            <td><?php echo $nome[$i]; ?></td>
            <td><?php echo $email[$i]; ?></td>
            <td><?php echo $empresa[$i]; ?></td>
            <td><?php echo $telefone[$i]; ?></td>
            <td><?php echo $quant_participante[$i]; ?></td>
            <td><?php echo $status_pag[$i]; ?></td>
            <td><?php echo $method_pag[$i]; ?></td>
            <td><a href="./add_pessoas?id_cad=<?php echo $id[$i]; ?>&mesa=<?php echo $mesa . $num; ?>&num=<?php echo $quant_participante[$i]; ?>">Adicionar</a></td>
            <td><a href="./listar_pessoas?id_cad=<?php echo $id[$i]; ?>&mesa=<?php echo $mesa . $num; ?>">Ver</a></td>
        </tr>
        <?php
    }
}
?>
    </table>
</div>

</body>
</html>