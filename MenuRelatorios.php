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
        <link rel="icon" type="image/png" href="images/report.ico" />
        <script src="js/jquery-2.1.0.js" type="text/javascript"> </script>
        <script src="js/jquery.maskedinput.js" type="text/javascript"> </script>
    	<title>Relatórios</title>
        
        <script>
			function chamaPagina(pagina)
			{
				$('#report').css('display','none');
				$('#imageCarregar').css("display","");
				$('#return').css('display','none');
								
				$.ajax({
					url: pagina,
					type: 'get',
					datatype: 'text',
					beforeSend: function()
					{
						$('#imageCarregar').css("display","");
					},
					//data: {pg:pg},
					success: function(r)
					{	
						$('#divRelatorioMostrar').html(r);
						$('#imageCarregar').css('display','none');				
					}				
				});	
			}
		</script>
    </head>
    
    <body>
    	<div class="figuraCabecalho">
        	<img src="images/Logo/Logo.png">
        </div>
        
    	<div id="divRelatorio">
            <nav id="menuRelatorio">               
                <ul style="cursor:pointer">	
                	<li><a href="MenuHome.php">Home</a></li>
                    <li><a onClick="chamaPagina('RelatorioCliente.php')">Clientes</a></li>
                    <li><a onClick="chamaPagina('RelatorioFornecedor.php')">Fornecedores</a></li>
                    <li><a onClick="chamaPagina('RelatorioEstados.php')">Estados</a></li>
                    <li><a onClick="chamaPagina('RelatorioCidade.php')">Cidades</a></li>
                    <li><a onClick="chamaPagina('RelatorioVeiculo.php')">Veículos</a></li>
                    <li><a onClick="chamaPagina('RelatorioOrdemServico.php')">Ordem de Serviço</a></li>
                    <li><a onClick="chamaPagina('RelatorioServico.php')">Serviços</a></li>
                    <li><a href="Logout.php">Sair</a></li>
                </ul>
            </nav>
        </div>
        
        <div id="divRelatorioMostrar">
        	 <div id="figura"  class="figuraReport">
                <img src="images/report.png" id="report">
                <img src="images/Carregar.gif" id="imageCarregar" style="display:none">
             </div>
        </div>      
        
        <DIV id="return">
        	<a href="MenuHome.php"><input type="image" src="images/return4.png"></a>
        </DIV>
                
        <!-- Div Informações Usuarios Logados -->
        
        <DIV id="figuraRodape">
            <? include('Rodape.php'); ?>
        </DIV>
    </body>
</html>