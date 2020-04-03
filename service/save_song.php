<?php

include('_conexion.php');

$response=new stdClass();

$sql="INSERT INTO cancion (nomcan,urlcan) VALUES('".$_GET['name']."','".$_GET['url']."')";
$result=mysqli_query($con,$sql);
if ($result===true) {
	$response->state=true;
}else{
	$response->state=false;
	$response->detail="No se pudo guardar la cancion!";
}

header('Content-Type: application/json');
echo json_encode($response);
mysqli_close($con);