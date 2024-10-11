<?php
    require_once '../conexao/conexao.php';

    if(!isset($_GET["id"])){
        header("location:listar_subtipo.php");
    }

    $id = $_GET["id"];
    $sql = "SELECT * FROM subtipo_violacao WHERE id_subtipo = {$id}";

    $mostrar = mysqli_query($conexao, $sql);
    if(!$mostrar){
        die("<h2 style='font-family: sans-serif'>ERRO no dado</h2>");
    }
    
    $dado = mysqli_fetch_array($mostrar);

    //Tipo
    $tipo = "SELECT * FROM tipo_violacao";
    $mostrarTipo = mysqli_query($conexao, $tipo);
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de atualização</title>
    <!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>
</head>
<body>
    <?php include "../includes/navbar.php";?>
    <div class="container">    
        <form action="update.php" method="post">

            <article class="row">
                <section class="col-lg-6 col-md-6 col-sm-12">
                    <div class="mb-3 ">
                        <label for="exampleInputEmail1" class="form-label">Subtipo</label>
                        <input type="text" name="subtipo" class="form-control" value="<?php echo $dado["nome"]?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="tipoV">
                            <?php
                                $tipoSelecionado = $dado["id_violacao"];
                                while($listar = mysqli_fetch_assoc($mostrarTipo)){
                                    $tipoComum = $listar["id_violacao"];
                                    if($tipoComum == $tipoSelecionado){
                            ?>
                                <option value="<?php echo $listar["id_violacao"]?>" selected>
                                    <?php echo $listar["nome"]?>
                                </option>

                            <?php
                                }else{
                            ?>
                                <option value="<?php echo $listar["id_violacao"]?>">
                                    <?php echo $listar["nome"]?>
                                </option>
                            <?php
                                    }
                                }
                            ?>
                        </select>

                        <input type="hidden" name="id" value="<?php echo $dado[0]?>">
                    </div>

                </section>
            </article>
            
            <button type="submit" class="btn btn-primary">Atualizar</button>

        </form>
    </div>
    
<!-- Footer -->
<?php include "../includes/footer.php"?>

</body>
</html>

<?php
    mysqli_close($conexao);
?>