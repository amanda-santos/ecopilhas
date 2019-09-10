<?php
include("conexao.php"); //incluir arquivo com conexão ao banco de dados
include("include/header.php");

if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
    if (isAdmin($_SESSION['tipo'])){ //SE O USUÁRIO LOGADO FOR DO TIPO ADMINISTRADOR
		
	if(is_numeric($_GET["id"])){
		$SQL = "DELETE FROM diretoria WHERE idDiretor = ".$_GET["id"];
		if ($con->query($SQL) === TRUE) {
			$SQL = "DELETE FROM diretoriapendente WHERE idDiretorPendente = ".$_GET["id"];
			if ($con->query($SQL) === TRUE) {
				echo "<script>alert('Exclusão realizada com sucesso!');</script>";
				echo "<script>window.location = 'diretoria.php';</script>";
			}else{
				echo "<script>alert('Erro ao realizar a exclusão!');</script>";
				echo "<script>window.location = 'diretoria.php';</script>";
			}
		}
		else{
			echo "<script>alert('Erro ao realizar a exclusão!');</script>";
			echo "<script>window.location = 'diretoria.php';</script>";
		}
	}

  }else {
    echo "<script>window.location = 'index.php';</script>";
  }
} else {
  echo "<script>window.location = 'index.php';</script>";
}
?>