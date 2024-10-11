<?php
 
    include '../conexao/conexao.php';
    session_start();

    if (!isset($_SESSION["id_cons"])) {
        header("location:../login/tela_de_login.php?msg=1");
    }elseif ($_SESSION["admim"] < 3) {
        echo "<script> alert('Você não tem permissão pra acessar essa página') </script>";
        echo "<script>window.location.replace('select_conse.php')</script>";
    }

    //Mostrar sexo
    $sql1 = "SELECT * FROM sexo";
    $listarSexo = mysqli_query($conexao, $sql1);
    
    //Mostrar ct
    $sql2 = "SELECT * FROM conselho_tutelar";
    $executeCT = mysqli_query($conexao, $sql2);

    //Mostrar ct
    $sql3 = "SELECT * FROM situacao_con";
    $executeSituacao = mysqli_query($conexao, $sql3);

    //Mostrar ct
    $sql4 = "SELECT * FROM religiao";
    $executeReligiao = mysqli_query($conexao, $sql4);
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar conselheiro no sistema</title>
    <!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>
    <link rel="stylesheet" href="../css/formulario.css">

</head>
<body>
    <?php include "../includes/navbar.php";?>

    <center>
        <h3 class="main-title">Cadastrar novo conselheiro</h3>
    </center>


    <div class="container teste">
        <!-- action="inserir/inserir_ct.php" -->
        <form action="inserir_conselheiro.php" method="post" enctype="multipart/form-data">

            <article class="row separa">
            <h4>Dados pessoais</h4>
                <section class=" col-sm-12">
                    <div class="mb-3 mt-3">
                        <label for="exampleInputEmail1" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" name="nome_conselheiro" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3 ">
                        <label for="exampleInputPassword1" class="form-label">Nome social</label>
                        <input type="text" class="form-control" name="nome_social" id="exampleInputPassword1">
                    </div>

                </section>    
                <section class=" col-sm-12">
                    <div class="mb-3 ">
                        <label for="exampleInputPassword1" class="form-label">Apelido</label>
                        <input type="text" class="form-control" name="apelido" id="exampleInputPassword1">
                    </div>

                    <div class="mb-3 ">
                        <label for="endereco" class="form-label">Data de nascimento</label>
                        <input type="date" class="form-control" name="dt_nascimento" id="dt_nasc" aria-describedby="emailHelp" >
                    </div>

                    <div class="mb-3 ">
                        <label for="exampleInputEmail1" class="form-label">Cor</label>
                        <input type="text" class="form-control" name="cor" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3 ">

                        <!-- Listar sexo -->
                        <label for="select" class="form-label">Sexo: </label><br>
                            <?php
                                $i = 0;
                                while($listagemSexo = mysqli_fetch_array($listarSexo)){
                                    $i++;
                            ?>
                                <input type="radio" name="sexo_conse" value="<?php echo $listagemSexo[0]?>" id="<?php echo $i?>">
                                <label for="<?php echo $i?>" ><?php echo $listagemSexo["nome"]?> </label>
                                <br>
                            <?php
                                }
                            ?>
                    </div>
            </article>

            <!-- Informações profissionais -->
            <article class="row separa">
            <h4>Dados profissas</h4>
                <section class=" col-sm-12">
                    <div class="mb-3 mt-3">
                        <label for="exampleInputEmail1" class="form-label">Numero de identificação (Matricula)</label>
                        <input type="text" class="form-control" name="matricula" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3 ">
                        <label for="bairro" class="form-label">Email profissional</label>
                        <input type="text" class="form-control" name="email" id="bairro">
                    </div>
                    
                    <div  id="contato">
                        <div class="mb-3 ">
                            <label for="exampleInputEmail1" class="form-label">Contato profissional</label>
                            <button type="button"  class="btn btn-success" id="add">+</button>
                            <input type="text" class="form-control tel" name="contato[]" id="tel" aria-describedby="emailHelp" onkeyup="maskTel()">
                            
                        </div>
                    </div>
                    <div class="mb-3 ">
                        <label for="exampleInputEmail1" class="form-label">Senha</label>
                        <input type="text" class="form-control" name="senha" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                </section>
                <section class=" col-sm-12">

                    <div class="mb-3 ">
                        <label for="exampleInputEmail1" class="form-label">Imagem de perfil</label>

                        <input type="hidden" name="MAX_FILE_SIZE" value="10073741824">
                        <input type="file" class="form-control" name="upload_imagem" id="exampleInputEmail1" aria-describedby="emailHelp" accept="image/*">
                        <span>Tamanho máximo: 10MB</span>
                    </div>

                    <div class="mb-3 ">
                    <label for="select" class="form-label">Selecione a Situação do conselheiro</label>
                        <select class="form-select selecionar" name="situacao" aria-label="Default select example" name="tipoV" id="select">
                            <?php
                                while($listagemSituacao = mysqli_fetch_array($executeSituacao)){
                            ?>
                                <option value="<?php echo $listagemSituacao[0]?>"> <?php echo $listagemSituacao["nome"]?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>

                        <div class="mb-3 ">
                        <label for="select" class="form-label">Selecione o Conselho Tutelar</label>
                            <select class="form-select selecionar" name="ct" aria-label="Default select example" name="tipoV" id="select">
                                <?php
                                    while($listagemCT = mysqli_fetch_array($executeCT)){
                                ?>
                                    <option value="<?php echo $listagemCT[0]?>"> <?php echo $listagemCT["nome"]?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    <div class="mb-3 ">

                    <!-- Listar estado -->
                        <label for="select" class="form-label">Selecione a Religião do conselheiro</label>
                        <select class="form-select selecionar" name="religiao" aria-label="Default select example" name="tipoV" id="select">
                            <?php
                                while($listagemReligiao = mysqli_fetch_array($executeReligiao)){
                            ?>
                                <option value="<?php echo $listagemReligiao[0]?>"> <?php echo $listagemReligiao["nome"]?></option>
                            <?php
                                }
                            ?>
                        </select>
                    <!-- Fim do listar estado -->

                    </div>
                </section>
            </article>
            
            <button type="submit" class="btn main-btn mt-3">Cadastrar conselheiro</button>
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