<?php
  include("conexao.php"); //incluir arquivo com conexão ao banco de dados
  include("include/header.php");

  if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
    //if (($_SESSION['tipo'] == 4) || ($_SESSION['tipo'] == 6) || ($_SESSION['tipo'] == 7)){ //SE O USUÁRIO LOGADO FOR DO TIPO ADMINISTRADOR

        //SE ATUALIZAR POST
        if (isset($_POST["atualizar"])) {

          $conteudo = addslashes($_POST["conteudoTituloIndex"]);

          $sql = "UPDATE itemsite SET conteudo = '".$conteudo."' WHERE idItemSite = 1;";
          
          if ($con->query($sql) === TRUE) {
            echo "<script>alert('Atualização realizada com sucesso!');</script>";
            echo "<script>window.location = 'index.php';</script>";
          } else {
            echo "Erro: " . $sql . "<br>" . $con->error;
          }
          $con->close();
              
        } //fim se atualizar post
    //}
  }

?>