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
	<HEAD>
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="css/style.css">   
        <script src="js/jquery-2.1.0.js" type="text/javascript"> </script>
        <script src="js/jquery.maskedinput.js" type="text/javascript"> </script>
        <link rel="icon" type="image/png" href="images/home.ico" />  
    	<title>Home</title>	
        
        <script>
			function chamaPagina(pagina)
			{
				$('#report').css('display','none');
				$('#imageCarregar').css("display","");
				$('#globo').css('display','none');
								
				$.ajax({
					url: pagina,
					type: 'get',
					datatype: 'text',
					//data: {pg:pg},
					success: function(r)
					{	
						$('#figuraGlobo').html(r);
						$('#imageCarregar').css('display','none');				
					}
				});	
			}
		</script>
    </HEAD>
        
    <BODY>
    	<DIV class="figuraCabecalho">
        	<img src="images/Logo/Logo.png">
        </DIV>
        
    	<DIV id="divMenuPrincipal">
            <nav id="menuPrincipal">
                <ul>
                    <li><a href="MenuHome.php">Home</a></li>
                    <li><a href="MenuCadastro.php">Cadastro</a></li>
                    <li><a href="OrdemServico.php">Movimentação</a></li>
                    <li><a href="MenuRelatorios.php">Relatório</a></li>
                    <li><a href="Logout.php">Sair</a></li>
                </ul>
            </nav>
        </DIV>
        
       <!-- <DIV class="figuraGlobo"> 
        	<img src="images/useradmin.png" alt="globo">
        </DIV>-->
        
        <DIV id="figuraGlobo">
        	 <div id="figura"  class="figuraReport">
                <img src="images/useradmin.png" id="globo">
                <img src="images/Carregar.gif" id="imageCarregar" style="display:none">
             </div>
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