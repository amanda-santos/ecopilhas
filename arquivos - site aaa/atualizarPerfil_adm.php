<?php
require_once ("conexao.php");
session_start();

//verifica se foi enviado algum valor
if (isset($_POST["atualizePerfil"])) {

    //recebe os valores enviados pelo formulário
    $idPerfil = $_GET['id'];
    $usuario = addslashes($_POST['usuario']);
    $nome = addslashes($_POST['nome']);
    $nomeSite = addslashes($_POST['nomeSite']);
    $tipo = $_POST['tipo'];
    $email = $_POST['email'];

    if (!isset($errMSG)) {
        // verifica se não há um perfil com mesmo login ou usuário
        $sqlVerificar = "SELECT * FROM perfil 
                WHERE idPerfil != '" . $idPerfil . "' 
                AND (login = '" . $usuario . "' 
                OR email = '" . $email . "');";
        $resultVerificar = $con->query($sqlVerificar) or die($con->error);
        if ($resultVerificar->num_rows > 0) {
            while ($row = $resultVerificar->fetch_assoc()) {
                echo"<script language='javascript' type='text/javascript'>alert('ERRO: Já existe um perfil cadastrado com o nome de usuário ou o e-mail informados.');javascript:window.history.go(-1);</script>";
                die();
            }
        }
    }

    if (!isset($errMSG)) {
        // Update os valores do perfil
        $sql = 'UPDATE perfil 
                SET nomeSite = "' . $nomeSite . '", login="' . $usuario . '", usuario="' . $nome . '", fk_idTipoPerfil=' . $tipo . ', email = "' . $email . '" WHERE idPerfil = ' . $idPerfil . ';';
        
        if ($con->query($sql) === true) {

			$_SESSION['login'] = $usuario;
			$_SESSION['tipo'] = $tipo;

            echo"<script language='javascript' type='text/javascript'>alert('Atualização realizada com sucesso!');window.location.href='editarPerfil_adm.php?login=" . $usuario . "';</script>";

            die();

        } else {
            $errMSG = "1 error while UPDATE perfil";
            echo $errMSG;
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
            echo"<script language='javascript' type='text/javascript'>alert('Erro na atualização!');javascript:window.history.go(-1);</script>";
            die();
        }
    }
}

?>

