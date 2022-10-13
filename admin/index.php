<?php

session_start();

$erro = '';

if(isset($_SESSION['erro'])){
    $erro = '<span class="aviso">'.$_SESSION['erro'].'</span>';
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
    <title>Login | Almoço de Confraternização 2022</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../css/global.css">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VXYCN6EK5G"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-VXYCN6EK5G');
    </script>
    <!-- Bloquear indexação -->
    <meta name="robots" content="noindex">
</head>
<body>
    <div class="container">
        <?php echo $erro; ?>
        <form action="./mod/valida.php" method="post">
            <h2>Gerenciamento do evento</h2>
            <input type="text" name="nome" placeholder="Insira seu Login" required>
            <input type="email" name="email" placeholder="Insira seu E-mail" required>
            <input type="submit" name="submit" value="Acessar">
        </form>
    </div>
</body>
</html>