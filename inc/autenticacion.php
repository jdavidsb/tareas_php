<?php
require_once 'database.php';

function registrarUsuario($email, $pass){
  # cifrar contraseña
  $passcifrada = password_hash($pass, PASSWORD_DEFAULT);
  $conexion = conectar();

  # Comprobar si el email ya existe para no duplicarlo
  // ANTIGUO $consulta = "SELECT * FROM usuarios WHERE mailusu='$email'";
  $consulta = 'SELECT * FROM usuarios WHERE mailusu=?';
  $resultado = $conexion->prepare($consulta);
  $resultado->bind_param('s', $email);
  $resultado->execute();
  $resultado = $resultado->get_result();
  // ANTIGUO $resultado = $conexion->query($consulta);
  if($resultado->num_rows > 0){
    $_SESSION['msg'] = 'El email proporcionado ya existe';
    header('Location: form_registro.php');
    exit();
  }

  // ANTIGUO $inser = "INSERT INTO usuarios VALUES ('', '$email', '$passcifrada', '')";
  // ANTIGUO $resultado = $conexion->query($inser);
  $inser = 'INSERT INTO usuarios (mailusu, passusu) VALUES (?, ?)';
  $resultado = $conexion->prepare($inser);
  $resultado->bind_param('ss', $email, $passcifrada);

  // ANTIGUO $resultado->execute();
  //$resultado = $resultado->get_result();
  if(!$resultado->execute()){
    return false;
  }
  return true;
}

function loginUsuario($email, $pass){
  $conexion = conectar();

  # $email = $conexion->escape_string($email);
  # $pass = $conexion->escape_string($pass);
  /*
  $query = "SELECT users.email,users.handle,userprofile.mobile FROM users,userprofile WHERE users.email =? OR users.handle =? OR userprofile.mobile=?";
  $stmt = $mysqli->prepare($query);
  $stmt->bind_param("sss",$email,$username,$mobile);
  if ($stmt->execute()) {
  if($stmt->num_rows){
     echo '......';
      }
  }
  */
  $consulta = 'SELECT * FROM usuarios WHERE mailusu =?';
  // $resultado = $conexion->query($consulta);
  $resultado = $conexion->prepare($consulta);
  $resultado->bind_param('s', $email);
  $resultado->execute();
  $resultado = $resultado->get_result(); # IMPORTANTE, con get_result() se recogen los resultados de la sentencia
  if($resultado->num_rows > 0){
    $usuario = $resultado->fetch_assoc();
    if(password_verify($pass, $usuario['passusu'])){
      session_regenerate_id();
      $_SESSION['usuario_id'] = $usuario['idusu'];
      $_SESSION['user_agent'] = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_STRING);
      # No es habitual que vaya cambiando la dirección de IP a lo largo de la session
      #$_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
      # $_SESSION['user_ip'] = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP);
      # Opción segura

      if(filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP)){
        $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
      }


      return true;
    }else{
      return false;
    }
  }else{
    $_SESSION['msg'] = 'Usuario no encontrado';
    header('Location: index.php');
    exit();
  }
}

function validarUsuario(){
  if(isset($_SESSION['identificado']) && $_SERVER['HTTP_USER_AGENT'] == $_SESSION['user_agent'] && $_SERVER['REMOTE_ADDR'] == $_SESSION['user_ip']){
    session_regenerate_id();
    return true;
  }
  return false;
}

?>
