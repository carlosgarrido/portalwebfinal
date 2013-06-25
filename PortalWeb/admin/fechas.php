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
	     <div class="medio-column-caja-titulo-azul">Ingrese fechas para obtener informe</div>
<form name="form1" method="POST" action="">
<table class="estilotabla2">
	<tr>
		<td class="estilocelda4">Fecha inicio:</td>
		<td class="estilocelda4"><input id="fecha1" size="12" type="text" name="fecha1"><input type="button" id="lanzador" value="...">Calendario</td>
		
	</tr>
	<tr>
		<td class="estilocelda4">Fecha termino:</td>
		<td class="estilocelda4"><input type="text" id="fecha2" size="12" name="fecha2"><input type="button" id="lanzador2" value="..."></td>
	</tr>
	<tr>
     <td colspan="2" class="estilocelda"><input type="submit" value="Ver informe"></td>
	</tr>
	</table>
</form>
<?php
if (isset($_POST["fecha1"]) and isset($_POST["fecha2"]))
{
	$fecha1=fecha_usa($_POST["fecha1"]);	
	$fecha2=fecha_usa($_POST["fecha2"]);
	if (($fecha1 > $fecha2) or ($fecha1=="") or ($fecha2=="")){
		echo "<SCRIPT LANGUAGE=\"JavaScript\">\n";
		echo "alert('ingrese una fecha anterior');";
		echo "location.href='fechas.php';";
		echo "</SCRIPT>";
	}
	else
		{
			$sql= "select orden.OrdenID,orden.UsuarioID,orden.OrdenFecha, usuarios.nombre, usuarios.correo,usuarios.apellidoP, orden.OrdenEstado  from orden,usuarios where usuarios.UsuarioID=orden.UsuarioID and orden.OrdenFecha BETWEEN '".$fecha1."' AND '".$fecha2."'";
			$con=conectarse();
			$informe=mysql_query($sql,$con);	
			if ($fila=mysql_fetch_array($informe))
			{
?>
				<table class="estilotabla" cellspacing='0'>
						<tr>
							<td class="estilocelda2">Codigo de Orden</td>
							<td class="estilocelda2">Cliente</td>
							<td class="estilocelda2">Fecha</td>
							<td class="estilocelda2">Estado de la orden</td>
						</tr>
						
<?php	
				$a=0;
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
					if ($fila[OrdenEstado]==0)
						$esta="No ha sido despachada";
					else
						$esta="despachada";
						
						echo "<tr>";	
							echo "<td class='".$estilo."'><a href='detallespedido.php?id=".$fila[OrdenID]."'>".$fila[OrdenID]."</a></td>";
							echo "<td class='".$estilo."'>".$fila[nombre]."_".$fila[apellidoP]."</td>\n";
							echo "<td class='".$estilo."'>".fecha_esp($fila[OrdenFecha])."</td>\n";
							echo "<td class='".$estilo."'>".$esta."</td>\n";
						echo "</tr>";				
				}		
				while($fila=mysql_fetch_array($informe));
			echo "</table>";
			}
		}	
	
}
?>




<script type="text/javascript">
   Calendar.setup({
    inputField     :    "fecha1",     // id del campo de texto
     ifFormat     :     "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador"     // el id del botón que lanzará el calendario
});

</script>
<script type="text/javascript">
   Calendar.setup({
    inputField     :    "fecha2",     // id del campo de texto
     ifFormat     :     "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador2"     // el id del botón que lanzará el calendario
}); 
</script>
</div>
</div>

<?php
include ("abajo.php");
?>

