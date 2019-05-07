<?php

	include('Conexao.php');
	
	$Codigo   = $_POST['codigo'];
	$Nome     = $_POST['nome'];
	$CPF      = $_POST['cpf'];
	$Endereco = $_POST['endereco'];
	$Bairro   = $_POST['bairro'];
	$Numero   = $_POST['numero'];
	$Telefone = $_POST['telefone'];
	$Cidade   = $_POST['cidade'];
		
	$Sql = "Update lavajato.cliente
			Set ClienteNome   = '$Nome',   ClienteCPFCNPJ = '$CPF',    ClienteEndereco = '$Endereco', 
			    ClienteBairro = '$Bairro', ClienteNumero  = '$Numero', ClienteTelefone = '$Telefone', 
				ClienteCidade = '$Cidade'
			Where ClienteId = '$Codigo'";
	
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