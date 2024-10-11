<?php
    require_once '../conexao/conexao.php';
        include "../uploads/upload.php";

        $place = "../uploads/img/conselheiros";
        
        if(isset($_POST["nome_conselheiro"])){
            //Chamando os dados para inserir imagem
            $result = uploadImg($place , $_FILES["upload_imagem"]);
            $localizacao = $result[0];

            //Dados do conselheiro
            $nome = $_POST["nome_conselheiro"];
            $nome_social = $_POST["nome_social"];
            $apelido = $_POST["apelido"];
            $data_Nascimento = $_POST["dt_nascimento"];
            $cor = $_POST["cor"];
            $idsexo = $_POST["sexo_conse"];

            //Dados do emprego
            $matricula = $_POST["matricula"];
            $email = $_POST["email"];
            $senha = $_POST["senha"];
            $idsituacao = $_POST["situacao"];
            $idct = $_POST["ct"];
            $idreligiao = $_POST["religiao"];
 
             //Comando que busca o auto incerment que é a chave eprimária do componente

            $sql_inserirCT = "INSERT INTO conselheiro (nome, nome_social, apelido, id_sexocon, cor, matricula, data_nascimento, email, login, senha, imagem, id_situacaocon, id_religiao, id_CT ) 
            VALUES ('$nome', '$nome_social', '$apelido', $idsexo, '$cor', '$matricula', '$data_Nascimento', '$email', '$matricula', '$senha', '$localizacao', $idsituacao, $idreligiao, $idct)";
            
            $insertConselheiro = mysqli_query($conexao, $sql_inserirCT);
            $idconselheiro = mysqli_insert_id($conexao);

            if(!$insertConselheiro){
                die("ERRO ao inserir CT");
            }
            
            //Dados contato
            $contatoss = $_POST["contato"]; //Recebe um array com as informações do contato
            foreach($contatoss as $contato){ //Aqui ele faz uma leitura desse array, pegando valor por valor e executando no coamndo abaixo
                if ($contato != "") {
                    $sql_inserirContato = "INSERT INTO contato_con (contato_con, id_conselheiro) VALUES ('$contato', $idconselheiro )";
                    
                    $inserirContato = mysqli_query($conexao, $sql_inserirContato);
                    if (!$inserirContato) {
                        die("Não deu fi");
                    }
                }
            }
        }else{
            header("location: cadastrar_conselheiro.php");
        }  

        
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CT Digital - Dado inserido com sucesso</title>
    <!-- Bibliotecas de estilo -->  
    <?php include "../includes/bibliotecas.php"?>
</head>
<body>

    <div class="container" style="width: 400px">

    <center>
        
        <h3>Adicionado com Sucesso!</h3>
        <div style="margin-top: 10px">
        <a href="cadastrar_conselheiro.php" class="btn btn-sm btn-warning" style="color:#fff">Voltar</a>
    </center>

    </div>
    

</body>
</html>

<?php
    mysqli_close($conexao);
?>