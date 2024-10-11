<?php

//faz a conexão com arquivo de conexão
require_once '../conexao/conexao.php';

//Selecione o tipo nome, id subtipo e nome subtipo da tabela violação junto com subtipo violação onde tipo violaão seja igual  a chave estrangeira
$mostrarTipo = "SELECT tipo.nome, subtipo.id_subtipo, subtipo.nome FROM tipo_violacao as tipo INNER JOIN subtipo_violacao as subtipo ON tipo.id_violacao = subtipo.id_violacao";
$tipo = mysqli_query($conexao, $mostrarTipo);

if(!$tipo){
    die("<h2 style='font-family: sans-serif'>Falha, recarregue a página e tente novamente</h2>");
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de subtipo</title>
    <!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>
</head>
<body>

<?php include "../includes/navbar.php";?>

<section class="container"> 
    <table class="table">
        <thead>
            <tr>
                <th scope="col">QTD</th>
                <th scope="col">Subtipo</th>
                <th scope="col">Tipo</th>
            </tr>
        </thead>
        <tbody>
                <?php

                    $i = 0;
                    while($listagem = mysqli_fetch_array($tipo)){
                    $i++;
                    $subTipo = $listagem["nome"];
                    $tipoV = $listagem[0];
                    $idsubTipo = $listagem["id_subtipo"];
                ?>
            <tr id='tr<?php echo $idsubTipo?>'>
                <th scope="row"><?php echo $i?></th>
                <td ><?php echo $subTipo?></td>
                <td><?php echo $tipoV?></td>
                <td>
                    <a href="form_Atualizar.php?id=<?php echo $idsubTipo?>" class="btn btn-warning btn-sm" style="color:white" role="button"><i class="far fa-edit"></i> Atualizar</a>
                    <button class="btn btn-danger btn-sm" style="color:white" onclick="deletar(<?php echo $idsubTipo?>)" role="button">  <i class="far fa-trash-alt"></i> Deletar</button>
                </td>

                <?php
                    }
                ?>
            </tr>
        </tbody>
    </table>
</section>

<!-- Footer -->
<?php include "../includes/footer.php"?>

    <script>
        function deletar(id){

            
            var confirmar = confirm("Deseja realmente deletar esse dado?");
            if(confirmar){
                    //e.preventDefault();

                    var el = document.getElementById("tr"+id)                    
                    
                    $.ajax({
                        type:"GET",
                        data:"id="+id,
                        url:"deletar.php",
                        async:false
                    }).done(function(data){
                        $sucesso = $.parseJSON(data)["sucesso"]
                        
                        if($sucesso){
                            //$(dado).fadeOut()
                            el.remove()
                            $("#alerta").show()
                        }else{
                            alert("Erro ao deletar o dado, tente novamente mais tarde")
                        }

                    }).fail(function(){
                        console.log("Falha")
                    })
            }
        }

        /*function deletar(id){
            var confirmar = confirm("Deseja realmente deletar esse dado? ")
            if(confirmar){
                window.location.replace("deletar/deletar.php?id="+id);
            }
        }*/
    </script>
</body>
</html>

<?php
    mysqli_close($conexao);
?>