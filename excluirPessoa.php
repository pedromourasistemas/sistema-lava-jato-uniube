<?php
	include('Conexao.php');	

	$Codigo  = $_POST['CPF'];
		
	$Sql = "Delete 
			From lavajato.pessoas 
			Where CPF = $Codigo";		
	
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