<?php
	//Confere se existe usuário logado, impedindo acesso direto as paginas.
	session_start();
	if((!isset ($_SESSION['username']) == true) and (!isset ($_SESSION['password']) == true)){
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		$mensagem = "Acesso não permitido. Faça o Login para poder acessar!";
		$_SESSION['mensagem'] = $mensagem;
		header("Location: login.php");
		exit;
	}
	$username = $_SESSION['username'];
?>