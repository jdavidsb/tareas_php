<?php
require 'bootstrap.php';

if(validarUsuario()){
  header('Location: tareas.php');
  exit();
}
getHeader('Recuperar Contraseña');
getAlertas();
getPassRecovery();
getFooter();
?>
