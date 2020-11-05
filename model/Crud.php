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

	public function select($id_usuario){
		$sql  = "SELECT * FROM $this->table WHERE id_usuario = :id_usuario";
		$stmt = Banco::prepare($sql);
		$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}
	public function verificaEmail($email){
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
	public function selectAll(){
		$sql  = "SELECT * FROM $this->table";
		$stmt = Banco::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function delete($id_usuario){
		$sql  = "DELETE FROM $this->table WHERE id_usuario = :id_usuario";
		$stmt = Banco::prepare($sql);
		$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
		return $stmt->execute(); 
	}

}