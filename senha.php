<?php

	session_start();

	$conexao = mysqli_connect("localhost","root","","pipo");
	$senha_cliente = $_POST['senha_cliente'];
	$id_cliente = $_SESSION['id_cli'];
	
	$sql = "SELECT nome_cliente, senha_cliente FROM cliente WHERE id_cliente='$id_cliente' AND senha_cliente='$senha_cliente'";
	$resultado = mysqli_query($conexao,$sql);
	$rowcount = mysqli_num_rows($resultado);
	
	if($rowcount == 0){
		echo "<script>alert('Erro: senha incorreta.');</script>";
		header("Location:entrar.php");		
	}
	else{
		$linha = mysqli_fetch_object($resultado);
		$nome_cliente = $linha->nome_cliente;
		$_SESSION['nome_cli'] = $nome_cliente;
		header("Location:cadastro.php");
	}

?>
