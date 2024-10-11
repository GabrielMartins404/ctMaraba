<?php
    require_once '../conexao/conexao.php';

    $nome = $_POST["nome_city"];
    $uf = $_POST["uf"];

    if(!isset($nome) || $nome==""){
        header("location: cadastrar_cidades.php");
    }

    $sql = "INSERT INTO cidade(nome, id_uf) values ('$nome', $uf)";

    $execute = mysqli_query($conexao, $sql);
    if(!$execute){
        die("ERRO ao cadastrar a cidade");
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadasttar</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <center>
    <h3>Adicionado com Sucesso!</h3>
	    <div style="margin-top: 10px">
	    <a href="cadastrar_cidades.php" class="btn btn-sm btn-warning" style="color:#fff">Voltar</a>
    </center>

    <!--Dependencias JS-->
	<script src="../..js/jquery.js"></script>
	<script src="../..js/pooper.js"></script>
	<script src="../..js/bootstrap.js"></script>
	<script src="../..js/main.js"></script>
</body>
</html>