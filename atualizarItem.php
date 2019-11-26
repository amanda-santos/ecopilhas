<?php

require_once ("conexao.php");

//verifica se foi enviado algum valor
if (isset($_POST["atualizar"])) {

    $id = $_GET["id"];

    //recebe os valores enviados pelo formulário
    $quantidade = addslashes($_POST['quantidade']);
    $peso = addslashes($_POST['peso']);
    $idMarca = addslashes($_POST['marca']);
    $idTriagem = $_GET["idTriagem"];

    $sql = 'UPDATE ecopilhas.ItemTriagem 
                SET quantidade = "' . $quantidade . '", peso = "' . $peso . '", idTriagem = "'.$idTriagem.'", idMarca = "'. $idMarca . '" WHERE idItemTriagem = "' . $id . '";';

    if ($con->query($sql) == true) {
        echo "<script language='javascript' type='text/javascript'>alert('Atualização realizada com sucesso!');javascript:history.go(-1);</script>";    
    } else {
        echo "<script language='javascript' type='text/javascript'>alert('Erro ao atualizar!');</script>";
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);

}

?>  