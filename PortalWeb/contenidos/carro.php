<div id="medio-column">
<?php
if($carro){
?>
	<div class="medio-column-caja-titulo-gris">Contenido de su carrito de compras</div>
		<table  cellpadding=2 cellspacing=0 class="estilotabla">
					<tr>
						<td class="estilocelda">Artículo</td>
						<td class="estilocelda">Cantidad</td>
						<td class="estilocelda">actualizar</td>
						<td class="estilocelda">Precio</td>
						<td class="estilocelda">Borrar</td>						
					</tr>
<?php
  $color=array("#ffffff","#F0F0F0");
  $contador=0;
  $suma=0;
  //antes de recorrer todos los valores de la matriz carro, ponemos a cero la variable $suma,
  //en la que iremos sumando los subtotales del costo de cada item por la cantidad de unidades que se especifiquen
   foreach($carro as $k => $v){
   //recorremos la matriz que tiene todos los valores del carro, calculamos el subtotal y el total
   $subto=$v['cantidad']*$v['precio'];
   $suma=$suma+$subto;
   $contador++;//este es el contador que usamos para los colores alternos
  ?>
  <form name="a<?php echo $v['identificador'] ?>" method="post" action="agregar.php?<?php echo SID ?>" id="a<?php echo $v['identificador'] ?>">
                    <tr class='prod'>
						<td><?php echo $v['producto']; ?></td>
						<td><input name="cantidad" type="text" id="cantidad" value="<?php echo $v['cantidad'] ?>" size="8">
                            <input name="id" type="hidden" id="id" value="<?php echo $v['id'] ?>"></td>
						<td><input name="imageField" type="image" src="/carrito/imagenes/sitio/actualizar.gif" width="20" height="20" border="0"></td>
						<td>$<?php echo number_format(($v['precio']*$v['cantidad']),0,'.','.'); ?></td>
						<td><a href="borracar.php?<?php echo SID ?>&id=<?php echo $v['id'] ?>"><img src="/carrito/imagenes/sitio/trash.gif" width="12" height="14" border="0"></a></td>						
					</tr>
  </form>
<?php
//por cada item creamos un formulario que submite a agregar producto y un link que permite eliminarlos
}?>
					<tr>
						<td >Total de Artículos: <?php echo count($carro);?> </td>
						<td colspan="4"></td>
                        
					</tr>
					<tr>
						<td colspan="3"></td>
						<td colspan="2" class="estilocelda3">Neto:     $<?php $suma2=$suma/(1.19); echo number_format($suma2,0,'.','.');?></td>
					</tr>
					<tr>
						<td colspan="3"></td>
						<td colspan="2" class="estilocelda3">Total: $<?php echo number_format($suma,0,'.','.');?></td><td></td>						
					</tr>
						<td colspan="5" class="estiloproducto"><a href="index.php?ac=finalizar" class="estiloproducto">Finalizar Pedido</a></td>
					</tr>
</table>
<?php
}
else
{
?>
<p align="center"> <span class="prod">No hay productos seleccionados</span> <a href="../index.php?<?php echo SID;?>"><img src="continuar.gif" width="13" height="13" border="0"></a>
  <?php
  }
  ?>
</div>

