<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
    <header class="print">
    <div class="container" id="nav-container">
      <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
        <a class="navbar-brand" href="index.html">
          <img id="logo" src="../img/icon.png" alt="Logo CT Digital"> CT Digital
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-links" aria-controls="navbar-links" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse justify-content-end" id="navbar-links">
          <div class="navbar-nav">
            <a href="../" class="nav-item nav-link" id="home-menu">Home</a>

            <li class="nav-item nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Listar dados
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item nav-item nav-link" href="../ct/index.php">Conselhos tutelares</a></li>
                    <li><a class="dropdown-item nav-item nav-link" href="../conselheiros/select_conse.php">Conselheiros</a></li>

                    <?php
                        if(isset($_SESSION["logado"])){
                    ?>
                        <li><a class="dropdown-item nav-item nav-link" href="../denuncia/listar_den.php">Denúncias</a></li>
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
                        <li><a class="dropdown-item nav-item nav-link" href="../ct/cadastrar_conselho.php">Conselhos tutelares</a></li>
                        <li><a class="dropdown-item nav-item nav-link" href="../conselheiros/cadastrar_conselheiro.php">Conselheiros</a></li>
                        <li><a class="dropdown-item nav-item nav-link" href="../noticias/cadastrarNoticias.php">Noticias</a></li>
                    </ul>
                </li>
            <?php
                }
            ?>

            <a class="nav-link" href="../denuncia/cadastrar_den.php">Fazer denúncia</a>
            <a href="../others/perguntas.php" class="nav-item nav-link" id="conselheiros-menu">Perguntas frequentes</a>
            <a href="../others/sobre.php" class="nav-item nav-link" id="conselheiros-menu">Sobre</a>

            <!-- Botões de login e sair -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end" style="margin:0 10px 0 20px">
                <a class="nav-link btn main-btn btn-login" href="../login/tela_de_login.php">Login</a>
                <?php
                    if (isset($_SESSION["logado"])) {
                        echo'<a class="nav-link btn main-btn btn-sair" href="../login/destroi.php">Sair</a>';
                    }
                ?>
            </div>

          </div>
        </div>
      </nav>
    
  </div>
  </header>

    <?php
        if (isset($_SESSION["logado"])) {
            if($_SESSION["logado"]){
                include "../includes/configs.php";
            }    
        }
    ?>
    
