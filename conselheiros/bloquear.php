<?php
    require_once '../conexao/conexao.php';

    if (!isset($_GET["id"])) {
        header("location: select_conse.php");  
    }

    $id_cons = $_GET["id"];
    $sql_conse = "SELECT nivel_acesso FROM conselheiro WHERE id_conselheiro = $id_cons";
    $execute_sql = mysqli_query($conexao, $sql_conse);
    $linha = mysqli_fetch_assoc($execute_sql);

    if($linha["nivel_acesso"] < 3){
        if($linha["nivel_acesso"] == 1){
            $sql_update = "UPDATE conselheiro SET nivel_acesso = 2 WHERE id_conselheiro = $id_cons";
            $execute_sql = mysqli_query($conexao, $sql_update);
            
            echo "Usuário desbloqueado com sucesso";
        }else{
            $sql_update = "UPDATE conselheiro SET nivel_acesso = 1 WHERE id_conselheiro = $id_cons";
            $execute_sql = mysqli_query($conexao, $sql_update);
            
            echo "Usuário bloqueado com sucesso";
        }
    }else{
        echo "Este usuário não pode ser bloqueado";
    }
    

?>

<?php
    mysqli_close($conexao);
?>