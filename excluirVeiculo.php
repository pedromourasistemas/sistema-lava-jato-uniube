<?php
	include('Conexao.php');

	$Veiculo  = $_POST['Veiculo'];
		
	$Sql = "Delete 
			From lavajato.veiculos 
			Where Veiculo = $Veiculo";
	
	$Query = mysql_query($Sql);
	
	if($Query)	
	{
		echo utf8_encode("1|Exclus�o conclu�da com sucesso!");
	}
	else
	{
		echo utf8_encode("2|Falha na exclus�o! Verificar!");
	}
?>