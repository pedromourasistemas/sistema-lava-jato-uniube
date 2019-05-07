<!DOCTYPE html>
<HTML>

	<? include('Conexao.php'); 
		date_default_timezone_set("Brazil/East");
	?>    
    
	<HEAD>
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    	<TITLE>Relatório Ordem Serviço</TITLE>  
        
        <script>
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
		</script>      
    </HEAD>
    
    <body>
    	<?
			
			//$DataIni = $_GET['dataInicial'];			
											
				
			//$DateFim = $_GET['dataFinal'];							
																									   
			print_r(date('Y-m-d', strtotime($_GET['dataInicial'])));
			print_r(date('Y-m-d', strtotime($_GET['dataFinal'])));
        ?>
    	
        <form id="OrdemServico" action="TesteData.php" method="get">
        <div id="Filtros">
            <P>
                <b>Data Inicial </b><input type="text" onKeyPress="mascaraData(this);" name="dataInicial" id="dataInicial" maxlength="10">
                <b>Data Final </b><input type="text" onKeyPress="mascaraData(this);" name="dataFinal" id="dataFinal" maxlength="10">
                <input type="submit" name="pesquisar" id="pesquisar" value="Pesquisar" style="color:#000;" >
            </P>
        </div>
        </form>
	</body>
</HTML>