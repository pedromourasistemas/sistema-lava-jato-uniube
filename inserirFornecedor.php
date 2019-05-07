<?php

	include('Conexao.php');

	$Razao    = $_POST['razao'];
	$CPF      = $_POST['cnpj'];
	$Endereco = $_POST['endereco'];
	$Bairro   = $_POST['bairro'];
	$Numero   = $_POST['numero'];
	$Telefone = $_POST['telefone'];
	$Cidade   = $_POST['cidade'];	
	
	$_SESSION['usuario'] = $Usuario;
	$_SESSION['senha']   = $Senha;
	
	$Sql = "Insert Into 
	  		lavajato.fornecedor(FornecedorRazao,  FornecedorCPFCNPJ,  FornecedorEndereco,
			                    FornecedorBairro, FornecedorNumero, FornecedorTelefone, FornecedorCidade)
		    Values('$Razao', '$CPF', '$Endereco', '$Bairro', '$Numero', '$Telefone', '$Cidade')";
	
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

