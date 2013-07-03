<div id="medio-column">
<?php
$palabra=$_POST['palabra'];
$_pagi_sql= "SELECT * FROM `productos` WHERE `Detalles`like '%".$palabra."%' or ProductoNombre like '%".$palabra."%' order by ProductoNombre";
$con=conectarse();
$i=0;
include("include/paginator.inc.php");
if ($fila=mysql_fetch_array($_pagi_result))
	{
	echo "Busqueda para '<B>". $palabra."</B>', Total " .mysql_num_rows($_pagi_result)." Productos encontrados";
		do
		 {
?>		
	      <div class="medio-column-caja-blanco">
		  <br>	        
			<table class="estilotabla">
				<tr>					
					<td>
					
						<div class="medio-column-caja-titulo-gris"><?php echo $fila["ProductoNombre"]; ?></div>
					
					<table class="estilotabla">
		       			<tr> 
						
							<td>
							<?php if ($fila["imagen"]<>""){?>
								<a class="estiloceldaF" href="javascript:imagenzoom('<?php echo $fila["ProductoNombre"]; ?>','<?php echo $fila["imagen"];?>','400','400');">
		                        <img src="imagenes/productos/<?php echo $fila["imagen"];?>" class="medio-column-img-izq" width="150" height="110" alt="<?php $fila["ProductoNombre"]; ?>" /></a>
							<?php } ?>
							
							</td>
							<td class="estilocelda4">
								<?php echo $fila["Detalles"];?><br><a href="index.php?ac=detalles&prod=<?php echo $fila['ProductoID'];?>">Ver ficha Completa</a></p>
							</td>
						</tr>
						<tr>
							<td class="estilocelda6" colspan="2">
								<p> Precio iva incluido: $<?php echo $fila['Precio'];?></p>
							</td>
						</tr>
						
					</table>
						
					</td>
				<tr>
					<td class="estiloceldaF">
					<p><a  href="agregar.php?<?php SID?>&id=<?php echo $fila['ProductoID'];?>"><img src="imagenes/sitio/comp_normal.gif"></a></p>	                
					</td>
				</tr>
			</table>
	      </div>
<?php		  
	    }
         while( $fila=mysql_fetch_array($_pagi_result) );
	}
else
	echo "<p align='center'>No hay productos que coincidan con los parametros de busqueda</p>";
	mysql_close($con);	
?>
</div>