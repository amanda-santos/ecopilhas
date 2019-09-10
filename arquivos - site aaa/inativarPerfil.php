<?php

    include 'conexao.php';
    include 'include/headerAdm.php';
    $login = $_GET['login'];

    if ($login == null){
        echo "<script>window.location.href='index.php';</script>";
    }else{
        $sql = 'UPDATE perfil SET ativo = 0 WHERE login = "' . $login . '";';

        if ($con->query($sql) == true) {

            echo "<script language='javascript' type='text/javascript'>alert('Perfil inativado com sucesso!');</script>";
            unset($_SESSION['login']);
            unset($_SESSION['senha']);
            unset($_SESSION['tipo']); 
            unset($_SESSION['id']);           
            echo "<script language='javascript' type='text/javascript'>window.location.href='index.php';</script>";
        } else {

            echo "<script>alert('ERRO: Não foi possível inativar o perfil.');
                          javascript:window.history.go(-1);
                  </script>";
            die();
            $errMSG = "error while inserting....1";
            echo $errMSG;
            echo "Error: " . $sql . "<br>" . mysqli_error($con);

        }
    }

?>