<?php
	$servidor = "ecopilhas.mysql.dbaas.com.br";
	$usuario = "ecopilhas";
	$senha = "EcoPilhas#2019";
	$nomeBD = "ecopilhas";
	$charset = 'utf8';
	$con = new mysqli($servidor, $usuario, $senha, $nomeBD);
	$con->set_charset($charset);
?>

