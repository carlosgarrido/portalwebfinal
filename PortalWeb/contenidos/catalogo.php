<div id="medio-column">
<table>
<div class="medio-column-caja-blanco" >
<?php
$categoria=$_GET['cid'];
$_pagi_sql= "SELECT * FROM `productos` WHERE `CategoriaID` =".$categoria."";
$con=conectarse();
$i=0;
include("include/paginator.inc.php");
if ($fila=mysql_fetch_array($_pagi_result))
	{

					 		do
							 {
                             if ($i==0)
                                echo "<tr>";
                             $i=$i+1;
echo "<td>\n";
echo "				<table class='estilotabla'>\n";
echo "					<tr>\n";
echo "						<td >\n";
echo "							<a href='index.php?ac=detalles&prod=".$fila['ProductoID']."'>\n";
echo "	                        <img src='imagenes/productos/".$fila['imagen']."' class='medio-column-img-centro' width='80'  height='90' alt='".$fila['ProductoNombre']."' ></a>\n";
echo "						</td>\n";
echo "					</tr>\n";
echo "					<tr>\n";
echo "						<td class='estilocelda2'>".$fila['ProductoNombre']."</td>\n";
echo "					</tr>\n";
echo "					<tr>\n";
echo "						<td></td>\n";
echo "					</tr>\n";
echo "					<tr>\n";
echo "						<td ></td>\n";
echo "					</tr>\n";
echo "				</table>\n";
echo "\n";
echo " </td>";
                             if ($i==5){
                                echo "</tr>";
                                $i=0;
                             }

							 }
                             while( $fila=mysql_fetch_array($_pagi_result) );
	}
	else
		echo"<p>No hay productos en esta categoria</p>";
	mysql_close($con);	
?>
</div>
</table>
</div>

