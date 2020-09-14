<?php include 'cabecalho.php'; ?>

<form action="contato.php" method="post">
	<table class="table">
		<tr>
			<td>Nome: </td>
			<td><input class="form-control" type="text" name="nome"></td>
			<td>Assunto: </td>
			<td><input class="form-control" type="text" name="subject"></td>
			<td>E-mail: </td>
			<td><input class="form-control" type="email" name="email"></td>
			<td>Mensagem:</td>
			<td><textarea class="form-control" name="msg"></textarea> </td>
			<td><button class="btn btn-success" type="submit">Enviar</button></td>
		</tr>
	</table>
</form>

<?php
$nome = $_POST["nome"];
$subject = $_POST["subject"];
$email = $_POST["email"];
$mensagem = $_POST["msg"];

require_once 'PHPMailerAutoload.php';


$mail = new PHPMailer ();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$email->SMTPDebug = 1;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "viniciussmendes@gmail.com";
$mail->Password = "senhareal";

$mail->setFrom ("viniciussmendes@gmail.com");
$mail->addAddress ("viniciuss.mendes@hotmail.com");
$mail->Subject = "Assunto: ";
$mail->msgHTML("<html>De: {$nome}<br/>Email: {$email}<br/>Subject: {$subject}<br/Mensagem: {$mensagem} </html>");
$mail->AltBody = "De: {$nome}\nEmail: {$email}\nAssunto: {$subject}\nMensagem: {$mensagem}";

if ($mail->send()) {
	$r1 = "Mensagem Enviada Com Sucesso";
	echo "$r1";
	header("Location: index.php");																												
}

else {
	$r2 = "A Mensgem Não Foi Enviada " . $mail->ErrorInfo; 
	echo "$r2";
	header("Location: index.php");
}
die();
?>

#para funcionar precisaria dos arquivos do phpmailer e da senha real do e-mail !
-->
<?php
include 'footer.php';
 ?>