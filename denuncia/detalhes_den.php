<?php
    require_once '../conexao/conexao.php';
    
    session_start();
    
    
    if (!isset($_SESSION["logado"])) {
        header("location:../login/tela_de_login.php?msg=1");
    }
    if (!isset($_GET["id"])) {
        header("location:listar_den.php");
    }
    $id = $_GET["id"];
    
    $sql1 = "SELECT den.id_denuncia  as id_den, den.protocolo as protocolo, den.denunciante as denunciante, den.email_denunciante as email_den, den.denunciado as denunciado, den.contato_denunciado as cont_denunciado, den.email_denunciado as email_denunciado, den.endereco_denunciado as end_denunciado, den.idade_denunciado as idade_den, den.bairro_denunciado as bairro_denunciado, 
    den.vitima as vitima, den.idade as idade_vit, den.relato as relato, den.data as data, den.hora as hora, den.endereco_vitima as endereco_vitima, den.ponto_referencia_vitima as ponto_referencia_vitima, den.bairro_vitima as bairro_vitima, den.status_denuncia as status_denuncia, den.den_anonima as den_anonima,
    sexo_v.nome as sexo_vitima, sexo_den.nome as sexo_den, p.nome as parentesco  
    FROM denuncia as den 
    INNER JOIN sexo as sexo_v ON den.id_sexovitima  = sexo_v.id_sexo  
    INNER JOIN sexo as sexo_den on den.id_sexodenunciado = sexo_den.id_sexo 
    INNER JOIN parentesco as p on den.id_parentesco = p.id_parentesco  
    WHERE den.id_denuncia = $id";
    
    $resultado = mysqli_query($conexao, $sql1);

    if(mysqli_num_rows($resultado) === 0){
        header("location: listar_den.php");
    }


    $linha = mysqli_fetch_array($resultado);  
    
    
    $sql_den_tipo = "SELECT subt.nome as subtipo_violação FROM denuncia_tipo as den_tipo
    INNER JOIN subtipo_violacao as subt ON subt.id_subtipo = den_tipo.id_tipo
    WHERE den_tipo.id_denuncia = $id";
    $execute_tipoV = mysqli_query($conexao, $sql_den_tipo);
    if(!$execute_tipoV){
        die("Erro babe");
    }

    

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da denúncia</title>
    <!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>
    <link rel="stylesheet" href="../css/listagem.css">
    <link rel="stylesheet" href="../css/formulario.css">
    

    <style>
        li.lista_sub{
            margin-top:-20px;
        }
        p.relato{
            margin-top:10px;
            font-size:12pt;
            font-family: calibri;
        }

        span.titulo_den{
            font-size:15pt;
            font-weight: bold;
        }
    </style>
