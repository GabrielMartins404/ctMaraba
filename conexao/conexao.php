<?php
    //Primeiro passo
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $database = "ctdigital";

    //Segundo passo
    $conexao = mysqli_connect($servidor, $usuario, $senha, $database);

    //Terceiro passo
    if(mysqli_connect_errno()){
        die("conexão com o BD ctdigital falhou N°:".mysqli_connect_errno());
    }

?>