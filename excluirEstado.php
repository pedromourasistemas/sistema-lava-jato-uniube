<?php

	include('Conexao.php');

	$UF  = $_POST['UF'];
		
	$Sql = "Delete 
			From lavajato.estados 
			Where UF = '$UF'";	
	
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