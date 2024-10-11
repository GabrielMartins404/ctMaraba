<?php
    require_once '../conexao/conexao.php';
        include "../uploads/upload.php";

        $place = "../uploads/img/conselho_tutelar";
        
        if(isset($_POST["nomect"])){
            //Chamando os dados para inserir imagem
            $result = uploadImg($place , $_FILES["upload_imagem"]);
            $localizacao_img = $result[0];

            //Dados do ct
            $nome = $_POST["nomect"];
            $site = $_POST["sitect"];
            $email = $_POST["emailct"];

            //Dados do endereco
            $endereco = $_POST["endereco"];
            $bairro = $_POST["bairro"];
            $numero = $_POST["numero"];
            $complemento = $_POST["complemento"];
            $cep = $_POST["cep"];
            $Referencia = $_POST["ptreferencia"];

            //Cidade
            $idcidade = $_POST["cidade"];

            //Estado e região
            $uf = $_POST["uf"];
            $selectUf = "SELECT * FROM uf WHERE id_uf = {$uf}";
            $executeUf = mysqli_query($conexao, $selectUf);

            if(!$executeUf){
                die("ERRo na lisrtagem UF");
            }

            $lerUf = mysqli_fetch_array($executeUf);
            $idRegiao = $lerUf["id_regiao"];

            // Inserção do endereço do conselho cadastrado
            $inserirEnd = "INSERT INTO endereco_ct (endereco, bairro, numero, complemento, cep, ponto_referencia, id_regiao, id_uf, id_cidade) ";
            $inserirEnd .= "VALUES ('$endereco', '$bairro', '$numero', '$complemento', '$cep', '$Referencia', $idRegiao, $uf, $idcidade)";
            
            $executarEnd = mysqli_query($conexao, $inserirEnd);
            if(!$executarEnd){
                die("Ta errado");
            }

            $idEnd = mysqli_insert_id($conexao); //Comando que busca o auto incerment que é a chave eprimária do componente

            $inserirCt = "INSERT INTO conselho_tutelar (nome, site, email, imagem, id_enderecoct) VALUES ('$nome', '$site', '$email', '$localizacao_img', $idEnd)";
            
            $insertCt = mysqli_query($conexao, $inserirCt);
            if(!$insertCt){
                die("ERRO ao inserir CT");
            }
            $id_ct = mysqli_insert_id($conexao);

            $contatos = $_POST["contato"]; //Recebe um array com as informações do contato
            foreach($contatos as $contato){ //Aqui ele faz uma leitura desse array, pegando valor por valor e executando no coamndo abaixo
                if ($contato != "") {
                    $sql_inserirContato = "INSERT INTO contato_ct (	numero, id_conselho ) VALUES ('$contato', $id_ct )";
                    
                    $inserirContato = mysqli_query($conexao, $sql_inserirContato);
                    if (!$inserirContato) {
                        die("Não deu fi");
                    }
                }
            }
            
        }    

        
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserção de dados do conselho</title>
    <!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>

</head>
<body>

    <div class="container" style="width: 400px">

    <center>
        
        <h3>Adicionado com Sucesso!</h3>
        <div style="margin-top: 10px">
        <a href="cadastrar_conselho.php" class="btn btn-sm btn-warning" style="color:#fff">Voltar</a>
    </center>

    </div>

<!-- Footer -->
<?php include "../includes/footer.php"?>

</body>
</html>

<?php
    mysqli_close($conexao);
?>