<?php
  include("include/header.php");

  if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
    if (isAdmin($_SESSION['tipo'])){ //SE O USUÁRIO LOGADO FOR DO TIPO ADMINISTRADOR

      if (isset($_POST["cadastrar"])) {

        $titulo = addslashes($_POST["titulo"]);

        $SQL = 'INSERT INTO SecaoPaginas (titulo, exibir) VALUES ("' . $titulo . '", 1);';

        if ($con->query($SQL) === TRUE){
          echo "<script>alert('Cadastro realizado com sucesso!');</script>";
          echo "<script>window.location = 'index.php';</script>";
        }else{
          //mensagem exibida caso ocorra algum erro na execução do comando sql
          echo "<script>alert('Erro ao cadastrar seção!');</script>";
          echo "Erro: ". $SQL. "<br>" . $con->error;
        }

      } //fim se cadastrar

    }else {
      echo "<script>window.location = 'index.php';</script>";
    }
  } else {
    echo "<script>window.location = 'index.php';</script>";
  }
?>