<?php
	include('Conexao.php');
	
	$Servico   = $_POST['Servico'];
	$Descricao = $_POST['Descricao']; 
	$Valor     = $_POST['Valor']; 
	
	$Valor = str_replace(",", ".", $Valor);
		
	$Sql = "Update lavajato.servicos
			Set Descricao = '$Descricao', Valor = $Valor  
			Where Servico = '$Servico' ";
	
	$Query = mysql_query($Sql);
	
	if($Query)	
	{
		echo utf8_encode("1|Alteração salva com sucesso!");		
	}
	else
	{
		echo utf8_encode("2|Falha na alteração! Verificar!");
	}
?>