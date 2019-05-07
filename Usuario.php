<!DOCTYPE html>
<HTML>
	<HEAD>
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    	<TITLE>Cadastro de Usuário</TITLE>	
    </HEAD>
    
    <BODY>
    	<DIV class="figuraCabecalho">
        	<img src="images/cabecalho.png" alt="cabecalho">
        </DIV>
        
        <H1 style="text-align:center;color:#009">CADASTRO DE USUÁRIO</H1>
        
    	<DIV id="divUsuario">
            <FORM action="inserirUsuario.php" method="post">
                <table id="tableUsuario" align="center" style="margin-top:300px">
                    <tbody>
                        <tr>
                            <td align="left" style="font-weight:bold;color:#FFF;">Login:</td>
                            <td align="right"><input type="text" name="login" id="login" maxlength="40"></td>
                        </tr>
                        
                        <tr>
                            <td align="left" style="font-weight:bold; color:#FFF;">Senha:</td>
                            <td align="right"><input type="password" name="senha" id="senha" maxlength="10"></td>
                        </tr> 
                        
                        <tr>
                            <td align="left" style="font-weight:bold; color:#FFF;">Funcionário:</td>
                            <td align="right"><input type="text" name="funcionario" id="funcionario" maxlength="10"></td>
                        </tr>                        
                        
                        <tr>
                            <td colspan="3" align="right"><button type="submit" name="cadastrar" id="cadastrar">Cadastrar</button></td>
                            <td colspan="3" align="right"><button type="reset" name="limpar" id="limpar">Limpar</button></td>
                        </tr>
                    </tbody>
                </table>            
            </FORM>
        </DIV>
    </BODY>
</HTML>