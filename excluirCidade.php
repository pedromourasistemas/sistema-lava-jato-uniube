<?php
	include('Conexao.php');

	$Cidade  = $_POST['Cidade'];
		
	$Sql = "Delete 
			From lavajato.cidades 
			Where Cidade = $Cidade";
	
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