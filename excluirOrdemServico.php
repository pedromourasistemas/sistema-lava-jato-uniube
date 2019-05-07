<?php
	include('Conexao.php');	

	$OrdemServico  = $_POST['OrdemServico'];
		
	$Sql = "Delete 
			From lavajato.ordensservicos 
			Where OrdemServico = $OrdemServico";		
	
	$Query = mysql_query($Sql);	
	
	if($Query)	
	{
		echo utf8_encode("1|Exclusão concluída com sucesso!");
	}
	else
	{
		echo utf8_encode("2|Falha na exclusão! Verificar!");
	}
?>