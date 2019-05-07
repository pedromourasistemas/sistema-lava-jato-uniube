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
	<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="icon" type="image/png" href="images/add.ico" />
        <script src="js/jquery-2.1.0.js" type="text/javascript"> </script>
        <script src="js/jquery.maskedinput.js" type="text/javascript"> </script>
        <script src="js/jquery.maskMoney.js" type="text/javascript"></script>
    	<title>Cadastro de Serviços</title>	
        
        <script language="javascript" type="text/javascript"> 
			function validarCampos() 
			{				
				var Descricao = document.forms["Servico"]["descricao"].value;
				var Valor     = document.forms["Servico"]["valor"].value;
				
				if(Descricao == "")
				{
					alert('Informe a Descrição!'); 
					Servico.descricao.focus(); 
					return false;
				}
				
				if(Valor == "")
				{
					alert('Informe o Valor!'); 
					Servico.valor.focus(); 
					return false;
				}
				
				salvaDados()					
			}
			
			<!-- Código Fonte para Máscarar Campos -->		
			$(document).ready(function()
			{
		       $("#valor").maskMoney({decimal:",",thousands:"."});
			});
			
			function salvaDados()
			{											
				var Descricao = $('#descricao').val();
				var Valor     = $('#valor').val();
														
				$.ajax({
					url: 'inserirServico.php',
					type: 'post',
					datatype: 'text',
					data: {Descricao :Descricao, Valor :Valor},
					success: function(r)
					{	
						var Result = r.split('|');
						
						if(Result[0] == 1)
						{
							alert(Result[1]);
							chamaPagina('Servico.php');
						}
						else
						{
							alert(Result[1]);
							chamaPagina('Servico.php');
						}
					}					
				});
			}			 			
        </script>        
    </head>
    
    <body>        
        <h1 id="tituloCadastroServico">CADASTRO DE SERVIÇOS</h1>
        
    	<div id="divServico">
            <form id="Servico" action="inserirServico.php" method="post">
                <div class="row">
                    <label for="descricao" class="labelServico">Descrição:</label>
                    <input type="text" name="descricao" id="descricao" class="largeServico" maxlength="45" autofocus> 
                </div> 
                
                <div class="row">
                    <label for="servico" class="labelServico">Valor: R$</label>
                    <input type="text" name="valor" class="largeValor" id="valor">
                </div> 
                
                <!-- ****************************************************************************************************************** -->
                
                <div class="row">
                    <button type="button" name="cadastrarServico" id="cadastrarServico" onClick="return validarCampos()">Cadastrar</button>
                    <button type="reset" name="clearServico" id="clearServico">Limpar</button>
                </div>             
            </form>
        </div>
    </body>
</html>