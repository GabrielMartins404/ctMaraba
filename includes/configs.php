<?php
    // include "../conexao/conexao.php";
    // session_start();

    $id_conselheiro = $_SESSION['id_cons'];
    $sql_perfil = "SELECT * FROM conselheiro WHERE id_conselheiro = $id_conselheiro";
    $perfil_exe = mysqli_query($conexao, $sql_perfil);
    $perfil = mysqli_fetch_assoc($perfil_exe);
?>
    
    <button type="button" class="btn btn-dark print" onclick="revelar()">
        <i class="fas fa-cog"></i>
    </button>

    <div id="menu-vertical" class=" rounded">

        <div class="perfil bg-white">
            <img src="../<?php echo $perfil['imagem']?>" alt="">
            <h6><?php echo $perfil["nome"] ?></h6>
        </div>

        <div class="bg-light list-group">
            <a href="../conselheiros/detalhes_cons.php?id=<?php echo $_SESSION["id_cons"]?>" class="list-group-item list-group-item-action">Ver Perfil</a>
            <a href="../conselheiros/atualizar.php?id=<?php echo $_SESSION["id_cons"]?>" class="list-group-item list-group-item-action">Atualizar dados</a>
            <a href="../others/trocar_senha.php?id=<?php echo $_SESSION["id_cons"]?>" class="list-group-item list-group-item-action">Trocar senha</a>
        </div>

    </div>
    <script>
        function revelar(){
            
            var menu = document.getElementById("menu-vertical");

            var barra = window.getComputedStyle(menu).getPropertyValue('left');
            
            if(barra == "-200px"){
                menu.style.left = "0px";
            }else{
                menu.style.left = "-200px";
            }
        }
    </script>
