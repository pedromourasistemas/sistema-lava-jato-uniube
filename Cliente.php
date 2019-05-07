<!DOCTYPE html>
<HTML>
	<HEAD>
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    	<TITLE>Cadastro de Cliente</TITLE>	
    </HEAD>
    
    <BODY>
    	<DIV class="figuraCabecalho">
        	<img src="images/cabecalho.png" alt="cabecalho">
        </DIV>
        
        <H1 style="text-align:center;color:#009">CADASTRO DE CLIENTE</H1>
        
    	<DIV id="divCliente">
            <FORM action="inserirCliente.php" method="post">
                <table id="tableCliente" align="center" style="margin-top:300px">
                    <tbody>
                        <tr>
                            <td align="left" style="font-weight:bold;color:#FFF;">Nome:</td>
                            <td align="right"><input type="text" name="nome" id="nome" maxlength="40"></td>
                        </tr>
                        
                        <tr>
                            <td align="left" style="font-weight:bold; color:#FFF;">CPF:</td>
                            <td align="right"><input type="text" name="cpf" id="cpf" maxlength="15"></td>
                        </tr> 
                        
                        <tr>
                            <td align="left" style="font-weight:bold; color:#FFF;">Endereço:</td>
                            <td align="right"><input type="text" name="endereco" id="endereco" maxlength="40"></td>
                        </tr>
                        
                        <tr>
                            <td align="left" style="font-weight:bold; color:#FFF;">Bairro:</td>
                            <td align="right"><input type="text" name="bairro" id="bairro" maxlength="30"></td>
                        </tr>
                        
                        <tr>
                            <td align="left" style="font-weight:bold; color:#FFF;">Número:</td>
                            <td align="right"><input type="text" name="numero" id="numero" maxlength="10"></td>
                        </tr>
                        
                        <tr>
                            <td align="left" style="font-weight:bold; color:#FFF;">Cidade:</td>
                            <td align="right"><input type="text" name="cidade" id="cidade" maxlength="30"></td>
                        </tr>
                        
                        <tr>
                            <td align="left" style="font-weight:bold; color:#FFF;">Telefone:</td>
                            <td align="right"><input type="text" name="telefone" id="telefone" maxlength="10"></td>
                        </tr>
                        
                        <tr>
                            <td colspan="3" align="right"><button type="submit" name="login" id="login">Cadastrar</button></td>
                            <td colspan="3" align="right"><button type="reset" name="login" id="login">Limpar</button></td>
                        </tr>
                    </tbody>
                </table>            
            </FORM>
        </DIV>
    </BODY>
</HTML>