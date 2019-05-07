<?php
	include('Conexao.php');
	
	$CPF = $_POST['Id'];
	
	$Sql = "Select P.*, C.Cidade, C.Descricao
		    From lavajato.pessoas P, lavajato.cidades C
		    Where P.Cidade = C.Cidade and
			      P.Tipo   = 'F'      and
				       CPF = $CPF";
	
	$Query = mysql_query($Sql);
	
	while($Resultado = mysql_fetch_assoc($Query))
	{
?>		 
          <td width="110px"><? echo $Resultado['CPF']; ?></td>
          <td><input style="width:160px;" type="text" name="nome" id="nome"  value="<? echo utf8_decode($Resultado['Nome']); ?>"></td>
          <td>
          	<input style="width:160px;" type="text" name="endereco" id="endereco"  value="<? echo utf8_decode($Resultado['Endereco']); ?>">					          </td>
          <td>
          	<input style="width:110px;" type="text" name="bairro" id="bairro" value="<? echo utf8_decode($Resultado['Bairro']); ?>">
          </td>
          <td>
          	<input style="width:60px;" type="text" name="numero" id="numero"  value="<? echo $Resultado['Numero']; ?>">
          </td>
          <td>
          	<input style="width:100px;" type="text" name="telefone" id="telefone"  value="<? echo $Resultado['Telefone']; ?>">
          </td>
          <td><input style="width:100px;" type="text" name="celular" id="celular"  value="<? echo $Resultado['Celular']; ?>"></td>
          <td width="160px">
          	<input style="width:100px;" readonly="true" type="text" name="descricaoCidade" id="descricaoCidade"  value="<? echo $Resultado['Descricao']; ?>">
          </td>
          <td><input style="width:50px;" type="text" name="tipo" id="tipo"  value="<? echo $Resultado['Tipo']; ?>"></td>
          <td width="50px">
            <a href="excluirPessoa.php?CPF=<?=$Resultado['CPF']?>"><img src="images/delete5.png" alt="delete"></a>
          </td>
          <td width="50px">
            <a onClick="salvaDados()" style="cursor:pointer;">
            <img src="images/save4.png" alt="alter"></a>
          </td>
          
          <input type="hidden" id="cpf" value="<? echo $Resultado['CPF']; ?>">
          <input type="hidden" id="cidade" value="<? echo $Resultado['Cidade']; ?>">
<?
	}
?>