<!DOCTYPE html>
<HTML>
	<? include('Conexao.php'); ?>
    
	<HEAD>
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    	<TITLE>Relatório de Pessoas</TITLE>	
    </HEAD>
    
    <BODY>
    	<DIV class="figuraCabecalho">
        	<img src="images/cabecalho.png" alt="cabecalho">
        </DIV>
        
        <H1 style="text-align:center;color:#009">RELATÓRIO DE PESSOAS</H1>
        
    	<DIV id="divRelatorioPessoa">
        	<FORM action="excluirPessoa.php" method="get">
                <table id="tableReportPessoa" align="center" style="margin-top:300px"  border="1">
                    <tbody>
                        <tr id="titulosPessoa">
	                       <td><b>CPF</b></td>
                           <td><b>Nome</b></td>                           
                           <td><b>Endereço</b></td>
                           <td><b>Bairro</b></td>
                           <td><b>Número</b></td>                           
                           <td><b>Telefone</b></td>
                           <td><b>Celular</b></td>
                           <td><b>Cidade</b></td>
                           <td><b>Tipo</b></td>
                           <td><b>Excluir</b></td>
                           <td><b>Alterar</b></td>
                        </tr>
						
						<?
						$Query ="Select *
								 From lavajato.pessoas";

						$Resultado = mysql_query($Query);
						
						while ($Registro = mysql_fetch_array($Resultado)) 
						{
						   ?>
						   <tr>		
                        	  <td><? echo $Registro['CPF']; ?></td>
							  <td><? echo $Registro['Nome']; ?></td>
							  <td><? echo $Registro['Endereco']; ?></td>
							  <td><? echo $Registro['Bairro']; ?></td>
                              <td><? echo $Registro['Numero']; ?></td>
                              <td><? echo $Registro['Telefone']; ?></td>
                              <td><? echo $Registro['Celular']; ?></td>
                              <td><? echo $Registro['Cidade']; ?></td>
                              <td><? echo $Registro['Tipo']; ?></td>
                              <td><a href="excluirPessoa.php?CPF=<?=$Registro['CPF']?>"><img src="images/del.png" alt="delete"></a></td>
                              <td><a href="updatePessoa.php?CPF=<?=$Registro['CPF']?>"><img src="images/pen.png" alt="alter"></a></td>
						   </tr>
						   <?
						}
						?>
                       
                    </tbody>
                </table> 
            </FORM>
        </DIV>
    </BODY>
</HTML>