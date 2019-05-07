<?php
	include('Conexao.php');
	
	$Cidade    = $_POST['Cidade'];
	$UF        = $_POST['UF'];
	$Descricao = $_POST['Descricao'];
		
	$Sql = "Update lavajato.cidades
			Set UF = '$UF', Descricao = '$Descricao'
			Where Cidade = $Cidade ";
	
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