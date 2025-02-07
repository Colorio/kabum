const apiUri = "/kabum/api/index.php/clients";

function singIn() {
  document.getElementById("formNewClient").addEventListener("submit", async function(event) {
    event.preventDefault();
    document.getElementById("submit").disabled = true;
    document.getElementById("error").textContent = '';
    document.getElementById("success").textContent = '';

    const formData = new URLSearchParams(new FormData(this));

    try {
      const response = await fetch(apiUri, {
        method: "POST",
        body: formData
      });

      const data = await response.json();

      if (data.error) {
        document.getElementById("error").textContent = `* ${data.error}`;
        document.getElementById("submit").disabled = false;
        return;
      }

      document.getElementById("error").textContent = '';
      document.getElementById("success").textContent = `* ${data.message}`;

      setTimeout(() => {
        window.location.href = '../'
      }, 2000);

      return;

    } catch (error) {
      document.getElementById("submit").disabled = false;
      document.getElementById("erro").textContent = "* Erro ao criar um cliente!";
    }
  });
}

singIn()