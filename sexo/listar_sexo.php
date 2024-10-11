<?php
include '../conexao/conexao.php';

$sql = "SELECT * FROM sexo ORDER BY nome ASC";
$busca = mysqli_query($conexao,$sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Listagem de Sexo</title>

	
</head>
<body>



<div class="container" style="margin-top: 40px">
	<h3>Lista de Sexo</h3>
<br>
	<table class="table">
  		<thead>
    		<tr>
      			<th scope="col">Nome</th>
    		</tr>
  		</thead>
  
       	<?php
			while ( $dado = mysqli_fetch_array($busca)) {
				$id_sexo = $dado['id_sexo'];
				$nome = $dado['nome'];
    	?>	
<tr>
    <td><?php echo $nome ?> </td>
	<td>
		
		<a class="btn btn-warning btn-sm" style="color:white" href="editar_area.php?id=<?php echo $id_sexo?>" role="button"><i class="far fa-edit"></i>&nbsp;Editar</a>

		<a class="btn btn-danger btn-sm" style="color:white" href="deletar_area.php?id=<?php echo $id_sexo?>" role="button"><i class="far fa-trash-alt"></i>&nbsp;Deletar</a>
	</td>
</tr>



<?php } ?>
    

  
</table>
	<div style="text-align: right;">
	<a href="index.php" role="button" class="btn btn-sm btn-success"> Voltar </a>
	</div>
</div>

</body>
</html>