<?php
require 'bootstrap.php';
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(validarUsuario()){
  header('Location: tareas.php');
  exit();
}
$_token = filter_input(INPUT_POST, '_token', FILTER_SANITIZE_STRING);
  if($_token === $_SESSION['token']){
    if(empty($_POST['email'])){
      $_SESSION['msg'] = 'Introduce tu dirección de email';
      header('Location: recordar_pass.php');
      exit();
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    # CONEXIÓN A LA BASE DE DATOS PARA VALIDAR QUE EXISTE
    $conexion = conectar();
    /*
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

    */
    // ANTIGUO $consulta = "SELECT * FROM usuarios WHERE mailusu='$email'";
    $consulta = 'SELECT * FROM usuarios WHERE mailusu=?';
    $resultado = $conexion->prepare($consulta);
    $resultado->bind_param('s', $email);
    $resultado->execute();
    $resultado = $resultado->get_result();
    // ANTIGUO $resultado = $conexion->query($consulta);
    if($resultado->num_rows == 0){
      $_SESSION['msg'] = 'Usuario no encontrado';
      header('Location: recordar_pass.php');
      exit();
    }

    $tokenmail = base64_encode(md5(uniqid()));
    //$_SESSION['tokenmail'] = $tokenmail;
    // ANTIGUO $actua = "UPDATE usuarios SET token='$tokenmail' WHERE mailusu='$email'";
    $actua = 'UPDATE usuarios SET token=? WHERE mailusu=?';
    $resultado = $conexion->prepare($actua);
    $resultado->bind_param('ss', $tokenmail, $email);
    $resultado->execute();
    // ANTIGUO $resultado = $conexion->query($actua);
    # enviar token al usuarios
    # A parte del token podríamos parasarle el email del usuario ?t=token&e=mail
    $enlace = '<a href="http://localhost/tareas/form_restablecer.php?t='.$tokenmail.'&e='.$email.'">aqui</a>';
    $mensaje = 'Para restaurar contraseña pulse en el siguiente enlace: '. $enlace;
    $mail = new PHPMailer(true);
    $mail->setLanguage('es');
      try{
        $mail->isSMTP();
        $mail->Host = '127.0.0.1';
        $mail->Port = 25;
        $mail->setFrom($email);
        $mail->addAddress('jdavidsb@gmail.com', 'David');
        $mail->isHTML(true);
        $mail->Subject = 'Asunto - RECUPERAR CONTRASEÑA';
        $mail->Body    = $mensaje;
        $mail->AltBody = $mensaje;
        $mail->send();
        //echo 'Mensaje ENVIADO'.$mensaje;

        $_SESSION['msg'] = 'Revise su correo para restablecer su contraseña';
        header('Location: recordar_pass.php');
        exit();

      }
      catch(Exception $e){
        //echo 'Error al enviar el mensaje: ', $mail->ErrorInfo;
        $_SESSION['msg'] = 'Error al enviar el correo electrónico: '. $mail->ErrorInfo . '. Vuelva a intentarlo más tarde.';
        header('Location: recordar_pass.php');
        exit();
      }
  }
?>
