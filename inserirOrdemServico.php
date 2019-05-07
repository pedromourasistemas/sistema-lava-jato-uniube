<?php

	include('Conexao.php');

	$Placa     = $_POST['nome'];
	$Data    = $_POST['data'];
	$Hora    = $_POST['hora'];
	$Servico = $_POST['servico'];
	
	$RegistroServicos = "Select *
	                     From lavajato.servicos
						 Where Servico = $Servico";
						 
	$Query = mysql_query($RegistroServicos);
	
	$row = mysql_fetch_assoc($Query);						 
						 
	$Valor     = $row['Valor'];	
	$Descricao = $row['Descricao']; 
	
	$Data  = date($Data);
	//$Valor = str_replace(",", ".", $Valor);	
	
	/*******************************************************************************/
	$RegistroVeiculo = "Select *
	                    From lavajato.veiculos
						Where Placa = '$Placa'";	
						
	$QueryVeiculo = mysql_query($RegistroVeiculo);	
	
	$row = mysql_fetch_assoc($QueryVeiculo);	
	
	$Veiculo = $row['Veiculo'];
	
	/*******************************************************************************/			
	$Sql = "Insert Into 
	  		lavajato.ordensservicos(Veiculo, Data, Hora, Descricao, Valor, Servico)
		    Values($Veiculo, '$Data', '$Hora', '$Descricao', $Valor, $Servico)";
	
	$Query = mysql_query($Sql);
		
	if($Query)	
	{
		echo '<script>
				 alert("Ordem de Serviço inserida com sucesso!");
		      </script>
			  
			  <meta http-equiv="refresh" content="0;url= OrdemServico.php">';		
	}
	else
	{
		echo '<script>
				 alert("Falha na inserção! Verificar!");
		      </script>
			  
			  <meta http-equiv="refresh" content="0;url= OrdemServico.php">';
	}
?>