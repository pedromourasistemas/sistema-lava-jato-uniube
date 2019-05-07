<?php

	include('Conexao.php');
	
	$CPF      = $_POST['CPF'];
	$Nome     = $_POST['Nome'];	
	$Endereco = $_POST['Endereco'];
	$Bairro   = $_POST['Bairro'];
	$Numero   = $_POST['Numero'];
	$Cidade   = $_POST['Cidade'];	
	$Telefone = $_POST['Telefone'];
	$Celular  = $_POST['Celular'];
	$Tipo     = $_POST['Tipo'];
	$Senha    = $_POST['Senha'];
	
	$CPF = str_replace(".", "", $CPF);
	$CPF = str_replace("-", "", $CPF);	
	
	$Telefone = str_replace("-", "", $Telefone);	
	$Telefone = str_replace("(", "", $Telefone);
	$Telefone = str_replace(")", "", $Telefone);
	
	$Celular = str_replace("-", "", $Celular);	
	$Celular = str_replace("(", "", $Celular);
	$Celular = str_replace(")", "", $Celular);
	
	$Validacao = "SELECT *
	              FROM lavajato.pessoas
				  WHERE CPF = $CPF";
				  
	$QueryValidacao = mysql_query($Validacao);	
	
	if(mysql_num_rows($QueryValidacao) > 0)
	{
		echo utf8_encode("3|Nгo foi possнvel inserir. Pessoa jб cadastrada no sistema!");
	}
	else
	{							
		$Sql = "Insert Into 
				lavajato.pessoas(CPF,   Nome,  Endereco, Bairro, Numero, Telefone, Celular, Cidade, Tipo, Senha)
				Values($CPF, '$Nome', '$Endereco', '$Bairro', $Numero, '$Telefone', '$Celular', $Cidade, '$Tipo', '$Senha')";
		
		$Query = mysql_query($Sql);	
			
		if($Query)	
		{
			echo utf8_encode("1|Pessoa cadastrada com sucesso!");		
		}
		else
		{
			echo utf8_encode("2|Falha na inserзгo! Verificar!");
		}
	}
?>