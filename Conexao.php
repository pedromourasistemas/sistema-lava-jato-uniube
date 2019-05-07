<?php

	$conexao = mysql_connect('localhost', 'root', 'vertrigo');

	mysql_set_charset('ISO-8859-1', $conexao);

	if (!$conexao) 
	{
		die('Conexão não pôde ser concluída! ' . mysql_error());
	} 
	else 
	{
		//echo ('Conexão bem sucedida.');	
	}
	
?>





