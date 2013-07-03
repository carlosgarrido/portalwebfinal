<?php
include ("../funciones/funciones.php");
$nombre=$_POST["nombre"];
$apellidoP=$_POST["apellidoP"];
$apellidoM=$_POST["apellidoM"];
$correo=$_POST["correo"];
$password=$_POST["password"];
$password2=$_POST["password2"];
$empresa=$_POST["empresa"];
$direccion=$_POST["Direccion"];
$fono=$_POST["fono"];
if ($password==$password2){
    if (existe(usuarios,Correo,$correo)){
        echo "<SCRIPT LANGUAGE=\"JavaScript\">\n";
        echo " location.href='../index.php?ac=registro';\n";
        echo "alert ('Este correo ya se encuentra registrado');\n";
         echo "</SCRIPT>";

        }
    else
      {
        $sql = "INSERT INTO `usuarios` (`Nombre`, `ApellidoP`, `AplellidoM`, `Correo`, `Password`, `Empresa`, `Direccion`, `Fono`) VALUES ('$nombre', '$apellidoP', '$apellidoM', '$correo','$password', '$empresa', '$direccion', '$fono')";
		$con=conectarse();
        $insercion=mysql_query($sql,$con);
        mysql_close($con);
		echo "<SCRIPT LANGUAGE=\"JavaScript\">\n";
        echo " location.href='../index.php?ac=cuenta';\n";
        echo "alert ('Su cuenta Ha sido Creada');\n";
        echo "</SCRIPT>";
       }
}
else
{
    echo "<SCRIPT LANGUAGE=\"JavaScript\">\n";
    echo " location.href='../index.php?ac=estado';\n";
    echo "alert ('passwords no coinciden');\n";
    echo "</SCRIPT>";
}
?>
