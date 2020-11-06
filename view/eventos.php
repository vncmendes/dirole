<?php
  require_once "../model/Evento.php";
  require_once "../model/EventoDAO.php";
  require_once '../controller/evento.php';

  $eventos = $evento->selectAll();
  ?>
  <!-- < ?php var_dump($eventos) ?> -->
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

 <section class="eventcards">

  <div class="eventcardscontent">


  <?php foreach ($eventos as $evento) :
    // $registra_eventocategoria = $evento->listaEventoCategoria($evento->id);
    // $registra_eventoestrutura = $evento->listaEventoEstrutura($evento->id);
  ?>
  
    <div class="cards">
      <a href="#">
        <ul>
          <div class="cardimage">
            <li><img src="images/01.jpg" alt=""></li>
          </div>

          <div class="cardinfo">
            <li>
              <span class="eventname">Nome: <?= $evento->nome ?> </span>
            </li>
            <li>
              <span class="eventdate">Data: <?= $evento->data ?> </span>
            </li>
            <li>
              <span class="eventlocation">Local: <?= $evento->localizacao ?> </span>
            </li>
          </div>
        </ul>
      </a>
    </div>
    <?php endforeach ?>
</section>

  <?php
  require_once 'eventsecond-content.php'
  ?>

  <?php
  require_once '../controller/usuario.php' ?>
  <?php require_once 'footer.php' ?>
</body>

</html>