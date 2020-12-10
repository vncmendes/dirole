<?php
// require_once '../view/head.php'; não faz sentido em um controller
require_once "../model/Evento.php";
require_once "../model/Categoria.php";
require_once "../model/Estrutura.php";

$eventos = new Evento();
$evento = new Evento(); //objeto para uso exclusivo da alteração - não sei se tá certo.
$categoria = new Categoria();
$estrutura = new Estrutura();

//<-- CONTROADOR ONDE É RECEBIDOA AS INFORMAÇÕES DE CADASTRO -->

if (array_key_exists("cadastrarEvento", $_POST)) {

	$validate = false;

	$nome = $_POST['nome'];
	$data = $_POST['data'];
	$horainicial = $_POST['horai'];
	$horafinal = $_POST['horaf'];
	$local = $_POST['localizacao'];
	$descricao = $_POST['descricao'];
	$gv = $_POST['gv'];
	$qtd = $_POST['qtd'];
	$ingresso = $_POST['ingresso'];
	$categoria = $_POST['categoria'];
	$estrutura = $_POST['estrutura'];
	$id_provider = $_SESSION['id_provider'];
	$arquivo = $_FILES['arquivo']['name'];
	$arquivo_temp = $_FILES['arquivo']['tmp_name'];
	$tamanho_arquivo = $_FILES['arquivo']['size'];
	$tipo_arquivo = $_FILES['arquivo']['type'];

	if ($nome == "" || $data == "" || $horainicial == "" || $horafinal == "" || $local == "" || $descricao == "" || $ingresso == "" || $categoria == "" || $estrutura == "" || $qtd == "") {
		echo "Preencha todos os campos";
		$validate = false;
		header("Location: ../view/adiciona-evento.php");
	} else {
		$validate = true;
	}

	// $usuario = new Usuario(); está no escopo global de usuario.
	$evento->setNome($nome);
	$evento->setData($data);
	$evento->setHorai($horainicial);
	$evento->setHoraf($horafinal);
	$evento->setLocal($local);
	$evento->setDescricao($descricao);
	$evento->setGv($gv);
	$evento->setQtd($qtd);
	$evento->setIngresso($ingresso);
	$evento->setCategoria($categoria);
	$evento->setEstrutura($estrutura);
	$evento->setArquivo($arquivo);
	$evento->setId_provider($id_provider);
	$eventos->insertEvent($evento);

	if ($validate == true) {
		// session_start();
		$eventoCadastradoOK = 1;
		$_SESSION['eventoCadastradoOK'] = $eventoCadastradoOK;
		@header("Location: ../view/lista-evento.php");
	} else {
		// session_start();
		$eventoCadastradoErro = 0;
		$_SESSION['eventoCadastradoErro'] = $eventoCadastradoErro;
		header("Location: ../view/lista-evento.php");
	}
}

if (array_key_exists('alterarEvento', $_POST)) {
	$validate = false;

	$id = $_POST['id'];
	$nome = $_POST['nome'];
	$data = $_POST['data'];
	$horainicial = $_POST['horai'];
	$horafinal = $_POST['horaf'];
	$local = $_POST['localizacao'];
	$descricao = $_POST['descricao'];
	$gv = $_POST['gv'];
	$qtd = $_POST['qtd'];
	$ingresso = $_POST['ingresso'];
	$categoria = $_POST['categoria'];
	$estrutura = $_POST['estrutura'];
	$arquivo = $_FILES['arquivo']['name'];
	$arquivo_temp = $_FILES['arquivo']['tmp_name'];
	$tamanho_arquivo = $_FILES['arquivo']['size'];
	$tipo_arquivo = $_FILES['arquivo']['type'];


	if ($nome == "" || $data == "" || $horainicial == "" || $horafinal == "" || $local == "" || $descricao == "" || $ingresso == "" || $categoria == "" || $estrutura == "" || $qtd == "") {
		echo "Preencha todos os campos";
		header("Location: ../view/lista-evento.php");
	} else {
		$validate = true;
		$_SESSION['eventoAlteradoOK'] = 1;
	}

	// $usuario = new Usuario(); está no escopo global de usuario.
	$evento->setId($id);
	$evento->setNome($nome);
	$evento->setData($data);
	$evento->setHorai($horainicial);
	$evento->setHoraf($horafinal);
	$evento->setLocal($local);
	$evento->setDescricao($descricao);
	$evento->setGv($gv);
	$evento->setQtd($qtd);
	$evento->setIngresso($ingresso);
	$evento->setCategoria($categoria);
	$evento->setEstrutura($estrutura);
	$evento->setArquivo($arquivo);
	$eventos->alteraEvent($evento);

	if ($validate == true) {
		session_start();
		$alteraEventoOK = 1;
		$_SESSION['alteraEventoOK'] = $alteraEventoOK;
		header("Location: ../view/lista-evento.php");
	} else {
		session_start();
		$alteraErroEvento = 0;
		$_SESSION['alteraErroEvento'] = $alteraErroEvento;
		header("Location: ../view/lista-evento.php");
	}
}

if (array_key_exists("remover", $_POST)) {

	$id = $_POST['idE'];

	$evento->deleteG($id);
	header("Location: ../view/lista-evento.php");
	die();
}
