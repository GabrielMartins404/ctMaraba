<?php
    require_once '../conexao/conexao.php';
    include "../uploads/upload.php";

    session_start();
    if(($_SESSION["admim"]) < 3){
        echo "<script> alert('Você não tem permissão pra acessar essa página') </script>";
        echo "<script>window.location.replace('detalhes_cons.php')</script>";
    }

    if(!isset($_GET["id"])){
        header("location: cadastrar_conselheiro.php");
    }
    
    $id = $_GET["id"];

    $sql_delete_img = "SELECT * FROM conselheiro WHERE id_conselheiro = $id";
            $execute_select = mysqli_query($conexao, $sql_delete_img);

            if(!$execute_select){
                die("ERRO no select");
            }
            $linha = mysqli_fetch_assoc($execute_select);

            $img = $linha["imagem"];

            deletarImg($img);

    $sql_delete_cont = "DELETE FROM contato_con WHERE id_conselheiro = $id";
    $execute_select_delete_cont = mysqli_query($conexao, $sql_delete_cont);
    
    $sql_delete = "DELETE FROM conselheiro WHERE id_conselheiro = $id";
    $execute_select_delete = mysqli_query($conexao, $sql_delete);
    if(!$execute_select_delete){
        die("Erro no delete");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apagar conselheiro</title>
    <!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>
    
</head>
<body>

    <div class="container" style="width: 400px">

    <center>
        
        <h3>Dado deletado com Sucesso!</h3>
        <div style="margin-top: 10px">
        <a href="select_conse.php" class="btn btn-sm btn-warning" style="color:#fff">Voltar</a>
    </center>

    </div>
    
</body>
</html>

<?php
    mysqli_close($conexao);
?>