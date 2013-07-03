<?php
session_start();
$MM_authorizedUsers = "0";
$MM_donotCheckaccess = "false";


function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) {
  $isValid = False;
  if (!empty($UserName)) {
    $arrUsers = Explode(",", $strUsers);
    $arrGroups = Explode(",", $strGroups);
    if (in_array($UserName, $arrUsers)) {
      $isValid = true;
    }
    if (in_array($UserGroup, $arrGroups)) {
      $isValid = true;
    }
    if (($strUsers == "") && false) {
      $isValid = true;
    }
  }
  return $isValid;
}

$MM_restrictGoTo = "index.php?ac=cuenta";
if (!((isset($_SESSION['MM_NombreUsuario'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_NombreUsuario'], $_SESSION['MM_Grupo'])))) {
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0)
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo);
  exit;
}
?>

<?php
if (isset($_SESSION['MM_NombreUsuario']))
{

	$correo=$_SESSION['MM_NombreUsuario'];
	if (existe(usuarios,Correo,$correo))
	{
		$con=conectarse();
		$sql="select UsuarioID from usuarios where Correo='$correo'";
		$consulta=mysql_query($sql,$con);
		$fila=mysql_fetch_array($consulta);
		$usuarioID=$fila['UsuarioID'];
		$fecha=obtenerFecha();
		$fecha=fecha_usa($fecha);
		$sql = "INSERT INTO `orden` (`UsuarioID`, `OrdenEstado`,`OrdenFecha`) VALUES ('$usuarioID','0','$fecha')";
		$consulta=mysql_query($sql,$con);			
		$sql="SELECT max(OrdenID) from `orden` WHERE `UsuarioID`=$usuarioID";
		$consulta=mysql_query($sql,$con);
		$fila=mysql_fetch_array($consulta);
		$ordenID=$fila[0];
		foreach($carro as $k => $v)
			{
				$cantidad=$v['cantidad'];
				$productoID=$v['id'];
				$sql="insert INTO `ordenesdetalles` (`OrdenID`, `ProductoID`, `Cantidad`) VALUES ('$ordenID', '$productoID', '$cantidad')";		   
				$consulta=mysql_query($sql,$con);
			}
		$carro=$_SESSION['carro'];
		unset ($carro);
		$_SESSION['carro']=$carro;
		echo "<SCRIPT LANGUAGE=\"JavaScript\">\n";
		echo " location.href='index.php?ac=estado';\n";
		echo "alert ('Su pedido ha sido procesado,Gracias Por su compra');\n";
		echo "</SCRIPT>";		
		
	}
}
?>