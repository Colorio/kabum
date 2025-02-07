<?php
  include '../../header.php';
  include '../../../logged.php';
  onlyLogged();
?>

<link rel="stylesheet" href="./style.css">

<session>
  <div class="session-header">
    <h2>Novo cliente</h2>
    <div>
      <a href="../"><button>Voltar</button></a>
    </div>
  </div>

  <hr>

  <div class="session-new">
    <form id="formNewClient">
      <span id="error" class="error"></span>
      <span id="success" class="success"></span>
      <div>
        <div class="form-control">
          <label for="name">Nome:</label>
          <input type="text" id="name" name="name">
        </div>

        <div class="form-control">
          <label for="birthday">Data de nascimento:</label>
          <input type="text" id="birthday" name="birthday">
        </div>

        <div class="form-control">
          <label for="cpf">CPF:</label>
          <input type="text" id="cpf" name="cpf">
        </div>

        <div class="form-control">
          <label for="rg">RG:</label>
          <input type="text" id="rg" name="rg">
        </div>

        <div class="form-control">
          <label for="phone">Telefone:</label>
          <input type="text" id="phone" name="phone">
        </div>
      </div>

      <div class="session-new-footer">
        <button id="submit">Adicionar</button>
      </div>
    </form>
  </div>

</session>

<script src="./script.js"></script>
<script src="../input-masks.js"></script>

<?php
  include '../../footer.php';
?>