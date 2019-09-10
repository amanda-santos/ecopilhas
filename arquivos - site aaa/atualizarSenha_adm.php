<?php

require_once ("conexao.php");
session_start();

//verifica se foi enviado algum valor
if (isset($_POST["atualizeSenha"])) {
    //recebe os valores enviados pelo formulário
    $login = $_GET['login'];
    $sqlVerifica = "select senha FROM perfil WHERE login = '" . $login . "';";
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
            $sql = 'UPDATE perfil SET senha="' . $nova .'" WHERE login = "' . $login . '";';
            if ($con->query($sql) === true) {
				$_SESSION['senha'] = $nova;
                echo"<script language='javascript' type='text/javascript'>alert('Senha atualizada com sucesso!');javascript:window.history.go(-1);</script>";
                die();
            } else {
                $errMSG = "1 error while inserting....2";
                echo $errMSG;
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        }
    }
}

?>

