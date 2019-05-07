<?php

	include('Conexao.php');
	
	$Codigo   = $_POST['codigo'];
	$Nome     = $_POST['nome'];
	$CPF      = $_POST['cpf'];
	$Endereco = $_POST['endereco'];
	$Bairro   = $_POST['bairro'];	
	$Telefone = $_POST['telefone'];
		
	$Sql = "Update lavajato.funcionario
			Set FuncionarioNome   = '$Nome',        FuncionarioCPF = '$CPF', FuncionarioEndereco = '$Endereco', 
			    FuncionarioBairro = '$Bairro', FuncionarioTelefone = '$Telefone'
			Where FuncionarioId = '$Codigo'";
	
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