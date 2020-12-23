<?php 

@session_start();

require_once '../model/Crud.php';

class EstruturaDAO extends Crud {

	protected $table = "estrutura";


function listaEstrutura(Estrutura $estrutura) {
	$estruturas = array();
	$sql = "select * from estrutura";
	$resultado = Conexao::prepare($sql);
	while($estrutura = mysqli_fetch_assoc($resultado)) {
		array_push($estruturas, $estrutura);
	}
	return $estruturas;
} 

}
