<!DOCTYPE html>
<HTML>
	<HEAD>
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="icon" type="image/ico" href="images/login2.ico" />
    	<TITLE>Login</TITLE>
        
        <script language='JavaScript'>
			function SomenteNumero(e)
			{
				var tecla = (window.event)?event.keyCode:e.which;
				   
				if((tecla>47 && tecla<58)) return true;
				else
				{
					if (tecla==8 || tecla==0) return true;
				else  
					return false;
				}
			}
		</script>	
    </HEAD>
    
    <BODY>
    	<DIV class="figuraCabecalho">
        	<img src="images/Logo/Logo.png">
        </DIV>
        
    	<DIV id="divLogin">
        	<FORM action="autenticacaoLogin.php" method="post">
                <div class="row">
                    <label for="cpf" class="labelLogin">CPF:</label>
                    <input type="text" name="cpf" id="cpf" class="largeLogin" maxlength="11"> 
                    <label for="info" class="SomenteNumero">* Somente números:</label>
                </div>
                
                <div class="row">
                    <label for="senha" class="labelLogin">Senha:</label>
                    <input type="password" name="senha" id="senha" class="largeLogin" maxlength="16"> 
                </div>
                
                <!-- ********************************************************************************************** -->
                
                <div class="row">
                    <button type="submit" name="Entrarlogin" id="Entrarlogin" onKeyPress="return SomenteNumero(event)">Entrar</button>
                    <button type="reset" name="clearLogin" id="clearLogin">Limpar</button>
                </div>
            </FORM>        	
        </DIV>
        
         <DIV class="figuraLogin">
        	<img src="images/login5.png" alt="cadastro">
        </DIV>    
        
        <DIV id="figuraRodape">
        	<? include('Rodape.php'); ?>             
        </DIV> 
    </BODY>
</HTML>