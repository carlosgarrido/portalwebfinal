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
if ($_GET["ac"])
{
	$id=$_GET["id"];
	if ($_GET["ac"]=="actualiza")
	{
		

		$nombre=$_POST["nombre"];
		$apellidoP=$_POST["apellidoP"];
		$apellidoM=$_POST["apellidoM"];
		$correo=$_POST["correo"];
		$password=$_POST["password"];
		$password2=$_POST["password2"];
		$empresa=$_POST["empresa"];
		$direccion=$_POST["Direccion"];
		$fono=$_POST["fono"];
		if ($password==$password2)
		{
				 $sql = "UPDATE `usuarios` SET `Nombre` = '$nombre', `ApellidoP` = '$apellidoP', `AplellidoM` = '$apellidoM', `Correo` = '$correo', `Password` = '$password', `Empresa` = '$empresa', `Direccion` = '$direccion', `Fono` = '$fono' WHERE `UsuarioID` = '$id' LIMIT 1";
				 echo $sql;
		         $con=conectarse();
		         $insercion=mysql_query($sql,$con);
		         mysql_close($con);
				 echo "<SCRIPT LANGUAGE=\"JavaScript\">\n";
				echo " location.href='frmusuarios.php?ac=ver&id=".$id."';";
				echo "alert ('Registro actualizado');\n";
				echo "</SCRIPT>";
		}
		else
		{
		    echo "<SCRIPT LANGUAGE=\"JavaScript\">\n";
		    echo " location.href='frmusuarios.php?ac=ver&id=".$id."';";
		    echo "alert ('passwords no coinciden');\n";
		    echo "</SCRIPT>";
		}
	}
	if ($_GET["ac"]=="ver")
	{
		$con=conectarse();
		$_pagi_sql="SELECT * FROM usuarios where UsuarioID='$id'";
		$_pagi_cuantos=10;
		include("../include/paginator.inc.php");
		if ($fila=mysql_fetch_array($_pagi_result))
		{
			do
				{
	?>
	<div id="medio-column">
	<div class="medio-column-caja-titulo-azul">Modificacion Clientes Registrados</div>
			<table  class="estilotabla3">
				<form method="POST" action="frmusuarios.php?ac=actualiza&id=<?php echo $id; ?>">
                    <tr>
						<td class="estilocelda3">Nombre</td><td><input type="text" name="nombre" value="<?php echo $fila['Nombre'];?>"></td>
					</tr>
					<tr>
						<td class="estilocelda3">Apellido Paterno</td><td><input type="text" name="apellidoP" value="<?php echo $fila['ApellidoP'];?>"></td>
					</tr>
                    <tr>
						<td class="estilocelda3">Apellido Materno</td><td><input type="text" name="apellidoM" value="<?php echo $fila['AplellidoM'];?>"></td>
					</tr>
					<tr>
						<td class="estilocelda3">Correo</td><td><input type="text" name="correo" value="<?php echo $fila['Correo'];?>"></td>
					</tr>
					<tr>
						<td class="estilocelda3">Password</td><td><input type="password" name="password" value="<?php echo $fila['Password'];?>"></td>
					</tr>
					<tr>
						<td class="estilocelda3">Vuelva ingresar Password</td><td><input type="password" name="password2"></td>
					</tr>

					<tr>
						<td class="estilocelda3">Empresa</td><td><input type="text" name="empresa" value="<?php echo $fila['Empresa'];?>"></td>
					</tr>
					<tr>
						<td class="estilocelda3">Direccion</td><td><input type="text" name="Direccion" value="<?php echo $fila['Direccion'];?>"></td>
					</tr>
					<tr>
						<td class="estilocelda3">Fono</td><td><input type="text" name="fono" value="<?php echo $fila['Fono'];?>"></td>
					</tr>
					<tr>
						<td colspan="2" class="estilocelda3"><input type="submit" value="Modificar"></td>
					</tr>
				</form>
				</table>
		</div>
<?php
				}
			while( $fila=mysql_fetch_array($_pagi_result) );
		}
	}		
}
mysql_close($con);
include ("abajo.php");
?>