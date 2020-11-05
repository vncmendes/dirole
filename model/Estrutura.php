<?php 

class Estrutura extends Crud {

	protected $table = "estrutura";
	private $id;
	private $nome;

	public function insert() {

	}
	
	public function insertEvento(Evento $evento) {}
	
	public function update($id_usuario) {
		
	}

function listaEstrutura(Estrutura $estrutura) {
	$estruturas = array();
	$sql = "select * from estrutura";
	$resultado = Conexao::prepare($sql);
	while($estrutura = mysqli_fetch_assoc($resultado)) {
		array_push($estruturas, $estrutura);
	}
	return $estruturas;
} 

	public function getEstrutura() {
		return $this->nome;
	}

	public function setEstrutura($nome) {
		$this->nome = $nome;
	}
	
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}
}
