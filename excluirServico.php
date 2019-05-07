<?php

	include('Conexao.php');

	$Servico  = $_POST['Servico'];
		
	$Sql = "Delete 
			From lavajato.servicos 
			Where Servico = '$Servico'";	
	
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