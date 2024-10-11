<?php
    include "../conexao/conexao.php";

    if(!isset($_GET["id"])){
        header("location: listar_uf.php");
    }

    $id_url = $_GET["id"];
    //Mostrar estado
    $sql_selectUf = "SELECT * FROM uf WHERE id_uf = $id_url";
    $executa_selectUf = mysqli_query($conexao, $sql_selectUf);
    $mostrar_uf = mysqli_fetch_assoc($executa_selectUf);

    //Mostrar regiap
    $sql_selectRegiao = "SELECT * FROM regiao";
    $executa_selectRegiao = mysqli_query($conexao, $sql_selectRegiao);

    if(isset($_POST["uf"])){
        $uf = $_POST["uf"];
        $sigla = $_POST["sigla"];
        $regiao = $_POST["regiao"];

        $sql_Update = "UPDATE uf SET nome = '$uf', sigla = '$sigla', id_regiao = $regiao WHERE id_uf = $id_url";
        $execute_update = mysqli_query($conexao, $sql_Update);

        if(!$execute_update){
            die("Deu um errozinho aí");
        }else{
            echo "<h3 style='background-color: green; color:white;'> Banco de dados atualizado com sucesso, uhhuu</h3>";
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tieste I ron away</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>

<form action="" method="post">
    <div class="container">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nome estado</label>
            <input type="text" class="form-control" name="uf" aria-describedby="emailHelp" value="<?php echo $mostrar_uf["nome"]?>">
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Sigla estado</label>
            <input type="text" class="form-control" name="sigla" aria-describedby="emailHelp" value="<?php echo $mostrar_uf["sigla"]?>">
        </div>

        <div class="mb-3">

        <label for="exampleInputEmail1" class="form-label">Região do estado</label>
            <select class="form-select" aria-label="Default select example" name="regiao">
                <?php 

                    //Essa partezinha é um pouco complicada, nem eu entendo direito 

                    $minhaRegiaoID = $mostrar_uf["id_regiao"]; //Recebe o id mas da tabela de estados
                    while ($listar_regiao = mysqli_fetch_assoc($executa_selectRegiao)) {    
                        $id_regiao = $listar_regiao["id_regiao"]; //Recbe o id da tabela de regia
                        if($minhaRegiaoID == $id_regiao){ //Procura (eu acho) qual região terá o id igual ao do estado selecionado         
                ?>
                    <option value="<?php echo $listar_regiao["id_regiao"]?>" selected>
                        <?php echo $listar_regiao["nome"]?>
                    </option>
                    <?php
                        }else{
                    ?>
                    <option value="<?php echo $listar_regiao["id_regiao"]?>">
                        <?php echo $listar_regiao["nome"]?>
                    </option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
    

        <input type="submit" class="btn btn-primary" value="Atualizar">
        <a href="listar_uf.php" class="btn btn-primary btn-warning" style="color:#fff">Voltar</a>
    </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>