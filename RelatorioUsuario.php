<!DOCTYPE html>
<HTML>
	<? include('Conexao.php'); ?>
    
	<HEAD>
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    	<TITLE>Relat�rio de Usu�rio</TITLE>	
    </HEAD>
    
    <BODY>
    	<DIV class="figuraCabecalho">
        	<img src="images/cabecalho.png" alt="cabecalho">
        </DIV>
        
        <H1 style="text-align:center;color:#009">RELAT�RIO DE USU�RIOS</H1>
        
    	<DIV id="divRelatorioUsuario">
                <table id="tableReportUsuario" align="center" style="margin-top:300px"  border="1">
                    <tbody>
                        <tr>
                           <td><b>Login</b></td>
                           <td><b>Funcion�rio</b></td>
                        </tr>
						
						<?
						$Query ="Select *
								 From lavajato.usuario";

						$Resultado = mysql_query($Query);
						
						while ($Registro = mysql_fetch_array($Resultado)) 
						{
						   ?>
						   <tr>		
							  <td><? echo $Registro['UsuarioLogin']; ?></td>
							  <td><? echo $Registro['FuncionarioId']; ?></td>
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