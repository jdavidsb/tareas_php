<?php
  require 'bootstrap.php';
  unset($_SESSION['identificado']);
  // session_destroy(); # ESTO ROMPE TODAS LAS VARIABLES DE SESION
  $_SESSION['msg'] = 'Sesión cerrada correctamente';
  header('Location: index.php');
  exit();
?>
