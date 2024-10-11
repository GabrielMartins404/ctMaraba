<?php
    require_once '../../conexao/conexao.php';
    session_start();

    if(!isset($_GET["id"])){
        header("location:../detalhes_den.php");
    }

    $id_den = $_GET["id"];
    $id_conselheiro = $_SESSION['id_cons'];

    $sql_ct = "SELECT id_CT FROM conselheiro WHERE id_conselheiro = $id_conselheiro";
    $execute_busca = mysqli_query($conexao, $sql_ct);
    $id_dados = mysqli_fetch_array($execute_busca);

    $id_ct = $id_dados["id_CT"];
    $id_select = $_GET["status"];

    $sqlUpdate = "UPDATE denuncia SET status_denuncia = $id_select, id_conselho = $id_ct WHERE id_denuncia = $id_den";
    $executar_update = mysqli_query($conexao, $sqlUpdate);

    $msg = [];
    if($executar_update){
        echo "Dados ATUALIZADOS com sucesso";
    }

?>

<?php
    mysqli_close($conexao);
?>