<?php
	include('Conexao.php');
	
	if(!empty($_GET["valor"]))
	{ 
		// EXECUTA A INSTRUÇÃO SELECT PASSANDO O QUE O USUARIO DIGITOU
		$Sql = "Select V.*, P.Nome, P.CPF 
				From lavajato.veiculos V, lavajato.pessoas P
				Where V.CPF = P.CPF and 
				      P.Nome Like '%$_GET[valor]%'";
				
		$Resultado = mysql_query($Sql) or die (mysql_error());
		 
		//VERIFICA A QUANTIDADE DE REGISTROS RETORNADOS
		$Linhas = mysql_num_rows($Resultado);
		 
		if($Linhas > 0)
		{
			//EXECUTA UM LOOP PARA MOSTRAR OS NOMES DAS PESSOAS
			// VALE LEMBRAR QUE TODOS ESSES RESULTADOS SERAO MOSTRADOS DENTRO DA PAGINA INDEX.PHP
			// DENTRO DO DIV 'PAGINA'			
			//echo "Nome - CPF - Placa <br>";
			echo '<table>';
			echo '<tr>';					
			echo 	'<td style="font-weight:bold;color:#009;">Nome</td>';
			echo 	'<td style="font-weight:bold;color:#009;">CPF</td>';
			echo 	'<td style="font-weight:bold;color:#009;">Placa <br> </td>';
			echo '</tr>';	
								 
			while($Row = mysql_fetch_array($Resultado))
			{?>
				<tr style="cursor:pointer;" onClick="preencherText('<?= $Row['CPF'] ?>')">					
				<td style="font-weight:bold;color:#000;"><?= $Row['Nome'] ?></td>
				<td style="font-weight:bold;color:#000;"><?= $Row['CPF'] ?></td>
				<td style="font-weight:bold;color:#000;"><?= $Row['Placa'] ?><br> </td>
				</tr>
            <?			
			}
			echo '</table>';
		}
		 
	}
?> 