<?php

	include('Conexao.php');

	$Login       = $_POST['login'];
	$Senha       = $_POST['senha'];
	$Funcionario = $_POST['funcionario'];
	
	//$_SESSION['usuario'] = $Usuario;
	//$_SESSION['senha']   = $Senha;
	
	$Sql = "Insert Into 
	  		lavajato.usuario(UsuarioLogin, UsuarioSenha,  FuncionarioId)
		    Values('$Login', '$Senha', $Funcionario)";
	
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

