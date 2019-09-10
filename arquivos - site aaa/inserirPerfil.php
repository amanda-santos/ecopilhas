<?php

require_once ("conexao.php");

//verifica se foi enviado algum valor
if (isset($_POST["insertPerfil"])) {

    //recebe os valores enviados pelo formulário
    $nome = addslashes($_POST['nome']);
    $usuario = addslashes($_POST['usuario']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $tipo = $_POST['tipo'];

    if (!isset($errMSG)) {
        $sql = "SELECT * FROM perfil 
                WHERE login = '" . $usuario . "'
                OR email = '" . $email . "';";

        $result = $con->query($sql) or die($con->error);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo"<script language='javascript' type='text/javascript'>alert('ERRO: Já existe um perfil com o nome de usuário ou o e-mail informados.');window.location.href='cadastrarPerfil.php';</script>";
                die();
            }
        }
    }

    if (!isset($errMSG)) {

        $sql = 'INSERT INTO perfil (login, usuario, email, senha, fk_idTipoPerfil, ativo) VALUES ("' . $usuario . '", "' . $nome . '", "' . $email . '", "' . $senha . '", "' . $tipo . '", 1);';

        if ($con->query($sql) == true) {

            
        } else {
            echo"<script language='javascript' type='text/javascript'>alert('Erro ao cadastrar!.');window.location.href='cadastrarPerfil.php';</script>";
            die();

            $errMSG = "error while inserting....1";

            echo $errMSG;

            echo "Error: " . $sql . "<br>" . mysqli_error($con);

        }

    }

    mysqli_close($con);

}

echo"<script language='javascript' type='text/javascript'>alert('Cadastro realizado com sucesso!');window.location.href='exibirPerfis.php';</script>";

die();

?>

    