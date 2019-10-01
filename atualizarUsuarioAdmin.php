<?php

require_once ("conexao.php");

//verifica se foi enviado algum valor
if (isset($_POST["atualizar"])) {

    $idUsuario = $_GET["idUsuario"];

    //recebe os valores enviados pelo formulário
    $nome = addslashes($_POST['nome']);
    $sobrenome = addslashes($_POST['sobrenome']);
    $usuario = addslashes($_POST['usuario']);
    $email = addslashes($_POST['email']);
    $nomeSite = addslashes($_POST['nomeSite']);
    $tipo = $_POST['tipo'];
    $ativo = $_POST['ativo'];

    $sqlValidacao = "SELECT * FROM Usuario 
                        WHERE idUsuario != '" . $idUsuario . "' 
                        AND (usuario = '" . $usuario . "' 
                        OR email = '" . $email . "');";
    $resultValidacao = $con->query($sqlValidacao) or die($con->error);

    if ($resultValidacao->num_rows > 0) {
        while ($rowValidacao = $resultValidacao->fetch_assoc()) {
            echo "<script language='javascript' type='text/javascript'>alert('ERRO: Já existe um perfil com o nome de usuário ou o e-mail informados.');javascript:history.go(-1);</script>";
            die();
        }
    }

    $sql = 'UPDATE Usuario 
                SET nome = "' . $nome . '", sobrenome = "' . $sobrenome . '", usuario = "' . $usuario . '", email = "' . $email . '", TipoUsuario_idTipoUsuario = ' . $tipo . ', nomeSite = "' . $nomeSite . '", ativo= '.$ativo.'
                WHERE idUsuario = ' . $idUsuario . ';';

    if ($con->query($sql) == true) {
        echo "<script language='javascript' type='text/javascript'>alert('Atualização realizada com sucesso!');window.location.href='exibirUsuarios.php';</script>";
    } else {
        echo "<script language='javascript' type='text/javascript'>alert('Erro ao atualizar!');</script>";
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);

}

?>

    