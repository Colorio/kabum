const apiUri = "/kabum/api/index.php/clients/";

const modal = document.getElementById("modalEdit");
const closeModalBtn = document.getElementById("closeModalBtn");

let clients = [];
let selectedIndex = null

async function fetchClients() {
  try {
    const response = await fetch(apiUri, {
      method: "GET"
    });

    const data = await response.json();

    if (data) {
      clients = data
      renderTable()
    }

  } catch (error) {
    document.getElementById("mensagem").textContent = "Erro ao buscar clientes!";
  }
}

function updateClient() {
  document.getElementById("formEditClient").addEventListener("submit", async function(event) {
    event.preventDefault();
    document.getElementById("submit").disabled = true;
    document.getElementById("error").textContent = '';
    document.getElementById("success").textContent = '';

    const formData = new URLSearchParams(new FormData(this));
    formData.append('id', clients[selectedIndex].id);

    try {
      const response = await fetch(apiUri + selectedIndex, {
        method: "PUT",
        body: formData
      });

      const data = await response.json();

      if (data.error) {
        document.getElementById("error").textContent = `* ${data.error}`;
        document.getElementById("submit").disabled = false;
        return;
      }

      document.getElementById("success").textContent = `* ${data.message}`;

      setTimeout(() => {
        clients[selectedIndex].name = formData.get('name')
        clients[selectedIndex].birthday = formatDateToDatabase(formData.get('birthday'))
        clients[selectedIndex].cpf = formData.get('cpf')
        clients[selectedIndex].rg = formData.get('rg')
        clients[selectedIndex].phone = formData.get('phone')

        renderTable()
        closeModal()
      }, 2000);

      return;

    } catch (error) {
      document.getElementById("submit").disabled = false;
      document.getElementById("erro").textContent = "* Erro ao criar um cliente!";
    }
  });
}

async function deleteClient(index, event) {
  try {
    const response = await fetch(apiUri + clients[index].id, {
      method: "DELETE"
    });

    const data = await response.json();
    event.target.disabled = true;

    if (data.error) {
      event.target.disabled = false;
      return;
    }

    document.getElementById("success").textContent = `* ${data.message}`;

    setTimeout(() => {
      clients = removeItemAndResetIndexes(clients, index);
      renderTable()
    }, 2000);

    return;

  } catch (error) {
    event.target.disabled = false;
  }
}

function renderTable() {
  const clientList = document.getElementById('client-rows');
  clientList.innerHTML = '';

  clients.forEach((client, index) => {
    let tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${index + 1}</td>
      <td>${client.name}</td>
      <td>${formatDate(client.birthday)}</td>
      <td>${formatCpf(client.cpf)}</td>
      <td>${client.rg}</td>
      <td>${formatPhone(client.phone)}</td>
      <td><a onClick="openAddressesModal(${client.id})" class="addresses">Gerenciar endereços</a></td>
      <td>
        <div class="actions">
          <button onClick="openModalEdit(${index})" class="edit">Editar</button>
          <button onclick="deleteClient(${index}, event)" class="delete">Excluir</button>
        <div>
      </td>
    `;

    clientList.appendChild(tr);
  });
}

function removeItemAndResetIndexes(array, indexToRemove) {
  if (indexToRemove > -1 && indexToRemove < array.length) {
    array.splice(indexToRemove, 1);
  }
  return array.map((item, index) => item);
}

function openModalEdit(index) {
  selectedIndex = index
  const client = clients[selectedIndex]
  document.getElementById("submit").disabled = false;

  document.getElementById("error").textContent = '';
  document.getElementById("success").textContent = '';

  document.getElementById("name").value = client.name;
  document.getElementById("birthday").value = formatDate(client.birthday);
  document.getElementById("cpf").value = formatCpf(client.cpf);
  document.getElementById("rg").value = client.rg;
  document.getElementById("phone").value = formatPhone(client.phone);

  document.body.classList.add("no-scroll");
  modal.style.display = "block";
}

function closeModal() {
  document.body.classList.remove("no-scroll");
  document.getElementById("name").value = "";
  document.getElementById("birthday").value = "";
  document.getElementById("cpf").value = "";
  document.getElementById("rg").value = "";
  document.getElementById("phone").value = "";
  selectedIndex = null
  modal.style.display = "none";
}

closeModalBtn.onclick = function() {
  closeModal()
}

window.onclick = function(event) {
  if (event.target == modal) {
    closeModal()
  }
}

fetchClients()
updateClient()
