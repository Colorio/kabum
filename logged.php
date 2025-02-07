<?php
  session_start();

  function notLogged() {
    if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
      header("Location: ./admin/clients");
      exit();
    }
  }

  function onlyLogged() {
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] != 1) {
      header("Location: /kabum");
      exit();
    }
  }
?>