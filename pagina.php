<?php
	include('Conexao.php');
    
	//######### INICIO Paginação
	$numreg = 10; // Quantos registros por página vai ser mostrado
	if (!isset($pg)) 
	{
		$pg = 0;
	}
	$inicial = $_GET['pg'] * $numreg; 
	
	//######### FIM dados Paginação
	
	// Faz o Select pegando o registro inicial até a quantidade de registros para página
	$sql = mysql_query("Select S.*, V.Modelo, V.Placa
								 				  From lavajato.ordensservicos S, lavajato.veiculos V
								 				  Where S.Veiculo = V.Veiculo LIMIT $inicial, $numreg");

	// Serve para contar quantos registros você tem na seua tabela para fazer a paginação
	$sql_conta = mysql_query("Select S.*, V.Modelo, V.Placa
								 				  From lavajato.ordensservicos S, lavajato.veiculos V
								 				  Where S.Veiculo = V.Veiculo");
	
	$quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação
	
	include("paginacao.php"); // Chama o arquivo que monta a paginação. ex: << anterior 1 2 3 4 5 próximo >>
	
	echo "<br><br>"; // Vai servir só para dar uma linha de espaço entre a paginação e o conteúdo
	?>
	<table id="tableReportOrdemServico" align="center" style="margin-top:300px;"  border="1">
    	<tbody>
	<?		
	while ($aux = mysql_fetch_array($sql))
	{?>		                    				
           <tr>	
              <td><? echo $aux['OrdemServico']; ?></td>	
              <td><? echo $aux['Modelo']; ?></td>
           </tr>                      
	<? } ?>
    	</tbody>
   	</table> <?
?>