<?php
    include "../conexao/conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre o sistema</title>

    <!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>
</head>
<body>
    <?php
        include "../includes/navbar.php";
    ?>

    <div class="container">
        <h4>Esse site foi construido em parceria entre Alunos do IFPA campus Marabá Industrial e o conselho tutelar de Marabá</h4>
    </div>

</body>
</html>

<?php
    mysqli_close($conexao);
?>