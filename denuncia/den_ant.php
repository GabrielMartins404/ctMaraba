<?php
 
    include '../conexao/conexao.php';
    session_start();

    //Mostrar sexo
    $sql1 = "SELECT * FROM sexo";
    $listarSexo = mysqli_query($conexao, $sql1);

    $sql5 = "SELECT * FROM sexo";
    $exe_sex_vitima = mysqli_query($conexao, $sql5);
    
    //Mostrar ct
    $sql2 = "SELECT * FROM parentesco";
    $execute_parentesco = mysqli_query($conexao, $sql2);

    //Mostrar ct
    $sql3 = "SELECT * FROM tipo_violacao";
    $execute_tipo_violacao = mysqli_query($conexao, $sql3);

    //Mostrar ct
    $sql4 = "SELECT * FROM subtipo_violacao";
    $execute_subtipo_v = mysqli_query($conexao, $sql4);
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denuncias</title>
    <!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>
    <link rel="stylesheet" href="../css/formulario.css">

</head>
<body>
    <?php include "../includes/navbar.php";?>

    <?php
        if(isset($_GET["message"])){
    ?>
        </div>
            <div class="alert alert-primary alert-dismissible fade show alerta" role="alert" >
                <h3 style="display: flex; align-items: center; justify-content: center;"><b>Sua denúncia foi realizada com sucesso!</b></h3>
                <center>
                    <img src="../img/ok.png" alt="">
                    <h6>A sociedade agradece pela informação</h6>
                </center>
                
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="atualizarUrl()"></button>
            </div>
        </div> 
    <?php
        }
    ?>

    <center>
        <h3 class="main-title">Nesse campo você poderá realizar uma denúncia</h3>
    </center>

    
    <div class="container teste">
        
        <form action="inserir_denuncia.php" method="post" enctype="multipart/form-data">

            <article class="row separa">
            <h4>Dados pessoais</h4>

                <section class="col-12">

                    <div class="mb-3 ">
                        <input class="form-check-input" type="checkbox" value="1" name="anonima" id="check">
                        <label for="check" class="form-label">Denúncia anônima</label> 
                    </div>
                
                    <div class="mb-3 mt-3">
                        <label for="exampleInputEmail1" class="form-label">Seu nome completo</label>
                        <input type="text" class="form-control" name="nome_denunciante" id="nome_completo" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3 ">
                        <label for="exampleInputPassword1" class="form-label">Seu email</label>
                        <input type="text" class="form-control" name="email_denunciante" id="email_completo">
                    </div>
                </section> 
            </article>
                
            <article class="row separa">
                <h4>Dados do denunciado</h4>
                <section class=" col-12">
                    <div class="mb-3 ">
                        <label for="exampleInputPassword1" class="form-label">Nome do denunciado</label>
                        <input type="text" class="form-control" name="nome_den" id="nome_den">
                    </div>

                    <div class="mb-3 ">
                        <label for="endereco" class="form-label">Contato do denunciado</label>
                        <input type="number" class="form-control" name="contato_den" id="contato_den" aria-describedby="emailHelp" >
                    </div>

                    <div class="mb-3 ">
                        <label for="exampleInputEmail1" class="form-label">Endereço do denunciado</label>
                        <input type="text" class="form-control" name="end_den" id="end_den" aria-describedby="emailHelp" required>
                    </div>

                    <div class="mb-3 ">
                        <label for="exampleInputEmail1" class="form-label">Bairro do denunciado</label>
                        <input type="text" class="form-control" name="bairro_den" id="bairro_den" aria-describedby="emailHelp"required>
                    </div>

                    <div class="mb-3 ">
                        <label for="exampleInputEmail1" class="form-label">Idade do denunciado</label>
                        <input type="number" class="form-control" name="idade_den" id="idade_den" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3 ">

                        <!-- Listar sexo -->
                        <label for="select" class="form-label">Sexo do denunciado</label><br>
                            <?php
                                $i = 0;
                                while($lista_sexo_denunciado = mysqli_fetch_array($listarSexo)){
                                    $i++;
                            ?>
                                <input type="radio" name="sexo_den" value="<?php echo $lista_sexo_denunciado[0]?>" id="<?php echo $i?>" required>
                                <label for="<?php echo $i?>" ><?php echo $lista_sexo_denunciado["nome"]?> </label>
                            <?php
                                }
                            ?>
                    </div>

                    <div class="mb-3 ">
                    <label for="select" class="form-label">Parentesco entre denunciado e vitima</label>
                        <select class="form-select selecionar" name="parentesco" aria-label="Default select example" id="select" required>
                        <option value="">---</option>

                            <?php
                                while($listagem_parentesco = mysqli_fetch_array($execute_parentesco)){
                            ?>
                                <option value="<?php echo $listagem_parentesco[0]?>"> <?php echo $listagem_parentesco["nome"]?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
            </article>

            <!-- Informações profissionais -->
            <article class="row separa">
            <h4>Dados da vítima</h4>
                <section class=" col-12">
                    <div class="mb-3 mt-3">
                        <label for="exampleInputEmail1" class="form-label">Nome da vítima</label>
                        <input type="text" class="form-control" name="nome_vit" id="nome_vit" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3 ">
                        <label for="bairro" class="form-label">Idade da vítima</label>
                        <input type="number" class="form-control" name="idade_vit" id="idade_vit" >
                    </div>

                    <div class="mb-3 ">

                        <!-- Listar sexo -->
                        <label for="select" class="form-label">Sexo da vítima </label><br>
                            <?php
                                $i = 0;
                                while($listar_sexo_vitima = mysqli_fetch_array($exe_sex_vitima)){
                                    $i++;
                            ?>
                                <input type="radio" name="sexo_vit" value="<?php echo $listar_sexo_vitima[0]?>" id="vitima_<?php echo $i?>" required>
                                <label for="vitima_<?php echo $i?>" ><?php echo $listar_sexo_vitima["nome"]?> </label>
                                <br>
                            <?php
                                }
                            ?>
                        </div>
                    
                        <div class="mb-3 ">
                            <label for="exampleInputEmail1" class="form-label">Endereço da vítima</label>
                            <input type="text" class="form-control" name="endereco_vit" id="endereco_vit" aria-describedby="emailHelp" required>
                        </div>

                        <div class="mb-3 ">
                            <label for="exampleInputEmail1" class="form-label">Ponto de referência do endereço da vítima</label>
                            <input type="text" class="form-control" name="pt_ref_vit" id="pt_ref_vit" aria-describedby="emailHelp" required>
                        </div>
    
                        <div class="mb-3 ">
                            <label for="exampleInputEmail1" class="form-label">Bairro da vítima</label>
                            <input type="text" class="form-control" name="bairro_vit" id="bairro_vit" aria-describedby="emailHelp" required>
                        </div>
                </section>

                
            </article>

            <!-- Inserir um botãp pra ser mais de um tipo de violação e uma base ajax que assim que eu escolher um no tipo
        escolha no subtipo -->
            <article class="row separa">
            <h4>Dados da denúncia</h4>
                                
            <div class="mb-3">
            <button type="button" onclick="adicionarTipoV()" class="btn btn-success" id="addTipoV">+</button>

                <div class="mb-3">
                    <label for="select" class="form-label">Tipo de violação </label><br>
                    <select class="form-select selecionar" name="tipo_violacao[]" aria-label="Default select example" id="tipo_violacao" required>
                        <option value="">---</option>

                            <?php
                                while($listar_tipo_v = mysqli_fetch_array($execute_tipo_violacao)){
                            ?>
                                <option value="<?php echo $listar_tipo_v[0]?>"> <?php echo $listar_tipo_v["nome"]?></option>
                            <?php
                                }
                            ?>
                    </select>
                </div>

                <div class="mb-3 "> 
                    <label for="select" class="form-label">Subtipo de violação </label><br>
                    <select class="form-select selecionar" name="subtipo_violacao[]" aria-label="Default select example" id="subtipo_violacao" required>
                        <option value="">---</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Faça uma breve descrição spbre o caso</label>
                    <textarea class="form-control" name="descricao" placeholder="Comente aqui" id="descricao" required></textarea>
                </div>
            </div>

            </article>
            
            <button type="submit" class="btn main-btn" style="margin-top:20px">Cadastrar denúncia</button>
        </form>
</div>

<!-- Footer -->
<?php include "../includes/footer.php"?>
    
    <script>
        function atualizarUrl(){
            window.location.replace('cadastrar_den.php')
        }

        function maskDate(){
            data = document.getElementById("dt_nasc")
            if(data.value.length == 2 || data.value.length == 5){
                data.value += "/"
            }
        }        
	
        $("#tipo_violacao").change(function(e){ 
                var tipoV = $(this).val(); //Aqui retornará o id de cada select selecionado
                
                $.ajax({
                    type:"GET",
                    url:"programas_secundarios/retornar_subtipo.php?tipoId=" + tipoV, //local onde será ,amdado os dados
                    async:false
                }).done(function(data){
                    //Já retornará automaticamente os produtos porque no retornar produtos coloco um where, que me retona todos os produtos que tenha aquela catgoria
                    var subtipo = ""

                    // Aqui diz que pra cada item retornado sera feito um loop que dará as seguintes informações
                    $.each($.parseJSON(data), function(chave, valor){ //Aqui basicamente tem o mesmo sentido da anterior, só esse parse json que converte os dados do json
                        subtipo += '<option value="' + valor.id_subtipo + '">' + valor.nome + "</option>";
                    });
                    
                    $("#subtipo_violacao").html(subtipo)
                    
                })

                
            })
    </script>
</body>
</html>

<?php
    mysqli_close($conexao);
?>