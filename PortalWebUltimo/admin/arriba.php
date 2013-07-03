<?php
//initialize the session
session_start();

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  session_unregister('MM_Username');
  session_unregister('MM_UserGroup');
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <title>Administracion contenido Web</title>
  <link rel="stylesheet" type="text/css" href="../css/estilo.css"/>
  <link rel="stylesheet" type="text/css" media="all" href="../funciones/jscalendar/calendar-blue.css" title="win2k-cold-1" />

  <!-- librería principal del calendario -->
 <script type="text/javascript" src="../funciones/jscalendar/calendar.js"></script>

 <!-- librería para cargar el lenguaje deseado -->
  <script type="text/javascript" src="../funciones/jscalendar/lang/calendar-es.js"></script>

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código -->
  <script type="text/javascript" src="../funciones/jscalendar/calendar-setup.js"></script>
	
<style type="text/css">
<!--
body {
	background-color: #009900;
}
-->
</style></head>
<body>
<center>
<div id="wrap">
    <!-- CABECERA -->
	<!-- FONDO -->
    <div id="header-seccion">
    <img src="../imagenes/banner.jpg" width="760" height="130" alt="Banner"> </div>
    	  <!-- Navegacion -->
    <div id="header">
      <ul>
        <li><a href="../index.php">VOLVER A SERVICIOS </a></li>
      </ul>
    </div>
