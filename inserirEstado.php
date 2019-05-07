<?php
	include('Conexao.php');

	$UF        = $_POST['UF'];
	$Descricao = $_POST['Descricao'];
	
	$Validacao = "SELECT *
	              FROM lavajato.estados
				  WHERE UF        = '$UF' and
				        Descricao = '$Descricao'";
				  
	$QueryValidacao = mysql_query($Validacao);	
	
	if(mysql_num_rows($QueryValidacao) > 0)
	{
		echo utf8_encode("3|Não foi possível inserir. Estado já cadastrado no sistema!");
	}
	else
	{	
		$Sql = "Insert Into 
				lavajato.estados(UF, Descricao)
				Values('$UF', '$Descricao')";
		
		$Query = mysql_query($Sql);
			
		if($Query)	
		{
			echo utf8_encode("1|Estado inserido com sucesso!");		
		}
		else
		{
			echo utf8_encode("2|Falha na inserção! Verificar!");
		}
	}
?>

