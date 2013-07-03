<?php require_once('../funciones/conexion.php'); ?>
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
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_conexion, $conexion);

  $LoginRS__query=sprintf("SELECT UserID, Password, Nivel FROM admin WHERE UserID='%s' AND Password='%s'",
  get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password));

  $LoginRS = mysql_query($LoginRS__query, $conexion) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {

    $loginStrGroup  = mysql_result($LoginRS,0,'Nivel');

    //declare two session variables and assign them
    $GLOBALS['MM_Username'] = $loginUsername;
    $GLOBALS['MM_UserGroup'] = $loginStrGroup;

    //register the session variables
    session_register("MM_Username");
    session_register("MM_UserGroup");

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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Sistema de Matricula" />
<meta name="keywords" content="Keywords" />
<meta name="author" content="Brian Garcia 2006, Neuromantes Informatica" />
<link rel="stylesheet" type="text/css" href="../css/estilo.css" media="screen" title="Sistema de Matriculas" />
<title></title>
</head>
<html>
<body>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<center>
		<div id="login">
			<form name="acceso" method="POST" action="<?php echo $loginFormAction; ?>">
			<div class="medio-column-caja-login-gris"><img src="../imagenes/sitio/login.jpg"></div>
				<table cellspacing="0" width="100%" border='0'>		
				
				<tr class="estilocelda">
		    		<td class="estilocelda">Usuario</td>
					<td class="estilocelda"><input name="user"  type="text" id="user"  class="login" ></td>
				</tr>
				<tr class="estilocelda">
		    		<td class="estilocelda">Password</td>
					<td class="estilocelda"><input name="pass"  type="password" class="login" id="pass" > </td>
				</tr>
				<tr class="estilocelda2"> 
		    		<td colspan='2' class="estilocelda"><input type="submit" name="Submit" value="Enviar"></td>
				</tr>
			</form>
		</div>
</center>
</body>
</html>
