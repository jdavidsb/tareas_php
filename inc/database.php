<?php
  function conectar(){
    # la conexión la ponemos en una función. devuelve conexion si se establece y si no devuelve false
    $conexion = new mysqli('localhost', 'root', '', 'gestion_tareas');
    if($conexion){
      return $conexion;
    }
    return false;
  }

  function desconectar($conexion){
    $conexion->close();
  }

  function crearTarea($tarea){
    $idusuario = $_SESSION['usuario_id'];
    $conexion = conectar();
    // ANTIGUO $consulta = "INSERT INTO tareas (idtarea ,destarea, usuario_id) VALUES ('', '$tarea', '$idusuario')";
    $inser = 'INSERT INTO tareas (destarea, usuario_id) VALUES (?, ?)';
    $resultado = $conexion->prepare($inser);
    $resultado->bind_param('ss', $tarea, $idusuario);
    // ANTIGUO $resultado = $conexion->query($consulta);
    if(!$resultado->execute()){
      return false;
    }
    return true;
  }

  # A esta función le paso el número de página en la que me encuentro
  function recogerTareas($pagina){
    $idusuario = $_SESSION['usuario_id'];
    $conexion = conectar();

    # CALCULAMOS EL REGISTRO INICIAL
    # Esto calcula la página inicial, se le resta 1 porque el array $resultado empieza en el valor 0
    $inicio = ($pagina - 1) * REGISTROS;

    # RECOGER TAREAS PAGINADAS
    // ANTIGUA $consulta = "SELECT idtarea, destarea, estado FROM tareas WHERE usuario_id='$idusuario' ORDER BY estado LIMIT ". $inicio . "," . REGISTROS;
    $consulta = 'SELECT idtarea, destarea, estado FROM tareas WHERE usuario_id=? ORDER BY estado LIMIT '. $inicio . ',' . REGISTROS;
    # limit funciona de la siguiente manera. si solo le paso un valor numérico, me coge ese número de REGISTROS
    # si le paso 2 valores numéricos, el primero será, del array $registros, desde el valor en el que tiene que partir y el segundo número cuantos registros a partir de ese valor
    // ANTIGUO $resultado = $conexion->query($consulta);
    $resultado = $conexion->prepare($consulta);
    $resultado->bind_param('s', $idusuario);
    $resultado->execute();
    $resultado = $resultado->get_result();

    if(!$resultado){
      return false;
    }
    return $resultado;
  }

  function paginacion($pagina){
    $idusuario = $_SESSION['usuario_id'];
    $paginacion = array();
    $conexion = conectar();
    // ANTIGUO $consulta = "SELECT idtarea, destarea, estado FROM tareas WHERE usuario_id='$idusuario' ORDER BY estado";
    $consulta = 'SELECT idtarea, destarea, estado FROM tareas WHERE usuario_id=? ORDER BY estado';
    $resultado = $conexion->prepare($consulta);
    $resultado->bind_param('s', $idusuario);
    $resultado->execute();
    $resultado = $resultado->get_result();
    // ANTIGUO $resultado = $conexion->query($consulta);

    # Calcular el número de registros en total
    if($resultado->num_rows < REGISTROS){
      # si el numero de filas de la consulta es menor que el de registros a mostrar, solo habrá una página
      $paginas = 1;
    }else{
      # Calculo del número de páginas a mostrar: cogemos el número de resultados de la consulta y le aplicamos la operación modulo % respecto al número de registros a mostrar. el módulo básicamente coge el resto de la división
      if($resultado->num_rows % REGISTROS == 0){
        # si el resto es 0
        $paginas = $resultado->num_rows / REGISTROS;
      }else{
        # si el resto es 1 (el resto de la división no es 0) round('el valor que quiero redondear', 'a cuantos decimales quiero redondearlo', 'tipo de redondeo') sirve para redondear
        # $paginas = round($resultado->num_rows / REGISTROS, 0, PHP_ROUND_HALF_DOWN) + 1;
        # en nuestro caso usamos un redondeo hacia abajo y le sumamos 1
        # ceil redondea siempre hacia arriba
        $paginas = ceil($resultado->num_rows / REGISTROS);
      }
    }
    # calcular cual es la página anterior y cual es la página siguiente
    # PAGINA ANTERIOR
    if($pagina == 1){
      $anterior = $pagina;
    }else{
      $anterior = $pagina - 1;
    }
    # PAGINA SIGUIENTE
    if($pagina == $paginas){
      $siguiente = $pagina;
    }else{
      $siguiente = $pagina + 1;
    }
    array_push($paginacion, $paginas); # metemos en el array el número de páginas
    array_push($paginacion, $anterior); # metemos en el array la página anterior
    array_push($paginacion, $siguiente); # metemos en el array la página siguiente
    array_push($paginacion, $pagina); # le pasamos el número de página actual

    return $paginacion;
  }

  function recogerMail(){
    $idusuario = $_SESSION['usuario_id'];
    $conexion = conectar();
    // ANTIGUO $consulta = "SELECT mailusu FROM usuarios WHERE idusu='$idusuario'";
    $consulta = 'SELECT mailusu FROM usuarios WHERE idusu=?';
    $resultado = $conexion->prepare($consulta);
    $resultado->bind_param('s', $idusuario);
    $resultado->execute();
    $resultado = $resultado->get_result();
    // ANTIGUO $resultado = $conexion->query($consulta);
    if(!$resultado){
      return false;
    }
    $fila = $resultado->fetch_assoc();
    $mailusu = $fila['mailusu'];
    return $mailusu;
  }
?>
