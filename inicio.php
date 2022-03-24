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
	<div class="container">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">	
				<h2>Selecione a sua empresa: </h2>			
				<input class="form-control" id="nome_empresa" type="text" placeholder="Digite o nome da sua empresa">
				<br>
				<table class="table" >
					<tbody id="tab_empresa">

<?php

	$conexao = mysqli_connect("localhost","root","","pipo");
		
	$sql = "SELECT * FROM cliente";
	$resultado = mysqli_query($conexao,$sql);
	$rowcount = mysqli_num_rows($resultado);
	$cliente = array();
	$i = 0;
	
	if($rowcount == 0){
		echo "<script>alert('Empresa não encontrada');</script>";	
	}
	else{
		while ($linha = mysqli_fetch_object($resultado)){
			$cliente[$i] = $linha->id_cliente;
			echo "<form id='identificacao_cliente' action='entrar.php' method='post' class='form-horizontal'>";
			echo "<tr>";
			echo "<td align='center'><input type='hidden' name='id_cli' id='id_cli' value='$cliente[$i]'>$linha->nome_cliente</td>";
			echo "<td align='center'><button type='submit' id='$cliente[$i]' class='btn btn-default'>Selecionar empresa</button></td>";
			echo "</tr>";
			echo "</form>";
			$i = $i+1;
		}		
	}

?>
					</tbody>
				</table>
			</div>
		<div class="col-sm-3"></div>
	</div>
	
<script>
$(document).ready(function(){
  $("#nome_empresa").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tab_empresa tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

</body>
</html>
