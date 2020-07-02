<?php

require_once ("conexao.php");

//verifica se foi enviado algum valor
if (isset($_POST["atualizar"])) {

    $id = $_GET["id"];

    //recebe os valores enviados pelo formulário
    $quantTotal = addslashes($_POST['quantTotal']);
    $pesoTotal = addslashes($_POST['pesoTotal']);
    $data = addslashes($_POST['data']);

    $sql = 'UPDATE Triagem 
                SET quantTotal = "' . $quantTotal . '", pesoTotal = "' . $pesoTotal . '", data = "' . $data . 
                '" WHERE idTriagem = "' . $id . '";';

    if ($con->query($sql) == true) {
        echo "<script language='javascript' type='text/javascript'>alert('Atualização realizada com sucesso!');javascript:history.go(-1);</script>";    
    } else {
        echo "<script language='javascript' type='text/javascript'>alert('Erro ao atualizar!');</script>";
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);

}

?>  