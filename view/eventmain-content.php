<style>
  div.eventcardscontent {
    display: flex;
    padding: 3%;
  }

  div.cards {
    position: relative;
    display: flex;
    width: 50%;
    margin: 0 1%;
    padding: ;
    border: none;
    border-radius: 8px;
    box-shadow: 2px 2px 15px 2px rgba(0, 0, 0, 0.8);

  }

  div.cards img {
    width: 100%;
    border-radius: 8px 8px 0px 0px;
  }

  div.cards ul {
    padding-inline-start: 0;
    margin-block-end: 0;
  }

  div.cards ul li {
    list-style: none;
  }

  div.cards a {
    text-decoration: none;
    color: #000000;
  }

  div.cardinfo {
    padding: 3%;
  }

  div.cardinfo span.eventname {
    font-family: "Lora", serif;
    font-size: 1.5em;
  }

  div.cardinfo span.eventdate {
    font-family: "Lora", serif;
    color: #00f;
  }

  div.cardinfo span.eventlocation {
    font-family: "Lora", serif;
    color: #777;
  }
</style>

<section class="eventcards">

  <div class="eventcardscontent">


  <?php foreach ($eventos as $evento) :
    $registra_eventocategoria = $evento->listaEventoCategoria($evento->id);
    $registra_eventoestrutura = $evento->listaEventoEstrutura($evento->id);
  ?>
  
    <div class="cards">
      <a href="#">
        <ul>
          <div class="cardimage">
            <li><img src="../images/01.jpg" alt=""></li>
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