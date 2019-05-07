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
    	<TITLE>Alteração de Cidades</TITLE>
        
        <script language="javascript" type="text/javascript"> 
			function validarCampos() 
			{
				var UF        = document.forms["Cidade"]["uf"].value;				
				var Descricao = document.forms["Cidade"]["descricao"].value;
				
				if(UF == "")
				{
					alert('Informe o Estado!'); 
					Cidade.uf.focus(); 
					return false;
				}
				
				if(Descricao == "")
				{
					alert('Informe a Descrição!'); 
					Cidade.descricao.focus(); 
					return false;
				}	
			} 
        </script>
        	
    </HEAD>
    
    <BODY>
    	<DIV class="figuraCabecalho">
        	<img src="images/Logo/Logo.png">
        </DIV>
        
        <H1 style="text-align:center;color:#009">CADASTRO DE CIDADES</H1>
        
         <?
			$Cidade = $_GET['Cidade'];
			
			$Query ="Select *
					 From lavajato.cidades
					 Where Cidade = $Cidade ";	 

			$Resultado = mysql_query($Query);
			
			$Registro = mysql_fetch_array($Resultado);
        ?>
    
    	<DIV id="divCidade">
            <FORM id="Cidade" action="alterarCidade.php" method="get">
            	<div class="row">
                    <input type="text" hidden="true" name="cidade" id="cidade" readonly value="<?=$Registro['Cidade']?>" maxlength="6">
                </div>
                
            	<div class="row">
                    <label  for="estado" class="labelCidade">Estado:</label>
                    <input type="text" name="uf" id="uf" readonly value="<?=$Registro['UF']?>" maxlength="6">
                </div>
                
                <div class="row">
                    <label for="descricao" class="labelCidade">Descrição:</label>
                    <input type="text" name="descricao" value="<?=$Registro['Descricao']?>" class="large" maxlength="45"> 
                </div>       
                
                <!-- ********************************************************************************************** -->
                
                <div class="row">
                	<button type="submit" name="cadastrarCidade" id="cadastrarCidade" onClick="return validarCampos()">Salvar</button>
                    <button type="reset" name="clearCidade" id="clearCidade">Limpar</button>
                </div>               
            </FORM>
        </DIV>
        
        <DIV id="returnCidade">
        	<a href="RelatorioCidade.php"><input type="image" src="images/return4.png"></a>
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