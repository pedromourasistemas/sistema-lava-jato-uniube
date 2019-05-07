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
        <link rel="icon" type="image/png" href="images/add.ico" />
        <script src="js/jquery-2.1.0.js" type="text/javascript"> </script>
        <script src="js/jquery.maskedinput.js" type="text/javascript"> </script>         
        <script src="js/script.js"></script>
        <!--<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>-->
        
    	<title>Cadastro de Veículos</title>	
        
        <script language="javascript" type="text/javascript">		
			function salvaDados()
			{							
				alert("Cheguei no Salva");					
				var Cliente = $('#cliente').val();
				var Modelo  = $('#modelo').val();
				var Placa   = $('#placa').val();
				var Cor     = $('#cor').val();
				var Ano     = $('#ano').val();
														
				$.ajax({
					url: 'inserirVeiculo.php',
					type: 'post',
					datatype: 'text',
					data: {Cliente :Cliente, Modelo :Modelo, Placa :Placa, Cor :Cor, Ano :Ano},
					success: function(r)
					{	
						var Result = r.split('|');
						
						if(Result[0] == 1)
						{
							alert(Result[1]);
							chamaPagina('Veiculo.php');
						}
						else
						{
							alert(Result[1]);
							chamaPagina('Veiculo.php');
						}
						
						if(Result[0] == 3)
						{
							alert(Result[3]);
							chamaPagina('Servico.php');
						}
					}					
				});	
			}
			
			<!-- Código Fonte para Máscarar Campos -->		
			$(document).ready(function()
			{
		       $("#placa").mask("***-****");
			});
			 
			function validarCampos() 
			{
				var Cliente = document.forms["Veiculo"]["cliente"].value;				
				var Modelo  = document.forms["Veiculo"]["modelo"].value;
				var Placa   = document.forms["Veiculo"]["placa"].value;
				var Cor     = document.forms["Veiculo"]["cor"].value;
				var Ano     = document.forms["Veiculo"]["ano"].value;
				
				var LetrasPlaca = Placa.substr(0,3);
				var NumPlaca    = Placa.substr(4,8);
				
				
				
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
				
				salvaDados()
			} 
			
			function pesquisa(valor)
			{
				document.getElementById('pagina').style.display = "";
				//FUNÇÃO QUE MONTA A URL E CHAMA A FUNÇÃO AJAX
				url="BuscaCliente.php?valor="+valor;
				ajax(url);
			}
			
			function preencherText(CPF)
			{
				$("#cliente").val(CPF);
				document.getElementById('pagina').style.display = "none";
			}
			
			function SomenteNumeros(e)
			{
				var tecla = new Number();
				
				if(window.event) 
				{
					tecla = e.keyCode;
				}
				else 
				if(e.which) 
				{
					tecla = e.which;
				}
				else 
				{
					return true;
				}
				
				if((tecla >= "97") && (tecla <= "122"))
				{
					alert("Informe somente números!");
					return false;
				}
			}		
        </script>
                
    </HEAD>
    
    <BODY>
        <H1 id="tituloCadastroVeiculo">CADASTRO DE VEÍCULOS</H1>
        
    	<div id="divVeiculo">
            <FORM id="Veiculo" action="inserirVeiculo.php" method="post">
                <div class="row">
                    <label for="veiculo" class="labelVeiculo">Cliente:</label>
  	                <input type="text" id="cliente" name="cliente" placeholder="Digite Nome Cliente" 
    					  class="largeVeiculo" onKeyPress="pesquisa(this.value)"> 
                </div>
                
                <div class="row">
                	<label  for="modelo" class="labelVeiculo">Modelo:</label>
                    <input type="text" name="modelo" id="modelo" class="largeVeiculo" maxlength="30">
                </div>
                
                <div class="row">
                	<label  for="placa" class="labelVeiculo">Placa:</label>
                    <input type="text" name="placa" id="placa" class="largeVeiculo" maxlength="7">
                </div>
                
                <div class="row">
                	<label  for="cor" class="labelVeiculo">Cor:</label>
                    <input type="text" name="cor" id="cor" class="largeVeiculo" maxlength="10">
                </div>
                
                <div class="row">
                	<label  for="ano" class="labelVeiculo">Ano:</label>
                    <input type="text" name="ano" id="ano" class="largeVeiculo" maxlength="4" onkeypress="return SomenteNumeros(event)">
                </div>
                
                <!-- ********************************************************************************************** -->
                
                <div class="row">
                	<button type="button" name="cadastrar" id="cadastrarVeiculo" onClick="return validarCampos()">Cadastrar</button>
                    <button type="reset" name="clear" id="clearVeiculo">Limpar</button>
                </div>                            
            </FORM>
        </div>
        
        <!--<div id="returnVeiculo">
        	<a href="MenuCadastro.php"><input type="image" src="images/return4.png"></a>
        </div>-->
        
        <DIV id="pagina">
        
        </DIV>
    </BODY>
</HTML>