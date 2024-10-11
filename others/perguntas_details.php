<?php
    include "../conexao/conexao.php";
    if(!isset($_GET["cod"])){
        header("location: perguntas.php");
    }

    $cod = $_GET["cod"];

    $sql_perguntas = "SELECT * FROM perguntas_detalhes WHERE id_pergunta = $cod";
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

        <style>
            
        </style>
    </head>
    <body>
        <?php
            include "../includes/navbar.php";
        ?>

    <a href='perguntas.php' class='btn voltar print'><i class="fas fa-arrow-left"></i></a>
    <div class="container" >

        <h3 class="main-title">Principais dúvidas</h3>

        <ul id="ul_mudanca">
            <?php
                $i = 0;
                while($linha = mysqli_fetch_array($sql_exe)){
                    // echo"<pre>";
                    // print_r($linha);
                    // echo"</pre>";
                   
            ?>
            
                <li class="list-group-item list-group-item-action li" id="li_<?php echo $i?>" onclick="mostrar(<?php echo $i?>)">
                    <?php echo $linha["titulo_pergunta"]?>
                    <i class="fas fa-chevron-down" id="i_<?php echo $i?>" style="margin-left: 10px;"></i>
                </li>
                <p id="p_<?php echo $i?>" class=" list-group-item list-group-item-action animate__animated animate__fadeInDown" style="display: none;">
                    <?php echo $linha["descricao_per"]?>
                </p>
            
            <?php
                 $i++;
                }
            ?>
        </ul>
    </div>

         <!--Dependencias JS-->
         <script src="../js/main.js"></script>
        <script>
            
            function mostrar(i){
                var p = document.getElementById("p_"+i)
                var i = document.getElementById("i_"+i)

                console.log(p.getBoundingClientRect().height)
                
                if(p.style.display === 'none'){
                    p.style.display = 'flex'
                    p.classList.add("animate__fadeInDown")

                    i.classList.remove("fa-chevron-down");
                    i.classList.add("fa-chevron-up");
                }else{
                    p.style.display = 'none'
                    p.classList.remove("animate__fadeInDown")

                    i.classList.remove("fa-chevron-up");
                    i.classList.add("fa-chevron-down");
                    
                }
            }
            

        </script>
    </body>
</html>

<?php
    mysqli_close($conexao);
?>