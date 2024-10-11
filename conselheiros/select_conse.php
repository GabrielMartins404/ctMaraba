<?php
    require_once '../conexao/conexao.php';
    session_start();

    $sql1 = "SELECT * FROM conselheiro";
    $resultado = mysqli_query($conexao, $sql1);

    if(isset($_SESSION['id_cons']) && $_SESSION['admim'] >= 3){
        $id_cons = $_SESSION['id_cons'];
        $sql2 = "SELECT senha FROM conselheiro WHERE id_conselheiro = $id_cons";
        $execute_sql2 = mysqli_query($conexao, $sql2);
        $linha2 = mysqli_fetch_assoc($execute_sql2);
    }

    $resultado = mysqli_query($conexao, $sql1);

    if(isset($_GET["search"])){
        
        $nome = mysqli_escape_string($conexao, $_GET["nome"]);

        $sql_search = "SELECT * FROM conselheiro WHERE nome LIKE '%{$nome}%' or nome_social LIKE '%{$nome}%' or apelido LIKE '%{$nome}%'";
        $resultado = mysqli_query($conexao, $sql_search);
        
        if(mysqli_num_rows($resultado) == 0){
            echo "<script> alert('Não foi encontrado nenhum resultado para a pesquisa') </script>";
            $sql1 = "SELECT * FROM conselheiro";
            $resultado = mysqli_query($conexao, $sql1);
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de conselheiros tutelar</title>
    
    <!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>

    <link rel="stylesheet" href="../css/listagem.css">

    
</head>
<body>
<?php 
    if(isset($_GET["c"])){
        echo"<script>  alert('Você não tem permissão pra adicionar conselheiros')</script>";
    }
?>

    <?php include "../includes/navbar.php";?>
    
    <a href='../index.php' class='btn voltar print'><i class="fas fa-arrow-left"></i></a>

    <div class="pesquisar">
        <form  action="select_conse.php" method="get" class="d-flex me-3 buscar">
            <button class="btn search-btn" type="submit" name="search">Pesquisar</button>
            <input class="form-control search-input" type="text" name="nome" placeholder="Procurar conselheiros" aria-label="Search">
        </form>
        <?php
            if (isset($_GET["search"])) {
            ?>
                <a href='select_conse.php' class='btn voltar' style='margin-left:7px'><i class="fas fa-arrow-left"></i></a>
            <?php
            }
        ?>
    </div>

    <main>
        <div id="listagem_cons" class="container"> 
            <table class="table">

                <tbody >
                
            <?php
                while($linha = mysqli_fetch_array($resultado)) {
                // echo "<pre>";
                //     print_r($linha);
                // echo "</pre>";
            ?>
                <tr class="tr_list">
                    <th class="imagem_conse" style="border-bottom: none;">
                        <a href="detalhes_cons.php?id=<?php echo $linha[0]?>">
                            <img src="../<?php echo $linha["imagem"]?>" class="img_cons">
                        </a>
                    <th class="nome" style="width: 300px; border-bottom: none;"> <?php echo $linha["nome"] ?></th>
                    
                    <?php
                        if(isset($_SESSION["admim"]) && $_SESSION["admim"] >= 3 ){
                    ?>
                        <th style="margin-left:300px; border-bottom: none;" > 
                            <?php 
                                if($linha["nivel_acesso"] >= 2){
                            ?>
                                <button class="btn btn-danger" onclick="bloquear(<?php echo $linha[0]?>, '<?php echo $linha2['senha']?>')">
                                    Bloquar acesso
                                </button>
                            <?php
                                }else{
                            ?>
                                <button class="btn btn-success" onclick="bloquear(<?php echo $linha[0]?>, '<?php echo $linha2['senha']?>')">
                                    Desbloquear acesso
                                </button>
                            <?php
                                }
                            ?>
                        </th>   
                    <?php
                        }
                    ?>
                    
                </tr>
            
             <?php
                }
            ?> 
          </tbody>
        </div>
    </main>

     <!--Dependencias JS-->
     <script src="../js/main.js"></script>
</body>
</html>

<?php
    mysqli_close($conexao);
?>