<?php 
include_once 'Crud.php';

class Evento extends Crud {

    protected $table = "eventos";
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
    
    public function update($id_usuario) {}

    public function insert() {}

    public function insertEvent(Evento $evento) {

    try {

    $nome = $evento->getNome();
    $data = $evento->getData();
    $horai = $evento->getHorai();
    $horaf = $evento->getHoraf();
    $local = $evento->getLocal();
    $descricao = $evento->getDescricao();
    $gv = $evento->getGv();
    $ingresso = $evento->getIngresso();
    $categoria = $evento->getCategoria();
    $estrutura = $evento->getEstrutura();
    $arquivo = $evento->getArquivo();

    // $sql = "INSERT INTO $this->$table (nome, data, horainicial, horafinal, localizacao, descricao, gv, ingresso, arquivo) VALUES (:nome, :data, :horai, :horaf, :local, :descricao, :gv, :ingresso, :arquivo)";

    $sql = "insert into eventos (nome, data, horainicial, horafinal, localizacao, descricao, gv, ingresso, arquivo) values (:nome, :data, :horai, :horaf, :local, :descricao, :gv, :ingresso, :arquivo)";

    $stmt = Banco::prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':data', $data);
    $stmt->bindParam(':horai', $horai);
    $stmt->bindParam(':horaf', $horaf);
    $stmt->bindParam(':local', $local);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':gv', $gv);
    $stmt->bindParam(':ingresso', $ingresso);
    $stmt->bindParam(':arquivo', $arquivo);

    if($stmt->execute()) {

        $sqlId = "select * from eventos order by id desc";
        $stmt12 = Banco::prepare($sqlId);
        $stmt12->execute();
        $linhas=$stmt12->fetchAll();
        $idevento=$linhas[0]->id;

        foreach ($categoria as $codigo) {
            $sql2= "insert into registra_eventocategoria (idcategoria, idevento) values (:idcategoria, :idevento)";
            $result2 = Banco::prepare($sql2);
            $result2->bindParam(':idcategoria', $codigo);
            $result2->bindParam(':idevento', $idevento);
            $result2->execute();

        }

        foreach ($estrutura as $codigo) {
            $sql3= "insert into registra_eventoestrutura (idestrutura, idevento) values (:idestrutura, :idevento)";
            $result4 = Banco::prepare($sql3);
            $result4->bindParam(':idestrutura', $codigo);
            $result4->bindParam(':idevento', $idevento);
            $result4->execute();
        }

    }
 }
        catch (Exception $e) {
            print $e->getMessage();	
            }
        }
        public function alteraEvent(Evento $evento) {
            try {
            $nome = $evento->getNome();
            $data = $evento->getData();
            $horai = $evento->getHorai();
            $horaf = $evento->getHoraf();
            $local = $evento->getLocal();
            $descricao = $evento->getDescricao();
            $gv = $evento->getGv();
            $ingresso = $evento->getIngresso();
            $categoria = $evento->getCategoria();
            $estrutura = $evento->getEstrutura();
            $arquivo = $evento->getArquivo();

            $id = "select * from eventos order by id desc";
            $stmtId = Banco::prepare($id);
            $stmtId->execute();
            $resultId=$stmtId->fetchAll();
            $idzao=$resultId[0]->id;

            $sql = "update eventos set nome=:nome, data=:data, horainicial=:horai, horafinal=:horaf, localizacao=:local, descricao=:descricao, gv=:gv, ingresso=:ingresso, arquivo=:arquivo where eventos.id = '".$idzao."' ";

            $stmt = Banco::prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':data', $data);
            $stmt->bindParam(':horai', $horai);
            $stmt->bindParam(':horaf', $horaf);
            $stmt->bindParam(':local', $local);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':gv', $gv);
            $stmt->bindParam(':ingresso', $ingresso);
            $stmt->bindParam(':arquivo', $arquivo);

            $varExcluiCat = "delete from registra_eventocategoria where registra_eventocategoria.idevento = '".$idzao."' ";
            $rCat = Banco::prepare($varExcluiCat);
            $rCat->execute();

            $varExcluiEst = "delete from registra_eventoestrutura where registra_eventoestrutura.idevento = '".$idzao."' ";
            $rEst = Banco::prepare($varExcluiEst);
            $rEst->execute();

            if($stmt->execute()) {
                $sqlId = "select * from eventos order by id desc";

                $stmt12 = Banco::prepare($sqlId);
                $stmt12->execute();
                $linhas=$stmt12->fetchAll();
                $idevento=$linhas[0]->id;
        
                foreach ($categoria as $codigo) {
                    $sql2= "insert into registra_eventocategoria (idcategoria, idevento) values (:idcategoria, :idevento)";
                    $result2 = Banco::prepare($sql2);
                    $result2->bindParam(':idcategoria', $codigo);
                    $result2->bindParam(':idevento', $idevento);
                    $result2->execute();
        
                }
        
                foreach ($estrutura as $codigo) {
                    $sql3= "insert into registra_eventoestrutura (idestrutura, idevento) values (:idestrutura, :idevento)";
                    $result4 = Banco::prepare($sql3);
                    $result4->bindParam(':idestrutura', $codigo);
                    $result4->bindParam(':idevento', $idevento);
                    $result4->execute();
                }
            }
         }
                catch (Exception $e) {
                    print $e->getMessage();	
                    }
                }

    public function selectAllLimited(){
        $sql  = "SELECT * FROM $this->table limit 8";
        $stmt = Banco::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function selectAllPagination($inicio, $quantidade_pages){
        $sql  = "SELECT * FROM $this->table limit $inicio, $quantidade_pages";
        $stmt = Banco::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function selectAllWithIdProv() {
        $sql  = "SELECT eventos.nome, id, localizacao, ingresso, horainicial, horafinal, gv, estacionamento, descricao, data, arquivo FROM eventos, provider WHERE eventos.id_provider = provider.id_provider";
        $stmt = Banco::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function listaEventoCategoria($idevento) {

    $registra_eventocategorias = array();
    $sql = "select * from registra_eventocategoria join categoria on registra_eventocategoria.idcategoria = categoria.id where idevento = :idevento";
    $stmt = Banco::prepare($sql);
    $stmt->bindParam(':idevento', $idevento, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
    }

    public function listaEventoEstrutura($idevento) {
        
    $registra_eventoestruturas = array();
    $sql = "select * from registra_eventoestrutura join estrutura on registra_eventoestrutura.idestrutura = estrutura.id where idevento = :idevento";
    $stmt = Banco::prepare($sql);
    $stmt->bindParam(':idevento', $idevento, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
    }

 //% ~~ GETTER AND SETTERS ~~ %//

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