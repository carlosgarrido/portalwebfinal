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
	     <div class="medio-column-caja-titulo-gris">Archivo de Noticias</div>

<form name="form1" method="post" action="">
<table class="estilotabla" cellspacing='0'>
	<tr>
		<td class="estilocelda2">Borrar</td>
		<td class="estilocelda2">Titulo Noticias</td>
		<td class="estilocelda2">Fecha</td>		
	</tr>
   	<tr>
<?php
$con=conectarse();
$_pagi_sql="SELECT * FROM noticias order by fecha";
$_pagi_cuantos=10;
include("../include/paginator.inc.php");
echo "<form name=\"form1\" method=\"post\" action=\"\">  ";
$a=1;
if ($fila=mysql_fetch_array($_pagi_result))
{
    do
	{
	if ($a==0)
		{
			$estilo="estilocelda";
			$a=1;
		}
	else
		{
			$estilo="estilocelda5";
			$a=0;
		}
echo "<td class='$estilo'><input type=checkbox name='d[".$fila[id]."]'></td>\n";

echo "<td class='$estilo'><a href='noticias.php?ac=actualiza&id=".$fila[id]."'>".$fila[titulo]."</a></td>";
echo "<td class='$estilo'>".fecha_esp($fila[fecha])."</td>\n";
echo "</tr>";
    }
    while( $fila=mysql_fetch_array($_pagi_result) );
}
echo "     <td colspan=\"4\" class=\"estilocelda2\"><input type=\"hidden\" name=\"num\" value=\"\"> <input id=submit type=submit value='Borrar' name=submit></td>\n";
echo "	</tr>\n";
echo "	</table>\n";
echo "</form>\n";
echo "</div>\n";
echo "</div>\n";
if (!empty($_POST['d'])) {
    $con=conectarse();
    $aLista=array_keys($_POST['d']);
    $sql="DELETE FROM noticias where id IN (".implode(',',$aLista).")";
    mysql_query($sql,$con);
    mysql_close($con);
    echo "<SCRIPT LANGUAGE=\"JavaScript\">\n";
	echo "location.href='listanoticias.php';";
	echo "</SCRIPT>";
}
include ("abajo.php");
?>
