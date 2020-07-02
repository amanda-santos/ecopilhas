<?php
// Check for empty fields
if(empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['telefone']) || empty($_POST['mensagem']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
   	echo "<script>alert('Por favor, preencha os campos corretamente.');javascript:window.history.go(-1);</script>";
    die(); 
}
   
$nome = strip_tags(htmlspecialchars($_POST['nome']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$telefone = strip_tags(htmlspecialchars($_POST['telefone']));
$mensagem = strip_tags(htmlspecialchars($_POST['mensagem']));

require_once("../PHPMailer/class.phpmailer.php");
require_once("../PHPMailer/class.smtp.php");

$emailDest = 'amanda5652@outlook.com';
$nomeDest = 'AAA - Associação dos Aposentados e Pensionistas de Ouro Branco';

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
$mailer->Username = 'aapob.noreply@gmail.com'; //Login de autenticação do SMTP
$mailer->Password = 'aapob-noreply#444'; //Senha de autenticação do SMTP
$mailer->FromName = $nome; //Nome que será exibido
$mailer->From = 'aapob.noreply@gmail.com'; //Obrigatório ser a mesma caixa postal configurada no remetente do SMTP
$mailer->AddReplyTo($email, $nome);
$mailer->SetFrom($email, $nome);
$mailer->AddAddress($emailDest,$nomeDest);
//Destinatários
$mailer->Subject = 'Mensagem enviada por ' .$nome;
$mailer->Body = 'Você recebeu uma nova mensagem do formulário do seu website (http://aapob.com.br).
				<br><br>
				<b>Nome: </b>' . $nome . 
				'<br><b>E-mail: </b>' . $email .
				'<br><b>Telefone: </b>' . $telefone .
				'<br><b>Mensagem: </b>' . $mensagem;

if(!$mailer->Send()){
    echo "Mailer Error: " . $mailer->ErrorInfo;
} else {
    echo "<script>alert('Mensagem enviada com sucesso! Entraremos em contato com você em breve.');javascript:window.history.go(-1);</script>";
}
?>