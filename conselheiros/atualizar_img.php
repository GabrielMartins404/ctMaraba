<?php
    require_once '../conexao/conexao.php';
    include "../uploads/upload.php"; //Aqui champ a arquivo de upploads

    if(!isset($_GET["id"])){
        header("location:atualizar.php");
    }

    $id = $_GET["id"];
    $sql = "SELECT * FROM conselheiro WHERE id_conselheiro = $id";
    $executar = mysqli_query($conexao, $sql);
    $output = mysqli_fetch_array($executar);

    $imagem = $output["imagem"]; //Aqui recebe o antigo caminho da imagem, obtido atravé do comando acima

    deletarImg($imagem);

    $novaImg = $_FILES["atualizar_img"];

    $place = "uploads/img/conselheiros";

    $result = uploadImg($place, $novaImg);
    
    if(isset($result[0])){
        echo $result[1]; // Exibição da mensagem

        $novo_caminho = $result[0]; // Exibição do caminho da image,

        $sqlUpdate = "UPDATE conselheiro SET imagem = '$novo_caminho' WHERE id_conselheiro = $id";
        $executar_update = mysqli_query($conexao, $sqlUpdate);
    }
    

?>

<?php
    mysqli_close($conexao);
?>