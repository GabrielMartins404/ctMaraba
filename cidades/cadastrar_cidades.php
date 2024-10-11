<?php
    require_once '../conexao/conexao.php';

    session_start();
    if(!isset($_SESSION["logado"])){
        header("location: ../index.php");
    }
    
    $sql = "SELECT * FROM uf";
    $executar = mysqli_query($conexao, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cidade</title>
    
    <!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>
</head>
<body>
<center class="container">
    <h3>Inserir nova cidade</h3>

    <form action="inserir_cidades.php" method="post">
        <div class="form-group">
          <input type="text" class="form-control tamanho" name="nome_city" placeholder="Digite o nome da cidade"  required>
        </div>
      
    
            
            <select name="uf" class="form-select tamanho mb-3" id="uf">
                <?php
                    while($mostrar = mysqli_fetch_assoc($executar)){
                ?>
                    <option value="<?php echo $mostrar["id_uf"]?>"><?php echo $mostrar["nome"]?></option>
                <?php
                    }
                ?>
            </select>
        
  	    
        <div style="text-align: center;">

        <a href="../index.php" role="button" class="btn btn-sm btn-primary"> Voltar </a>
        <button type="submit" class="btn btn-sm btn-success"> Cadastrar </button>

        </div>
    
    </form>
</center>


	<script src="../js/main.js"></script>
</body>
</html>