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
        <link rel="icon" type="image/png" href="images/add.ico" />
        <script src="js/jquery-2.1.0.js" type="text/javascript"> </script>       
    	<title>Cadastros</title>
        
        <script>
			function chamaPagina(pagina)
			{
				$('#cadastro').css('display','none');
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
					
					success: function(r)
					{	
						$('#divRelatorioMostrar').html(r);
						$('#imageCarregar').css('display','none');				
					}				
				});	
			}
		</script>	
    </HEAD>
    
    <BODY>
    	<div class="figuraCabecalho">
        	<img src="images/Logo/Logo.png">
        </div>
        
    	<div id="divMenu">
            <nav id="menu">
                <ul>
                	<li><a href="MenuHome.php">Home</a></li>
                    <li><a onClick="chamaPagina('Pessoa.php')">Pessoas</a></li>
                    <li><a onClick="chamaPagina('Cidade.php')">Cidades</a></li>
                    <li><a onClick="chamaPagina('Estado.php')">Estados</a></li>
                    <li><a onClick="chamaPagina('Veiculo.php')">Veículos</a></li>
                    <li><a onClick="chamaPagina('Servico.php')">Serviços</a></li>
                    <li><a href="Logout.php">Sair</a></li>
                </ul>
            </nav>
        </div>
        
        <!--<DIV id="return">
        	<a href="MenuHome.php"><input type="image" src="images/return4.png"></a>
        </DIV>-->
        
        <div id="divRelatorioMostrar">
        	 <div id="figura"  class="figuraReport">
                <img src="images/add.png" id="cadastro">
                <img src="images/Carregar.gif" id="imageCarregar" style="display:none">
             </div>
        </div>
        
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