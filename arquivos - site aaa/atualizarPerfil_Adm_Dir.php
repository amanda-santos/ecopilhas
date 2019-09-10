<?php
require_once ("conexao.php");
session_start();

//verifica se foi enviado algum valor

if ((isset($_POST["atualizePerfil"])) && ($_SESSION["tipo"] == 4)) {
    //recebe os valores enviados pelo formulário
    $idPerfil = $_GET['idPerfil'];
    $nome = addslashes($_POST['nome']);
    $usuario = addslashes($_POST['usuario']);
    $nomeSite = addslashes($_POST['nomeSite']);
    $email = addslashes($_POST['email']);
    $tipo = $_POST['tipo'];
    $ativo = $_POST['ativo'];

    if (!isset($errMSG)) {
        // verifica se não há um perfil com mesmo login ou usuário
        $sqlVerificar = "SELECT * FROM perfil 
                WHERE idPerfil != '" . $idPerfil . "' 
                AND (login = '" . $usuario . "' 
                OR email = '" . $email . "');";

                //echo $sqlVerificar."<br>";

        $resultVerificar = $con->query($sqlVerificar);

        if ($resultVerificar->num_rows > 0) {
            //echo $resultVerificar->num_rows;
            echo "<script>alert('ERRO: Ja existe um perfil com o nome de usuario ou o e-mail informados.');javascript:window.history.go(-1);</script>";
            die(); 
        }
    }

    if (!isset($errMSG)) {
        // Update os valores do perfil

        $sql = 'UPDATE perfil 
                SET nomeSite = "' . $nomeSite . '", login="' . $usuario . '", usuario="' . $nome . '", fk_idTipoPerfil=' . $tipo . ', ativo = ' . $ativo . ', email = "' . $email . '" WHERE idPerfil = ' . $idPerfil . ';';
        
        if ($con->query($sql) === true) {
            echo "<script language='javascript' type='text/javascript'>alert('Perfil atualizado com sucesso!');window.location.href='exibirPerfis.php';</script>";
            die();
        } else {
            $errMSG = "1 error while UPDATE perfil";
            echo $errMSG;
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
            echo"<script language='javascript' type='text/javascript'>alert('Erro ao atualizar!');javascript:window.history.go(-1);</script>";
            die();
        }
    }
}else{
  echo "<script>window.location.href='index.php';</script>";
}
?>