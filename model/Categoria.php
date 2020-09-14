<?php 

	class Categoria {

		private $id;
		private $nome;

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