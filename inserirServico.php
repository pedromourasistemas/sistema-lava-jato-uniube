<?php
	include('Conexao.php');

	$Descricao = $_POST['Descricao'];
	$Valor     = $_POST['Valor'];
	
	$Valor = str_replace(",", ".", $Valor);
	
	$Sql = "Insert Into 
	  		lavajato.servicos(Descricao, Valor)
		    Values('$Descricao', $Valor)";
	
	$Query = mysql_query($Sql);
		
	if($Query)	
	{
		echo utf8_encode("1|Serviço inserido com sucesso!");			
	}
	else
	{
		echo utf8_encode("2|Falha na inserção! Verificar!");
	}
?>

