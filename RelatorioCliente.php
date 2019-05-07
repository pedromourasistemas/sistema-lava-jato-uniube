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
    	<title>Relatório de Clientes</title>	
        
        <script>
			function editaPessoa(Pagina, Id)
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
			
			function salvaDados()
			{
				var CPF      = $('#cpf').val();
				var Nome     = $('#nome').val();
				var Endereco = $('#endereco').val();
				var Bairro   = $('#bairro').val();
				var Numero   = $('#numero').val();
				var Telefone = $('#telefone').val();
				var Celular  = $('#celular').val();
				var Cidade   = $('#cidade').val();
				var Tipo     = $('#tipo').val();
																		
				$.ajax({
					url: 'alterarPessoa.php',
					type: 'post',
					datatype: 'text',
					data: {"CPF" :CPF, "Nome" :Nome, "Endereco" :Endereco, "Bairro" :Bairro, "Numero" :Numero, 
						   "Telefone" :Telefone, "Celular" :Celular, "Cidade" :Cidade, "Tipo" :Tipo},
					success: function(r)
					{	
						var Result = r.split('|');
						
						if(Result[0] == 1)
						{
							alert(Result[1]);
							chamaPagina('RelatorioCliente.php');
						}
						else
						{
							alert(Result[1]);
							chamaPagina('RelatorioCliente.php');
						}
					}					
				});	
			}
			
			function excluiDados(CPF)
			{
				$.ajax({
					url: 'excluirPessoa.php',
					type: 'post',
					datatype: 'text',
					data: {CPF :CPF},
					success: function(r)
					{	
						var Result = r.split('|');
						
						if(Result[0] == 1)
						{
							alert(Result[1]);
							chamaPagina('RelatorioCliente.php');
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
        <H1 id="tituloRelatorioPessoas">RELATÓRIO DE CLIENTES</H1>
        
    	<div id="divRelatorioPessoa">
        	<FORM action="excluirPessoa.php" method="get">
                <table id="tableReportPessoa" align="center" style="margin-top:300px"  border="1">
                    <tbody>
                        <tr id="titulosPessoa">
	                       <td width="110px"><b>CPF</b></td>
                           <td><b>Nome</b></td>                           
                           <td><b>Endereço</b></td>
                           <td><b>Bairro</b></td>
                           <td><b>Número</b></td>                           
                           <td><b>Telefone</b></td>
                           <td><b>Celular</b></td>
                           <td><b>Cidade</b></td>
                           <td><b>Tipo</b></td>
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
								 
						$Query = "Select P.*, C.Descricao
								  From lavajato.pessoas P, lavajato.cidades C
								  Where P.Cidade = C.Cidade and
									    P.Tipo   = 'C'
								  Order By P.Nome Limit $Inicio, $Limite";

						$Resultado = mysql_query($Query);
						
						/***********************************************************************************************/					
                       	$SqlCont = mysql_query("Select P.*, C.Descricao
											    From lavajato.pessoas P, lavajato.cidades C
											    Where P.Cidade = C.Cidade and
												      P.Tipo   = 'C'");
													 
     				    $QtdTotalReg = mysql_num_rows($SqlCont);
						
						$QtdPagina = ceil($QtdTotalReg / $Limite);
						
						echo '<div id="mostraPaginacaoCliente">';
						
						for($i = 1; $i <= $QtdPagina; $i++)
						{
							echo '<a onClick="paginacao(\'RelatorioCliente.php\', '.$i.')" style="cursor:pointer;"> '.$i.'</a>';
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
							$CPFFirst  = " ";
							$CPFMiddle = " ";
							$CPFLast   = " ";
							$CPFDigito = " ";
							
							$CPFFirst  = substr($Registro['CPF'], 0, 3);
							$CPFMiddle = substr($Registro['CPF'], 3, 3);
							$CPFLast   = substr($Registro['CPF'], 6, 3);
							$CPFDigito = substr($Registro['CPF'], 9, 2);	
							
							$CPFMascarado = $CPFFirst .'.'. $CPFMiddle .'.'. $CPFLast .'-'. $CPFDigito;
							
							$DDD        = substr($Registro['Telefone'], 0, 2);
							$TelefoneP1 = substr($Registro['Telefone'], 2, 4);
							$TelefoneP2 = substr($Registro['Telefone'], 4, 4);
							
							$TelefoneMascarado = '('. $DDD .')'. $TelefoneP1 .'-'. $TelefoneP2;
							
							$DDD       = substr($Registro['Celular'], 0, 2);
							$CelularP1 = substr($Registro['Celular'], 2, 4);
							$CelularP2 = substr($Registro['Celular'], 4, 4);
							
							$CelularMascarado = '('. $DDD .')'. $CelularP1 .'-'. $CelularP2;							
							//#############################################################################################
							
						   ?>
						   <tr class="<?= $class ?>" id="itemContainer_<?=$Registro['CPF']?>">		
                        	  <td width="110px"><? echo $CPFMascarado ?></td>
							  <td width="160px"><? echo utf8_decode($Registro['Nome']); ?></td>
							  <td width="160px"><? echo utf8_decode($Registro['Endereco']); ?></td>
							  <td width="110px"><? echo utf8_decode($Registro['Bairro']); ?></td>
                              <td width="60px"><? echo $Registro['Numero']; ?></td>
                              <td width="100px"><? echo $TelefoneMascarado ?></td>
                              <td width="100px"><? echo $CelularMascarado ?></td>
                              <td width="160px"><? echo utf8_decode($Registro['Descricao']); ?></td>
                              <td width="50px"><?
							  		if($Registro['Tipo'] == 'C')
									{ 
										echo "Cliente";
									}
								  ?>
                              </td>
                              <td width="50px">
                              	<a onClick="excluiDados(<?=$Registro['CPF']?>)" style="cursor:pointer;">
                                <img src="images/delete5.png" alt="delete"></a>
                              </td>
                              <td width="50px">
                              	<a onClick="editaPessoa('editarPessoa.php', <?= $Registro['CPF']; ?>)" style="cursor:pointer;">
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
        
        <!--<DIV class="figuraReportCliente">
        	<img src="images/Icones64x64/IconeRelatorio1.png" alt="cadastro">
        </DIV>-->
        
        <div id="resultado" ></div>
        
        <DIV id="returnReportCliente">
        	<a href="MenuRelatorios.php"><input type="image" src="images/return4.png"></a>
            <a href="RelatorioPDFCliente.php" id="Printer"><input type="image" src="images/printer10.png"></a>
            <a href="MenuCadastro.php" id="Adicionar"><input type="image" src="images/add3.png"></a>
        </DIV>
    </BODY>
</HTML>