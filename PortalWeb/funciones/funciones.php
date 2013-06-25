<?php
function conectarse()
	{
			if (!($link=mysql_connect("localhost","root","")))
		{
			echo "Error conectando a la base de datos.";
			exit();
		}
			if (!mysql_select_db("serviweb",$link))
		{
			echo "Error seleccionando la base de datos.";
			exit();
		}
		return $link;
	}
function existe($tabla,$campo,$cadena)
{
	$link = conectarse();
	$pregunta = "select * from $tabla where $campo = '$cadena'";
	if(!$consulta = mysql_query($pregunta,$link))
    {
		echo "Error en la ejecución de la consulta: ".mysql_error();
		exit;
	}
	if(mysql_num_rows($consulta)==0)
	{
		return false;
	}

	return true;
}

function listaCampo($tabla){
	$link = conectarse();
	$id = mysql_list_fields("serviweb",$tabla);
	$cuantos = mysql_num_fields($id);
    $sel="<select name='campo'>";
	while($campo = mysql_field_name($id,$link)){
       	$sel=$sel."<option value='".$campo."'>".$campo."</option>";
		$i++;
		if($i == ($cuantos))	break;
	}
	$sel=$sel." </select>";
    return $sel;
}

function listaContenido($tabla,$se){
	$link=conectarse();
	$query="SELECT * FROM $tabla";
    $sel="<select name='campo' selected='$se'>";
	$consulta=mysql_query($query,$link);
	$fila=mysql_fetch_array($consulta);
	do
	{
		$sel=$sel."<option value=".$fila[0].">".$fila[1]."</option>";
	}
	while( $fila=mysql_fetch_array($consulta) );
    $sel=$sel." </select>";
	mysql_close($link);
    return $sel;
}

function listaContenido2($tabla,$se){
	$link=conectarse();
	$query="SELECT * FROM $tabla";
    $sel="<select name='campo2'>";
	$consulta=mysql_query($query,$link);
	$fila=mysql_fetch_array($consulta);
	do
	{
		if ($se==$fila[0])
				$sel=$sel."<option value=".$fila[0]." selected>".$fila[1]."</option>";
		else
				$sel=$sel."<option value=".$fila[0].">".$fila[1]."</option>";
		
	}
	while( $fila=mysql_fetch_array($consulta) );
    $sel=$sel." </select>";
	mysql_close($link);
    return $sel;
}

function listaContenido3($tabla){
	$link=conectarse();
	$query="SELECT * FROM $tabla";
    $sel="<select name='campo2'><option>--Seleccione--</option>";
	$consulta=mysql_query($query,$link);
	$fila=mysql_fetch_array($consulta);
    do
	{
		$sel=$sel."<option value=".$fila[0].">".$fila[1]."</option>";
	}
	while( $fila=mysql_fetch_array($consulta) );
    $sel=$sel." </select>";
	mysql_close($link);
    return $sel;
}


function obtenerFecha(){
	setlocale(LC_TIME,"es_ES");
	$fsys = strftime("%d/%m/%Y",time());
	return $fsys;
}

function fecha_usa($esp)
{
	list($dia,$mes,$ano)=split('[-/]',$esp);
	if($dia>31)
		return $dia."/".$mes."/".$ano;
	else
		return $ano."/".$mes."/".$dia;
}

function fecha_esp($usa)
{
	list($ano,$mes,$dia)=split('[-/]',$usa);
	if($ano<31)
		return $ano."/".$mes."/".$dia;
	else
		return $dia."/".$mes."/".$ano;
}

?>
