<?php
    //<?php include "../includes/navbar.php"; 
    require_once '../conexao/conexao.php';
    session_start();

    if(!isset($_GET["codigo"])){
        header("location:select.php");
    }

    //Informações do conselho e endereco
    $id = $_GET["codigo"];
    $sql1 = "SELECT * FROM conselho_tutelar as ct INNER JOIN endereco_ct as endCt ON endct.id_enderecoCt = ct.id_enderecoct WHERE ct.id_conselho = $id";
    $resultado = mysqli_query($conexao, $sql1);

    if(!$resultado){
        header("location: select.php");
    }
    
    if(mysqli_num_rows($resultado) === 0){
        header("location: select.php");
    }

    $linha = mysqli_fetch_array($resultado); 
    
    // echo "<pre>";
    //     print_r($resultado);
    // echo "</pre>";

    $idCidade = $linha["id_cidade"];
    
    //Informações da cidade e estado
    $sql2 = "SELECT * FROM cidade as c INNER JOIN uf as u ON c.id_uf = u.id_uf WHERE id_cidade = $idCidade ";
    $executeCidade = mysqli_query($conexao,$sql2);
    $linha2 = mysqli_fetch_array($executeCidade);

    

    //Select contato
    $sql3 = "SELECT * FROM contato_ct WHERE id_conselho = $id";
    $contato_ct_exe = mysqli_query($conexao, $sql3);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes dos conselhos</title>
    <!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>

    <link rel="stylesheet" href="../css/listagem.css">

</head>
<body>
    
    <?php include "../includes/navbar.php";?>
    <a href='index.php' class='btn voltar print'><i class="fas fa-arrow-left"></i></a>

    <div class="mudarEs" id="mudarEs">
        <div class="alert alert-black alert-dismissible show fade ampliar" role="alert" id="mostrar">
            <button type="button" class="btn-close btn-close-white" onclick="fechar()" id="fechar"></button> 
            <img src="../<?php echo $linha["imagem"]?>" class="imagem_ampliar">
        </div>
    </div>
    <main>
        <div class="container">
            <div class="detalhes row"> 
                <div class="col-md-6 col-sm-6 image">
                    <ul class="ul_detalhes">
                        <li class="imagem_detalhes img-fluid">
                            <button onclick="mudarEstado()">
                                <img src="../<?php echo $linha["imagem"]?>">
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="col-md-6 col-sm-6">
                    <ul class="ul_detalhes">
                        <li><h3><?php echo $linha["nome"] ?></h3></li>
                        <li> E-mail: <?php echo $linha["email"] ?></li>
                        <li> Bairro: <?php echo $linha["bairro"] ?></li>
                        <li> Endereço: <?php echo $linha["endereco"] ?></li>
                        <li> Número: <?php echo $linha["numero"] ?></li>
                        <li> Complemento: <?php echo $linha["complemento"] ?></li>
                        <li> CEP: <?php echo $linha["cep"] ?></li>
                        <li> Ponto de referência: <?php echo $linha["ponto_referencia"] ?></li>
                        <li> Cidade: <?php echo $linha2[1] ?></li>
                        <li> Estado: <?php echo $linha2["nome"] ?></li>

                        <li> Contatos: 
                        <?php  
                            while ($listar_cont = mysqli_fetch_array($contato_ct_exe)) {
                                if (count($listar_cont) >3) {
                                    echo $listar_cont["numero"]." / ";
                                } else {
                                    echo $listar_cont["numero"];
                                }
                            }
                        ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <center>
        <?php
            if(isset($_SESSION['logado']) && $_SESSION['admim'] >=  3){
        ?>

            <a href="form_atualizar_ct.php?id=<?php echo $id?>" class="btn btn-sm btn-primary" style="color:#fff; margin-top:30px">Atualizar</a>
            <button type="button" class="btn btn-sm btn-danger" style="color:#fff; margin-top:30px" onclick="deletar(<?php echo $linha['id_conselho'];?>)">Deletar</a>
        
        <?php        
            }
        ?>
    </center>

<!-- Footer -->
<?php include "../includes/footer.php"?>

    <!-- JS -->
    <script>

    function deletar(id) {
        var deletar_cons = confirm("Deseja realmente deletar esse dado?")
        if(deletar_cons){
            window.location.replace("delete_ct.php?id="+id);
        }

    }    
    
    function mudarEstado() {
        document.getElementById("mudarEs").style.display = 'none'
        if(document.getElementById("mudarEs").style.display == 'none')
            document.getElementById("mudarEs").style.display = 'block';
    }
    function fechar(){   
        document.getElementById("mudarEs").style.display = "none";
    }


    </script>
</body>
</html>

<?php
    mysqli_close($conexao);
?>