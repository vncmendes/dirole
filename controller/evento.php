<?php

require_once '../view/head.php';
require_once "../model/Evento.php";
require_once "../model/Categoria.php";
require_once "../model/Estrutura.php";
// require_once "../model/EventoDAO.php";
// require_once "../model/CategoriaDAO.php";
// require_once "../model/EstruturaDAO.php";
// $eventoDAO = new EventoDAO();
$eventos = new Evento();
$evento = new Evento(); //objeto para uso exclusivo da alteração - não sei se tá certo.
$categoria = new Categoria();
$estrutura = new Estrutura();
// $categoriaDAO = new CategoriaDAO();
// $estruturaDAO = new EstruturaDAO();

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
	$ingresso = $_POST['ingresso'];
	$categoria = $_POST['categoria'];
	$estrutura = $_POST['estrutura'];
	$arquivo = $_FILES['arquivo']['name'];
	$arquivo_temp = $_FILES['arquivo']['tmp_name'];
	$tamanho_arquivo = $_FILES['arquivo']['size'];
	$tipo_arquivo = $_FILES['arquivo']['type'];

	if ($nome == "" || $data == "" || $horainicial == "" || $horafinal == "" || $local == "" || $descricao == "" || $ingresso == "" || $categoria == "" || $estrutura == "") {
		echo "Preencha todos os campos";
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
	$evento->setIngresso($ingresso);
	$evento->setCategoria($categoria);
	$evento->setEstrutura($estrutura);
	$evento->setArquivo($arquivo);

	$eventos->insertEvent($evento);


	if ($validate == true) {
		// session_start();
		// $eventoCadastradoOK = 1;
		// $_SESSION['eventoCadastradoOK'] = $eventoCadastradoOK;
		echo "Evento adicionado com sucesso";
		header("Location: ../view/lista-evento.php");
	} else {
		// session_start();
		// $eventoCadastradoErro = 0;
		// $_SESSION['eventoCadastradoErro'] = $eventoCadastradoErro;
		echo "Evento não adicionado";
		header("Location: ../view/lista-evento.php");
	}
	//header("Location: ../view/index.php");


}

if (array_key_exists('alterarEvento', $_POST)) {
	$validate = false;

	$nome = $_POST['nome'];
	$data = $_POST['data'];
	$horainicial = $_POST['horai'];
	$horafinal = $_POST['horaf'];
	$local = $_POST['localizacao'];
	$descricao = $_POST['descricao'];
	$gv = $_POST['gv'];
	$ingresso = $_POST['ingresso'];
	$categoria = $_POST['categoria'];
	$estrutura = $_POST['estrutura'];
	$arquivo = $_FILES['arquivo']['name'];
	$arquivo_temp = $_FILES['arquivo']['tmp_name'];
	$tamanho_arquivo = $_FILES['arquivo']['size'];
	$tipo_arquivo = $_FILES['arquivo']['type'];


	if ($nome == "" || $data == "" || $horainicial == "" || $horafinal == "" || $local == "" || $descricao == "" || $ingresso == "" || $categoria == "" || $estrutura == "") {
		echo "Preencha todos os campos";
		header("Location: ../view/lista-evento.php");
	} 
	else {
		$validate = true;
		$_SESSION['eventoAlteradoOK'] = 1;
	}

	// $usuario = new Usuario(); está no escopo global de usuario.
	$evento->setNome($nome);
	$evento->setData($data);
	$evento->setHorai($horainicial);
	$evento->setHoraf($horafinal);
	$evento->setLocal($local);
	$evento->setDescricao($descricao);
	$evento->setGv($gv);
	$evento->setIngresso($ingresso);
	$evento->setCategoria($categoria);
	$evento->setEstrutura($estrutura);
	$evento->setArquivo($arquivo);
	$eventos->alteraEvent($evento);

	if ($validate == true) {
		// session_start();
		// $alteraEventoOK = 1;
		// $_SESSION['alteraEventoOK'] = $alteraEventoOK;
		echo "Evento adicionado com sucesso";
		header("Location: ../view/lista-evento.php");
	} else {
		// session_start();
		// $alteraErroEvento = 0;
		// $_SESSION['alteraErroEvento'] = $alteraErroEvento;
		echo "Evento não adicionado";
		header("Location: ../view/lista-evento.php");
	}
}

if (array_key_exists("remover", $_POST)) {

	$id = $_POST['idE'];

	$evento->deleteG($id);
	header("Location: ../view/lista-evento.php");
	die();
}
