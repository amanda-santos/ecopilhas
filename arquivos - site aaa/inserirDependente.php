<?php
require_once ("conexao.php");

//verifica se foi enviado algum valor
if (isset($_POST["insertDependente"]) ) {
//recebe os valores enviados pelo formulário
    $nome = addslashes(ucwords($_POST['nome']));
    $dataNascimento = addslashes($_POST['dataNascimento']);
    $genero = $_POST['genero'];
    $cpf = addslashes($_POST['cpf']);
    $telefone = addslashes($_POST['telefone']);
    $telefone2 = addslashes($_POST['telefone2']);
    $email = addslashes(strtolower($_POST['email']));
    $parentesco = $_POST['parentesco'];
    $agregado = $_POST['agregado'];
    $matricula = (int) $_POST['matricula'];
    $idUsuario = "";
    $idAssociado = "";
    $tipoUser = "dependente";

    if($matricula == null) {
        echo"<script language='javascript' type='text/javascript'>alert('ERRO: A matrícula do associado é inválida. Tente novamente.');window.location.href='cadastrarDependente.php';</script>";
        die();
    }

    if ($agregado == 1) {
        $tipoUser = "dependente-agregado";
    }

    if (!isset($errMSG)) {
        $sql = 'INSERT INTO usuario(nome,cpf,login,senha,tipo) VALUES("' . $nome . '","' . $cpf . '","' . $cpf . '","' . $matricula . '","' . $tipoUser . '" );';

        if ($con->query($sql) == true) {
            $sql = "select idUsuario from usuario WHERE cpf='" . $cpf . "';";
            $result = $con->query($sql) or die($con->error);
            while ($row = $result->fetch_assoc()) {
                unset($id, $name);
                $idUsuario = $row['idUsuario'];
            }
        } else {
            $errMSG = "error while inserting....2";
            echo $errMSG;
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }

        $sql = "select idAssociado from associado WHERE matriculaAAA='" . $matricula . "';";
        $result = $con->query($sql) or die($con->error);
        while ($row = $result->fetch_assoc()) {
            unset($id, $name);
            $idAssociado = $row['idAssociado'];
        }

        $sql = 'INSERT INTO dependente(fk_idUsuario,fk_idAssociado,dataNascimento,fk_idGenero,email,fk_idParentesco,agregado) '
                . 'VALUES("' . $idUsuario . '","' . $idAssociado . '","' . $dataNascimento . '","' . $genero . '","' . $email . '","' . $parentesco . '","' . $agregado . '")';

        if ($con->query($sql) === true) {
        } else {
            $errMSG = "error while inserting....2";
            echo $errMSG;
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }

        $sql = 'INSERT INTO telefone(fk_idUsuario, telefone, telefone2) '
                . 'VALUES("' . $idUsuario . '","' . $telefone . '","' . $telefone2 . '")';

        if ($con->query($sql) === true) {

        } else {
            $errMSG = "error while inserting....2";
            echo $errMSG;
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }

    }

    //include 'selecionarDependente.php';

    //include 'selecionarUsuario.php';

    echo"<script language='javascript' type='text/javascript'>alert('Cadastro de dependente realizado com sucesso!');window.location.href='cadastrarDependente.php';</script>";
    die();
}

mysqli_close($con);

?>