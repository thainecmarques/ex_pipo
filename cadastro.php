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

<?php

	session_start();

	$conexao = mysqli_connect("localhost","root","","pipo");
	$id_cliente = $_SESSION['id_cli'];
	$nome_cliente = $_SESSION['nome_cli'];
	
	echo "<center><h3> Empresa: <strong> $nome_cliente </strong></h3></center>";
	
?>

<div class="col-sm-3">
	<ul class="list-group">
		<li class="list-group-item list-group-item-info"><h4>Os benefícios oferecidos são:</h4></li>
	    
<?php
	
	$sql = "SELECT id_beneficio FROM cliente_beneficio WHERE id_cliente = '$id_cliente'";
	$resultado = mysqli_query($conexao,$sql);
	$rowcount = mysqli_num_rows($resultado);
	
	if($rowcount == 0){
		echo "<script>alert('Erro');</script>";	
	}
	else{
		$id_dados = array();
		$i = 0;
		while ($linha = mysqli_fetch_object($resultado)){
			$id_ben = $linha->id_beneficio;
			$sql = "SELECT nome_beneficio FROM beneficio WHERE id_beneficio = '$id_ben'";
			$resultado_ben = mysqli_query($conexao,$sql);
			$linha_nome_ben = mysqli_fetch_object($resultado_ben);
			echo "<li class='list-group-item'>$linha_nome_ben->nome_beneficio</li>"; //mostrar os beneficios daquele cliente
			
			//selecionar todos os dados necessarios para cadastrar um funcionario de acordo com os beneficios oferecidos pela empresa
			$sql_dados = "SELECT beneficio_dados.id_dados_func, dados_func.desc_dados FROM beneficio_dados, dados_func WHERE beneficio_dados.id_beneficio = '$id_ben' AND beneficio_dados.id_dados_func = dados_func.id_dados_func";
			$resultado_dados = mysqli_query($conexao,$sql_dados);
			while ($linha_dados = mysqli_fetch_object($resultado_dados)){
				$id_dados[$i] = $linha_dados->id_dados_func; //armazenar os códigos em um array
				$i = $i + 1;
			}
		}
		
		$dados_un = array_unique($id_dados); //tirar os codigos repetidos do array para nao duplicar os dados necessarios
		$_SESSION['dados_un'] = $dados_un;
	}
?>
	</ul>	
</div>

<div class="col-sm-6">
	<form id="dados_func" action="dados_func.php" method="post" class="form-horizontal">
		<div class="form-group">
			<label><h4>Para incluir um novo funcionário, informe os dados abaixo: </h4></label>
<?php

	$aux = count($dados_un); //quantidade de codigos diferentes
	$dado = reset($dados_un); //primeiro elemento do array
	for ($n = 0; $n < $aux; $n++){ //percorrer o array para mostrar os dados necessarios
		$sql_desc = "SELECT * FROM dados_func WHERE id_dados_func = '$dado'";
		$resultado_desc = mysqli_query($conexao,$sql_desc);
		$linha_desc = mysqli_fetch_object($resultado_desc);
		
		echo "<br><label>$linha_desc->desc_dados</label><br>";
		if(strpos($linha_desc->desc_dados, 'CPF') !== false){
			echo "<input type='text' id='$dado' name='$dado' class='form-control' minlength='11' maxlength='11' required>";
		}
		else{
			echo "<input type='$linha_desc->tipo_html' id='$dado' name='$dado' class='form-control' required>";
		}
		$dado = next($dados_un); //ir para o proximo elemento do array
	}
	
?>
			<br>
		</div>
		<button type="submit" id="enviar_dados_func" class="btn btn-default">Enviar</button>
	</form>	
</div>
<div class="col-sm-3"></div>
</body>
</html>