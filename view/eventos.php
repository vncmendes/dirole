<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  session_start();
  session_status();
  require_once "head.php";
  require_once "../model/Evento.php";
  require_once "../model/EventoDAO.php";
  require_once '../controler/evento.php';

  $eventos = $eventoDAO->getAll();
  ?>
</head>

<body>

  <?php
  require_once 'navbar2.php'
  ?>

  <?php
  //if (isset($_SESSION['id'])) {
  //}
  require_once 'eventmain-content.php';
  ?>

  <?php
  require_once 'eventsecond-content.php'
  ?>

  <?php
  require_once '../controler/usuario.php' ?>
  <?php require_once 'footer.php' ?>
</body>

</html>