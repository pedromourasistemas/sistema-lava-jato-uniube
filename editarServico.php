<?php
	include('Conexao.php');
	
	$Servico = $_POST['Id'];
	
	$Sql = "SELECT *
	        FROM lavajato.servicos
			WHERE Servico = $Servico";
	
	$Query = mysql_query($Sql);
	
	while($Resultado = mysql_fetch_assoc($Query))
	{
?>		 
          <td><? echo $Resultado['Servico']; ?></td>
          <td><input type="text" name="descricao" id="descricao" value="<? echo utf8_encode($Resultado['Descricao']); ?>"></td>
          <td><input type="text" name="valor" id="valor"  value="<? echo $Resultado['Valor']; ?>"></td>
          <td>
            <a href="excluirServico.php?Servico=<?=$Resultado['Servico']?>">
            <img src="images/delete5.png" alt="delete"></a>
          </td>
          <td>
            <a onClick="salvaDados()" style="cursor:pointer;">
            <img src="images/save4.png" alt="alter"></a>
          </td>
          
          <input type="hidden" id="servico" value="<? echo $Resultado['Servico']; ?>">
<?
	}
?>