<?php
    require_once "../../conexao/conexao.php";

    if(isset($_GET['tipoId'])) {
        $catID = $_GET['tipoId'];
    } else {
        $catID = 1;
    }

    $selecao  = "SELECT * FROM subtipo_violacao ";
    $selecao .= "WHERE id_violacao  = {$catID}";
    $subtipo = mysqli_query($conexao, $selecao);

    $retorno = array();
    while($linha = mysqli_fetch_object($subtipo)) {
        $retorno[] = $linha;
    } 	

    echo json_encode($retorno);
    
    //Fechar conexão
    mysqli_close($conexao)
?>

<?php
    mysqli_close($conexao);
?>