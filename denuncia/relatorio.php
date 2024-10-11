<?php

//faz a conexão com arquivo de conexão
require_once '../conexao/conexao.php';

session_start();
    
    if (!isset($_GET["id"])) {
        header("location:listar_den.php");
    }    

    if (!isset($_SESSION["id_cons"])) {
        header("location:../login/tela_de_login.php?msg=1");
    }

    $id_den = $_GET["id"];
    $id_cons = $_SESSION["id_cons"];

    // Buscar conselheiro
    $sql_conselheiro = "SELECT nome, id_CT FROM conselheiro WHERE id_conselheiro = $id_cons";
    $execute_sql_cons = mysqli_query($conexao, $sql_conselheiro);
    $linha_cons = mysqli_fetch_array($execute_sql_cons);

    // Buscar CT
    $id_ct = $linha_cons["id_CT"];

    $sql_ct = "SELECT nome, id_enderecoct FROM conselho_tutelar WHERE id_conselho = $id_ct";
    $execute_sql_ct = mysqli_query($conexao, $sql_ct);

    // Buscar endereço do CT
    $linha_end_ct = mysqli_fetch_array($execute_sql_ct);
    $id_end_ct = $linha_end_ct["id_enderecoct"];

    $sql_end_ct = "SELECT * FROM endereco_ct WHERE id_enderecoCt = $id_end_ct";
    $execute_sql_ct = mysqli_query($conexao, $sql_end_ct);

    $listagem_end = mysqli_fetch_array($execute_sql_ct);

    //Buscar cidade e estado
    $id_cidade = $listagem_end["id_cidade"];
    $id_uf = $listagem_end["id_uf"];

    $sql_cidade = "SELECT * FROM cidade WHERE id_cidade = $id_cidade";
    $execute_cidade = mysqli_query($conexao, $sql_cidade);
    $listagem_cidade = mysqli_fetch_array($execute_cidade);

    $sql_uf = "SELECT * FROM uf WHERE id_uf = $id_uf";
    $execute_uf = mysqli_query($conexao, $sql_uf);
    $listagem_uf = mysqli_fetch_array($execute_uf);

    // Buscar denuncia
    $sql_denuncia = "SELECT * FROM denuncia WHERE id_denuncia = $id_den";
    $execute_sql_den = mysqli_query($conexao, $sql_denuncia);
    if(mysqli_num_rows($execute_sql_den) === 0){
        header("location: listar_den.php");
    }

    $denuncia = mysqli_fetch_array($execute_sql_den);
    $data = strtotime($denuncia["data"]);

    // Buscar parentesco e sexo
    $id_sexo_denu = $denuncia["id_sexodenunciado"];
    $id_parentesco = $denuncia["id_parentesco"];

    $sql_sexo_denu = "SELECT * FROM sexo WHERE id_sexo = $id_sexo_denu";
    $execute_sqlsexo = mysqli_query($conexao, $sql_sexo_denu);
    $listagem_sexo_denu = mysqli_fetch_array($execute_sqlsexo);

    $sql_parenteco = "SELECT * FROM parentesco WHERE id_parentesco = $id_parentesco";
    $execute_parentesco = mysqli_query($conexao, $sql_parenteco);
    $listagem_parentesco = mysqli_fetch_array($execute_parentesco);

    if(!$execute_sql_den){
        die("<h2 style='font-family: sans-serif'>Falha, recarregue a página e tente novamente</h2>");
    }


// echo "<pre>";
//     print_r($denuncia);
// echo "</pre>";
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de denúncia</title>
    <!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>

    <style>
        section.a4{
            width: 17cm;
            text-align: justify;
            padding: 10px;
            padding-left: 30px;
            padding-right: 20px;
        }
        p.footer{
            text-align: center;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
        }

        @media print{
            body{
                margin: 0;
                padding: 0;
            }

            .print{
                display: none;
            }

            section.a4{
                width: 24cm;
                text-align: justify;
                padding: 10px;
                padding-left: 30px;
                padding-right: 20px;
            }

        }
    </style>
</head>
<body>

    <?php include "../includes/navbar.php";?>

<button class="btn btn-light print" onclick="print()">
    Imprimir
</button>
<br>
<a href='listar_den.php' class='btn voltar print'><i class="fas fa-arrow-left"></i></a>
    <section class="container a4">         
        <h3 style="margin-bottom: 30px;">Relatorio da denúncia</h3>

        <p style="text-indent: 30px;">
            O conselho tutelar Marabá sediado <?php echo $listagem_end["endereco"] ?> na número <?php echo $listagem_end["numero"] ?>, <?php echo $listagem_end["bairro"] ?>/<?php echo $listagem_cidade["nome"]?>-<?php echo $listagem_uf["sigla"]?>, 
            com fundamento no Art. 136, inciso VII, da Lei 8.069/90, (Estatuto da Criança e do Adolescente - ECA), 
            confirma o recebimento de uma denúncia no dia <?php echo date("d/m/y",$data) ?> no horário <?php echo $denuncia["hora"]?>,  
            contra uma pessoa do sexo <?php echo $listagem_sexo_denu["nome"]?> apontado como <?php echo $listagem_parentesco["nome"]?> da vítima. 
        </p>

        <p class="footer">
            _______________________________________ <br>
            <?php echo $linha_cons["nome"]?>
        </p>
    </section>

     <!--Dependencias JS-->
     <script src="../js/main.js"></script>
    <script>

    </script>
</body>
</html>

<?php
    mysqli_close($conexao);
?>