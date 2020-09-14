<?php
require_once 'Conexao.php';

class Crud extends Conexao
{

	protected $table;

	//	abstract public function insert($objeto);
	//abstract public function update($id);

	public function find($id)
	{

		$sql = "SELECT * FROM $this->table WHERE id = :id";
		$stmt = Conexao::prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

	public function getAll()
	{

		$sql = "SELECT * FROM $this->table";
		$stmt = Conexao::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function delete($id)
	{

		$sql = "DELETE FROM $this->table WHERE id = :id";
		$stmt = Conexao::prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
	}
}
