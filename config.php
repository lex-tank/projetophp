<?php
	function conectar(){
		$servidor = "localhost";
		$usuario = "id3944855_root";
		$senha= "rhadm";
		$bd = "id3944855_rhadm";

		$con = new mysqli($servidor,$usuario,$senha,$bd);
		mysqli_set_charset($con,"utf8");
		return $con;
	}

	$conexao = conectar();
?>