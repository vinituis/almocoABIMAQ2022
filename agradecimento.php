<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agradecimento | Almoço de Confraternização 2022</title>
    <!-- Criador da página -->
    <meta name="author" content="@vinituis">
    <!-- Favicon -->
    <link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="./img/favicon.png">
    <!-- CSS -->
    <link rel="stylesheet" href="./css/global.css">
</head>
<body>

<?php

$method = $_GET['method'];

if($method == 'pix'){
?>

<div class="container">
    <h2>Pagamento via <?php echo $method ?></h2>
    <span class="aviso">Após realizar o pagamento, envie o comprovante para <s>eventos@abimaq.org.br</s>, para realizarmos as liberações necessárias para o evento.</span>
    <br><br>
    <h2>Chave Pix: XX.XXX.XXXXX-XX</h2>
</div>

<?php
}elseif($method == 'boleto'){
?>

<div class="container">
    <h2>Pagamento via <?php echo $method ?></h2>
    <span class="aviso">Após realizar o pagamento, envie o comprovante para <s>eventos@abimaq.org.br</s>, para realizarmos as liberações necessárias para o evento.</span>
    <br><br>
    <h2>Em breve entraremos em contato para realizar o pagamento.</h2>
</div>

<?php
}elseif($method == 'cartao'){
?>

<div class="container">
    <h2>Pagamento via <?php echo $method ?></h2>
    <span class="aviso">Após realizar o pagamento, envie o comprovante para <s>eventos@abimaq.org.br</s>, para realizarmos as liberações necessárias para o evento.</span>
    <br><br>
    <h2>Em breve entraremos em contato para realizar o pagamento.</h2>
</div>

<?php
}
?>
</body>
</html>