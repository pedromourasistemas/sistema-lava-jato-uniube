<?php
	include('Conexao.php');
	
	$OrdemServico = $_POST['Id'];
	
	$Sql = "Select S.*, V.Modelo, V.Placa
		    From lavajato.ordensservicos S, lavajato.veiculos V
		    Where S.Veiculo = V.Veiculo and
			   OrdemServico = $OrdemServico";
	
	$Query = mysql_query($Sql);
	
	while($Resultado = mysql_fetch_assoc($Query))
	{
?>		 
          <td>
          	<input style="width:50px;" type="text" readonly="true" id="ordemservico" value="<? echo $Resultado['OrdemServico']; ?>">
          </td>
          <td>
          	<input style="width:150px;" type="text" readonly="true" id="modelo" value="<? echo $Resultado['Modelo']; ?>">
          </td>
          <td>
          	<input style="width:100px;" type="text" readonly="true" id="placa" value="<? echo $Resultado['Placa']; ?>">
          </td>
          <td>
          	<input style="width:160px;" type="text" name="data" id="data"  value="<? echo $Resultado['Data']; ?>">
          </td>
          <td>
          	<input style="width:160px;" type="text" name="hora" id="hora"  value="<? echo $Resultado['Hora']; ?>">
          </td>
          <td>
          	<input style="width:160px;" type="text" name="descricao" id="descricao" value="<? echo utf8_encode($Resultado['Descricao']); ?>">
          </td>
          <td><input type="text" name="valor" id="valor"  value="<? echo $Resultado['Valor']; ?>"></td>
          <td>
            <a href="excluirOrdemServico.php?OrdemServico=<?=$Resultado['OrdemServico']?>">
            <img src="images/delete5.png" alt="delete"></a>
          </td>
          <td>
            <a onClick="salvaDados()" style="cursor:pointer;">
            <img src="images/save4.png" alt="alter"></a>
          </td>
          
          
<?
	}
?>