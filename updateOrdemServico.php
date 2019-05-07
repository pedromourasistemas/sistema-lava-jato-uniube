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
<html>
	
    <? include('Conexao.php'); ?>
    
	<HEAD>
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/jquery.maskedinput.js" type="text/javascript"> </script>
    	<TITLE>Alteração de Ordem Serviço</TITLE>
        
        <script language="javascript" type="text/javascript"> 
			<!-- Código Fonte para Máscarar Campos -->		
			$(document).ready(function()
			{
		       $("#data").mask("99/99/99");
			   $("#hora").mask("99:99");
			});
			
			function validarCampos() 
			{
				var Veiculo   = document.forms["updateOrdemServico"]["veiculo"].value;				
				var Data      = document.forms["updateOrdemServico"]["data"].value;
				var Hora      = document.forms["updateOrdemServico"]["hora"].value;
				var Descricao = document.forms["updateOrdemServico"]["descricao"].value;
				var Valor     = document.forms["updateOrdemServico"]["valor"].value; 
				
				if(Veiculo == "")
				{
					alert('Informe o Veículo!'); 
					updateOrdemServico.veiculo.focus(); 
					return false;
				}
				
				if(Data == "")
				{
					alert('Informe a Data!'); 
					updateOrdemServico.data.focus(); 
					return false;
				}
				
				if(Hora == "")
				{
					alert('Informe a Hora!'); 
					updateOrdemServico.hora.focus(); 
					return false;
				}
				
				if(Descricao == "")
				{
					alert('Informe a Descrição!'); 
					updateOrdemServico.descricao.focus(); 
					return false;
				}
				
				if(Valor == "")
				{
					alert('Informe o Valor!'); 
					updateOrdemServico.valor.focus(); 
					return false;
				}	
			} 
        </script>
        	
    </HEAD>
    
    <body>
    	<div class="figuraCabecalho">
        	<img src="images/Logo/Logo.png">
        </div>
        
        <h1 id="tituloUpdateOrdem">ORDEM DE SERVIÇOS</h1>
        
         <?
			$OrdemServico = $_GET['OrdemServico'];
			
			$Query ="Select *
					 From lavajato.ordensservicos
					 Where OrdemServico = $OrdemServico ";	 

			$Resultado = mysql_query($Query);
			
			$Registro = mysql_fetch_array($Resultado);
			
			$Data = date('d/m/Y', strtotime($Registro['Data']));
			$Hora = date('H:i:s', strtotime($Registro['Hora']));
        ?>
    
    	<div id="divOrdemServico">
            <FORM id="updateOrdemServico" action="alterarOrdemServico.php" method="get">
            	<div class="row">
  	                <input type="text" id="ordemservico" name="ordemservico" hidden="true" class="largeOrdemServico" readonly 
                    	   value="<?=$Registro['OrdemServico']?>"> 
                </div>
                
            	<div class="row">
                    <label for="veiculo" class="labelOrdemServico">Veículo:</label>
  	                <input type="text" id="veiculo" name="veiculo" class="largeOrdemServico" readonly 
                    	   value="<?=$Registro['Veiculo']?>"> 
                </div> 
                
                <div class="row">
                    <label for="data" class="labelOrdemServico">Data:</label>
                    <input type="text" size="8" name="data" id="data" value="<?= $Data ?>"> 
                    <label for="hora" class="labelOrdemServico">Hora:</label>
                    <input type="text" size="5" name="hora" id="hora" value="<?= $Hora ?>">
                </div> 
                
                <div class="row">
                	<label for="servico" class="labelOrdemServico">Serviços:</label>
					<input type="text" size="5" name="servico" class="largeOrdemServico" readonly 
                           id="hora" value="<?=$Registro['Servico']?>">
                </div> 
                
                <!-- ************************************************************************************************************* -->
                
                <div class="row">
                    <button type="submit" class="botoesOrdem" name="cadastrarOrdemServico" id="cadastrarOrdemServico" onClick="return                            validarCampos()"> Salvar
                    </button>
                    <button type="reset" class="botoesOrdem" name="clearOrdemServico" id="clearOrdemServico">Limpar</button>
                </div>                            
            </FORM>
        </div>
        
        <div id="returnOrdem">
        	<a href="MenuRelatorios.php"><input type="image" src="images/return4.png"></a>
        </div>
        
        <div id="figuraRodape">
            <? include('Rodape.php'); ?>
        </div>
        
        <div id="pagina">
        
        </div>
    </body>
</html>