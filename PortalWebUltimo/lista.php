<html dir="LTR" lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<title>PortalWeb - Lista de Precios </title>
<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #000000;
}
a:link {
	color: #000000;
	text-decoration: none;
}
a:visited {
	color: #000000;
	text-decoration: none;
}
a:hover {
	color: #666666;
	text-decoration: none;
}
a:active {
	color: #000000;
	text-decoration: none;
}
.Titulo {
	font-size: 30px;
	font-weight: bold;
	font-family: Trebuchet MS, Sans-Serif, Georgia, Courier, Times New Roman, Serif;
}

.rojo {
color: #FF0000;
}

.top {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
	}
-->
</style>
</head>
<!-- body //-->

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		    <td width="180" valign="middle"><img src="http://127.0.0.1/carrito/imagenes/banner.jpg"><br>
				<span class="top"></span>
				curico-chile<br>
				<img src="imagenes/sitio/sp-lista.gif" alt="" width="300" height="10">
			</td>
			<td width="601" align="center">&nbsp;</td>
		    <td width="96" align="right" valign="middle"><img src="imagenes/sitio/LOGO.gif" ></td>
		</tr>
</table>
<center>
	<table width="100%" border="0" cellpadding="2" cellspacing="0">	
		<tr>
			<td>

<?php
include ("funciones/funciones.php");
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
							<td colspan="4" width="1000">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3" width="100%" ><strong><?php echo $filacate[CategoriaNombre];?></font></strong></td><td align="center" colspan="4" width="100%" class=""><strong></strong></td>							
						</tr>
								<tr bgcolor="#D9F0FF">
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
										$color="#F4F4F7";
										$a=0;
									}
									else
									{
										$color="#FFFFFF";
										$a=1;
									}									
									if ($filapro[Stock]<10){
										$st="bajo";
										$col="#FF0000";
										}
									else if ($filapro[Stock]==0){
										$st="Sin stock";
										$col="#FF0000";
										}
									else
										$st="normal";
?>
									<tr bgcolor='<?php echo $color;?>'>
										<td width="60" align="center"><?php echo $filapro[ProductoID];?></td>
										<td width="50" align="center"><font color="<?php echo $col;?>"><?php echo $st;?></font></td>
										<td width="1000" align="center">&nbsp&nbsp;&nbsp;&nbsp;<a href="index.php?ac=detalles&prod=<?php echo $filapro[ProductoID]?>"><?php echo $filapro[ProductoNombre]?></a></td>
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
</center>
</body>
</html>