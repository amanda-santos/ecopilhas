<?php
include("conexao.php"); //incluir arquivo com conexão ao banco de dados
include("include/header.php");

if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
    if (($_SESSION['tipo'] != 'socio') && ($_SESSION['tipo'] != 'dependente')) { //SE O USUÁRIO LOGADO FOR DO TIPO ADMINISTRADOR
		
	if(is_numeric($_GET["id"])){
		$SQL = "DELETE FROM imagem WHERE idImagem = ".$_GET["id"];
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

  }else {
    echo "<script>window.location = 'index.php';</script>";
  }
} else {
  echo "<script>window.location = 'index.php';</script>";
}
?>