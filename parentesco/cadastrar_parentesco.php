
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
<div class="container">    
    <form action="inserir/inserir_parentesco.php" method="get">

        <article class="row">
            <section class="col-lg-6 col-md-6 col-sm-12">
                <div class="mb-3 ">
                    <label for="exampleInputEmail1" class="form-label">Digite qual o Parentesco</label>
                    <input type="text" name="parentesco" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
            </section>
        </article>
        
        <button type="submit" class="btn btn-primary">Inserir</button>

      </form>
</div>

<!-- Footer -->
<?php include "../includes/footer.php"?>

</body>
</body>
</html>