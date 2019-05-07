<?php

	include('Conexao.php');
	
	session_start();

	$CPF   = $_POST['cpf'];
	$Senha = $_POST['senha'];
	
	$Sql = "Select * 
		    From lavajato.pessoas
		    Where CPF   = $CPF and
		          Senha = '$Senha' ";
	
	$Query = mysql_query($Sql);
	
	$Result = mysql_fetch_assoc($Query);
	
	if($Result)	
	{
		$_SESSION['cpf']   = $CPF;
		$_SESSION['senha'] = $Senha;
		$_SESSION['nome']  = $Result['Nome'];
		
		//Direcionando para Menu Principal
		header("Location: MenuHome.php");			
	}
	else
	{
		unset ($_SESSION['cpf']);
		unset ($_SESSION['senha']);			
		echo '<script>
				 alert("Usuário e/ou senha inválido(s)!");
		      </script>
			  
			  <meta http-equiv="refresh" content="0;url= Home.php">';		
	}
?>