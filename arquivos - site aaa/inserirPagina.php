<?php
  include("conexao.php"); //incluir arquivo com conexão ao banco de dados
  include("include/header.php");

  if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
    if (isAdmin($_SESSION['tipo'])){ //SE O USUÁRIO LOGADO FOR DO TIPO ADMINISTRADOR

      if (isset($_POST["cadastrar"])) {

        $idSecaoPaginas = $_GET["idSecaoPaginas"];

        $titulo = addslashes($_POST["titulo"]);

        $SQL = 'INSERT INTO pagina (nome, idSecaoPaginas, autor, dataAlteracao, autorAprovacao, dataAprovacao, exibir) VALUES ("' . $titulo . '", ' . $idSecaoPaginas . ', ' . $_SESSION["id"] . ', CURRENT_TIME(), ' . $_SESSION["id"] . ', CURRENT_TIME(), 1);';

        if ($con->query($SQL) === TRUE){

          $sqlPaginaPendente = 'INSERT INTO paginapendente (nome, idSecaoPaginas, autor, dataAlteracao, aprovacao) VALUES ("' . $titulo . '", ' . $idSecaoPaginas . ', ' . $_SESSION["id"] . ', CURRENT_TIME(), 1);';

          if ($con->query($sqlPaginaPendente) === TRUE){

            echo "<script>alert('Cadastro realizado com sucesso!');</script>";
            echo "<script>window.location = 'editarSecaoPaginas.php?id=" . $idSecaoPaginas . "';</script>";

          }else{

            //mensagem exibida caso ocorra algum erro na execução do comando sql
            echo "<script>alert('Erro ao cadastrar seção!');</script>";
            echo "Erro: ". $sqlPaginaPendente. "<br>" . $con->error;
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