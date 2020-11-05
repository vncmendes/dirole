<?php 

// include "funcoes.php";
require_once "../model/Usuario.php";
require_once "../model/UsuarioDAO.php";


$validate = false;

$usuarioDAO = new UsuarioDAO();

$id = $_POST['alterar'];
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

if ($nome and $sobrenome and $email and $senha) {
	$validate = true;
}

$usuario = new Usuario();
$usuario->setId($id);
$usuario->setNome($nome); 
$usuario->setSobrenome($sobrenome); 
$usuario->setEmail($email); 
$usuario->setSenha($senha); 

$usuarioDAO->update($usuario);

if ($validate == true) {
	echo "Usuário adicionado com sucesso";
}
else {
	echo "Usuário não adicionado";
}