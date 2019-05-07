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
        <script src="js/jquery.maskedinput.js" type="text/javascript"> </script>
        <!--<script src="js/script.js"></script>-->
        <!-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>-->
        <!--<script src="js/jquery-2.1.0.js" type="text/javascript"> </script>-->
    	<TITLE>Relatório Ordem Serviço</TITLE>  
        
        <script>
			function editaOrdem(Pagina, Id)
			{
				alert("Cheguei na Function!");
				$('#imageCarregar').css("display","none");
												
				$.ajax({
					url: Pagina,
					type: 'post',
					datatype: 'text',
					data: {Id :Id},
					success: function(r)
					{	
						$('#resultado').css("display"," ");
						$('#itemContainer_'+Id).html(r);										
					}
				});	
			}
			
			<!-- Código Fonte para Máscarar Campos -->		
			$(document).ready(function()
			{
		       $("#dataInicial").mask("99/99/99");
			   $("#dataFinal").mask("99/99/99");
			});
			
			function mascaraData(campoData)
			{
				var DataInicial = document.forms["OrdemServico"]["dataInicial"].value;
				var DataFinal   = document.forms["OrdemServico"]["dataFinal"].value;
																
				//*********** Data Inicial ************
				if(DataInicial.length == 2)
				{
					DataInicial += '/';
					document.forms["OrdemServico"]["dataInicial"].value = DataInicial;
					return true;
				}
				if(DataInicial.length == 5)
				{
					DataInicial += '/';
					document.forms["OrdemServico"]["dataInicial"].value = DataInicial;
					return true;
				}
				
				//*********** Data Final ************
				if(DataFinal.length == 2)
				{
					DataFinal += '/';
					document.forms["OrdemServico"]["dataFinal"].value = DataFinal;
					return true;
				}
				
				if(DataFinal.length == 5)
				{
					DataFinal += '/';
					document.forms["OrdemServico"]["dataFinal"].value = DataFinal;
					return true;
				}				
			}
			
			function salvaDados()
			{
				var Servico   = $('#servico').val();
				var Descricao = $('#descricao').val();
				var Valor     = $('#valor').val();
														
				$.ajax({
					url: 'alterarServico.php',
					type: 'post',
					datatype: 'text',
					data: {Descricao :Descricao, Valor :Valor, Servico :Servico},
					success: function(r)
					{	
						var Result = r.split('|');
						
						if(Result[0] == 1)
						{
							alert(Result[1]);
							chamaPagina('RelatorioServico.php');
						}
						else
						{
							alert(Result[1]);
						}
					}					
				});	
			}
			
			function excluiDados(OrdemServico)
			{
				alert("Cheguei aqui!");
				$.ajax({
					url: 'excluirOrdemServico.php',
					type: 'post',
					datatype: 'text',
					data: {OrdemServico :OrdemServico},
					success: function(r)
					{	
						var Result = r.split('|');
						
						if(Result[0] == 1)
						{
							alert(Result[1]);
							chamaPagina('RelatorioOrdemServico.php');
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
    </HEAD>
    
    <BODY>
    	<div id="principal">                
                <div id="titulo">
                	<H1 id="tituloRelatorioOrdemServico">RELATÓRIO DE ORDEM DE SERVIÇO</H1>
                </div>
                
                <div id="divRelatorioOrdemServico">
                    <FORM id="OrdemServico" action="excluirOrdemServico.php" method="GET">
                    	<!--<div id="Filtros">                        	
                            <P>           
                            	<b id="FiltrosInfo">Filtros</b>                
                                <b id="dataInicial">Data Inicial </b>
                                <input type="date" onKeyPress="mascaraData(this);" name="dataInicial" id="dataInicial" maxlength="10">
                                <b id="dataFinal">Data Final </b>
                                <input type="date" onKeyPress="mascaraData(this);" name="dataFinal" id="dataFinal" maxlength="10">
                                <input type="submit" name="pesquisar" id="pesquisar" value="Pesquisar" style="color:#000;" >
                            </P>
                        </div>-->
                                        
                        <table id="tableReportOrdemServico" align="center" style="margin-top:300px;"  border="1">
                            <tbody>
                                <tr id="titulosOrdem">
                                   <td><b>Código</b></td>
                                   <td><b>Veículo</b></td>
                                   <td><b>Placa</b></td>
                                   <td><b>Data</b></td>
                                   <td><b>Hora</b></td>
                                   <td><b>Descrição</b></td>
                                   <td><b>Valor</b></td>
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
                                					
								if((empty($_GET['dataInicial'])) || (empty($_GET['dataFinal'])))
								{ 
									$Query ="Select S.*, V.Modelo, V.Placa
											 From lavajato.ordensservicos S, lavajato.veiculos V
											 Where S.Veiculo = V.Veiculo Limit $Inicio, $Limite";             
								}
								else
								{
									$Query ="Select S.*, V.Modelo, V.Placa
                                         	 From lavajato.ordensservicos S, lavajato.veiculos V
                                         	 Where S.Veiculo = V.Veiculo and
                                           S.Data >= '" . date('Y-m-d', strtotime($_GET['dataInicial'])) . "' and
                                           S.Data <= '" . date('Y-m-d', strtotime($_GET['dataFinal'])) . "' Limit $Inicio, $Limite";
								}      
																
                                $Resultado = mysql_query($Query);
                                
                                /***********************************************************************************************/					
								$SqlCont = mysql_query("Select S.*, V.Modelo, V.Placa
														From lavajato.ordensservicos S, lavajato.veiculos V
														Where S.Veiculo = V.Veiculo");
															 
								$QtdTotalReg = mysql_num_rows($SqlCont);
								
								$QtdPagina = ceil($QtdTotalReg / $Limite);
								
								echo '<div id="mostraPaginacaoOrdemServico">';
								
								for($i = 1; $i <= $QtdPagina; $i++)
								{
								  echo '<a onClick="paginacao(\'RelatorioOrdemServico.php\', '.$i.')" style="cursor:pointer;"> '.$i.'</a>';
								}
								
								echo '</div>';				
								
								/***********************************************************************************************/						
                                $i = 0;
								
                                while($Registro = mysql_fetch_array($Resultado)) 
                                {
									if ($i % 2 == 0) 
									{
										$class = 'par';
									} else {
										$class = 'impar';
									}
									
                                    $Data = $Registro['Data'];
                                    $Data = date('d/m/y', strtotime($Data));
									
									//######################## Mascarando dados para mostrar no relatório ########################//
									$PlacaLetras  = substr($Registro['Placa'], 0, 3);
									$PlacaNumero  = substr($Registro['Placa'], 3, 4);
									
									$PlacaMascarada = $PlacaLetras .'-'. $PlacaNumero;
									//############################################################################################//
									
                                   ?>
                                   <tr class="<?= $class ?>" id="itemContainer_<?=$Registro['OrdemServico']?>">	
                                      <td><? echo $Registro['OrdemServico']; ?></td>	
                                      <td><? echo $Registro['Modelo']; ?></td>
                                      <td><? echo $PlacaMascarada ?></td>
                                      <td><? echo $Data; ?></td>
                                      <td><? echo $Registro['Hora']; ?></td>
                                      <td><? echo $Registro['Descricao']; ?></td>
                                      <td><? echo "R$ " .$Registro['Valor']; ?></td>
                                      <td>
                                        <a onClick="excluiDados(<?=$Registro['OrdemServico']?>)" style="cursor:pointer;">
                                        <img src="images/delete5.png" alt="delete"></a>
                                      </td>
                                      <td>
                                        <a href="updateOrdemServico.php?OrdemServico=<?=$Registro['OrdemServico']?>">
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
                
                <!--<DIV class="figuraReportOrdemServico">
                    <img src="images/Icones64x64/IconeRelatorio8.png" alt="cadastro">
                </DIV>-->
                
                <div id="resultado" ></div>
                
                <div id="returnReportOrdemServico">
                    <a href="MenuRelatorios.php"><input type="image" src="images/return4.png"></a>
                    <a href="RelatorioPDFOrdemServico.php" id="Printer"><input type="image" src="images/printer10.png"></a>
                    <a href="MenuCadastro.php" id="Adicionar"><input type="image" src="images/add3.png"></a>
                </div>
        	</div>
    	</div>
    </BODY>
</HTML>