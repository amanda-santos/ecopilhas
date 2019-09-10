<?php
  include("conexao.php"); //incluir arquivo com conexão ao banco de dados
  include("include/header.php");

  if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
    if (isAdmin($_SESSION['tipo'])){ //SE O USUÁRIO LOGADO FOR DO TIPO ADMINISTRADOR

        //SE ATUALIZAR POST
        if (isset($_POST["atualizar"])) {

          $endereco = addslashes($_POST["endereco"]);
          $telefone = addslashes($_POST["telefone"]);
          $email = addslashes($_POST["email"]);
          $horarioFunc = addslashes($_POST["horarioFunc"]);

          $autor = $_POST["autor"];
          $dataAlteracao = $_POST["dataAlteracao"];

          $autorAprovacao = $_SESSION['id'];

          $sql = "UPDATE contato SET endereco = '".$endereco."', telefone = '".$telefone."', email = '".$email."', horarioFunc = '".$horarioFunc."', dataAlteracao = '".$dataAlteracao."', autor = '".$autor."', dataAprovacao = CURRENT_TIME(), autorAprovacao = '".$autorAprovacao."' WHERE idContato = 1;";
          
          if ($con->query($sql) === TRUE) {

            $sql = "UPDATE contatopendente SET aprovacao = 1 WHERE idContatoPendente = 1;";
          
            if ($con->query($sql) === TRUE) {
              echo "<script>alert('Atualização realizada com sucesso!');</script>";
              echo "<script>window.location = 'associar.php';</script>";
            } else {
              echo "Erro: " . $sql . "<br>" . $con->error;
            }
            
          } else {
            echo "Erro: " . $sql . "<br>" . $con->error;
          }
          $con->close();
              
        } //fim se atualizar post
    }
  }

?>