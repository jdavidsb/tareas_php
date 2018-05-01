<?php
require 'bootstrap.php';
  if(!validarUsuario()){
    $_SESSION['msg'] = 'Identificate para acceder a esta sección';
    header('Location: index.php');
    exit();
  }
getHeader('Mis tareas');
getAlertas();
getFormNuevaTarea();
# SISTEMA DE PAGINACION
  if(isset($_GET['p'])){
    $pagina = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_NUMBER_INT);
  }else{
    $pagina = 1;
  }
$paginacion = paginacion($pagina);
# A la función recoger tareas le paso el número de página
$tareas = recogerTareas($pagina);
  if($tareas->num_rows == 0){
    echo '<h4>No hay tareas para mostrar</h4>';
  }else{
    mostrarTareas($tareas, $paginacion);
  }

getFooter();
?>
