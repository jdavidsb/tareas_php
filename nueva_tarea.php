<?php
require 'bootstrap.php';

if(!validarUsuario()){
  $_SESSION['msg'] = 'Identificate para acceder a esta sección';
  header('Location: index.php');
  exit();
}

  if(empty($_POST['nuevatarea'])){
    $_SESSION['msg'] = 'Escribe una tarea';
    header('Location: tareas.php');
    exit();
  }
  $tarea = filter_input(INPUT_POST, 'nuevatarea', FILTER_SANITIZE_STRING);
  $resultado = crearTarea($tarea);

  if(!$resultado){
    $_SESSION['msg'] = 'No se pudo crear la tarea';
    header('Location: tareas.php');
    exit();
  }

  $_SESSION['msg'] = 'Tarea creada correctamente';
  header('Location: tareas.php');
  exit();


?>
