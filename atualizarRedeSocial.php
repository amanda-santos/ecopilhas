<?php
  include("conexao.php"); //incluir arquivo com conexão ao banco de dados
  include("include/header.php");

  if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
    //if (($_SESSION['tipo'] == 4) || ($_SESSION['tipo'] == 6) || ($_SESSION['tipo'] == 7)){ //SE O USUÁRIO LOGADO FOR DO TIPO ADMINISTRADOR

        //SE ATUALIZAR POST
        if (isset($_POST["atualizar"])) {

          // facebook
          $linkF = addslashes($_POST["linkF"]);
          if (isset($_POST['mostrarF'])){
            $mostrarF = 1;
          }else{
            $mostrarF = 0;
          }

          $sql = "UPDATE ecopilhas.RedeSocial SET link = '".$linkF."', mostrar = '".$mostrarF."' WHERE idRedeSocial = 1;";
          
          if ($con->query($sql) === TRUE) {
            
            // twitter
            $linkTw = addslashes($_POST["linkTw"]);
            if (isset($_POST['mostrarTw'])){
              $mostrarTw = 1;
            }else{
              $mostrarTw = 0;
            }

            $sql = "UPDATE ecopilhas.RedeSocial SET link = '".$linkTw."', mostrar = '".$mostrarTw."' WHERE idRedeSocial = 2;";
            
            if ($con->query($sql) === TRUE) {

              // google+
              $linkG = addslashes($_POST["linkG"]);
              if (isset($_POST['mostrarG'])){
                $mostrarG = 1;
              }else{
                $mostrarG = 0;
              }

              $sql = "UPDATE ecopilhas.RedeSocial SET link = '".$linkG."', mostrar = '".$mostrarG."' WHERE idRedeSocial = 3;";
              
              if ($con->query($sql) === TRUE) {

                // tumblr
                $linkTu = addslashes($_POST["linkTu"]);
                if (isset($_POST['mostrarTu'])){
                  $mostrarTu = 1;
                }else{
                  $mostrarTu = 0;
                }

                $sql = "UPDATE ecopilhas.RedeSocial SET link = '".$linkTu."', mostrar = '".$mostrarTu."' WHERE idRedeSocial = 4;";
                
                if ($con->query($sql) === TRUE) {

                  // instagram
                  $linkI = addslashes($_POST["linkI"]);
                  if (isset($_POST['mostrarI'])){
                    $mostrarI = 1;
                  }else{
                    $mostrarI = 0;
                  }

                  $sql = "UPDATE ecopilhas.RedeSocial SET link = '".$linkI."', mostrar = '".$mostrarI."' WHERE idRedeSocial = 5;";
                  
                  if ($con->query($sql) === TRUE) {

                    echo "<script>alert('Atualização realizada com sucesso!');</script>";
                    echo "<script>window.location = 'index.php';</script>";
                    
                  } else {
                    echo "Erro: " . $sql . "<br>" . $con->error;
                  }
                  
                } else {
                  echo "Erro: " . $sql . "<br>" . $con->error;
                }
                
              } else {
                echo "Erro: " . $sql . "<br>" . $con->error;
              }
              
            } else {
              echo "Erro: " . $sql . "<br>" . $con->error;
            }

          } else {
            echo "Erro: " . $sql . "<br>" . $con->error;
          }

          $con->close();
              
        } //fim se atualizar post
    //}
  }

?>