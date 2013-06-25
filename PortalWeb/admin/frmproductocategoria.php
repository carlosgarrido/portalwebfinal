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
// ******************************
// *** Mantenedor de Categorias
// *** Ingresar Y actualizar
// *** Brian Garcia
// *****************************

if ($_GET["ac"]){
     $ac=$_GET["ac"];
     $con=conectarse();
      if ($ac=="ingresar")
          ingresar();
     if ($ac=="agregar")
     {
          $NombreCategoria=$_POST["nombre"];
          if (existe(categoriaproductos,CategoriaNombre,$NombreCategoria))
                    echo "<p>Esta categoria ya se encuentra ingresada";
          else{
                $sql = "INSERT INTO `categoriaproductos` (`CategoriaID`, `CategoriaNombre`) VALUES (NULL, '$NombreCategoria')";
                 echo "<p>Nueva Categoria Insertada";
                 mysql_query($sql,$con);
          }
     }
     if ($ac=="actualizar")
     {
         $NombreCategoria=$_POST["nombre"];
         $CategoriaID=$_POST["id"];
         if (existe(categoriaproductos,CategoriaNombre,$NombreCategoria))
                    echo "<p>Esta categoria ya se encuentra ingresada";
         else
         {
            $sql = "UPDATE `categoriaproductos` SET `CategoriaNombre` = '$NombreCategoria' WHERE `CategoriaID` = '$CategoriaID'";
            mysql_query($sql,$con);
            echo " <p>Categoria Actualizada";
         }
     }
     if ($ac=="actualiza"){
            $id=$_GET["id"];
            $sql = "SELECT `CategoriaNombre` FROM `categoriaproductos` WHERE `CategoriaID` = $id ";
            $resultado=mysql_query($sql,$con);
            $fila = mysql_fetch_array($resultado);
            actualizar($id,$fila[0]);
     }
     mysql_close($con);
}



        function ingresar()
        {
        echo "<div id=\"medio-column\">\n";
        echo "    <div class=\"medio-column-caja-blanca\">\n";
        echo "	     <div class=\"medio-column-caja-titulo-gris\">Agregar Categoria de Producto</div> <br>\n";
        echo "              <form method=\"post\" name=\"form1\" action=\"frmproductocategoria.php?ac=agregar\">\n";
        echo "			  <table class=\"estilotabla3\">\n";
        echo "			  <tr>\n";
        echo "				<td class=\"estilocelda3\">Nombre de Categoria</td>\n";
        echo "			  	<td class=\"estilocelda3\"><input name=\"nombre\" type=\"text\"  value=\"\"></td>\n";
        echo "			  </tr>\n";
        echo "				<tr>\n";
        echo "					<td colspan=\"2\" class=\"estilocelda3\">\n";
        echo "                    <input type=\"submit\" name=\"Submit\" value=\"Guardar\"></td>\n";
        echo "				</tr>\n";
        echo "                     <input name=\"id\" type=\"hidden\" id=\"id\" value=\"\">\n";
        echo "				</table>\n";
        echo "              </form>\n";
        echo "    </div>\n";
        echo "</div>";
        }


        function actualizar($CategoriaID,$CategoriaNombre)
        {
        echo "<div id=\"medio-column\">\n";
        echo "    <div class=\"medio-column-caja-blanca\">\n";
        echo "	     <div class=\"medio-column-caja-titulo-gris\">Agregar Categoria de Producto</div> <br>\n";
        echo "              <form method=\"post\" name=\"form1\" action=\"frmproductocategoria.php?&ac=actualizar\">\n";
        echo "			  <table class=\"estilotabla3\">\n";
        echo "			  <tr>\n";
        echo "				<td class=\"estilocelda3\">Nombre de Categoria</td>\n";
        echo "			  	<td class=\"estilocelda3\"><input name=\"nombre\" type=\"text\"  value=".$CategoriaNombre."></td>\n";
        echo "			  </tr>\n";
        echo "				<tr>\n";
        echo "					<td colspan=\"2\" class=\"estilocelda3\">\n";
        echo "                    <input type=\"submit\" name=\"Submit\" value=\"Guardar\"></td>\n";
        echo "				</tr>\n";
        echo "                     <input name=\"id\" type=\"hidden\" id=\"id\" value=".$CategoriaID.">\n";
        echo "				</table>\n";
        echo "              </form>\n";
        echo "    </div>\n";
        echo "</div>";
        }

include ("abajo.php");
?>




