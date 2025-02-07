<?php
  include './logged.php';
  notLogged();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KaBuM!</title>
  <link rel="icon" type="image/png" href="./public/images/favicon.webp">
  <link rel="stylesheet" href="./public/style.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="login-wrapper">
    <img src="./public/images/logo.svg" alt="Logo Kabum!">

    <h4>Acesse nossa plataforma!</h4>

    <span id="error" class="error"></span>
    <span id="success" class="success"></span>

    <div class="login-form">
      <form id="loginForm">
        <div class="form-control">
          <label for="user">Usuário:</label>
          <input type="text" id="user" name="user">
        </div>

        <div class="form-control">
          <label for="password">Senha:</label>
          <input type="password" id="password" name="password">
        </div>

        <div class="buttons">
          <button id="submit">Entrar</button>
          <a href="./register/">Não possui uma conta? Crie aqui!</a>
        </div>
      </form>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>