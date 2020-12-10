<?php
require_once '../PHPMailer-master/src/PHPMailer.php';
require_once '../PHPMailer-master/src/SMTP.php';
require_once '../PHPMailer-master/src/Exception.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<?php
	require_once 'head.php';
	require_once 'navbar2.php';
	?>
</head>

<body>
	<?php
	$nome = $_POST["name"];
	$email = $_POST["email"];
	$subject = $_POST["subject"];
	$mensagem = $_POST["msg"];
	// $mail = new PHPMailer ();
	$mail = new PHPMailer\PHPMailer\PHPMailer();
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587; // ou 587 or 465;
	$mail->SMTPDebug = 0;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = "diroleventos@gmail.com";
	$mail->Password = "981817dirole";

	$mail->setFrom("diroleventos@gmail.com");
	$mail->addAddress("diroleventos@gmail.com");
	$mail->Subject = "Assunto: {$subject}";
	$mail->msgHTML("<html>De: {$nome}<br/>Email: {$email}<br/>Subject: {$subject}<br/Mensagem: {$mensagem} </html>");
	$mail->AltBody = "De: {$nome}\nEmail: {$email}\nAssunto: {$subject}\nMensagem: {$mensagem}";

	if (!$mail->Send()) {
		echo "A Mensagem Não Foi Enviada ";
	} else {
		echo "<script>alert('Sucesso, agora verifique seu email/spam');</script>";
	}
	?>
	<div>
		<div style="display: flex; width: 50%">
			<h1>Agradeçemos o contato, assim que possível responderemos, Obrigado !</h1>
		</div>
	</div>

</body>
<?php
require_once 'footer.php';
?>

</html>