<?php
include("include/headerAdm.php");	
$id = $_GET["id"];
if($id){
    $SQL = "DELETE FROM ecopilhas.Marca WHERE idMarca = '". $id . "'";
    if ($con->query($SQL) === TRUE) {
        echo "<script>window.location = 'exibirMarca.php';</script>";
    }else{
        echo "<script>alert('Erro ao excluir!');</script>";
        echo "<script>window.location = 'exibirMarca.php';</script>";
    }
}else{
    echo "<script>window.location = 'index.php';</script>";
}
?>