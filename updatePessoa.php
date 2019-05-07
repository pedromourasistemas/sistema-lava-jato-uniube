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
    	<TITLE>Alteração Pessoa</TITLE>	
        
        <script language="javascript" type="text/javascript"> 
			function validarCampos() 
			{
				var CPF      = document.forms["Pessoa"]["cpf"].value;				
				var Nome     = document.forms["Pessoa"]["nome"].value;				
				var Endereco = document.forms["Pessoa"]["endereco"].value;				
				var Bairro   = document.forms["Pessoa"]["bairro"].value;				
				var Numero   = document.forms["Pessoa"]["numero"].value;
				var Cidade   = document.forms["Pessoa"]["cidade"].value;	
				var Telefone = document.forms["Pessoa"]["telefone"].value;		
				var Celular  = document.forms["Pessoa"]["celular"].value;
				var Tipo     = document.forms["Pessoa"]["tipo"].value;
				var Senha    = document.forms["Pessoa"]["senha"].value;	
				
				if(CPF == "")
				{
					alert('Informe o CPF!'); 
					Pessoa.cpf.focus(); 
					return false;
				}
				
				if(Nome == "")
				{
					alert('Informe o Nome!'); 
					Pessoa.nome.focus(); 
					return false;
				}
				
				if(Endereco == "")
				{
					alert('Informe o Endereço!'); 
					Pessoa.endereco.focus(); 
					return false;
				}
				
				if(Bairro == "")
				{
					alert('Informe o Bairro!'); 
					Pessoa.bairro.focus(); 
					return false;
				}
				
				if(Numero == "")
				{
					alert('Informe o Número!'); 
					Pessoa.numero.focus(); 
					return false;
				}
				
				if(Cidade == "")
				{
					alert('Informe a Cidade!'); 
					Pessoa.cidade.focus(); 
					return false;
				}
				
				if(Telefone == "")
				{
					alert('Informe o Telefone!'); 
					Pessoa.telefone.focus(); 
					return false;
				}
				
				if(Celular == "")
				{
					alert('Informe o Celular!'); 
					Pessoa.celular.focus(); 
					return false;
				}
				
				if(Tipo == "")
				{
					alert('Informe o Tipo!'); 
					Pessoa.tipo.focus(); 
					return false;
				}
				
				if(Senha == "")
				{
					alert('Informe a Senha!'); 
					Pessoa.senha.focus(); 
					return false;
				}
			} 
        </script>
        
        <script> 	
			<!-- Código Fonte para Máscarar Campos -->		
			$(document).ready(function()
			{
		       $("#telefone").mask("(99)9999-9999");
			   $("#celular").mask("(99)9999-9999");
			   $("#cpf").mask("999.999.999-99");
			});
        </script>
    </HEAD>
    
    <BODY>
    	<div class="figuraCabecalho">
        	<img src="images/Logo/Logo.png">
        </div>
        
        <H1 style="text-align:center;color:#009">CADASTRO DE PESSOAS</H1>
        
        <?
			$CPF = $_GET['CPF'];
			
			$Query ="Select *
					 From lavajato.pessoas
					 Where CPF = $CPF ";	 

			$Resultado = mysql_query($Query);
			
			$Registro = mysql_fetch_array($Resultado);			
        ?>
        
    	<DIV id="divPessoa">
            <FORM id="Pessoa" action="alterarPessoa.php" method="get">
            	<div class="row">
                    <label for="cpf" class="labelPessoa">CPF:</label>
                    <input type="text" name="cpf" class="largePessoa" value="<?=$Registro['CPF']?>" id="cpf" maxlength="14"> 
                </div>
                
                <div class="row">
                    <label for="nome" class="labelPessoa">Nome:</label>
                    <input type="text" name="nome" class="largePessoa" value="<?=$Registro['Nome']?>" id="nome" maxlength="40"> 
                </div>
                
                <div class="row">
                    <label for="endereco" class="labelPessoa">Endereço:</label>
                    <input type="text" name="endereco" class="largePessoa" value="<?=$Registro['Endereco']?>" 
                    	   id="endereco" maxlength="40"> 
                </div>
                
                <div class="row">
                    <label for="bairro" class="labelPessoa">Bairro:</label>
                    <input type="text" name="bairro" class="largePessoa" value="<?=$Registro['Bairro']?>" id="bairro" maxlength="30"> 
                </div>
                
                <div class="row">
                    <label for="numero" class="labelPessoa">Número:</label>
                    <input type="text" name="numero" class="largePessoa" value="<?=$Registro['Numero']?>" id="numero" maxlength="11"> 
                </div>
                
                <div class="row">
                    <label for="cidade" class="labelPessoa">Cidade:</label>
                    <select name="cidade" class="largePessoa" id="cidade">
                        <option value="">Selecione</option>
                        <?
                            $sql = "SELECT Cidade, Descricao
                                    FROM lavajato.cidades
                                    ORDER BY Descricao";
                                    
                            $res = mysql_query($sql);	
                                                                                                            
                            while($row = mysql_fetch_assoc($res)) 
                            {
                                echo '<option value="'.$row['Cidade'].'">'.$row['Descricao'].'</option>';
                            }
                        ?>	                                
                   </select> 
                </div>
                
                <div class="row">
                    <label for="telefone" class="labelPessoa">Telefone:</label>
                    <input type="text" name="telefone" class="largePessoa" value="<?=$Registro['Telefone']?>" 
                           id="telefone" maxlength="14"> 
                </div>
                
                <div class="row">
                    <label for="celular" class="labelPessoa">Celular:</label>
                    <input type="text" name="celular" class="largePessoa" value="<?=$Registro['Celular']?>" id="celular" maxlength="14"> 
                </div> 
                
                <div class="row">
                    <label for="tipo" class="labelPessoa">Tipo:</label>
                    <select name="tipo" class="largePessoa" id="tipo">
                        <option value="">Selecione</option>
                        <option value="C">Cliente</option>
                        <option value="F">Fornecedor</option>
                    </select>
                </div> 
                
                <div class="row">
                    <label for="senha" class="labelPessoa">Senha:</label>
                    <input type="password" name="senha" class="largePessoa" id="senha" maxlength="16"> 
                </div> 
                
                <!-- ********************************************************************************************** -->
                
                <div class="row">
                    <button type="submit" name="cadastrarPessoa" id="cadastrarPessoa" onclick="return validarCampos()">Salvar</button>
                    <button type="reset" name="clearPessoa" id="clearPessoa">Limpar</button> 
                </div>  
            </FORM>
        </DIV>
        
        <DIV id="returnPessoa">
        	<a href="MenuRelatorios.php"><input type="image" src="images/return4.png"></a>
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