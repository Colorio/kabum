const apiUri = "/kabum/api/index.php/sign-in";

function singIn() {
  document.getElementById("loginForm").addEventListener("submit", async function(event) {
    event.preventDefault();
    const formData = new URLSearchParams(new FormData(this));
    document.getElementById("submit").disabled = true;

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
        window.location.reload()
      }, 2000);

      return;
    } catch (error) {
      document.getElementById("mensagem").textContent = "Erro ao logar!";
      document.getElementById("submit").disabled = false;
    }
  });
}

singIn()