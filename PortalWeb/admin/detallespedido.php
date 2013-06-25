<?php
session_start();
$MM_authorizedUsers = "1";
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

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {
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
include ("index.php");
?>

<div id="medio-column">
    <div class="medio-column-caja-blanco">
	     <div class="medio-column-caja-titulo-gris">Detalles pedido n°<?php echo $id=$_GET['id']?></div>
			<form name="form1" method="post" action="">
			<table class="estilotabla" cellspacing='0'>
				<tr>
					<td class="estilocelda2">Eleminar</td>
					<td class="estilocelda2">Producto</td>
					<td class="estilocelda2">Cantidad</td>
					<td class="estilocelda2">Precio</td>
					<td class="estilocelda2">Total</td>
				</tr>
			   	<tr>
<?php
$con=conectarse();
$id=$_GET['id'];
$sql="SELECT ID,Cantidad,ProductoNombre,Precio FROM `ordenesdetalles` , `productos` where OrdenID=$id and ordenesdetalles.ProductoID=productos.ProductoID";
$consulta=mysql_query($sql,$con);
echo "<form name=\"form1\" method=\"post\" action=\"\">  ";
$a=0;
if ($fila=mysql_fetch_array($consulta))
{
	do
	    {
		if ($a==0)
		{
			$estilo="estilocelda5";
			$a=1;
		}
		else
		{
			$estilo="estilocelda";
			$a=0;
		}
		
			echo "<td class='".$estilo."'><input type=checkbox name='d[".$fila[ID]."]'></td>\n";
			echo "<td class='".$estilo."'>".$fila[ProductoNombre]."</a></td>";
			echo "<td class='".$estilo."'>".$fila[Cantidad]."</td>\n";
			echo "<td class='".$estilo."'>$".$fila[Precio]."</td>\n";
			echo "<td class='".$estilo."'>$".$subto=$fila[Precio]*$fila[Cantidad]."</td>\n";
			echo "</tr>";
			$suma=$suma+$subto;
	    }
	while( $fila=mysql_fetch_array($consulta) );
}
echo "<tr>
	<td colspan='2' class='estilocelda2'>Total</td>
	<td colspan='3' class='estilocelda2'>$".$suma."</td>
</tr>
</table>";
echo "<p><center><input id=submit type=submit value=Borrar name=submit></p></center>";
echo  "</form>";
mysql_close($con);
if (!empty($_POST['d'])) {
    $con=conectarse();
    $aLista=array_keys($_POST['d']);
    $sql="DELETE FROM ordenesdetalles where ID IN (".implode(',',$aLista).")";
    mysql_query($sql,$con);
    mysql_close($con);
    echo "<SCRIPT LANGUAGE=\"JavaScript\">\n";
	echo "location.href='detallespedido.php?id=$id';";
	echo "</SCRIPT>";
}
?>
</div>
</div>

<?php
include ("abajo.php");
?>