<?php
  include("conexao.php"); //incluir arquivo com conexão ao banco de dados
  include("include/header.php");

  if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
    if (($_SESSION['tipo'] != 'socio') && ($_SESSION['tipo'] != 'dependente') && (isAdmin($_SESSION['tipo']) == false)) { 

        $sql = "SELECT aprovacao FROM contatopendente WHERE idContatoPendente = 1;";

        $result = $con->query($sql);

        if ($result->num_rows > 0) { // Exibindo cada linha retornada com a consulta
          while ($exibir = $result->fetch_assoc()){
            $aprovacao = $exibir["aprovacao"];
            if ($aprovacao == 0) {
              echo "<script>alert('ERRO: Por favor, aguarde a aprovação das atualizações pendentes.');
                            window.location.href='associar.php';
                    </script>";
              exit;
            }
          } // fim while
        } else { //se não achar nenhum registro
          echo "<script>alert('Não há dados cadastrados com o id informado.');
                        window.location.href='associar.php';
                </script>";
          exit;
        }

        //SE ATUALIZAR POST
        if (isset($_POST["atualizar"])) {

          $endereco = addslashes($_POST["endereco"]);
          $telefone = addslashes($_POST["telefone"]);
          $email = addslashes($_POST["email"]);
          $horarioFunc = addslashes($_POST["horarioFunc"]);

          $autor = $_SESSION['id'];

          $sql = "UPDATE contatopendente SET endereco = '".$endereco."', telefone = '".$telefone."', email = '".$email."', horarioFunc = '".$horarioFunc."', dataAlteracao = CURRENT_TIME(), autor = '".$autor."', aprovacao = 0 WHERE idContatoPendente = 1;";
          
          if ($con->query($sql) === TRUE) {
            echo "<script>alert('Atualização realizada com sucesso! Por favor, aguarde a aprovação.');</script>";
            echo "<script>window.location = 'associar.php';</script>";
          } else {
            echo "Erro: " . $sql . "<br>" . $con->error;
          }
          $con->close();
              
        } //fim se atualizar post
    }
  }

?>