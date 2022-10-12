<?php

// Email de envio do cadastro para o nelson
$Enotifica = 
'
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

$Epag =
'
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
                </div>
            </body>
            </html>
';


$Ecancel =
'
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
            </html>
';

?>