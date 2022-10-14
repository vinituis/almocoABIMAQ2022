<?php

include "../../config.php";

$pag = $_GET['status'];
$id = $_GET['id'];

$sql = "SELECT * FROM cadastros WHERE id = '$id'";
$res = mysqli_query($conn, $sql);
if(mysqli_num_rows($res) >= 1){
    while ($data = mysqli_fetch_assoc($res)){
        $email = $data['email'];
        $ref_cad = $data['id'];
        $quant = $data['quant_participante'];
    }
}

if(isset($_GET['status'])){
    if(isset($_GET['id'])){
        $update = "UPDATE cadastros SET status_pag = '$pag' WHERE id = '$id'";
        mysqli_query($conn, $update);

        if(isset($update)){
            if($pag == 'pago'){
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
                        <a href="http://almoco.abimaq.org.br/admin/add_pessoas?id_cad='.$ref_cad.'&num='.$quant.'">Link para adicionar participantes</a>
                        <small>Caso o link não funcione, copie e cole a url abaixo:<br>http://almoco.abimaq.org.br/admin/add_pessoas?id_cad='.$ref_cad.'&num='.$quant.'</small>
                    </div>
                </body>
                </html>';
                $emailenviar = 'eventos@abimaq.org.br';
                $destino = $email;
                $assunto = 'Pagamento realizado';
            
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-Type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= 'From: Eventos ABIMAQ <$email>';

                $enviaremail = mail($destino, $assunto, $arq, $headers);
            
                if($enviaremail){
                    echo "foi";
                }else{
                    echo "deu erro ao enviar";
                }
            }elseif($pag == 'cancelado'){
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
                        <h1>Cancelamento realizado</h1>
                    </div>
                </body>
                </html>';
                $emailenviar = 'eventos@abimaq.org.br';
                $destino = $email;
                $assunto = 'Inscrição cancelada';

                echo $assunto;
            
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
        header('location: ../cadastros');
    }
  
}


?>

