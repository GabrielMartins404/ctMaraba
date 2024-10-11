<?php

//faz a conexão com arquivo de conexão
include '../conexao/conexao.php';

$sql = "SELECT r.nome as nome_regiao, uf.id_uf as id_uf, uf.nome as nome_uf, uf.sigla as sigla_uf FROM uf INNER JOIN regiao as r ON r.id_regiao = uf.id_regiao";
$uf = mysqli_query($conexao, $sql);

if(!$uf){
    die("<h2 style='font-family: sans-serif'>Falha, recarregue a página e tente novamente</h2>");
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de uf</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    
</head>
<body>

<section class="container"> 
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome do uf</th>
                <th scope="col">Sigla</th>
                <th scope="col">Região</th>
            </tr>
        </thead>
        <tbody>
                <?php
                    while($listagem_uf = mysqli_fetch_array($uf)){
                ?>
            <tr id='tr'>
                <td ><?php echo $listagem_uf["nome_uf"]?></td>
                <td><?php echo $listagem_uf["sigla_uf"]?></td>
                <td><?php echo $listagem_uf["nome_regiao"]?></td>

                <td>
                    <a href="updateUf.php?id=<?php echo $listagem_uf["id_uf"]?>" class="btn btn-warning btn-sm" style="color:white" role="button"><i class="far fa-edit"></i> Atualizar</a>
                </td>

                <?php
                    }
                ?>
            </tr>
        </tbody>
    </table>
</section>
    <!--Dependencias JS-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>