<?php
    require_once '../conexao/conexao.php';

    $sql = "SELECT * FROM tipo_violacao";

    $execute = mysqli_query($conexao, $sql);
    if(!$execute){
        die("ERRO");
    }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>subtipo</title>
    <!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>
</head>

<body>
    <?php include "../includes/navbar.php";?>
    <div class="container">    
        <form action="inserir_subtipo.php" method="get">

            <article class="row">
                <section class="col-lg-6 col-md-6 col-sm-12">
                    <div class="mb-3 ">
                        <label for="exampleInputEmail1" class="form-label">Subtipo</label>
                        <input type="text" name="subtipo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="tipoV">
                            <?php
                                while($mostrar = mysqli_fetch_assoc($execute)){
                            ?>
                                <option value="<?php echo $mostrar["id_violacao"]?>"><?php echo $mostrar["nome"]?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>

                </section>
            </article>
            
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
    
<!-- Footer -->
<?php include "../includes/footer.php"?>
</body>
</html>

<?php
    mysqli_close($conexao);
?>