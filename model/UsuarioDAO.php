<?php
// if (!isset($_SESSION)) {
// 	session_start();
// 	session_status();
// }
require_once '../model/Crud.php';

class UsuarioDAO extends Crud
{
	protected $table = "usuarios";

	public function getLogin(Usuario $usuario)
	{
		try {

			$email = $usuario->getEmail();
			$senha = $usuario->getSenha();

			$sql = "SELECT email, senha, id, nome FROM usuarios WHERE email = :email and senha = :senha";
			$stmt = Conexao::prepare($sql);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':senha', $senha);

			if ($stmt->execute()) {

				if ($stmt->rowCount() > 0) {

					$usuario = $stmt->fetch();
					$_SESSION['id'] = $usuario->id;
					$_SESSION['autentica_usuario'] = $usuario->email;
					//header("Location: ../view/eventos.php");
					// $_SESSION['foto'] = $usuario->foto;
					return true;
				} else {
					return false;
				}
			}
		} catch (Exception $e) {
			print $e->getMessage();
		}
	}

	public function setIdSessions($usuario)
	{
		$_SESSION['id'] = $usuario->id;
		//$_SESSION[$usuario];
		$_SESSION['autentica_usuario'] = $usuario->email;
	}

	public function verificaLogin()
	{
		return isset($_SESSION['autentica_usuario']);
	}

	public function estaLogado()
	{
		echo $_SESSION['autentica_usuario'];
	}

	public function deslogar($usuario)
	{
		unset($_SESSION['id']);
		//unset($_SESSION[$usuario]);
		unset($_SESSION['autentica_usuario']);
		session_destroy();
		session_start();
	}

	public function insert(Usuario $usuario)
	{

		try {
			// recebe os valores em uma variável usando os métodos antes.
			$nome = $usuario->getNome();
			$sobrenome = $usuario->getSobrenome();
			$email = $usuario->getEmail();
			$senha = $usuario->getSenha();
			$foto = $usuario->getFoto();

			$sql = "INSERT INTO $this->table (nome, sobrenome, email, senha, foto) VALUES (:nome, :sobrenome, :email, :senha, :foto)";
			$stmt = Conexao::prepare($sql);
			$stmt->bindParam(':nome', $nome);
			$stmt->bindParam(':sobrenome', $sobrenome);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':senha', $senha);
			$stmt->bindParam(':foto', $foto);

			return $stmt->execute();
		} catch (Exception $e) {
			print $e->getMessage();
		}
	}

	public function update(Usuario $usuario)
	{

		try {

			$id = $usuario->getId();
			$nome = $usuario->getNome();
			$sobrenome = $usuario->getSobrenome();
			$email = $usuario->getEmail();
			$senha = $usuario->getSenha();

			$sql = "UPDATE $this->table SET nome = :nome, sobrenome = :sobrenome, email = :email, senha = :senha WHERE id = :id";
			$stmt = Conexao::prepare($sql);
			$stmt->bindParam(':nome', $nome);
			$stmt->bindParam(':sobrenome', $sobrenome);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':senha', $senha);
			$stmt->bindParam(':id', $id);

			return $stmt->execute();
		} catch (Exception $e) {
			print $e->getMessage();
		}
	}

	public function updateFoto($id)
	{

		try {
			$foto = $id . ".jpg";
			$sql = "UPDATE $this->table SET foto = :foto WHERE id = :id";

			$stmt = Conexao::prepare($sql);
			$stmt->bindParam(':foto', $foto);
			$stmt->bindParam(':id', $id);

			return $stmt->execute();
		} catch (Exception $e) {
			print $e->getMessage();
		}
	}
}
