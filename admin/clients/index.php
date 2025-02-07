<?php
  include '../header.php';
  include '../../logged.php';
  onlyLogged();
?>

<link rel="stylesheet" href="style.css">

<session>
  <div class="session-header">
    <h2>Clientes</h2>
    <div>
      <a href="./new"><button>Novo cliente</button></a>
    </div>
  </div>
  <hr>
  <div class="session-list">
    <table>
      <thead>
          <tr>
            <th></th>
            <th>Nome</th>
            <th>Data de nascimento</th>
            <th>CPF</th>
            <th>RG</th>
            <th>Telefone</th>
            <th>Endereços</th>
            <th>Ações</th>
          </tr>
      </thead>
      <tbody id="client-rows"></tbody>
    </table>
  </div>
</session>

<div id="modalEdit" class="modal">
  <div class="modal-content">
    <span id="closeModalBtn" class="close">&times;</span>
    <h2>Editar cliente</h2>
    <div>
      <form id="formEditClient">
        <span id="error" class="error"></span>
        <span id="success" class="success"></span>
        <div>
          <div class="form-control">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name">
          </div>

          <div class="form-control">
            <label for="birthday">Data de nascimento:</label>
            <input type="text" id="birthday" name="birthday" placeholder="DD/MM/YYYY" maxlength="10">
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
          <button id="submit">Editar cliente</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="modalAddresses" class="modal">
  <div class="modal-content">
    <span id="closeAddressModalBtn" class="close">&times;</span>
    <h2>Endereços</h2>
    <button onclick="newAddress()">Adicionar novo endereço</button>

    <div class="session-list">
      <span id="errorAddress" class="error"></span>
      <span id="successAddress" class="success"></span>

      <table>
        <thead>
            <tr>
              <th></th>
              <th>Nome</th>
              <th>Endereço</th>
              <th>Cidade</th>
              <th>Estado</th>
              <th>CEP</th>
              <th>Ações</th>
            </tr>
        </thead>
        <tbody id="addresses-rows"></tbody>
      </table>
    </div>
  </div>
</div>

<script src="data-format.js"></script>
<script src="script.js"></script>
<script src="input-masks.js"></script>
<script src="addresses.js"></script>

<?php
  include '../footer.php';
?>