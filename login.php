<?php
require 'bootstrap.php';

$_token = filter_input(INPUT_POST, '_token', FILTER_SANITIZE_STRING);
if($_token === $_SESSION['_token']){

  if(empty($_POST['email']) || empty($_POST['pass'])){
    $_SESSION['msg'] = 'Hay que cubrir todos los campos';
    header('Location: index.php');
    exit();
  }

  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
  $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

  /*
  $filtros = array(
    'email' => FILTER_SANITIZE_STRING,
    'pass' => FILTER_SANITIZE_STRING
);

  $datos = filter_input_array(INPUT_POST, $filtros);

  $resultado = loginUsuario($datos['email'], $datos['pass']);
  */

  $resultado = loginUsuario($email, $pass);

  if(!$resultado){
    $_SESSION['msg'] = 'Datos de acceso incorrectos';
    header('Location: index.php');
    exit();
  }

  session_regenerate_id();
  $_SESSION['identificado'] = true;
  $_SESSION['email'] = $email;
  // $_SESSION['email'] = $dagos['email'];

  $_SESSION['msg'] = 'Sessión iniciada correctamente';
  header('Location: tareas.php');
  exit();
}
?>
