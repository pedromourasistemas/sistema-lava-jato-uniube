<?php

	$conexao = mysql_connect('localhost', 'root', 'vertrigo');

	mysql_set_charset('ISO-8859-1', $conexao);

	if (!$conexao) 
	{
		die('Conex�o n�o p�de ser conclu�da! ' . mysql_error());
	} 
	else 
	{
		//echo ('Conex�o bem sucedida.');	
	}
	
?>





