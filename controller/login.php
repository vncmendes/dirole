<?php

require_once '../model/Conexao.php';
require_once '../model/UsuarioDAO.php';
require_once '../model/Usuario.php';

$autentica = false;

$email = $_POST['email'];
$senha = $_POST['senha'];

$usuarioDAO = new UsuarioDAO();
$usuario = new Usuario();

$usuario->setEmail($email);
$usuario->setSenha($senha);

if ($email == "" or $senha == "") {
	echo "Preencha todos os campos";
} else 
	if ($email != $usuario->getEmail()) {
	echo "Email inválido !";
} else
		if ($senha != $usuario->getSenha()) {
	echo "Senha incorreta !";
} else {
	$autentica = true;
}

if ($autentica == true) {
	$usuarioDAO->getLogin($usuario);
}

//$usuario2 = $usuarioDAO->logaUsuario($email);
$usuario3 = $usuarioDAO->estaLogado();

var_dump($usuario);
