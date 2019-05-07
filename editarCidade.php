<?php
	include('Conexao.php');
	
	$Cidade = $_POST['Id'];
	
	$Sql = "SELECT *
	        FROM lavajato.cidades
			WHERE Cidade = $Cidade";
	
	$Query = mysql_query($Sql);
	
	while($Resultado = mysql_fetch_assoc($Query))
	{
?>		 
          <td><? echo $Resultado['Cidade']; ?></td>
          <td><input type="text" name="descricao" id="descricao" value="<? echo utf8_encode($Resultado['Descricao']); ?>"></td>
          <td><input type="text" name="uf" id="uf"  value="<? echo $Resultado['UF']; ?>"></td>
          <td>
            <a href="excluirCidade.php?Cidade=<?=$Resultado["Cidade"]?>">
            <img src="images/delete5.png" alt="delete"></a>
          </td>
          <td>
            <a onClick="salvaDados()" style="cursor:pointer;">
            <img src="images/save4.png" alt="alter"></a>
          </td>
          
          <input type="hidden" id="cidade" value="<? echo $Resultado['Cidade']; ?>">
<?
	}
?>