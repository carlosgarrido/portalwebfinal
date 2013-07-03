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
	<div class="medio-column-caja-titulo-gris">Listado de productos en inventario</div>
   		<table  border="0" cellpadding="2" cellspacing="0">	
				<tr>
					<td>
<?php

$con=conectarse();
$sqlcategorias = "Select * From CategoriaProductos";
$catego=mysql_query($sqlcategorias,$con);	
if ($filacate=mysql_fetch_array($catego))
{
    do
	{		
					
?>
					<table  border="0" cellspacing="1" cellpadding="0">
								<tr>
									<td colspan="3" width="1000">&nbsp;</td>
								</tr>
								<tr class="estilocelda6">
									<td colspan="3" width="100%" class="estilocelda4"><strong><?php echo $filacate[CategoriaNombre];?></font></strong></td><td align="center" colspan="4" width="100%" class=""><strong></strong></td>							
								</tr>
								<tr class="estilocelda2">
									<td width="60" align="center">Cód.</td><td width="50" align="center">Stock</td><td width="1000" align="center">Producto</td><td align="center">&nbsp;&nbsp;&nbsp;Precio&nbsp;&nbsp;&nbsp;</td>
								</tr>
<?php
					$productos = "Select * From Productos Where CategoriaID='".$filacate[CategoriaID]."'";
					$produc=mysql_query($productos,$con);
					if ($filapro=mysql_fetch_array($produc))
					{
						$a=0;
					    do
						{
									if ($a==1)
									{	
										$color="estilocelda5";
										$a=0;
									}
									else
									{
										$color="estilocelda";
										$a=1;
									}	
									if ($filapro[Stock]<10)
										$col="#FF0000";																	
									else
										$col="";
?>
									<tr class='<?php echo $color;?>'>
										<td width="60" align="center"><?php echo $filapro[ProductoID];?></td>
										<td width="50" align="center"><font color="<?php echo $col;?>"><?php echo $filapro[Stock];?></font></td>
										<td width="1000">&nbsp&nbsp;&nbsp;&nbsp;<a href="frmproducto.php?ac=actualiza&id=<?php echo $filapro[ProductoID]?>"><?php echo $filapro[ProductoNombre]?></a></td>
										<td align="center">&nbsp;&nbsp;&nbsp;$<?php echo $filapro[Precio];?>&nbsp;&nbsp;&nbsp;</td>
									</tr>
<?php
						}	
						while($filapro=mysql_fetch_array($produc));	
					}
?>
	
					</table>
<?php
	}	
	while($filacate=mysql_fetch_array($catego));
}
mysql_close($con);	
?>	
				</td>
				</tr>
			</table>
</div>
</div>
<!--#include File="abajo.asp"-->