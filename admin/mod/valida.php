<?php

session_start();

if(isset($_POST)){
    include '../../config.php';

    if((include '../../config.php') == TRUE){

        $nome = filter_var($_POST['nome'], FILTER_SANITIZE_STRING, 513);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING, 513);

        $select = " SELECT * FROM users WHERE email = '$email' && nome = '$nome'";

        $result = mysqli_query($conn, $select);

        if(mysqli_num_rows($result) >= 1) {
            echo 'OK';
            $row = mysqli_fetch_row($result);
            var_dump($row);
            $_SESSION['logado'] = 'true';
            $_SESSION['nome'] = $_POST['nome'];
            $_SESSION['status'] = $row[3];

            date_default_timezone_set('America/Belem');
            $hora = date('H:i');
            $data = date('d/m/Y');
            $date = $data.' | '.$hora;

            if($row[3] == 'master') {
                $sucesso = 'sim';
                
                header('location: ../cadastros');
            }elseif($row[3] == 'adm'){
                $sucesso = 'sim';
    
                header('location: ../cadastros');
            }elseif($row[3] == 'block'){
                $sucesso = 'não';

                unset($_SESSION['logado']);
                $_SESSION['erro'] = 'Você está bloqueado';

                var_dump($logado);
                header('location: ../');
            }
            
            
        }else{
            echo 'Ops!';
            $_SESSION['erro'] = 'Não identificamos você';
            header('location: ../');
        }
    }
}

?>