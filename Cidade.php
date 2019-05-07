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
	
    <? include('Conexao.php'); ?>
    
	<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="icon" type="image/png" href="images/add.ico" />
    	<title>Cadastro de Cidades</title>	
        
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
				
				salvaDados();
			} 
			
			function salvaDados()
			{								
				var UF        = $('#uf').val();
				var Descricao = $('#descricao').val();
														
				$.ajax({
					url: 'inserirCidade.php',
					type: 'post',
					datatype: 'text',
					data: {Descricao :Descricao, UF :UF},
					success: function(r)
					{	
						var Result = r.split('|');
						
						if(Result[0] == 1)
						{
							alert(Result[1]);
							chamaPagina('Cidade.php');
						}
						else
						{
							alert(Result[1]);
							chamaPagina('Cidade.php');
						}
						
						if(Result[0] == 3)
						{
							alert(Result[3]);
							chamaPagina('Cidade.php');
						}
					}					
				});	
			}
        </script>        
    </head>
    
    <body>        
        <h1 id="tituloCadastroCidade">CADASTRO DE CIDADES</h1>
    
    	<div id="divCidade">
            <FORM id="Cidade" action="inserirCidade.php" method="post">
            	<div class="row">
                    <label  for="estado" class="labelCidade">Estado:</label>
                    <select id="uf" name="uf" class="large" autofocus>
                        <option value="">Selecione</option>
                        <?
                            $sql = "SELECT UF, Descricao
                                    FROM lavajato.estados
                                    ORDER BY UF";
                                    
                            $res = mysql_query($sql);	
                                                                                                            
                            while($row = mysql_fetch_assoc($res)) 
                            {
                                echo '<option value="'.$row['UF'].'">'.utf8_decode($row['Descricao']).'</option>';
                            }
                        ?>	                                
                    </select>
                </div>
                
                <div class="row">
                    <label for="descricao" class="labelCidade">Descrição:</label>
                    <input type="text" id="descricao" name="descricao" class="large" maxlength="45"> 
                </div>       
                
                <!-- ************************************************************************************************************** -->
                
                <div class="row">
                	<button type="button" name="cadastrarCidade" id="cadastrarCidade" onClick="return validarCampos()">Gravar</button>
                    <button type="reset" name="clearCidade" id="clearCidade">Limpar</button>
                </div>    
            </FORM>
        </div>
    </body>
</html>