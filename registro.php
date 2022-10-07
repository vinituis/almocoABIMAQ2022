<?php

include './config.php';

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

    if(isset($_POST['submit'])){
        if(isset($_POST['quant'])){
            $quant = $_POST['quant'];
        }else{
            $quant = 10;
        }
        
        $secao = $_POST['secao'];
        $mesa = $_POST['mesa'];
        $type = $_POST['type'];
        
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $empresa = $_POST['empresa'];
        $endereco = $_POST['endereco'];
        $tel = $_POST['tel'];
        $obs = $_POST['obs'];
        $pag = $_POST['pag'];

        $insert = "INSERT INTO cadastros(ref_mesa, nome, email, empresa, cpf_cnpj, endereco, telefone, quant_participante, observacoes_pag, method_pag) VALUES ('$id_mesa', '$nome', '$email', '$empresa', '$cpf', '$endereco', '$tel', '$quant', '$obs', '$pag')";
        mysqli_query($conn, $insert);

        if(isset($insert)){
            date_default_timezone_set('America/Sao_Paulo');
            $hora_envio = date('H:i:s');
            $data_envio = date('d/m/Y');
            $arq = '
            <!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <title>E-mail</title>
                <style type="text/css">
                    body {
                    margin:0;
                    font-family: Verdana, sans-serif;
                    font-size: 12px;
                    color: #000;
                    }
                    p {
                    font-size: 12px;
                    }
                </style>

            </head>
            <body>
                <div>
                    <h1>Inscrição realizada</h1>
                    <p><b>Seção: </b>$secao</p>
                    <p><b>Mesa: </b>$mesa</p>
                    <p><b>Lugares: </b>$quant</p>

                    <p><b>Tipo: </b>$type</p>
                    <p><b>CPF/CNPJ: </b>$cpf</p>
                    <p><b>Pagamento: </b>$pag</p>
                    <p><b>Observações de Pagamento: </b>$obs</p>
                    <p><b>Nome: </b>$nome</p>
                    <p><b>E-mail: </b>$email</p>
                    <p><b>Empresa: </b>$empresa</p>
                    <p><b>Endereço: </b>$endereco</p>
                    <p><b>Telefone: </b>$tel</p>
                    <p>Enviado em $data_envio às $hora_envio </p>
                </div>
            </body>
            </html>
            ';
            $emailenviar = 'eventos@abimaq.org.br';
            $destino = 'eventos@abimaq.org.br';
            $assunto = 'Confirmação de Mesa | Almoço 2022 ';
        
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-Type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: Eventos ABIMAQ <$email>';
        
            $enviaremail = mail($destino, $assunto, $arq, $headers);
        
            if($enviaremail){
                echo "foi";
            }else{
                echo "deu erro ao enviar";
            }
        }
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
    <script src="./js/form.js"></script>
</head>
<body>

<!-- Caso tenha um alert js a mensagem aparece no "<p>" abaixo -->
<!-- <p id="demo"></p> -->

    <h1>Reserva de Mesa | Seção <?php echo $secao; ?> - Mesa <?php echo $mesa; ?></h1>

    <form action="" method="post">
        <label for="secao">Seção</label>
        <input type="text" id="secao" name="secao" value="<?php echo $secao; ?>">

        <label for="mesa">Mesa</label>
        <input type="text" id="mesa" name="mesa" value="<?php echo $mesa; ?>">
        <?php
            if(isset($status)){
                if($status == 'parcial'){
                    echo '
                    <select name="quant" id="quant" required>
                        <option value="">Selecione a Quantidade</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                    </select>';
                }
            }
        ?>

        <h3>Dados de faturamento</h3>
        <select name="type" id="type" onChange="update()">
            <option value="">Selecione para seguir</option>
            <option value="CPF">Pessoa Física</option>
            <option value="CNPJ">Pessoa Juridica</option>
        </select>
        <input type="text" id="cpf" name="cpf" placeholder="cpf" required>
        <input type="text" id="nome" name="nome" placeholder="nome" required>
        <input type="email" id="email" name="email" placeholder="email" required>
        <input type="text" id="empresa" name="empresa" placeholder="empresa" required>
        <input type="text" id="endereco" name="endereco" placeholder="endereco" required>
        <input type="text" id="tel" name="tel" placeholder="telefone" required>
        <input type="text" id="observacoes" name="obs" placeholder="observacoes" required>
        <select name="pag" id="pag" required>
            <option value="">Selecione a forma de pagamento</option>
            <option value="pix">Pix</option>
            <option value="cartao">Cartão</option>
            <option value="boleto">Boleto</option>
        </select>

        <!-- Se for necessário exibir um alerta antes de enviar o formulário, basta inserir [onclick="alert()"] no input de submit abaixo -->
        
        <input type="submit" name="submit" value="Enviar Reserva">
    </form>
    <a href="./">Cancelar</a>

    <script>update();</script>
</body>
</html>