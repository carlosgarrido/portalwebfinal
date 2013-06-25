<?php
$sql = "SELECT * FROM productos ORDER BY rand(" . time() . " * " . time() . ") LIMIT 2";
$con=conectarse();
$sql=mysql_query($sql,$con);
if ($row=mysql_fetch_array($sql))
{
?>
<div id="medio-column">	
		<div class="medio-column-caja-blanco">
			<div class="medio-column-caja-titulo-azul"> Destacados</div>

<?php
do
{

		if ($a==1) 
			{
			$estilo2="medio-column-caja-der-blanco";
			$estilo="medio-column-der";
			$a=0;
			}
		else 
		{
			$estilo2="medio-column-caja-izq-blanco";
			$estilo="medio-column-izq";
			$a=1;
		}
?>
			<div class=<?php echo $estilo;?>>				
						<div class=<?php echo $estilo2;?>>
							<div class="medio-column-caja-titulo-gris"><?php echo $row['ProductoNombre'];?></div>
							<p><img src="imagenes/productos/<?php echo $row['imagen'];?>" class="medio-column-img-izq" width="100"  alt="" ><?php echo $row['Detalles'];?></p>
		        			<p><a href="index.php?ac=detalles&prod=<?php echo $row['ProductoID'];?>">Detalles</a></p>
						</div>
			</div>	
<?php
}
    while( $row=mysql_fetch_array($sql) );
}	
?>

				
		</div>
<br>
<br>		
<div class="medio-column-caja-blanco">
					<div class="medio-column-caja-titulo-azul">Ofertas</div>		
<?php
mysql_close($con);
$a=0;

$sql = "SELECT * FROM noticias order by fecha";
$con=conectarse();
$sql=mysql_query($sql,$con);
if ($fila=mysql_fetch_array($sql))
do
{

		if ($a==1) 
			{
			$estilo2="medio-column-caja-der-blanco";
			$estilo="medio-column-der";
			$a=0;
			}
		else 
		{
			$estilo2="medio-column-caja-izq-blanco";
			$estilo="medio-column-izq";
			$a=1;
		}

		?>

				
						<div class=<?php echo $estilo;?>>				
								<div class=<?php echo $estilo2;?>>
									<div class="medio-column-caja-titulo-gris"><?php echo $fila[titulo];?> </div>
									<p><img src="imagenes/noticias/<?php echo $fila[imagen];?>" class="medio-column-img-izq" width="85" height="75" alt="" /> <?php echo $fila[texto1];?></p>
				        			<p></p>
								</div>
						</div>
						
			
<?php
}
    while( $fila=mysql_fetch_array($sql) );
?>
	</div>
		           
</div> 	

