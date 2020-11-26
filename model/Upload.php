<?php
include_once 'Usuario.php';

class Upload extends Usuario {

    	private $name;
    	private $pasta;
    	private $nome_substituto;
    	private $permite;



    	public function uploadImagem($name_imagem,$pasta_destino,$nome_principal,$tipo_imagem) {
            if(!empty($_FILES[$name_imagem][''tmp_name''])){
                $tipo_permitido = explode(",", $tipo_imagem);
            }
         }
}