<?	
	session_start(); 
	date_default_timezone_set("Brazil/East");
	
	if((!isset ($_SESSION['cpf']) == true) and (!isset ($_SESSION['senha']) == true)) 
	{ 
		unset($_SESSION['cpf']); 
		unset($_SESSION['senha']); 
		echo '<script>
				 alert("Faça o Login para acessar o Sistema!!");
		      </script>
			  
			  <meta http-equiv="refresh" content="0;url= Home.php">';
	} 
	
	$logado      = $_SESSION['cpf'];
	$NomeUsuario = $_SESSION['nome'];
	$DataAtual   = date("d/m/Y");
	$HoraAtual   = date("H:i:s");	
?>
<!DOCTYPE html>
<HTML>
	
    <? include('Conexao.php'); ?>
    
	<HEAD>
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    	<TITLE>Alteração de Serviços</TITLE>
        
        <script language="javascript" type="text/javascript"> 
			function validarCampos()
			{
				var Descricao = document.forms["alteraServico"]["descricao"].value; 
				var Valor     = document.forms["alteraServico"]["valor"].value;
				
				if(Descricao == "")
				{
					alert('Informe a Descrição!'); 
					alteraServico.descricao.focus(); 
					return false;
				}
				
				if(Valor == "")
				{
					alert('Informe o Valor!'); 
					alteraServico.valor.focus(); 
					return false;
				}
			}
		</script>	
    </HEAD>
    
    <BODY>
    	<DIV class="figuraCabecalho">
        	<img src="images/Logo/Logo.png">
        </DIV>
        
        <H1 style="text-align:center;color:#009">CADASTRO DE SERVIÇOS</H1>
        
        <?
			$Servico = $_GET['Servico'];
			
			$Query ="Select *
					 From lavajato.servicos
					 Where Servico = '$Servico' ";	 

			$Resultado = mysql_query($Query);
			
			$Registro = mysql_fetch_array($Resultado);
        ?>
                
    	<DIV id="divServico">
            <FORM id="alteraServico" action="alterarServico.php" method="get">    
            	<div class="row">
                    <input type="text" hidden="true" name="servico" class="largeValor" value="<?=$Registro['Servico']?>" id="valor">
                </div>
                        	
            	<div class="row">
                    <label for="descricao" class="labelServico">Descrição:</label>
                    <input type="text" name="descricao" id="descricao" class="largeServico" 
                           value="<?=$Registro['Descricao']?>" maxlength="30"> 
                </div> 
                
                <div class="row">
                    <label for="servico" class="labelServico">Valor: R$</label>
                    <input type="text" name="valor" class="largeValor" value="<?=$Registro['Valor']?>" id="valor">
                </div> 
                
                <!-- ************************************************************************* -->
                
                <div class="row">
                    <button type="submit" name="cadastrarServico" id="cadastrarServico" onClick="return validarCampos()">Salvar</button>
                    <button type="reset" name="clearServico" id="clearServico">Limpar</button>
                </div>        
            </FORM>
        </DIV>
        
        <DIV id="returnServico">
        	<a href="RelatorioServico.php"><input type="image" src="images/return4.png"></a>
        </DIV>
        
        <div id="informacaoUsuario">
        	<P id="textoUsuario">
            	<b>Usuário Logado|</b> <?= $NomeUsuario ?> <b>| Data:</b> <?= $DataAtual ?> <b>| Hora:</b> <?= $HoraAtual ?>
            </P>
        </div>
        
        <DIV id="figuraRodape">
            <? include('Rodape.php'); ?>
        </DIV>
    </BODY>
</HTML>