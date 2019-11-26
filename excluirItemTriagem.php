<?php
include("include/headerAdm.php");	
$id = $_GET["id"];
if($id){
    $SQL = "DELETE FROM ecopilhas.ItemTriagem WHERE idItemTriagem = '". $id . "'";
    if ($con->query($SQL) === TRUE) {
        echo "<script>window.location = 'exibirTriagens.php';</script>";
    }else{
        echo "<script>alert('Erro ao excluir!');</script>";
        echo "<script>window.location = 'exibirTriagens.php';</script>";
    }
}else{
    echo "<script>window.location = 'index.php';</script>";
}
?>