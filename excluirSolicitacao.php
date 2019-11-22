<?php
include("include/headerAdm.php");	
if(is_numeric($_GET["id"])){
    $SQL = "DELETE FROM Solicitacao WHERE idSolicitacao = ".$_GET["id"];
    if ($con->query($SQL) === TRUE) {
        echo "<script>window.location = 'exibirSolicitacoes.php';</script>";
    }else{
        echo "<script>alert('Erro ao excluir!');</script>";
        echo "<script>window.location = 'exibirSolicitacoes.php';</script>";
    }
}else{
    echo "<script>window.location = 'index.php';</script>";
}
?>