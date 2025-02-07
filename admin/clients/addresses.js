
const apiAddressesUri = "/kabum/api/index.php/addresses/";
const addressesModal = document.getElementById("modalAddresses");
const closeAddressModalBtn = document.getElementById("closeAddressModalBtn");

let currentClientId = null
let currentClientName = null
let addresses = []
let editAddressIndex = null
let isCreating = false

function openAddressesModal(clientId) {
  currentClientId = clientId;
  fetchAddresses();

  document.body.classList.add("no-scroll");
  addressesModal.style.display = "block";
}

function closeAddressesModal() {
  document.body.classList.remove("no-scroll");
  addresses = null;
  currentClientId = null;
  currentClientName = null;
  addressesModal.style.display = "none";
}

async function fetchAddresses() {
  try {
    const response = await fetch(apiAddressesUri + currentClientId, {
      method: "GET"
    });

    const data = await response.json();

    if (data) {
      addresses = data
      renderAddressesTable();
    }

  } catch (error) {
    console.log('erro ao buscar endereços');
  }
}

function newAddress() {
  if (isCreating) {
    return;
  }

  isCreating = true;

  const addressesList = document.getElementById('addresses-rows');
  let tr = document.createElement("tr");
  tr.innerHTML = `
    <form id="addressFormCreate">
      <td></td>
      <td><input id="addressName" name="addressName"></td>
      <td><input id="address" name="address"></td>
      <td><input id="city" name="city"></td>
      <td><input id="state" name="state"></td>
      <td><input id="zipcode" name="zipcode"></td>
      <td>
        <div class="actions">
          <button id="save" onClick="createAddress()" class="save">&check;</button>
          <button id="cancel" onclick="cancelAddressEdit()" class="cancel">&times;</button>
        <div>
      </td>
    </form>
  `;

  addressesList.prepend(tr);
}

async function createAddress() {
  const form = document.getElementById("addressFormCreate");
  document.getElementById("save").disabled = true;
  document.getElementById("errorAddress").textContent = '';
  document.getElementById("successAddress").textContent = '';

  const formData = new URLSearchParams(new FormData(form));
  formData.append('clientId', currentClientId);
  formData.append('addressName', document.getElementById("addressName").value);
  formData.append('address', document.getElementById("address").value);
  formData.append('city', document.getElementById("city").value);
  formData.append('state', document.getElementById("state").value);
  formData.append('zipcode', document.getElementById("zipcode").value);

  try {
    const response = await fetch(apiAddressesUri, {
      method: "POST",
      body: formData
    });

    const data = await response.json();

    if (data.error) {
      document.getElementById("errorAddress").textContent = `* ${data.error}`;
      document.getElementById("save").disabled = false;
      return;
    }

    document.getElementById("successAddress").textContent = `* ${data.message}`;

    setTimeout(() => {
      fetchAddresses();
      editAddressIndex = null;
      document.getElementById("errorAddress").textContent = '';
      document.getElementById("successAddress").textContent = '';
    }, 2000);
    isCreating = false;

    return;

  } catch (error) {
    isCreating = false;
    document.getElementById("submit").disabled = false;
    document.getElementById("erro").textContent = "* Erro ao editar um endereço!";
  }

}

async function updateAddress() {
  const form = document.getElementById("addressFormUpdate");
  document.getElementById("save").disabled = true;
  document.getElementById("errorAddress").textContent = '';
  document.getElementById("successAddress").textContent = '';

  const formData = new URLSearchParams(new FormData(form));
  formData.append('clientId', currentClientId);
  formData.append('addressName', document.getElementById("addressName").value);
  formData.append('address', document.getElementById("address").value);
  formData.append('city', document.getElementById("city").value);
  formData.append('state', document.getElementById("state").value);
  formData.append('zipcode', document.getElementById("zipcode").value);

  try {
    const response = await fetch(apiAddressesUri + editAddressIndex, {
      method: "PUT",
      body: formData
    });

    const data = await response.json();

    if (data.error) {
      document.getElementById("errorAddress").textContent = `* ${data.error}`;
      document.getElementById("save").disabled = false;
      return;
    }

    document.getElementById("successAddress").textContent = `* ${data.message}`;

    setTimeout(() => {
      addresses[editAddressIndex].name = document.getElementById("addressName").value;
      addresses[editAddressIndex].address = document.getElementById("address").value;
      addresses[editAddressIndex].city = document.getElementById("city").value;
      addresses[editAddressIndex].state = document.getElementById("state").value;
      addresses[editAddressIndex].zipcode = document.getElementById("zipcode").value;
      editAddressIndex = null
      document.getElementById("errorAddress").textContent = '';
      document.getElementById("successAddress").textContent = '';
      renderAddressesTable()
    }, 2000);

    return;

  } catch (error) {
    document.getElementById("submit").disabled = false;
    document.getElementById("erro").textContent = "* Erro ao editar um endereço!";
  }
}

function renderAddressesTable() {
  const addressesList = document.getElementById('addresses-rows');
  addressesList.innerHTML = '';

  addresses.forEach((address, index) => {
    let tr = document.createElement("tr");
    if (editAddressIndex == index && editAddressIndex != null) {
      tr.innerHTML = `
        <form id="addressFormUpdate">
          <td>${index + 1}</td>
          <td><input id="addressName" name="addressName" value="${address.name}"></td>
          <td><input id="address" name="address" value="${address.address}"></td>
          <td><input id="city" name="city" value="${address.city}"></td>
          <td><input id="state" name="state" value="${address.state}"></td>
          <td><input id="zipcode" name="zipcode" value="${address.zipcode}"></td>
          <td>
            <div class="actions">
              <button id="save" onClick="updateAddress()" class="save">&check;</button>
              <button id="cancel" onclick="cancelAddressEdit()" class="cancel">&times;</button>
            <div>
          </td>
        </form>
      `;

    } else {
      tr.innerHTML = `
        <td>${index + 1}</td>
        <td>${address.name}</td>
        <td>${address.address}</td>
        <td>${address.city}</td>
        <td>${address.state}</td>
        <td>${address.zipcode}</td>
        <td>
          <div class="actions">
            <button onClick="editAddresses(${index})" class="edit">Editar</button>
            <button onclick="deleteAddress(${index}, event)" class="delete">Excluir</button>
          <div>
        </td>
      `;
    }

    addressesList.appendChild(tr);
  });
}

function cancelAddressEdit() {
  editAddressIndex = null;
  isCreating = false;
  renderAddressesTable()
}

function editAddresses(index) {
  editAddressIndex = index;
  renderAddressesTable()
}

async function deleteAddress(index, event) {
  try {
    const response = await fetch(apiAddressesUri + addresses[index].id, {
      method: "DELETE"
    });

    const data = await response.json();
    event.target.disabled = true;

    if (data.error) {
      event.target.disabled = false;
      return;
    }

    setTimeout(() => {
      addresses = removeItemAndResetIndexes(addresses, index);
      renderAddressesTable()
    }, 2000);

    return;

  } catch (error) {
    event.target.disabled = false;
  }
}

closeAddressModalBtn.onclick = function() {
  closeAddressesModal()
}

window.onclick = function(event) {
  if (event.target == addressesModal) {
    closeAddressesModal()
  }
}