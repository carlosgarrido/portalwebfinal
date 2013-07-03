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

<div id="medio-column">
    <div class="medio-column-caja-blanco">
	     <div class="medio-column-caja-titulo-gris">Estado de sus Compras</div>
		 
<?php
		$correo=$_SESSION['MM_NombreUsuario'];
		$sql="SELECT orden.OrdenID,orden.UsuarioID,orden.OrdenEstado,orden.OrdenFecha, usuarios.Correo,usuarios.Nombre,usuarios.ApellidoP FROM usuarios,orden where orden.UsuarioID=usuarios.UsuarioID and usuarios.Correo='".$correo."'";
		$con=conectarse();
			$informe=mysql_query($sql,$con);	
			if ($fila=mysql_fetch_array($informe))
			{
	
				echo "Cantidad de Pedidos:" .mysql_num_rows($informe);
?>
				<table class="estilotabla" cellspacing='0'>
						<tr>
							<td class="estilocelda2">Codigo de Orden</td>
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
							echo "<td class='".$estilo."'>".$fila[OrdenID]."</td>";
							echo "<td class='".$estilo."'>".fecha_esp($fila[OrdenFecha])."</td>\n";
							echo "<td class='".$estilo."'>".$esta."</td>\n";
						echo "</tr>";				
				}		
				while($fila=mysql_fetch_array($informe));
			echo "</table>";
			}
			else
			{
				?>
						<tr >
							<td class="estilocelda5" colspan="4"><?php echo "No tiene compras a su nombre";?><td>
						</tr>
				<?php
				echo "</table>";

				}
?>
			<br>
			<br>
			<table class="estilotabla" cellspacing='0'>
						<tr>
							<td class="estilocelda">Usuario:</td><td class="estilocelda"><b><?php echo $correo; ?></b></td>
							<td class="estilocelda"><a href="index.php?ac=logout">Terminar Sesion</a></td>
						</tr>
			</table>
</div>
</div>

    
