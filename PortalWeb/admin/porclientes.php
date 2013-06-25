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
// *********************************
// *** informe de compras realizadas por clientes
// *** Brian Garcia
// *********************************
include ("index.php");
?>


<div id="medio-column">
    <div class="medio-column-caja-blanco">
	     <div class="medio-column-caja-titulo-gris">Informe de Compras</div>
		 <form name="form1" method="POST" action="">
			<table class="estilotabla2">
					<tr>
						<td class="estilocelda4">Buscar:</td>
						<td class="estilocelda4"><input type='text' name='busca'></td>
						<td class="estilocelda4"><select name="campo">
							<option value='Correo'>Correo</option>
							<option value='Nombre'>Nombre</option>
							<option value='ApellidoP'>Apellido Paterno</option>
							</select>
						</td>
						<td class="estilocelda4"><input type='submit' name='buscar' value="Buscar"></td></td>
					</tr>
			</table>
		</form>
<?php
if (isset($_POST["campo"]))
{
		$campo=$_POST["campo"];
		$busca=$_POST["busca"];
		$sql="SELECT orden.OrdenID,orden.UsuarioID,orden.OrdenEstado,orden.OrdenFecha, usuarios.Correo,usuarios.Nombre,usuarios.ApellidoP FROM usuarios,orden where orden.UsuarioID=usuarios.UsuarioID and usuarios.$campo like '%".$busca."%'";
		$con=conectarse();
			$informe=mysql_query($sql,$con);	
			if ($fila=mysql_fetch_array($informe))
			{
?>
				<table class="estilotabla" cellspacing='0'>
						<tr >
							<td class="estilocelda5" colspan="4"><?php echo "Busqueda para '<B>". $busca."</B>' en, '<b>".$campo."</b>', se encontaron " .mysql_num_rows($informe)." concidencias";?><td>
						</tr>
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
							echo "<td class='".$estilo."'>".$fila[Nombre]."_".$fila[ApellidoP]."</td>\n";
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
							<td class="estilocelda5" colspan="4"><?php echo "Busqueda para '<B>". $busca."</B>' en, '<b>".$campo."</b>', no arrojo resultados";?><td>
						</tr>
				<?php
				echo "</table>";
			}
}	
?>
</div>
    
</div>

<?php
include ("abajo.php");
?>

