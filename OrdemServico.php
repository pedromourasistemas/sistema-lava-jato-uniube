<?	
	session_start(); 
	date_default_timezone_set("Brazil/East");
	
	if((!isset ($_SESSION['cpf']) == true) and (!isset ($_SESSION['senha']) == true)) 
	{ 
		unset($_SESSION['cpf']); 
		unset($_SESSION['senha']); 
		echo '<script>
				 alert("Fa�a o Login para acessar o Sistema!!");
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
	
    <? 
		include('Conexao.php'); 
		//date_default_timezone_set("Brazil/East");
	?>
    
	<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="icon" type="image/ico" href="images/service1.ico" />
    	<title>Ordem de Servi�o</title>	
        
        <script src="js/script.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="js/jquery.maskedinput.js" type="text/javascript"> </script>
        
        <script language="javascript" type="text/javascript"> 
			function validarCampos() 
			{
				var Veiculo   = document.forms["OrdemServico"]["veiculo"].value;				
				var Data      = document.forms["OrdemServico"]["data"].value;
				var Hora      = document.forms["OrdemServico"]["hora"].value;
				var Nome      = document.forms["OrdemServico"]["nome"].value;
				var Servico   = document.forms["OrdemServico"]["servico"].value;
				
				if(Veiculo == "")
				{
					alert('Informe o Ve�culo!'); 
					OrdemServico.veiculo.focus(); 
					return false;
				}
				
				if(Data == "")
				{
					alert('Informe a Data!'); 
					OrdemServico.data.focus(); 
					return false;
				}
				
				if(Hora == "")
				{
					alert('Informe a Hora!'); 
					OrdemServico.hora.focus(); 
					return false;
				}
				
				if(Nome == "")
				{
					alert('Informe o Nome!'); 
					OrdemServico.nome.focus(); 
					return false;
				}
				
				if(Servico == "")
				{
					alert('Informe um Servico!'); 
					OrdemServico.servico.focus(); 
					return false;
				}
			} 
			
			function pesquisa(valor)
			{
				document.getElementById('pagina').style.display = "";
				//FUN��O QUE MONTA A URL E CHAMA A FUN��O AJAX
				url="BuscaVeiculoCliente.php?valor="+valor;
				ajax(url);
			}
			
			function preencherText(Placa)
			{
				$("#nome").val(Placa);
				document.getElementById('pagina').style.display = "none";
			}	
        </script>
        
        <script> 	
			<!-- C�digo Fonte para M�scarar Campos -->		
			$(document).ready(function()
			{
		       $("#data").mask("99/99/99");
			   $("#hora").mask("99:99");
			});
        </script>
    </head>
    
    <body>
    	<div class="figuraCabecalho">
        	<img src="images/Logo/Logo.png">
        </div>
        
        <h1 id="tituloOrdemServico">EMISS�O DE ORDEM DE SERVI�O</h1>
    
    	<div id="divOrdemServico">
            <FORM id="OrdemServico" action="inserirOrdemServico.php" method="post">
                <div class="row">
                    <label for="veiculo" class="labelOrdemServico">Ve�culo:</label>
  	                <input type="text" id="nome" name="nome" placeholder="Digite Nome Cliente" 
    					   class="largeOrdemServico" onKeyPress="pesquisa(this.value)" autofocus> 
                </div> 
                
                <div class="row">
                    <label for="data" class="labelOrdemServico">Data:</label>
                    <input type="text" size="5" name="data" id="data" value="<?=$Data = date("d/m/y")?>"> 
                    <label for="hora" class="labelOrdemServico">Hora:</label>
                    <input type="text" size="5" name="hora" id="hora" value="<?=$Hora = date("H:i")?>">
                </div> 
                
                <div class="row">
                	<label for="servico" class="labelOrdemServico">Servi�os:</label>
                    <select name="servico" id="servico">
                        <option value="">Selecione</option>
                        <?
                            $sql = "SELECT *
                                    FROM lavajato.servicos
                                    ORDER BY Descricao";
                                    
                            $res = mysql_query($sql);	
                                                                                                            
                            while($row = mysql_fetch_assoc($res)) 
                            {
                                echo '<option value="'.$row['Servico'].'">'.utf8_decode($row['Descricao']).'</option>';
                            }
                        ?>	                                
                   </select>
                </div> 
                
                <!-- ************************************************************************************************** -->
                
                <div class="row">
                    <button type="submit" name="cadastrarOrdemServico" id="cadastrarOrdemServico" onClick="return validarCampos()">				                     	Cadastrar
                    </button>
                    <button type="reset" name="clearOrdemServico" id="clearOrdemServico">Limpar</button>
                </div>        
            </FORM>
        </div>
        
        <div id="returnOrdem">
        	<a href="MenuHome.php"><input type="image" src="images/return4.png"></a>
        </div>
        
        <div id="informacaoUsuario">
        	<P id="textoUsuario">
            	<b>Usu�rio Logado|</b> <?= $NomeUsuario ?> <b>| Data:</b> <?= $DataAtual ?> <b>| Hora:</b> <?= $HoraAtual ?>
            </P>
        </div>
        
        <div id="figuraRodape">
            <? include('Rodape.php'); ?>
        </div>
        
        <div id="pagina">
        
        </div>
    </body>
</html>