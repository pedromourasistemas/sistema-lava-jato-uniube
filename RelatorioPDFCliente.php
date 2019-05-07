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

	$Query = "Select P.*, C.Descricao
			  From lavajato.pessoas P, lavajato.cidades C
			  Where P.Cidade = C.Cidade and
					P.Tipo   = 'C'";

	$Resultado = mysql_query($Query);
	
	require_once("fpdf/fpdf.php");
	 
	$pdf= new FPDF("P","pt","A4");
	
	$pdf->AddPage();
	
	$pdf->SetFont('arial','B',18);
	$pdf->SetTextColor(0, 150, 256);
	$pdf->Cell(0,5,"Relatório de Clientes",0,1,'C');
	$pdf->Cell(0,5,"","B",1,'C');
	$pdf->Ln(8);
	
	$Num = 0;
	
	while($Registro = mysql_fetch_array($Resultado))
	{
		$Num      = $Num + 1; 						   
		$CPF      = $Registro['CPF'];
		$Nome     = $Registro['Nome'];
		$Endereco = $Registro['Endereco'];
		$Bairro   = $Registro['Bairro'];
		$Numero   = $Registro['Numero'];
		$Telefone = $Registro['Telefone'];
		$Celular  = $Registro['Celular']; 
		$Cidade   = $Registro['Descricao'];
		$Tipo     = $Registro['Tipo'];			 
				 
		//Numero
		$pdf->SetFont('arial','B',12);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->Cell(70,20,"Código:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(70,20,$Num,0,1,'L');
		
		//CPF
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(70,20,"CPF:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(70,20,$CPF,0,1,'L'); 
		 
		//Nome
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(70,20,"Nome:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(0,20,$Nome,0,1,'L');		
		 
		//Endereço
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(70,20,"Endereço:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(70,20,$Endereco,0,1,'L');
		 
		//Bairro
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(70,20,"Bairro:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(70,20,$Bairro,0,1,'L');
		 
		//Numero
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(70,20,"Numero:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(70,20,$Numero,0,1,'L');
		 
		//Telefone
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(70,20,"Telefone:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(70,20,$Telefone,0,1,'L');
		
		//Celular
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(70,20,"Celular:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(70,20,$Celular,0,1,'L');
		
		//Cidade
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(70,20,"Cidade:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(70,20,$Cidade,0,1,'L');
		
		//Tipo
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(70,20,"Tipo:",0,0,'L');
		$pdf->setFont('arial','',12);
		$pdf->Cell(70,20,"Cliente",0,1,'L');
		
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(0,5,"","B",1,'C');
		
		$pdf->Ln();
	}
					 
	$pdf->Output("Clientes" .rand(). ".pdf","D");
?>