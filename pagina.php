<?php
	include('Conexao.php');
    
	//######### INICIO Pagina��o
	$numreg = 10; // Quantos registros por p�gina vai ser mostrado
	if (!isset($pg)) 
	{
		$pg = 0;
	}
	$inicial = $_GET['pg'] * $numreg; 
	
	//######### FIM dados Pagina��o
	
	// Faz o Select pegando o registro inicial at� a quantidade de registros para p�gina
	$sql = mysql_query("Select S.*, V.Modelo, V.Placa
								 				  From lavajato.ordensservicos S, lavajato.veiculos V
								 				  Where S.Veiculo = V.Veiculo LIMIT $inicial, $numreg");

	// Serve para contar quantos registros voc� tem na seua tabela para fazer a pagina��o
	$sql_conta = mysql_query("Select S.*, V.Modelo, V.Placa
								 				  From lavajato.ordensservicos S, lavajato.veiculos V
								 				  Where S.Veiculo = V.Veiculo");
	
	$quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra pagina��o
	
	include("paginacao.php"); // Chama o arquivo que monta a pagina��o. ex: << anterior 1 2 3 4 5 pr�ximo >>
	
	echo "<br><br>"; // Vai servir s� para dar uma linha de espa�o entre a pagina��o e o conte�do
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