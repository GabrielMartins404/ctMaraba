<?php
    include "../conexao/conexao.php";

    $sql_perguntas = "SELECT * FROM perguntas";
    $sql_exe = mysqli_query($conexao, $sql_perguntas);

    
?>
<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Perguntas Frequentes</title>

        <!-- Bibliotecas -->
        <?php include "../includes/bibliotecas.php"?>
    </head>
    <body>
        <?php
            include "../includes/navbar.php";
        ?>

    <a href='../home' class='btn voltar print'><i class="fas fa-arrow-left"></i></a>
    <div class="container">

        <h3 class="main-title">Principais temas de dúvidas</h3>

        <ul id="ul_mudanca">
            <?php
                while($linha = mysqli_fetch_array($sql_exe)){
            ?>
                <a href="perguntas_details.php?cod=<?php echo $linha["id_perguntas"]?>" class="list-group-item list-group-item-action li"><?php echo $linha["titulo_pergunta"]?></a>
            
            <?php
                }
            ?>
        </ul>
    </div>
    <!--Dependencias JS-->
    <script src="../js/main.js"></script>
        
    </body>
</html>

<?php
    mysqli_close($conexao);
?>