<?php
	include('Conexao.php');
	
	$UF = $_POST['Id'];
	
	$Sql = "SELECT *
	        FROM lavajato.estados
			WHERE UF = '$UF'";
			
	//die($Sql);
	
	$Query = mysql_query($Sql);
	
	while($Resultado = mysql_fetch_assoc($Query))
	{
?>		 
          <td><?= $Resultado['UF']; ?></td>
          <td><input type="text" name="descricao" id="descricao" value="<? echo utf8_encode($Resultado['Descricao']); ?>"></td>          
          <td>
            <a href="excluirEstado.php?UF=<?=$Resultado['UF']?>">
            <img src="images/delete5.png" alt="delete"></a>
          </td>
          <td>
            <a onClick="salvaDados()" style="cursor:pointer;">
            <img src="images/save4.png" alt="alter"></a>
          </td> 
          
          <input type="hidden" id="uf" value="<? echo $Resultado['UF']; ?>">           
<?
	}
?>