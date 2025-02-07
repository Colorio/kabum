<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KaBuM!</title>
  <link rel="icon" type="image/png" href="./public/images/favicon.webp">
  <link rel="stylesheet" href="../public/style.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="login-wrapper">
    <img src="../public/images/logo.svg" alt="Logo Kabum!">

    <span id="error" class="error"></span>
    <span id="success" class="success"></span>

    <h4>Crie seu cadastro!</h4>

    <div class="login-form">
      <form id="registerForm">
        <div class="form-control">
          <label for="name">Nome:</label>
          <input type="text" id="name" name="name">
        </div>

        <div class="form-control">
          <label for="email">E-mail:</label>
          <input type="text" id="email" name="email">
        </div>

        <div class="form-control">
          <label for="password">Senha:</label>
          <input type="password" id="password" name="password">
        </div>

        <div class="buttons">
          <button id="submit" type="submit" >Criar conta!</button>
          <a href="../">Já possui um conta? Entrar!</a>
        </div>
      </form>
    </div>
  </div>

  <script src="./script.js"></script>
</body>
</html>