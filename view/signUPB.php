<style>
  div#modalSignUPB {
    background: rgba(0, 0, 0, 0.6);
    left: 0;
    top: 0;
    display: none;
    width: 100%;
    height: 100%;
    display: none;
    position: fixed;
    z-index: 100;
  }


  div.modalSUBLogin {
    flex: 1;
    position: relative;
    max-width: 380px;
    min-width: 150px;
    max-height: auto;
    margin: 35px auto;
    display: flex;
  }

  div.box-contentB {
    margin-top: 5%;
    width: 100%;
    height: 100%;
  }

  div.modalSUBLogin form {
    background: #36393f;
    border-radius: 5px;
    box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.2);
    padding: 6% 10%;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: stretch;
    margin-top: 5%;
  }

  div.modalSUBLogin form h1 {
    color: #fff;
    font-size: 26px;
    font-weight: 500;
    text-align: center;
    margin: 0 0 5px;
  }

  div.modalSUBLogin form span {
    color: #b9bbbe;
    font-size: 14px;
    line-height: 16px;
    font-weight: 600;
    margin-top: 15px;
  }

  div.modalSUBLogin form input {
    height: 14%;
    padding: 2.5%;
    border-radius: 3px;
    border: 1px solid rgba(0, 0, 0, 0.3);
    background-color: rgba(0, 0, 0, 0.1);
    color: #f6f6f6;
    margin-top: 2%;
    transition: border 0.15s ease;
    font-size: 16px;
  }

  div.modalSUBLogin form button {
    color: #fff;
    padding: 2.5%;
    border-radius: 3px;
    border: 0;
    background: #1a7a0d;
    font-family: "Lora", serif;
    font-weight: 400;
    margin: 8% 0 0;
  }

  .fecharSUB {
    position: absolute;
    cursor: pointer;
    right: 4%;
    top: 8%;
    color: rgba(255, 255, 255, 0.6);
  }

  .fecharSUP:hover {
    color: #fff;
  }

  div.modalSUBLogin form button:hover {
    background: #0f6603;
  }

  div.modalSUBLogin form input:focus {
    border-color: #37a129;
  }
</style>

<div id="modalSignUPB">
  <div class="modalSUBLogin">
    <div class="box-contentB">
      <form action="" method="POST" id="formB">
        <h1>Bem-Vindo (a)</h1>

        <span>Nome</span>
        <input type="text" name="nameB" pattern=".{3,}" title="Mínimo 3 caracteres" required>

        <span>Sobrenome</span>
        <input type="text" name="snameB" pattern=".{3,}" title="Mínimo 3 caracteres" required>

        <span>E-mail</span>
        <input type="email" name="emailB" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>

        <span>Senha</span>
        <input type="password" name="passwordB" pattern=".{8,}" title="Mínimo 8 caracteres" required>

        <span>Digite a senha novamente</span>
        <input type="password" name="password2B" pattern=".{8,}" title="Mínimo 8 caracteres" required>

        <button type="submit" name="cadastrarB">Enviar</button>
      </form>
    </div>
    <div class="fecharSUB">x</div>
  </div>
</div>