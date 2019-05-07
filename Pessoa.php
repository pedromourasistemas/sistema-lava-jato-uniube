<?	
	session_start(); 
	session_cache_expire(1);
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
    
	<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="icon" type="image/png" href="images/add.ico" />
        <script src="js/jquery-2.1.0.js" type="text/javascript"> </script>
        <script src="js/jquery.maskedinput.js" type="text/javascript"> </script>
    	<title>Cadastro de Pessoas</title>	
        
        <script language="javascript" type="text/javascript"> 		
			function CarregaCidades(UF)
			{			
				if(UF)
				{
					var url = 'TesteCidade.php?UF='+UF;
					
					
					$.get(url, function(dataReturn)
					{
						$('#cidadeSelect').html(dataReturn);								
					});
				}	
			}
			
			<!-- Código Fonte para Máscarar Campos -->		
			$(document).ready(function()
			{
		       $("#telefone").mask("(99)9999-9999");
			   $("#celular").mask("(99)9999-9999");
			   $("#cpf").mask("999.999.999-99");
			});
			
			function validarCampos() 
			{
				var CPF      = document.forms["Pessoa"]["cpf"].value;				
				var Nome     = document.forms["Pessoa"]["nome"].value;				
				var Endereco = document.forms["Pessoa"]["endereco"].value;				
				var Bairro   = document.forms["Pessoa"]["bairro"].value;				
				var Numero   = document.forms["Pessoa"]["numero"].value;
				var Cidade   = document.forms["Pessoa"]["cidadeSelect"].value;	
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
					Pessoa.cidadeSelect.focus(); 
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
				
				salvaDados()
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
			
			function salvaDados()
			{												
				var CPF      = $('#cpf').val();
				var Nome     = $('#nome').val();
				var Endereco = $('#endereco').val();
				var Numero   = $('#numero').val();
				var Cidade   = $('#cidadeSelect').val();
				var Telefone = $('#telefone').val();
				var Celular  = $('#celular').val();
				var Tipo     = $('#tipo').val();
				var Senha    = $('#senha').val();
														
				$.ajax({
					url: 'inserirPessoa.php',
					type: 'post',
					datatype: 'text',
					data: {CPF :CPF, Nome :Nome, Endereco :Endereco, Numero :Numero, Cidade :Cidade, 
					       Telefone :Telefone, Celular :Celular, Tipo :Tipo, Senha :Senha},						   
					success: function(r)
					{	
						var Result = r.split('|');
						
						if(Result[0] == 1)
						{
							alert(Result[1]);
							chamaPagina('Pessoa.php');
						}
						else
						{
							alert(Result[1]);
							chamaPagina('Pessoa.php');
						}
						
						if(Result[0] == 3)
						{
							alert(Result[3]);
							chamaPagina('Pessoa.php');
						}
					}					
				});	
			}
		</script>
        
    </head>
    
    <body>        
        <h1 id="tituloCadastroPessoa">CADASTRO DE PESSOAS</h1>
        
    	<div id="divPessoa">
            <FORM id="Pessoa" action="inserirPessoa.php" method="post">
                <div class="row">
                    <label for="cpf" class="labelPessoa">CPF:</label>
                    <input type="text" name="cpf" class="largePessoa" id="cpf" maxlength="14" autofocus 
                           onkeypress="return SomenteNumeros(event)"> 
                </div>
                
                <div class="row">
                    <label for="nome" class="labelPessoa">Nome:</label>
                    <input type="text" name="nome" class="largePessoa" id="nome" maxlength="40"> 
                </div>
                
                <div class="row">
                    <label for="endereco" class="labelPessoa">Endereço:</label>
                    <input type="text" name="endereco" class="largePessoa" id="endereco" maxlength="40"> 
                </div>
                
                <div class="row">
                    <label for="bairro" class="labelPessoa">Bairro:</label>
                    <input type="text" name="bairro" class="largePessoa" id="bairro" maxlength="30"> 
                </div>
                
                <div class="row">
                    <label for="numero" class="labelPessoa">Número:</label>
                    <input type="text" name="numero" class="largePessoa" id="numero" maxlength="4" 
                    	   onkeypress="return SomenteNumeros(event)"> 
                </div>
                
                <div class="row">
                    <label for="estado" class="labelPessoa">Estado:</label>
                    <select name="estadoSelect" class="largePessoa" id="estadoSelect" onChange="CarregaCidades(this.value)">
                        <option value="">Selecione</option>
                        <?
                            $SqlEstado = "SELECT UF, Descricao
										  FROM lavajato.estados
										  ORDER BY Descricao";
                                    
                            $res = mysql_query($SqlEstado);	
                                                                                                            
                            while($rowEstado = mysql_fetch_assoc($res)) 
                            {
                                echo '<option value="'.$rowEstado['UF'].'">'.utf8_decode($rowEstado['Descricao']).'</option>';
                            }
                        ?>	                                
                   </select> 
                </div>
                
                <div class="row">
                    <label for="cidade" class="labelPessoa">Cidade:</label>
                    <select name="cidadeSelect" class="largePessoa" id="cidadeSelect">
                        <option value="">Selecione um Estado</option>	                                
                    </select> 
                </div>
                
                <div class="row">
                    <label for="telefone" class="labelPessoa">Telefone:</label>
                    <input type="text" name="telefone" class="largePessoa" id="telefone" maxlength="14" 
                    	   onkeypress="return SomenteNumeros(event)" > 
                </div>
                
                <div class="row">
                    <label for="celular" class="labelPessoa">Celular:</label>
                    <input type="text" name="celular" class="largePessoa" id="celular" maxlength="14"
                           onkeypress="return SomenteNumeros(event)" > 
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
                    <input type="password" name="senha" class="largePessoa" id="senha" maxlength="16" > 
                </div> 
                
                <!-- ***************************************************************************************************************** -->
                
                <div class="row">
                    <button type="button" name="cadastrarPessoa" id="cadastrarPessoa" onclick="return validarCampos()">Cadastrar</button>
                    <button type="reset" name="clearPessoa" id="clearPessoa">Limpar</button> 
                </div>           
            </FORM>
        </div>
    </body>
</html>