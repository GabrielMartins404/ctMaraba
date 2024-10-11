<?php

//faz a conexão com arquivo de conexão
require_once '../conexao/conexao.php';

$nome = $_GET['subtipo'];
$tipoV = $_GET['tipoV'];


$sql = "INSERT INTO subtipo_violacao (nome, id_violacao) VALUES ('$nome', $tipoV)";

$inserir = mysqli_query($conexao, $sql);
if(!$inserir){
    die("ERRO ao inserir");
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>CT Digital - Dados do Sexo Cadastrado com Sucesso</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>

<div class="container" style="width: 400px">

<center>
	
	<h3>Adicionado com Sucesso!</h3>
	<div style="margin-top: 10px">
	<a href="cadastrar_subtipoV.php" class="btn btn-sm btn-warning" style="color:#fff">Voltar</a>
</center>

</div>

<!-- Footer -->
<?php include "../includes/footer.php"?>

</body>
</html>

<?php
    mysqli_close($conexao);
?>