</head>
<body>
    
    <?php include "../includes/navbar.php";?>

    

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Status denúncia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <?php
                        if($linha["status_denuncia"] == 0){
                            echo "<h4> Essa denúncia ainda não foi atendida </h4>";
                        ?>
                            <select class="form-select mb-3" aria-label=".form-select-sm" id="status" name="status">
                                <option value="0" selected>Deixar como está</option>
                                <option value="1">Atender denúncia</option>
                            </select>
                        <?php
                        
                        }elseif ($linha["status_denuncia"] == 1 && $_SESSION["admim"] >= 3) {
                            echo "<h4> Essa denúncia já foi atendida, deseja mudar esse status? </h4>";
                        ?>
                            <select class="form-select mb-3" aria-label=".form-select-sm" id="status" name="status">
                                <option value="1" selected>Continuar em atendimento</option>
                                <option value="0">Interromper atendimento</option>
                            </select>
                        <?php
                        }
                        else if($linha["status_denuncia"] == 1 ){
                            echo "<h4> Denúncia já em atendimento <h4>";
                        }
                    ?>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="mudarStatus(<?php echo $id?>)">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <main>
    <a href="listar_den.php" class="btn btn-sm btn-warning" style="color:#fff; margin-top:30px; margin-bottom:20px">Voltar</a>

    <?php
        if($linha["status_denuncia"] == 1){
    ?>
        <a href="relatorio.php?id=<?php echo $id?>" class="btn btn-sm btn-success" style="color:#fff; margin-top:30px; margin-bottom:20px">Gerar relatorio</a>
    <?php
        }
    ?>

    <section class="container table-responsive"> 
    <table class="table" style="margin-bottom:60px">
    
        <thead>
            <tr>
                <h4 class="text-center">Informações da denúncia</h4>
            </tr>
            <tr>
                <th scope="col" class="tabela">Horário do recebimento da denúncia</th>
                <th scope="col" class="tabela">Data do recebimento da denúncia</th>
                <th scope="col" class="tabela">Quantidade de dias da denúncia</th>
                <th scope="col" class="tabela">Protocolo</th>
                <th>    
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Ver status da denúncia
                    </button>
            </th>
            </tr>
        </thead>
        <tbody>
                <?php
                ?>
            <tr id=''>
                <td> 
                    <?php 
                        $hora_den = strtotime($linha["hora"]);
                        echo date( "H:i",$hora_den)
                    ?>
                </td>
                <td> 
                <span class="info"> 
                <?php 
                    $data_den = strtotime($linha["data"]);
                    echo date('d/m/Y', $data_den)
                ?>
                </span>
                </td>
                <td>  
                    <span class="info"> 
                    <?php 
                        date_default_timezone_set("Brazil/east");

                        $data_den = $linha["data"];
                        $hoje = date("Y-m-d");
                        $dias_calc = strtotime($hoje) - strtotime($data_den);
                        $dias = floor($dias_calc / (60 * 60 * 24));

                        if($dias < 0){
                            $dias *= -1; 
                        }
                        echo "Há ".$dias." dias atrás";
                    ?>
                    </span>
                </td>
                <td> 
                    <span class="info">
                        <?php echo $linha["protocolo"]?>
                    </span>
                </td>
                <?php
                    
                ?>
            </tr>
        </tbody>
    </table>
