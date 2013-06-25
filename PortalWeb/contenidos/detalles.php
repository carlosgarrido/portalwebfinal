<?php
$ProductoID=$_GET['prod'];
$con=conectarse();
$query="select * from productos where ProductoID='$ProductoID'";
$consulta=mysql_query($query,$con);
$fila=mysql_fetch_array($consulta);

?>
<div id="medio-column">
<table class="clasetabla">
	<div class="medio-column-caja-blanco">
	<tr>
		<td colspan="2">
				<div class="medio-column-caja-titulo-azul"><?php echo $fila['ProductoNombre']; ?> </div>
		</td>
	</tr>
	<tr>
		<td>

				<a href="javascript:imagenzoom('<?php echo $fila['ProductoNombre']; ?>','<?php echo $fila['imagen']; ?>','400','400');">
                        <img src="imagenes/productos/<?php echo $fila['imagen'];?>" class="medio-column-img-izq" width="200"  alt="<?php echo $fila['ProductoNombre']; ?>"> </a>
		</td>
		<td class="estilocelda4">
                        <?php echo $fila['Detalles']; ?>
		</td>
	</tr>
	<tr>
		<td colspan="2" class="estilocelda6">&nbsp;</td>
	</tr>
	<tr>
			<td colspan="2" class="estilocelda4"><a href="javascript:history.back()">Atras</a></td>
	</tr>
	</tr>
      </div>
	</table>
</div>
<?php
mysql_close($con);
?>
