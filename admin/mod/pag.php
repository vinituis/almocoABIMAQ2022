<?php

include "../../config.php";

include "../../mod/emails.php";

$pag = $_GET['status'];
$id = $_GET['id'];

$sql = "SELECT * FROM cadastros WHERE id = '$id'";
$res = mysqli_query($conn, $sql);
if(mysqli_num_rows($res) >= 1){
    while ($data = mysqli_fetch_assoc($res)){
        $email = $data['email'];
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
                $arq = $Epag;
                $emailenviar = 'eventos@abimaq.org.br';
                $destino = $email;
                $assunto = 'Pagamento realizado';

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
            }elseif($pag == 'cancelado'){
                date_default_timezone_set('America/Sao_Paulo');
                $hora_envio = date('H:i:s');
                $data_envio = date('d/m/Y');
                $arq = $Ecancel;
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
        // header('location: ../cadastros');
    }
  
}


?>

