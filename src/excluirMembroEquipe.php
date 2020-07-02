<?php
include("include/header.php");

if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
    if (isAdmin($_SESSION['tipo'])){ //SE O USUÁRIO LOGADO FOR DO TIPO ADMINISTRADOR
		
	if(is_numeric($_GET["id"])){
		$SQL = "DELETE FROM MembroEquipe WHERE idMembroEquipe = ".$_GET["id"];
		if ($con->query($SQL) === TRUE) {
			$SQL = "DELETE FROM MembroEquipePendente WHERE idMembroEquipePendente = ".$_GET["id"];
			if ($con->query($SQL) === TRUE) {
				echo "<script>alert('Exclusão realizada com sucesso!');</script>";
				echo "<script>window.location = 'equipe.php';</script>";
			}else{
				echo "<script>alert('Erro ao realizar a exclusão!');</script>";
				echo "<script>window.location = 'equipe.php';</script>";
			}
		}
		else{
			echo "<script>alert('Erro ao realizar a exclusão!');</script>";
			echo "<script>window.location = 'equipe.php';</script>";
		}
	}

  }else {
    echo "<script>window.location = 'index.php';</script>";
  }
} else {
  echo "<script>window.location = 'index.php';</script>";
}
?>