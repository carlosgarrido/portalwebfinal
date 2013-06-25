<?php
session_start();
extract($_GET);
$carro=$_SESSION['carro'];
unset($carro[md5($id)]);
$_SESSION['carro']=$carro;
echo "<SCRIPT LANGUAGE=\"JavaScript\">\n";
echo " location.href='index.php?ac=carro';";
echo "</SCRIPT>";
?>
