<?php
 require_once 'conexao/conexao.php';
 session_start();

 $sql_ct = "SELECT * FROM conselho_tutelar";
 $sql_ct_exe = mysqli_query($conexao, $sql_ct);

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Conselho Tutelar Digital Marabá-PA</title>

  <!-- Bibliotecas de estilo -->
  <?php include "includes/bibliotecas.php"?>

  <!-- Estilos index -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/main-style.css">

  <style>
    .location{
      text-decoration: none;
      color: #444;
    }

  </style>
</head>
<body>

  <!-- Seção de cabeçalho e Nav BAR -->
  <header class="print">
    <div class="container" id="nav-container">
      <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
        <a class="navbar-brand" href="index.html">
          <img id="logo" src="img/icon.png" alt="Logo CT Digital"> CT Digital
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-links" aria-controls="navbar-links" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse justify-content-end" id="navbar-links">
          <div class="navbar-nav">
            <a href="index.php" class="nav-item nav-link" id="home-menu">Home</a>

            <li class="nav-item nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Listar dados
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item nav-item nav-link" href="ct/index.php">Conselhos tutelares</a></li>
                    <li><a class="dropdown-item nav-item nav-link" href="conselheiros/select_conse.php">Conselheiros</a></li>

                    <?php
                        if(isset($_SESSION["logado"])){
                    ?>
                        <li><a class="dropdown-item nav-item nav-link" href="denuncia/listar_den.php">Denúncias</a></li>
                    <?php
                        }
                    ?>
                </ul>
            </li>

            <?php
                if(isset($_SESSION["logado"]) && $_SESSION["admim"] >= 3 ){
            ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Cadastrar dados
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item nav-item nav-link" href="ct/cadastrar_conselho.php">Conselhos tutelares</a></li>
                        <li><a class="dropdown-item nav-item nav-link" href="conselheiros/cadastrar_conselheiro.php">Conselheiros</a></li>
                        
                    </ul>
                </li>
            <?php
                }
            ?>

            <a class="nav-link" href="denuncia/cadastrar_den.php">Fazer denúncia</a>
            <a href="others/perguntas.php" class="nav-item nav-link" id="conselheiros-menu">Perguntas frequentes</a>
            <a href="others/sobre.php" class="nav-item nav-link" id="conselheiros-menu">Sobre</a>

            <!-- Botões de login e sair -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end" style="margin:0 10px 0 20px">
                <a class="nav-link btn main-btn btn-login" href="login/tela_de_login.php">Login</a>
                <?php
                    if (isset($_SESSION["logado"])) {
                        echo'<a class="nav-link btn main-btn btn-sair" href="login/destroi.php">Sair</a>';
                    }
                ?>
            </div>

          </div>
        </div>
      </nav>
    
  </div>
  </header>

  <main>

    <div class="container-fluid">

      <!-- Seção de conselhos -->
      <div id="secao-conselhos">
        <div class="container">
            <div class="row">
              <div class="col-12"> 
                <h3 class="main-title">Conselhos Tutelares</h3>
              </div>

              <!-- Conselhos -->
              <?php

                // Mostrar todos os outros conselhos
                while( $res_ct = mysqli_fetch_array($sql_ct_exe)){
                  $id_conselho = $res_ct['id_conselho']; //Id dos conselhos tutelares

                  // Comando para conseguir os endereços dos conselhos tuteares
                  $id_end_ct = $res_ct["id_enderecoct"];

                  $sql_endCT = "SELECT * FROM endereco_ct WHERE id_enderecoCt = $id_end_ct";
                  $endCT_execute = mysqli_query($conexao, $sql_endCT);
                 
                  $res_endCT = mysqli_fetch_array($endCT_execute);

              ?>
              <div class="col-md-6">
                <a href="ct/detalhe.php?codigo=<?php echo $id_conselho?>">
                  <img class="img-fluid" src="<?php echo $res_ct['imagem']?>" alt="Conselhos Tutelares">
                </a>
              </div>
              <div class="col-md-6 info-ct">
                <h3 class="about-title"><?php echo $res_ct['nome']?></h3>
                <p>Conselho tutelar localizado no bairro <?php echo $res_endCT['bairro']?>.</p>
                <p>Funcionamento de segunda a sabádo.</p>
                <p>Veja mais informações:</p>
                
                <ul id="about-list">
                  <li><i class="fas fa-check"></i> Rua: <?php echo $res_endCT['endereco']?></li>
                  <li><i class="fas fa-check"></i> Endereço: <?php echo $res_endCT['numero']?></li>
                  <li><i class="fas fa-check"></i> Contatos: 
                  <?php 
                    // Comando para conselguir os contatos referentes aos conselhos
                    $sql_cont_ct = "SELECT * FROM contato_ct WHERE id_conselho = $id_conselho";
                    $sql_cont_exe = mysqli_query($conexao, $sql_cont_ct);

                    if(mysqli_num_rows($sql_cont_exe) > 1){ 
                      while( $res_cont_ct = mysqli_fetch_array($sql_cont_exe)){
                        echo $res_cont_ct['numero'] . " / ";;
                      }
                      
                    }else{
                      $res_cont_ct = mysqli_fetch_array($sql_cont_exe);
                      echo $res_cont_ct['numero'];
                    }
                  ?></li>
                  <li><i class="fas fa-check"></i> Email: <?php echo $res_ct['email']?></li>
                  <li><i class="fas fa-check"></i> Ponto de referência: <?php echo $res_endCT['ponto_referencia']?></li>
                </ul>
              </div>

              
              <!-- Inicio da listagem dos conselheiros -->
              <div id="conselheiros" style="margin-bottom: 70px;">
                  <div class="container">
                    <div class="row centralizar">

                      <div class="col-12 mb-5">
                        <h3 style="text-align: center;">Conselheiros do núcleo <?php echo $res_endCT['bairro']?></h3>
                      </div>
              
              <?php
                // Comando para listar os conselheiros referentes a cada conselho tutelar
                $sql_cons = "SELECT id_conselheiro, nome, imagem, id_CT FROM conselheiro WHERE id_CT = $id_conselho";
                $sql_cons_exe = mysqli_query($conexao, $sql_cons);

                while ($res_conselheiros = mysqli_fetch_array($sql_cons_exe)) {
                  
              ?>
                <!-- Parte HTML -->
                      <div class="col-md-3 cartao">
                        <a href="conselheiros/detalhes_cons.php?id=<?php echo  $res_conselheiros['id_conselheiro']?>" class="card">
                          <img src="<?php echo $res_conselheiros['imagem']?>" alt="Imagem de perfil" class="img-conselheiros" style="width: 100%; height: 200px;">
                          <div class="card-body">
                            <h5 class="card-title"><?php echo $res_conselheiros['nome']?></h5>
                            <p class="card-text"><?php echo $res_ct['nome']?></p>
                          </div>
                        </a>
                      </div>
              <?php
                  }
              ?>
                  </div>
                </div>
              </div>
              <!-- Fim da listagem dos conselheiros -->
              <?php
                }
              ?>
            </div>
          </div>
      </div>
      <!-- Fim da listagem dos conselhos tutelares -->

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
              <img src="img1/proj1.jpg" class="img-fluid" alt="Evento 1">
            </div>
            <div class="col-md-4 project-box noti">
              <img src="img1/proj2.jpg" class="img-fluid" alt="Noticia 2">
            </div>
            <div class="col-md-4 project-box nova">
              <img src="img1/proj3.jpg" class="img-fluid" alt="Atualização 3">
            </div>
            <div class="col-md-4 project-box even">
              <img src="img1/proj4.jpg" class="img-fluid" alt="Evento 4">
            </div>
            <div class="col-md-4 project-box noti">
              <img src="img1/proj5.jpg" class="img-fluid" alt="Noticia 5">
            </div>
            <div class="col-md-4 project-box nova">
              <img src="img1/proj6.jpg" class="img-fluid" alt="Atualização 6">
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
              <p><span class="contact-tile">Contato para denúncia:</span> (48)99999-9999</p>
              <p><span class="contact-tile">Horários de funcionamento:</span> 8:00 - 19:00</p>
            </div>
            <div class="col-md-4 contact-box">
              <i class="fas fa-envelope"></i>
              <p><span class="contact-tile">Email para atendimentos:</span> ct@ct.com.br</p>
            </div>
            <div class="col-md-4 contact-box">
              <i class="fas fa-map-marker-alt"></i>
              <p><span class="contact-tile">Localização dos conselhos:
                <p>
                  <ul id="about-list">
                    <li><a href="https://goo.gl/maps/sqQ87YUpfo1e26Nf8" target="_blank" class="location">Nova Marabá</a></li>
                    <li><a href="https://goo.gl/maps/e48FwCnZni52qYFF9" target="_blank" class="location">Cidade Nova</a></li>
                  </ul>
                </p>
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

  <script src="js/scripts.js"></script>

  </script>
</body>
</html>

<?php
    mysqli_close($conexao);
?>