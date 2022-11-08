<?php

include "../../config.php";

$pag = $_GET['status'];
$id = $_GET['id'];

$sql = "SELECT * FROM cadastros WHERE id = '$id'";
$res = mysqli_query($conn, $sql);
if(mysqli_num_rows($res) >= 1){
    while ($data = mysqli_fetch_assoc($res)){
        $nome = $data['nome'];
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
                        <p>Olá '.$nome.',</p>
                        <p>O pagamento do(s) convite(s) para o Almoço de Confraternização ABIMAQ foi aprovado em nosso sistema.</p>
                        <p>Disponibilizamos abaixo o link para cadastro dos participantes na mesa. Você terá até o dia 25/11/2022 para inserir os dados dos convidados.</p>
                        <p>Caso esta data já tenha passado, entre em contato com o Nelson através do telefone (11) 5582-6315 ou e-mail <a href="mailto:eventos@abimaq.org.br">eventos@abimaq.org.br</a>.</p>
                        <a href="http://almoco.abimaq.org.br/admin/add_pessoas?id_cad='.$ref_cad.'&num='.$quant.'">Adicione os participantes</a>
                        <br><br>
                        <small>Caso o link não funcione, copie e cole a url abaixo:<br>http://almoco.abimaq.org.br/admin/add_pessoas?id_cad='.$ref_cad.'&num='.$quant.'</small>
                        <br><br>
                        <p>Atenciosamente,</p>
                        <p><b>Eventos ABIMAQ</b></p>
                        <p>Enviado em '.$data_envio.' às '.$hora_envio.' </p>
                    </div>
                </body>
                </html>';
                $emailenviar = 'eventos@abimaq.org.br';
                $destino = $email;
                $assunto = 'Identificamos seu pagamento | Almoço de Confraternização ABIMAQ';
            
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
                
            }
        }
        header('location: ../cadastros');
    }
  
}


?>

