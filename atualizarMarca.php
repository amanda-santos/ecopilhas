<?php

require_once ("conexao.php");

//verifica se foi enviado algum valor
if (isset($_POST["atualizar"])) {

    $id = $_GET["id"];

    //recebe os valores enviados pelo formulário
    $nome = addslashes($_POST['nome']);
    $pais = addslashes($_POST['pais']);

    $sql = 'UPDATE Marca 
                SET nome = "' . $nome . '", pais = "' . $pais . '" WHERE idMarca = "' . $id . '";';

    if ($con->query($sql) == true) {
        echo "<script language='javascript' type='text/javascript'>alert('Atualização realizada com sucesso!');javascript:history.go(-1);</script>";    
    } else {
        echo "<script language='javascript' type='text/javascript'>alert('Erro ao atualizar!');</script>";
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);

}

?>  