<?php
    require_once '../conexao/conexao.php';
        include "../uploads/upload.php";

        $place = "uploads/img/noticias";
        
        if(isset($_POST["titulo_noticias"])){
            //Chamando os dados para inserir imagem
            $result = uploadImg($place , $_FILES["imagem_noticia"]);
            $localizacao_img = $result[0];

            //Dados do conselheiro
            $titulo = $_POST["titulo_noticias"];
            $descricao = $_POST["descricao_noticias"];
            
 
            $sql_inserirNoticias = "INSERT INTO noticias_eventos (titulo, descricao, imagemNoticia) 
            VALUES ('$titulo', '$descricao', '$localizacao_img')";
            
            $inserirNoticias = mysqli_query($conexao, $sql_inserirNoticias);

            if(!$inserirNoticias){
                die("ERRO ao inserir CT");
            }else{
                header("location: cadastrarNoticias.php?message=1");
            }
            
        }else{
            header("location: listarNoticias.php");
        }  

        
?>

<?php
    mysqli_close($conexao);
?>