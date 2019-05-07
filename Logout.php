<?
	ob_start();
	//INICIALIZA A SESSÃO 
	session_start();
	
	//DESTRÓI AS SESSOES
	unset($_SESSION['cpf']); 
	unset($_SESSION['senha']);
	
	session_destroy(); 
	
	//REDIRECIONA PARA A TELA DE LOGIN 
	header("Location: Home.php");
?>