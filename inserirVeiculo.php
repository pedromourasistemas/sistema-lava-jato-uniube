<?php
	include('Conexao.php');

	$CPF    = $_POST['Cliente'];
	$Modelo = $_POST['Modelo'];
	$Placa  = $_POST['Placa'];
	$Cor    = $_POST['Cor'];
	$Ano    = $_POST['Ano'];	
	
	$Placa = str_replace("-", "", $Placa);
	
	$Validacao = "SELECT *
	              FROM lavajato.veiculos
				  WHERE CPF   = $CPF and
				        Placa = '$Placa'";
										  
	$QueryValidacao = mysql_query($Validacao);	
	
	if(mysql_num_rows($QueryValidacao) > 0)
	{
		echo utf8_encode("3|N�o foi poss�vel inserir. Ve�culo j� cadastrado no sistema!");
	}
	else
	{	
		$Sql = "Insert Into 
				lavajato.veiculos(CPF, Modelo,  Placa, Cor, Ano)
				Values($CPF, '$Modelo', '$Placa', '$Cor', '$Ano')";
		
		$Query = mysql_query($Sql);
			
		if($Query)	
		{
			echo utf8_encode("1|Ve�culo cadastrado com sucesso!");		
		}
		else
		{
			echo utf8_encode("2|Falha na inser��o! Verificar!");
		}
	}
?>

