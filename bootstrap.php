<?php
# este archivo se incluye siempre y de esta manera es la base de cualquier página ARCHIVO BASE (todas nuestra páginas van a cargarlo)
session_start();
# definir una constante que nos servirá para el sistema de paginacion
define('REGISTROS', 10);
require 'inc/display.php'; # muestra elementos en la página
require 'inc/database.php'; # funciones de la base de datos
require 'inc/autenticacion.php'; # autenticación de usuarios
?>
