<?php
 require_once '../conexao/conexao.php';

 $sql_cons = "SELECT 	id_conselheiro, nome, imagem, id_CT FROM conselheiro";
 $sql_cons_exe = mysqli_query($conexao, $sql_cons);

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
  <?php include "../includes/bibliotecas.php"?>

  <style>
    .location{
      text-decoration: none;
      color: #444;
    }
  </style>
</head>
<body>

  <!-- Seção de cabeçalho e Nav BAR -->
  <?php
    include "../includes/navbar.php";
  ?>

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
                // Mostrar somente um conselho tutelar
                $res_ct_one = mysqli_fetch_array($sql_ct_exe);
                $id_end_ct_one = $res_ct_one["id_enderecoct"];

                $sql_endCT_one = "SELECT * FROM endereco_ct WHERE id_enderecoCt = $id_end_ct_one";
                $endCT_execute_one = mysqli_query($conexao, $sql_endCT_one);
               
                $res_endCT_one = mysqli_fetch_array($endCT_execute_one);
              ?>
              
              <div class="col-md-6">
                <img class="img-fluid" src="<?php echo $res_ct_one['imagem']?>" alt="Agência hDC">
              </div>
              <div class="col-md-6 info-ct">
                <h3 class="about-title"><?php echo $res_ct_one['nome']?></h3>
                <p>Conselho tutelar localizado no bairro <?php echo $res_endCT_one['bairro']?>.</p>
                <p>Funcionamento de segunda a sabádo.</p>
                <p>Veja mais informações:</p>
                
                <ul id="about-list">
                  <li><i class="fas fa-check"></i> Rua: <?php echo $res_endCT_one['endereco']?></li>
                  <li><i class="fas fa-check"></i> Endereço: <?php echo $res_endCT_one['numero']?></li>
                  <li><i class="fas fa-check"></i> Contatos: <?php 

                    $id_cont = $res_ct_one['id_conselho'];
                    $sql_cont_ct = "SELECT * FROM contato_ct WHERE id_conselho = $id_cont";
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
                  <li><i class="fas fa-check"></i> Email: <?php echo $res_ct_one['email']?></li>
                  <li><i class="fas fa-check"></i> Ponto de referência: <?php echo $res_endCT_one['ponto_referencia']?></li>
                </ul>
              </div>
              <hr>

              <span id="mostrar-mais" class="row" style=" display:none;">
              <?php

                // Mostrar todos os outros conselhos
                while( $res_ct = mysqli_fetch_array($sql_ct_exe)){
                  // Comando para conseguir os endereços
                  $id_end_ct = $res_ct["id_enderecoct"];

                  $sql_endCT = "SELECT * FROM endereco_ct WHERE id_enderecoCt = $id_end_ct";
                  $endCT_execute = mysqli_query($conexao, $sql_endCT);
                 
                  $res_endCT = mysqli_fetch_array($endCT_execute);

              ?>
              <div class="col-md-6">
                <img class="img-fluid" src="<?php echo $res_ct['imagem']?>" alt="Agência hDC">
              </div>
              <div class="col-md-6 info-ct">
                <h3 class="about-title"><?php echo $res_ct['nome']?></h3>
                <p>Conselho tutelar localizado no bairro <?php echo $res_endCT['bairro']?>.</p>
                <p>Funcionamento de segunda a sabádo.</p>
                <p>Veja mais informações:</p>
                
                <ul id="about-list">
                  <li><i class="fas fa-check"></i> Rua: <?php echo $res_endCT['endereco']?></li>
                  <li><i class="fas fa-check"></i> Endereço: <?php echo $res_endCT['numero']?></li>
                  <li><i class="fas fa-check"></i> Contatos: <?php 

                    $id_cont = $res_ct['id_conselho'];
                    $sql_cont_ct = "SELECT * FROM contato_ct WHERE id_conselho = $id_cont";
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
              
              <hr>
              <?php
                }
              ?>
              </span>
            </div>
          </div>
      </div>
      <button id="expandir-retrair" class="col-12">
        <p id="msg-mostrar">Mostrar Mais</p>
        <i class="fas fa-chevron-down mais-menos" id="seta"></i>
      </button>

      <!-- Conselheiros -->
      <div id="conselheiros" style="margin-bottom: 70px;">
        <div class="container">
          <div class="row centralizar">

            <div class="col-12">
              <h3 class="main-title">Conselheiros</h3>
            </div>

            <?php
              while( $res_cons = mysqli_fetch_array($sql_cons_exe)){
                $id_cons_ct = $res_cons["id_CT"];

                $sql_cons_ct = "SELECT nome FROM conselho_tutelar WHERE id_conselho = $id_cons_ct";
                $cons_ct_exe = mysqli_query($conexao, $sql_cons_ct);
                $res_cons_ct = mysqli_fetch_array($cons_ct_exe); 
            ?>

            <div class="col-md-3 cartao">
              <a href="../conselheiros/detalhes_cons.php?id=<?php echo $res_cons['id_conselheiro']?>" class="card">
                <img src="<?php echo $res_cons['imagem']?>" alt="Imagem de perfil">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $res_cons['nome']?></h5>
                  <p class="card-text"><?php echo $res_cons_ct['nome']?></p>
                </div>
              </a>
            </div>

            <?php
              }
            ?>
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
            <div class="col-md-6" id="msg-box">
              <p>Faça uma denúncia:</p>
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
      
  <script>
    var msg = document.getElementById("msg-mostrar")
    var mostrar_mais = document.getElementById("mostrar-mais")
    var botao_expandir = document.getElementById("expandir-retrair")
    var seta = document.getElementById("seta")

    botao_expandir.addEventListener("click", function(){
      if(mostrar_mais.style.display == "none"){
        mostrar_mais.style.display = "flex";
        $("#seta").removeClass("fa-chevron-down");
        $("#seta").addClass("fa-chevron-up");
        msg.innerHTML = "Mostrar Menos"

      }else{
        mostrar_mais.style.display = "none";
        $("#seta").removeClass("fa-chevron-up");
        $("#seta").addClass("fa-chevron-down");
        voltar()
        msg.innerHTML = "Mostrar Mais"
      }
    })

    function voltar(){
      $("html, body").animate({scrollTop : "80"}, 500);
    }

  </script>
</body>
</html>