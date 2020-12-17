<?php 

class Compra extends Crud {

    protected $table = "compra";

    private $id;
	private $idevento;
	private $idusuario;
    private $comprador;
    private $evento;
    private $datacompra;
	
	public function insert() {}

	public function insertEvento(Evento $evento) {}
	
	public function update($id_usuario) {} 

    public function executaCompra($idevento, $idcomprador) {
        
        // $PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

        // $sqlComprador = $PDO->query("SELECT nome FROM usuarios where id_usuario = $idcomprador");
        // $stmtNC = $sqlComprador->fetch(PDO::FETCH_ASSOC);
        // $retNC = $stmtNC['nome'];
        // var_dump($retNC);

        // $sqlEvento = $PDO->query("SELECT nome FROM eventos where id = $idevento");
        // $stmtNE = $sqlEvento->fetch(PDO::FETCH_ASSOC);
        // $retNE = $stmtNE['nome'];

        // var_dump($retNE);

        // $sqlDataHoje = $PDO->query("SELECT CURDATE()");
        // $stmtDH = $sqlDataHoje->fetch(PDO::FETCH_ASSOC);
        // $retDH = $stmtDH['data'];
        // var_dump($retDH);
        
        // var_dump($retNC);
        // var_dump($retNE);

        // $sql = "INSERT into compra (idevento, idusuario, comprador, evento, datacompra) values ($idevento, $idcomprador, $retNC, $retNE, $retDH)";
        $sql = "INSERT into compra (idevento, idusuario) values ($idevento, $idcomprador)";
        $stmt = Banco::prepare($sql);
        $stmt->bindParam(':idevento', $idevento, PDO::PARAM_INT);
        $stmt->bindParam(':idusuario', $idcomprador, PDO::PARAM_INT);
        // $stmt->bindParam(':comprador', $retNC, PDO::PARAM_STR);
        // $stmt->bindParam(':evento', $retNE, PDO::PARAM_STR);
        // $stmt->bindParam(':datacompra', $retDH, PDO::PARAM_STR);
        $stmt->execute();

        $sqlEvento = "UPDATE eventos set qtd = qtd - 1 where eventos.id = $idevento";
        $stmtEvent = Banco::prepare($sqlEvento);
        $stmtEvent->execute();

        $sqlUsuario = "UPDATE usuarios set qtd_comp = qtd_comp + 1 where usuarios.id_usuario = $idcomprador";
        $stmtUser = Banco::prepare($sqlUsuario);
        $stmtUser->execute();

        header("Location: ../view/compraefetuada.php");

    }

    public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
    }
    
	public function getIdEvento() {
		return $this->idevento;
	}

	public function setIdEvento($idevento) {
		$this->idevento = $idevento;
    }
    
	public function getIdUsuario() {
		return $this->idusuario;
	}

	public function setIdUsuario($idusuario) {
		$this->idusuario = $idusuario;
    }
    
	public function getComprador() {
		return $this->comprador;
	}

	public function setComprador($comprador) {
		$this->comprador = $comprador;
    }
    
	public function getEvento() {
		return $this->evento;
	}

	public function setEvento($evento) {
		$this->evento = $evento;
    }
    
	public function getDataCompra() {
		return $this->datacompra;
	}

	public function setDataCompra($datacompra) {
		$this->datacompra = $datacompra;
    }
}

 ?>