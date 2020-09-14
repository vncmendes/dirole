<?php 

	class Estrutura {

		private $id;
		private $nome;

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
