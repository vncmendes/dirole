<?php

class Compra extends Crud
{

  protected $table = "compra";

  private $id;
  private $idevento;
  private $idusuario;
  private $comprador;
  private $evento;
  private $datacompra;

  public function insert()
  {
  }

  public function insertEvento(Evento $evento)
  {
  }

  public function update($id_usuario)
  {
  }

  public function getNomeEvento($idusuario) {
    $sql = "SELECT evento from $this->table where idusuario = $idusuario";
    $stmt = Banco::prepare($sql);
    $stmt->bindParam(':idusuario', $idusuario, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function getInfosCompraUser($idusuario) {
    $sql = "SELECT compra.*, DATE_FORMAT(datacompra, '%d/%m/%Y') datacompra FROM $this->table WHERE idusuario = $idusuario";
    $stmt = Banco::prepare($sql);
    $stmt->bindParam(':idusuario', $idusuario, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function getQtdsUser($idusuario) {
    $sql = "SELECT count(id) qtd, sum(valor) valor FROM $this->table WHERE idusuario = $idusuario";
    $stmt = Banco::prepare($sql);
    $stmt->bindParam(':idusuario', $idusuario, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
  }
  public function getQtdsProv($idProvider) {
    $sql = "SELECT count(id) qtd, sum(valor) valor FROM $this->table WHERE idusuario = $idProvider";
    $stmt = Banco::prepare($sql);
    $stmt->bindParam(':idusuario', $idusuario, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function getCompraUser($idusuario) {
    $sql = "SELECT count(id) from $this->table where idusuario = $idusuario";
    $stmt = Banco::prepare($sql);
    $stmt->bindParam(':idusuario', $idusuario, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
  }

  public function getCompra($idusuario) {
    $sql  = "SELECT max(idevento), evento, DATE_FORMAT(datacompra, '%d/%m/%Y') datacompra, comprador, valor FROM $this->table WHERE idusuario = :idusuario";
    // $sql  = "SELECT evento, datacompra, comprador FROM $this->table WHERE idusuario = :idusuario";
		$stmt = Banco::prepare($sql);
		$stmt->bindParam(':idusuario', $idusuario, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
  }

  public function getUltima($idusuario) {
    $sql  = "SELECT max(idevento) FROM $this->table WHERE idusuario = :idusuario";
    // $sql  = "SELECT evento, datacompra, comprador FROM $this->table WHERE idusuario = :idusuario";
		$stmt = Banco::prepare($sql);
		$stmt->bindParam(':idusuario', $idusuario, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
  }

  public function executaCompra($idevento, $idcomprador)
  {

    $PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

    $sqlComprador = $PDO->query("SELECT nome FROM usuarios where id_usuario = $idcomprador");
    $stmtNC = $sqlComprador->fetch(PDO::FETCH_ASSOC);
    $retNC = $stmtNC['nome'];

    $sqlEvento = $PDO->query("SELECT nome, ingresso FROM eventos where id = $idevento");
    $stmtNE = $sqlEvento->fetch(PDO::FETCH_ASSOC);
    $retNE = $stmtNE['nome'];
    $retV = $stmtNE['ingresso'];

    $sqlDataHoje = $PDO->query("SELECT CURDATE()");
    $stmtDH = $sqlDataHoje->fetch(PDO::FETCH_ASSOC);
    $retDH = $stmtDH['CURDATE()'];

    $sql = "INSERT into compra (idevento, idusuario, comprador, evento, valor, datacompra) values (:idevento, :idusuario, :retNC, :retNE, :retV, :retDH)";
    // $sql = "INSERT into compra (idevento, idusuario) values ($idevento, $idcomprador)";
    $stmt = Banco::prepare($sql);
    $stmt->bindParam(':idevento', $idevento, PDO::PARAM_INT);
    $stmt->bindParam(':idusuario', $idcomprador, PDO::PARAM_INT);
    $stmt->bindParam(':retNC', $retNC, PDO::PARAM_STR);
    $stmt->bindParam(':retNE', $retNE, PDO::PARAM_STR);
    $stmt->bindParam(':retV', $retV, PDO::PARAM_INT);
    $stmt->bindParam(':retDH', $retDH, PDO::PARAM_STR);
    $stmt->execute();

    // $sqlTodasCompras = $PDO->query("select * from compra");
    // $stmtTC = $sqlTodasCompras->fetchAll(PDO::FETCH_ASSOC);

    // $sqlComprador = $PDO->query("SELECT nome FROM usuarios where id_usuario = $idcomprador");

    $sqlEvento = "UPDATE eventos set qtd = qtd - 1 where eventos.id = $idevento";
    $stmtEvent = Banco::prepare($sqlEvento);
    $stmtEvent->execute();

    $sqlUsuario = "UPDATE usuarios set qtd_comp = qtd_comp + 1 where usuarios.id_usuario = $idcomprador";
    $stmtUser = Banco::prepare($sqlUsuario);
    $stmtUser->execute();
    header("Location: ../view/compraefetuada.php");
  }



  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getIdEvento()
  {
    return $this->idevento;
  }

  public function setIdEvento($idevento)
  {
    $this->idevento = $idevento;
  }

  public function getIdUsuario()
  {
    return $this->idusuario;
  }

  public function setIdUsuario($idusuario)
  {
    $this->idusuario = $idusuario;
  }

  public function getComprador()
  {
    return $this->comprador;
  }

  public function setComprador($comprador)
  {
    $this->comprador = $comprador;
  }

  public function getEvento()
  {
    return $this->evento;
  }

  public function setEvento($evento)
  {
    $this->evento = $evento;
  }

  public function getDataCompra()
  {
    return $this->datacompra;
  }

  public function setDataCompra($datacompra)
  {
    $this->datacompra = $datacompra;
  }
}
