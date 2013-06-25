<?php
ob_start("ob_gzhandler");
session_start();
$carro=$_SESSION['carro'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">

<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="description" content="carrito de compras" />
  <meta name="keywords" content="" />
  <link rel="stylesheet" type="text/css" href="css/estilo.css" />
  <title>Carrito de compras</title>
  <script language="JavaScript">
	<!-- agrande imagenes en detalles del producto
	function imagenzoom(displayname,imagen,altura,ancho) {
		pagi="/carrito/imagenes/productos/" + imagen;
		opciones = "toolbar=no,menubar=no,location=no,scrollbars=no,resizable=yes,width=" + ancho +",height=" + altura;
		OpenWin = this.open(pagi, "ProductWindow",opciones );
	}
	// fin-->
	</script>
</head>

<body>
  <div id="wrap">

    <!-- CABECERA -->
	  <!-- FONDO -->
    <div id="header-seccion"><img src="imagenes/banner.jpg" width="760" height="130" alt="Banner" /></div>

	  <!-- Navegacion -->
    <div id="header">
      <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="index.php?ac=registro">Registrarse</a></li>
        <li><a href="#">Nuestra Empresa</a></li>
		</ul>
    </div>

	  <!-- COLUMNA IZQUIERDA -->
	  <!-- Navegacion -->

    <div id="izq-column">
		<ul>
			<li class="izq-navheader-primero">Catalogo</li>
			<li>
<?php
include ("funciones/funciones.php");
$_pagi_sql='SELECT * FROM `categoriaproductos` order by CategoriaNombre';
$con=conectarse();
include("include/paginator.inc.php");
if ($fila=mysql_fetch_array($_pagi_result))
	{

					 		do
							 {
							 echo "<a href='index.php?ac=catalogo&cid=".$fila[0]."'>".$fila[1]."</a>";
							 }
                             while( $fila=mysql_fetch_array($_pagi_result) );
	}
	mysql_close($con);
?>
			</li>		
		</ul>
		<br>
		<ul>
			
				<li class="izq-navheader-primero">Busqueda</li>
				<li>
			  	<form name="busqueda" method="post" action="index.php?ac=busca">
				               <input name="palabra" type="text" id="palabra">
		        		       <input type="submit" name="Submit" value="buscar">
		        </form>
		        </li>
		</ul>
		<br>
		<ul>
		<li><a href="admin/login.php">Administracion</a></li>
		</ul>
    </div>
<?php
switch ($_GET['ac']) {
    case 'catalogo':
        include('contenidos/catalogo.php');
        break;
    case 'registro':
        include('contenidos/registro.php');
        break;
    case 'carro':
        include('contenidos/carro.php');
        break;
    case 'detalles':
        include('contenidos/detalles.php');
        break;
	case 'finalizar':
        include('contenidos/finalizar.php');
        break;
	case 'busca':
        include('contenidos/buscar.php');
        break;
	case 'cuenta':
        include('contenidos/cuenta.php');
        break;	
	case 'estado':
        include('contenidos/estado.php');
        break;
	case 'logout':
        session_destroy();
        break;							
	default:
         include('contenidos/defecto.php');
		 break;
}
include ("contenidos/abajo.php");
?>
