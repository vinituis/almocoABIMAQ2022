<?php

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almoço</title>
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/lp.css">
    <script src="https://kit.fontawesome.com/77f6bd1ed5.js" crossorigin="anonymous" defer></script>
</head>
<body>
    <div class="header">
        <div class="nav">
            <img src="./img/logo.png" alt="">
            <a href="" class="item_nav">Opção 1</a>
            <a href="" class="item_nav">Opção 2</a>
            <a href="" class="item_nav">Opção 3</a>
        </div>
    </div>

    <!-- Seção de introdução e informações -->
    <div class="container">
        <h1>Almoço De Confraternização 2019</h1>
        <small>ABIMAQ |SINDIMAQ</small>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto nihil odio et? Perferendis vero voluptas exercitationem ut pariatur eligendi culpa.
        </p>
        <div class="container dados">
            <div class="dado">
                <div class="icon">
                    <i class="far fa-calendar"></i>
                    <span>Data</span>
                </div>
                <p>O Almoço vai acontecer no dia 09 de Dezembro de 2022.</p>
            </div>
            <div class="dado">
                <div class="icon">
                    <i class="fas fa-user"></i>
                    <span>Público</span>
                </div>
                <p>+ de 500 convidados</p>
            </div>
            <div class="dado">
                <div class="icon">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>local</span>
                </div>
                <p><b>Buffet Torres</b><br>Av. dos Imarés, 182.</p>
            </div>
        </div>
    </div>

    <!-- Seção de para patrocinar -->

    <div class="container branco">
        <h2>Quer patrocinar este evento?</h2>
        <small>Solicitações até 15 de Novembro</small>
        <p>A ABIMAQ possui um público altamente qualificado entre os setores da indústria de máquinas e equipamentos na América Latina, alta audiência e os melhores canais.
        <br>
        Estamos presentes em todo Brasil.</p>
        <a href="" class="btn">Acesse o Mídia Kit</a>
    </div>

    <!-- Seção do mapa -->
    <div class="container" id="mapa">
        <h2>Mapa das mesas</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel ut et perspiciatis perferendis esse, ea magni tempora impedit, provident modi culpa officia ducimus sunt ab natus doloribus animi cum omnis tempore quam velit. Cumque qui veniam, accusamus eum amet rem fuga non nam ea nisi minus architecto dignissimos incidunt natus.</p>
        <div class="mapa">
            <?php include('./mod/mapa.php'); ?>
        </div>
    </div>

    <!-- Seção de contato -->
    <div class="container branco">
        <h2>Contato</h2>
        <p>Para obter mais informações sobre o Almoço de Confraternização ABIMAQ 2019, condições para compra de convites, como patrocinar o evento, dentre outras informações, entre em contato com através dos canais abaixo:</p>
        <p>E-mail:<a href="">E-mail</a></p>
        <p>Telefone: +55 11 5582-0000</p>
    </div>

    <!-- Seção de patrocinadores -->
    <div class="container">
        <h2>Patrocinadores</h2>
        <div class="partners">
            <div class="partner">
                <img src="./img/estrutura.png" alt="">
            </div>
            <div class="partner">
                <img src="./img/estrutura.png" alt="">
            </div>
            <div class="partner">
                <img src="./img/estrutura.png" alt="">
            </div>
            <div class="partner">
                <img src="./img/estrutura.png" alt="">
            </div>
        </div>
    </div>
    
    <!-- Seção de footer -->

    <div class="container branco footer">
        <p>ABIMAQ 2022 &copy; Todos os direitos reservados</p>
        <small>Desenvolvido por <a href="https://www.linkedin.com/in/vinicius-fernandes-andrade/">@vinituis</a></small>
    </div>

</body>
</html>