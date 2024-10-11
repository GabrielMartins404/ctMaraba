
<?php

//faz a conexão com arquivo de conexão
require_once '../conexao/conexao.php';

if(!isset($_GET["id"])){ //Verifica se o id foi configurado
    header("location: listar_subtipo.php");
}

$id = $_GET["id"]; //Recebe o id da url

//Comando pra deletar
$deletar = "DELETE FROM subtipo_violacao WHERE id_subtipo = $id"; 

$executarDelete = mysqli_query($conexao, $deletar);


//Retornar para o json ajax
$retorno = [];
if($executarDelete){
	$retorno["sucesso"] = true; 
}else{
	$retorno["sucesso"] = false;
}

echo json_encode($retorno);
?>

<?php
    mysqli_close($conexao);
?>

