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
    	<title>Relatório de Veículos</title>	
        
        <script>
			function editaVeiculo(Pagina, Id)
			{
				$('#imageCarregar').css("display","none");
				var Veiculo = $('#veiculo').val();
				var Placa   = $('#placa').val();		
												
				$.ajax({
					url: Pagina,
					type: 'post',
					datatype: 'text',
					data: {Id :Id, Veiculo :Veiculo, Placa :Placa},
					success: function(r)
					{	
						$('#resultado').css("display"," ");
						$('#itemContainer_'+Id).html(r);										
					}
				});	
			}
		</script>
        
        <script>
			function salvaDados(Veiculo)
			{
				var Modelo  = $('#modelo').val();
				var Placa   = $('#placa').val();
				var Cor     = $('#cor').val();
				var Ano     = $('#ano').val();
																						
				$.ajax({
					url: 'alterarVeiculo.php',
					type: 'post',
					datatype: 'text',
					data: {Veiculo :Veiculo, Modelo :Modelo, Placa :Placa, Cor :Cor, Ano :Ano},
					success: function(r)
					{	
						alert(r);
						var Result = r.split('|');
						
						if(Result[0] == 1)
						{
							alert(Result[1]);
							chamaPagina('RelatorioVeiculo.php');
						}
						else
						{
							alert(Result[1]);
						}
					}					
				});	
			}
			
			function excluiDados(Veiculo)
			{
				$.ajax({
					url: 'excluirVeiculo.php',
					type: 'post',
					datatype: 'text',
					data: {Veiculo :Veiculo},
					success: function(r)
					{	
						var Result = r.split('|');
						
						if(Result[0] == 1)
						{
							alert(Result[1]);
							chamaPagina('RelatorioVeiculo.php');
						}
						else
						{
							alert(Result[1]);
						}
					}					
				});
			}
			
			function paginacao(Pagina, IdPag)
			{
				$.ajax({
					url: Pagina,
					type: 'post',
					datatype: 'text',
					data: {IdPag :IdPag},
					success: function(r)
					{	
						$('#divRelatorioMostrar').html(r);
					}					
				});
			}
		</script>
    </head>
    
    <body>        
        <h1 id="tituloRelatorioVeiculo">RELATÓRIO DE VEÍCULOS</h1>
        
    	<div id="divRelatorioVeiculo">
        	<FORM action="excluirVeiculo.php" method="post">
                <table id="tableReportVeiculo" align="center" style="margin-top:300px"  border="1">
                    <tbody>
                        <tr id="titulosVeiculo">
                           <td><b>Código</b></td>                           
                           <td><b>Modelo</b></td>
                           <td><b>Placa</b></td>
                           <td><b>Cor</b></td>
                           <td><b>Ano</b></td>
                           <td><b>Cliente</b></td>
                           <td><b>Excluir</b></td>
                           <td><b>Alterar</b></td>
                        </tr>
						
						<?
						/*************************************** DADOS PAGINAÇÃO ***********************************/
						$Limite = 10; //Defini o limite de registros a ser mostrado por página.
						
						if(!isset($_POST['IdPag'])) 
						{
							$_POST['IdPag'] = 1;
						}
						
						/* Operação matemática que resulta no registro inicial
						a ser selecionado no banco de dados baseado na página atual */
						$Inicio = ($_POST['IdPag'] * $Limite) - $Limite;
																
						/*******************************************************************************************/
						
						$Query = "Select V.*, P.Nome
      							  From lavajato.veiculos V, lavajato.pessoas P
								  Where V.CPF = P.CPF Limit $Inicio, $Limite";

						$Resultado = mysql_query($Query);									
						
						/***********************************************************************************************/					
                       	$SqlCont = mysql_query("Select V.*, P.Nome
												From lavajato.veiculos V, lavajato.pessoas P
												Where V.CPF = P.CPF");
													 
     				    $QtdTotalReg = mysql_num_rows($SqlCont);
						
						$QtdPagina = ceil($QtdTotalReg / $Limite);
						
						echo '<div id="mostraPaginacaoVeiculo">';
						
						for($i = 1; $i <= $QtdPagina; $i++)
						{
							echo '<a onClick="paginacao(\'RelatorioVeiculo.php\', '.$i.')" style="cursor:pointer;"> '.$i.'</a>';
						}
						
						echo '</div>';				
						
						/***********************************************************************************************/
						$i = 0;
						
						while ($Registro = mysql_fetch_array($Resultado)) 
						{
							if ($i % 2 == 0) 
							{
								$class = 'par';
							} else {
								$class = 'impar';
							}
							
							//######################## Mascarando dados para mostrar no relatório ########################//
							$PlacaLetras  = substr($Registro['Placa'], 0, 3);
							$PlacaNumero  = substr($Registro['Placa'], 3, 4);
							
							$PlacaMascarada = $PlacaLetras .'-'. $PlacaNumero;
							//############################################################################################//
														
						   ?>
						   <tr class="<?= $class ?>" id="itemContainer_<?=$Registro['Placa'];?>">	
                              <td id="veiculo"><? echo $Registro['Veiculo']; ?></td>	
							  <td><? echo utf8_decode($Registro['Modelo']); ?></td>
							  <td><? echo $PlacaMascarada ?></td>
							  <td><? echo utf8_decode($Registro['Cor']); ?></td>
                              <td><? echo $Registro['Ano']; ?></td>	
                              <td><? echo utf8_decode($Registro['Nome']); ?></td>
                              <td>
                              	<a onClick="excluiDados(<?=$Registro['Veiculo']?>)" style="cursor:pointer;">
                                <img src="images/delete5.png" alt="delete"></a>
                              </td>
                              <td>
                              		<a onClick="editaVeiculo('editarVeiculo.php', '<?=$Registro['Placa'];?>')" style="cursor:pointer;">
                                    <img src="images/pen.png" alt="alter"></a>
                              </td>
                           </tr>
						   <?
						   
						   $i++;
						}
						?>
                       
                    </tbody>
                </table> 
        	</FORM>
        </div>
        
        <!--<DIV class="figuraReportVeiculo">
        	<img src="images/veiculo5.png" alt="cadastro">
        </DIV>-->
        
        <div id="returnReportVeiculo">
        	<a href="MenuRelatorios.php"><input type="image" src="images/return4.png"></a>
            <a href="RelatorioPDFVeiculo.php" id="Printer"><input type="image" src="images/printer10.png"></a>
            <a href="MenuCadastro.php" id="Adicionar"><input type="image" src="images/add3.png"></a>
        </div>
    </body>
</html>