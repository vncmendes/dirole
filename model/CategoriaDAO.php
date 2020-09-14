<?php 

@session_start();

require_once '../model/Crud.php';

class CategoriaDAO extends Crud {

	protected $table = "categoria";

function listaCategoria(Categoria $categoria) {
	$categoria = array();
	$sql = "select * from categoria";
	$resultado = Conexao::prepare($sql);
	while($estrutura = mysqli_fetch_assoc($resultado)) {
		array_push($categorias, $categoria);
	}
	return $categorias;
} 

}
