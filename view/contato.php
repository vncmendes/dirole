<?php 
require_once 'head.php';
require_once 'navbar2.php';
require_once '../PHPMailer-master/src/PHPMailer.php';
require_once '../PHPMailer-master/src/SMTP.php';
require_once '../PHPMailer-master/src/Exception.php';

$nome = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$mensagem = $_POST["msg"];

// $mail = new PHPMailer ();
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465; // ou 587;
$mail->SMTPDebug = 1;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "diroleventos@gmail.com";
$mail->Password = "981817dirole";

$mail->setFrom ("viniciussmendes@gmail.com");
$mail->addAddress ("viniciuss.mendes@hotmail.com");
$mail->Subject = "Assunto: {$subject}";
$mail->msgHTML("<html>De: {$nome}<br/>Email: {$email}<br/>Subject: {$subject}<br/Mensagem: {$mensagem} </html>");
$mail->AltBody = "De: {$nome}\nEmail: {$email}\nAssunto: {$subject}\nMensagem: {$mensagem}";

if (!$mail->Send()) {
	echo "A Mensagem Não Foi Enviada ";
  } 
else {
	echo "<script>alert('Sucesso, agora verifique seu email/spam');</script>";
	}

require_once 'footer.php';
 ?>