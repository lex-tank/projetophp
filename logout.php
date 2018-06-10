<?php
	//elimina as variaveis de sessão.
	session_start();
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    header("Location: login.php");
 ?>
