<?php

//faz a conexão com arquivo de conexão
require_once '../conexao/conexao.php';

if(!isset($_GET["id"])){ //Verifica se o id foi configurado
    header("location: listar_subtipo.php");
}

$id = $_GET["id"]; //Recebe o id da url

//Comando pra deletar
$deletar = "DELETE FROM parentesco WHERE id_parentesco = $id"; 

$executarDelete = mysqli_query($conexao, $deletar);
if(!$executarDelete){
    die("<h2 style='font-family: sans-serif'>ERRO ao deletar dado</h2>");
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>CT Digital - Dados deletados com Sucesso</title>
<!-- Bibliotecas de estilo -->
<?php include "../includes/bibliotecas.php"?>

</head>
<body>

<div class="container" style="width: 400px">

<center>
	
	<h3>Dado deletado com absoluto sucesso!</h3>
	<div style="margin-top: 10px">
	<a href="../listar_parentesco.php" class="btn btn-sm btn-warning" style="color:#fff">Voltar</a>
</center>

</div>

</body>
</html>