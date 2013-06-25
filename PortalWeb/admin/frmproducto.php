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
          $ProductoNombre=$_POST["ProductoNombre"];
          $Detalles=$_POST["detalles"];
          $Precio=$_POST["Precio"];
          $Stock=$_POST["Stock"];
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
                $ruta="C:\wamp\www\PortalWeb\imagenes\productos/".$Imagen;
			    copy($temp,$ruta);

          }
          $CategoriaID=$_POST["campo2"];
          if (existe(productos,ProductoNombre,$ProductoNombre))
                   echo "<p>Este Producto ya se encuentra ingresado";
          else{
                     $sql = "INSERT INTO `productos` (`ProductoNombre`, `Detalles`, `Precio`, `Stock`, `imagen`, `CategoriaID`)";
                     $sql=$sql." VALUES ( '$ProductoNombre', '$Detalles', '$Precio', '$Stock', '$Imagen', '$CategoriaID')";
                     echo "<p>Nuevo Producto Insertado";
                     mysql_query($sql,$con);
              }
     }
     if ($ac=="actualizar")
     {
         $ProductoID=$_POST["id"];
         $ProductoNombre=$_POST["nombre"];
         $Detalles=$_POST["detalles"];
         $Precio=$_POST["precio"];
         $Stock=$_POST["stock"];
		 $categoria=$_POST["campo2"];
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
                $ruta="imagenes/productos/".$Imagen;
               	copy($temp,$ruta);

          }
         $CategoriaID=$_POST["campo2"];
         $sql = "UPDATE `productos` SET `ProductoNombre` = '$ProductoNombre' , `Detalles` ='$Detalles' , `Precio` ='$Precio' , `Stock` = '$Stock', `imagen` ='$Imagen',`CategoriaID`='$categoria'  WHERE `ProductoID` = '$ProductoID'" ;
         mysql_query($sql,$con);
         echo " <p>Producto Actualizado";
         
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
echo "        <form action=\"frmproducto.php?ac=agregar\" method=\"post\" enctype=\"multipart/form-data\" name=\"form1\">";
echo "		<table class=\"estilotabla3\">\n";
echo "			<tr>\n";
echo "				<td class=\"estilocelda3\">Nombre del Producto</td>\n";
echo "				<td class=\"estilocelda3\"><input name=\"ProductoNombre\" type=\"text\" id=\"name3\" value=\"\"></td>\n";
echo "				<td class=\"estilocelda3\" rowspan=\"4\"><img src=\"../imagenes/productos/sinimagen.jpg\" class=\"medio-column-img-izq\" width=\"80\" height=\"90\" alt=\"\" />\n";
echo "			</tr>\n";
echo "			<tr>\n";
echo "              <td class=\"estilocelda3\">Precio</td>\n";
echo "			  <td class=\"estilocelda3\"><input name=\"Precio\" type=\"text\" id=\"name\" value=\"\"></td>\n";
echo "			</tr>\n";
echo "			<tr>\n";
echo "				<td class=\"estilocelda3\">Stock</td>\n";
echo "				<td class=\"estilocelda3\"><input name=\"Stock\" type=\"text\" id=\"stock\" value=\"\"></td>\n";
echo "			</tr>\n";
echo "			<tr>\n";
echo "				<td class=\"estilocelda3\">categoria</td>\n";
echo "				<td class=\"estilocelda3\">".listaContenido3(categoriaproductos)."<td>\n";
echo "			</tr>\n";
echo "			<tr>\n";
echo "				<td class=\"estilocelda3\">Imagen</td>\n";
echo "				<td class=\"estilocelda3\" colspan=\"2\"><input type=\"file\" name=\"file\"></td>\n";
echo "			</tr>\n";
echo "			<tr>\n";
echo "				<td colspan=\"3\" class=\"estilocelda3\">Detalles<textarea name=\"detalles\" cols=\"50\" rows=\"7\" id=\"name2\"></textarea></td>\n";
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

function actualizar($ID)
{
$con=conectarse();
$sql = "SELECT * FROM `productos` WHERE `ProductoID`='".$ID."'";
$resultado=mysql_query($sql,$con);
$fila = mysql_fetch_array($resultado);
echo "<div id='medio-column'>
	<div class='medio-column-caja-blanca'>
		<div class='medio-column-caja-titulo-gris'>Agregar Nuevo Producto</div>
		<form action='frmproducto.php?ac=actualizar' method='post' enctype='multipart/form-data' name='form1'>
			<table class='estilotabla3'>
			<tr>
				<td class='estilocelda3'>Nombre del Producto</td>
				<td class='estilocelda3'><input name='nombre' type='text' id='name3' value='".$fila[ProductoNombre]."'></td>
				<td class='estilocelda3' rowspan='4'><img src='../imagenes/productos/".$fila[imagen]."' class='medio-column-img-izq' width='80' height='90'>
			</tr>
		<tr>
		<td class='estilocelda3'>Precio</td>
		<td class='estilocelda3'><input name='precio' type='text' id='name' value='".$fila[Precio]."'></td>
        </tr>\n";
echo "			<tr>\n";
echo "				<td class=\"estilocelda3\">Stock</td>\n";
echo "				<td class=\"estilocelda3\"><input name=\"stock\" type=\"text\" id=\"stock\" value='".$fila[Stock]."'></td>\n";
echo "			</tr>\n";
echo "			<tr>\n";
echo "				<td class=\"estilocelda3\">categoria</td>\n";
echo "				<td class='estilocelda3'>".listacontenido2(CategoriaProductos,$fila[6])."</td>";
echo "			</tr>";
echo "			<tr>";
echo "				<td class=\"estilocelda3\">Imagen</td>\n";
echo "				<td class=\"estilocelda3\" colspan=\"2\"><input type=\"file\" name=\"file\"></td>\n";
echo "			</tr>\n";
echo "			<tr>\n";
echo "				<td colspan=\"3\" class=\"estilocelda3\">Detalles<textarea name=\"detalles\" cols=\"50\" rows=\"7\" id=\"name2\">".$fila[Detalles]."</textarea></td>\n";
echo "			</tr>\n";
echo "			<tr>\n";
echo "				<td class=\"estilocelda3\" colspan=\"3\"><input type=\"submit\" name=\"Submit\" value=\"Guardar\"><td>\n";
echo "				<input name=\"id\" type=\"hidden\" id=\"id\" value=".$ID.">\n";
echo "			</tr>\n";
echo "		</table>\n";
echo "      </form>\n";
echo "    </div>\n";
echo "</div>\n";
echo "";
}
include ("abajo.php");
?>

