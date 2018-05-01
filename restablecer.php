<?php
require 'bootstrap.php';

if(validarUsuario()){
  header('Location: tareas.php');
  exit();
}

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$tokenmail = filter_input(INPUT_POST, 'tokenmail', FILTER_SANITIZE_STRING);

if(empty($_POST['pass']) || empty($_POST['pass2'])){
  $_SESSION['msg'] = 'Hay que cubrir todos los campos';
  header('Location: form_restablecer.php?t='.$tokenmail.'&e='.$email);
  exit();
}

$pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
$pass2 = filter_input(INPUT_POST, 'pass2', FILTER_SANITIZE_STRING);


if($pass != $pass2){
  $_SESSION['msg'] = 'Las contraseñas no coinciden';
  header('Location: form_restablecer.php?t='.$tokenmail.'&e='.$email);
  exit();
}

$passcifrada = password_hash($pass, PASSWORD_DEFAULT);
$conexion = conectar();
$consulta = "UPDATE usuarios SET passusu='$passcifrada', token='' WHERE mailusu='$email' AND token='$tokenmail'";
$resultado = $conexion->query($consulta);
if(!$resultado){
  $_SESSION['msg'] = 'No se ha podido restablecer la contraseña';
  header('Location: form_restablecer.php?t='.$tokenmail.'&e='.$email);
  exit();
}

header('Location: index.php');
exit();
?>
