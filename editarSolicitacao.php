<?php

require_once ("conexao.php");
include("include/headerAdm.php");

$id = $_GET["id"];
$c = $_GET["c"];

$sql = 'UPDATE Solicitacao 
            SET concluido = '.$c.'
            WHERE idSolicitacao = ' . $id . ';';

if ($con->query($sql) == true) {
    echo "<script language='javascript' type='text/javascript'>javascript:history.go(-1);</script>";    
} else {
    echo "<script language='javascript' type='text/javascript'>alert('Erro ao atualizar!');</script>";
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

mysqli_close($con);

?>

    