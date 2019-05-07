<!DOCTYPE html>
<HTML>
	<? include('Conexao.php'); ?>
    
	<HEAD>
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    	<TITLE>Relatório de Funcionário</TITLE>	
    </HEAD>
    
    <BODY>
    	<DIV class="figuraCabecalho">
        	<img src="images/cabecalho.png" alt="cabecalho">
        </DIV>
        
        <H1 style="text-align:center;color:#009">RELATÓRIO DE FUNCIONÁRIOS</H1>
        
    	<DIV id="divRelatorioFuncionario">
                <table id="tableReportFuncionario" align="center" style="margin-top:300px"  border="1">
                    <tbody>
                        <tr>
                           <td><b>Nome</b></td>
                           <td><b>CPF</b></td>
                           <td><b>Endereço</b></td>
                           <td><b>Bairro</b></td>
                           <td><b>Telefone</b></td>
                        </tr>
						
						<?
						$Query ="Select *
								 From lavajato.funcionario";

						$Resultado = mysql_query($Query);
						
						while ($Registro = mysql_fetch_array($Resultado)) 
						{
						   ?>
						   <tr>		
							  <td><? echo $Registro['FuncionarioNome']; ?></td>
							  <td><? echo $Registro['FuncionarioCPF']; ?></td>
							  <td><? echo $Registro['FuncionarioEndereco']; ?></td>
                              <td><? echo $Registro['FuncionarioBairro']; ?></td>
                              <td><? echo $Registro['FuncionarioTelefone']; ?></td>
                              <td><a href="#"><img src="images/del.png" alt="delete"></a></td>
                              <td><a href="#"><img src="images/pen.png" alt="alter"></a></td>
						   </tr>
						   <?
						}
						?>
                       
                    </tbody>
                </table> 
        </DIV>
    </BODY>
</HTML>