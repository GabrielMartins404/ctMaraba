<?php
    require_once '../conexao/conexao.php';
    
    session_start();
    
    
    if (!isset($_SESSION["id_cons"])) {
        header("location:../login/tela_de_login.php?msg=1");
    }

    if (!isset($_GET["id"])) {
        header("location:select_conse.php");
    }

    //Informações do conselho e endereco
    $permission = $_SESSION['admim'];
    if($permission <= 2){
        if (!isset($_GET["f"])) {
            echo "<script> alert('Você não tem permissão pra acessar essa página') </script>";
            $_GET["f"] = 1;
        }
        $id = $_SESSION["id_cons"];
    }else{
        $id = $_GET["id"];
    }
    
    $sql1 = "SELECT cons.id_conselheiro as id_cons, cons.data_nascimento as dt_nasc, cons.nome as nome_cons, cons.nome_social as nome_social, cons.apelido as apelido, cons.cor as cor_cons, cons.email as email_cons, cons.imagem as imagem_cons,
    situ.nome as nome_situ, ct.nome as nome_ct, s.nome as sexo  
    FROM conselheiro as cons 
    INNER JOIN situacao_con as situ ON cons.id_situacaocon = situ.id_situacaocon 
    INNER JOIN conselho_tutelar as ct on cons.id_CT = ct.id_conselho 
    INNER JOIN sexo as s on s.id_sexo = cons.id_sexocon WHERE cons.id_conselheiro = $id";
    
    $resultado = mysqli_query($conexao, $sql1);
    if(mysqli_num_rows($resultado) === 0){
        header("location: select.php");
    }
    
    $linha = mysqli_fetch_array($resultado);    
    
    date_default_timezone_set("Brazil/east"); //Aqui diz que ta usando o horario de brasilia
    $dn = new DateTime($linha["dt_nasc"]);
    $agora = new DateTime();

    $idade = $agora -> diff($dn);
    
    $sql_cont = "SELECT * FROM contato_con WHERE id_conselheiro = $id";
    $execute_cont = mysqli_query($conexao, $sql_cont);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conselheiro</title>

    <!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>
    <link rel="stylesheet" href="../css/listagem.css">
    

    <style>
        
    </style>
</head>
<body>
    
    <?php include "../includes/navbar.php";?>
    <br>

    <div class="mudarEs" id="mudarEs">
        <div class="alert alert-warning alert-dismissible show fade ampliar" role="alert" id="mostrar">
            <button type="button" class="btn-close btn-close-white" onclick="fechar()" id="fechar"></button> 
            <img src="<?php echo $linha["imagem_cons"]?>" class="imagem_ampliar">
        </div>
    </div>

<main>
    <div class="container">
        <div class="detalhes row">
            <div class="welcome col-12"> 
                <h3>Bem vindo, <?php echo $linha["nome_cons"]?></h3>
            </div>    
                <div class="col-md-6 col-sm-6 image">
                    <ul class="ul_detalhes">
                        <li class="imagem_detalhes img-fluid">
                            <button onclick="mudarEstado()">
                                <img src="../<?php echo $linha["imagem_cons"]?>">
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="col-md-6 col-sm-6">
                    <ul class="ul_detalhes">
                        <li><h3><?php echo $linha["nome_cons"] ?></h3></li>
                        <li> E-mail: <?php echo $linha["email_cons"] ?></li>
                        <li> Sexo: <?php echo $linha["sexo"] ?></li>
                        <li> Cor: <?php echo $linha["cor_cons"] ?></li>
                        <li> Situação: <?php echo $linha["nome_situ"] ?></li>
                        <li> Idade: <?php echo $idade->y." anos" ?></li>
                        <li> Contatos: 
                        <?php  
                            while ($listar_cont = mysqli_fetch_array($execute_cont)) {
                                if (count($listar_cont) >3) {
                                    echo $listar_cont["contato_con"]." / ";
                                } else {
                                    echo $listar_cont["contato_con"];
                                }
                            }
                        ?>
                        </li>
                        <li> Conselho Tutelar: <?php echo $linha["nome_ct"] ?></li>
                    
                    </ul>
                </div>
            </div>
    </div>
</main>

<center>
    <div class="botao col-12">
        <a href="select_conse.php" class="btn btn-sm btn-warning" style="color:#fff; margin-top:30px">Voltar</a>
        <a href="atualizar.php?id=<?php echo $id?>" class="btn btn-sm btn-primary" style="color:#fff; margin-top:30px">Atualizar</a>
        <button type="button" class="btn btn-sm btn-danger" style="color:#fff; margin-top:30px" onclick="deletar(<?php echo $linha['id_cons']?>)">Apagar dados</button>
    </div>
</center>

    <!--Dependencias JS-->
    <script src="../js/main.js"></script>

    <script>
    
    function deletar(id) {
        var deletar_cons = confirm("Deseja realmente deletar esse dado?")
        if(deletar_cons){
            window.location.replace("delete_cons.php?id="+id);
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