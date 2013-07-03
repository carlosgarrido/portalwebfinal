<?php require_once('funciones/conexion.php'); ?>
<?php
session_start();
$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($accesscheck)) {
  $GLOBALS['PrevUrl'] = $accesscheck;
  session_register('PrevUrl');
}

if (isset($_POST['user'])) {
  $loginUsername=$_POST['user'];
  $password=$_POST['pass'];
  $MM_fldUserAuthorization = "Nivel";
  $MM_redirectLoginSuccess = "index.php?ac=estado";
  $MM_redirectLoginFailed = "index.php?ac=cuenta";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_conexion, $conexion);

  $LoginRS__query=sprintf("SELECT UsuarioID, Password, Nivel FROM usuarios WHERE Correo='%s' AND Password='%s'",
  get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password));

  $LoginRS = mysql_query($LoginRS__query, $conexion) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {

    $loginStrGroup  = mysql_result($LoginRS,0,'Nivel');

    //declare two session variables and assign them
    $GLOBALS['MM_NombreUsuario'] = $loginUsername;
    $GLOBALS['MM_Grupo'] = $loginStrGroup;

    //register the session variables
    session_register("MM_NombreUsuario");
    session_register("MM_Grupo");

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>

<div id="medio-column">
	<div class="medio-column-caja-titulo-gris">Ingreso</div>
		<center>
			<table  class="estilotabla2">
				<form method="POST" action="index.php?ac=cuenta">
					<tr>
						<td class="estilocelda" colspan="2">Identifiquese con sus datos</td>
					</tr>
                    <tr>
						<td class="estilocelda4">Correo</td><td><input type="text" name="user"></td>
					</tr>
					<tr>
						<td class="estilocelda4">Contraseña</td><td><input type="password" name="pass"></td>
					</tr>
                    <tr>
						<td class="estilocelda" colspan="2"><input type="submit" name="entrar" value='entrar'></td>
					</tr>
				</form>
					<td class="estilocelda" colspan="2">Si no esta Registrado, Sirvase crear una cuenta en nuestra tienda <a href="index.php?ac=registro">AQUI</a></td>
			</table>
		</center>
	</div>


					
					
	