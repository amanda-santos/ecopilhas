<?php
  include("include/header.php");
    if (isset($_POST["solicitar"])) {

        $nome = addslashes($_POST["nome"]);
        $email = addslashes($_POST["email"]);
        $telefone = addslashes($_POST["telefone"]);
        $tipo = $_POST["tipo"];
        $local = addslashes($_POST["local"]);
        $observacao = addslashes($_POST["observacao"]);

        $SQL = "INSERT INTO Solicitacao (nome, email, telefone, tipo, local, observacao, data)
                    VALUES ('".$nome."', '".$email."', '".$telefone."', ".$tipo.", '".$local."', '".$observacao."', CURRENT_TIME());";

        if ($con->query($SQL) === TRUE){
            echo "<script>alert('Solicitação enviada com sucesso! Em breve entraremos em contato com você.');</script>";
            echo "<script>window.location = 'cadastrarSolicitacao.php';</script>";
        }else{
            //mensagem exibida caso ocorra algum erro na execução do comando sql
            echo "<script>alert('Erro ao enviar solicitação!');</script>";
            echo "Erro: ". $SQL. "<br>" . $con->error;
        }

    } //fim se cadastrar
?>