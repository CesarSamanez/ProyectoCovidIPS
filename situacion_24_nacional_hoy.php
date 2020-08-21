<?php

//require("fechahoy.php");

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
/*
//total pruebas
$tiempo_inicio = microtime(true);


$j=0;
$fecha_actual = date("Y-m-d");
for($i=0;$i<30;$i++){

	$hoytemp = date("d/m/Y",strtotime($fecha_actual."- $i days"));
	$rest = substr($hoytemp, 0, 1);
	if($rest == '0'){
		$hoytemp=substr($hoytemp, 1, strlen($hoytemp)-1);
	}
	
	$hoy = date("Y/m/d",strtotime($fecha_actual."- $i days"));
	$j=$i+1;
	$ayer = date("Y/m/d",strtotime($fecha_actual."- $j days"));
	$sql="SELECT * FROM positivos where fecha_resultado='$hoytemp'";
	$res=$conn->query($sql);
	if($res->num_rows==0){
		//echo $hoy."<br>";
	}else{
		//echo "".$hoy."<br>";
		//echo "".$ayer."<br>";
		echo "".$i."<br>";
		break;
	}
}
$tiempo_fin = microtime(true);
echo "Tiempo empleado: " . ($tiempo_fin - $tiempo_inicio)."<br>";
*/

/*$hoy=date("Y")."-".date("m")."-".date("d");
$ayer=date("Y-m-d", strtotime("yesterday")); 
$hoy="2020-06-20";//borrar
$ayer="2020-06-19";//borrar*/

$sql="SELECT * FROM fecha";
$res=$conn->query($sql);
if($res->num_rows > 0){
  while($row= $res->fetch_assoc()){
	  $hoy=$row["hoy"];
	  $ayer=$row["ayer"];
  }
}




$sql="SELECT cantidad FROM pruebas WHERE fecha='$hoy'";
$res=$conn->query($sql);
if($res->num_rows > 0){
  while($row= $res->fetch_assoc()){
	  $th=$row["cantidad"];
  }
}
$sql="SELECT cantidad FROM pruebas WHERE fecha='$ayer'";
$res=$conn->query($sql);
if($res->num_rows > 0){
  while($row= $res->fetch_assoc()){
	  $ta=$row["cantidad"];
  }
}
$totalHOY=$th-$ta;
$data["totalHOY"]=$totalHOY;
//echo "\$totalHOY -> ".$totalHOY."<br>";

//total positivos
$sql="SELECT COUNT(uuid) total FROM hoy";
$res=$conn->query($sql);
if($res->num_rows > 0){
  while($row= $res->fetch_assoc()){
	$totalPOS=$row["total"];
	$data["totalPOS"]=$totalPOS;
   // echo "\$totalPOS -> ".$totalPOS."<br>";
  }
}

//total p rapida hoy
$sql="SELECT COUNT(uuid) tp FROM hoy WHERE metododx='PR'";
$res=$conn->query($sql);
if($res->num_rows > 0){
  while($row= $res->fetch_assoc()){
	  $totalPR=$row["tp"];
	  $data["totalPR"]=$totalPR;
    //echo "\$totalPR -> ".$totalPR."<br>";
  }
}
//total pruebas oleculars
$sql="SELECT COUNT(uuid) tp FROM hoy WHERE metododx='PCR'";
$res=$conn->query($sql);
if($res->num_rows > 0){
  while($row= $res->fetch_assoc()){
	  $totalPCR=$row["tp"];
	  $data["totalPCR"]=$totalPCR;
    //echo "\$totalPCR -> ".$totalPCR."<br>";
  }
}
//PRUEBAS HOY VARONES
$sql="SELECT COUNT(uuid) tp FROM hoy WHERE sexo='MASCULINO'";
$res=$conn->query($sql);
if($res->num_rows > 0){
  while($row= $res->fetch_assoc()){
	  $totalM=$row["tp"];
	  $data["totalM"]=$totalM;
    //echo "\$totalM -> ".$totalM."<br>";
  }
}
//PRUEBAS HOY FEmeni
$sql="SELECT COUNT(uuid) tp FROM hoy WHERE sexo='FEMENINO'";
$res=$conn->query($sql);
if($res->num_rows > 0){
  while($row= $res->fetch_assoc()){
	  $totalF=$row["tp"];
	  $data["totalF"]=$totalF;
    //echo "\$totalF -> ".$totalF."<br>";
  }
}


//departa
//SELECT COUNT(uuid) FROM `positivos` WHERE departamento='arequipa' AND provincia='arequipa'
$hoy=date("d")."/".date("m")."/".date("Y");
$hoy="20/06/2020";//borrar
$sql="SELECT DISTINCT(departamento) FROM hoy ORDER BY departamento";
$res=$conn->query($sql);
$depaHOY=[[]];
$i=0;
if($res->num_rows > 0){
  while($row= $res->fetch_assoc()){
    $depnom=$row["departamento"];
    $sql="SELECT COUNT(uuid) total FROM hoy WHERE departamento='$depnom' AND metododx='PR'";
    //echo $depnom." ";
	$depaHOY[$i][0]=$depnom;
    $depcant=$conn->query($sql);
    if($depcant->num_rows > 0){
      $num=$depcant->fetch_assoc();
	  $depPR=$num["total"];
      //echo $depPR." ";
	  $depaHOY[$i][1]=$depPR;
    }
	$sql="SELECT COUNT(uuid) total FROM hoy WHERE departamento='$depnom' AND metododx='PCR'";
    $depcant=$conn->query($sql);
    if($depcant->num_rows > 0){
      $num=$depcant->fetch_assoc();
      $depPCR=$num["total"];
      //echo $depPCR." ";
	  $depaHOY[$i][2]=$depPCR;
    }
	$sql="SELECT COUNT(uuid) total FROM hoy WHERE departamento='$depnom'";
    $depcant=$conn->query($sql);
    if($depcant->num_rows > 0){
      $num=$depcant->fetch_assoc();
      $depT=$num["total"];
      //echo $depT."<br>";
	  $depaHOY[$i][3]=$depT;
    } 
	$i++;
  }
}
$data["depaHOY"]=$depaHOY;
$data["depat"]=$i;
echo json_encode($data);
?>
