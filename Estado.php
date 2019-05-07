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
    	<title>Cadastro de Estados</title>	
        
        <script language="javascript" type="text/javascript"> 
			function validarCampos() 
			{
				var UF        = document.forms["Estado"]["uf"].value;				
				var Descricao = document.forms["Estado"]["descricao"].value;
				
				if(UF == "")
				{
					alert('Informe a Sigla!'); 
					Estado.uf.focus(); 
					return false;
				}
				
				if(Descricao == "")
				{
					alert('Informe a Descrição!'); 
					Estado.descricao.focus(); 
					return false;
				}	
				
				salvaDados()
			} 
			
			function salvaDados()
			{								
				var UF        = $('#uf').val();
				var Descricao = $('#descricao').val();
														
				$.ajax({
					url: 'inserirEstado.php',
					type: 'post',
					datatype: 'text',
					data: {UF :UF, Descricao :Descricao},
					success: function(r)
					{	
						var Result = r.split('|');
						
						if(Result[0] == 1)
						{
							alert(Result[1]);
							chamaPagina('Estado.php');
						}
						else
						{
							alert(Result[1]);
							chamaPagina('Estado.php');
						}
						
						if(Result[0] == 3)
						{
							alert(Result[3]);
							chamaPagina('Estado.php');
						}
					}					
				});	
			}
			
			function SomenteLetras(e)
			{
				var tecla = new String();
				
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
				
				if((tecla >= "48") && (tecla <= "57"))
				{
					alert("Informe somente Letras!");
					return false;
				}
			}
			
			function MudaUpper(e)
			{	
				var UF = document.forms["Estado"]["uf"].value;
							
				UF = UF.toUpperCase();
				
				$('#uf').val(UF);
			}
        </script>        
    </head>
    
    <body>        
        <h1 id="tituloCadastroEstado">CADASTRO DE ESTADOS</h1>
        
    	<div id="divEstado">
            <FORM id="Estado" action="inserirEstado.php" method="post">
            	<div class="row">
                	<label  for="sigla" class="labelEstado">Sigla:</label>
                    <input type="text" id="uf" name="uf" class="largeEstado" onKeyUp="return MudaUpper(event)" 
                           autofocus onkeypress="return SomenteLetras(event)" maxlength="2">
                </div>
                
                <div class="row">
                	<label  for="descricao" class="labelEstado">Descrição:</label>
                    <input type="text" id="descricao" name="descricao" class="largeEstado" onkeypress="return SomenteLetras(event)"                           maxlength="40">
                </div>
                
                <!-- ************************************************************************************************************* -->
                
                <div class="row">
                	<button type="button" name="cadastrarEstado" id="cadastrarEstado" onClick="return validarCampos()">Gravar</button>
                    <button type="reset" name="clearEstado" id="clearEstado">Limpar</button>
                </div>
            </FORM>
        </div>
    </body>
</html>