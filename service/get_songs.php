<?php

include('_conexion.php');

$response=new stdClass();

$canciones=array();
$i=0;
$sql="select * from cancion";
$result=mysqli_query($con,$sql);
while ($row=mysqli_fetch_array($result)) {
	$obj=new stdClass();
	$obj->codcan=$row['codcan'];
	$obj->nomcan=$row['nomcan'];
	$obj->urlcan=$row['urlcan'];
	$canciones[$i]=$obj;
	$i++;
}

$response->canciones=$canciones;
$response->state=true;

header('Content-Type: application/json');
echo json_encode($response);
mysqli_close($con);
