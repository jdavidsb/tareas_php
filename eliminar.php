<?php
require 'bootstrap.php';
if(!validarUsuario()){
  $_SESSION['msg'] = 'Identificate para acceder a esta sección';
  header('Location: index.php');
  exit();
}

if(isset($_GET['ta'])){
  $idtarea = filter_input(INPUT_GET, 'ta', FILTER_SANITIZE_NUMBER_INT);
  $idusuario = $_SESSION['usuario_id'];
  $conexion = conectar();
  # Comprobando que la tarea seleccionada por el usuario existe y además la ha creado el usuario logado
  $consulta = "SELECT * FROM tareas WHERE idtarea='$idtarea' AND usuario_id='$idusuario'";
  $resultado = $conexion->query($consulta);
  if($resultado->num_rows === 0){
    $_SESSION['msg'] = 'La tarea no existe o no tiene permisos para modificarla';
    header('Location: tareas.php');
    exit();
  }

  $mod = "DELETE FROM tareas WHERE idtarea='$idtarea'";
  $resultad= $conexion->query($mod);
  if(!$resultado){
    $_SESSION['msg'] = 'No se ha podido eliminar la tarea';
    header('Location: tareas.php');
    exit();
  }
}else{
  header('Location: tareas.php');
  exit();
}
header('Location: tareas.php');
exit();
?>
