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
        
        // Utilizei o item "htmlspecialchars($_POST['nome'], ENT_QUOTES)" para sanitizar a string
        $nome = htmlspecialchars($_POST['nome'], ENT_QUOTES);
        $cpf = htmlspecialchars($_POST['cpf'], ENT_QUOTES);
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
        $empresa = htmlspecialchars($_POST['empresa'], ENT_QUOTES);
        $endereco = htmlspecialchars($_POST['endereco'], ENT_QUOTES);
        $tel = htmlspecialchars($_POST['tel'], ENT_QUOTES);
        $obs = htmlspecialchars($_POST['obs'], ENT_QUOTES);
        $pag = htmlspecialchars($_POST['pag'], ENT_QUOTES);

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
                    <h1>Inscri????o realizada</h1>
                    <p><b>Se????o: </b>'.$secao.'</p>
                    <p><b>Mesa: </b>'.$mesa.'</p>
                    <p><b>Lugares: </b>'.$quant.'</p>

                    <p><b>Tipo: </b>'.$type.'</p>
                    <p><b>CPF/CNPJ: </b>'.$cpf.'</p>
                    <p><b>Pagamento: </b>'.$pag.'</p>
                    <p><b>Observa????es de Pagamento: </b>'.$obs.'</p>
                    <p><b>Nome: </b>'.$nome.'</p>
                    <p><b>E-mail: </b>'.$email.'</p>
                    <p><b>Empresa: </b>'.$empresa.'</p>
                    <p><b>Endere??o: </b>'.$endereco.'</p>
                    <p><b>Telefone: </b>'.$tel.'</p>
                    <p>Enviado em '.$data_envio.' ??s '.$hora_envio.' </p>
                </div>
            </body>
            </html>';
            $emailenviar = 'eventos@abimaq.org.br';
            $destino = 'eventos@abimaq.org.br';
            $assunto = 'Confirma????o de Mesa '.$secao.$mesa.' | Almo??o 2022 ';
        
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-Type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: Eventos ABIMAQ <$email>';
        
            $enviaremail = mail($destino, $assunto, $arq, $headers);
        
            // Email para o cliente
            $arq2 = '
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
                    <p>Ol?? '.$nome.',</p>
                    <p>Agradecemos seu interesse em participar do Almo??o de Confraterniza????o da ABIMAQ.</p>
                    <p>A reserva do(s) '.$quant.' convite(s) foi realizada.</p>
                    <p>Envie para o e-mail eventos@abimaq.org.br o comprovante de pagamento para que a reserva seja efetuada.</p>
                    <p>Caso tenha selecionado as formas de pagamento boleto ou cart??o, em breve um de nossos analistas entrar??o em contato.</p>
                    <p>Em caso de d??vida, entre em contato com o Nelson atrav??s do e-mail <a href="mailto:eventos@abimaq.org.br">eventos@abimaq.org.br</a> ou telefone (11) 5582-6315.</p>
                    <br>
                    <p>Atenciosamente,</p>
                    <p><b>Eventos ABIMAQ</b></p>
                    <p>Enviado em '.$data_envio.' ??s '.$hora_envio.' </p>
                </div>
            </body>
            </html>';
            $emailenviar = 'eventos@abimaq.org.br';
            $destino = $email;
            $assunto = 'Reserva realizada | Almo??o de Confraterniza????o ABIMAQ';
        
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-Type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: Eventos ABIMAQ <$email>';
        
            $enviaremail = mail($destino, $assunto, $arq2, $headers);
            header('location: ./agradecimento?method='. $pag .'');
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Almo??o de Confraterniza????o 2022</title>
    <!-- Criador da p??gina -->
    <meta name="author" content="@vinituis">
    <!-- Favicon -->
    <link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="./img/favicon.png">
    <!-- CSS -->
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/lp.css">
    <!-- JavaScript -->
    <script src="./js/form.js"></script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VXYCN6EK5G"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-VXYCN6EK5G');
    </script>
</head>
<body>

<!-- Caso tenha um alert js a mensagem aparece no "<p>" abaixo -->
<!-- <p id="demo"></p> -->

<div class="container">

    <h1>Reserva de Mesa | Se????o <?php echo $secao; ?> - Mesa <?php echo $mesa; ?></h1>

    <form action="" method="post">
        <?php
            // seleciono os cadastros que j?? existem na mesa 
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
                // verifico se a quantidade de participantes ?? igual ou maior que 10 que ?? o n??mero m??ximo de cadeiras por mesa, e se for maior eu bloqueio a mesa 
                if($quant >= 10){
                    $update = "UPDATE mesas SET status = 'block' WHERE id = '$id_mesa'";
                    mysqli_query($conn, $update);
                }
            }
            // verifico se o status ?? de mesa individual, se sim exibo as quantidades disponiveis de lugares
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
            <option value="CPF">Pessoa F??sica</option>
            <option value="CNPJ">Pessoa Juridica</option>
        </select>
        <input type="number" id="cpf" name="cpf" placeholder="cpf" required>
        <input type="text" id="nome" name="nome" placeholder="nome" required>
        <input type="email" id="email" name="email" placeholder="email" required>
        <input type="text" id="empresa" name="empresa" placeholder="empresa" required>
        <textarea id="endereco" name="endereco" rows="2" placeholder="Endere??o" required></textarea>
        <input type="number" id="tel" name="tel" placeholder="telefone" required>
        <select name="pag" id="pag" required>
            <option value="">Selecione a forma de pagamento</option>
            <option value="boleto">Boleto</option>
        </select>
        <textarea id="observacoes" name="obs" rows="2" placeholder="Observa????es de pagamento"></textarea>

        <!-- Se for necess??rio exibir um alerta antes de enviar o formul??rio, basta inserir [onclick="alert()"] no input de submit abaixo -->
        
        <input type="submit" name="submit" value="Enviar Reserva">
    </form>
    <a class="cancelar" href="./">Cancelar</a>

</div>

    <script>update();</script>
</body>
</html>