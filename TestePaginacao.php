<!DOCTYPE html>
<HTML>
		
	<? include('Conexao.php'); ?>
    
    <HEAD>
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    	<TITLE>Paginacao</TITLE>	
    </HEAD>

<body>
<div class="global-div">

<h1>Páginação Avançada com PHP</h1>

<?php
	//$pag = ($_GET['pag']);
	//$pag = filter_var($pag, FILTER_VALIDATE_INT);
	
	$pag = 1;
	
	$inicio = 0;
	$limite = 1	;
	
	if($pag!='')
	{
		$inicio = $pag - 1;
	} 
	
	$busca_total = mysql_query("SELECT COUNT(*) as total FROM servicos");
	$total = mysql_fetch_array($busca_total);
	$total = $total['total'];
	
	die($total);
	
	$busca = mysql_query("SELECT * FROM servicos LIMIT $inicio, $limite");
	if (mysql_num_rows($busca)>0)
	{
		while ($texto = mysql_fetch_array($busca))
		{
			extract($texto);
			echo '<h2>'.$texto['Servico'].'</h2>';
			echo '<p>'. nl2br($artigo).'</p>';
		}
		
		$prox = $pag + 1;
		$ant = $pag - 1;
		$ultima_pag = ceil($total / $limite);
		$penultima = $ultima_pag - 1;	
		$adjacentes = 2;
		
		echo '<div class="paginacao">';
		
		if ($pag>1)
		{
			$paginacao = '<a href="TestePaginacao.php?pag='.$ant.'">anterior</a>';
		}
		
		
		if ($ultima_pag <= 5)
		{
			for ($i=1; $i< $ultima_pag+1; $i++)
			{
				if ($i == $pag)
				{
					$paginacao .= '<a class="atual" href="TestePaginacao.php?pag='.$i.'">'.$i.'</a>';				
				} else {
					$paginacao .= '<a href="TestePaginacao.php?pag='.$i.'">'.$i.'</a>';	
				}
			}
		} 
	
		if ($ultima_pag > 5)
		{
			if ($pag < 1 + (2 * $adjacentes))
			{
				for ($i=1; $i< 2 + (2 * $adjacentes); $i++)
				{
					if ($i == $pag)
					{
						$paginacao .= '<a class="atual" href="TestePaginacao.php?pag='.$i.'">'.$i.'</a>';				
					} else {
						$paginacao .= '<a href="TestePaginacao.php?pag='.$i.'">'.$i.'</a>';	
					}
				}
				$paginacao .= '...';
				$paginacao .= '<a href="TestePaginacao.php?pag='.$penultima.'">'.$penultima.'</a>';
				$paginacao .= '<a href="TestePaginacao.php?pag='.$ultima_pag.'">'.$ultima_pag.'</a>';
			}
			elseif($pag > (2 * $adjacentes) && $pag < $ultima_pag - 3)
			{
				$paginacao .= '<a href="TestePaginacao.php?pag=1">1</a>';				
				$paginacao .= '<a href="TestePaginacao.php?pag=1">2</a> ... ';	
				for ($i = $pag-$adjacentes; $i<= $pag + $adjacentes; $i++)
				{
					if ($i == $pag)
					{
						$paginacao .= '<a class="atual" href="TestePaginacao.php?pag='.$i.'">'.$i.'</a>';				
					} else {
						$paginacao .= '<a href="TestePaginacao.php?pag='.$i.'">'.$i.'</a>';	
					}
				}
				$paginacao .= '...';
				$paginacao .= '<a href="TestePaginacao.php?pag='.$penultima.'">'.$penultima.'</a>';
				$paginacao .= '<a href="TestePaginacao.php?pag='.$ultima_pag.'">'.$ultima_pag.'</a>';
			}
			else {
				$paginacao .= '<a href="TestePaginacao.php?pag=1">1</a>';				
				$paginacao .= '<a href="TestePaginacao.php?pag=1">2</a> ... ';	
				for ($i = $ultima_pag - (4 + (2 * adjacentes)); $i <= $ultima_pag; $i++)
				{
					if ($i == $pag)
					{
						$paginacao .= '<a class="atual" href="TestePaginacao.php?pag='.$i.'">'.$i.'</a>';				
					} else {
						$paginacao .= '<a href="TestePaginacao.php?pag='.$i.'">'.$i.'</a>';	
					}
				}
			}
		}	
	}
		
	
	if ($prox <= $ultima_pag && $ultima_pag > 2)
	{
		$paginacao .= '<a href="TestePaginacao.php?pag='.$prox.'">pr&oacute;xima &raquo;</a>';
	}
	
	echo $paginacao;		
	echo '</div>';
?>

</div>

</body>
</HTML>