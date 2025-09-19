<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add User</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-white min-h-screen p-8">

  <!-- Top Picture -->
  <div class="flex justify-center mb-6">
    <!-- Replace the src with your own file path -->
    <img src="Hfiz.png" alt="Logo" 
         class="w-32 h-32 rounded-full object-cover shadow-lg border">
  </div>

  <!-- Top bar -->
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Admin CRUD</h1>
    <!-- Logout button -->
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" 
        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">
        Logout
      </button>
    </form>
  </div>

  <!-- Form -->
  <form id="crudForm" class="flex flex-col md:flex-row gap-3 mb-6">
    <input type="hidden" id="userId">
    <input type="text" id="name" placeholder="Name" required
      class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">
    <input type="email" id="email" placeholder="Email" required
      class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">
    <button type="submit"
      class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">Save</button>
    <button type="button" onclick="resetForm()"
      class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded-lg transition">Cancel</button>
  </form>

  <!-- Table -->
  <div class="overflow-x-auto">
    <table class="w-full border-collapse">
      <thead>
        <tr class="bg-blue-100 text-left">
          <th class="p-3 border">ID</th>
          <th class="p-3 border">Name</th>
          <th class="p-3 border">Email</th>
          <th class="p-3 border">Actions</th>
        </tr>
      </thead>
      <tbody id="tableBody" class="bg-white"></tbody>
    </table>
  </div>

  <script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    async function fetchUsers() {
      const res = await fetch("/users2");
      const users = await res.json();
      renderTable(users);
    }

    async function saveUser(e) {
      e.preventDefault();
      const userId = document.getElementById('userId').value;
      const name = document.getElementById('name').value.trim();
      const email = document.getElementById('email').value.trim();

      let url = "/users2";
      let method = "POST";

      if (userId) {
        url = `/users2/${userId}`;
        method = "PUT";
      }

      await fetch(url, {
        method,
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": csrfToken
        },
        body: JSON.stringify({ name, email })
      });

      resetForm();
      fetchUsers();
    }

    async function deleteUser(id) {
      if (!confirm("Delete this record?")) return;
      await fetch(`/users2/${id}`, {
        method: "DELETE",
        headers: {
          "X-CSRF-TOKEN": csrfToken,
          "Accept": "application/json"
        }
      });
      fetchUsers();
    }

    function renderTable(users) {
      const tbody = document.getElementById('tableBody');
      tbody.innerHTML = '';
      if (users.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" class="p-4 text-center text-gray-500">No records found</td></tr>';
        return;
      }
      users.forEach(user => {
        tbody.innerHTML += `
          <tr class="hover:bg-gray-100">
            <td class="p-3 border">${user.id}</td>
            <td class="p-3 border">${user.name}</td>
            <td class="p-3 border">${user.email}</td>
            <td class="p-3 border space-x-2">
              <button onclick="editUser(${user.id})" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg transition">Edit</button>
              <button onclick="deleteUser(${user.id})" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition">Delete</button>
            </td>
          </tr>
        `;
      });
    }

    function editUser(id) {
      const users = document.getElementById('tableBody').querySelectorAll('tr');
      const row = Array.from(users).find(r => r.children[0].innerText == id);
      document.getElementById('userId').value = id;
      document.getElementById('name').value = row.children[1].innerText;
      document.getElementById('email').value = row.children[2].innerText;
    }

    function resetForm() {
      document.getElementById('userId').value = '';
      document.getElementById('crudForm').reset();
    }

    document.getElementById('crudForm').addEventListener('submit', saveUser);

    fetchUsers();
  </script>
</body>
</html>
