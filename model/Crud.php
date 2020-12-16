<?php

require_once 'Banco.php';

abstract class Crud extends Banco{

	protected $table;

	abstract public function insert();
	// abstract public function insertEvento(Evento $evento);
	abstract public function update($id_usuario);
    
    public function listAllEmail(){
		$sql  = "SELECT email_responsavel, id_usuario FROM $this->table";
		$stmt = Banco::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}
//incluido por vnc
	public function find($id) {
		$sql = "SELECT * FROM $this->table WHERE id = :id";
		$stmt = Banco::prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

	public function findG($id) {

		$sql = "SELECT * FROM $this->table WHERE id = :id";
		$stmt = Conexao::prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

	public function select($id_usuario) {
		$sql  = "SELECT * FROM $this->table WHERE id_usuario = :id_usuario";
		$stmt = Banco::prepare($sql);
		$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}
	public function selectP($id_provider) {
		$sql  = "SELECT * FROM $this->table WHERE id_provider = :id_provider";
		$stmt = Banco::prepare($sql);
		$stmt->bindParam(':id_provider', $id_provider, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

	public function selectAdm($id_adm) {
		$sql  = "SELECT * FROM $this->table WHERE id_adm = :id_adm";
		$stmt = Banco::prepare($sql);
		$stmt->bindParam(':id_adm', $id_adm, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

	public function verificaEmail($email) {
		$sql  = "SELECT * FROM $this->table WHERE email = :email";
		$stmt = Banco::prepare($sql);
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		$response = $stmt->rowCount();
        if($response > 0){
            return $stmt->fetch();
        }
        else{
            return false;
        }
	}

	public function selectAll() {
		$sql  = "SELECT * FROM $this->table";
		$stmt = Banco::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function delete($id_usuario) {
		$sql  = "DELETE FROM $this->table WHERE id_usuario = :id_usuario";
		$stmt = Banco::prepare($sql);
		$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
		return $stmt->execute(); 
	}

	public function deleteG($id) {
		$sql = "DELETE FROM $this->table WHERE id = :id";
		$stmt = Banco::prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
	}

	public function tratarCaracter($valor, $tipo) {
		switch($tipo) {
			case 1: $ret = utf8_decode($valor); break;
			case 2: $ret = htmlentities($valor, ENT_QUOTES, "ISO-8859-1"); break;
		}
		return $ret;
	}

	public function dataAtual($tipo) {
		switch($tipo) {
			case 1: $ret = date("Y-m-d"); break;
			case 2: $ret = date("Y-m-d H:i:s"); break;
			case 3: $ret = date("d/m/Y"); break;
		}
		return $ret;
	}

	public function base64($valor, $tipo) {
		switch($tipo) {
			case 1: $ret = base64_encode($valor); break;
			case 2: $ret = base64_decode($valor); break;
		}
		return $ret;
	}

}