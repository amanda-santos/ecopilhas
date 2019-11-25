<?php
  include("conexao.php"); //incluir arquivo com conexão ao banco de dados
  include("include/header.php");

  if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
    if (isAdmin($_SESSION['tipo'])){ //SE O USUÁRIO LOGADO FOR DO TIPO ADMINISTRADOR

      if (isset($_POST["cadastrar"])) {

        $titulo = addslashes($_POST["titulo"]);

        $SQL = 'INSERT INTO ecopilhas.Secao (nome, exibir, autor, dataAlteracao, autorAprovacao, dataAprovacao) VALUES ("' . $titulo . '", 1, ' . $_SESSION["id"] . ', CURRENT_TIME(), ' . $_SESSION["id"] . ', CURRENT_TIME());';

        if ($con->query($SQL) === TRUE){
          
          $sqlPendente = 'INSERT INTO ecopilhas.SecaoPendente (nome, autor, dataAlteracao, aprovacao) VALUES ("' . $titulo . '", ' . $_SESSION["id"] . ', CURRENT_TIME(), 1);';

          if ($con->query($sqlPendente) === TRUE){
            echo "<script>alert('Cadastro realizado com sucesso!');</script>";
            echo "<script>window.location = 'index.php';</script>";
          }else{
            //mensagem exibida caso ocorra algum erro na execução do comando sql
            echo "<script>alert('Erro ao cadastrar seção!');</script>";
            echo "Erro: ". $sqlPendente. "<br>" . $con->error;
          }

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