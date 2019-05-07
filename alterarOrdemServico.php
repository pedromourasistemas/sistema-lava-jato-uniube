<?php
	include('Conexao.php');
	
	$OrdemServico = $_GET['ordemservico'];
	$Veiculo      = $_GET['veiculo'];	
	$Data         = $_GET['data'];	
	$Hora         = $_GET['hora'];
	$Servico      = $_GET['servico'];
	
	$Data = implode("-",array_reverse(explode("/", $_GET['data'])));
		
	$Sql = "Update lavajato.ordensservicos
			Set Veiculo = $Veiculo, Data = '$Data', Hora = '$Hora', Servico = '$Servico'
			Where OrdemServico = $OrdemServico ";
	
	$Query = mysql_query($Sql);
	
	if($Query)	
	{
		echo '<script>
				 alert("Alteração salva com sucesso!");
		      </script>
			  
			  <meta http-equiv="refresh" content="0;url= MenuRelatorios.php">';		
	}
	else
	{
		echo '<script>
				 alert("Falha na alteração! Verificar!");
		      </script>
			  
			  <meta http-equiv="refresh" content="0;url= MenuRelatorios.php">';
	}
?>