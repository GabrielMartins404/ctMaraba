<?php
	require_once "../conexao/conexao.php";

	//Inicio da sessão
	session_start();
	//Parte do click no butão
	if(isset($_POST["logar"])){ //Verifica se o botão foi clicado
		$erros = array(); //cria um array pra armazenar os erros

		$login = mysqli_escape_string($conexao, $_POST["num_M"]); //aqui pega os dados do form mas com uma segurança, não permitindo a execução de comando sql
		$senha = mysqli_escape_string($conexao, $_POST["senha"]);

		if(empty($login) or empty($senha)){ //Faz um verificação se o form tem algo vazio, se sim da erro
			$erros[] = "Campo vazio, digite o que se pede para entrar";
		}else{
			$sql = "SELECT login FROM conselheiro WHERE login = '$login'";
			$resultado = mysqli_query($conexao, $sql);

			if(mysqli_num_rows($resultado) > 0){ //Verifica o valor do mysqli_query acima, se retornou algo
				$sql = "SELECT * FROM conselheiro WHERE login = '$login' AND senha = '$senha'";
				$resultado = mysqli_query($conexao, $sql);

				if(mysqli_num_rows($resultado) == 1){
					$dados = mysqli_fetch_assoc($resultado); 

					if($dados['nivel_acesso'] > 1){
						$id = $dados['id_conselheiro'];
						$_SESSION['logado'] = true; //Cria um super global de sessão
						$_SESSION['id_cons'] = $dados['id_conselheiro']; //Essa super global recebe o id
						$_SESSION['admim'] = $dados['nivel_acesso'];
						header("location: ../conselheiros/detalhes_cons.php?id=$id&&f=1");
						
					}else{
						$erros[] = "Seu acesso a esse sistema foi bloqueado";
					}
				}else{
					$erros[] = "Usuario e senha não conferem";
				}

			}else{
				$erros[] = "Matrícula de login inexistente";
			}
		}
	}

?>


<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Tela de login</title>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

		<?php include "../includes/bibliotecas.php"?>
		<link rel="stylesheet" type="text/css" href="../css/formulario.css">

		<style>
			body{
				width: 100%;
			}

			
			.tela-login{
				width: 100%;
				display: flex;
				justify-content: center;
			}
		</style>
	</head>
	<body>
	<?php include "../includes/navbar.php";?>

	<?php
		if(isset($_GET["msg"])){
			echo "
				<script>
					alert('É necessário efetuar o login e ter permissão pra acessar esses campos')
				</script>
			";
		}
	?>

	<div class="container tela-login">
		<div class="d-flex altura">
			<div class="card row">
				<div class="card-header col-12">
					<h3>Login</h3>
					<?php
						if(!empty($erros)) {
							foreach ($erros as $erro) {
								echo "<li class='erro'>".$erro."</li>";
							}
						}
					?>				
				</div>

				<div class="card-body col-12">
					<form action="" method="post" autocomplete="off">
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text back"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" class="form-control" name="num_M" placeholder="Nº de matrícula">
						</div>

						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text back"><i class="fas fa-key"></i></span>
							</div>
							<input type="text" class="form-control" name="senha" placeholder="Senha">
						</div>

						<div class="form-group">
							<button type="submit" name="logar" class="btn float-right btn-outline-success login_btn">Entrar</button>
						</div>

						</div>
					</form>

					<div class="card-footer col-12">
						<div class="d-flex justify-content-center">
							Esqueceu sua senha? <a href="#">clique aqui</a>
						</div>
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