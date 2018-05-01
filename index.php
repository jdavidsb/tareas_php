<?php
require 'bootstrap.php';
  if(validarUsuario()){
    header('Location: tareas.php');
    exit();
  }
getHeader('Inicio');
getAlertas();
getFormLogin();
getFooter();
?>
