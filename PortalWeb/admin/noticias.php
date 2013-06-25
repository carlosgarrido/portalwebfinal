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
include("index.php");
if ($_GET["ac"]){
     $ac=$_GET["ac"];
     $con=conectarse();
     if ($ac=="ingresar")
        ingresar();
     if ($ac=="agregar")
     {
          $titulo=$_POST["titulo"];
          $texto1=$_POST["texto1"];
          $texto2=$_POST["texto2"];
          $tipo_img=$HTTP_POST_FILES["file"]['type'];
          if (!((strpos($tipo_img, "gif")||strpos($tipo_img, "jpg")||strpos($tipo_img, "jpeg")))){
            echo "<pr>La extensión del archivo no es correcta.";
            $Imagen="sinimagen.jpg";
            }
          else
          {
                $Imagen=$_FILES["file"]["name"];
                $temp=$_FILES["file"]["tmp_name"];
                $tamanio = $_FILES["file"]["size"];
                $ruta="C:\wamp\www\carrito\imagenes\\noticias\\".$Imagen;
               	copy($temp,$ruta);

          }
          if (existe(noticias,titulo,$ProductoNombre))
                   echo "<p>Esta noticia ya se encuentra ingresado";
          else{
					$fecha=obtenerFecha();
					$fecha=fecha_usa($fecha);
                     $sql = "INSERT INTO `noticias` (`titulo`, `texto1`, `texto2`,`imagen`,`fecha`)";
                     $sql=$sql." VALUES ( '$titulo', '$texto1', '$texto2','$Imagen','$fecha')";
					 echo "<p>Nueva noticia ingresada";
                     mysql_query($sql,$con);
              }
     }
     if ($ac=="actualizar")
     {
         $id=$_POST["id"];
         $titulo=$_POST["titulo"];
         $texto1=$_POST["texto1"];
         $texto2=$_POST["texto2"];
         $tipo_img=$HTTP_POST_FILES["file"]['type'];
         if (!((strpos($tipo_img, "gif")||strpos($tipo_img, "jpg")||strpos($tipo_img, "jpeg")))){
            echo "<pr>La extensión del archivo no es correcta.";
            $Imagen="sinimagen.jpg";
            }
         else
          {
                $Imagen=$_FILES["file"]["name"];
                $temp=$_FILES["file"]["tmp_name"];
                $tamanio = $_FILES["file"]["size"];
                $ruta="C:\wamp\www\carrito\imagenes\\noticias\\".$Imagen;
               	copy($temp,$ruta);

          }
         $sql = "UPDATE `noticias` SET `titulo` = '$titulo' , `texto1` ='$texto1' , `texto2` ='$texto2' , `imagen` ='$Imagen' WHERE `id` = '$id'" ;
         mysql_query($sql,$con);
         echo " <p>Noticia Actualizada";
         
     }
     if ($ac=="actualiza"){
            $id=$_GET["id"];
            actualizar($id);
     }
}

function ingresar()
{
echo "<div id=\"medio-column\">\n";
echo "    <div class=\"medio-column-caja-blanca\">\n";
echo "	     <div class=\"medio-column-caja-titulo-gris\">Agregar Nuevo Producto</div>\n";
echo "         <p></p>\n";
echo "        <form action=\"noticias.php?ac=agregar\" method=\"post\" enctype=\"multipart/form-data\" name=\"form1\">";
echo "		<table class=\"estilotabla3\">\n";
echo "			<tr>\n";
echo "				<td class=\"estilocelda3\">Titulo Noticia</td>\n";
echo "				<td class=\"estilocelda3\"><input name=\"titulo\" type=\"text\" id=\"name3\" value=\"\"></td>\n";
echo "				<td class=\"estilocelda3\" rowspan=\"3\"><img src=\"../imagenes/productos/sinimagen.jpg\" class=\"medio-column-img-izq\" width=\"80\" height=\"90\" alt=\"\" />\n";
echo "			</tr>\n";
echo "			<tr>\n";
echo "				<td class=\"estilocelda3\">Imagen</td>\n";
echo "				<td class=\"estilocelda3\"><input type=\"file\" name=\"file\"></td>\n";
echo "			</tr>\n";
echo "			<tr>\n";
echo "				<td colspan=\"2\" class=\"estilocelda3\">Detalles<textarea name=\"texto1\" cols=\"50\" rows=\"7\" id=\"name1\"></textarea></td>\n";
echo "			</tr>\n";
echo "			<tr>\n";
echo "				<td colspan=\"2\" class=\"estilocelda3\">Detalles<textarea name=\"texto2\" cols=\"50\" rows=\"7\" id=\"name2\"></textarea></td>\n";
echo "			</tr>\n";
echo "			<tr>\n";
echo "				<td class=\"estilocelda3\" colspan=\"3\"><input type=\"submit\" name=\"Submit\" value=\"Guardar\"><td>\n";
echo "				<input name=\"id\" type=\"hidden\" id=\"id\" value=\"\">\n";
echo "			</tr>\n";
echo "		</table>\n";
echo "      </form>\n";
echo "    </div>\n";
echo "</div>";
}

function actualizar($id)
{
$con=conectarse();
$sql = "SELECT * FROM `noticias` WHERE `id`='".$id."'";
$resultado=mysql_query($sql,$con);
$fila = mysql_fetch_array($resultado);
echo "<div id='medio-column'>
	<div class='medio-column-caja-blanca'>
		<div class='medio-column-caja-titulo-gris'>Actualizar Nuevo Producto</div>
		<form action='noticias.php?ac=actualizar' method='post' enctype='multipart/form-data' name='form1'>
			<table class='estilotabla3'>
			<tr>
				<td class='estilocelda3'>Titulo Noticia</td>
				<td class='estilocelda3'><input name='titulo' type='text' id='name3' value='".$fila[titulo]."'></td>
				<td class='estilocelda3' rowspan='3'><img src='../imagenes/noticias/".$fila[imagen]."' class='medio-column-img-izq' width='80' height='90'>
			</tr>
		<tr>
		<td class='estilocelda3'>Imagen</td>
		<td class='estilocelda3'><input name='file' type='file' id='name' value=''></td>
        </tr>\n";

echo "			<tr>\n";
echo "				<td colspan=\"2\" class=\"estilocelda3\">Texto1<textarea name=\"texto1\" cols=\"50\" rows=\"7\" id=\"name2\">".$fila[texto1]."</textarea></td>\n";
echo "			</tr>\n";
echo "			<tr>\n";
echo "				<td colspan=\"2\" class=\"estilocelda3\">Texto2<textarea name=\"texto2\" cols=\"50\" rows=\"7\" id=\"name2\">".$fila[texto2]."</textarea></td>\n";
echo "			</tr>\n";
echo "			<tr>\n";
echo "				<td class=\"estilocelda3\" colspan=\"3\"><input type=\"submit\" name=\"Submit\" value=\"Guardar\"><td>\n";
echo "				<input name=\"id\" type=\"hidden\" id=\"id\" value=".$id.">\n";
echo "			</tr>\n";
echo "		</table>\n";
echo "      </form>\n";
echo "    </div>\n";
echo "</div>\n";
echo "";
}
include ("abajo.php");
?>

