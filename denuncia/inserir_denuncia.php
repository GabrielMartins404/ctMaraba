<?php
    require_once '../conexao/conexao.php';
        
        if(isset($_POST["nome_denunciante"])){

            //Dados do cara que faz a denuncia
            $nome_denunciante = $_POST["nome_denunciante"];
            $email_denunciante = $_POST["email_denunciante"];
            $tipo_denuncia = isset($_POST["anonima"])? 1 : 0;
            // $tipo_denuncia = 1;

            //Dados do denunciado
            $nome_denunciado = $_POST["nome_den"];
            $contato_denunciado = $_POST["contato_den"];
            $end_denunciado = $_POST["end_den"];
            $bairro_denunciado = $_POST["bairro_den"];
            $idade_denunciado = $_POST["idade_den"];
            $sexo_denunciado = $_POST["sexo_den"];
            $parentesco = $_POST["parentesco"];

            //Dados da vitima
            $nome_vitima = $_POST["nome_vit"];
            $idade_vitima = $_POST["idade_vit"];
            $sexo_vitima = $_POST["sexo_vit"];
            $endereco_vitima = $_POST["endereco_vit"];
            $bairro_vitima = $_POST["bairro_vit"];
            $pt_ref_vit = $_POST["pt_ref_vit"];

            //Dados da denuncia
            $descricao_caso = $_POST["descricao"];
            $protocolo_den = rand();
            $status_den = 0;

            //Pegar o horario e data da denuncia
            date_default_timezone_set('Brazil/east');
            $horario = getdate();
            $data_den = $horario["year"]. "-" . $horario["mon"]. "-" . $horario["mday"];
            $hora_den = $horario["hours"]. ":" . $horario["minutes"]. ":" . $horario["seconds"];

 
            $sql_inserir_denuncia = "INSERT INTO denuncia (protocolo, denunciante, email_denunciante, denunciado, contato_denunciado, endereco_denunciado, id_parentesco, idade_denunciado, id_sexodenunciado, vitima, idade, id_sexovitima, id_conselho, relato, data, hora, endereco_vitima, ponto_referencia_vitima, bairro_denunciado, bairro_vitima, status_denuncia, den_anonima) 
            VALUES ('$protocolo_den', '$nome_denunciante', '$email_denunciante', '$nome_denunciado', '$contato_denunciado', '$end_denunciado', $parentesco, $idade_denunciado, $sexo_denunciado, '$nome_vitima', $idade_vitima, $sexo_vitima, 4, '$descricao_caso', '$data_den', '$hora_den', '$endereco_vitima', '$pt_ref_vit', '$bairro_denunciado', '$bairro_vitima', $status_den, $tipo_denuncia);";
            
            $inserir_denuncia = mysqli_query($conexao, $sql_inserir_denuncia);

            if(!$inserir_denuncia){
                die("ERRO ao inserir denuncia");
            }
            
            $id_denuncia = mysqli_insert_id($conexao);

            //Dados contato
            $subtipoVs = $_POST["subtipo_violacao"];
 
            foreach($subtipoVs as $subtipoV){
    
                if ($subtipoV != "") {
                    $sql_inserir_subtipoV = "INSERT INTO denuncia_tipo (id_denuncia, id_tipo)
                    VALUES ($id_denuncia, $subtipoV)";
                    
                    $inserir_subtipo = mysqli_query($conexao, $sql_inserir_subtipoV);
                    if (!$inserir_subtipo) {
                        die("Não deu fi");
                    }
                }
            }

            header("location: cadastrar_den.php?message=1");
            
        }else{
            header("location: cadastrar_den.php");
        }  

        
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserção da denúncia</title>
    <!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>
</head>
<body>

    <div class="container" style="width: 400px">

    <center>
        
        <h3>Sua denúncia foi realizada com sucesso!</h3>
        <h6>A sociedade agradece</h6>
        <div style="margin-top: 10px">
        <a href="cadastrar_den.php" class="btn btn-sm btn-warning" style="color:#fff">Voltar</a>
    </center>

    </div>

</body>
</html>

<?php
    mysqli_close($conexao);
?>