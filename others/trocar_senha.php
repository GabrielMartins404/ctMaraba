<?php
	require_once "../conexao/conexao.php";

	//Inicio da sessão
	session_start();
	//Parte do click no butão

    $id = $_GET["id"];
	if(isset($_POST["alterar_senha"])){ 
		$erros = array();

		$senha_antiga = mysqli_escape_string($conexao, $_POST["senha_antiga"]); //aqui pega os dados do form mas com uma segurança, não permitindo a execução de comando sql
		$nova_senha = mysqli_escape_string($conexao, $_POST["nova_senha"]);
        $conf_nova_senha = mysqli_escape_string($conexao, $_POST["conf_nova_senha"]);

		if(empty($senha_antiga) or empty($nova_senha) or empty($conf_nova_senha)){ //Faz um verificação se o form tem algo vazio, se sim da erro
			$erros[] = "Campo vazio, digite alguma bo***";
		}else{
			$sql = "SELECT senha FROM conselheiro WHERE id_conselheiro = $id";
			$resultado = mysqli_query($conexao, $sql);

			if(mysqli_num_rows($resultado) > 0){ //Verifica o valor do mysqli_query acima, se retornou algo
				$sql = "SELECT * FROM conselheiro WHERE id_conselheiro = $id";
				$resultado = mysqli_query($conexao, $sql);
                $dados = mysqli_fetch_assoc($resultado); 
                $senha_velha = $dados["senha"];

				if($senha_velha == $senha_antiga){

					if($nova_senha == $conf_nova_senha){
                        $sqlUpdate = "UPDATE conselheiro SET senha = '$nova_senha' WHERE id_conselheiro = $id";
                        $executar = mysqli_query($conexao, $sqlUpdate);

                        if($executar){
                            echo "<script> alert('Senha atualizada com sucesso') </script>";
                            echo "<script>window.location.replace('../conselheiros/detalhes_cons.php?id=$id&f=1')</script>";
                        }else{
                            die("WErro no sql");
                        }

                    }else{
                        $erros[] = "Senha digitada e de confirmação não conferem";
                    }

				}else{
					$erros[] = "Senha não conferem";
				}

			}else{
				$erros[] = "Ocorreu um erro no sistema, tente novamente mais tarde.";
			}
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Atualizar senha</title>
  
	<!-- Bibliotecas de estilo -->
    <?php include "../includes/bibliotecas.php"?>

	<style>
	
		.aumentar{
			margin-bottom: 20px;
		}
	</style>
</head>
<body>
<?php include "../includes/navbar.php";?>



	<div class="container mt-3">
			<div class="d-flex justify-content-center altura">
				<div class="card row">

					<div class="card-header col-12">
						<h3>Trocar senha</h3>

						<?php
							if(!empty($erros)) {
								foreach ($erros as $erro) {
									echo "<li class='erro'>".$erro."</li>";
								}
							}
						?>				
					</div>

					<div class="card-body col-12">
						<form action="" method="post">
							<div class="input-group form-group">
								<input type="text" class="form-control aumentar " name="senha_antiga" autocomplete="off" placeholder="Digite a senha antiga">
							</div>

							<div class="input-group form-group">
								<input type="text" class="form-control aumentar" name="nova_senha" autocomplete="off" placeholder="Nova senha">
							</div>

							<div class="input-group form-group">
								<input type="text" class="form-control aumentar" name="conf_nova_senha" autocomplete="off" placeholder="Confirmação da nova senha">
							</div>

							<div class="form-group">
								<button type="submit" name="alterar_senha" class="btn float-right btn-outline-success login_btn">Trocar senha</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		 <!--Dependencias JS-->
		 <script src="../js/main.js"></script>
	</body>
</html>

<?php
    mysqli_close($conexao);
?>