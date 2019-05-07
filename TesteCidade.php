<?
	include('Conexao.php');

	$UF = $_GET['UF'];
		
	$sql = "SELECT Cidade, Descricao
			FROM lavajato.cidades
			WHERE UF = '$UF'
			ORDER BY Descricao";
			
	$res = mysql_query($sql);	
	
	$Html = "";
		
	while($row = mysql_fetch_assoc($res)) 
	{
		echo '<option value="'.$row["Cidade"].'">'.utf8_encode($row["Descricao"]).'</option>';
	}
		
?>	                                
