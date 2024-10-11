<?php
 
    include '../conexao/conexao.php';
    session_start();

    // if (!isset($_SESSION["id_cons"])) {
    //     header("location:../login/tela_de_login.php?msg=1");
    // }elseif ($_SESSION["admim"] < 3) {
    //     echo "<script> alert('Você não tem permissão pra acessar essa página') </script>";
    //     echo "<script>window.location.replace('select_conse.php')</script>";
    // }
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar noticia</title>
    <!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>
    <link rel="stylesheet" href="../css/formulario.css">

</head>
<body>
    <?php include "../includes/navbar.php";?>

    <center>
        <h3 class="main-title">Cadastrar nova Notícia ou Evento</h3>
    </center>

    <?php
        if(isset($_GET["message"])){
    ?>
        </div>
            <div class="alert alert-primary alert-dismissible fade show alerta" role="alert" >
                <h3 style="display: flex; align-items: center; justify-content: center;"><b>Noticia cadastrada com sucesso</b></h3>
                <center>
                    <img src="../img/ok.png" alt="">
                    <h6>Essa noticia foi cadastrada no sistema</h6>
                </center>
                
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="atualizarUrl()"></button>
            </div>
        </div> 
    <?php
        }
    ?>

    <div class="container teste">

        <form action="inserirNoticias.php" method="post" enctype="multipart/form-data">

            <article class="row separa">
            <h4>Dados da noticia</h4>
                <section class=" col-sm-12">

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Adicione uma imagem</label>

                        <input type="hidden" name="MAX_FILE_SIZE" value="10073741824">
                        <input type="file" class="form-control" name="imagem_noticia" aria-describedby="emailHelp" accept="image/*">
                        <span>Tamanho máximo: 10MB</span>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="exampleInputEmail1" class="form-label">Titulo da noticía</label>
                        <input type="text" class="form-control" name="titulo_noticias"  aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3 ">
                        <label for="exampleInputPassword1" class="form-label">Descrição da notícias</label>
                        <textarea class="form-control" name="descricao_noticias" ></textarea>
                    </div>

                </section>    
                <button type="submit" class="btn main-btn mt-3">Cadastrar nova notícia</button>    
            </article>
            
        </form>

</div>
    


 <!--Dependencias JS-->
 <script src="../js/main.js"></script>
 
    <!-- JS -->
    <script>
        $(".tel").mask("(99) 99999-9999");      
    </script>
</body>
</html>

<?php
    mysqli_close($conexao);
?>