<?php
    require_once '../conexao/conexao.php';
    
    $sql1 = "SELECT * FROM conselho_tutelar as ct INNER JOIN endereco_ct as endCt ON endct.id_enderecoCt = ct.id_enderecoct";
    $resultado = mysqli_query($conexao, $sql1);

    if(isset($_GET["search"])){
        
        $nome = mysqli_escape_string($conexao, $_GET["nome"]);

        $sql_search = "SELECT * FROM conselho_tutelar as ct INNER JOIN endereco_ct as endCt ON endct.id_enderecoCt = ct.id_enderecoct WHERE nome LIKE '%{$nome}%'";
        $resultado = mysqli_query($conexao, $sql_search);
        
        if(mysqli_num_rows($resultado) == 0){
            echo "<script> alert('Não foi encontrado nenhum resultado para a pesquisa') </script>";
            $sql1 = "SELECT * FROM conselho_tutelar as ct INNER JOIN endereco_ct as endCt ON endct.id_enderecoCt = ct.id_enderecoct";
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
    <title>Lista de conselhos tutelares</title>
    <!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>
    
    <link rel="stylesheet" href="../css/listagem.css">

    <style>
        #listagem{
            display: block;
        }
    </style>
</head>
<body>

<?php include "../includes/navbar.php";?>

<a href='../index.php' class='btn voltar print'><i class="fas fa-arrow-left"></i></a>
<div class="pesquisar">
    <form  action="select.php" method="get" class="d-flex me-3 mt-3 buscar">
        <input class="form-control search-input" type="text" name="nome" placeholder="Procurar conselhos tutelares" aria-label="Search">
        <button class="btn search-btn" type="submit" name="search">Pesquisar</button>
    </form>
    <?php
        if (isset($_GET["search"])) {
        ?>
            <a href='select.php' class='btn voltar'><i class="fas fa-arrow-left"></i></a>
        <?php
        }
    ?>
</div>

    <main>
        <div id="listagem" class="container"> 
            <?php
                while($linha = mysqli_fetch_array($resultado)) {
            ?>
                <ul class="ul_listagem">
                    <li class="imagem">
                        <a href="detalhe.php?codigo=<?php echo $linha[0]?>">
                            <img src="../<?php echo $linha["imagem"]?>">
                        </a>
                    </li>
                    <li><h3><?php echo $linha["nome"] ?></h3></li>
                    <li> E-mail : <?php echo $linha["email"] ?></li>
                    <li> Bairro : <?php echo $linha["bairro"] ?></li>
                    <li> Enderço : <?php echo $linha["endereco"] ?></li>
                    
                </ul>
             <?php
                }
            ?> 
          
        </div>
    </main>

</body>
</html>

<?php
    mysqli_close($conexao);
?>