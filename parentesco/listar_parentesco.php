<?php


//faz a conexão com arquivo de conexão
require_once '../conexao/conexao.php';

$sql = "SELECT * FROM parentesco";
$executar = mysqli_query($conexao, $sql);

if(!$executar){
    die("<h2 style='font-family: sans-serif'>Falha, recarregue a página e tente novamente</h2>");
}

//"deletar()"
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de parentesco</title>
<!-- Bibliotecas de estilo -->
<?php include "../includes/bibliotecas.php"?>
</head>
<body>


<section class="container">   
    <table class="table">
        <thead>
            <tr>
                <th scope="col">QTD</th>
                <th scope="col">Parentesco</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 0;
                while($listagem = mysqli_fetch_array($executar)){
                    $i++;
                    $id = $listagem[0];
            ?>
            <tr>
                <th scope="row"><?php echo$i?></th>
                <td><?php echo$listagem[1]?></td>
                <td>
                    <a href="atualizar/form_Atualizar.php?id=<?php echo$listagem[0]?>" class="btn btn-warning btn-sm" style="color:white" role="button"> <i class="far fa-edit"></i> Atualizar</a>
                    <button class="btn btn-danger btn-sm" style="color:white" role="button" onclick="deletar(<?php echo $id?>)"> <i class="far fa-trash-alt"></i> Deletar</button>
                </td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</section>

    <script>
        function deletar(id){
            var confirmar = confirm("Deseja realmente deletar esse dado? ")
            if(confirmar){
                window.location.replace("deletar/deletar.php?id="+id);
            }
        }
    </script>

<!-- Footer -->
<?php include "../includes/footer.php"?>

</body>
</html>