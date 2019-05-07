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
	
	/*$CPF = str_replace(".", "", $CPF);
	$CPF = str_replace("-", "", $CPF);	
	
	$Telefone = str_replace("-", "", $Telefone);	
	$Telefone = str_replace("(", "", $Telefone);
	$Telefone = str_replace(")", "", $Telefone);
	
	$Celular = str_replace("-", "", $Celular);	
	$Celular = str_replace("(", "", $Celular);
	$Celular = str_replace(")", "", $Celular);*/
		
	$Sql = "Update lavajato.pessoas
			Set Nome = '$Nome', Endereco = '$Endereco', 
			    Bairro = '$Bairro', Numero = '$Numero', Cidade = '$Cidade',
				Telefone = '$Telefone', Celular = '$Celular', Tipo = '$Tipo',
				Senha = '$Senha'			
			Where CPF = $CPF ";
			
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