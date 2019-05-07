<?php

	include('Conexao.php');

	$Nome     = $_POST['nome'];
	$CPF      = $_POST['cpf'];
	$Endereco = $_POST['endereco'];
	$Bairro   = $_POST['bairro'];
	$Numero   = $_POST['numero'];
	$Telefone = $_POST['telefone'];
	$Cidade   = $_POST['cidade'];
		
	$Sql = "Insert Into 
	  		lavajato.cliente(ClienteNome,   ClienteCPFCNPJ,  ClienteEndereco,
			                 ClienteBairro, ClienteNumero, ClienteTelefone, ClienteCidade)
		    Values('$Nome', '$CPF', '$Endereco', '$Bairro', '$Numero', '$Telefone', '$Cidade')";
	
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