<?php
    require_once '../conexao/conexao.php';
    if(!isset($_POST["subtipo"])){
        header("location: form_atualizar.php");
    }

    $subtipo = $_POST["subtipo"];
    $id = $_POST["id"];

    $sql = "UPDATE parentesco SET nome = '$subtipo' WHERE id_parentesco = $id ";
    $atualizar = mysqli_query($conexao, $sql);

    if(!$atualizar){
        die("ERRO ao atualizar");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CT Digital - Parentesco atualizado com sucesso</title>
    <!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>
</head>
<body>

    <div class="container" style="width: 400px">

    <center>
	
        <h3>Dados atualizados com Sucesso!</h3>
        <div style="margin-top: 10px">
        <a href="../listar_parentesco.php" class="btn btn-sm btn-warning" style="color:#fff">Voltar</a>
    </center>

    </div> 

<!-- Footer -->
<?php include "../includes/footer.php"?>
   
</body>
</html>