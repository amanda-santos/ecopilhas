<?php

include "conexao.php";
//include "atualizar.php";

// session_start inicia a sessão
session_start();

// as variáveis login e senha recebem os dados digitados na página anterior
$login = $_POST['login'];
$senha = $_POST['senha'];

// A variavel $result pega as varias $login e $senha, faz uma pesquisa na tabela de usuarios
$sql = "SELECT * FROM ecopilhas.Usuario WHERE usuario = '" . $login . "' AND senha = '" . $senha . "';";
$result = $con->query($sql);
/* Logo abaixo temos um bloco com if e else, verificando se a variável $result foi bem sucedida, ou seja se ela estiver encontrado algum registro idêntico o seu valor será igual a 1, se não, se não tiver registros seu valor será 0. Dependendo do resultado ele redirecionará para a pagina site.php ou retornara  para a pagina do formulário inicial para que se possa tentar novamente realizar o login */

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
		if ($row['ativo'] == 1) {
			$_SESSION['id'] = $row['idUsuario'];
			$_SESSION['login'] = $row['usuario'];
			$_SESSION['tipo'] = $row['TipoUsuario_idTipoUsuario'];
			$_SESSION['senha'] = $row['senha'];
			header('location:indexAdmin.php');
		}else{
			unset($_SESSION['id']);
			unset($_SESSION['login']);
			unset($_SESSION['senha']);
			unset($_SESSION['tipo']);
			$mensagem = "Usuário inativo!";
			echo "<script>alert('" . $mensagem . "');window.location.href='login.html';</script>";
			die();
		}
    }
} else {
	unset($_SESSION['id']);
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    unset($_SESSION['tipo']);
    $mensagem = "Dados Incorretos!";
    echo "<script>alert('" . $mensagem . "');window.location.href='login.html';</script>";
    die();
}
?>
