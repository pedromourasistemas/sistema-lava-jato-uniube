<?php

	include('Conexao.php');
	
	$UF        = $_POST['UF'];
	$Descricao = $_POST['Descricao']; 
		
	$Sql = "Update lavajato.estados
			Set Descricao = '$Descricao' 
			Where UF = '$UF' ";
	
	$Query = mysql_query($Sql);
	
	if($Query)	
	{
		echo utf8_encode("1|Altera��o salva com sucesso!");
	}
	else
	{
		echo utf8_encode("2|Falha na altera��o! Verificar!");
	}	
?>