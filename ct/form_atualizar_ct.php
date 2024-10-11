<?php
    require_once '../conexao/conexao.php';
    include "../uploads/upload.php"; //Aqui champ a arquivo de upploads

    session_start();

    if (!isset($_SESSION["logado"])) {
        header("location:../../login/tela_de_login.php?msg=1");
    }elseif ($_SESSION["admim"] < 3) {
        echo "<script> alert('Você não tem permissão pra acessar essa página') </script>";
        echo "<script>window.location.replace('select.php')</script>";
    }

    
    if(!isset($_GET["id"])){
        header("location:select.php");
    }

    //Informações do conselho e endereco
    $id = $_GET["id"];
    $sql1 = "SELECT * FROM conselho_tutelar as ct INNER JOIN endereco_ct as endct ON ct.id_enderecoCt = endct.id_enderecoct WHERE id_conselho = $id";
    
    $resultado = mysqli_query($conexao, $sql1);

    if(mysqli_num_rows($resultado) === 0){
        header("location: select.php");
    }
    
    $linha = mysqli_fetch_array($resultado);    

    //Select de contatos
    $sql2 = "SELECT * FROM contato_ct AS cont_ct WHERE id_conselho = $id ";
    $res_cont = mysqli_query($conexao,$sql2);

    //Select cidade 
    $sql3 = "SELECT * FROM cidade";
    $res_city = mysqli_query($conexao, $sql3); 
    
    //Select cidade 
    $sql4 = "SELECT * FROM uf";
    $res_uf = mysqli_query($conexao, $sql4); 

?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Atualizar dados do conselho</title>
        <!-- Bibliotecas de estilo -->
        <?php include "../includes/bibliotecas.php"?>
        <link rel="stylesheet" href="../css/listagem.css">
      
    </head>

    <body>
    <?php include "../includes/navbar.php";?>
    <a href='index.php' class='btn voltar print'><i class="fas fa-arrow-left"></i></a>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alterar imagem</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <img src="../<?php echo $linha["imagem"]?>" class="img"><br>

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
                <form action="update_ct.php?id=<?php echo $linha["id_conselho"]?>" method="post">
                    <section class=" col-sm-12">
                        <li class="imagem_detalhes">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <img src="../<?php echo $linha["imagem"]?>">
                            </button>
                        </li>
                        <div class="mb-3 ">
                            <label for="exampleInputPassword1" class="form-label">Nome</label>
                            <input type="text" value="<?php echo $linha["nome"] ?>" class="form-control" name="n">
                        </div>

                        <div class="mb-3 ">
                            <label for="exampleInputPassword1" class="form-label">E-mail</label>
                            <input type="text" value="<?php echo $linha["email"] ?>" class="form-control" name="email_ct" id="email">
                        </div>

                        <div class="mb-3 " id="contato">
                        <label for="exampleInputPassword1" class="form-label">Contato</label>
                            <?php
                                $i = 0;
                                if ($res_cont->num_rows != 0) {
                                    echo '<button type="button" class="btn btn-success mb-3" id="add">+</button>';
                                    while ($listar_cont = mysqli_fetch_array($res_cont)) {
                                        $i++;
                                        ?>

                                    <div id="remove_<?php echo $i?>" class="mb-3 div_remove">
                                        <button type="button" class="btn btn-danger btn_remove_one" id="<?php echo $i?>" style="margin-left:20px"> X </button>
                                        <input type="text" value="<?php echo $listar_cont["numero"] ?>" class="form-control" name="contato[]" id="tel">
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
                            <label for="exampleInputEmail1" class="form-label">Site</label>
                            <input type="text" value="<?php echo $linha["site"] ?>" class="form-control" name="nome_ct" id="Nome" aria-describedby="emailHelp">
                        </div>

                        <div class="mb-3 ">
                            <label for="exampleInputPassword1" class="form-label">Endereço</label>
                            <input type="text" value="<?php echo $linha["endereco"] ?>" class="form-control" name="endereco" id="cor">
                        </div>

                        <div class="mb-3 ">
                            <label for="exampleInputPassword1" class="form-label">Bairro</label>
                            <input type="text" value="<?php echo $linha["bairro"]?>" class="form-control" name="bairro" id="dt_nasc">
                        </div>

                        <div class="mb-3 ">
                            <label for="exampleInputPassword1" class="form-label">Número</label>
                            <input type="text" value="<?php echo $linha["numero"]?>" class="form-control" name="numero" id="dt_nasc">
                        </div>

                        <div class="mb-3 ">
                            <label for="exampleInputPassword1" class="form-label">Complemento</label>
                            <input type="text" value="<?php echo $linha["complemento"]?>" class="form-control" name="complemento" id="dt_nasc">
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="exampleInputEmail1" class="form-label">Ponto de referência</label>
                            <input type="text" value="<?php echo $linha["ponto_referencia"] ?>" class="form-control" name="pt_ref_ct" id="Nome" aria-describedby="emailHelp">
                        </div>

                        <div class="mb-3 ">
                            <label for="exampleInputPassword1" class="form-label">CEP</label>
                            <input type="text" value="<?php echo $linha["cep"]?>" class="form-control" name="cep" >
                        </div>

                        <div class="mb-3 ">
                            <label for="exampleInputPassword1" class="form-label">Cidade</label>
                            
                            <select name="cidade" class="form-select">
                                <?php
                                    $mycidade = $linha["id_cidade"];
                                    while ($cidade = mysqli_fetch_array($res_city)) {
                                        if ($mycidade == $cidade["id_cidade"]) {
                                            ?>

                                    <option value="<?php echo $cidade["id_cidade"]?>" selected>
                                        <?php echo $cidade["nome"]?>
                                    </option>
                                
                                <?php
                                        }else{
                                ?>

                                    <option value="<?php echo $cidade["id_cidade"]?>">
                                        <?php echo $cidade["nome"]?>    
                                    </option>

                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3 ">
                            <label for="exampleInputPassword1" class="form-label">Estado</label>
                            
                            <select name="uf" class="form-select">
                                <?php
                                    $my_uf = $linha["id_uf"];
                                    while ($uf = mysqli_fetch_array($res_uf)) {
                                        if ($my_uf == $uf["id_uf"]) {
                                            ?>

                                    <option value="<?php echo $uf["id_uf"]?>" selected>
                                        <?php echo $uf["nome"]?>
                                    </option>
                                
                                <?php
                                        }else{
                                ?>

                                    <option value="<?php echo $uf["id_uf"]?>">
                                        <?php echo $uf["nome"]?>
                                    </option>

                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Atualizar</button>

                    </section>
                </form>
            </div>
        </main>
        
<!-- Footer -->
<?php include "../includes/footer.php"?>

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
                        url:'delete_dado.php?img=1&id=<?php echo $linha["id_conselho"]?>',
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
                    url: 'atualizar_img_ct.php?id=<?php echo $linha["id_conselho"]?>',
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