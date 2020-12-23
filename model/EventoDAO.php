 <!-- < ?php

@session_start();

require_once '../model/Crud.php';

class EventoDAO extends Crud {
	
	protected $table = "eventos";

	function insert(Evento $evento) {

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

	$sql = "insert into eventos (nome, data, horainicial, horafinal, localizacao, descricao, gv, ingresso, arquivo) values (:nome, :data, :horai, :horaf, :local, :descricao, :gv, :ingresso, :arquivo)";

	$stmt = Conexao::prepare($sql);
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
		$stmt12 = Conexao::prepare($sqlId);
		$stmt12->execute();
		$linhas=$stmt12->fetchAll();
		$idevento=$linhas[0]->id;

	 foreach ($categoria as $codigo) {
		$sql2= "insert into registra_eventocategoria (idcategoria, idevento) values (:idcategoria, :idevento)";
			$result2 = Conexao::prepare($sql2);
			$result2->bindParam(':idcategoria', $codigo);
			$result2->bindParam(':idevento', $idevento);
			$result2->execute();
	
	 }

	 foreach ($estrutura as $codigo) {
		$sql3= "insert into registra_eventoestrutura (idestrutura, idevento) values (:idestrutura, :idevento)";
			$result4 = Conexao::prepare($sql3);
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

	function listaEventoCategoria($idevento) {

	$registra_eventocategorias = array();
	$sql = "select * from registra_eventocategoria join categoria on registra_eventocategoria.idcategoria = categoria.id where idevento = :idevento";
		$stmt = Conexao::prepare($sql);
		$stmt->bindParam(':idevento', $idevento, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();

}

	function listaEventoEstrutura($idevento) {
		
	$registra_eventoestruturas = array();
	$sql = "select * from registra_eventoestrutura join estrutura on registra_eventoestrutura.idestrutura = estrutura.id where idevento = :idevento";
	$stmt = Conexao::prepare($sql);
	$stmt->bindParam(':idevento', $idevento, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchAll();
}

} -->