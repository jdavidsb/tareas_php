<?php
require 'bootstrap.php';

$_token = filter_input(INPUT_POST, '_token', FILTER_SANITIZE_STRING);
if($_token === $_SESSION['_token']){

  # Comprobar que los datos no están vacíos
  if(empty($_POST['email']) || empty($_POST['pass']) || empty($_POST['pass2'])){
    # Crear mensaje de error. si alguna de las variables que viene del form_registro están vacías, redireccionar de nuevo al mismo form registro pasandole un error
    $_SESSION['msg'] = 'Hay que cubrir todos los campos';
    header('Location: form_registro.php');
    exit();
  }

  # recogida de variables
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
  $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
  $pass2 = filter_input(INPUT_POST, 'pass2', FILTER_SANITIZE_STRING);

  # Longitud mínima de 8 caracteres
  if(strlen($pass) < 8){
    $_SESSION['msg'] = 'La contraseña debe tener un mínimo de 8 caracteres';
    header('Location: form_registro.php');
    exit();
  }

  # Comprobar que las dos contraseñas coinciden
  if($pass !== $pass2){
    $_SESSION['msg'] = 'Las contraseñas no coinciden';
    header('Location: form_registro.php');
    exit();
  }

  $resultado = registrarUsuario($email, $pass);

  if(!$resultado){
    $_SESSION['msg'] = 'No se pudo completar el registro';
    header('Location: form_registro.php');
    exit();
  }

  # Crear mensaje de que todo ha ido bien
  $_SESSION['msg'] = 'Registro completado';
  header('Location: index.php');
  exit();
}
?>
