<?php
    require_once '../conexao/conexao.php';
    include "../uploads/upload.php"; //Aqui champ a arquivo de upploads

    if(!isset($_GET["id"])){
        header("location: select_conse.php");
    }

    //Informações do conselho e endereco
    $id = $_GET["id"];
    $sql1 = "SELECT cons.id_conselheiro as id_cons, cons.data_nascimento as dt_nasc, cons.nome as nome_cons, cons.nome_social as nome_social, cons.apelido as apelido, cons.cor as cor_cons, cons.email as email_cons, cons.imagem as imagem_cons,
    situ.id_situacaocon as id_situacao, situ.nome as nome_situ, ct.nome as nome_ct, cons.id_CT as id_ct, cons.id_sexocon as id_sexocon, s.nome as sexo  
    FROM conselheiro as cons 
    INNER JOIN situacao_con as situ ON cons.id_situacaocon = situ.id_situacaocon 
    INNER JOIN conselho_tutelar as ct on cons.id_CT = ct.id_conselho 
    INNER JOIN sexo as s on s.id_sexo = cons.id_sexocon WHERE cons.id_conselheiro = $id";
    
    $resultado = mysqli_query($conexao, $sql1);
    if(mysqli_num_rows($resultado) === 0){
        header("location: select.php");
    }
    
    $linha = mysqli_fetch_array($resultado);    
    
    //data de nascimento
    $data = $linha["dt_nasc"];

    //tabela sexo
    $sql2 = "SELECT * FROM sexo";
    $execute_select_sexo = mysqli_query($conexao, $sql2);
    
    //tabela situação
    $sql3 = "SELECT * FROM situacao_con";
    $execute_select_situacao = mysqli_query($conexao, $sql3);

    //tabela ct
    $sql4 = "SELECT * FROM conselho_tutelar";
    $execute_select_ct = mysqli_query($conexao, $sql4);

    //Tabela contato
    $sql5 = "SELECT * FROM contato_con WHERE id_conselheiro = $id";
    $execute_cont = mysqli_query($conexao, $sql5);

