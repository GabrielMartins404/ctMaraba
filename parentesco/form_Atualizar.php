<?php
    require_once '../conexao/conexao.php';

    if(!isset($_GET["id"])){
        header("location:../listar_subtipo.php");
    }
    $id = $_GET["id"];
    $sql = "SELECT * FROM parentesco WHERE id_parentesco = {$id}";

    $mostrar = mysqli_query($conexao, $sql);
    if(!$mostrar){
        die("<h2 style='font-family: sans-serif'>ERRO no dado</h2>");
    }
    
    $dado = mysqli_fetch_array($mostrar);
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CT Digital - Atualizar</title>
    <!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>
</head>
<body>

<div class="container">    
    <form action="update.php" method="post">

        <article class="row">
            <section class="col-lg-6 col-md-6 col-sm-12">
                <div class="mb-3 ">
                    <label for="exampleInputEmail1" class="form-label">Parentesco</label>
                    <input type="text" name="subtipo" class="form-control" value="<?php echo $dado["nome"]?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>

                <div class="mb-3">

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