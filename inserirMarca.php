<?php

require_once ("conexao.php");

//verifica se foi enviado algum valor
if (isset($_POST["cadastrar"])) {

    //recebe os valores enviados pelo formulário
    $nome = addslashes($_POST['nome']);
    $pais = addslashes($_POST['pais']);

    $sql = 'INSERT INTO Marca (nome,pais) VALUES ("' . $nome . '", "' . $pais . '");';

    if ($con->query($sql) == true) {
        echo "<script language='javascript' type='text/javascript'>alert('Cadastro realizado com sucesso!');window.location.href='exibirMarca.php';</script>";    
    } else {
        echo "<script language='javascript' type='text/javascript'>alert('Erro ao cadastrar!');</script>";
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);

}

?>

    