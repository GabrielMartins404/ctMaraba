<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastrar Sexo</title>
  <!-- Bibliotecas de estilo -->
  <?php include "../includes/bibliotecas.php"?>

  <style>
    
    #tamanhoContainer {
    width: 600px;
    }

  </style>

</head>


<body>
	
 <div class="container" id="tamanhoContainer" style="margin-top: 40px" > 
    <h4>Formulário de Cadastro de Sexo</h4>


      <form action="_inserir_sexo.php" method="POST" style="margin-top:30px">
  	    <div class="form-group">
          <label >Nome</label>
          <input type="text" class="form-control" name="nome" placeholder="Digite o Sexo" required>
        </div>
      

        <div style="text-align: center;">

        <a href="../index.php" role="button" class="btn btn-sm btn-primary"> Voltar </a>
        <button type="submit" class="btn btn-sm btn-success"> Cadastrar </button>

        </div>
      </form>

</div>

</body>
</html>