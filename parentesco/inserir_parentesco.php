<?php

//faz a conexão com arquivo de conexão
require_once '../conexao/conexao.php';

$nome = $_GET['parentesco'];



$sql = "INSERT INTO parentesco (nome) VALUES ('$nome')";

$inserir = mysqli_query($conexao, $sql);

if(!$inserir){
    die("ERRO ao inserir");
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>CT Digital - Parentesco inserido com sucesso</title>
<!-- Bibliotecas de estilo -->
<?php include "../includes/bibliotecas.php"?>

</head>
<body>

<div class="container" style="width: 400px">

<center>
	
	<h3>Adicionado com Sucesso!</h3>
	<div style="margin-top: 10px">
	<a href="cadastrar_parentesco.php" class="btn btn-sm btn-warning" style="color:#fff">Voltar</a>
</center>

</div>

<!-- Footer -->
<?php include "../includes/footer.php"?>

</body>
</html>