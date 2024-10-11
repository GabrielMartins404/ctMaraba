<?php
 
    include '../conexao/conexao.php';

    //Mostrar cidades
    $cidade = "SELECT * FROM cidade";
    
    $listarCity = mysqli_query($conexao, $cidade);
    if(!$listarCity){
        die("ERRO no comando de cidade");
    }
    
    //Mostrar estados
    $uf = "SELECT * FROM uf";
    
    $executeUf = mysqli_query($conexao, $uf);
    if(!$executeUf){
        die("ERRO no UF");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadstrar novo conselho no sistema</title>
   <!-- Bibliotecas de estilo -->
   <?php include "../includes/bibliotecas.php"?>

   <link rel="stylesheet" href="../css/formulario.css">

</head>
<body>


    <?php include "../includes/navbar.php";?>
    
    <a  href='index.php' class='btn voltar print'><i class="fas fa-arrow-left"></i></a>

    <center>
        <h3 class="main-title">Cadastrar novo conselho tutelar</h3>
    </center>


    <div class="container teste">
        <!-- action="inserir/inserir_ct.php" -->
        <form action="inserir_ct.php" method="post" enctype="multipart/form-data">
            <article class="row ">
                    <div  id="contato">
                        <div class="mb-3 ">
                            <label for="exampleInputEmail1" class="form-label">Contatos do conselho</label>
                            <button type="button"  class="btn btn-success" id="add">+</button>
                            <input type="text" class="form-control" name="contato[]" id="tel" aria-describedby="emailHelp" onkeyup="maskTel()"> 
                        </div>
                    </div>
                <section class="col-lg-6 col-md-6 col-sm-12">
                    <div class="mb-3 ">
                        <label for="exampleInputEmail1" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nomect" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3 ">
                        <label for="exampleInputPassword1" class="form-label">Site</label>
                        <input type="text" class="form-control" name="sitect" id="exampleInputPassword1">
                    </div>

                </section>    
                <section class="col-lg-6 col-md-6 col-sm-12">
                    <div class="mb-3 ">
                        <label for="exampleInputPassword1" class="form-label">Email</label>
                        <input type="text" class="form-control" name="emailct" id="exampleInputPassword1">
                    </div>


                    <div class="mb-3 ">
                        <label for="exampleInputEmail1" class="form-label">Selecione uma imagem</label>

                        <input type="hidden" name="MAX_FILE_SIZE" value="10073741824">
                        <input type="file" class="form-control" name="upload_imagem" id="exampleInputEmail1" aria-describedby="emailHelp" accept="image/*">
                        <span>Tamanho máximo: 10MB</span>
                    </div>

            
            </article>

            <article class="row ">
                <section class="col-lg-6 col-md-6 col-sm-12">
                    <div class="mb-3 ">
                        <label for="exampleInputEmail1" class="form-label">Endereço</label>
                        <input type="text" class="form-control" name="endereco" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3 ">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" class="form-control" name="bairro" id="bairro">
                    </div>
                
                    <div class="mb-3 ">
                        <label for="exampleInputPassword1" class="form-label">Numero</label>
                        <input type="text" class="form-control" name="numero" id="exampleInputPassword1">
                    </div>

                    <div class="mb-3 ">
                        <label for="exampleInputEmail1" class="form-label">Complemento</label>
                        <input type="text" class="form-control" name="complemento" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                </section>
                <section class="col-lg-6 col-md-6 col-sm-12">
                    <div class="mb-3 ">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control" name="cep" id="cep">
                    </div>

                    <div class="mb-3 ">
                        <label for="endereco" class="form-label">Ponto de referência</label>
                        <input type="text" class="form-control" name="ptreferencia" id="endereco" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3 ">

                        <!-- Listar cidade -->
                        <label for="select" class="form-label">Selecione a cidade</label>
                        <select class="form-select selecionar" name="cidade" aria-label="Default select example" name="tipoV" id="select">
                            <?php
                                while($listagemCity = mysqli_fetch_array($listarCity)){
                            ?>
                                <option value="<?php echo $listagemCity[0]?>"> <?php echo $listagemCity["nome"]?></option>
                            <?php
                                }
                            ?>
                        </select>
                        <!-- Fim do select de imagens -->

                    </div>

                    <div class="mb-3 ">

                    <!-- Listar estado -->
                        <label for="select" class="form-label">Selecione o estado</label>
                        <select class="form-select selecionar" name="uf" aria-label="Default select example" name="tipoV" id="select">
                            <?php
                                while($listarUf = mysqli_fetch_array($executeUf)){
                            ?>
                                <option value="<?php echo $listarUf[0]?>"> <?php echo $listarUf["nome"]?></option>
                            <?php
                                }
                            ?>
                        </select>
                    <!-- Fim do listar estado -->

                    </div>
                </section>
            </article>
            
            <button type="submit" class="btn main-btn">Cadastrar conselho</button>
        </form>
</div>

    <!--Dependencias JS-->
    <script src="../js/main.js"></script>
</body>
</html>

<?php
    mysqli_close($conexao);
?>