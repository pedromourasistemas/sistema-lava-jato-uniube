<?php

	include('Conexao.php');

	$Nome     = $_POST['nome'];
	$CPF      = $_POST['cpf'];
	$Endereco = $_POST['endereco'];
	$Bairro   = $_POST['bairro'];	
	$Telefone = $_POST['telefone'];
	
	$_SESSION['usuario'] = $Usuario;
	$_SESSION['senha']   = $Senha;
	
	$Sql = "Insert Into 
	  		lavajato.funcionario(FuncionarioId, FuncionarioNome, FuncionarioCPF,  FuncionarioEndereco,
			                     FuncionarioBairro, FuncionarioTelefone)
		    Values(01, '$Nome', '$CPF', '$Endereco', '$Bairro', '$Telefone')";
	
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

