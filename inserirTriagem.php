<?php

require_once ("conexao.php");

//verifica se foi enviado algum valor
if (isset($_POST["cadastrar"])) {

    //recebe os valores enviados pelo formulário
    $data = addslashes($_POST['data']);
    $pesoTotal = addslashes($_POST['pesoTotal']);
    $quantTotal = addslashes($_POST['quantTotal']);

    $sql = 'INSERT INTO Triagem (data, pesoTotal, quantTotal) VALUES ("' . $data . '", "' . $pesoTotal . '", "'. $quantTotal .'");';

    if ($con->query($sql) == true) {
        echo "<script language='javascript' type='text/javascript'>alert('Cadastro realizado com sucesso!');window.location.href='exibirTriagens.php';</script>";    
    } else {
        echo "<script language='javascript' type='text/javascript'>alert('Erro ao cadastrar!');</script>";
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);

}

?>

    