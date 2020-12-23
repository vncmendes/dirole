<?php
session_start();
require_once "usuario.php";
require_once "../model/Evento.php";
require_once "../model/Usuario.php";
require_once "../model/Compra.php";

$eventos = new Evento();
$usuario = new Usuario();
$compra = new Compra();


//<-- CONTROADOR ONDE É RECEBIDOA AS INFORMAÇÕES DA COMPRA -->

if (array_key_exists("finalizarCompra", $_POST)) {

    $idevento = $_POST['id'];
    $idcomprador = $_SESSION['id_usuario'];

    if(empty($idcomprador) || (empty($idevento))) {
        // header("Location: ../view/compraefetuada.php");
        echo "Não foi possível efetuar a compra do ingresso, tentei novamente !";
    }
    else {
        $r = $compra->executaCompra($idevento, $idcomprador);
        if ($r) {
            header("Location: ../view/compraefetuada.php");
            echo "Parabéns agora é só partir para a diversão !";
        }
        // header("Location: ../view/compraefetuada.php");
    }

    

    

}

?>