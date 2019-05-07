<?php
	include('Conexao.php');
	
	$Veiculo = $_POST['Veiculo'];
	$Modelo  = $_POST['Modelo'];
	$Placa   = $_POST['Placa'];
	$Cor     = $_POST['Cor'];
	$Ano     = $_POST['Ano'];
		
	$Placa = str_replace("-", "", $Placa);
		
	$Sql = "Update lavajato.veiculos
			Set Modelo = '$Modelo', Cor = '$Cor', Ano = '$Ano'
			Where Veiculo = $Veiculo and
			      Placa   = '$Placa' ";  
	
	$Query = mysql_query($Sql);
	
	if($Query)	
	{
		echo utf8_encode("1|Alteraчуo salva com sucesso!");		
	}
	else
	{
		echo utf8_encode("2|Falha na alteraчуo! Verificar!");
	}
?>