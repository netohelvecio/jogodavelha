<?php
	$servidor = "localhost"; //nome do servidor
	$usuario = "root"; //usuario do banco
	$senha = ""; //senha do banco
	$dbname = "bd_jogodavelha"; //nome do banco
	
	//Criar a conexão
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
?>