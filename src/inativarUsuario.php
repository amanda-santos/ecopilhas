<?php
    include 'conexao.php';
    include 'include/headerAdm.php';
    $idUsuario = $_GET['idUsuario'];

    $sql = 'UPDATE ecopilhas.Usuario SET ativo = 0 WHERE idUsuario = ' . $idUsuario . ';';

    if ($con->query($sql) == true) {
        echo "<script language='javascript' type='text/javascript'>alert('Usuário inativado com sucesso!');</script>";
        unset($_SESSION['usuario']);
        unset($_SESSION['senha']);
        unset($_SESSION['tipo']); 
        unset($_SESSION['id']);           
        echo "<script language='javascript' type='text/javascript'>window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('ERRO: Não foi possível inativar o perfil.');
                        javascript:window.history.go(-1);
                </script>";
        die();
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
    
?>