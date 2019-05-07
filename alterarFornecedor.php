<?php

	include('Conexao.php');
	
	$Codigo   = $_POST['codigo'];
	$Razao    = $_POST['razao'];
	$CPF      = $_POST['cnpj'];
	$Endereco = $_POST['endereco'];
	$Bairro   = $_POST['bairro'];
	$Numero   = $_POST['numero'];
	$Telefone = $_POST['telefone'];
	$Cidade   = $_POST['cidade'];
		
	$Sql = "Update lavajato.fornecedor
			Set FornecedorRazao  = '$Razao',  FornecedorCPFCNPJ = '$CPF',    FornecedorEndereco = '$Endereco', 
			    FornecedorBairro = '$Bairro', FornecedorNumero  = '$Numero', FornecedorTelefone = '$Telefone', 
				FornecedorCidade = '$Cidade'
			Where FornecedorId = '$Codigo'";
	
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