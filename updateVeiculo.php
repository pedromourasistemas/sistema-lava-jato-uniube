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
        <script src="js/jquery-2.1.0.js" type="text/javascript"> </script>
        <script src="js/jquery.maskedinput.js" type="text/javascript"> </script>
    	<TITLE>Alteração de Veículos</TITLE>	
        
        <script language="javascript" type="text/javascript"> 
			function validarCampos() 
			{
				var Cliente = document.forms["Veiculo"]["cliente"].value;				
				var Modelo  = document.forms["Veiculo"]["modelo"].value;
				var Placa   = document.forms["Veiculo"]["placa"].value;
				var Cor     = document.forms["Veiculo"]["cor"].value;
				var Ano     = document.forms["Veiculo"]["ano"].value;
				
				if(Cliente == "")
				{
					alert('Informe o Cliente!'); 
					Veiculo.cliente.focus(); 
					return false;
				}
				
				if(Modelo == "")
				{
					alert('Informe o Modelo!'); 
					Veiculo.modelo.focus(); 
					return false;
				}
				
				if(Placa == "")
				{
					alert('Informe a Placa!'); 
					Veiculo.placa.focus(); 
					return false;
				}
				
				if(Cor == "")
				{
					alert('Informe a Cor!'); 
					Veiculo.cor.focus(); 
					return false;
				}
				
				if(Ano == "")
				{
					alert('Informe o Ano!'); 
					Veiculo.ano.focus(); 
					return false;
				}	
			} 
        </script>
        
        <script> 	
			<!-- Código Fonte para Máscarar Campos -->		
			$(document).ready(function()
			{
		       $("#placa").mask("***-****");
			});
        </script>
        
    </HEAD>
    
    <BODY>
    	<div class="figuraCabecalho">
        	<img src="images/Logo/Logo.png">
        </div>
        
        <H1 style="text-align:center;color:#009">CADASTRO DE VEÍCULOS</H1>
        
         <?
			$Veiculo = $_GET['Veiculo'];
			
			$Query = "Select *
					  From lavajato.veiculos
					  Where Veiculo = $Veiculo ";	 

			$Resultado = mysql_query($Query);
			
			$Registro = mysql_fetch_array($Resultado);
        ?>
        
    	<DIV id="divVeiculo">
            <FORM id="Veiculo" action="alterarVeiculo.php" method="get">
            	<div class="row">
                	<label  for="cliente" class="labelVeiculo">Cliente:</label>
                    <input type="text" name="veiculo" readonly="true" id="veiculo" 
                    	   value="<?=$Registro['Veiculo']?>" class="largeVeiculo" maxlength="30">
                </div>
                
                <div class="row">
                	<label  for="modelo" class="labelVeiculo">Modelo:</label>
                    <input type="text" name="modelo" id="modelo" value="<?=$Registro['Modelo']?>" class="largeVeiculo" maxlength="30">
                </div>
                
                <div class="row">
                	<label  for="placa" class="labelVeiculo">Placa:</label>
                    <input type="text" name="placa" id="placa" value="<?=$Registro['Placa']?>" class="largeVeiculo" maxlength="7">
                </div>
                
                <div class="row">
                	<label  for="cor" class="labelVeiculo">Cor:</label>
                    <input type="text" name="cor" id="cor" value="<?=$Registro['Cor']?>" class="largeVeiculo" maxlength="10">
                </div>
                
                <div class="row">
                	<label  for="ano" class="labelVeiculo">Ano:</label>
                    <input type="text" name="ano" id="ano" value="<?=$Registro['Ano']?>" class="largeVeiculo" maxlength="4">
                </div>
                
                <!-- ********************************************************************************************** -->
                
                <div class="row">
                	<button type="submit" name="cadastrar" id="cadastrarVeiculo" onClick="return validarCampos()">Cadastrar</button>
                    <button type="reset" name="clear" id="clearVeiculo">Limpar</button>
                </div>               
            </FORM>
        </DIV>
        
        <div id="returnVeiculo">
        	<a href="RelatorioVeiculo.php"><input type="image" src="images/return4.png"></a>
        </div>
        
        <div id="informacaoUsuario">
        	<P id="textoUsuario">
            	<b>Usuário Logado|</b> <?= $NomeUsuario ?> <b>| Data:</b> <?= $DataAtual ?> <b>| Hora:</b> <?= $HoraAtual ?>
            </P>
        </div>
        
        <div id="figuraRodape">
            <? include('Rodape.php'); ?>
        </div
    </BODY>
</HTML>