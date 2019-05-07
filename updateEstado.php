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
    	<TITLE>Alteração de Estados</TITLE>	
        
        <script language="javascript" type="text/javascript"> 
			function validarCampos() 
			{
				var UF        = document.forms["Estado"]["uf"].value;				
				var Descricao = document.forms["Estado"]["descricao"].value;
				
				if(UF == "")
				{
					alert('Informe a Sigla!'); 
					Estado.uf.focus(); 
					return false;
				}
				
				if(Descricao == "")
				{
					alert('Informe a Descrição!'); 
					Estado.descricao.focus(); 
					return false;
				}	
			} 
        </script>
        
    </HEAD>
    
    <BODY>
    	<DIV class="figuraCabecalho">
        	<img src="images/Logo/Logo.png">
        </DIV>
        
        <H1 style="text-align:center;color:#009">CADASTRO DE ESTADOS</H1>
        
        <?
			$UF = $_GET['UF'];
			
			$Query ="Select *
					 From lavajato.estados
					 Where UF = '$UF' ";	 

			$Resultado = mysql_query($Query);
			
			$Registro = mysql_fetch_array($Resultado);
        ?>
                
    	<DIV id="divEstado">
            <FORM id="Estado" action="alterarEstado.php" method="get">
            	<div class="row">
                	<label  for="sigla" class="labelEstado">Sigla:</label>
                    <input type="text" name="uf" value="<?=$Registro['UF']?>" class="largeEstado" maxlength="2">
                </div>
                
                <div class="row">
                	<label  for="descricao" class="labelEstado">Descrição:</label>
                    <input type="text" name="descricao" value="<?=$Registro['Descricao']?>" class="largeEstado" maxlength="40">
                </div>
                
                <!-- ********************************************************************************************** -->
                
                <div class="row">
                	<button type="submit" name="cadastrarEstado" id="cadastrarEstado" onClick="return validarCampos()">Salvar</button>
                    <button type="reset" name="clearEstado" id="clearEstado">Limpar</button>
                </div>       
            </FORM>
        </DIV>
        
        <DIV id="returnEstado">
        	<a href="RelatorioEstado.php"><input type="image" src="images/return4.png"></a>
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