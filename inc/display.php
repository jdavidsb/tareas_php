<?php
  function getHeader($titulo){
    # recoger la cabecera de la pagination
    ?>
    <!DOCTYPE html>
    <html lang="es">
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gestor de tareas - <?php echo $titulo; ?></title>

        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="https://bootswatch.com/4/cosmo/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/main.min.css">

        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <!-- <link rel="stylesheet" href="https://bootswatch.com/4/simplex/bootstrap.min.css"> -->
        <!-- <link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css"> -->
        <!-- <link rel="stylesheet" href="https://bootswatch.com/4/superhero/bootstrap.min.css"> -->
        <!-- si generase un CSS personalizado, lo metería aquí -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
      </head>
      <body>
        <?php getNavBar(); ?>
        <div class="container">
    <?php
  }

  function getFooter(){
    # recoge el pie de la página
    ?>
        </div>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/ext-core/3.1.0/ext-core.js"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="js/main.min.js"></script>

        </script>
      </body>
    </html>
    <?php
  }

  function getRestablecerPass($email, $tokenmail){
    ?>
    <div class="row formulario">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <h3>Escribe tu nueva contraseña</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="jumbotron col-sm-6">
        <form action="restablecer.php" method="post">
          <input type="hidden" name="email" value="<?php echo $email; ?>">
          <input type="hidden" name="tokenmail" value="<?php echo $tokenmail; ?>">

          <div class="form-group row">
            <label for="pass" class="col-sm-4 col-form-label" data-toggle="popover">Nueva Contraseña</label>
            <div class="col-sm-8">
              <input type="password" name="pass" class="form-control" placeholder="Password">
            </div>
          </div>

          <div class="form-group row">
            <label for="pass" class="col-sm-4 col-form-label">Confirmar Contraseña</label>
            <div class="col-sm-8">
              <input type="password" name="pass2" class="form-control" placeholder="Password">
            </div>
          </div>

          <div class="form-group row">
            <label for="blanco" class="col-sm-4 col-form-label"></label>
            <div class="col-sm-6">
              <input type="submit" value="Restablecer" class="btn btn-primary">
            </div>
          </div>

        </form>
      </div>
    </div>

    <?php
  }

  function getFormLogin(){
    $_token = base64_encode(md5(uniqid()));
    $_SESSION['_token'] = $_token;
    ?>
    <div class="row formulario">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <h3>Iniciar sesión</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="jumbotron col-sm-6">
        <form action="login.php" method="post">
          <input type="hidden" name="_token" value="<?php echo $_token; ?>">
          <!-- <button type="button" class="btn btn-lg btn-danger" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button> -->
          <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
              <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="pass" class="col-sm-3 col-form-label">Contraseña</label>
            <div class="col-sm-9">
              <input type="password" name="pass" class="form-control" placeholder="Password">
            </div>
          </div>

          <div class="form-group row">
            <label for="blanco" class="col-sm-3 col-form-label"></label>
            <div class="col-sm-5">
              <input type="submit" value="Iniciar Sessión" class="btn btn-primary">
            </div>
            <!--
            <div class="col-sm-4">
              <a href="form_registro.php" class="btn btn-default">Crear cuenta</a>
            </div>
            -->
          </div>
        </form>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-3 form-text">
        <small><a href="recordar_pass.php">¿Olvidaste tu password?</a></small>
      </div>
      <div class="col-sm-3 text-right form-text">
        <small><a href="form_registro.php">¿No tienes cuenta? Crea una de forma gratuita</a></small>
      </div>
    </div>
    <?php
  }

  function getPassRecovery(){
    $_token = base64_encode(md5(uniqid()));
    $_SESSION['token'] = $_token;
    ?>
    <div class="row formulario">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <h3>Recuperar Contraseña</h3>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-3"></div>
      <div class="jumbotron col-sm-6">
        <form action="recuperar_pass.php" method="post">
          <input type="hidden" name="_token" value="<?php echo $_token; ?>">
          <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
              <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
          </div>
          <div class="form-group row">
            <label for="blanco" class="col-sm-3 col-form-label"></label>
            <div class="col-sm-5">
              <input type="submit" value="Recuperar contraseña" class="btn btn-primary">
            </div>
          </div>
        </form>
      </div>
    </div>
    <?php
  }

  function getFormRegistro(){
    $_token = base64_encode(md5(uniqid()));
    $_SESSION['_token'] = $_token;
    ?>
    <div class="row formulario">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <h3>Crear Cuenta</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="jumbotron col-sm-6">
        <form action="registro.php" method="post">
          <input type="hidden" name="_token" value="<?php echo $_token; ?>">

          <div class="form-group row">
            <label for="email" class="col-sm-4 col-form-label">Email</label>
            <div class="col-sm-8">
              <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
          </div>

          <div class="form-group row">
            <label for="pass" class="col-sm-4 col-form-label" data-toggle="popover" data-content="La contraseña debe tener como mínimo 8 caracteres">Contraseña</label>
            <div class="col-sm-8">
              <input type="password" name="pass" class="form-control" id="pass" data-placement="bottom" placeholder="Password">
            </div>
          </div>

          <div class="form-group row">
            <label for="pass" class="col-sm-4 col-form-label">Confirmar Contraseña</label>
            <div class="col-sm-8">
              <input type="password" name="pass2" class="form-control" placeholder="Password">
            </div>
          </div>

          <div class="form-group row">
            <label for="blanco" class="col-sm-4 col-form-label"></label>
            <div class="col-sm-5">
              <input type="submit" value="Crear Cuenta" class="btn btn-primary">
            </div>
          </div>

        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6 text-right form-text">
        <small><a href="index.php">¿Ya tienes cuenta? Identificate</a></small>
      </div>
    </div>
    <?php
  }

  function getAlertas(){
    if(isset($_SESSION['msg'])){
    ?>
      <div class="alert alert-danger alert_dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $_SESSION['msg'] ?>
      </div>
    <?php
    # Despues de mostrar el mensaje de error, borramos la variable
    unset($_SESSION['msg']);
    }
  }

  function getNavBar(){
    ?>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu">
            <!-- <span class="sr-only">Toggle navigation</span> -->
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Tareas</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
          <ul class="nav navbar-nav">
            <li><a href="index.php"><i class="fa fa-home"></i>Inicio</a></li> <!--  -->
            <li><a href="tareas.php"><i class="fa fa-tasks"></i>Tareas</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php if(validarUsuario()){ ?>
              <li><a href="logout.php"><i class="fa fa-sign-out"></i>Cerrar sesión</a></li>
            <?php }else{ ?>
              <li><a href="index.php"><i class="fa fa-sign-in"></i>Iniciar sesión</a></li>
              <li><a href="form_registro.php"><i class="fa fa-user"></i>Crear cuenta</a></li>
            <?php } ?>
          </ul>
        </div>
      <div>
    </nav>
    <?php
  }

  function getFormNuevaTarea(){
    ?>
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">

        <form action="nueva_tarea.php" method="post">
          <div class="input-group">
            <input type="text" name="nuevatarea" class="form-control">
            <input type="submit" class="btn btn-primary" value="Guardar">
          </div>
        </form>

      </div>
    </div>

    <?php
  }

  function mostrarTareas($tareas, $paginacion){
    $mail = recogerMail();
    ?>
    <h2>Mis tareas: <?php echo $mail; ?></h2>
    <div class="panel panel-default">
      <table class="table">
        <thead>
          <tr>
            <th>Tarea</th>
            <th>Estado</th>
            <th class="text-right">Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while($tarea = $tareas->fetch_assoc()){
            if($tarea['estado'] == 'pendiente'){
              echo '<tr>';
            }else{
              echo '<tr class="success">';
            }

              echo '<td width="80%">' . $tarea['destarea'] . '</td>';
              echo '<td>' . $tarea['estado'] . '</td>';
              echo '<td class="text-right">';
                if($tarea['estado'] == 'pendiente'){
                  echo '<a href="completar.php?ta='. $tarea['idtarea'] .'" class="btn btn-success btn-xs"><i class="fa fa-check"></i></a>  ';
                }
                /* echo '<a href="eliminar.php?ta='. $tarea['idtarea'] .'" class="btn btn-danger btn-xs" onclick="confirm(\'¿Seguro que desea elminar la tarea?\')"><i class="fa fa-trash"></i></a>'; */
                echo '<a href="eliminar.php?ta='. $tarea['idtarea'] .'" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>';
              echo '</td>';
            echo '</tr>';
          }
          ?>
        </tbody>
      </table>
    </div>

    <div class="text-center">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item"><a class="page-link" href="tareas.php?p=<?php echo $paginacion[1]; #le paso la pagina anterior ?>">&laquo;</a></li>
          <?php
          for($i = 1; $i <= $paginacion[0]; $i++){
            if($paginacion[3] == $i){
              ?>
              <li class="page-item active"><a class="page-link" href="tareas.php?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
              <?php
            }else{
              ?>
              <li class="page-item"><a class="page-link" href="tareas.php?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
              <?php
            }
          }
          ?>
          <li class="page-item"><a class="page-link" href="tareas.php?p=<?php echo $paginacion[2]; # le paso la pagina siguiente ?>">&raquo;</a></li>
        </ul>
      </nav>
    </div>

    <?php
  }

  function prueba(){
    ?>
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container"> <!-- OPEN CONTAINER FLUID -->
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Tareas</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-menu">
          <ul class="nav navbar-nav">
            <li><a href="#">Link1</a></li>
            <li><a href="#">Link2</a></li>
            <li><a href="#">Link3</a></li>



        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </div>

    <?php
  }

?>
