<?php
  require_once "../model/Evento.php";
  // require_once "../model/EventoDAO.php";
  require_once '../controller/evento.php';

  $eventos = $evento->selectAll();
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php

  require_once "head.php";
  
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
  require_once '../controller/usuario.php' ?>
  <?php require_once 'footer.php' ?>
</body>

</html>