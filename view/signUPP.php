<style>
  div#modalSignUPP {
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

  div.modalSUPLogin {
    flex: 1;
    position: relative;
    width: 400px;
    min-width: 150px;
    height: auto;
    margin: 35px auto;
    /* margin-top: 10%; */
    display: flex;
    justify-content: center;
    align-items: center;
  }

  div.box-contentP {
    margin-top: 5%;
    width: 100%;
    height: 100%;
  }

  div.modalSUPLogin form {
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

  div.modalSUPLogin form h1 {
    color: #fff;
    font-size: 26px;
    font-weight: 500;
    text-align: center;
    margin: 0 0 5px;
  }

  div.modalSUPLogin form span {
    color: #b9bbbe;
    font-size: 14px;
    line-height: 16px;
    font-weight: 600;
    margin-top: 15px;
  }

  div.modalSUPLogin form input {
    height: 12%;
    padding: 2.5%;
    border-radius: 3px;
    border: 1px solid rgba(0, 0, 0, 0.3);
    background-color: rgba(0, 0, 0, 0.1);
    color: #f6f6f6;
    margin-top: 2%;
    transition: border 0.15s ease;
    font-size: 16px;
  }

  div.modalSUPLogin form button {
    color: #fff;
    padding: 2.5%;
    border-radius: 3px;
    border: 0;
    background: #1a7a0d;
    font-family: "Lora", serif;
    font-weight: 400;
    margin: 8% 0 0;
  }

  .fecharSUP {
    position: absolute;
    cursor: pointer;
    right: 4%;
    top: 8%;
    color: rgba(255, 255, 255, 0.6);
  }

  .fecharSUP:hover {
    color: #fff;
  }

  div.modalSUPLogin form button:hover {
    background: #0f6603;
  }

  div.modalSUPLogin form input:focus {
    border-color: #37a129;
  }
</style>

<div id="modalSignUPP">
  <div class="modalSUPLogin">
    <div class="box-contentP">
      <form action="" method="POST" id="formP">
        <h1>Olá, Produtora (o)</h1>

        <span>Nome</span>
        <input type="text" name="nome" pattern=".{3,}" title="Mínimo 3 caracteres" required>

        <span>Sobrenome</span>
        <input type="text" name="sobrenome" pattern=".{3,}" title="Mínimo 3 caracteres" required>

        <span>E-mail</span>
        <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>

        <span>CPF</span>
        <input type="text" name="cpf" pattern="([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})" title="Digite o CPF no formato 000.000.000-00" maxlength="14" required>

        <span>Senha</span>
        <input type="password" name="senha" pattern=".{8,}" title="Mínimo 8 caracteres" required>

        <span>Digite a senha novamente</span>
        <input type="password" name="confirmaSenha" pattern=".{8,}" title="Mínimo 8 caracteres" required>

        <button type="submit" name="cadastrarP">Enviar</button>
      </form>
    </div>
    <div class="fecharSUP">x</div>
  </div>
</div>