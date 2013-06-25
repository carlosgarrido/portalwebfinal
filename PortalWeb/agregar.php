<?php
include ("funciones/funciones.php");
$link=conectarse();
session_start();
extract($_REQUEST);
$sql="select * from productos where ProductoID='".$id."'";
$qry=mysql_query($sql,$link);
$row=mysql_fetch_array($qry);

$carro=$_SESSION['carro'];	
		$cant=0;			
		if(!($carro[md5($id)]))
		{
			$carro[md5($id)]=array('identificador'=>md5($id),'cantidad'=>$cant,'producto'=>$row['ProductoNombre'],'precio'=>$row['Precio'],'id'=>$id);
		}		
				foreach ($carro[md5($id)] as $elemento)
				{
					
						$eleme[]=$elemento;
				}		
		if ($eleme[1]==0)
		{
			$cant=1;			
		}		
		else
		{
			if (isset($cantidad)){
				if ($cantidad<1)
					$cantidad=1;				
				$cant=$cantidad;
			}
			else
				$cant=$eleme[1]+1;			
		}	
		echo $cant;
		$carro[md5($id)]=array('identificador'=>md5($id),'cantidad'=>$cant,'producto'=>$row['ProductoNombre'],'precio'=>$row['Precio'],'id'=>$id);
		
$_SESSION['carro']=$carro;

echo "<SCRIPT LANGUAGE=\"JavaScript\">\n";
echo " location.href='index.php?ac=carro';";
echo "</SCRIPT>";
?>
