<?php
    require_once '../conexao/conexao.php';

    if(!isset($_GET["id"])){
        header("location: select_conse.php");
    }

    $id_cons = $_GET["id"];

    $nome = $_POST["nome_conselheiro"];
    $email = $_POST["email"];
    $sexo = $_POST["sexo"];
    $cor = $_POST["cor"];
    $situacao = $_POST["situacao"];
    $dt_nasc = $_POST["dt_nasc"];
    $ct = $_POST["ct"];

    $sql = "UPDATE conselheiro SET nome = '$nome', id_sexocon = $sexo, cor = '$cor', 
    data_nascimento = '$dt_nasc', email = '$email', id_CT = $ct, id_situacaocon = $situacao 
    WHERE id_conselheiro = $id_cons";

    $executar_update = mysqli_query($conexao, $sql);

    if(!$executar_update){
        die("ERRO ao atualizar");
    }

    //Atualizar contato
        $sql_delete = "DELETE FROM contato_con WHERE id_conselheiro = $id_cons ";
        $execute_delete = mysqli_query($conexao, $sql_delete);
        if (isset($_POST["contato"])) {
            $contato_array = $_POST["contato"];

        foreach ($contato_array as $num_contato) {
            if ($num_contato != "") {
                $sql_insert = "INSERT INTO contato_con (contato_con, id_conselheiro) VALUES ('$num_contato', $id_cons)";
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
    <title>Atualizar</title>
    <!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>
    
</head>
<body>

    <div class="container" style="width: 400px">

    <center>
        
        <h3>Atualizado com Sucesso!</h3>
        <div style="margin-top: 10px">
        <a href="detalhes_cons.php?codigo=<?php echo $id_cons?>" class="btn btn-sm btn-warning" style="color:#fff">Voltar</a>
    </center>

    </div>


</body>
</html>

<?php
    mysqli_close($conexao);
?>