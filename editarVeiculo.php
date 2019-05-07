<?php
	include('Conexao.php');
	
	$Veiculo = $_POST['Veiculo'];
	$Placa   = $_POST['Id'];
	
	$Placa = str_replace("-", "", $Placa);
	
	$Sql = "Select V.*, P.Nome
		    From lavajato.veiculos V, lavajato.pessoas P
		    Where V.CPF = P.CPF and
			      V.Placa = '$Placa'";
			
	//die($Sql);
	
	$Query = mysql_query($Sql);
	
	while($Resultado = mysql_fetch_assoc($Query))
	{
		$PlacaLetras  = substr($Resultado['Placa'], 0, 3);
		$PlacaNumero  = substr($Resultado['Placa'], 3, 4);
		
		$PlacaMascarada = $PlacaLetras .'-'. $PlacaNumero;
?>		           
          <td id="veiculo"><? echo $Resultado['Veiculo']; ?></td>	
          <td><input type="text" name="modelo" id="modelo" value="<? echo utf8_encode($Resultado['Modelo']); ?>">
          <td><? echo $PlacaMascarada ?></td>
          <td><input type="text" name="cor" id="cor" value="<? echo $Resultado['Cor']; ?>"></td>
          <td><input type="text" name="ano" id="ano" value="<? echo $Resultado['Ano']; ?>"></td>	
          <td><? echo $Resultado['Nome']; ?></td>
          <td>
                <a href="excluirVeiculo.php?Veiculo=<?=$Resultado['Veiculo']?>">
                <img src="images/delete5.png" alt="delete"></a>
          </td>
          <td>
            <a onClick="salvaDados(<?=$Resultado['Veiculo'];?>)" style="cursor:pointer;">
            <img src="images/save4.png" alt="alter"></a>
          </td> 
          
          <input type="hidden" name="placa" id="placa" value="<? echo $PlacaMascarada ?>">        
<?
	}
?>