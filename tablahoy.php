<?php

require("fechahoy.php");

$servername = "localhost";
$username = "test";
$password = "EkMGdb5c";
$dbname = "data";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
ini_set('display_errors', 1);
//
$sql="TRUNCATE hoy";
$res=$conn->query($sql);
$sql="TRUNCATE fecha";
$res=$conn->query($sql);
//total hoy
/*$fecha_actual = date("d-m-Y");
for($i=0;$i<30;$i++){
	$hoy = date("Y/m/d",strtotime($fecha_actual."- $i days"));
	$rest = substr($hoy, 0, 1);
	/*if($rest == '0'){
		$hoy=substr($hoy, 1, strlen($hoy)-1);
	}*//*
	$hoytmp=$hoy;
	$hoy="";
	//echo $hoy."<p>Tiempo vacio</p><br>";
	for($k=0;$k<strlen($hoytmp);$k++){
		$restp = substr($hoytmp, $k, 1);
		if($restp != '/'){
			$hoy=$hoy.$restp;
		}
	}
	
	$sql="SELECT * FROM positivos where fecha_resultado='$hoy'";
	$res=$conn->query($sql);
	if($res->num_rows==0){
		echo $hoy."<br>";
	}else{
		echo "check-->".$hoy;
		break;
	}
}*/
//






$sql="SELECT * FROM positivos where fecha_resultado='$hoyfecha'";
$res=$conn->query($sql);
if($res->num_rows > 0){
  while($row= $res->fetch_assoc()){
	$uuid=$row["uuid"];
	$depar=$row["departamento"];
	$prov=$row["provincia"];
	$dis=$row["distrito"];
	$eto=$row["metododx"];
	$edad=$row["edad"];
	$sex=$row["sexo"];
	$fech=$row["fecha_resultado"];
    $sqlin="INSERT INTO hoy VALUES('$uuid','$depar','$prov','$dis','$eto','$edad','$sex','$fech')";
	$in=$conn->query($sqlin);
  }
}
$sqlin="INSERT INTO fecha VALUES('$hoy', '$ayer', '$hoyfecha')";
$in=$conn->query($sqlin);


//require("fechaproyeccion.php");
?>
