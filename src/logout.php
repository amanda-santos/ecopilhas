<?php
session_start();
session_destroy();

//Limpa
unset($_SESSION['login']);
unset($_SESSION['senha']);
unset($_SESSION['tipo']);

//Redireciona para a página inicial
header('location:index.php');
?>
