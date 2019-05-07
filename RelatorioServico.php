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
    	<title>Relatório de Serviços</title>
        
        <script>
			function editaServico(Pagina, Id)
			{
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
		</script>
        
        <script>
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
			
			function excluiDados(Servico)
			{
				$.ajax({
					url: 'excluirServico.php',
					type: 'post',
					datatype: 'text',
					data: {Servico :Servico},
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
        <h1 id="tituloRelatorioServico">RELATÓRIO DE SERVIÇOS</h1>
        
    	<div id="divRelatorioServico">
        	<FORM action="excluirServico.php" method="GET">
                <table id="tableReportServico" align="center" style="margin-top:300px"  border="1">
                    <tbody>
                        <tr id="titulosServico">
                           <td><b>Código</b></td>
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
                            
						$Query = "Select *
								  From lavajato.servicos
								  Order By Descricao
								  Limit $Inicio, $Limite";

						$Resultado = mysql_query($Query);					
						
						/***********************************************************************************************/					
                       	$SqlCont = mysql_query("Select *
								  			    From lavajato.servicos");
													 
     				    $QtdTotalReg = mysql_num_rows($SqlCont);
						
						$QtdPagina = ceil($QtdTotalReg / $Limite);
						
						echo '<div id="mostraPaginacaoServico">';
						
						for($i = 1; $i <= $QtdPagina; $i++)
						{
							echo '<a onClick="paginacao(\'RelatorioServico.php\', '.$i.')" style="cursor:pointer;"> '.$i.'</a>';
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
							
						   ?>
						   <tr class="<?= $class ?>" id="itemContainer_<?=$Registro['Servico']?>">	
                           	  <td><? echo $Registro['Servico']; ?></td>	
							  <td><? echo utf8_decode($Registro['Descricao']); ?></td>
							  <td><? echo "R$ " .$Registro['Valor']; ?></td>
                              <td>
                              	<a onClick="excluiDados(<?=$Registro['Servico']?>)" style="cursor:pointer;">
                                <img src="images/delete5.png" alt="delete"></a>
                              </td>
                              <td>
                              	<a onClick="editaServico('editarServico.php', <?= $Registro['Servico']; ?>)" style="cursor:pointer;">
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
        
        <!--<DIV class="figuraReportServico">
        	<img src="images/servicos.png" alt="cadastro">
        </DIV>-->
        
        <div id="resultado" ></div>
        
        <div id="returnReportCidade">
        	<a href="MenuRelatorios.php"><input type="image" src="images/return4.png"></a>
            <a href="RelatorioPDFServico.php" id="Printer"><input type="image" src="images/printer10.png"></a>
            <a href="MenuCadastro.php" id="Adicionar"><input type="image" src="images/add3.png"></a>
        </div>
    </body>
</html>