<?php

//faz a conexão com arquivo de conexão
require_once '../conexao/conexao.php';

session_start();
    
    
    if (!isset($_SESSION["id_cons"])) {
        header("location:../login/tela_de_login.php?msg=1");
    }

$sql_denuncia = "SELECT * FROM denuncia";
$execute_sql_den = mysqli_query($conexao, $sql_denuncia);

if(!$execute_sql_den){
    die("<h2 style='font-family: sans-serif'>Falha, recarregue a página e tente novamente</h2>");
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de denúncia</title>
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
                <th scope="col">Status denuncia</th>
                <th scope="col">Data da denuncia</th>
                <th scope="col">Hora da denuncia</th>
            </tr>
        </thead>
        <tbody>
                <?php

                    $i = 0;
                    while($listagem = mysqli_fetch_array($execute_sql_den)){
                    $i++;
                    $id_denuncia = $listagem["id_denuncia"];
                    $data_den = strtotime($listagem["data"]);
                    $hora_den = strtotime($listagem["hora"]);
                ?>
            <tr id=''>
                <th scope="row"><?php echo $i?></th>
                <td> 
                <?php
                    if($listagem["status_denuncia"] == 0){
                        echo "Denúncia sem atendimento";
                    }else{
                        echo "Denúncia em atendimento";
                    }
                ?>
                </td>
                <td> <?php echo date('d/m/Y', $data_den)?></td>
                <td> <?php echo date('H:i', $hora_den);?></td>

                <td>
                    <?php
                        if($listagem["status_denuncia"] == 0){        
                    ?>
                        
                        <a href="detalhes_den.php?id=<?php echo $id_denuncia?>" class="btn btn-danger btn-sm" style="color:white" role="button"><i class="fas fa-info-circle" style="margin-right:5px"></i> Detalhes</a>
                    
                    <?php
                        }else{
                    ?>

                         <a href="detalhes_den.php?id=<?php echo $id_denuncia?>" class="btn btn-success btn-sm" style="color:white" role="button"><i class="fas fa-info-circle" style="margin-right:5px"></i> Detalhes</a>
                    
                    <?php
                        }
                    ?>
                    
                </td>

                <?php
                    }
                ?>
            </tr>
        </tbody>
    </table>
</section>

    <!--Dependencias JS-->
    <script src="../js/main.js"></script>

    <script>

    </script>
</body>
</html>

<?php
    mysqli_close($conexao);
?>