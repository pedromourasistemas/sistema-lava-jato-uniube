<?php

	include('Conexao.php');

	$Codigo  = $_POST['codigo'];
		
	$Sql = "Delete 
			From lavajato.usuario 
			Where UsuarioId = $Codigo";
	
	$Query = mysql_query($Sql);
	
	$Result = mysql_fetch_assoc($Query);
		
	if(empty($Result))
	{
		//echo "Conectado com Sucesso!";
		header("Location: MenuTelas.php");
	}
	else
	{
		
	}
?>