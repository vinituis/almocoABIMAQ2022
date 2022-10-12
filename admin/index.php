<?php

session_start();

$erro = '';

if(isset($_SESSION['erro'])){
    $erro = '<span class="erro">'.$_SESSION['erro'].'</span>';
    unset($_SESSION['erro']);
}

if(isset($_SESSION['logado'])){
    header('location: ./cadastros');
}else{
    unset($_SESSION['logado']);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesse a plataforma</title>
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <form action="./mod/valida.php" method="post">
        <img src="./images/logo.png" alt="">
        <h2>Acesse a transmissão</h2>
        <?php echo $erro; ?>
        <input type="text" name="nome" placeholder="Insira seu Login" required>
        <input type="email" name="email" placeholder="Insira seu E-mail" required>
        <input type="submit" name="submit" value="Acessar">
    </form>


    <small>login: viniciusa</small><br>
    <small>email: vinicius.andrade@abimaq.org.br</small>
</body>
</html>