<?php
    require_once '../conexao/conexao.php';

    if(!isset($_GET["id"])){
        header("location: select.php");
    }

    $id_ct = $_GET["id"];

    $nome_ct = $_POST["n"];
    $email_ct = $_POST["email_ct"];
    $endereco = $_POST["endereco"];
    $bairro = $_POST["bairro"];
    $numero = $_POST["numero"];
    $complemento = $_POST["complemento"];
    $cep = $_POST["cep"];
    $cidade = $_POST["cidade"];
    $uf = $_POST["uf"];
    $pt_referencia = $_POST["pt_ref_ct"];

    //Pegar região
    $sql_regiao = "SELECT * FROM uf WHERE id_uf = $uf";
    $id_regiao_exe = mysqli_query($conexao, $sql_regiao);
    $id_regiao = mysqli_fetch_assoc($id_regiao_exe);
    $regiao = $id_regiao["id_regiao"];

    //Atualizar ct
    $sql1 = "UPDATE conselho_tutelar SET nome = '$nome_ct', email = '$email_ct' WHERE id_conselho = $id_ct";
    $executar_update1 = mysqli_query($conexao, $sql1);

    $sql_id_end = "SELECT * FROM conselho_tutelar WHERE id_conselho = $id_ct";
    $id_end_exe = mysqli_query($conexao, $sql_id_end);
    $id_end = mysqli_fetch_assoc($id_end_exe);
    $end = $id_end["id_enderecoct"];
    

    //Atualizar endereco ct
    $sql2 = "UPDATE endereco_ct SET endereco = '$endereco', bairro = '$bairro', numero = '$numero', complemento = '$complemento', ponto_referencia = '$pt_referencia', cep = '$cep', id_cidade = $cidade, id_uf = $uf, id_regiao = $regiao 
    WHERE id_enderecoCt = $end";
    
    $executar_update2 = mysqli_query($conexao, $sql2);

    //Atualizar contato
        $sql_delete = "DELETE FROM contato_ct WHERE id_conselho = $id_ct ";
        $execute_delete = mysqli_query($conexao, $sql_delete);
        if (isset($_POST["contato"])) {
            $contato_array = $_POST["contato"];

        foreach ($contato_array as $num_contato) {
            if ($num_contato != "") {
                $sql_insert = "INSERT INTO contato_ct (	numero, id_conselho ) VALUES ('$num_contato', $id_ct)";
                $execute_insert = mysqli_query($conexao, $sql_insert);
            
                if (!$execute_insert) {
                    die("erro ao inserir");
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
    <title>Atualizar ct</title>
    <!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>
</head>
<body>

    <div class="container" style="width: 400px">

    <center>
        
        <h3>Atualizado com Sucesso!</h3>
        <div style="margin-top: 10px">
        <a href="detalhe.php?id=<?php echo $id_ct?>" class="btn btn-sm btn-warning" style="color:#fff">Voltar</a>
    </center>

    </div>

<!-- Footer -->
<?php include "../includes/footer.php"?>

</body>
</html>

<?php
    mysqli_close($conexao);
?>