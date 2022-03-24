<?php

	session_start();

	$conexao = mysqli_connect("localhost","root","","pipo");
	
	$id_cliente = $_SESSION['id_cli'];
	$dados_un = $_SESSION['dados_un'];
	$aux = count($dados_un);
	$dado = reset($dados_un);
	
	$sql = "SELECT max(id_func) AS max_id_func FROM func"; //verificar qual o codigo do ultimo funcionario cadastrado
	$resultado = mysqli_query($conexao,$sql);
	$rowcount = mysqli_num_rows($resultado);
	
	if($rowcount == 0){
		echo "<script>alert('Erro');</script>";	
	}
	else{
		$linha = mysqli_fetch_object($resultado);
		$id_func = $linha->max_id_func;
		$id_func = $id_func + 1;
		for ($n = 0; $n < $aux; $n++){
			$desc = $_POST[$dado];
			$sql_insert = "INSERT INTO func (id_func, id_cliente, id_dados_func, desc_func) VALUES ('$id_func', '$id_cliente', '$dado', '$desc')";
			$resultado_insert = mysqli_query($conexao,$sql_insert);
			$dado = next($dados_un);
		}
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
<div class="col-sm-3"></div>
<div class="col-sm-6">
	<center><h3> O que você gostaria de fazer agora? </h3></center>
	<div class="btn-group btn-group-justified">
		<a href="cadastro.php" class="btn btn-default">Cadastrar outro funcionário</a>
		<a href="inicio.php" class="btn btn-danger">Sair</a>
	</div>
</div>
<div class="col-sm-3"></div>
</body>
</html>