<?php
require 'bootstrap.php';

if(validarUsuario()){
  header('Location: tareas.php');
  exit();
}

if(!isset($_GET['t']) || !isset($_GET['e'])){
    $_SESSION['msg'] = 'No se puede realizar la acción';
    header('Location: recordar_pass.php');
    exit();
}
$tokenmail = filter_input(INPUT_GET, 't', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_GET, 'e', FILTER_VALIDATE_EMAIL);
# Comprobar si el token y el email existen en la base de datos
$conexion = conectar();
// ANTIGUO $consulta = "SELECT * FROM usuarios WHERE mailusu='$email' AND token='$tokenmail'";
$consulta = 'SELECT * FROM usuarios WHERE mailusu=? AND token=?';
$resultado = $conexion->prepare($consulta);
$resultado->bind_param('ss', $email, $tokenmail);
$resultado->execute();
$resultado = $resultado->get_result();
// ANTIGUO $resultado = $conexion->query($consulta);

if($resultado->num_rows == 0){
  $_SESSION['msg'] = 'No se puede realizar la acción';
  header('Location: recordar_pass.php');
  exit();
}
getHeader('Recuperar contraseña');
getAlertas();
getRestablecerPass($email, $tokenmail);

getFooter();
?>
