<style>
  section.eventcards {
    padding-top: 1%;
  }

  div.eventcardscontent {
    display: flex;
    padding: 3%;
    box-shadow: 6px 6px 15px 1px black;
  }

  div.cards {
    position: relative;
    display: flex;
    width: 25%;
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
    color: #000;
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

  section.eventcards span.indexontherise {
    font-size: 2em;
    position: relative;
    margin: 5%;
    color: rgba(100, 10, 200, 0.9);
  }
</style>

<section class="eventcards">
  <span class="indexontherise">Em Alta</span>
  <div class="eventcardscontent">
    <div class="cards">
      <a href="#">
        <ul>
          <div class="cardimage">
            <li><img src="../images/01.jpg" alt=""></li>
          </div>

          <div class="cardinfo">
            <li>
              <span class="eventname">Nome: </span>
            </li>
            <li>
              <span class="eventdate">Data: </span>
            </li>
            <li>
              <span class="eventlocation">Local: </span>
            </li>
          </div>
        </ul>
      </a>
    </div>
    <div class="cards">
      <a href="#">
        <ul>
          <div class="cardimage">
            <li><img src="../images/02.jpg" alt=""></li>
          </div>

          <div class="cardinfo">
            <li>
              <span class="eventname">Nome: </span>
            </li>
            <li>
              <span class="eventdate">Data: </span>
            </li>
            <li>
              <span class="eventlocation">Local: </span>
            </li>
          </div>
        </ul>
      </a>
    </div>
    <div class="cards">
      <a href="#">
        <ul>
          <div class="cardimage">
            <li><img src="../images/03.jpg" alt=""></li>
          </div>

          <div class="cardinfo">
            <li>
              <span class="eventname">Nome: </span>
            </li>
            <li>
              <span class="eventdate">Data: </span>
            </li>
            <li>
              <span class="eventlocation">Local: </span>
            </li>
          </div>
        </ul>
      </a>
    </div>
    <div class="cards">
      <a href="#">
        <ul>
          <div class="cardimage">
            <li><img src="../images/04.jpg" alt=""></li>
          </div>

          <div class="cardinfo">
            <li>
              <span class="eventname">Nome: </span>
            </li>
            <li>
              <span class="eventdate">Data: </span>
            </li>
            <li>
              <span class="eventlocation">Local: </span>
            </li>
          </div>
        </ul>
      </a>
    </div>
  </div>

</section>