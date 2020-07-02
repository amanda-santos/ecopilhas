<?php

require_once ("conexao.php");

//verifica se foi enviado algum valor
if (isset($_POST["cadastrar"])) {

    //recebe os valores enviados pelo formulário
    $nome = addslashes($_POST['nome']);
    $sobrenome = addslashes($_POST['sobrenome']);
    $usuario = addslashes($_POST['usuario']);
    $email = addslashes($_POST['email']);
    $nomeSite = addslashes($_POST['nomeSite']);
    $senha = addslashes($_POST['senha']);
    $tipo = $_POST['tipo'];

    $sqlValidacao = "SELECT * FROM Usuario 
            WHERE usuario = '" . $usuario . "'
            OR email = '" . $email . "';";
    $resultValidacao = $con->query($sqlValidacao) or die($con->error);

    if ($resultValidacao->num_rows > 0) {
        while ($rowValidacao = $resultValidacao->fetch_assoc()) {
            echo"<script language='javascript' type='text/javascript'>alert('ERRO: Já existe um perfil com o nome de usuário ou o e-mail informados.');javascript:history.go(-1);</script>";
            die();
        }
    }

    $sql = 'INSERT INTO Usuario (nome, sobrenome, usuario, email, senha, TipoUsuario_idTipoUsuario, nomeSite, ativo) 
                VALUES ("' . $nome . '", "' . $sobrenome . '", "' . $usuario . '", "' . $email . '", "' . $senha . '", ' . $tipo . ', "' . $nomeSite . '", 1);';

    if ($con->query($sql) == true) {
        echo "<script language='javascript' type='text/javascript'>alert('Cadastro realizado com sucesso!');window.location.href='exibirUsuarios.php';</script>";    
    } else {
        echo "<script language='javascript' type='text/javascript'>alert('Erro ao cadastrar!');</script>";
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);

}

?>

    