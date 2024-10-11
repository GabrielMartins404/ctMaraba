<?php
    require_once '../conexao/conexao.php';
    include "../uploads/upload.php";

    session_start();

    if (!isset($_SESSION["id_cons"])) {
        header("location:../../login/tela_de_login.php?msg=1");
    }elseif ($_SESSION["admim"] < 3) {
        echo "<script> alert('Você não tem permissão pra acessar essa página') </script>";
        echo "<script>window.location.replace('../select.php')</script>";
    }

    if(!isset($_GET["id"])){
        header("location: ../select.php");
    }
    
    $id = $_GET["id"];

    $sql_delete_img = "SELECT * FROM conselho_tutelar WHERE id_conselho = $id";
    $execute_select = mysqli_query($conexao, $sql_delete_img);
    if(mysqli_num_rows($execute_select) === 0){
        header("location: select.php");
    }

    if(!$execute_select){
        die("ERRO");
    }
    $linha = mysqli_fetch_assoc($execute_select);

    $img = $linha["imagem"];

    deletarImg("../".$img);

    $sql_delete_cont = "DELETE FROM contato_ct WHERE id_conselho = $id";
    $execute_select_delete_cont = mysqli_query($conexao, $sql_delete_cont);
    
    $sql_delete = "DELETE FROM conselho_tutelar WHERE id_conselho = $id";
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
    <title>Apagar conselho do sistema</title>
    <!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>

</head>
<body>

    <div class="container" style="width: 400px">

    <center>
        
        <h3>Dado deletado com Sucesso!</h3>
        <div style="margin-top: 10px">
        <a href="select.php" class="btn btn-sm btn-warning" style="color:#fff">Voltar</a>
    </center>

    </div>
<!-- Footer -->
<?php include "../includes/footer.php"?>    
</body>
</html>

<?php
    mysqli_close($conexao);
?>