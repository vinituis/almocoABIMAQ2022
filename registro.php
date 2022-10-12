<?php

    include './config.php';
    include './mod/emails.php';

    if(!isset($_GET['secao'])){
        header('location: ./');
    }

    if(!isset($_GET['mesa'])){
        header('location: ./');
    }

    $_GET['secao'];
    $_GET['mesa'];
    $_GET['status'];
    $_GET['id'];

    $secao = $_GET['secao'];
    $mesa = $_GET['mesa'];
    $status = $_GET['status'];
    $id_mesa = $_GET['id'];

    if($status == 'block' || $status == 'hidden'){
        header('location: ./');
    }

    // se existir o envio subo no banco e notifico o nelson 
    if(isset($_POST['submit'])){
        if(isset($_POST['quant'])){
            $quant = $_POST['quant'];
        }else{
            $quant = 10;
        }
        
        $secao = $secao;
        $mesa = $mesa;
        $type = $_POST['type'];
        
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $empresa = $_POST['empresa'];
        $endereco = $_POST['endereco'];
        $tel = $_POST['tel'];
        $obs = $_POST['obs'];
        $pag = $_POST['pag'];

        echo $arq;

        // $insert = "INSERT INTO cadastros(ref_mesa, nome, email, empresa, cpf_cnpj, endereco, telefone, quant_participante, observacoes_pag, method_pag) VALUES ('$id_mesa', '$nome', '$email', '$empresa', '$cpf', '$endereco', '$tel', '$quant', '$obs', '$pag')";
        // mysqli_query($conn, $insert);

        // if(isset($insert)){
        //     date_default_timezone_set('America/Sao_Paulo');
        //     $hora_envio = date('H:i:s');
        //     $data_envio = date('d/m/Y');
        //     $arq = $arq;
        //     $emailenviar = 'eventos@abimaq.org.br';
        //     $destino = 'eventos@abimaq.org.br';
        //     $assunto = 'Confirmação de Mesa | Almoço 2022 ';
        
        //     $headers = 'MIME-Version: 1.0' . "\r\n";
        //     $headers .= 'Content-Type: text/html; charset=iso-8859-1' . "\r\n";
        //     $headers .= 'From: Eventos ABIMAQ <$email>';
        
        //     $enviaremail = mail($destino, $assunto, $arq, $headers);
        
        //     if($enviaremail){
        //         echo "foi";
        //     }else{
        //         echo "deu erro ao enviar";
        //     }
        // }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/lp.css">
    <script src="./js/form.js"></script>
</head>
<body>

<!-- Caso tenha um alert js a mensagem aparece no "<p>" abaixo -->
<!-- <p id="demo"></p> -->

<div class="container">

    <h1>Reserva de Mesa | Seção <?php echo $secao; ?> - Mesa <?php echo $mesa; ?></h1>

    <form action="" method="post">
        <?php
            // seleciono os cadastros que já existem na mesa 
            $sql = "SELECT * FROM cadastros WHERE ref_mesa = '$id_mesa'";
            $res = mysqli_query($conn, $sql);
            $quant = 0;
            // verifico se existe cadastros nessa mesa e conto a quantidade de participantes
            if(mysqli_num_rows($res) >= 1){
                while ($reg = mysqli_fetch_assoc($res)){
                    $Nparticipante = $reg['quant_participante'];
                    $statusPag = $reg['status_pag'];
                    if($statusPag == 'cancelado'){}else{
                        $quant = $quant + $Nparticipante;
                    }
                }
                // verifico se a quantidade de participantes é igual ou maior que 10 que é o número máximo de cadeiras por mesa, e se for maior eu bloqueio a mesa 
                if($quant >= 10){
                    $update = "UPDATE mesas SET status = 'block' WHERE id = '$id_mesa'";
                    mysqli_query($conn, $update);
                }
            }
            // verifico se o status é de mesa individual, se sim exibo as quantidades disponiveis de lugares
            if(isset($status)){
                if($status == 'parcial'){
                    ?>
                    <select name="quant" id="quant" required>
                        <option value="">Selecione a Quantidade</option>
                    <?php
                    // repito a quantidade de lugares vagos
                    for($x = 1; $x <= (10 - $quant); $x++){
                        ?>
                        <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                        <?php
                    }
                }
            }
        ?>
                    </select>

        <h2>Dados de faturamento</h2>
        <select name="type" id="type" onChange="update()">
            <option value="">Selecione para seguir</option>
            <option value="CPF">Pessoa Física</option>
            <option value="CNPJ">Pessoa Juridica</option>
        </select>
        <input type="number" id="cpf" name="cpf" placeholder="cpf" required>
        <input type="text" id="nome" name="nome" placeholder="nome" required>
        <input type="email" id="email" name="email" placeholder="email" required>
        <input type="text" id="empresa" name="empresa" placeholder="empresa" required>
        <textarea id="endereco" name="endereco" rows="2" placeholder="Endereço" required></textarea>
        <input type="number" id="tel" name="tel" placeholder="telefone" required>
        <select name="pag" id="pag" required>
            <option value="">Selecione a forma de pagamento</option>
            <option value="pix">Pix</option>
            <option value="cartao">Cartão</option>
            <option value="boleto">Boleto</option>
        </select>
        <textarea id="observacoes" name="obs" rows="2" placeholder="Observações de pagamento" required></textarea>

        <!-- Se for necessário exibir um alerta antes de enviar o formulário, basta inserir [onclick="alert()"] no input de submit abaixo -->
        
        <input type="submit" name="submit" value="Enviar Reserva">
    </form>
    <a class="cancelar" href="./">Cancelar</a>

</div>

    <script>update();</script>
</body>
</html>