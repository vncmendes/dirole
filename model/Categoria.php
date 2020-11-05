<?php 

class Categoria extends Crud {

	protected $table = "categoria";
	private $id;
	private $nome;
	
	public function insert() {

	}

	public function insertEvento(Evento $evento) {}
	
	public function update($id_usuario) {
		
	}
	
	function listaCategoria(Categoria $categoria) {
		$categoria = array();
		$sql = "select * from categoria";
		$resultado = Conexao::prepare($sql);
		while($estrutura = mysqli_fetch_assoc($resultado)) {
			array_push($categorias, $categoria);
		}
		return $categorias;
	} 

	public function getCategoria() {
		return $this->nome;
	}

	public function setCategoria($nome) {
		$this->nome = $nome;
	}
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}
}

 ?>