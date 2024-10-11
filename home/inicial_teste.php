<?php
 require_once '../conexao/conexao.php';
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Conselho Tutelar Digital Marabá-PA</title>

  <!-- Fontes -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/main-style.css">

  <!-- Java script -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

   <!-- Icones -->
   <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

   <!-- Parallax -->
   <script src="https://cdn.jsdelivr.net/parallax.js/1.4.2/parallax.min.js"></script>
</head>
<body>

  <!-- Seção de cabeçalho e Nav BAR -->
  <?php
    include "../includes/navbar.php";
  ?>

  <main>

    <div class="container-fluid">

      <!-- Seção de conselhos -->
      <div id="about-area">
        <div class="container">
            <div class="row">
              <div class="col-12"> 
                <h3 class="main-title">Conselhos Tutelares</h3>
              </div>

              <div class="col-md-6">
                <img class="img-fluid" src="../img1/agencia.jpg" alt="Agência hDC">
              </div>
              <div class="col-md-6">
                <h3 class="about-title">Conselho Cidade Nova</h3>
                <p>Conselho tutelar localizado na liberdade.</p>
                <p>E nossos designers trabalharão na sua interface/layout para impulsionar o negócio.</p>
                <p>Funcionamento de segunda a sabádo.</p>
                <p>Veja mais informações:</p>
                
                <ul id="about-list">
                  <li><i class="fas fa-check"></i> Endereço: </li>
                  <li><i class="fas fa-check"></i> Rua: </li>
                  <li><i class="fas fa-check"></i> Contatos:</li>
                  <li><i class="fas fa-check"></i> Email:</li>
                  <li><i class="fas fa-check"></i> Ponto de referência: </li>
                </ul>
              </div>

              <span style="margin: 15px 0px 10px 0px;"></span>

              <div class="col-md-6">
                <img class="img-fluid" src="../img1/agencia.jpg" alt="Agência hDC">
              </div>
              <div class="col-md-6">
                <h3 class="about-title">Conselho Nova Marabá</h3>
                <p>Conselho tutelar localizado na liberdade.</p>
                <p>E nossos designers trabalharão na sua interface/layout para impulsionar o negócio.</p>
                <p>Funcionamento de segunda a sabádo.</p>
                <p>Veja mais informações:</p>
                
                <ul id="about-list">
                  <li><i class="fas fa-check"></i> Endereço: </li>
                  <li><i class="fas fa-check"></i> Rua: </li>
                  <li><i class="fas fa-check"></i> Contatos:</li>
                  <li><i class="fas fa-check"></i> Email:</li>
                  <li><i class="fas fa-check"></i> Ponto de referência: </li>
                </ul>
              </div>

            </div>
          </div>
      </div>

      <!-- Conselheiros -->
      <div id="team-area" style="margin-bottom: 70px;">
        <div class="container">
          <div class="row centralizar">

            <div class="col-12">
              <h3 class="main-title">Conselheiros</h3>
            </div>

            <div class="col-md-2 cartao">
              <div class="card">
                <img src="../img1/profile1.jpg" alt="Imagem de perfil">
                <div class="card-body">
                  <h5 class="card-title">Shwaisteinger</h5>
                  <p class="card-text">Conselho Nova Marabá</p>
                </div>
              </div>
            </div>

            <div class="col-md-2 cartao">
              <div class="card">
                <img src="../img1/profile2.jpg" alt="Imagem de perfil">
                <div class="card-body">
                  <h5 class="card-title">Regina</h5>
                  <p class="card-text">Conselho Nova Marabá</p>
                </div>
              </div>
            </div>

            <div class="col-md-2 cartao">
              <div class="card">
                <img src="../img1/profile3.jpg" alt="Imagem de perfil">
                <div class="card-body">
                  <h5 class="card-title">Pastor</h5>
                  <p class="card-text">Conselho Nova Marabá</p>
                </div>
              </div>
            </div>

            <div class="col-md-2 cartao">
              <div class="card">
                <img src="../img1/profile4.jpg" alt="Imagem de perfil">
                <div class="card-body">
                  <h5 class="card-title">Ana Júlia</h5>
                  <p class="card-text">Conselho Cidade Nova</p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- Informações do conselho sobre o que faz -->
      <div id="services-area">
        <div class="container">
          <div class="row">
            <div class="col-12">
                <h3 class="main-title">Informações sobre os conselhos</h3>
            </div>
            <div class="col-md-4 service-box">
              <i class="fas fa-bullhorn"></i>
              <h4>Atendimentos de denúncias</h4>
              <p>Essa plataforma pode ser utilizada como uma maneira de realizar uma denúncia a algum conselho tutelar.</p>
            </div>
            <div class="col-md-4 service-box">
              <i class="fas fa-users"></i>
              <h4>Conselheiros preparados</h4>
              <p>COnselheiros preparados para atender e acompanhar crianças em situações de vulnerabilidade.</p>
            </div>
            <div class="col-md-4 service-box">
              <i class="fas fa-headset"></i>
              <h4>Suporte legal</h4>
              <p>Damos suportes a crianças que necessitem.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Eventos e notícias -->
      <div id="portfolio-area">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h3 class="main-title">Eventos e notícias</h3>
            </div>
            <div class="col-md-12" id="filter-btn-box">
              <button class="main-btn filter-btn active" id="all-btn">Todos</button>
              <button class="main-btn filter-btn" id="noti-btn">Notícias</button>
              <button class="main-btn filter-btn" id="even-btn">Eventos</button>
              <button class="main-btn filter-btn" id="nova-btn">Últimas atualizações</button>
            </div>
            <div class="col-md-4 project-box even">
              <img src="../img1/proj1.jpg" class="img-fluid" alt="Projeto 1">
            </div>
            <div class="col-md-4 project-box noti">
              <img src="../img1/proj2.jpg" class="img-fluid" alt="Projeto 2">
            </div>
            <div class="col-md-4 project-box nova">
              <img src="../img1/proj3.jpg" class="img-fluid" alt="Projeto 3">
            </div>
            <div class="col-md-4 project-box even">
              <img src="../img1/proj4.jpg" class="img-fluid" alt="Projeto 4">
            </div>
            <div class="col-md-4 project-box noti">
              <img src="../img1/proj5.jpg" class="img-fluid" alt="Projeto 5">
            </div>
            <div class="col-md-4 project-box nova">
              <img src="../img1/proj6.jpg" class="img-fluid" alt="Projeto 6">
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Rodapé -->
  <footer>
    <div id="contact-area">
      <div class="container">
          <div class="row">

            <!-- Contatos dos conselhos tutelares -->
            <div class="col-md-12">
              <h3 class="main-title">Contatos</h3>
            </div>
            <div class="col-md-4 contact-box">
              <i class="fas fa-phone"></i>
              <p><span class="contact-tile">Ligue para:</span> (48)99999-9999</p>
              <p><span class="contact-tile">Horários:</span> 8:00 - 19:00</p>
            </div>
            <div class="col-md-4 contact-box">
              <i class="fas fa-envelope"></i>
              <p><span class="contact-tile">Envie um email:</span> ct@ct.com.br</p>
            </div>
            <div class="col-md-4 contact-box">
              <i class="fas fa-map-marker-alt"></i>
              <p><span class="contact-tile">Localização dos conselhos:</span> Conselhos tutelares</p>
            </div>
            <div class="col-md-6" id="msg-box">
              <p>Ou nos deixe uma mensagem:</p>
            </div>

            <!-- Campos de formulário do rodapé -->
            <div class="col-md-6" id="contact-form">
              <form action="">
                <input type="text" class="form-control" placeholder="E-mail" name="email">
                <input type="text" class="form-control" placeholder="Assunto" name="subject">
                <textarea class="form-control" rows="3" placeholder="Sua mensagem..." name="message"></textarea>
                <input type="submit" class="main-btn">
              </form>
            </div>
          </div>
      </div>
    </div>

    <!-- copyright -->
    <div id="copy-area">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
              <p>Adaptado por <a href="#">Grupo de extensão IFPA-CMI</a> &copy; 2021</p>
            </div>
        </div>
      </div>
    </div>
  </footer>

  <script src="../js/scripts.js"></script>
</body>
</html>