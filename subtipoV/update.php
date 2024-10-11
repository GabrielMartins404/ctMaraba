<?php
    require_once '../conexao/conexao.php';
    if(!isset($_POST["tipoV"])){
        header("location: form_atualizar.php");
    }

    $subtipo = $_POST["subtipo"];
    $idTipo = $_POST["tipoV"];
    $id = $_POST["id"];

    $sql = "UPDATE subtipo_violacao SET nome = '$subtipo', id_violacao = $idTipo WHERE id_subtipo = $id ";
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
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <div class="container" style="width: 400px">

    <center>
	
        <h3>Dados atualizados com Sucesso!</h3>
        <div style="margin-top: 10px">
        <a href="listar_subtipo.php" class="btn btn-sm btn-warning" style="color:#fff">Voltar</a>
    </center>

    </div> 

<!-- Footer -->
<?php include "../includes/footer.php"?>   
</body>
</html>

<?php
    mysqli_close($conexao);
?>