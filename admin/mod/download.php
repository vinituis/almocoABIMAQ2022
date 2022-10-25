<?php

include '../../config.php';

session_start();

$select = "SELECT * FROM cadastros ORDER BY cadastros.status_pag DESC";
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



if($_GET['table'] == 'cadastros'){


    $data = gmdate("d-m-y_H-i-s");
    $arquivo = 'lista_de_cadastro_'.$data.'.xls';
        header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header ("Cache-Control: no-cache, must-revalidate");
        header ("Pragma: no-cache");
        header ("Content-Type: text/html; charset=UTF-8");
        header ("Content-Disposition: attachment; filename={$arquivo}");
        // este trecho ajusta caracteres especiais
        echo "\xEF\xBB\xBF";
        // fim do trecho
    ?>
    <table border="1">
        <tr class="topo">
            <td>Mesa</td>
            <td>Nome</td>
            <td>E-mail</td>
            <td>Empresa</td>
            <td>CPF ou CNPJ</td>
            <td>Endereço</td>
            <td>Telefone</td>
            <td>Cadeiras</td>
            <td>Pagamento</td>
            <td>Obs. de Pagamento</td>
            <td>Metodo de pagamento</td>
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
    
        <tr class="yellow">
            <td><?php echo $mesa . $num; ?></td>
            <td><?php echo $nome[$i]; ?></td>
            <td><?php echo $email[$i]; ?></td>
            <td><?php echo $empresa[$i]; ?></td>
            <td><?php echo $cpf_cnpj[$i]; ?></td>
            <td><?php echo $endereco[$i]; ?></td>
            <td><?php echo $telefone[$i]; ?></td>
            <td><?php echo $quant_participante[$i]; ?></td>
            <td><?php echo $status_pag[$i]; ?></td>
            <td><?php echo $observacoes_pag[$i]; ?></td>
            <td><?php echo $method_pag[$i]; ?></td>
        </tr>
        <?php

}
}
?>
    </table>
    <?php
}
?>