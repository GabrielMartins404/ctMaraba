<?php
    require_once '../conexao/conexao.php';
    include "../uploads/upload.php";

        if(!isset($_GET["id"])){
            header("location: select_conse.php");
        }

        $id = $_GET["id"];

        if(isset($_GET["img"])){
            $sql = "SELECT * FROM conselheiro WHERE id_conselheiro = $id";
            $execute_select = mysqli_query($conexao, $sql);

            if(!$execute_select){
                die("ERRO no select");
            }
            $linha = mysqli_fetch_assoc($execute_select);

            $img = $linha["imagem"];

            deletarImg($img);
            
            if(deletarImg($img)){
                echo"Imagem deletada com sucesso";
            }else{
                echo "Falha ao deletar imagem";
            }
        }
?>

<?php
    mysqli_close($conexao);
?>