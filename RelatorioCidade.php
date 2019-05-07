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
    
	<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    	<TITLE>Relatório de Cidades</TITLE>	
        
        <script>
			function editaCidade(Pagina, Id)
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
				var Cidade    = $('#cidade').val();
				var Descricao = $('#descricao').val();
				var UF        = $('#uf').val();
														
				$.ajax({
					url: 'alterarCidade.php',
					type: 'post',
					datatype: 'text',
					data: {Descricao :Descricao, UF :UF, Cidade :Cidade},
					success: function(r)
					{	
						var Result = r.split('|');
						
						if(Result[0] == 1)
						{
							alert(Result[1]);
							chamaPagina('RelatorioCidade.php');
						}
						else
						{
							alert(Result[1]);
						}
					}					
				});	
			}
			
			function excluiDados(Cidade)
			{
				$.ajax({
					url: 'excluirCidade.php',
					type: 'post',
					datatype: 'text',
					data: {Cidade :Cidade},
					success: function(r)
					{	
						var Result = r.split('|');
						
						if(Result[0] == 1)
						{
							alert(Result[1]);
							chamaPagina('RelatorioCidade.php');
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
    
    <BODY>        
        <H1 id="tituloRelatorioCidade">RELATÓRIO DE CIDADES</H1>
        
    	<DIV id="divRelatorioCidade">
        	<FORM action="excluirCidade.php" method="POST">
            
            <div class="holder"></div>
            
                <table id="tableReportCidade" align="center" style="margin-top:300px"  border="1">
                    <tbody>
                        <tr id="titulosCidade">
                           <td><b>Código</b></td>
                           <td><b>Descrição</b></td>
                           <td><b>Estado</b></td>
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
								  From lavajato.cidades 
								  Order By Descricao Limit $Inicio, $Limite ";

						$Resultado = mysql_query($Query);					
						
						/*************************************** DADOS PAGINAÇÃO ***********************************/
						$SqlCont = mysql_query("Select *
								        	    From lavajato.cidades");
													 
     				    $QtdTotalReg = mysql_num_rows($SqlCont);
						
						$QtdPagina = ceil($QtdTotalReg / $Limite);
						
						echo '<div id="mostraPaginacaoCidade">';
						
						for($i = 1; $i <= $QtdPagina; $i++)
						{
							echo '<a onClick="paginacao(\'RelatorioCidade.php\', '.$i.')" style="cursor:pointer;"> '.$i.'</a>';
						}
						
						echo '</div>';
						
						/*******************************************************************************************/
						
						$i = 0;				
						
						while($Registro = mysql_fetch_array($Resultado)) 
						{							
							if ($i % 2 == 0) 
							{
								$class = 'par';
							} else {
								$class = 'impar';
							}
							
						   ?>
						   <tr class="<?= $class ?>" id="itemContainer_<? echo $Registro['Cidade']; ?>">	
                           	  <td><? echo $Registro['Cidade']; ?></td>	
							  <td><? echo $Registro['Descricao']; ?></td>
							  <td><? echo $Registro['UF']; ?></td>
                              <td>
                              	<a onClick="excluiDados(<?=$Registro['Cidade']?>)" style="cursor:pointer;">
                                <img src="images/delete5.png" alt="delete"></a>
                              </td>
                              <td>
                              	<a onClick="editaCidade('editarCidade.php', <?= $Registro['Cidade']; ?>)" style="cursor:pointer;">
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
        
        <!--<DIV class="figuraReportCidade">
        	<img src="images/Icones64x64/IconeRelatorio3.png" alt="cadastro">
        </DIV>-->
        
        <div id="resultado" ></div>
        
        <div id="returnReportCidade">
        	<a href="MenuRelatorios.php"><input type="image" src="images/return4.png"></a>
            <a href="RelatorioPDFCidade.php" id="Printer"><input type="image" src="images/printer10.png"></a>
            <a href="MenuCadastro.php" id="Adicionar"><input type="image" src="images/add3.png"></a>
        </div>
    </BODY>
</HTML>