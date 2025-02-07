// const apiUrl = '../api/index.php/users';

// // document.addEventListener('DOMContentLoaded', loadUsers);
// document.addEventListener('DOMContentLoaded', fetchUsers);

// function fetchUsers() {
//   fetch('../api/index.php/users')
//     .then(response => response.json())
//     .then(users => {
//       console.log(users)
//       const userList = document.getElementById('users');
//       userList.innerHTML = '';
//       users.forEach(user => {
//         const li = document.createElement('li');
//         li.textContent = `${user.name} - ${user.email}`;
//         li.innerHTML += ` <button onclick="deleteUser(${user.id})">Excluir</button>`;
//         userList.appendChild(li);
//       });
//     });
// }

// function addUser() {
//     fetch(apiUrl)
//         .then(response => response.json())
//         .then(users => {
//             const userTable = document.getElementById('userTable');
//             userTable.innerHTML = '';
//             users.forEach(user => {
//                 userTable.innerHTML += `
//                     <tr>
//                         <td>${user.id}</td>
//                         <td>${user.name}</td>
//                         <td>${user.email}</td>
//                         <td>
//                             <button onclick="editUser(${user.id}, '${user.name}', '${user.email}')">Editar</button>
//                             <button onclick="deleteUser(${user.id})">Deletar</button>
//                         </td>
//                     </tr>`;
//             });
//         });
// }

// document.getElementById('userForm').addEventListener('submit', function (e) {
//     e.preventDefault();
//     const id = document.getElementById('userId').value;
//     const name = document.getElementById('name').value;
//     const email = document.getElementById('email').value;

//     const method = id ? 'PUT' : 'POST';
//     const payload = id ? { id, name, email } : { name, email };

//     fetch(apiUrl+"users", {
//         method: method,
//         headers: { 'Content-Type': 'application/json' },
//         body: JSON.stringify(payload)
//     })
//     .then(response => response.json())
//     .then(data => {
//         alert(data.message || data.error);
//         document.getElementById('userForm').reset();
//         loadUsers();
//     });
// });

// function editUser(id, name, email) {
//     document.getElementById('userId').value = id;
//     document.getElementById('name').value = name;
//     document.getElementById('email').value = email;
// }

// function deleteUser(id) {
//     if (confirm('Tem certeza que deseja deletar este usuário?')) {
//         fetch(apiUrl+"users", {
//             method: 'DELETE',
//             headers: { 'Content-Type': 'application/json' },
//             body: JSON.stringify({ id })
//         })
//         .then(response => response.json())
//         .then(data => {
//             alert(data.message || data.error);
//             loadUsers();
//         });
//     }
// }
