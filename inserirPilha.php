<?php

require_once ("conexao.php");

//verifica se foi enviado algum valor
if (isset($_POST["adicionar"])) {

    $idTriagem = $_GET["id"];

    //recebe os valores enviados pelo formulário
    $marca = addslashes($_POST['marca']);
    $peso = addslashes($_POST['peso']);
    $quantidade = addslashes($_POST['quantidade']);

    $sql = 'INSERT INTO ecopilhas.ItemTriagem (idMarca, idTriagem, quantidade, peso) VALUES ("' . $marca . '", "' . $idTriagem . '", "'. $quantidade .'","'. $peso .'");';

    if ($con->query($sql) == true) {
        echo "<script language='javascript' type='text/javascript'>alert('Cadastro realizado com sucesso!');window.location.href='exibirTriagens.php';</script>";    
    } else {
        echo "<script language='javascript' type='text/javascript'>alert('Erro ao cadastrar!');</script>";
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);

}

?>

    