<?php
require 'bootstrap.php';
  if(validarUsuario()){
    header('Location: tareas.php');
    exit();
  }
getHeader('Crear cuenta');
getAlertas();
getFormRegistro();
getFooter();
?>
