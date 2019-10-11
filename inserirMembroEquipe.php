<?php
  include("include/header.php");

  if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
    if (isAdmin($_SESSION['tipo'])){ //SE O USUÁRIO LOGADO FOR DO TIPO ADMINISTRADOR

      if (isset($_POST["cadastrar"])) {

        $nome = addslashes($_POST["nome"]);
        $cargo = addslashes($_POST["cargo"]);
        $descricao = addslashes($_POST["descricao"]);
        $email = addslashes($_POST["email"]);
        $autor = $_SESSION["id"];

        //recebe os valores enviados pelo formulário
        $file = $_FILES['img'];

        //permite debugar e ver o que foi enviado
        //var_dump($file);

        //conta quantas imagens foram enviadas
        $numFile = count(array_filter($file['name']));

        //define qual pasta a imagem será salva
        $folder = 'upload/img-membro-equipe';;

        //define os tipos suportados de arquivos enviados
        $permite = array("image/tif", "image/jpeg","image/png");
        $maxSize = 1024 * 1024 * 5;

        //Mensagens
        $msg = array(); //cria um array vazio
        //cria um array e já atribui valores das mensagens a ele.
        $erro = array(
          1 =>"O arquivo é maior que o limite definido no max_filesize.",
          2 => "O aquivo ultrapassa o limite de tamanho permitido no MAX_FILE_SIZE.",
          3 => "O upload do arquivo foi feito parcialmente.",
          4 => "Não foi feito o upload do arquivo."
        );

        if ($numFile<=0) {
          $img = "padrao.png";

          //define o comando sql para inserção do nome da imagem no banco de dados
          $SQL = 'INSERT INTO MembroEquipe (nome, email, descricao, cargo, img, Usuario_idUsuario_autor, dataAlteracao, Usuario_idUsuario_autorAprovacao, dataAprovacao) 
                    VALUES ("' . $nome . '","' . $email . '","' . $descricao . '","' . $cargo . '", "' . $img . '", ' . $autor . ', CURRENT_TIME(), ' . $autor . ', CURRENT_TIME());';

          if ($con->query($SQL) === TRUE){
            //verifica se o comando foi executado com sucesso

            $SQL = 'INSERT INTO MembroEquipePendente (nome, email, descricao, cargo, img, Usuario_idUsuario, dataAlteracao, aprovacao) 
                      VALUES ("' . $nome . '","' . $email . '","' . $descricao . '","' . $cargo . '", "' . $img . '", ' . $autor . ', CURRENT_TIME(), 1);';

            if ($con->query($SQL) === TRUE){
              echo "<script>alert('Cadastro realizado com sucesso!');</script>";
              echo "<script>window.location = 'equipe.php';</script>";
            }else{
              //mensagem exibida caso ocorra algum erro na execução do comando sql
              echo "<script>alert('Erro ao cadastrar membro da equipe!');</script>";
              echo "Erro: ". $SQL. "<br>" . $con->error;
            }

          }else{
            //mensagem exibida caso ocorra algum erro na execução do comando sql
            echo "<script>alert('Erro ao cadastrar membro da equipe!');</script>";
            echo "Erro: ". $SQL. "<br>" . $con->error;
          }

        } else {
          for ($i=0; $i < $numFile; $i++) {

            $name = $file["name"][$i]; //pega o nome
            $type = $file["type"][$i]; //pega o tipo
            $size = $file["size"][$i]; //pega o tamanho
            $error = $file["error"][$i]; //pega os erros
            $tmp = $file["tmp_name"][$i]; //pega o nome temporário do arquivo quando ele está sendo passado do cliente para o servidor
            $extensao = @end(explode(".", $name)); //pega extensão de cada arquivo

            //var_dump($extensao); //para debugar e ver se está pegando a extensão dos arquivos

            $img = rand().".$extensao"; //gera um novo nome único para os arquivos. Poderia também usar a função md5 do php 

            //abaixo estamos tratando as mensagens a serem exibidas para o usuário, em casos de erro ou sucesso no upload
            if ($error != 0) { //se não houver erro ao carregar a imagem
              $msg[] = "<b>$name: </b>".$erro[$error];

            } else if(!in_array($type, $permite)) {
              $msg[] = "<b>$name: </b>ERRO: Tipo de arquivo não suportado. Escolha arquivo do tipo .jpg e .png.";

            } else if ($size > $maxSize) {
              $msg[] = "<b>$name: </b>ERRO: Tamanho do arquivo é maior que o permitido.";

            } else {
              //move o arquivo para a pasta definida
              if (move_uploaded_file($tmp, $folder."/".$img)) {
                //trecho para gravar a imagem na pasta e para gravar os dados na pasta da imagem no banco de dados

                $sql = 'INSERT INTO MembroEquipe (nome, email, descricao, cargo, img, Usuario_idUsuario_autor, dataAlteracao, Usuario_idUsuario_autorAprovacao, dataAprovacao) 
                          VALUES ("' . $nome . '","' . $email . '","' . $descricao . '","' . $cargo . '", "' . $img . '", ' . $autor . ', CURRENT_TIME(), ' . $autor . ', CURRENT_TIME());';
                
                if ($con->query($sql) === TRUE) {
                  
                  //verifica se o comando foi executado com sucesso
                  
                  $SQL = 'INSERT INTO MembroEquipePendente (nome, email, descricao, cargo, img, Usuario_idUsuario, dataAlteracao, aprovacao) 
                            VALUES ("' . $nome . '","' . $email . '","' . $descricao . '","' . $cargo . '", "' . $img . '", ' . $autor . ', CURRENT_TIME(), 1);';

                  if ($con->query($SQL) === TRUE){
                    echo "<script>alert('Cadastro realizado com sucesso!');</script>";
                    echo "<script>window.location = 'equipe.php';</script>";
                  }else{
                    //mensagem exibida caso ocorra algum erro na execução do comando sql
                    echo "<script>alert('Erro ao cadastrar membro da equipe!');</script>";
                    echo "Erro: ". $SQL. "<br>" . $con->error;
                  }

                } else {
                  echo "Erro: " . $sql . "<br>" . $con->error;
                }
                $con->close();

              } else {
                $msg[] = "<b>$name: </b> Desculpe! Ocorreu um erro ao fazer upload da imagem.";
              }
            }
          }

          //var_dump($msg); //para debugar e ver o conteúdo da variável $msg
          foreach ($msg as $mensagem) {
            echo $mensagem."<br>";
          }
          
        }    
      } //fim se atualizar post
    }
  }

?>