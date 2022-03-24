<?php

	session_start();
	
	$conexao = mysqli_connect("localhost","root","","pipo");
		
	$id_cliente = $_POST['id_cli'];
	$_SESSION['id_cli'] = $id_cliente;
	
	$sql = "SELECT nome_cliente FROM cliente WHERE id_cliente='$id_cliente'";
	$resultado = mysqli_query($conexao,$sql);
	$rowcount = mysqli_num_rows($resultado);
	
	if($rowcount == 0){
		echo "<script>Erro: empresa não encontrada</script>";	
	}
	else{
		$linha = mysqli_fetch_object($resultado);
		$nome_cliente = $linha->nome_cliente;
	}
?>

<html>
<head>
	<title> Exercicio Pipo Saúde </title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		
</head>
	
<body>
<center>
<div class="container">
  <h2>Página para incluir funcionário nos benefícios</h2>
	<form id="identificacao_cliente" action="senha.php" method="post" class="form-horizontal">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<div class="form-group">
				<label>Sua empresa:</label><br>
<?php
				echo $nome_cliente;
?>
			</div>
			<div class="form-group">
				<label for="senha_cliente">Informe seu código de acesso ou senha:</label><br>
				<input type="password" id="senha_cliente" name="senha_cliente" class="form-control">
			</div>
			<button type="submit" id="enviar_nome_senha" class="btn btn-default">Entrar</button>
		</div>
		<div class="col-sm-3"></div>
	</form>
</div>
</center>
</body>
</html>