<?php 

require_once 'Crud.php';
	
	class AdmDAO extends Crud {

		protected $table = "adm";

		public function getLogin (Adm $adm) {

			try {

			$email = $admDAO->getEmail();
			$senha = $admDAO->getSenha();

			$sql = "SELECT nome, senha from "

			}
		

		public function insert(Adm $adm) {

		try { 
		// recebe os valores em uma variável usando os métodos antes.
		$email = $usuario->getEmail();
		$senha = $usuario->getSenha();

		$sql = "INSERT INTO $this->table (email, senha) VALUES (:email, :senha)";
		$stmt = Conexao::prepare($sql);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':senha', $senha);

		return $stmt->execute();
	}
	catch (Exception $e) {
		print $e->getMessage();	
		}
	}
	}


 ?>