<?php
	
	include('Conexao.php');
	
	$Pagina       = $_POST['Pagina'];
	$QtdRegistros = $_POST['QtdRegistros'];
	$QtdPagina    = $_POST['QtdPagina'];
	
	if($Pagina == "")
	{
		$PagSelecionada = "1";
	}
	else
	{
		$PagSelecionada = $Pagina;
	}
	
	$QtdInicial = $PagSelecionada - 1; 
	$QtdInicial = $QtdInicial * $QtdRegistros;

		
	/*// Faz aparecer os numeros das página entre o ANTERIOR e PROXIMO
	for($Pag_Idx =1; $Pag_Idx < $quant_pg; $Pag_Idx++)
	{ 
		// Verifica se a página que o navegante esta e retira o link do número para identificar visualmente
		if ($_GET['pg'] == ($i_pg-1)) 
		{ 
			echo "&nbsp;<span class=pgoff>[$i_pg]</span>&nbsp;";
		} 
		else 
		{
			$i_pg2 = $i_pg-1;
			echo '&nbsp;<a href='.$_SERVER['PHP_SELF'].'?pg='.$i_pg2.' class=pg><b>'.$i_pg.'</b></a>&nbsp;';
		}
	}*/
	
?>