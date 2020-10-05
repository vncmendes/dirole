<?php
// if (!isset($_SESSION)) {
// 	session_start();
// 	session_status();
// }

require_once "../model/Usuario.php";
require_once "../model/UsuarioDAO.php";
require_once '../config-upload.php';

$usuarioDAO = new UsuarioDAO();
$usuario = new Usuario();

//<-- CONTROADOR ONDE É RECEBIDOA AS INFORMAÇÕES DE CADASTRO -->

if (array_key_exists("cadastrarB", $_POST)) {

	$table = "usuarios";
	$validate = false;

	$nome = $_POST['nameB'];
	$sobrenome = $_POST['snameB'];
	$email = $_POST['emailB'];
	$senha = md5($_POST['passwordB']);
	$senha2 = md5($_POST['password2B']);

	$sql = " SELECT * FROM $table WHERE email = :email";

	$stmt = Conexao::prepare($sql);
	$stmt->bindParam(':email', $email);
	if ($stmt->execute()) {
		if ($stmt->rowCount() > 0) {
			echo "Usuário já cadastrado !";
			return false;
		}
	}
	if ($nome == "" or $sobrenome == "" or $email == "" or $senha == "" or $senha2 == "") {
		echo "Preencha todos os campos";
	} else if ($senha != $senha2) {
		$senhas = "As senhas devem ser iguais "; ?>
		<p class="text-success text-center"> <?= $senhas ?> </p>
	<?php
		return false;
	} else {
		$validate = true;
	}
	// $usuario = new Usuario(); está no escopo global de usuario.
	$usuario->setNome($nome);
	$usuario->setSobrenome($sobrenome);
	$usuario->setEmail($email);
	$usuario->setSenha($senha);

	$usuarioDAO->insert($usuario);


	if ($validate == true) {
		$msg = "Usuário adicionado com sucesso"; ?>
		<p class="text-success text-center"> <?= $msg ?> </p>
	<?php } else {
		echo "Usuário não adicionado";
	}
	//header("Location: ../view/index.php");
	?>

<?php }

//<-- CONTROADOR ONDE É RECEBIDOA AS INFORMAÇÕES DE CADASTRO --FIM-->



//<-- CONTROLADOR ONDE É RECEBIDA AS INFORMAÇÕES PARA SEREM REALMENTE ALTERADAS -->

if (array_key_exists("enviar", $_POST)) {

	$validate = false;

	//$usuarioDAO = new UsuarioDAO();

	$id = $_POST['id'];
	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];

	if ($nome and $sobrenome and $email and $senha) {
		$validate = true;
	}

	//$usuario = new Usuario();
	$usuario->setId($id);
	$usuario->setNome($nome);
	$usuario->setSobrenome($sobrenome);
	$usuario->setEmail($email);
	$usuario->setSenha($senha);

	$usuarioDAO->update($usuario);

	if ($validate == true) {
		echo "Usuário alterado com sucesso";
		header("Location: ../view/lista-usuario.php");
	} else {
		echo "Usuário não alterado";
	}
?>
	<tr>
		<td>
			<a href="../view/lista-usuario.php" class="btn btn-dark">Voltar</a>
		</td>
	</tr>
	<?php }

//<-- CONTROLADOR ONDE É RECEBIDA AS INFORMAÇÕES PARA SEREM REALMENTE ALTERADAS --FIM-->

//<-- CONTROLADOR ONDE É RECEBIDA AS INFORMAÇÕES PARA SEREM REMOVIDAS -->

if (array_key_exists("remover", $_POST)) {

	$id = $_POST['idR'];
	//$usuarioDAO = new UsuarioDAO();

	$usuarioDAO->delete($id);

	header("Location: ../view/lista-usuario.php");
	die();
}

if (array_key_exists("removerPerfil", $_POST)) {

	$id = $_POST['id'];
	//$usuarioDAO = new UsuarioDAO();

	$usuarioDAO->delete($id);
	unset($_SESSION['id']);
	unset($_SESSION['autentica_usuario']);

	header("Location: ../view/index.php");
	die();
}
//<-- CONTROLADOR ONDE É RECEBIDA AS INFORMAÇÕES PARA SEREM REMOVIDAS --FIM-->

if (array_key_exists("logar", $_POST)) {

	$autentica = false;

	$email = $_POST['email'];
	$senha = md5($_POST['password']);

	if ($email != "") {
		if ($senha != "") {
			$usuario->setEmail($email);
			$usuario->setSenha($senha);
			$autentica = true;
		} else {
			echo "Preencha todos os campos";
			return false;
		}
	}
	if ($autentica == true) {
		if ($usuarioDAO->getLogin($usuario)) { ?>
			<p class="text-success text-center">Você está logado como <?= $usuario->getEmail() ?> </p>
	<?php
			header("location: ../view/eventos.php"); //quando logar vai pra evento por hora.
		} else {
			echo "Acesso Negado !";
		}
	}
	?>
<?php }

//<-- CONTROLADOR ONDE É RECEBIDA AS INFORMAÇÕES PARA SEREM REMOVIDAS --FIM-->

if (array_key_exists("uploadArc", $_POST)) {

	$nomeArc = $_FILES['foto']['name'];
	$tipoArc = $_FILES['foto']['type'];
	$tamanhoArc = $_FILES['foto']['size'];
	$nomeArcTemp = $_FILES['foto']['tmp_name'];
	$errorArc = $_FILES['foto']['error'];
	$id = $_SESSION['id'];

	$usuarioDAO->updateFoto($id);


	if ($sobrescrever == "não" and file_exists("$caminho/$id.jpg")) {
		die("Arquivo já existe");
	}
	if ($limitar_tamanho == "sim" and ($tamanhoArc > $tamanho_bytes)) {
		die("Arquivo deve ter no máximo $tamanho_bytes bytes");
	}

	$ext = strrchr($nomeArc, '.');

	if (($limitar_ext == "sim") and !in_array($ext, $extensoes_validas)) {
		die("Extensão de arquivo inválida para upload");
	}

	if (!empty($nomeArc)) {
		if (move_uploaded_file($nomeArcTemp, "../imagens/$id.jpg")) {
			header("Location: ../view/perfil.php");
		} else {
			die("Falha no erro");
		}
	} else {
		die("Selecione o arquivo a ser enviado !");
	}
}
