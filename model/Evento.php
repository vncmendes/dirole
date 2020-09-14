<?php 

	class Evento {

		private $id;
		private $nome;
		private $data;
		private $horai;
		private $horaf;
		private $local;
		private $descricao;
		private $gv;
		private $ingresso;
		private $categoria;
		private $estrutura;
		private $arquivo;
		
		public function getId() {
			return $this->id;
		}

		public function setId($id) {
			$this->id = $id;
		}

		public function getNome() {
			return $this->nome;
		}

		public function setNome($nome) {
			$this->nome = $nome;
		}

		public function getData() {
			return $this->data;
		}

		public function setData($data) {
			$this->data = $data;
		}

		public function getHorai() {
			return $this->horai;
		}

		public function setHorai($horai) {
			$this->horai = $horai;
		}

		public function getHoraf() {
			return $this->horaf;
		}

		public function setHoraf($horaf) {
			$this->horaf = $horaf;
		}

		public function getLocal() {
			return $this->local;
		}

		public function setLocal($local) {
			$this->local = $local;
		}

		public function getDescricao() {
			return $this->descricao;
		}

		public function setDescricao($descricao) {
			$this->descricao = $descricao;
		}

		public function getGv() {
			return $this->gv;
		}

		public function setGv($gv) {
			$this->gv = $gv;
		}

		public function getIngresso() {
			return $this->ingresso;
		}

		public function setIngresso($ingresso) {
			$this->ingresso = $ingresso;
		}

		public function getCategoria() {
			return $this->categoria;
		}

		public function setCategoria($categoria) {
			$this->categoria = $categoria;
		}

		public function getEstrutura() {
			return $this->estrutura;
		}

		public function setEstrutura($estrutura) {
			$this->estrutura = $estrutura;
		}

		public function getArquivo() {
			return $this->arquivo;
		}

		public function setArquivo($arquivo) {
			$this->arquivo = $arquivo;
		}


	}


 ?>