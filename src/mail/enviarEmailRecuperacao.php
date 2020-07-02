<?php

header('Content-Type: text/html; charset=utf-8');

include("../conexao.php"); //incluir arquivo com conexão ao banco de dados

$email = utf8_decode (strip_tags(trim($_POST['email'])));
$sql = "SELECT idUsuario, nome FROM ecopilhas.Usuario WHERE email='$email'";
$result = $con->query($sql);
if ($result->num_rows > 0) { // Exibindo cada linha retornada com a consulta
	while ($exibir = $result->fetch_assoc()){
		$idUsuario = $exibir["idUsuario"];
		$nome = ucwords($exibir["nome"]);
	} // fim while
} else { //se não achar nenhum registro
	echo "<script>alert('Não existe nenhuma conta cadastrada com o e-mail informado.');javascript:window.history.go(-1);</script>";
	exit;
}

require_once("../PHPMailer/class.phpmailer.php");
require_once("../PHPMailer/class.smtp.php");

$mailer = new PHPMailer();
$mailer->IsSMTP();
$mailer->CharSet = 'UTF-8';
$mailer->Encoding = 'base64';
$mailer->isHTML();
$mailer->SMTPDebug = 0;
$mailer->Port = 587; //Indica a porta de conexão 
$mailer->SMTPSecure = 'tls';
$mailer->Host = 'smtp.gmail.com';
$mailer->SMTPAuth = true; //define se haverá ou não autenticação 
$mailer->Username = 'ecopilhas.noreply@gmail.com'; //Login de autenticação do SMTP
$mailer->Password = 'ecopilhas-noreply#444'; //Senha de autenticação do SMTP
$mailer->FromName = 'Projeto Ecopilhas'; //Nome que será exibido
$mailer->From = 'ecopilhas.noreply@gmail.com'; //Obrigatório ser a mesma caixa postal configurada no remetente do SMTP
$mailer->AddAddress($email,$nome);
//Destinatários
$mailer->Subject = 'Redefinição de Senha';
$mailer->Body = '<p>Prezado(a) usuário(a),</p>
				<p>por favor, acesse o link a seguir para redefinir a sua senha no site do Projeto Ecopilhas.</p>
				<p>http://ecopilhas.com.br/redefinirSenha.php?id=' . $idUsuario . '</p>' .
				'<p>Atenciosamente,</p>' .
				'<p>Projeto Ecopilhas</p>';

if(!$mailer->Send()){
    echo "Mailer Error: " . $mailer->ErrorInfo;
} else {
    echo "<script>alert('Por favor, acesse o seu e-mail para redefinir a sua senha.');javascript:window.history.go(-1);</script>";
}
?>