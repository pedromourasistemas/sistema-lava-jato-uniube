﻿<?
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
			  From lavajato.estados";

	$Resultado = mysql_query($Query);
	
	require_once("fpdf/fpdf.php");
	 
	$pdf= new FPDF("P","pt","A4");
	
	$pdf->AddPage();
	
	$pdf->SetFont('arial','B',18);
	$pdf->SetTextColor(0, 150, 256);
	$pdf->Cell(0,5,"Relatorio de Estados",0,1,'C');
	$pdf->Cell(0,5,"","B",1,'C');
	$pdf->Ln(8);
	
	$Num = 0;
	
	while($Registro = mysql_fetch_array($Resultado))
	{
		$Num       = $Num + 1; 						   
		$UF        = $Registro['UF'];
		$Descricao = $Registro['Descricao'];	 
				 
		//Numero
		$pdf->SetFont('arial','B',12);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->Cell(70,20,"Codigo:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(70,20,$Num,0,1,'L');
		
		//UF
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(70,20,"Sigla:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(70,20,$UF,0,1,'L'); 
		 
		//Descrição
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(70,20,"Descricao:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(0,20,$Descricao,0,1,'L');		
		
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(0,5,"","B",1,'C');
		
		$pdf->Ln();
	}
					 
	$pdf->Output("Estados" .rand(). ".pdf","D");
?>