<?php
include("conexao.php"); //incluir arquivo com conexão ao banco de dados
include("include/header.php");

if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
    if (isAdmin($_SESSION['tipo'])){ //SE O USUÁRIO LOGADO FOR DO TIPO ADMINISTRADOR
		
	if((is_numeric($_GET["idPost"])) && (is_numeric($_GET["idSecao"]))){
		$idPost = $_GET["idPost"];
		$idSecao = $_GET["idSecao"];
		$SQL = "DELETE FROM ecopilhas.Post WHERE idPost = ".$idPost;
		if ($con->query($SQL) === TRUE) {
			$SQL = "DELETE FROM ecopilhas.PostPendente WHERE idPostPendente = ".$idPost;
			if ($con->query($SQL) === TRUE) {
				echo "<script>alert('Exclusão realizada com sucesso!');</script>";
				echo "<script>window.location = 'postagens.php?id=". $idSecao."';</script>";
			}else{
				echo "<script>alert('Erro ao realizar a exclusão!');</script>";
				echo "<script>window.history.go(-1);</script>";
			}
		}
		else{
			echo "<script>alert('Erro ao realizar a exclusão!');</script>";
			echo "<script>window.history.go(-1);</script>";
		}
	}

  }else {
    echo "<script>window.location = 'index.php';</script>";
  }
} else {
  echo "<script>window.location = 'index.php';</script>";
}
?>