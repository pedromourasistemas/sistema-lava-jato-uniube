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

	$Query = "Select V.*, P.Nome
			  From lavajato.veiculos V, lavajato.pessoas P
			  Where V.CPF = P.CPF";

	$Resultado = mysql_query($Query);
	
	require_once("fpdf/fpdf.php");

	$pdf= new FPDF("P","pt","A4");
	
	$pdf->AddPage();
	
	$pdf->SetFont('arial','B',18);
	$pdf->SetTextColor(0, 150, 256);
	$pdf->Cell(0,5,"Relatorio de Veiculos",0,1,'C');
	$pdf->Cell(0,5,"","B",1,'C');
	$pdf->Ln(8);
	
	$Num = 0;
	
	while($Registro = mysql_fetch_array($Resultado))
	{
		$Num    = $Num + 1;						   
		$Nome   = $Registro['Nome'];
		$Modelo = $Registro['Modelo'];	
		$Placa  = $Registro['Placa'];
		$Cor    = $Registro['Cor']; 
		$Ano    = $Registro['Ano'];
				 
		//Numero
		$pdf->SetFont('arial','B',12);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->Cell(70,20,"Codigo:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(70,20,$Num,0,1,'L');
		
		//Nome
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(70,20,"Nome:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(70,20,$Nome,0,1,'L'); 
		 
		//Modelo
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(70,20,"Modelo:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(0,20,$Modelo,0,1,'L');	
		
		//Placa
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(70,20,"Placa:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(0,20,$Placa,0,1,'L');
		
		//Cor
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(70,20,"Cor:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(0,20,$Cor,0,1,'L');
		
		//Ano
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(70,20,"Ano:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(0,20,$Ano,0,1,'L');	
		
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(0,5,"","B",1,'C');
		
		$pdf->Ln();
	}
					 
	$pdf->Output("Veiculos" .rand(). ".pdf","D");
?>