</section>

        <div id="detalhes">   
                <ul class="ul_detalhes">
                    <!-- Dados do denunciante -->
                    <section class="separa">
                    <h4>Dados do denunciante</h4>

                    <?php
                        if($linha["den_anonima"] == 0 || $_SESSION["admim"] >= 3){
                    ?>
                        <li class="detalhes_den">
                            <span class="titulo"> Denunciante: </span>
                            <span class="info">
                                <?php  
                                    if ( $linha["denunciante"] == "") {
                                        echo "Não informado";
                                    } else {
                                        echo $linha["denunciante"];
                                    }
                                ?>
                            </span>
                        </li> 

                        <li class="detalhes_den">
                            <span class="titulo"> E-mail: </span>
                            <span class="info">
                                <?php  
                                    if ( $linha["email_den"] == "") {
                                        echo "Não informado";
                                    } else {
                                        echo $linha["email_den"];
                                    }
                                ?>
                            </span>
                        </li>

                    <?php
                        }else{
                            echo "<h5> Essa denúncia foi realozada de maneira anônima, somente os administradores tem direito a ver esse campo</h5>";
                        }
                    ?>
                    </section>

                        <!-- Dados do denunciado -->
                    <section class="separa">
                    <h4>Dados do denunciado</h4>
                        <li class="detalhes_den">
                            <span class="titulo"> Nome do denunciado: </span>
                            <span class="info">
                                <?php  
                                    if ( $linha["denunciado"] == "") {
                                        echo "Não informado";
                                    } else {
                                        echo $linha["denunciado"];
                                    }
                                ?>
                            </span>
                        </li>

                        <li class="detalhes_den">
                            <span class="titulo"> Contato do denunciado: </span>
                            <span class="info">
                                <?php  
                                    if ( $linha["cont_denunciado"] == "") {
                                        echo "Não informado";
                                    } else {
                                        echo $linha["cont_denunciado"];
                                    }
                                ?>
                            </span>
                        </li>

                        <li class="detalhes_den">
                            <span class="titulo"> Email denunciado: </span>
                            <span class="info">
                                <?php  
                                    if ( $linha["email_denunciado"] == "") {
                                        echo "Não informado";
                                    } else {
                                        echo $linha["email_denunciado"];
                                    }
                                ?>
                            </span>
                        </li>

                        <li class="detalhes_den">
                            <span class="titulo"> Sexo do denunciado: </span>
                            <span class="info">
                                <?php echo $linha["sexo_den"]?>
                            </span>
                        </li>
                        
                        <li class="detalhes_den">
                            <span class="titulo"> Idade do denunciado: </span>
                            <span class="info">
                                <?php echo "Aproximadamente ".$linha["idade_den"]." anos";?>
                            </span>
                        </li>

                        <li class="detalhes_den">
                            <span class="titulo"> Endereço do denunciado: </span>
                            <span class="info">
                                <?php echo $linha["end_denunciado"]?>
                            </span>
                        </li>

                        <li class="detalhes_den">
                            <span class="titulo"> Bairro do denunciado: </span>
                            <span class="info">
                                <?php echo $linha["bairro_denunciado"]?>
                            </span>
                        </li>
                    </section>

                        <!-- Dados da vitima -->
                    <section class="separa">
                        <h4>Dados da vítima</h4>
                        <li class="detalhes_den">
                            <span class="titulo">  Nome da vitima: </span>
                            <span class="info">
                                <?php  
                                    if ( $linha["vitima"] == "") {
                                        echo "Não informado";
                                    } else {
                                        echo $linha["vitima"];
                                    }
                                ?>
                            </span>
                        </li>

                        <li class="detalhes_den">
                            <span class="titulo"> Idade da vítima: </span>
                            <span class="info">
                                <?php echo "Aproximadamente ".$linha["idade_vit"]." anos"?>
                            </span>
                        </li>

                        <li class="detalhes_den">
                            <span class="titulo"> Sexo da vítima: </span>
                            <span class="info">
                                <?php echo $linha["sexo_vitima"]?>
                            </span>
                        </li>

                        <li class="detalhes_den">
                            <span class="titulo"> Parentesco entre o agressor e vítima: </span>
                            <span class="info">
                                <?php echo $linha["parentesco"]?>
                            </span>
                        </li>

                        <li class="detalhes_den">
                            <span class="titulo"> Endereço da vítima: </span>
                            <span class="info">
                                <?php echo $linha["endereco_vitima"]?>
                            </span>
                        </li>

                        <li class="detalhes_den">
                            <span class="titulo"> Bairro da vítima: </span>
                            <span class="info">
                                <?php echo $linha["bairro_vitima"]?>
                            </span>
                        </li>

                        <li class="detalhes_den">
                            <span class="titulo"> Ponto de referência da vítima: </span>
                            <span class="info"> 
                                <?php  
                                    if ( $linha["ponto_referencia_vitima"] == "") {
                                        echo "Não informado";
                                    } else {
                                        echo $linha["ponto_referencia_vitima"];
                                    }
                                ?>
                            </span>
                        </li>
                    </section>
        
                        <!-- Daods da denuncia -->
                    <section class="separa">
                        <h4>Detalhes da denúncia</h4>

                        <li class="detalhes_den">
                            <span class="titulo_den">Tipos de violação relatado </span>
                            <ul>
                                <?php 
                                    while ($linha2 = mysqli_fetch_array($execute_tipoV)){
                                        echo"<br>";
                                ?>
                                    <li class='lista_sub' style=" list-style:disc;"><?php echo $linha2["subtipo_violação"]?></li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </li>

                        <li class="detalhes_den">
                            <span class="titulo_den">Relato da denúncia: </span>
                            <p class="text-break relato">
                                <?php echo $linha["relato"]?>
                            </p>
                        </li>
                    </section>
                </ul>
        </div>
    </main>

    
     <!--Dependencias JS-->
     <script src="../js/main.js"></script>

    <script>
        function mudarStatus(id){
            var select = document.getElementById("status");
            var valor = select.options[select.selectedIndex].value; //Pega o valor do option dentro do select, pegando o selecionado

                var confirmar = confirm("Desejá realmente alterar o status dessa denúncia?");

                if(confirmar){
                    
                    $.ajax({
                        url: 'programas_secundarios/atualizar_status.php?id='+id+'&&status='+valor,
                        type: 'POST',
                        data: valor,
                        async: false,
                        contentType: false,
                        success: function(data){
                        alert(data)
                        window.location.reload();
                        }
                    })
                } 
            
    }
    </script>
</body>
</html>

<?php
    mysqli_close($conexao);
?>