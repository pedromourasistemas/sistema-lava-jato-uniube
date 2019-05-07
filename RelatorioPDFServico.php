<?
	session_start(); 
	
	if((!isset ($_SESSION['cpf']) == true) and (!isset ($_SESSION['senha']) == true)) 
	{ 
		unset($_SESSION['cpf']); 
		unset($_SESSION['senha']); 
		echo '<script>
				 alert("Faça o Login para acessar o Sistema!!");
		      </script>
			  
			  <meta http-equiv="refresh" content="0;url= Home.php">';
	} 
	
	$logado = $_SESSION['cpf'];
?>

<? 
	include('Conexao.php');    

	$Query = "Select *
			  From lavajato.servicos";

	$Resultado = mysql_query($Query);
	
	require_once("fpdf/fpdf.php");

	$pdf= new FPDF("P","pt","A4");
	
	$pdf->AddPage();
	
	$pdf->SetFont('arial','B',18);
	$pdf->SetTextColor(0, 150, 256);
	$pdf->Cell(0,5,"Relatorio de Servicos",0,1,'C');
	$pdf->Cell(0,5,"","B",1,'C');
	$pdf->Ln(8);
	
	while($Registro = mysql_fetch_array($Resultado))
	{
		$Num       = $Registro['Servico'];						   
		$Descricao = $Registro['Descricao'];
		$Valor     = $Registro['Valor'];
				 
		//Numero
		$pdf->SetFont('arial','B',12);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->Cell(70,20,"Codigo:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(70,20,$Num,0,1,'L');
		
		//Descricao
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(70,20,"Descricao:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(70,20,$Descricao,0,1,'L'); 
		 
		//Valor
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(70,20,"Valor:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(0,20,"R$ " .$Valor,0,1,'L');	
		
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(0,5,"","B",1,'C');
		
		$pdf->Ln();
	}
					 
	$pdf->Output("Servicos" .rand(). ".pdf","D");
?>