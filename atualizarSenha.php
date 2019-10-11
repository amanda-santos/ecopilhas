<?php

require_once ("conexao.php");
session_start();

//verifica se foi enviado algum valor
if (isset($_POST["atualizar"])) {
    //recebe os valores enviados pelo formulário
    $idUsuario = $_GET['idUsuario'];
    $sqlVerifica = "SELECT senha FROM ecopilhas.Usuario WHERE idUsuario = " . $idUsuario . ";";
    $resultVerifica = $con->query($sqlVerifica);

    if ($resultVerifica->num_rows > 0) {
        while ($row = $resultVerifica->fetch_assoc()) {
            $senha = $row['senha'];
        }
    }

    $atual = $_POST['atual'];
    $nova = addslashes($_POST['nova']);

    if ($atual != $senha) {
        echo"<script language='javascript' type='text/javascript'>alert('Senha atual incorreta!');javascript:window.history.go(-1);</script>";
    }else{
        //update dos valores do usuário
        if (!isset($errMSG)) {
            $sql = 'UPDATE Usuario SET senha="' . $nova .'" WHERE idUsuario = ' . $idUsuario . ';';
            if ($con->query($sql) === true) {
				$_SESSION['senha'] = $nova;
                echo"<script language='javascript' type='text/javascript'>alert('Senha atualizada com sucesso!');javascript:window.history.go(-1);</script>";
                die();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        }
    }
}

?>

