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

	$Query = "Select S.*, V.Modelo, V.Placa
			  From lavajato.ordensservicos S, lavajato.veiculos V
			  Where S.Veiculo = V.Veiculo";

	$Resultado = mysql_query($Query);
	
	require_once("fpdf/fpdf.php");

	$pdf= new FPDF("P","pt","A4");
	
	$pdf->AddPage();
	
	$pdf->SetFont('arial','B',18);
	$pdf->SetTextColor(0, 150, 256);
	$pdf->Cell(0,5,"Relatorio de Ordem de Servicos",0,1,'C');
	$pdf->Cell(0,5,"","B",1,'C');
	$pdf->Ln(8);
	
	$Num = 0;
	
	while($Registro = mysql_fetch_array($Resultado))
	{
		$Num       = $Num + 1;
								   
		$Data      = $Registro['Data'];
		$Data      = date('d/m/y', strtotime($Data));
		
		$Hora      = $Registro['Hora'];
		$Descricao = $Registro['Descricao'];
		$Valor     = $Registro['Valor'];
		
				 
		//Numero
		$pdf->SetFont('arial','B',12);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->Cell(70,20,"Codigo:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(70,20,$Num,0,1,'L');
		
		//Data
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(70,20,"Data:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(70,20,$Data,0,1,'L');
		
		//Hora
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(70,20,"Hora:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(70,20,$Hora,0,1,'L');
		
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
					 
	$pdf->Output("OrdemServicos" .rand(). ".pdf","D");
?>