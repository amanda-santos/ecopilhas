<?php
include("include/header.php");

if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO		
	if(is_numeric($_GET["id"])){
		$SQL = "DELETE FROM Imagem WHERE idImagem = ".$_GET["id"];
		if ($con->query($SQL) === TRUE) {
			echo "<script>alert('Imagem excluída com sucesso!');</script>";
			echo "<script>window.location = 'galeria.php';</script>";
		}else{
			echo "<script>alert('Erro ao excluir a imagem!');</script>";
			echo "<script>window.location = 'galeria.php';</script>";
		}
	}else{
		echo "<script>window.location = 'index.php';</script>";
	}
} else {
  echo "<script>window.location = 'index.php';</script>";
}
?>