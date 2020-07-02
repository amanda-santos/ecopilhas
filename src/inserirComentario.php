<?php
  include("conexao.php"); //incluir arquivo com conexão ao banco de dados
  include("include/header.php");

      if (isset($_POST["enviar"])) {

        $nome = addslashes($_POST["nome"]);
        $comentario = addslashes($_POST["comentario"]);
        $idPost = $_GET["id"];

        $SQL = 'INSERT INTO ecopilhas.Comentario (nome, comentario, idPost, dataEnvio) VALUES ("' . $nome . '","' . $comentario . '",' . $idPost . ', CURRENT_TIME());';

        if ($con->query($SQL) === TRUE){
          echo "<script>window.location = 'post.php?id=".$idPost."';</script>";
        }else{
          //mensagem exibida caso ocorra algum erro na execução do comando sql
          echo "<script>alert('Erro ao enviar comentário!');</script>";
          echo "Erro: ". $SQL. "<br>" . $con->error;
        }

      } //fim se atualizar post
?>