?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Atualização dos dados do conselheiro</title>
        <link rel="stylesheet" href="../css/listagem.css">

        <?php include "../includes/bibliotecas.php"?>

    </head>

    <body>
    <?php include "../includes/navbar.php";?>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alterar imagem</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <img src="../<?php echo $linha["imagem_cons"]?>" class="img"><br>

                        <form id="formulario_img" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $id?>">
                            <input type="hidden" name="MAX_FILE_SIZE" value="10073741824">
                            <input type="file" name="atualizar_img" id="atualizarImg" accept="image/*">

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onClick="">Fechar</button>
                                <button type="button" class="btn btn-primary" id="enviarImg">Enviar </button>
                                <button type="button" class="btn btn-danger" id="deletarImg">Deletar </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <main>
            <div class="container">
                <form action="update_cons.php?id=<?php echo $linha["id_cons"]?>" method="post">
                    <section class=" col-sm-12">
                        <li class="imagem_detalhes">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <img src="../<?php echo $linha["imagem_cons"]?>">
                            </button>
                        </li>
                        
                        <div class="mb-3 mt-3">
                            <label for="exampleInputEmail1" class="form-label">Nome</label>
                            <input type="text" value="<?php echo $linha["nome_cons"] ?>" class="form-control" name="nome_conselheiro" id="Nome" aria-describedby="emailHelp">
                        </div>

                        <div class="mb-3 ">
                            <label for="exampleInputPassword1" class="form-label">E-mail</label>
                            <input type="text" value="<?php echo $linha["email_cons"] ?>" class="form-control" name="email" id="email">
                        </div>

                        <div class="mb-3 " id="contato">
                        <label for="exampleInputPassword1" class="form-label">Contato</label>
                            <?php
                                $i = 0;
                                if ($execute_cont->num_rows != 0) {
                                    echo '<button type="button"   class="btn btn-success mb-3" id="add">+</button>';
                                    while ($listar_cont = mysqli_fetch_array($execute_cont)) {
                                        $i++;
                                        ?>
                                    <div id="remove_<?php echo $i?>" class="mb-3 div_remove">
                                        <button type="button" class="btn btn-danger btn_remove_one" id="<?php echo $i?>" style="margin-left:20px"> X </button>
                                        <input type="text" value="<?php echo $listar_cont["contato_con"] ?>" class="form-control" name="contato[]" id="tel">
                                    </div>
                            <?php
                                    }
                                }else{
                                    
                                ?>
                                <div class="div_remove mb-3">
                                    <button type="button" class="btn btn-success" id="add">+</button>
                                    <input type="text" class="form-control" name="contato[]" id="tel" aria-describedby="emailHelp" onkeyup="maskTel()">
                                </div>
                                <?php
                                    }
                            ?>

                        
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="exampleInputEmail1" class="form-label">Sexo</label>

                            <?php
                                    $id_sex = $linha["id_sexocon"];
                                    $i = 0;
                                    while ($listar_sexo = mysqli_fetch_array($execute_select_sexo)) {   
                                        $i++;  
                                        $sexo_tbs = $listar_sexo[0];
                                        if($id_sex == $sexo_tbs){
                                ?>
                                </br>
                                <input type="radio" name="sexo" value="<?php echo $listar_sexo[0]?>" id="<?php echo $i?>" checked>
                                <label for="<?php echo $i?>"><?php echo $listar_sexo["nome"]?> </label>

                                <?php
                                        }else{
                                ?>
                                    </br>
                                    <input type="radio" name="sexo" value="<?php echo $listar_sexo[0]?>" id="<?php echo $i?>">
                                    <label for="<?php echo $i?>"><?php echo $listar_sexo["nome"]?> </label>
                                    <?php
                                    }
                                }
                                ?>
                        </div>

                        <div class="mb-3 ">
                            <label for="exampleInputPassword1" class="form-label">Cor</label>
                            <input type="text" value="<?php echo $linha["cor_cons"] ?>" class="form-control" name="cor" id="cor">
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="exampleInputEmail1" class="form-label">Situação</label>

                            <select class="form-select selecionar" name="situacao" aria-label="Default select example" name="tipoV" id="select">
                                    <?php
                                        $id_situ = $linha["id_situacao"];
                                        while($listaSituacao = mysqli_fetch_array($execute_select_situacao)){
                                            if($id_situ == $listaSituacao[0]){
                                    ?>
                                        <option value="<?php echo $listaSituacao[0]?>" selected> <?php echo $listaSituacao["nome"]?></option>
                                    
                                    <?php
                                        }else{
                                    ?>
                                        <option value="<?php echo $listaSituacao[0]?>" > <?php echo $listaSituacao["nome"]?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                        </div>

                        <div class="mb-3 ">
                            <label for="exampleInputPassword1" class="form-label">Data de nascimento</label>
                            <input type="date" value="<?php echo $data?>" class="form-control" name="dt_nasc" id="dt_nasc">
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="exampleInputEmail1" class="form-label">Conselho Tutelar</label>
                            <select class="form-select selecionar" name="ct" aria-label="Default select example" name="tipoV" id="select">
                                    <?php
                                        $id_ct = $linha["id_ct"];
                                        while($lista_ct = mysqli_fetch_array($execute_select_ct)){
                                            if($id_ct == $lista_ct[0]){
                                    ?>
                                        <option value="<?php echo $lista_ct[0]?>" selected> <?php echo $lista_ct["nome"]?></option>

                                    <?php
                                            }else{
                                    ?>
                                        <option value="<?php echo $lista_ct[0]?>"> <?php echo $lista_ct["nome"]?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                        </div>

                    </section>
                    
                    <a href="detalhes_cons.php" class="btn btn-warning" style="color:white">Voltar</a>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </form>
            </div>
        </main>
        


 <!--Dependencias JS-->
 <script src="../js/main.js"></script>
        <script>

            $( "form" ).on( "click", ".btn_remove_one", function() {
                var button_id = $(this).attr("id");
                $('#remove_'+button_id+'').remove()
                
            });

            $("#deletarImg").on('click', function(e){
                var excluir = confirm("Deseja realmente exluir essa imagem")
                if(excluir){
                    $.ajax({
                        url:'delete_dado.php?img=1&id=<?php echo $linha["id_cons"]?>',
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        success: function(data){
                            alert(data);
                            window.location.reload()
                        } 
                    })
                }else{
                    alert("BUA, BUA, erro ao deletar")
                }
                
            })            

            $("#enviarImg").on('click', function(e) {
                e.preventDefault()
                var form = $("#formulario_img")[0]
                var formData = new FormData(form)
                
                $.ajax({
                    url: 'atualizar_img.php?id=<?php echo $linha["id_cons"]?>',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data){
                        alert(data);
                        window.location.reload()
                    }
                    
                })

            })
        </script>
    </body>

    </html>

    <?php
        mysqli_close($conexao);
    ?>