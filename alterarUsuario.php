<?php

	include('Conexao.php');
	
	$Codigo   = $_POST['codigo'];
	$Login       = $_POST['login'];
	$Senha       = $_POST['senha'];
	$Funcionario = $_POST['funcionario'];
		
	$Sql = "Update lavajato.usuario
			Set UsuarioLogin = '$Login', UsuarioSenha = '$Senha', FuncionarioId = '$Funcionario'
			Where UsuarioId = '$Codigo'";
	
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